<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$database = "boutique";

// Établir la connexion
$connexion = mysqli_connect($servername, $username, $password, $database);

// Vérifier la connexion
if (!$connexion) {
    die("Connection failed: " . mysqli_connect_error());
}

// Récupérer l'ID du produit depuis l'URL
$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

// Récupérer les détails du produit
$sql = "SELECT * FROM produits WHERE product_id = $product_id";
$result = mysqli_query($connexion, $sql);
$product = mysqli_fetch_assoc($result);

// Vérifier si le produit existe
if (!$product) {
    echo '<div class="alert alert-danger">Produit non trouvé.</div>';
    exit;
}
?>

<!DOCTYPE html>