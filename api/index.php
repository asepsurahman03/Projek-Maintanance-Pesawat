<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

try {
    // Setup writable directories in /tmp for Vercel Serverless environment
    $tmpPaths = [
        '/tmp/storage',
        '/tmp/storage/app',
        '/tmp/storage/app/public',
        '/tmp/storage/framework',
        '/tmp/storage/framework/cache',
        '/tmp/storage/framework/cache/data',
        '/tmp/storage/framework/sessions',
        '/tmp/storage/framework/testing',
        '/tmp/storage/framework/views',
        '/tmp/storage/logs',
        '/tmp/bootstrap/cache',
    ];

    foreach ($tmpPaths as $path) {
        if (!is_dir($path)) {
            @mkdir($path, 0777, true);
        }
    }

    // Setup SQLite database in /tmp
    $sourceDb = __DIR__ . '/../database/database.sqlite';
    $targetDb = '/tmp/database.sqlite';

    if (!file_exists($targetDb)) {
        if (file_exists($sourceDb) && filesize($sourceDb) > 0) {
            @copy($sourceDb, $targetDb);
        } else {
            @touch($targetDb);
        }
        @chmod($targetDb, 0777);
    }

    putenv("DB_CONNECTION=sqlite");
    putenv("DB_DATABASE={$targetDb}");
    $_ENV['DB_CONNECTION'] = 'sqlite';
    $_ENV['DB_DATABASE'] = $targetDb;

    // Fallback APP_KEY
    if (!env('APP_KEY')) {
        putenv('APP_KEY=base64:yJXhRe8J5iIPv0y5Y3++tSwCgqRue2HwNo6zfkx8z98=');
        $_ENV['APP_KEY'] = 'base64:yJXhRe8J5iIPv0y5Y3++tSwCgqRue2HwNo6zfkx8z98=';
    }

    // Autoloader
    require __DIR__ . '/../vendor/autoload.php';

    // Bootstrap Laravel Application
    /** @var Application $app */
    $app = require_once __DIR__ . '/../bootstrap/app.php';

    $app->useStoragePath('/tmp/storage');

    // Handle incoming request
    $app->handleRequest(Request::capture());

} catch (\Throwable $e) {
    http_response_code(500);
    echo "<h1>Server Error Detail</h1>";
    echo "<p><strong>Message:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><strong>File:</strong> " . htmlspecialchars($e->getFile()) . " (line " . $e->getLine() . ")</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}
