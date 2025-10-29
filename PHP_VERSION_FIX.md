# 🔧 PHP Versiyon Hatası - Çözüm

## ❌ Hata
```
Fatal error: Composer detected issues in your platform: 
Your Composer dependencies require a PHP version ">= 8.2.0". 
You are running 7.4.33.
```

## ✅ ÇÖZÜM

### ADIM 1: PHP Versiyonunu Değiştir

1. **cPanel** → **Select PHP Version**
2. **evahomeworld.com** domain'ini seç
3. Dropdown'dan **PHP 8.2** seç
4. **Set as current** butonuna tıkla

**ÖNEMLİ:** Modül seçimlerini kontrol et:
- ✅ `php82_mbstring`
- ✅ `php82_xml`
- ✅ `php82_mysqlnd` (veya `php82_mysql`)
- ✅ `php82_zip`
- ✅ `php82_curl`
- ✅ `php82_gd`
- ✅ `php82_intl`
- ✅ `php82_openssl`

5. **Save** butonuna tıkla

### ADIM 2: PHP Versiyonunu Kontrol Et

Terminal'de:
```bash
cd ~/public_html
php -v
```

**Çıktı şöyle olmalı:**
```
PHP 8.2.x
```

### ADIM 3: Laravel Ayarları

Terminal'de:
```bash
# Cache temizle
php artisan optimize:clear

# Config cache
php artisan config:cache
```

### ADIM 4: Test Et

Tarayıcıda:
- http://evahomeworld.com

---

## 🔍 PHP Versiyonu Hala Eski Görünüyorsa

### Çözüm 1: .htaccess ile PHP Versiyonu Ayarla

File Manager → `public_html/.htaccess` dosyasına ekle:

```apache
<IfModule mod_php8.c>
    AddHandler application/x-httpd-ea-php82___lsphp .php
</IfModule>
```

### Çözüm 2: .user.ini Dosyası

File Manager → `public_html/` klasöründe `.user.ini` dosyası oluştur:

```ini
php_version=82
```

---

## ✅ BAŞARILI OLDUĞUNDA

Terminal'de `php -v` komutu:
```
PHP 8.2.x
```

Site açıldığında:
- ✅ Hata yok
- ✅ Laravel çalışıyor

---

**PHP 8.2 aktif olmalı! 🚀**
