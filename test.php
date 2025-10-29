<?php
echo "<h1>EvaHome Test</h1>";
echo "<p>PHP Versiyonu: " . phpversion() . "</p>";
echo "<p>Sunucu: " . $_SERVER['SERVER_SOFTWARE'] . "</p>";
echo "<p>Tarih: " . date('Y-m-d H:i:s') . "</p>";
echo "<p>Bu sayfa görünüyorsa, sunucu çalışıyor!</p>";

// Dosya kontrolü
echo "<h2>Dosya Kontrolü</h2>";
echo "<p>install.php: " . (file_exists('install.php') ? '✅ Mevcut' : '❌ Yok') . "</p>";
echo "<p>vendor klasörü: " . (is_dir('vendor') ? '✅ Mevcut' : '❌ Yok') . "</p>";
echo "<p>.env dosyası: " . (file_exists('.env') ? '✅ Mevcut' : '❌ Yok') . "</p>";

// Composer install butonu
echo "<h2>Composer Install</h2>";
echo "<form method='post'>";
echo "<button type='submit' name='install' style='background: #007cba; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;'>Composer Install Çalıştır</button>";
echo "</form>";

if (isset($_POST['install'])) {
    echo "<h3>Composer Install Çalıştırılıyor...</h3>";
    
    // Composer.phar indir
    if (!file_exists('composer.phar')) {
        echo "<p>Composer.phar indiriliyor...</p>";
        $composerContent = file_get_contents('https://getcomposer.org/composer.phar');
        if ($composerContent !== false) {
            file_put_contents('composer.phar', $composerContent);
            echo "<p style='color: green;'>✅ composer.phar indirildi</p>";
        }
    }
    
    // Composer install
    echo "<p>Composer install çalıştırılıyor...</p>";
    $output = [];
    $return_var = 0;
    exec('php composer.phar install --no-dev --optimize-autoloader 2>&1', $output, $return_var);
    
    echo "<div style='background: #f0f0f0; padding: 10px; margin: 10px 0;'>";
    echo "<strong>Çıktı:</strong><br>";
    foreach ($output as $line) {
        echo htmlspecialchars($line) . "<br>";
    }
    echo "</div>";
    
    if ($return_var === 0) {
        echo "<p style='color: green; font-size: 18px;'>🎉 Composer install başarılı!</p>";
        echo "<p><a href='/' style='background: #007cba; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Ana Siteye Git</a></p>";
    } else {
        echo "<p style='color: red; font-size: 18px;'>❌ Composer install başarısız!</p>";
    }
}
?>
