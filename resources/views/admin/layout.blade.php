<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - EvaHome</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
    <style>
        body {
            background: #f8fafc;
        }
        .sidebar {
            width: 260px;
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: white;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
        }
        .sidebar-item:hover {
            background: #f0f0f0;
        }
        .sidebar-item.active {
            background: #6366f1;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-indigo-600 mb-8">
                Eva<span class="text-accent">Home</span> <br>
                <span class="text-sm text-gray-600">Admin Panel</span>
            </h2>
            
            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-item block px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line mr-3"></i> Dashboard
                </a>
                
                <a href="{{ route('admin.products.index') }}" class="sidebar-item block px-4 py-3 rounded-lg {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="fas fa-box mr-3"></i> Ürünler
                </a>
                
                <a href="#" class="sidebar-item block px-4 py-3 rounded-lg">
                    <i class="fas fa-shopping-cart mr-3"></i> Siparişler
                </a>
                
                <a href="#" class="sidebar-item block px-4 py-3 rounded-lg">
                    <i class="fas fa-users mr-3"></i> Kullanıcılar
                </a>
                
                <a href="#" class="sidebar-item block px-4 py-3 rounded-lg">
                    <i class="fas fa-heart mr-3"></i> Koleksiyonlar
                </a>
                
                <a href="#" class="sidebar-item block px-4 py-3 rounded-lg">
                    <i class="fas fa-folder-open mr-3"></i> Kategoriler
                </a>
                
                <div class="border-t border-gray-200 my-4"></div>
                
                <a href="{{ route('home') }}" class="sidebar-item block px-4 py-3 rounded-lg">
                    <i class="fas fa-home mr-3"></i> Ana Sayfaya Dön
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-item block w-full text-left px-4 py-3 rounded-lg text-red-600">
                        <i class="fas fa-sign-out-alt mr-3"></i> Çıkış Yap
                    </button>
                </form>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
            <div class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-800">@yield('title', 'Dashboard')</h1>
                    <div class="flex items-center space-x-4">
                        <div class="text-gray-600">
                            <i class="fas fa-user-circle mr-2"></i>
                            {{ Auth::user()->name }}
                        </div>
                        <span class="px-3 py-1 bg-indigo-100 text-indigo-600 rounded-full text-sm font-semibold">
                            Admin
                        </span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="p-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>
</html>

