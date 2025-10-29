<?php

namespace Database\Seeders;

use App\Models\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PremiumCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collections = [
            [
                'name' => 'Golden Jasmine',
                'slug' => 'golden-jasmine',
                'description' => 'Bereket Seninle Yuva Kursun',
                'type' => 'energy',
                'color_hex' => '#F6EBD9',
                'color_description' => 'Pastel ekru / şampanya',
                'visual_feeling' => 'Işıltılı, sıcak, aydınlık',
                'feeling' => 'Aydınlık ve iyimserlik',
                'scent' => 'Yasemin',
                'energy' => 'Pozitif enerji ve bereket',
                'emotion' => 'Neşe',
                'element' => 'Işık',
                'story' => 'Altın yasemin çiçeklerinin ilk ışıklarla buluştuğu sabahların enerjisini taşır.',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Velvet Rose',
                'slug' => 'velvet-rose',
                'description' => 'Mekanın Yeniden Sevgiyle Nefes Alsın',
                'type' => 'energy',
                'color_hex' => '#D9A7A0',
                'color_description' => 'Pastel bordo / pudra gül',
                'visual_feeling' => 'Romantik, yumuşak, zarif',
                'feeling' => 'Romantizm ve şefkat',
                'scent' => 'Gül',
                'energy' => 'Sevgi ve şefkat enerjisi',
                'emotion' => 'Aşk',
                'element' => 'Su',
                'story' => 'Kadifemsi güllerin sabah çiyiyle örtülü yumuşak dokunuşunu hissettirir.',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Citrus Harmony',
                'slug' => 'citrus-harmony',
                'description' => 'Sabah Işığı Evinde Yeniden Doğsun',
                'type' => 'energy',
                'color_hex' => '#F9CBA3',
                'color_description' => 'Pastel turuncu / şeftali',
                'visual_feeling' => 'Neşeli, enerjik, canlı',
                'feeling' => 'Enerji ve canlılık',
                'scent' => 'Narenciye',
                'energy' => 'Canlandırıcı ve uyarıcı enerji',
                'emotion' => 'Mutluluk',
                'element' => 'Ateş',
                'story' => 'Yaz sabahlarının ferahlığını ve turunçgil bahçelerinin enerjisini taşır.',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'Lavender Peace',
                'slug' => 'lavender-peace',
                'description' => 'Huzur Günlük Rituelin Olsun',
                'type' => 'energy',
                'color_hex' => '#D4C3E1',
                'color_description' => 'Pastel lila / lavanta',
                'visual_feeling' => 'Sakin, huzurlu, yumuşak',
                'feeling' => 'Huzur ve dinginlik',
                'scent' => 'Lavanta',
                'energy' => 'Sakinleştirici ve dengeleyici enerji',
                'emotion' => 'Huzur',
                'element' => 'Hava',
                'story' => 'Provence lavanta tarlalarının sonsuz huzurunu ve dinginliğini taşır.',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'name' => 'Luminous Bloom',
                'slug' => 'luminous-bloom',
                'description' => 'Berraklık Hayatına Aksın',
                'type' => 'energy',
                'color_hex' => '#F5CEDB',
                'color_description' => 'Pastel pembe',
                'visual_feeling' => 'Arınmış, taze, zarif',
                'feeling' => 'Saflık ve yenilenme',
                'scent' => 'Çiçek Buketi',
                'energy' => 'Temizleyici ve yenileyici enerji',
                'emotion' => 'Huzur',
                'element' => 'Hava',
                'story' => 'Bahar çiçeklerinin ilk açılışındaki saf ve temiz enerjiyi taşır.',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'name' => 'Sacred Oud',
                'slug' => 'sacred-oud',
                'description' => 'Tazelik Her Nefesine Dokunsun',
                'type' => 'energy',
                'color_hex' => '#C9D8C5',
                'color_description' => 'Pastel mint / yeşil',
                'visual_feeling' => 'Dingin, mistik, doğal',
                'feeling' => 'Mistik derinlik',
                'scent' => 'Oud',
                'energy' => 'Topraklayıcı ve merkeze getirici enerji',
                'emotion' => 'İçsel huzur',
                'element' => 'Toprak',
                'story' => 'Antik ormanların derinliklerinde saklı kutsal ağaçların enerjisini taşır.',
                'is_active' => true,
                'order' => 6,
            ],
            [
                'name' => 'Earth Harmony',
                'slug' => 'earth-harmony',
                'description' => 'Güç İçinde Sessizce Parlasın',
                'type' => 'energy',
                'color_hex' => '#D7C8B6',
                'color_description' => 'Pastel bej / açık kahve',
                'visual_feeling' => 'Topraklanmış, güvenli, sıcak',
                'feeling' => 'Güven ve istikrar',
                'scent' => 'Ahşap',
                'energy' => 'Dengeleştirici ve rahatlatıcı enerji',
                'emotion' => 'Güvenlik',
                'element' => 'Toprak',
                'story' => 'Doğanın sıcak kucağında hissettiğiniz o güvenli ve huzurlu anları yansıtır.',
                'is_active' => true,
                'order' => 7,
            ],
            [
                'name' => 'Royal Spice',
                'slug' => 'royal-spice',
                'description' => 'İlham Sessizlikte Çiçek Açsın',
                'type' => 'energy',
                'color_hex' => '#C4BDB5',
                'color_description' => 'Pastel gri / füme',
                'visual_feeling' => 'Sofistike, güçlü, nötr',
                'feeling' => 'Güç ve sofistikasyon',
                'scent' => 'Baharat',
                'energy' => 'Güçlendirici ve koruyucu enerji',
                'emotion' => 'Özgüven',
                'element' => 'Metal',
                'story' => 'Tarihi ipek yolunun gizemli baharat kokularını ve asil gücünü taşır.',
                'is_active' => true,
                'order' => 8,
            ],
        ];

        foreach ($collections as $collectionData) {
            Collection::updateOrCreate(
                ['slug' => $collectionData['slug']],
                $collectionData
            );
        }
    }
}
