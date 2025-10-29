# 🚀 EVA HOME Premium Typography - Hızlı Başlangıç

## ✅ Kurulum Tamamlandı!

### 📦 Yüklenen Font'lar
- ✅ **Playfair Display** (400, 500, 600, 700) - Başlıklar için
- ✅ **Inter** (400, 500, 600, 700) - Gövde metinleri için

### 🎨 Renk Paleti Hazır
```
#1B1B1B - Başlıklar
#222222 - Genel metin
#333333 - Paragraflar  
#000000 - Fiyatlar
#666666 - İkincil bilgiler
#999999 - Placeholder
```

---

## 🎯 Hemen Kullan!

### 1. Başlık Oluştur (Playfair Display)
```blade
<!-- H1 - Hero başlık -->
<x-heading level="1">
    Lüks Ev Dekorasyonu
</x-heading>

<!-- H2 - Bölüm başlığı -->
<x-heading level="2" class="text-center mb-8">
    Öne Çıkan Koleksiyonlar
</x-heading>

<!-- H3 - Kart başlığı -->
<x-heading level="3">
    {{ $collection->name }}
</x-heading>
```

### 2. Fiyat Göster (Inter + Tabular-nums)
```blade
<!-- Normal fiyat -->
<x-price :amount="$product->price" />

<!-- Büyük fiyat -->
<x-price :amount="$product->price" size="2xl" class="text-eva-price" />

<!-- İndirimli fiyat -->
<div class="flex items-center gap-3">
    <x-price :amount="$product->discount_price" 
             size="xl" 
             class="text-red-600 font-bold" />
    <x-price :amount="$product->price" 
             size="sm" 
             class="text-gray-400 line-through" />
</div>
```

### 3. Premium Card
```blade
<div class="premium-card p-6">
    <!-- Görsel -->
    <img src="..." class="w-full rounded-lg mb-4">
    
    <!-- Başlık - Playfair -->
    <x-heading level="4" class="mb-2">
        {{ $product->name }}
    </x-heading>
    
    <!-- Açıklama - Inter -->
    <p class="body-text mb-4">
        {{ $product->short_description }}
    </p>
    
    <!-- Fiyat -->
    <x-price :amount="$product->price" size="lg" />
</div>
```

### 4. Navigation (Inter)
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

### 5. Button (Inter)
```blade
<button class="btn-text bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition">
    Sepete Ekle
</button>
```

---

## 🎨 Utility Classes

### Font Families
```html
<h1 class="font-heading">Playfair Display</h1>
<p class="font-body">Inter</p>
```

### Renkler
```html
<h1 class="text-eva-heading">#1B1B1B</h1>
<p class="text-eva-body">#222</p>
<p class="text-eva-text">#333</p>
<span class="text-eva-price">#000</span>
```

### Özel Sınıflar
```html
<span class="price-text">Fiyat stili</span>
<a class="nav-text">Menü stili</a>
<button class="btn-text">Buton stili</button>
<p class="body-text">Paragraf stili</p>
<h2 class="premium-heading">Premium başlık</h2>
```

---

## 📱 Responsive Örnek

```blade
<section class="py-16">
    <!-- Responsive Başlık -->
    <x-heading level="1" class="text-3xl md:text-5xl lg:text-6xl text-center mb-8">
        Evinize Zarafet Katın
    </x-heading>
    
    <!-- Responsive Paragraf -->
    <p class="text-base md:text-lg lg:text-xl text-eva-text text-center max-w-3xl mx-auto mb-12">
        Özenle seçilmiş premium mobilya ve dekorasyon ürünleri
    </p>
    
    <!-- Responsive Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
            <div class="premium-card p-4">
                <img src="..." class="w-full aspect-square object-cover rounded-lg mb-4">
                <x-heading level="5" class="mb-2">{{ $product->name }}</x-heading>
                <x-price :amount="$product->price" size="lg" />
            </div>
        @endforeach
    </div>
</section>
```

---

## 🎯 Premium Patterns

### Hero Section
```blade
<section class="relative h-screen flex items-center justify-center bg-gray-50">
    <div class="text-center max-w-4xl mx-auto px-4">
        <x-heading level="1" class="mb-6">
            Evinize Zarafet Katın
        </x-heading>
        
        <p class="text-xl text-eva-text mb-8">
            Özenle seçilmiş premium ürünler
        </p>
        
        <button class="btn-text bg-black text-white px-8 py-4 rounded-lg">
            Koleksiyonu Keşfet
        </button>
    </div>
</section>
```

### Product Card
```blade
<div class="group premium-card overflow-hidden">
    <div class="aspect-square overflow-hidden">
        <img src="..." 
             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
    </div>
    
    <div class="p-6">
        <x-heading level="4" class="mb-2 group-hover:text-gray-600 transition">
            {{ $product->name }}
        </x-heading>
        
        <p class="body-text text-sm mb-4 line-clamp-2">
            {{ $product->short_description }}
        </p>
        
        <div class="flex items-center justify-between">
            <x-price :amount="$product->price" size="lg" />
            <button class="btn-text bg-black text-white px-4 py-2 rounded text-sm">
                Görüntüle
            </button>
        </div>
    </div>
</div>
```

### Stats Section
```blade
<div class="grid grid-cols-3 gap-8 py-16 text-center">
    <div>
        <p class="text-5xl font-heading font-bold text-eva-heading mb-2 tabular-nums">
            {{ number_format($stats['products']) }}
        </p>
        <p class="text-eva-muted uppercase tracking-wider text-sm font-medium">
            Ürün
        </p>
    </div>
    
    <div>
        <p class="text-5xl font-heading font-bold text-eva-heading mb-2 tabular-nums">
            {{ number_format($stats['customers']) }}
        </p>
        <p class="text-eva-muted uppercase tracking-wider text-sm font-medium">
            Mutlu Müşteri
        </p>
    </div>
    
    <div>
        <p class="text-5xl font-heading font-bold text-eva-heading mb-2">
            %{{ $stats['satisfaction'] }}
        </p>
        <p class="text-eva-muted uppercase tracking-wider text-sm font-medium">
            Memnuniyet
        </p>
    </div>
</div>
```

---

## 📋 Şablon Yapısı

### Ana Sayfa
```blade
{{-- Hero Section --}}
<section class="relative h-screen bg-gray-50">
    <x-heading level="1" class="text-center">
        Ana Başlık
    </x-heading>
</section>

{{-- Collections Grid --}}
<section class="py-16">
    <x-heading level="2" class="text-center mb-12">
        Koleksiyonlarımız
    </x-heading>
    
    <div class="grid grid-cols-4 gap-8">
        {{-- Collection cards --}}
    </div>
</section>

{{-- Products --}}
<section class="py-16 bg-gray-50">
    <x-heading level="2" class="text-center mb-12">
        Öne Çıkan Ürünler
    </x-heading>
    
    <div class="grid grid-cols-4 gap-6">
        {{-- Product cards --}}
    </div>
</section>
```

### Ürün Detay
```blade
<div class="grid grid-cols-2 gap-12">
    {{-- Sol: Görseller --}}
    <div>
        <img src="..." class="w-full rounded-lg">
    </div>
    
    {{-- Sağ: Bilgiler --}}
    <div>
        <x-heading level="2" class="mb-4">
            {{ $product->name }}
        </x-heading>
        
        <p class="body-text mb-6">
            {{ $product->description }}
        </p>
        
        <div class="bg-gray-50 p-6 rounded-lg mb-6">
            @if($product->hasDiscount())
                <div class="flex items-baseline gap-3 mb-2">
                    <x-price :amount="$product->discount_price" 
                             size="3xl" 
                             class="text-red-600 font-bold" />
                    <x-price :amount="$product->price" 
                             size="lg" 
                             class="text-gray-400 line-through" />
                </div>
            @else
                <x-price :amount="$product->price" 
                         size="3xl" 
                         class="font-bold" />
            @endif
        </div>
        
        <button class="btn-text w-full bg-black text-white py-4 rounded-lg">
            Sepete Ekle
        </button>
    </div>
</div>
```

---

## ✅ Checklist

### Başlarken
- [x] Font'lar yüklendi
- [x] CSS variables tanımlandı
- [x] Tailwind config güncellendi
- [x] Component'ler oluşturuldu
- [x] Build yapıldı

### Şimdi Yapılacaklar
- [ ] Ana sayfa başlıklarını güncelle
- [ ] Ürün kartlarını premium style'a çevir
- [ ] Navigation'ı yeni font ile uyumlu hale getir
- [ ] Fiyatları `<x-price>` component'i ile değiştir
- [ ] Hero section ekle

---

## 🎨 Görsel Hiyerarşi

```
H1 (Playfair 48px Bold)           ← Hero, sayfa başlıkları
  ↓
H2 (Playfair 36px Semibold)       ← Bölüm başlıkları
  ↓
H3 (Playfair 30px Semibold)       ← Alt bölüm başlıkları
  ↓
Body (Inter 16px Regular)         ← Paragraflar
  ↓
Button (Inter 16px Medium)        ← CTA'lar
  ↓
Caption (Inter 14px Regular)      ← Yardımcı bilgiler
```

---

## 🚀 Başlat

```bash
# Development server
php artisan serve

# Vite dev server
npm run dev
```

**Projenize http://localhost:8000 adresinden erişin ve premium tipografiyi görün! 💎**

