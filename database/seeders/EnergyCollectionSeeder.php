<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EnergyCollection;
use Illuminate\Support\Str;

class EnergyCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collections = [
            [
                'name' => 'Golden Jasmin',
                'slug' => 'golden-jasmin',
                'color_code' => '#FBE2A9',
                'description' => 'Şans ve pozitif enerji. Golden Jasmin koleksiyonu, hayatınıza bereket ve şans getirecek pozitif enerjileri bünyesinde barındırır. Her ürünümüz özenle seçilmiş Golden Jasmin enerjisiyle harmanlanmıştır.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Velvet Rose',
                'slug' => 'velvet-rose',
                'color_code' => '#E79993',
                'description' => 'Aşk ve sevgi. Velvet Rose koleksiyonu, romantizm ve sevgi enerjilerini yaşamınıza taşır. İlişkilerinizi güçlendiren, kalpleri birbirine yaklaştıran özel ürünler.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Citrus Harmony',
                'slug' => 'citrus-harmony',
                'color_code' => '#FFD18A',
                'description' => 'Neşe ve canlılık. Citrus Harmony koleksiyonu, enerji dolu, neşeli ve canlı bir yaşam tarzı sunar. Her gününüzü pozitif enerjiyle dolduracak taze ve dinamik ürünler.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Lavender Peace',
                'slug' => 'lavender-peace',
                'color_code' => '#C7A7EA',
                'description' => 'Rahatlama ve stres azaltma. Lavender Peace koleksiyonu, huzurlu ve sakin bir yaşam için tasarlanmıştır. Stres ve endişelerinizden kurtulup iç huzurunuza kavuşun.',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Luminous Bloom',
                'slug' => 'luminous-bloom',
                'color_code' => '#F7AEC9',
                'description' => 'Yenilenme ve tazelik. Luminous Bloom koleksiyonu, yaşam enerjinizi yenileyen ve tazelik veren ürünlerle doludur. Her başlangıç için perfect.',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Sacred Oud',
                'slug' => 'sacred-oud',
                'color_code' => '#CFE8CB',
                'description' => 'Huzur ve bereket. Sacred Oud koleksiyonu, manevi huzur ve bereketi yaşamınıza taşır. Enerjinizi dengeleyen, içsel huzura ulaşmanızı sağlayan özel ürünler.',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Earth Harmony',
                'slug' => 'earth-harmony',
                'color_code' => '#D9B78F',
                'description' => 'Bolluk ve topraklama. Earth Harmony koleksiyonu, toprak enerjisiyle birleşerek yaşamınıza bolluk ve istikrar getirir. Temel ihtiyaçlarınızı karşılayan güçlü enerjiler.',
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Royal Spice',
                'slug' => 'royal-spice',
                'color_code' => '#C79B7E',
                'description' => 'Arınma ve negatif enerji temizliği. Royal Spice koleksiyonu, negatif enerjilerden arınmanızı sağlar. Yaşam alanınızı temizleyip pozitif enerjiyle doldurur.',
                'sort_order' => 8,
                'is_active' => true,
            ],
        ];
        
        foreach ($collections as $collection) {
            EnergyCollection::updateOrCreate(
                ['slug' => $collection['slug']],
                $collection
            );
        }
    }
}
