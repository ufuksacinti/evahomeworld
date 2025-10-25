<?php
/**
 * Laravel Migration Runner
 * http://evahomeworld.com/public/run_migrations.php
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h1>🚀 Laravel Migration Runner</h1>";
echo "<pre>";

$basePath = dirname(__DIR__);

// Composer autoload
require $basePath . '/vendor/autoload.php';

// Laravel bootstrap
if (!defined('LARAVEL_START')) {
    define('LARAVEL_START', microtime(true));
}

try {
    $app = require $basePath . '/bootstrap/app.php';
    echo "✅ Laravel bootstrap başarılı\n\n";
    
    // Migration dosyalarını kontrol et
    echo "=== Migration Dosyaları ===\n";
    $migrationPath = $basePath . '/database/migrations';
    
    if (is_dir($migrationPath)) {
        $files = glob($migrationPath . '/*.php');
        echo "Bulunan migration dosyaları: " . count($files) . "\n";
        
        foreach ($files as $file) {
            echo "   - " . basename($file) . "\n";
        }
    } else {
        echo "❌ Migration klasörü bulunamadı!\n";
    }
    
    echo "\n=== Migration Çalıştırma ===\n";
    
    // Artisan command'ı çalıştır
    $artisan = $basePath . '/artisan';
    
    if (file_exists($artisan)) {
        echo "Artisan dosyası bulundu\n";
        
        // Migration komutunu çalıştır
        $command = "cd $basePath && php artisan migrate --force 2>&1";
        echo "Komut çalıştırılıyor: $command\n\n";
        
        $output = shell_exec($command);
        
        if ($output) {
            echo "Migration çıktısı:\n";
            echo $output . "\n";
        } else {
            echo "Migration çıktısı alınamadı\n";
        }
        
    } else {
        echo "❌ Artisan dosyası bulunamadı!\n";
    }
    
    echo "\n=== Migration Sonrası Kontrol ===\n";
    
    // Database tablolarını kontrol et
    try {
        $pdo = new PDO(
            "mysql:host=localhost;dbname=xqxevaho_home54;charset=utf8mb4",
            'xqxevaho_evahome',
            'B)G18T$1S+yg',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        
        $stmt = $pdo->query("SHOW TABLES");
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        if (empty($tables)) {
            echo "⚠️  Hala tablo yok!\n";
        } else {
            echo "✅ Oluşturulan tablolar (" . count($tables) . "):\n";
            foreach ($tables as $table) {
                echo "   - $table\n";
            }
        }
        
    } catch (PDOException $e) {
        echo "❌ Database kontrol hatası: " . $e->getMessage() . "\n";
    }
    
    echo "\n=== İŞLEM TAMAMLANDI ===\n";
    echo "Migration'lar çalıştırıldı.\n";
    echo "Şimdi ana siteyi test edin: <a href='/'>Ana Site</a>\n";
    
} catch (Exception $e) {
    echo "❌ HATA: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}

echo "\n⚠️  Bu dosyayı SİLİN (güvenlik için)!\n";
echo "</pre>";
?>
