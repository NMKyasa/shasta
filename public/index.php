<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/helpers.php';

use App\Core\Routing\Router;
use Dotenv\Dotenv;

/**
 * Load environment variables
 */
$dotenv = Dotenv::createImmutable(
    dirname(__DIR__)
);

$dotenv->load();

/**
 * Create router instance
 */
$router = new Router();

/**
 * Load routes
 */
require_once __DIR__ . '/../routes/web.php';

/**
 * Dispatch request
 */
$router->dispatch();