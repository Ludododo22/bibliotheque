<?php $page_title='Livre'; include __DIR__.'/header.php'; 
$id = (int)($_GET['id'] ?? 0);
$book = ['titre'=>'','auteur'=>'','description'=>'','maison_edition'=>'','nombre_exemplaire'=>1, 'image' => ''];
$editing = false;
if ($id > 0) {
  $stmt = $pdo->prepare("SELECT * FROM livres WHERE id=:id");
  $stmt->execute([':id'=>$id]);
  $book = $stmt->fetch();
  if ($book) $editing = true;
}
?>
<section>
  <h1><?= $editing ? 'Modifier le livre' : 'Ajouter un livre' ?></h1>
  <form class="form" method="post" action="save_book.php" enctype="multipart/form-data">
    <?php if ($editing): ?>
      <input type="hidden" name="id" value="<?= (int)$book['id'] ?>">
    <?php endif; ?>
    <label>Titre
      <input type="text" name="titre" required maxlength="100" value="<?= h($book['titre']) ?>">
    </label>
    <label>Auteur
      <input type="text" name="auteur" required maxlength="100" value="<?= h($book['auteur']) ?>">
    </label>
    <label>Maison d'édition
      <input type="text" name="maison_edition" maxlength="100" value="<?= h($book['maison_edition']) ?>">
    </label>
    <label>Nombre d'exemplaires
      <input type="number" name="nombre_exemplaire" min="0" step="1" value="<?= (int)$book['nombre_exemplaire'] ?>">
    </label>
    <label>Description
      <textarea name="description" rows="6"><?= h($book['description']) ?></textarea>
    </label>
    <label>Image de couverture
      <input type="file" name="image" accept="image/jpeg,image/png,image/webp">
      <?php if ($editing && $book['image']): ?>
        <div class="mt-1">
          <img src="uploads/<?= h($book['image']) ?>" alt="Couverture actuelle" style="max-height: 150px; border-radius: 0.5rem;">
        </div>
      <?php endif; ?>
    </label>
    <div class="actions">
      <button type="submit"><?= $editing ? 'Enregistrer' : 'Créer' ?></button>
      <a class="btn secondary" href="gerer.php">Annuler</a>
    </div>
  </form>
</section>
<?php include __DIR__.'/footer.php'; ?>