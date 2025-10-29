<?php
/**
 * Git Pull Script - Sunucuda Git Repository'yi Güncelleme
 * 
 * Kullanım: https://evahomeworld.com/git-pull.php?password=GUVENLI_SIFRE
 * 
 * ÖNEMLİ: Bu script'i kullandıktan sonra mutlaka silin!
 */

// Güvenlik: Şifre belirleyin (veritabanı şifresi ile güçlendirildi)
$SECURE_PASSWORD = 'EvaHome2024!Pull_B)G18T$1S+yg';

// Şifre kontrolü
if (!isset($_GET['password']) || $_GET['password'] !== $SECURE_PASSWORD) {
    die('❌ Yetkisiz erişim! Şifre gerekli.');
}

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Git Pull</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .container { max-width: 900px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #007bff; }
        .step { margin: 20px 0; padding: 15px; background: #f8f9fa; border-left: 4px solid #007bff; }
        .success { background: #d4edda; border-left-color: #28a745; color: #155724; }
        .error { background: #f8d7da; border-left-color: #dc3545; color: #721c24; }
        .warning { background: #fff3cd; border-left-color: #ffc107; color: #856404; }
        .info { background: #d1ecf1; border-left-color: #17a2b8; color: #0c5460; }
        pre { background: #f4f4f4; padding: 10px; border-radius: 4px; overflow-x: auto; max-height: 400px; overflow-y: auto; }
        .command { background: #2d3748; color: #68d391; padding: 10px; border-radius: 4px; font-family: monospace; margin: 5px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔄 Git Pull - Sunucu Güncelleme</h1>
        
        <?php
        $basePath = dirname(__DIR__);
        $gitPath = $basePath;
        
        // Proje kök dizini kontrolü
        if (!is_dir($gitPath . '/.git')) {
            echo '<div class="step error">';
            echo '<h3>❌ Git Repository Bulunamadı!</h3>';
            echo '<p>Proje klasöründe .git klasörü yok. Git repository ayarlarınızı kontrol edin.</p>';
            echo '<p><strong>Klasör:</strong> ' . htmlspecialchars($gitPath) . '</p>';
            echo '</div>';
            exit;
        }
        
        echo '<div class="step info">';
        echo '<h3>📂 Repository Bilgileri</h3>';
        echo '<p><strong>Klasör:</strong> ' . htmlspecialchars($gitPath) . '</p>';
        echo '</div>';
        
        // Git komutlarını çalıştır
        $commands = [
            'Mevcut Durum' => 'git status',
            'Remote Bilgisi' => 'git remote -v',
            'Branch Bilgisi' => 'git branch',
            'Fetch' => 'git fetch origin',
            'Reset' => 'git reset --hard origin/ufuk',
            'Clean' => 'git clean -fd',
            'Son Durum' => 'git status',
            'Son 5 Commit' => 'git log --oneline -5',
        ];
        
        $allOutput = [];
        
        foreach ($commands as $stepName => $command) {
            echo '<div class="step">';
            echo '<h3>⏳ ' . htmlspecialchars($stepName) . '</h3>';
            echo '<div class="command">' . htmlspecialchars($command) . '</div>';
            
            $output = [];
            $return_var = 0;
            
            chdir($gitPath);
            exec($command . ' 2>&1', $output, $return_var);
            
            $allOutput[$stepName] = [
                'command' => $command,
                'output' => $output,
                'return' => $return_var
            ];
            
            echo '<pre>';
            if (!empty($output)) {
                echo htmlspecialchars(implode("\n", $output));
            } else {
                echo '(Çıktı yok)';
            }
            echo '</pre>';
            
            if ($return_var !== 0 && $stepName !== 'Clean') {
                echo '<p class="warning">⚠️ Komut çıkış kodu: ' . $return_var . '</p>';
            } else {
                echo '<p class="success">✓ Tamamlandı</p>';
            }
            
            echo '</div>';
        }
        
        // Özet
        echo '<div class="step success">';
        echo '<h3>✅ İşlem Tamamlandı!</h3>';
        echo '<p>Sunucu GitHub'daki <strong>ufuk</strong> branch'i ile eşitlendi.</p>';
        echo '<p><strong>Son Commit:</strong></p>';
        echo '<pre>';
        if (isset($allOutput['Son 5 Commit']['output'])) {
            echo htmlspecialchars(implode("\n", array_slice($allOutput['Son 5 Commit']['output'], 0, 1)));
        }
        echo '</pre>';
        echo '</div>';
        
        // Önemli uyarılar
        echo '<div class="step warning">';
        echo '<h3>⚠️ ÖNEMLİ UYARILAR</h3>';
        echo '<ul>';
        echo '<li><strong>.env dosyası:</strong> Git pull .env dosyasını etkilemez (gitignore\'da)</li>';
        echo '<li><strong>vendor klasörü:</strong> Composer install yapmanız gerekebilir</li>';
        echo '<li><strong>Cache:</strong> Config ve cache\'leri temizlemeniz gerekebilir</li>';
        echo '<li><strong>İzinler:</strong> storage ve bootstrap/cache klasörlerinin yazma izni olmalı</li>';
        echo '</ul>';
        echo '</div>';
        ?>
        
        <div class="step warning">
            <h3>🔒 Güvenlik</h3>
            <p>Bu script'i kullandıktan sonra mutlaka silin!</p>
            <p><code>public/git-pull.php</code> dosyasını FTP veya cPanel File Manager ile silin.</p>
        </div>
    </div>
</body>
</html>

