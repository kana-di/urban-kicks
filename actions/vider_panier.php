<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /dashboard/boutique/login.php");
    exit();
}

require_once '../includes/db.php';

$user_id = $_SESSION['user_id'];

$stmt = $connexion->prepare("DELETE FROM panier WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->close();

header("Location: /dashboard/boutique/panier.php?message=Panier+vidé+avec+succès.");
exit();
