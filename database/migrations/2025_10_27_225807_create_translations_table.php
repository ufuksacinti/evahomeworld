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
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // Çeviri anahtarı (örn: "home.title")
            $table->text('tr')->nullable(); // Türkçe çeviri
            $table->text('en')->nullable(); // İngilizce çeviri
            $table->string('group')->default('general'); // Grup (general, menu, product, vb.)
            $table->timestamps();
            
            $table->index('key');
            $table->index('group');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translations');
    }
};
