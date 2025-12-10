<!-- src/Views/salamanders/show.php -->

<h1><?= htmlspecialchars($salamander['name']) ?></h1>

<p><strong>Habitat:</strong> <?= htmlspecialchars($salamander['habitat']) ?></p>

<p><strong>Description:</strong><br>
    <?= nl2br(htmlspecialchars($salamander['description'])) ?>
</p>

<p>
    <a href="/web250-mvc/public/salamanders">Back to list</a>
</p>