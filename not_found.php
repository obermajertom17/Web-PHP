<!doctype html>
<html lang="cs">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>404 - Stránka nenalezena</title>
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
      <h2>404 - Stránka nenalezena</h2>
      <p>Omlouváme se, ale požadovaná stránka neexistuje.</p>
      <p><a href="?page=home">Zpět na domovskou stránku</a></p>
    </div>
  </main>

  <footer>
    &copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($name ?? 'Neznámý', ENT_QUOTES, 'UTF-8'); ?> — vytvořeno jako školní portfolio
  </footer>
</body>
</html>