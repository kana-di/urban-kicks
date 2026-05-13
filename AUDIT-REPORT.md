# AUDIT REPORT — Urban Kicks
> Généré le 2026-05-13 | Lecture seule — aucun fichier modifié

---

## RÉSUMÉ EN 5 LIGNES

Ce projet est dans un état **MAUVAIS pour la mise en production, MOYEN pour un CV de stage**.
Le cœur de l'application (catalogue, panier, ajout produit admin) existe et montre de bonnes intentions,
mais le code est parsemé de bugs bloquants : le login ne peut pas rediriger (headers already sent),
l'inscription stocke les mots de passe en clair alors que le login attend des hash,
et le fichier de détail produit est inaccessible à cause d'une virgule dans son nom.
**Avant de pousser sur GitHub**, 5 bugs critiques doivent être corrigés, sinon un recruteur qui clone le projet et le lance verra des pages blanches.

---

## PARTIE 1 — INVENTAIRE DES FICHIERS

| Fichier | Lignes | Rôle | Problèmes de nom |
|---|---|---|---|
| home.php | 397 | Page d'accueil principale | Aucun |
| home2.php | 424 | **RIEN** — template Bootstrap copié-collé | À supprimer |
| entete.php | 464 | **RIEN** — template Bootstrap copié-collé | À supprimer |
| login.php | 148 | Connexion utilisateur | Aucun |
| inscription.php | 141 | Création de compte | Aucun |
| traitement.php | 56 | Doublon de login (inutilisé) | À supprimer |
| utilisateurs.php | 57 | Doublon de login (inutilisé) | À supprimer |
| page_produits.php | 123 | Catalogue produits | Aucun |
| panier.php | 148 | Affichage du panier | Aucun |
| ajout_panier.php | 61 | Ajout au panier | Aucun |
| viderpanier.php | 32 | Vider le panier | Aucun |
| sup_produits.php | 42 | Supprimer items du panier | Aucun |
| teste.php | 42 | **DOUBLON** de sup_produits.php | À supprimer |
| pageadmin.php | 90 | Dashboard admin | Aucun |
| ajout_produits_admin.php | 125 | Formulaire ajout produit | Aucun |
| ajout_produitsssss.php | 88 | Script de seeding BD (à usage unique) | **Nom avec "sssss"** |
| paiment.php | 27 | Page paiement | **Faute : "paiment" → "paiement"** |
| avantagemembres.php | 72 | Page avantages membres | Aucun |
| basededonne.php | 17 | Connexion DB | **Faute : "basededonne"** |
| conbase | — | Doublon de basededonne.php | **Pas d'extension .php** |
| detail_produits,php | ~31 | Détail d'un produit | **VIRGULE au lieu de point !** |

### Fichiers SUSPECTS détaillés

**home.php vs home2.php :**
- `home.php` = vraie page d'accueil Urban Kicks avec navbar, hero vidéo, produits hardcodés, footer complet.
- `home2.php` = template "Album example" Bootstrap copié-collé mot pour mot depuis la doc officielle Bootstrap. Aucun lien Urban Kicks. Titre : "Album example · Bootstrap v5.3". **Jamais référencé nulle part. À supprimer.**

**teste.php :**
- Contenu identique à 100% à `sup_produits.php`. C'est une copie de test oubliée. **Jamais référencé nulle part. À supprimer.**

**ajout_produitsssss.php vs ajout_produits_admin.php :**
- `ajout_produits_admin.php` = page admin avec formulaire HTML pour ajouter UN produit.
- `ajout_produitsssss.php` = script PHP pur (sans HTML) qui insère des produits en dur dans un tableau PHP. C'est un script de seeding (pour peupler la BD une fois). **Jamais lié depuis aucune page. À conserver temporairement pour créer les données de démo, puis supprimer.**

---

## PARTIE 2 — DÉPENDANCES

### Qui utilise quoi

| Fichier | Utilise (liens/redirections/forms) |
|---|---|
| home.php | page_produits.php, login.php, panier.php, avantagemembres.php, `votre_script_de_traitement.php` (**INEXISTANT**) |
| page_produits.php | home.php, login.php, inscription.php, ajout_panier.php, `detail_produits.php` (**INEXISTANT** — le vrai est `detail_produits,php`) |
| login.php | → home.php (user), → ajout_produits_admin.php (admin) |
| inscription.php | login.php, `conditions_utilisation.html` (**INEXISTANT**) |
| panier.php | page_produits.php, viderpanier.php, paiment.php, sup_produits.php |
| ajout_panier.php | → panier.php |
| viderpanier.php | → panier.php |
| sup_produits.php | → panier.php |
| pageadmin.php | ajout_produits_admin.php |
| ajout_produits_admin.php | → ajout_produits_admin.php (self-redirect) |
| traitement.php | → login.php (mais n'est jamais appelé) |
| utilisateurs.php | → login.php (mais n'est jamais appelé) |

### Graphe des références RÉELLES (qui pointe vers qui)

```
home.php ──────────────────► page_produits.php
                          ► login.php
                          ► panier.php
                          ► avantagemembres.php
                          ► votre_script_de_traitement.php [404]

page_produits.php ─────────► ajout_panier.php
                          ► detail_produits.php [404 — virgule dans le nom]
                          ► login.php, home.php, inscription.php

login.php ─────────────────► home.php (si user)
                          ► ajout_produits_admin.php (si admin)

inscription.php ───────────► login.php
                          ► conditions_utilisation.html [404]

panier.php ────────────────► sup_produits.php
                          ► viderpanier.php
                          ► paiment.php

pageadmin.php ─────────────► ajout_produits_admin.php
```

### Fichiers ORPHELINS (jamais référencés)

| Fichier | Verdict |
|---|---|
| home2.php | À SUPPRIMER |
| entete.php | À SUPPRIMER |
| traitement.php | À SUPPRIMER |
| utilisateurs.php | À SUPPRIMER |
| teste.php | À SUPPRIMER |
| ajout_produitsssss.php | À garder en local pour seeding, NE PAS pousser sur GitHub |
| conbase | À SUPPRIMER (doublon sans extension) |

---

## PARTIE 3 — ANALYSE DES PAGES (PRÉDICTION DE BUGS)

### home.php — ⚠️ MARCHE PARTIELLEMENT

- **Requêtes SQL :** Aucune (produits hardcodés en HTML statique)
- **Bugs détectés :**
  - CSS `margin-right: px;` → valeur invalide (silencieusement ignorée)
  - CSS `transform: ;` → valeur invalide (ignorée)
  - `<object-position: contain>` → invalide (devrait être `center`)
  - `</h>` au lieu de `</h5>` (2 occurrences) → HTML invalide
  - Form newsletter → `action="votre_script_de_traitement.php"` → **404 garanti**
  - Images produits hardcodées avec URLs Nike CDN → peuvent tomber en 404 n'importe quand
  - Logo en base64 inline (65 lignes de base64 dans le HTML) → mauvaise pratique

### page_produits.php — ❌ BUG DÈS L'OUVERTURE

- **Requêtes SQL :** `SELECT product_id, name, price, image_url, description FROM produits`
- **Tables :** `produits`
- **Bugs détectés :**
  - Ligne 1 : `!<DOCTYPE html>` → manque le `<` → le navigateur reçoit `!` comme texte brut avant le DOCTYPE
  - Lien "Voir Détails" → `detail_produits.php?id=X` → fichier inexistant (le vrai s'appelle `detail_produits,php`) → **404 à chaque clic**
  - Bootstrap 4 (stackpath CDN) ici vs Bootstrap 5 ailleurs → incohérence visuelle

### login.php — ❌ BUG CRITIQUE

- **Requêtes SQL :** `SELECT * FROM utilisateurs WHERE email = ?` (requête préparée ✓)
- **Bugs détectés :**
  - Tout le HTML est envoyé AVANT le code PHP → `header("location:home.php")` échouera avec **"headers already sent"** → redirection impossible
  - `session_start()` absent → session non initialisée → la redirection admin/user ne fonctionne pas
  - Le champ `code_admin` est affiché dans le formulaire mais ignoré par le PHP

### inscription.php — ❌ BUG CRITIQUE (double)

- **Requêtes SQL :** `INSERT INTO utilisateurs (nom,email,password,address,ville,code_postal,pays) VALUES (?, ?, ?, ?, ?, ?, ?)`
- **Bugs détectés :**
  - HTML envoyé AVANT le PHP → même problème headers already sent
  - **Variable `$adresse` inexistante** : la variable PHP est `$address` mais bind_param passe `$adresse` → **undefined variable** → NULL inséré en BD
  - **Mot de passe stocké EN CLAIR** : aucun `password_hash()` → la colonne reçoit le mot de passe tel quel
  - Or `login.php` utilise `password_verify()` qui attend un hash bcrypt → **les comptes créés via inscription ne peuvent JAMAIS se connecter**
  - `</html>` en double (lignes 117 et 121)
  - Le rôle sélectionné ('admin'/'client') est dans le POST mais jamais inséré en BD

### panier.php — ⚠️ MARCHE SI L'UTILISATEUR HARDCODÉ EXISTE

- **Requêtes SQL :**
  - `SELECT user_id FROM utilisateurs WHERE email = ?`
  - `SELECT p.product_id, p.name, p.price, pa.quantite FROM panier pa JOIN produits p ON pa.product_id = p.product_id WHERE pa.user_id = ?`
- **Tables :** `utilisateurs`, `panier`, `produits`
- **Bugs détectés :**
  - Email hardcodé `thiernooumar4434@gmail.com` → si pas en BD → page blanche avec erreur
  - `$_SESSION['user_id']` est set depuis panier.php (contourne la vraie auth)
  - Credentials PayPal sandbox exposés publiquement (ligne 133)
  - Symbole `$` pour le total (ligne 110) mais `€` pour les prix individuels → incohérence

### pageadmin.php — ⚠️ MARCHE MAIS DANGEREUX

- **Requêtes SQL :** Aucune
- **Bugs détectés :**
  - **Aucune vérification de session** → n'importe qui peut accéder à `http://localhost/dashboard/boutique/pageadmin.php`
  - `onclick="alert('Ajouter des produits')"` → comportement bizarre UX (alert avant navigation)

### detail_produits,php — ❌ INACCESSIBLE

- **Requêtes SQL :** `SELECT * FROM produits WHERE product_id = $product_id` (**injection SQL**)
- **Bugs détectés :**
  - **Nom du fichier avec virgule** → Apache ne peut pas accéder à ce fichier via URL (la virgule n'est pas un séparateur d'extension valide)
  - `page_produits.php` pointe vers `detail_produits.php` (avec point) → double 404
  - Injection SQL ligne 20 : bien que `intval()` protège pour les entiers, la requête est construite par concaténation directe → mauvaise pratique
  - Fichier incomplet (coupé à la ligne 31, pas de HTML affiché)

### paiment.php — ❌ CASSÉ COMPLÈTEMENT

- **Requêtes SQL :** Aucune
- **Bugs détectés :**
  - `<?= $total ?>` → `$total` n'existe pas dans ce fichier → affiche `0` ou erreur PHP
  - Le JS a une **virgule après `})`** → erreur JavaScript → bouton PayPal ne s'affiche pas
  - Titre "Document" (jamais modifié)
  - Pas de CSS, pas de navbar → page vide à part le bouton cassé

---

## PARTIE 4 — BASE DE DONNÉES

**Connexion :**
- Méthode : `mysqli_connect()` (procédural)
- Serveur : `localhost`, user : `root`, password : `""` (vide)
- Base : `boutique`
- **Encodage UTF-8 : NON CONFIGURÉ** — aucun `mysqli_set_charset($connexion, 'utf8mb4')` → risque de problèmes avec les accents

**Tables référencées dans le code :**

| Table | Référencée dans | Colonnes utilisées |
|---|---|---|
| `utilisateurs` | login, inscription, panier, ajout_panier, traitement, utilisateurs | id / user_id (CONFLIT !), nom, email, password, address, ville, code_postal, pays, role |
| `produits` | page_produits, detail_produits, ajout_produits_admin, ajout_produitsssss | product_id, category_id, name, description, price, stock, brand, tailles, image_url |
| `produits_images` | ajout_produits_admin, ajout_produitsssss | product_id, image_url |
| `panier` | panier, ajout_panier, viderpanier, sup_produits | user_id, product_id, quantite |
| `categories` | Implicite via category_id dans produits | Non lue directement |

**CONFLIT CRITIQUE :** `login.php` stocke `$_SESSION['user_id'] = $row['id']` mais `panier.php` cherche `SELECT user_id FROM utilisateurs WHERE email = ?`. Si la colonne s'appelle `id` dans la BD, panier.php retourne NULL et plante.

**Aucun fichier .sql trouvé** → impossible de recréer la BD depuis le repo.

---

## PARTIE 5 — SÉCURITÉ

| # | Problème | Fichier | Sévérité |
|---|---|---|---|
| 1 | **Mots de passe stockés EN CLAIR** | inscription.php ligne 156 | 🔴 CRITIQUE |
| 2 | **session_start() manquant** | login.php, traitement.php | 🔴 CRITIQUE |
| 3 | **Aucune protection des pages admin** | pageadmin.php, ajout_produits_admin.php | 🔴 CRITIQUE |
| 4 | **Injection SQL** | detail_produits,php ligne 20 | 🟠 ÉLEVÉ |
| 5 | **Credentials PayPal sandbox exposés** | panier.php L133, paiment.php L14 | 🟠 ÉLEVÉ |
| 6 | **Email personnel hardcodé** | ajout_panier.php L16, panier.php L16 | 🟡 MOYEN |
| 7 | **Emails réels dans le footer** | home.php L457-458 | 🟡 MOYEN |
| 8 | **Pas d'encodage UTF-8** | basededonne.php et tous les fichiers de connexion | 🟡 MOYEN |
| 9 | XSS : `echo $message` sans htmlspecialchars | ajout_produits_admin.php L109 | 🟡 MOYEN |

---

## PARTIE 6 — RAPPORT FINAL

### Top 5 des fichiers à renommer en priorité

| Actuel | Nouveau nom |
|---|---|
| `detail_produits,php` | `detail_produit.php` (virgule → point) |
| `paiment.php` | `paiement.php` (correction faute) |
| `basededonne.php` | `db.php` (court, standard) |
| `ajout_produitsssss.php` | `seed_produits.php` (intent clair) ou supprimer |
| `conbase` | Supprimer (doublon sans extension) |

### Top 5 des bugs probables à la première démo

1. **Login bloqué** — `headers already sent` → l'utilisateur clique "Se connecter", rien ne se passe
2. **Inscription inutilisable** — même bug headers + mot de passe en clair = compte créé mais login impossible
3. **Detail produit 404** — chaque clic "Voir Détails" sur page_produits.php → page Not Found
4. **Panier vide si l'email hardcodé n'est pas en BD** — page blanche avec "L'utilisateur par défaut n'existe pas"
5. **Page paiement cassée** — `$total` undefined + JS invalide → bouton PayPal invisible

### Top 5 des fichiers à supprimer

| Fichier | Raison |
|---|---|
| home2.php | Template Bootstrap copié, jamais utilisé |
| entete.php | Template Bootstrap copié, jamais utilisé |
| traitement.php | Doublon de login.php, jamais appelé |
| utilisateurs.php | Doublon de traitement.php, jamais appelé |
| teste.php | Copie exacte de sup_produits.php |

**Bonus :** `conbase` (doublon sans extension), et `ajout_produitsssss.php` à ne pas pousser sur GitHub.

### Structure de dossiers cible recommandée

```
boutique/
├── index.php              (anciennement home.php)
├── produits.php           (anciennement page_produits.php)
├── detail_produit.php     (anciennement detail_produits,php — renommé)
├── login.php
├── inscription.php
├── panier.php
├── paiement.php           (anciennement paiment.php — corrigé)
├── avantages-membres.php
│
├── admin/
│   ├── dashboard.php      (anciennement pageadmin.php)
│   └── ajouter-produit.php (anciennement ajout_produits_admin.php)
│
├── actions/               (scripts sans HTML, appelés par formulaires)
│   ├── ajout_panier.php
│   ├── vider_panier.php
│   └── sup_panier.php
│
├── includes/
│   └── db.php             (anciennement basededonne.php)
│
├── image/
└── AUDIT-REPORT.md
```

### Estimation honnête du temps de refactor

| Phase | Durée estimée |
|---|---|
| Supprimer les fichiers orphelins + renommer | 15 min |
| Corriger les 5 bugs critiques (headers, hash, session, 404 detail, $total) | 2–3h |
| Créer le fichier SQL de la BD (pour GitHub) | 1h |
| Ajouter la protection des pages admin | 30 min |
| Retirer les emails/credentials hardcodés | 20 min |
| **Total minimum pour un CV présentable** | **~4–5h** |

---

## CHECKLIST DE TESTS NAVIGATEUR

Lance ces URLs dans Chrome **dans cet ordre** après avoir démarré Apache+MySQL et créé la BD :

### Test 1 — Page d'accueil
```
http://localhost/dashboard/boutique/home.php
```
**Devrait afficher :** Page Urban Kicks avec vidéo en fond, navbar, section produits hardcodés.
**Si tu vois :** Page blanche → Apache non démarré.
**Bug connu :** Le formulaire newsletter renvoie 404, c'est normal (bug documenté).

### Test 2 — Catalogue produits
```
http://localhost/dashboard/boutique/page_produits.php
```
**Devrait afficher :** Liste des produits avec images depuis la BD.
**Si tu vois :** "Aucun produit trouvé" → BD vide → normal si pas de données.
**Bug connu :** Le DOCTYPE est `!<DOCTYPE` (affiché comme texte) — visible dans le code source.

### Test 3 — Inscription
```
http://localhost/dashboard/boutique/inscription.php
```
**Devrait afficher :** Formulaire d'inscription.
**Si tu vois :** "Entrée réussi" après soumission → compte créé, MAIS mot de passe en clair.
**Bug connu :** Le compte créé ici ne pourra PAS se connecter (bug critique documenté).

### Test 4 — Login
```
http://localhost/dashboard/boutique/login.php
```
**Devrait afficher :** Formulaire de connexion.
**Si tu vois après connexion :** Page blanche avec "headers already sent" → bug critique confirmé.
**Ce qui devrait arriver (pas encore fonctionnel) :** Redirection vers home.php.

### Test 5 — Panier
```
http://localhost/dashboard/boutique/panier.php
```
**Devrait afficher :** Table du panier (vide ou avec produits).
**Si tu vois :** "L'utilisateur par défaut n'existe pas" → créer un user avec l'email `thiernooumar4434@gmail.com` en BD.
**Bug connu :** Email hardcodé, à corriger.

### Test 6 — Admin (accessible sans login !)
```
http://localhost/dashboard/boutique/pageadmin.php
```
**Devrait afficher :** Page "Bienvenue Admin" avec bouton "Ajouter des produits".
**Si tu vois :** Cette page → confirme la faille : TOUT LE MONDE peut y accéder.
**Bug connu :** Aucune protection de session — bug sécurité documenté.

### Test 7 — Ajout produit admin
```
http://localhost/dashboard/boutique/ajout_produits_admin.php
```
**Devrait afficher :** Formulaire d'ajout produit avec "BIENVENUE CHER ADMIN".
**Test :** Remplis le formulaire et soumets → devrait ajouter un produit en BD.
**Si tu vois :** "Produit ajouté avec succès!" → cette fonctionnalité marche.

### Test 8 — Détail produit (bug attendu)
```
http://localhost/dashboard/boutique/detail_produits.php?id=1
```
**Devrait afficher :** Détail d'un produit.
**Ce que tu vas voir :** Erreur 404 → bug confirmé (le fichier s'appelle `detail_produits,php` avec une virgule).

---

## VERDICT FINAL

> **"Attention, voici les pièges"**

Le projet **ne peut pas être lancé tel quel** devant un recruteur sans corrections préalables.
Les 3 problèmes qui feront fuir un recruteur technique :
1. Le login renvoie une page blanche au lieu de rediriger
2. Les comptes créés à l'inscription ne peuvent jamais se connecter
3. Il n'y a pas de fichier SQL → le recruteur ne peut pas tester le projet

**Lance le refactor. Commence par les bugs 1, 2 et 3 ci-dessus — ça prend 2h et ça rend le projet démontrable.**
