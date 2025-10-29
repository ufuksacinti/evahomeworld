# 🎯 ADIM ADIM ÇÖZÜM - cPanel Deploy

## 📂 Mevcut Dosya Yapısı (Görselden)

```
/home/xqxevaho/public_html/
├── .env ✅ (var)
├── composer.json ✅
├── composer.phar ✅
├── public/ ✅ (var, içinde index.php var)
├── vendor/ ❌ (YOK - SORUN BU!)
└── ...diğer Laravel klasörleri
```

## ❌ Sorunlar

1. **vendor klasörü yok** → Composer bağımlılıkları yüklenmemiş
2. **public_html/index.php yok** → Dizin listelemesi gösteriyor
3. **Document Root** `public_html` → `public_html/public` olmalı

---

## ✅ ADIM ADIM ÇÖZÜM

### ADIM 1: cPanel Terminal Aç

1. cPanel → **Terminal** (alt kısımda Advanced bölümünde)
2. Veya cPanel → **File Manager** → **Terminal**

### ADIM 2: Composer ile vendor Klasörünü Oluştur

Terminal'de şu komutları çalıştır:

```bash
cd ~/public_html
php composer.phar install --no-dev --optimize-autoloader
```

**NOT:** Bu işlem 2-5 dakika sürebilir. Bekleyin.

### ADIM 3: public_html Klasöründe index.php Oluştur

File Manager'da:

1. `public_html` klasörüne git
2. **+ File** butonuna tıkla
3. Dosya adı: `index.php`
4. İçeriği buraya yapıştır:

```php
<?php
/**
 * Laravel Application
 * This file redirects all requests to the public directory
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// If the file exists in public_html/public, serve it directly
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

// Otherwise forward to index.php in public folder
require_once __DIR__.'/public/index.php';
```

5. **Save** butonuna tıkla

### ADIM 4: .env Dosyasını Kontrol Et

File Manager'da `.env` dosyasını aç ve şunları kontrol et:

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
```

### ADIM 5: PHP Versiyonunu Değiştir

1. cPanel → **Select PHP Version**
2. **PHP 8.2** seç
3. **Set as current** butonuna tıkla

### ADIM 6: Laravel Setup (Terminal'de)

```bash
cd ~/public_html
php artisan key:generate
php artisan config:cache
php artisan storage:link
```

### ADIM 7: İzinleri Ayarla

```bash
chmod -R 755 storage bootstrap/cache
chmod 644 public/.htaccess
```

---

## 🧪 TEST

Tarayıcıda aç:

1. **http://evahomeworld.com** ✅ (Ana sayfa açılmalı)
2. **http://evahomeworld.com/public** ✅ (Laravel public klasörü)

---

## ❓ SORUN DEVAM EDERSE

### Error: "vendor/autoload.php not found"

**Çözüm:**
```bash
cd ~/public_html
php composer.phar install --no-dev
```

### Error: "Application key not set"

**Çözüm:**
```bash
php artisan key:generate
php artisan config:cache
```

### Dizin Listelemesi Hala Görünüyor

**Çözüm:**
1. ADIM 3'ü tekrar yap (index.php oluştur)
2. `.htaccess` dosyasını kontrol et

### 500 Internal Server Error

**Çözüm:**
```bash
tail -f storage/logs/laravel.log
```

---

## ✅ BAŞARILI OLDUĞUNDA

Göreceksiniz:
- ✅ Ana sayfa açılıyor (403 yok, dizin listelemesi yok)
- ✅ EVA HOME logosu/sayfa görünüyor
- ✅ CSS'ler yükleniyor

---

## 📞 YARDIM

Hala sorun varsa:
1. Terminal çıktısını paylaş
2. `storage/logs/laravel.log` içeriğini paylaş
3. File Manager'da `vendor` klasörünün var olup olmadığını kontrol et

**Başarılar! 🚀**
