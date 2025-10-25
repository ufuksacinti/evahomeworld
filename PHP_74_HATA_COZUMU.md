# 🚨 PHP 7.4.33 HATASI - ACİL ÇÖZÜM

## ❌ SORUN
Error log'da görünen hata:
```
Your Composer dependencies require a PHP version ">= 8.2.0". 
You are running 7.4.33.
```

**cPanel Select PHP Version'da PHP 8.3 seçili ama hala PHP 7.4 kullanılıyor!**

---

## ✅ ÇÖZÜM: PHP 8.3'ü ZORLA KULLAN

### ADIM 1: .htaccess Dosyasını Kontrol Et

File Manager → `public_html/.htaccess` dosyasını açın.

**İçeriği şöyle OLMALI:**

```apache
AddHandler application/x-httpd-ea-php83 .php

<IfModule mod_rewrite.c>
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_URI} !^/public/
RewriteRule ^(.*)$ public/$1 [L,QSA]
</IfModule>
```

**İlk satır çok önemli:** `AddHandler application/x-httpd-ea-php83 .php`

---

### ADIM 2: Select PHP Version'ı Tekrar Kontrol Et

1. cPanel → **Select PHP Version**
2. Domain: `evahomeworld.com` seçin
3. PHP Version: **ea-php83** seçin
4. **Set as current** butonuna tıklayın
5. **Save** butonuna tıklayın

---

### ADIM 3: Terminal'de PHP Versiyonunu Test Et

cPanel → Terminal:

```bash
# Hangi PHP kullanılıyor?
which php

# PHP 8.3 direkt yol ile
/opt/cpanel/ea-php83/root/usr/bin/php -v

# Eğer 8.3 değilse, symlink oluştur
cd ~
ln -sf /opt/cpanel/ea-php83/root/usr/bin/php /home/xqxevaho/bin/php83
```

---

### ADIM 4: public_html/public/index.php Dosyasını Kontrol Et

File Manager → `public_html/public/index.php` dosyasını açın.

**En başta** şunu ekleyin (14. satırdan önce):

```php
<?php
// PHP version check
if (version_compare(PHP_VERSION, '8.2.0', '<')) {
    die('PHP Version Error: PHP ' . PHP_VERSION . ' detected. PHP 8.2+ required.');
}

// PHP Handler override
if (function_exists('ini_set')) {
    ini_set('default_charset', 'UTF-8');
}

define('LARAVEL_START', microtime(true));
// ... existing code ...
```

---

### ADIM 5: Terminal'de Artisan Test

cPanel → Terminal:

```bash
cd ~/public_html

# PHP versiyonunu kontrol
php83 artisan --version

# Eğer php83 çalışmıyorsa
/opt/cpanel/ea-php83/root/usr/bin/php artisan --version

# Cache temizle
php83 artisan optimize:clear

# Config cache
php83 artisan config:cache
```

---

### ADIM 6: .user.ini Dosyası Oluştur

File Manager → `public_html/.user.ini` dosyası oluşturun:

```ini
; Force PHP 8.3
php_version=83
```

---

### ADIM 7: Test Dosyası

File Manager → `public_html/public/phpinfo.php` dosyası oluşturun:

```php
<?php
echo "PHP Version: " . phpversion() . "<br>";
echo "Handler: " . php_sapi_name() . "<br>";
phpinfo();
```

Tarayıcıda: `http://evahomeworld.com/public/phpinfo.php`

**PHP versiyonu 8.3.23 göstermeli!**

---

## 🔧 ALTERNATİF ÇÖZÜM: public_html/index.php Sil

Eğer hala PHP 7.4 kullanılıyorsa:

1. File Manager → `public_html/index.php` dosyasını **SİLİN**
2. cPanel → Domains → evahomeworld.com
3. Document Root: `public_html/public` olarak değiştirin
4. Save

---

## 📋 KONTROL LİSTESİ

1. ✅ `public_html/.htaccess` ilk satırında `AddHandler application/x-httpd-ea-php83 .php` var mı?
2. ✅ cPanel Select PHP Version'da PHP 8.3 seçili mi?
3. ✅ `php83 artisan --version` komutu çalışıyor mu?
4. ✅ `phpinfo.php` PHP 8.3.23 gösteriyor mu?
5. ✅ `.user.ini` dosyası var mı?

---

## 🚨 EN ÖNEMLİSİ

Terminal'de şu komutu çalıştırın:

```bash
cd ~/public_html
php83 artisan --version
```

**Sonucu paylaşın!** 🔍
