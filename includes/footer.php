</div><!-- /padding-top wrapper -->

<footer class="py-5 mt-5" style="background:#0a0a0a; border-top:1px solid #1c1c1c;">
    <div class="container">
        <div class="row g-4 mb-4">
            <div class="col-lg-4 mb-2">
                <h5 class="fw-black mb-3" style="letter-spacing:-0.5px;">🥾 Urban Kicks</h5>
                <p style="color:#555; font-size:0.87rem; line-height:1.7; max-width:260px;">
                    Votre destination pour les sneakers premium. Éditions limitées, classiques et tendances.
                </p>
            </div>
            <div class="col-6 col-lg-2">
                <h6 class="fw-bold mb-3" style="font-size:0.78rem; letter-spacing:1.5px; text-transform:uppercase; color:#888;">Boutique</h6>
                <ul class="list-unstyled" style="font-size:0.87rem;">
                    <li class="mb-2"><a href="/dashboard/boutique/home.php">Accueil</a></li>
                    <li class="mb-2"><a href="/dashboard/boutique/produits.php">Produits</a></li>
                    <li class="mb-2"><a href="/dashboard/boutique/avantages-membres.php">Avantages</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-2">
                <h6 class="fw-bold mb-3" style="font-size:0.78rem; letter-spacing:1.5px; text-transform:uppercase; color:#888;">Compte</h6>
                <ul class="list-unstyled" style="font-size:0.87rem;">
                    <li class="mb-2"><a href="/dashboard/boutique/login.php">Connexion</a></li>
                    <li class="mb-2"><a href="/dashboard/boutique/inscription.php">S'inscrire</a></li>
                    <li class="mb-2"><a href="/dashboard/boutique/panier.php">Mon panier</a></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h6 class="fw-bold mb-3" style="font-size:0.78rem; letter-spacing:1.5px; text-transform:uppercase; color:#888;">Contact</h6>
                <p style="color:#555; font-size:0.87rem; margin-bottom:6px;">
                    <i class="bi bi-envelope me-2" style="color:#444;"></i>contact@urbankicks.ca
                </p>
                <p style="color:#555; font-size:0.87rem;">
                    <i class="bi bi-geo-alt me-2" style="color:#444;"></i>Montréal, QC, Canada
                </p>
            </div>
        </div>

        <div style="border-top:1px solid #1c1c1c; padding-top:24px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
            <p style="color:#333; font-size:0.78rem; margin:0;">
                © 2025 Urban Kicks · Projet académique · DEC Techniques de l'informatique, Institut Teccart
            </p>
            <p style="color:#333; font-size:0.78rem; margin:0;">
                Fait avec ❤️ à Montréal
            </p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Scroll animations -->
<script>
(function(){
    var observer = new IntersectionObserver(function(entries){
        entries.forEach(function(entry){
            if(entry.isIntersecting){
                entry.target.classList.add('uk-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });

    document.querySelectorAll('.uk-fade-up').forEach(function(el){
        observer.observe(el);
    });
})();
</script>

</body>
</html>
