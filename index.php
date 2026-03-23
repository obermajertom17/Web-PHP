<?php
session_start();
require_once __DIR__ . '/db.php';

// Načtení dalších dat z profile.json (profil, projekty, atd.)
$data = [];
$json = @file_get_contents(__DIR__ . '/profile.json');
if ($json !== false) {
    $decoded = json_decode($json, true);
    if (is_array($decoded)) {
        $data = $decoded;
    }
}

// Flash zprávy
$message = $_SESSION['flash_message'] ?? '';
$messageType = $_SESSION['flash_type'] ?? '';
unset($_SESSION['flash_message'], $_SESSION['flash_type']);

// Zpracování POST akcí (přidání / úprava / smazání) - pouze pro interests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // smazání zájmu
    if (isset($_POST['delete_interest_id'])) {
        $id = (int) $_POST['delete_interest_id'];
        if ($id <= 0) {
            $_SESSION['flash_message'] = 'Nepodařilo se odstranit zájem.';
            $_SESSION['flash_type'] = 'error';
        } else {
            $stmt = $db->prepare('DELETE FROM interests WHERE id = ?');
            $stmt->execute([$id]);
            $_SESSION['flash_message'] = 'Zájem byl odstraněn.';
            $_SESSION['flash_type'] = 'success';
        }

        header('Location: index.php?page=interests');
        exit;
    }

    // úprava zájmu
    if (isset($_POST['edit_interest_id'], $_POST['edit_interest_name'])) {
        $id = (int) $_POST['edit_interest_id'];
        $newValue = trim((string) $_POST['edit_interest_name']);

        if ($id <= 0 || $newValue === '') {
            $_SESSION['flash_message'] = 'Pole nesmí být prázdné.';
            $_SESSION['flash_type'] = 'error';
        } else {
            // kontrola duplicity (bez ohledu na velikost písmen)
            $stmt = $db->prepare('SELECT 1 FROM interests WHERE LOWER(name) = LOWER(?) AND id != ? LIMIT 1');
            $stmt->execute([$newValue, $id]);
            if ($stmt->fetch()) {
                $_SESSION['flash_message'] = 'Tento zájem už existuje.';
                $_SESSION['flash_type'] = 'error';
            } else {
                $stmt = $db->prepare('UPDATE interests SET name = ? WHERE id = ?');
                $stmt->execute([$newValue, $id]);
                $_SESSION['flash_message'] = 'Zájem byl upraven.';
                $_SESSION['flash_type'] = 'success';
            }
        }

        header('Location: index.php?page=interests');
        exit;
    }

    // přidání nového zájmu
    if (isset($_POST['new_interest'])) {
        $newInterest = trim((string) $_POST['new_interest']);
        if ($newInterest === '') {
            $_SESSION['flash_message'] = 'Pole nesmí být prázdné.';
            $_SESSION['flash_type'] = 'error';
        } else {
            // kontrola duplicity (bez ohledu na velikost písmen)
            $stmt = $db->prepare('SELECT 1 FROM interests WHERE LOWER(name) = LOWER(?) LIMIT 1');
            $stmt->execute([$newInterest]);
            if ($stmt->fetch()) {
                $_SESSION['flash_message'] = 'Tento zájem už existuje.';
                $_SESSION['flash_type'] = 'error';
            } else {
                $stmt = $db->prepare('INSERT INTO interests (name) VALUES (?)');
                $stmt->execute([$newInterest]);
                $_SESSION['flash_message'] = 'Zájem byl přidán.';
                $_SESSION['flash_type'] = 'success';
            }
        }

        header('Location: index.php?page=interests');
        exit;
    }
}

// Načtení seznamu zájmů z databáze
$interests = [];
try {
    $stmt = $db->query('SELECT id, name FROM interests ORDER BY name');
    $interests = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Throwable $e) {
    // v případě chyby dáme prázdný seznam
    $interests = [];
}

// Pokud se edituje, načteme existující hodnotu
$editInterestId = null;
$editInterestName = '';
if (isset($_GET['edit_id'])) {
    $editInterestId = (int) $_GET['edit_id'];
    if ($editInterestId > 0) {
        $stmt = $db->prepare('SELECT name FROM interests WHERE id = ?');
        $stmt->execute([$editInterestId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $editInterestName = $row['name'];
        } else {
            $editInterestId = null;
        }
    }
}

$name = isset($data['name']) ? $data['name'] : 'Neznámý';
$skills = isset($data['skills']) && is_array($data['skills']) ? $data['skills'] : [];
$age = isset($data['age']) ? $data['age'] : '';
$city = isset($data['city']) ? $data['city'] : '';
$education = isset($data['education']) ? $data['education'] : '';
$about = isset($data['about']) ? $data['about'] : '';
// structured school info
$school = isset($data['school']) && is_array($data['school']) ? $data['school'] : [];

// Routing
$page = $_GET['page'] ?? 'home';
switch ($page) {
    case 'home':
        require __DIR__ . '/pages/home.php';
        break;
    case 'interests':
        require __DIR__ . '/pages/interests.php';
        break;
    case 'skills':
        require __DIR__ . '/pages/skills.php';
        break;
    default:
        require __DIR__ . '/pages/not_found.php';
        break;
}
