<?php
$page_title = "Accueil";
require_once 'includes/header.php';
?>

<!-- ═══════════════════════════════════════════
     HERO — Vidéo plein écran
════════════════════════════════════════════ -->
<section class="hero-video">

    <video autoplay muted loop playsinline>
        <source src="/dashboard/boutique/image/7680115-uhd_4096_2160_25fps.mp4" type="video/mp4">
    </video>

    <div class="hero-overlay"></div>

    <div class="hero-content">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-7 col-xl-6">

                    <p class="section-label" style="color:rgba(255,255,255,0.5); margin-bottom:20px;">
                        Nouvelle collection 2025
                    </p>

                    <h1 class="hero-title mb-4">
                        URBAN<br>
                        <span class="dim">KICKS</span>
                    </h1>

                    <p class="hero-subtitle mb-5">
                        Les sneakers les plus recherchées, disponibles maintenant.
                        Éditions limitées, classiques intemporels, nouvelles sorties.
                    </p>

                    <div class="d-flex gap-3 flex-wrap">
                        <a href="/dashboard/boutique/produits.php" class="btn-hero">
                            Explorer la collection
                        </a>
                        <a href="/dashboard/boutique/avantages-membres.php" class="btn-hero-outline">
                            Devenir membre
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Scroll indicator -->
    <div style="position:absolute; bottom:36px; left:50%; transform:translateX(-50%); z-index:3; text-align:center;">
        <p style="color:rgba(255,255,255,0.45); font-size:0.65rem; letter-spacing:2.5px; text-transform:uppercase; margin-bottom:10px; font-weight:600;">
            Défiler
        </p>
        <div style="width:1px; height:44px; background:linear-gradient(to bottom, rgba(255,255,255,0.5), transparent); margin:0 auto; animation:scroll-down 1.8s ease-in-out infinite;"></div>
    </div>

</section>

<style>
@keyframes scroll-band {
    0%   { transform: translateX(0); }
    100% { transform: translateX(-16.66%); }
}
</style>

<!-- ═══════════════════════════════════════════
     BANDE DÉFILANTE
════════════════════════════════════════════ -->
<div style="background:var(--uk-dark); padding:13px 0; overflow:hidden; white-space:nowrap; user-select:none;">
    <div style="display:inline-flex; gap:56px; animation:scroll-band 28s linear infinite;">
        <?php for ($i = 0; $i < 8; $i++): ?>
        <span style="color:rgba(255,255,255,0.9); font-weight:800; font-size:0.72rem; letter-spacing:2.5px; text-transform:uppercase;">
            ★&nbsp;Nike &nbsp;&nbsp; ★&nbsp;Adidas &nbsp;&nbsp; ★&nbsp;Jordan &nbsp;&nbsp; ★&nbsp;New Balance &nbsp;&nbsp; ★&nbsp;Yeezy &nbsp;&nbsp; ★&nbsp;Converse &nbsp;&nbsp; ★&nbsp;Puma &nbsp;&nbsp;
        </span>
        <?php endfor; ?>
    </div>
</div>

<!-- ═══════════════════════════════════════════
     NOS COUPS DE CŒUR
════════════════════════════════════════════ -->
<section style="padding:96px 0;">
    <div class="container">

        <div class="d-flex justify-content-between align-items-end mb-5 flex-wrap gap-3 uk-fade-up">
            <div>
                <span class="section-label">Sélection de la semaine</span>
                <h2 class="section-title">Nos coups de cœur</h2>
            </div>
            <a href="/dashboard/boutique/produits.php" class="btn-uk-outline" style="padding:10px 22px; font-size:0.78rem;">
                Tout voir →
            </a>
        </div>

        <div class="row g-4">
            <div class="col-md-4 uk-fade-up uk-d1">
                <a href="/dashboard/boutique/produits.php" class="card-produit" style="text-decoration:none; color:inherit;">
                    <div class="img-wrapper">
                        <img src="/dashboard/boutique/image/acceuil_image1.webp" alt="Air Force 1">
                    </div>
                    <div class="card-body">
                        <p class="product-brand">Nike</p>
                        <p class="product-name">Air Force 1 '07</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge-prix">149,99 $</span>
                            <span style="font-size:0.78rem; color:var(--uk-muted);">En stock</span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 uk-fade-up uk-d2">
                <a href="/dashboard/boutique/produits.php" class="card-produit" style="text-decoration:none; color:inherit;">
                    <div class="img-wrapper">
                        <img src="/dashboard/boutique/image/image2.webp" alt="Jordan 1">
                    </div>
                    <div class="card-body">
                        <p class="product-brand">Jordan</p>
                        <p class="product-name">Jordan 1 Retro High OG</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge-prix">299,99 $</span>
                            <span style="font-size:0.78rem; color:var(--uk-danger); font-weight:700;">5 restants</span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 uk-fade-up uk-d3">
                <a href="/dashboard/boutique/produits.php" class="card-produit" style="text-decoration:none; color:inherit;">
                    <div class="img-wrapper" style="background:#111;">
                        <img src="/dashboard/boutique/image/image_backgro.jpeg" alt="Yeezy">
                    </div>
                    <div class="card-body">
                        <p class="product-brand">Adidas</p>
                        <p class="product-name">Yeezy Boost 350 V2</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge-prix">399,99 $</span>
                            <span style="font-size:0.78rem; color:var(--uk-danger); font-weight:700;">Rare</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>
</section>

<!-- ═══════════════════════════════════════════
     POURQUOI URBAN KICKS
════════════════════════════════════════════ -->
<section style="background:var(--uk-bg-2); padding:96px 0;">
    <div class="container">

        <div class="text-center mb-5 uk-fade-up">
            <span class="section-label">Nos engagements</span>
            <h2 class="section-title">Pourquoi Urban Kicks ?</h2>
        </div>

        <div class="row g-4">
            <div class="col-md-4 uk-fade-up uk-d1">
                <div class="feature-card text-center">
                    <span class="feature-icon">🚚</span>
                    <h5 style="font-weight:800; font-size:1rem; margin-bottom:10px;">Livraison rapide</h5>
                    <p class="text-muted-uk mb-0" style="font-size:0.88rem;">Livraison gratuite au Canada dès 150 $. Expédié en 24–48 h ouvrables.</p>
                </div>
            </div>
            <div class="col-md-4 uk-fade-up uk-d2">
                <div class="feature-card text-center">
                    <span class="feature-icon">✅</span>
                    <h5 style="font-weight:800; font-size:1rem; margin-bottom:10px;">Authenticité garantie</h5>
                    <p class="text-muted-uk mb-0" style="font-size:0.88rem;">Chaque paire vérifiée et certifiée authentique avant expédition.</p>
                </div>
            </div>
            <div class="col-md-4 uk-fade-up uk-d3">
                <div class="feature-card text-center">
                    <span class="feature-icon">↩️</span>
                    <h5 style="font-weight:800; font-size:1rem; margin-bottom:10px;">Retours gratuits</h5>
                    <p class="text-muted-uk mb-0" style="font-size:0.88rem;">30 jours pour changer d'avis. Retour gratuit, sans question posée.</p>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- ═══════════════════════════════════════════
     BANNIÈRE INSCRIPTION
════════════════════════════════════════════ -->
<section style="padding:48px 0; background:var(--uk-white); border-top:1px solid var(--uk-border); border-bottom:1px solid var(--uk-border);">
    <div class="container">
        <div class="row align-items-center g-4 uk-fade-up">
            <div class="col-md-8">
                <h3 style="font-weight:900; letter-spacing:-0.8px; margin-bottom:6px;">Rejoignez le club Urban Kicks.</h3>
                <p class="text-muted-uk mb-0" style="font-size:0.92rem;">
                    Accès anticipé aux drops, points de fidélité, remises exclusives. Gratuit, sans engagement.
                </p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="/dashboard/boutique/inscription.php" class="btn-uk" style="padding:13px 30px;">
                    S'inscrire gratuitement
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════
     CTA FINAL — Fond sombre
════════════════════════════════════════════ -->
<section style="background:var(--uk-dark); padding:110px 0;">
    <div class="container text-center uk-fade-up">
        <h2 style="font-size:clamp(2.2rem,5.5vw,3.5rem); font-weight:900; color:white; letter-spacing:-2px; line-height:1.05;" class="mb-3">
            Prêt à trouver<br>votre prochaine paire ?
        </h2>
        <p style="color:rgba(255,255,255,0.5); font-size:1rem; max-width:480px; margin:0 auto 40px;">
            Des centaines de modèles vous attendent. Livraison rapide partout au Canada.
        </p>
        <a href="/dashboard/boutique/produits.php" class="btn-hero" style="padding:16px 44px; font-size:0.9rem;">
            Voir la collection complète
        </a>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
