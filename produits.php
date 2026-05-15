<?php
session_start();
$page_title = "Nos Produits";
require_once 'includes/db.php';

$stmt = $connexion->prepare(
    "SELECT product_id, name, price, image_url, description, brand
     FROM produits
     ORDER BY product_id DESC"
);
$stmt->execute();
$produits = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>
<?php require_once 'includes/header.php'; ?>

<div class="container" style="padding:60px 0 80px;">

    <!-- En-tête -->
    <div class="mb-5">
        <span class="section-label">Catalogue</span>
        <h1 class="section-title mb-1">Nos Produits</h1>
        <p class="text-muted-uk">
            <?= count($produits) ?> article<?= count($produits) > 1 ? 's' : '' ?> disponible<?= count($produits) > 1 ? 's' : '' ?>
        </p>
    </div>

    <?php if (empty($produits)): ?>
        <div class="text-center py-5" style="border:2px dashed var(--uk-border); border-radius:16px;">
            <div style="font-size:4rem; margin-bottom:16px;">🥾</div>
            <h4 class="fw-bold mb-2">Aucun produit disponible</h4>
            <p class="text-muted-uk mb-0">Revenez bientôt — de nouvelles paires arrivent !</p>
        </div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($produits as $p): ?>
            <div class="col">
                <div class="card-produit">
                    <div class="img-wrapper">
                        <img src="<?= htmlspecialchars($p['image_url'] ?? '') ?>"
                             alt="<?= htmlspecialchars($p['name']) ?>">
                    </div>
                    <div class="card-body">
                        <?php if ($p['brand']): ?>
                        <p class="product-brand"><?= htmlspecialchars($p['brand']) ?></p>
                        <?php endif; ?>
                        <p class="product-name"><?= htmlspecialchars($p['name']) ?></p>
                        <?php if ($p['description']): ?>
                        <p style="font-size:0.85rem; color:var(--uk-muted); margin-bottom:16px; line-height:1.5;">
                            <?= htmlspecialchars(mb_substr($p['description'], 0, 80)) ?><?= mb_strlen($p['description']) > 80 ? '…' : '' ?>
                        </p>
                        <?php endif; ?>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge-prix"><?= number_format($p['price'], 2, ',', ' ') ?> $</span>
                            <a href="/dashboard/boutique/detail_produit.php?id=<?= $p['product_id'] ?>"
                               class="btn-uk" style="padding:8px 18px; font-size:0.78rem;">
                                Voir →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>
