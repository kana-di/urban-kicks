<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: /dashboard/boutique/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /dashboard/boutique/admin/liste-produits.php");
    exit();
}

$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;

if ($product_id > 0) {
    require_once '../includes/db.php';

    $stmt = $connexion->prepare("DELETE FROM produits WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        $_SESSION['flash']      = "Produit supprimé avec succès.";
        $_SESSION['flash_type'] = 'success';
    } else {
        $_SESSION['flash']      = "Erreur : produit introuvable ou déjà supprimé.";
        $_SESSION['flash_type'] = 'error';
    }
    $stmt->close();
} else {
    $_SESSION['flash']      = "ID de produit invalide.";
    $_SESSION['flash_type'] = 'error';
}

header("Location: /dashboard/boutique/admin/liste-produits.php");
exit();
