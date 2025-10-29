@extends('layouts.admin')

@section('title', 'Koleksiyon Yönetimi - Admin Panel')
@section('page-title', 'Koleksiyon Yönetimi')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div class="flex items-center gap-3">
        <div class="w-10 h-1 bg-eva-gold"></div>
        <h2 class="font-heading font-semibold text-2xl text-eva-heading">Koleksiyonlar</h2>
    </div>
    <a href="{{ route('admin.collections.create') }}" 
       class="flex items-center gap-2 btn-text bg-eva-gold hover:bg-eva-charcoal text-white px-6 py-3 rounded-lg transition-all shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Yeni Koleksiyon
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @forelse($collections as $collection)
        <div class="bg-white rounded-xl overflow-hidden shadow-sm border-2 hover:border-eva-gold/40 transition-all"
             style="border-color: {{ $collection->color_hex }}40;">
            <div class="relative h-48"
                 style="background: linear-gradient(135deg, {{ $collection->color_hex }}20 0%, {{ $collection->color_hex }}40 100%);">
                @if($collection->image)
                    <img src="{{ asset('storage/' . $collection->image) }}" 
                         alt="{{ $collection->name }}"
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <x-wax-seal type="gold" size="xl" class="opacity-20" />
                    </div>
                @endif
                
                <!-- Type Badge -->
                <div class="absolute top-4 left-4">
                    <span class="px-3 py-1 rounded-full text-xs font-bold
                        {{ $collection->type === 'energy' ? 'bg-purple-500 text-white' : 'bg-blue-500 text-white' }}">
                        {{ $collection->type === 'energy' ? 'Energy' : 'Shop' }}
                    </span>
                </div>
            </div>

            <div class="p-6">
                <!-- Collection Name & Color -->
                <div class="flex items-center justify-between mb-3">
                    <h3 class="font-heading font-semibold text-lg text-eva-heading">{{ $collection->name }}</h3>
                    @if($collection->color_hex)
                        <span class="w-6 h-6 rounded-full border-2 border-white shadow-sm" 
                              style="background-color: {{ $collection->color_hex }};"></span>
                    @endif
                </div>

                @if($collection->visual_feeling)
                    <p class="text-sm text-eva-text italic mb-3">{{ $collection->visual_feeling }}</p>
                @endif

                <div class="flex items-center justify-between mb-4 pb-4 border-b border-eva-silver/20">
                    <div>
                        <p class="text-xs text-eva-muted">Ürün Sayısı</p>
                        <p class="text-xl font-bold text-eva-charcoal tabular-nums">{{ $collection->products_count }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-eva-muted">Sıra</p>
                        <p class="text-xl font-bold text-eva-charcoal tabular-nums">{{ $collection->order }}</p>
                    </div>
                    <div>
                        @if($collection->is_active)
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Pasif</span>
                        @endif
                    </div>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('admin.collections.edit', $collection) }}" 
                       class="flex-1 text-center btn-text bg-eva-charcoal hover:bg-eva-gold text-white py-2 rounded-lg transition-all text-sm">
                        Düzenle
                    </a>
                    <form action="{{ route('admin.collections.destroy', $collection) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full btn-text bg-red-500 hover:bg-red-600 text-white py-2 rounded-lg transition-all text-sm"
                                onclick="return confirm('Bu koleksiyonu silmek istediğinizden emin misiniz?')">
                            Sil
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-2 text-center py-16">
            <x-wax-seal type="gold" size="2xl" class="mx-auto mb-6 opacity-20" />
            <p class="text-eva-muted text-lg">Henüz koleksiyon bulunmuyor</p>
        </div>
    @endforelse
</div>
@endsection

