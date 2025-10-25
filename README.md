# EvaHome - Laravel E-Ticaret Projesi

Modern ve full-featured Laravel e-ticaret projesi. Ev mobilyaları ve dekorasyon ürünleri satışı için geliştirilmiştir.

## 🚀 Özellikler

### Kullanıcı Tarafı
- ✅ Modern ve responsive anasayfa
- ✅ Ürün listeleme ve filtreleme
- ✅ Ürün detay sayfası (5-6 görsel, özellikler)
- ✅ Kategori bazlı ürün görüntüleme
- ✅ Sepet sistemi (misafir ve üye)
- ✅ Favori ürünler
- ✅ Sipariş oluşturma
- ✅ Sipariş takibi
- ✅ Blog sistemi
- ✅ Toplu sipariş talebi formu
- ✅ Kullanıcı profili ve adres yönetimi

### Admin Paneli
- ✅ Dashboard (istatistikler, grafikler)
- ✅ Ürün yönetimi (CRUD)
- ✅ Çoklu görsel yükleme
- ✅ Ürün özellikleri yönetimi
- ✅ Kategori yönetimi (hiyerarşik)
- ✅ Sipariş yönetimi ve durum güncelleme
- ✅ Blog yazısı yönetimi
- ✅ En çok görüntülenen ürünler
- ✅ En çok satılan ürünler
- ✅ Stok uyarıları

## 📦 Kurulum

### Gereksinimler
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL/SQLite
- XAMPP veya başka bir local server

### Adım 1: Bağımlılıkları Yükleyin

```bash
composer install
npm install
```

### Adım 2: Environment Ayarları

.env.example dosyasını .env olarak kopyalayın (zaten oluşturuldu):

```bash
# Veritabanı ayarlarını yapılandırın
DB_CONNECTION=sqlite
# SQLite kullanıyoruz (database/database.sqlite)
```

### Adım 3: Veritabanını Hazırlayın

```bash
# Migration'ları çalıştırın
php artisan migrate:fresh

# Demo verileri yükleyin
php artisan db:seed
```

### Adım 4: Storage Link Oluşturun

```bash
php artisan storage:link
```

### Adım 5: Frontend Asset'leri Derleyin

```bash
npm run build
```

### Adım 6: Projeyi Çalıştırın

```bash
php artisan serve
```

Tarayıcınızda `http://localhost:8000` adresini açın.

## 🔐 Giriş Bilgileri

### Admin Kullanıcı
- **Email:** admin@evahome.com
- **Şifre:** password
- **Panel:** http://localhost:8000/admin

### Test Müşteri
- **Email:** musteri@test.com
- **Şifre:** password

## 📊 Veritabanı Yapısı

### Ana Tablolar
- **users** - Kullanıcılar (admin ve müşteriler)
- **categories** - Ürün kategorileri (hiyerarşik)
- **products** - Ürünler
- **product_images** - Ürün görselleri (çoklu)
- **product_attributes** - Ürün özellikleri
- **orders** - Siparişler
- **order_items** - Sipariş detayları
- **carts** - Sepetler
- **cart_items** - Sepet ürünleri
- **favorites** - Favori ürünler
- **campaigns** - Kampanyalar
- **blog_posts** - Blog yazıları
- **blog_categories** - Blog kategorileri
- **bulk_orders** - Toplu sipariş talepleri
- **addresses** - Kullanıcı adresleri
- **settings** - Site ayarları

## 🛣️ Önemli Rotalar

### Frontend
- `/` - Anasayfa
- `/urunler` - Ürün listesi
- `/urunler/{slug}` - Ürün detay
- `/kategori/{slug}` - Kategori sayfası
- `/sepet` - Sepet
- `/favoriler` - Favoriler
- `/blog` - Blog listesi
- `/blog/{slug}` - Blog yazısı
- `/toplu-siparis` - Toplu sipariş formu

### Admin Panel
- `/admin` - Dashboard
- `/admin/products` - Ürün yönetimi
- `/admin/categories` - Kategori yönetimi
- `/admin/orders` - Sipariş yönetimi
- `/admin/blog-posts` - Blog yönetimi

## 💳 Ödeme Entegrasyonu

Proje, Iyzico ve Shopier ödeme sistemleri için hazır altyapıya sahiptir.

### Iyzico Entegrasyonu İçin:
```bash
composer require iyzico/iyzipay-php
```

### Shopier Entegrasyonu İçin:
API anahtarlarınızı `.env` dosyasına ekleyin ve `CartController::processOrder` metodunu güncelleyin.

## 🎨 Frontend Geliştirme

Frontend için Tailwind CSS kullanılmaktadır.

```bash
# Development mode
npm run dev

# Production build
npm run build
```

## 📝 Demo Veriler

Seeder ile oluşturulan demo veriler:
- 2 kullanıcı (1 admin, 1 müşteri)
- 6 ana kategori + 22 alt kategori
- 10 ürün (farklı kategorilerde)
- 4 blog kategorisi
- 5 blog yazısı

## 🔧 Özelleştirme

### Logo ve Site Bilgileri
`resources/views/layouts/main.blade.php` dosyasından logo ve site adını değiştirebilirsiniz.

### Renkler
Tailwind CSS kullanıldığı için `tailwind.config.js` dosyasından renkleri özelleştirebilirsiniz.

## 📱 View Dosyaları (Oluşturulacak)

Aşağıdaki view dosyaları yapılandırma ile oluşturulabilir:

### Frontend Views
- `resources/views/products/index.blade.php` - Ürün listesi
- `resources/views/products/show.blade.php` - Ürün detay
- `resources/views/products/category.blade.php` - Kategori sayfası
- `resources/views/products/favorites.blade.php` - Favoriler
- `resources/views/cart/index.blade.php` - Sepet
- `resources/views/cart/checkout.blade.php` - Ödeme sayfası
- `resources/views/orders/index.blade.php` - Siparişlerim
- `resources/views/orders/show.blade.php` - Sipariş detay
- `resources/views/blog/index.blade.php` - Blog listesi
- `resources/views/blog/show.blade.php` - Blog yazısı
- `resources/views/bulk-order.blade.php` - Toplu sipariş formu

### Admin Views
- `resources/views/admin/dashboard.blade.php` - Dashboard
- `resources/views/admin/products/` - Ürün yönetimi sayfaları
- `resources/views/admin/categories/` - Kategori yönetimi
- `resources/views/admin/orders/` - Sipariş yönetimi
- `resources/views/admin/blog-posts/` - Blog yönetimi

## 🐛 Troubleshooting

### Storage klasörü izinleri
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### Cache temizleme
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

## 📄 Lisans

Bu proje açık kaynak kodludur.

## 👨‍💻 Geliştirici

EvaHome E-Ticaret Projesi - Laravel 12

## 🤝 Katkıda Bulunma

Pull request'ler kabul edilir. Büyük değişiklikler için önce bir issue açın.
