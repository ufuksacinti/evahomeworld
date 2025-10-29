# 🚨 ACİL DÜZELTMELER - cPanel Deploy

## Mevcut Sorunlar
1. ❌ `vendor` klasörü eksik
2. ❌ Document root yanlış ayarlanmış
3. ❌ Dizin listelemesi açık

## HIZLI ÇÖZÜM

### 1. Composer Bağımlılıklarını Yükle

```bash
# cPanel Terminal'de çalıştır
cd ~/public_html

# Composer'ı global yükle (ilk kez çalıştırıyorsan)
curl -sS https://getcomposer.org/installer | php
php composer.phar install --no-dev --optimize-autoloader

# VEYA composer zaten yüklüyse
composer install --no-dev --optimize-autoloader
```

### 2. Document Root'u Düzelt

**SEÇENEK 1: Document Root'u Değiştir (ÖNERİLEN)**

1. cPanel → **Domains** → **evahomeworld.com**
2. **Manage** butonuna tıkla
3. **Document Root** değerini değiştir:
   - ESKİ: `public_html`
   - YENİ: `public_html/public`
4. **Change** butonuna tıkla

**SEÇENEK 2: .htaccess ile Yönlendirme**

cPanel → File Manager → `public_html/.htaccess` dosyası oluştur:

```apache
RewriteEngine On
RewriteCond %{REQUEST_URI} !^/public/
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ public/$1 [L]
```

### 3. .env Dosyası Oluştur

```bash
cd ~/public_html
cp env.example.txt .env
nano .env
```

**.env içeriği:**
```env
APP_NAME=EvaHome
APP_ENV=production
APP_DEBUG=false
APP_URL=https://evahomeworld.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=xqxevaho_homedb
DB_USERNAME=xqxevaho_ufuk38
DB_PASSWORD=]3Zhem*

CACHE_STORE=file
SESSION_DRIVER=database
```

### 4. Laravel Setup

```bash
php artisan key:generate
php artisan config:cache
php artisan storage:link
```

### 5. PHP Versiyonunu Değiştir

cPanel → **Select PHP Version** → **PHP 8.2** seç

### 6. İzinleri Düzelt

```bash
chmod -R 755 storage bootstrap/cache
chmod 644 public/.htaccess
```

---

## TAM KURULUM KOMUT DİZİSİ

Terminal'de şu komutları sırayla çalıştır:

```bash
# 1. Dizine git
cd ~/public_html

# 2. Composer ile bağımlılıkları yükle
php composer.phar install --no-dev --optimize-autoloader

# 3. .env dosyası oluştur
cp env.example.txt .env
nano .env  # Yukarıdaki içeriği yapıştır ve Ctrl+X, Y, Enter

# 4. Laravel key generate
php artisan key:generate

# 5. Veritabanı migration
php artisan migrate --force

# 6. Cache oluştur
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 7. Storage link
php artisan storage:link

# 8. İzinler
chmod -R 755 storage bootstrap/cache
chmod 644 public/.htaccess
```

---

## SORUN ÇÖZÜLMEDİYSE

### vendor.zip'ten Çıkartma

File Manager'da:
1. `vendor.zip` dosyasına sağ tıkla → **Extract**
2. Çıkartılan `vendor` klasörünü kontrol et
3. Boyut: ~10-15 MB olmalı

### Cache Temizleme

```bash
php artisan optimize:clear
php artisan config:cache
```

### Error Log Kontrol

```bash
tail -f storage/logs/laravel.log
```

---

## BAŞARILI MESAJ

Site çalıştığında şunu görmelisiniz:
- ✅ Ana sayfa açılıyor (403 yok)
- ✅ "EVA HOME" başlığı görünüyor
- ✅ CSS'ler yükleniyor

**Not:** Document Root değişikliği 5-10 dakika sürebilir.

**Başarılar! 🚀**
