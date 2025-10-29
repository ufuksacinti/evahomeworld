@extends('layouts.app')

@section('title', $product->name . ' - Ürün Detayı')

@section('content')

<!-- Product Detail Section -->
<section class="py-12 bg-gray-50">
    <div class="container max-w-7xl mx-auto">
        <!-- Breadcrumb -->
        <div class="mb-8 px-6 md:px-8 lg:px-10">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm">
                    <li><a href="{{ route('home') }}" class="text-primary hover:text-accent">Ana Sayfa</a></li>
                    <li class="text-gray-400">/</li>
                    @if($product->energyCollection)
                    <li><a href="{{ route('collections.show', $product->energyCollection->slug) }}" class="text-primary hover:text-accent">{{ $product->energyCollection->name }}</a></li>
                    <li class="text-gray-400">/</li>
                    @endif
                    <li class="text-gray-700 font-semibold">{{ $product->name }}</li>
                </ol>
            </nav>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 px-6 md:px-8 lg:px-10">
            <!-- Product Images -->
            <div>
                <!-- Main Image -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-4 aspect-square relative">
                    @if($product->image)
                        <img id="mainProductImage" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                            <div class="text-center p-8">
                                <div class="text-6xl mb-2">📦</div>
                                <span class="text-gray-600 font-semibold">Görsel yüklenecek</span>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Discount Badge -->
                    @if($product->hasDiscount())
                        <div class="absolute top-4 right-4 bg-accent text-white px-4 py-2 rounded-full font-bold shadow-lg text-lg">
                            -{{ $product->discountPercentage() }}%
                        </div>
                    @endif
                </div>
                
                <!-- Gallery Thumbnails -->
                @if($product->images && $product->images->count() > 0)
                <div class="flex space-x-3 overflow-x-auto pb-2">
                    <button onclick="changeMainImage('{{ asset('storage/' . $product->image) }}')" 
                            class="flex-shrink-0 w-24 h-24 bg-white rounded-lg border-2 border-primary overflow-hidden hover:border-accent transition">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    </button>
                    @foreach($product->images as $image)
                        <button onclick="changeMainImage('{{ asset('storage/' . $image->image_path) }}')" 
                                class="flex-shrink-0 w-24 h-24 bg-white rounded-lg border-2 border-gray-200 hover:border-primary transition overflow-hidden">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
                @endif
            </div>
            
            <!-- Product Details -->
            <div>
                <!-- Energy Collection Badge -->
                @if($product->energyCollection)
                <div class="flex items-center mb-3">
                    <span class="w-4 h-4 rounded-full mr-3 shadow-md" style="background-color: {{ $product->energyCollection->color_code }};"></span>
                    <a href="{{ route('collections.show', $product->energyCollection->slug) }}" class="text-indigo-600 font-semibold hover:text-indigo-800 transition">
                        {{ $product->energyCollection->name }} Koleksiyonu
                    </a>
                </div>
                @endif
                
                <!-- Product Name -->
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $product->name }}</h1>
                
                <!-- Rating -->
                @if($product->rating > 0)
                    <div class="flex items-center mb-3">
                        <div class="flex text-yellow-400 text-xl">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($product->rating))
                                    ★
                                @else
                                    ☆
                                @endif
                            @endfor
                        </div>
                        <span class="text-gray-600 ml-2 text-sm">({{ $product->rating_count }} değerlendirme)</span>
                    </div>
                @endif
                
                <!-- SKU -->
                <div class="mb-3">
                    <span class="text-xs text-gray-500">Ürün Kodu: <strong>{{ $product->sku }}</strong></span>
                </div>
                
                <!-- Price -->
                <div class="bg-gradient-to-r from-indigo-50 via-purple-50 to-pink-50 rounded-xl p-4 mb-4">
                    @if($product->hasDiscount())
                        <div class="mb-2">
                            <span class="text-xs text-gray-500 line-through">{{ number_format($product->price, 2) }} ₺</span>
                        </div>
                        <div>
                            <span class="text-3xl font-bold text-indigo-600">{{ number_format($product->finalPrice(), 2) }} ₺</span>
                        </div>
                    @else
                        <div>
                            <span class="text-3xl font-bold text-indigo-600">{{ number_format($product->price, 2) }} ₺</span>
                        </div>
                    @endif
                </div>
                
                <!-- Quantity & Actions -->
                <div class="mb-4 space-y-3">
                    <!-- Quantity Selector -->
                    <div class="flex items-center gap-2">
                        <label class="font-semibold text-gray-700 w-12">Adet:</label>
                        <div class="flex items-center border-2 border-gray-300 rounded-full">
                            <button onclick="decreaseQuantity()" class="px-3 py-2 hover:bg-gray-100 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                </svg>
                            </button>
                            <input type="number" id="quantity" value="1" min="1" max="{{ $product->stock_quantity }}" 
                                   class="w-12 text-center border-none focus:outline-none font-semibold">
                            <button onclick="increaseQuantity()" class="px-3 py-2 hover:bg-gray-100 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </button>
                        </div>
                        <span class="text-xs text-gray-500">(Max {{ $product->stock_quantity }})</span>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="grid grid-cols-2 gap-3">
                        <button onclick="addToCart()" 
                                class="w-full py-3 px-4 bg-gradient-to-r from-indigo-600 to-indigo-800 rounded-full font-bold text-white text-sm hover:scale-105 transition-all duration-300 shadow-lg flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Sepete Ekle
                        </button>
                        <button onclick="toggleFavorite()" 
                                id="favoriteBtn"
                                class="w-full py-3 px-4 bg-white border-2 border-indigo-600 rounded-full font-bold text-indigo-600 text-sm hover:bg-indigo-600 hover:text-white transition-all duration-300 shadow-lg flex items-center justify-center">
                            <span id="favoriteIcon">♡</span>
                            <span class="ml-2">Favorilere</span>
                        </button>
                    </div>
                </div>
                
                <!-- Product Details -->
                <div class="bg-white rounded-xl shadow-lg p-4">
                    <h3 class="text-xl font-bold mb-3 text-gray-800">Ürün Detayları</h3>
                    <div class="space-y-2 text-sm text-gray-700">
                        @if($product->category)
                        <div class="flex">
                            <span class="font-semibold w-32">Kategori:</span>
                            <span>{{ $product->category->name }}</span>
                        </div>
                        @endif
                        @if($product->energyCollection)
                        <div class="flex">
                            <span class="font-semibold w-32">Koleksiyon:</span>
                            <span>{{ $product->energyCollection->name }}</span>
                        </div>
                        @endif
                        <div class="flex">
                            <span class="font-semibold w-32">SKU:</span>
                            <span>{{ $product->sku }}</span>
                        </div>
                        <div class="flex">
                            <span class="font-semibold w-32">Durum:</span>
                            <span>{{ $product->in_stock ? 'Stokta Var' : 'Stokta Yok' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Product Description -->
<section class="py-12 bg-white">
    <div class="container max-w-7xl mx-auto px-6 md:px-8 lg:px-10">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Ürün Açıklaması</h2>
            <div class="prose prose-lg max-w-none">
                <p class="text-gray-700 leading-relaxed">
                    {{ $product->description ?: $product->short_description }}
                </p>
                
                @if($product->short_description)
                <div class="mt-8 bg-gray-50 p-6 rounded-2xl">
                    <h3 class="text-xl font-bold mb-3 text-gray-800">Kısa Açıklama</h3>
                    <p class="text-gray-700">{{ $product->short_description }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Related Products -->
@if($relatedProducts->count() > 0)
<section class="py-12 bg-gray-50">
    <div class="container max-w-7xl mx-auto px-6 md:px-8 lg:px-10">
        <h2 class="text-3xl font-bold mb-8 text-center text-gray-800">Benzer Ürünler</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-4">
            @foreach($relatedProducts as $relatedProduct)
            <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden group flex flex-col">
                <!-- Product Image -->
                <a href="{{ route('products.show', $relatedProduct->slug) }}">
                    <div class="relative aspect-square bg-gray-100 overflow-hidden flex-shrink-0">
                        @if($relatedProduct->image)
                            <img src="{{ asset('storage/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                <div class="text-center p-4">
                                    <div class="text-4xl mb-1">📦</div>
                                    <span class="text-gray-600 text-xs font-semibold">Görsel yüklenecek</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </a>
                
                <!-- Product Info -->
                <div class="p-4 flex flex-col flex-grow">
                    <h3 class="text-sm font-bold mb-1 text-gray-800 line-clamp-2 min-h-[2.5rem]">{{ $relatedProduct->name }}</h3>
                    
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            @if($relatedProduct->hasDiscount())
                                <span class="text-lg font-bold text-indigo-600">{{ number_format($relatedProduct->finalPrice(), 2) }} ₺</span>
                            @else
                                <span class="text-lg font-bold text-indigo-600">{{ number_format($relatedProduct->price, 2) }} ₺</span>
                            @endif
                        </div>
                    </div>
                    
                    <a href="{{ route('products.show', $relatedProduct->slug) }}" 
                       class="block w-full py-2 px-4 bg-gradient-to-r from-indigo-600 to-indigo-800 rounded-full font-semibold text-sm text-white text-center transition-all duration-300 hover:scale-105 shadow-md hover:shadow-lg mt-auto">
                        İncele
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@push('scripts')
<script>
    function changeMainImage(imageUrl) {
        document.getElementById('mainProductImage').src = imageUrl;
    }
    
    function increaseQuantity() {
        const input = document.getElementById('quantity');
        const max = parseInt(input.getAttribute('max'));
        const current = parseInt(input.value);
        if (current < max) {
            input.value = current + 1;
        }
    }
    
    function decreaseQuantity() {
        const input = document.getElementById('quantity');
        const current = parseInt(input.value);
        if (current > 1) {
            input.value = current - 1;
        }
    }
    
    function addToCart() {
        const quantity = document.getElementById('quantity').value;
        
        fetch('/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                product_id: {{ $product->id }},
                quantity: parseInt(quantity)
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
    
    function toggleFavorite() {
        fetch(`/favorites/toggle/{{ $product->id }}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if(response.status === 401) {
                alert('Favorilere eklemek için lütfen giriş yapın.');
                window.location.href = '/login';
                return;
            }
            return response.json();
        })
        .then(data => {
            if(data && data.success) {
                const icon = document.getElementById('favoriteIcon');
                icon.textContent = data.is_favorite ? '♥' : '♡';
                alert(data.is_favorite ? 'Favorilere eklendi!' : 'Favorilerden kaldırıldı!');
            } else if(data && data.error) {
                alert(data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
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

