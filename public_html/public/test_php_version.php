<?php
/**
 * PHP Version Test
 * http://evahomeworld.com/public/test_php_version.php
 */

header('Content-Type: text/plain');

echo "=== PHP Version Test ===\n\n";
echo "PHP Version: " . PHP_VERSION . "\n";
echo "Required: >= 8.2.0\n\n";

if (version_compare(PHP_VERSION, '8.2.0', '>=')) {
    echo "✅ PHP Version OK!\n";
} else {
    echo "❌ PHP Version TOO OLD!\n";
    echo "Current: " . PHP_VERSION . "\n";
    echo "Required: >= 8.2.0\n";
}

echo "\n=== Configuration ===\n";
echo "PHP SAPI: " . php_sapi_name() . "\n";
echo "Loaded PHP: " . PHP_BINARY . "\n";

echo "\n=== Composer Check ===\n";
$vendorPath = __DIR__ . '/../vendor/autoload.php';
if (file_exists($vendorPath)) {
    require $vendorPath;
    echo "✅ Composer autoload OK\n";
} else {
    echo "❌ Vendor not found\n";
}

echo "\n=== Test Complete ===\n";
