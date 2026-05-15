<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: /dashboard/boutique/home.php");
    exit();
}

require_once 'includes/db.php';

$error = '';

if (isset($_POST['envoyer'])) {
    $nom         = trim($_POST['nom'] ?? '');
    $email       = trim($_POST['email'] ?? '');
    $password    = $_POST['password'] ?? '';
    $address     = trim($_POST['address'] ?? '');
    $ville       = trim($_POST['ville'] ?? '');
    $code_postal = trim($_POST['code_postal'] ?? '');
    $pays        = trim($_POST['pays'] ?? 'Canada');

    if (empty($nom) || empty($email) || empty($password)) {
        $error = "Le nom, l'email et le mot de passe sont obligatoires.";
    } elseif (strlen($password) < 6) {
        $error = "Le mot de passe doit contenir au moins 6 caractères.";
    } else {
        $check = $connexion->prepare("SELECT id FROM utilisateurs WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = "Cette adresse email est déjà utilisée.";
        } else {
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $connexion->prepare(
                "INSERT INTO utilisateurs (nom, email, password, address, ville, code_postal, pays, role)
                 VALUES (?, ?, ?, ?, ?, ?, ?, 'client')"
            );
            $stmt->bind_param("sssssss", $nom, $email, $hash, $address, $ville, $code_postal, $pays);

            if ($stmt->execute()) {
                header("Location: /dashboard/boutique/login.php?registered=1");
                exit();
            } else {
                $error = "Une erreur est survenue. Veuillez réessayer.";
            }
            $stmt->close();
        }
        $check->close();
    }
}

$page_title = "Créer un compte";
?>
<?php require_once 'includes/header.php'; ?>

<div style="background:var(--uk-bg-2); min-height:calc(100vh - 72px); display:flex; align-items:center; justify-content:center; padding:40px 20px;">
    <div class="form-card" style="width:100%; max-width:540px;">

        <div class="text-center mb-4">
            <div style="font-size:2.5rem; margin-bottom:8px;">🥾</div>
            <h1 style="font-size:1.6rem; font-weight:900; letter-spacing:-0.5px;">Créer un compte</h1>
            <p class="text-muted-uk" style="font-size:0.9rem;">Rejoignez la communauté Urban Kicks</p>
        </div>

        <?php if ($error): ?>
            <div class="alert-uk-error mb-4">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <!-- Infos obligatoires -->
            <div class="mb-3">
                <label for="nom" class="form-label-uk">Nom d'utilisateur <span style="color:var(--uk-danger);">*</span></label>
                <input type="text" id="nom" name="nom" class="form-control-uk"
                       placeholder="JohnDoe" required
                       value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label-uk">Adresse email <span style="color:var(--uk-danger);">*</span></label>
                <input type="email" id="email" name="email" class="form-control-uk"
                       placeholder="votre@email.com" required
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>
            <div class="mb-4">
                <label for="password" class="form-label-uk">Mot de passe <span style="color:var(--uk-danger);">*</span></label>
                <input type="password" id="password" name="password" class="form-control-uk"
                       placeholder="Min. 6 caractères" required>
            </div>

            <!-- Séparateur livraison -->
            <div style="border-top:1px solid var(--uk-border); margin:20px 0 16px;">
                <p style="font-size:0.8rem; color:var(--uk-muted); margin-top:16px; margin-bottom:0; text-transform:uppercase; letter-spacing:0.5px; font-weight:600;">
                    Adresse de livraison (optionnel)
                </p>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label-uk">Adresse</label>
                <input type="text" id="address" name="address" class="form-control-uk"
                       placeholder="123 rue des Sneakers"
                       value="<?= htmlspecialchars($_POST['address'] ?? '') ?>">
            </div>
            <div class="row g-3 mb-3">
                <div class="col-7">
                    <label for="ville" class="form-label-uk">Ville</label>
                    <input type="text" id="ville" name="ville" class="form-control-uk"
                           placeholder="Montréal"
                           value="<?= htmlspecialchars($_POST['ville'] ?? '') ?>">
                </div>
                <div class="col-5">
                    <label for="code_postal" class="form-label-uk">Code postal</label>
                    <input type="text" id="code_postal" name="code_postal" class="form-control-uk"
                           placeholder="H1A 1A1"
                           value="<?= htmlspecialchars($_POST['code_postal'] ?? '') ?>">
                </div>
            </div>
            <div class="mb-4">
                <label for="pays" class="form-label-uk">Pays</label>
                <input type="text" id="pays" name="pays" class="form-control-uk"
                       placeholder="Canada"
                       value="<?= htmlspecialchars($_POST['pays'] ?? 'Canada') ?>">
            </div>

            <button type="submit" name="envoyer" class="btn-uk w-100" style="padding:14px; font-size:0.9rem; border-radius:8px;">
                Créer mon compte
            </button>
        </form>

        <p class="text-center mt-4" style="font-size:0.9rem; color:var(--uk-muted);">
            Déjà un compte ?
            <a href="/dashboard/boutique/login.php"
               style="color:var(--uk-dark); font-weight:700; text-decoration:none;">
                Se connecter
            </a>
        </p>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
