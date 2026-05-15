<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: /dashboard/boutique/login.php");
    exit();
}

require_once '../includes/db.php';

$message      = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name        = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price       = floatval($_POST['price'] ?? 0);
    $stock       = intval($_POST['stock'] ?? 0);
    $brand       = trim($_POST['brand'] ?? '');
    $image_url   = trim($_POST['image_url'] ?? '');

    if (empty($name) || $price <= 0) {
        $message      = "Le nom et un prix valide sont obligatoires.";
        $message_type = 'danger';
    } else {
        $stmt = $connexion->prepare(
            "INSERT INTO produits (name, description, price, stock, brand, image_url)
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("ssdiss", $name, $description, $price, $stock, $brand, $image_url);

        if ($stmt->execute()) {
            $_SESSION['flash'] = "Produit \"" . htmlspecialchars($name) . "\" ajouté avec succès !";
            header("Location: /dashboard/boutique/admin/ajouter-produit.php");
            exit();
        } else {
            $message      = "Erreur lors de l'ajout : " . $connexion->error;
            $message_type = 'danger';
        }
        $stmt->close();
    }
}

if (isset($_SESSION['flash'])) {
    $message      = $_SESSION['flash'];
    $message_type = 'success';
    unset($_SESSION['flash']);
}

$page_title = "Ajouter un produit";
require_once '../includes/header.php';
?>

<div class="container py-5" style="max-width:680px;">
    <div class="d-flex align-items-center gap-3 mb-5">
        <a href="/dashboard/boutique/admin/dashboard.php" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h1 class="section-title mb-0">Ajouter un produit</h1>
            <p class="text-muted mb-0" style="font-size:0.9rem;">Tous les produits ajoutés apparaissent dans le catalogue.</p>
        </div>
    </div>

    <?php if ($message): ?>
        <div class="alert-uk-<?= $message_type === 'success' ? 'success' : 'danger' ?> mb-4">
            <i class="bi bi-<?= $message_type === 'success' ? 'check-circle-fill' : 'exclamation-triangle-fill' ?> me-2"></i>
            <?= $message ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="p-4 rounded-3 mb-4" style="background:var(--uk-white); border:1px solid var(--uk-border);">
            <h6 class="fw-bold mb-3" style="color:var(--uk-dark);">Informations principales</h6>
            <div class="row g-3">
                <div class="col-12">
                    <label for="name" class="form-label-uk">Nom du produit <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" class="form-control form-control-uk"
                           placeholder="Nike Air Force 1 '07" required
                           value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label for="brand" class="form-label-uk">Marque</label>
                    <input type="text" id="brand" name="brand" class="form-control form-control-uk"
                           placeholder="Nike, Adidas, Jordan…"
                           value="<?= htmlspecialchars($_POST['brand'] ?? '') ?>">
                </div>
                <div class="col-md-3">
                    <label for="price" class="form-label-uk">Prix ($) <span class="text-danger">*</span></label>
                    <input type="number" id="price" name="price" class="form-control form-control-uk"
                           placeholder="149.99" step="0.01" min="0" required
                           value="<?= htmlspecialchars($_POST['price'] ?? '') ?>">
                </div>
                <div class="col-md-3">
                    <label for="stock" class="form-label-uk">Stock</label>
                    <input type="number" id="stock" name="stock" class="form-control form-control-uk"
                           placeholder="10" min="0"
                           value="<?= htmlspecialchars($_POST['stock'] ?? '10') ?>">
                </div>
                <div class="col-12">
                    <label for="description" class="form-label-uk">Description</label>
                    <textarea id="description" name="description" class="form-control form-control-uk"
                              rows="3" placeholder="Décrivez le produit…"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
                </div>
            </div>
        </div>

        <div class="p-4 rounded-3 mb-4" style="background:var(--uk-white); border:1px solid var(--uk-border);">
            <h6 class="fw-bold mb-3" style="color:var(--uk-dark);">Image</h6>
            <div class="col-12">
                <label for="image_url" class="form-label-uk">URL de l'image</label>
                <input type="url" id="image_url" name="image_url" class="form-control form-control-uk"
                       placeholder="https://exemple.com/image.jpg"
                       value="<?= htmlspecialchars($_POST['image_url'] ?? '') ?>">
                <div class="mt-1" style="font-size:0.8rem; color:#555;">
                    Utilisez une URL d'image hébergée (Imgur, CDN, etc.)
                </div>
            </div>
        </div>

        <div class="d-flex gap-3">
            <button type="submit" class="btn btn-uk px-5 py-2">
                <i class="bi bi-plus-lg me-2"></i>Ajouter le produit
            </button>
            <a href="/dashboard/boutique/produits.php" class="btn btn-outline-secondary px-4 py-2" target="_blank">
                <i class="bi bi-eye me-2"></i>Voir le catalogue
            </a>
        </div>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>
