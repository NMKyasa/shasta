<?php

use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\ServiceController;
use App\Controllers\Admin\CategoryController;

/**
 * Admin dashboard
 */
$router->middleware('auth')
    ->get('/dashboard', [

        DashboardController::class,

        'index'
    ]);

/**
 * Services listing
 */
$router->middleware('auth')
    ->get('/dashboard/services', [

        ServiceController::class,

        'index'
    ]);

/**
 * Homepage
 */
$router->get('/', [

    HomeController::class,

    'index'
]);

/**
 * Show login page
 */
$router->get('/login', [

    AuthController::class,

    'showLogin'
]);

/**
 * Process login
 */
$router->post('/login', [

    AuthController::class,

    'login'
]);

/**
 * Logout
 */
$router->get('/logout', [

    AuthController::class,

    'logout'
]);

/**
 * Create service form
 */
$router->middleware('auth')
    ->get('/dashboard/services/create', [

        ServiceController::class,

        'create'
    ]);

    /**
 * Store service
 */
$router->middleware('auth')
    ->post('/dashboard/services/store', [

        ServiceController::class,

        'store'
    ]);

    /**
 * Store category via AJAX
 */
$router->middleware('auth')
    ->post('/dashboard/categories/store-ajax', [

        CategoryController::class,

        'storeAjax'
    ]);

    /**
 * Edit service
 */
$router->middleware('auth')
    ->get('/dashboard/services/edit/{id}', [

        ServiceController::class,

        'edit'
    ]);

/**
 * Update service
 */
$router->middleware('auth')
    ->post('/dashboard/services/update/{id}', [

        ServiceController::class,

        'update'
    ]);