<?php
session_start(); // Démarrer la session

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$database = "boutique";

$connexion = mysqli_connect($servername, $username, $password, $database);
if (!$connexion) {
    die("Connection failed: " . mysqli_connect_error());
}

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo '<div class="alert alert-danger">Vous devez être connecté pour supprimer des produits de votre panier.</div>';
    exit();
}

// Récupérer l'ID de l'utilisateur
$user_id = $_SESSION['user_id'];

// Vérifiez si des produits ont été sélectionnés
if (isset($_POST['produits']) && is_array($_POST['produits'])) {
    // Préparez la requête pour supprimer les produits sélectionnés
    $produits = $_POST['produits'];
    $placeholders = implode(',', array_fill(0, count($produits), '?'));
    $sql = "DELETE FROM panier WHERE user_id = ? AND product_id IN ($placeholders)";

    $stmt = mysqli_prepare($connexion, $sql);

    // Lier les paramètres
    $types = str_repeat('i', count($produits) + 1); // 'i' pour integer
    mysqli_stmt_bind_param($stmt, $types, $user_id, ...$produits);

    // Exécuter la requête
    if (mysqli_stmt_execute($stmt)) {
        // Rediriger vers la page du panier avec un message de succès
        header("Location: panier.php?message=Produits supprimés avec succès.");
        exit();
    } else {
        echo '<div class="alert alert-danger">Erreur lors de la tentative de suppression des produits.</div>';
    }
} else {
    echo '<div class="alert alert-warning">Aucun produit sélectionné pour la suppression.</div>';
}

// Fermez la connexion
mysqli_close($connexion);
?>