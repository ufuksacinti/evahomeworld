<?php
echo "<h1>EvaHome Test - 403 Hatası Çözümü</h1>";
echo "<p>Bu sayfa görünüyorsa, PHP çalışıyor!</p>";
echo "<p>PHP Versiyonu: " . phpversion() . "</p>";
echo "<p>Tarih: " . date('Y-m-d H:i:s') . "</p>";

// Dosya kontrolü
echo "<h2>Dosya Kontrolü</h2>";
echo "<p>index.php: " . (file_exists('index.php') ? '✅ Mevcut' : '❌ Yok') . "</p>";
echo "<p>artisan: " . (file_exists('artisan') ? '✅ Mevcut' : '❌ Yok') . "</p>";
echo "<p>.env: " . (file_exists('.env') ? '✅ Mevcut' : '❌ Yok') . "</p>";
echo "<p>.htaccess: " . (file_exists('.htaccess') ? '✅ Mevcut' : '❌ Yok') . "</p>";
echo "<p>vendor klasörü: " . (is_dir('vendor') ? '✅ Mevcut' : '❌ Yok') . "</p>";

// İzin kontrolü
echo "<h2>İzin Kontrolü</h2>";
echo "<p>Mevcut dizin: " . getcwd() . "</p>";
echo "<p>Dizin yazılabilir: " . (is_writable('.') ? '✅ Evet' : '❌ Hayır') . "</p>";

if (file_exists('storage')) {
    echo "<p>Storage yazılabilir: " . (is_writable('storage') ? '✅ Evet' : '❌ Hayır') . "</p>";
}

if (file_exists('bootstrap/cache')) {
    echo "<p>Bootstrap/cache yazılabilir: " . (is_writable('bootstrap/cache') ? '✅ Evet' : '❌ Hayır') . "</p>";
}

// .htaccess içeriğini göster
echo "<h2>.htaccess İçeriği</h2>";
if (file_exists('.htaccess')) {
    echo "<pre style='background: #f0f0f0; padding: 10px; border-radius: 5px;'>";
    echo htmlspecialchars(file_get_contents('.htaccess'));
    echo "</pre>";
} else {
    echo "<p style='color: red;'>❌ .htaccess dosyası bulunamadı!</p>";
}

echo "<hr>";
echo "<p><a href='/' style='background: #007cba; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Ana Sayfayı Test Et</a></p>";
?>
