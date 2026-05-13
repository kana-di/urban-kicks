<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ma Boutique - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="image/Design sans titre.jpg" />
    <style>
        body {
            background-color: whitesmoke;
        }

        .navbar {
            justify-content: space-between;
        }

        .hero {
            position: relative;
            color: white;
            padding: 5%;
            height: 90vh;
            overflow: hidden;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .btn-ajouter {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-ajouter:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <!-- Barre de navigation -->
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
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Se connecter</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <div class="container text-center" style="margin-top: 50px;">
        <h1>Bienvenue Admin</h1>
        <div class="d-flex justify-content-center">
            <a href="ajout_produits_admin.php">
                <button class="btn-ajouter" onclick="alert('Ajouter des produits')">Ajouter des produits</button>
            </a>
        </div>
    </div>

    <!-- Suivez-nous -->
    <div class="text-center mt-4">
        <h5 class="text-uppercase">Suivez-nous</h5>
        <a href="#" class="btn btn-outline-primary btn-sm">Facebook</a>
        <a href="#" class="btn btn-outline-info btn-sm">Twitter</a>
        <a href="https://www.instagram.com/kaana_diallo/" class="btn btn-outline-danger btn-sm">Instagram</a>
    </div>

    <div class="text-center p-3" style="background-color: #f8f9fa;">
        © 2024 Urban Kicks. Tous droits réservés.
    </div>
</body>

</html>