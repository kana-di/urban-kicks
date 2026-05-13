<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .form-group label {
            margin-bottom: 10px;
        }

        body {
            background-image: url('image/image_backgro.jpeg');
            background-color: beige;
        }

        .container {
            margin-top: 70px;
            max-width: 800px;
            background-color: beige;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        #code_admin_container {
            display: none;
            /* Masquer le champ par défaut */
        }

        .footer-text {
            text-align: center;
            margin-top: 20px;
        }
    </style>
    <script>
        function toggleCodeAdminField() {
            const roleSelect = document.getElementById('role');
            const codeAdminContainer = document.getElementById('code_admin_container');
            if (roleSelect.value === 'admin') {
                codeAdminContainer.style.display = 'block'; // Afficher le champ si "Administrateur" est sélectionné
            } else {
                codeAdminContainer.style.display = 'none'; // Masquer le champ sinon
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <h2>Créer un compte</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="nom">Nom d'utilisateur :</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>

            <div class="form-group">
                <label for="email">Adresse e-mail :</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="address">Adresse :</label>
                <input class="form-control" id="address" name="address">
            </div>

            <div class="form-group">
                <label for="ville">Ville :</label>
                <input type="text" class="form-control" id="ville" name="ville">
            </div>

            <div class="form-group">
                <label for="code_postal">Code postal :</label>
                <input type="text" class="form-control" id="code_postal" name="code_postal">
            </div>

            <div class="form-group">
                <label for="pays">Pays :</label>
                <input type="text" class="form-control" id="pays" name="pays">
            </div>

            <div class="form-group">
                <label for="role">Rôle :</label>
                <select class="form-control" id="role" name="role" required onchange="toggleCodeAdminField()">
                    <option value="client">Client</option>
                    <option value="admin">Administrateur</option>
                </select>
            </div>

            <div id="code_admin_container" class="form-group">
                <label for="code_admin">Code d'accès :</label>
                <input type="text" class="form-control" id="code_admin" name="code_admin">
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="conditions" name="conditions" required>
                <label class="form-check-label" for="conditions">J'accepte les <a href="conditions_utilisation.html"
                        target="_blank">conditions d'utilisation</a></label>
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="envoyer">Inscription</button>
            <p class="text-center mt-3">Vous avez déjà un compte ? <a href="login.php">Connectez-vous ici</a></p>
        </form>

</body>

</html>

</html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// pour se connecter a une base de donnée on doit avoir "le nom du server =>localhost" "le username => root" "le mot_de_passe => root na pas de mot de passe" "le nom de la base de donner" 

$servername = "localhost";
$username = "root";
$password = "";
$database = "boutique";


try {
    // Connexion à la base de données
    $connexion = mysqli_connect($servername, $username, $password, $database);

    if (isset($_POST["envoyer"])) {
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        // $confirm_password = $_POST['confirm_password'];
        // $first_name = $_POST['first_name'];
        // $last_name = $_POST['last_name'];
        $address = $_POST['address'];
        $ville = $_POST['ville'];
        $code_postal = $_POST['code_postal'];
        $pays = $_POST['pays'];
        if (
            !empty($nom) && !empty($email) && !empty($password) && !empty($address)
            && !empty($ville) && !empty($code_postal) && !empty($pays)
        ) {
            $sql = "insert into utilisateurs (nom,email,password,address,ville,code_postal, pays) values (?, ?, ?, ?, ?, ?, ?)";
            // Preparation de la requete 
            $requet = mysqli_prepare($connexion, $sql);
            // le "sss" cest pour les String & pour les entiers on a "iii"
            mysqli_stmt_bind_param($requet, "sssssss", $nom, $email, $password, $adresse, $ville, $code_postal, $pays);
            mysqli_stmt_execute($requet);
            echo "Entrée réussi ";
        }
    }



} catch (Exception $e) {

    echo "Error syntaxe" . $e->getMessage();
}

?>