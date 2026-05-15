<?php
$connexion = new mysqli("localhost", "root", "", "boutique");
$connexion->set_charset("utf8mb4");

if ($connexion->connect_error) {
    die("<div class='alert alert-danger m-3'>Erreur de connexion : " . htmlspecialchars($connexion->connect_error) . "</div>");
}
