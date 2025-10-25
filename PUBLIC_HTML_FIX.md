# 🔧 500 Hatası - .htaccess Düzeltmesi

## ❌ Sorun
500 Internal Server Error alıyorsunuz.

## ✅ ÇÖZÜM

### ADIM 1: public_html/.htaccess Düzeltin

File Manager → `public_html/.htaccess` dosyasını **TAMAMEN** şu içerikle değiştirin:

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

**Save** yapın.

### ADIM 2: public/.htaccess Kontrol

File Manager → `public_html/public/.htaccess` dosyasını kontrol edin (zaten doğru görünüyor).

### ADIM 3: Error Log Kontrol

Terminal'de:
```bash
tail -50 ~/public_html/public/error_log
```

VEYA

File Manager → `public_html/public/error_log` dosyasını açın.

---

## 🔍 YAYGIN HATALAR

### Hata 1: "End of script output before headers"

**Çözüm:**
```bash
cd ~/public_html
chmod 644 public/index.php
chmod 644 index.php
```

### Hata 2: "Call to undefined function"

**Çözüm:**
File Manager → `public_html/vendor` klasörü var mı kontrol edin.

Yoksa:
```bash
composer install --no-dev
```

### Hata 3: APP_KEY hatası

**Çözüm:**
```bash
php artisan key:generate
php artisan config:cache
```

---

## 🧪 TEST

```bash
# PHP versiyonunu kontrol et
cd ~/public_html
php -v

# Eğer 7.4 gösteriyorsa
php83 -v
```

---

## ⚠️ ÖNEMLİ

`.htaccess` dosyanızda **Sadece** şu satır olmalı:

```apache
AddHandler application/x-httpd-ea-php83 .php
```

**Asla:**
```apache
<IfModule mod_php83.c>
   AddHandler application/x-httpd-ea-php83 .php
</IfModule>
```

Bu **çalışmaz** çünkü mod adı farklı.

---

**Test edin! 🚀**
