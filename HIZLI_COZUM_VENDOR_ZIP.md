# ⚡️ HIZLI ÇÖZÜM - vendor.zip ile

## 📦 Dosya Durumu
Görselden görüyorum ki:
- ✅ `vendor.zip` mevcut (26.35 MB)
- ❌ `vendor/` klasörü yok
- ❌ `public_html/index.php` yok

## 🚀 HIZLI ÇÖZÜM (3 Adım)

### ADIM 1: vendor.zip'i Çıkart

File Manager'da:
1. `vendor.zip` dosyasına sağ tıkla
2. **Extract** seç
3. Çıkartılan `vendor` klasörünü kontrol et
4. Boyut: ~25-30 MB olmalı

### ADIM 2: index.php Oluştur

File Manager'da `public_html` klasöründe:

1. **+ File** butonuna tıkla
2. Dosya adı: `index.php`
3. İçerik:

```php
<?php

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

require_once __DIR__.'/public/index.php';
```

4. **Save** tıkla

### ADIM 3: Test Et

Tarayıcıda:
- http://evahomeworld.com ✅

---

## ✅ KONTROL LİSTESİ

Şu dosyalar `public_html` içinde olmalı:

- [ ] `vendor/` klasörü var (26+ MB)
- [ ] `index.php` dosyası var
- [ ] `public/` klasörü var
- [ ] `.env` dosyası var

---

## ❌ Sorun Devam Ederse

### vendor klasörü yoksa

Terminal'de:
```bash
cd ~/public_html
php composer.phar install --no-dev
```

### 500 Error

```bash
php artisan key:generate
php artisan config:cache
```

### Cache Temizle

```bash
php artisan optimize:clear
```

---

**5 dakikada çözüm! ⚡️**
