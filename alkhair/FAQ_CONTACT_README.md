# 📝 FAQ & Contact - Documentation

## ✨ Nouvelles Fonctionnalités Ajoutées

### 1️⃣ Page FAQ (Questions Fréquentes)
**Route:** `/faq`  
**Controller:** `FaqController`  
**View:** `resources/views/faq.blade.php`

#### Fonctionnalités:
- ✅ Questions organisées par catégories
- ✅ Accordion interactif (Alpine.js)
- ✅ 4 catégories principales:
  - Général
  - Pour les Donateurs
  - Pour les Associations
  - Sécurité & Transparence
- ✅ CTA vers la page Contact
- ✅ Design responsive

#### Utilisation:
```php
// Accéder à la page FAQ
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
```

---

### 2️⃣ Formulaire de Contact
**Routes:** 
- GET `/contact` - Afficher le formulaire
- POST `/contact` - Envoyer le message

**Controller:** `ContactController`  
**View:** `resources/views/contact.blade.php`  
**Email Template:** `resources/views/emails/contact.blade.php`

#### Fonctionnalités:
- ✅ Formulaire de contact complet
- ✅ Validation des champs
- ✅ Envoi d'email à l'administration
- ✅ Messages de succès/erreur
- ✅ Informations de contact affichées
- ✅ Design responsive

#### Champs du formulaire:
- **Nom complet** (requis)
- **Email** (requis, format email)
- **Sujet** (requis)
- **Message** (requis, min 10 caractères)

#### Validation:
```php
'name' => 'required|string|max:255',
'email' => 'required|email',
'subject' => 'required|string|max:255',
'message' => 'required|string|min:10',
```

---

## 📁 Fichiers Créés

### Controllers
- `app/Http/Controllers/FaqController.php`
- `app/Http/Controllers/ContactController.php`

### Views
- `resources/views/faq.blade.php`
- `resources/views/contact.blade.php`
- `resources/views/emails/contact.blade.php`
- `resources/views/layouts/footer.blade.php`

### Mailable
- `app/Mail/ContactMessage.php`

### Tests
- `tests/Feature/FaqContactTest.php`

---

## 🚀 Configuration Requise

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

---

## 🧪 Tests

### Exécuter les tests
```bash
php artisan test --filter FaqContactTest
```

### Tests disponibles:
- ✅ test_faq_page_can_be_accessed
- ✅ test_contact_page_can_be_accessed
- ✅ test_contact_form_validation_works
- ✅ test_contact_form_can_be_submitted

---

## 🎨 Design

### Couleurs utilisées:
- **Primary:** #0A1128 (Bleu foncé)
- **Accent:** #F5A623 (Orange/Doré)
- **Background:** #F9FAFB (Gris clair)

### Composants:
- Material Symbols Icons
- Tailwind CSS
- Alpine.js (pour l'accordion FAQ)

---

## 📱 Responsive

Les deux pages sont entièrement responsive:
- ✅ Mobile (< 640px)
- ✅ Tablet (640px - 1024px)
- ✅ Desktop (> 1024px)

---

## 🔗 Liens dans le Footer

Le footer a été créé avec les liens vers:
- Accueil
- Projets
- Rapports d'Impact
- **FAQ** (nouveau)
- **Contact** (nouveau)

---

## 📊 Statistiques

- **Lignes de code ajoutées:** ~500+
- **Fichiers créés:** 8
- **Tests ajoutés:** 4
- **Routes ajoutées:** 3

---

**Développé avec ❤️ pour AL-KHAIR**
