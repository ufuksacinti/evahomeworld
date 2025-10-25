<?php
/**
 * Build Assets Check & Fix
 * http://evahomeworld.com/public/build_assets.php
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h1>🔨 Build Assets Check</h1>";
echo "<pre>";

$basePath = dirname(__DIR__);

echo "Base Path: $basePath\n\n";

// Check if manifest exists
$manifestPath = $basePath . '/public/build/manifest.json';
$buildDir = $basePath . '/public/build';

echo "=== Checking Build Assets ===\n\n";

if (file_exists($manifestPath)) {
    echo "✅ manifest.json EXISTS\n";
    $manifest = json_decode(file_get_contents($manifestPath), true);
    echo "   Files in manifest: " . count($manifest) . "\n\n";
} else {
    echo "❌ manifest.json MISSING!\n";
    echo "Expected: $manifestPath\n\n";
}

// Check build directory
if (is_dir($buildDir)) {
    echo "✅ build/ directory exists\n";
    $files = scandir($buildDir);
    $files = array_filter($files, function($f) { return $f[0] !== '.'; });
    echo "   Files in build/: " . count($files) . "\n";
    
    foreach ($files as $file) {
        $size = filesize($buildDir . '/' . $file);
        echo "   - $file (" . round($size/1024, 2) . " KB)\n";
    }
} else {
    echo "❌ build/ directory MISSING!\n";
    echo "Expected: $buildDir\n\n";
}

// Check if Vite assets exist
echo "\n=== Checking Vite Assets ===\n";
$assetFiles = ['app.css', 'app.js'];

foreach ($assetFiles as $asset) {
    $assetPath = $buildDir . '/assets/' . $asset;
    if (file_exists($assetPath)) {
        $size = filesize($assetPath);
        echo "✅ assets/$asset (" . round($size/1024, 2) . " KB)\n";
    } else {
        echo "❌ assets/$asset MISSING!\n";
    }
}

echo "\n=== SOLUTION ===\n";
echo "Frontend assets need to be built!\n\n";
echo "You need to run on your LOCAL machine:\n";
echo "1. npm install\n";
echo "2. npm run build\n\n";
echo "Then upload the 'public/build' folder to the server.\n";
echo "OR\n";
echo "Run on server (if Node.js is installed):\n";
echo "cd $basePath\n";
echo "npm install\n";
echo "npm run build\n";

echo "\n=== Checking package.json ===\n";
$packageJson = $basePath . '/package.json';
if (file_exists($packageJson)) {
    echo "✅ package.json exists\n";
} else {
    echo "❌ package.json MISSING!\n";
}

echo "\n=== Checking node_modules ===\n";
$nodeModules = $basePath . '/node_modules';
if (is_dir($nodeModules)) {
    echo "✅ node_modules exists\n";
} else {
    echo "❌ node_modules MISSING!\n";
    echo "Run: npm install\n";
}

echo "</pre>";
?>
