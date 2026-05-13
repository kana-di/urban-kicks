<?php
session_start(); // Démarrer la session

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configuration de la base de données
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

// Initialiser un message de retour
$message = "BIENVENUE CHER ADMIN";


// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $brand = $_POST['brand'];
    $tailles = $_POST['tailles'];
    $images = explode(',', $_POST['image_url']); // Convertir la chaîne d'images en tableau

    // Préparation de la requête d'insertion pour les produits
    $stmt = $connexion->prepare("INSERT INTO produits (category_id, name, description, price, stock, brand, tailles) VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Vérification de la préparation de la requête
    if (!$stmt) {
        die("Erreur de préparation de la requête : " . mysqli_error($connexion));
    }

    // Lier les paramètres et exécuter la requête
    $stmt->bind_param("issiiss", $category_id, $name, $description, $price, $stock, $brand, $tailles);

    if ($stmt->execute()) {
        // Récupérer l'ID du produit inséré
        $product_id = $stmt->insert_id;

        // Préparation de la requête d'insertion pour les images
        $stmt_image = $connexion->prepare("INSERT INTO produits_images (product_id, image_url) VALUES (?, ?)");

        // Vérification de la préparation de la requête d'images
        if (!$stmt_image) {
            die("Erreur de préparation de la requête d'images : " . mysqli_error($connexion));
        }

        // Boucle à travers les images et exécution de la requête
        foreach ($images as $image_url) {
            $trimmed_image_url = trim($image_url); // Stocker le résultat de trim dans une variable
            $stmt_image->bind_param("is", $product_id, $trimmed_image_url); // Passer la variable
            $stmt_image->execute();
        }

        // Fermer les déclarations
        $stmt->close();
        $stmt_image->close();

        // Stocker le message de succès dans la session
        $_SESSION['message'] = "Produit ajouté avec succès !";

        // Rediriger vers la même page pour réinitialiser le formulaire
        header("Location: ajout_produits_admin.php");
        exit(); // Terminer le script après la redirection
    } else {
        $message = "Erreur lors de l'ajout du produit : " . $stmt->error;
    }

    // Fermer la déclaration
    $stmt->close();
}

// Vérifier si le message de succès est présent dans la session
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']); // Supprimer le message de la session après l'affichage
}

// Fermer la connexion
$connexion->close();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Produit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Ajouter un Produit</h1>

        <?php if ($message): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>

        <form action="ajout_produits_admin.php" method="POST">
            <div class="form-group">
                <label for="category_id">Catégorie ID</label>
                <input type="number" class="form-control" id="category_id" name="category_id" required>
            </div>
            <div class="form-group">
                <label for="name">Nom du Produit</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">Prix</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" required>
            </div>
            <div class="form-group">
                <label for="brand">brand</label>
                <input type="text" class="form-control" id="brand" name="brand" required>
            </div>
            <div class="form-group">
                <label for="tailles">Tailles (séparées par des virgules)</label>
                <input type="text" class="form-control" id="tailles" name="tailles" required>
            </div>
            <div class="form-group">
                <label for="image_url">URL des Images (séparées par des virgules)</label>
                <input type="text" class="form-control" id="image_url" name="image_url" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter le Produit</button>
        </form>
    </div>
</body>

</html>