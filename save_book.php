<?php 

require_once __DIR__.'/config.php';

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$titre = trim($_POST['titre'] ?? '');
$auteur = trim($_POST['auteur'] ?? '');
$maison = trim($_POST['maison_edition'] ?? '');
$nb = (int)($_POST['nombre_exemplaire'] ?? 0);
$desc = trim($_POST['description'] ?? '');

// Gestion de l'image
$image_filename = null;
$image_error = null;

if ($id > 0) {
    // En édition, on récupère l'image actuelle
    $stmt = $pdo->prepare("SELECT image FROM livres WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $current_image = $stmt->fetchColumn();
}

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
    $max_size = 2 * 1024 * 1024; // 2 Mo

    if ($_FILES['image']['size'] > $max_size) {
        $image_error = "L'image est trop volumineuse (max 2 Mo).";
    } elseif (!in_array($_FILES['image']['type'], $allowed_types)) {
        $image_error = "Format non supporté (JPEG, PNG, WebP uniquement).";
    } else {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_filename = 'livre_' . time() . '_' . mt_rand(1000, 9999) . '.' . $ext;

        // Vérifier que le dossier uploads existe
        if (!is_dir(__DIR__ . '/uploads')) {
            mkdir(__DIR__ . '/uploads', 0755, true);
        }

        $upload_path = __DIR__ . '/uploads/' . $image_filename;
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
            $image_error = "Erreur lors de l'upload de l'image.";
        }
    }
}

if ($titre === '' || $auteur === '') {
    $_SESSION['flash'] = "Le titre et l'auteur sont requis.";
    header("Location: book_form.php" . ($id > 0 ? "?id=$id" : ""));
    exit;
}

if ($image_error) {
    $_SESSION['flash'] = $image_error;
    header("Location: book_form.php" . ($id > 0 ? "?id=$id" : ""));
    exit;
}

try {
    if ($id > 0) {
        // Si une nouvelle image a été uploadée, on supprime l’ancienne
        if ($image_filename && $current_image) {
            $old_path = __DIR__ . '/uploads/' . $current_image;
            if (file_exists($old_path)) {
                unlink($old_path);
            }
        }

        $sql = "UPDATE livres SET titre=:t, auteur=:a, description=:d, maison_edition=:m, nombre_exemplaire=:n";
        $params = [':t'=>$titre, ':a'=>$auteur, ':d'=>$desc, ':m'=>$maison, ':n'=>$nb, ':id'=>$id];

        if ($image_filename) {
            $sql .= ", image=:img";
            $params[':img'] = $image_filename;
        }

        $sql .= " WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        $_SESSION['flash'] = "Livre mis à jour.";
    } else {
        $sql = "INSERT INTO livres (titre, auteur, description, maison_edition, nombre_exemplaire";
        $params = [':t'=>$titre, ':a'=>$auteur, ':d'=>$desc, ':m'=>$maison, ':n'=>$nb];

        if ($image_filename) {
            $sql .= ", image";
            $params[':img'] = $image_filename;
        }

        $sql .= ") VALUES (:t, :a, :d, :m, :n";
        if ($image_filename) {
            $sql .= ", :img";
        }
        $sql .= ")";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        $_SESSION['flash'] = "Livre créé.";
    }
} catch (Exception $e) {
    $_SESSION['flash'] = "Erreur lors de l'enregistrement : " . $e->getMessage();
}

header("Location: gerer.php");
exit;