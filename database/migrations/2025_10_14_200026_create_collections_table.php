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
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Mini Vase Collection, Candle Collection, vb.
            $table->string('slug')->unique(); // mini-vase-collection
            $table->text('description')->nullable(); // Koleksiyon açıklaması
            $table->string('image')->nullable(); // Koleksiyon görseli
            $table->string('type')->default('shop'); // shop veya energy
            $table->integer('order')->default(0); // Sıralama
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};
