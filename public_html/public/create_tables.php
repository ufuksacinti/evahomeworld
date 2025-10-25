<?php
/**
 * Manual Database Table Creator
 * This script creates all tables directly without using shell_exec
 * http://evahomeworld.com/public/create_tables.php
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h1>🗄️ Manual Database Setup</h1>";
echo "<pre>";

$basePath = dirname(__DIR__);

require $basePath . '/vendor/autoload.php';

if (!defined('LARAVEL_START')) {
    define('LARAVEL_START', microtime(true));
}

try {
    // Bootstrap Laravel
    $app = require $basePath . '/bootstrap/app.php';
    $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
    
    echo "✅ Laravel bootstrap başarılı\n\n";
    
    // Database bağlantısı testi
    echo "=== Database Connection Test ===\n";
    $pdo = new PDO(
        "mysql:host=localhost;dbname=xqxevaho_home54;charset=utf8mb4",
        'xqxevaho_evahome',
        'B)G18T$1S+yg',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    echo "✅ Database bağlantısı başarılı\n\n";
    
    // 1. Mevcut tabloları sil
    echo "=== Step 1: Drop Existing Tables ===\n";
    $tables = [
        'settings', 'bulk_orders', 'favorites', 'campaigns', 
        'cart_items', 'carts', 'order_items', 'orders',
        'product_images', 'products', 'collections', 'blog_posts',
        'categories', 'job_batches', 'failed_jobs', 'jobs',
        'cache_locks', 'cache', 'sessions', 'password_reset_tokens', 'users'
    ];
    
    foreach ($tables as $table) {
        try {
            $pdo->exec("DROP TABLE IF EXISTS `$table`");
            echo "✅ Dropped: $table\n";
        } catch (PDOException $e) {
            echo "ℹ️  $table (not exists)\n";
        }
    }
    
    echo "\n=== Step 2: Create Tables ===\n\n";
    
    // 2. Users table
    echo "Creating: users, password_reset_tokens, sessions\n";
    $pdo->exec("
        CREATE TABLE `users` (
            `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` varchar(255) NOT NULL,
            `email` varchar(255) NOT NULL,
            `email_verified_at` timestamp NULL,
            `password` varchar(255) NOT NULL,
            `remember_token` varchar(100),
            `phone` varchar(255),
            `role` enum('admin','customer') DEFAULT 'customer',
            `created_at` timestamp NULL,
            `updated_at` timestamp NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `users_email_unique` (`email`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
    
    $pdo->exec("
        CREATE TABLE `password_reset_tokens` (
            `email` varchar(255) NOT NULL,
            `token` varchar(255) NOT NULL,
            `created_at` timestamp NULL,
            PRIMARY KEY (`email`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
    
    $pdo->exec("
        CREATE TABLE `sessions` (
            `id` varchar(255) NOT NULL,
            `user_id` bigint UNSIGNED,
            `ip_address` varchar(45),
            `user_agent` text,
            `payload` longtext NOT NULL,
            `last_activity` int NOT NULL,
            PRIMARY KEY (`id`),
            KEY `sessions_user_id_index` (`user_id`),
            KEY `sessions_last_activity_index` (`last_activity`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
    echo "✅ Created\n\n";
    
    // 3. Cache tables
    echo "Creating: cache, cache_locks\n";
    $pdo->exec("
        CREATE TABLE `cache` (
            `key` varchar(255) NOT NULL,
            `value` mediumtext NOT NULL,
            `expiration` int NOT NULL,
            PRIMARY KEY (`key`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
    
    $pdo->exec("
        CREATE TABLE `cache_locks` (
            `key` varchar(255) NOT NULL,
            `owner` varchar(255) NOT NULL,
            `expiration` int NOT NULL,
            PRIMARY KEY (`key`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
    echo "✅ Created\n\n";
    
    // 4. Jobs tables
    echo "Creating: jobs, job_batches, failed_jobs\n";
    $pdo->exec("
        CREATE TABLE `jobs` (
            `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
            `queue` varchar(255) NOT NULL,
            `payload` longtext NOT NULL,
            `attempts` tinyint UNSIGNED NOT NULL,
            `reserved_at` int UNSIGNED,
            `available_at` int UNSIGNED NOT NULL,
            `created_at` int UNSIGNED NOT NULL,
            PRIMARY KEY (`id`),
            KEY `jobs_queue_index` (`queue`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
    
    $pdo->exec("
        CREATE TABLE `job_batches` (
            `id` varchar(255) NOT NULL,
            `name` varchar(255) NOT NULL,
            `total_jobs` int NOT NULL,
            `pending_jobs` int NOT NULL,
            `failed_jobs` int NOT NULL,
            `failed_job_ids` longtext NOT NULL,
            `options` mediumtext,
            `cancelled_at` int,
            `created_at` int NOT NULL,
            `finished_at` int,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
    
    $pdo->exec("
        CREATE TABLE `failed_jobs` (
            `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
            `uuid` varchar(255) NOT NULL,
            `connection` text NOT NULL,
            `queue` text NOT NULL,
            `payload` longtext NOT NULL,
            `exception` longtext NOT NULL,
            `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
    echo "✅ Created\n\n";
    
    // 5. Categories
    echo "Creating: categories\n";
    $pdo->exec("
        CREATE TABLE `categories` (
            `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` varchar(255) NOT NULL,
            `slug` varchar(255) NOT NULL,
            `description` text,
            `parent_id` bigint UNSIGNED,
            `image` varchar(255),
            `order` int DEFAULT 0,
            `is_active` tinyint(1) DEFAULT 1,
            `created_at` timestamp NULL,
            `updated_at` timestamp NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `categories_slug_unique` (`slug`),
            KEY `categories_parent_id_foreign` (`parent_id`),
            CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
    echo "✅ Created\n\n";
    
    // 6. Collections
    echo "Creating: collections\n";
    $pdo->exec("
        CREATE TABLE `collections` (
            `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` varchar(255) NOT NULL,
            `slug` varchar(255) NOT NULL,
            `description` text,
            `type` varchar(255) DEFAULT 'collection',
            `image` varchar(255),
            `order` int DEFAULT 0,
            `is_active` tinyint(1) DEFAULT 1,
            `created_at` timestamp NULL,
            `updated_at` timestamp NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `collections_slug_unique` (`slug`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
    echo "✅ Created\n\n";
    
    // 7. Products
    echo "Creating: products\n";
    $pdo->exec("
        CREATE TABLE `products` (
            `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
            `category_id` bigint UNSIGNED,
            `collection_id` bigint UNSIGNED,
            `name` varchar(255) NOT NULL,
            `slug` varchar(255) NOT NULL,
            `sku` varchar(255) NOT NULL,
            `description` text,
            `short_description` text,
            `price` decimal(10,2) NOT NULL,
            `discount_price` decimal(10,2),
            `stock` int DEFAULT 0,
            `is_featured` tinyint(1) DEFAULT 0,
            `is_active` tinyint(1) DEFAULT 1,
            `view_count` int DEFAULT 0,
            `sale_count` int DEFAULT 0,
            `created_at` timestamp NULL,
            `updated_at` timestamp NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `products_slug_unique` (`slug`),
            UNIQUE KEY `products_sku_unique` (`sku`),
            KEY `products_category_id_foreign` (`category_id`),
            KEY `products_collection_id_foreign` (`collection_id`),
            CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
            CONSTRAINT `products_collection_id_foreign` FOREIGN KEY (`collection_id`) REFERENCES `collections` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
    echo "✅ Created\n\n";
    
    // 8. Product Images
    echo "Creating: product_images\n";
    $pdo->exec("
        CREATE TABLE `product_images` (
            `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
            `product_id` bigint UNSIGNED NOT NULL,
            `image` varchar(255) NOT NULL,
            `is_primary` tinyint(1) DEFAULT 0,
            `order` int DEFAULT 0,
            `created_at` timestamp NULL,
            `updated_at` timestamp NULL,
            PRIMARY KEY (`id`),
            KEY `product_images_product_id_foreign` (`product_id`),
            CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
    echo "✅ Created\n\n";
    
    // 9. Orders
    echo "Creating: orders\n";
    $pdo->exec("
        CREATE TABLE `orders` (
            `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
            `user_id` bigint UNSIGNED,
            `order_number` varchar(255) NOT NULL,
            `total_amount` decimal(10,2) NOT NULL,
            `discount_amount` decimal(10,2) DEFAULT 0,
            `shipping_amount` decimal(10,2) DEFAULT 0,
            `status` enum('pending','processing','shipped','delivered','cancelled') DEFAULT 'pending',
            `payment_status` enum('pending','paid','failed','refunded') DEFAULT 'pending',
            `payment_method` varchar(255),
            `payment_transaction_id` varchar(255),
            `shipping_address` json,
            `billing_address` json,
            `notes` text,
            `created_at` timestamp NULL,
            `updated_at` timestamp NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `orders_order_number_unique` (`order_number`),
            KEY `orders_user_id_foreign` (`user_id`),
            CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
    echo "✅ Created\n\n";
    
    // 10. Order Items
    echo "Creating: order_items\n";
    $pdo->exec("
        CREATE TABLE `order_items` (
            `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
            `order_id` bigint UNSIGNED NOT NULL,
            `product_id` bigint UNSIGNED NOT NULL,
            `quantity` int NOT NULL,
            `price` decimal(10,2) NOT NULL,
            `total` decimal(10,2) NOT NULL,
            `created_at` timestamp NULL,
            `updated_at` timestamp NULL,
            PRIMARY KEY (`id`),
            KEY `order_items_order_id_foreign` (`order_id`),
            KEY `order_items_product_id_foreign` (`product_id`),
            CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
            CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
    echo "✅ Created\n\n";
    
    // 11. Carts
    echo "Creating: carts\n";
    $pdo->exec("
        CREATE TABLE `carts` (
            `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
            `user_id` bigint UNSIGNED,
            `session_id` varchar(255),
            `created_at` timestamp NULL,
            `updated_at` timestamp NULL,
            PRIMARY KEY (`id`),
            KEY `carts_user_id_foreign` (`user_id`),
            CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
    echo "✅ Created\n\n";
    
    // 12. Cart Items
    echo "Creating: cart_items\n";
    $pdo->exec("
        CREATE TABLE `cart_items` (
            `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
            `cart_id` bigint UNSIGNED NOT NULL,
            `product_id` bigint UNSIGNED NOT NULL,
            `quantity` int NOT NULL,
            `created_at` timestamp NULL,
            `updated_at` timestamp NULL,
            PRIMARY KEY (`id`),
            KEY `cart_items_cart_id_foreign` (`cart_id`),
            KEY `cart_items_product_id_foreign` (`product_id`),
            CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
            CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
    echo "✅ Created\n\n";
    
    // 13. Favorites
    echo "Creating: favorites\n";
    $pdo->exec("
        CREATE TABLE `favorites` (
            `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
            `user_id` bigint UNSIGNED NOT NULL,
            `product_id` bigint UNSIGNED NOT NULL,
            `created_at` timestamp NULL,
            `updated_at` timestamp NULL,
            PRIMARY KEY (`id`),
            KEY `favorites_user_id_foreign` (`user_id`),
            KEY `favorites_product_id_foreign` (`product_id`),
            CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
            CONSTRAINT `favorites_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
    echo "✅ Created\n\n";
    
    // 14. Campaigns
    echo "Creating: campaigns\n";
    $pdo->exec("
        CREATE TABLE `campaigns` (
            `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
            `title` varchar(255) NOT NULL,
            `description` text,
            `discount_percentage` int DEFAULT 0,
            `start_date` datetime NOT NULL,
            `end_date` datetime NOT NULL,
            `is_active` tinyint(1) DEFAULT 1,
            `image` varchar(255),
            `created_at` timestamp NULL,
            `updated_at` timestamp NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
    echo "✅ Created\n\n";
    
    // 15. Blog Posts
    echo "Creating: blog_posts\n";
    $pdo->exec("
        CREATE TABLE `blog_posts` (
            `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
            `user_id` bigint UNSIGNED,
            `title` varchar(255) NOT NULL,
            `slug` varchar(255) NOT NULL,
            `content` longtext NOT NULL,
            `excerpt` text,
            `featured_image` varchar(255),
            `is_published` tinyint(1) DEFAULT 0,
            `published_at` timestamp NULL,
            `view_count` int DEFAULT 0,
            `created_at` timestamp NULL,
            `updated_at` timestamp NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `blog_posts_slug_unique` (`slug`),
            KEY `blog_posts_user_id_foreign` (`user_id`),
            CONSTRAINT `blog_posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
    echo "✅ Created\n\n";
    
    // 16. Bulk Orders
    echo "Creating: bulk_orders\n";
    $pdo->exec("
        CREATE TABLE `bulk_orders` (
            `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
            `user_id` bigint UNSIGNED,
            `company_name` varchar(255) NOT NULL,
            `email` varchar(255) NOT NULL,
            `phone` varchar(255) NOT NULL,
            `message` text NOT NULL,
            `status` enum('pending','contacted','completed','cancelled') DEFAULT 'pending',
            `created_at` timestamp NULL,
            `updated_at` timestamp NULL,
            PRIMARY KEY (`id`),
            KEY `bulk_orders_user_id_foreign` (`user_id`),
            CONSTRAINT `bulk_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
    echo "✅ Created\n\n";
    
    // 17. Settings
    echo "Creating: settings\n";
    $pdo->exec("
        CREATE TABLE `settings` (
            `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
            `key` varchar(255) NOT NULL,
            `value` text,
            `created_at` timestamp NULL,
            `updated_at` timestamp NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `settings_key_unique` (`key`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
    echo "✅ Created\n\n";
    
    // Check final count
    echo "\n=== Final Check ===\n";
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "✅ Toplam tablo sayısı: " . count($tables) . "\n\n";
    foreach ($tables as $table) {
        $countStmt = $pdo->query("SELECT COUNT(*) as count FROM `$table`");
        $count = $countStmt->fetch()['count'];
        echo "   - $table ($count kayıt)\n";
    }
    
    echo "\n=== İŞLEM BAŞARILI ===\n";
    echo "✅ Tüm tablolar oluşturuldu!\n";
    echo "🔄 Ana siteyi test edin: <a href='/'>Ana Site</a>\n";
    
} catch (Exception $e) {
    echo "\n❌ HATA: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}

echo "\n⚠️  Bu dosyayı SİLİN (güvenlik için)!\n";
echo "</pre>";
?>
