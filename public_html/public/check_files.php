<?php
/**
 * Check Critical Files
 * http://evahomeworld.com/public/check_files.php
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h1>📁 Critical Files Check</h1>";
echo "<pre>";

$basePath = dirname(__DIR__);

echo "Base Path: $basePath\n\n";

$criticalFiles = [
    '.env',
    'vendor/autoload.php',
    'bootstrap/app.php',
    'resources/views/home.blade.php',
    'app/Http/Controllers/HomeController.php',
    'app/Services/CacheService.php',
    'resources/views/layouts/app.blade.php',
    'public/build/assets/app.css',
    'public/build/assets/app.js',
];

echo "=== Checking Files ===\n\n";

$missing = [];
$exists = [];

foreach ($criticalFiles as $file) {
    $fullPath = $basePath . '/' . $file;
    if (file_exists($fullPath)) {
        $size = filesize($fullPath);
        echo "✅ $file ($size bytes)\n";
        $exists[] = $file;
    } else {
        echo "❌ $file (MISSING!)\n";
        $missing[] = $file;
    }
}

echo "\n=== Summary ===\n";
echo "Found: " . count($exists) . " files\n";
echo "Missing: " . count($missing) . " files\n";

if (count($missing) > 0) {
    echo "\n⚠️  Missing Files:\n";
    foreach ($missing as $file) {
        echo "   - $file\n";
    }
    echo "\n❗ This is why you're getting a 500 error!\n";
    echo "Upload the missing files via GitHub or FTP.\n";
} else {
    echo "\n✅ All critical files exist!\n";
}

// Check view directories
echo "\n=== Checking View Directories ===\n";
$viewDirs = [
    'resources/views',
    'resources/views/layouts',
    'resources/views/components',
    'resources/views/products',
    'resources/views/collections',
];

foreach ($viewDirs as $dir) {
    $fullPath = $basePath . '/' . $dir;
    if (is_dir($fullPath)) {
        $count = count(glob($fullPath . '/*.blade.php'));
        echo "✅ $dir ($count blade files)\n";
    } else {
        echo "❌ $dir (MISSING!)\n";
    }
}

echo "</pre>";
?>
