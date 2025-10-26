# EvaHome - Sunucu Kurulum Adımları

## 🚀 Sunucuya Yükleme ve Tasarım Sorunlarını Çözme

### 1. Dosyaları Sunucuya Yükleyin

Tüm proje dosyalarını SSH/FTP ile sunucuya yükleyin:
```
/app
/bootstrap
/config
/database
/public
/resources
/routes
/vendor (composer install ile)
.env
artisan
composer.json
composer.lock
package.json
tailwind.config.js
vite.config.js
```

### 2. Sunucuda SSH ile Bağlanın ve Aşağıdaki Komutları Çalıştırın

```bash
# Proje klasörüne gidin
cd /var/www/yourdomain.com  # veya public_html/evahome

# Bağımlılıkları yükleyin
composer install --no-dev --optimize-autoloader
npm install

# Veritabanını hazırlayın
php artisan migrate --force
php artisan db:seed --force

# Storage link oluşturun (ÇOK ÖNEMLİ!)
php artisan storage:link

# Frontend asset'lerini derleyin (ÇOK ÖNEMLİ - Tasarım için gerekli!)
npm run build

# Cache'leri temizleyin
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Production optimizasyonları
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 3. Public_html veya Htaccess Kullanıyorsanız

Eğer hosting'inizde `public_html` klasörü varsa, içeriğini düzenleyin:

**.htaccess** dosyası oluşturun (public_html içinde):
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

**index.php** dosyasını düzenleyin:
```php
<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
*/

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
```

### 4. Environment Ayarları (.env)

`.env` dosyanızı sunucu ayarlarına göre düzenleyin:

```env
APP_NAME="EVA HOME"
APP_ENV=production
APP_KEY=base64:your_generated_key
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

# ... diğer ayarlar
```

**APP_KEY oluşturmak için:**
```bash
php artisan key:generate
```

### 5. Dosya İzinleri (Linux Sunucular)

```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 6. Build Asset'leri Kontrol Edin

Build işlemi sonrası şu dosyalar oluşmalı:
```
/public/build/assets/app-XXX.css
/public/build/assets/app-XXX.js
/public/build/manifest.json
```

Bu dosyalar olmadan tasarım çalışmaz!

### 7. SSL ve Güvenlik

```bash
# SSL yoksa Let's Encrypt kullanın
sudo certbot --nginx

# Production optimizasyonları
php artisan optimize
```

## 🔍 Tasarım Farkının Nedenleri

### ❌ Muhtemel Sorunlar:
1. **npm run build yapılmadı** → CSS/JS dosyaları yok
2. **Storage link yok** → Resimler yüklenmiyor
3. **Cache sorunu** → Eski dosyalar gösteriliyor
4. **.env production değil** → Asset path'leri yanlış
5. **public_html klasör yapısı** → Dosya yolları hatalı

### ✅ Çözümler:
1. ✅ Sunucuda `npm run build` çalıştırın
2. ✅ `php artisan storage:link` çalıştırın
3. ✅ Tüm cache'leri temizleyin
4. ✅ `.env` dosyasını production olarak ayarlayın
5. ✅ Dosya yapısını kontrol edin

## 📝 Kontrol Listesi

Yerelde tasarımla aynı görünmesi için:
- [ ] Sunucuda `npm install` yapıldı
- [ ] Sunucuda `npm run build` yapıldı
- [ ] `php artisan storage:link` çalıştırıldı
- [ ] `.env` production modunda
- [ ] Cache'ler temizlendi
- [ ] `public/build/` klasöründe dosyalar var
- [ ] SSL sertifikası var
- [ ] Dosya izinleri doğru

## 🐛 Troubleshooting

### Tasarım hala farklı ise:

```bash
# Tekrar derleyin
npm run build

# Browser cache'i temizleyin (Ctrl+Shift+R veya Ctrl+F5)

# Laravel cache'i temizleyin
php artisan optimize:clear

# Browser console'da hataları kontrol edin (F12)
```

### Build dosyaları 404 hatası veriyorsa:

`.htaccess` dosyanızı kontrol edin ve `public/` klasörünü document root yapın.

### Resimler görünmüyorsa:

```bash
# Storage link'in çalıştığını kontrol edin
ls -la public/storage
```

## 📞 Destek

Sorun devam ederse:
1. Browser console'da (F12) hataları kontrol edin
2. Laravel log dosyasını kontrol edin: `storage/logs/laravel.log`
3. Dosya yapısını GitHub ile karşılaştırın
4. Build process'i tekrar çalıştırın

---

**Not:** Sunucuda Node.js yüklü olmalı! Çoğu cPanel hosting'de Node.js bulunmaz. 
Bu durumda yerelde `npm run build` yapıp `public/build/` klasörünü sunucuya yüklemeniz gerekir.

