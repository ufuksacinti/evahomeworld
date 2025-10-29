# Font Kullanım Örnekleri - EvaHome

## 🎨 Inter Font - Hazır Implementasyonlar

### ✅ Güncellenmiş Dosyalar

#### 1. Layout Dosyaları
- ✅ `resources/views/layouts/main.blade.php`
- ✅ `resources/views/layouts/app.blade.php`

#### 2. Config Dosyaları
- ✅ `tailwind.config.js`
- ✅ `resources/css/app.css`

#### 3. Component'ler
- ✅ `resources/views/components/price.blade.php` (YENİ)

#### 4. Admin Panel Views
- ✅ `resources/views/admin/products/index.blade.php`
- ✅ `resources/views/admin/products/edit.blade.php`
- ✅ `resources/views/admin/orders/index.blade.php`

---

## 📝 Kullanım Örnekleri

### 1. Ürün Fiyatları

#### Ürün Kartında
```blade
<!-- Basit fiyat -->
<x-price :amount="$product->getFinalPrice()" size="lg" />

<!-- İndirimli fiyat -->
<div class="flex items-center gap-2">
    <x-price :amount="$product->discount_price" 
             size="xl" 
             class="text-red-600 font-bold" />
    <x-price :amount="$product->price" 
             size="sm" 
             class="text-gray-400 line-through" />
</div>

<!-- İndirim yüzdesi ile -->
<div class="space-y-1">
    <x-price :amount="$product->getFinalPrice()" size="2xl" class="text-green-600" />
    @if($product->hasDiscount())
        <div class="flex items-center gap-2">
            <x-price :amount="$product->price" size="sm" class="text-gray-400 line-through" />
            <span class="bg-red-500 text-white text-xs px-2 py-1 rounded">
                -%{{ $product->getDiscountPercentage() }}
            </span>
        </div>
    @endif
</div>
```

#### Ürün Detay Sayfasında
```blade
<div class="bg-gray-50 p-6 rounded-lg">
    @if($product->hasDiscount())
        <!-- İndirimli fiyat - büyük -->
        <div class="flex items-baseline gap-3 mb-2">
            <x-price :amount="$product->discount_price" 
                     size="3xl" 
                     class="text-green-600 font-bold" />
            <x-price :amount="$product->price" 
                     size="lg" 
                     class="text-gray-400 line-through" />
        </div>
        
        <!-- İndirim badge -->
        <div class="inline-flex items-center px-3 py-1 bg-red-500 text-white rounded-full">
            <span class="text-sm font-bold">{{ $product->getDiscountPercentage() }}% İNDİRİM</span>
        </div>
    @else
        <!-- Normal fiyat -->
        <x-price :amount="$product->price" 
                 size="3xl" 
                 class="text-gray-900 font-bold" />
    @endif
    
    <!-- Stok bilgisi -->
    <div class="mt-4 text-sm text-gray-600">
        <span class="tabular-nums font-medium">{{ $product->stock }}</span> adet stokta
    </div>
</div>
```

### 2. Sepet Sayfası

```blade
<!-- Sepet item -->
<div class="flex items-center justify-between py-4 border-b">
    <div class="flex-1">
        <h3 class="font-medium">{{ $item->product->name }}</h3>
        <p class="text-sm text-gray-600">Adet: <span class="tabular-nums">{{ $item->quantity }}</span></p>
    </div>
    
    <div class="text-right">
        <!-- Birim fiyat -->
        <x-price :amount="$item->price" size="sm" class="text-gray-600" />
        
        <!-- Toplam -->
        <x-price :amount="$item->getTotal()" 
                 size="lg" 
                 class="text-gray-900 font-bold" />
    </div>
</div>

<!-- Sepet toplamı -->
<div class="bg-gray-50 p-6 rounded-lg mt-6">
    <div class="space-y-3">
        <div class="flex justify-between text-sm">
            <span class="text-gray-600">Ara Toplam</span>
            <x-price :amount="$cart->getTotalAmount()" size="base" class="text-gray-900" />
        </div>
        
        <div class="flex justify-between text-sm">
            <span class="text-gray-600">Kargo</span>
            <x-price :amount="0" size="base" class="text-green-600" />
            <span class="text-green-600 text-xs ml-2">(Ücretsiz)</span>
        </div>
        
        <div class="border-t pt-3 flex justify-between items-baseline">
            <span class="font-bold text-lg">Toplam</span>
            <x-price :amount="$cart->getTotalAmount()" 
                     size="2xl" 
                     class="text-green-600 font-bold" />
        </div>
    </div>
</div>
```

### 3. Sipariş Sayfası

```blade
<!-- Sipariş özeti -->
<div class="bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-xl font-bold mb-4">Sipariş Özeti</h2>
    
    <div class="space-y-3 border-b pb-4">
        @foreach($order->items as $item)
            <div class="flex justify-between text-sm">
                <div class="flex-1">
                    <span>{{ $item->product_name }}</span>
                    <span class="text-gray-500 ml-2 tabular-nums">(x{{ $item->quantity }})</span>
                </div>
                <x-price :amount="$item->total" size="sm" />
            </div>
        @endforeach
    </div>
    
    <div class="space-y-2 mt-4">
        <div class="flex justify-between text-sm">
            <span class="text-gray-600">Ara Toplam</span>
            <x-price :amount="$order->total_amount" size="base" />
        </div>
        
        @if($order->discount_amount > 0)
            <div class="flex justify-between text-sm text-green-600">
                <span>İndirim</span>
                <x-price :amount="$order->discount_amount" size="base" class="text-green-600" />
            </div>
        @endif
        
        <div class="flex justify-between text-sm">
            <span class="text-gray-600">Kargo</span>
            <x-price :amount="$order->shipping_amount" size="base" />
        </div>
        
        <div class="border-t pt-3 flex justify-between items-baseline">
            <span class="font-bold text-lg">Genel Toplam</span>
            <x-price :amount="$order->getGrandTotal()" 
                     size="2xl" 
                     class="text-blue-600 font-bold" />
        </div>
    </div>
</div>

<!-- Sipariş bilgisi -->
<div class="mt-6">
    <p class="text-sm text-gray-600">
        Sipariş No: <span class="font-medium tabular-nums">{{ $order->order_number }}</span>
    </p>
    <p class="text-sm text-gray-600">
        Tarih: <span class="tabular-nums">{{ $order->created_at->format('d.m.Y H:i') }}</span>
    </p>
</div>
```

### 4. Admin Dashboard

```blade
<!-- İstatistik kartları -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <!-- Toplam Gelir -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-sm font-medium text-gray-600">Toplam Gelir</h3>
            <svg class="w-5 h-5 text-green-500"><!-- icon --></svg>
        </div>
        <x-price :amount="$stats['total_revenue']" 
                 size="2xl" 
                 class="text-gray-900 font-bold" />
        <p class="text-xs text-green-600 mt-2">
            <span class="tabular-nums">+12.5%</span> önceki aya göre
        </p>
    </div>
    
    <!-- Toplam Sipariş -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-sm font-medium text-gray-600">Toplam Sipariş</h3>
            <svg class="w-5 h-5 text-blue-500"><!-- icon --></svg>
        </div>
        <p class="text-2xl font-bold tabular-nums text-gray-900">
            {{ number_format($stats['total_orders']) }}
        </p>
        <p class="text-xs text-blue-600 mt-2">
            <span class="tabular-nums">+8</span> bugün
        </p>
    </div>
    
    <!-- Müşteri Sayısı -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-sm font-medium text-gray-600">Müşteriler</h3>
            <svg class="w-5 h-5 text-purple-500"><!-- icon --></svg>
        </div>
        <p class="text-2xl font-bold tabular-nums text-gray-900">
            {{ number_format($stats['total_customers']) }}
        </p>
        <p class="text-xs text-purple-600 mt-2">
            <span class="tabular-nums">+23</span> bu ay
        </p>
    </div>
    
    <!-- Ortalama Sepet -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-sm font-medium text-gray-600">Ort. Sepet</h3>
            <svg class="w-5 h-5 text-orange-500"><!-- icon --></svg>
        </div>
        <x-price :amount="$stats['average_cart']" 
                 size="2xl" 
                 class="text-gray-900 font-bold" />
    </div>
</div>
```

### 5. Responsive Fiyat Gösterimi

```blade
<!-- Mobilde küçük, desktop'ta büyük -->
<div class="flex items-baseline gap-2">
    <x-price :amount="$product->getFinalPrice()" 
             class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-bold text-green-600" />
    
    @if($product->hasDiscount())
        <x-price :amount="$product->price" 
                 class="text-sm sm:text-base md:text-lg text-gray-400 line-through" />
    @endif
</div>
```

### 6. Tabular-Nums Olmadan (Genel Metin)

```blade
<!-- Normal paragraph metni -->
<p class="text-base text-gray-700 leading-relaxed">
    EvaHome'da {{ number_format($productCount) }} üründen oluşan 
    geniş koleksiyonumuzu keşfedin. Müşteri memnuniyeti %{{ $satisfaction }} oranında!
</p>
```

---

## 🎯 Font Ağırlıkları Kullanımı

### Normal (400)
```blade
<p class="font-normal">
    Genel içerik metinleri, açıklamalar, paragraflar
</p>
```

### Medium (500)
```blade
<span class="font-medium">
    Vurgular, navigation linkleri, buton metinleri, label'lar
</span>
```

### Bold (700)
```blade
<h1 class="font-bold">
    Ana başlıklar, önemli bilgiler, CTA'lar
</h1>
```

---

## 📱 Mobil Optimizasyonlar

```blade
<!-- Responsive font boyutları -->
<div class="space-y-4">
    <!-- Küçük ekranlarda kompakt -->
    <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold">
        Ana Başlık
    </h1>
    
    <!-- Fiyat mobilde daha küçük -->
    <x-price :amount="$price" 
             class="text-xl sm:text-2xl md:text-3xl font-bold" />
    
    <!-- Metin mobilde küçük -->
    <p class="text-sm sm:text-base leading-relaxed">
        Açıklama metni
    </p>
</div>
```

---

## ✅ Checklist: Fiyat Gösterirken

- [ ] `<x-price>` component'ini kullan
- [ ] Uygun boyutu seç (xs, sm, base, lg, xl, 2xl, 3xl)
- [ ] İndirimli fiyatlarda renk kontrastı sağla
- [ ] İndirim yüzdesini göster
- [ ] Stok bilgisinde `tabular-nums` kullan
- [ ] Sipariş numaralarında `tabular-nums` kullan
- [ ] Responsive boyutlandırma yap
- [ ] Para birimi gösterilsin (default: ₺)

---

## 🚫 Yapmayın

```blade
<!-- YANLIŞ ❌ -->
<span>{{ $product->price }} TL</span>
<div>₺{{ $price }}</div>
<p style="font-family: Arial">Fiyat: {{ $price }}</p>

<!-- DOĞRU ✅ -->
<x-price :amount="$product->price" />
<x-price :amount="$price" size="lg" class="text-green-600" />
<x-price :amount="$price" currency="TL" />
```

---

## 🎨 Renk Paleti (Fiyatlar için)

```blade
<!-- Normal fiyat -->
class="text-gray-900"

<!-- İndirimli fiyat -->
class="text-red-600"  veya  class="text-green-600"

<!-- Toplam tutarlar -->
class="text-blue-600"  veya  class="text-green-600"

<!-- Eski fiyat (üstü çizili) -->
class="text-gray-400 line-through"
```

---

**Not:** Tüm örnekler production-ready'dir ve doğrudan kullanılabilir!

