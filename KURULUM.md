# EvaHome - Kurulum ve Kullanım Rehberi

## ✅ Tamamlanan İşlemler

### 1. Laravel Kurulumu
- Laravel 12 projesi başarıyla kuruldu
- Tüm bağımlılıklar yüklendi
- Veritabanı yapılandırması hazır

### 2. Veritabanı Yapısı
Dört ana tablo oluşturuldu:

#### a) energy_collections (Enerji Koleksiyonları)
- Renk kodları (`color_code`) ile özel koleksiyonlar
- Her koleksiyon bir renk kodu ile tanımlanır
- Açıklama, görsel ve sıralama desteği

#### b) categories (Kategoriler)
- Ürün kategorileri için yapı
- Açıklama, görsel ve sıralama desteği

#### c) products (Ürünler)
- Enerji koleksiyonlarına bağlı
- Kategorilere bağlı
- Fiyat, indirim ve stok yönetimi
- SEO meta bilgileri
- Galeri desteği

#### d) product_images (Ürün Görselleri)
- Çoklu görsel desteği
- Ana görsel işaretleme
- Sıralama desteği

### 3. Modeller ve İlişkiler
- Tüm modeller oluşturuldu
- İlişkiler (Relationships) tanımlandı
- Helper metodlar eklendi (finalPrice, hasDiscount, vb.)

### 4. Merkezi CSS Yönetim Sistemi
**`resources/css/app.css`** dosyasında:
- Tüm font ayarları
- Tüm renk kodları
- Arka plan renkleri
- Shadow değerleri
- Spacing (Boşluk) değerleri
- Border radius değerleri
- Transition ayarları
- Z-index katmanları

**TEK BİR YERDEN YÖNETİLİYOR!**

### 5. Controller'lar ve Route'lar
- HomeController
- ProductController
- EnergyCollectionController
- CategoryController

### 6. View Yapısı
- Ana layout (`layouts/app.blade.php`)
- Ana sayfa görünümü
- CSS değişkenleri ile entegre tasarım

---

## 📋 Sonraki Adımlar

### Önerilen Sıralama

#### Adım 1: CSS'yi Özelleştirin
`resources/css/app.css` dosyasını açın ve şunları değiştirin:

```css
/* Örnek: Ana rengi değiştirmek */
--color-primary: #6366f1;  /* Kendi renginiz */
--color-secondary: #8b5cf6;  /* İkincil renginiz */

/* Font değiştirmek */
--font-primary: 'Arial', sans-serif;  /* İstediğiniz font */

/* Arka plan */
--bg-primary: #ffffff;  /* Ana arka plan */
```

#### Adım 2: Veritabanını Yapılandırın
`.env` dosyasını düzenleyin:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=evahome
DB_USERNAME=root
DB_PASSWORD=
```

#### Adım 3: Veritabanını Oluşturun
```bash
php artisan migrate
```

#### Adım 4: Örnek Veri Ekleme (İsteğe Bağlı)
Seeder oluşturup test verileri ekleyebilirsiniz:

```bash
php artisan make:seeder EnergyCollectionSeeder
php artisan make:seeder CategorySeeder
php artisan make:seeder ProductSeeder
```

#### Adım 5: Görsel Yükleme İçin Storage Bağlama
```bash
php artisan storage:link
```

#### Adım 6: Asset'leri Derleyin
```bash
npm install
npm run dev
```

#### Adım 7: Server'ı Başlatın
```bash
php artisan serve
```

---

## 🎨 CSS Değişkenleri Nasıl Kullanılır?

### Sınıf İçinde Kullanım

```html
<div style="color: var(--color-primary);">
    Bu metin primary renkte olacak
</div>

<div style="background: var(--bg-secondary); padding: var(--spacing-4);">
    İçerik burada
</div>
```

### Blade Template'lerde

```blade
<div class="bg-primary text-primary" style="padding: var(--spacing-6);">
    Özel içerik
</div>

<h1 style="font-size: var(--font-size-4xl); color: var(--color-accent);">
    Başlık
</h1>
```

### Kendi CSS Dosyanızda

```css
.benim-ozel-buton {
    background-color: var(--color-primary);
    padding: var(--spacing-4) var(--spacing-6);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    transition: var(--transition-base);
}

.benim-ozel-buton:hover {
    background-color: var(--color-primary-dark);
    box-shadow: var(--shadow-lg);
}
```

---

## 🔧 Özelleştirme İpuçları

### 1. Renk Paleti Değiştirme
`resources/css/app.css` dosyasında `:root` bölümündeki renk değerlerini değiştirin:

```css
--color-primary: #YENİ_RENK_1;
--color-secondary: #YENİ_RENK_2;
--color-accent: #YENİ_RENK_3;
```

### 2. Font Değiştirme
Google Fonts'tan font seçin ve `resources/views/layouts/app.blade.php` dosyasına ekleyin.
Sonra `app.css` dosyasında kullanın:

```css
--font-primary: 'Seçtiğiniz Font', sans-serif;
```

### 3. Spacing Değerlerini Ayarlama
Boşluk değerlerini ihtiyacınıza göre ayarlayın:

```css
--spacing-4: 1.5rem;  /* 24px yerine 24px */
--spacing-8: 3rem;    /* 48px yerine 48px */
```

---

## 📝 Önemli Notlar

1. **CSS Dosyası**: Tüm stillerinizi `resources/css/app.css` dosyasından yönetin
2. **Veritabanı**: `php artisan migrate` ile tablolar oluşturuldu
3. **Model İlişkileri**: Tüm ilişkiler tanımlı, güvenle kullanabilirsiniz
4. **Route'lar**: Temel route'lar tanımlandı

---

## 🚀 Başlamak İçin

1. Bu dosyayı okuyun
2. `resources/css/app.css` dosyasını özelleştirin
3. Veritabanı bağlantınızı kontrol edin
4. `php artisan serve` ile başlatın
5. `http://localhost:8000` adresini açın

İyi çalışmalar! 🎉

