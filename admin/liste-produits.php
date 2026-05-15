<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: /dashboard/boutique/login.php");
    exit();
}

require_once '../includes/db.php';

$flash      = $_SESSION['flash'] ?? '';
$flash_type = $_SESSION['flash_type'] ?? 'success';
unset($_SESSION['flash'], $_SESSION['flash_type']);

$produits = $connexion->query(
    "SELECT product_id, name, brand, price, stock, image_url FROM produits ORDER BY product_id DESC"
)->fetch_all(MYSQLI_ASSOC);

$page_title = "Gestion des produits";
require_once '../includes/header.php';
?>

<div class="container" style="padding:60px 0 80px;">

    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">
        <div>
            <span class="section-label">Admin</span>
            <h1 class="section-title mb-1">Gestion des produits</h1>
            <p style="color:var(--uk-muted); font-size:0.9rem; margin:0;">
                <?= count($produits) ?> produit<?= count($produits) > 1 ? 's' : '' ?> dans le catalogue
            </p>
        </div>
        <div class="d-flex gap-2">
            <a href="/dashboard/boutique/admin/dashboard.php" class="btn-uk-outline" style="padding:10px 20px; font-size:0.8rem;">
                ← Dashboard
            </a>
            <a href="/dashboard/boutique/admin/ajouter-produit.php" class="btn-uk" style="padding:10px 20px; font-size:0.8rem;">
                + Ajouter un produit
            </a>
        </div>
    </div>

    <!-- Flash message -->
    <?php if ($flash): ?>
        <div class="alert-uk-<?= $flash_type === 'success' ? 'success' : 'error' ?> mb-4">
            <i class="bi bi-<?= $flash_type === 'success' ? 'check-circle-fill' : 'exclamation-triangle-fill' ?> me-2"></i>
            <?= htmlspecialchars($flash) ?>
        </div>
    <?php endif; ?>

    <?php if (empty($produits)): ?>
        <div class="text-center py-5" style="border:2px dashed var(--uk-border); border-radius:16px;">
            <div style="font-size:3.5rem; margin-bottom:16px;">🥾</div>
            <h4 class="fw-bold mb-2">Aucun produit dans le catalogue</h4>
            <p style="color:var(--uk-muted);" class="mb-4">Commencez par ajouter votre premier produit.</p>
            <a href="/dashboard/boutique/admin/ajouter-produit.php" class="btn-uk" style="padding:12px 28px;">
                Ajouter un produit
            </a>
        </div>

    <?php else: ?>
        <!-- Tableau produits -->
        <div style="background:var(--uk-white); border:1px solid var(--uk-border); border-radius:14px; overflow:hidden;">

            <table style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr style="background:var(--uk-bg-2);">
                        <th style="padding:14px 20px; font-size:0.72rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--uk-muted); border-bottom:1px solid var(--uk-border); width:72px;">Photo</th>
                        <th style="padding:14px 20px; font-size:0.72rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--uk-muted); border-bottom:1px solid var(--uk-border);">Produit</th>
                        <th style="padding:14px 20px; font-size:0.72rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--uk-muted); border-bottom:1px solid var(--uk-border); text-align:center;">Prix</th>
                        <th style="padding:14px 20px; font-size:0.72rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--uk-muted); border-bottom:1px solid var(--uk-border); text-align:center;">Stock</th>
                        <th style="padding:14px 20px; font-size:0.72rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--uk-muted); border-bottom:1px solid var(--uk-border); text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produits as $i => $p): ?>
                    <tr style="<?= $i < count($produits) - 1 ? 'border-bottom:1px solid var(--uk-border);' : '' ?> transition:background 0.15s;"
                        onmouseenter="this.style.background='var(--uk-bg)'"
                        onmouseleave="this.style.background='transparent'">

                        <!-- Miniature -->
                        <td style="padding:16px 20px;">
                            <div style="width:52px; height:52px; border-radius:8px; overflow:hidden; background:var(--uk-bg-2); flex-shrink:0;">
                                <?php if ($p['image_url']): ?>
                                <img src="<?= htmlspecialchars($p['image_url']) ?>"
                                     alt="<?= htmlspecialchars($p['name']) ?>"
                                     style="width:100%; height:100%; object-fit:cover;">
                                <?php else: ?>
                                <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; font-size:1.4rem;">🥾</div>
                                <?php endif; ?>
                            </div>
                        </td>

                        <!-- Nom + marque -->
                        <td style="padding:16px 20px;">
                            <div style="font-weight:700; font-size:0.95rem; color:var(--uk-dark); margin-bottom:3px;">
                                <?= htmlspecialchars($p['name']) ?>
                            </div>
                            <?php if ($p['brand']): ?>
                            <div style="font-size:0.75rem; color:var(--uk-muted); font-weight:600; text-transform:uppercase; letter-spacing:0.5px;">
                                <?= htmlspecialchars($p['brand']) ?>
                            </div>
                            <?php endif; ?>
                        </td>

                        <!-- Prix -->
                        <td style="padding:16px 20px; text-align:center;">
                            <span style="font-weight:800; font-size:0.95rem; color:var(--uk-dark);">
                                <?= number_format($p['price'], 2, ',', ' ') ?> $
                            </span>
                        </td>

                        <!-- Stock -->
                        <td style="padding:16px 20px; text-align:center;">
                            <?php if ($p['stock'] > 5): ?>
                                <span style="background:#f0fdf4; color:#16a34a; font-size:0.78rem; font-weight:700; padding:4px 10px; border-radius:100px;">
                                    <?= $p['stock'] ?> en stock
                                </span>
                            <?php elseif ($p['stock'] > 0): ?>
                                <span style="background:#fefce8; color:#ca8a04; font-size:0.78rem; font-weight:700; padding:4px 10px; border-radius:100px;">
                                    <?= $p['stock'] ?> restant<?= $p['stock'] > 1 ? 's' : '' ?>
                                </span>
                            <?php else: ?>
                                <span style="background:#fff1f2; color:#dc2626; font-size:0.78rem; font-weight:700; padding:4px 10px; border-radius:100px;">
                                    Rupture
                                </span>
                            <?php endif; ?>
                        </td>

                        <!-- Actions -->
                        <td style="padding:16px 20px; text-align:right;">
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="/dashboard/boutique/admin/modifier-produit.php?id=<?= $p['product_id'] ?>"
                                   style="background:var(--uk-dark); color:white; font-size:0.78rem; font-weight:700; padding:7px 16px; border-radius:6px; text-decoration:none; display:inline-flex; align-items:center; gap:6px; transition:opacity 0.2s;"
                                   onmouseenter="this.style.opacity='0.8'" onmouseleave="this.style.opacity='1'">
                                    <i class="bi bi-pencil-fill"></i> Modifier
                                </a>
                                <form method="POST" action="/dashboard/boutique/actions/supprimer_produit.php"
                                      onsubmit="return confirm('Supprimer « <?= htmlspecialchars(addslashes($p['name'])) ?> » ? Cette action est irréversible.')">
                                    <input type="hidden" name="product_id" value="<?= $p['product_id'] ?>">
                                    <button type="submit"
                                            style="background:#fff1f2; color:#dc2626; border:1px solid #fecdd3; font-size:0.78rem; font-weight:700; padding:7px 14px; border-radius:6px; cursor:pointer; display:inline-flex; align-items:center; gap:6px; transition:all 0.2s;"
                                            onmouseenter="this.style.background='#dc2626'; this.style.color='white'; this.style.borderColor='#dc2626'"
                                            onmouseleave="this.style.background='#fff1f2'; this.style.color='#dc2626'; this.style.borderColor='#fecdd3'">
                                        <i class="bi bi-trash-fill"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php require_once '../includes/footer.php'; ?>
