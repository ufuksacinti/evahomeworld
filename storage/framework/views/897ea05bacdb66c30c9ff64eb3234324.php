<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['level' => '1', 'class' => '']));

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

foreach (array_filter((['level' => '1', 'class' => '']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
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
?>

<<?php echo e($tag); ?> <?php echo e($attributes->merge(['class' => $finalClass])); ?>>
    <?php echo e($slot); ?>

</<?php echo e($tag); ?>>

<?php /**PATH C:\xampp\htdocs\evahome\resources\views/components/heading.blade.php ENDPATH**/ ?>