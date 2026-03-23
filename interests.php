<!doctype html>
<html lang="cs">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?> - Zájmy</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav>
    <a href="?page=home">Domů</a>
    <a href="?page=interests">Zájmy</a>
    <a href="?page=skills">Dovednosti</a>
  </nav>

  <main>
    <div class="card">
      <h2>Zájmy</h2>
      <?php if (!empty($message)): ?>
        <p class="<?php echo $messageType; ?>"><?php echo htmlspecialchars($message); ?></p>
      <?php endif; ?>

      <form method="post" class="interest-form">
        <input type="text" name="new_interest" required placeholder="Nový zájem">
        <button type="submit">Přidat zájem</button>
      </form>

      <?php if ($editInterestId !== null): ?>
        <form method="post" class="interest-form">
          <input type="hidden" name="edit_interest_id" value="<?php echo $editInterestId; ?>">
          <input type="text" name="edit_interest_name" value="<?php echo htmlspecialchars($editInterestName, ENT_QUOTES, 'UTF-8'); ?>" required>
          <button type="submit">Uložit změny</button>
          <a class="button secondary" href="index.php?page=interests">Zrušit</a>
        </form>
      <?php endif; ?>

      <?php if (!empty($interests)): ?>
        <ul class="interest-list">
          <?php foreach ($interests as $interest): ?>
            <li>
              <?php echo htmlspecialchars($interest['name'], ENT_QUOTES, 'UTF-8'); ?>
              <a class="edit-button" href="?page=interests&edit_id=<?php echo $interest['id']; ?>">Upravit</a>
              <form method="post" class="delete-form" style="display:inline">
                <input type="hidden" name="delete_interest_id" value="<?php echo $interest['id']; ?>">
                <button type="submit" class="delete-button" aria-label="Smazat <?php echo htmlspecialchars($interest['name'], ENT_QUOTES, 'UTF-8'); ?>">&times;</button>
              </form>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <p>Žádné zájmy nejsou uvedené.</p>
      <?php endif; ?>
    </div>
  </main>

  <footer>
    &copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?> — vytvořeno jako školní portfolio
  </footer>
</body>
</html>