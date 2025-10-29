# 🚨 PHP 7.4 Sorunu - Kalıcı Çözüm

## ❌ Hata
```
Your Composer dependencies require a PHP version ">= 8.2.0". 
You are running 7.4.33.
```

## ✅ MUTLAK ÇÖZÜM

### ADIM 1: Terminal'de Kontrol

cPanel Terminal'de:
```bash
cd ~/public_html
php -v
```

**Eğer hala 7.4 gösteriyorsa:**

### ADIM 2: .htaccess ile Zorla

File Manager → `public_html/.htaccess` dosyasını aç ve **EN BAŞA** ekle:

```apache
# PHP 8.3 Zorla
<IfModule mod_lsapi.c>
   php82
</IfModule>

<IfModule mod_php83.c>
   AddHandler application/x-httpd-ea-php83 .php
</IfModule>
```

### ADIM 3: .user.ini Dosyası

File Manager → `public_html/.user.ini` dosyası oluştur (yoksa):

```ini
php_version=83
```

### ADIM 4: .htaccess'te Rewrite Ekleyin

Eğer .htaccess dosyanız zaten varsa, **mevcut içeriğinize** şunu ekleyin:

```apache
# PHP 8.3
<IfModule mod_php.c>
AddHandler x-httpd-php83 .php
</IfModule>

# VEYA

<IfModule lsapi_module>
   php82
</IfModule>
```

### ADIM 5: Public Klasörü .htaccess

File Manager → `public_html/public/.htaccess` dosyasını aç ve **EN BAŞA** ekle:

```apache
AddHandler application/x-httpd-ea-php83 .php
```

---

## 🔄 YEDEK ÇÖZÜM - cPanel'den

### Çözüm 1: Select PHP Version

1. cPanel → **Select PHP Version**
2. **evahomeworld.com** seç
3. **PHP 8.3** veya **PHP 8.2** seç
4. **Set as current**
5. **Save**

### Çözüm 2: PHP Switcher

1. cPanel → **Software** → **MultiPHP Manager**
2. Domain'i seç
3. **ea-php83** seç
4. **Apply** tıkla

---

## 🧪 KONTROL

```bash
cd ~/public_html
php -v
```

**Çıktı:**
```
PHP 8.3.x
```

VEYA

```bash
php -v | grep -i "PHP 8"
```

---

## ❌ SORUN DEVAM EDERSE

### Terminal'de Manuel Kontrol

```bash
# PHP path'i kontrol et
which php

# PHP config'i kontrol et
php --ini
```

### Index.php Dosyası

File Manager → `public_html/index.php` dosyasının **EN BAŞINA** ekle:

```php
<?php
// PHP 8.3 Zorla
if (version_compare(PHP_VERSION, '8.2.0') < 0) {
    die('PHP 8.2+ required. Current: ' . PHP_VERSION);
}
```

---

## ✅ BAŞARI

Tarayıcıda:
- http://evahomeworld.com

**PHP versiyon hatası olmamalı!**

---

**Mutlaka çalışmalı! 🚀**
