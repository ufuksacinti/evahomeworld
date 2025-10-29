<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['collection']));

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

foreach (array_filter((['collection']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<a href="<?php echo e(route('collections.show', $collection->slug)); ?>" 
   <?php echo e($attributes->merge(['class' => 'group block'])); ?>>
    <div class="relative overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-all duration-300"
         style="background: linear-gradient(135deg, <?php echo e($collection->color_hex); ?>20 0%, <?php echo e($collection->color_hex); ?>40 100%);">
        
        <!-- Collection Image -->
        <?php if($collection->image): ?>
            <div class="aspect-square overflow-hidden">
                <img src="<?php echo e(asset('storage/' . $collection->image)); ?>" 
                     alt="<?php echo e($collection->name); ?>"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            </div>
        <?php else: ?>
            <!-- Gradient Background if no image -->
            <div class="aspect-square flex items-center justify-center"
                 style="background: linear-gradient(135deg, <?php echo e($collection->color_hex); ?>40 0%, <?php echo e($collection->color_hex); ?>80 100%);">
                <!-- Optional: Wax Seal -->
                <div class="opacity-20">
                    <?php if (isset($component)) { $__componentOriginal47895ac5e81b30b0dc867dec913558bd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal47895ac5e81b30b0dc867dec913558bd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.wax-seal','data' => ['type' => 'gold','size' => '2xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('wax-seal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'gold','size' => '2xl']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal47895ac5e81b30b0dc867dec913558bd)): ?>
<?php $attributes = $__attributesOriginal47895ac5e81b30b0dc867dec913558bd; ?>
<?php unset($__attributesOriginal47895ac5e81b30b0dc867dec913558bd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal47895ac5e81b30b0dc867dec913558bd)): ?>
<?php $component = $__componentOriginal47895ac5e81b30b0dc867dec913558bd; ?>
<?php unset($__componentOriginal47895ac5e81b30b0dc867dec913558bd); ?>
<?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        
        <!-- Color Bar -->
        <div class="h-2" style="background-color: <?php echo e($collection->color_hex); ?>;"></div>
        
        <!-- Content -->
        <div class="p-6 bg-white">
            <!-- Collection Name -->
            <?php if (isset($component)) { $__componentOriginal98df7be4d2d83ea3b787e656b1f8d7eb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal98df7be4d2d83ea3b787e656b1f8d7eb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.heading','data' => ['level' => '4','class' => 'mb-2 group-hover:text-eva-gold transition-colors']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['level' => '4','class' => 'mb-2 group-hover:text-eva-gold transition-colors']); ?>
                <?php echo e($collection->name); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal98df7be4d2d83ea3b787e656b1f8d7eb)): ?>
<?php $attributes = $__attributesOriginal98df7be4d2d83ea3b787e656b1f8d7eb; ?>
<?php unset($__attributesOriginal98df7be4d2d83ea3b787e656b1f8d7eb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal98df7be4d2d83ea3b787e656b1f8d7eb)): ?>
<?php $component = $__componentOriginal98df7be4d2d83ea3b787e656b1f8d7eb; ?>
<?php unset($__componentOriginal98df7be4d2d83ea3b787e656b1f8d7eb); ?>
<?php endif; ?>
            
            <!-- Color Description -->
            <?php if($collection->color_description): ?>
                <p class="text-xs text-eva-muted mb-2 flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full inline-block" 
                          style="background-color: <?php echo e($collection->color_hex); ?>;"></span>
                    <?php echo e($collection->color_description); ?>

                </p>
            <?php endif; ?>
            
            <!-- Visual Feeling -->
            <?php if($collection->visual_feeling): ?>
                <p class="text-sm text-eva-text mb-3 italic">
                    <?php echo e($collection->visual_feeling); ?>

                </p>
            <?php endif; ?>
            
            <!-- Description -->
            <?php if($collection->description): ?>
                <p class="text-sm text-gray-600 line-clamp-2 mb-4">
                    <?php echo e($collection->description); ?>

                </p>
            <?php endif; ?>
            
            <!-- View Button -->
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium text-eva-gold group-hover:text-eva-charcoal transition-colors">
                    Koleksiyonu Keşfet →
                </span>
                
                <?php if($collection->products_count ?? 0): ?>
                    <span class="text-xs text-eva-muted tabular-nums">
                        <?php echo e($collection->products_count); ?> ürün
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</a>

<?php /**PATH C:\xampp\htdocs\evahome\resources\views/components/collection-card.blade.php ENDPATH**/ ?>