<?php 
$page_title='Accueil'; 
include __DIR__.'/header.php'; ?>

<section class="hero">
  <div class="hero-text">
    <h1>Bienvenue à <span class="accent">WEBIBLIO</span></h1>
    <p>Recherchez, découvrez et gérez les livres de notre bibliothèque en ligne. Utilisez la barre de recherche ci‑dessous pour trouver un titre ou un auteur, puis consultez les détails ou ajoutez-le à votre liste de lecture.</p>
    <form class="search" action="resultats.php" method="get">
      <input type="text" name="q" placeholder="Rechercher par titre ou auteur…" aria-label="Rechercher">
      <button type="submit">Rechercher</button>
    </form>
    <p class="mt-1 small">Astuce : laissez vide et validez pour voir tous les livres.</p>
  </div>
</section>

<section>
  <h2>Nouveautés</h2>
  <div class="grid cards">
  <?php
    $stmt = $pdo->query("SELECT id, titre, auteur, image FROM livres ORDER BY created_at DESC, id DESC LIMIT 6");
    foreach ($stmt as $row): ?>
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