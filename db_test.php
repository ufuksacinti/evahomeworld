<?php
// Veritabanı Bağlantı Test Script'i
echo "<h1>EvaHome Veritabanı Test</h1>";
echo "<hr>";

// .env dosyasını oku
$envFile = file_get_contents('.env');
$lines = explode("\n", $envFile);
$config = [];

foreach ($lines as $line) {
    if (strpos($line, '=') !== false) {
        list($key, $value) = explode('=', $line, 2);
        $config[trim($key)] = trim($value);
    }
}

echo "<h2>1. .env Dosyası Kontrolü</h2>";
echo "<div style='background: #f0f0f0; padding: 10px; border-radius: 5px;'>";
echo "<strong>Veritabanı Ayarları:</strong><br>";
echo "DB_CONNECTION: " . ($config['DB_CONNECTION'] ?? 'YOK') . "<br>";
echo "DB_HOST: " . ($config['DB_HOST'] ?? 'YOK') . "<br>";
echo "DB_PORT: " . ($config['DB_PORT'] ?? 'YOK') . "<br>";
echo "DB_DATABASE: " . ($config['DB_DATABASE'] ?? 'YOK') . "<br>";
echo "DB_USERNAME: " . ($config['DB_USERNAME'] ?? 'YOK') . "<br>";
echo "DB_PASSWORD: " . (isset($config['DB_PASSWORD']) ? '***' . substr($config['DB_PASSWORD'], -3) : 'YOK') . "<br>";
echo "</div>";
echo "<hr>";

// Veritabanı bağlantısını test et
echo "<h2>2. Veritabanı Bağlantı Testi</h2>";
echo "<div style='background: #f0f0f0; padding: 10px; border-radius: 5px;'>";

try {
    $host = $config['DB_HOST'] ?? 'localhost';
    $port = $config['DB_PORT'] ?? '3306';
    $dbname = $config['DB_DATABASE'] ?? '';
    $username = $config['DB_USERNAME'] ?? '';
    $password = $config['DB_PASSWORD'] ?? '';
    
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    
    echo "<strong>DSN:</strong> $dsn<br>";
    echo "<strong>Kullanıcı:</strong> $username<br><br>";
    
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    
    echo "<span style='color: green;'>✅ Veritabanı bağlantısı başarılı!</span><br>";
    
    // Tabloları kontrol et
    echo "<br><strong>Mevcut Tablolar:</strong><br>";
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    if (empty($tables)) {
        echo "<span style='color: orange;'>⚠️ Hiç tablo bulunamadı. Migration çalıştırılması gerekiyor.</span><br>";
    } else {
        echo "<span style='color: green;'>✅ " . count($tables) . " tablo bulundu:</span><br>";
        foreach ($tables as $table) {
            echo "- $table<br>";
        }
    }
    
    // Users tablosunu kontrol et
    if (in_array('users', $tables)) {
        echo "<br><strong>Users Tablosu:</strong><br>";
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM users");
        $count = $stmt->fetch()['count'];
        echo "Toplam kullanıcı sayısı: $count<br>";
        
        if ($count > 0) {
            $stmt = $pdo->query("SELECT id, name, email, role FROM users LIMIT 5");
            $users = $stmt->fetchAll();
            echo "<br><strong>İlk 5 kullanıcı:</strong><br>";
            foreach ($users as $user) {
                echo "- ID: {$user['id']}, İsim: {$user['name']}, Email: {$user['email']}, Rol: {$user['role']}<br>";
            }
        }
    }
    
} catch (PDOException $e) {
    echo "<span style='color: red;'>❌ Veritabanı bağlantı hatası:</span><br>";
    echo "<strong>Hata:</strong> " . htmlspecialchars($e->getMessage()) . "<br>";
    
    // Yaygın hatalar ve çözümleri
    echo "<br><strong>Olası Çözümler:</strong><br>";
    if (strpos($e->getMessage(), 'Access denied') !== false) {
        echo "- Kullanıcı adı veya şifre yanlış<br>";
        echo "- Veritabanı kullanıcısının izinleri kontrol edilmeli<br>";
    } elseif (strpos($e->getMessage(), 'Unknown database') !== false) {
        echo "- Veritabanı adı yanlış veya veritabanı mevcut değil<br>";
        echo "- cPanel'de veritabanı oluşturulmalı<br>";
    } elseif (strpos($e->getMessage(), 'Connection refused') !== false) {
        echo "- MySQL servisi çalışmıyor<br>";
        echo "- Host adresi yanlış olabilir<br>";
    }
}

echo "</div>";
echo "<hr>";

// Laravel Migration Test
echo "<h2>3. Laravel Migration Testi</h2>";
echo "<div style='background: #f0f0f0; padding: 10px; border-radius: 5px;'>";

if (file_exists('artisan')) {
    echo "<strong>Migration çalıştırılıyor...</strong><br>";
    $output = [];
    $return_var = 0;
    exec('php artisan migrate --force 2>&1', $output, $return_var);
    
    echo "<strong>Çıktı:</strong><br>";
    foreach ($output as $line) {
        echo htmlspecialchars($line) . "<br>";
    }
    
    if ($return_var === 0) {
        echo "<br><span style='color: green;'>✅ Migration başarılı!</span><br>";
    } else {
        echo "<br><span style='color: red;'>❌ Migration başarısız!</span><br>";
    }
} else {
    echo "<span style='color: red;'>❌ artisan dosyası bulunamadı!</span><br>";
}

echo "</div>";
echo "<hr>";

// Sonuç
echo "<h2>4. Sonuç</h2>";
if (isset($pdo) && !empty($tables)) {
    echo "<span style='color: green; font-size: 18px;'>🎉 Veritabanı hazır! Site çalışmaya hazır.</span><br>";
    echo "<a href='/' style='background: #007cba; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin: 10px 0; display: inline-block;'>Ana Siteyi Ziyaret Et</a>";
} else {
    echo "<span style='color: red; font-size: 18px;'>❌ Veritabanı sorunu var. Yukarıdaki hataları kontrol edin.</span><br>";
}

echo "<hr>";
echo "<p><small>Bu script EvaHome Laravel projesi için veritabanı testi yapar.</small></p>";
?>
