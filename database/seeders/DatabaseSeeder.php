<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed admin users first
        $this->call(AdminUserSeeder::class);
        
        // Seed translations
        $this->call(TranslationSeeder::class);
        
        // Seed energy collections
        $this->call(EnergyCollectionSeeder::class);
        
        // Seed categories
        $this->call(CategorySeeder::class);
        
        // Seed products
        $this->call(ProductSeeder::class);
    }
}
