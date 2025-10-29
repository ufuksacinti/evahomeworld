@extends('layouts.app')

@section('title', 'Sepetim')

@section('content')

<!-- Cart Hero Section -->
<section class="py-24 bg-gradient-to-br from-primary via-secondary to-accent">
    <div class="container text-center text-white z-10 relative section-header">
        <h1 class="text-5xl md:text-7xl font-bold mb-6">Sepetim</h1>
        <p class="text-xl md:text-2xl text-white/90">
            Alışveriş sepetinizdeki ürünler
        </p>
    </div>
</section>

<!-- Cart Items -->
<section class="py-16 bg-gray-50">
    <div class="container max-w-7xl mx-auto px-6 md:px-8 lg:px-10">
        @if($items->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Sepetteki Ürünler</h2>
                
                <div class="bg-white rounded-2xl shadow-lg p-6 space-y-4">
                    @foreach($items as $item)
                    <div class="flex items-center gap-4 pb-4 border-b border-gray-200 last:border-b-0">
                        <!-- Product Image -->
                        <a href="{{ route('products.show', $item->product->slug) }}" class="flex-shrink-0">
                            <div class="w-24 h-24 bg-gray-100 rounded-lg overflow-hidden">
                                @if($item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <span class="text-2xl">📦</span>
                                    </div>
                                @endif
                            </div>
                        </a>
                        
                        <!-- Product Info -->
                        <div class="flex-grow">
                            <a href="{{ route('products.show', $item->product->slug) }}">
                                <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $item->product->name }}</h3>
                            </a>
                            
                            <!-- Quantity -->
                            <div class="flex items-center gap-2 mt-2">
                                <button onclick="updateQuantity({{ $item->id }}, -1)" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-gray-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                    </svg>
                                </button>
                                <span class="font-semibold w-12 text-center">{{ $item->quantity }}</span>
                                <button onclick="updateQuantity({{ $item->id }}, 1)" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-gray-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Price & Remove -->
                        <div class="text-right">
                            <div class="text-2xl font-bold text-indigo-600 mb-2">{{ number_format($item->subtotal, 2) }} ₺</div>
                            <div class="text-sm text-gray-500">{{ number_format($item->price, 2) }} ₺ × {{ $item->quantity }}</div>
                            <button onclick="removeItem({{ $item->id }})" class="mt-2 text-red-600 hover:text-red-800 text-sm">
                                <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Kaldır
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Cart Summary -->
            <div class="lg:col-span-1">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Sipariş Özeti</h2>
                
                <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24">
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Ara Toplam</span>
                            <span>{{ number_format($cart->total, 2) }} ₺</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Kargo</span>
                            <span>Ücretsiz</span>
                        </div>
                        <div class="border-t border-gray-200 pt-4 flex justify-between">
                            <span class="text-xl font-bold text-gray-800">Toplam</span>
                            <span class="text-2xl font-bold text-indigo-600">{{ number_format($cart->total, 2) }} ₺</span>
                        </div>
                    </div>
                    
                    <a href="{{ route('checkout.index') }}" class="block w-full py-4 px-6 bg-gradient-to-r from-indigo-600 to-indigo-800 rounded-full font-bold text-lg text-white text-center hover:scale-105 transition-all shadow-lg hover:shadow-xl">
                        <svg class="w-6 h-6 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Ödemeye Geç
                    </a>
                    
                    <a href="{{ route('products.index') }}" class="block w-full mt-4 py-3 px-6 border-2 border-indigo-600 rounded-full font-semibold text-indigo-600 text-center hover:bg-indigo-600 hover:text-white transition">
                        Alışverişe Devam Et
                    </a>
                </div>
            </div>
        </div>
        
        @else
        <div class="text-center py-16">
            <div class="text-6xl mb-6">🛒</div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Sepetiniz boş</h3>
            <p class="text-gray-600 mb-8">Sepetinize ürün ekleyerek alışverişe başlayın!</p>
            <a href="{{ route('products.index') }}" class="inline-block py-3 px-8 bg-gradient-to-r from-indigo-600 to-indigo-800 rounded-full font-bold text-white hover:scale-105 transition shadow-lg">
                Alışverişe Başla
            </a>
        </div>
        @endif
    </div>
</section>

@push('scripts')
<script>
    function updateQuantity(itemId, change) {
        fetch(`/cart/update/${itemId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                quantity: parseInt(document.querySelector(`#quantity-${itemId}`).textContent) + change
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                location.reload();
            } else {
                alert(data.message || 'Bir hata oluştu');
            }
        });
    }
    
    function removeItem(itemId) {
        if(confirm('Bu ürünü sepetten kaldırmak istediğinizden emin misiniz?')) {
            fetch(`/cart/remove/${itemId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    location.reload();
                } else {
                    alert(data.message || 'Bir hata oluştu');
                }
            });
        }
    }
</script>
@endpush

@endsection

