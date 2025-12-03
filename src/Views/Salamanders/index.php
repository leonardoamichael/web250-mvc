<?php
// src/Views/salamanders/index.php
//
// The View is responsible ONLY for displaying data as HTML.
// It receives the $salamanders variable from the controller.
// It should NOT talk directly to the database.
//
// We use htmlspecialchars() to prevent XSS (cross-site scripting) attacks,
// and nl2br() to keep line breaks in our text.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Salamanders</title>
</head>
<body>
    <h1>Salamanders</h1>

    <?php foreach ($salamanders as $s): ?>
        <h2><?= htmlspecialchars($s['name']) ?></h2>

        <p>
            <strong>Habitat:</strong>
            <?= nl2br(htmlspecialchars($s['habitat'])) ?>
        </p>

        <p>
            <?= nl2br(htmlspecialchars($s['description'])) ?>
        </p>

        <hr>
    <?php endforeach; ?>
</body>
</html>
