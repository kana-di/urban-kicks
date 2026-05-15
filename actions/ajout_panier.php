<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /dashboard/boutique/login.php");
    exit();
}

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id === 0) {
    header("Location: /dashboard/boutique/produits.php");
    exit();
}

require_once '../includes/db.php';

$user_id  = $_SESSION['user_id'];
$quantite = 1;

// Vérifie si le produit est déjà dans le panier
$check = $connexion->prepare("SELECT id FROM panier WHERE user_id = ? AND product_id = ?");
$check->bind_param("ii", $user_id, $product_id);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    $stmt = $connexion->prepare(
        "UPDATE panier SET quantite = quantite + ? WHERE user_id = ? AND product_id = ?"
    );
    $stmt->bind_param("iii", $quantite, $user_id, $product_id);
} else {
    $stmt = $connexion->prepare(
        "INSERT INTO panier (user_id, product_id, quantite) VALUES (?, ?, ?)"
    );
    $stmt->bind_param("iii", $user_id, $product_id, $quantite);
}
$check->close();

if ($stmt->execute()) {
    header("Location: /dashboard/boutique/panier.php?message=Produit+ajouté+au+panier.");
} else {
    header("Location: /dashboard/boutique/produits.php?error=panier");
}
$stmt->close();
exit();
