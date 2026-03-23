<!doctype html>
<html lang="cs">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?> - Dovednosti</title>
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
      <h2>Dovednosti</h2>
      <div class="badges">
        <?php foreach ($skills as $skill): ?>
          <div class="badge"><?php echo htmlspecialchars($skill, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endforeach; ?>
      </div>
    </div>
  </main>

  <footer>
    &copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?> — vytvořeno jako školní portfolio
  </footer>
</body>
</html>