<?php
$page_title = "Avantages membres";
require_once 'includes/header.php';
?>

<div class="container" style="padding:60px 0 80px;">

    <!-- En-tête -->
    <div class="text-center mb-5 py-4 uk-fade-up">
        <span class="section-label">Programme membres</span>
        <h1 class="section-title mb-3">Rejoignez le club Urban Kicks</h1>
        <p class="text-muted-uk" style="max-width:480px; margin:0 auto; font-size:1rem; line-height:1.7;">
            Un programme pensé pour les vrais passionnés de sneakers. Accès, avantages et expériences exclusives.
        </p>
    </div>

    <!-- Grille des avantages -->
    <div class="row g-4 mb-5">
        <?php
        $avantages = [
            ['rocket-takeoff-fill', 'Accès anticipé',      'Soyez les premiers informés des nouveaux drops et éditions limitées, avant tout le monde.'],
            ['star-fill',           'Points fidélité',     'Chaque achat rapporte des points échangeables contre des réductions et cadeaux.'],
            ['percent',             'Remises exclusives',  'Des offres réservées aux membres sur une sélection de produits chaque semaine.'],
            ['calendar-event-fill', 'Événements privés',   'Invitations aux soirées de lancement, ateliers de personnalisation et meet-ups.'],
            ['headset',             'Support prioritaire', 'Une ligne dédiée aux membres avec des réponses en moins de 2 h ouvrables.'],
            ['newspaper',           'Contenus exclusifs',  'Newsletter sneakers, conseils de style, interviews de designers et tendances à venir.'],
            ['palette-fill',        'Personnalisation',    'Accès à des options de customisation exclusives sur certains modèles.'],
            ['gift-fill',           'Cadeaux surprise',    'Échantillons et petites attentions envoyés aléatoirement à nos membres fidèles.'],
        ];
        $delays = ['', 'uk-d1', 'uk-d2', 'uk-d3'];
        foreach ($avantages as $i => [$icon, $titre, $desc]):
            $delay = $delays[$i % 4];
        ?>
        <div class="col-md-6 col-lg-3 uk-fade-up <?= $delay ?>">
            <div class="feature-card">
                <i class="bi bi-<?= $icon ?> mb-3 d-block" style="font-size:1.8rem; color:var(--uk-muted);"></i>
                <h6 style="font-weight:800; font-size:0.95rem; margin-bottom:8px; color:var(--uk-dark);"><?= $titre ?></h6>
                <p style="font-size:0.85rem; color:var(--uk-muted); margin-bottom:0; line-height:1.6;"><?= $desc ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- CTA -->
    <div class="text-center py-5 px-4 uk-fade-up" style="background:var(--uk-dark); border-radius:18px;">
        <h2 style="font-weight:900; letter-spacing:-1px; color:white; font-size:clamp(1.6rem,3vw,2.4rem);" class="mb-3">
            Prêt à rejoindre l'équipe ?
        </h2>
        <p style="color:rgba(255,255,255,0.55); font-size:0.95rem;" class="mb-4">
            L'inscription est gratuite et prend moins de 2 minutes.
        </p>
        <a href="/dashboard/boutique/inscription.php" class="btn-hero" style="padding:14px 36px; font-size:0.88rem;">
            S'inscrire maintenant
        </a>
    </div>

</div>

<?php require_once 'includes/footer.php'; ?>
