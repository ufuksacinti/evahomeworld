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
            $table->string('feeling')->nullable()->after('description'); // Verdiği His
            $table->string('color')->nullable()->after('feeling'); // Renk
            $table->string('scent')->nullable()->after('color'); // Koku
            $table->text('energy')->nullable()->after('scent'); // Enerji
            $table->text('emotion')->nullable()->after('energy'); // Ana Duygu
            $table->string('element')->nullable()->after('emotion'); // Temsili Element
            $table->text('story')->nullable()->after('element'); // Hikaye
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('collections', function (Blueprint $table) {
            $table->dropColumn(['feeling', 'color', 'scent', 'energy', 'emotion', 'element', 'story']);
        });
    }
};
