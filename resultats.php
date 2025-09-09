<?php 

$page_title='Résultats'; 
include __DIR__.'/header.php'; 
$q = trim($_GET['q'] ?? '');
?>

<section>
  <h1>Résultats de recherche</h1>
  <form class="search mb-1" action="results.php" method="get">
    <input type="text" name="q" value="<?= h($q) ?>" placeholder="Titre ou auteur…">
    <button type="submit">Rechercher</button>
  </form>

  <?php
    if ($q === '') {
        $stmt = $pdo->query("SELECT id, titre, auteur, image FROM livres ORDER BY titre ASC");
    } else {
        $stmt = $pdo->prepare("SELECT id, titre, auteur, image FROM livres WHERE titre LIKE :q OR auteur LIKE :q ORDER BY titre ASC");
        $stmt->execute([':q' => "%$q%"]);
    }
    $rows = $stmt->fetchAll();
  ?>

  <p class="muted"><?= count($rows) ?> livre(s) trouvé(s)</p>
  <div class="grid cards">
    <?php foreach ($rows as $row): ?>
      <article class="card">
        <?php if ($row['image']): ?>
          <div style="text-align:center; margin-bottom:1rem;">
            <img src="uploads/<?= h($row['image']) ?>" alt="Couverture de <?= h($row['titre']) ?>" style="max-height:120px; border-radius:0.5rem;">
          </div>
        <?php endif; ?>
        <h3><?= h($row['titre']) ?></h3>
        <p class="muted"><?= h($row['auteur']) ?></p>
        <div class="actions">
          <a class="btn" href="details.php?id=<?= (int)$row['id'] ?>">Détails</a>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>
<?php include __DIR__.'/footer.php'; ?>