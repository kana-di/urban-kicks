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

// Vérifiez si l'utilisateur est connecté, sinon récupérez l'utilisateur par défaut
if (!isset($_SESSION['user_id'])) {
    // Récupérer l'ID de l'utilisateur par défaut
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
} else {
    // Si l'utilisateur est connecté, utilisez son ID
    $user_id = $_SESSION['user_id'];
}

// Récupérer les produits du panier pour l'utilisateur
$sql = "SELECT p.product_id, p.name, p.price, pa.quantite FROM panier pa JOIN produits p ON pa.product_id = p.product_id WHERE pa.user_id = ?";
$stmt = mysqli_prepare($connexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Affichage du panier
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Mon Panier</title>
</head>
<style>
    .paypal-button-container {
        display: flex;
        justify-content: center;
        /* Centre horizontalement */
        margin-top: 20px;
        /* Ajoute un espace au-dessus du bouton */
    }
</style>

<body>

    <header class="bg-light py-4">
        <div class="container text-center">
            <h1 class="text-uppercase">Mon Panier</h1>
        </div>
    </header>

    <section class="container mt-5">
        <form action="sup_produits.php" method="POST">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sélectionner</th>
                            <th>Nom du Produit</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        while ($item = mysqli_fetch_assoc($result)):
                            $item_total = $item['price'] * $item['quantite'];
                            $total += $item_total;
                            ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="produits[]" value="<?php echo $item['product_id']; ?>">
                                </td>
                                <td><?php echo htmlspecialchars($item['name']); ?></td>
                                <td>€<?php echo htmlspecialchars(number_format($item['price'], 2)); ?></td>
                                <td><?php echo htmlspecialchars($item['quantite']); ?></td>
                                <td>€<?php echo htmlspecialchars(number_format($item_total, 2)); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <h3>Total : $<?php echo htmlspecialchars(number_format($total, 2)); ?></h3>
                <button type="submit" class="btn btn-danger">Supprimer les produits sélectionnés</button>
            <?php else: ?>
                <div class="alert alert-info">Votre panier est vide.</div>
            <?php endif; ?>
        </form>
    </section>

    <footer class="bg-light text-center py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="page_produits.php" class="btn btn-secondary">Continuer vos achats</a>
                    <a href="viderpanier.php" class="btn btn-danger">Vider le panier</a>
                    <a href="paiement.php" class="btn btn-success">Passer à la caisse</a>
                </div>
            </div>
        </div>

    </footer>

    <div id="paypal-button-container" style="text-align:center;margin-left:25%; margin-right:25%;">
        <script
            src="https://sandbox.paypal.com/sdk/js?client-id=AZb7AzOCkvMPK8OrRzAcVrUF1FYT9VkOGNZqtde2XSgSPvy__YLxFYU6q27MFXp3xvhuVtybulmSM19m"></script>
        <script>
            paypal.Buttons({
                createOrder: function (data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: "<?= $total ?>"
                            }
                        }]
                    });
                },
                onApprove: function (data, actions) {
                    return actions.order.capture().then(function (details) {
                        alert('Transation completee par ' + details.payer.name_given + "!");
                        window.location.href = "page_produits.php";
                    });
                },
                onError: function (err) {
                    console.log('erreur de paiement', err);
                    alert("paiment echoue");
                }

            }).render("#paypal-button-container").then(function () { });

        </script>

    </div>

</body>

</html>

<?php
// Fermez la connexion
mysqli_close($connexion);
?>