<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: /dashboard/boutique/login.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id === 0) {
    header("Location: /dashboard/boutique/admin/liste-produits.php");
    exit();
}

require_once '../includes/db.php';

// Charger le produit existant
$stmt = $connexion->prepare("SELECT * FROM produits WHERE product_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$produit = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$produit) {
    header("Location: /dashboard/boutique/admin/liste-produits.php");
    exit();
}

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
        $message_type = 'error';
    } else {
        $stmt = $connexion->prepare(
            "UPDATE produits
             SET name = ?, description = ?, price = ?, stock = ?, brand = ?, image_url = ?
             WHERE product_id = ?"
        );
        $stmt->bind_param("ssdissi", $name, $description, $price, $stock, $brand, $image_url, $id);

        if ($stmt->execute()) {
            $_SESSION['flash']      = "« " . htmlspecialchars($name) . " » mis à jour avec succès !";
            $_SESSION['flash_type'] = 'success';
            header("Location: /dashboard/boutique/admin/liste-produits.php");
            exit();
        } else {
            $message      = "Erreur lors de la mise à jour : " . $connexion->error;
            $message_type = 'error';
        }
        $stmt->close();

        // Mettre à jour le tableau local pour pré-remplir le formulaire
        $produit = array_merge($produit, compact('name', 'description', 'price', 'stock', 'brand', 'image_url'));
    }
}

$page_title = "Modifier — " . $produit['name'];
require_once '../includes/header.php';
?>

<div class="container" style="max-width:720px; padding:60px 20px 80px;">

    <!-- En-tête -->
    <div class="d-flex align-items-center gap-3 mb-5">
        <a href="/dashboard/boutique/admin/liste-produits.php"
           style="width:38px; height:38px; border-radius:8px; background:var(--uk-white); border:1px solid var(--uk-border); display:flex; align-items:center; justify-content:center; text-decoration:none; color:var(--uk-dark); transition:all 0.2s; flex-shrink:0;"
           onmouseenter="this.style.background='var(--uk-bg-2)'" onmouseleave="this.style.background='var(--uk-white)'">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <span class="section-label">Admin · Catalogue</span>
            <h1 class="section-title mb-0" style="font-size:1.8rem;">Modifier un produit</h1>
        </div>
    </div>

    <!-- Aperçu actuel -->
    <?php if ($produit['image_url']): ?>
    <div class="mb-4 p-4 d-flex align-items-center gap-4"
         style="background:var(--uk-white); border:1px solid var(--uk-border); border-radius:14px;">
        <div style="width:80px; height:80px; border-radius:10px; overflow:hidden; background:var(--uk-bg-2); flex-shrink:0;">
            <img src="<?= htmlspecialchars($produit['image_url']) ?>"
                 alt="<?= htmlspecialchars($produit['name']) ?>"
                 style="width:100%; height:100%; object-fit:cover;">
        </div>
        <div>
            <div style="font-size:0.72rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:var(--uk-muted); margin-bottom:4px;">
                <?= htmlspecialchars($produit['brand'] ?? '') ?>
            </div>
            <div style="font-weight:800; font-size:1.05rem; color:var(--uk-dark);">
                <?= htmlspecialchars($produit['name']) ?>
            </div>
            <div style="font-size:0.9rem; color:var(--uk-muted); margin-top:2px;">
                <?= number_format($produit['price'], 2, ',', ' ') ?> $ · <?= $produit['stock'] ?> en stock
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Message -->
    <?php if ($message): ?>
        <div class="alert-uk-<?= $message_type === 'success' ? 'success' : 'error' ?> mb-4">
            <i class="bi bi-<?= $message_type === 'success' ? 'check-circle-fill' : 'exclamation-triangle-fill' ?> me-2"></i>
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <!-- Formulaire -->
    <form method="POST" action="">

        <!-- Infos principales -->
        <div class="mb-3 p-4" style="background:var(--uk-white); border:1px solid var(--uk-border); border-radius:14px;">
            <h6 style="font-weight:800; font-size:0.82rem; text-transform:uppercase; letter-spacing:1px; color:var(--uk-muted); margin-bottom:18px;">
                Informations principales
            </h6>
            <div class="row g-3">
                <div class="col-12">
                    <label for="name" class="form-label-uk">Nom du produit <span style="color:var(--uk-danger);">*</span></label>
                    <input type="text" id="name" name="name" class="form-control-uk" required
                           value="<?= htmlspecialchars($produit['name']) ?>">
                </div>
                <div class="col-md-6">
                    <label for="brand" class="form-label-uk">Marque</label>
                    <input type="text" id="brand" name="brand" class="form-control-uk"
                           placeholder="Nike, Adidas, Jordan…"
                           value="<?= htmlspecialchars($produit['brand'] ?? '') ?>">
                </div>
                <div class="col-md-3">
                    <label for="price" class="form-label-uk">Prix ($) <span style="color:var(--uk-danger);">*</span></label>
                    <input type="number" id="price" name="price" class="form-control-uk"
                           step="0.01" min="0.01" required
                           value="<?= htmlspecialchars($produit['price']) ?>">
                </div>
                <div class="col-md-3">
                    <label for="stock" class="form-label-uk">Stock</label>
                    <input type="number" id="stock" name="stock" class="form-control-uk"
                           min="0"
                           value="<?= htmlspecialchars($produit['stock']) ?>">
                </div>
                <div class="col-12">
                    <label for="description" class="form-label-uk">Description</label>
                    <textarea id="description" name="description" class="form-control-uk" rows="3"
                              placeholder="Décrivez le produit…"><?= htmlspecialchars($produit['description'] ?? '') ?></textarea>
                </div>
            </div>
        </div>

        <!-- Image -->
        <div class="mb-4 p-4" style="background:var(--uk-white); border:1px solid var(--uk-border); border-radius:14px;">
            <h6 style="font-weight:800; font-size:0.82rem; text-transform:uppercase; letter-spacing:1px; color:var(--uk-muted); margin-bottom:18px;">
                Image du produit
            </h6>
            <div class="row g-3 align-items-start">
                <div class="col-md-8">
                    <label for="image_url" class="form-label-uk">URL de l'image</label>
                    <input type="url" id="image_url" name="image_url" class="form-control-uk"
                           placeholder="https://exemple.com/image.jpg"
                           value="<?= htmlspecialchars($produit['image_url'] ?? '') ?>">
                    <p style="font-size:0.78rem; color:var(--uk-muted); margin-top:6px; margin-bottom:0;">
                        Collez l'URL d'une image hébergée (Imgur, CDN Nike, etc.)
                    </p>
                </div>
                <?php if ($produit['image_url']): ?>
                <div class="col-md-4">
                    <label class="form-label-uk">Aperçu actuel</label>
                    <div style="width:100%; aspect-ratio:1; border-radius:10px; overflow:hidden; background:var(--uk-bg-2); border:1px solid var(--uk-border);">
                        <img src="<?= htmlspecialchars($produit['image_url']) ?>"
                             alt="Aperçu"
                             id="imgPreview"
                             style="width:100%; height:100%; object-fit:cover;">
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Boutons -->
        <div class="d-flex gap-3 flex-wrap">
            <button type="submit" class="btn-uk" style="padding:13px 32px; font-size:0.88rem;">
                <i class="bi bi-check-lg me-2"></i>Enregistrer les modifications
            </button>
            <a href="/dashboard/boutique/admin/liste-produits.php" class="btn-uk-outline" style="padding:11px 24px; font-size:0.88rem;">
                Annuler
            </a>
        </div>

    </form>

</div>

<!-- Aperçu en direct de l'image -->
<script>
document.getElementById('image_url').addEventListener('input', function(){
    var preview = document.getElementById('imgPreview');
    if (preview) preview.src = this.value || '';
});
</script>

<?php require_once '../includes/footer.php'; ?>
