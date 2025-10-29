# 🚀 EVA HOME - cPanel Deployment Rehberi

## 📋 Ön Hazırlık

### 1. cPanel Bilgileri
- **Domain:** evahomeworld.com
- **cPanel URL:** https://cpanel.evahomeworld.com
- **FTP/SSH:** cPanel içinden erişilebilir

---

## ⚙️ Veritabanı Oluşturma

### 1. cPanel'de Veritabanı Oluştur
1. **cPanel** → **MySQL Databases**
2. **Create New Database** → `homedb` (zaten var: `xqxevaho_homedb`)
3. **Create Database User** → Bilgileri not et
4. **Add User to Database** → Full privileges ver

### 2. SQL Dump Hazırlama (Opsiyonel)
```bash
# Local'de SQLite'dan export
php artisan db:export > database_backup.sql
```

---

## 📁 Dosya Yükleme

### Yöntem 1: FTP ile (FileZilla)
1. **FTP Bilgileri:** cPanel → FTP Accounts
2. **Host:** ftp.evahomeworld.com veya server IP
3. **Klasör:** `public_html/` veya `evahomeworld.com/`
4. **Upload:** Tüm dosyaları yükle

### Yöntem 2: cPanel File Manager
1. **cPanel** → **File Manager**
2. **public_html** klasörüne git
3. **Upload** → Tüm dosyaları seç ve yükle

### Önemli: Güvenlik
✅ `.env` dosyasını YÜKLEMEYİN (sunucuda oluşturulacak)  
❌ `storage/logs/*.log` dosyalarını yükleme  
❌ `vendor/` ve `node_modules/` sırayla sunucuda oluşturulacak

---

## 🔧 Sunucu Kurulumu

### 1. SSH ile Bağlan (terminal üzerinden)
```bash
# cPanel → Advanced → Terminal
cd public_html  # veya domain klasörüne git
```

### 2. Composer Kurulumu
```bash
# Composer yüklü değilse:
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
```

### 3. Node.js & NPM Kurulumu
```bash
# Node yüklü değilse:
curl -fsSL https://rpm.nodesource.com/setup_18.x | bash -
yum install -y nodejs
```

### 4. Bağımlılıkları Yükle
```bash
# PHP bağımlılıkları
composer install --no-dev --optimize-autoloader

# Node bağımlılıkları
npm install
npm run build
```

---

## 🗄️ Veritabanı Migrasyonu

### 1. .env Dosyası Oluştur
```bash
cp .env.example .env
nano .env  # veya vi .env
```

### 2. .env İçeriği
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

CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=database

IYZICO_API_KEY=your_production_api_key
IYZICO_SECRET_KEY=your_production_secret
IYZICO_BASE_URL=https://api.iyzipay.com
```

### 3. Laravel Key Generate
```bash
php artisan key:generate
```

### 4. Migrasyonlar
```bash
# Migration'ları çalıştır
php artisan migrate --force

# (Opsiyonel) Seeder'ları çalıştır
php artisan db:seed --class=AdminUserSeeder
php artisan db:seed --class=ShopCategorySeeder
php artisan db:seed --class=CollectionSeeder
```

---

## 🔒 İzinleri Ayarla

```bash
# Storage ve cache klasörlerine yazma izni ver
chmod -R 755 storage
chmod -R 755 bootstrap/cache

# Kullanıcı:gruplara göre
chown -R cpanel_username:cpanel_username storage
chown -R cpanel_username:cpanel_username bootstrap/cache
```

---

## 🎨 Asset Optimizasyonu

```bash
# Production build
npm run build

# Laravel cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🌐 cPanel Ayarları

### 1. Document Root
- **cPanel** → **Domains** → **Manage** → **evahomeworld.com**
- **Document Root:** `public_html` ✅

### 2. PHP Versiyonu
- **cPanel** → **Select PHP Version**
- **PHP Version:** 8.2+ ✅
- **Extensions:** Enable:
  - `php8.2-mbstring`
  - `php8.2-xml`
  - `php8.2-mysql`
  - `php8.2-zip`
  - `php8.2-curl`
  - `php8.2-gd`
  - `php8.2-intl`

### 3. SSL Sertifikası
- **cPanel** → **SSL/TLS Status**
- Let's Encrypt ile ücretsiz SSL kur

---

## 🚨 .htaccess Ayarları

### public/.htaccess (Mevcut)
```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

### Dizin Listelemesini Engelle
```apache
Options -Indexes
```

---

## 🧪 Test Et

1. **Ana Sayfa:** https://evahomeworld.com
2. **Admin Panel:** https://evahomeworld.com/admin
   - Email: `admin@evahome.com`
   - Şifre: `password`
3. **Login/Register:** Test et
4. **Ürün Sayfaları:** Kontrol et

---

## 🔄 Güncelleme Süreci

Gelecekte yeni bir sürüm yüklediğinizde:

```bash
# 1. Yeni dosyaları yükle
git pull  # veya FTP ile güncel dosyaları yükle

# 2. Bağımlılıkları güncelle
composer install --no-dev

# 3. Migration'ları çalıştır
php artisan migrate --force

# 4. Cache'leri temizle
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# 5. Yeni asset'leri build et
npm run build

# 6. Cache'leri yeniden oluştur
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🐛 Sorun Giderme

### 500 Internal Server Error
```bash
# Hata loglarını kontrol et
tail -f storage/logs/laravel.log

# Storage izinlerini kontrol et
ls -la storage/
chmod -R 755 storage
```

### Database Connection Error
- `.env` dosyasındaki veritabanı bilgilerini kontrol et
- cPanel'de veritabanı kullanıcısının full privileges olduğundan emin ol

### File Permission Issues
```bash
chmod -R 755 storage bootstrap/cache
chown -R cpaneluser:cpaneluser storage bootstrap/cache
```

### Asset'ler Yüklenmiyor
```bash
# Build'i yeniden yap
npm run build

# Public storage link'i oluştur
php artisan storage:link
```

---

## 📞 Destek

Sorun yaşarsanız:
1. `storage/logs/laravel.log` dosyasını kontrol et
2. cPanel error logs'u kontrol et
3. PHP error log'larını incele

**Başarılı deploylar! 🚀✨**
