<?php
/**
 * Laravel Test Scripti
 * http://evahomeworld.com/public/test_laravel.php
 */

// Hata raporlama aç
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>🔍 Laravel Test</h1>";
echo "<pre>";

// PHP versiyonu
echo "PHP Version: " . PHP_VERSION . "\n\n";

// Base path
$basePath = dirname(__DIR__);
echo "Base Path: $basePath\n\n";

// 1. Vendor kontrol
$vendorPath = $basePath . '/vendor/autoload.php';
if (file_exists($vendorPath)) {
    echo "✅ vendor/autoload.php bulundu\n";
    require $vendorPath;
    echo "✅ Composer autoload başarılı\n\n";
} else {
    echo "❌ vendor/autoload.php BULUNAMADI!\n";
    echo "Expected: $vendorPath\n\n";
    die("Vendor klasörü eksik!");
}

// 2. Bootstrap kontrol
$bootstrapPath = $basePath . '/bootstrap/app.php';
if (file_exists($bootstrapPath)) {
    echo "✅ bootstrap/app.php bulundu\n";
} else {
    echo "❌ bootstrap/app.php BULUNAMADI!\n";
    die();
}

// 3. .env kontrol
$envPath = $basePath . '/.env';
if (file_exists($envPath)) {
    echo "✅ .env bulundu\n";
    $env = file_get_contents($envPath);
    if (strpos($env, 'APP_KEY=') !== false) {
        echo "✅ APP_KEY tanımlı\n";
    } else {
        echo "⚠️  APP_KEY eksik!\n";
    }
} else {
    echo "❌ .env BULUNAMADI!\n";
}

// 4. Storage permissions
$storagePath = $basePath . '/storage';
if (is_writable($storagePath)) {
    echo "✅ Storage yazılabilir\n";
} else {
    echo "❌ Storage yazılamıyor!\n";
}

// 5. Laravel başlatma testi
echo "\n=== Laravel Bootstrap Testi ===\n";

try {
    // LARAVEL_START constant'ı tanımla
    if (!defined('LARAVEL_START')) {
        define('LARAVEL_START', microtime(true));
    }
    
    echo "✅ LARAVEL_START tanımlandı\n";
    
    // Bootstrap dosyasını require et
    echo "Bootstrap çağrılıyor...\n";
    $app = require $bootstrapPath;
    
    echo "✅ Laravel bootstrap başarılı!\n";
    echo "✅ App instance: " . get_class($app) . "\n";
    
    // Config test - direkt config dosyasından oku
    echo "\n=== Config Test (Direkt) ===\n";
    
    // app.php config dosyasını direkt oku
    $configPath = $basePath . '/config/app.php';
    if (file_exists($configPath)) {
        echo "✅ config/app.php bulundu\n";
        $appConfig = require $configPath;
        echo "App Name: " . ($appConfig['name'] ?? 'N/A') . "\n";
    }
    
    // .env dosyasını parse et
    echo "\n=== .env Bilgileri ===\n";
    $envLines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($envLines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            if (in_array($key, ['APP_NAME', 'APP_ENV', 'APP_DEBUG', 'DB_CONNECTION', 'DB_DATABASE'])) {
                echo "$key = $value\n";
            }
        }
    }
    
    // Cache kontrol
    echo "\n=== Cache Dosyaları ===\n";
    $cacheFiles = [
        'config.php' => $basePath . '/bootstrap/cache/config.php',
        'routes.php' => $basePath . '/bootstrap/cache/routes.php',
    ];
    
    foreach ($cacheFiles as $name => $path) {
        if (file_exists($path)) {
            echo "❌ $name MEVCUT (SİLİNMELİ)\n";
        } else {
            echo "✅ $name yok (doğru)\n";
        }
    }
    
    echo "\n=== SONUÇ ===\n";
    echo "Laravel bootstrap başarılı!\n";
    echo "Config cache dosyaları silindi.\n";
    echo "\nŞimdi ana siteyi açmayı deneyin:\n";
    
} catch (Exception $e) {
    echo "\n❌ HATA: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    
    // Stack trace sadece ilk 5 satır
    $trace = explode("\n", $e->getTraceAsString());
    echo "\nStack Trace (ilk 5 satır):\n";
    foreach (array_slice($trace, 0, 5) as $line) {
        echo $line . "\n";
    }
}

echo "\n=== Test Tamamlandı ===\n";
echo "</pre>";

echo "<div style='margin-top: 20px; padding: 10px; background: #e3f2fd; border-radius: 5px;'>";
echo "<strong>Sonraki Adım:</strong><br>";
echo "Ana siteyi açın: <a href='/'>http://evahomeworld.com</a><br>";
echo "<small>Eğer hala 500 hatası alıyorsanız, config cache dosyalarını kontrol edin.</small>";
echo "</div>";
?>
