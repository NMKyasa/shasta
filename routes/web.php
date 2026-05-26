<?php

use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\ServiceController;
use App\Controllers\Admin\ProjectController;
use App\Controllers\Admin\CategoryController;
use App\Controllers\Admin\PricingController;
use App\Controllers\Admin\TeamController;
use App\Controllers\Admin\TestimonialController;
use App\Controllers\Admin\SettingController;

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

    /**
 * Project listing
 */
$router->middleware('auth')
    ->get('/dashboard/projects', [

        ProjectController::class,

        'index'
    ]);


/**
 * Create project form
 */
$router->middleware('auth')
    ->get('/dashboard/projects/create', [

        ProjectController::class,

        'create'
    ]);

    /**
 * Store project
 */
$router->middleware('auth')
    ->post('/dashboard/projects/store', [

        ProjectController::class,

        'store'
    ]);


    /**
 * Edit project
 */
$router->middleware('auth')
    ->get('/dashboard/projects/edit/{id}', [

        ProjectController::class,

        'edit'
    ]);

/**
 * Update Project
 */
$router->middleware('auth')
    ->post('/dashboard/projects/update/{id}', [

        ProjectController::class,

        'update'
    ]);


       /**
 * Category listing
 */
$router->middleware('auth')
    ->get('/dashboard/categories', [

        CategoryController::class,

        'index'
    ]);


/**
 * Create category form
 */
$router->middleware('auth')
    ->get('/dashboard/categories/create', [

        CategoryController::class,

        'create'
    ]);

    /**
 * Store category
 */
$router->middleware('auth')
    ->post('/dashboard/categories/store', [

        CategoryController::class,

        'store'
    ]);


    /**
 * Edit category
 */
$router->middleware('auth')
    ->get('/dashboard/categories/edit/{id}', [

        CategoryController::class,

        'edit'
    ]);

/**
 * Update Category
 */
$router->middleware('auth')
    ->post('/dashboard/categories/update/{id}', [

        CategoryController::class,

        'update'
    ]);

          /**
 * Pricing listing
 */
$router->middleware('auth')
    ->get('/dashboard/pricing', [

        PricingController::class,

        'index'
    ]);


/**
 * Create pricing form
 */
$router->middleware('auth')
    ->get('/dashboard/pricing/create', [

        PricingController::class,

        'create'
    ]);

    /**
 * Store pricing
 */
$router->middleware('auth')
    ->post('/dashboard/pricing/store', [

        PricingController::class,

        'store'
    ]);


    /**
 * Edit pricing
 */
$router->middleware('auth')
    ->get('/dashboard/pricing/edit/{id}', [

        PricingController::class,

        'edit'
    ]);

/**
 * Update Pricing
 */
$router->middleware('auth')
    ->post('/dashboard/pricing/update/{id}', [

        PricingController::class,

        'update'
    ]);

/**
 * Team listing
 */
$router->middleware('auth')
    ->get('/dashboard/team', [

        TeamController::class,

        'index'
    ]);


/**
 * Create team form
 */
$router->middleware('auth')
    ->get('/dashboard/team/create', [

        TeamController::class,

        'create'
    ]);

    /**
 * Store team
 */
$router->middleware('auth')
    ->post('/dashboard/team/store', [

        TeamController::class,

        'store'
    ]);


    /**
 * Edit team
 */
$router->middleware('auth')
    ->get('/dashboard/team/edit/{id}', [

        TeamController::class,

        'edit'
    ]);

/**
 * Update Team
 */
$router->middleware('auth')
    ->post('/dashboard/team/update/{id}', [

        TeamController::class,

        'update'
    ]);

    /**
 * Testimonial listing
 */
$router->middleware('auth')
    ->get('/dashboard/testimonials', [

        TestimonialController::class,

        'index'
    ]);


/**
 * Create testimonial form
 */
$router->middleware('auth')
    ->get('/dashboard/testimonials/create', [

        TestimonialController::class,

        'create'
    ]);

    /**
 * Store testimonial
 */
$router->middleware('auth')
    ->post('/dashboard/testimonials/store', [

        TestimonialController::class,

        'store'
    ]);


    /**
 * Edit testimonial
 */
$router->middleware('auth')
    ->get('/dashboard/testimonials/edit/{id}', [

        TestimonialController::class,

        'edit'
    ]);

/**
 * Update Testimonial
 */
$router->middleware('auth')
    ->post('/dashboard/testimonials/update/{id}', [

        TestimonialController::class,

        'update'
    ]);

/**
 * Settings listing
 */
$router->middleware('auth')
    ->get('/dashboard/settings', [

        SettingController::class,

        'index'
    ]);


/**
 * Create settings form
 */
$router->middleware('auth')
    ->get('/dashboard/settings/create', [

        SettingController::class,

        'create'
    ]);

    /**
 * Store settings
 */
$router->middleware('auth')
    ->post('/dashboard/settings/store', [

        SettingController::class,

        'store'
    ]);


    /**
 * Edit settings
 */
$router->middleware('auth')
    ->get('/dashboard/settings/edit/{id}', [

        SettingController::class,

        'edit'
    ]);

/**
 * Update Settings
 */
$router->middleware('auth')
    ->post('/dashboard/settings/update', [

        SettingController::class,

        'update'
    ]);