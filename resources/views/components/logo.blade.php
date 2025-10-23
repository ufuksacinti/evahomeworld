@props(['variant' => 'default', 'size' => 'md'])

@php
    // Logo varyantları - kullanıcının yüklediği logoları kullan
    $logoTypes = [
        'default' => 'evahome-logo.svg',
        'white' => 'evahome-logo-white.svg',
        'dark' => 'evahome-logo-black.svg',  // Kullanıcının dosya ismi
        'black' => 'evahome-logo-black.svg',
        'icon' => 'evahome-icon.svg',
    ];
    
    // Boyut sınıfları
    $sizeClasses = [
        'xs' => 'h-6',
        'sm' => 'h-8',
        'md' => 'h-10',
        'lg' => 'h-12',
        'xl' => 'h-16',
        '2xl' => 'h-20',
    ];
    
    $logoFile = $logoTypes[$variant] ?? $logoTypes['default'];
    $logoPath = asset('images/logo/' . $logoFile);
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
    
    // Check if file exists, otherwise show text fallback
    $logoExists = file_exists(public_path('images/logo/' . $logoFile));
@endphp

@if($logoExists)
    <img {{ $attributes->merge(['class' => "evahome-logo {$sizeClass}"]) }}
         src="{{ $logoPath }}"
         alt="EVA HOME"
         loading="lazy">
@else
    <!-- Text fallback if logo not uploaded yet -->
    <span {{ $attributes->merge(['class' => "evahome-logo font-heading font-bold {$sizeClass} flex items-center"]) }}>
        @if($variant === 'white')
            <span class="text-white" style="font-size: {{ match($size) { 'xs' => '1rem', 'sm' => '1.25rem', 'md' => '1.5rem', 'lg' => '1.75rem', 'xl' => '2rem', '2xl' => '2.5rem', default => '1.5rem' } }}">EVA HOME</span>
        @else
            <span class="text-eva-heading" style="font-size: {{ match($size) { 'xs' => '1rem', 'sm' => '1.25rem', 'md' => '1.5rem', 'lg' => '1.75rem', 'xl' => '2rem', '2xl' => '2.5rem', default => '1.5rem' } }}">EVA HOME</span>
        @endif
    </span>
@endif

