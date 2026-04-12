<?php

declare(strict_types=1);

/**
 * Router for `php -S` during GitHub Actions static export only.
 * Normalizes SCRIPT_NAME/PATH_INFO so Symfony matches routes at /… while the app
 * is deployed under GITHUB_PAGES_BASE_PATH (e.g. /savethedate).
 *
 * Usage: php -S 127.0.0.1:8080 -t public public/ci-github-pages-router.php
 */
$base = rtrim((string) getenv('GITHUB_PAGES_BASE_PATH'), '/');
$uri = $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($uri, PHP_URL_PATH) ?: '/';

if ($base !== '' && str_starts_with($path, $base)) {
    $path = substr($path, \strlen($base)) ?: '/';
}

$publicFile = __DIR__.$path;
if ($path !== '/' && is_file($publicFile)) {
    return false;
}

$_SERVER['SCRIPT_FILENAME'] = __DIR__.'/index.php';
$_SERVER['SCRIPT_NAME'] = ($base === '' ? '' : $base).'/index.php';
$_SERVER['PATH_INFO'] = $path;
$_SERVER['PHP_SELF'] = $_SERVER['SCRIPT_NAME'];

require __DIR__.'/index.php';
