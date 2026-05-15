<?php
session_start();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id === 0) {
    header("Location: /dashboard/boutique/produits.php");
    exit();
}

require_once 'includes/db.php';

$stmt = $connexion->prepare("SELECT * FROM produits WHERE product_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$produit = $result->fetch_assoc();
$stmt->close();

if (!$produit) {
    header("Location: /dashboard/boutique/produits.php");
    exit();
}

$page_title = htmlspecialchars($produit['name']);
?>
<?php require_once 'includes/header.php'; ?>

<div class="container py-5">
    <!-- Fil d'Ariane -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb" style="background:none; padding:0;">
            <li class="breadcrumb-item">
                <a href="/dashboard/boutique/produits.php" class="text-muted text-decoration-none">Produits</a>
            </li>
            <li class="breadcrumb-item active text-white">
                <?= htmlspecialchars($produit['name']) ?>
            </li>
        </ol>
    </nav>

    <div class="row g-5 align-items-start">
        <!-- Image -->
        <div class="col-md-6">
            <div class="rounded-3 overflow-hidden" style="background:#111; aspect-ratio:1;">
                <img src="<?= htmlspecialchars($produit['image_url'] ?? '') ?>"
                     alt="<?= htmlspecialchars($produit['name']) ?>"
                     class="w-100 h-100"
                     style="object-fit:cover;"
                     >
            </div>
        </div>

        <!-- Infos -->
        <div class="col-md-6">
            <?php if (!empty($produit['brand'])): ?>
            <span class="badge bg-secondary mb-3" style="font-size:0.85rem; letter-spacing:1px;">
                <?= htmlspecialchars($produit['brand']) ?>
            </span>
            <?php endif; ?>

            <h1 class="fw-bold mb-3" style="font-size:2rem;">
                <?= htmlspecialchars($produit['name']) ?>
            </h1>

            <div class="mb-4">
                <span class="badge-prix" style="font-size:1.4rem; padding:10px 20px;">
                    <?= number_format($produit['price'], 2, ',', ' ') ?> $
                </span>
            </div>

            <?php if (!empty($produit['description'])): ?>
            <p class="mb-4" style="color:#ccc; line-height:1.7;">
                <?= nl2br(htmlspecialchars($produit['description'])) ?>
            </p>
            <?php endif; ?>

            <!-- Stock -->
            <?php if (isset($produit['stock'])): ?>
            <p class="mb-4" style="font-size:0.9rem;">
                <?php if ($produit['stock'] > 5): ?>
                    <span style="color:#6f6;"><i class="bi bi-check-circle-fill me-1"></i>En stock (<?= $produit['stock'] ?> disponibles)</span>
                <?php elseif ($produit['stock'] > 0): ?>
                    <span style="color:#fa3;"><i class="bi bi-exclamation-circle-fill me-1"></i>Plus que <?= $produit['stock'] ?> en stock !</span>
                <?php else: ?>
                    <span style="color:#f66;"><i class="bi bi-x-circle-fill me-1"></i>Rupture de stock</span>
                <?php endif; ?>
            </p>
            <?php endif; ?>

            <!-- Actions -->
            <?php if (!isset($_SESSION['user_id'])): ?>
                <div class="alert-uk-info mb-4">
                    <i class="bi bi-info-circle me-2"></i>
                    <a href="/dashboard/boutique/login.php" class="text-decoration-none" style="color:#7cf;">
                        Connectez-vous
                    </a> pour ajouter ce produit au panier.
                </div>
            <?php endif; ?>

            <div class="d-flex gap-3 flex-wrap">
                <?php if (isset($_SESSION['user_id']) && ($produit['stock'] ?? 1) > 0): ?>
                <a href="/dashboard/boutique/actions/ajout_panier.php?id=<?= $produit['product_id'] ?>"
                   class="btn btn-uk btn-lg px-5 py-3">
                    <i class="bi bi-bag-plus me-2"></i>Ajouter au panier
                </a>
                <?php endif; ?>
                <a href="/dashboard/boutique/produits.php" class="btn btn-outline-secondary btn-lg px-4 py-3">
                    <i class="bi bi-arrow-left me-2"></i>Retour
                </a>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
