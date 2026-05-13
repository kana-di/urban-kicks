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

// Définir l'email de l'utilisateur par défaut
$defaultEmail = 'thiernooumar4434@gmail.com';

// Vérifiez si l'utilisateur existe déjà
$sql = "SELECT user_id FROM utilisateurs WHERE email = ?";
$stmt = mysqli_prepare($connexion, $sql);
mysqli_stmt_bind_param($stmt, "s", $defaultEmail);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if ($row) {
    // L'utilisateur existe, récupérez son ID
    $user_id = $row['user_id'];
    $_SESSION['user_id'] = $user_id; // Stockez l'ID de l'utilisateur dans la session
} else {
    echo '<div class="alert alert-danger">L\'utilisateur par défaut n\'existe pas.</div>';
    exit();
}

// Vérifiez si un produit est ajouté
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    $quantite = 1; // Vous pouvez ajuster cela selon vos besoins

    // Vérifiez si le produit est déjà dans le panier
    $sql = "SELECT * FROM panier WHERE user_id = ? AND product_id = ?";
    $stmt = mysqli_prepare($connexion, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $user_id, $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // Si le produit est déjà dans le panier, mettez à jour la quantité
        $sql = "UPDATE panier SET quantite = quantite + ? WHERE user_id = ? AND product_id = ?";
        $stmt = mysqli_prepare($connexion, $sql);
        mysqli_stmt_bind_param($stmt, "iii", $quantite, $user_id, $product_id);
    } else {
        // Sinon, insérez le produit dans le panier
        $sql = "INSERT INTO panier (user_id, product_id, quantite) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($connexion, $sql);
        mysqli_stmt_bind_param($stmt, "iii", $user_id, $product_id, $quantite);
    }

    // Exécutez la requête
    if (mysqli_stmt_execute($stmt)) {
        // Rediriger vers la page du panier après l'ajout
        header("Location: panier.php?message=Produit ajouté au panier avec succès.");
        exit();
    } else {
        echo '<div class="alert alert-danger">Erreur lors de l\'ajout du produit au panier.</div>';
    }
}

// Fermez la connexion
mysqli_close($connexion);
?>