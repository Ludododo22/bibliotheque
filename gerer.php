<?php $page_title='Gestion des livres'; include __DIR__.'/header.php'; ?>
<section>
  <h1>Gestion des livres</h1>
  <p class="muted">Ajoutez, modifiez ou supprimez des livres.</p>
  <div class="actions mb-1">
    <a class="btn" href="book_form.php">➕ Ajouter un livre</a>
  </div>
  <?php
    $stmt = $pdo->query("SELECT id, titre, auteur, nombre_exemplaire, image FROM livres ORDER BY id DESC");
    $rows = $stmt->fetchAll();
  ?>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Couverture</th>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Exemplaires</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($rows as $r): ?>
        <tr>
          <td><?= (int)$r['id'] ?></td>
          <td>
            <?php if ($r['image']): ?>
              <img src="uploads/<?= h($r['image']) ?>" alt="Couverture" style="max-height: 60px; border-radius: 0.3rem;">
            <?php else: ?>
              <span class="muted">—</span>
            <?php endif; ?>
          </td>
          <td><?= h($r['titre']) ?></td>
          <td><?= h($r['auteur']) ?></td>
          <td><?= (int)$r['nombre_exemplaire'] ?></td>
          <td>
            <a class="btn small" href="book_form.php?id=<?= (int)$r['id'] ?>">Modifier</a>
            <form class="inline" method="post" action="delete_book.php" onsubmit="return confirm('Supprimer ce livre ?');">
              <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
              <button type="submit" class="danger small">Supprimer</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</section>
<?php include __DIR__.'/footer.php'; ?>