<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /dashboard/boutique/login.php");
    exit();
}

require_once 'includes/db.php';

$user_id = $_SESSION['user_id'];

$stmt = $connexion->prepare(
    "SELECT p.product_id, p.name, p.price, p.image_url, pa.quantite
     FROM panier pa
     JOIN produits p ON pa.product_id = p.product_id
     WHERE pa.user_id = ?
     ORDER BY pa.created_at DESC"
);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$total = 0;
foreach ($items as $item) {
    $total += $item['price'] * $item['quantite'];
}
$_SESSION['total_panier'] = $total;
$livraison   = $total >= 150 ? 0 : 9.99;
$total_final = $total + $livraison;

$message = $_GET['message'] ?? '';
$page_title = "Mon Panier";
?>
<?php require_once 'includes/header.php'; ?>

<div class="container" style="padding:60px 0 80px;">

    <!-- En-tête -->
    <div class="mb-5">
        <span class="section-label">Mon espace</span>
        <h1 class="section-title mb-1">Mon Panier</h1>
        <p class="text-muted-uk">
            <?= count($items) ?> article<?= count($items) > 1 ? 's' : '' ?>
        </p>
    </div>

    <?php if ($message): ?>
        <div class="alert-uk-success mb-4">
            <i class="bi bi-check-circle-fill me-2"></i>
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <?php if (empty($items)): ?>
        <div class="text-center py-5" style="border:2px dashed var(--uk-border); border-radius:16px; background:var(--uk-white);">
            <div style="font-size:4rem; margin-bottom:16px;">🛍️</div>
            <h4 class="fw-bold mb-2">Votre panier est vide</h4>
            <p class="text-muted-uk mb-4">Explorez notre catalogue et trouvez votre prochaine paire.</p>
            <a href="/dashboard/boutique/produits.php" class="btn-uk" style="padding:12px 32px;">
                Voir les produits
            </a>
        </div>

    <?php else: ?>
        <div class="row g-4">

            <!-- Articles -->
            <div class="col-lg-8">
                <form action="/dashboard/boutique/actions/sup_panier.php" method="POST">
                    <table class="panier-table">
                        <thead>
                            <tr>
                                <th style="width:48px;"></th>
                                <th>Produit</th>
                                <th style="text-align:center;">Qté</th>
                                <th style="text-align:right;">Prix unit.</th>
                                <th style="text-align:right;">Total</th>
                                <th style="width:40px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item): ?>
                            <tr>
                                <!-- Image -->
                                <td>
                                    <div style="width:56px; height:56px; border-radius:8px; overflow:hidden; background:var(--uk-bg-2);">
                                        <img src="<?= htmlspecialchars($item['image_url'] ?? '') ?>"
                                             alt="<?= htmlspecialchars($item['name']) ?>"
                                             style="width:100%; height:100%; object-fit:cover;">
                                    </div>
                                </td>
                                <!-- Nom -->
                                <td>
                                    <span style="font-weight:600; font-size:0.95rem;">
                                        <?= htmlspecialchars($item['name']) ?>
                                    </span>
                                </td>
                                <!-- Quantité -->
                                <td style="text-align:center;">
                                    <span class="badge-uk"><?= $item['quantite'] ?></span>
                                </td>
                                <!-- Prix unitaire -->
                                <td style="text-align:right; color:var(--uk-muted); font-size:0.9rem;">
                                    <?= number_format($item['price'], 2, ',', ' ') ?> $
                                </td>
                                <!-- Total ligne -->
                                <td style="text-align:right; font-weight:700;">
                                    <?= number_format($item['price'] * $item['quantite'], 2, ',', ' ') ?> $
                                </td>
                                <!-- Checkbox -->
                                <td style="text-align:center;">
                                    <input type="checkbox" name="produits[]"
                                           value="<?= $item['product_id'] ?>"
                                           style="width:16px; height:16px; accent-color:var(--uk-dark); cursor:pointer;">
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <!-- Actions -->
                    <div class="d-flex gap-2 mt-3 flex-wrap">
                        <button type="submit" class="btn-uk-outline" style="padding:9px 18px; font-size:0.8rem; color:var(--uk-danger); border-color:var(--uk-danger);">
                            <i class="bi bi-trash me-1"></i> Supprimer la sélection
                        </button>
                        <a href="/dashboard/boutique/actions/vider_panier.php" class="btn-uk-outline" style="padding:9px 18px; font-size:0.8rem;">
                            <i class="bi bi-x-circle me-1"></i> Vider le panier
                        </a>
                        <a href="/dashboard/boutique/produits.php" class="btn-uk-outline" style="padding:9px 18px; font-size:0.8rem;">
                            ← Continuer mes achats
                        </a>
                    </div>
                </form>
            </div>

            <!-- Récapitulatif -->
            <div class="col-lg-4">
                <div class="panier-summary">
                    <h5 style="font-weight:800; margin-bottom:20px; letter-spacing:-0.3px;">Récapitulatif</h5>

                    <div class="d-flex justify-content-between mb-2" style="font-size:0.95rem;">
                        <span class="text-muted-uk">Sous-total</span>
                        <span><?= number_format($total, 2, ',', ' ') ?> $</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3" style="font-size:0.95rem;">
                        <span class="text-muted-uk">Livraison</span>
                        <?php if ($livraison === 0): ?>
                            <span style="color:var(--uk-success); font-weight:600;">Gratuite ✓</span>
                        <?php else: ?>
                            <span><?= number_format($livraison, 2, ',', ' ') ?> $</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($livraison > 0): ?>
                    <p style="font-size:0.78rem; color:var(--uk-muted); margin-bottom:12px;">
                        Plus que <?= number_format(150 - $total, 2, ',', ' ') ?> $ pour la livraison gratuite.
                    </p>
                    <?php endif; ?>

                    <hr style="border-color:var(--uk-border); margin:16px 0;">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span style="font-weight:800; font-size:1.05rem;">Total</span>
                        <span class="badge-prix" style="font-size:1.1rem; padding:8px 16px;">
                            <?= number_format($total_final, 2, ',', ' ') ?> $
                        </span>
                    </div>

                    <a href="/dashboard/boutique/paiement.php" class="btn-uk w-100" style="padding:14px; font-size:0.9rem; border-radius:8px; text-align:center; display:block;">
                        Passer à la caisse →
                    </a>
                </div>
            </div>

        </div>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>
