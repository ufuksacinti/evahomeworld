# 🔧 PHP 8.3 - 500 Hatası Çözümü

## ❌ Sorun
PHP 8.3 yükledikten sonra 500 Internal Server Error alıyorsunuz.

## ✅ ADIM ADIM ÇÖZÜM

### ADIM 1: PHP Modüllerini Aktifleştir

1. cPanel → **Select PHP Version**
2. **Extensions** bölümüne gir
3. Şu modülleri **aktif** hale getir:
   - ✅ `php83_mbstring`
   - ✅ `php83_xml`
   - ✅ `php83_mysqlnd` (veya `php83_mysql`)
   - ✅ `php83_zip`
   - ✅ `php83_curl`
   - ✅ `php83_gd`
   - ✅ `php83_intl`
   - ✅ `php83_openssl`
   - ✅ `php83_fileinfo`
   - ✅ `php83_tokenizer`

4. **Save** butonuna tıkla

### ADIM 2: Error Log'u Kontrol Et

cPanel → **File Manager** → `public_html/public/error_log` dosyasını aç

VEYA

Terminal'de:
```bash
tail -f public_html/public/error_log
```

### ADIM 3: Laravel Log Kontrol

Terminal'de:
```bash
cd ~/public_html
tail -50 storage/logs/laravel.log
```

### ADIM 4: Cache Temizle

```bash
# Tüm cache'leri temizle
php artisan optimize:clear

# Config cache
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### ADIM 5: İzinleri Kontrol Et

```bash
# Storage ve cache için izinler
chmod -R 755 storage bootstrap/cache

# Public klasörü
chmod 644 public/.htaccess
```

### ADIM 6: Composer Autoload Yenile

```bash
composer dump-autoload
```

### ADIM 7: En Önemli - .env Kontrol

File Manager → `.env` dosyasını aç ve şunu kontrol et:

```env
APP_ENV=production
APP_DEBUG=false
```

**ÖNEMLİ:** Eğer `APP_DEBUG=true` ise, hataları görebilirsiniz.

---

## 🔍 YAYGIN HATALAR ve ÇÖZÜMLERİ

### Hata 1: "Class not found" veya "Token not found"

```bash
composer install --no-dev
composer dump-autoload -o
```

### Hata 2: "Permission denied" veya "Could not open input file"

```bash
chmod -R 755 storage bootstrap/cache
```

### Hata 3: "Missing extensions"

cPanel → Select PHP Version → Extensions → Eksik modülü aktif et

### Hata 4: Composer platform check hatası

```bash
composer update --with-all-dependencies
```

---

## 🧪 TEST

```bash
# PHP versiyonunu kontrol et
php -v

# Composer yüklenmesini test et
composer diagnose

# Laravel çalışıyor mu?
php artisan about
```

---

## ✅ BAŞARILI OLDUĞUNDA

- ✅ `php -v` → PHP 8.3.x
- ✅ Site açılıyor
- ✅ Laravel log'da hata yok

---

**PHP 8.3'te çalışmalı! 🚀**
