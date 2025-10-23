# 🎨 EVA HOME - Logo ve Balmumu Mühür Kullanım Rehberi

## 📁 SVG Dosyalarınızı Nereye Yükleyin?

### ✅ Oluşturulan Klasörler

```
public/
  └── images/
      ├── logo/          ← Logo dosyaları buraya
      └── seals/         ← Balmumu mühür dosyaları buraya
```

---

## 📦 1. Logo Dosyaları

### Yükleme Yeri
```
public/images/logo/
```

### Önerilen Dosya İsimleri
```
evahome-logo.svg         ← Ana logo (renkli)
evahome-logo-white.svg   ← Beyaz logo (koyu arkaplan için)
evahome-logo-dark.svg    ← Koyu logo (açık arkaplan için)
evahome-icon.svg         ← Sadece icon (küçük boyutlar için)
```

### Nasıl Yüklerim?
1. Windows Explorer'da projeyi açın
2. `C:\xampp\htdocs\evahome\public\images\logo\` klasörüne gidin
3. SVG dosyalarınızı buraya kopyalayın

---

## 🔖 2. Balmumu Mühür Dosyaları

### Yükleme Yeri
```
public/images/seals/
```

### Önerilen Dosya İsimleri
```
wax-seal.svg            ← Ana mühür (default)
wax-seal-bronze.svg     ← Bronz renk mühür
wax-seal-gold.svg       ← Altın renk mühür
wax-seal-silver.svg     ← Gümüş renk mühür
```

### Nasıl Yüklerim?
1. Windows Explorer'da projeyi açın
2. `C:\xampp\htdocs\evahome\public\images\seals\` klasörüne gidin
3. SVG dosyalarınızı buraya kopyalayın

---

## 🚀 Kullanım Örnekleri

### 1. Logo Kullanımı

#### Blade Component ile (Önerilen)
```blade
<!-- Ana logo -->
<x-logo />

<!-- Beyaz logo (koyu arkaplan için) -->
<x-logo variant="white" />

<!-- Koyu logo -->
<x-logo variant="dark" />

<!-- Sadece icon -->
<x-logo variant="icon" />

<!-- Farklı boyutlar -->
<x-logo size="xs" />    <!-- 24px -->
<x-logo size="sm" />    <!-- 32px -->
<x-logo size="md" />    <!-- 40px - default -->
<x-logo size="lg" />    <!-- 48px -->
<x-logo size="xl" />    <!-- 64px -->
<x-logo size="2xl" />   <!-- 80px -->

<!-- Özel class ile -->
<x-logo class="hover:opacity-80 transition" />
```

#### Manuel Kullanım
```blade
<img src="{{ asset('images/logo/evahome-logo.svg') }}" 
     alt="EVA HOME" 
     class="h-10">
```

---

### 2. Balmumu Mühür Kullanımı

#### Blade Component ile (Önerilen)
```blade
<!-- Default mühür -->
<x-wax-seal />

<!-- Farklı renk varyantları -->
<x-wax-seal type="bronze" />
<x-wax-seal type="gold" />
<x-wax-seal type="silver" />

<!-- Farklı boyutlar -->
<x-wax-seal size="xs" />    <!-- 32px -->
<x-wax-seal size="sm" />    <!-- 48px -->
<x-wax-seal size="md" />    <!-- 64px - default -->
<x-wax-seal size="lg" />    <!-- 96px -->
<x-wax-seal size="xl" />    <!-- 128px -->
<x-wax-seal size="2xl" />   <!-- 160px -->

<!-- Özel class ile -->
<x-wax-seal class="opacity-80 hover:opacity-100 transition" />
```

#### Manuel Kullanım
```blade
<img src="{{ asset('images/seals/wax-seal.svg') }}" 
     alt="Premium Seal" 
     class="w-16 h-16">
```

---

## 🎨 Kullanım Senaryoları

### 1. Navbar'da Logo
```blade
<!-- resources/views/layouts/main.blade.php -->
<header class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <a href="{{ route('home') }}">
                <x-logo size="lg" class="hover:opacity-80 transition" />
            </a>
            
            <!-- Navigation -->
            <nav class="flex items-center space-x-8">
                <!-- ... -->
            </nav>
        </div>
    </div>
</header>
```

### 2. Ürün Kartında Mühür (Premium Badge)
```blade
<div class="relative premium-card">
    <!-- Mühür - sağ üst köşede -->
    <div class="absolute -top-4 -right-4 z-10">
        <x-wax-seal type="gold" size="lg" />
    </div>
    
    <!-- Ürün görseli -->
    <img src="{{ $product->image }}" class="w-full rounded-lg">
    
    <!-- Ürün bilgileri -->
    <x-heading level="4" class="mt-4">{{ $product->name }}</x-heading>
    <x-price :amount="$product->price" size="lg" />
</div>
```

### 3. Collection Sayfasında Premium Badge
```blade
<section class="relative py-16 bg-gray-50">
    <!-- Dekoratif mühür - arka planda -->
    <div class="absolute top-8 right-8 opacity-10">
        <x-wax-seal type="bronze" size="2xl" />
    </div>
    
    <div class="relative z-10">
        <x-heading level="1" class="text-center mb-12">
            Premium Koleksiyon
        </x-heading>
        
        <!-- Collection grid -->
    </div>
</section>
```

### 4. Ürün Detayında Premium İşareti
```blade
<div class="grid grid-cols-2 gap-12">
    <!-- Sol: Görseller -->
    <div class="relative">
        <img src="{{ $product->image }}" class="w-full rounded-lg">
        
        <!-- Eğer premium ürünse mühür göster -->
        @if($product->is_premium)
            <div class="absolute top-4 right-4">
                <x-wax-seal type="gold" size="xl" />
            </div>
        @endif
    </div>
    
    <!-- Sağ: Bilgiler -->
    <div>
        <x-heading level="2" class="mb-4">
            {{ $product->name }}
        </x-heading>
        <!-- ... -->
    </div>
</div>
```

### 5. Footer'da Logo
```blade
<footer class="bg-gray-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-4 gap-8">
            <div>
                <!-- Beyaz logo (koyu arkaplan için) -->
                <x-logo variant="white" size="xl" class="mb-4" />
                <p class="text-gray-400">
                    Eviniz için en kaliteli mobilyalar
                </p>
            </div>
            <!-- ... -->
        </div>
    </div>
</footer>
```

### 6. Certificate Badge (Sertifika Rozeti)
```blade
<div class="flex items-center gap-4 p-6 bg-gray-50 rounded-lg">
    <x-wax-seal type="silver" size="lg" />
    
    <div>
        <h4 class="font-heading font-semibold text-lg">
            100% Doğal Malzeme
        </h4>
        <p class="text-sm text-gray-600">
            Tüm ürünlerimiz el yapımı ve doğal malzemelerden üretilmiştir
        </p>
    </div>
</div>
```

### 7. Premium Product Tag
```blade
<!-- Ürün listesinde -->
@foreach($products as $product)
    <div class="group premium-card relative">
        <!-- Premium işareti -->
        @if($product->is_featured || $product->is_premium)
            <div class="absolute top-2 right-2 z-10">
                <x-wax-seal type="gold" size="sm" 
                            class="drop-shadow-lg" />
            </div>
        @endif
        
        <!-- Ürün içeriği -->
        <img src="..." class="w-full">
        <x-heading level="5">{{ $product->name }}</x-heading>
        <x-price :amount="$product->price" />
    </div>
@endforeach
```

### 8. Hero Section'da Dekoratif Kullanım
```blade
<section class="relative h-screen flex items-center justify-center overflow-hidden">
    <!-- Dekoratif mühürler - arka plan -->
    <div class="absolute inset-0 overflow-hidden opacity-5">
        <x-wax-seal type="bronze" size="2xl" 
                    class="absolute top-10 left-10 rotate-12" />
        <x-wax-seal type="gold" size="2xl" 
                    class="absolute bottom-20 right-20 -rotate-12" />
        <x-wax-seal type="silver" size="2xl" 
                    class="absolute top-1/2 left-1/4 rotate-45" />
    </div>
    
    <!-- Hero içerik -->
    <div class="relative z-10 text-center">
        <x-heading level="1" class="mb-6">
            El İşçiliği, Doğal Ürünler
        </x-heading>
        <p class="text-xl text-eva-text mb-8">
            Her ürün özenle seçilmiş doğal malzemelerden üretilir
        </p>
    </div>
</section>
```

### 9. About Us / Hakkımızda Sayfası
```blade
<section class="py-16">
    <div class="max-w-4xl mx-auto text-center">
        <!-- Merkezi büyük mühür -->
        <div class="mb-8 flex justify-center">
            <x-wax-seal type="gold" size="2xl" />
        </div>
        
        <x-heading level="1" class="mb-6">
            Kalite Sözümüzdür
        </x-heading>
        
        <p class="text-lg text-eva-text mb-8">
            2010'dan beri el yapımı, doğal ve premium ürünler üretiyoruz
        </p>
        
        <!-- Özellikler -->
        <div class="grid grid-cols-3 gap-8 mt-12">
            <div>
                <x-wax-seal type="bronze" size="lg" class="mx-auto mb-4" />
                <h3 class="font-heading font-semibold mb-2">El İşçiliği</h3>
                <p class="text-sm text-gray-600">Her ürün özenle yapılır</p>
            </div>
            
            <div>
                <x-wax-seal type="gold" size="lg" class="mx-auto mb-4" />
                <h3 class="font-heading font-semibold mb-2">Doğal Malzeme</h3>
                <p class="text-sm text-gray-600">%100 doğal içerikler</p>
            </div>
            
            <div>
                <x-wax-seal type="silver" size="lg" class="mx-auto mb-4" />
                <h3 class="font-heading font-semibold mb-2">Kalite Garantisi</h3>
                <p class="text-sm text-gray-600">Ömür boyu garanti</p>
            </div>
        </div>
    </div>
</section>
```

---

## 🎨 CSS Styling (Opsiyonel)

### Hover Efektleri
```css
/* resources/css/app.css */
@layer components {
    .evahome-seal {
        transition: all 0.3s ease;
    }
    
    .evahome-seal:hover {
        transform: rotate(5deg) scale(1.05);
        filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
    }
    
    .evahome-logo {
        transition: opacity 0.3s ease;
    }
    
    .evahome-logo:hover {
        opacity: 0.8;
    }
}
```

---

## 📊 SVG Optimizasyonu

### SVG Dosyalarınızı Optimize Edin
```bash
# SVGO ile (Node.js gerekli)
npx svgo public/images/logo/*.svg
npx svgo public/images/seals/*.svg
```

### Manuel Optimizasyon
1. **SVGOMG** kullanın: https://jakearchibald.github.io/svgomg/
2. SVG dosyanızı yükleyin
3. Optimize et
4. İndir ve `public/images/` klasörüne kaydet

---

## ✅ Checklist

### Logo Dosyaları
- [ ] `evahome-logo.svg` yüklendi
- [ ] `evahome-logo-white.svg` yüklendi
- [ ] `evahome-logo-dark.svg` yüklendi (opsiyonel)
- [ ] `evahome-icon.svg` yüklendi (opsiyonel)

### Balmumu Mühür Dosyaları
- [ ] `wax-seal.svg` yüklendi
- [ ] `wax-seal-bronze.svg` yüklendi (opsiyonel)
- [ ] `wax-seal-gold.svg` yüklendi (opsiyonel)
- [ ] `wax-seal-silver.svg` yüklendi (opsiyonel)

### Component Kullanımı
- [ ] Navbar'da logo eklendi
- [ ] Footer'da logo eklendi
- [ ] Premium ürünlerde mühür kullanıldı
- [ ] Collection sayfalarında dekoratif mühür eklendi

---

## 🚨 Önemli Notlar

### 1. SVG Dosya Boyutu
- Logo için: Max 50KB
- Mühür için: Max 100KB
- Optimize edilmemiş SVG'ler sayfa yüklemesini yavaşlatır

### 2. Renk Uyumu
- Logo renklerini CSS ile değiştirmek isterseniz SVG'de `currentColor` kullanın
- Mühür renkleri doğrudan SVG içinde tanımlanmalı

### 3. Responsive Kullanım
```blade
<!-- Mobilde küçük, desktop'ta büyük -->
<x-logo class="h-8 md:h-10 lg:h-12" />
<x-wax-seal class="w-12 h-12 md:w-16 md:h-16" />
```

### 4. Performance
- SVG'ler otomatik olarak lazy loading kullanır
- Hero section'daki SVG'ler için `loading="eager"` ekleyin

---

## 🎯 Premium Kullanım Önerileri

### Mühür Kullanım Yerleri
✅ Premium ürün kartları  
✅ Featured collection'lar  
✅ Sertifika/garanti bölümleri  
✅ About us sayfası  
✅ Dekoratif arka plan elementleri  
✅ Trust badges  

### Logo Kullanım Yerleri
✅ Navbar (header)  
✅ Footer  
✅ Favicon (icon variant)  
✅ Email templates  
✅ Loading screen  
✅ 404 sayfası  

---

## 📞 Destek

Dosyalarınızı yükledikten sonra test edin:
```blade
<!-- Test sayfası oluşturun -->
<div class="p-8 space-y-8">
    <div>
        <h2>Logo Varyantları</h2>
        <x-logo />
        <x-logo variant="white" class="bg-gray-900 p-4" />
        <x-logo variant="icon" />
    </div>
    
    <div>
        <h2>Mühür Varyantları</h2>
        <x-wax-seal />
        <x-wax-seal type="bronze" />
        <x-wax-seal type="gold" />
        <x-wax-seal type="silver" />
    </div>
</div>
```

**Hazır! Artık premium balmumu mühür logonuzu sitenizde kullanabilirsiniz! 🎨✨**

