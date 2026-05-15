<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$page_actuelle = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? htmlspecialchars($page_title) . ' — Urban Kicks' : 'Urban Kicks' ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* ── Variables ── */
        :root {
            --uk-bg:      #f7f7f7;
            --uk-bg-2:    #eeeeee;
            --uk-dark:    #0f0f0f;
            --uk-dark-2:  #1e1e1e;
            --uk-muted:   #6b6b6b;
            --uk-border:  #e2e2e2;
            --uk-white:   #ffffff;
            --uk-success: #16a34a;
            --uk-danger:  #dc2626;
            --uk-radius:  10px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            background-color: var(--uk-bg);
            color: var(--uk-dark);
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            font-size: 15px;
            line-height: 1.65;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Navbar ── */
        .navbar-uk {
            background-color: var(--uk-white) !important;
            border-bottom: 1px solid var(--uk-border);
            padding: 18px 0;
            transition: box-shadow 0.3s ease, padding 0.3s ease;
        }
        .navbar-uk.scrolled {
            padding: 12px 0;
            box-shadow: 0 4px 30px rgba(0,0,0,0.08) !important;
        }
        .navbar-brand {
            font-weight: 900;
            font-size: 1.35rem;
            letter-spacing: -0.8px;
            color: var(--uk-dark) !important;
        }
        .navbar-uk .nav-link {
            color: var(--uk-muted) !important;
            font-weight: 500;
            font-size: 0.88rem;
            letter-spacing: 0.1px;
            padding: 6px 14px !important;
            border-radius: 6px;
            transition: color 0.2s, background 0.2s;
        }
        .navbar-uk .nav-link:hover { color: var(--uk-dark) !important; background: rgba(0,0,0,0.04); }
        .navbar-uk .nav-link.active-uk { color: var(--uk-dark) !important; font-weight: 700; }
        .navbar-toggler { border-color: var(--uk-border) !important; }

        /* ── Boutons standard (fond clair) ── */
        .btn-uk {
            background: var(--uk-dark);
            color: var(--uk-white);
            font-weight: 700;
            font-size: 0.82rem;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            border: none;
            padding: 12px 28px;
            border-radius: 5px;
            transition: background 0.2s, transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn-uk:hover {
            background: var(--uk-dark-2);
            color: var(--uk-white);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.18);
        }
        .btn-uk-outline {
            background: transparent;
            color: var(--uk-dark);
            font-weight: 700;
            font-size: 0.82rem;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            border: 2px solid var(--uk-dark);
            padding: 10px 26px;
            border-radius: 5px;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-uk-outline:hover { background: var(--uk-dark); color: var(--uk-white); }

        /* ── Boutons sur fond sombre (hero vidéo) ── */
        .btn-hero {
            background: var(--uk-white);
            color: var(--uk-dark);
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            border: none;
            padding: 15px 36px;
            border-radius: 5px;
            transition: all 0.25s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-hero:hover {
            background: #f0f0f0;
            color: var(--uk-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
        }
        .btn-hero-outline {
            background: transparent;
            color: var(--uk-white);
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            border: 2px solid rgba(255,255,255,0.55);
            padding: 13px 34px;
            border-radius: 5px;
            transition: all 0.25s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-hero-outline:hover {
            border-color: var(--uk-white);
            background: rgba(255,255,255,0.1);
            color: var(--uk-white);
        }

        /* ── Hero vidéo ── */
        .hero-video {
            position: relative;
            min-height: 92vh;
            overflow: hidden;
            display: flex;
            align-items: center;
        }
        .hero-video video {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
        }
        .hero-video .hero-overlay {
            position: absolute;
            inset: 0;
            z-index: 1;
            background: linear-gradient(
                135deg,
                rgba(0,0,0,0.72) 0%,
                rgba(0,0,0,0.45) 60%,
                rgba(0,0,0,0.25) 100%
            );
        }
        .hero-video .hero-content {
            position: relative;
            z-index: 2;
            width: 100%;
        }
        .hero-title {
            font-size: clamp(3.5rem, 9vw, 7rem);
            font-weight: 900;
            line-height: 0.95;
            letter-spacing: -4px;
            color: var(--uk-white);
        }
        .hero-title .dim { color: rgba(255,255,255,0.4); }
        .hero-subtitle {
            font-size: 1.05rem;
            color: rgba(255,255,255,0.72);
            max-width: 420px;
            line-height: 1.7;
            font-weight: 400;
        }

        /* ── Hero non-vidéo (autres pages) ── */
        .hero-section {
            background: linear-gradient(135deg, #f0f0f0 0%, #e8e8e8 100%);
            padding: 80px 0;
        }

        /* ── Cards produits ── */
        .card-produit {
            background: var(--uk-white);
            border: 1px solid var(--uk-border);
            border-radius: 14px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
            height: 100%;
            display: block;
        }
        .card-produit:hover {
            transform: translateY(-8px);
            box-shadow: 0 24px 64px rgba(0,0,0,0.1);
            border-color: #c8c8c8;
        }
        .card-produit .img-wrapper {
            background: var(--uk-bg-2);
            height: 248px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-produit .img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .card-produit:hover .img-wrapper img { transform: scale(1.07); }
        .card-produit .card-body {
            padding: 22px;
            border-top: 1px solid var(--uk-border);
        }
        .product-brand {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--uk-muted);
            margin-bottom: 5px;
        }
        .product-name {
            font-size: 1rem;
            font-weight: 700;
            color: var(--uk-dark);
            margin-bottom: 16px;
            letter-spacing: -0.2px;
        }

        /* ── Badge prix ── */
        .badge-prix {
            background: var(--uk-dark);
            color: var(--uk-white);
            font-weight: 800;
            font-size: 0.95rem;
            padding: 6px 14px;
            border-radius: 100px;
            display: inline-block;
            letter-spacing: -0.2px;
        }

        /* ── Sections ── */
        .section-label {
            display: block;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--uk-muted);
            margin-bottom: 10px;
        }
        .section-title {
            font-size: clamp(1.9rem, 4.5vw, 3rem);
            font-weight: 900;
            letter-spacing: -1.5px;
            color: var(--uk-dark);
            line-height: 1.05;
        }

        /* ── Feature cards ── */
        .feature-card {
            padding: 36px 32px;
            background: var(--uk-white);
            border: 1px solid var(--uk-border);
            border-radius: 14px;
            transition: all 0.3s;
            height: 100%;
        }
        .feature-card:hover {
            border-color: #bbb;
            box-shadow: 0 12px 40px rgba(0,0,0,0.07);
            transform: translateY(-4px);
        }
        .feature-icon { font-size: 2.2rem; margin-bottom: 18px; display: block; }

        /* ── Formulaires ── */
        .form-control-uk {
            background: var(--uk-white);
            border: 1.5px solid var(--uk-border);
            color: var(--uk-dark);
            padding: 13px 16px;
            border-radius: 9px;
            font-size: 0.93rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            width: 100%;
            font-family: inherit;
        }
        .form-control-uk:focus {
            border-color: var(--uk-dark);
            box-shadow: 0 0 0 3px rgba(0,0,0,0.06);
            outline: none;
        }
        .form-control-uk::placeholder { color: #b0b0b0; }
        .form-label-uk {
            font-weight: 600;
            font-size: 0.83rem;
            color: var(--uk-dark);
            margin-bottom: 7px;
            display: block;
            letter-spacing: 0.1px;
        }
        .form-card {
            background: var(--uk-white);
            border: 1px solid var(--uk-border);
            border-radius: 18px;
            padding: 44px 40px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.06);
            max-width: 480px;
            margin: 0 auto;
            width: 100%;
        }

        /* ── Panier ── */
        .panier-table {
            width: 100%;
            background: var(--uk-white);
            border: 1px solid var(--uk-border);
            border-radius: 14px;
            overflow: hidden;
            border-collapse: separate;
        }
        .panier-table th {
            background: var(--uk-bg-2);
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--uk-muted);
            padding: 14px 20px;
            border-bottom: 1px solid var(--uk-border);
        }
        .panier-table td {
            padding: 18px 20px;
            vertical-align: middle;
            border-bottom: 1px solid var(--uk-border);
            color: var(--uk-dark);
        }
        .panier-table tr:last-child td { border-bottom: none; }
        .panier-summary {
            background: var(--uk-white);
            border: 1px solid var(--uk-border);
            border-radius: 14px;
            padding: 30px;
            position: sticky;
            top: 90px;
        }

        /* ── Alerts ── */
        .alert-uk-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
            padding: 14px 18px;
            border-radius: 9px;
            font-weight: 500;
            font-size: 0.9rem;
        }
        .alert-uk-error {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            color: #9f1239;
            padding: 14px 18px;
            border-radius: 9px;
            font-weight: 500;
            font-size: 0.9rem;
        }
        .alert-uk-info {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            color: #1e40af;
            padding: 14px 18px;
            border-radius: 9px;
            font-weight: 500;
            font-size: 0.9rem;
        }

        /* ── Scroll animations ── */
        .uk-fade-up {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.65s cubic-bezier(0.16,1,0.3,1),
                        transform 0.65s cubic-bezier(0.16,1,0.3,1);
        }
        .uk-fade-up.uk-visible { opacity: 1; transform: translateY(0); }
        .uk-d1 { transition-delay: 0.08s; }
        .uk-d2 { transition-delay: 0.18s; }
        .uk-d3 { transition-delay: 0.28s; }

        /* ── Scroll indicator ── */
        @keyframes scroll-down {
            0%, 100% { transform: translateY(0) scaleY(1); opacity: 0.6; }
            50%       { transform: translateY(10px) scaleY(1.2); opacity: 1; }
        }

        /* ── Footer ── */
        footer { background: #0a0a0a !important; }
        footer h5, footer h6 { color: #fff !important; font-weight: 700; }
        footer a { color: #666 !important; text-decoration: none; transition: color 0.2s; }
        footer a:hover { color: #fff !important; }

        /* ── Misc ── */
        .text-muted-uk { color: var(--uk-muted) !important; }
        .badge-uk {
            background: var(--uk-bg-2);
            color: var(--uk-dark);
            font-size: 0.72rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 100px;
            display: inline-block;
        }
        a { color: inherit; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-uk fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="/dashboard/boutique/home.php">🥾 Urban Kicks</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav me-auto gap-1">
                <li class="nav-item">
                    <a class="nav-link <?= in_array($page_actuelle, ['home.php','index.php']) ? 'active-uk' : '' ?>"
                       href="/dashboard/boutique/home.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page_actuelle === 'produits.php' ? 'active-uk' : '' ?>"
                       href="/dashboard/boutique/produits.php">Produits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page_actuelle === 'avantages-membres.php' ? 'active-uk' : '' ?>"
                       href="/dashboard/boutique/avantages-membres.php">Membres</a>
                </li>
                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/boutique/admin/dashboard.php"
                       style="color:#d97706 !important; font-weight:700;">⚙ Admin</a>
                </li>
                <?php endif; ?>
            </ul>

            <ul class="navbar-nav gap-1 align-items-lg-center">
                <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item">
                    <a class="nav-link <?= $page_actuelle === 'panier.php' ? 'active-uk' : '' ?>"
                       href="/dashboard/boutique/panier.php">
                        <i class="bi bi-bag"></i> Panier
                    </a>
                </li>
                <li class="nav-item">
                    <span class="nav-link" style="color:var(--uk-dark) !important; font-size:0.82rem; font-weight:600; pointer-events:none;">
                        👤 <?= htmlspecialchars($_SESSION['user_nom'] ?? '') ?>
                    </span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/boutique/login.php?logout=1"
                       style="color:var(--uk-danger) !important; font-size:0.85rem;">
                        Déconnexion
                    </a>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/boutique/login.php">Connexion</a>
                </li>
                <li class="nav-item ms-lg-1">
                    <a class="btn-uk" href="/dashboard/boutique/inscription.php"
                       style="padding:9px 20px; font-size:0.78rem;">S'inscrire</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Navbar scroll effect -->
<script>
(function(){
    var nav = document.getElementById('mainNav');
    window.addEventListener('scroll', function(){
        nav.classList.toggle('scrolled', window.scrollY > 30);
    }, { passive: true });
})();
</script>

<div style="padding-top:72px;">
