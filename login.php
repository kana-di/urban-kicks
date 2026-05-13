<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login</title>
    <style>
        body {
            background-image: url('image/image_backgro.jpeg');
            background-color: #f1f1f1;
            font-family: Arial, sans-serif;
            margin: 30px;
            padding: 20px;
            /* background-image: linear-gradient(to bottom right, #f1f1f1, #ddd); */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* Remplir la hauteur de la fenêtre */
        }



        .login-container {

            /* Espace en haut */
            min-width: 400px;
            min-height: 400px;
            /* Hauteur minimale pour le conteneur */
            /* Largeur maximale du formulaire */
            background-color: beige;
            /* Couleur de fond du formulaire */
            padding: 30px;
            /* Espacement interne */
            border-radius: 10px;
            /* Coins arrondis */
            display: flexbox;
            align-items: center;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);

            /* Ombre légère */

        }

        h2 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Connexion</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" required>
            </div>
            <div class="form-group">
                <label for="code_admin">Code d'accès (si vous êtes administrateur) :</label>
                <input type="text" class="form-control" id="code_admin" name="code_admin">
            </div>
            <input type="submit" class="btn btn-primary" name="connexion" value="Se connecter">
        </form>
    </div>
</body>

</html>
<?php
// login.php


$servername
    = "localhost";

$username
    = "root";

$password
    = "";

$database
    = "boutique";



// connexion à la base de données

try {

    $connexion
        = mysqli_connect(
            $servername,
            $username,
            $password,
            $database
        );

    if
    (isset($_POST['connexion'])) {

        $email
            = $_POST['email'];

        $password
            = $_POST['pwd'];

        if (
            !empty($email)
            && !empty($password)
        ) {

            $sql
                = "select * from utilisateurs where email=?";

            $requete
                = mysqli_prepare(
                    $connexion,
                    $sql
                );

            mysqli_stmt_bind_param(
                $requete,
                's',
                $email
            );

            mysqli_stmt_execute($requete);

            $resultat
                = mysqli_stmt_get_result($requete);

            $user
                = mysqli_fetch_assoc($resultat);

            if (
                $user
                &&
                password_verify($password, $user['password'])
            ) {

                if (
                    $user['role']
                    ==
                    "user"
                ) {

                    header("location:home.php");

                    exit();

                } else {

                    header("location:ajout_produits_admin.php");

                    exit();

                }

                // echo "<p class='alert alert-success'> Connexion réussie avec succes !!!</p>";

            } else {

                echo
                    "Erreur avec les identifiants";

            }





        } else {

            echo
                "Veuillez remplir tous les champs";

        }


    }

} catch (Exception
    $e) {

    echo
        "Erreur : " .
        $e->getMessage();

}



?>