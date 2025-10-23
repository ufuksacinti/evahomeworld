@extends('layouts.admin')

@section('title', 'Müşteri Yönetimi - Admin Panel')
@section('page-title', 'Müşteriler')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-eva-silver/30 overflow-hidden">
    <div class="p-6 border-b border-eva-silver/30 bg-eva-soft-white">
        <div class="flex items-center gap-3">
            <div class="w-10 h-1 bg-eva-gold"></div>
            <h2 class="font-heading font-semibold text-xl text-eva-heading">Tüm Müşteriler</h2>
        </div>
    </div>

    <table class="min-w-full divide-y divide-eva-silver/20">
        <thead class="bg-eva-soft-white">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-bold text-eva-charcoal uppercase">Müşteri</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-eva-charcoal uppercase">E-posta</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-eva-charcoal uppercase">Sipariş</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-eva-charcoal uppercase">Kayıt Tarihi</th>
                <th class="px-6 py-4 text-right text-xs font-bold text-eva-charcoal uppercase">İşlemler</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-eva-silver/20">
            @forelse($customers as $customer)
                <tr class="hover:bg-eva-soft-white transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-eva-gold/20 flex items-center justify-center">
                                <span class="font-bold text-eva-gold">{{ substr($customer->name, 0, 1) }}</span>
                            </div>
                            <span class="font-medium text-eva-charcoal">{{ $customer->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-eva-text">{{ $customer->email }}</td>
                    <td class="px-6 py-4">
                        <span class="text-sm font-bold text-eva-charcoal tabular-nums">{{ $customer->orders_count }}</span>
                        <span class="text-xs text-eva-muted">sipariş</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-eva-muted tabular-nums">
                        {{ $customer->created_at->format('d.m.Y') }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.customers.show', $customer) }}" 
                           class="text-eva-gold hover:text-eva-charcoal transition-colors font-medium">
                            Detay
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <p class="text-eva-muted">Henüz müşteri bulunmuyor</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="p-4 border-t border-eva-silver/30 bg-eva-soft-white">
        {{ $customers->links() }}
    </div>
</div>
@endsection

