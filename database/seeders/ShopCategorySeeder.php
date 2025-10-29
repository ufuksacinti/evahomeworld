<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ShopCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing categories
        Category::truncate();

        // 1. Ceramic Collection (Parent)
        $ceramicCollection = Category::create([
            'name' => 'Ceramic Collection',
            'slug' => 'ceramic-collection',
            'description' => 'El yapımı seramik ürünlerimizi keşfedin',
            'parent_id' => null,
            'is_active' => true,
            'order' => 1,
        ]);

        // Ceramic sub-categories
        Category::create([
            'name' => 'Mini Vases',
            'slug' => 'mini-vases',
            'description' => 'Küçük ve şık seramik vazolar',
            'parent_id' => $ceramicCollection->id,
            'is_active' => true,
            'order' => 1,
        ]);

        Category::create([
            'name' => 'Large Vases',
            'slug' => 'large-vases',
            'description' => 'Büyük dekoratif seramik vazolar',
            'parent_id' => $ceramicCollection->id,
            'is_active' => true,
            'order' => 2,
        ]);

        // 2. Glass Collection (Parent)
        $glassCollection = Category::create([
            'name' => 'Glass Collection',
            'slug' => 'glass-collection',
            'description' => 'Özel cam işçiliği ürünlerimiz',
            'parent_id' => null,
            'is_active' => true,
            'order' => 2,
        ]);

        // Glass sub-categories
        Category::create([
            'name' => 'Candles',
            'slug' => 'candles',
            'description' => 'Cam kavanozda premium mumlar',
            'parent_id' => $glassCollection->id,
            'is_active' => true,
            'order' => 1,
        ]);

        Category::create([
            'name' => 'Vases',
            'slug' => 'vases',
            'description' => 'Zarif cam vazolar',
            'parent_id' => $glassCollection->id,
            'is_active' => true,
            'order' => 2,
        ]);

        // 3. Gift Sets (Standalone)
        Category::create([
            'name' => 'Gift Sets',
            'slug' => 'gift-sets',
            'description' => 'Özel hediye setleri',
            'parent_id' => null,
            'is_active' => true,
            'order' => 3,
        ]);

        // 4. Wedding (Standalone)
        Category::create([
            'name' => 'Wedding',
            'slug' => 'wedding',
            'description' => 'Düğün ve nikah için özel ürünler',
            'parent_id' => null,
            'is_active' => true,
            'order' => 4,
        ]);

        // 5. Diffusers (Standalone)
        Category::create([
            'name' => 'Diffusers',
            'slug' => 'diffusers',
            'description' => 'Aromaterapi ve koku yayıcılar',
            'parent_id' => null,
            'is_active' => true,
            'order' => 5,
        ]);
    }
}
