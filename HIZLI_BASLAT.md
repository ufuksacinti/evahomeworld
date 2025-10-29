# 🚀 EVA HOME - Hızlı Başlangıç Rehberi

## ⚡ 3 Adımda Başlat

### 1. Migration & Seed
```bash
php artisan migrate
php artisan db:seed --class=PremiumCollectionSeeder
php artisan db:seed --class=ShopCategorySeeder
```

### 2. Build Assets
```bash
npm run build
```

### 3. Başlat
```bash
php artisan serve
```

**Tarayıcıda:** http://localhost:8000

---

## 🎨 Görmeniz Gerekenler

### ✅ Ana Sayfa
- Premium hero section (Playfair başlık)
- Gold decorative lines
- Wax seal dekorasyonları
- Collection grid (renk kodlu)

### ✅ Navigation
- **SHOP** dropdown → 5 kategori (2 seviye)
- **COLLECTIONS** dropdown → 8 enerji koleksiyonu (renk çemberleri)
- Gold hover effects
- Active page indicators

### ✅ Collection Sayfası
- Dinamik renk arka planları
- Visual feeling gösterimi
- Wax seal dekorasyonları
- Premium gradient boxes

### ✅ Ürün Kartları
- Collection badge (sol üst)
- Wax seal (featured ürünler)
- Tabular-nums fiyatlar
- Premium hover effects

---

## 📁 SVG Dosyalarını Yükleyin (Manuel)

### Logo
```
C:\xampp\htdocs\evahome\public\images\logo\
├── evahome-logo.svg
├── evahome-logo-white.svg
└── evahome-icon.svg
```

### Wax Seal (Balmumu Mühür)
```
C:\xampp\htdocs\evahome\public\images\seals\
├── wax-seal.svg (default)
├── wax-seal-bronze.svg (prinç)
├── wax-seal-gold.svg (altın)
└── wax-seal-silver.svg (gümüş)
```

---

## ⚙️ Environment (.env)

```env
# Temel
APP_NAME=EVA HOME
APP_URL=http://localhost:8000

# Database (SQLite - hazır)
DB_CONNECTION=sqlite

# Ödeme (Iyzico - sandbox)
IYZICO_API_KEY=your_sandbox_key
IYZICO_SECRET_KEY=your_sandbox_secret
IYZICO_BASE_URL=https://sandbox-api.iyzipay.com

# Mail (Mailtrap veya SMTP)
MAIL_MAILER=log
MAIL_FROM_ADDRESS="noreply@evahome.com"
MAIL_FROM_NAME="EVA HOME"
```

---

## 🎯 Test Senaryoları

### 1. Ana Sayfa
- [ ] Premium hero görünüyor
- [ ] Wax seal dekorasyonları var
- [ ] Collection kartları renk gradientli
- [ ] Gold accents aktif

### 2. Navigation
- [ ] SHOP dropdown açılıyor
- [ ] Ceramic → Mini/Large Vases alt kategorileri
- [ ] Glass → Candles/Vases alt kategorileri
- [ ] COLLECTIONS → 8 koleksiyon renk çemberleriyle
- [ ] Hover gold efekt çalışıyor

### 3. Collection Sayfası
- [ ] Renk arka planı aktif
- [ ] Visual feeling gösteriliyor
- [ ] Story box gold kenarlıklı
- [ ] Ürün kartlarında collection badge var

### 4. Ürün Detay
- [ ] Collection badge görünüyor
- [ ] Featured ürünlerde wax seal var
- [ ] Fiyatlar hizalı (tabular-nums)
- [ ] Premium butonlar çalışıyor

---

## 🎨 Component Kullanımı

### Hızlı Referans
```blade
<!-- Başlık -->
<x-heading level="1">Başlık</x-heading>

<!-- Fiyat -->
<x-price :amount="199.90" size="lg" />

<!-- Collection Badge -->
<x-collection-badge :collection="$collection" />

<!-- Wax Seal -->
<x-wax-seal type="gold" size="lg" />

<!-- Logo -->
<x-logo size="lg" />
```

---

## 🐛 Sorun Giderme

### Logo/Seal Görünmüyor?
```bash
# Cache temizle
php artisan view:clear

# SVG dosyalarını kontrol et
ls public/images/logo/
ls public/images/seals/
```

### Renkler Çalışmıyor?
```bash
# Build tekrar yap
npm run build

# Config cache temizle
php artisan config:clear
```

### Menu Görünmüyor?
```bash
# View cache temizle
php artisan view:clear

# Seeder çalıştır
php artisan db:seed --class=ShopCategorySeeder
```

---

## 📞 Yardım

**Dokümantasyon:**
- TAMAMLANAN_GELISTIRMELER_FINAL.md
- EVA_HOME_PREMIUM_TYPOGRAPHY.md
- PREMIUM_RENK_SISTEMI.md

**Başarılı alışverişler! 💎✨**

