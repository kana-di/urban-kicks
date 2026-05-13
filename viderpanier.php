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
    echo '<div class="alert alert-danger">Vous devez être connecté pour vider votre panier.</div>';
    exit();
}

// Récupérer l'ID de l'utilisateur
$user_id = $_SESSION['user_id'];

// Supprimer tous les articles du panier de l'utilisateur
$sql = "DELETE FROM panier WHERE user_id = ?";
$stmt = mysqli_prepare($connexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);

if (mysqli_stmt_execute($stmt)) {
    // Rediriger vers la page du panier avec un message de succès
    header("Location: panier.php?message=Votre panier a été vidé avec succès.");
    exit();
} else {
    echo '<div class="alert alert-danger">Erreur lors de la tentative de vider le panier.</div>';
}

// Fermez la connexion
mysqli_close($connexion);
?>