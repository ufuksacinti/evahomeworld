@props(['collection', 'size' => 'md'])

@php
    $sizeClasses = [
        'sm' => 'px-2 py-1 text-xs',
        'md' => 'px-3 py-1.5 text-sm',
        'lg' => 'px-4 py-2 text-base',
    ];
    
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-2 rounded-full font-medium {$sizeClass}"]) }}
      style="background-color: {{ $collection->color_hex }}30; color: {{ $collection->color_hex }}; border: 1px solid {{ $collection->color_hex }}50;">
    <!-- Color Dot -->
    <span class="w-2 h-2 rounded-full" 
          style="background-color: {{ $collection->color_hex }};"></span>
    
    {{ $collection->name }}
</span>

