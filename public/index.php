<?php
/**
 * Start session
 */
session_start();

/**
 * Composer autoload
 */
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/helpers.php';

use App\Core\Routing\Router;

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