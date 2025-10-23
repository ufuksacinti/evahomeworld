@props(['level' => '1', 'class' => ''])

@php
    $tag = 'h' . $level;
    $defaultClasses = 'font-heading font-semibold text-eva-heading';
    
    $sizeClasses = [
        '1' => 'text-5xl md:text-6xl',
        '2' => 'text-4xl md:text-5xl',
        '3' => 'text-3xl md:text-4xl',
        '4' => 'text-2xl md:text-3xl',
        '5' => 'text-xl md:text-2xl',
        '6' => 'text-lg md:text-xl',
    ];
    
    $finalClass = $defaultClasses . ' ' . ($sizeClasses[$level] ?? $sizeClasses['1']) . ' ' . $class;
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => $finalClass]) }}>
    {{ $slot }}
</{{ $tag }}>

