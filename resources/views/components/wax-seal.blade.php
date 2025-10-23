@props(['type' => 'default', 'size' => 'md'])

@php
    // Mühür tipleri
    $sealTypes = [
        'default' => 'wax-seal.svg',
        'bronze' => 'wax-seal-bronze.svg',
        'gold' => 'wax-seal-gold.svg',
        'silver' => 'wax-seal-silver.svg',
    ];
    
    // Boyut sınıfları
    $sizeClasses = [
        'xs' => 'w-8 h-8',
        'sm' => 'w-12 h-12',
        'md' => 'w-16 h-16',
        'lg' => 'w-24 h-24',
        'xl' => 'w-32 h-32',
        '2xl' => 'w-40 h-40',
    ];
    
    $sealFile = $sealTypes[$type] ?? $sealTypes['default'];
    $sealPath = asset('images/seals/' . $sealFile);
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
@endphp

<img {{ $attributes->merge(['class' => "evahome-seal {$sizeClass}"]) }}
     src="{{ $sealPath }}"
     alt="EVA HOME Premium Seal"
     loading="lazy">

