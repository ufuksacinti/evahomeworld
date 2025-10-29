@extends('layouts.app')

@section('title', 'Enerji Koleksiyonları')

@section('content')

<!-- Hero Section -->
<section class="relative py-24 bg-gradient-to-br from-primary via-secondary to-accent">
    <div class="container text-center text-white z-10 relative section-header">
        <h1 class="text-5xl md:text-7xl font-bold mb-6">Enerji Koleksiyonları</h1>
        <p class="text-xl md:text-2xl text-white/90">
            Her koleksiyon, benzersiz enerjisiyle yaşamınıza pozitif değer katıyor
        </p>
    </div>
</section>

<!-- Collections Grid -->
@if($collections->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="container">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($collections as $collection)
            <a href="{{ route('collections.show', $collection->slug) }}" 
               class="product-card bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group block">
                
                <!-- Collection Color Header -->
                <div style="background: linear-gradient(135deg, {{ $collection->color_code }}, {{ $collection->color_code }}DD);" 
                     class="h-48 flex items-center justify-center relative overflow-hidden group-hover:scale-102 transition-transform duration-500">
                    <div class="absolute inset-0 bg-black/10"></div>
                    <div class="absolute inset-0 flex items-center justify-center z-10">
                        <div class="w-16 h-16 rounded-full bg-white/20 backdrop-blur-md border-2 border-white shadow-lg"></div>
                    </div>
                </div>
                
                <!-- Collection Info -->
                <div class="p-6">
                    <div class="flex items-center mb-3">
                        <span class="w-6 h-6 rounded-full mr-3 shadow-md" style="background-color: {{ $collection->color_code }};"></span>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $collection->name }}</h3>
                    </div>
                    
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $collection->description }}</p>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Ürünler</span>
                        <span class="text-primary font-semibold flex items-center">
                            Keşfet
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
    <div class="container text-center">
        <p class="text-xl text-gray-600">Henüz enerji koleksiyonu bulunmamaktadır.</p>
    </div>
</section>
@endif

@endsection

