@extends('layouts.main')

@section('title', $category->name . ' - EVA HOME')

@section('content')
<div class="bg-eva-soft-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-sm text-eva-muted mb-6">
            <a href="{{ route('home') }}" class="hover:text-eva-gold transition-colors">Ana Sayfa</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <a href="{{ route('products.index') }}" class="hover:text-eva-gold transition-colors">Ürünler</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-eva-charcoal">{{ $category->name }}</span>
        </nav>

        <!-- Category Header -->
        <div class="text-center mb-12">
            <div class="w-24 h-1 bg-eva-gold mx-auto mb-6"></div>
            <x-heading level="1" class="mb-4">
                {{ $category->name }}
            </x-heading>
            @if($category->description)
                <p class="text-xl text-eva-text max-w-3xl mx-auto">{{ $category->description }}</p>
            @endif
        </div>

        <!-- Category Stats -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8 border border-eva-silver/30">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-6">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-eva-gold">{{ $products->total() }}</div>
                        <div class="text-sm text-eva-muted">Toplam Ürün</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-eva-gold">{{ $products->count() }}</div>
                        <div class="text-sm text-eva-muted">Bu Sayfada</div>
                    </div>
                </div>
                
                <!-- Sort Options -->
                <div class="flex items-center space-x-4">
                    <label class="text-sm font-medium text-eva-charcoal">Sıralama:</label>
                    <select id="sortSelect" class="px-4 py-2 border border-eva-silver/50 rounded-lg focus:ring-2 focus:ring-eva-gold">
                        <option value="newest">En Yeni</option>
                        <option value="popular">En Popüler</option>
                        <option value="price_asc">Fiyat (Düşük-Yüksek)</option>
                        <option value="price_desc">Fiyat (Yüksek-Düşük)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow-sm border border-eva-silver/30 overflow-hidden hover:shadow-lg transition-all duration-300 group">
                        <!-- Product Image -->
                        <div class="relative overflow-hidden">
                            @if($product->images->count() > 0)
                                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-64 bg-eva-soft-white flex items-center justify-center">
                                    <svg class="w-16 h-16 text-eva-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                            
                            <!-- Favorite Button -->
                            @auth
                                <button class="absolute top-3 right-3 p-2 bg-white/80 rounded-full hover:bg-white transition-colors"
                                        onclick="toggleFavorite({{ $product->id }})">
                                    <svg class="w-5 h-5 text-eva-muted hover:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                            @endauth
                        </div>

                        <!-- Product Info -->
                        <div class="p-4">
                            <h3 class="font-heading font-semibold text-lg text-eva-charcoal mb-2 line-clamp-2">
                                {{ $product->name }}
                            </h3>
                            
                            @if($product->short_description)
                                <p class="text-sm text-eva-muted mb-3 line-clamp-2">{{ $product->short_description }}</p>
                            @endif

                            <!-- Price -->
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-2">
                                    @if($product->discount_price && $product->discount_price < $product->price)
                                        <span class="text-lg font-bold text-eva-gold">{{ number_format($product->discount_price, 2) }} ₺</span>
                                        <span class="text-sm text-eva-muted line-through">{{ number_format($product->price, 2) }} ₺</span>
                                    @else
                                        <span class="text-lg font-bold text-eva-gold">{{ number_format($product->price, 2) }} ₺</span>
                                    @endif
                                </div>
                                
                                @if($product->stock > 0)
                                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">Stokta</span>
                                @else
                                    <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded-full">Tükendi</span>
                                @endif
                            </div>

                            <!-- Actions -->
                            <div class="flex space-x-2">
                                <a href="{{ route('products.show', $product->slug) }}" 
                                   class="flex-1 text-center py-2 px-4 bg-eva-gold text-white rounded-lg hover:bg-eva-charcoal transition-colors">
                                    Detay
                                </a>
                                @if($product->stock > 0)
                                    <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" 
                                                class="w-full py-2 px-4 border border-eva-gold text-eva-gold rounded-lg hover:bg-eva-gold hover:text-white transition-colors">
                                            Sepete Ekle
                                        </button>
                                    </form>
                                @endif
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
            <!-- Empty State -->
            <div class="text-center py-16">
                <x-wax-seal type="bronze" size="lg" class="mx-auto mb-6 opacity-20" />
                <h3 class="text-xl font-heading text-eva-charcoal mb-2">Bu kategoride henüz ürün bulunmuyor</h3>
                <p class="text-eva-muted mb-6">Diğer kategorilerimizi inceleyebilirsiniz.</p>
                <a href="{{ route('products.index') }}" 
                   class="btn-text bg-eva-gold hover:bg-eva-gold/90 text-white px-6 py-3 rounded-lg transition-all duration-300 shadow-sm">
                    Tüm Ürünleri Görüntüle
                </a>
            </div>
        @endif
    </div>
</div>

<script>
function toggleFavorite(productId) {
    // Favorite toggle functionality
    console.log('Toggle favorite for product:', productId);
}

// Sort functionality
document.getElementById('sortSelect').addEventListener('change', function() {
    const sortValue = this.value;
    const url = new URL(window.location);
    url.searchParams.set('sort', sortValue);
    window.location.href = url.toString();
});
</script>
@endsection
