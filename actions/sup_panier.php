<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /dashboard/boutique/login.php");
    exit();
}

require_once '../includes/db.php';

$user_id = $_SESSION['user_id'];

if (!isset($_POST['produits']) || !is_array($_POST['produits'])) {
    header("Location: /dashboard/boutique/panier.php?message=Aucun+article+sélectionné.");
    exit();
}

$produits = array_map('intval', $_POST['produits']);
$placeholders = implode(',', array_fill(0, count($produits), '?'));
$types = str_repeat('i', count($produits) + 1);

$stmt = $connexion->prepare(
    "DELETE FROM panier WHERE user_id = ? AND product_id IN ($placeholders)"
);
$stmt->bind_param($types, $user_id, ...$produits);

if ($stmt->execute()) {
    header("Location: /dashboard/boutique/panier.php?message=Articles+supprimés.");
} else {
    header("Location: /dashboard/boutique/panier.php?error=1");
}
$stmt->close();
exit();
