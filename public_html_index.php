<?php
/**
 * Laravel Application
 * This file redirects all requests to the public directory
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// If the file exists in public_html/public, serve it directly
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

// Otherwise forward to index.php in public folder
require_once __DIR__.'/public/index.php';
