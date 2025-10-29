# EvaHome E-Ticaret Sistemi - Ödeme ve Sipariş Yönetimi

## 🎉 Tamamlanan Özellikler

### 1. ✅ Sepet Yönetimi
- Sepete ekleme
- Sepetten çıkarma
- Miktar güncelleme
- Sepeti temizleme
- Otomatik stok rezervasyonu
- Gerçek zamanlı sepet sayısı

### 2. ✅ Sipariş Yönetimi
- Sipariş oluşturma
- Sipariş detayları
- Sipariş listesi
- Müşteri bilgileri kaydetme

### 3. ✅ Ödeme Sistemi (İyzico Hazır)
- Ödeme sayfası
- Ödeme callback
- Ödeme başarı/başarısızlık sayfaları
- Sipariş numarası otomatik oluşturma

### 4. ✅ Stok Yönetimi
- Otomatik stok rezervasyonu
- Stok kontrolü
- Düşük stok bildirimi
- Stok serbest bırakma

## 📦 Oluşturulacak View Dosyaları

### Temel Klasör Yapısı
```
resources/views/
├── auth/
│   ├── login.blade.php
│   └── register.blade.php
├── cart/
│   └── index.blade.php
├── checkout/
│   └── index.blade.php
├── payment/
│   ├── index.blade.php
│   ├── success.blade.php
│   └── failure.blade.php
├── orders/
│   ├── index.blade.php
│   └── show.blade.php
└── favorites/
    └── index.blade.php
```

## 🚀 Kullanım

### Sepete Ekleme
```blade
<button onclick="addToCart({{ $product->id }})">Sepete Ekle</button>

<script>
function addToCart(productId) {
    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: 1
        })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            alert('Ürün sepete eklendi!');
            updateCartCount();
        }
    });
}
</script>
```

### Favorilere Ekleme
```blade
<button onclick="toggleFavorite({{ $product->id }})" id="favorite-btn-{{ $product->id }}">
    <span id="favorite-icon-{{ $product->id }}">♡</span>
</button>

<script>
function toggleFavorite(productId) {
    fetch(`/favorites/toggle/${productId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            const icon = document.getElementById(`favorite-icon-${productId}`);
            icon.textContent = data.is_favorite ? '♥' : '♡';
        } else {
            alert('Lütfen giriş yapın');
            window.location.href = '/login';
        }
    });
}
</script>
```

## 🔧 İyzico Entegrasyonu

### 1. İyzico Package Kurulumu
```bash
composer require iyzico/iyzipay-php
```

### 2. .env Dosyasına Ekleyin
```env
IYZICO_API_KEY=your_api_key
IYZICO_SECRET_KEY=your_secret_key
IYZICO_BASE_URL=https://sandbox-api.iyzipay.com  # Test için
# IYZICO_BASE_URL=https://api.iyzipay.com  # Production için
```

### 3. config/iyzipay.php Oluşturun
```php
<?php

return [
    'api_key' => env('IYZICO_API_KEY'),
    'secret_key' => env('IYZICO_SECRET_KEY'),
    'base_url' => env('IYZICO_BASE_URL', 'https://sandbox-api.iyzipay.com'),
];
```

### 4. PaymentController Güncelleme
`PaymentController` içinde İyzico entegrasyonunu ekleyin:

```php
use Iyzipay\Model\CheckoutFormInitialize;
use Iyzipay\Options;

$options = new Options();
$options->setApiKey(config('iyzipay.api_key'));
$options->setSecretKey(config('iyzipay.secret_key'));
$options->setBaseUrl(config('iyzipay.base_url'));

// Ödeme formunu oluştur
$request = new CheckoutFormInitialize();
$request->setLocale('tr');
$request->setConversationId($order->order_number);
$request->setPrice($order->total);
$request->setPaidPrice($order->total);
$request->setCurrency('TRY');
$request->setBasketId((string) $order->id);
// ... diğer parametreler
```

## 📋 Route'lar

### Sepet
- `GET /cart` - Sepet sayfası
- `POST /cart/add` - Sepete ekle
- `POST /cart/update/{item}` - Güncelle
- `DELETE /cart/remove/{item}` - Kaldır
- `POST /cart/clear` - Temizle
- `GET /cart/count` - Sepet sayısı

### Checkout
- `GET /checkout` - Checkout sayfası
- `POST /checkout` - Sipariş oluştur

### Ödeme
- `GET /payment/process/{order}` - Ödeme sayfası
- `POST /payment/callback` - İyzico callback
- `GET /payment/success/{order}` - Başarılı ödeme
- `GET /payment/failure/{order}` - Başarısız ödeme

### Siparişler
- `GET /orders` - Siparişlerim
- `GET /orders/{order}` - Sipariş detayı

### Favoriler
- `GET /favorites` - Favori ürünler
- `POST /favorites/toggle/{product}` - Favoriye ekle/çıkar
- `GET /favorites/check/{product}` - Favori mi kontrol et

## 🎨 View Dosyaları Oluşturma

### auth/login.blade.php
```blade
@extends('layouts.app')

@section('content')
<div class="container py-16">
    <div class="max-w-md mx-auto">
        <h1 class="text-3xl font-bold mb-8 text-center">{{ t('auth.login') }}</h1>
        
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            
            <div>
                <label class="block mb-2">Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 border rounded">
            </div>
            
            <div>
                <label class="block mb-2">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded">
            </div>
            
            <button type="submit" class="w-full btn btn-primary">Login</button>
        </form>
        
        <div class="text-center mt-4">
            <a href="{{ route('register') }}" class="text-primary">Don't have an account? Register</a>
        </div>
    </div>
</div>
@endsection
```

### cart/index.blade.php
```blade
@extends('layouts.app')

@section('content')
<div class="container py-16">
    <h1 class="text-3xl font-bold mb-8">{{ t('cart.title') }}</h1>
    
    @if($items->count() > 0)
        <div class="space-y-4">
            @foreach($items as $item)
            <div class="flex items-center border p-4 rounded">
                <img src="{{ asset('storage/' . $item->product->image) }}" class="w-24 h-24 object-cover">
                <div class="flex-1 ml-4">
                    <h3 class="font-bold">{{ $item->product->name }}</h3>
                    <p class="text-secondary">{{ number_format($item->price, 2) }} ₺</p>
                </div>
                <div class="mr-4">
                    <input type="number" value="{{ $item->quantity }}" min="1" onchange="updateQuantity({{ $item->id }}, this.value)">
                </div>
                <div class="mr-4">
                    <strong>{{ number_format($item->subtotal, 2) }} ₺</strong>
                </div>
                <button onclick="removeItem({{ $item->id }})" class="text-error">Remove</button>
            </div>
            @endforeach
        </div>
        
        <div class="mt-8 p-6 bg-secondary rounded">
            <div class="flex justify-between text-xl font-bold">
                <span>Total:</span>
                <span>{{ number_format($cart->total, 2) }} ₺</span>
            </div>
            <a href="{{ route('checkout.index') }}" class="btn btn-primary w-full mt-4">Checkout</a>
        </div>
    @else
        <p class="text-center py-16">Your cart is empty</p>
    @endif
</div>
@endsection
```

## 📝 Notlar

1. **Stok Yönetimi**: Sepete eklendiğinde stok rezerve edilir, sipariş tamamlandığında stoktan düşer.

2. **Sepet Kalıcılığı**: 
   - Login olmayanlar için session_id kullanılır
   - Login olanlar için user_id kullanılır
   - Login olduğunda guest sepeti user sepetine aktarılabilir

3. **Sipariş Numarası**: Her siparişe benzersiz sipariş numarası oluşturulur (ORD20251027XXXX)

4. **Ödeme Durumu**: 
   - pending: Bekliyor
   - paid: Ödendi
   - failed: Başarısız
   - refunded: İade edildi

5. **Sipariş Durumu**:
   - pending: Bekliyor
   - processing: İşleniyor
   - shipped: Kargoya verildi
   - delivered: Teslim edildi
   - cancelled: İptal edildi

## 🎯 Sonraki Adımlar

1. View dosyalarını oluşturun (yukarıdaki örnekleri kullanabilirsiniz)
2. İyzico package'ını kurun
3. İyzico API key'lerini .env'e ekleyin
4. PaymentController'a İyzico entegrasyonunu ekleyin
5. Test edin!

