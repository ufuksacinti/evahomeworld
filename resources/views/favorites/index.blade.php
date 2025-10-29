@extends('layouts.app')

@section('title', 'Favorilerim')

@section('content')

<!-- Favorites Hero Section -->
<section class="py-24 bg-gradient-to-br from-primary via-secondary to-accent">
    <div class="container text-center text-white z-10 relative section-header">
        <h1 class="text-5xl md:text-7xl font-bold mb-6">Favorilerim</h1>
        <p class="text-xl md:text-2xl text-white/90">
            Beğendiğiniz ürünleri kolayca bulun
        </p>
    </div>
</section>

<!-- Favorites Products -->
<section class="py-16 bg-gray-50">
    <div class="container max-w-7xl mx-auto px-6 md:px-8 lg:px-10">
        @if($favorites->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-4">
            @foreach($favorites as $product)
            <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden group flex flex-col">
                <!-- Product Image -->
                <a href="{{ route('products.show', $product->slug) }}">
                    <div class="relative aspect-square bg-gray-100 overflow-hidden flex-shrink-0">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                <div class="text-center p-4">
                                    <div class="text-4xl mb-1">📦</div>
                                    <span class="text-gray-600 text-xs font-semibold">Görsel yüklenecek</span>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Discount Badge -->
                        @if($product->hasDiscount())
                            <div class="absolute top-4 right-4 bg-accent text-white px-4 py-2 rounded-full font-bold shadow-lg text-sm">
                                -{{ $product->discountPercentage() }}%
                            </div>
                        @endif
                    </div>
                </a>
                
                <!-- Product Info -->
                <div class="p-4 flex flex-col flex-grow">
                    <h3 class="text-sm font-bold mb-1 text-gray-800 line-clamp-2 min-h-[2.5rem]">{{ $product->name }}</h3>
                    
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            @if($product->hasDiscount())
                                <span class="text-lg font-bold text-indigo-600">{{ number_format($product->finalPrice(), 2) }} ₺</span>
                            @else
                                <span class="text-lg font-bold text-indigo-600">{{ number_format($product->price, 2) }} ₺</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="flex gap-2">
                        <a href="{{ route('products.show', $product->slug) }}" 
                           class="flex-1 py-2 px-4 bg-gradient-to-r from-indigo-600 to-indigo-800 rounded-full font-semibold text-sm text-white text-center transition-all duration-300 hover:scale-105 shadow-md hover:shadow-lg">
                            İncele
                        </a>
                        <button onclick="addToCart({{ $product->id }})" 
                                class="flex-1 py-2 px-4 bg-white border-2 border-indigo-600 rounded-full font-semibold text-indigo-600 text-sm hover:bg-indigo-600 hover:text-white transition-all">
                            Sepete Ekle
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-12">
            {{ $favorites->links() }}
        </div>
        
        @else
        <div class="text-center py-16">
            <div class="text-6xl mb-6">💝</div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Henüz favori ürününüz yok</h3>
            <p class="text-gray-600 mb-8">Beğendiğiniz ürünleri favorilerinize ekleyin!</p>
            <a href="{{ route('products.index') }}" class="inline-block py-3 px-8 bg-gradient-to-r from-indigo-600 to-indigo-800 rounded-full font-bold text-white hover:scale-105 transition shadow-lg">
                Alışverişe Başla
            </a>
        </div>
        @endif
    </div>
</section>

@push('scripts')
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
            } else {
                alert(data.message || 'Bir hata oluştu');
            }
        });
    }
    
    function updateCartCount() {
        fetch('/cart/count')
            .then(response => response.json())
            .then(data => {
                const cartCount = document.getElementById('cartCount');
                if(cartCount) {
                    cartCount.textContent = data.count || 0;
                }
            });
    }
</script>
@endpush

@endsection

