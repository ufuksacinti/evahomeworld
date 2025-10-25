<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['variant' => 'default', 'size' => 'md']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['variant' => 'default', 'size' => 'md']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
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
?>

<?php if($logoExists): ?>
    <img <?php echo e($attributes->merge(['class' => "evahome-logo {$sizeClass}"])); ?>

         src="<?php echo e($logoPath); ?>"
         alt="EVA HOME"
         loading="lazy">
<?php else: ?>
    <!-- Text fallback if logo not uploaded yet -->
    <span <?php echo e($attributes->merge(['class' => "evahome-logo font-heading font-bold {$sizeClass} flex items-center"])); ?>>
        <?php if($variant === 'white'): ?>
            <span class="text-white" style="font-size: <?php echo e(match($size) { 'xs' => '1rem', 'sm' => '1.25rem', 'md' => '1.5rem', 'lg' => '1.75rem', 'xl' => '2rem', '2xl' => '2.5rem', default => '1.5rem' }); ?>">EVA HOME</span>
        <?php else: ?>
            <span class="text-eva-heading" style="font-size: <?php echo e(match($size) { 'xs' => '1rem', 'sm' => '1.25rem', 'md' => '1.5rem', 'lg' => '1.75rem', 'xl' => '2rem', '2xl' => '2.5rem', default => '1.5rem' }); ?>">EVA HOME</span>
        <?php endif; ?>
    </span>
<?php endif; ?>

<?php /**PATH C:\xampp\htdocs\evahome\resources\views/components/logo.blade.php ENDPATH**/ ?>