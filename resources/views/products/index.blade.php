@extends('layouts.main')

@section('title', 'Ürünler - EVA HOME')

@section('content')
<div class="bg-eva-soft-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="text-center mb-12">
            <div class="w-24 h-1 bg-eva-gold mx-auto mb-6"></div>
            <x-heading level="1" class="mb-4">
                Ürünlerimiz
            </x-heading>
            <p class="text-xl text-eva-text">Eviniz için özenle seçilmiş, el yapımı premium ürünler</p>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8 border border-eva-silver/30">
            <form method="GET" action="{{ route('products.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search -->
                <div>
                    <label class="block text-sm font-medium text-eva-charcoal mb-2">Arama</label>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Ürün ara..." 
                           class="w-full px-4 py-2 border border-eva-silver/50 rounded-lg focus:ring-2 focus:ring-eva-gold focus:border-eva-gold">
                </div>

                <!-- Sort -->
                <div>
                    <label class="block text-sm font-medium text-eva-charcoal mb-2">Sıralama</label>
                    <select name="sort" class="w-full px-4 py-2 border border-eva-silver/50 rounded-lg focus:ring-2 focus:ring-eva-gold">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>En Yeni</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>En Popüler</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Fiyat (Düşük-Yüksek)</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Fiyat (Yüksek-Düşük)</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="flex items-end">
                    <button type="submit" class="w-full btn-text bg-eva-gold hover:bg-eva-gold/90 text-white px-6 py-2 rounded-lg transition-all duration-300 shadow-sm">
                        Filtrele
                    </button>
                </div>
            </form>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @forelse($products as $product)
                <div class="group bg-white rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300 border border-eva-silver/30">
                    <div class="relative overflow-hidden aspect-square">
                        @if($product->getPrimaryImage())
                            <img src="{{ asset('storage/' . $product->getPrimaryImage()->image_path) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center"
                                 style="background: linear-gradient(135deg, {{ $product->collection->color_hex ?? '#FAF8F6' }}20 0%, {{ $product->collection->color_hex ?? '#FAF8F6' }}40 100%);">
                                <x-wax-seal type="bronze" size="xl" class="opacity-20" />
                            </div>
                        @endif
                        
                        <!-- Collection Badge - Top Left -->
                        @if($product->collection)
                            <div class="absolute top-3 left-3">
                                <x-collection-badge :collection="$product->collection" size="sm" />
                            </div>
                        @endif
                        
                        <!-- Discount Badge - Top Right -->
                        @if($product->hasDiscount())
                            <div class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                                -%{{ $product->getDiscountPercentage() }}
                            </div>
                        @endif
                        
                        <!-- Premium Wax Seal (if featured) -->
                        @if($product->is_featured)
                            <div class="absolute bottom-3 right-3">
                                <x-wax-seal type="gold" size="sm" class="drop-shadow-xl" />
                            </div>
                        @endif
                    </div>

                    <div class="p-5">
                        <!-- Product Name -->
                        <x-heading level="5" class="mb-2 line-clamp-2 group-hover:text-eva-gold transition-colors">
                            {{ $product->name }}
                        </x-heading>
                        
                        <!-- Category -->
                        @if($product->category)
                            <p class="text-sm text-eva-muted mb-4">{{ $product->category->name }}</p>
                        @endif
                        
                        <!-- Price -->
                        <div class="mb-4">
                            @if($product->hasDiscount())
                                <div class="flex items-baseline gap-2">
                                    <x-price :amount="$product->discount_price" size="xl" class="text-eva-price font-bold" />
                                    <x-price :amount="$product->price" size="sm" class="text-eva-muted line-through" />
                                </div>
                            @else
                                <x-price :amount="$product->price" size="xl" class="text-eva-price font-bold" />
                            @endif
                        </div>

                        <!-- CTA Button -->
                        <button class="w-full btn-text bg-eva-charcoal text-white py-3 rounded-lg hover:bg-eva-gold transition-colors duration-300">
                            İncele
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center py-16">
                    <x-wax-seal type="gold" size="2xl" class="mx-auto mb-6 opacity-20" />
                    <x-heading level="3" class="mb-4">
                        Ürün Bulunamadı
                    </x-heading>
                    <p class="text-eva-muted">Arama kriterlerinizi değiştirmeyi deneyin</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
            <div class="mt-12">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
