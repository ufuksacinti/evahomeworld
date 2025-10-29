<?php
/**
 * Veritabanı Kontrol Script'i
 * 
 * Products tablosunun yapısını kontrol eder ve eksik kolonları gösterir.
 * 
 * Kullanım: https://evahomeworld.com/check-db.php
 */

// Laravel bootstrap
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Veritabanı Kontrol</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #007bff; }
        .step { margin: 20px 0; padding: 15px; background: #f8f9fa; border-left: 4px solid #007bff; }
        .success { background: #d4edda; border-left-color: #28a745; color: #155724; }
        .error { background: #f8d7da; border-left-color: #dc3545; color: #721c24; }
        .warning { background: #fff3cd; border-left-color: #ffc107; color: #856404; }
        .info { background: #d1ecf1; border-left-color: #17a2b8; color: #0c5460; }
        pre { background: #f4f4f4; padding: 10px; border-radius: 4px; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #007bff; color: white; }
        .col-exists { color: #28a745; font-weight: bold; }
        .col-missing { color: #dc3545; font-weight: bold; }
        button { background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; margin: 10px 5px; }
        button:hover { background: #218838; }
        .sql-box { background: #f8f9fa; padding: 15px; border-radius: 4px; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Veritabanı Kontrol Paneli</h1>
        
        <?php
        try {
            // 1. Products tablosu var mı?
            echo '<div class="step info">';
            echo '<h3>📋 Products Tablosu Kontrolü</h3>';
            
            if (Schema::hasTable('products')) {
                echo '<p class="success">✅ Products tablosu mevcut</p>';
                
                $productCount = DB::table('products')->count();
                echo "<p>Toplam ürün sayısı: <strong>$productCount</strong></p>";
            } else {
                echo '<p class="error">❌ Products tablosu bulunamadı!</p>';
                echo '</div>';
                exit;
            }
            echo '</div>';
            
            // 2. Kolonları kontrol et
            echo '<div class="step">';
            echo '<h3>📊 Products Tablosu Kolonları</h3>';
            
            $columns = DB::select('SHOW COLUMNS FROM products');
            $columnNames = array_column($columns, 'Field');
            
            $requiredColumns = [
                'rating' => 'decimal(3,2) - Ürün puanı (0.00-9.99)',
                'view_count' => 'bigint unsigned - Görüntülenme sayısı',
                'rating_count' => 'bigint unsigned - Puanlama sayısı'
            ];
            
            echo '<table>';
            echo '<tr><th>Kolon Adı</th><th>Durum</th><th>Tip</th></tr>';
            
            $missingColumns = [];
            foreach ($requiredColumns as $colName => $colDesc) {
                $exists = in_array($colName, $columnNames);
                $colData = null;
                if ($exists) {
                    foreach ($columns as $col) {
                        if ($col->Field === $colName) {
                            $colData = $col;
                            break;
                        }
                    }
                }
                
                echo '<tr>';
                echo '<td><strong>' . htmlspecialchars($colName) . '</strong></td>';
                if ($exists) {
                    echo '<td><span class="col-exists">✅ MEVCUT</span></td>';
                    echo '<td>' . htmlspecialchars($colData->Type) . ' (Default: ' . htmlspecialchars($colData->Default ?? 'NULL') . ')</td>';
                } else {
                    echo '<td><span class="col-missing">❌ EKSIK</span></td>';
                    echo '<td>' . htmlspecialchars($colDesc) . '</td>';
                    $missingColumns[] = $colName;
                }
                echo '</tr>';
            }
            echo '</table>';
            echo '</div>';
            
            // 3. Eksik kolonlar için SQL
            if (!empty($missingColumns)) {
                echo '<div class="step warning">';
                echo '<h3>⚠️ Eksik Kolonlar Tespit Edildi!</h3>';
                echo '<p>Aşağıdaki SQL komutlarını phpMyAdmin\'de çalıştırarak eksik kolonları ekleyebilirsiniz:</p>';
                
                echo '<div class="sql-box">';
                echo '<strong>SQL Komutları (phpMyAdmin\'de SQL sekmesinde çalıştırın):</strong><br><br>';
                echo '<pre>';
                
                $sqlCommands = [];
                if (in_array('view_count', $missingColumns)) {
                    $sqlCommands[] = "ALTER TABLE `products` ADD COLUMN `view_count` BIGINT UNSIGNED NOT NULL DEFAULT 0 AFTER `is_active`;";
                }
                if (in_array('rating', $missingColumns)) {
                    $hasViewCount = in_array('view_count', $columnNames);
                    $afterColumn = $hasViewCount ? 'view_count' : 'is_active';
                    $sqlCommands[] = "ALTER TABLE `products` ADD COLUMN `rating` DECIMAL(3,2) NOT NULL DEFAULT 0.00 AFTER `$afterColumn`;";
                }
                if (in_array('rating_count', $missingColumns)) {
                    $sqlCommands[] = "ALTER TABLE `products` ADD COLUMN `rating_count` BIGINT UNSIGNED NOT NULL DEFAULT 0 AFTER `rating`;";
                }
                
                foreach ($sqlCommands as $sql) {
                    echo htmlspecialchars($sql) . "\n";
                }
                
                echo '</pre>';
                echo '</div>';
                
                echo '<p><strong>Yöntem 2:</strong> Migration script\'ini çalıştırın:</p>';
                echo '<p><code>https://evahomeworld.com/db-migrate-only.php?password=EvaHome2024!Migrate</code></p>';
                
                echo '</div>';
            } else {
                echo '<div class="step success">';
                echo '<h3>✅ Tüm Gerekli Kolonlar Mevcut!</h3>';
                echo '<p>Veritabanı yapısı doğru görünüyor. Site çalışmalı.</p>';
                echo '</div>';
            }
            
            // 4. Tüm kolonları listele
            echo '<div class="step info">';
            echo '<h3>📋 Tüm Kolonlar</h3>';
            echo '<table>';
            echo '<tr><th>Kolon Adı</th><th>Tip</th><th>Null</th><th>Default</th></tr>';
            foreach ($columns as $col) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($col->Field) . '</td>';
                echo '<td>' . htmlspecialchars($col->Type) . '</td>';
                echo '<td>' . htmlspecialchars($col->Null) . '</td>';
                echo '<td>' . htmlspecialchars($col->Default ?? 'NULL') . '</td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '</div>';
            
        } catch (\Exception $e) {
            echo '<div class="step error">';
            echo '<h3>❌ Hata Oluştu!</h3>';
            echo '<p><strong>Hata:</strong> ' . htmlspecialchars($e->getMessage()) . '</p>';
            echo '<pre>' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
            echo '</div>';
        }
        ?>
        
        <div class="step info">
            <h3>ℹ️ Bilgi</h3>
            <p>Bu script veritabanı yapısını kontrol eder ve eksik kolonları gösterir.</p>
            <p>Güvenlik için bu dosyayı kullanımdan sonra silebilirsiniz.</p>
        </div>
    </div>
</body>
</html>

