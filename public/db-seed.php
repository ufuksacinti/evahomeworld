<?php
/**
 * Veritabanı Seeder Script'i
 * 
 * Bu script veritabanına demo verilerini yükler.
 * 
 * Kullanım: https://evahomeworld.com/db-seed.php?password=GUVENLI_SIFRE
 */

// Güvenlik: Script'i korumak için şifre belirleyin
$SECURE_PASSWORD = 'EvaHome2024!Seed'; // BURAYI DEĞİŞTİRİN!

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
    <title>Veritabanı Seeder</title>
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
        button { background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; margin: 10px 5px; }
        button:hover { background: #218838; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🌱 Veritabanı Seeder</h1>
        
        <?php
        try {
            // 1. Mevcut durum kontrolü
            echo '<div class="step info">';
            echo '<h3>📊 Mevcut Durum</h3>';
            
            $tables = [
                'users' => 'Kullanıcılar',
                'translations' => 'Çeviriler',
                'energy_collections' => 'Enerji Koleksiyonları',
                'categories' => 'Kategoriler',
                'products' => 'Ürünler',
            ];
            
            echo '<ul>';
            foreach ($tables as $table => $label) {
                if (Schema::hasTable($table)) {
                    $count = DB::table($table)->count();
                    echo "<li><strong>$label:</strong> $count kayıt</li>";
                } else {
                    echo "<li><strong>$label:</strong> ❌ Tablo yok</li>";
                }
            }
            echo '</ul>';
            echo '</div>';
            
            // 2. Seeder'ları çalıştır
            echo '<div class="step">';
            echo '<h3>⏳ Veriler yükleniyor...</h3>';
            echo '<p class="warning">⚠️ Bu işlem birkaç dakika sürebilir.</p>';
            
            // DatabaseSeeder çalıştır (tüm seeder'ları - admin de dahil)
            echo '<p><strong>Adım 1:</strong> Tüm veriler yükleniyor (admin users, translations, collections, categories, products)...</p>';
            echo '<p class="info">ℹ️ Eğer kayıtlar zaten varsa güncellenecek, yoksa oluşturulacak.</p>';
            
            Artisan::call('db:seed', ['--force' => true]);
            $seedOutput = Artisan::output();
            
            echo '<pre>' . htmlspecialchars($seedOutput) . '</pre>';
            echo '<p class="success">✓ Seeder işlemi tamamlandı.</p>';
            echo '</div>';
            
            // 3. Sonuç kontrolü
            echo '<div class="step success">';
            echo '<h3>✅ İşlem Tamamlandı!</h3>';
            
            echo '<p><strong>Yüklenen Veriler:</strong></p>';
            echo '<ul>';
            foreach ($tables as $table => $label) {
                if (Schema::hasTable($table)) {
                    $count = DB::table($table)->count();
                    echo "<li><strong>$label:</strong> $count kayıt</li>";
                }
            }
            echo '</ul>';
            
            // Admin giriş bilgileri
            $admin = DB::table('users')->where('role', 'admin')->first();
            if ($admin) {
                echo '<div class="warning">';
                echo '<h3>🔐 Admin Giriş Bilgileri</h3>';
                echo '<p><strong>Email:</strong> ' . htmlspecialchars($admin->email) . '</p>';
                echo '<p><strong>Şifre:</strong> password</p>';
                echo '<p><strong>Admin Panel:</strong> <a href="/admin" target="_blank">/admin</a></p>';
                echo '</div>';
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
            <p><code>public/db-seed.php</code> dosyasını FTP veya cPanel File Manager ile silin.</p>
        </div>
    </div>
</body>
</html>

