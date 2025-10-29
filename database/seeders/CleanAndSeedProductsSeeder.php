<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Collection;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductAttribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CleanAndSeedProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Önce tüm ürünleri, kategorileri ve ilişkili verileri temizle
        ProductAttribute::truncate();
        ProductImage::truncate();
        Product::truncate();
        Category::truncate();

        // Koleksiyonları al
        $collections = Collection::all()->keyBy('slug');

        // Her koleksiyon için örnek ürünler oluştur
        $this->createShopCollectionProducts($collections);
        $this->createEnergyCollectionProducts($collections);
    }

    private function createShopCollectionProducts($collections)
    {
        // Mini Vase Collection
        if ($collections->has('mini-vase-collection')) {
            $collection = $collections->get('mini-vase-collection');
            for ($i = 1; $i <= 8; $i++) {
                $this->createProduct([
                    'collection_id' => $collection->id,
                    'name' => "Mini Vase - Enerji Serisi {$i}",
                    'price' => rand(150, 350),
                    'stock' => rand(10, 50),
                ]);
            }
        }

        // Candle Collection
        if ($collections->has('candle-collection')) {
            $collection = $collections->get('candle-collection');
            $candleTypes = ['Tek Fitil', 'Çift Fitil'];
            foreach ($candleTypes as $type) {
                for ($i = 1; $i <= 4; $i++) {
                    $this->createProduct([
                        'collection_id' => $collection->id,
                        'name' => "{$type} Mum - Model {$i}",
                        'price' => $type === 'Tek Fitil' ? rand(200, 300) : rand(350, 500),
                        'stock' => rand(15, 40),
                    ]);
                }
            }
        }

        // Arome Diffuser Collection
        if ($collections->has('arome-diffuser-collection')) {
            $collection = $collections->get('arome-diffuser-collection');
            for ($i = 1; $i <= 6; $i++) {
                $this->createProduct([
                    'collection_id' => $collection->id,
                    'name' => "Oda Kokusu - Aroma {$i}",
                    'price' => rand(250, 450),
                    'stock' => rand(20, 60),
                ]);
            }
        }

        // Gift Sets
        if ($collections->has('gift-sets')) {
            $collection = $collections->get('gift-sets');
            for ($i = 1; $i <= 5; $i++) {
                $this->createProduct([
                    'collection_id' => $collection->id,
                    'name' => "Hediye Seti 2'li - Set {$i}",
                    'price' => rand(400, 700),
                    'stock' => rand(10, 30),
                    'is_featured' => true,
                ]);
            }
        }

        // Wedding Collection
        if ($collections->has('wedding-collection')) {
            $collection = $collections->get('wedding-collection');
            for ($i = 1; $i <= 6; $i++) {
                $this->createProduct([
                    'collection_id' => $collection->id,
                    'name' => "Düğün Koleksiyonu - Model {$i}",
                    'price' => rand(300, 600),
                    'stock' => rand(15, 35),
                ]);
            }
        }

        // Mini Wedding Vases
        if ($collections->has('mini-wedding-vases')) {
            $collection = $collections->get('mini-wedding-vases');
            for ($i = 1; $i <= 8; $i++) {
                $this->createProduct([
                    'collection_id' => $collection->id,
                    'name' => "Gelin Çiçeği Mini Vazo - {$i}",
                    'price' => rand(180, 320),
                    'stock' => rand(20, 50),
                ]);
            }
        }

        // Bridesmaid Gifts
        if ($collections->has('bridesmaid-gifts')) {
            $collection = $collections->get('bridesmaid-gifts');
            for ($i = 1; $i <= 6; $i++) {
                $this->createProduct([
                    'collection_id' => $collection->id,
                    'name' => "Nedime Hediyesi Mini Set - {$i}",
                    'price' => rand(250, 400),
                    'stock' => rand(15, 40),
                ]);
            }
        }

        // Large Vase Collection
        if ($collections->has('large-vase-collection')) {
            $collection = $collections->get('large-vase-collection');
            $sizes = ['Küçük Boy', 'Büyük Boy'];
            foreach ($sizes as $size) {
                for ($i = 1; $i <= 4; $i++) {
                    $this->createProduct([
                        'collection_id' => $collection->id,
                        'name' => "Silindir Vazo {$size} - Enerji {$i}",
                        'price' => $size === 'Küçük Boy' ? rand(400, 600) : rand(700, 1000),
                        'stock' => rand(10, 25),
                    ]);
                }
            }
        }
    }

    private function createEnergyCollectionProducts($collections)
    {
        $energyCollections = [
            'golden-jasmin',
            'velvet-rose',
            'citrus-harmony',
            'luminous-bloom',
            'secret-oud',
            'earth-harmony',
            'royal-spice',
            'lavender-peace',
        ];

        foreach ($energyCollections as $slug) {
            if ($collections->has($slug)) {
                $collection = $collections->get($slug);
                
                // Her enerji koleksiyonu için farklı ürün tipleri
                $productTypes = [
                    ['name' => 'Mini Vazo', 'price' => [200, 350]],
                    ['name' => 'Tek Fitil Mum', 'price' => [250, 400]],
                    ['name' => 'Çift Fitil Mum', 'price' => [400, 550]],
                    ['name' => 'Oda Kokusu', 'price' => [300, 450]],
                    ['name' => 'Büyük Vazo', 'price' => [600, 900]],
                ];

                foreach ($productTypes as $type) {
                    $this->createProduct([
                        'collection_id' => $collection->id,
                        'name' => "{$collection->name} - {$type['name']}",
                        'price' => rand($type['price'][0], $type['price'][1]),
                        'stock' => rand(15, 50),
                        'is_featured' => rand(0, 1) === 1,
                    ]);
                }
            }
        }
    }

    private function createProduct($data)
    {
        $product = Product::create([
            'collection_id' => $data['collection_id'],
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'sku' => 'SKU-' . Str::upper(Str::random(8)),
            'description' => 'Bu ürün el yapımı, özel tasarım bir üründür. Yüksek kaliteli malzemelerden üretilmiştir.',
            'short_description' => 'El yapımı, özel tasarım ürün',
            'price' => $data['price'],
            'discount_price' => rand(0, 1) === 1 ? $data['price'] * 0.85 : null,
            'stock' => $data['stock'],
            'is_featured' => $data['is_featured'] ?? false,
            'is_active' => true,
            'view_count' => rand(10, 200),
            'sale_count' => rand(0, 50),
        ]);

        // Placeholder görsel ekle (gerçek görsel yüklenmediği için)
        // Görsel olmadan bırakıyoruz, view'da placeholder gösterilecek

        // Örnek özellikler ekle
        $attributes = [
            ['name' => 'Malzeme', 'value' => 'Seramik'],
            ['name' => 'Üretim', 'value' => 'El Yapımı'],
            ['name' => 'Renk', 'value' => 'Pastel Tonlar'],
        ];

        foreach ($attributes as $attr) {
            ProductAttribute::create([
                'product_id' => $product->id,
                'attribute_name' => $attr['name'],
                'attribute_value' => $attr['value'],
            ]);
        }

        return $product;
    }
}
