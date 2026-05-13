<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ma Boutique - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="image\Design sans titre.jpg" />
    <style>
        body {

            background-color: whitesmoke;
        }

        .navbar {
            justify-content: space-between;
            /* Espace entre les éléments */
        }


        .hero {

            position: relative;
            /* Position relative pour le conteneur */
            color: white;
            /* Couleur du texte */
            padding: 5%;
            padding-right: 600px;
            margin-right: px;
            right: 0;
            /* Espacement en haut et en bas */
            /* text-align: left; */

            /* Centrer le texte */
            overflow: hidden;
            /* Masquer tout débordement */
            height: 90vh;


        }


        .hero h1 {
            font-size: 3rem;
            /* Taille de police pour le titre */
            margin-bottom: 20px;
            /* Espacement en bas du titre */
        }

        .hero p {
            transform: ;
            font-size: 20px;
            /* Taille de police pour le paragraphe */
            line-height: 1;
            /* Hauteur de ligne pour une meilleure lisibilité */
            line-height: 1.4;
        }

        .hero .lead {
            font-size: 1.2rem;
            /* Taille de police pour le texte de lead */
            font-weight: 700;
        }



        .background-video {


            position: absolute;
            /* Position absolue pour la vidéo */
            top: 0;
            /* Positionner en haut */
            left: 0;
            /* Positionner à gauche */
            width: 100%;
            /* Largeur de la vidéo */
            height: max-content;
            /* Hauteur de la vidéo */
            object-fit: cover;
            /* Adapter la vidéo sans la recadrer */
            object-position: contain;
            /* Centrer la vidéo */
            z-index: -1;
            /* Envoyer la vidéo derrière le texte */
        }

        .navbar-brand {
            margin-left: 15px;
            /* Pousse les éléments de navigation à droite */
        }

        .nav-item {
            margin-left: 10px;
        }

        .description {



            /* font-weight: 700; */

            position: absolute;
            /* Position relative pour le conteneur */
            color: white;
            /* Couleur du texte */
            font-size: 1.2em;
            padding-left: 200px;
            margin-left: 600px;
            left: 600px;
            right: 15px;
            /* Espacement en haut et en bas */
            /* text-align: left; */

        }

        .description p {

            color: white;
            background-color: black;

        }

        .sous h5 {
            position: relative;
            /* Position relative pour le conteneur */
            text-align: center;
            padding: 30px;
            font-size: 1.4em;
            background-color: white;
        }

        .sous a {
            margin: 30px;
            position: relative;
            background-color: black;
        }

        .sous1 {
            text-align: center;
            padding: 50px;
        }

        .sous1 a {
            background-color: beige;
            margin: 30px;
            position: relative;
            background-color: black;
        }

        /* .row {
            margin: 30px;


        } */

        .container-fluid h2 {
            text-align: left;
            margin: 20px;
        }

        /* .container-fluid {
            margin: 20px;
            position: absolue;
        } */

        /* .col-md-4 {
            position: relative;

        } */

        /* .row {

            Ajustez la largeur selon vos besoins */
        /* overflow-x: auto; */
        /* Permet le défilement horizontal */
        /* white-space: nowrap; */
        /* Évite le retour à la ligne */
        /* padding: 10px 0;

        /* } */

        .container-fluid h2 {
            text-align: left;
            margin: 20px;
        }

        .scrolling-wrapper {
            overflow-x: auto;
            /* Permet le défilement horizontal */
            white-space: nowrap;
            /* Évite le retour à la ligne */
            padding: 30px 50px;

        }

        .card {
            display: inline-block;
            /* Affiche les cartes en ligne */
            margin-right: 20px;
            /* Espace entre les cartes */

        }

        footer {
            background-color: #f8f9fa;
            /* Couleur de fond du pied de page */
            padding: 20px 0;
            /* Espacement vertical */
        }

        footer h5 {
            margin-bottom: 15px;
            /* Espacement en bas des titres */
        }

        footer a {
            color: #007bff;
            /* Couleur des liens */
            text-decoration: none;
            /* Pas de soulignement */
        }

        footer a:hover {
            text-decoration: underline;
            /* Soulignement au survol */
        }

        footer .btn {
            margin-right: 5px;
            /* Espacement entre les boutons de réseaux sociaux */
        }

        .btn-secondary {
            margin-right: 20px;
            /* Espace entre le bouton et le titre */
            background-color: black;
        }

        .newsletter {
            text-align: center;
            background-color: aliceblue;
        }

        .newsletter h2 {
            padding-left: 10px;
        }

        .footer-custom {
            background-color: black;
            color: white;
        }

        .footer-custom a {
            color: white;
            /* Pour que les liens soient blancs */
        }

        .footer-bottom {
            background-color: #343a40;
            /* Couleur de fond pour la ligne inférieure */
            color: white;
            /* Couleur du texte */
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
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">À Propos</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">se connecter</a>
                    </li>
                    <a href="panier.php">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMwAAADACAMAAAB/Pny7AAAAY1BMVEX///8AAAAnJye4uLhPT0/o6OhdXV2zs7MUFBTz8/NYWFiYmJimpqbIyMhAQEAfHx9tbW1/f38zMzPBwcGsrKw7Ozv5+flISEje3t7U1NSIiIh3d3cPDw9nZ2fOzs4ZGRmQkJDNZsMeAAAKxklEQVR4nN1d6YKyOgxVEAQBF3YVlfd/yjvfNkNOaUmh2HrPz6lTeoCk2Ro2m80m223V6C7t5jMQXyao/Mattr1OFlhctttDYHuhDFx5XLbb+wc8mzuXjLe3vdRpeFwyn/Bo2Fy2zdP2WifR8dmUttc6iYZPxn31nPLJhO5vnXwyp8L2WifxfLHZpLbXOo1rmDO1wP0DrIC6SC4S3AnN/Gp7qYtQU2XnvtCoUPeETOK8clYiI2SaDxAaBVpqu7m/06gQU6vafYtGiZKQCWPb61kEKjTbzyYTPP5PyjmhRoDt9SyDT8i8bC9nGa7UCPhs5RxQ5Zz8+WvcPgvfKorsOmMLp0KT/+K3v93DJvesIq8O50uq+6L41Aiog/7AD+msjNfunmmRCULy/+ejRgzkDcjPWm8bO05oCbmvQSaJbC93Cjc+matGOMoS+FGwOpyezTb4sRZm1sMmTmy5KZxRxXLsuDotrmwvlQF2fOIxPZd1nLjGgEZA2h4SJpnWrU1/HB6TzCa3vVIOuCpgTDmHtyHuwPeWyJDSPdi7S3+Z3OiceVr+oBe2cu5eI+akH6g8aOxzqzBmz+SHjSKA3dI5IatawMvPdumRy0EI01C3R2UuUTJHBW0a59qmcAP3dLjiksGKFDFK49P37GiATA1vN/6ypXYWOz4BN+ElvhtXyjeX72FsMrBZv3AnialMdVwyATwZkUxMd1ZPnmhnk4GLChUvEJ6IuGRqUFYjwUD6TkTyPYxN5kmveUM5hZeBvdGgshIm/jITaHL0vJwM6BSh3qWgXmPIJgMx51zcoTL6hov6TpsM+FHC2wDKjmvPfL2f4AaIZl1AH/pRavhxydT0UVcopwEoO34oIKZLGLsN9EZ60lwOl0xMryhEYVqwATQyFKCcG1H1gvHRLyVDo9yiwwL6gb1nbkSLRrwP4JCeZTsNlwzcHEH+QWQuGmSCA/1f8Q0NqPo+yISGS4YqFA/lHzKUGiIjJGrGVO+R/KCSJaa4ZOj1doL8T6okBeAVHjEe6Co7mUnOJIMmM8o/vPdHrQzlld74kTsBOqJnkZEWGE7tIjCuVw2Hav1eIkBid0k6hhKcs1s5/jOQ0UcKPh4Y8joisxHCGp2QMjnBD16nMXjgU43/6oSxuuhFARcbMX2VKFyOBOgWkbcux5x7zQqF+jY9pzVoFyiU/ArIdyPSLrp+upuoeWin9GN3Y866IrMRTD+HMKN2zHdVOed6CfTfCKYOdNmCvshsBK/cGVzm1MG5mkXnxzIGaN3Mbubzavogu9lFCLiMMB5Fr25qji+of4NThPNKlEE5H8o9RQlOD45/oYCgdO+Lv0H7P4EpHpTNzPrEAm4JahG038a0DMM5g8rQFzpe4P7388jU9JZ0gksE3uaYZDLcZvA2MIoUw8OdWwYLO40QzIIwbjjizDLIgEuMwROIBLMLGhDgbophRlARs8hgJAiNFdghHjO5YM5EOFIDOZMxoZkmMzUJjUZ0s3aZ36CXEeIIcaIeZ5GBxMsWuUJUe37lOKgrIVED4bWRWOE0mYxGK044TPV/Pr+mH8LVgvBl1B3N55DBkBgMw8PnJ5kEQKJBCPG04MGJt22SDMo/vKq4l80XmU0NiRrUNNgsQYxnTZIJ1PcDh5ecuYZt8YG3HpR3r0+mpVtmB+o9Uw9rAQLaQv3Nnm4CB30yIJZY2QIS1SzgIribuBiI4YjZ+Uky8OwhmwAnFJeIjDgZZqwgCdQJ2+YUGSi8QJkIQGiXnRsBy9mLAaABypoOQ5HksYDxOKCPtmvJaA0igzuqJq4w2wEAw1VIh0PqrUZNiBOAZb6jow0dXiQyouVkF4tEZiOoE7tYetSqmL7E2xAtPW6NFotNSKsNuEDlbBPLDyg7JDTL+y24k6jxlh/qxxIne7gbOGztjNBgdfAc+K7EnGfkZQS0h+nrvAOVkdPJjgiNmU44jiRqzLTBuNLAZZc3xwEaCGuequFgBP86/M8jmNyvigByDKZ6LVB38wTeILjW53bgs2yovFXEn6kh7HYP4mAIOioU1M0EuAHobnaKi1Iy4GmC0u/ptBAdMNU8qqCxPkzUqAo6lWTgiYNQmIuYEcR0p/EgUAdhPPIWqsjUlWIQj4vxT5pOARN1dFR1JkFFBlxySFbGqrd3CSDWB69vTUdJWbCKTElD5pCshINZJgyzPwDFUkFAiL6Fp+GoigzmGOikEPfpTXHZbGDbhILwi3xURQYyLzAp1Q4vg52j8DbRZw5xgmHuU0EGMq9HKhRQ0r4z2DYGUrFQLQ+Zj8dApBRkIMt8oAb+ngqUELJfAJDxFxWaGHJOA6oKMiksl14RBErnJMMkQDmX5DbWYCI8Zf9HyMDxPqrva/qPZtsUQ1gDEoIwOhBWORlIZEEXUngH5Uen5gATNTRXC6OXn+dGNdaw3AR8Ppp5xbJqMfGzBDXWBZ7L4gclVd1V9vwLaJaSp9fvkRSqTK4/yFJ0bo2KjJCt/3qNB64Htk2V+zPfrlADzkzU/KDCmuqXMcPsS1ulu8qqt+kZU8x1yu1Xuxrkh1o14cJ5DUMWM5bHWIEhXdY6EWYy4zC7cYqmN8IFaz3swNA3CpxIzs4s/UU40RvobMYqwxIAKzAVLXNAkXl7Q1u/A5vlxVgzb9vS7xlssi7mZbu8anZvQXhPCqPt4gVVdkw+tq8udhuadzjKEQh+6wdzEXSZ+18KUsCf24DHRUDw6AO+rqUAKLPP/hQFkPnsj4T8n5/MB3z0SAGfRpd0eiO5Bzi29tmfPEELQNH2z30Itlluyk+ygRSDy6dLeQ1Wwtr3aaRz+2kXroTH+ZKu+imyNzc7Px3Dfr3drMV6r9XReeacfoSVIICp2iWEndbt5vJKFNgj+U1YaUezk5uJVvrwlZ2g5uz+BWrwPiduHMd13jRLWcDHOiq6Lq2EnE2cYRhj09p41by1jJs6s3AcaEYPMy7a91sDq0ZQr+W5wXaWX3uCl+ee2D2wy2UQfyuZYiWp+QbWyG2jx/5L7cR+iCxH+k/8gXAgtwv9X1MUB6TTrOzjQG+ObfSdDkrw8JNsJXjwupNPsXKkHqrKhhYudKOXNoeF0/9kii1vCkOADXRY0YKmgqTYDbt/NIopNL5nNgPYaIRYUGBhS0p3sJUBmeJpqI8RCyi8RN1AxaXk4L7OFOvGHaGShrbugWVKvg6BxTiqKdhfy5gF6GdB1wsrkXxRBchEqinY3zGZBWzOoVqmZKNRTxFypjAEVADkxEXBanaBCoBM8WTpEFNQqWZYpaRCFFXzbjg20RXGMEroRDJIdEI+V5rPwU1zMAX2t1g571BA7Om75qjeowcns0UyNFr8f1MIx8FXNmcCrNg83bIgjoOsxyC7tD+UUPQZ9X+ngL+PffTGLMTOAPn5csFPuG1V7/v4FGcx3tivnRPGdJoUcqcXX1Up1k9uMSuDFWeqBJ9IAr1vGs+CIL/jULVUYDboXimqScAqdFZ3h2Y9mlkNpnVRMx7NRHuIgJH3UX0Q0SCyyYWI/XYB/uTnE17vqjuaitdG03WiU8XfC1qy6kLYISkXTvRu4pMDq28xA6QqfZSwJDdZPoUh1L40XHvaM2+qfAqPO4UpXCWx9DNfCUmneH9ZS5yNdAlqCp1dO85GzImdb6WwLX7CrX1oUZFMYa88py6Sv0Hmqp+7jCwJX/+m0JOV/wDHK8yeQcrRewAAAABJRU5ErkJggg=="
                            alt="Une belle" width="25" height="25">
                    </a>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Section Héro -->
    <div class="hero">
        <video autoplay muted loop class="background-video">
            <source src="image/7680115-uhd_4096_2160_25fps.mp4" type="video/mp4">
            Votre navigateur ne supporte pas la vidéo.
        </video>

        <div class="container1">
            <h1>Bienvenue chez Urban Kicks !</h1>
            <p>Plongez dans l'univers dynamique et tendance des sneakers <br> Avec Urban Kicks, votre destination ultime
                pour les passionnés de chaussures.<br> Que vous soyez à la recherche des dernières tendances,<br>
                d'éditions limitées ou de modèles classiques,<br> nous avons ce qu'il vous faut !
            <p class="lead">Découvrez nos produits de qualité à des prix imbattables.</p>
            <a href="page_produits.php" class="btn btn-primary btn-lg">Voir les Produits</a>
        </div>
        <div class="description">
            <h2><strong>Chez Urban Kicks</strong></h2>
            <p>Nous pensons que chaque paire de baskets raconte une histoire.
                C'est pourquoi nous avons soigneusement sélectionné une collection qui allie style,
                confort et performance. </p>


        </div>


    </div>
    <div class="sous">
        <h5>Nos produits sont choisis pour répondre à vos besoins,que vous soyez un athlète, un amateur de
            streetwear <br> ou
            simplement à la recherche de la paire parfaite pour compléter votre look.</h> <br>
            <a href="page_produits.php" class="btn btn-primary btn-lg">Categories</a>
    </div>


    <!-- <p class="description">
        Chez Urban Kicks,<br>
        nous pensons que chaque paire de baskets raconte une histoire.<br>
        C'est pourquoi nous avons soigneusement sélectionné une collection qui allie style,<br>
        confort et performance. Nos produits sont choisis pour répondre à vos besoins,<br>
        que vous soyez un athlète, un amateur de streetwear<br>
        ou simplement à la recherche de la paire parfaite pour compléter votre look.
    </p> -->
    <!-- Section de contenu -->
    <div class=" container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Nos Meilleures Ventes</h2>
            <a href="page_produits.php" class="btn btn-secondary">Voir Plus</a>

        </div>
        <div class="scrolling-wrapper d-flex flex-nowrap">
            <div class="col-md-4">
                <div class="card">
                    <img src="https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/8722be57-c8e4-468a-9f81-bb7aa52043e7/WMNS+AIR+FORCE+1+%2707+LX.png"
                        class="card-img-top" alt="Produit 1">
                    <div class="card-body">
                        <h5 class="card-title">Nike Air Force 1</h5>
                        <p class="card-text"><strong>PRIX: 150$</strong></p>
                        <a href="panier.php" class="btn btn-primary">Ajouter au Panier</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://static.nike.com/a/images/q_auto:eco/t_product_v1/f_auto/dpr_1.0/h_594,c_limit/0f0390ab-4274-48ed-ae7f-9192ea202d7a/air-jordan-1-mid-shoes-ntkGmF.png"
                        class="card-img-top" alt="Produit 2">
                    <div class="card-body">
                        <h5 class="card-title">Produit 2</h5>
                        <p class="card-text">Description du produit 2.</p>
                        <a href="panier.php" class="btn btn-primary">Ajouter au Panier</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://static.nike.com/a/images/q_auto:eco/t_product_v1/f_auto/dpr_1.0/h_594,c_limit/9bc016bc-cd7a-49cc-a399-47930b00c59f/dunk-low-retro-shoe-mhrtZC.png"
                        class="card-img-top" alt="Produit 3">
                    <div class="card-body">
                        <h5 class="card-title">Produit 3</h5>
                        <p class="card-text">Description du produit 3.</p>
                        <a href="panier.php" class="btn btn-primary">Ajouter au Panier</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://static.nike.com/a/images/q_auto:eco/t_product_v1/f_auto/dpr_1.0/h_594,c_limit/afcc356d-82a2-4115-acff-ebfd35ab41f5/jr-mercurial-superfly-10-academy-younger-older-mg-high-top-football-boot-JqwN7g.png"
                        class="card-img-top" alt="Produit 4">
                    <div class="card-body">
                        <h5 class="card-title">Nike Jr. Mercurial Superfly 10 Academy</h5>
                        <p class="card-text">PRIX:150$</p>
                        <a href="panier.php" class="btn btn-primary">Ajouter au Panier</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="sous1">
            <h5>Rejoignez Urban Kicks pour profiter d'un accès exclusif aux lancements de sneakers et de remises
                spéciales. <br> Ne manquez pas l'opportunité de faire partie d'une communauté passionnée et dynamique !
                .</h> <br>
                <a href="avantagemembres.php" class="btn btn-primary btn-lg">en savoir plus</a>
        </div>
        <div class="newsletter">
            <h2>Inscrivez-vous à notre Newsletter !</h2>
            <p>Recevez les dernières nouvelles et offres exclusives de Urban Kicks directement dans votre boîte mail.
            </p>
            <form action="votre_script_de_traitement.php" method="POST">
                <input type="email" name="email" placeholder="Votre adresse e-mail" required>
                <button type="submit">S'inscrire</button>
            </form>
            <!-- <div class="nesle">
            <h2>Accès Membre</h2>
            <img src="https://static.nike.com/a/images/f_auto/dpr_1.0,cs_srgb/w_1903,c_limit/875d559e-2c4f-4d67-b193-c216aa29a2f7/nike-snkrs-app.png"
                alt="Description de l'image" class="foreground-image">

        </div> -->
            <!-- <div class="pied">
            <img src="https://static.nike.com/a/images/f_auto/dpr_1.0,cs_srgb/h_2492,c_limit/9e160fff-61f4-44a9-9bb1-e40b88d7f43e/sitio-web-oficial-de-nike.png"
                alt="Description de l'image" class="foreground-image">
        </div> -->
            <!-- Pied de page
        <footer class="bg-light text-center text-lg-start mt-5">
            <div class -->
            <!-- Pied de page -->
            <footer class="bg-light text-center text-lg-start mt-5">
                <div class="container p-4">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 mb-4 text-lg">
                            <h5 class="text-uppercase">À Propos</h5>
                            <p>
                                Notre mission est de vous offrir non seulement des sneakers de qualité, mais aussi une
                                expérience de shopping inoubliable. Nous nous engageons à vous fournir des produits qui
                                allient style, confort et durabilité. Explorez notre collection soigneusement choisie et
                                rejoignez la communauté Urban Kicks, où chaque sneaker raconte une histoire.
                            </p>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4">
                            <h5 class="text-uppercase">Liens Utiles</h5>
                            <ul class="list-unstyled">
                                <li><a href="home.php">Accueil</a></li>
                                <li><a href="page_produits.php">Produits</a></li>
                                <li><a href="login.php">Se connecter</a></li>
                                <li><a href="inscription.php">Inscription</a></li>
                            </ul>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4">
                            <h5 class="text-uppercase">Contact</h5>
                            <p>
                                email : lahababimehdi@urbankick.com <br>
                                Email: kana@urbankicks.com<br>
                                Téléphone: +1 1 23 45 67 89
                            </p>
                            <h5 class="text-uppercase">Suivez-nous</h5>
                            <a href="#" class="https://www.facebook.com/mehdi.lahbabi.39">Facebook</a>
                            <a href="#" class="btn btn-outline-info btn-sm">Twitter</a>
                            <a href="https://www.instagram.com/kaana_diallo/"
                                class="btn btn-outline-danger btn-sm">Instagram</a>
                        </div>
                    </div>
                </div>

                <div class="text-center p-3" style="background-color: #f8f9fa;">
                    © 2024 Urban Kicks. Tous droits réservés.
                </div>
            </footer>