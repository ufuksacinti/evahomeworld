<!-- Mobile Menu -->
<div id="mobile-menu" class="lg:hidden bg-white border-t border-eva-silver/30 hidden">
    <div class="px-4 py-4 space-y-1">
        <!-- HOME -->
        <a href="{{ route('home') }}" 
           class="block px-4 py-3 nav-text text-eva-charcoal hover:bg-eva-gold/10 hover:text-eva-gold rounded-lg transition-all {{ request()->routeIs('home') ? 'bg-eva-gold/10 text-eva-gold' : '' }}">
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
                @foreach($shopCategories as $category)
                    @if($category->hasChildren())
                        <!-- Category with children -->
                        <div>
                            <button class="flex items-center justify-between w-full px-4 py-2 text-sm text-eva-charcoal hover:bg-eva-gold/10 hover:text-eva-gold rounded-lg transition-all"
                                    onclick="toggleMobileSubmenu('category-{{ $category->id }}')">
                                <span class="font-medium">{{ $category->name }}</span>
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div id="category-{{ $category->id }}" class="ml-4 mt-1 space-y-1 hidden">
                                @foreach($category->children as $child)
                                    <a href="{{ route('category.show', $child->slug) }}" 
                                       class="block px-4 py-2 text-sm text-eva-muted hover:text-eva-gold rounded-lg transition-colors">
                                        {{ $child->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <!-- Standalone category -->
                        <a href="{{ route('category.show', $category->slug) }}" 
                           class="block px-4 py-2 text-sm text-eva-charcoal hover:bg-eva-gold/10 hover:text-eva-gold rounded-lg transition-all">
                            <span class="font-medium">{{ $category->name }}</span>
                        </a>
                    @endif
                @endforeach
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
                @foreach($energyCollections as $collection)
                    <a href="{{ route('collections.show', $collection->slug) }}" 
                       class="flex items-center gap-3 px-4 py-2 text-sm hover:bg-eva-gold/10 rounded-lg transition-all group">
                        <span class="w-3 h-3 rounded-full flex-shrink-0" 
                              style="background-color: {{ $collection->color_hex }};"></span>
                        <span class="text-eva-charcoal group-hover:text-eva-gold transition-colors">
                            {{ $collection->name }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
        
        <!-- ABOUT -->
        <a href="{{ route('about') }}" 
           class="block px-4 py-3 nav-text text-eva-charcoal hover:bg-eva-gold/10 hover:text-eva-gold rounded-lg transition-all {{ request()->routeIs('about') ? 'bg-eva-gold/10 text-eva-gold' : '' }}">
            ABOUT
        </a>
        
        <!-- BLOG -->
        <a href="{{ route('blog.index') }}" 
           class="block px-4 py-3 nav-text text-eva-charcoal hover:bg-eva-gold/10 hover:text-eva-gold rounded-lg transition-all {{ request()->routeIs('blog.*') ? 'bg-eva-gold/10 text-eva-gold' : '' }}">
            BLOG
        </a>
        
        <!-- CONTACT -->
        <a href="{{ route('contact') }}" 
           class="block px-4 py-3 nav-text text-eva-charcoal hover:bg-eva-gold/10 hover:text-eva-gold rounded-lg transition-all {{ request()->routeIs('contact') ? 'bg-eva-gold/10 text-eva-gold' : '' }}">
            CONTACT
        </a>
    </div>
</div>

