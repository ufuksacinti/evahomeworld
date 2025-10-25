# 🎯 SON 500 HATASI ÇÖZÜMÜ - Laravel Özel

## ✅ DOĞRULANDI
- ✅ PHP 8.3.23 aktif
- ✅ vendor klasörü mevcut
- ✅ .env dosyası mevcut

## 🚨 SORUN: Ana Site 500 Hatası

---

## 🔥 HEMEN YAPILMASI GEREKENLER

### 1️⃣ Error Log'u Oku

cPanel File Manager → `public_html/public/error_log` dosyasını açın.

**EN SON 5 SATIRI buraya kopyalayın!**

---

### 2️⃣ Laravel Artisan Test

cPanel → Terminal:

```bash
cd ~/public_html

# Laravel artisan test
php83 artisan --version

# Tüm cache'leri temizle
php83 artisan optimize:clear

# Config cache
php83 artisan config:cache

# Route cache
php83 artisan route:cache

# View cache
php83 artisan view:cache
```

---

### 3️⃣ Storage ve Bootstrap Permissions

Terminal'de:

```bash
cd ~/public_html

# Storage permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache

# Owner değiştir (cPanel username)
chown -R xqxevaho:xqxevaho storage
chown -R xqxevaho:xqxevaho bootstrap/cache
```

---

### 4️⃣ .env Dosyası Kontrolü

File Manager → `public_html/.env` dosyasını açın.

Şu satırların doğru olduğundan emin olun:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://evahomeworld.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=xqxevaho_homedb
DB_USERNAME=xqxevaho_ufuk38
DB_PASSWORD=]3Zhem*

SESSION_DRIVER=database
CACHE_DRIVER=file
```

---

## 🔍 YAYGIN HATALAR VE ÇÖZÜMLER

### Hata 1: "SQLSTATE[HY000] [1049] Unknown database"
→ Veritabanı yok

**Çözüm:**
```bash
cd ~/public_html
php83 artisan migrate
```

---

### Hata 2: "The stream or file could not be opened"
→ Storage permissions hatası

**Çözüm:**
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

---

### Hata 3: "Class 'X' not found"
→ Composer autoload hatası

**Çözüm:**
```bash
cd ~/public_html
php83 composer dump-autoload -o
```

---

### Hata 4: "No application encryption key"
→ APP_KEY eksik

**Çözüm:**
```bash
cd ~/public_html
php83 artisan key:generate --force
php83 artisan config:cache
```

---

### Hata 5: "Call to undefined function"
→ PHP extension eksik

**Çözüm:**
cPanel → Select PHP Version → Extensions:
- curl ✅
- fileinfo ✅
- gd ✅
- mbstring ✅
- openssl ✅
- pdo ✅
- pdo_mysql ✅
- tokenizer ✅
- xml ✅
- zip ✅

---

## 🧪 HIZLI TEST KOMUTLARI

```bash
cd ~/public_html

# 1. Artisan test
php83 artisan --version

# 2. Database test
php83 artisan migrate:status

# 3. Cache test
php83 artisan config:show

# 4. Error log
tail -50 public/error_log
```

---

## 🎯 SON ADIM: Database Migration

Eğer veritabanı tabloları yoksa:

```bash
cd ~/public_html

# Migration çalıştır
php83 artisan migrate --force

# Seeder çalıştır
php83 artisan db:seed --force
```

---

## 📋 KONTROL LİSTESİ

1. ✅ Error log'u okudum mu? (EN SON 5 SATIR)
2. ✅ php83 artisan --version çalışıyor mu?
3. ✅ chmod 755 storage bootstrap/cache yaptım mı?
4. ✅ php83 artisan optimize:clear çalıştırdım mı?
5. ✅ .env dosyası doğru mu?
6. ✅ Veritabanı bağlantısı çalışıyor mu?
7. ✅ PHP extension'lar aktif mi?

---

## 🚨 EN ÖNEMLİSİ

**Error log'daki EN SON HATA satırını paylaşın!**

File Manager → `public_html/public/error_log` → En son 5 satır

VEYA

Tarayıcıda: `http://evahomeworld.com/public/error_log`

---

**Error log'daki son hatayı paylaşın, hemen çözelim!** 🔥
