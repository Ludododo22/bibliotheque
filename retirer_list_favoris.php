<?php 

require_once __DIR__.'/config.php';

$lecteurId = ensure_current_lecteur_id($pdo);
$id_livre = (int)($_POST['id_livre'] ?? 0);
if ($id_livre > 0) {
    $stmt = $pdo->prepare("DELETE FROM liste_lecture WHERE id_livre=:l AND id_lecteur=:u");
    $stmt->execute([':l'=>$id_livre, ':u'=>$lecteurId]);
    $_SESSION['flash'] = "Livre retiré de votre liste.";
}
header("Location: favoris.php");
exit;
