# P1 Geliştirmeleri Kurulum Rehberi

## 📦 Adım 1: Iyzico Paketini Yükleyin

```bash
composer require iyzico/iyzipay-php
```

## 🗄️ Adım 2: Migration'ları Çalıştırın

```bash
php artisan migrate
```

Bu komut aşağıdaki migration'ları çalıştıracak:
- Database indeksler (performans artışı)
- Notifications table (email bildirimleri için)

## ⚙️ Adım 3: Environment Ayarları

`.env` dosyanıza aşağıdaki değişkenleri ekleyin:

```env
# Payment Gateways
IYZICO_API_KEY=
IYZICO_SECRET_KEY=
IYZICO_BASE_URL=https://sandbox-api.iyzipay.com

SHOPIER_API_KEY=
SHOPIER_API_SECRET=

# Mail Settings (Email notifications için)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@evahome.com"
MAIL_FROM_NAME="EvaHome"
```

### Test İçin Iyzico Sandbox Anahtarları:
Iyzico'dan sandbox hesabı oluşturun: https://sandbox-merchant.iyzipay.com/

## 🧹 Adım 4: Cache Temizleme

```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

## 🚀 Adım 5: Projeyi Başlatın

```bash
# Terminal 1: Laravel Server
php artisan serve

# Terminal 2: Vite (Frontend)
npm run dev

# Terminal 3: Queue Worker (Email notifications için)
php artisan queue:work
```

## ✅ Test Etme

### 1. Cache Testi
- Ana sayfayı yükleyin
- Database'de query sayısını kontrol edin (çok azalmalı)
- İkinci yüklemede cache'den geldiğini görün

### 2. Admin Panel Testi
- `/admin` adresine gidin
- Ürün ekleyin/düzenleyin
- Collection seçimi yapabildiğinizi kontrol edin

### 3. Email Notification Testi
```bash
# Test için Mailtrap kullanabilirsiniz
# https://mailtrap.io

# Yeni kullanıcı oluşturun
- Hoş geldin emaili almalısınız

# Sipariş oluşturun
- Sipariş onay emaili almalısınız
```

### 4. Ödeme Testi (Sandbox)
- Sepete ürün ekleyin
- Checkout sayfasına gidin
- Iyzico test kartı: 5528790000000008
- CVV: 123
- Expire: 12/30

## 🔍 Log Kontrolü

```bash
# Ödeme logları
tail -f storage/logs/payment.log

# Sipariş logları
tail -f storage/logs/orders.log

# Genel loglar
tail -f storage/logs/laravel.log
```

## 🛠️ Sorun Giderme

### Cache Çalışmıyor
```bash
php artisan config:cache
php artisan cache:clear
```

### Email Gönderilmiyor
```bash
# Queue'yu kontrol edin
php artisan queue:work

# Mail ayarlarını test edin
php artisan tinker
> Mail::raw('Test', function($msg) { $msg->to('test@test.com')->subject('Test'); });
```

### Indeksler Eklenmiyor
```bash
# Migration'ı tekrar çalıştırın
php artisan migrate:rollback --step=1
php artisan migrate
```

### Observer Çalışmıyor
```bash
# Cache'i temizleyin
php artisan optimize:clear
```

## 📊 Performans Kontrolü

### Önceki durum:
- Ana sayfa: ~150 query
- Collection sayfası: ~80 query

### Sonraki durum (cache ile):
- Ana sayfa: ~20 query
- Collection sayfası: ~15 query

### İndeks kontrolü:
```sql
-- MySQL'de
SHOW INDEX FROM products;
SHOW INDEX FROM collections;

-- SQLite'da
.schema products
```

## 🎉 Tamamlandı!

Artık projeniz:
- ✅ Cache mekanizmasına sahip
- ✅ Database indeksli
- ✅ Ödeme entegrasyonlu
- ✅ Email bildirimli
- ✅ Modern admin panelli

**Başarılı geliştirmeler! 🚀**

