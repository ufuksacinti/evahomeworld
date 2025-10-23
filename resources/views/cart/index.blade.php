@extends('layouts.main')

@section('title', 'Sepetim - EvaHome')

@section('content')
<div class="bg-white min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Sepetim</h1>

        @if($cart->items->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                        @foreach($cart->items as $item)
                            <div class="p-6 border-b border-gray-200 last:border-b-0">
                                <div class="flex gap-4">
                                    <!-- Product Image -->
                                    <div class="w-24 h-24 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden">
                                        @if($item->product->images->count() > 0)
                                            <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}" 
                                                 alt="{{ $item->product->name }}"
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Product Info -->
                                    <div class="flex-1">
                                        <div class="flex justify-between">
                                            <div>
                                                <h3 class="font-semibold text-gray-900 mb-1">
                                                    <a href="{{ route('products.show', $item->product->slug) }}" class="hover:text-gray-700">
                                                        {{ $item->product->name }}
                                                    </a>
                                                </h3>
                                                @if($item->product->collection)
                                                    <p class="text-sm text-gray-500">{{ $item->product->collection->name }}</p>
                                                @endif
                                            </div>
                                            <form action="{{ route('cart.remove', $item->product) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>

                                        <div class="flex items-center justify-between mt-4">
                                            <!-- Quantity Update -->
                                            <form action="{{ route('cart.update', $item->product) }}" method="POST" class="flex items-center space-x-2">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button" onclick="updateQuantity(this, -1)" class="w-8 h-8 border border-gray-300 rounded hover:bg-gray-50">
                                                    <svg class="w-4 h-4 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                                    </svg>
                                                </button>
                                                <input type="number" 
                                                       name="quantity" 
                                                       value="{{ $item->quantity }}" 
                                                       min="1" 
                                                       max="{{ $item->product->stock }}"
                                                       class="w-16 text-center border border-gray-300 rounded py-1 text-sm"
                                                       onchange="this.form.submit()">
                                                <button type="button" onclick="updateQuantity(this, 1)" class="w-8 h-8 border border-gray-300 rounded hover:bg-gray-50">
                                                    <svg class="w-4 h-4 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                </button>
                                            </form>

                                            <!-- Price -->
                                            <div class="text-right">
                                                <p class="text-lg font-bold text-gray-900">{{ number_format($item->getTotal(), 2) }} ₺</p>
                                                <p class="text-sm text-gray-500">{{ number_format($item->price, 2) }} ₺ / adet</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Clear Cart -->
                    <div class="mt-4">
                        <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Sepeti temizlemek istediğinizden emin misiniz?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-700 text-sm font-medium">
                                Sepeti Temizle
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 sticky top-24">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Sipariş Özeti</h2>
                        
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Ara Toplam</span>
                                <span>{{ number_format($cart->getTotalAmount(), 2) }} ₺</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Kargo</span>
                                <span class="text-green-600 font-medium">Ücretsiz</span>
                            </div>
                            <div class="border-t border-gray-300 pt-3 flex justify-between text-lg font-bold text-gray-900">
                                <span>Toplam</span>
                                <span>{{ number_format($cart->getTotalAmount(), 2) }} ₺</span>
                            </div>
                        </div>

                        <div class="space-y-3">
                            @auth
                                <a href="{{ route('checkout') }}" class="block w-full bg-gray-900 text-white text-center px-6 py-3 rounded-lg hover:bg-gray-800 transition-colors font-medium">
                                    Siparişi Tamamla
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="block w-full bg-gray-900 text-white text-center px-6 py-3 rounded-lg hover:bg-gray-800 transition-colors font-medium">
                                    Giriş Yap ve Devam Et
                                </a>
                            @endauth
                            
                            <a href="{{ route('home') }}" class="block w-full border-2 border-gray-900 text-gray-900 text-center px-6 py-3 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                                Alışverişe Devam Et
                            </a>
                        </div>

                        <!-- Cart Info -->
                        <div class="mt-6 pt-6 border-t border-gray-300">
                            <div class="flex items-start space-x-2 text-sm text-gray-600">
                                <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p>Güvenli ödeme ve hızlı teslimat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Sepetiniz Boş</h2>
                <p class="text-gray-600 mb-8">Alışverişe başlamak için ürünlerimize göz atın</p>
                <a href="{{ route('home') }}" class="inline-block bg-gray-900 text-white px-8 py-3 rounded-lg hover:bg-gray-800 transition-colors font-medium">
                    Alışverişe Başla
                </a>
            </div>
        @endif
    </div>
</div>

<script>
    function updateQuantity(button, change) {
        const form = button.closest('form');
        const input = form.querySelector('input[name="quantity"]');
        const currentValue = parseInt(input.value);
        const newValue = currentValue + change;
        const min = parseInt(input.min);
        const max = parseInt(input.max);
        
        if (newValue >= min && newValue <= max) {
            input.value = newValue;
            form.submit();
        }
    }
</script>
@endsection






