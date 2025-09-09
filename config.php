<?php
// config.php
declare(strict_types=1);
session_start();

// --- Database configuration ---
$DB_HOST = getenv('DB_HOST') ?: 'localhost';
$DB_NAME = getenv('DB_NAME') ?: 'bibliotheque';
$DB_USER = getenv('DB_USER') ?: 'root';
$DB_PASS = getenv('DB_PASS') ?: '';

try {
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo "<h1>Erreur de connexion à la base de données</h1>";
    echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
    exit;
}

// --- Ensure a 'lecteur' linked to this session (guest mode) ---
function ensure_current_lecteur_id(PDO $pdo): int {
    if (isset($_SESSION['lecteur_id'])) {
        return (int)$_SESSION['lecteur_id'];
    }
    // Create a guest lecteur
    $nom = 'Invité';
    $prenom = 'Guest';
    $email = 'guest-' . session_id() . '@example.com';
    $stmt = $pdo->prepare("INSERT INTO lecteurs (nom, prenom, email) VALUES (:nom, :prenom, :email)");
    $stmt->execute([':nom' => $nom, ':prenom' => $prenom, ':email' => $email]);
    $_SESSION['lecteur_id'] = (int)$pdo->lastInsertId();
    return (int)$_SESSION['lecteur_id'];
}

function h(?string $s): string {
    return htmlspecialchars($s ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
?>
