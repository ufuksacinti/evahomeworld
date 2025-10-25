# 🚀 cPanel Git Version Control Deployment

## Kurulum Adımları

### 1. Repository Ayarları

1. **cPanel** → **Git Version Control**
2. **Create Repository** tıkla
3. Formu doldur:
   ```
   Repository URL: https://github.com/ufuksacinti/evahomeworld.git
   Repository Path: public_html (veya evahomeworld.com klasörü)
   Branch: main
   ```
4. **Create** tıkla

### 2. İlk Pull

```bash
# cPanel Terminal ile
cd public_html
git pull origin main
```

### 3. Bağımlılıkları Yükle

```bash
# Composer
composer install --no-dev --optimize-autoloader

# NPM
npm install
npm run build
```

### 4. .env Dosyası

```bash
# .env dosyası oluştur
cp .env.example .env
nano .env  # veya cPanel File Manager'da düzenle
```

**.env İçeriği:**
```env
APP_NAME=EvaHome
APP_ENV=production
APP_DEBUG=false
APP_URL=https://evahomeworld.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=xqxevaho_homedb
DB_USERNAME=xqxevaho_ufuk38
DB_PASSWORD=]3Zhem*

CACHE_STORE=file
SESSION_DRIVER=database
```

### 5. Laravel Setup

```bash
# Key generate
php artisan key:generate

# Migration
php artisan migrate --force

# Cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 6. İzinler

```bash
chmod -R 755 storage bootstrap/cache
chmod 644 public/.htaccess
```

### 7. Storage Link

```bash
php artisan storage:link
```

---

## Güncelleme (Git Pull)

### Otomatik Güncelleme

cPanel Git Version Control'den **Pull or Deploy** butonuna tıkla.

### Manuel Güncelleme

```bash
cd public_html
git pull origin main

# Composer
composer install --no-dev

# Cache temizle
php artisan optimize:clear

# Asset build
npm run build

# Cache yenile
php artisan config:cache
php artisan route:cache
```

---

## 403 Hatası Çözümü

### Sebep
cPanel Git, repository'yi `public_html` klasörüne çekiyor. Laravel'in `public` klasörü document root olmalı.

### Çözüm 1: .htaccess ile Yönlendirme (ÖNERİLEN)

`public_html/.htaccess` dosyası oluştur:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    
    # public klasörüne yönlendir
    RewriteCond %{REQUEST_URI} !^/public/
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>

# Dizin listelemesini engelle
Options -Indexes
```

### Çözüm 2: Document Root'u Değiştir

1. cPanel → **Domains** → **evahomeworld.com**
2. **Manage** tıkla
3. **Document Root** değerini `public_html/public` olarak ayarla
4. **Save Changes**

### Çözüm 3: Symbolic Link

```bash
cd public_html
mv public public_backup
ln -s $(pwd)/public_backup public
```

---

## Otomatik Deploy Script

`public_html/deploy.sh` dosyası oluştur:

```bash
#!/bin/bash

echo "🔄 Deploying EvaHome..."

# Git pull
git pull origin main

# Composer
composer install --no-dev --optimize-autoloader

# NPM build
npm run build

# Laravel
php artisan migrate --force
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link

# İzinler
chmod -R 755 storage bootstrap/cache

echo "✅ Deploy completed!"
```

Çalıştır:
```bash
chmod +x deploy.sh
./deploy.sh
```

---

## Webhook ile Otomatik Deploy

GitHub'da otomatik deploy için:

1. cPanel → **Cron Jobs**
2. Yeni cron oluştur:
   ```
   Command: cd ~/public_html && git pull origin main && php artisan config:cache
   When: * * * * *
   ```

3. **Save Crontab**

---

## Troubleshooting

### 403 Forbidden
```bash
chmod 755 public
chmod 644 public/.htaccess
```

### 500 Error
```bash
# Log kontrol
tail -f storage/logs/laravel.log

# Cache temizle
php artisan optimize:clear
```

### Database Error
```bash
# .env kontrol
cat .env | grep DB_

# Migrate
php artisan migrate --force
```

### Asset'ler Yüklenmiyor
```bash
npm run build
php artisan storage:link
```

---

## Git Hooks

Repository içinde `.git/hooks/post-receive` oluştur:

```bash
#!/bin/bash
cd /home/username/public_html
git pull origin main
php artisan migrate --force
php artisan config:cache
php artisan route:cache
```

**Başarılar! 🚀**
