@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-semibold mb-1">Toplam Ürün</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $stats['total_products'] }}</h3>
            </div>
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                <i class="fas fa-box text-blue-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-semibold mb-1">Toplam Sipariş</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $stats['total_orders'] }}</h3>
            </div>
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                <i class="fas fa-shopping-cart text-green-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-semibold mb-1">Toplam Kullanıcı</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $stats['total_users'] }}</h3>
            </div>
            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center">
                <i class="fas fa-users text-purple-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-pink-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-semibold mb-1">Koleksiyonlar</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $stats['total_collections'] }}</h3>
            </div>
            <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center">
                <i class="fas fa-heart text-pink-600 text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Orders -->
    <div class="bg-white rounded-xl shadow-lg">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">Son Siparişler</h2>
        </div>
        <div class="p-6">
            @if($recent_orders->count() > 0)
                <div class="space-y-4">
                    @foreach($recent_orders as $order)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-semibold text-gray-800">#{{ $order->order_number }}</p>
                            <p class="text-sm text-gray-600">{{ $order->user->name ?? 'Guest' }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-indigo-600">{{ number_format($order->total, 2) }} ₺</p>
                            <p class="text-xs text-gray-500">{{ $order->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-8">Henüz sipariş yok.</p>
            @endif
        </div>
    </div>

    <!-- Top Products -->
    <div class="bg-white rounded-xl shadow-lg">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">En Çok Görüntülenen Ürünler</h2>
        </div>
        <div class="p-6">
            @if($top_products->count() > 0)
                <div class="space-y-4">
                    @foreach($top_products as $product)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $product->name }}</p>
                            <p class="text-sm text-gray-600">{{ $product->energyCollection->name ?? 'N/A' }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-indigo-600">{{ number_format($product->view_count) }} <i class="fas fa-eye text-gray-400"></i></p>
                            <p class="text-xs text-gray-500">{{ number_format($product->price, 0) }} ₺</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-8">Henüz ürün görüntülemesi yok.</p>
            @endif
        </div>
    </div>
</div>
@endsection

