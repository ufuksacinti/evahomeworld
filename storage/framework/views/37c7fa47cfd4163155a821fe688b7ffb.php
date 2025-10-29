<!-- Mobile Menu -->
<div id="mobile-menu" class="lg:hidden bg-white border-t border-eva-silver/30 hidden">
    <div class="px-4 py-4 space-y-1">
        <!-- HOME -->
        <a href="<?php echo e(route('home')); ?>" 
           class="block px-4 py-3 nav-text text-eva-charcoal hover:bg-eva-gold/10 hover:text-eva-gold rounded-lg transition-all <?php echo e(request()->routeIs('home') ? 'bg-eva-gold/10 text-eva-gold' : ''); ?>">
            HOME
        </a>
        
        <!-- SHOP -->
        <div>
            <button class="flex items-center justify-between w-full px-4 py-3 nav-text text-eva-charcoal hover:bg-eva-gold/10 hover:text-eva-gold rounded-lg transition-all" 
                    onclick="toggleMobileSubmenu('shop-menu')">
                <span>SHOP</span>
                <svg class="w-4 h-4 transform transition-transform" id="shop-menu-icon" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div id="shop-menu" class="ml-4 mt-1 space-y-1 hidden">
                <?php $__currentLoopData = $shopCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($category->hasChildren()): ?>
                        <!-- Category with children -->
                        <div>
                            <button class="flex items-center justify-between w-full px-4 py-2 text-sm text-eva-charcoal hover:bg-eva-gold/10 hover:text-eva-gold rounded-lg transition-all"
                                    onclick="toggleMobileSubmenu('category-<?php echo e($category->id); ?>')">
                                <span class="font-medium"><?php echo e($category->name); ?></span>
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div id="category-<?php echo e($category->id); ?>" class="ml-4 mt-1 space-y-1 hidden">
                                <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('category.show', $child->slug)); ?>" 
                                       class="block px-4 py-2 text-sm text-eva-muted hover:text-eva-gold rounded-lg transition-colors">
                                        <?php echo e($child->name); ?>

                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Standalone category -->
                        <a href="<?php echo e(route('category.show', $category->slug)); ?>" 
                           class="block px-4 py-2 text-sm text-eva-charcoal hover:bg-eva-gold/10 hover:text-eva-gold rounded-lg transition-all">
                            <span class="font-medium"><?php echo e($category->name); ?></span>
                        </a>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        
        <!-- COLLECTIONS -->
        <div>
            <button class="flex items-center justify-between w-full px-4 py-3 nav-text text-eva-charcoal hover:bg-eva-gold/10 hover:text-eva-gold rounded-lg transition-all" 
                    onclick="toggleMobileSubmenu('collections-menu')">
                <span>COLLECTIONS</span>
                <svg class="w-4 h-4 transform transition-transform" id="collections-menu-icon" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div id="collections-menu" class="ml-4 mt-1 space-y-1 hidden">
                <?php $__currentLoopData = $energyCollections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('collections.show', $collection->slug)); ?>" 
                       class="flex items-center gap-3 px-4 py-2 text-sm hover:bg-eva-gold/10 rounded-lg transition-all group">
                        <span class="w-3 h-3 rounded-full flex-shrink-0" 
                              style="background-color: <?php echo e($collection->color_hex); ?>;"></span>
                        <span class="text-eva-charcoal group-hover:text-eva-gold transition-colors">
                            <?php echo e($collection->name); ?>

                        </span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        
        <!-- ABOUT -->
        <a href="<?php echo e(route('about')); ?>" 
           class="block px-4 py-3 nav-text text-eva-charcoal hover:bg-eva-gold/10 hover:text-eva-gold rounded-lg transition-all <?php echo e(request()->routeIs('about') ? 'bg-eva-gold/10 text-eva-gold' : ''); ?>">
            ABOUT
        </a>
        
        <!-- BLOG -->
        <a href="<?php echo e(route('blog.index')); ?>" 
           class="block px-4 py-3 nav-text text-eva-charcoal hover:bg-eva-gold/10 hover:text-eva-gold rounded-lg transition-all <?php echo e(request()->routeIs('blog.*') ? 'bg-eva-gold/10 text-eva-gold' : ''); ?>">
            BLOG
        </a>
        
        <!-- CONTACT -->
        <a href="<?php echo e(route('contact')); ?>" 
           class="block px-4 py-3 nav-text text-eva-charcoal hover:bg-eva-gold/10 hover:text-eva-gold rounded-lg transition-all <?php echo e(request()->routeIs('contact') ? 'bg-eva-gold/10 text-eva-gold' : ''); ?>">
            CONTACT
        </a>
    </div>
</div>

<?php /**PATH C:\xampp\htdocs\evahome\resources\views/layouts/navigation-mobile.blade.php ENDPATH**/ ?>