@extends('layouts.main')

@section('title', 'Ana Sayfa - EVA HOME')

@section('content')
<!-- Interactive Hero Section -->
<section class="relative bg-white py-20 lg:py-32 overflow-hidden">
    <!-- Decorative Wax Seals -->
    <div class="absolute top-20 right-10 opacity-5">
        <x-wax-seal type="gold" size="2xl" />
    </div>
    <div class="absolute bottom-20 left-10 opacity-5">
        <x-wax-seal type="bronze" size="2xl" />
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div class="order-2 lg:order-1">
                <div class="w-24 h-1 bg-eva-gold mb-8"></div>
                
                <x-heading level="1" class="mb-6">
                    <span class="text-eva-gold">Kokunun Duyguyla</span><br/>
                    Buluştuğu Yer
                </x-heading>
                
                <!-- Interactive Energy Collection Icons -->
                <div class="mb-8">
                    <p class="text-lg text-eva-text mb-6">
                        Her koleksiyon, farklı bir enerji ve hikaye taşır. Keşfetmek için üzerine gelin:
                    </p>
                    
                    <div class="grid grid-cols-4 gap-3 mb-6">
                        @foreach($allEnergyCollections as $collection)
                            <div class="energy-icon group cursor-pointer transition-all duration-300 hover:scale-110"
                                 data-collection="{{ $collection->id }}"
                                 style="background-color: {{ $collection->color_hex }};"
                                 onmouseover="showCollectionStory('{{ $collection->id }}')"
                                 onmouseout="hideCollectionStory()">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300">
                                    <span class="text-white text-lg font-bold opacity-80 group-hover:opacity-100 transition-opacity">
                                        {{ strtoupper(substr($collection->name, 0, 1)) }}
                                    </span>
                                </div>
                                <p class="text-xs text-center mt-2 text-eva-text font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    {{ $collection->name }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Collection Story Display -->
                <div id="collection-story" class="mb-8 p-6 rounded-lg border-2 border-eva-gold/20 bg-gradient-to-r from-eva-soft-white to-white transition-all duration-500 opacity-0 transform translate-y-4">
                    <div id="story-content">
                        <h3 id="story-title" class="font-heading text-xl text-eva-heading mb-3"></h3>
                        <p id="story-description" class="text-eva-text leading-relaxed"></p>
                        <p id="story-feeling" class="text-sm text-eva-muted mt-3 italic"></p>
                    </div>
                </div>
                
                <div class="flex gap-4">
                    <a href="#collections" 
                       class="btn-text bg-eva-charcoal text-white px-8 py-4 rounded-lg hover:bg-eva-gold transition-all duration-300 shadow-lg">
                        Koleksiyonları Keşfet
                    </a>
                    <a href="#energy" 
                       class="btn-text border-2 border-eva-gold text-eva-charcoal px-8 py-4 rounded-lg hover:bg-eva-gold hover:text-white transition-all duration-300">
                        Enerji Serileri
                    </a>
                </div>
            </div>

            <!-- Right Content - Dynamic Collection Visual -->
            <div class="order-1 lg:order-2">
                <div class="relative">
                    <div id="collection-visual" class="bg-gradient-to-br from-eva-soft-white to-white rounded-2xl p-12 flex items-center justify-center relative overflow-hidden shadow-2xl border-2 border-eva-gold/20 transition-all duration-700"
                         style="min-height: 500px;">
                        
                        <!-- Default State -->
                        <div id="default-visual" class="text-center z-10 transition-opacity duration-500">
                            <x-wax-seal type="gold" size="2xl" class="mx-auto mb-6" />
                            <p class="font-heading text-2xl text-eva-heading font-semibold mb-2">8 Enerji Koleksiyonu</p>
                            <p class="text-eva-muted">Her biri farklı bir hikaye</p>
                        </div>
                        
                        <!-- Dynamic Collection Visual -->
                        <div id="dynamic-visual" class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-500">
                            <div class="text-center">
                                <div id="collection-icon" class="w-24 h-24 rounded-full mx-auto mb-6 flex items-center justify-center shadow-2xl">
                                    <span id="collection-letter" class="text-white text-4xl font-bold"></span>
                                </div>
                                <h3 id="collection-name" class="font-heading text-2xl text-eva-heading font-semibold mb-2"></h3>
                                <p id="collection-subtitle" class="text-eva-muted"></p>
                            </div>
                        </div>
                        
                        <!-- Decorative elements -->
                        <div id="decorative-circles" class="absolute inset-0 pointer-events-none">
                            <div class="absolute top-8 right-8 w-32 h-32 rounded-full opacity-20 transition-all duration-700"></div>
                            <div class="absolute bottom-8 left-8 w-24 h-24 rounded-full opacity-20 transition-all duration-700"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Collection Data for JavaScript -->
<script>
const energyCollections = @json($allEnergyCollections);

function showCollectionStory(collectionId) {
    const collection = energyCollections.find(c => c.id == collectionId);
    if (!collection) return;
    
    // Update story content
    document.getElementById('story-title').textContent = collection.name + ' Hikayesi';
    document.getElementById('story-description').textContent = collection.description || 'Bu koleksiyon, özel enerjisi ve anlamıyla evinize huzur getirir.';
    document.getElementById('story-feeling').textContent = collection.visual_feeling || collection.color_description;
    
    // Show story container
    const storyContainer = document.getElementById('collection-story');
    storyContainer.style.opacity = '1';
    storyContainer.style.transform = 'translateY(0)';
    
    // Update visual
    updateCollectionVisual(collection);
}

function hideCollectionStory() {
    const storyContainer = document.getElementById('collection-story');
    storyContainer.style.opacity = '0';
    storyContainer.style.transform = 'translateY(1rem)';
    
    // Reset to default visual
    resetToDefaultVisual();
}

function updateCollectionVisual(collection) {
    // Hide default, show dynamic
    document.getElementById('default-visual').style.opacity = '0';
    document.getElementById('dynamic-visual').style.opacity = '1';
    
    // Update content
    document.getElementById('collection-letter').textContent = collection.name.charAt(0).toUpperCase();
    document.getElementById('collection-name').textContent = collection.name;
    document.getElementById('collection-subtitle').textContent = collection.visual_feeling || 'Özel enerji koleksiyonu';
    
    // Update colors
    const icon = document.getElementById('collection-icon');
    icon.style.backgroundColor = collection.color_hex;
    
    const visual = document.getElementById('collection-visual');
    visual.style.borderColor = collection.color_hex + '40';
    
    // Update decorative circles
    const circles = document.querySelectorAll('#decorative-circles > div');
    circles.forEach(circle => {
        circle.style.backgroundColor = collection.color_hex;
    });
}

function resetToDefaultVisual() {
    // Show default, hide dynamic
    document.getElementById('default-visual').style.opacity = '1';
    document.getElementById('dynamic-visual').style.opacity = '0';
    
    // Reset colors
    const visual = document.getElementById('collection-visual');
    visual.style.borderColor = 'rgba(216, 179, 111, 0.2)';
    
    // Reset decorative circles
    const circles = document.querySelectorAll('#decorative-circles > div');
    circles.forEach((circle, index) => {
        if (index === 0) {
            circle.style.backgroundColor = 'var(--color-jasmine)';
        } else {
            circle.style.backgroundColor = 'var(--color-lavender)';
        }
    });
}
</script>

<!-- Shop Collections Section -->
@if($shopCollections->count() > 0)
<section id="collections" class="bg-white py-16 border-t border-eva-silver/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="w-24 h-1 bg-eva-gold mx-auto mb-6"></div>
            <x-heading level="2" class="mb-4">
                Shop Collections
            </x-heading>
            <p class="text-lg text-eva-text">Özel tasarım koleksiyonlarımızı keşfedin</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($shopCollections as $collection)
                <x-collection-card :collection="$collection" />
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Energy Collections Section -->
@if($energyCollections->count() > 0)
<section id="energy" class="bg-eva-soft-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="w-24 h-1 bg-eva-gold mx-auto mb-6"></div>
            <x-heading level="2" class="mb-4">
                Enerji Serisi Koleksiyonları
            </x-heading>
            <p class="text-lg text-eva-text mb-8">
                Her koleksiyon, farklı bir enerji ve duygu taşır
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($energyCollections as $collection)
                <x-collection-card :collection="$collection" />
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('collections.index') }}" 
               class="inline-flex items-center gap-2 nav-text text-eva-gold hover:text-eva-charcoal transition-colors font-medium">
                <span>Tüm Koleksiyonları Keşfet</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Featured Products -->
@if($featuredProducts->count() > 0)
<section class="bg-white py-16 border-t-2 border-eva-gold/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="w-24 h-1 bg-eva-gold mx-auto mb-6"></div>
            <x-heading level="2" class="mb-4">
                Öne Çıkan Ürünler
            </x-heading>
            <p class="text-lg text-eva-text">Premium kalite, el işçiliği</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredProducts->take(8) as $product)
                <div class="group bg-white rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300 border border-eva-silver/30">
                    <a href="{{ route('products.show', $product->slug) }}">
                        <!-- Product Image -->
                        <div class="relative aspect-square bg-gray-50">
                            @if($product->images->count() > 0)
                                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center"
                                     style="background: linear-gradient(135deg, {{ $product->collection->color_hex ?? '#FAF8F6' }}20 0%, {{ $product->collection->color_hex ?? '#FAF8F6' }}40 100%);">
                                    <x-wax-seal type="bronze" size="lg" class="opacity-20" />
                                </div>
                            @endif

                            <!-- Collection Badge -->
                            @if($product->collection)
                                <div class="absolute top-3 left-3">
                                    <x-collection-badge :collection="$product->collection" size="sm" />
                                </div>
                            @endif

                            <!-- Discount Badge -->
                            @if($product->hasDiscount())
                                <div class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow-lg">
                                    -%{{ $product->getDiscountPercentage() }}
                                </div>
                            @endif
                            
                            <!-- Premium Wax Seal -->
                            <div class="absolute bottom-3 right-3">
                                <x-wax-seal type="gold" size="sm" class="drop-shadow-xl" />
                            </div>
                        </div>

                        <!-- Product Info -->
                        <div class="p-4">
                            <h3 class="font-heading font-semibold text-base text-eva-heading mb-2 line-clamp-2 group-hover:text-eva-gold transition-colors">
                                {{ $product->name }}
                            </h3>

                            <div class="flex items-baseline gap-2">
                                @if($product->hasDiscount())
                                    <x-price :amount="$product->discount_price" size="base" class="text-eva-price font-bold" />
                                    <x-price :amount="$product->price" size="xs" class="text-eva-muted line-through" />
                                @else
                                    <x-price :amount="$product->price" size="base" class="text-eva-price font-bold" />
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Statistics Section -->
<section class="bg-eva-charcoal text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <p class="text-5xl font-heading font-bold mb-2 tabular-nums text-eva-gold">
                    {{ number_format($stats['total_products']) }}+
                </p>
                <p class="text-eva-silver uppercase tracking-wider text-sm font-medium">Ürün</p>
            </div>
            <div>
                <p class="text-5xl font-heading font-bold mb-2 tabular-nums text-eva-gold">8</p>
                <p class="text-eva-silver uppercase tracking-wider text-sm font-medium">Enerji Koleksiyonu</p>
            </div>
            <div>
                <p class="text-5xl font-heading font-bold mb-2 tabular-nums text-eva-gold">
                    {{ number_format($stats['total_orders']) }}+
                </p>
                <p class="text-eva-silver uppercase tracking-wider text-sm font-medium">Sipariş</p>
            </div>
            <div>
                <p class="text-5xl font-heading font-bold mb-2 tabular-nums text-eva-gold">
                    {{ number_format($stats['total_customers']) }}+
                </p>
                <p class="text-eva-silver uppercase tracking-wider text-sm font-medium">Mutlu Müşteri</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="relative bg-white py-20 border-t-2 border-eva-gold/20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <!-- Wax Seal -->
        <x-wax-seal type="gold" size="xl" class="mx-auto mb-8" />
        
        <x-heading level="2" class="mb-6">
            Toplu Sipariş mi Vermek İstiyorsunuz?
        </x-heading>
        
        <p class="text-lg text-eva-text mb-8 max-w-2xl mx-auto">
            Kurumsal ve toplu siparişleriniz için özel fiyatlandırma ve hizmet sunuyoruz. 
            Premium paketleme ve özel tasarım seçenekleri.
        </p>
        
        <a href="{{ route('bulk.order') }}" 
           class="inline-flex items-center gap-3 btn-text bg-eva-gold hover:bg-eva-charcoal text-white px-8 py-4 rounded-lg transition-all duration-300 shadow-lg">
            <span>Toplu Sipariş Formu</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
        </a>
    </div>
</section>
@endsection
