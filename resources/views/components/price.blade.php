@props(['amount', 'size' => 'base', 'currency' => '₺', 'showCurrency' => true])

@php
    $sizeClasses = [
        'xs' => 'text-xs',
        'sm' => 'text-sm',
        'base' => 'text-base',
        'lg' => 'text-lg',
        'xl' => 'text-xl',
        '2xl' => 'text-2xl',
        '3xl' => 'text-3xl',
    ];
    
    $class = $sizeClasses[$size] ?? $sizeClasses['base'];
    // EVA HOME Premium Price Styling
    $priceClass = "price-text {$class}";
@endphp

<span {{ $attributes->merge(['class' => $priceClass]) }}>
    @if($showCurrency){{ $currency }}@endif{{ number_format($amount, 2, ',', '.') }}
</span>

