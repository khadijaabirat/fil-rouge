# ⚡ Installation Rapide - AL-KHAIR

## 🚀 Installation en 5 Minutes

### 1. Cloner et Installer

```bash
git clone https://github.com/votre-repo/alkhair.git
cd alkhair
composer install
npm install
```

### 2. Configuration

```bash
cp .env.example .env
php artisan key:generate
```

Modifier `.env`:

```env
DB_DATABASE=alkhair
DB_USERNAME=root
DB_PASSWORD=

STRIPE_KEY=pk_test_votre_cle
STRIPE_SECRET=sk_test_votre_cle
```

### 3. Base de Données

```bash
php artisan migrate
php artisan db:seed
```

### 4. Lancer le Projet

```bash
# Terminal 1: Serveur Laravel
php artisan serve

# Terminal 2: Queue Worker
php artisan queue:work

# Terminal 3: Assets (optionnel)
npm run dev
```

### 5. Accéder à l'Application

- **URL**: http://localhost:8000
- **Admin**: admin@alkhair.ma / password
- **Association**: association@test.ma / password
- **Donateur**: donator@test.ma / password

---

## 📝 Commandes Utiles

```bash
# Tests
php artisan test

# Cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimisation
php artisan optimize
composer dump-autoload

# Vérifier les projets expirés
php artisan projects:check-expired

# Build assets
npm run build
```

---

## 🔧 Dépannage

### Erreur de Permission

```bash
chmod -R 775 storage bootstrap/cache
```

### Erreur de Base de Données

```bash
php artisan migrate:fresh --seed
```

### Erreur Stripe

Vérifier que les clés Stripe sont correctes dans `.env`

---

## 📚 Documentation Complète

- [README.md](README.md) - Documentation complète
- [DEPLOYMENT.md](DEPLOYMENT.md) - Guide de déploiement

---

**Développé avec ❤️ pour le Maroc 🇲🇦**
