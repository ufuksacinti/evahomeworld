@extends('layouts.admin')

@section('title', 'Ürün Yönetimi - Admin Panel')
@section('page-title', 'Ürün Yönetimi')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div class="flex items-center gap-3">
        <div class="w-10 h-1 bg-eva-gold"></div>
        <h2 class="font-heading font-semibold text-2xl text-eva-heading">Tüm Ürünler</h2>
    </div>
    <a href="{{ route('admin.products.create') }}" 
       class="flex items-center gap-2 btn-text bg-eva-gold hover:bg-eva-charcoal text-white px-6 py-3 rounded-lg transition-all shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Yeni Ürün
    </a>
</div>

@if (session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-lg mb-6">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-eva-silver/30 overflow-hidden">
    <table class="min-w-full divide-y divide-eva-silver/20">
        <thead class="bg-eva-soft-white">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-bold text-eva-charcoal uppercase">Görsel</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-eva-charcoal uppercase">Ürün</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-eva-charcoal uppercase">Koleksiyon</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-eva-charcoal uppercase">Fiyat</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-eva-charcoal uppercase">Stok</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-eva-charcoal uppercase">Durum</th>
                <th class="px-6 py-4 text-right text-xs font-bold text-eva-charcoal uppercase">İşlemler</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-eva-silver/20">
            @forelse ($products as $product)
                <tr class="hover:bg-eva-soft-white transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($product->images->first())
                                                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                                                     alt="{{ $product->name }}" 
                                                     class="w-16 h-16 object-cover rounded">
                                            @else
                                                <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                                    <span class="text-gray-400">No img</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                            @if($product->is_featured)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    ⭐ Öne Çıkan
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm text-gray-900">{{ $product->collection->name ?? '-' }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $product->sku }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <x-price :amount="$product->getFinalPrice()" size="sm" class="text-gray-900" />
                                            @if($product->hasDiscount())
                                                <x-price :amount="$product->price" size="xs" class="block text-gray-500 line-through" />
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm tabular-nums {{ $product->stock <= 10 ? 'text-red-600 font-semibold' : 'text-gray-900' }}">
                                                {{ $product->stock }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($product->is_active)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Aktif
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    Pasif
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:text-blue-900 mr-3">Düzenle</a>
                                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Silmek istediğinizden emin misiniz?')">Sil</button>
                                            </form>
                                        </td>
                                    </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <x-wax-seal type="bronze" size="lg" class="mx-auto mb-4 opacity-20" />
                        <p class="text-eva-muted">Henüz ürün bulunmamaktadır.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="p-4 border-t border-eva-silver/30 bg-eva-soft-white">
        {{ $products->links() }}
    </div>
</div>
@endsection

