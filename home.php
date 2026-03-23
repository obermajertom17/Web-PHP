<!doctype html>
<html lang="cs">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?> - Domů</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav>
    <a href="?page=home">Domů</a>
    <a href="?page=interests">Zájmy</a>
    <a href="?page=skills">Dovednosti</a>
  </nav>

  <section class="hero">
    <div class="hero-inner">
      <div>
        <h1><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></h1>
        <p><?php echo htmlspecialchars($education, ENT_QUOTES, 'UTF-8'); ?> — <?php echo htmlspecialchars($school['city'] ?? $city, ENT_QUOTES, 'UTF-8'); ?></p>
        <p><?php echo htmlspecialchars($about, ENT_QUOTES, 'UTF-8'); ?></p>
        <p><a class="cta" href="#contact">Kontaktovat</a></p>
      </div>
      <div class="avatar"><?php echo strtoupper(substr($name,0,1)); ?></div>
    </div>
  </section>

  <main>
    <div class="left-column">
      <div id="about" class="card">
        <h2>O mně</h2>
        <div class="profile-meta">
          <p><?php echo htmlspecialchars($about, ENT_QUOTES, 'UTF-8'); ?></p>
          <?php if ($age !== ''): ?><p>Věk: <?php echo htmlspecialchars($age, ENT_QUOTES, 'UTF-8'); ?></p><?php endif; ?>
          <?php if ($city !== ''): ?><p>Bydliště: <?php echo htmlspecialchars($city, ENT_QUOTES, 'UTF-8'); ?></p><?php endif; ?>
        </div>
      </div>

      <div id="school-overview" class="card">
        <h2>Škola & Obory</h2>
        <p><strong><?php echo htmlspecialchars($school['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?></strong> — <?php echo htmlspecialchars($school['city'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
        <p>Současný obor: <?php echo htmlspecialchars($school['current_field'] ?? ($school['fields'][0]['name'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></p>

        <?php if (!empty($school['fields']) && is_array($school['fields'])): ?>
          <div class="school-fields">
            <?php foreach ($school['fields'] as $field): ?>
              <div class="field-card">
                <div class="field-head">
                  <div class="field-icon"><?php echo htmlspecialchars(mb_substr($field['name'],0,1), ENT_QUOTES, 'UTF-8'); ?></div>
                  <div class="field-title">
                    <h4><?php echo htmlspecialchars($field['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h4>
                    <p class="muted small"><?php echo htmlspecialchars($field['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
                  </div>
                <?php if (!empty($field['subjects']) && is_array($field['subjects'])): ?>
                  <ul class="subject-list">
                    <?php foreach ($field['subjects'] as $sub): ?>
                      <li><?php echo htmlspecialchars($sub, ENT_QUOTES, 'UTF-8'); ?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>

      <div id="hobbies" class="card">
        <h2>Zájmy a volný čas</h2>
        <?php if (!empty($data['hobbies']) && is_array($data['hobbies'])): ?>
          <div class="badges">
            <?php foreach ($data['hobbies'] as $h): ?>
              <div class="badge"><?php echo htmlspecialchars($h, ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <p>Ukaž, co tě baví — třeba sport, cestování nebo koníčky.</p>
        <?php endif; ?>
      </div>

      <div id="projects" class="card projects">
        <h2>Projekty</h2>
        <?php if (!empty($data['projects']) && is_array($data['projects'])): ?>
          <?php foreach ($data['projects'] as $proj): ?>
            <div class="project">
              <h3><?php echo htmlspecialchars($proj['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h3>
              <p><?php echo htmlspecialchars($proj['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>Žádné projekty k zobrazení.</p>
        <?php endif; ?>
      </div>
    </div>

    <aside class="right-column">
      <!-- Prázdné pro domovskou stránku -->
    </aside>
  </main>

  <footer>
    &copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?> — vytvořeno jako školní portfolio
  </footer>
</body>
</html>