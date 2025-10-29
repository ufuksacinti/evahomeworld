<!-- Main Navigation -->
<nav class="hidden lg:flex items-center space-x-8">
    <!-- HOME -->
    <a href="{{ route('home') }}" 
       class="nav-text text-eva-charcoal hover:text-eva-gold transition-colors duration-300 {{ request()->routeIs('home') ? 'text-eva-gold' : '' }}">
        HOME
    </a>
    
    <!-- SHOP Dropdown -->
    <div class="relative group">
        <button class="flex items-center nav-text text-eva-charcoal hover:text-eva-gold transition-colors duration-300">
            <span>SHOP</span>
            <svg class="w-4 h-4 ml-1 transform group-hover:rotate-180 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
        
        <div class="absolute left-0 mt-2 w-72 bg-white rounded-xl shadow-2xl border-2 border-eva-gold/20 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 overflow-visible">
            @foreach($shopCategories as $category)
                @if($category->children && $category->children->count() > 0)
                    <!-- Parent with Children (2-level dropdown) -->
                    <div class="relative dropdown-parent">
                        <a href="{{ route('category.show', $category->slug) }}" 
                           class="flex items-center justify-between px-6 py-3 text-eva-charcoal hover:bg-eva-gold/10 hover:text-eva-gold transition-all border-b border-eva-silver/20">
                            <span class="font-medium">{{ $category->name }}</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        
                        <!-- Sub-menu -->
                        <div class="absolute left-full top-0 ml-2 w-56 bg-white rounded-xl shadow-2xl border-2 border-eva-gold/20 opacity-0 invisible dropdown-parent:hover dropdown-submenu transition-all duration-300">
                            @foreach($category->children as $child)
                                <a href="{{ route('category.show', $child->slug) }}" 
                                   class="block px-6 py-3 text-eva-charcoal hover:bg-eva-gold/10 hover:text-eva-gold transition-all border-b border-eva-silver/20 last:border-0">
                                    {{ $child->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <!-- Standalone Category -->
                    <a href="{{ route('category.show', $category->slug) }}" 
                       class="block px-6 py-3 text-eva-charcoal hover:bg-eva-gold/10 hover:text-eva-gold transition-all border-b border-eva-silver/20 last:border-0">
                        <span class="font-medium">{{ $category->name }}</span>
                    </a>
                @endif
            @endforeach
        </div>
    </div>

    <!-- COLLECTIONS Dropdown -->
    <div class="relative group">
        <button class="flex items-center nav-text text-eva-charcoal hover:text-eva-gold transition-colors duration-300">
            <span>COLLECTIONS</span>
            <svg class="w-4 h-4 ml-1 transform group-hover:rotate-180 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
        
        <div class="absolute left-0 mt-2 w-80 bg-white rounded-xl shadow-2xl border-2 border-eva-gold/20 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 overflow-hidden">
            @foreach($energyCollections as $collection)
                <a href="{{ route('collections.show', $collection->slug) }}" 
                   class="flex items-center gap-4 px-6 py-4 hover:bg-eva-gold/10 transition-all border-b border-eva-silver/20 last:border-0 group/collection">
                    <!-- Color Circle -->
                    <span class="w-8 h-8 rounded-full border-2 border-white shadow-md flex-shrink-0 group-hover/collection:scale-110 transition-transform" 
                          style="background-color: {{ $collection->color_hex }};"></span>
                    
                    <div class="flex-1">
                        <p class="font-medium text-eva-charcoal group-hover/collection:text-eva-gold transition-colors">
                            {{ $collection->name }}
                        </p>
                        @if($collection->visual_feeling)
                            <p class="text-xs text-eva-muted italic">
                                {{ Str::limit($collection->visual_feeling, 30) }}
                            </p>
                        @endif
                    </div>
                </a>
            @endforeach
            
            <!-- View All -->
            <a href="{{ route('collections.index') }}" 
               class="block px-6 py-3 text-center text-eva-gold hover:bg-eva-gold/10 font-medium transition-all">
                Tüm Koleksiyonları Gör →
            </a>
        </div>
    </div>

    <!-- ABOUT -->
    <a href="{{ route('about') }}" 
       class="nav-text text-eva-charcoal hover:text-eva-gold transition-colors duration-300 {{ request()->routeIs('about') ? 'text-eva-gold' : '' }}">
        ABOUT
    </a>
    
    <!-- BLOG -->
    <a href="{{ route('blog.index') }}" 
       class="nav-text text-eva-charcoal hover:text-eva-gold transition-colors duration-300 {{ request()->routeIs('blog.*') ? 'text-eva-gold' : '' }}">
        BLOG
    </a>
    
    <!-- CONTACT -->
    <a href="{{ route('contact') }}" 
       class="nav-text text-eva-charcoal hover:text-eva-gold transition-colors duration-300 {{ request()->routeIs('contact') ? 'text-eva-gold' : '' }}">
        CONTACT
    </a>
</nav>

