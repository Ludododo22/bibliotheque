<?php $page_title='Détails du livre'; include __DIR__.'/header.php'; 
$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) { echo "<p>Identifiant invalide.</p>"; include __DIR__.'/footer.php'; exit; }
$stmt = $pdo->prepare("SELECT * FROM livres WHERE id=:id");
$stmt->execute([':id'=>$id]);
$book = $stmt->fetch();
if (!$book) { echo "<p>Livre introuvable.</p>"; include __DIR__.'/footer.php'; exit; }
?>
<article class="book-details">
  <h1><?= h($book['titre']) ?></h1>
  <p class="muted">par <?= h($book['auteur']) ?></p>

  <?php if ($book['image']): ?>
    <div style="text-align:center; margin:1.5rem 0;">
      <img src="uploads/<?= h($book['image']) ?>" alt="Couverture de <?= h($book['titre']) ?>" style="max-width:200px; border-radius:0.75rem; box-shadow: var(--shadow);">
    </div>
  <?php endif; ?>

  <dl class="meta">
    <dt>Maison d'édition</dt><dd><?= h($book['maison_edition']) ?: '—' ?></dd>
    <dt>Exemplaires</dt><dd><?= (int)$book['nombre_exemplaire'] ?></dd>
  </dl>
  <p><?= nl2br(h($book['description'])) ?></p>

  <form action="ajout.php" method="post" class="inline">
    <input type="hidden" name="id_livre" value="<?= (int)$book['id'] ?>">
    <button type="submit">Ajouter à ma liste</button>
  </form>
  <a class="btn secondary" href="resultats.php">← Retour</a>
</article>
<?php include __DIR__.'/footer.php'; ?>