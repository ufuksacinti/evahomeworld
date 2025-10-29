<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            
            // İlişkiler
            $table->foreignId('energy_collection_id')->nullable()->constrained('energy_collections')->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            
            // Fiyat bilgileri
            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->string('currency', 3)->default('TRY');
            
            // Stok yönetimi
            $table->integer('stock_quantity')->default(0);
            $table->integer('reserved_stock')->default(0); // Rezerve edilmiş stok (sepetteki)
            $table->integer('low_stock_threshold')->default(5); // Düşük stok eşiği
            $table->boolean('in_stock')->default(true);
            $table->boolean('manage_stock')->default(false);
            $table->boolean('allow_backorder')->default(false); // Stok bittiğinde sipariş al
            
            // Ürün bilgileri
            $table->string('image')->nullable();
            $table->json('gallery')->nullable(); // Ürün galerisi
            $table->integer('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            
            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
