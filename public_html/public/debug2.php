<?php
/**
 * Detailed Debug Script
 * http://evahomeworld.com/public/debug2.php
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>🔍 Detailed Debug Test</h1>";
echo "<pre>";

$basePath = dirname(__DIR__);

echo "Base Path: $basePath\n\n";

// 1. Bootstrap
require $basePath . '/vendor/autoload.php';

if (!defined('LARAVEL_START')) {
    define('LARAVEL_START', microtime(true));
}

try {
    $app = require $basePath . '/bootstrap/app.php';
    echo "✅ Laravel bootstrap başarılı!\n\n";
    
    // 2. Try to get the home route
    echo "=== Testing Home Route ===\n\n";
    
    $request = Illuminate\Http\Request::create('/', 'GET');
    
    // Capture all output
    ob_start();
    $response = $app->handle($request);
    $output = ob_get_clean();
    
    echo "Response Status: " . $response->getStatusCode() . "\n";
    
    if ($response->getStatusCode() >= 500) {
        echo "\n❌ 500 ERROR DETAILS:\n";
        echo "=====================\n\n";
        
        // Get response content
        $content = $response->getContent();
        
        if (empty($content)) {
            echo "Response is EMPTY!\n";
            echo "\nThis usually means:\n";
            echo "1. View file is missing (resources/views/home.blade.php)\n";
            echo "2. Controller threw an exception\n";
            echo "3. Database query failed\n\n";
            
            // Check if view exists
            $viewPath = $basePath . '/resources/views/home.blade.php';
            if (file_exists($viewPath)) {
                echo "✅ home.blade.php EXISTS\n";
            } else {
                echo "❌ home.blade.php MISSING!\n";
                echo "Expected: $viewPath\n";
            }
        } else {
            echo "Response Content (first 3000 chars):\n";
            echo substr($content, 0, 3000) . "\n";
        }
        
        // Try to get exception details
        echo "\n=== Checking Laravel Log ===\n";
        $logPath = $basePath . '/storage/logs/laravel.log';
        
        if (file_exists($logPath)) {
            echo "✅ Log file exists\n";
            $logContent = file_get_contents($logPath);
            $logLines = explode("\n", $logContent);
            
            // Get last 50 lines
            $lastLines = array_slice($logLines, -50);
            
            echo "\nLast 50 lines from log:\n";
            echo implode("\n", $lastLines);
        } else {
            echo "❌ Log file does not exist\n";
            echo "Expected: $logPath\n";
        }
        
    } else {
        echo "✅ Route başarılı!\n";
        echo "Content length: " . strlen($response->getContent()) . " bytes\n";
    }
    
    echo "\n\n=== Output Captured ===\n";
    if (!empty($output)) {
        echo $output;
    } else {
        echo "(No output captured)\n";
    }
    
} catch (Throwable $e) {
    echo "\n❌ EXCEPTION CAUGHT:\n";
    echo "=====================\n";
    echo "Message: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n\n";
    
    echo "Stack Trace:\n";
    echo $e->getTraceAsString() . "\n";
}

echo "</pre>";
?>
