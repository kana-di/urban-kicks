<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /dashboard/boutique/login.php");
    exit();
}

$total = $_SESSION['total_panier'] ?? 0;

if ($total <= 0) {
    header("Location: /dashboard/boutique/panier.php");
    exit();
}

$livraison   = $total >= 150 ? 0 : 9.99;
$total_final = $total + $livraison;

$page_title = "Paiement";
require_once 'includes/db.php';
require_once 'includes/config.php';
?>
<?php require_once 'includes/header.php'; ?>

<div class="container" style="max-width:680px; padding:60px 20px 80px;">

    <div class="mb-5">
        <span class="section-label">Finaliser</span>
        <h1 class="section-title">Paiement</h1>
    </div>

    <!-- Récapitulatif commande -->
    <div class="mb-4 p-4" style="background:var(--uk-white); border:1px solid var(--uk-border); border-radius:14px;">
        <h5 style="font-weight:800; margin-bottom:20px; letter-spacing:-0.3px;">Récapitulatif</h5>

        <div class="d-flex justify-content-between mb-2" style="font-size:0.93rem;">
            <span class="text-muted-uk">Sous-total</span>
            <span><?= number_format($total, 2, ',', ' ') ?> $</span>
        </div>
        <div class="d-flex justify-content-between mb-3" style="font-size:0.93rem;">
            <span class="text-muted-uk">Livraison</span>
            <?php if ($livraison == 0): ?>
                <span style="color:var(--uk-success); font-weight:700;">Gratuite ✓</span>
            <?php else: ?>
                <span><?= number_format($livraison, 2, ',', ' ') ?> $</span>
            <?php endif; ?>
        </div>

        <hr style="border-color:var(--uk-border); margin:16px 0;">

        <div class="d-flex justify-content-between align-items-center">
            <span style="font-weight:800; font-size:1.05rem;">Total</span>
            <span class="badge-prix" style="font-size:1.15rem; padding:8px 18px;">
                <?= number_format($total_final, 2, ',', ' ') ?> $
            </span>
        </div>
    </div>

    <!-- Infos livraison -->
    <div class="mb-4 p-4" style="background:var(--uk-white); border:1px solid var(--uk-border); border-radius:14px;">
        <h5 style="font-weight:800; margin-bottom:16px; letter-spacing:-0.3px;">Livraison</h5>
        <?php
        $stmt = $connexion->prepare("SELECT address, ville, code_postal, pays FROM utilisateurs WHERE id = ?");
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        ?>
        <p class="text-muted-uk mb-1" style="font-size:0.9rem;">
            <i class="bi bi-person me-2"></i><?= htmlspecialchars($_SESSION['user_nom'] ?? '') ?>
        </p>
        <?php if (!empty($user['address'])): ?>
        <p class="text-muted-uk mb-0" style="font-size:0.9rem;">
            <i class="bi bi-geo-alt me-2"></i>
            <?= htmlspecialchars($user['address']) ?>,
            <?= htmlspecialchars($user['ville']) ?>
            <?= htmlspecialchars($user['code_postal']) ?>,
            <?= htmlspecialchars($user['pays']) ?>
        </p>
        <?php else: ?>
        <p class="text-muted-uk mb-0" style="font-size:0.9rem;">
            <i class="bi bi-info-circle me-2"></i>Aucune adresse enregistrée.
        </p>
        <?php endif; ?>
    </div>

    <!-- Paiement PayPal -->
    <div class="p-4" style="background:var(--uk-white); border:1px solid var(--uk-border); border-radius:14px;">
        <h5 style="font-weight:800; margin-bottom:20px; letter-spacing:-0.3px;">Méthode de paiement</h5>
        <div id="paypal-button-container"></div>
    </div>

    <div class="text-center mt-4">
        <a href="/dashboard/boutique/panier.php" class="text-muted-uk text-decoration-none" style="font-size:0.85rem;">
            ← Retour au panier
        </a>
    </div>

</div>

<script src="https://www.paypal.com/sdk/js?client-id=<?= PAYPAL_CLIENT_ID ?>&currency=CAD"></script>
<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{ amount: { value: "<?= number_format($total_final, 2, '.', '') ?>" } }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                alert('Paiement réussi ! Merci, ' + details.payer.name.given_name + '.');
                window.location.href = "/dashboard/boutique/home.php";
            });
        },
        onError: function(err) {
            console.error('Erreur PayPal :', err);
            alert("Le paiement a échoué. Veuillez réessayer.");
        }
    }).render('#paypal-button-container');
</script>

<?php require_once 'includes/footer.php'; ?>
