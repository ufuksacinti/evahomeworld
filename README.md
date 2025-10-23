# EvaHome - Laravel E-ticaret Projesi

Modern ve kullanıcı dostu Laravel tabanlı e-ticaret platformu.

## 🚀 Özellikler

- **Modern Laravel 11** framework
- **Tailwind CSS** ile responsive tasarım
- **Admin Panel** - Kapsamlı yönetim sistemi
- **E-ticaret** - Ürün, kategori, sipariş yönetimi
- **Blog Sistemi** - İçerik yönetimi
- **Kullanıcı Yönetimi** - Kayıt, giriş, profil
- **Ödeme Sistemi** - Iyzico entegrasyonu
- **SEO Optimizasyonu** - Meta taglar ve URL yapısı

## 📋 Gereksinimler

- **PHP 8.2+**
- **MySQL 5.7+**
- **Composer**
- **Node.js & NPM**

## 🔧 Kurulum

### 1. Projeyi İndirin
```bash
git clone https://github.com/ufuksacinti/evahome-clean.git
cd evahome-clean
```

### 2. Bağımlılıkları Yükleyin
```bash
composer install
npm install
```

### 3. Ortam Dosyasını Ayarlayın
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Veritabanını Kurun
```bash
php artisan migrate --seed
```

### 5. Frontend Assetlerini Build Edin
```bash
npm run build
```

### 6. Sunucuyu Başlatın
```bash
php artisan serve
```

## 🌐 Production Deploy

### cPanel ile Deploy
1. GitHub repository'yi cPanel Git Version Control'e bağlayın
2. `.cpanel.yml` dosyası otomatik deploy sağlar
3. Production ayarları `.env` dosyasında hazır

### Manuel Deploy
1. Dosyaları sunucuya yükleyin
2. `composer install --no-dev --optimize-autoloader` çalıştırın
3. `php artisan migrate --force` çalıştırın
4. Storage ve bootstrap/cache izinlerini ayarlayın

## 📁 Proje Yapısı

```
evahome/
├── app/                    # Laravel uygulama dosyaları
├── config/                 # Konfigürasyon dosyaları
├── database/               # Migration ve seed dosyaları
├── public/                 # Web erişilebilir dosyalar
├── resources/              # View, CSS, JS dosyaları
├── routes/                 # Route tanımları
├── storage/                # Log ve cache dosyaları
├── tests/                  # Test dosyaları
├── .env                    # Ortam değişkenleri
├── .htaccess               # Apache yönlendirme kuralları
└── composer.json           # PHP bağımlılıkları
```

## 🔑 Varsayılan Giriş Bilgileri

### Admin Paneli
- **URL:** `/admin`
- **Email:** `admin@evahome.com`
- **Şifre:** `password`

## 🛠️ Geliştirme

### Yeni Özellik Ekleme
1. Feature branch oluşturun
2. Değişikliklerinizi yapın
3. Test edin
4. Pull request oluşturun

### Veritabanı Değişiklikleri
```bash
php artisan make:migration create_new_table
php artisan migrate
```

## 📞 Destek

Sorunlar için GitHub Issues kullanın veya iletişime geçin.

## 📄 Lisans

Bu proje MIT lisansı altında lisanslanmıştır.

---

**EvaHome** - Ev dekorasyonunda kalite ve şıklığın buluştuğu yer! 🏠✨