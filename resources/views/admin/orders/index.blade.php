@extends('layouts.admin')

@section('title', 'Sipariş Yönetimi - Admin Panel')
@section('page-title', 'Sipariş Yönetimi')

@section('content')
<div class="flex items-center gap-3 mb-6">
    <div class="w-10 h-1 bg-eva-gold"></div>
    <h2 class="font-heading font-semibold text-2xl text-eva-heading">Tüm Siparişler</h2>
</div>

<!-- Filters -->
<div class="mb-6 bg-white rounded-xl p-6 shadow-sm border border-eva-silver/30">
    <form method="GET" class="flex flex-wrap gap-4">
        <select name="status" class="px-4 py-2 border-2 border-eva-silver/50 rounded-lg focus:ring-2 focus:ring-eva-gold">
            <option value="">Tüm Durumlar</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Beklemede</option>
            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Hazırlanıyor</option>
            <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Kargoda</option>
            <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Teslim Edildi</option>
            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>İptal</option>
        </select>
        <select name="payment_status" class="px-4 py-2 border-2 border-eva-silver/50 rounded-lg focus:ring-2 focus:ring-eva-gold">
            <option value="">Tüm Ödeme Durumları</option>
            <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Ödeme Bekliyor</option>
            <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Ödendi</option>
            <option value="failed" {{ request('payment_status') == 'failed' ? 'selected' : '' }}>Başarısız</option>
            <option value="refunded" {{ request('payment_status') == 'refunded' ? 'selected' : '' }}>İade Edildi</option>
        </select>
        <button type="submit" class="btn-text bg-eva-gold hover:bg-eva-charcoal text-white px-6 py-2 rounded-lg transition-all">
            Filtrele
        </button>
        <a href="{{ route('admin.orders.index') }}" class="btn-text border-2 border-eva-silver hover:bg-eva-soft-white px-6 py-2 rounded-lg transition-all">
            Temizle
        </a>
    </form>
</div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

<div class="bg-white rounded-xl shadow-sm border border-eva-silver/30 overflow-hidden">
    <table class="min-w-full divide-y divide-eva-silver/20">
        <thead class="bg-eva-soft-white">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-bold text-eva-charcoal uppercase">Sipariş No</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-eva-charcoal uppercase">Müşteri</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-eva-charcoal uppercase">Tutar</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-eva-charcoal uppercase">Durum</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-eva-charcoal uppercase">Ödeme</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-eva-charcoal uppercase">Tarih</th>
                <th class="px-6 py-4 text-right text-xs font-bold text-eva-charcoal uppercase">İşlemler</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-eva-silver/20">
            @forelse ($orders as $order)
                <tr class="hover:bg-eva-soft-white transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 tabular-nums">{{ $order->order_number }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $order->user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $order->user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <x-price :amount="$order->getGrandTotal()" size="sm" class="text-gray-900" />
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($order->status == 'delivered') bg-green-100 text-green-800
                                                @elseif($order->status == 'shipped') bg-blue-100 text-blue-800
                                                @elseif($order->status == 'processing') bg-yellow-100 text-yellow-800
                                                @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                @if($order->status == 'pending') Beklemede
                                                @elseif($order->status == 'processing') Hazırlanıyor
                                                @elseif($order->status == 'shipped') Kargoda
                                                @elseif($order->status == 'delivered') Teslim Edildi
                                                @elseif($order->status == 'cancelled') İptal
                                                @endif
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($order->payment_status == 'paid') bg-green-100 text-green-800
                                                @elseif($order->payment_status == 'failed') bg-red-100 text-red-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                @if($order->payment_status == 'pending') Bekliyor
                                                @elseif($order->payment_status == 'paid') Ödendi
                                                @elseif($order->payment_status == 'failed') Başarısız
                                                @elseif($order->payment_status == 'refunded') İade
                                                @endif
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $order->created_at->format('d.m.Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 hover:text-blue-900 mr-3">Detay</a>
                                            <a href="{{ route('admin.orders.edit', $order) }}" class="text-gray-600 hover:text-gray-900">Düzenle</a>
                                        </td>
                                    </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <x-wax-seal type="gold" size="lg" class="mx-auto mb-4 opacity-20" />
                        <p class="text-eva-muted">Henüz sipariş bulunmamaktadır.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="p-4 border-t border-eva-silver/30 bg-eva-soft-white">
        {{ $orders->links() }}
    </div>
</div>
@endsection

