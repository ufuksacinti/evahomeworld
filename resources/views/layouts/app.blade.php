<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>@yield('title', config('app.name', 'EvaHome'))</title>
    
    <!-- Meta Tags -->
    <meta name="description" content="@yield('meta_description', 'EvaHome - Enerji Koleksiyonları ile Özel Ürünler')">
    <meta name="keywords" content="@yield('meta_keywords', 'enerji, koleksiyon, ürün, evahome')">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="antialiased bg-primary">
    
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="container px-6 md:px-8 lg:px-10">
            <div class="flex items-center justify-between py-4">
                <!-- Left: Hamburger Menu -->
                <div class="flex items-center pl-2">
                    <button id="hamburgerBtn" class="text-gray-700 hover:text-primary transition mr-4">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Center: Logo -->
                <div class="flex-1 text-center">
                    <a href="{{ route('home') }}" class="text-3xl font-bold text-primary inline-block">
                        Eva<span class="text-accent">Home</span>
                    </a>
                </div>
                
                <!-- Right: Cart and Language -->
                <div class="flex items-center space-x-4 pr-2">
                    @auth
                    <!-- User Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center space-x-2 text-gray-700 hover:text-primary transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="hidden sm:inline font-medium">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div class="absolute right-0 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg hidden group-hover:block w-56">
                            <div class="px-4 py-3 border-b border-gray-200">
                                <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            </div>
                            @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-100 text-gray-700">
                                <i class="fas fa-tachometer-alt mr-2 text-indigo-600"></i>Admin Panel
                            </a>
                            @endif
                            <a href="{{ route('orders.index') }}" class="block px-4 py-2 hover:bg-gray-100 text-gray-700">
                                <i class="fas fa-shopping-bag mr-2 text-gray-600"></i>Siparişlerim
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Çıkış Yap
                                </button>
                            </form>
                        </div>
                    </div>
                    @endauth

                    @guest
                    <!-- Login Button -->
                    <a href="{{ route('login') }}" class="flex items-center text-gray-700 hover:text-primary transition px-3 py-2 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        <span class="hidden sm:inline">Giriş</span>
                    </a>
                    @endguest

                    <!-- Language Switcher -->
                    <div class="relative group">
                        <button class="flex items-center space-x-1 text-gray-700 hover:text-primary transition">
                            <span class="uppercase font-semibold">{{ strtoupper(app()->getLocale()) }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div class="absolute right-0 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg hidden group-hover:block">
                            <a href="{{ route('locale.switch', 'tr') }}" class="block px-4 py-2 hover:bg-gray-100 text-gray-700">TR</a>
                            <a href="{{ route('locale.switch', 'en') }}" class="block px-4 py-2 hover:bg-gray-100 text-gray-700">EN</a>
                        </div>
                    </div>

                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" class="relative flex items-center text-gray-700 hover:text-primary transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="absolute -top-1 -right-1 bg-accent text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold" id="cartCount">0</span>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Hamburger Menu Sidebar -->
        <div id="sidebar" class="fixed top-0 left-0 h-full w-80 bg-white shadow-xl transform -translate-x-full transition-transform duration-300 z-50">
            <div class="p-6 px-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-primary">{{ t('menu.title') }}</h2>
                    <button id="closeSidebar" class="text-gray-700 hover:text-primary transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Menu Items -->
                <div class="space-y-1">
                    <!-- 1. Enerji Koleksiyonları -->
                    <div>
                        <button onclick="toggleMenu('collections')" class="w-full flex items-center justify-between py-3 px-6 text-left hover:bg-gray-100 rounded-lg transition">
                            <span class="font-semibold text-gray-800">{{ t('menu.collections') }}</span>
                            <svg id="icon-collections" class="w-5 h-5 text-gray-500 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="submenu-collections" class="hidden pl-4 space-y-1 mt-1">
                            @php
                                $collections = \App\Models\EnergyCollection::where('is_active', true)->orderBy('sort_order')->get();
                            @endphp
                            @foreach($collections as $collection)
                                <a href="{{ route('collections.show', $collection->slug) }}" class="block py-2 px-4 pl-8 hover:bg-gray-100 rounded text-gray-700 flex items-center">
                                    <span class="w-3 h-3 rounded-full mr-2" style="background-color: {{ $collection->color_code }};"></span>
                                    {{ $collection->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- 2. Ürün Kategorileri -->
                    <div>
                        <button onclick="toggleMenu('categories')" class="w-full flex items-center justify-between py-3 px-6 text-left hover:bg-gray-100 rounded-lg transition">
                            <span class="font-semibold text-gray-800">{{ t('menu.categories') }}</span>
                            <svg id="icon-categories" class="w-5 h-5 text-gray-500 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="submenu-categories" class="hidden pl-4 space-y-1 mt-1">
                            @php
                                $categories = \App\Models\Category::where('is_active', true);
                                if (\Illuminate\Support\Facades\Schema::hasColumn('categories', 'sort_order')) {
                                    $categories = $categories->orderBy('sort_order');
                                } else {
                                    $categories = $categories->orderBy('created_at', 'desc');
                                }
                                $categories = $categories->get();
                            @endphp
                            @foreach($categories as $cat)
                                <a href="{{ route('categories.show', $cat->slug) }}" class="block py-2 px-4 pl-8 hover:bg-gray-100 rounded text-gray-700">
                                    {{ $cat->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- 3. Marka -->
                    <div>
                        <button onclick="toggleMenu('brand')" class="w-full flex items-center justify-between py-3 px-6 text-left hover:bg-gray-100 rounded-lg transition">
                            <span class="font-semibold text-gray-800">{{ t('menu.brand') }}</span>
                            <svg id="icon-brand" class="w-5 h-5 text-gray-500 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="submenu-brand" class="hidden pl-4 space-y-1 mt-1">
                            <a href="#" class="block py-2 px-4 pl-8 hover:bg-gray-100 rounded text-gray-700">{{ t('menu.brand.story') }}</a>
                            <a href="#" class="block py-2 px-4 pl-8 hover:bg-gray-100 rounded text-gray-700">{{ t('menu.brand.manifesto') }}</a>
                            <a href="#" class="block py-2 px-4 pl-8 hover:bg-gray-100 rounded text-gray-700">{{ t('menu.brand.blog') }}</a>
                            <a href="#" class="block py-2 px-4 pl-8 hover:bg-gray-100 rounded text-gray-700">{{ t('menu.brand.contact') }}</a>
                            <a href="#" class="block py-2 px-4 pl-8 hover:bg-gray-100 rounded text-gray-700">{{ t('menu.brand.shipping') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Overlay -->
        <div id="overlay" class="fixed inset-0 bg-black/10 z-40 hidden backdrop-blur-sm"></div>
    </header>
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="bg-gradient-to-b from-gray-900 to-gray-950 text-white mt-24">
        <div class="container px-6 md:px-8 lg:px-10 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <!-- Company Info -->
                <div>
                    <h3 class="text-2xl font-bold mb-4">
                        Eva<span class="text-accent">Home</span>
                    </h3>
                    <p class="text-gray-400 mb-6">
                        Enerji koleksiyonları ile özel tasarım ürünlerin buluştuğu platform. Her ürünümüz özenle seçilmiş enerjilerle yaşamınıza pozitif değer katıyor.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 hover:bg-primary transition flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 hover:bg-primary transition flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 hover:bg-primary transition flex items-center justify-center">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.897 1.382-.42.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.897-.419-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="font-bold mb-6 text-lg">Hızlı Linkler</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition flex items-center"><svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>Ana Sayfa</a></li>
                        <li><a href="{{ route('collections.index') }}" class="text-gray-400 hover:text-white transition flex items-center"><svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>Koleksiyonlar</a></li>
                        <li><a href="{{ route('products.index') }}" class="text-gray-400 hover:text-white transition flex items-center"><svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>Ürünler</a></li>
                        <li><a href="{{ route('categories.index') }}" class="text-gray-400 hover:text-white transition flex items-center"><svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>Kategoriler</a></li>
                    </ul>
                </div>
                
                <!-- Collections -->
                <div>
                    <h4 class="font-bold mb-6 text-lg">Enerji Koleksiyonları</h4>
                    <ul class="space-y-3">
                        @php
                            $footerCollections = \App\Models\EnergyCollection::where('is_active', true)->take(5)->get();
                        @endphp
                        @foreach($footerCollections as $collection)
                        <li><a href="{{ route('collections.show', $collection->slug) }}" class="text-gray-400 hover:text-white transition flex items-center">
                            <span class="w-3 h-3 rounded-full mr-2" style="background-color: {{ $collection->color_code }};"></span>{{ $collection->name }}
                        </a></li>
                        @endforeach
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h4 class="font-bold mb-6 text-lg">İletişim</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span>info@evahome.com</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span>+90 555 123 4567</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>İstanbul, Türkiye</span>
                        </li>
                    </ul>
                    
                    <div class="mt-6">
                        <a href="{{ route('register') }}" class="btn btn-primary w-full">Kayıt Ol</a>
                    </div>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="border-t border-gray-800 mt-12 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 mb-4 md:mb-0">&copy; {{ date('Y') }} EvaHome. Tüm hakları saklıdır.</p>
                    <div class="flex space-x-6 text-sm text-gray-400">
                        <a href="#" class="hover:text-white transition">Gizlilik Politikası</a>
                        <a href="#" class="hover:text-white transition">Kullanım Şartları</a>
                        <a href="#" class="hover:text-white transition">İade ve Değişim</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Scripts -->
    <script>
        // Hamburger Menu Toggle
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const sidebar = document.getElementById('sidebar');
        const closeSidebar = document.getElementById('closeSidebar');
        const overlay = document.getElementById('overlay');
        
        hamburgerBtn.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        });
        
        closeSidebar.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
        
        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
        
        // Toggle submenu
        function toggleMenu(type) {
            const submenu = document.getElementById(`submenu-${type}`);
            const icon = document.getElementById(`icon-${type}`);
            
            submenu.classList.toggle('hidden');
            
            if (submenu.classList.contains('hidden')) {
                icon.style.transform = 'rotate(0deg)';
            } else {
                icon.style.transform = 'rotate(180deg)';
            }
        }
        
        // Update cart count
        fetch('/cart/count')
            .then(response => response.json())
            .then(data => {
                document.getElementById('cartCount').textContent = data.count || 0;
            })
            .catch(error => {
                console.log('Cart count error:', error);
            });
    </script>
    
    @stack('scripts')
</body>
</html>

