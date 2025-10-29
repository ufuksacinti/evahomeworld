@extends('layouts.app')

@section('title', $collection->name . ' - Enerji Koleksiyonu')

@section('content')

<!-- Hero Section with Collection Color -->
<section class="relative h-96 flex items-center justify-center overflow-hidden" style="background: linear-gradient(135deg, {{ $collection->color_code }} 0%, {{ $collection->color_code }}DD 100%);">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="relative z-10 container text-center text-white">
        <div class="inline-block w-24 h-24 rounded-full mb-6 shadow-2xl" style="background-color: {{ $collection->color_code }};"></div>
        <h1 class="text-5xl md:text-7xl font-bold mb-6">{{ $collection->name }}</h1>
        <p class="text-xl md:text-2xl max-w-3xl mx-auto">{{ $collection->description }}</p>
    </div>
    
    <!-- Decorative Elements -->
    <div class="absolute top-10 left-10 w-32 h-32 rounded-full opacity-20 blur-3xl" style="background-color: {{ $collection->color_code }};"></div>
    <div class="absolute bottom-10 right-10 w-40 h-40 rounded-full opacity-20 blur-3xl" style="background-color: {{ $collection->color_code }};"></div>
</section>

<!-- Products Section -->
<section class="py-16 bg-gray-50">
    <div class="container">
        @if($products->count() > 0)
        <div class="section-header mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">
                {{ $collection->name }} Koleksiyonundan Ürünler
            </h2>
            <p class="text-gray-600">Toplam {{ $products->total() }} ürün bulundu</p>
        </div>
        
        <!-- 4 Column Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-4">
            @foreach($products as $product)
            <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group flex flex-col">
                <!-- Product Image -->
                <div class="relative aspect-square bg-gray-100 overflow-hidden">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                             class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br" 
                             style="background: linear-gradient(135deg, {{ $collection->color_code }}15, {{ $collection->color_code }}30);">
                            <div class="text-center p-8">
                                <div class="text-4xl mb-2">📦</div>
                                <span class="text-gray-600 text-sm font-semibold">Görsel yüklenecek</span>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Discount Badge -->
                    @if($product->hasDiscount())
                        <div class="absolute top-4 right-4 bg-accent text-white px-4 py-2 rounded-full font-bold shadow-lg text-sm">
                            -{{ $product->discountPercentage() }}%
                        </div>
                    @endif
                    
                    <!-- Quick Actions Overlay -->
                    <div class="absolute inset-0 bg-white/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <a href="{{ route('products.show', $product->slug) }}" 
                           class="bg-indigo-600 text-white px-6 py-3 rounded-full font-bold text-sm hover:scale-110 transition-transform shadow-lg">
                            Detay
                        </a>
                    </div>
                    
                    <!-- Favorite Badge -->
                    <div id="favorite-badge-{{ $product->id }}" class="absolute top-3 right-3 hidden">
                        <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center shadow-lg">
                            <i class="fas fa-heart text-white text-lg"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Product Info -->
                <div class="p-4">
                    <!-- Category Badge -->
                    @if($product->category)
                        <div class="inline-block text-xs font-semibold text-gray-500 mb-1 uppercase tracking-wide">
                            {{ $product->category->name }}
                        </div>
                    @endif
                    
                    <h3 class="text-lg font-bold mb-1.5 text-gray-800 line-clamp-2">
                        {{ $product->name }}
                    </h3>
                    
                    <p class="text-gray-600 text-sm mb-2 line-clamp-2">
                        {{ $product->short_description }}
                    </p>
                    
                    <!-- Rating -->
                    @if($product->rating > 0)
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($product->rating))
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-sm text-gray-600 ml-2">({{ $product->rating_count }})</span>
                        </div>
                    @endif
                    
                    <!-- Price -->
                    <div class="flex items-center justify-between mb-2">
                        <div>
                            @if($product->hasDiscount())
                                <span class="text-xl font-bold text-primary">{{ number_format($product->finalPrice(), 2) }} ₺</span>
                                <span class="text-sm text-gray-400 line-through ml-2">{{ number_format($product->price, 2) }} ₺</span>
                            @else
                                <span class="text-xl font-bold text-primary">{{ number_format($product->price, 2) }} ₺</span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex gap-2">
                        <button onclick="addToCart({{ $product->id }})" 
                                class="flex-1 py-2 px-3 bg-gradient-to-r from-indigo-600 to-indigo-800 rounded-full font-semibold text-xs text-white transition-all duration-300 hover:scale-105 shadow-md">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Sepete Ekle
                        </button>
                        <button onclick="toggleFavorite({{ $product->id }})" 
                                id="favorite-btn-{{ $product->id }}"
                                class="flex-1 py-2 px-3 bg-white border-2 border-indigo-600 rounded-full font-semibold text-xs text-indigo-600 hover:bg-indigo-600 hover:text-white transition-all shadow-md">
                            <i id="favorite-icon-{{ $product->id }}" class="far fa-heart mr-1"></i>
                            Favorilere
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-12">
            {{ $products->links() }}
        </div>
        
        @else
        <div class="text-center py-16">
            <div class="inline-block w-24 h-24 rounded-full mb-6" style="background-color: {{ $collection->color_code }};"></div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ $collection->name }} Koleksiyonunda Henüz Ürün Yok</h3>
            <p class="text-gray-600 mb-8">Yakında bu koleksiyondan harika ürünler eklenecek!</p>
            <a href="{{ route('collections.index') }}" class="btn btn-primary">
                Tüm Koleksiyonları Gör
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
    
    function toggleFavorite(productId) {
        fetch(`/favorites/toggle/${productId}`, {
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
                const icon = document.getElementById(`favorite-icon-${productId}`);
                const badge = document.getElementById(`favorite-badge-${productId}`);
                
                if(data.is_favorite) {
                    icon.className = 'fas fa-heart mr-1';
                    if(badge) badge.classList.remove('hidden');
                } else {
                    icon.className = 'far fa-heart mr-1';
                    if(badge) badge.classList.add('hidden');
                }
            }
        })
        .catch(error => console.error('Error:', error));
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

