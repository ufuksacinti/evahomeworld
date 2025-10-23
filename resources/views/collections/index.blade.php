<x-main-layout>
    <!-- Hero Section -->
    <section class="relative py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Decorative line -->
            <div class="w-24 h-1 bg-eva-gold mx-auto mb-6"></div>
            
            <x-heading level="1" class="mb-6">
                Koleksiyonlarımız
            </x-heading>
            
            <p class="text-xl text-eva-text max-w-3xl mx-auto">
                Her biri özenle tasarlanmış, el yapımı ürünlerimizle tanışın
            </p>
        </div>
    </section>

    <!-- Collections Grid -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($collections->where('type', 'shop')->count() > 0)
                <section class="mb-16">
                    <div class="flex items-center justify-between mb-8">
                        <x-heading level="2">
                            Shop Koleksiyonları
                        </x-heading>
                        <div class="w-16 h-1 bg-eva-gold"></div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($collections->where('type', 'shop') as $collection)
                            <x-collection-card :collection="$collection" />
                        @endforeach
                    </div>
                </section>
            @endif

            @if($collections->where('type', 'energy')->count() > 0)
                <section>
                    <div class="flex items-center justify-between mb-8">
                        <x-heading level="2">
                            Enerji Koleksiyonları
                        </x-heading>
                        <div class="w-16 h-1 bg-eva-gold"></div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($collections->where('type', 'energy') as $collection)
                            <x-collection-card :collection="$collection" />
                        @endforeach
                    </div>
                </section>
            @endif

            @if($collections->count() == 0)
                <div class="text-center py-16">
                    <x-wax-seal type="gold" size="xl" class="mx-auto mb-6 opacity-30" />
                    <p class="text-eva-muted text-lg">Henüz koleksiyon bulunmamaktadır.</p>
                </div>
            @endif
        </div>
    </div>
</x-main-layout>
