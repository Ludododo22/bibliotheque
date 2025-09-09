<?php require_once __DIR__.'/config.php';
$lecteurId = ensure_current_lecteur_id($pdo);
$id_livre = (int)($_POST['id_livre'] ?? 0);
if ($id_livre > 0) {
    try {
        $stmt = $pdo->prepare("INSERT INTO liste_lecture (id_livre, id_lecteur) VALUES (:l, :u)");
        $stmt->execute([':l'=>$id_livre, ':u'=>$lecteurId]);
        $_SESSION['flash'] = "Livre ajouté à votre liste.";
    } catch (PDOException $e) {
        $_SESSION['flash'] = "Ce livre est déjà dans votre liste.";
    }
}
header("Location: favoris.php");
exit;
