<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: /dashboard/boutique/login.php");
    exit();
}

require_once '../includes/db.php';
/** @var \mysqli $connexion */

$nb_produits     = $connexion->query("SELECT COUNT(*) FROM produits")->fetch_row()[0];
$nb_utilisateurs = $connexion->query("SELECT COUNT(*) FROM utilisateurs")->fetch_row()[0];
$nb_paniers      = $connexion->query("SELECT COUNT(DISTINCT user_id) FROM panier")->fetch_row()[0];

$page_title = "Administration";
require_once '../includes/header.php';
?>

<div class="container" style="padding:60px 0 80px;">

    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">
        <div>
            <span class="section-label">Espace admin</span>
            <h1 class="section-title mb-1">Administration</h1>
            <p style="color:var(--uk-muted); font-size:0.9rem; margin:0;">
                Connecté en tant que
                <strong style="color:var(--uk-dark);"><?= htmlspecialchars($_SESSION['user_nom']) ?></strong>
                <span class="badge bg-warning text-dark ms-1" style="font-size:0.72rem;">Admin</span>
            </p>
        </div>
        <a href="/dashboard/boutique/admin/ajouter-produit.php" class="btn-uk" style="padding:12px 24px;">
            <i class="bi bi-plus-lg me-2"></i>Ajouter un produit
        </a>
    </div>

    <!-- Stats -->
    <div class="row g-4 mb-5">
        <?php
        $stats = [
            ['box-seam',  $nb_produits,     'Produits en catalogue', '#f0fdf4', '#16a34a'],
            ['people',    $nb_utilisateurs, 'Membres inscrits',      '#eff6ff', '#1d4ed8'],
            ['bag-check', $nb_paniers,      'Paniers actifs',        '#fefce8', '#ca8a04'],
        ];
        foreach ($stats as [$icon, $val, $label, $bg, $color]) {
            echo '<div class="col-md-4">';
            echo '<div class="p-4 rounded-3 text-center" style="background:' . $bg . '; border:1px solid var(--uk-border);">';
            echo '<i class="bi bi-' . $icon . ' mb-3 d-block" style="font-size:2rem; color:' . $color . ';"></i>';
            echo '<div style="font-size:2.4rem; font-weight:900; color:var(--uk-dark); line-height:1; margin-bottom:6px;">' . (int)$val . '</div>';
            echo '<div style="font-size:0.82rem; font-weight:600; color:var(--uk-muted); text-transform:uppercase; letter-spacing:0.8px;">' . htmlspecialchars($label) . '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>

    <!-- Actions rapides -->
    <h5 style="font-weight:800; margin-bottom:16px; letter-spacing:-0.3px; color:var(--uk-dark);">
        Actions rapides
    </h5>
    <div class="row g-3">
        <div class="col-md-3">
            <a href="/dashboard/boutique/admin/liste-produits.php"
               class="d-block p-4 text-decoration-none"
               style="background:var(--uk-white); border:1px solid var(--uk-border); border-radius:14px; transition:all 0.2s; color:inherit;"
               onmouseenter="this.style.borderColor='#999'; this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.08)'"
               onmouseleave="this.style.borderColor='var(--uk-border)'; this.style.transform=''; this.style.boxShadow=''">
                <i class="bi bi-pencil-square mb-3 d-block" style="font-size:1.8rem; color:#7c3aed;"></i>
                <h6 style="font-weight:800; margin-bottom:6px; color:var(--uk-dark);">Gérer les produits</h6>
                <p style="font-size:0.83rem; color:var(--uk-muted); margin:0;">Modifier, supprimer, gérer le stock.</p>
            </a>
        </div>
        <div class="col-md-3">
            <a href="/dashboard/boutique/admin/ajouter-produit.php"
               class="d-block p-4 text-decoration-none"
               style="background:var(--uk-white); border:1px solid var(--uk-border); border-radius:14px; transition:all 0.2s; color:inherit;"
               onmouseenter="this.style.borderColor='#999'; this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.08)'"
               onmouseleave="this.style.borderColor='var(--uk-border)'; this.style.transform=''; this.style.boxShadow=''">
                <i class="bi bi-plus-circle mb-3 d-block" style="font-size:1.8rem; color:#1d4ed8;"></i>
                <h6 style="font-weight:800; margin-bottom:6px; color:var(--uk-dark);">Ajouter un produit</h6>
                <p style="font-size:0.83rem; color:var(--uk-muted); margin:0;">Ajouter un nouveau modèle au catalogue.</p>
            </a>
        </div>
        <div class="col-md-4">
            <a href="/dashboard/boutique/produits.php"
               class="d-block p-4 text-decoration-none"
               style="background:var(--uk-white); border:1px solid var(--uk-border); border-radius:14px; transition:all 0.2s; color:inherit;"
               onmouseenter="this.style.borderColor='#999'; this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.08)'"
               onmouseleave="this.style.borderColor='var(--uk-border)'; this.style.transform=''; this.style.boxShadow=''">
                <i class="bi bi-grid mb-3 d-block" style="font-size:1.8rem; color:#16a34a;"></i>
                <h6 style="font-weight:800; margin-bottom:6px; color:var(--uk-dark);">Voir le catalogue</h6>
                <p style="font-size:0.83rem; color:var(--uk-muted); margin:0;">Afficher tous les produits visibles sur le site.</p>
            </a>
        </div>
        <div class="col-md-4">
            <a href="/dashboard/boutique/login.php?logout=1"
               class="d-block p-4 text-decoration-none"
               style="background:var(--uk-white); border:1px solid var(--uk-border); border-radius:14px; transition:all 0.2s; color:inherit;"
               onmouseenter="this.style.borderColor='#f87171'; this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.08)'"
               onmouseleave="this.style.borderColor='var(--uk-border)'; this.style.transform=''; this.style.boxShadow=''">
                <i class="bi bi-box-arrow-right mb-3 d-block" style="font-size:1.8rem; color:var(--uk-danger);"></i>
                <h6 style="font-weight:800; margin-bottom:6px; color:var(--uk-danger);">Déconnexion</h6>
                <p style="font-size:0.83rem; color:var(--uk-muted); margin:0;">Terminer la session administrateur.</p>
            </a>
        </div>
    </div>

</div>

<?php require_once '../includes/footer.php'; ?>
