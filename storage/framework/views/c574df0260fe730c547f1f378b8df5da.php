<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['type' => 'default', 'size' => 'md']));

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

foreach (array_filter((['type' => 'default', 'size' => 'md']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
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
?>

<img <?php echo e($attributes->merge(['class' => "evahome-seal {$sizeClass}"])); ?>

     src="<?php echo e($sealPath); ?>"
     alt="EVA HOME Premium Seal"
     loading="lazy">

<?php /**PATH C:\xampp\htdocs\evahome\resources\views/components/wax-seal.blade.php ENDPATH**/ ?>