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
        Schema::table('products', function (Blueprint $table) {
            // Görüntülenme ve puanlama alanları
            if (!Schema::hasColumn('products', 'view_count')) {
                $table->unsignedBigInteger('view_count')->default(0)->after('is_active');
            }
            if (!Schema::hasColumn('products', 'rating')) {
                $table->decimal('rating', 3, 2)->default(0)->after('view_count'); // 0.00 - 9.99 aralığı yeterli
            }
            if (!Schema::hasColumn('products', 'rating_count')) {
                $table->unsignedBigInteger('rating_count')->default(0)->after('rating');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'rating_count')) {
                $table->dropColumn('rating_count');
            }
            if (Schema::hasColumn('products', 'rating')) {
                $table->dropColumn('rating');
            }
            if (Schema::hasColumn('products', 'view_count')) {
                $table->dropColumn('view_count');
            }
        });
    }
};
