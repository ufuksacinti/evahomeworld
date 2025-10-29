# 🚨 VENDOR KLASÖRÜ EKSİK - ÇÖZÜM

## ❌ SORUN
```
Failed to open stream: No such file or directory in /vendor/autoload.php
```

## ✅ ÇÖZÜM: 2 YOL

---

## 🔧 YOL 1: Terminal'de Composer Install (ÖNERİLEN)

### ADIM 1: cPanel Terminal'i Aç
cPanel → Terminal

### ADIM 2: Şu Komutları Çalıştır

```bash
cd ~/public_html

# Composer var mı kontrol et
composer --version

# Eğer composer yoksa
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
chmod +x /usr/local/bin/composer

# Vendor klasörünü oluştur
composer install --no-dev --optimize-autoloader

# Eğer hata verirse
composer install --no-dev --optimize-autoloader --ignore-platform-reqs
```

### ADIM 3: Test Et
```bash
ls -la vendor/
```

---

## 🔧 YOL 2: vendor.zip Dosyasını Aç (HIZLI)

### ADIM 1: File Manager'da vendor.zip'i Bul
File Manager → `public_html/vendor.zip`

### ADIM 2: vendor.zip'i Aç
1. `vendor.zip` üzerine **sağ tık**
2. **Extract** seçeneğine tıklayın
3. Extract location: `/home/xqxevaho/public_html/` (otomatik olmalı)
4. **Extract Files** butonuna tıklayın

### ADIM 3: Klasör Yapısını Kontrol Et
File Manager'da şu klasörler olmalı:
```
public_html/
  ├── vendor/
  │   ├── autoload.php
  │   ├── composer/
  │   ├── laravel/
  │   └── ...
  ├── public/
  ├── .env
  └── ...
```

---

## 🚨 ÖNEMLİ HATIRLATMA

1. **PHP Versiyonu**: PHP 7.4 kullanılıyor, PHP 8.3 olmalı!
   - `/opt/cpanel/ea-php74/root/` → PHP 7.4
   - `/opt/cpanel/ea-php83/root/` → PHP 8.3

2. **PHP Handler**: `public_html/.htaccess` dosyasında:
   ```apache
   AddHandler application/x-httpd-ea-php83 .php
   ```

---

## 🧪 TEST KOMUTLARI

```bash
cd ~/public_html

# PHP versiyonunu kontrol
php83 -v

# Vendor var mı?
ls vendor/autoload.php

# Composer install
composer install --no-dev --optimize-autoloader
```

---

## 📋 KONTROL LİSTESİ

✅ `vendor/autoload.php` dosyası var mı?
✅ `vendor` klasörü `public_html` içinde mi?
✅ PHP 8.3 aktif mi? (`php83 -v`)
✅ `.htaccess` dosyasında PHP 8.3 handler var mı?

---

## 🔄 SON ADIM

Vendor kurulduktan sonra:

```bash
cd ~/public_html

# Laravel cache temizle
php83 artisan optimize:clear

# Config cache
php83 artisan config:cache

# Test et
php83 artisan --version
```

---

## ⚠️ SORUN DEVAM EDERSE

### vendor.zip Yok mu?

File Manager'da `vendor.zip` dosyasını bulamıyorsanız:

1. Lokal bilgisayarınızda:
   ```bash
   cd c:\xampp\htdocs\evahome
   php -v  # PHP 8.2+ olmalı
   composer install --no-dev --optimize-autoloader
   ```

2. `vendor` klasörünü zip'leyin

3. FileZilla/FTP ile `public_html/vendor.zip` olarak yükleyin

4. cPanel File Manager'da açın

---

**Hangi yöntemi kullanacaksınız? Terminal mi, vendor.zip mi?** 🚀
