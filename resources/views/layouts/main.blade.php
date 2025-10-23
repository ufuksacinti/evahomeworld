<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'EVA HOME - Premium Ev Dekorasyonu')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo/evahome-icon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts - Preconnect for performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- EVA HOME Premium Font Set -->
    <!-- Playfair Display: Headings (H1-H3) - Elegant & Luxury -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap&subset=latin-ext" rel="stylesheet">
    
    <!-- Inter: Body, Menus, Buttons, Prices - Modern & Clean -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap&subset=latin-ext" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-eva-soft-white">
    <div class="min-h-screen">
        <!-- Top Header -->
        <header class="bg-white border-b border-eva-silver/30">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-10 text-sm">
                    <!-- Left Side - Language -->
                    <div class="flex items-center space-x-4">
                        <div class="relative group">
                            <button class="flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-300">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                                </svg>
                                <span>TR</span>
                                <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            
                            <div class="absolute left-0 mt-1 w-20 bg-white rounded-lg shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                                <a href="#" class="block px-3 py-2 text-gray-900 hover:bg-gray-50 transition-colors text-sm">EN</a>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Auth & Cart -->
                    <div class="flex items-center space-x-6">
                        <!-- Search -->
                        <div class="relative hidden md:block">
                            <input type="text" placeholder="Ürün ara..." class="w-64 pl-8 pr-3 py-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                            <svg class="w-4 h-4 absolute left-2.5 top-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>

                        <!-- Cart -->
                        <a href="{{ route('cart.index') }}" class="flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-300">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="text-sm font-medium">Sepetim</span>
                            <span class="ml-1 bg-gray-900 text-white text-xs rounded-full px-2 py-0.5">0</span>
                        </a>

                        @auth
                            <!-- User Menu -->
                            <div class="relative group">
                                <button class="flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-300 font-medium">
                                    <span class="text-sm">{{ Auth::user()->name }}</span>
                                    <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                
                                <div class="absolute right-0 mt-1 w-48 bg-white rounded-lg shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                                    @if(Auth::user()->isAdmin())
                                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-900 hover:bg-gray-50 transition-colors border-b border-gray-100 text-sm">
                                            Admin Paneli
                                        </a>
                                    @endif
                                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-900 hover:bg-gray-50 transition-colors border-b border-gray-100 text-sm">
                                        Hesabım
                                    </a>
                                    <a href="{{ route('my.orders') }}" class="block px-4 py-2 text-gray-900 hover:bg-gray-50 transition-colors border-b border-gray-100 text-sm">
                                        Siparişlerim
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 transition-colors rounded-b-lg text-sm">
                                            Çıkış Yap
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 transition-colors duration-300 text-sm">
                                Giriş Yap
                            </a>
                            <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-900 transition-colors duration-300 text-sm">
                                Üye Ol
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Header -->
        <header class="bg-white border-b border-eva-silver/30 sticky top-0 z-40 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                            <x-logo size="lg" class="group-hover:opacity-80 transition" />
                        </a>
                    </div>

                    @include('layouts.navigation-main')

                    <!-- Mobile Menu Button -->
                    <div class="lg:hidden">
                        <button id="mobile-menu-button" class="text-gray-700 hover:text-gray-900 transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            @include('layouts.navigation-mobile')
        </header>

        <!-- Main Content -->
        <main>
            @if(session('success'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-lg shadow-sm">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-lg shadow-sm">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                            {{ session('error') }}
                        </div>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-eva-charcoal text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <x-logo variant="white" size="xl" class="mb-4" />
                        <p class="text-eva-silver leading-relaxed">Eviniz için en kaliteli mobilyalar ve dekorasyon ürünleri.</p>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold mb-4">Kategoriler</h4>
                        <ul class="space-y-2 text-gray-400">
                            <li><a href="#" class="hover:text-white transition-colors duration-300">Oturma Odası</a></li>
                            <li><a href="#" class="hover:text-white transition-colors duration-300">Yatak Odası</a></li>
                            <li><a href="#" class="hover:text-white transition-colors duration-300">Yemek Odası</a></li>
                            <li><a href="#" class="hover:text-white transition-colors duration-300">Dekorasyon</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold mb-4">Kurumsal</h4>
                        <ul class="space-y-2 text-gray-400">
                            <li><a href="#" class="hover:text-white transition-colors duration-300">Hakkımızda</a></li>
                            <li><a href="#" class="hover:text-white transition-colors duration-300">İletişim</a></li>
                            <li><a href="{{ route('bulk.order') }}" class="hover:text-white transition-colors duration-300">Toplu Sipariş</a></li>
                            <li><a href="{{ route('blog.index') }}" class="hover:text-white transition-colors duration-300">Blog</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold mb-4">İletişim</h4>
                        <ul class="space-y-3 text-gray-400">
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                info@evahome.com
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                0850 123 45 67
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="border-t border-eva-gold/30 mt-12 pt-8 text-center text-eva-silver">
                    <p>&copy; {{ date('Y') }} EVA HOME. Tüm hakları saklıdır.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- JavaScript for Mobile Menu -->
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });

        // Mobile submenu toggle
        function toggleMobileSubmenu(menuId) {
            const submenu = document.getElementById(menuId);
            submenu.classList.toggle('hidden');
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            
            if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                mobileMenu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
