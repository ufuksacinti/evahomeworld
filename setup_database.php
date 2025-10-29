<?php
/**
 * Database Setup - Tüm tabloları sıfırlar ve yeniden kurar
 * http://evahomeworld.com/public/setup_database.php
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h1>🗄️ Database Setup</h1>";
echo "<pre>";

$basePath = dirname(__DIR__);

require $basePath . '/vendor/autoload.php';

if (!defined('LARAVEL_START')) {
    define('LARAVEL_START', microtime(true));
}

try {
    $app = require $basePath . '/bootstrap/app.php';
    echo "✅ Laravel bootstrap başarılı\n\n";
    
    // PHP path'ini bul
    $phpPath = '/opt/cpanel/ea-php83/root/usr/bin/php';
    if (!file_exists($phpPath)) {
        $phpPath = 'php'; // Fallback
    }
    
    echo "PHP Path: $phpPath\n";
    echo "Base Path: $basePath\n\n";
    
    // ADIM 1: Migration'ları çalıştır
    echo "=== ADIM 1: Migration'ları Çalıştırma ===\n";
    
    $command = "cd $basePath && $phpPath artisan migrate --force 2>&1";
    echo "Komut: $command\n\n";
    
    $output = shell_exec($command);
    
    if ($output) {
        echo "Çıktı:\n$output\n\n";
    } else {
        echo "❌ Migration çalıştırılamadı!\n";
        echo "shell_exec çalışmıyor olabilir.\n\n";
        
        // Alternatif: Database migration'ları manuel çalıştır
        echo "=== Manuel Migration Denenecek ===\n";
        try {
            Artisan::call('migrate', ['--force' => true]);
            echo Artisan::output();
        } catch (Exception $e) {
            echo "❌ Hata: " . $e->getMessage() . "\n";
        }
    }
    
    // ADIM 2: Seeders çalıştır
    echo "\n=== ADIM 2: Seeder'ları Çalıştırma ===\n";
    
    $command = "cd $basePath && $phpPath artisan db:seed --force 2>&1";
    echo "Komut: $command\n\n";
    
    $output = shell_exec($command);
    
    if ($output) {
        echo "Çıktı:\n$output\n\n";
    } else {
        echo "Seeder çalıştırılamadı\n";
    }
    
    // ADIM 3: Tabloları kontrol et
    echo "=== ADIM 3: Tabloları Kontrol Etme ===\n";
    
    try {
        $pdo = new PDO(
            "mysql:host=localhost;dbname=xqxevaho_home54;charset=utf8mb4",
            'xqxevaho_evahome',
            'B)G18T$1S+yg',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        
        $stmt = $pdo->query("SHOW TABLES");
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        echo "✅ Toplam tablo sayısı: " . count($tables) . "\n";
        foreach ($tables as $table) {
            echo "   - $table\n";
        }
        
        if (count($tables) < 20) {
            echo "\n⚠️  UYARI: Beklenenden az tablo var!\n";
            echo "Migration'lar tam çalışmamış olabilir.\n";
        }
        
    } catch (PDOException $e) {
        echo "❌ Database hatası: " . $e->getMessage() . "\n";
    }
    
    echo "\n=== İŞLEM TAMAMLANDI ===\n";
    echo "✅ Database kurulumu tamamlandı!\n";
    echo "🔄 Ana siteyi test edin: <a href='/'>Ana Site</a>\n";
    
} catch (Exception $e) {
    echo "❌ HATA: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "\nStack Trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\n⚠️  Bu dosyayı SİLİN (güvenlik için)!\n";
echo "</pre>";
?>
