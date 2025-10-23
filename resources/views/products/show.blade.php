@extends('layouts.main')

@section('title', $product->name . ' - EVA HOME')

@section('content')
<div class="bg-eva-soft-white min-h-screen">
    <!-- Breadcrumb -->
    <div class="bg-white border-b border-eva-silver/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex items-center space-x-2 text-sm text-eva-muted">
                <a href="{{ route('home') }}" class="hover:text-eva-gold transition-colors">Ana Sayfa</a>
                <span>/</span>
                @if($product->collection)
                    <a href="{{ route('collections.show', $product->collection->slug) }}" class="hover:text-eva-gold transition-colors">
                        {{ $product->collection->name }}
                    </a>
                    <span>/</span>
                @endif
                <span class="text-eva-charcoal">{{ Str::limit($product->name, 30) }}</span>
            </nav>
        </div>
    </div>

    <!-- Product Detail -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Left: Product Images -->
            <div>
                <!-- Main Image -->
                <div class="relative aspect-square bg-white rounded-2xl mb-4 overflow-hidden shadow-lg border-2"
                     style="border-color: {{ $product->collection->color_hex ?? '#C7C2BA' }}40;">
                    @if($product->images->count() > 0)
                        <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center"
                             style="background: linear-gradient(135deg, {{ $product->collection->color_hex ?? '#FAF8F6' }}20 0%, {{ $product->collection->color_hex ?? '#FAF8F6' }}50 100%);">
                            <div class="text-center">
                                <x-wax-seal type="gold" size="2xl" class="mx-auto mb-4 opacity-20" />
                                <p class="text-lg font-heading text-eva-muted">{{ $product->name }}</p>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Premium Badge (if featured) -->
                    @if($product->is_featured)
                        <div class="absolute top-4 right-4">
                            <x-wax-seal type="gold" size="lg" class="drop-shadow-2xl" />
                        </div>
                    @endif
                </div>

                <!-- Thumbnail Images -->
                @if($product->images->count() > 1)
                    <div class="grid grid-cols-5 gap-3">
                        @foreach($product->images->take(5) as $image)
                            <div class="aspect-square bg-white rounded-lg overflow-hidden cursor-pointer hover:opacity-75 transition-opacity shadow-sm border"
                                 style="border-color: {{ $product->collection->color_hex ?? '#C7C2BA' }}30;">
                                <img src="{{ asset('storage/' . $image->image_path) }}" 
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Right: Product Info -->
            <div>
                <!-- Collection Badge -->
                @if($product->collection)
                    <div class="mb-6">
                        <a href="{{ route('collections.show', $product->collection->slug) }}">
                            <x-collection-badge :collection="$product->collection" size="md" 
                                                class="hover:scale-105 transition-transform cursor-pointer" />
                        </a>
                    </div>
                @endif

                <!-- Product Name -->
                <x-heading level="1" class="mb-6">
                    {{ $product->name }}
                </x-heading>

                <!-- Short Description -->
                @if($product->short_description)
                    <p class="text-lg text-eva-text mb-8 leading-relaxed">
                        {{ $product->short_description }}
                    </p>
                @endif

                <!-- Price Box -->
                <div class="bg-white rounded-xl p-6 mb-8 shadow-sm border-2"
                     style="border-color: {{ $product->collection->color_hex ?? '#D8B36F' }}40;">
                    @if($product->hasDiscount())
                        <div class="flex items-baseline gap-4 mb-3">
                            <x-price :amount="$product->discount_price" size="3xl" class="text-red-600 font-bold" />
                            <x-price :amount="$product->price" size="lg" class="text-eva-muted line-through" />
                        </div>
                        <div class="inline-flex items-center gap-2 bg-red-500 text-white text-sm font-bold px-4 py-2 rounded-full">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd" />
                            </svg>
                            %{{ $product->getDiscountPercentage() }} İNDİRİM
                        </div>
                    @else
                        <x-price :amount="$product->price" size="3xl" class="text-eva-price font-bold" />
                    @endif
                    
                    <!-- Stock Status -->
                    <div class="mt-4 pt-4 border-t border-eva-silver/30">
                        @if($product->stock > 0)
                            <div class="flex items-center text-green-600">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="font-medium">Stokta mevcut</span>
                                <span class="ml-2 text-sm tabular-nums">({{ $product->stock }} adet)</span>
                            </div>
                        @else
                            <div class="flex items-center text-red-600">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                <span class="font-medium">Stokta yok</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Add to Cart Form -->
                <form action="{{ route('cart.add', $product) }}" method="POST" class="mb-8">
                    @csrf
                    
                    <!-- Quantity Selector -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-eva-charcoal mb-3">Adet Seçin</label>
                        <div class="flex items-center gap-4">
                            <button type="button" onclick="decrementQuantity()" 
                                    class="w-12 h-12 border-2 border-eva-silver rounded-lg hover:border-eva-gold hover:bg-eva-gold/10 transition-all">
                                <svg class="w-6 h-6 mx-auto text-eva-charcoal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                </svg>
                            </button>
                            <input type="number" 
                                   id="quantity-input" 
                                   name="quantity" 
                                   value="1" 
                                   min="1" 
                                   max="{{ $product->stock }}" 
                                   class="w-24 text-center text-xl font-bold tabular-nums border-2 border-eva-silver rounded-lg py-3 focus:outline-none focus:ring-2 focus:ring-eva-gold focus:border-eva-gold"
                                   required>
                            <button type="button" onclick="incrementQuantity()" 
                                    class="w-12 h-12 border-2 border-eva-silver rounded-lg hover:border-eva-gold hover:bg-eva-gold/10 transition-all">
                                <svg class="w-6 h-6 mx-auto text-eva-charcoal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4">
                        @if($product->stock > 0)
                            <button type="submit" 
                                    class="flex-1 btn-text bg-eva-charcoal text-white px-8 py-4 rounded-lg hover:bg-eva-gold transition-all duration-300 font-medium flex items-center justify-center gap-2 shadow-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Sepete Ekle
                            </button>
                        @else
                            <button type="button" disabled 
                                    class="flex-1 bg-gray-300 text-gray-500 px-8 py-4 rounded-lg cursor-not-allowed font-medium">
                                Stokta Yok
                            </button>
                        @endif
                        
                        <!-- Favorite Button -->
                        @auth
                            @if($isFavorite)
                                <form action="{{ route('favorites.remove', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-14 h-14 border-2 border-red-500 bg-red-50 text-red-500 rounded-lg hover:bg-red-100 transition-all duration-300 flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('favorites.add', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="w-14 h-14 border-2 border-eva-silver rounded-lg hover:border-red-500 hover:text-red-500 hover:bg-red-50 transition-all duration-300 flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" 
                               class="w-14 h-14 border-2 border-eva-silver rounded-lg hover:border-eva-gold hover:bg-eva-gold/10 transition-all duration-300 flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </a>
                        @endauth
                    </div>
                </form>

                <script>
                    function incrementQuantity() {
                        const input = document.getElementById('quantity-input');
                        const max = parseInt(input.max);
                        const current = parseInt(input.value);
                        if (current < max) {
                            input.value = current + 1;
                        }
                    }

                    function decrementQuantity() {
                        const input = document.getElementById('quantity-input');
                        const min = parseInt(input.min);
                        const current = parseInt(input.value);
                        if (current > min) {
                            input.value = current - 1;
                        }
                    }
                </script>

                <!-- Product Attributes -->
                @if($product->attributes->count() > 0)
                    <div class="bg-white rounded-lg p-6 mb-6 shadow-sm border border-eva-silver/30">
                        <h3 class="font-heading font-semibold text-lg text-eva-heading mb-4">Ürün Özellikleri</h3>
                        <dl class="space-y-3">
                            @foreach($product->attributes as $attribute)
                                <div class="flex justify-between items-center py-2 border-b border-eva-silver/20 last:border-0">
                                    <dt class="text-eva-muted">{{ $attribute->attribute_name }}</dt>
                                    <dd class="text-eva-charcoal font-medium">{{ $attribute->attribute_value }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>
                @endif
                
                <!-- Premium Features -->
                <div class="grid grid-cols-3 gap-4">
                    <div class="text-center p-4 bg-white rounded-lg shadow-sm border border-eva-silver/30">
                        <x-wax-seal type="bronze" size="sm" class="mx-auto mb-2" />
                        <p class="text-xs text-eva-muted font-medium">El Yapımı</p>
                    </div>
                    <div class="text-center p-4 bg-white rounded-lg shadow-sm border border-eva-silver/30">
                        <x-wax-seal type="gold" size="sm" class="mx-auto mb-2" />
                        <p class="text-xs text-eva-muted font-medium">Premium</p>
                    </div>
                    <div class="text-center p-4 bg-white rounded-lg shadow-sm border border-eva-silver/30">
                        <x-wax-seal type="silver" size="sm" class="mx-auto mb-2" />
                        <p class="text-xs text-eva-muted font-medium">Doğal</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Description -->
        @if($product->description)
            <div class="mt-16">
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-eva-silver/30">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-1 bg-eva-gold"></div>
                        <x-heading level="2">
                            Ürün Açıklaması
                        </x-heading>
                    </div>
                    <div class="prose prose-lg max-w-none text-eva-text">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="bg-white py-16 mt-12 border-t-2 border-eva-gold/20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-1 bg-eva-gold"></div>
                    <x-heading level="2">
                        Benzer Ürünler
                    </x-heading>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $relatedProduct)
                        <div class="group bg-white rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300 border border-eva-silver/30">
                            <a href="{{ route('products.show', $relatedProduct->slug) }}">
                                <!-- Product Image -->
                                <div class="relative aspect-square">
                                    @if($relatedProduct->images->count() > 0)
                                        <img src="{{ asset('storage/' . $relatedProduct->images->first()->image_path) }}" 
                                             alt="{{ $relatedProduct->name }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                            <x-wax-seal type="bronze" size="lg" class="opacity-20" />
                                        </div>
                                    @endif

                                    <!-- Collection Badge -->
                                    @if($relatedProduct->collection)
                                        <div class="absolute top-3 left-3">
                                            <x-collection-badge :collection="$relatedProduct->collection" size="sm" />
                                        </div>
                                    @endif
                                    
                                    <!-- Premium Badge -->
                                    @if($relatedProduct->is_featured)
                                        <div class="absolute top-3 right-3">
                                            <x-wax-seal type="gold" size="xs" class="drop-shadow-lg" />
                                        </div>
                                    @endif
                                </div>

                                <!-- Product Info -->
                                <div class="p-4">
                                    <h3 class="font-heading font-semibold text-base text-eva-heading mb-2 line-clamp-2 group-hover:text-eva-gold transition-colors">
                                        {{ $relatedProduct->name }}
                                    </h3>
                                    
                                    <div class="flex items-center justify-between">
                                        @if($relatedProduct->hasDiscount())
                                            <div class="flex flex-col">
                                                <x-price :amount="$relatedProduct->discount_price" size="base" class="text-eva-price font-bold" />
                                                <x-price :amount="$relatedProduct->price" size="xs" class="text-eva-muted line-through" />
                                            </div>
                                        @else
                                            <x-price :amount="$relatedProduct->price" size="base" class="text-eva-price font-bold" />
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
