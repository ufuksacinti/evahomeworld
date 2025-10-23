@extends('layouts.main')

@section('title', $collection->name . ' - EVA HOME')

@section('content')
<div class="min-h-screen" style="background-color: {{ $collection->color_hex }}08;">
    
    @if($collection->type === 'energy')
        <!-- Energy Collection Header -->
        <section class="relative overflow-hidden" 
                 style="background: linear-gradient(135deg, {{ $collection->color_hex }}20 0%, {{ $collection->color_hex }}40 100%);">
            <!-- Decorative Elements -->
            <div class="absolute top-10 right-10 opacity-10">
                <x-wax-seal type="gold" size="2xl" />
            </div>
            <div class="absolute bottom-10 left-10 opacity-5">
                <x-wax-seal type="bronze" size="2xl" />
            </div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Side - Collection Info -->
                    <div>
                        <!-- Color Badge -->
                        <div class="inline-flex items-center gap-3 px-6 py-3 rounded-full mb-6 border-2 border-white shadow-lg"
                             style="background-color: {{ $collection->color_hex }};">
                            <span class="w-4 h-4 rounded-full bg-white"></span>
                            <span class="font-medium text-eva-charcoal">{{ $collection->color_description }}</span>
                        </div>
                        
                        <!-- Collection Name -->
                        <x-heading level="1" class="mb-6">
                            {{ $collection->name }}
                        </x-heading>
                        
                        <!-- Visual Feeling -->
                        @if($collection->visual_feeling)
                            <p class="text-2xl italic text-eva-charcoal/80 mb-8">
                                {{ $collection->visual_feeling }}
                            </p>
                        @endif
                        
                        <!-- Collection Details -->
                        <div class="space-y-4">
                            @if($collection->feeling)
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0"
                                         style="background-color: {{ $collection->color_hex }}40;">
                                        <svg class="w-6 h-6 text-eva-charcoal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-eva-muted uppercase tracking-wider">Verdiği His</p>
                                        <p class="text-lg text-eva-charcoal font-medium">{{ $collection->feeling }}</p>
                                    </div>
                                </div>
                            @endif
                            
                            @if($collection->scent)
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0"
                                         style="background-color: {{ $collection->color_hex }}40;">
                                        <svg class="w-6 h-6 text-eva-charcoal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-eva-muted uppercase tracking-wider">Koku</p>
                                        <p class="text-lg text-eva-charcoal font-medium">{{ $collection->scent }}</p>
                                    </div>
                                </div>
                            @endif
                            
                            @if($collection->energy)
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0"
                                         style="background-color: {{ $collection->color_hex }}40;">
                                        <svg class="w-6 h-6 text-eva-charcoal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-eva-muted uppercase tracking-wider">Enerji</p>
                                        <p class="text-lg text-eva-charcoal font-medium">{{ $collection->energy }}</p>
                                    </div>
                                </div>
                            @endif
                            
                            @if($collection->emotion)
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0"
                                         style="background-color: {{ $collection->color_hex }}40;">
                                        <svg class="w-6 h-6 text-eva-charcoal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-eva-muted uppercase tracking-wider">Ana Duygu</p>
                                        <p class="text-lg text-eva-charcoal font-medium">{{ $collection->emotion }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Right Side - Story with Wax Seal -->
                    @if($collection->story)
                        <div class="relative bg-white rounded-2xl p-8 shadow-xl border-2"
                             style="border-color: {{ $collection->color_hex }}40;">
                            <!-- Wax Seal -->
                            <div class="absolute -top-8 -right-8">
                                <x-wax-seal type="gold" size="xl" />
                            </div>
                            
                            <x-heading level="3" class="mb-4 text-eva-gold">
                                Hikayesi
                            </x-heading>
                            <p class="text-lg text-eva-charcoal leading-relaxed">
                                {{ $collection->story }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @else
        <!-- Shop Collection Header -->
        <section class="relative py-16 bg-white border-b border-eva-silver/30">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                @if($collection->color_hex)
                    <div class="flex items-center justify-center gap-3 mb-6">
                        <span class="w-12 h-12 rounded-full border-2 border-eva-gold shadow-lg" 
                              style="background-color: {{ $collection->color_hex }};"></span>
                    </div>
                @endif
                
                <x-heading level="1" class="mb-6">
                    {{ $collection->name }}
                </x-heading>
                
                @if($collection->description)
                    <p class="text-xl text-eva-text max-w-3xl mx-auto">
                        {{ $collection->description }}
                    </p>
                @endif
            </div>
        </section>
    @endif

    <!-- Products Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar - Other Collections -->
            @if($otherCollections->count() > 0)
            <aside class="lg:w-72 flex-shrink-0">
                <div class="bg-white border border-eva-silver/30 rounded-lg p-6 sticky top-24 shadow-sm">
                    <h3 class="font-heading font-semibold text-lg text-eva-heading mb-6">
                        @if($collection->type === 'energy')
                            Diğer Enerji Koleksiyonları
                        @else
                            Diğer Koleksiyonlar
                        @endif
                    </h3>
                    <nav class="space-y-2">
                        @foreach($otherCollections as $otherCollection)
                            <a href="{{ route('collections.show', $otherCollection->slug) }}" 
                               class="block px-4 py-3 rounded-lg transition-all duration-300 group hover:shadow-md"
                               style="background-color: {{ $otherCollection->color_hex }}15;">
                                <div class="flex items-center gap-3">
                                    <span class="w-4 h-4 rounded-full border border-white shadow-sm flex-shrink-0" 
                                          style="background-color: {{ $otherCollection->color_hex }};"></span>
                                    <span class="nav-text group-hover:text-eva-gold transition-colors">
                                        {{ $otherCollection->name }}
                                    </span>
                                </div>
                                @if($otherCollection->visual_feeling)
                                    <p class="text-xs text-eva-muted mt-1 ml-7 italic">
                                        {{ $otherCollection->visual_feeling }}
                                    </p>
                                @endif
                            </a>
                        @endforeach
                    </nav>
                </div>
            </aside>
            @endif

            <!-- Products -->
            <div class="flex-1">
                @if($products->count() > 0)
                    <!-- Product Count & Sort -->
                    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <p class="text-eva-charcoal">
                                <span class="font-bold text-2xl tabular-nums">{{ $products->total() }}</span>
                                <span class="text-eva-muted ml-2">ürün bulundu</span>
                            </p>
                        </div>
                        
                        <select class="nav-text border-2 border-eva-silver/50 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-eva-gold focus:border-eva-gold">
                            <option>Önerilen</option>
                            <option>Fiyat: Düşükten Yükseğe</option>
                            <option>Fiyat: Yüksekten Düşüğe</option>
                            <option>En Yeni</option>
                        </select>
                    </div>

                    <!-- Products Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                        @foreach($products as $product)
                            <div class="group bg-white rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300 border border-eva-silver/30">
                                <a href="{{ route('products.show', $product->slug) }}" class="block">
                                    <!-- Product Image -->
                                    <div class="relative aspect-square bg-gray-100">
                                        @if($product->images->count() > 0)
                                            <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                                                 alt="{{ $product->name }}"
                                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center"
                                                 style="background: linear-gradient(135deg, {{ $collection->color_hex }}20 0%, {{ $collection->color_hex }}40 100%);">
                                                <x-wax-seal type="gold" size="xl" class="opacity-20" />
                                            </div>
                                        @endif

                                        <!-- Collection Badge - Top Left -->
                                        <div class="absolute top-3 left-3">
                                            <x-collection-badge :collection="$collection" size="sm" />
                                        </div>

                                        <!-- Discount Badge -->
                                        @if($product->hasDiscount())
                                            <div class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                                                -%{{ $product->getDiscountPercentage() }}
                                            </div>
                                        @endif
                                        
                                        <!-- Premium Badge (if featured) -->
                                        @if($product->is_featured)
                                            <div class="absolute bottom-3 right-3">
                                                <x-wax-seal type="gold" size="sm" class="drop-shadow-lg" />
                                            </div>
                                        @endif

                                        <!-- Favorite Button -->
                                        <button class="absolute bottom-3 left-3 bg-white p-2 rounded-full shadow-md hover:bg-eva-gold hover:text-white transition-all duration-300 opacity-0 group-hover:opacity-100">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Product Info -->
                                    <div class="p-5">
                                        <x-heading level="5" class="mb-2 line-clamp-2 group-hover:text-eva-gold transition-colors">
                                            {{ $product->name }}
                                        </x-heading>
                                        
                                        @if($product->category)
                                            <p class="text-sm text-eva-muted mb-4">{{ $product->category->name }}</p>
                                        @endif

                                        <!-- Price -->
                                        <div class="flex items-center justify-between">
                                            <div>
                                                @if($product->hasDiscount())
                                                    <div class="flex items-baseline gap-2">
                                                        <x-price :amount="$product->discount_price" size="lg" class="text-eva-price font-bold" />
                                                        <x-price :amount="$product->price" size="sm" class="text-eva-muted line-through" />
                                                    </div>
                                                @else
                                                    <x-price :amount="$product->price" size="lg" class="text-eva-price font-bold" />
                                                @endif
                                            </div>

                                            <!-- Add to Cart Button -->
                                            <button onclick="event.preventDefault(); /* Add to cart logic */" 
                                                    class="bg-eva-charcoal text-white p-2.5 rounded-lg hover:bg-eva-gold transition-colors duration-300">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <div class="w-32 h-32 mx-auto mb-6 rounded-full flex items-center justify-center relative"
                             style="background-color: {{ $collection->color_hex }}20;">
                            <x-wax-seal type="gold" size="xl" class="opacity-30" />
                        </div>
                        
                        <x-heading level="3" class="mb-4">
                            Yakında Burada!
                        </x-heading>
                        
                        <p class="text-lg text-eva-text mb-8 max-w-md mx-auto">
                            @if($collection->type === 'energy')
                                <span class="font-medium">{{ $collection->name }}</span> koleksiyonunun büyüleyici ürünleri çok yakında sizlerle buluşacak.
                            @else
                                Bu koleksiyona yakında ürünler eklenecektir.
                            @endif
                        </p>
                        
                        <a href="{{ route('home') }}" 
                           class="inline-flex items-center gap-2 btn-text bg-eva-charcoal text-white px-8 py-4 rounded-lg hover:bg-eva-gold transition-colors duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Ana Sayfaya Dön
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
