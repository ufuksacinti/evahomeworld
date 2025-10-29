# 🔧 cPanel 403 Hatası Çözümü

## Sorun
GitHub'dan indirdikten sonra site 403 Forbidden hatası veriyor.

## Çözüm Adımları

### 1. Dosya İzinlerini Düzelt

```bash
# Storage ve cache klasörlerine yazma izni
chmod -R 755 storage
chmod -R 755 bootstrap/cache

# Public klasörüne okuma izni
chmod -R 755 public
chmod 644 public/.htaccess
```

### 2. Document Root Ayarı

cPanel'de 2 seçenek var:

#### SEÇENEK 1: public_html'i public klasörüne yönlendir (ÖNERİLEN)

```bash
# .htaccess'i düzenle (public_html klasöründe)
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ public/$1 [L]
```

#### SEÇENEK 2: public içeriğini doğrudan public_html'e taşı

```bash
cd public_html
cp -r public/* .
rm -rf public
```

### 3. cPanel Ayarları

1. **Domains** → **evahomeworld.com** → **Manage**
2. **Document Root** ayarını kontrol et
3. SSL aktifleştir

### 4. PHP Ayarları

```bash
# PHP version
Select PHP Version → PHP 8.2

# Extensions
- mbstring ✅
- xml ✅
- mysql ✅
- zip ✅
- curl ✅
- gd ✅
- intl ✅
```

### 5. .env Dosyası Kontrolü

```bash
# .env dosyasının doğru yerde olduğundan emin ol
ls -la .env

# İçeriğini kontrol et
cat .env | grep APP_URL
# Şunu görmeli: APP_URL=https://evahomeworld.com
```

### 6. Cache Temizle

```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Tekrar oluştur
php artisan config:cache
php artisan route:cache
```

### 7. Error Log Kontrol

```bash
# Hata loglarını kontrol et
tail -f storage/logs/laravel.log

# Apache error log
tail -f /usr/local/apache/logs/error_log
```

## Hızlı Test

Sunucuda bu komutları çalıştır:

```bash
# 1. İzinleri düzelt
cd ~/public_html
chmod -R 755 storage bootstrap/cache public
chmod 644 public/.htaccess

# 2. Cache temizle
php artisan optimize:clear

# 3. Test
curl -I https://evahomeworld.com
```

## Yaygın Hatalar

### 403 Forbidden
- **Sebep:** .htaccess veya izin sorunu
- **Çözüm:** `chmod 644 public/.htaccess`

### 500 Internal Server Error
- **Sebep:** PHP hatası veya .env eksik
- **Çözüm:** `storage/logs/laravel.log` kontrol et

### Database Connection Error
- **Sebep:** .env'de yanlış DB bilgileri
- **Çözüm:** cPanel MySQL ayarlarını kontrol et

## Sonuç

Eğer hala çalışmıyorsa:

1. cPanel → **Error Logs** kontrol et
2. **PHP Error Log** incele
3. **MySQL** bağlantısını test et

**Başarılar! 🚀**
