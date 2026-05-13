<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "boutique";

try {
    // Établir la connexion
    $connexion = mysqli_connect($servername, $username, $password, $database);

    // Vérifier la connexion
    if (!$connexion) {
        throw new Exception("Connection failed: " . mysqli_connect_error());
    }

} catch (Exception $e) {
    // Afficher l'erreur dans une alerte
    echo "<div class='alert alert-danger' role='alert'>" . $e->getMessage() . "</div>";
}
?>