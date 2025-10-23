<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Oturma Odası',
                'description' => 'Oturma odası mobilyaları ve aksesuarları',
                'order' => 1,
                'children' => ['Koltuk Takımları', 'TV Üniteleri', 'Sehpalar', 'Kitaplıklar']
            ],
            [
                'name' => 'Yatak Odası',
                'description' => 'Yatak odası mobilyaları',
                'order' => 2,
                'children' => ['Yataklar', 'Gardroplar', 'Şifoniyerler', 'Başucu Lambaları']
            ],
            [
                'name' => 'Yemek Odası',
                'description' => 'Yemek odası mobilyaları',
                'order' => 3,
                'children' => ['Yemek Masaları', 'Sandalyeler', 'Büfeler']
            ],
            [
                'name' => 'Mutfak',
                'description' => 'Mutfak mobilyaları ve aksesuarları',
                'order' => 4,
                'children' => ['Mutfak Masaları', 'Bar Tabureleri', 'Mutfak Dolapları']
            ],
            [
                'name' => 'Aydınlatma',
                'description' => 'Ev aydınlatma ürünleri',
                'order' => 5,
                'children' => ['Avizeler', 'Lambaderler', 'Masa Lambaları', 'Duvar Aplikleri']
            ],
            [
                'name' => 'Dekorasyon',
                'description' => 'Ev dekorasyon ürünleri',
                'order' => 6,
                'children' => ['Tablolar', 'Vazolar', 'Mumlar', 'Duvar Süsleri']
            ],
        ];

        foreach ($categories as $categoryData) {
            $children = $categoryData['children'] ?? [];
            unset($categoryData['children']);

            $category = Category::create([
                'name' => $categoryData['name'],
                'slug' => \Illuminate\Support\Str::slug($categoryData['name']),
                'description' => $categoryData['description'] ?? null,
                'order' => $categoryData['order'],
                'is_active' => true,
            ]);

            foreach ($children as $index => $childName) {
                Category::create([
                    'name' => $childName,
                    'slug' => \Illuminate\Support\Str::slug($childName),
                    'parent_id' => $category->id,
                    'order' => $index + 1,
                    'is_active' => true,
                ]);
            }
        }
    }
}
