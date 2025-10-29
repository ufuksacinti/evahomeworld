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
        Schema::table('collections', function (Blueprint $table) {
            // Renk HEX kodu (örn: #F6EBD9)
            $table->string('color_hex', 7)->nullable()->after('description');
            
            // Görsel hissi (örn: Işıltılı, sıcak, aydınlık)
            $table->string('visual_feeling')->nullable()->after('color_hex');
            
            // Renk tanımı (örn: Pastel ekru / şampanya)
            $table->string('color_description')->nullable()->after('visual_feeling');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('collections', function (Blueprint $table) {
            $table->dropColumn(['color_hex', 'visual_feeling', 'color_description']);
        });
    }
};
