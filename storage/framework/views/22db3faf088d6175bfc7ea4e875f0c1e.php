<?php $__env->startSection('title', 'Ana Sayfa - EVA HOME'); ?>

<?php $__env->startSection('content'); ?>
<!-- Interactive Hero Section -->
<section class="relative bg-white py-20 lg:py-32 overflow-hidden">
    <!-- Decorative Wax Seals -->
    <div class="absolute top-20 right-10 opacity-5">
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
    <div class="absolute bottom-20 left-10 opacity-5">
        <?php if (isset($component)) { $__componentOriginal47895ac5e81b30b0dc867dec913558bd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal47895ac5e81b30b0dc867dec913558bd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.wax-seal','data' => ['type' => 'bronze','size' => '2xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('wax-seal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'bronze','size' => '2xl']); ?>
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
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div class="order-2 lg:order-1">
                <div class="w-24 h-1 bg-eva-gold mb-8"></div>
                
                <?php if (isset($component)) { $__componentOriginal98df7be4d2d83ea3b787e656b1f8d7eb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal98df7be4d2d83ea3b787e656b1f8d7eb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.heading','data' => ['level' => '1','class' => 'mb-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['level' => '1','class' => 'mb-6']); ?>
                    <span class="text-eva-gold">Kokunun Duyguyla</span><br/>
                    Buluştuğu Yer
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
                
                <!-- Interactive Energy Collection Icons -->
                <div class="mb-8">
                    <p class="text-lg text-eva-text mb-6">
                        Her koleksiyon, farklı bir enerji ve hikaye taşır. Keşfetmek için üzerine gelin:
                    </p>
                    
                    <div class="grid grid-cols-4 gap-3 mb-6">
                        <?php $__currentLoopData = $allEnergyCollections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="energy-icon group cursor-pointer transition-all duration-300 hover:scale-110"
                                 data-collection="<?php echo e($collection->id); ?>"
                                 style="background-color: <?php echo e($collection->color_hex); ?>;"
                                 onmouseover="showCollectionStory('<?php echo e($collection->id); ?>')"
                                 onmouseout="hideCollectionStory()">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300">
                                    <span class="text-white text-lg font-bold opacity-80 group-hover:opacity-100 transition-opacity">
                                        <?php echo e(strtoupper(substr($collection->name, 0, 1))); ?>

                                    </span>
                                </div>
                                <p class="text-xs text-center mt-2 text-eva-text font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <?php echo e($collection->name); ?>

                                </p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                
                <!-- Collection Story Display -->
                <div id="collection-story" class="mb-8 p-6 rounded-lg border-2 border-eva-gold/20 bg-gradient-to-r from-eva-soft-white to-white transition-all duration-500 opacity-0 transform translate-y-4">
                    <div id="story-content">
                        <h3 id="story-title" class="font-heading text-xl text-eva-heading mb-3"></h3>
                        <p id="story-description" class="text-eva-text leading-relaxed"></p>
                        <p id="story-feeling" class="text-sm text-eva-muted mt-3 italic"></p>
                    </div>
                </div>
                
                <div class="flex gap-4">
                    <a href="#collections" 
                       class="btn-text bg-eva-charcoal text-white px-8 py-4 rounded-lg hover:bg-eva-gold transition-all duration-300 shadow-lg">
                        Koleksiyonları Keşfet
                    </a>
                    <a href="#energy" 
                       class="btn-text border-2 border-eva-gold text-eva-charcoal px-8 py-4 rounded-lg hover:bg-eva-gold hover:text-white transition-all duration-300">
                        Enerji Serileri
                    </a>
                </div>
            </div>

            <!-- Right Content - Dynamic Collection Visual -->
            <div class="order-1 lg:order-2">
                <div class="relative">
                    <div id="collection-visual" class="bg-gradient-to-br from-eva-soft-white to-white rounded-2xl p-12 flex items-center justify-center relative overflow-hidden shadow-2xl border-2 border-eva-gold/20 transition-all duration-700"
                         style="min-height: 500px;">
                        
                        <!-- Default State -->
                        <div id="default-visual" class="text-center z-10 transition-opacity duration-500">
                            <?php if (isset($component)) { $__componentOriginal47895ac5e81b30b0dc867dec913558bd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal47895ac5e81b30b0dc867dec913558bd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.wax-seal','data' => ['type' => 'gold','size' => '2xl','class' => 'mx-auto mb-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('wax-seal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'gold','size' => '2xl','class' => 'mx-auto mb-6']); ?>
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
                            <p class="font-heading text-2xl text-eva-heading font-semibold mb-2">8 Enerji Koleksiyonu</p>
                            <p class="text-eva-muted">Her biri farklı bir hikaye</p>
                        </div>
                        
                        <!-- Dynamic Collection Visual -->
                        <div id="dynamic-visual" class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-500">
                            <div class="text-center">
                                <div id="collection-icon" class="w-24 h-24 rounded-full mx-auto mb-6 flex items-center justify-center shadow-2xl">
                                    <span id="collection-letter" class="text-white text-4xl font-bold"></span>
                                </div>
                                <h3 id="collection-name" class="font-heading text-2xl text-eva-heading font-semibold mb-2"></h3>
                                <p id="collection-subtitle" class="text-eva-muted"></p>
                            </div>
                        </div>
                        
                        <!-- Decorative elements -->
                        <div id="decorative-circles" class="absolute inset-0 pointer-events-none">
                            <div class="absolute top-8 right-8 w-32 h-32 rounded-full opacity-20 transition-all duration-700"></div>
                            <div class="absolute bottom-8 left-8 w-24 h-24 rounded-full opacity-20 transition-all duration-700"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Collection Data for JavaScript -->
<script>
const energyCollections = <?php echo json_encode($allEnergyCollections, 15, 512) ?>;

function showCollectionStory(collectionId) {
    const collection = energyCollections.find(c => c.id == collectionId);
    if (!collection) return;
    
    // Update story content
    document.getElementById('story-title').textContent = collection.name + ' Hikayesi';
    document.getElementById('story-description').textContent = collection.description || 'Bu koleksiyon, özel enerjisi ve anlamıyla evinize huzur getirir.';
    document.getElementById('story-feeling').textContent = collection.visual_feeling || collection.color_description;
    
    // Show story container
    const storyContainer = document.getElementById('collection-story');
    storyContainer.style.opacity = '1';
    storyContainer.style.transform = 'translateY(0)';
    
    // Update visual
    updateCollectionVisual(collection);
}

function hideCollectionStory() {
    const storyContainer = document.getElementById('collection-story');
    storyContainer.style.opacity = '0';
    storyContainer.style.transform = 'translateY(1rem)';
    
    // Reset to default visual
    resetToDefaultVisual();
}

function updateCollectionVisual(collection) {
    // Hide default, show dynamic
    document.getElementById('default-visual').style.opacity = '0';
    document.getElementById('dynamic-visual').style.opacity = '1';
    
    // Update content
    document.getElementById('collection-letter').textContent = collection.name.charAt(0).toUpperCase();
    document.getElementById('collection-name').textContent = collection.name;
    document.getElementById('collection-subtitle').textContent = collection.visual_feeling || 'Özel enerji koleksiyonu';
    
    // Update colors
    const icon = document.getElementById('collection-icon');
    icon.style.backgroundColor = collection.color_hex;
    
    const visual = document.getElementById('collection-visual');
    visual.style.borderColor = collection.color_hex + '40';
    
    // Update decorative circles
    const circles = document.querySelectorAll('#decorative-circles > div');
    circles.forEach(circle => {
        circle.style.backgroundColor = collection.color_hex;
    });
}

function resetToDefaultVisual() {
    // Show default, hide dynamic
    document.getElementById('default-visual').style.opacity = '1';
    document.getElementById('dynamic-visual').style.opacity = '0';
    
    // Reset colors
    const visual = document.getElementById('collection-visual');
    visual.style.borderColor = 'rgba(216, 179, 111, 0.2)';
    
    // Reset decorative circles
    const circles = document.querySelectorAll('#decorative-circles > div');
    circles.forEach((circle, index) => {
        if (index === 0) {
            circle.style.backgroundColor = 'var(--color-jasmine)';
        } else {
            circle.style.backgroundColor = 'var(--color-lavender)';
        }
    });
}
</script>

<!-- Shop Collections Section -->
<?php if($shopCollections->count() > 0): ?>
<section id="collections" class="bg-white py-16 border-t border-eva-silver/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="w-24 h-1 bg-eva-gold mx-auto mb-6"></div>
            <?php if (isset($component)) { $__componentOriginal98df7be4d2d83ea3b787e656b1f8d7eb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal98df7be4d2d83ea3b787e656b1f8d7eb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.heading','data' => ['level' => '2','class' => 'mb-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['level' => '2','class' => 'mb-4']); ?>
                Shop Collections
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
            <p class="text-lg text-eva-text">Özel tasarım koleksiyonlarımızı keşfedin</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php $__currentLoopData = $shopCollections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if (isset($component)) { $__componentOriginalac81e65f88133dbd28c6577deb3e69dd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalac81e65f88133dbd28c6577deb3e69dd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.collection-card','data' => ['collection' => $collection]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('collection-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['collection' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($collection)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalac81e65f88133dbd28c6577deb3e69dd)): ?>
<?php $attributes = $__attributesOriginalac81e65f88133dbd28c6577deb3e69dd; ?>
<?php unset($__attributesOriginalac81e65f88133dbd28c6577deb3e69dd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalac81e65f88133dbd28c6577deb3e69dd)): ?>
<?php $component = $__componentOriginalac81e65f88133dbd28c6577deb3e69dd; ?>
<?php unset($__componentOriginalac81e65f88133dbd28c6577deb3e69dd); ?>
<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Energy Collections Section -->
<?php if($energyCollections->count() > 0): ?>
<section id="energy" class="bg-eva-soft-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="w-24 h-1 bg-eva-gold mx-auto mb-6"></div>
            <?php if (isset($component)) { $__componentOriginal98df7be4d2d83ea3b787e656b1f8d7eb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal98df7be4d2d83ea3b787e656b1f8d7eb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.heading','data' => ['level' => '2','class' => 'mb-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['level' => '2','class' => 'mb-4']); ?>
                Enerji Serisi Koleksiyonları
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
            <p class="text-lg text-eva-text mb-8">
                Her koleksiyon, farklı bir enerji ve duygu taşır
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php $__currentLoopData = $energyCollections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if (isset($component)) { $__componentOriginalac81e65f88133dbd28c6577deb3e69dd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalac81e65f88133dbd28c6577deb3e69dd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.collection-card','data' => ['collection' => $collection]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('collection-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['collection' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($collection)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalac81e65f88133dbd28c6577deb3e69dd)): ?>
<?php $attributes = $__attributesOriginalac81e65f88133dbd28c6577deb3e69dd; ?>
<?php unset($__attributesOriginalac81e65f88133dbd28c6577deb3e69dd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalac81e65f88133dbd28c6577deb3e69dd)): ?>
<?php $component = $__componentOriginalac81e65f88133dbd28c6577deb3e69dd; ?>
<?php unset($__componentOriginalac81e65f88133dbd28c6577deb3e69dd); ?>
<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="text-center mt-12">
            <a href="<?php echo e(route('collections.index')); ?>" 
               class="inline-flex items-center gap-2 nav-text text-eva-gold hover:text-eva-charcoal transition-colors font-medium">
                <span>Tüm Koleksiyonları Keşfet</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Featured Products -->
<?php if($featuredProducts->count() > 0): ?>
<section class="bg-white py-16 border-t-2 border-eva-gold/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="w-24 h-1 bg-eva-gold mx-auto mb-6"></div>
            <?php if (isset($component)) { $__componentOriginal98df7be4d2d83ea3b787e656b1f8d7eb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal98df7be4d2d83ea3b787e656b1f8d7eb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.heading','data' => ['level' => '2','class' => 'mb-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['level' => '2','class' => 'mb-4']); ?>
                Öne Çıkan Ürünler
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
            <p class="text-lg text-eva-text">Premium kalite, el işçiliği</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php $__currentLoopData = $featuredProducts->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="group bg-white rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300 border border-eva-silver/30">
                    <a href="<?php echo e(route('products.show', $product->slug)); ?>">
                        <!-- Product Image -->
                        <div class="relative aspect-square bg-gray-50">
                            <?php if($product->images->count() > 0): ?>
                                <img src="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>" 
                                     alt="<?php echo e($product->name); ?>"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center"
                                     style="background: linear-gradient(135deg, <?php echo e($product->collection->color_hex ?? '#FAF8F6'); ?>20 0%, <?php echo e($product->collection->color_hex ?? '#FAF8F6'); ?>40 100%);">
                                    <?php if (isset($component)) { $__componentOriginal47895ac5e81b30b0dc867dec913558bd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal47895ac5e81b30b0dc867dec913558bd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.wax-seal','data' => ['type' => 'bronze','size' => 'lg','class' => 'opacity-20']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('wax-seal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'bronze','size' => 'lg','class' => 'opacity-20']); ?>
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
                            <?php endif; ?>

                            <!-- Collection Badge -->
                            <?php if($product->collection): ?>
                                <div class="absolute top-3 left-3">
                                    <?php if (isset($component)) { $__componentOriginal20721f8383721fab4b0d7fa7d7f029b8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal20721f8383721fab4b0d7fa7d7f029b8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.collection-badge','data' => ['collection' => $product->collection,'size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('collection-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['collection' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->collection),'size' => 'sm']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal20721f8383721fab4b0d7fa7d7f029b8)): ?>
<?php $attributes = $__attributesOriginal20721f8383721fab4b0d7fa7d7f029b8; ?>
<?php unset($__attributesOriginal20721f8383721fab4b0d7fa7d7f029b8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal20721f8383721fab4b0d7fa7d7f029b8)): ?>
<?php $component = $__componentOriginal20721f8383721fab4b0d7fa7d7f029b8; ?>
<?php unset($__componentOriginal20721f8383721fab4b0d7fa7d7f029b8); ?>
<?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Discount Badge -->
                            <?php if($product->hasDiscount()): ?>
                                <div class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow-lg">
                                    -%<?php echo e($product->getDiscountPercentage()); ?>

                                </div>
                            <?php endif; ?>
                            
                            <!-- Premium Wax Seal -->
                            <div class="absolute bottom-3 right-3">
                                <?php if (isset($component)) { $__componentOriginal47895ac5e81b30b0dc867dec913558bd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal47895ac5e81b30b0dc867dec913558bd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.wax-seal','data' => ['type' => 'gold','size' => 'sm','class' => 'drop-shadow-xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('wax-seal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'gold','size' => 'sm','class' => 'drop-shadow-xl']); ?>
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

                        <!-- Product Info -->
                        <div class="p-4">
                            <h3 class="font-heading font-semibold text-base text-eva-heading mb-2 line-clamp-2 group-hover:text-eva-gold transition-colors">
                                <?php echo e($product->name); ?>

                            </h3>

                            <div class="flex items-baseline gap-2">
                                <?php if($product->hasDiscount()): ?>
                                    <?php if (isset($component)) { $__componentOriginal5c7c50258000edf57abfef324d310474 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c7c50258000edf57abfef324d310474 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.price','data' => ['amount' => $product->discount_price,'size' => 'base','class' => 'text-eva-price font-bold']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('price'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['amount' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->discount_price),'size' => 'base','class' => 'text-eva-price font-bold']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5c7c50258000edf57abfef324d310474)): ?>
<?php $attributes = $__attributesOriginal5c7c50258000edf57abfef324d310474; ?>
<?php unset($__attributesOriginal5c7c50258000edf57abfef324d310474); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5c7c50258000edf57abfef324d310474)): ?>
<?php $component = $__componentOriginal5c7c50258000edf57abfef324d310474; ?>
<?php unset($__componentOriginal5c7c50258000edf57abfef324d310474); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginal5c7c50258000edf57abfef324d310474 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c7c50258000edf57abfef324d310474 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.price','data' => ['amount' => $product->price,'size' => 'xs','class' => 'text-eva-muted line-through']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('price'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['amount' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->price),'size' => 'xs','class' => 'text-eva-muted line-through']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5c7c50258000edf57abfef324d310474)): ?>
<?php $attributes = $__attributesOriginal5c7c50258000edf57abfef324d310474; ?>
<?php unset($__attributesOriginal5c7c50258000edf57abfef324d310474); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5c7c50258000edf57abfef324d310474)): ?>
<?php $component = $__componentOriginal5c7c50258000edf57abfef324d310474; ?>
<?php unset($__componentOriginal5c7c50258000edf57abfef324d310474); ?>
<?php endif; ?>
                                <?php else: ?>
                                    <?php if (isset($component)) { $__componentOriginal5c7c50258000edf57abfef324d310474 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c7c50258000edf57abfef324d310474 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.price','data' => ['amount' => $product->price,'size' => 'base','class' => 'text-eva-price font-bold']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('price'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['amount' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->price),'size' => 'base','class' => 'text-eva-price font-bold']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5c7c50258000edf57abfef324d310474)): ?>
<?php $attributes = $__attributesOriginal5c7c50258000edf57abfef324d310474; ?>
<?php unset($__attributesOriginal5c7c50258000edf57abfef324d310474); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5c7c50258000edf57abfef324d310474)): ?>
<?php $component = $__componentOriginal5c7c50258000edf57abfef324d310474; ?>
<?php unset($__componentOriginal5c7c50258000edf57abfef324d310474); ?>
<?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Statistics Section -->
<section class="bg-eva-charcoal text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <p class="text-5xl font-heading font-bold mb-2 tabular-nums text-eva-gold">
                    <?php echo e(number_format($stats['total_products'])); ?>+
                </p>
                <p class="text-eva-silver uppercase tracking-wider text-sm font-medium">Ürün</p>
            </div>
            <div>
                <p class="text-5xl font-heading font-bold mb-2 tabular-nums text-eva-gold">8</p>
                <p class="text-eva-silver uppercase tracking-wider text-sm font-medium">Enerji Koleksiyonu</p>
            </div>
            <div>
                <p class="text-5xl font-heading font-bold mb-2 tabular-nums text-eva-gold">
                    <?php echo e(number_format($stats['total_orders'])); ?>+
                </p>
                <p class="text-eva-silver uppercase tracking-wider text-sm font-medium">Sipariş</p>
            </div>
            <div>
                <p class="text-5xl font-heading font-bold mb-2 tabular-nums text-eva-gold">
                    <?php echo e(number_format($stats['total_customers'])); ?>+
                </p>
                <p class="text-eva-silver uppercase tracking-wider text-sm font-medium">Mutlu Müşteri</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="relative bg-white py-20 border-t-2 border-eva-gold/20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <!-- Wax Seal -->
        <?php if (isset($component)) { $__componentOriginal47895ac5e81b30b0dc867dec913558bd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal47895ac5e81b30b0dc867dec913558bd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.wax-seal','data' => ['type' => 'gold','size' => 'xl','class' => 'mx-auto mb-8']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('wax-seal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'gold','size' => 'xl','class' => 'mx-auto mb-8']); ?>
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
        
        <?php if (isset($component)) { $__componentOriginal98df7be4d2d83ea3b787e656b1f8d7eb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal98df7be4d2d83ea3b787e656b1f8d7eb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.heading','data' => ['level' => '2','class' => 'mb-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['level' => '2','class' => 'mb-6']); ?>
            Toplu Sipariş mi Vermek İstiyorsunuz?
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
        
        <p class="text-lg text-eva-text mb-8 max-w-2xl mx-auto">
            Kurumsal ve toplu siparişleriniz için özel fiyatlandırma ve hizmet sunuyoruz. 
            Premium paketleme ve özel tasarım seçenekleri.
        </p>
        
        <a href="<?php echo e(route('bulk.order')); ?>" 
           class="inline-flex items-center gap-3 btn-text bg-eva-gold hover:bg-eva-charcoal text-white px-8 py-4 rounded-lg transition-all duration-300 shadow-lg">
            <span>Toplu Sipariş Formu</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
        </a>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\evahome\resources\views/home.blade.php ENDPATH**/ ?>