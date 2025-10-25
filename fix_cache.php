<?php
/**
 * Cache Temizleme ve Sorun Tespiti
 * http://evahomeworld.com/public/fix_cache.php
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);

$basePath = dirname(__DIR__);

echo "<h1>🔧 Cache Temizleme ve Sorun Tespiti</h1>";
echo "<pre>";

// 1. Tüm cache dosyalarını sil
echo "=== Cache Dosyalarını Sil ===\n\n";

$cacheFiles = [
    $basePath . '/bootstrap/cache/config.php',
    $basePath . '/bootstrap/cache/routes.php',
    $basePath . '/bootstrap/cache/services.php',
    $basePath . '/bootstrap/cache/packages.php',
    $basePath . '/bootstrap/cache/.gitignore',
];

$deleted = 0;
foreach ($cacheFiles as $file) {
    if (file_exists($file) && unlink($file)) {
        echo "✅ Silindi: " . basename($file) . "\n";
        $deleted++;
    }
}

if ($deleted == 0) {
    echo "ℹ️  Silinecek cache dosyası yok\n";
}

// 2. Framework cache temizle
echo "\n=== Framework Cache Temizle ===\n\n";

$cacheDirs = [
    $basePath . '/storage/framework/cache/data',
    $basePath . '/storage/framework/views',
];

foreach ($cacheDirs as $dir) {
    if (is_dir($dir)) {
        $files = glob($dir . '/*');
        $count = 0;
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
                $count++;
            }
        }
        echo "✅ $dir temizlendi ($count dosya)\n";
    }
}

// 3. .env kontrol
echo "\n=== .env Kontrol ===\n\n";

$envPath = $basePath . '/.env';
if (file_exists($envPath)) {
    $env = file_get_contents($envPath);
    
    $checks = [
        'APP_ENV=production' => 'APP_ENV',
        'APP_DEBUG=false' => 'APP_DEBUG',
        'APP_KEY=' => 'APP_KEY',
        'DB_CONNECTION=mysql' => 'DB Connection',
    ];
    
    foreach ($checks as $needle => $name) {
        if (strpos($env, $needle) !== false) {
            echo "✅ $name doğru\n";
        } else {
            echo "⚠️  $name kontrol edilmeli\n";
        }
    }
}

// 4. Composer autoload test
echo "\n=== Composer Autoload Test ===\n\n";

$vendorPath = $basePath . '/vendor/autoload.php';
if (file_exists($vendorPath)) {
    require $vendorPath;
    echo "✅ Composer autoload başarılı\n";
} else {
    echo "❌ Composer autoload BAŞARISIZ!\n";
}

// 5. Bootstrap test
echo "\n=== Bootstrap Test ===\n\n";

try {
    if (!defined('LARAVEL_START')) {
        define('LARAVEL_START', microtime(true));
    }
    
    $app = require $basePath . '/bootstrap/app.php';
    echo "✅ Laravel bootstrap başarılı\n";
    
} catch (Exception $e) {
    echo "❌ Bootstrap hatası: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}

echo "\n=== İŞLEM TAMAMLANDI ===\n";
echo "\n✅ Tüm cache temizlendi!\n";
echo "🔄 Şimdi ana siteyi açmayı deneyin: <a href='/'>Ana Site</a>\n";
echo "\n⚠️  Bu dosyayı SİLİN (güvenlik için)!\n";

echo "</pre>";
?>
