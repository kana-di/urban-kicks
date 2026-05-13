!<DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <title>Page Produits</title>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="home.php">
                    <img src="image/Design sans titre.jpg" alt="Logo" width="30" height="30"
                        class="d-inline-block align-text-top">
                    Urban Kicks
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="home.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="page_produits.php">Produits</a>
                        </li>
                        <!-- <li class="nav-item">
                        <a class="nav-link" href="#">À Propos</a>
                    </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">se connecter</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- En-tête de la page -->
        <header class="bg-light py-4">
            <div class="container text-center">
                <h1 class="text-uppercase">Nos Produits</h1>
                <p>Découvrez notre sélection de sneakers tendance et de qualité.</p>
            </div>
        </header>

        <!-- Section Produits -->
        <section class="container mt-5">
            <div class="row">
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

                // Récupérer les produits
                $sql = "SELECT product_id, name, price, image_url, description FROM produits"; // Assurez-vous que ces colonnes existent
                $result = mysqli_query($connexion, $sql);

                // Afficher les produits
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="<?php echo htmlspecialchars($row['image_url']); ?>" class="card-img-top"
                                    alt="<?php echo htmlspecialchars($row['name']); ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                                    <p class="font-weight-bold">
                                        €<?php echo htmlspecialchars(number_format($row['price'], 2)); ?>
                                    </p>
                                    <a href="ajout_panier.php?id=<?php echo htmlspecialchars($row['product_id']); ?>"
                                        class="btn btn-primary">Ajouter au panier</a>
                                    <a href="detail_produit.php?id=<?php echo htmlspecialchars($row['product_id']); ?>"
                                        class="btn btn-info">Voir Détails</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="alert alert-info col-12">Aucun produit trouvé</div>';
                }

                // Fermer la connexion
                mysqli_close($connexion);
                ?>
            </div>
        </section>

        <!-- Pied de page -->
        <footer class="bg-light text-center py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <h5 class="text-uppercase">À Propos</h5>
                        <p>Notre mission est de vous offrir non seulement des sneakers de qualité, mais aussi une
                            expérience
                            de shopping inoubliable.</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h5 class="text-uppercase">Liens Utiles</h5>
                        <ul class="list-unstyled">
                            <li><a href="home.php">Accueil</a></li>
                            <li><a href="page_produits.php">Produits</a></li>
                            <li><a href="login.php">Se connecter</a></li>
                            <li><a href="inscription.php">Inscription</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h5 class="text-uppercase">Contact</h5>
                        <p>
                            Email: kana@urbankicks.com<br>
                            Téléphone: +1 1 23 45 67 89
                        </p>
                    </div>
                </div>
            </div>
            <div class="text-center p-3" style="background-color: