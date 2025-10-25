<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['amount', 'size' => 'base', 'currency' => '₺', 'showCurrency' => true]));

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

foreach (array_filter((['amount', 'size' => 'base', 'currency' => '₺', 'showCurrency' => true]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
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
?>

<span <?php echo e($attributes->merge(['class' => $priceClass])); ?>>
    <?php if($showCurrency): ?><?php echo e($currency); ?><?php endif; ?><?php echo e(number_format($amount, 2, ',', '.')); ?>

</span>

<?php /**PATH C:\xampp\htdocs\evahome\resources\views/components/price.blade.php ENDPATH**/ ?>