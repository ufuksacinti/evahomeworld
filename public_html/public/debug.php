<?php
/**
 * Debug Script
 * http://evahomeworld.com/public/debug.php
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>🔍 Debug Test</h1>";
echo "<pre>";

$basePath = dirname(__DIR__);

echo "Base Path: $basePath\n\n";

// 1. Vendor check
$vendorPath = $basePath . '/vendor/autoload.php';
if (file_exists($vendorPath)) {
    echo "✅ vendor/autoload.php bulundu\n";
    require $vendorPath;
    echo "✅ Composer autoload başarılı\n\n";
} else {
    die("❌ vendor/autoload.php BULUNAMADI!\n");
}

// 2. Bootstrap
try {
    define('LARAVEL_START', microtime(true));
    
    echo "Bootstrap çağrılıyor...\n";
    $app = require $basePath . '/bootstrap/app.php';
    echo "✅ Laravel bootstrap başarılı!\n\n";
    
    // 3. Test database connection
    echo "=== Database Test ===\n";
    $pdo = new PDO(
        "mysql:host=localhost;dbname=xqxevaho_home54;charset=utf8mb4",
        'xqxevaho_evahome',
        'B)G18T$1S+yg',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    echo "✅ Database bağlantısı başarılı\n\n";
    
    // 4. Check tables
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "✅ Toplam tablo: " . count($tables) . "\n\n";
    
    // 5. Try to get a route
    echo "=== Route Test ===\n";
    try {
        $request = Illuminate\Http\Request::create('/', 'GET');
        $response = $app->handle($request);
        $status = $response->getStatusCode();
        echo "Route Status: $status\n";
        
        if ($status >= 500) {
            echo "\n❌ 500 Hatası tespit edildi!\n";
            echo "Response Content (ilk 2000 karakter):\n";
            echo substr($response->getContent(), 0, 2000) . "\n";
        } else {
            echo "✅ Route başarılı!\n";
        }
    } catch (Exception $e) {
        echo "❌ Route hatası: " . $e->getMessage() . "\n";
        echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
        
        // Stack trace
        $trace = explode("\n", $e->getTraceAsString());
        echo "\nStack Trace:\n";
        foreach (array_slice($trace, 0, 15) as $line) {
            echo $line . "\n";
        }
    }
    
    echo "\n✅ Her şey çalışıyor!\n";
    
} catch (Exception $e) {
    echo "\n❌ HATA: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    
    // Stack trace
    $trace = explode("\n", $e->getTraceAsString());
    echo "\nStack Trace:\n";
    foreach (array_slice($trace, 0, 10) as $line) {
        echo $line . "\n";
    }
}

echo "</pre>";
?>
