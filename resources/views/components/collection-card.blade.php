@props(['collection'])

<a href="{{ route('collections.show', $collection->slug) }}" 
   {{ $attributes->merge(['class' => 'group block']) }}>
    <div class="relative overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-all duration-300"
         style="background: linear-gradient(135deg, {{ $collection->color_hex }}20 0%, {{ $collection->color_hex }}40 100%);">
        
        <!-- Collection Image -->
        @if($collection->image)
            <div class="aspect-square overflow-hidden">
                <img src="{{ asset('storage/' . $collection->image) }}" 
                     alt="{{ $collection->name }}"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            </div>
        @else
            <!-- Gradient Background if no image -->
            <div class="aspect-square flex items-center justify-center"
                 style="background: linear-gradient(135deg, {{ $collection->color_hex }}40 0%, {{ $collection->color_hex }}80 100%);">
                <!-- Optional: Wax Seal -->
                <div class="opacity-20">
                    <x-wax-seal type="gold" size="2xl" />
                </div>
            </div>
        @endif
        
        <!-- Color Bar -->
        <div class="h-2" style="background-color: {{ $collection->color_hex }};"></div>
        
        <!-- Content -->
        <div class="p-6 bg-white">
            <!-- Collection Name -->
            <x-heading level="4" class="mb-2 group-hover:text-eva-gold transition-colors">
                {{ $collection->name }}
            </x-heading>
            
            <!-- Color Description -->
            @if($collection->color_description)
                <p class="text-xs text-eva-muted mb-2 flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full inline-block" 
                          style="background-color: {{ $collection->color_hex }};"></span>
                    {{ $collection->color_description }}
                </p>
            @endif
            
            <!-- Visual Feeling -->
            @if($collection->visual_feeling)
                <p class="text-sm text-eva-text mb-3 italic">
                    {{ $collection->visual_feeling }}
                </p>
            @endif
            
            <!-- Description -->
            @if($collection->description)
                <p class="text-sm text-gray-600 line-clamp-2 mb-4">
                    {{ $collection->description }}
                </p>
            @endif
            
            <!-- View Button -->
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium text-eva-gold group-hover:text-eva-charcoal transition-colors">
                    Koleksiyonu Keşfet →
                </span>
                
                @if($collection->products_count ?? 0)
                    <span class="text-xs text-eva-muted tabular-nums">
                        {{ $collection->products_count }} ürün
                    </span>
                @endif
            </div>
        </div>
    </div>
</a>

