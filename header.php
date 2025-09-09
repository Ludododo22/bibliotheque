<?php require_once __DIR__ . '/config.php'; $lecteurId = ensure_current_lecteur_id($pdo); ?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= h($page_title ?? 'Bibliothèque en ligne') ?></title>
  <link rel="stylesheet" href="assets/styles.css">
  <script defer src="assets/script.js"></script>
</head>
<body>
<header class="site-header">
  <div class="container header-inner">
    <a class="brand" href="index.php">Bibliothèque Web</a>
    <nav>
      <a href="index.php">Accueil</a>
      <a href="resultats.php">Recherche</a>
      <a href="favoris.php">Mes Favoris</a>
      <a href="gerer.php">Gestion des livres</a>
    </nav>
  </div>
</header>
<main class="container"><?php if (!empty($_SESSION['flash'])) { echo '<div class="card" style="margin:1rem 0; padding:.75rem 1rem;">'.h($_SESSION['flash']).'</div>'; unset($_SESSION['flash']); } ?>
