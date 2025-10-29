<?php
/**
 * Laravel Application Bootstrap
 * 
 * Bu dosya public_html klasörüne kopyalanmalıdır.
 * Document Root public klasörüne ayarlanamıyorsa bu çözüm kullanılır.
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
