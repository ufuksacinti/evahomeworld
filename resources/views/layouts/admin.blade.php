<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel - EVA HOME')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo/evahome-icon.svg') }}">

    <!-- Fonts - EVA HOME Premium -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap&subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap&subset=latin-ext" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="font-sans antialiased bg-eva-soft-white">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-72 bg-eva-charcoal text-white flex-shrink-0 shadow-2xl">
            <div class="p-6 border-b border-eva-gold/30">
                <!-- Logo -->
                <a href="{{ route('admin.dashboard') }}" class="block">
                    <x-logo variant="white" size="lg" class="mb-2" />
                    <p class="text-xs text-eva-silver uppercase tracking-wider">Admin Panel</p>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-1">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-eva-gold text-white' : 'text-eva-silver hover:bg-eva-gold/20 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>

                <!-- Products -->
                <a href="{{ route('admin.products.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.products.*') ? 'bg-eva-gold text-white' : 'text-eva-silver hover:bg-eva-gold/20 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span class="font-medium">Ürünler</span>
                </a>

                <!-- Collections -->
                <a href="{{ route('admin.collections.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.collections.*') ? 'bg-eva-gold text-white' : 'text-eva-silver hover:bg-eva-gold/20 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <span class="font-medium">Koleksiyonlar</span>
                </a>

                <!-- Categories -->
                <a href="{{ route('admin.categories.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.categories.*') ? 'bg-eva-gold text-white' : 'text-eva-silver hover:bg-eva-gold/20 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    <span class="font-medium">Kategoriler</span>
                </a>

                <!-- Orders -->
                <a href="{{ route('admin.orders.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.orders.*') ? 'bg-eva-gold text-white' : 'text-eva-silver hover:bg-eva-gold/20 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span class="font-medium">Siparişler</span>
                    @if(isset($pendingOrders) && $pendingOrders > 0)
                        <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full tabular-nums">{{ $pendingOrders }}</span>
                    @endif
                </a>

                <!-- Customers -->
                <a href="{{ route('admin.customers.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.customers.*') ? 'bg-eva-gold text-white' : 'text-eva-silver hover:bg-eva-gold/20 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span class="font-medium">Müşteriler</span>
                </a>

                <!-- Bulk Orders -->
                <a href="{{ route('admin.bulk-orders.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.bulk-orders.*') ? 'bg-eva-gold text-white' : 'text-eva-silver hover:bg-eva-gold/20 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="font-medium">Toplu Siparişler</span>
                </a>

                <!-- Blog Posts -->
                <a href="{{ route('admin.blog-posts.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.blog-posts.*') ? 'bg-eva-gold text-white' : 'text-eva-silver hover:bg-eva-gold/20 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    <span class="font-medium">Blog</span>
                </a>

                <!-- Divider -->
                <div class="my-4 border-t border-eva-gold/20"></div>

                <!-- Settings -->
                <a href="{{ route('admin.settings') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.settings') ? 'bg-eva-gold text-white' : 'text-eva-silver hover:bg-eva-gold/20 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="font-medium">Ayarlar</span>
                </a>
            </nav>

            <!-- User Info -->
            <div class="absolute bottom-0 left-0 right-0 p-6 border-t border-eva-gold/30">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-full bg-eva-gold flex items-center justify-center flex-shrink-0">
                        <span class="font-bold text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-eva-silver truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('home') }}" 
                       class="flex-1 text-center text-xs text-eva-silver hover:text-white transition-colors py-2">
                        Siteyi Görüntüle
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="flex-1">
                        @csrf
                        <button type="submit" 
                                class="w-full text-xs text-eva-silver hover:text-white transition-colors py-2">
                            Çıkış Yap
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="bg-white border-b border-eva-silver/30 shadow-sm">
                <div class="px-8 py-4 flex items-center justify-between">
                    <div>
                        <h1 class="font-heading text-2xl font-semibold text-eva-heading">
                            @yield('page-title', 'Dashboard')
                        </h1>
                        @if(isset($breadcrumbs))
                            <nav class="flex items-center gap-2 mt-1 text-sm text-eva-muted">
                                @foreach($breadcrumbs as $label => $url)
                                    @if($loop->last)
                                        <span class="text-eva-charcoal">{{ $label }}</span>
                                    @else
                                        <a href="{{ $url }}" class="hover:text-eva-gold transition-colors">{{ $label }}</a>
                                        <span>/</span>
                                    @endif
                                @endforeach
                            </nav>
                        @endif
                    </div>

                    <!-- Quick Actions -->
                    <div class="flex items-center gap-4">
                        <!-- Notifications -->
                        <button class="relative p-2 text-eva-muted hover:text-eva-gold transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>

                        <!-- User -->
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-eva-charcoal font-medium">{{ Auth::user()->name }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto">
                @if(session('success'))
                    <div class="mx-8 mt-4">
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
                    <div class="mx-8 mt-4">
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

                <div class="p-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>

