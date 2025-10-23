<?php

namespace Database\Seeders;

use App\Models\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shopCollections = [
            [
                'name' => 'Mini Vase Collection',
                'description' => '8 enerji serisinden çiçekli mini vazolar',
                'type' => 'shop',
                'order' => 1,
            ],
            [
                'name' => 'Candle Collection',
                'description' => 'Tek ve çift fitil mumlar',
                'type' => 'shop',
                'order' => 2,
            ],
            [
                'name' => 'Arome Diffuser Collection',
                'description' => 'Oda kokuları',
                'type' => 'shop',
                'order' => 3,
            ],
            [
                'name' => 'Gift Sets',
                'description' => '2\'li kutular',
                'type' => 'shop',
                'order' => 4,
            ],
            [
                'name' => 'Wedding Collection',
                'description' => 'Düğün koleksiyonları',
                'type' => 'shop',
                'order' => 5,
            ],
            [
                'name' => 'Mini Wedding Vases',
                'description' => 'Gelin çiçekleri hediyelik dekoratif versiyonlar',
                'type' => 'shop',
                'order' => 6,
            ],
            [
                'name' => 'Bridesmaid Gifts',
                'description' => 'Mum ve koku mini setleri',
                'type' => 'shop',
                'order' => 7,
            ],
            [
                'name' => 'Large Vase Collection',
                'description' => 'Silindir form iki farklı boy 8 enerji temasında',
                'type' => 'shop',
                'order' => 8,
            ],
        ];

        $energyCollections = [
            [
                'name' => 'Güneş Enerjisi Ürünleri',
                'description' => 'Sürdürülebilir güneş enerjisi ile çalışan ürünler',
                'type' => 'energy',
                'order' => 1,
            ],
            [
                'name' => 'Enerji Tasarruflu Aydınlatma',
                'description' => 'LED ve enerji tasarruflu aydınlatma çözümleri',
                'type' => 'energy',
                'order' => 2,
            ],
            [
                'name' => 'Akıllı Ev Sistemleri',
                'description' => 'Enerji verimliliği sağlayan akıllı ev teknolojileri',
                'type' => 'energy',
                'order' => 3,
            ],
            [
                'name' => 'Sürdürülebilir Mobilyalar',
                'description' => 'Çevre dostu malzemelerden üretilmiş mobilyalar',
                'type' => 'energy',
                'order' => 4,
            ],
        ];

        // Create Shop Collections
        foreach ($shopCollections as $collectionData) {
            Collection::create([
                'name' => $collectionData['name'],
                'slug' => Str::slug($collectionData['name']),
                'description' => $collectionData['description'],
                'type' => $collectionData['type'],
                'order' => $collectionData['order'],
                'is_active' => true,
            ]);
        }

        // Create Energy Collections
        foreach ($energyCollections as $collectionData) {
            Collection::create([
                'name' => $collectionData['name'],
                'slug' => Str::slug($collectionData['name']),
                'description' => $collectionData['description'],
                'type' => $collectionData['type'],
                'order' => $collectionData['order'],
                'is_active' => true,
            ]);
        }
    }
}
