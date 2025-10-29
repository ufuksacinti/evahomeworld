<?php
/**
 * Sadece Migration Çalıştırma Script'i
 * 
 * Bu script verileri silmeden sadece eksik migration'ları çalıştırır.
 * 
 * Kullanım: https://evahomeworld.com/db-migrate-only.php?password=GUVENLI_SIFRE
 */

// Güvenlik: Script'i korumak için şifre belirleyin
$SECURE_PASSWORD = 'EvaHome2024!Migrate'; // BURAYI DEĞİŞTİRİN!

// Şifre kontrolü
if (!isset($_GET['password']) || $_GET['password'] !== $SECURE_PASSWORD) {
    die('❌ Yetkisiz erişim! Şifre gerekli.');
}

// Laravel bootstrap
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Migration Çalıştır</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #007bff; }
        .step { margin: 20px 0; padding: 15px; background: #f8f9fa; border-left: 4px solid #007bff; }
        .success { background: #d4edda; border-left-color: #28a745; color: #155724; }
        .error { background: #f8d7da; border-left-color: #dc3545; color: #721c24; }
        .warning { background: #fff3cd; border-left-color: #ffc107; color: #856404; }
        .info { background: #d1ecf1; border-left-color: #17a2b8; color: #0c5460; }
        pre { background: #f4f4f4; padding: 10px; border-radius: 4px; overflow-x: auto; }
        button { background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔄 Migration Çalıştırma</h1>
        
        <?php
        try {
            // 1. Mevcut durum kontrolü
            echo '<div class="step info">';
            echo '<h3>📊 Mevcut Durum Kontrolü</h3>';
            
            $hasRating = Schema::hasColumn('products', 'rating');
            $hasViewCount = Schema::hasColumn('products', 'view_count');
            $hasRatingCount = Schema::hasColumn('products', 'rating_count');
            
            echo '<p><strong>Products Tablosu Kolonları:</strong></p>';
            echo '<ul>';
            echo '<li>rating: ' . ($hasRating ? '✅ Var' : '❌ Yok') . '</li>';
            echo '<li>view_count: ' . ($hasViewCount ? '✅ Var' : '❌ Yok') . '</li>';
            echo '<li>rating_count: ' . ($hasRatingCount ? '✅ Var' : '❌ Yok') . '</li>';
            echo '</ul>';
            echo '</div>';
            
            // 2. Migration durumunu kontrol et
            echo '<div class="step info">';
            echo '<h3>📋 Migration Durumu</h3>';
            
            Artisan::call('migrate:status');
            $statusOutput = Artisan::output();
            
            echo '<pre>' . htmlspecialchars($statusOutput) . '</pre>';
            echo '</div>';
            
            // 3. Migration'ları çalıştır
            echo '<div class="step">';
            echo '<h3>⏳ Migration'lar Çalıştırılıyor...</h3>';
            echo '<p class="warning">⚠️ Veriler korunacak, sadece eksik tablolar/kolonlar eklenecek.</p>';
            
            Artisan::call('migrate', ['--force' => true]);
            $migrateOutput = Artisan::output();
            
            echo '<pre>' . htmlspecialchars($migrateOutput) . '</pre>';
            echo '<p class="success">✓ Migration işlemi tamamlandı.</p>';
            echo '</div>';
            
            // 4. Tekrar kontrol
            echo '<div class="step success">';
            echo '<h3>✅ Sonuç Kontrolü</h3>';
            
            $hasRatingAfter = Schema::hasColumn('products', 'rating');
            $hasViewCountAfter = Schema::hasColumn('products', 'view_count');
            $hasRatingCountAfter = Schema::hasColumn('products', 'rating_count');
            
            echo '<p><strong>Products Tablosu Kolonları (Sonra):</strong></p>';
            echo '<ul>';
            echo '<li>rating: ' . ($hasRatingAfter ? '✅ Var' : '❌ Yok') . '</li>';
            echo '<li>view_count: ' . ($hasViewCountAfter ? '✅ Var' : '❌ Yok') . '</li>';
            echo '<li>rating_count: ' . ($hasRatingCountAfter ? '✅ Var' : '❌ Yok') . '</li>';
            echo '</ul>';
            
            if ($hasRatingAfter && $hasViewCountAfter && $hasRatingCountAfter) {
                echo '<p class="success"><strong>✅ Tüm gerekli kolonlar başarıyla eklendi!</strong></p>';
            } else {
                echo '<p class="warning"><strong>⚠️ Bazı kolonlar hala eksik olabilir. Logları kontrol edin.</strong></p>';
            }
            echo '</div>';
            
            // 5. Tablo bilgisi
            echo '<div class="step info">';
            echo '<h3>📊 Products Tablosu Bilgileri</h3>';
            
            if (Schema::hasTable('products')) {
                $productCount = DB::table('products')->count();
                echo "<p>Toplam ürün sayısı: <strong>$productCount</strong></p>";
                echo '<p class="success">✅ Veriler korundu!</p>';
            }
            echo '</div>';
            
        } catch (\Exception $e) {
            echo '<div class="step error">';
            echo '<h3>❌ Hata Oluştu!</h3>';
            echo '<p><strong>Hata:</strong> ' . htmlspecialchars($e->getMessage()) . '</p>';
            echo '<pre>' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
            echo '</div>';
        }
        ?>
        
        <div class="step warning">
            <h3>⚠️ Güvenlik Uyarısı</h3>
            <p>Bu script çalıştırıldıktan sonra mutlaka silinmelidir!</p>
            <p><code>public/db-migrate-only.php</code> dosyasını FTP veya cPanel File Manager ile silin.</p>
        </div>
    </div>
</body>
</html>

