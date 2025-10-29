@extends('layouts.app')

@section('title', 'Ürün Kategorileri')

@section('content')

<!-- Hero Section -->
<section class="relative py-24 bg-gradient-to-br from-primary via-secondary to-accent">
    <div class="container text-center text-white z-10 relative section-header">
        <h1 class="text-5xl md:text-7xl font-bold mb-6">Ürün Kategorileri</h1>
        <p class="text-xl md:text-2xl text-white/90">
            Her kategoride, yaşamınıza özel değer katacak ürünleri keşfedin
        </p>
    </div>
</section>

<!-- Categories Grid -->
@if($categories->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="container px-6 md:px-8 lg:px-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($categories as $category)
            <a href="{{ route('categories.show', $category->slug) }}" 
               class="product-card bg-white rounded-2xl shadow-lg overflow-hidden group block">
                
                <!-- Category Image Header -->
                <div class="h-64 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center relative overflow-hidden group-hover:scale-105 transition-transform duration-500">
                    @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="text-6xl">📦</div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </div>
                
                <!-- Category Info -->
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">{{ $category->name }}</h3>
                    
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $category->description }}</p>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Ürünleri Gör</span>
                        <span class="text-primary font-semibold flex items-center group-hover:translate-x-2 transition-transform">
                            Keşfet
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@else
<section class="py-16 bg-gray-50">
    <div class="container px-6 md:px-8 lg:px-10 text-center">
        <p class="text-xl text-gray-600">Henüz kategori bulunmamaktadır.</p>
    </div>
</section>
@endif

@endsection

