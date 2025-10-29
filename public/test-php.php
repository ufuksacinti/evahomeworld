<?php
/**
 * Basit PHP Test Dosyası
 * Bu dosya çalışıyorsa PHP ve sunucu yapılandırması çalışıyor demektir.
 */
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP Test</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f0f0f0; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; }
        .success { color: #28a745; font-weight: bold; }
        .error { color: #dc3545; font-weight: bold; }
        pre { background: #f4f4f4; padding: 15px; border-radius: 4px; overflow-x: auto; }
    </style>
</head>
<body>
    <div class="container">
        <h1>✅ PHP Çalışıyor!</h1>
        <p class="success">Eğer bu sayfayı görüyorsanız, PHP ve sunucu yapılandırması çalışıyor demektir.</p>
        
        <h2>📊 PHP Bilgileri</h2>
        <pre><?php
echo "PHP Version: " . PHP_VERSION . "\n";
echo "Server: " . $_SERVER['SERVER_SOFTWARE'] . "\n";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo "Script Path: " . __FILE__ . "\n";
echo "Current Directory: " . __DIR__ . "\n";
?></pre>
        
        <h2>🔍 Dosya Kontrolü</h2>
        <pre><?php
$files = [
    '../vendor/autoload.php' => 'Laravel Vendor',
    '../.env' => 'Environment File',
    '../bootstrap/app.php' => 'Laravel Bootstrap',
    'check-db.php' => 'Database Check Script',
];

foreach ($files as $file => $label) {
    $exists = file_exists($file);
    echo ($exists ? '✅' : '❌') . " $label: " . ($exists ? $file : 'YOK') . "\n";
}
?></pre>
        
        <h2>🔗 Diğer Testler</h2>
        <ul>
            <li><a href="check-db.php">Database Check Script</a></li>
            <li><a href="db-migrate-only.php">Migration Script</a></li>
            <li><a href="../">Ana Dizin</a></li>
        </ul>
    </div>
</body>
</html>

