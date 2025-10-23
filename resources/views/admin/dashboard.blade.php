@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')
@section('page-title', 'Dashboard')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Revenue -->
    <div class="bg-white rounded-xl p-6 shadow-sm border-2 border-eva-gold/20 hover:border-eva-gold/40 transition-all">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-sm font-medium text-eva-muted uppercase tracking-wide">Toplam Gelir</p>
                <x-price :amount="$stats['total_revenue']" size="2xl" class="text-eva-gold font-bold mt-2" />
            </div>
            <div class="w-12 h-12 rounded-full bg-eva-gold/20 flex items-center justify-center">
                <svg class="w-6 h-6 text-eva-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        <p class="text-xs text-green-600 flex items-center gap-1">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
            </svg>
            <span class="tabular-nums">+12.5%</span> bu ay
        </p>
    </div>

    <!-- Total Orders -->
    <div class="bg-white rounded-xl p-6 shadow-sm border-2 border-blue-100 hover:border-blue-200 transition-all">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-sm font-medium text-eva-muted uppercase tracking-wide">Toplam Sipariş</p>
                <p class="text-3xl font-bold text-eva-charcoal mt-2 tabular-nums">{{ number_format($stats['total_orders']) }}</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
        </div>
        <p class="text-xs text-blue-600 flex items-center gap-1">
            <span class="tabular-nums">{{ $stats['pending_orders'] }}</span> beklemede
        </p>
    </div>

    <!-- Total Products -->
    <div class="bg-white rounded-xl p-6 shadow-sm border-2 border-purple-100 hover:border-purple-200 transition-all">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-sm font-medium text-eva-muted uppercase tracking-wide">Toplam Ürün</p>
                <p class="text-3xl font-bold text-eva-charcoal mt-2 tabular-nums">{{ number_format($stats['total_products']) }}</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
        </div>
        <p class="text-xs text-purple-600">8 koleksiyon</p>
    </div>

    <!-- Total Customers -->
    <div class="bg-white rounded-xl p-6 shadow-sm border-2 border-green-100 hover:border-green-200 transition-all">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-sm font-medium text-eva-muted uppercase tracking-wide">Müşteriler</p>
                <p class="text-3xl font-bold text-eva-charcoal mt-2 tabular-nums">{{ number_format($stats['total_customers']) }}</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
        </div>
        <p class="text-xs text-green-600 flex items-center gap-1">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
            </svg>
            <span class="tabular-nums">+23</span> bu ay
        </p>
    </div>
</div>

<!-- Quick Actions & Recent Activity -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
    <!-- Quick Actions -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-eva-silver/30">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-1 bg-eva-gold"></div>
            <h2 class="font-heading font-semibold text-lg text-eva-heading">Hızlı İşlemler</h2>
        </div>
        
        <div class="space-y-3">
            <a href="{{ route('admin.products.create') }}" 
               class="flex items-center gap-3 px-4 py-3 bg-eva-soft-white hover:bg-eva-gold/10 rounded-lg transition-all group">
                <div class="w-8 h-8 rounded-full bg-eva-gold/20 flex items-center justify-center group-hover:bg-eva-gold/30">
                    <svg class="w-4 h-4 text-eva-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <span class="font-medium text-eva-charcoal">Yeni Ürün Ekle</span>
            </a>

            <a href="{{ route('admin.orders.index') }}?status=pending" 
               class="flex items-center gap-3 px-4 py-3 bg-eva-soft-white hover:bg-eva-gold/10 rounded-lg transition-all group">
                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center group-hover:bg-blue-200">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <span class="font-medium text-eva-charcoal">Bekleyen Siparişler</span>
                @if($stats['pending_orders'] > 0)
                    <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full tabular-nums">{{ $stats['pending_orders'] }}</span>
                @endif
            </a>

            <a href="{{ route('admin.collections.index') }}" 
               class="flex items-center gap-3 px-4 py-3 bg-eva-soft-white hover:bg-eva-gold/10 rounded-lg transition-all group">
                <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center group-hover:bg-purple-200">
                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <span class="font-medium text-eva-charcoal">Koleksiyonları Yönet</span>
            </a>

            <a href="{{ route('admin.bulk-orders.index') }}" 
               class="flex items-center gap-3 px-4 py-3 bg-eva-soft-white hover:bg-eva-gold/10 rounded-lg transition-all group">
                <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center group-hover:bg-orange-200">
                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <span class="font-medium text-eva-charcoal">Toplu Sipariş Talepleri</span>
            </a>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="lg:col-span-2 bg-white rounded-xl p-6 shadow-sm border border-eva-silver/30">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-1 bg-eva-gold"></div>
                <h2 class="font-heading font-semibold text-lg text-eva-heading">Son Siparişler</h2>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="text-sm text-eva-gold hover:text-eva-charcoal transition-colors">
                Tümünü Gör →
            </a>
        </div>

        <div class="space-y-3">
            @forelse($recentOrders as $order)
                <div class="flex items-center justify-between py-3 px-4 bg-eva-soft-white rounded-lg hover:bg-eva-gold/5 transition-all">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-eva-gold/20 flex items-center justify-center flex-shrink-0">
                            <span class="text-xs font-bold text-eva-gold">#</span>
                        </div>
                        <div>
                            <p class="font-medium text-eva-charcoal text-sm tabular-nums">{{ $order->order_number }}</p>
                            <p class="text-xs text-eva-muted">{{ $order->user->name }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <x-price :amount="$order->getGrandTotal()" size="sm" class="text-eva-charcoal font-bold" />
                        <span class="text-xs px-3 py-1 rounded-full
                            @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                            @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                            @elseif($order->status == 'shipped') bg-purple-100 text-purple-800
                            @elseif($order->status == 'delivered') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            @if($order->status == 'pending') Bekliyor
                            @elseif($order->status == 'processing') Hazırlanıyor
                            @elseif($order->status == 'shipped') Kargoda
                            @elseif($order->status == 'delivered') Teslim
                            @else {{ ucfirst($order->status) }}
                            @endif
                        </span>
                    </div>
                </div>
            @empty
                <p class="text-center text-eva-muted py-8">Henüz sipariş yok</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Products & Stock -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    <!-- Best Selling Products -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-eva-silver/30">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-1 bg-eva-gold"></div>
            <h2 class="font-heading font-semibold text-lg text-eva-heading">En Çok Satanlar</h2>
        </div>

        <div class="space-y-4">
            @forelse($bestSellingProducts as $product)
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                        @if($product->getPrimaryImage())
                            <img src="{{ asset('storage/' . $product->getPrimaryImage()->image_path) }}" 
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <x-wax-seal type="bronze" size="xs" class="opacity-20" />
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-eva-charcoal truncate">{{ $product->name }}</p>
                        <div class="flex items-center gap-2 mt-1">
                            @if($product->collection)
                                <span class="w-3 h-3 rounded-full" style="background-color: {{ $product->collection->color_hex }};"></span>
                                <p class="text-xs text-eva-muted">{{ $product->collection->name }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-eva-charcoal tabular-nums">{{ $product->sale_count }}</p>
                        <p class="text-xs text-eva-muted">satış</p>
                    </div>
                </div>
            @empty
                <p class="text-center text-eva-muted py-6">Henüz satış yok</p>
            @endforelse
        </div>
    </div>

    <!-- Low Stock Alert -->
    <div class="bg-white rounded-xl p-6 shadow-sm border-2 border-red-100">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-1 bg-red-500"></div>
            <h2 class="font-heading font-semibold text-lg text-eva-heading">Düşük Stok Uyarısı</h2>
        </div>

        <div class="space-y-3">
            @forelse($lowStockProducts as $product)
                <div class="flex items-center justify-between py-3 px-4 bg-red-50 rounded-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-red-500"></div>
                        <div>
                            <p class="font-medium text-eva-charcoal text-sm">{{ $product->name }}</p>
                            <p class="text-xs text-eva-muted">SKU: {{ $product->sku }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-bold text-red-600 tabular-nums">{{ $product->stock }}</p>
                        <p class="text-xs text-eva-muted">adet</p>
                    </div>
                </div>
            @empty
                <div class="text-center py-6">
                    <svg class="w-12 h-12 mx-auto text-green-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-eva-muted text-sm">Tüm ürünler stokta</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Most Viewed Products -->
<div class="bg-white rounded-xl p-6 shadow-sm border border-eva-silver/30">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-10 h-1 bg-eva-gold"></div>
        <h2 class="font-heading font-semibold text-lg text-eva-heading">En Çok Görüntülenenler</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
        @forelse($mostViewedProducts as $product)
            <div class="group">
                <div class="aspect-square rounded-lg overflow-hidden bg-gray-100 mb-3 relative">
                    @if($product->getPrimaryImage())
                        <img src="{{ asset('storage/' . $product->getPrimaryImage()->image_path) }}" 
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                        <div class="w-full h-full flex items-center justify-center"
                             style="background: linear-gradient(135deg, {{ $product->collection->color_hex ?? '#FAF8F6' }}20, {{ $product->collection->color_hex ?? '#FAF8F6' }}40);">
                            <x-wax-seal type="bronze" size="sm" class="opacity-20" />
                        </div>
                    @endif
                    
                    @if($product->collection)
                        <div class="absolute top-2 left-2">
                            <span class="w-4 h-4 rounded-full border border-white shadow-sm block" 
                                  style="background-color: {{ $product->collection->color_hex }};"></span>
                        </div>
                    @endif
                </div>
                <p class="font-medium text-sm text-eva-charcoal mb-1 truncate group-hover:text-eva-gold transition-colors">
                    {{ $product->name }}
                </p>
                <p class="text-xs text-eva-muted flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <span class="tabular-nums">{{ number_format($product->view_count) }}</span>
                </p>
            </div>
        @empty
            <div class="col-span-5 text-center py-8 text-eva-muted">
                Henüz görüntülenme verisi yok
            </div>
        @endforelse
    </div>
</div>
@endsection
