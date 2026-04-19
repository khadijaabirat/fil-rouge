# 🔧 Documentation Technique - AL-KHAIR

## Table des Matières

1. [Architecture](#architecture)
2. [Base de Données](#base-de-données)
3. [API Interne](#api-interne)
4. [Services](#services)
5. [Tests](#tests)
6. [Sécurité](#sécurité)

---

## 1. Architecture

### 1.1 Pattern MVC

```
┌─────────────┐
│   Routes    │ ← Définition des routes
└──────┬──────┘
       │
┌──────▼──────┐
│ Controllers │ ← Logique de contrôle
└──────┬──────┘
       │
┌──────▼──────┐
│  Services   │ ← Logique métier
└──────┬──────┘
       │
┌──────▼──────┐
│Repositories │ ← Accès aux données
└──────┬──────┘
       │
┌──────▼──────┐
│   Models    │ ← Modèles Eloquent
└──────┬──────┘
       │
┌──────▼──────┐
│  Database   │ ← MySQL
└─────────────┘
```

### 1.2 Structure des Dossiers

```
app/
├── Console/
│   ├── Commands/              # Commandes Artisan personnalisées
│   └── Kernel.php            # Scheduler
├── Http/
│   ├── Controllers/          # Contrôleurs
│   │   ├── Auth/            # Authentification
│   │   ├── AdminController.php
│   │   ├── AssociationController.php
│   │   ├── DonationController.php
│   │   ├── DonatorController.php
│   │   ├── HomeController.php
│   │   ├── ImpactReportController.php
│   │   ├── PdfController.php
│   │   └── ProjectController.php
│   ├── Middleware/          # Middlewares
│   │   ├── CheckBannedUser.php
│   │   └── CheckRole.php
│   └── Requests/            # Form Requests
│       ├── RegisterUserRequest.php
│       ├── StoreProjectRequest.php
│       ├── StoreDonationRequest.php
│       └── StoreImpactReportRequest.php
├── Models/                  # Modèles Eloquent
│   ├── User.php
│   ├── Project.php
│   ├── Donation.php
│   ├── Payment.php
│   ├── ImpactReport.php
│   └── Category.php
├── Notifications/           # Notifications
│   ├── DonationStatusChanged.php
│   ├── AssociationStatusChanged.php
│   └── ImpactReportPublished.php
├── Observers/              # Observers
│   └── ProjectObserver.php
├── Policies/               # Policies
│   └── ProjectPolicy.php
├── Repositories/           # Repositories
│   ├── Interfaces/
│   │   ├── ProjectRepositoryInterface.php
│   │   └── DonationRepositoryInterface.php
│   ├── ProjectRepository.php
│   └── DonationRepository.php
└── Services/               # Services
    ├── CacheService.php
    ├── DonationService.php
    ├── PdfService.php
    └── ProjectSearchService.php
```

---

## 2. Base de Données

### 2.1 Schéma

#### Table: users
```sql
id                  BIGINT UNSIGNED PRIMARY KEY
name                VARCHAR(255)
email               VARCHAR(255) UNIQUE
email_verified_at   TIMESTAMP NULL
password            VARCHAR(255)
phone               VARCHAR(255) NULL
profilePhoto        VARCHAR(255) NULL
role                ENUM('admin', 'donator', 'association')
ville               VARCHAR(255) NULL
licenseNumber       VARCHAR(255) NULL
address             VARCHAR(255) NULL
rib                 VARCHAR(255) NULL
description         TEXT NULL
documentKYC         VARCHAR(255) NULL
status              ENUM('PENDING', 'ACTIVE', 'BANNED') NULL
category_id         BIGINT UNSIGNED NULL
remember_token      VARCHAR(100) NULL
created_at          TIMESTAMP
updated_at          TIMESTAMP
deleted_at          TIMESTAMP NULL
```

#### Table: projects
```sql
id                  BIGINT UNSIGNED PRIMARY KEY
title               VARCHAR(255)
description         TEXT
goalAmount          DECIMAL(12,2)
currentAmount       DECIMAL(12,2) DEFAULT 0
videoUrl            VARCHAR(255) NULL
startDate           DATETIME
endDate             DATETIME
status              ENUM('OPEN','CLOSED','COMPLETED','SUSPENDED')
association_id      BIGINT UNSIGNED FOREIGN KEY
category_id         BIGINT UNSIGNED FOREIGN KEY
created_at          TIMESTAMP
updated_at          TIMESTAMP
deleted_at          TIMESTAMP NULL
```

#### Table: donations
```sql
id                  BIGINT UNSIGNED PRIMARY KEY
amount              DECIMAL(12,2)
message             VARCHAR(500) NULL
donationDate        DATETIME
isAnonymous         BOOLEAN DEFAULT FALSE
status              ENUM('PENDING','VALIDATED','PROCESSING','RECEIVED','IMPACT')
donator_id          BIGINT UNSIGNED NULL FOREIGN KEY
project_id          BIGINT UNSIGNED FOREIGN KEY
created_at          TIMESTAMP
updated_at          TIMESTAMP
```

#### Table: payments
```sql
id                  BIGINT UNSIGNED PRIMARY KEY
transactionId       VARCHAR(255) UNIQUE NULL
paymentMethod       ENUM('ONLINE', 'MANUAL')
paymentReceipt      VARCHAR(255) NULL
amount              DECIMAL(15,2)
paymentDate         DATETIME NULL
status              ENUM('SUCCESS', 'FAILED', 'PENDING')
donation_id         BIGINT UNSIGNED FOREIGN KEY
created_at          TIMESTAMP
updated_at          TIMESTAMP
```

#### Table: impact_reports
```sql
id                  BIGINT UNSIGNED PRIMARY KEY
description         TEXT
completionDate      DATETIME
videoLink           VARCHAR(255) NULL
images              JSON NULL
project_id          BIGINT UNSIGNED FOREIGN KEY
created_at          TIMESTAMP
updated_at          TIMESTAMP
```

### 2.2 Relations

```
User (Association) ──┬─< Project ──┬─< Donation ──< Payment
                     │             │
                     │             └─< ImpactReport
                     │
User (Donator) ──────┴─< Donation

Category ──< Project
Category ──< User (Association)
```

---

## 3. API Interne

### 3.1 Routes Principales

#### Authentification
```php
POST   /register              # Inscription
POST   /login                 # Connexion
POST   /logout                # Déconnexion
GET    /verify-email/{id}/{hash}  # Vérification email
POST   /forgot-password       # Mot de passe oublié
POST   /reset-password        # Réinitialisation
```

#### Projets
```php
GET    /projets               # Liste des projets
GET    /projects/{id}         # Détails d'un projet
POST   /projects              # Créer un projet (Association)
PUT    /projects/{id}         # Modifier un projet (Association)
DELETE /projects/{id}         # Supprimer un projet (Association)
POST   /projects/{id}/extend  # Prolonger un projet (Association)
```

#### Dons
```php
GET    /projects/{id}/donate  # Formulaire de don
POST   /projects/{id}/donate  # Effectuer un don
GET    /donations/{id}/success # Succès paiement Stripe
GET    /donations/{id}/cancel  # Annulation paiement
GET    /donations/{id}/receipt # Télécharger reçu PDF
```

#### Administration
```php
GET    /admin/dashboard                      # Tableau de bord
POST   /admin/association/{id}/validate      # Valider association
POST   /admin/association/{id}/ban           # Bannir association
POST   /admin/association/{id}/unban         # Débannir association
POST   /admin/donation/{id}/validate         # Valider don
POST   /admin/donation/{id}/reject           # Rejeter don
POST   /admin/project/{id}/suspend           # Suspendre projet
POST   /admin/project/{id}/restore           # Restaurer projet
POST   /admin/project/{id}/approve-withdrawal # Approuver retrait
```

---

## 4. Services

### 4.1 ProjectSearchService

**Responsabilité**: Recherche et filtrage des projets

**Méthodes**:
```php
public static function search(array $filters): Builder
```

**Filtres supportés**:
- `search`: Recherche textuelle (titre, description)
- `category_id`: Filtrage par catégorie
- `ville`: Filtrage par ville
- `sort`: Tri (urgent, recent, progress)

**Exemple**:
```php
$filters = [
    'search' => 'école',
    'category_id' => 2,
    'ville' => 'Rabat',
    'sort' => 'urgent'
];
$projects = ProjectSearchService::search($filters)->paginate(12);
```

### 4.2 DonationService

**Responsabilité**: Gestion de la logique métier des dons

**Méthodes**:
```php
public function createDonation(array $data)
public function validateDonation($donationId)
public function rejectDonation($donationId)
```

### 4.3 CacheService

**Responsabilité**: Gestion du cache

**Méthodes**:
```php
public function getStatistics()
public function getOpenProjects()
public function getCategories()
public function clearProjectCache()
public function clearStatisticsCache()
public function clearAllCache()
```

**TTL**: 1 heure (3600 secondes)

### 4.4 PdfService

**Responsabilité**: Génération de PDF

**Méthodes**:
```php
public function generateDonationReceipt(Donation $donation)
public function generateProjectReport(Project $project)
```

---

## 5. Tests

### 5.1 Structure

```
tests/
├── Feature/
│   ├── AuthenticationTest.php    # 5 tests
│   ├── DonationTest.php          # 5 tests
│   ├── ProjectTest.php           # 5 tests
│   ├── AdminTest.php             # 5 tests
│   ├── AssociationTest.php       # 5 tests
│   ├── SearchTest.php            # 4 tests
│   └── NotificationTest.php      # 2 tests
└── Unit/
    └── (à venir)
```

### 5.2 Exécution

```bash
# Tous les tests
php artisan test

# Tests spécifiques
php artisan test --filter AuthenticationTest

# Avec couverture
php artisan test --coverage
```

### 5.3 Couverture Actuelle

- **Total**: 31 tests
- **Couverture**: ~40%
- **Objectif**: 80%+

---

## 6. Sécurité

### 6.1 Mesures Implémentées

#### Authentification
- ✅ Hashage Bcrypt (cost: 12)
- ✅ Email Verification obligatoire
- ✅ Password Reset sécurisé
- ✅ Remember Token

#### Autorisation
- ✅ RBAC (Role-Based Access Control)
- ✅ Middleware CheckRole
- ✅ Middleware CheckBannedUser
- ✅ Policies (ProjectPolicy)
- ✅ Gates

#### Protection
- ✅ CSRF Protection (Laravel)
- ✅ XSS Protection (Blade escaping)
- ✅ SQL Injection Protection (Eloquent)
- ✅ Mass Assignment Protection (fillable)
- ✅ File Upload Validation
- ✅ Rate Limiting (Laravel default)

#### Données
- ✅ SoftDeletes (intégrité référentielle)
- ✅ Validation stricte (Form Requests)
- ✅ Sanitization automatique

### 6.2 Headers de Sécurité

```php
// À ajouter dans Middleware
X-Frame-Options: SAMEORIGIN
X-Content-Type-Options: nosniff
X-XSS-Protection: 1; mode=block
Strict-Transport-Security: max-age=31536000
```

### 6.3 Bonnes Pratiques

```php
// ✅ Bon
$user = User::find($id);
if ($user && $user->id === Auth::id()) {
    // Action autorisée
}

// ❌ Mauvais
$user = User::find($request->id);
$user->update($request->all());
```

---

## 📞 Contact Technique

**Email**: dev@alkhair.ma  
**Documentation**: https://docs.alkhair.ma

---

**Version**: 1.0  
**Dernière mise à jour**: Mars 2026
