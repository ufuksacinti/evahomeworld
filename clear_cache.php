<?php
/**
 * Laravel Cache Temizleme Scripti
 * 
 * Kullanım: http://evahomeworld.com/public/clear_cache.php
 * Güvenlik: İşlem bitince bu dosyayı SİLİN!
 */

// PHP versiyonu kontrolü
if (version_compare(PHP_VERSION, '8.2.0', '<')) {
    die('PHP 8.2+ gerekli! Mevcut: ' . PHP_VERSION);
}

echo "<h1>🧹 Laravel Cache Temizleme</h1>";
echo "<pre>";

// Proje dizini
$basePath = __DIR__ . '/..';

// Storage paths
$cachePaths = [
    $basePath . '/bootstrap/cache/config.php',
    $basePath . '/bootstrap/cache/routes.php',
    $basePath . '/bootstrap/cache/services.php',
    $basePath . '/bootstrap/cache/packages.php',
    $basePath . '/storage/framework/cache/',
    $basePath . '/storage/framework/views/',
    $basePath . '/storage/framework/sessions/',
];

// Cache temizleme fonksiyonu
function clearCache($path) {
    if (file_exists($path)) {
        if (is_dir($path)) {
            // Klasörü temizle (alt klasörleri silmeden)
            $files = glob($path . '*');
            $deleted = 0;
            foreach ($files as $file) {
                if (is_file($file)) {
                    if (unlink($file)) {
                        $deleted++;
                    }
                }
            }
            return $deleted;
        } else {
            // Dosyayı sil
            if (unlink($path)) {
                return 1;
            }
        }
    }
    return 0;
}

// Cache temizleme
echo "Cache temizleniyor...\n\n";

$totalDeleted = 0;
foreach ($cachePaths as $path) {
    $deleted = clearCache($path);
    $totalDeleted += $deleted;
    
    if ($deleted > 0) {
        echo "✅ " . basename($path) . " temizlendi ($deleted dosya)\n";
    } else {
        echo "ℹ️  " . basename($path) . " (değişiklik yok)\n";
    }
}

echo "\n✅ Toplam $totalDeleted dosya/cache temizlendi!\n";
echo "\n🔄 Tarayıcıda ana siteyi açın: <a href='/'>http://evahomeworld.com</a>\n";
echo "\n⚠️  ÖNEMLİ: Bu dosyayı SİLİN (güvenlik için)!\n";

echo "</pre>";

// .env kontrol
$envPath = $basePath . '/.env';
if (file_exists($envPath)) {
    $env = file_get_contents($envPath);
    if (strpos($env, 'APP_ENV=production') !== false) {
        echo "<div style='background: #e8f5e9; padding: 10px; border-radius: 5px; margin-top: 20px;'>";
        echo "<strong>✅ .env dosyası bulundu</strong><br>";
        echo "<small>Production modunda çalışıyor.</small>";
        echo "</div>";
    }
}

// Storage permissions kontrol
$storagePath = $basePath . '/storage';
$cachePath = $basePath . '/bootstrap/cache';

if (is_writable($storagePath)) {
    echo "<div style='background: #e8f5e9; padding: 10px; border-radius: 5px; margin-top: 10px;'>";
    echo "<strong>✅ Storage klasörü yazılabilir</strong>";
    echo "</div>";
} else {
    echo "<div style='background: #ffebee; padding: 10px; border-radius: 5px; margin-top: 10px;'>";
    echo "<strong>⚠️ Storage klasörü yazılamıyor! Permissions ayarlayın.</strong>";
    echo "</div>";
}

if (is_writable($cachePath)) {
    echo "<div style='background: #e8f5e9; padding: 10px; border-radius: 5px; margin-top: 10px;'>";
    echo "<strong>✅ Bootstrap/cache klasörü yazılabilir</strong>";
    echo "</div>";
} else {
    echo "<div style='background: #ffebee; padding: 10px; border-radius: 5px; margin-top: 10px;'>";
    echo "<strong>⚠️ Bootstrap/cache klasörü yazılamıyor! Permissions ayarlayın.</strong>";
    echo "</div>";
}
?>
