# Font Yapılandırması - EvaHome

## 🎨 Seçilen Font: Inter

**Inter**, modern e-ticaret siteleri için özel olarak optimize edilmiş, okunabilirliği yüksek bir fontur.

## ⚙️ Yapılandırma Detayları

### 1. Font Ağırlıkları
```
- 400 (Normal) - Genel metin içeriği için
- 500 (Medium) - Başlıklar, navigation, butonlar için
- 700 (Bold)   - Vurgular, önemli başlıklar için
```

### 2. Subset
```
Latin-ext (Latin Extended)
```
Türkçe karakterler (ğ, ü, ş, ı, ö, ç, Ğ, Ü, Ş, İ, Ö, Ç) dahil.

### 3. Performans Optimizasyonları

#### Preconnect
```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
```
- DNS çözümlemesi ve bağlantı kurulumu önceden yapılıyor
- Font yükleme hızı %30-50 artıyor

#### Display: Swap
```html
&display=swap
```
- Sayfa render edilirken fallback font gösteriliyor
- Font yüklenince Inter'e geçiş yapılıyor
- Flash of Invisible Text (FOIT) önleniyor

### 4. Tabular Nums (Fiyatlar için)

#### CSS Utility Class
```css
.tabular-nums {
    font-variant-numeric: tabular-nums;
}
```

#### Avantajları
- Her rakam eşit genişlikte
- Fiyatlar alt alta gelince hizalı
- Animasyonlarda kaymalar olmuyor
- Tablo ve liste görünümlerinde düzenli

## 🚀 Kullanım

### 1. Blade Component ile Fiyat Gösterimi

```blade
<!-- Basit kullanım -->
<x-price :amount="199.90" />
<!-- Çıktı: ₺199,90 -->

<!-- Para birimi olmadan -->
<x-price :amount="199.90" :showCurrency="false" />
<!-- Çıktı: 199,90 -->

<!-- Farklı boyutlar -->
<x-price :amount="199.90" size="xs" />
<x-price :amount="199.90" size="sm" />
<x-price :amount="199.90" size="base" />
<x-price :amount="199.90" size="lg" />
<x-price :amount="199.90" size="xl" />
<x-price :amount="199.90" size="2xl" />
<x-price :amount="199.90" size="3xl" />

<!-- Özel class'lar ile -->
<x-price :amount="199.90" class="text-red-600" />
```

### 2. Manuel Tabular-Nums Kullanımı

```blade
<!-- Herhangi bir sayı için -->
<span class="tabular-nums">1234</span>
<span class="tabular-nums">5678</span>

<!-- Fiyat class'ı (tabular-nums + font-medium) -->
<span class="price">₺199,90</span>

<!-- Tailwind ile kombine -->
<div class="text-2xl font-bold tabular-nums text-green-600">
    ₺1.299,00
</div>
```

### 3. Font Ağırlıkları

```blade
<!-- Normal (400) - Default -->
<p class="font-normal">Normal metin içeriği</p>

<!-- Medium (500) - Vurgular -->
<p class="font-medium">Önemli bilgi</p>

<!-- Bold (700) - Başlıklar -->
<h1 class="font-bold text-3xl">Ana Başlık</h1>
```

## 📊 Performans Metrikleri

### Font Yükleme Boyutu
```
Inter 400: ~15KB (woff2, Latin-ext)
Inter 500: ~15KB (woff2, Latin-ext)
Inter 700: ~16KB (woff2, Latin-ext)
---
Toplam: ~46KB
```

### Yükleme Süresi (Ortalama)
```
DNS Preconnect: ~50ms kazanç
Font Download: ~100-200ms
Display Swap: 0ms blocking (FOIT yok)
```

## 🎯 Uygulama Alanları

### 1. Fiyatlar
```blade
<!-- Ürün kartlarında -->
<x-price :amount="$product->getFinalPrice()" size="lg" />

<!-- Sepet toplamı -->
<x-price :amount="$cart->getTotalAmount()" size="2xl" class="text-green-600" />

<!-- İndirimli fiyat -->
<div class="flex items-center gap-2">
    <x-price :amount="$product->discount_price" size="xl" class="text-red-600" />
    <x-price :amount="$product->price" size="sm" class="line-through text-gray-400" />
</div>
```

### 2. Stok Sayıları
```blade
<span class="tabular-nums font-medium">
    Stok: {{ $product->stock }}
</span>
```

### 3. Sipariş Numaraları
```blade
<span class="tabular-nums font-mono">
    #{{ $order->order_number }}
</span>
```

### 4. İstatistikler (Dashboard)
```blade
<div class="tabular-nums text-4xl font-bold text-blue-600">
    {{ number_format($stats['total_revenue'], 2) }}
</div>
```

## 🔧 Özelleştirme

### Tailwind Config'de Ek Ayarlar

```js
// tailwind.config.js
theme: {
    extend: {
        fontSize: {
            'price-sm': ['0.875rem', { lineHeight: '1.25rem', letterSpacing: '-0.01em' }],
            'price-base': ['1rem', { lineHeight: '1.5rem', letterSpacing: '-0.01em' }],
            'price-lg': ['1.125rem', { lineHeight: '1.75rem', letterSpacing: '-0.02em' }],
            'price-xl': ['1.5rem', { lineHeight: '2rem', letterSpacing: '-0.02em' }],
        }
    }
}
```

### Özel Price Varyantları

```css
/* resources/css/app.css */
@layer components {
    .price-discount {
        @apply tabular-nums font-bold text-red-600;
    }
    
    .price-original {
        @apply tabular-nums font-normal text-gray-400 line-through;
    }
    
    .price-total {
        @apply tabular-nums font-bold text-2xl text-green-600;
    }
}
```

## 📱 Responsive Font Boyutları

```blade
<!-- Responsive fiyat -->
<div class="text-sm sm:text-base md:text-lg lg:text-xl tabular-nums">
    ₺{{ number_format($price, 2) }}
</div>
```

## ✅ Best Practices

### DO ✓
- Fiyatlar için her zaman `tabular-nums` kullan
- Component'i kullanarak tutarlılık sağla
- Büyük fiyatlar için `font-bold` ekle
- İndirimlerde renk kontrastı sağla

### DON'T ✗
- Fiyatlarda proportional-nums kullanma
- Font ağırlığını inline style ile değiştirme
- Her sayı için tabular-nums ekleme (gereksiz)
- Font dosyalarını local'de host etme (CDN daha hızlı)

## 🧪 Test Senaryoları

### Görsel Test
```
₺199,90
₺1.299,00
₺12.999,90
₺123.456,78
```
Yukarıdaki fiyatlar alt alta gelince virgüller hizalı olmalı.

### Performans Test
```bash
# Font yükleme testi
curl -I https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700

# PageSpeed Insights
https://pagespeed.web.dev/
```

## 🔄 Güncelleme Süreci

1. **Font değişikliği için:**
   - `resources/views/layouts/main.blade.php` ve `app.blade.php`'yi güncelle
   - `tailwind.config.js`'te fontFamily'yi değiştir

2. **Ağırlık ekleme için:**
   - Font URL'ine yeni ağırlığı ekle: `&wght@400;500;600;700`
   - `tailwind.config.js`'te fontWeight'e ekle

3. **Rebuild:**
```bash
npm run build
```

## 📚 Kaynaklar

- [Inter Font](https://rsms.me/inter/)
- [Google Fonts](https://fonts.google.com/specimen/Inter)
- [Font Variant Numeric](https://developer.mozilla.org/en-US/docs/Web/CSS/font-variant-numeric)
- [Web Font Optimization](https://web.dev/font-best-practices/)

---

**Not:** Font yapılandırması production'a geçmeden önce PageSpeed Insights ile test edilmelidir.

