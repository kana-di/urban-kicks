<?php
session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: /dashboard/boutique/home.php");
    exit();
}

if (isset($_SESSION['user_id'])) {
    header("Location: /dashboard/boutique/home.php");
    exit();
}

require_once 'includes/db.php';

$error = '';

if (isset($_POST['connexion'])) {
    $email = trim($_POST['email'] ?? '');
    $pwd   = $_POST['pwd'] ?? '';

    if (!empty($email) && !empty($pwd)) {
        $stmt = $connexion->prepare("SELECT id, nom, password, role FROM utilisateurs WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if ($user && password_verify($pwd, $user['password'])) {
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_nom']  = $user['nom'];
            $_SESSION['user_role'] = $user['role'];

            header("Location: " . ($user['role'] === 'admin'
                ? "/dashboard/boutique/admin/dashboard.php"
                : "/dashboard/boutique/home.php"));
            exit();
        }
        $error = "Email ou mot de passe incorrect.";
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}

$page_title = "Connexion";
?>
<?php require_once 'includes/header.php'; ?>

<div style="background:var(--uk-bg-2); min-height:calc(100vh - 72px); display:flex; align-items:center; justify-content:center; padding:40px 20px;">
    <div class="form-card" style="width:100%;">

        <div class="text-center mb-4">
            <div style="font-size:2.5rem; margin-bottom:8px;">🥾</div>
            <h1 style="font-size:1.6rem; font-weight:900; letter-spacing:-0.5px;">Connexion</h1>
            <p class="text-muted-uk" style="font-size:0.9rem;">Accédez à votre compte Urban Kicks</p>
        </div>

        <?php if ($error): ?>
            <div class="alert-uk-error mb-4">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['registered'])): ?>
            <div class="alert-uk-success mb-4">
                <i class="bi bi-check-circle-fill me-2"></i>
                Compte créé avec succès ! Connectez-vous maintenant.
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="email" class="form-label-uk">Adresse email</label>
                <input type="email" id="email" name="email" class="form-control-uk"
                       placeholder="votre@email.com" required
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>
            <div class="mb-4">
                <label for="pwd" class="form-label-uk">Mot de passe</label>
                <input type="password" id="pwd" name="pwd" class="form-control-uk"
                       placeholder="••••••••" required>
            </div>
            <button type="submit" name="connexion" class="btn-uk w-100" style="padding:14px; font-size:0.9rem; border-radius:8px;">
                Se connecter
            </button>
        </form>

        <div class="text-center mt-4">
            <p style="font-size:0.9rem; color:var(--uk-muted);">
                Pas encore de compte ?
                <a href="/dashboard/boutique/inscription.php"
                   style="color:var(--uk-dark); font-weight:700; text-decoration:none;">
                    S'inscrire gratuitement
                </a>
            </p>
            <a href="/dashboard/boutique/home.php"
               style="font-size:0.85rem; color:var(--uk-muted); text-decoration:none;">
                ← Retour à l'accueil
            </a>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
