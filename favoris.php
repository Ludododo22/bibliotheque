<?php 
$page_title='Ma liste de lecture'; 
include __DIR__.'/header.php'; 
$lecteurId = ensure_current_lecteur_id($pdo);
$stmt = $pdo->prepare("
  SELECT ll.id, l.id as id_livre, l.titre, l.auteur, l.image, ll.date_emprunt, ll.date_retour
  FROM liste_lecture ll
  JOIN livres l ON l.id = ll.id_livre
  WHERE ll.id_lecteur = :id
  ORDER BY ll.created_at DESC
");
$stmt->execute([':id'=>$lecteurId]);
$items = $stmt->fetchAll();
?>
<section>
  <h1>Ma liste de lecture</h1>
  <?php if (!$items): ?>
    <p class="muted">Votre liste est vide.</p>
  <?php else: ?>
    <ul class="list" style="list-style: none; padding: 0; margin: 0;">
      <?php foreach ($items as $it): ?>
        <li class="list-item" style="display: flex; align-items: flex-start; gap: 1rem; padding: 1rem; border: 1px solid #273043; border-radius: 0.75rem; margin-bottom: 0.75rem; background: var(--card);">
          <?php if ($it['image']): ?>
            <div style="flex: 0 0 80px;">
              <img src="uploads/<?= h($it['image']) ?>" alt="Couverture de <?= h($it['titre']) ?>" style="width: 80px; height: 110px; object-fit: cover; border-radius: 0.5rem; box-shadow: var(--shadow);">
            </div>
          <?php endif; ?>
          <div style="flex: 1;">
            <strong><?= h($it['titre']) ?></strong>
            <span class="muted">— <?= h($it['auteur']) ?></span>
          </div>
          <form action="retirer_liste_favoris.php" method="post" class="inline" style="align-self: center;">
            <input type="hidden" name="id_livre" value="<?= (int)$it['id_livre'] ?>">
            <button type="submit" class="danger" style="padding: 0.4rem 0.8rem; font-size: 0.9rem;">Retirer</button>
          </form>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</section>
<?php include __DIR__.'/footer.php'; ?>