# 🔥 PHP VERSİYONU VE 500 HATASI - SON ÇÖZÜM

## 🚨 ACİL KONTROLLER

### 1️⃣ .htaccess İçeriğini Kontrol Et

File Manager → `public_html/.htaccess` dosyası şu şekilde OLMALI:

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

**İlk satır çok önemli!**

---

### 2️⃣ .user.ini Dosyası Oluştur

File Manager → `public_html/.user.ini` dosyası oluşturun:

```ini
; cPanel .user.ini
auto_prepend_file=
auto_append_file=
cgi.fix_pathinfo=1
memory_limit=256M
upload_max_filesize=64M
post_max_size=64M
max_execution_time=300
max_input_time=300
```

---

### 3️⃣ public/.htaccess Kontrolü

File Manager → `public_html/public/.htaccess` dosyası doğru mu kontrol edin.

---

## 🛠️ TERMINAL TESTLERİ

cPanel → Terminal:

```bash
cd ~/public_html

# PHP versiyonunu kontrol
php83 -v
# PHP 8.3.x görmeli

# Eğer 7.4 gösteriyorsa, doğrudan php83 kullanın
/opt/cpanel/ea-php83/root/usr/bin/php -v

# Laravel artisan test
php83 artisan --version

# Error log kontrol
tail -20 public/error_log
```

---

## 🔥 ALTERNATİF ÇÖZÜMLER

### ÇÖZÜM A: Select PHP Version'dan Değiştir

1. cPanel → **Select PHP Version**
2. Domain: `evahomeworld.com` seçin
3. PHP Version: **ea-php83** seçin
4. **Set as current** butonuna tıklayın
5. Şu extension'ları aktif edin:
   - curl
   - fileinfo
   - gd
   - mbstring
   - openssl
   - pdo
   - pdo_mysql
   - tokenizer
   - xml
   - zip
6. **Save** butonuna tıklayın

---

### ÇÖZÜM B: MultiPHP INI Editor

1. cPanel → **MultiPHP INI Editor**
2. Domain seçin
3. Şu ayarları yapın:
   ```
   display_errors = On
   memory_limit = 256M
   upload_max_filesize = 64M
   max_execution_time = 300
   ```
4. Save

---

### ÇÖZÜM C: .htaccess'i Basitleştir

File Manager → `public_html/.htaccess` içeriğini **SADECE** şu şekilde yapın:

```apache
AddHandler application/x-httpd-ea-php83 .php
```

**Başka hiçbir şey olmasın!**

---

## 🧪 TEST DOSYASI OLUŞTUR

File Manager → `public_html/test.php` dosyası oluşturun:

```php
<?php
echo "PHP Version: " . phpversion() . "<br>";
echo "Handler: " . php_sapi_name() . "<br>";
echo "Extensions: " . implode(", ", get_loaded_extensions());
```

Tarayıcıda açın: `http://evahomeworld.com/test.php`

**PHP versiyonu ne gösteriyor?**

---

## 📋 SIRALI KONTROL LİSTESİ

1. ✅ `public_html/.htaccess` ilk satırında `AddHandler application/x-httpd-ea-php83 .php` var mı?
2. ✅ cPanel Select PHP Version'da PHP 8.3 seçili mi?
3. ✅ `vendor/autoload.php` dosyası var mı?
4. ✅ `.env` dosyası doğru mu?
5. ✅ PHP extension'lar yüklü mü?
6. ✅ Error log'da yeni hata var mı?

---

## 🚨 EĞER HALA 500 HATASI ALIYORSANIZ

### Error Log'u Kontrol Et:

```bash
tail -50 ~/public_html/public/error_log
```

**En son hatayı paylaşın!**

---

## 🔍 YAYGIN HATALAR VE ÇÖZÜMLERİ

### Hata 1: "Call to undefined function"
→ PHP extension eksik
**Çözüm:** cPanel → Select PHP Version → Extensions aktif et

### Hata 2: "Class 'X' not found"
→ Composer autoload sorunu
**Çözüm:** 
```bash
cd ~/public_html
php83 composer dump-autoload
php83 artisan optimize:clear
```

### Hata 3: "No application encryption key"
→ .env dosyası sorunu
**Çözüm:**
```bash
php83 artisan key:generate
php83 artisan config:cache
```

---

## ⚡ HIZLI TEST

Tarayıcıda şu adresi açın:

```
http://evahomeworld.com/public/index.php
```

Hata mesajı alıyorsanız, en son hatayı paylaşın.

---

**Test.php'yi oluşturup bana sonucu söyleyin. PHP versiyonu ne?** 🔍
