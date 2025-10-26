@extends('layouts.admin')

@section('title', 'Kategori Düzenle - Admin Panel')
@section('page-title', 'Kategori Düzenle')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div class="flex items-center gap-3">
        <div class="w-10 h-1 bg-eva-gold"></div>
        <h2 class="font-heading font-semibold text-2xl text-eva-heading">Kategori Düzenle</h2>
    </div>
    <a href="{{ route('admin.categories.index') }}" 
       class="flex items-center gap-2 btn-text bg-eva-silver hover:bg-eva-charcoal text-white px-6 py-3 rounded-lg transition-all shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Geri Dön
    </a>
</div>

@if ($errors->any())
    <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-lg mb-6">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
            <div>
                <h3 class="font-medium">Lütfen aşağıdaki hataları düzeltin:</h3>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-eva-silver/30 overflow-hidden">
    <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data" class="p-8">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Sol Kolon -->
            <div class="space-y-6">
                <!-- Kategori Adı -->
                <div>
                    <label for="name" class="block text-sm font-medium text-eva-charcoal mb-2">
                        Kategori Adı <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $category->name) }}" 
                           required
                           class="w-full px-4 py-3 border border-eva-silver/50 rounded-lg focus:ring-2 focus:ring-eva-gold focus:border-eva-gold transition-all"
                           placeholder="Kategori adını girin">
                </div>

                <!-- Üst Kategori -->
                <div>
                    <label for="parent_id" class="block text-sm font-medium text-eva-charcoal mb-2">
                        Üst Kategori
                    </label>
                    <select id="parent_id" 
                            name="parent_id" 
                            class="w-full px-4 py-3 border border-eva-silver/50 rounded-lg focus:ring-2 focus:ring-eva-gold focus:border-eva-gold transition-all">
                        <option value="">Ana Kategori</option>
                        @foreach($parentCategories as $parentCategory)
                            <option value="{{ $parentCategory->id }}" {{ old('parent_id', $category->parent_id) == $parentCategory->id ? 'selected' : '' }}>
                                {{ $parentCategory->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Sıra -->
                <div>
                    <label for="order" class="block text-sm font-medium text-eva-charcoal mb-2">
                        Sıra
                    </label>
                    <input type="number" 
                           id="order" 
                           name="order" 
                           value="{{ old('order', $category->order) }}" 
                           min="0"
                           class="w-full px-4 py-3 border border-eva-silver/50 rounded-lg focus:ring-2 focus:ring-eva-gold focus:border-eva-gold transition-all"
                           placeholder="0">
                </div>

                <!-- Durum -->
                <div>
                    <label class="flex items-center gap-3">
                        <input type="checkbox" 
                               name="is_active" 
                               value="1" 
                               {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                               class="w-5 h-5 text-eva-gold focus:ring-eva-gold border-eva-silver/50 rounded">
                        <span class="text-sm font-medium text-eva-charcoal">Aktif</span>
                    </label>
                </div>
            </div>

            <!-- Sağ Kolon -->
            <div class="space-y-6">
                <!-- Kategori Açıklaması -->
                <div>
                    <label for="description" class="block text-sm font-medium text-eva-charcoal mb-2">
                        Açıklama
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="6"
                              class="w-full px-4 py-3 border border-eva-silver/50 rounded-lg focus:ring-2 focus:ring-eva-gold focus:border-eva-gold transition-all resize-none"
                              placeholder="Kategori açıklamasını girin">{{ old('description', $category->description) }}</textarea>
                </div>

                <!-- Mevcut Resim -->
                @if($category->image)
                    <div>
                        <label class="block text-sm font-medium text-eva-charcoal mb-2">
                            Mevcut Resim
                        </label>
                        <div class="relative">
                            <img src="{{ asset('storage/' . $category->image) }}" 
                                 alt="{{ $category->name }}" 
                                 class="w-full h-48 object-cover rounded-lg border border-eva-silver/30">
                            <div class="absolute top-2 right-2">
                                <span class="bg-white text-xs px-2 py-1 rounded-full text-eva-muted shadow-sm">
                                    Mevcut
                                </span>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Yeni Resim -->
                <div>
                    <label for="image" class="block text-sm font-medium text-eva-charcoal mb-2">
                        {{ $category->image ? 'Yeni Resim (Değiştirmek için)' : 'Kategori Resmi' }}
                    </label>
                    <div class="border-2 border-dashed border-eva-silver/50 rounded-lg p-6 text-center hover:border-eva-gold transition-colors">
                        <input type="file" 
                               id="image" 
                               name="image" 
                               accept="image/*"
                               class="hidden"
                               onchange="previewImage(this)">
                        <label for="image" class="cursor-pointer">
                            <svg class="w-12 h-12 text-eva-muted mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-sm text-eva-muted">{{ $category->image ? 'Yeni resim yüklemek için tıklayın' : 'Resim yüklemek için tıklayın' }}</p>
                            <p class="text-xs text-eva-light mt-1">PNG, JPG, GIF (Max: 2MB)</p>
                        </label>
                    </div>
                    <div id="image-preview" class="mt-4 hidden">
                        <img id="preview-img" src="" alt="Önizleme" class="w-full h-48 object-cover rounded-lg">
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Butonları -->
        <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-eva-silver/30">
            <a href="{{ route('admin.categories.index') }}" 
               class="px-6 py-3 border border-eva-silver/50 text-eva-charcoal rounded-lg hover:bg-eva-soft-white transition-all">
                İptal
            </a>
            <button type="submit" 
                    class="px-8 py-3 bg-eva-gold text-white rounded-lg hover:bg-eva-charcoal transition-all shadow-sm font-medium">
                Değişiklikleri Kaydet
            </button>
        </div>
    </form>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
