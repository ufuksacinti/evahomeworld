<?php
/**
 * Server Setup Script - Composer, Cache, Assets, Config
 * 
 * Kullanım: https://evahomeworld.com/server-setup.php?password=GUVENLI_SIFRE
 * 
 * ÖNEMLİ: Bu script'i kullandıktan sonra mutlaka silin!
 */

// Güvenlik: Şifre belirleyin
// Şifre: EvaHome2024Setup
$SECURE_PASSWORD = 'EvaHome2024Setup';

// Şifre kontrolü
if (!isset($_GET['password']) || $_GET['password'] !== $SECURE_PASSWORD) {
    die('❌ Yetkisiz erişim! Şifre gerekli.');
}

// Timeout ayarla (uzun sürebilir)
set_time_limit(600); // 10 dakika

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Server Setup</title>
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
        button { background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; margin: 5px; }
        button:hover { background: #0056b3; }
        a { text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h1>⚙️ Server Setup - Composer, Cache, Assets, Config</h1>
        
        <?php
        $basePath = dirname(__DIR__);
        chdir($basePath);
        
        echo '<div class="step info">';
        echo '<h3>📂 Proje Bilgileri</h3>';
        echo '<p><strong>Klasör:</strong> ' . htmlspecialchars($basePath) . '</p>';
        echo '<p><strong>PHP Versiyonu:</strong> ' . PHP_VERSION . '</p>';
        echo '</div>';
        
        // İşlem seçimi
        $action = $_GET['action'] ?? 'all';
        
        // Composer Install
        if ($action === 'all' || $action === 'composer') {
            echo '<div class="step">';
            echo '<h3>📦 1. Composer Install</h3>';
            
            // Composer path kontrolü ve otomatik indirme
            $composerPath = '';
            $composerPharPath = $basePath . '/composer.phar';
            
            // Önce mevcut composer.phar'ı kontrol et
            if (file_exists($composerPharPath)) {
                $composerPath = 'php composer.phar';
                echo '<p class="success">✓ composer.phar bulundu!</p>';
            } elseif (file_exists('/usr/local/bin/composer')) {
                $composerPath = '/usr/local/bin/composer';
                echo '<p class="success">✓ Sistem composer bulundu!</p>';
            } elseif (file_exists('/usr/bin/composer')) {
                $composerPath = '/usr/bin/composer';
                echo '<p class="success">✓ Sistem composer bulundu!</p>';
            } else {
                // Composer.phar yoksa indirmeyi dene
                echo '<p class="warning">⚠️ composer.phar bulunamadı. İndiriliyor...</p>';
                
                // Composer.phar'ı indir
                $composerUrl = 'https://getcomposer.org/composer-stable.phar';
                $composerContent = @file_get_contents($composerUrl);
                
                if ($composerContent !== false && file_put_contents($composerPharPath, $composerContent)) {
                    chmod($composerPharPath, 0755);
                    $composerPath = 'php composer.phar';
                    echo '<p class="success">✓ composer.phar başarıyla indirildi!</p>';
                } else {
                    echo '<p class="error">❌ composer.phar indirilemedi. Manuel olarak indirmeniz gerekiyor.</p>';
                    echo '<p class="info">📥 <strong>Manuel İndirme:</strong></p>';
                    echo '<ol>';
                    echo '<li>Tarayıcınızda şu adresi açın: <code>https://getcomposer.org/composer.phar</code></li>';
                    echo '<li>İndirilen dosyayı <code>' . htmlspecialchars($composerPharPath) . '</code> konumuna yükleyin</li>';
                    echo '<li>cPanel File Manager ile dosyayı yükleyin ve script\'i tekrar çalıştırın</li>';
                    echo '</ol>';
                    echo '</div>'; // step div'ini kapat
                    goto skip_composer_install; // Composer install'ı atla
                }
            }
            
            echo '<div class="command">' . htmlspecialchars($composerPath) . ' install --no-dev --optimize-autoloader</div>';
            echo '<p>⏳ Composer bağımlılıkları yükleniyor... Bu işlem 2-5 dakika sürebilir.</p>';
            
            // COMPOSER_HOME environment variable ayarla (eğer yoksa)
            $homeDir = $_SERVER['HOME'] ?? '/tmp';
            $composerHome = $basePath . '/.composer';
            if (!is_dir($composerHome)) {
                @mkdir($composerHome, 0755, true);
            }
            
            $output = [];
            $return_var = 0;
            // COMPOSER_HOME ve HOME environment variable'larını ayarla
            $command = 'cd ' . escapeshellarg($basePath) . ' && HOME=' . escapeshellarg($homeDir) . ' COMPOSER_HOME=' . escapeshellarg($composerHome) . ' ' . $composerPath . ' install --no-dev --optimize-autoloader 2>&1';
            
            exec($command, $output, $return_var);
            
            echo '<pre>';
            if (!empty($output)) {
                $displayOutput = array_slice($output, -50); // Son 50 satır
                echo htmlspecialchars(implode("\n", $displayOutput));
                if (count($output) > 50) {
                    echo "\n... (toplam " . count($output) . " satır, son 50 gösteriliyor)";
                }
            } else {
                echo '(Çıktı yok)';
            }
            echo '</pre>';
            
            if ($return_var === 0) {
                echo '<p class="success">✓ Composer install başarılı!</p>';
            } else {
                echo '<p class="error">❌ Composer install hatası! Çıkış kodu: ' . $return_var . '</p>';
                $outputString = implode("\n", $output);
                if (strpos($outputString, 'command not found') !== false) {
                    echo '<p class="warning">⚠️ Composer komutu bulunamadı. composer.phar dosyasını manuel olarak indirmeniz gerekiyor.</p>';
                } elseif (strpos($outputString, 'HOME or COMPOSER_HOME') !== false || strpos($outputString, 'environment variable') !== false) {
                    echo '<p class="warning">⚠️ Composer HOME environment variable hatası. Script güncellendi, lütfen tekrar deneyin.</p>';
                }
            }
            echo '</div>';
            
            skip_composer_install:
        }
        
        // Laravel Cache Temizleme (Artisan kullan)
        if ($action === 'all' || $action === 'cache') {
            echo '<div class="step">';
            echo '<h3>🧹 2. Laravel Cache Temizleme</h3>';
            
            // Laravel bootstrap (eğer vendor mevcut ise)
            if (file_exists($basePath . '/vendor/autoload.php')) {
                require $basePath . '/vendor/autoload.php';
                $app = require_once $basePath . '/bootstrap/app.php';
                $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
                
                $cacheCommands = [
                    'Config Cache Temizle' => 'config:clear',
                    'Route Cache Temizle' => 'route:clear',
                    'View Cache Temizle' => 'view:clear',
                    'Application Cache Temizle' => 'cache:clear',
                    'Optimize Clear' => 'optimize:clear',
                ];
                
                foreach ($cacheCommands as $stepName => $command) {
                    echo '<div style="margin: 10px 0; padding: 10px; background: #fff; border-radius: 4px;">';
                    echo '<strong>' . htmlspecialchars($stepName) . ':</strong><br>';
                    echo '<div class="command">php artisan ' . htmlspecialchars($command) . '</div>';
                    
                    try {
                        \Illuminate\Support\Facades\Artisan::call($command);
                        $artisanOutput = \Illuminate\Support\Facades\Artisan::output();
                        
                        echo '<pre style="max-height: 100px;">';
                        echo htmlspecialchars($artisanOutput ?: '(Başarılı)');
                        echo '</pre>';
                        echo '<span style="color: #28a745;">✓</span>';
                    } catch (\Exception $e) {
                        $errorMsg = $e->getMessage();
                        echo '<pre style="max-height: 100px;">';
                        echo htmlspecialchars($errorMsg);
                        echo '</pre>';
                        
                        // SQLite hatasını kontrol et (kritik değil)
                        if (strpos($errorMsg, 'database.sqlite') !== false || strpos($errorMsg, 'sqlite') !== false) {
                            echo '<span style="color: #ffc107;">⚠️ SQLite cache hatası (önemli değil, cache file driver kullanılıyor)</span>';
                        } else {
                            echo '<span style="color: #dc3545;">⚠️ Hata</span>';
                        }
                    }
                    echo '</div>';
                }
                
                echo '<p class="success">✓ Cache temizleme işlemi tamamlandı!</p>';
            } else {
                echo '<p class="warning">⚠️ Laravel vendor klasörü bulunamadı. Önce Composer install çalıştırmanız gerekiyor.</p>';
            }
            echo '</div>';
        }
        
        // Assets Build (NPM)
        if ($action === 'all' || $action === 'assets') {
            echo '<div class="step">';
            echo '<h3>🎨 3. Assets Build (NPM)</h3>';
            
            // NPM kontrolü
            $npmPath = '';
            if (file_exists('/usr/local/bin/npm')) {
                $npmPath = '/usr/local/bin/npm';
            } elseif (file_exists('/usr/bin/npm')) {
                $npmPath = '/usr/bin/npm';
            } else {
                $npmPath = 'npm';
            }
            
            // NPM Install
            echo '<div style="margin: 10px 0; padding: 10px; background: #fff; border-radius: 4px;">';
            echo '<strong>NPM Install:</strong><br>';
            echo '<div class="command">' . htmlspecialchars($npmPath) . ' install</div>';
            
            $output = [];
            $return_var = 0;
            
            exec($npmPath . ' install 2>&1', $output, $return_var);
            
            echo '<pre style="max-height: 200px;">';
            if (!empty($output)) {
                $displayOutput = array_slice($output, -30);
                echo htmlspecialchars(implode("\n", $displayOutput));
                if (count($output) > 30) {
                    echo "\n... (toplam " . count($output) . " satır)";
                }
            } else {
                echo '(Çıktı yok)';
            }
            echo '</pre>';
            
            if ($return_var === 0) {
                echo '<span style="color: #28a745;">✓ NPM Install başarılı!</span>';
            } else {
                echo '<span style="color: #dc3545;">⚠️ NPM Install hatası! Çıkış kodu: ' . $return_var . '</span>';
                echo '<p class="warning">⚠️ NPM kurulu olmayabilir. Bu durumda assets build yapılamayacak.</p>';
            }
            echo '</div>';
            
            // NPM Build
            if ($return_var === 0 || file_exists($basePath . '/node_modules')) {
                echo '<div style="margin: 10px 0; padding: 10px; background: #fff; border-radius: 4px;">';
                echo '<strong>NPM Build:</strong><br>';
                echo '<div class="command">' . htmlspecialchars($npmPath) . ' run build</div>';
                
                $output = [];
                $return_var = 0;
                
                exec($npmPath . ' run build 2>&1', $output, $return_var);
                
                echo '<pre style="max-height: 200px;">';
                if (!empty($output)) {
                    $displayOutput = array_slice($output, -30);
                    echo htmlspecialchars(implode("\n", $displayOutput));
                    if (count($output) > 30) {
                        echo "\n... (toplam " . count($output) . " satır)";
                    }
                } else {
                    echo '(Çıktı yok)';
                }
                echo '</pre>';
                
                if ($return_var === 0) {
                    echo '<span style="color: #28a745;">✓ NPM Build başarılı!</span>';
                } else {
                    echo '<span style="color: #dc3545;">⚠️ NPM Build hatası! Çıkış kodu: ' . $return_var . '</span>';
                }
                echo '</div>';
            }
            
            echo '</div>';
        }
        
        // Config Cache (Artisan kullan)
        if ($action === 'all' || $action === 'config') {
            echo '<div class="step">';
            echo '<h3>⚡ 4. Laravel Config Cache</h3>';
            
            // Laravel bootstrap (eğer vendor mevcut ise)
            if (file_exists($basePath . '/vendor/autoload.php')) {
                if (!class_exists('Illuminate\Support\Facades\Artisan')) {
                    require $basePath . '/vendor/autoload.php';
                    $app = require_once $basePath . '/bootstrap/app.php';
                    $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
                }
                
                $configCommands = [
                    'Config Cache' => 'config:cache',
                    'Route Cache' => 'route:cache',
                    'View Cache' => 'view:cache',
                ];
                
                foreach ($configCommands as $stepName => $command) {
                    echo '<div style="margin: 10px 0; padding: 10px; background: #fff; border-radius: 4px;">';
                    echo '<strong>' . htmlspecialchars($stepName) . ':</strong><br>';
                    echo '<div class="command">php artisan ' . htmlspecialchars($command) . '</div>';
                    
                    try {
                        \Illuminate\Support\Facades\Artisan::call($command);
                        $artisanOutput = \Illuminate\Support\Facades\Artisan::output();
                        
                        echo '<pre style="max-height: 100px;">';
                        echo htmlspecialchars($artisanOutput ?: '(Başarılı)');
                        echo '</pre>';
                        echo '<span style="color: #28a745;">✓</span>';
                    } catch (\Exception $e) {
                        $errorMsg = $e->getMessage();
                        echo '<pre style="max-height: 100px;">';
                        echo htmlspecialchars($errorMsg);
                        echo '</pre>';
                        
                        // SQLite hatasını kontrol et (kritik değil)
                        if (strpos($errorMsg, 'database.sqlite') !== false || strpos($errorMsg, 'sqlite') !== false) {
                            echo '<span style="color: #ffc107;">⚠️ SQLite cache hatası (önemli değil, cache file driver kullanılıyor)</span>';
                        } else {
                            echo '<span style="color: #dc3545;">⚠️ Hata</span>';
                        }
                    }
                    echo '</div>';
                }
                
                echo '<p class="success">✓ Config cache işlemi tamamlandı!</p>';
            } else {
                echo '<p class="warning">⚠️ Laravel vendor klasörü bulunamadı. Önce Composer install çalıştırmanız gerekiyor.</p>';
            }
            echo '</div>';
        }
        
        // Özet
        if ($action === 'all') {
            echo '<div class="step success">';
            echo '<h3>✅ Tüm İşlemler Tamamlandı!</h3>';
            echo '<ul>';
            echo '<li>✓ Composer bağımlılıkları yüklendi (veya denendi)</li>';
            echo '<li>✓ Cache temizlendi (eğer vendor mevcut ise)</li>';
            echo '<li>✓ Assets build edildi (eğer NPM mevcut ise)</li>';
            echo '<li>✓ Config cache oluşturuldu (eğer vendor mevcut ise)</li>';
            echo '</ul>';
            echo '</div>';
        }
        ?>
        
        <div class="step info">
            <h3>🎯 İşlem Seçimi</h3>
            <p>Tek tek çalıştırmak için:</p>
            <a href="?password=<?= urlencode($SECURE_PASSWORD) ?>&action=composer"><button>📦 Sadece Composer</button></a>
            <a href="?password=<?= urlencode($SECURE_PASSWORD) ?>&action=cache"><button>🧹 Sadece Cache Temizle</button></a>
            <a href="?password=<?= urlencode($SECURE_PASSWORD) ?>&action=assets"><button>🎨 Sadece Assets Build</button></a>
            <a href="?password=<?= urlencode($SECURE_PASSWORD) ?>&action=config"><button>⚡ Sadece Config Cache</button></a>
            <a href="?password=<?= urlencode($SECURE_PASSWORD) ?>&action=all"><button>🔄 Tümünü Çalıştır</button></a>
        </div>
        
        <div class="step warning">
            <h3>🔒 Güvenlik</h3>
            <p>Bu script'i kullandıktan sonra mutlaka silin!</p>
            <p><code>public/server-setup.php</code> dosyasını FTP veya cPanel File Manager ile silin.</p>
        </div>
    </div>
</body>
</html>

