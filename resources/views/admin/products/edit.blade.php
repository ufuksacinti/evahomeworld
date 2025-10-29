<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800">Ürün Düzenle: {{ $product->name }}</h2>
                        <a href="{{ route('admin.products.index') }}" class="text-blue-600 hover:text-blue-800">
                            ← Geri Dön
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Product Images Section -->
                    <div class="mb-8 p-6 bg-gray-50 rounded-lg">
                        <h3 class="text-lg font-semibold mb-4">Ürün Görselleri</h3>
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                            @foreach($product->images as $image)
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" 
                                         alt="Product Image" 
                                         class="w-full h-40 object-cover rounded-lg">
                                    @if($image->is_primary)
                                        <span class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">
                                            Ana Görsel
                                        </span>
                                    @endif
                                    <form action="{{ route('admin.products.images.delete', [$product, $image]) }}" 
                                          method="POST" 
                                          class="absolute top-2 right-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-500 text-white p-2 rounded hover:bg-red-600"
                                                onclick="return confirm('Bu görseli silmek istediğinizden emin misiniz?')">
                                            ✕
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>

                        <form action="{{ route('admin.products.images', $product) }}" 
                              method="POST" 
                              enctype="multipart/form-data"
                              class="flex items-center space-x-4">
                            @csrf
                            <input type="file" 
                                   name="images[]" 
                                   multiple 
                                   accept="image/*"
                                   class="flex-1 px-4 py-2 border border-gray-300 rounded-lg">
                            <button type="submit" 
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Görsel Yükle
                            </button>
                        </form>
                    </div>

                    <!-- Product Details Form -->
                    <form action="{{ route('admin.products.update', $product) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Ürün Adı -->
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Ürün Adı *</label>
                                <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Koleksiyon -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Koleksiyon *</label>
                                <select name="collection_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="">Koleksiyon Seçin</option>
                                    @foreach(\App\Models\Collection::where('is_active', true)->orderBy('name')->get() as $collection)
                                        <option value="{{ $collection->id }}" 
                                            {{ old('collection_id', $product->collection_id) == $collection->id ? 'selected' : '' }}>
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
                                        <option value="{{ $category->id }}" 
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- SKU -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">SKU *</label>
                                <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Fiyat -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Fiyat (₺) *</label>
                                <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01" min="0" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- İndirimli Fiyat -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">İndirimli Fiyat (₺)</label>
                                <input type="number" name="discount_price" value="{{ old('discount_price', $product->discount_price) }}" 
                                    step="0.01" min="0"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Stok -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Stok Adedi *</label>
                                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" min="0" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Kısa Açıklama -->
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kısa Açıklama</label>
                                <textarea name="short_description" rows="3"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('short_description', $product->short_description) }}</textarea>
                            </div>

                            <!-- Detaylı Açıklama -->
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Detaylı Açıklama</label>
                                <textarea name="description" rows="6"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('description', $product->description) }}</textarea>
                            </div>

                            <!-- Statistics -->
                            <div class="col-span-2 grid grid-cols-3 gap-4 p-4 bg-blue-50 rounded-lg">
                                <div>
                                    <p class="text-sm text-gray-600">Görüntülenme</p>
                                    <p class="text-2xl font-bold text-blue-600 tabular-nums">{{ number_format($product->view_count) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Satış Adedi</p>
                                    <p class="text-2xl font-bold text-green-600 tabular-nums">{{ number_format($product->sale_count) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Mevcut Stok</p>
                                    <p class="text-2xl font-bold tabular-nums {{ $product->stock <= 10 ? 'text-red-600' : 'text-gray-800' }}">
                                        {{ number_format($product->stock) }}
                                    </p>
                                </div>
                            </div>

                            <!-- Öne Çıkan -->
                            <div class="flex items-center">
                                <input type="checkbox" name="is_featured" id="is_featured" value="1" 
                                    {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="is_featured" class="ml-2 block text-sm text-gray-900">
                                    Öne Çıkan Ürün
                                </label>
                            </div>

                            <!-- Aktif -->
                            <div class="flex items-center">
                                <input type="checkbox" name="is_active" id="is_active" value="1" 
                                    {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                    Aktif
                                </label>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-between">
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700"
                                        onclick="return confirm('Bu ürünü silmek istediğinizden emin misiniz?')">
                                    Ürünü Sil
                                </button>
                            </form>

                            <div class="flex space-x-3">
                                <a href="{{ route('admin.products.index') }}" 
                                   class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                                    İptal
                                </a>
                                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    Değişiklikleri Kaydet
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

