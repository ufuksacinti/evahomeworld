# EvaHome - E-Ticaret Projesi

Laravel tabanlı, Enerji Koleksiyonları ve Ürün Kategorileri ile ürün satışı yapılan modern bir e-ticaret sitesi.

## 📋 Özellikler

### Veritabanı Yapısı

Proje, ürün satışları için optimize edilmiş şu ana tablolara sahiptir:

1. **energy_collections** (Enerji Koleksiyonları)
   - Renk kodları (`color_code`) ile özel koleksiyonlar
   - Açıklama, görsel ve sıralama desteği
   - Aktif/pasif durum yönetimi

2. **categories** (Ürün Kategorileri)
   - Ürün kategorileri
   - Açıklama, görsel ve sıralama desteği
   - Aktif/pasif durum yönetimi

3. **products** (Ürünler)
   - Enerji koleksiyonlarına bağlı
   - Kategorilere bağlı
   - Fiyat, indirim fiyatı, stok yönetimi
   - SEO meta bilgileri
   - Galeri desteği (JSON)
   - Ürün SKU ve slug ile benzersiz tanımlama

4. **product_images** (Ürün Görselleri)
   - Her ürün için çoklu görsel desteği
   - Ana görsel işaretleme
   - Sıralama desteği

### Modeller ve İlişkiler

Tüm modeller arası ilişkiler tanımlanmıştır:

- **EnergyCollection**
  - `products()` - Koleksiyona ait tüm ürünler
  - `activeProducts()` - Aktif ürünler

- **Category**
  - `products()` - Kategoriye ait tüm ürünler
  - `activeProducts()` - Aktif ürünler

- **Product**
  - `energyCollection()` - Ürünün bağlı olduğu koleksiyon
  - `category()` - Ürünün bağlı olduğu kategori
  - `images()` - Ürün görselleri
  - `primaryImage()` - Ana görsel
  - `finalPrice()` - Nihai fiyat (indirim varsa indirimli fiyat)
  - `hasDiscount()` - İndirim kontrolü
  - `discountPercentage()` - İndirim yüzdesi

- **ProductImage**
  - `product()` - Görselin ait olduğu ürün

### Merkezi CSS Yönetim Sistemi

Tüm CSS yapılandırması `resources/css/app.css` dosyasında merkezi olarak yönetilir:

#### Yönetilen Değerler
- **Font Ailesi**: Primary, Secondary, Display fontları
- **Font Boyutları**: xs'den 5xl'e kadar ölçeklenebilir boyutlar
- **Font Ağırlıkları**: Light'dan Extrabold'a kadar
- **Renk Sistemi**: Primary, Secondary, Accent renkler
- **Gri Tonları**: 50'den 900'e kadar nötr renkler
- **Durum Renkleri**: Success, Warning, Error, Info
- **Arka Plan Renkleri**: Primary, Secondary, Tertiary
- **Metin Renkleri**: Primary, Secondary, Tertiary, Light, White
- **Gölgeler**: sm'den 2xl'e kadar shadow değerleri
- **Boşluklar**: 0'dan 32'ye kadar spacing değerleri
- **Border Radius**: none'dan full'e kadar yuvarlatma değerleri
- **Geçişler**: Hızlı, orta, yavaş transition değerleri
- **Z-Index Katmanları**: Modal, Dropdown, Tooltip için katmanlar

#### Kullanım Örneği
CSS dosyasında değişiklik yaparak tüm sitenin stilini tek yerden kontrol edebilirsiniz:

```css
:root {
  --color-primary: #6366f1;  /* Ana rengi değiştirin */
  --font-primary: 'Inter', sans-serif;  /* Font ailesini değiştirin */
  --spacing-4: 1rem;  /* Boşluk değerlerini değiştirin */
}
```

## 🚀 Kurulum

### Gereksinimler
- PHP >= 8.2
- Composer
- MySQL veya SQLite
- Node.js ve NPM (Frontend için)

### Adımlar

1. **Composer bağımlılıklarını yükleyin**:
```bash
composer install
```

2. **Ortam değişkenlerini ayarlayın**:
```bash
cp .env.example .env
php artisan key:generate
```

3. **Veritabanını yapılandırın**:
`.env` dosyasında veritabanı ayarlarınızı yapın.

4. **Veritabanını oluşturun**:
```bash
php artisan migrate
```

5. **Frontend bağımlılıklarını yükleyin**:
```bash
npm install
```

6. **Assets'leri derleyin**:
```bash
npm run dev
# veya production için:
npm run build
```

7. **Sunucuyu başlatın**:
```bash
php artisan serve
```

## 📁 Proje Yapısı

```
evahome/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── HomeController.php
│   │       ├── ProductController.php
│   │       ├── EnergyCollectionController.php
│   │       └── CategoryController.php
│   └── Models/
│       ├── EnergyCollection.php
│       ├── Category.php
│       ├── Product.php
│       └── ProductImage.php
├── database/
│   └── migrations/
│       ├── *_create_energy_collections_table.php
│       ├── *_create_categories_table.php
│       ├── *_create_products_table.php
│       └── *_create_product_images_table.php
├── resources/
│   ├── css/
│   │   └── app.css          # Merkezi CSS yönetim sistemi
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php # Ana layout
│   │   └── home.blade.php
└── routes/
    └── web.php
```

## 🎨 CSS Yönetimi

Tüm stil ayarlarınızı değiştirmek için `resources/css/app.css` dosyasını düzenleyin:

- **Font Ayarları**: `--font-primary`, `--font-secondary` değişkenlerini değiştirin
- **Renkler**: `--color-primary`, `--color-secondary` gibi değişkenleri düzenleyin
- **Arka Plan**: `--bg-primary`, `--bg-secondary` değerlerini ayarlayın
- **Spacing**: `--spacing-*` değerlerini ihtiyacınıza göre ayarlayın

## 🔗 Route'lar

- `/` - Ana sayfa
- `/products` - Ürünler listesi
- `/products/{slug}` - Ürün detayı
- `/collections` - Enerji koleksiyonları listesi
- `/collections/{slug}` - Koleksiyon detayı
- `/categories` - Kategoriler listesi
- `/categories/{slug}` - Kategori detayı

## 📝 Sonraki Adımlar

1. Admin paneli eklenmesi (Laravel Breeze veya Filament kullanılabilir)
2. Sepet ve ödeme sistemi entegrasyonu
3. Kullanıcı kayıt/giriş sistemi
4. Ürün ve kategori yönetimi için admin paneli
5. Görsel yükleme ve yönetim sistemi

## 👥 Katkıda Bulunma

Projeye katkıda bulunmak için:
1. Fork edin
2. Yeni bir branch oluşturun
3. Değişikliklerinizi yapın
4. Pull request gönderin

## 📄 Lisans

Bu proje MIT lisansı altında lisanslanmıştır.

## 📞 İletişim

Sorularınız için: info@evahome.com

---

**EvaHome** - Enerji koleksiyonları ile özel tasarım ürünler
