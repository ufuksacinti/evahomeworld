@extends('layouts.admin')

@section('title', 'Toplu Sipariş Talepleri - Admin Panel')
@section('page-title', 'Toplu Sipariş Talepleri')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-eva-silver/30 overflow-hidden">
    <div class="p-6 border-b border-eva-silver/30 bg-eva-soft-white">
        <div class="flex items-center gap-3">
            <div class="w-10 h-1 bg-eva-gold"></div>
            <h2 class="font-heading font-semibold text-xl text-eva-heading">Toplu Sipariş Talepleri</h2>
        </div>
    </div>

    <table class="min-w-full divide-y divide-eva-silver/20">
        <thead class="bg-eva-soft-white">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-bold text-eva-charcoal uppercase">Firma</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-eva-charcoal uppercase">İletişim</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-eva-charcoal uppercase">Mesaj</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-eva-charcoal uppercase">Durum</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-eva-charcoal uppercase">Tarih</th>
                <th class="px-6 py-4 text-right text-xs font-bold text-eva-charcoal uppercase">İşlemler</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-eva-silver/20">
            @forelse($bulkOrders as $bulkOrder)
                <tr class="hover:bg-eva-soft-white transition-colors">
                    <td class="px-6 py-4">
                        <p class="font-medium text-eva-charcoal">{{ $bulkOrder->company_name }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm text-eva-text">{{ $bulkOrder->email }}</p>
                        <p class="text-xs text-eva-muted tabular-nums">{{ $bulkOrder->phone }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm text-eva-text line-clamp-2">{{ $bulkOrder->message }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('admin.bulk-orders.status', $bulkOrder) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()"
                                    class="text-xs px-3 py-1 rounded-full border-0
                                    @if($bulkOrder->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($bulkOrder->status == 'contacted') bg-blue-100 text-blue-800
                                    @elseif($bulkOrder->status == 'completed') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                <option value="pending" {{ $bulkOrder->status == 'pending' ? 'selected' : '' }}>Bekliyor</option>
                                <option value="contacted" {{ $bulkOrder->status == 'contacted' ? 'selected' : '' }}>İletişimde</option>
                                <option value="completed" {{ $bulkOrder->status == 'completed' ? 'selected' : '' }}>Tamamlandı</option>
                                <option value="cancelled" {{ $bulkOrder->status == 'cancelled' ? 'selected' : '' }}>İptal</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-sm text-eva-muted tabular-nums">
                        {{ $bulkOrder->created_at->format('d.m.Y H:i') }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="mailto:{{ $bulkOrder->email }}" 
                           class="text-eva-gold hover:text-eva-charcoal transition-colors font-medium text-sm">
                            E-posta Gönder
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <p class="text-eva-muted">Henüz toplu sipariş talebi yok</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="p-4 border-t border-eva-silver/30 bg-eva-soft-white">
        {{ $bulkOrders->links() }}
    </div>
</div>
@endsection

