<?php
/**
 * Index.php Oluşturma Script'i
 * 
 * Bu script public_html/index.php dosyasını otomatik oluşturur.
 * 
 * Kullanım: https://evahomeworld.com/create-index-php.php?password=GUVENLI_SIFRE
 */

// Güvenlik
$SECURE_PASSWORD = 'EvaHome2024Index';

if (!isset($_GET['password']) || $_GET['password'] !== $SECURE_PASSWORD) {
    die('❌ Yetkisiz erişim! Şifre gerekli.');
}

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Index.php Oluştur</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #007bff; }
        .step { margin: 20px 0; padding: 15px; background: #f8f9fa; border-left: 4px solid #007bff; }
        .success { background: #d4edda; border-left-color: #28a745; color: #155724; }
        .error { background: #f8d7da; border-left-color: #dc3545; color: #721c24; }
        .info { background: #d1ecf1; border-left-color: #17a2b8; color: #0c5460; }
        pre { background: #f4f4f4; padding: 10px; border-radius: 4px; overflow-x: auto; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📝 Index.php Oluşturma</h1>
        
        <?php
        $basePath = dirname(__DIR__);
        $indexPhpPath = $basePath . '/index.php';
        $indexPhpContent = <<<'PHP'
<?php
/**
 * Laravel Application Bootstrap
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// Public klasöründeki dosyaları doğrudan servis et
$publicPath = __DIR__ . '/public' . $uri;

if ($uri !== '/' && file_exists($publicPath) && !is_dir($publicPath)) {
    return false; // Apache/Nginx dosyayı doğrudan servis eder
}

// Laravel bootstrap
require_once __DIR__ . '/public/index.php';
PHP;

        echo '<div class="step info">';
        echo '<h3>📂 Dosya Konumu</h3>';
        echo '<p><strong>Hedef Dosya:</strong> <code>' . htmlspecialchars($indexPhpPath) . '</code></p>';
        echo '</div>';
        
        // Dosya oluştur
        if (isset($_GET['create'])) {
            echo '<div class="step">';
            echo '<h3>⏳ Index.php Oluşturuluyor...</h3>';
            
            if (file_put_contents($indexPhpPath, $indexPhpContent)) {
                chmod($indexPhpPath, 0644);
                echo '<p class="success">✓ <code>index.php</code> dosyası başarıyla oluşturuldu!</p>';
                echo '<p><strong>Dosya Yolu:</strong> <code>' . htmlspecialchars($indexPhpPath) . '</code></p>';
                
                // Test et
                if (file_exists($basePath . '/public/index.php')) {
                    echo '<p class="success">✓ <code>public/index.php</code> dosyası mevcut.</p>';
                } else {
                    echo '<p class="error">❌ <code>public/index.php</code> dosyası bulunamadı!</p>';
                }
                
                if (file_exists($basePath . '/vendor/autoload.php')) {
                    echo '<p class="success">✓ <code>vendor/autoload.php</code> dosyası mevcut.</p>';
                } else {
                    echo '<p class="error">❌ <code>vendor/autoload.php</code> dosyası bulunamadı! Composer install çalıştırın.</p>';
                }
                
                echo '<div class="step success">';
                echo '<h3>✅ İşlem Tamamlandı!</h3>';
                echo '<p>Şimdi tarayıcıda şu adresi açın:</p>';
                echo '<p><strong><a href="/" target="_blank">https://evahomeworld.com</a></strong></p>';
                echo '</div>';
            } else {
                echo '<p class="error">❌ Dosya oluşturulamadı! İzin hatası olabilir.</p>';
                echo '<p class="info">ℹ️ cPanel File Manager ile manuel olarak oluşturmanız gerekebilir.</p>';
            }
            echo '</div>';
        } else {
            echo '<div class="step info">';
            echo '<h3>📋 Ne Yapılacak?</h3>';
            echo '<p>Bu script <code>public_html/index.php</code> dosyasını otomatik oluşturacak.</p>';
            echo '<p><strong>Dosya İçeriği:</strong></p>';
            echo '<pre>' . htmlspecialchars($indexPhpContent) . '</pre>';
            echo '</div>';
            
            echo '<div class="step">';
            echo '<h3>🚀 Oluşturmak İçin</h3>';
            echo '<p>Aşağıdaki butona tıklayın:</p>';
            echo '<a href="?password=' . urlencode($SECURE_PASSWORD) . '&create=1" style="display: inline-block; background: #28a745; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px; font-weight: bold;">📝 Index.php Oluştur</a>';
            echo '</div>';
        }
        ?>
        
        <div class="step info">
            <h3>🔒 Güvenlik</h3>
            <p>Bu script'i kullandıktan sonra mutlaka silin!</p>
            <p><code>public/create-index-php.php</code> dosyasını FTP veya cPanel File Manager ile silin.</p>
        </div>
    </div>
</body>
</html>

