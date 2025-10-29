<?php
// EvaHome Composer Install Script - Terminal olmadan çalıştırılabilir
set_time_limit(0);
ini_set('memory_limit', '512M');

echo "<h1>EvaHome Kurulum Script'i</h1>";
echo "<hr>";

// PHP versiyonunu kontrol et
echo "<h2>1. PHP Versiyon Kontrolü</h2>";
echo "Mevcut PHP Versiyonu: " . phpversion() . "<br>";
if (version_compare(phpversion(), '8.2.0', '>=')) {
    echo "<span style='color: green;'>✅ PHP versiyonu uygun (8.2+)</span><br>";
} else {
    echo "<span style='color: red;'>❌ PHP versiyonu uygun değil (8.2+ gerekli)</span><br>";
}
echo "<hr>";

// Composer.phar dosyasının varlığını kontrol et
echo "<h2>2. Composer Kontrolü</h2>";
if (file_exists('composer.phar')) {
    echo "<span style='color: green;'>✅ composer.phar mevcut</span><br>";
} else {
    echo "<span style='color: orange;'>⚠️ composer.phar bulunamadı, indiriliyor...</span><br>";
    
    // Composer.phar indir
    $composerContent = file_get_contents('https://getcomposer.org/composer.phar');
    if ($composerContent !== false) {
        file_put_contents('composer.phar', $composerContent);
        echo "<span style='color: green;'>✅ composer.phar indirildi</span><br>";
    } else {
        echo "<span style='color: red;'>❌ composer.phar indirilemedi</span><br>";
    }
}
echo "<hr>";

// Composer install çalıştır
echo "<h2>3. Composer Install</h2>";
echo "<div style='background: #f0f0f0; padding: 10px; border-radius: 5px;'>";
echo "<strong>Çalıştırılan komut:</strong> php composer.phar install --no-dev --optimize-autoloader<br><br>";

$output = [];
$return_var = 0;

// Composer install komutunu çalıştır
exec('php composer.phar install --no-dev --optimize-autoloader 2>&1', $output, $return_var);

echo "<strong>Çıktı:</strong><br>";
foreach ($output as $line) {
    echo htmlspecialchars($line) . "<br>";
}

if ($return_var === 0) {
    echo "<br><span style='color: green;'>✅ Composer install başarılı!</span><br>";
} else {
    echo "<br><span style='color: red;'>❌ Composer install başarısız!</span><br>";
}
echo "</div>";
echo "<hr>";

// Vendor klasörünü kontrol et
echo "<h2>4. Vendor Klasör Kontrolü</h2>";
if (is_dir('vendor')) {
    echo "<span style='color: green;'>✅ vendor klasörü mevcut</span><br>";
    
    // Vendor klasöründeki dosya sayısını say
    $fileCount = count(glob('vendor/*', GLOB_ONLYDIR));
    echo "Vendor klasöründe $fileCount paket bulundu<br>";
    
    // Autoload dosyasını kontrol et
    if (file_exists('vendor/autoload.php')) {
        echo "<span style='color: green;'>✅ vendor/autoload.php mevcut</span><br>";
    } else {
        echo "<span style='color: red;'>❌ vendor/autoload.php bulunamadı</span><br>";
    }
} else {
    echo "<span style='color: red;'>❌ vendor klasörü bulunamadı</span><br>";
}
echo "<hr>";

// Laravel komutlarını çalıştır
echo "<h2>5. Laravel Komutları</h2>";
echo "<div style='background: #f0f0f0; padding: 10px; border-radius: 5px;'>";

// Config cache
echo "<strong>Config Cache:</strong><br>";
$configOutput = [];
exec('php artisan config:cache 2>&1', $configOutput, $configReturn);
foreach ($configOutput as $line) {
    echo htmlspecialchars($line) . "<br>";
}
echo "<br>";

// Route cache
echo "<strong>Route Cache:</strong><br>";
$routeOutput = [];
exec('php artisan route:cache 2>&1', $routeOutput, $routeReturn);
foreach ($routeOutput as $line) {
    echo htmlspecialchars($line) . "<br>";
}
echo "<br>";

// Migration
echo "<strong>Migration:</strong><br>";
$migrationOutput = [];
exec('php artisan migrate --force 2>&1', $migrationOutput, $migrationReturn);
foreach ($migrationOutput as $line) {
    echo htmlspecialchars($line) . "<br>";
}

echo "</div>";
echo "<hr>";

// İzinleri ayarla
echo "<h2>6. İzinleri Ayarlama</h2>";
if (is_dir('storage')) {
    chmod('storage', 0755);
    echo "<span style='color: green;'>✅ storage klasörü izinleri ayarlandı</span><br>";
}

if (is_dir('bootstrap/cache')) {
    chmod('bootstrap/cache', 0755);
    echo "<span style='color: green;'>✅ bootstrap/cache klasörü izinleri ayarlandı</span><br>";
}

echo "<hr>";

// Sonuç
echo "<h2>7. Sonuç</h2>";
if (file_exists('vendor/autoload.php') && is_dir('vendor')) {
    echo "<span style='color: green; font-size: 18px;'>🎉 Kurulum tamamlandı! Site çalışmaya hazır.</span><br>";
    echo "<a href='/' style='background: #007cba; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin: 10px 0; display: inline-block;'>Ana Siteyi Ziyaret Et</a>";
    echo "<a href='/admin' style='background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin: 10px 0; display: inline-block;'>Admin Paneline Git</a>";
} else {
    echo "<span style='color: red; font-size: 18px;'>❌ Kurulum tamamlanamadı. Lütfen hataları kontrol edin.</span><br>";
}

echo "<hr>";
echo "<p><small>Bu script EvaHome Laravel projesi için hazırlanmıştır. Terminal erişimi olmadan çalışır.</small></p>";
?>
