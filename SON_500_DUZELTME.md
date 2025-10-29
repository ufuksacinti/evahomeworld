# 🔥 SON 500 HATASI ÇÖZÜMÜ

## 🚨 ACİL ADIMLAR

### 1️⃣ Error Log Okuyun

cPanel File Manager → `public_html/public/error_log` dosyasını açın ve **EN SON 10 SATIRI** buraya kopyalayın.

VEYA

Tarayıcıda açın:
```
http://evahomeworld.com/public/error_log
```

### 2️⃣ PHP Test Dosyası Oluşturun

File Manager → `public_html/public/test.php` dosyası oluşturun:

```php
<?php
phpinfo();
```

Tarayıcıda açın: `http://evahomeworld.com/public/test.php`

**PHP versiyonu ne gösteriyor?**

---

## 🔧 ALTERNATİF .htaccess ÇÖZÜMLERİ

### ÇÖZÜM A: Minimal .htaccess

File Manager → `public_html/.htaccess` dosyasını **SILİN** veya içeriği:

```apache
AddHandler application/x-httpd-ea-php83 .php
```

**Sadece bu satır olsun.**

### ÇÖZÜM B: Farklı PHP Handler

`public_html/.htaccess` içeriği:

```apache
<IfModule mod_suphp.c>
suPHP_ConfigPath /home/xqxevaho
</IfModule>

<IfModule mod_rewrite.c>
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_URI} !^/public/
RewriteRule ^(.*)$ public/$1 [L,QSA]
</IfModule>
```

### ÇÖZÜM C: public_html/public/index.php Test

File Manager → `public_html/public/index.php` dosyasını açın ve **EN BAŞINA** ekleyin:

```php
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
define('LARAVEL_START', microtime(true));
// ... existing code ...
```

### ÇÖZÜM D: public_html/index.php Kaldır

File Manager → `public_html/index.php` dosyasını **SİLİN.**

Cpanel'den Document Root'u `public_html/public` olarak değiştirin:
- cPanel → Domains → evahomeworld.com → Document Root: `public_html/public`

---

## 🔍 KONTROL LİSTESİ

1. ✅ `public_html/vendor` klasörü var mı?
2. ✅ `.env` dosyası düzgün mü?
3. ✅ `php83 -v` komutu PHP 8.3 gösteriyor mu?
4. ✅ `error_log` dosyası ne diyor?
5. ✅ File permissions doğru mu? (755 dosyalar, 644)

---

## 🛠️ TERMINAL KOMUTLARI

cPanel Terminal'de:

```bash
cd ~/public_html

# PHP versiyonu kontrol
php83 -v

# Vendor var mı?
ls -la vendor/

# Storage permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache

# En son hataları göster
tail -100 public/error_log
```

---

## 📧 ERROR LOG ÖRNEKLERİ

### Hata 1: "Call to undefined function"
→ PHP extension eksik

### Hata 2: "Class not found"
→ vendor klasörü eksik veya bozuk

### Hata 3: "No such file or directory"
→ Yol sorunları

### Hata 4: "Failed to open stream"
→ Permission sorunları

---

**Şu anda error_log dosyasındaki EN SON SATIR nedir? Paylaşın!** 🔍
