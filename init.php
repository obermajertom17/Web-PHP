<?php
// Inicializace SQLite databáze pro zájmy
// Vytvoří soubor profile.db a tabulku interests, pokud neexistují.

$dbPath = __DIR__ . '/profile.db';

try {
    $db = new PDO('sqlite:' . $dbPath);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db->exec(
        'CREATE TABLE IF NOT EXISTS interests (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL UNIQUE COLLATE NOCASE
        )'
    );
} catch (Throwable $e) {
    // Pokud selže připojení k databázi, zobrazíme jednoduchou chybu.
    // V produkci by bylo vhodné chybovou hlášku logovat.
    http_response_code(500);
    echo 'Nepodařilo se připojit k databázi.';
    exit;
}
