<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800">Yeni Ürün Ekle</h2>
                        <a href="{{ route('admin.products.index') }}" class="text-blue-600 hover:text-blue-800">
                            ← Geri Dön
                        </a>
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Ürün Adı -->
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Ürün Adı *</label>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Koleksiyon -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Koleksiyon *</label>
                                <select name="collection_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="">Koleksiyon Seçin</option>
                                    @foreach(\App\Models\Collection::where('is_active', true)->orderBy('name')->get() as $collection)
                                        <option value="{{ $collection->id }}" {{ old('collection_id') == $collection->id ? 'selected' : '' }}>
                                            {{ $collection->name }} ({{ $collection->type }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Kategori -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
                                <select name="category_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="">Kategori Seçin</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- SKU -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">SKU *</label>
                                <input type="text" name="sku" value="{{ old('sku') }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Fiyat -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Fiyat (₺) *</label>
                                <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- İndirimli Fiyat -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">İndirimli Fiyat (₺)</label>
                                <input type="number" name="discount_price" value="{{ old('discount_price') }}" step="0.01" min="0"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Stok -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Stok Adedi *</label>
                                <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Kısa Açıklama -->
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kısa Açıklama</label>
                                <textarea name="short_description" rows="3"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('short_description') }}</textarea>
                            </div>

                            <!-- Detaylı Açıklama -->
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Detaylı Açıklama</label>
                                <textarea name="description" rows="6"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
                            </div>

                            <!-- Öne Çıkan -->
                            <div class="flex items-center">
                                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="is_featured" class="ml-2 block text-sm text-gray-900">
                                    Öne Çıkan Ürün
                                </label>
                            </div>

                            <!-- Aktif -->
                            <div class="flex items-center">
                                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                    Aktif
                                </label>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('admin.products.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                                İptal
                            </a>
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Ürünü Kaydet
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

