<?php
/**
 * Veritabanı Reset Script
 * 
 * UYARI: Bu script tüm veritabanını siler ve yeniden oluşturur!
 * Sadece bir kez kullanın ve hemen sonra silin!
 * 
 * Kullanım: https://evahomeworld.com/db-reset.php?password=GUVENLI_SIFRE
 */

// Güvenlik: Script'i korumak için şifre belirleyin
$SECURE_PASSWORD = 'EvaHome2024!Reset'; // BURAYI DEĞİŞTİRİN!

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
    <title>Veritabanı Reset</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #e74c3c; }
        .step { margin: 20px 0; padding: 15px; background: #f8f9fa; border-left: 4px solid #007bff; }
        .success { background: #d4edda; border-left-color: #28a745; color: #155724; }
        .error { background: #f8d7da; border-left-color: #dc3545; color: #721c24; }
        .warning { background: #fff3cd; border-left-color: #ffc107; color: #856404; }
        pre { background: #f4f4f4; padding: 10px; border-radius: 4px; overflow-x: auto; }
        button { background: #dc3545; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background: #c82333; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🗄️ Veritabanı Reset İşlemi</h1>
        
        <?php
        try {
            // 1. Tüm tabloları sil
            echo '<div class="step warning">';
            echo '<h3>⏳ Adım 1: Eski tablolar siliniyor...</h3>';
            
            $tables = DB::select('SHOW TABLES');
            $tableName = 'Tables_in_' . DB::connection()->getDatabaseName();
            
            if (count($tables) > 0) {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                foreach ($tables as $table) {
                    $tableName = array_values((array) $table)[0];
                    Schema::dropIfExists($tableName);
                    echo "<p>✓ Tablo silindi: <strong>$tableName</strong></p>";
                }
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                echo '<p class="success">✓ Tüm eski tablolar başarıyla silindi.</p>';
            } else {
                echo '<p>ℹ️ Silinecek tablo bulunamadı.</p>';
            }
            echo '</div>';
            
            // 2. Migration'ları çalıştır
            echo '<div class="step">';
            echo '<h3>⏳ Adım 2: Yeni tablolar oluşturuluyor (migration)...</h3>';
            
            Artisan::call('migrate', ['--force' => true]);
            $migrateOutput = Artisan::output();
            
            echo '<pre>' . htmlspecialchars($migrateOutput) . '</pre>';
            echo '<p class="success">✓ Migration işlemi tamamlandı.</p>';
            echo '</div>';
            
            // 3. Seed'leri çalıştır
            echo '<div class="step">';
            echo '<h3>⏳ Adım 3: Demo veriler yükleniyor (seed)...</h3>';
            
            Artisan::call('db:seed', ['--force' => true]);
            $seedOutput = Artisan::output();
            
            echo '<pre>' . htmlspecialchars($seedOutput) . '</pre>';
            echo '<p class="success">✓ Seed işlemi tamamlandı.</p>';
            echo '</div>';
            
            // 4. Başarı mesajı
            echo '<div class="step success">';
            echo '<h2>✅ İşlem Başarıyla Tamamlandı!</h2>';
            echo '<p><strong>ÖNEMLİ:</strong> Güvenlik için bu dosyayı (db-reset.php) hemen silin!</p>';
            
            // Tabloları listele
            $newTables = DB::select('SHOW TABLES');
            echo '<h3>Oluşturulan Tablolar:</h3><ul>';
            foreach ($newTables as $table) {
                $tableName = array_values((array) $table)[0];
                $count = DB::table($tableName)->count();
                echo "<li><strong>$tableName</strong> ($count kayıt)</li>";
            }
            echo '</ul></div>';
            
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
            <p><code>public/db-reset.php</code> dosyasını FTP veya cPanel File Manager ile silin.</p>
        </div>
    </div>
</body>
</html>

