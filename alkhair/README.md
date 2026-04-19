# 🌟 AL-KHAIR - Plateforme Solidaire de Collecte de Dons

![Laravel](https://img.shields.io/badge/Laravel-11-red)
![PHP](https://img.shields.io/badge/PHP-8.1+-blue)
![Tests](https://img.shields.io/badge/Tests-30+-green)
![License](https://img.shields.io/badge/License-MIT-yellow)

## 📖 À propos

AL-KHAIR est une plateforme web solidaire qui connecte les donateurs avec des associations marocaines locales, garantissant une transparence totale sur l'utilisation des dons grâce à un suivi rigoureux et traçable de leur cycle de vie.

### 🎯 Objectifs

- ✅ Faciliter la collecte de dons en ligne
- ✅ Garantir la traçabilité complète des dons
- ✅ Offrir une transparence totale à tous les acteurs
- ✅ Centraliser la gestion des associations, projets et dons

---

## ✨ Fonctionnalités Principales

### Pour les Donateurs
- 🎁 Effectuer des dons (minimum 100 DH)
- 🕵️ Option de don anonyme
- 💬 Ajouter des messages d'encouragement
- 📄 Télécharger des reçus PDF
- 📊 Suivre l'historique des dons
- 🔔 Recevoir des notifications en temps réel

### Pour les Associations
- 📝 Inscription avec vérification KYC
- 🚀 Créer et gérer des projets
- 💰 Suivre les dons reçus
- 📈 Publier des rapports d'impact
- 💳 Demander le retrait des fonds
- 🔔 Notifications sur les mises à jour

### Pour les Administrateurs
- ✅ Valider les comptes associations
- 🔍 Vérifier les dons manuels
- 🛡️ Modérer les contenus
- 📊 Accéder aux statistiques globales
- 🚫 Suspendre/Bannir des comptes

---

## 🛠️ Technologies Utilisées

### Backend
- **PHP 8.1+** - Langage de programmation
- **Laravel 11** - Framework MVC
- **MySQL** - Base de données
- **Eloquent ORM** - Gestion des données

### Frontend
- **Blade Templates** - Moteur de templates
- **Tailwind CSS** - Framework CSS
- **JavaScript** - Interactivité
- **Alpine.js** - Composants réactifs

### Outils & Services
- **Stripe** - Paiement en ligne (simulation)
- **DomPDF** - Génération de PDF
- **Laravel Queue** - Gestion des tâches asynchrones
- **Laravel Scheduler** - Tâches planifiées
- **PHPUnit/Pest** - Tests automatisés

---

## 📦 Installation

### Prérequis
- PHP >= 8.1
- Composer
- MySQL
- Node.js & NPM

### Étapes d'installation

```bash
# 1. Cloner le projet
git clone https://github.com/votre-repo/alkhair.git
cd alkhair

# 2. Installer les dépendances PHP
composer install

# 3. Installer les dépendances JavaScript
npm install

# 4. Copier le fichier d'environnement
cp .env.example .env

# 5. Générer la clé d'application
php artisan key:generate

# 6. Configurer la base de données dans .env
DB_DATABASE=alkhair
DB_USERNAME=root
DB_PASSWORD=

# 7. Exécuter les migrations
php artisan migrate

# 8. Exécuter les seeders (optionnel)
php artisan db:seed

# 9. Créer le lien symbolique pour le storage
php artisan storage:link

# 10. Compiler les assets
npm run build

# 11. Démarrer le serveur
php artisan serve
```

---

## ⚙️ Configuration

### Configuration Email (.env)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=votre-email@gmail.com
MAIL_PASSWORD=votre-mot-de-passe-app
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=votre-email@gmail.com
MAIL_FROM_NAME="AL-KHAIR"
```

### Configuration Stripe (.env)
```env
STRIPE_KEY=pk_test_votre_cle_publique
STRIPE_SECRET=sk_test_votre_cle_secrete
```

### Configuration Queue (.env)
```env
QUEUE_CONNECTION=database
```

### Configuration Cache (.env)
```env
CACHE_DRIVER=file  # ou redis pour de meilleures performances
```

---

## 🚀 Utilisation

### Démarrer le serveur de développement
```bash
php artisan serve
```

### Démarrer le worker de queue
```bash
php artisan queue:work
```

### Exécuter le scheduler (en production)
Ajouter dans crontab:
```bash
* * * * * cd /chemin-vers-projet && php artisan schedule:run >> /dev/null 2>&1
```

### Vérifier les projets expirés manuellement
```bash
php artisan projects:check-expired
```

---

## 🧪 Tests

### Exécuter tous les tests
```bash
php artisan test
```

### Exécuter des tests spécifiques
```bash
php artisan test --filter AuthenticationTest
```

### Exécuter avec couverture
```bash
php artisan test --coverage
```

### Tests disponibles (30+ tests)
- ✅ AuthenticationTest (5 tests)
- ✅ DonationTest (5 tests)
- ✅ ProjectTest (5 tests)
- ✅ AdminTest (5 tests)
- ✅ AssociationTest (5 tests)
- ✅ SearchTest (4 tests)
- ✅ NotificationTest (2 tests)

---

## 📁 Structure du Projet

```
alkhair/
├── app/
│   ├── Console/
│   │   └── Commands/          # Commandes Artisan
│   ├── Http/
│   │   ├── Controllers/       # Contrôleurs
│   │   ├── Middleware/        # Middlewares
│   │   └── Requests/          # Form Requests
│   ├── Models/                # Modèles Eloquent
│   ├── Notifications/         # Notifications
│   ├── Observers/             # Observers
│   ├── Policies/              # Policies
│   ├── Repositories/          # Repositories
│   └── Services/              # Services
├── database/
│   ├── factories/             # Factories
│   ├── migrations/            # Migrations
│   └── seeders/               # Seeders
├── resources/
│   ├── views/                 # Vues Blade
│   └── css/                   # Styles
├── routes/
│   ├── web.php                # Routes web
│   └── auth.php               # Routes authentification
├── tests/
│   └── Feature/               # Tests fonctionnels
└── storage/
    └── app/
        ├── public/            # Fichiers publics
        └── private/           # Fichiers privés (KYC)
```

---

## 🔐 Sécurité

### Mesures de sécurité implémentées
- ✅ Protection CSRF
- ✅ Protection XSS
- ✅ Protection SQL Injection
- ✅ Hashage des mots de passe (Bcrypt)
- ✅ Vérification d'email obligatoire
- ✅ Middleware d'authentification
- ✅ RBAC (Role-Based Access Control)
- ✅ Validation des fichiers uploadés
- ✅ SoftDeletes pour l'intégrité des données

---

## 📊 Statistiques du Projet

- **Lignes de code**: ~15,000+
- **Fichiers**: 150+
- **Tests**: 30+
- **Couverture**: 40%+
- **Modèles**: 7
- **Controllers**: 10+
- **Migrations**: 10+
- **Services**: 5+
- **Repositories**: 2+

---

## 🤝 Contribution

Les contributions sont les bienvenues! Veuillez suivre ces étapes:

1. Fork le projet
2. Créer une branche (`git checkout -b feature/AmazingFeature`)
3. Commit vos changements (`git commit -m 'Add AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

---

## 📝 Licence

Ce projet est sous licence MIT. Voir le fichier [LICENSE](LICENSE) pour plus de détails.

---

## 👥 Auteurs

- **Votre Nom** - Développeur Principal

---

## 📞 Contact

- **Email**: contact@alkhair.ma
- **Site Web**: https://alkhair.ma
- **GitHub**: https://github.com/votre-username

---

## 🙏 Remerciements

- Laravel Framework
- Tailwind CSS
- Stripe
- Tous les contributeurs open-source

---

## 📸 Captures d'écran

### Page d'accueil
![Home](screenshots/home.png)

### Tableau de bord Donateur
![Donator Dashboard](screenshots/donator-dashboard.png)

### Tableau de bord Association
![Association Dashboard](screenshots/association-dashboard.png)

### Tableau de bord Admin
![Admin Dashboard](screenshots/admin-dashboard.png)

---

**Développé avec ❤️ pour le Maroc**
