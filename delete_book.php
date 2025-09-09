<?php require_once __DIR__.'/config.php';
$id = (int)($_POST['id'] ?? 0);
if ($id > 0) {
    // Récupérer le nom de l'image avant suppression
    $stmt = $pdo->prepare("SELECT image FROM livres WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $image = $stmt->fetchColumn();

    // Supprimer le livre
    $stmt = $pdo->prepare("DELETE FROM livres WHERE id=:id");
    $stmt->execute([':id'=>$id]);

    // Supprimer le fichier image s'il existe
    if ($image) {
        $image_path = __DIR__ . '/uploads/' . $image;
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }

    $_SESSION['flash'] = "Livre supprimé.";
}
header("Location: gerer.php"); exit;