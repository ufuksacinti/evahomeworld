# 🔧 Site Erişim Sorunu Çözümü

## 🚨 Sorun
`https://evahomeworld.com/check-db.php` adresine ulaşılamıyor.

## ✅ Hızlı Kontrol Listesi

### 1. PHP Dosyaları Çalışıyor mu?

**Test 1:** Tarayıcıda açın:
```
https://evahomeworld.com/test-php.php
```

**Eğer çalışıyorsa:** PHP çalışıyor demektir, sorun Laravel/bootstrap ile ilgili.

**Eğer çalışmıyorsa:** .htaccess veya sunucu yapılandırması sorunu var.

---

### 2. .htaccess Dosyası Kontrolü

#### A. public_html/.htaccess
File Manager'da `public_html/.htaccess` dosyasını kontrol edin. **Şu şekilde olmalı:**

```apache
# PHP 8.3 Handler
AddHandler application/x-httpd-ea-php83 .php

<IfModule mod_rewrite.c>
    RewriteEngine On
    
    # If public folder exists, redirect to it
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} !^/public/
    RewriteRule ^(.*)$ public/$1 [L,QSA]
</IfModule>
```

#### B. public/.htaccess
`public_html/public/.htaccess` dosyası **DOĞRU** görünüyor (Laravel standart .htaccess).

---

### 3. Document Root Kontrolü

cPanel → **Domains** → **evahomeworld.com** → **Manage**

Document Root şunlardan biri olmalı:
- `public_html` (önerilen - .htaccess ile yönlendirme yapıyor)
- `public_html/public` (alternatif)

**Eğer `public_html/public` ise:** `check-db.php` dosyasına şu şekilde erişin:
```
https://evahomeworld.com/check-db.php
```
*(/public/ kısmı otomat changing eklenmemeli)*

---

### 4. Dosya Yolu Kontrolü

File Manager'da kontrol edin:
- ✅ `public_html/public/check-db.php` dosyası var mı?
- ✅ `public_html/public/test-php.php` dosyası var mı?
- ✅ `public_html/vendor/` klasörü var mı?
- ✅ `public_html/.env` dosyası var mı?

---

### 5. PHP Hatalarını Görüntüleme

`check-db.php` dosyasının **en başına** şunu ekleyin:

```php
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
// ... existing code ...
```

VEYA `public_html/.env` dosyasında:
```
APP_DEBUG=true
```

---

### 6. Error Log Kontrolü

#### A. Laravel Log
File Manager → `public_html/storage/logs/laravel.log`

#### B. PHP Error Log
File Manager → `public_html/public/error_log`

VEYA cPanel → **Metrics** → **Errors**

#### C. Apache Error Log
cPanel → **Metrics** → **Apache Errors**

---

## 🔧 Adım Adım Çözüm

### ÇÖZÜM 1: Basit Test Dosyası

File Manager'da `public_html/public/test.php` oluşturun:

```php
<?php
echo "PHP Çalışıyor!";
phpinfo();
```

Tarayıcıda: `https://evahomeworld.com/test.php`

**Eğer çalışıyorsa:** Laravel bootstrap sorunu var.

**Eğer çalışmıy-limor:** .htaccess veya PHP handler sorunu var.

---

### ÇÖZÜM 2: .htaccess'i Geçici Devre Dışı Bırak

File Manager'da `public_html/.htaccess` dosyasını **YENİDEN ADLANDIRIN:**
- Eski isim: `.htaccess`
- Yeni isim: `.htaccess.backup`

Sonra `check-db.php`'ye erişmeyi deneyin:
```
https://evahomeworld.com/public/check-db.php
```

**Eğer çalışıyorsa:** .htaccess rewrite kuralları sorunu var.

---

### ÇÖZÜM 3: Vendor Klasörü Kontrolü

Terminal'de (eğer erişiminiz varsa):

```bash
cd ~/public_html
ls -la vendor/
```

VEYA File Manager'da `public_html/vendor` klasörünü kontrol edin.

**Yoksa:**
```bash
composer install --no-dev --optimize-autoloader
```

---

### ÇÖZÜM 4: .env Dosyası Kontrolü

File Manager → `public_html/.env` dosyasını açın ve kontrol edin:

```env
APP_ENV=production
APP_DEBUG=true  # Geçici olarak true yapın
APP_URL=https://evahomeworld.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=xqxevaho_home54
DB_USERNAME=xqxevaho_evahome
DB_PASSWORD=B)G18T$1S+yg
```

---

### ÇÖZÜM 5: PHP Handler Değiştirme

cPanel → **Select PHP Version**

- PHP Version: **8.3** seçin
- **Extensions:**
  - ✅ php-mbstring
  - ✅ php-xml
  - ✅ php-mysql
  - ✅ php-zip
  - ✅ php-curl

---

## 🧪 Test Sırası

1. ✅ `https://evahomeworld.com/test-php.php` → Çalışıyor mu?
2. ✅ `https://evahomeworld.com/test.php` → Çalışıyor mu?
3. ✅ `https://evahomeworld.com/check-db.php` → Hangi hata veriyor?
4. ✅ `https://evahomeworld.com/public/check-db.php` → Farklı mı?

---

## 📞 Hata Mesajına Göre Çözüm

### "404 Not Found"
→ Dosya yolu yanlış veya .htaccess rewrite sorunu

### "500 Internal Server Error"
→ PHP hatası veya .htaccess syntax hatası

### "Call to undefined function"
→ vendor klasörü eksik veya composer install gerekli

### "Class 'Illuminate\...' not found"
→ vendor/autoload.php yüklenemiyor

### "Connection refused" veya Veritabanı hatası
→ .env dosyasındaki DB bilgileri yanlış

---

## ⚠️ ÖNEMLİ NOTLAR

1. **Test dosyalarını silin:** `test.php`, `test-php.php` dosyalarını işiniz bitince silin.
2. **APP_DEBUG=true geçici:** Üretimde `APP_DEBUG=false` olmalı.
3. **.htaccess backup:** .htaccess'i değiştirmeden önce yedek alın.

---

## 🚀 Hızlı Test Komutu

File Manager'da `public_html/public/quick-test.php` oluşturun:

```php
<?php
echo "<h1>PHP Test</h1>";
echo "PHP Version: " . PHP_VERSION . "<br>";
echo "File exists: " . (file_exists('../vendor/autoload.php') ? 'YES' : 'NO') . "<br>";
echo "ENV exists: " . (file_exists('../.env') ? 'YES' : 'NO') . "<br>";
```

Açın: `https://evahomeworld.com/quick-test.php`

