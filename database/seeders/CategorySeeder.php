<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Enerji Mumları',
                'slug' => 'enerji-mumlari',
                'description' => 'Özel enerjilerle dolu, pozitif enerji yayan mum koleksiyonumuz. Her mum, yaşamınıza özel değer katacak güçlerle bezenmiştir.',
                'image' => null,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Oda Kokuları',
                'slug' => 'oda-kokulari',
                'description' => 'Ev ve ofislerinize huzur getiren, rahatlatıcı aromalar. Her koku ile yaşam alanlarınızı özel hissettirin.',
                'image' => null,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Enerji Wax Tablet',
                'slug' => 'enerji-wax-tablet',
                'description' => 'Pratik ve etkili enerji yayıcı wax tablet koleksiyonumuz. Her tablet özenle seçilmiş enerjilerle hazırlanmıştır.',
                'image' => null,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Vazolar',
                'slug' => 'vazolar',
                'description' => 'Şık ve dekoratif vazo koleksiyonumuz. Her vazo, bulunduğu alana değer katacak özel tasarımlara sahiptir.',
                'image' => null,
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Hediye Setleri',
                'slug' => 'hediye-setleri',
                'description' => 'Sevdikleriniz için özel hazırlanmış hediye setlerimiz. Her set, sizin için anlamlı bir paket içerir.',
                'image' => null,
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Gelin Çiçekleri',
                'slug' => 'gelin-cicekleri',
                'description' => 'Özel günleriniz için tasarlanmış, zarif ve romantik gelin çiçekleri koleksiyonumuz.',
                'image' => null,
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Dekoratif Kutu',
                'slug' => 'dekoratif-kutu',
                'description' => 'Şık ve modern dekoratif kutu koleksiyonumuz. Her kutu, saklama ve sergileme için ideal tasarımlara sahiptir.',
                'image' => null,
                'sort_order' => 7,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }

        $this->command->info('Categories seeded successfully!');
    }
}
