<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Translation;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $translations = [
            // Menu translations
            ['key' => 'menu.title', 'tr' => 'Menü', 'en' => 'Menu', 'group' => 'menu'],
            ['key' => 'menu.collections', 'tr' => 'Enerji Koleksiyonları', 'en' => 'Energy Collections', 'group' => 'menu'],
            ['key' => 'menu.categories', 'tr' => 'Ürün Kategorileri', 'en' => 'Product Categories', 'group' => 'menu'],
            ['key' => 'menu.brand', 'tr' => 'Marka', 'en' => 'Brand', 'group' => 'menu'],
            
            // Category translations
            ['key' => 'menu.categories.candles', 'tr' => 'Enerji Mumları', 'en' => 'Energy Candles', 'group' => 'menu'],
            ['key' => 'menu.categories.room_scents', 'tr' => 'Oda Kokuları', 'en' => 'Room Scents', 'group' => 'menu'],
            ['key' => 'menu.categories.wax_tablets', 'tr' => 'Enerji Wax Tablet', 'en' => 'Energy Wax Tablets', 'group' => 'menu'],
            ['key' => 'menu.categories.vases', 'tr' => 'Vazolar', 'en' => 'Vases', 'group' => 'menu'],
            ['key' => 'menu.categories.gift_sets', 'tr' => 'Hediye Setleri', 'en' => 'Gift Sets', 'group' => 'menu'],
            ['key' => 'menu.categories.bridal_flowers', 'tr' => 'Gelin Çiçekleri', 'en' => 'Bridal Flowers', 'group' => 'menu'],
            ['key' => 'menu.categories.decorative_box', 'tr' => 'Dekoratif Kutu', 'en' => 'Decorative Box', 'group' => 'menu'],
            
            // Brand translations
            ['key' => 'menu.brand.story', 'tr' => 'Hikayemiz', 'en' => 'Our Story', 'group' => 'menu'],
            ['key' => 'menu.brand.manifesto', 'tr' => 'Manifesto', 'en' => 'Manifesto', 'group' => 'menu'],
            ['key' => 'menu.brand.blog', 'tr' => 'Blog', 'en' => 'Blog', 'group' => 'menu'],
            ['key' => 'menu.brand.contact', 'tr' => 'İletişim', 'en' => 'Contact', 'group' => 'menu'],
            ['key' => 'menu.brand.shipping', 'tr' => 'Teslimat ve İade Koşulları', 'en' => 'Shipping and Returns', 'group' => 'menu'],
            
            // General translations
            ['key' => 'general.home', 'tr' => 'Ana Sayfa', 'en' => 'Home', 'group' => 'general'],
            ['key' => 'general.cart', 'tr' => 'Sepet', 'en' => 'Cart', 'group' => 'general'],
            ['key' => 'general.products', 'tr' => 'Ürünler', 'en' => 'Products', 'group' => 'general'],
        ];
        
        foreach ($translations as $translation) {
            Translation::create($translation);
        }
    }
}
