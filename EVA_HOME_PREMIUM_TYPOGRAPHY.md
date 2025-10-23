# 💎 EVA HOME - Premium Typography System

## 🎨 Font Kombinasyonu: Playfair Display + Inter

### Inspirasyon
- **Jo Malone** - Lüks parfüm markası
- **Dior Home** - Premium ev dekorasyonu  
- **Aesop** - Minimalist ve zarif tasarım

---

## 📖 Font Seçimleri

### 1. Playfair Display (Başlıklar)
```css
font-family: "Playfair Display", Georgia, serif;
font-weight: 600;
color: #1B1B1B;
letter-spacing: 0.2px;
```

**Kullanım Alanları:**
- ✅ H1, H2, H3 başlıklar
- ✅ Hero section başlıkları
- ✅ Bölüm başlıkları
- ✅ Özel vurgulanmış metinler

**Özellikler:**
- Serif, zarif ve lüks görünüm
- Türkçe karakter desteği (%100)
- High contrast, readable
- Premium marka imajı

### 2. Inter (Gövde Metinleri)
```css
font-family: "Inter", system-ui, sans-serif;
font-weight: 400-700;
color: #222 - #333;
letter-spacing: 0-0.2px;
```

**Kullanım Alanları:**
- ✅ Paragraflar
- ✅ Menü ve navigation
- ✅ Butonlar
- ✅ Fiyatlar (tabular-nums)
- ✅ Form elementleri
- ✅ Tüm UI metinleri

**Özellikler:**
- Modern, clean, okunabilir
- Mükemmel tabular-nums desteği
- Web optimized
- Variable font desteği

---

## 🎯 Renk Paleti

```css
:root {
    --color-heading: #1B1B1B;   /* Başlıklar - Koyu siyah */
    --color-body: #222222;      /* Genel metin */
    --color-text: #333333;      /* Paragraflar */
    --color-price: #000000;     /* Fiyatlar - Saf siyah */
    --color-muted: #666666;     /* İkincil bilgiler */
    --color-light: #999999;     /* Placeholder, disabled */
}
```

---

## 📐 Typography Scale

### Başlıklar (Playfair Display)

| Element | Font Size | Line Height | Weight | Letter Spacing |
|---------|-----------|-------------|--------|----------------|
| H1 | 48px (3rem) | 1.1 | 600 | 0.2px |
| H2 | 36px (2.25rem) | 1.2 | 600 | 0.2px |
| H3 | 30px (1.875rem) | 1.2 | 600 | 0.2px |
| H4 | 24px (1.5rem) | 1.2 | 600 | 0.2px |

### Gövde Metinleri (Inter)

| Element | Font Size | Line Height | Weight | Letter Spacing |
|---------|-----------|-------------|--------|----------------|
| Body Text | 16px (1rem) | 1.6 | 400 | 0 |
| Navigation | 14-16px | 1.5 | 500 | 0.2px |
| Button | 14-16px | 1.5 | 500 | 0.2px |
| Price | 16-24px | 1.4 | 500 | 0.1px |

---

## 🚀 Kullanım Örnekleri

### 1. Heading Component
```blade
<!-- H1 Başlık -->
<x-heading level="1">
    Lüks Ev Dekorasyonu
</x-heading>

<!-- H2 Başlık -->
<x-heading level="2" class="text-gray-800">
    Öne Çıkan Koleksiyonlar
</x-heading>

<!-- H3 Başlık -->
<x-heading level="3">
    Yeni Sezon Ürünleri
</x-heading>

<!-- Özel stil ile -->
<x-heading level="1" class="text-center mb-8">
    {{ $collection->name }}
</x-heading>
```

### 2. Price Component (Güncellenmiş)
```blade
<!-- Normal fiyat -->
<x-price :amount="$product->price" />

<!-- Büyük fiyat -->
<x-price :amount="$product->price" size="2xl" />

<!-- İndirimli fiyat -->
<div class="flex items-center gap-3">
    <x-price :amount="$product->discount_price" 
             size="xl" 
             class="text-red-600" />
    <x-price :amount="$product->price" 
             size="sm" 
             class="text-gray-400 line-through" />
</div>
```

### 3. Navigation
```blade
<nav class="flex items-center space-x-8">
    <a href="#" class="nav-text hover:text-eva-heading transition">
        Koleksiyonlar
    </a>
    <a href="#" class="nav-text hover:text-eva-heading transition">
        Yeni Gelenler
    </a>
</nav>
```

### 4. Button
```blade
<button class="btn-text bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition">
    Sepete Ekle
</button>
```

### 5. Product Card (Premium Style)
```blade
<div class="premium-card p-6">
    <!-- Product Image -->
    <img src="..." alt="..." class="w-full rounded-lg mb-4">
    
    <!-- Product Name - Playfair Display -->
    <x-heading level="4" class="mb-2">
        {{ $product->name }}
    </x-heading>
    
    <!-- Description - Inter -->
    <p class="body-text text-eva-text mb-4 line-clamp-2">
        {{ $product->short_description }}
    </p>
    
    <!-- Price - Inter with tabular-nums -->
    <div class="flex items-center justify-between">
        <x-price :amount="$product->getFinalPrice()" 
                 size="lg" 
                 class="text-eva-price" />
        
        <button class="btn-text bg-black text-white px-4 py-2 rounded">
            Görüntüle
        </button>
    </div>
</div>
```

### 6. Hero Section
```blade
<section class="relative h-screen flex items-center justify-center bg-gray-50">
    <div class="text-center max-w-4xl mx-auto px-4">
        <!-- Main Heading - Playfair -->
        <x-heading level="1" class="mb-6">
            Evinize Zarafet Katın
        </x-heading>
        
        <!-- Subtitle - Inter -->
        <p class="text-xl text-eva-text mb-8 max-w-2xl mx-auto">
            Özenle seçilmiş premium mobilya ve dekorasyon ürünleriyle 
            yaşam alanlarınızı dönüştürün.
        </p>
        
        <!-- CTA Button -->
        <button class="btn-text bg-black text-white px-8 py-4 rounded-lg text-lg hover:bg-gray-800 transition">
            Koleksiyonu Keşfet
        </button>
    </div>
</section>
```

---

## 🎨 Tailwind Utility Classes

### Font Families
```html
<!-- Playfair Display -->
<h1 class="font-heading">Başlık</h1>

<!-- Inter -->
<p class="font-body">Metin</p>
<p class="font-sans">Metin (default)</p>
```

### Font Weights
```html
<p class="font-normal">Normal (400)</p>
<p class="font-medium">Medium (500)</p>
<p class="font-semibold">Semibold (600)</p>
<p class="font-bold">Bold (700)</p>
```

### Text Colors
```html
<h1 class="text-eva-heading">#1B1B1B</h1>
<p class="text-eva-body">#222</p>
<p class="text-eva-text">#333</p>
<span class="text-eva-price">#000</span>
<span class="text-eva-muted">#666</span>
<span class="text-eva-light">#999</span>
```

### Letter Spacing
```html
<h1 class="tracking-wider">0.2px</h1>
<p class="tracking-wide">0.1px</p>
<p class="tracking-normal">0</p>
```

### Special Classes
```html
<!-- Price with tabular nums -->
<span class="price-text">₺199,90</span>

<!-- Navigation text -->
<a class="nav-text">Menü</a>

<!-- Button text -->
<button class="btn-text">Buton</button>

<!-- Body text -->
<p class="body-text">Paragraf</p>

<!-- Premium heading -->
<h2 class="premium-heading">Özel Başlık</h2>
```

---

## 📱 Responsive Typography

```blade
<!-- Responsive Heading -->
<x-heading level="1" class="text-3xl md:text-5xl lg:text-6xl">
    Responsive Başlık
</x-heading>

<!-- Responsive Price -->
<x-price :amount="$price" 
         class="text-lg sm:text-xl md:text-2xl lg:text-3xl" />

<!-- Responsive Body Text -->
<p class="text-sm md:text-base lg:text-lg body-text">
    Responsive paragraf metni
</p>
```

---

## 🎯 Premium Design Patterns

### 1. Collection Header
```blade
<div class="text-center py-16 bg-gradient-to-b from-gray-50 to-white">
    <x-heading level="1" class="mb-4">
        {{ $collection->name }}
    </x-heading>
    
    @if($collection->description)
        <p class="text-xl text-eva-text max-w-3xl mx-auto">
            {{ $collection->description }}
        </p>
    @endif
</div>
```

### 2. Product Grid
```blade
<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
    @foreach($products as $product)
        <div class="group premium-card overflow-hidden">
            <div class="aspect-square overflow-hidden mb-4">
                <img src="..." 
                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            </div>
            
            <div class="p-4">
                <x-heading level="5" class="mb-2 group-hover:text-gray-600 transition">
                    {{ $product->name }}
                </x-heading>
                
                <x-price :amount="$product->getFinalPrice()" 
                         size="lg" />
            </div>
        </div>
    @endforeach
</div>
```

### 3. Stats Section
```blade
<div class="grid grid-cols-3 gap-8 py-12">
    <div class="text-center">
        <p class="text-5xl font-heading font-bold text-eva-heading mb-2 tabular-nums">
            {{ number_format($stats['products']) }}
        </p>
        <p class="text-eva-muted uppercase tracking-wider text-sm font-medium">
            Ürün
        </p>
    </div>
    
    <div class="text-center">
        <p class="text-5xl font-heading font-bold text-eva-heading mb-2 tabular-nums">
            {{ number_format($stats['customers']) }}
        </p>
        <p class="text-eva-muted uppercase tracking-wider text-sm font-medium">
            Mutlu Müşteri
        </p>
    </div>
    
    <div class="text-center">
        <p class="text-5xl font-heading font-bold text-eva-heading mb-2">
            %{{ number_format($stats['satisfaction']) }}
        </p>
        <p class="text-eva-muted uppercase tracking-wider text-sm font-medium">
            Memnuniyet
        </p>
    </div>
</div>
```

---

## ✅ Checklist

### Typography
- [x] Playfair Display yüklendi (400, 500, 600, 700)
- [x] Inter yüklendi (400, 500, 600, 700)
- [x] Latin-ext subset aktif (Türkçe karakterler)
- [x] Display: swap aktif
- [x] Preconnect optimize edildi
- [x] CSS variables tanımlandı
- [x] Tailwind config güncellendi

### Components
- [x] `<x-heading>` component'i oluşturuldu
- [x] `<x-price>` component'i güncellendi
- [x] Premium utility class'lar eklendi

### Colors
- [x] EVA HOME renk paleti tanımlandı
- [x] Tailwind color system entegre edildi

### Performance
- [x] Font preload
- [x] Subset optimization
- [x] Display swap

---

## 🚀 Kurulum

```bash
# Assets'i build et
npm run build

# Projeyi başlat
php artisan serve
```

---

## 📊 Performans

**Font Dosya Boyutları:**
```
Playfair Display (4 weights, Latin-ext): ~60KB
Inter (4 weights, Latin-ext): ~60KB
─────────────────────────────────────────
TOPLAM: ~120KB
```

**Yükleme Süresi:**
- Preconnect: ~50ms kazanç
- Font Download: ~200-300ms
- Display Swap: 0ms blocking

---

**Premium e-ticaret deneyimi için hazır! 💎**

