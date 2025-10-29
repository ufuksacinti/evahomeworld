<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\EnergyCollection;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ürün çeşitleri
        $productTypes = [
            'Cam Mumluk',
            'Seramik Mumluk',
            'Mini Vazo',
            'Vazo',
            'Büyük Vazo',
            'Cam Oda Kokusu',
            'Gelin Çiçeği',
            'Dekoratif Kutu',
            'Enerji Wax Tablet',
        ];
        
        // Kategorileri al
        $categories = Category::where('is_active', true)->get();
        
        // Her enerji koleksiyonu için ürünler oluştur
        $energyCollections = EnergyCollection::where('is_active', true)->get();
        
        foreach ($energyCollections as $collection) {
            foreach ($productTypes as $index => $type) {
                // Kategori eşleştirme (basit bir eşleştirme yapıyoruz)
                $category = $categories->random();
                
                // Fiyat belirleme (2000-12000 arası)
                $basePrice = rand(2000, 12000);
                $discountPrice = null;
                
                // %20 ihtimalle indirimli ürün
                if (rand(1, 10) <= 2) {
                    $discountPrice = $basePrice * 0.8; // %20 indirim
                }
                
                Product::updateOrCreate(
                    [
                        'name' => $collection->name . ' ' . $type,
                        'slug' => Str::slug($collection->name . ' ' . $type),
                    ],
                    [
                        'name' => $collection->name . ' ' . $type,
                        'slug' => Str::slug($collection->name . ' ' . $type),
                        'sku' => 'PROD-' . strtoupper(Str::random(8)),
                        'description' => $collection->name . ' enerjisi ile özel olarak tasarlanmış ' . strtolower($type) . '. ' . $collection->description,
                        'short_description' => $collection->name . ' enerjisi ile özel tasarım ' . strtolower($type) . '.',
                        'energy_collection_id' => $collection->id,
                        'category_id' => $category->id,
                        'price' => $basePrice,
                        'discount_price' => $discountPrice,
                        'currency' => 'TRY',
                        'stock_quantity' => rand(10, 100),
                        'in_stock' => true,
                        'manage_stock' => true,
                        'image' => null, // Placeholder görsel - daha sonra yüklenecek
                        'is_featured' => rand(1, 10) <= 3, // %30 ihtimalle featured
                        'is_active' => true,
                        'view_count' => rand(0, 500),
                        'rating' => rand(40, 50) / 10, // 4.0 - 5.0 arası
                        'rating_count' => rand(5, 150),
                    ]
                );
            }
        }
        
        $this->command->info('Products seeded successfully!');
    }
}
