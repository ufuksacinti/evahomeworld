<?php
/**
 * Database Connection Test
 * http://evahomeworld.com/public/test_db.php
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h1>🔌 Database Connection Test</h1>";
echo "<pre>";

$basePath = dirname(__DIR__);

// .env dosyasından veritabanı bilgilerini oku
$envPath = $basePath . '/.env';
if (!file_exists($envPath)) {
    die("❌ .env dosyası bulunamadı!\n");
}

$env = file_get_contents($envPath);
$config = [];

foreach (explode("\n", $env) as $line) {
    if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
        list($key, $value) = explode('=', $line, 2);
        $config[trim($key)] = trim($value);
    }
}

echo "=== Database Configuration ===\n";
echo "Host: " . ($config['DB_HOST'] ?? 'N/A') . "\n";
echo "Database: " . ($config['DB_DATABASE'] ?? 'N/A') . "\n";
echo "Username: " . ($config['DB_USERNAME'] ?? 'N/A') . "\n";
echo "Password: " . str_repeat('*', strlen($config['DB_PASSWORD'] ?? '')) . "\n\n";

// MySQL bağlantı testi
echo "=== Connection Test ===\n";

try {
    $host = $config['DB_HOST'] ?? 'localhost';
    $dbname = $config['DB_DATABASE'] ?? '';
    $username = $config['DB_USERNAME'] ?? '';
    $password = $config['DB_PASSWORD'] ?? '';
    
    if (empty($dbname) || empty($username)) {
        die("❌ Database veya username boş!\n");
    }
    
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    
    echo "Connecting to: $dbname\n";
    
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    
    echo "✅ Database connection başarılı!\n\n";
    
    // Database version
    $stmt = $pdo->query('SELECT VERSION() as version');
    $version = $stmt->fetch();
    echo "MySQL Version: " . $version['version'] . "\n\n";
    
    // Check tables
    echo "=== Database Tables ===\n";
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    if (empty($tables)) {
        echo "⚠️  Veritabanı BOŞ! Tablolar yok.\n";
        echo "Laravel migration'ları çalıştırmalısınız.\n";
    } else {
        echo "✅ Bulunan tablolar (" . count($tables) . "):\n";
        foreach ($tables as $table) {
            echo "   - $table\n";
        }
    }
    
    echo "\n✅ Database test başarılı!\n";
    
} catch (PDOException $e) {
    echo "❌ Database connection BAŞARISIZ!\n";
    echo "Error: " . $e->getMessage() . "\n\n";
    echo "=== Olası Sorunlar ===\n";
    echo "1. Database adı yanlış olabilir\n";
    echo "2. Username veya password yanlış olabilir\n";
    echo "3. Database henüz oluşturulmamış olabilir\n";
    echo "4. MySQL servisi çalışmıyor olabilir\n";
}

echo "\n=== Test Tamamlandı ===\n";
echo "</pre>";

echo "<div style='margin-top: 20px; padding: 10px; background: #fff3cd; border-radius: 5px;'>";
echo "<strong>⚠️ ÖNEMLİ:</strong><br>";
echo "Veritabanı bağlantısı başarısızsa, ana site çalışmayacaktır.<br>";
echo "Veritabanını oluşturup migration çalıştırmanız gerekebilir.";
echo "</div>";
?>
