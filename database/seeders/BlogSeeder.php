<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\User;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // Blog kategorileri
        $categories = [
            ['name' => 'Dekorasyon İpuçları', 'description' => 'Ev dekorasyonu hakkında faydalı bilgiler'],
            ['name' => 'Mobilya Bakımı', 'description' => 'Mobilyalarınızı nasıl korursunuz'],
            ['name' => 'Trendler', 'description' => 'En yeni mobilya ve dekorasyon trendleri'],
            ['name' => 'Yaşam Alanları', 'description' => 'Farklı yaşam alanlarını düzenleme'],
        ];

        $blogCategories = [];
        foreach ($categories as $cat) {
            $blogCategories[] = BlogCategory::create([
                'name' => $cat['name'],
                'slug' => \Illuminate\Support\Str::slug($cat['name']),
                'description' => $cat['description'],
            ]);
        }

        $admin = User::where('role', 'admin')->first();

        // Blog yazıları
        $posts = [
            [
                'title' => '2024 Ev Dekorasyon Trendleri',
                'content' => '<h2>Yılın En Popüler Trendleri</h2><p>2024 yılında ev dekorasyonunda doğal malzemeler, sürdürülebilirlik ve minimalist tasarımlar öne çıkıyor. Ahşap mobilyalar, organik formlar ve nötr renkler bu yılın vazgeçilmez unsurları arasında.</p><h3>Doğal Malzemeler</h3><p>Masif ahşap, bambu, hasır ve keten gibi doğal malzemeler evlerimizde daha fazla yer almaya başlıyor.</p>',
                'excerpt' => '2024 yılının en popüler ev dekorasyon trendlerini keşfedin.',
                'categories' => [0, 2],
            ],
            [
                'title' => 'Küçük Oturma Odalarını Büyük Gösterme İpuçları',
                'content' => '<h2>Alan Kullanımı</h2><p>Küçük oturma odalarında doğru mobilya seçimi ve yerleşimi çok önemlidir. Açık renkler, aynalar ve çok fonksiyonlu mobilyalar alanı büyük gösterir.</p><h3>Renk Seçimi</h3><p>Açık tonlar ve beyaz kullanımı alanı ferah gösterir.</p>',
                'excerpt' => 'Küçük oturma odalarınızı nasıl büyük göstereceğinizi öğrenin.',
                'categories' => [0, 3],
            ],
            [
                'title' => 'Mobilya Bakımında Dikkat Edilmesi Gerekenler',
                'content' => '<h2>Mobilya Temizliği</h2><p>Mobilyalarınızın uzun ömürlü olması için düzenli bakım şarttır. Her malzeme türüne uygun temizlik ürünleri kullanılmalıdır.</p><h3>Ahşap Bakımı</h3><p>Ahşap mobilyaları nemli bezle silin ve özel bakım yağları kullanın.</p>',
                'excerpt' => 'Mobilyalarınızı uzun yıllar kullanmak için bakım ipuçları.',
                'categories' => [1],
            ],
            [
                'title' => 'Yatak Odası Dekorasyonunda Dikkat Edilecekler',
                'content' => '<h2>Huzurlu Bir Uyku Alanı</h2><p>Yatak odası dekorasyonunda rahatık ve huzur ön planda olmalıdır. Sakin renkler, yumuşak aydınlatma ve kaliteli yatak takımları şarttır.</p>',
                'excerpt' => 'Huzurlu bir yatak odası için dekorasyon önerileri.',
                'categories' => [0, 3],
            ],
            [
                'title' => 'Minimalist Yaşam Alanı Oluşturma',
                'content' => '<h2>Az İçerikle Daha Fazla Yaşam</h2><p>Minimalist yaşam tarzı, sadece ihtiyaç duyduğunuz eşyalarla yaşamayı öğretir. Daha az eşya, daha fazla özgürlük demektir.</p>',
                'excerpt' => 'Minimalist bir yaşam alanı nasıl yaratılır?',
                'categories' => [0, 2],
            ],
        ];

        foreach ($posts as $postData) {
            $categoryIds = $postData['categories'];
            unset($postData['categories']);

            $post = BlogPost::create([
                'user_id' => $admin->id,
                'title' => $postData['title'],
                'slug' => \Illuminate\Support\Str::slug($postData['title']),
                'content' => $postData['content'],
                'excerpt' => $postData['excerpt'],
                'is_published' => true,
                'published_at' => now()->subDays(rand(1, 30)),
                'view_count' => rand(50, 500),
            ]);

            $categoriesToAttach = [];
            foreach ($categoryIds as $index) {
                if (isset($blogCategories[$index])) {
                    $categoriesToAttach[] = $blogCategories[$index]->id;
                }
            }
            $post->categories()->attach($categoriesToAttach);
        }
    }
}
