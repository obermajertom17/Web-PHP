<?php
// Načtení dat z profile.json
$data = [];
$json = @file_get_contents(__DIR__ . '/profile.json');
if ($json !== false) {
    $decoded = json_decode($json, true);
    if (is_array($decoded)) {
        $data = $decoded;
    }
}

$name = isset($data['name']) ? $data['name'] : 'Neznámý';
$skills = isset($data['skills']) && is_array($data['skills']) ? $data['skills'] : [];
$interests = isset($data['interests']) && is_array($data['interests']) ? $data['interests'] : [];
?>
<!doctype html>
<html lang="cs">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main>
    <header>
      <h1><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></h1>
    </header>

    <section>
      <h2>Dovednosti</h2>
      <?php if (!empty($skills)): ?>
        <ul>
        <?php foreach ($skills as $skill): ?>
          <li><?php echo htmlspecialchars($skill, ENT_QUOTES, 'UTF-8'); ?></li>
        <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <p>Žádné dovednosti k zobrazení.</p>
      <?php endif; ?>
    </section>

    <!-- Interests/projects section will be added in the next commit -->

  </main>
</body>
</html>
