<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Oturma Odası Ürünleri
            [
                'category' => 'Koltuk Takımları',
                'name' => 'Modern L Koltuk Takımı',
                'sku' => 'KLT-001',
                'price' => 12999.00,
                'discount_price' => 9999.00,
                'stock' => 15,
                'short_description' => 'Şık ve rahat modern L koltuk takımı',
                'description' => 'Yüksek kaliteli kumaş kaplama, ergonomik tasarım, dayanıklı metal ayaklar. Oturma odanıza modern bir dokunuş katar.',
                'is_featured' => true,
                'attributes' => [
                    ['Renk', 'Gri'],
                    ['Malzeme', 'Kumaş'],
                    ['Boyut', '280x200 cm'],
                ]
            ],
            [
                'category' => 'Koltuk Takımları',
                'name' => 'Chesterfield Deri Koltuk',
                'sku' => 'KLT-002',
                'price' => 18999.00,
                'stock' => 8,
                'short_description' => 'Klasik İngiliz tarzı deri koltuk',
                'description' => 'Hakiki deri kaplama, düğmeli kapitone sırt, masif ahşap ayaklar.',
                'is_featured' => true,
                'attributes' => [
                    ['Renk', 'Kahverengi'],
                    ['Malzeme', 'Deri'],
                    ['Boyut', '220x90 cm'],
                ]
            ],
            [
                'category' => 'TV Üniteleri',
                'name' => 'Beyaz TV Ünitesi',
                'sku' => 'TV-001',
                'price' => 3499.00,
                'discount_price' => 2799.00,
                'stock' => 25,
                'short_description' => 'Modern minimalist TV ünitesi',
                'description' => 'Parlak beyaz lake, 2 kapaklı dolap, açık raf.',
                'is_featured' => false,
                'attributes' => [
                    ['Renk', 'Beyaz'],
                    ['Malzeme', 'MDF'],
                    ['Boyut', '180x40x45 cm'],
                ]
            ],
            
            // Yatak Odası Ürünleri
            [
                'category' => 'Yataklar',
                'name' => 'Yavrulu Yatak Başlığı',
                'sku' => 'YTK-001',
                'price' => 5999.00,
                'stock' => 20,
                'short_description' => 'Kapitone yatak başlığı',
                'description' => 'Yumuşak kapitone başlık, sağlam ahşap konstrüksiyon.',
                'is_featured' => true,
                'attributes' => [
                    ['Renk', 'Bej'],
                    ['Malzeme', 'Kumaş'],
                    ['Boyut', '160x120 cm'],
                ]
            ],
            [
                'category' => 'Gardroplar',
                'name' => '4 Kapaklı Gardrop',
                'sku' => 'GRP-001',
                'price' => 8999.00,
                'discount_price' => 7499.00,
                'stock' => 12,
                'short_description' => 'Geniş hacimli gardrop',
                'description' => '4 kapaklı, aynalı, çekmeceli, askılık ve raflı.',
                'is_featured' => false,
                'attributes' => [
                    ['Renk', 'Ceviz'],
                    ['Malzeme', 'MDF'],
                    ['Boyut', '200x60x220 cm'],
                ]
            ],

            // Yemek Odası Ürünleri
            [
                'category' => 'Yemek Masaları',
                'name' => 'Açılabilir Yemek Masası',
                'sku' => 'YMK-001',
                'price' => 4999.00,
                'stock' => 18,
                'short_description' => '6-8 kişilik açılır masa',
                'description' => 'Açılabilir mekanizma, masif ahşap, 6-8 kişilik.',
                'is_featured' => true,
                'attributes' => [
                    ['Renk', 'Ceviz'],
                    ['Malzeme', 'Masif Ahşap'],
                    ['Boyut', '160/200x90 cm'],
                ]
            ],
            [
                'category' => 'Sandalyeler',
                'name' => 'Döşemeli Yemek Sandalyesi',
                'sku' => 'SND-001',
                'price' => 899.00,
                'discount_price' => 699.00,
                'stock' => 50,
                'short_description' => 'Rahat döşemeli sandalye',
                'description' => 'Yumuşak döşeme, ahşap ayaklar, modern tasarım.',
                'is_featured' => false,
                'attributes' => [
                    ['Renk', 'Gri'],
                    ['Malzeme', 'Kumaş/Ahşap'],
                    ['Boyut', '45x50x95 cm'],
                ]
            ],

            // Aydınlatma Ürünleri
            [
                'category' => 'Avizeler',
                'name' => 'Modern Kristal Avize',
                'sku' => 'AVZ-001',
                'price' => 2499.00,
                'stock' => 15,
                'short_description' => 'Şık kristal avize',
                'description' => 'Kristal taşlı, LED uyumlu, 6 kollu.',
                'is_featured' => true,
                'attributes' => [
                    ['Renk', 'Krom'],
                    ['Malzeme', 'Metal/Kristal'],
                    ['Çap', '60 cm'],
                ]
            ],
            [
                'category' => 'Lambaderler',
                'name' => 'Tripod Lambader',
                'sku' => 'LMB-001',
                'price' => 899.00,
                'discount_price' => 699.00,
                'stock' => 30,
                'short_description' => 'Modern üç ayaklı lambader',
                'description' => 'Ahşap ayaklar, kumaş abajur, ayarlanabilir yükseklik.',
                'is_featured' => false,
                'attributes' => [
                    ['Renk', 'Doğal Ahşap'],
                    ['Malzeme', 'Ahşap/Kumaş'],
                    ['Yükseklik', '150 cm'],
                ]
            ],

            // Dekorasyon Ürünleri
            [
                'category' => 'Tablolar',
                'name' => 'Soyut Sanat Kanvas Tablo',
                'sku' => 'TBL-001',
                'price' => 599.00,
                'stock' => 40,
                'short_description' => 'Modern duvar tablosu',
                'description' => 'Yüksek çözünürlüklü baskı, ahşap çerçeve.',
                'is_featured' => false,
                'attributes' => [
                    ['Boyut', '60x80 cm'],
                    ['Malzeme', 'Kanvas'],
                    ['Tip', 'Soyut'],
                ]
            ],
        ];

        foreach ($products as $productData) {
            $categoryName = $productData['category'];
            $category = Category::where('name', $categoryName)->first();
            
            if (!$category) {
                continue;
            }

            $attributes = $productData['attributes'] ?? [];
            unset($productData['category'], $productData['attributes']);

            $product = Product::create([
                'category_id' => $category->id,
                'name' => $productData['name'],
                'slug' => \Illuminate\Support\Str::slug($productData['name']),
                'sku' => $productData['sku'],
                'price' => $productData['price'],
                'discount_price' => $productData['discount_price'] ?? null,
                'stock' => $productData['stock'],
                'short_description' => $productData['short_description'],
                'description' => $productData['description'],
                'is_featured' => $productData['is_featured'],
                'is_active' => true,
                'view_count' => rand(10, 500),
                'sale_count' => rand(0, 50),
            ]);

            // Add attributes
            foreach ($attributes as $attr) {
                $product->attributes()->create([
                    'attribute_name' => $attr[0],
                    'attribute_value' => $attr[1],
                ]);
            }
        }
    }
}
