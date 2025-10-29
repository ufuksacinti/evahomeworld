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
        // Products table indexes
        Schema::table('products', function (Blueprint $table) {
            $table->index('slug');
            $table->index('collection_id');
            $table->index('category_id');
            $table->index('is_active');
            $table->index('is_featured');
            $table->index('view_count');
            $table->index('sale_count');
            $table->index(['is_active', 'is_featured']);
            $table->index(['is_active', 'collection_id']);
        });

        // Collections table indexes
        Schema::table('collections', function (Blueprint $table) {
            $table->index('slug');
            $table->index('type');
            $table->index('is_active');
            $table->index('order');
            $table->index(['type', 'is_active', 'order']);
        });

        // Orders table indexes
        Schema::table('orders', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('order_number');
            $table->index('status');
            $table->index('payment_status');
            $table->index(['user_id', 'status']);
            $table->index(['user_id', 'created_at']);
        });

        // Order items table indexes
        Schema::table('order_items', function (Blueprint $table) {
            $table->index('order_id');
            $table->index('product_id');
        });

        // Cart items table indexes
        Schema::table('cart_items', function (Blueprint $table) {
            $table->index('cart_id');
            $table->index('product_id');
            $table->index(['cart_id', 'product_id']);
        });

        // Carts table indexes
        Schema::table('carts', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('session_id');
        });

        // Favorites table indexes
        Schema::table('favorites', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('product_id');
            $table->index(['user_id', 'product_id']);
        });

        // Product images table indexes
        Schema::table('product_images', function (Blueprint $table) {
            $table->index('product_id');
            $table->index('is_primary');
            $table->index('order');
        });

        // Categories table indexes
        Schema::table('categories', function (Blueprint $table) {
            $table->index('slug');
            $table->index('parent_id');
            $table->index('is_active');
        });

        // Blog posts table indexes
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->index('slug');
            $table->index('is_published');
            $table->index('published_at');
        });

        // Users table indexes
        Schema::table('users', function (Blueprint $table) {
            $table->index('role');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Products table
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['slug']);
            $table->dropIndex(['collection_id']);
            $table->dropIndex(['category_id']);
            $table->dropIndex(['is_active']);
            $table->dropIndex(['is_featured']);
            $table->dropIndex(['view_count']);
            $table->dropIndex(['sale_count']);
            $table->dropIndex(['is_active', 'is_featured']);
            $table->dropIndex(['is_active', 'collection_id']);
        });

        // Collections table
        Schema::table('collections', function (Blueprint $table) {
            $table->dropIndex(['slug']);
            $table->dropIndex(['type']);
            $table->dropIndex(['is_active']);
            $table->dropIndex(['order']);
            $table->dropIndex(['type', 'is_active', 'order']);
        });

        // Orders table
        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['order_number']);
            $table->dropIndex(['status']);
            $table->dropIndex(['payment_status']);
            $table->dropIndex(['user_id', 'status']);
            $table->dropIndex(['user_id', 'created_at']);
        });

        // Order items table
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropIndex(['order_id']);
            $table->dropIndex(['product_id']);
        });

        // Cart items table
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropIndex(['cart_id']);
            $table->dropIndex(['product_id']);
            $table->dropIndex(['cart_id', 'product_id']);
        });

        // Carts table
        Schema::table('carts', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['session_id']);
        });

        // Favorites table
        Schema::table('favorites', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['product_id']);
            $table->dropIndex(['user_id', 'product_id']);
        });

        // Product images table
        Schema::table('product_images', function (Blueprint $table) {
            $table->dropIndex(['product_id']);
            $table->dropIndex(['is_primary']);
            $table->dropIndex(['order']);
        });

        // Categories table
        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex(['slug']);
            $table->dropIndex(['parent_id']);
            $table->dropIndex(['is_active']);
        });

        // Blog posts table
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropIndex(['slug']);
            $table->dropIndex(['is_published']);
            $table->dropIndex(['published_at']);
        });

        // Users table
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role']);
            $table->dropIndex(['email']);
        });
    }
};

