@extends('layouts.app')

@section('title', 'Ana Sayfa - EvaHome')

@section('content')

<!-- Hero Slider Section -->
<section class="relative h-screen flex items-center justify-center overflow-hidden">
    <div id="heroSlider" class="absolute inset-0 flex transition-all duration-1000">
        <!-- Slider Item 1 -->
        <div class="min-w-full bg-cover bg-center bg-no-repeat" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="absolute inset-0 bg-black bg-opacity-30"></div>
            <div class="relative container flex items-center justify-center h-full">
                <div class="text-center text-white z-10">
                    <h1 class="text-6xl md:text-7xl font-bold mb-6 animate-fade-in">
                        Enerji Dolu Ürünlerimizle Tanışın
                    </h1>
                    <p class="text-2xl md:text-3xl mb-8 max-w-2xl mx-auto animate-fade-in-delay">
                        Her koleksiyon, benzersiz enerjisiyle yaşamınıza pozitif değer katıyor
                    </p>
                    <a href="#most-liked" class="inline-block bg-white text-primary px-12 py-4 rounded-full font-bold text-lg hover:bg-primary hover:text-white transition-all duration-300 transform hover:scale-105 shadow-2xl animate-fade-in-delay-2">
                        Alışverişe Başla
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Slider Item 2 -->
        <div class="min-w-full bg-cover bg-center bg-no-repeat" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <div class="absolute inset-0 bg-black bg-opacity-30"></div>
            <div class="relative container flex items-center justify-center h-full">
                <div class="text-center text-white z-10">
                    <h1 class="text-6xl md:text-7xl font-bold mb-6">
                        Özel Tasarım Koleksiyonlar
                    </h1>
                    <p class="text-2xl md:text-3xl mb-8 max-w-2xl mx-auto">
                        Koleksiyonlarımız, yaşam enerjinizi yükseltecek
                    </p>
                    <a href="#most-liked" class="inline-block bg-white text-primary px-12 py-4 rounded-full font-bold text-lg hover:bg-primary hover:text-white transition-all duration-300 transform hover:scale-105 shadow-2xl">
                        Alışverişe Başla
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Slider Item 3 -->
        <div class="min-w-full bg-cover bg-center bg-no-repeat" style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">
            <div class="absolute inset-0 bg-black bg-opacity-30"></div>
            <div class="relative container flex items-center justify-center h-full">
                <div class="text-center text-white z-10">
                    <h1 class="text-6xl md:text-7xl font-bold mb-6">
                        Pozitif Enerji Hediye
                    </h1>
                    <p class="text-2xl md:text-3xl mb-8 max-w-2xl mx-auto">
                        Sevdikleriniz için özel tasarım ürünler
                    </p>
                    <a href="#most-liked" class="inline-block bg-white text-primary px-12 py-4 rounded-full font-bold text-lg hover:bg-primary hover:text-white transition-all duration-300 transform hover:scale-105 shadow-2xl">
                        Alışverişe Başla
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Slider Controls -->
    <button id="prevSlide" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-40 text-white p-3 rounded-full transition-all duration-300 z-20">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
    </button>
    <button id="nextSlide" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-40 text-white p-3 rounded-full transition-all duration-300 z-20">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>
    
    <!-- Slider Dots -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-3 z-20">
        <button class="slider-dot w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition-all duration-300 active"></button>
        <button class="slider-dot w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition-all duration-300"></button>
        <button class="slider-dot w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition-all duration-300"></button>
    </div>
</section>

<!-- En Çok Beğenilenler Section -->
<section id="most-liked" class="py-24 bg-gradient-to-b from-gray-50 to-white">
    <div class="container">
        <div class="section-header mb-16">
            <h2 class="text-5xl font-bold mb-4 text-gray-800">En Çok Beğenilenler</h2>
            <p class="text-xl text-gray-600">
                Müşterilerimizin en çok tercih ettiği, en yüksek puanlı ürünlerimizi keşfedin
            </p>
        </div>
        
        @if(isset($mostLikedProducts) && count($mostLikedProducts) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 p-4">
            @foreach($mostLikedProducts as $product)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col">
                <div class="relative aspect-square bg-gray-100 overflow-hidden flex-shrink-0 group">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary/20 via-secondary/20 to-accent/20">
                            <div class="text-center p-8">
                                <div class="text-4xl mb-2">📦</div>
                                <span class="text-gray-600 text-sm font-semibold">Görsel yüklenecek</span>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Discount Badge -->
                    @if($product->hasDiscount())
                        <div class="absolute top-4 right-4 bg-accent text-white px-4 py-2 rounded-full font-bold shadow-lg">
                            -{{ $product->discountPercentage() }}%
                        </div>
                    @endif
                    
                    <!-- Energy Color Indicator -->
                    @if($product->energyCollection)
                        <div class="absolute top-4 left-4 w-8 h-8 rounded-full shadow-lg border-2 border-white" style="background-color: {{ $product->energyCollection->color_code }};"></div>
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
                
                <div class="p-4 flex flex-col flex-grow">
                    <!-- Category Badge -->
                    @if($product->category)
                        <div class="inline-block text-xs font-semibold text-gray-500 mb-1 uppercase tracking-wide">
                            {{ $product->category->name }}
                        </div>
                    @endif
                    
                    <h3 class="text-lg font-bold mb-1.5 text-gray-800 line-clamp-2">{{ $product->name }}</h3>
                    
                    <p class="text-gray-600 text-sm mb-2 line-clamp-2">{{ $product->short_description }}</p>
                    
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
                                <span class="text-xl font-bold text-indigo-600">{{ number_format($product->finalPrice(), 2) }} ₺</span>
                                <span class="text-sm text-gray-400 line-through ml-2">{{ number_format($product->price, 2) }} ₺</span>
                            @else
                                <span class="text-xl font-bold text-indigo-600">{{ number_format($product->price, 2) }} ₺</span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex gap-2">
                        <button onclick="addToCartFromHome({{ $product->id }})" 
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
        
        <div class="text-center mt-16">
            <a href="{{ route('products.index') }}" class="btn btn-secondary text-lg px-12 py-4">
                Tüm Ürünleri Görüntüle
            </a>
        </div>
        @else
        <div class="text-center py-16">
            <p class="text-xl text-gray-600">Henüz en çok beğenilen ürün yok</p>
        </div>
        @endif
    </div>
</section>

<!-- Energy Collections Section -->
@if(isset($energyCollections) && count($energyCollections) > 0)
<section class="py-24 bg-white">
    <div class="container">
        <div class="section-header mb-16">
            <h2 class="text-5xl font-bold mb-4 text-gray-800">Enerji Koleksiyonları</h2>
            <p class="text-xl text-gray-600">
                Özel renk kodları ile tasarlanmış koleksiyonlarımızı keşfedin
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 p-4">
            @foreach($energyCollections as $collection)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div style="background-color: {{ $collection->color_code }}; height: 250px;" class="flex items-center justify-center relative overflow-hidden group">
                    @if($collection->image)
                        <img src="{{ asset('storage/' . $collection->image) }}" alt="{{ $collection->name }}" class="max-w-full max-h-full object-contain group-hover:scale-110 transition-transform duration-500">
                    @else
                        <span class="text-white text-4xl font-bold">{{ $collection->name }}</span>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-50 group-hover:opacity-30 transition-opacity duration-300"></div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-3 text-gray-800">{{ $collection->name }}</h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $collection->description }}</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-500">Renk:</span>
                            <div class="w-6 h-6 rounded-full border-2 border-gray-300" style="background-color: {{ $collection->color_code }};"></div>
                        </div>
                        <a href="{{ route('collections.show', $collection->slug) }}" class="text-primary hover:text-primary-dark font-semibold flex items-center">
                            Keşfet 
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-16">
            <a href="{{ route('collections.index') }}" class="btn btn-secondary text-lg px-12 py-4">
                Tüm Koleksiyonları Görüntüle
            </a>
        </div>
    </div>
</section>
@endif

@push('styles')
<style>
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in {
        animation: fade-in 1s ease-out;
    }
    
    .animate-fade-in-delay {
        animation: fade-in 1s ease-out 0.3s backwards;
    }
    
    .animate-fade-in-delay-2 {
        animation: fade-in 1s ease-out 0.6s backwards;
    }
    
    .slider-dot.active {
        background-color: white;
    }
</style>
@endpush

@push('scripts')
<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('#heroSlider > div');
    const dots = document.querySelectorAll('.slider-dot');
    const totalSlides = slides.length;
    
    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.style.transform = `translateX(-${index * 100}%)`;
        });
        
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });
    }
    
    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    }
    
    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        showSlide(currentSlide);
    }
    
    document.getElementById('nextSlide').addEventListener('click', nextSlide);
    document.getElementById('prevSlide').addEventListener('click', prevSlide);
    
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentSlide = index;
            showSlide(currentSlide);
        });
    });
    
    // Auto-play slider
    setInterval(nextSlide, 5000);
    
    // Quick add to cart
    function addToCartFromHome(productId) {
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
    
    function quickAddToCart(productId) {
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
                document.getElementById('cartCount').textContent = data.count || 0;
            });
    }
</script>
@endpush

@endsection
