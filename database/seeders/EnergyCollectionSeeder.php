<?php

namespace Database\Seeders;

use App\Models\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EnergyCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Önce mevcut energy koleksiyonlarını sil
        Collection::where('type', 'energy')->delete();

        $energyCollections = [
            [
                'name' => 'Golden Jasmin',
                'description' => 'Işık, yenilenme ve yaşam enerjisi',
                'feeling' => 'Şans ve Yenilenme',
                'color' => '#FAF0E6', // Pastel Ekru
                'scent' => 'Jasmin',
                'energy' => 'Işık, yenilenme, yaşam enerjisi, iyi başlangıçlar',
                'emotion' => 'Tazelik, umut, canlılık',
                'element' => 'Güneş',
                'story' => 'Golden Jasmin, yeni başlangıçların ve yenilenmenin enerjisini taşır. Güneşin ışığı gibi, hayatınıza umut ve canlılık getirir. Her sabah yeni bir başlangıçtır ve Golden Jasmin bu enerjiyi evinize taşır.',
                'order' => 1,
            ],
            [
                'name' => 'Velvet Rose',
                'description' => 'Sevgi ve romantizm enerjisi',
                'feeling' => 'Sevgi ve Romantizm',
                'color' => '#8B4F5C', // Pastel Bordo
                'scent' => 'Velvet Rose',
                'energy' => 'Kalp açıklığı, sevgi frekansı',
                'emotion' => 'Şefkat, yumuşaklık, kalpten bağ',
                'element' => 'Kalp',
                'story' => 'Velvet Rose, kalbin dilini konuşur. Sevgi ve şefkatin yumuşak dokunuşuyla, ilişkilerinize derinlik katar. Kalp açıklığı ve romantizmin enerjisiyle evinizi sıcak bir yuva haline getirir.',
                'order' => 2,
            ],
            [
                'name' => 'Citrus Harmony',
                'description' => 'Neşe ve pozitiflik enerjisi',
                'feeling' => 'Neşe ve Pozitiflik',
                'color' => '#FFD8A8', // Pastel Turuncu
                'scent' => 'Citrus & Amber',
                'energy' => 'Canlılık, coşku, güne enerjik başlama',
                'emotion' => 'Mutluluk, yaratıcılık, motivasyon',
                'element' => 'Ateş',
                'story' => 'Citrus Harmony, güne enerjik başlamanın ve yaratıcılığın kaynağıdır. Ateş elementi gibi, içinizdeki tutkuyu ateşler ve motivasyonunuzu yükseltir. Her gün yeni bir fırsat, her an yeni bir başlangıçtır.',
                'order' => 3,
            ],
            [
                'name' => 'Luminous Bloom',
                'description' => 'Ruhsal tazelenme enerjisi',
                'feeling' => 'Ruhsal Tazelenme',
                'color' => '#FFB6C1', // Pastel Pembe
                'scent' => 'Peony',
                'energy' => 'Hafiflik, yenilik, zarafet',
                'emotion' => 'Güzellik, tazelik, zarif değişim',
                'element' => 'Hava',
                'story' => 'Luminous Bloom, ruhunuzun hafiflemesini ve yenilenmesini sağlar. Hava elementi gibi özgür ve zarif, değişime açık bir enerji taşır. Güzellik ve tazelik arayışınızda size eşlik eder.',
                'order' => 4,
            ],
            [
                'name' => 'Secret Oud',
                'description' => 'Huzur ve bereket enerjisi',
                'feeling' => 'Huzur ve Bereket',
                'color' => '#B4D7B4', // Pastel Yeşil
                'scent' => 'Oud & Jasmin',
                'energy' => 'Bolluk akışı, içsel huzur, denge',
                'emotion' => 'Teslimiyet, spiritüel denge, sakinlik',
                'element' => 'Ağaç',
                'story' => 'Secret Oud, bolluk ve huzurun sırrını taşır. Ağaç elementi gibi köklü ve dengeli, içsel huzurunuzu bulmanıza yardımcı olur. Spiritüel dengeniz için mükemmel bir arkadaştır.',
                'order' => 5,
            ],
            [
                'name' => 'Earth Harmony',
                'description' => 'Köklenme ve güven enerjisi',
                'feeling' => 'Köklenme ve Güven',
                'color' => '#E8D5C4', // Pastel Bej
                'scent' => 'Sandalwood',
                'energy' => 'Topraklanma, bolluk, güven, istikrar',
                'emotion' => 'Güçlü temeller, huzur, güven hissi',
                'element' => 'Toprak',
                'story' => 'Earth Harmony, topraklanmanın ve güvenin enerjisini taşır. Toprak elementi gibi sağlam ve istikrarlı, güçlü temeller oluşturmanıza yardımcı olur. Hayatınıza bolluk ve güven getirir.',
                'order' => 6,
            ],
            [
                'name' => 'Royal Spice',
                'description' => 'Arınma ve dönüşüm enerjisi',
                'feeling' => 'Arınma ve Dönüşüm',
                'color' => '#C8C8C8', // Pastel Gri
                'scent' => 'Spice & Musk',
                'energy' => 'Negatif enerjiyi temizleme, yeniden doğuş',
                'emotion' => 'Güçlenme, cesaret, dönüşüm',
                'element' => 'Metal / Ateş',
                'story' => 'Royal Spice, arınma ve dönüşümün gücünü taşır. Metal ve ateş elementlerinin birleşimi, negatif enerjileri temizler ve yeniden doğuşunuza zemin hazırlar. Cesaretle dönüşün, güçlenerek yeniden doğun.',
                'order' => 7,
            ],
            [
                'name' => 'Lavender Peace',
                'description' => 'Huzur ve rahatlama enerjisi',
                'feeling' => 'Huzur ve Rahatlama',
                'color' => '#E6E6FA', // Pastel Lila
                'scent' => 'Lavender & Cotton',
                'energy' => 'Zihinsel dinginlik, uyku enerjisi',
                'emotion' => 'Sessizlik, huzur, yumuşak sakinlik',
                'element' => 'Su',
                'story' => 'Lavender Peace, zihinsel dinginlik ve huzurun kaynağıdır. Su elementi gibi akıcı ve sakin, rahatlamanıza ve derin bir uykuya dalmanıza yardımcı olur. Sessizliğin ve huzurun tadını çıkarın.',
                'order' => 8,
            ],
        ];

        foreach ($energyCollections as $collectionData) {
            Collection::create([
                'name' => $collectionData['name'],
                'slug' => Str::slug($collectionData['name']),
                'description' => $collectionData['description'],
                'type' => 'energy',
                'feeling' => $collectionData['feeling'],
                'color' => $collectionData['color'],
                'scent' => $collectionData['scent'],
                'energy' => $collectionData['energy'],
                'emotion' => $collectionData['emotion'],
                'element' => $collectionData['element'],
                'story' => $collectionData['story'],
                'order' => $collectionData['order'],
                'is_active' => true,
            ]);
        }
    }
}
