# 🚀 Guide d'Installation Détaillé - AL-KHAIR

## Table des Matières

1. [Prérequis](#prérequis)
2. [Installation sur Windows](#installation-sur-windows)
3. [Installation sur Linux/Mac](#installation-sur-linuxmac)
4. [Configuration](#configuration)
5. [Déploiement en Production](#déploiement-en-production)
6. [Dépannage](#dépannage)

---

## 1. Prérequis

### Logiciels Requis

#### Obligatoires
- ✅ **PHP** >= 8.1
- ✅ **Composer** (gestionnaire de dépendances PHP)
- ✅ **MySQL** >= 5.7 ou **MariaDB** >= 10.3
- ✅ **Node.js** >= 16.x
- ✅ **NPM** >= 8.x

#### Optionnels (Recommandés)
- ⚪ **Redis** (pour le cache et les queues)
- ⚪ **Git** (pour le versioning)

### Extensions PHP Requises

```bash
php -m  # Vérifier les extensions installées
```

Extensions nécessaires:
- ✅ BCMath
- ✅ Ctype
- ✅ Fileinfo
- ✅ JSON
- ✅ Mbstring
- ✅ OpenSSL
- ✅ PDO
- ✅ PDO_MySQL
- ✅ Tokenizer
- ✅ XML
- ✅ GD (pour les images)
- ✅ Zip

---

## 2. Installation sur Windows

### Étape 1: Installer XAMPP

1. Téléchargez XAMPP depuis [apachefriends.org](https://www.apachefriends.org/)
2. Installez XAMPP (version avec PHP 8.1+)
3. Démarrez Apache et MySQL depuis le panneau de contrôle XAMPP

### Étape 2: Installer Composer

1. Téléchargez depuis [getcomposer.org](https://getcomposer.org/)
2. Exécutez l'installateur
3. Vérifiez l'installation:
```bash
composer --version
```

### Étape 3: Installer Node.js

1. Téléchargez depuis [nodejs.org](https://nodejs.org/)
2. Installez la version LTS
3. Vérifiez l'installation:
```bash
node --version
npm --version
```

### Étape 4: Cloner le Projet

```bash
# Ouvrir le terminal dans C:\xampp\htdocs
cd C:\xampp\htdocs

# Cloner le projet
git clone https://github.com/votre-repo/alkhair.git
cd alkhair
```

### Étape 5: Installer les Dépendances

```bash
# Dépendances PHP
composer install

# Dépendances JavaScript
npm install
```

### Étape 6: Configuration

```bash
# Copier le fichier d'environnement
copy .env.example .env

# Générer la clé d'application
php artisan key:generate
```

### Étape 7: Créer la Base de Données

1. Ouvrez phpMyAdmin: `http://localhost/phpmyadmin`
2. Créez une nouvelle base de données: `alkhair`
3. Encodage: `utf8mb4_unicode_ci`

### Étape 8: Configurer .env

Ouvrez `.env` et modifiez:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=alkhair
DB_USERNAME=root
DB_PASSWORD=
```

### Étape 9: Exécuter les Migrations

```bash
php artisan migrate
```

### Étape 10: Exécuter les Seeders (Optionnel)

```bash
php artisan db:seed
```

### Étape 11: Créer le Lien Symbolique

```bash
php artisan storage:link
```

### Étape 12: Compiler les Assets

```bash
npm run build
```

### Étape 13: Démarrer le Serveur

```bash
php artisan serve
```

Accédez à: `http://localhost:8000`

---

## 3. Installation sur Linux/Mac

### Étape 1: Installer les Prérequis

#### Ubuntu/Debian
```bash
# Mettre à jour les paquets
sudo apt update

# Installer PHP et extensions
sudo apt install php8.1 php8.1-cli php8.1-common php8.1-mysql \
php8.1-zip php8.1-gd php8.1-mbstring php8.1-curl php8.1-xml \
php8.1-bcmath

# Installer MySQL
sudo apt install mysql-server

# Installer Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Installer Node.js
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install nodejs
```

#### macOS
```bash
# Installer Homebrew (si pas déjà installé)
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"

# Installer PHP
brew install php@8.1

# Installer MySQL
brew install mysql

# Installer Composer
brew install composer

# Installer Node.js
brew install node
```

### Étape 2: Cloner et Configurer

```bash
# Cloner le projet
git clone https://github.com/votre-repo/alkhair.git
cd alkhair

# Installer les dépendances
composer install
npm install

# Configuration
cp .env.example .env
php artisan key:generate
```

### Étape 3: Base de Données

```bash
# Se connecter à MySQL
mysql -u root -p

# Créer la base de données
CREATE DATABASE alkhair CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### Étape 4: Migrations et Seeders

```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
```

### Étape 5: Compiler et Démarrer

```bash
npm run build
php artisan serve
```

---

## 4. Configuration

### 4.1 Configuration Email

Éditez `.env`:

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

**Note Gmail**: Utilisez un "Mot de passe d'application" depuis les paramètres de sécurité Google.

### 4.2 Configuration Stripe

```env
STRIPE_KEY=pk_test_votre_cle_publique
STRIPE_SECRET=sk_test_votre_cle_secrete
```

Obtenez vos clés depuis: [dashboard.stripe.com](https://dashboard.stripe.com/)

### 4.3 Configuration Queue

```env
QUEUE_CONNECTION=database
```

Démarrer le worker:
```bash
php artisan queue:work
```

### 4.4 Configuration Cache

#### Avec File (par défaut)
```env
CACHE_DRIVER=file
```

#### Avec Redis (recommandé)
```env
CACHE_DRIVER=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

Installer Redis:
```bash
# Ubuntu
sudo apt install redis-server

# macOS
brew install redis

# Démarrer Redis
redis-server
```

### 4.5 Configuration Scheduler

En production, ajoutez dans crontab:

```bash
# Ouvrir crontab
crontab -e

# Ajouter cette ligne
* * * * * cd /chemin-vers-projet && php artisan schedule:run >> /dev/null 2>&1
```

---

## 5. Déploiement en Production

### 5.1 Optimisations

```bash
# Optimiser l'autoloader
composer install --optimize-autoloader --no-dev

# Mettre en cache les configurations
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Compiler les assets pour production
npm run build
```

### 5.2 Configuration .env Production

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://votre-domaine.com

# Utiliser un driver de cache performant
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

### 5.3 Permissions

```bash
# Donner les bonnes permissions
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 5.4 Configuration Apache

Créez un VirtualHost:

```apache
<VirtualHost *:80>
    ServerName votre-domaine.com
    DocumentRoot /var/www/alkhair/public

    <Directory /var/www/alkhair/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/alkhair-error.log
    CustomLog ${APACHE_LOG_DIR}/alkhair-access.log combined
</VirtualHost>
```

### 5.5 Configuration Nginx

```nginx
server {
    listen 80;
    server_name votre-domaine.com;
    root /var/www/alkhair/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### 5.6 SSL avec Let's Encrypt

```bash
# Installer Certbot
sudo apt install certbot python3-certbot-apache

# Obtenir un certificat
sudo certbot --apache -d votre-domaine.com
```

---

## 6. Dépannage

### Problème: "Class not found"

```bash
composer dump-autoload
php artisan clear-compiled
php artisan cache:clear
```

### Problème: "Permission denied"

```bash
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R www-data:www-data storage bootstrap/cache
```

### Problème: "SQLSTATE[HY000] [2002]"

- Vérifiez que MySQL est démarré
- Vérifiez les credentials dans `.env`
- Vérifiez le port (3306 par défaut)

### Problème: "Mix manifest not found"

```bash
npm install
npm run build
```

### Problème: "Queue not working"

```bash
# Redémarrer le worker
php artisan queue:restart
php artisan queue:work
```

### Problème: "Storage link not working"

```bash
# Supprimer l'ancien lien
rm public/storage

# Recréer le lien
php artisan storage:link
```

---

## 📞 Support

Si vous rencontrez des problèmes:

1. Consultez la [documentation Laravel](https://laravel.com/docs)
2. Vérifiez les logs: `storage/logs/laravel.log`
3. Contactez le support: support@alkhair.ma

---

**Bonne installation! 🚀**
