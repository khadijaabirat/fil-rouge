# 🚀 Guide de Déploiement - AL-KHAIR

## 📋 Prérequis

- Serveur Linux (Ubuntu 20.04+ recommandé)
- PHP 8.2+
- MySQL 8.0+
- Nginx ou Apache
- Composer
- Node.js 18+ & NPM
- Certificat SSL (Let's Encrypt recommandé)

---

## 🔧 Installation en Production

### 1. Cloner le Projet

```bash
cd /var/www
git clone https://github.com/votre-repo/alkhair.git
cd alkhair
```

### 2. Configuration des Permissions

```bash
sudo chown -R www-data:www-data /var/www/alkhair
sudo chmod -R 755 /var/www/alkhair
sudo chmod -R 775 /var/www/alkhair/storage
sudo chmod -R 775 /var/www/alkhair/bootstrap/cache
```

### 3. Installation des Dépendances

```bash
# PHP
composer install --optimize-autoloader --no-dev

# JavaScript
npm install
npm run build
```

### 4. Configuration de l'Environnement

```bash
cp .env.example .env
php artisan key:generate
```

Modifier `.env` pour la production:

```env
APP_NAME="AL-KHAIR"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://alkhair.ma

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=alkhair_prod
DB_USERNAME=alkhair_user
DB_PASSWORD=mot_de_passe_securise

# Cache (Redis recommandé)
CACHE_STORE=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# Queue
QUEUE_CONNECTION=redis

# Session
SESSION_DRIVER=redis
SESSION_LIFETIME=120

# Mail
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=noreply@alkhair.ma
MAIL_PASSWORD=votre_mot_de_passe_app
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@alkhair.ma"
MAIL_FROM_NAME="AL-KHAIR"

# Stripe
STRIPE_KEY=pk_live_votre_cle_publique
STRIPE_SECRET=sk_live_votre_cle_secrete

# Logging
LOG_CHANNEL=daily
LOG_LEVEL=error
LOG_DAYS=30
```

### 5. Base de Données

```bash
# Créer la base de données
mysql -u root -p
CREATE DATABASE alkhair_prod CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'alkhair_user'@'localhost' IDENTIFIED BY 'mot_de_passe_securise';
GRANT ALL PRIVILEGES ON alkhair_prod.* TO 'alkhair_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;

# Exécuter les migrations
php artisan migrate --force

# Seeders (optionnel)
php artisan db:seed --force
```

### 6. Optimisations Laravel

```bash
# Cache de configuration
php artisan config:cache

# Cache des routes
php artisan route:cache

# Cache des vues
php artisan view:cache

# Optimisation de l'autoloader
composer dump-autoload --optimize

# Créer le lien symbolique pour storage
php artisan storage:link
```

### 7. Configuration Nginx

Créer `/etc/nginx/sites-available/alkhair`:

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name alkhair.ma www.alkhair.ma;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name alkhair.ma www.alkhair.ma;
    root /var/www/alkhair/public;

    # SSL Configuration
    ssl_certificate /etc/letsencrypt/live/alkhair.ma/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/alkhair.ma/privkey.pem;
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers HIGH:!aNULL:!MD5;

    # Security Headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "no-referrer-when-downgrade" always;
    add_header Content-Security-Policy "default-src 'self' https: data: 'unsafe-inline' 'unsafe-eval';" always;

    index index.php;

    charset utf-8;

    # Logs
    access_log /var/log/nginx/alkhair-access.log;
    error_log /var/log/nginx/alkhair-error.log;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    # Cache static files
    location ~* \.(jpg|jpeg|png|gif|ico|css|js|svg|woff|woff2|ttf|eot)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }
}
```

Activer le site:

```bash
sudo ln -s /etc/nginx/sites-available/alkhair /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

### 8. Configuration du Queue Worker

Créer `/etc/supervisor/conf.d/alkhair-worker.conf`:

```ini
[program:alkhair-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/alkhair/artisan queue:work redis --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/www/alkhair/storage/logs/worker.log
stopwaitsecs=3600
```

Démarrer le worker:

```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start alkhair-worker:*
```

### 9. Configuration du Scheduler

Ajouter dans crontab:

```bash
sudo crontab -e -u www-data
```

Ajouter:

```cron
* * * * * cd /var/www/alkhair && php artisan schedule:run >> /dev/null 2>&1
```

### 10. Certificat SSL (Let's Encrypt)

```bash
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d alkhair.ma -d www.alkhair.ma
```

---

## 🔒 Sécurité Supplémentaire

### Firewall (UFW)

```bash
sudo ufw allow 22/tcp
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp
sudo ufw enable
```

### Fail2Ban

```bash
sudo apt install fail2ban
sudo systemctl enable fail2ban
sudo systemctl start fail2ban
```

### Backup Automatique

Créer un script `/usr/local/bin/backup-alkhair.sh`:

```bash
#!/bin/bash
DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="/backups/alkhair"
mkdir -p $BACKUP_DIR

# Backup Database
mysqldump -u alkhair_user -p'mot_de_passe' alkhair_prod | gzip > $BACKUP_DIR/db_$DATE.sql.gz

# Backup Files
tar -czf $BACKUP_DIR/files_$DATE.tar.gz /var/www/alkhair/storage/app

# Delete old backups (keep 30 days)
find $BACKUP_DIR -type f -mtime +30 -delete

echo "Backup completed: $DATE"
```

Ajouter dans crontab:

```cron
0 2 * * * /usr/local/bin/backup-alkhair.sh >> /var/log/alkhair-backup.log 2>&1
```

---

## 📊 Monitoring

### Installation de Laravel Telescope (Développement uniquement)

```bash
composer require laravel/telescope --dev
php artisan telescope:install
php artisan migrate
```

### Logs

```bash
# Voir les logs en temps réel
tail -f storage/logs/laravel.log

# Voir les logs Nginx
tail -f /var/log/nginx/alkhair-error.log
```

---

## 🔄 Mise à Jour

```bash
cd /var/www/alkhair

# Mode maintenance
php artisan down

# Pull des changements
git pull origin main

# Mise à jour des dépendances
composer install --optimize-autoloader --no-dev
npm install
npm run build

# Migrations
php artisan migrate --force

# Clear cache
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Redémarrer les workers
sudo supervisorctl restart alkhair-worker:*

# Mode production
php artisan up
```

---

## ✅ Checklist de Déploiement

- [ ] Configuration `.env` en production
- [ ] APP_DEBUG=false
- [ ] Certificat SSL installé
- [ ] Permissions correctes (755/775)
- [ ] Cache Laravel activé
- [ ] Queue worker configuré
- [ ] Scheduler configuré
- [ ] Backup automatique configuré
- [ ] Firewall activé
- [ ] Logs configurés
- [ ] Tests de charge effectués
- [ ] Monitoring en place

---

## 📞 Support

En cas de problème:
- Vérifier les logs: `storage/logs/laravel.log`
- Vérifier Nginx: `/var/log/nginx/alkhair-error.log`
- Vérifier les workers: `sudo supervisorctl status`

**Développé avec ❤️ pour le Maroc 🇲🇦**
