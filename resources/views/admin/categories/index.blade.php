@extends('layouts.admin')

@section('title', 'Kategori Yönetimi - Admin Panel')
@section('page-title', 'Kategori Yönetimi')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div class="flex items-center gap-3">
        <div class="w-10 h-1 bg-eva-gold"></div>
        <h2 class="font-heading font-semibold text-2xl text-eva-heading">Kategoriler</h2>
    </div>
    <a href="{{ route('admin.categories.create') }}" 
       class="flex items-center gap-2 btn-text bg-eva-gold hover:bg-eva-charcoal text-white px-6 py-3 rounded-lg transition-all shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Yeni Kategori
    </a>
</div>

@if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-lg mb-6">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-eva-silver/30 overflow-hidden">
    <table class="min-w-full divide-y divide-eva-silver/30">
        <thead class="bg-eva-soft-white">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-bold text-eva-charcoal uppercase tracking-wider">Kategori Adı</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-eva-charcoal uppercase tracking-wider">Üst Kategori</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-eva-charcoal uppercase tracking-wider">Ürün Sayısı</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-eva-charcoal uppercase tracking-wider">Durum</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-eva-charcoal uppercase tracking-wider">Sıra</th>
                <th class="px-6 py-4 text-right text-xs font-bold text-eva-charcoal uppercase tracking-wider">İşlemler</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-eva-silver/20">
            @forelse(\App\Models\Category::with('parent', 'products')->orderBy('order')->get() as $category)
                <tr class="hover:bg-eva-soft-white transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            @if($category->parent_id)
                                <span class="text-eva-muted">└─</span>
                            @endif
                            <span class="font-medium text-eva-charcoal">{{ $category->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if($category->parent)
                            <span class="text-sm text-eva-muted">{{ $category->parent->name }}</span>
                        @else
                            <span class="text-xs text-eva-light italic">Ana Kategori</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm text-eva-charcoal tabular-nums">{{ $category->products->count() }}</span>
                    </td>
                    <td class="px-6 py-4">
                        @if($category->is_active)
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Pasif</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm text-eva-muted tabular-nums">{{ $category->order }}</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.categories.edit', $category) }}" 
                               class="text-eva-gold hover:text-eva-charcoal transition-colors">
                                Düzenle
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" id="delete-form-{{ $category->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="text-red-600 hover:text-red-800 transition-colors"
                                        onclick="confirmDelete({{ $category->id }}, '{{ $category->name }}')">
                                    Sil
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <x-wax-seal type="bronze" size="lg" class="mx-auto mb-4 opacity-20" />
                        <p class="text-eva-muted">Henüz kategori bulunmuyor</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
function confirmDelete(categoryId, categoryName) {
    if (confirm(`"${categoryName}" kategorisini silmek istediğinizden emin misiniz?\n\nBu işlem geri alınamaz!`)) {
        document.getElementById(`delete-form-${categoryId}`).submit();
    }
}
</script>
@endsection

