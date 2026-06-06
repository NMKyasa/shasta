<?php

use App\Controllers\Frontend\HomeController;
use App\Controllers\AuthController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\ServiceController;
use App\Controllers\Admin\ProjectController;
use App\Controllers\Admin\CategoryController;
use App\Controllers\Admin\PricingController;
use App\Controllers\Admin\TeamController;
use App\Controllers\Admin\TestimonialController;
use App\Controllers\Admin\SettingController;
use App\Controllers\Admin\InquiryController;
use App\Models\Slider;
use App\Models\Media;
use App\Controllers\Admin\SliderController;
use App\Controllers\Admin\ImpactController;
use App\Controllers\Admin\MenuController;
use App\Controllers\Admin\MenuItemController;
use App\Controllers\Admin\RoleController;
use App\Controllers\Admin\PermissionController;
use App\Models\RolePermission;
use App\Controllers\Admin\RolePermissionController;
use App\Controllers\Admin\PermissionSeederController;
use App\Controllers\Admin\UserController;
use App\Controllers\Admin\UserPermissionController;
use App\Models\UserPermission;
use App\Controllers\Admin\AuditLogController;
use App\Controllers\Frontend\ServiceController as FrontendServiceController;
use App\Controllers\Frontend\ProjectController as FrontendProjectController;
use App\Controllers\Frontend\AboutController;
use App\Controllers\Frontend\TeamController as FrontendTeamController;
use App\Controllers\Frontend\TestimonialController as FrontendTestimonialController;


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

    // Inquiries listing
    $router->middleware('auth')
        ->get('/dashboard/inquiries', [

            InquiryController::class,

            'index'
        ]);

    // Show inquiry details
    $router->middleware('auth')
        ->get('/dashboard/inquiries/show/{id}', [

            InquiryController::class,

            'show'
        ]);

    // Update inquiry status
    $router->middleware('auth')
        ->post('/dashboard/inquiries/update-status/{id}', [

            InquiryController::class,

            'updateStatus'
        ]);

// Slider listing
$router->middleware('auth')
    ->get('/dashboard/sliders', [

        SliderController::class,

        'index'
    ]);

// Create slider form
$router->middleware('auth')
    ->get('/dashboard/sliders/create', [

        SliderController::class,

        'create'
    ]);

// Store slider
$router->middleware('auth')
    ->post('/dashboard/sliders/store', [

        SliderController::class,

        'store'
    ]);

// Edit slider
$router->middleware('auth')
    ->get('/dashboard/sliders/edit/{id}', [

        SliderController::class,

        'edit'
    ]);

// Update slider
$router->middleware('auth')
    ->post('/dashboard/sliders/update/{id}', [

        SliderController::class,

        'update'
    ]);

    /**
 * About settings
 */
$router->middleware('auth')
    ->get('/dashboard/settings/about', [

        SettingController::class,

        'about'
    ]);

/**
 * Update about settings
 */
$router->middleware('auth')
    ->post('/dashboard/settings/about', [

        SettingController::class,

        'updateAbout'
    ]);

    // Impact listing
    $router->middleware('auth')
        ->get('/dashboard/impact', [

            ImpactController::class,

            'index'
        ]);

    // Create impact form
    $router->middleware('auth')
        ->get('/dashboard/impact/create', [

            ImpactController::class,

            'create'
        ]);

    // Store impact
    $router->middleware('auth')
        ->post('/dashboard/impact/store', [

            ImpactController::class,

            'store'
        ]);


    // Edit impact
    $router->middleware('auth')
        ->get('/dashboard/impact/edit/{id}', [

            ImpactController::class,

            'edit'
        ]);

    // Update impact
    $router->middleware('auth')
        ->post('/dashboard/impact/update/{id}', [

            ImpactController::class,

            'update'
        ]);

/**
 * Menus listing
 */
$router->middleware('auth')
    ->get('/dashboard/menus', [

        MenuController::class,

        'index'
    ]);

/**
 * Create menu form
 */
$router->middleware('auth')
    ->get('/dashboard/menus/create', [

        MenuController::class,

        'create'
    ]);

/**
 * Store menu
 */
$router
    ->middleware('auth')
    ->middleware('csrf')
    ->post(
        '/dashboard/menus/store',
        [MenuController::class, 'store']
    );

/**
 * Edit menu
 */
$router->middleware('auth')
    ->get('/dashboard/menus/edit/{id}', [

        MenuController::class,

        'edit'
    ]);

/**
 * Update menu
 */
$router
    ->middleware('auth')
    ->middleware('csrf')
    ->post(
        '/dashboard/menus/update/{id}',
        [MenuController::class, 'update']
    );

    /**
 * Menu items listing
 */
$router->middleware('auth')
    ->get('/dashboard/menu-items', [

        MenuItemController::class,

        'index'
    ]);

/**
 * Create menu item
 */
$router->middleware('auth')
    ->get('/dashboard/menu-items/create', [

        MenuItemController::class,

        'create'
    ]);

/**
 * Store menu item
 */
$router->middleware('auth')
    ->post('/dashboard/menu-items/store', [

        MenuItemController::class,

        'store'
    ]);

/**
 * Edit menu item
 */
$router->middleware('auth')
    ->get('/dashboard/menu-items/edit/{id}', [

        MenuItemController::class,

        'edit'
    ]);

/**
 * Update menu item
 */
$router->middleware('auth')
    ->post('/dashboard/menu-items/update/{id}', [

        MenuItemController::class,

        'update'
    ]);

/**
 * Roles listing
 */
$router->middleware('auth')
    ->get('/dashboard/roles', [

        RoleController::class,

        'index'
    ]);

/**
 * Create role form
 */
$router->middleware('auth')
    ->get('/dashboard/roles/create', [

        RoleController::class,

        'create'
    ]);

/**
 * Store role
 */
$router->middleware('auth')
    ->post('/dashboard/roles/store', [

        RoleController::class,

        'store'
    ]);

/**
 * Edit role
 */
$router->middleware('auth')
    ->get('/dashboard/roles/edit/{id}', [

        RoleController::class,

        'edit'
    ]);

/**
 * Update role
 */
$router->middleware('auth')
    ->post('/dashboard/roles/update/{id}', [

        RoleController::class,

        'update'
    ]);
    

/**
 * Permissions listing
 */
$router->middleware('auth')
    ->get('/dashboard/permissions', [

        PermissionController::class,

        'index'
    ]);

/**
 * Create permission form
 */
$router->middleware('auth')
    ->get('/dashboard/permissions/create', [

        PermissionController::class,

        'create'
    ]);

/**
 * Store permission
 */
$router->middleware('auth')
    ->post('/dashboard/permissions/store', [

        PermissionController::class,

        'store'
    ]);

/**
 * Edit permission
 */
$router->middleware('auth')
    ->get('/dashboard/permissions/edit/{id}', [

        PermissionController::class,

        'edit'
    ]);

/**
 * Update permission
 */
$router->middleware('auth')
    ->post('/dashboard/permissions/update/{id}', [

        PermissionController::class,

        'update'
    ]);

// Role permissions listing
$router->middleware('auth')
    ->get('/dashboard/role_permissions', [

        RolePermissionController::class,

        'index'
    ]);

/** * Edit role permissions
 */
$router->middleware('auth')
    ->get('/dashboard/role_permissions/edit/{roleId}', [

        RolePermissionController::class,

        'edit'
    ]);

/** * Update role permissions
 */
$router->middleware('auth')
    ->post('/dashboard/role_permissions/update/{roleId}', [

        RolePermissionController::class,

        'update'
    ]);

/**
 * Permission Seeder
 */
$router->middleware('auth')
    ->post('/dashboard/permissions/generate', [

        PermissionSeederController::class,

        'seed'
    ]);


// $router->post(
//     '/dashboard/permissions/generate',
//     'Admin\PermissionSeederController@seed'
// );


/**
 * User listing
 */
$router->middleware('auth')
    ->get('/dashboard/users', [

        UserController::class,

        'index'
    ]);

/** * Create user form
 */
$router->middleware('auth')
    ->get('/dashboard/users/create', [

        UserController::class,

        'create'
    ]);

/** * Store user */
$router->middleware('auth')
    ->post('/dashboard/users/store', [

        UserController::class,

        'store'
    ]);

/** * Edit user form
 */
$router->middleware('auth')
    ->get('/dashboard/users/edit/{id}', [

        UserController::class,

        'edit'
    ]);

/** * Update user */
$router->middleware('auth')
    ->post('/dashboard/users/update/{id}', [

        UserController::class,

        'update'
    ]);


// User permissions listing
$router->middleware('auth')
    ->get('/dashboard/user_permissions', [

        UserPermissionController::class,

        'index'
    ]);

/** * Edit user permissions
 */
$router->middleware('auth')
    ->get('/dashboard/user_permissions/edit/{userId}', [

        UserPermissionController::class,

        'edit'
    ]);

/** * Update user permissions
 */
$router->middleware('auth')
    ->post('/dashboard/user_permissions/update/{userId}', [

        UserPermissionController::class,

        'update'
    ]);

    // Audit logs listing
    $router->middleware('auth')
        ->get('/dashboard/audit_logs', [

            AuditLogController::class,

            'index'
        ]);

        // Audit log details
        $router->middleware('auth')
        ->get('/dashboard/audit_logs/show/{id}', [

            AuditLogController::class,

            'show'
        ]);

        // Services listing for frontend
        $router->get('/services', [

            FrontendServiceController::class,

            'index'
        ]);

            // Service details
        $router->get('/services/{slug}', [

            FrontendServiceController::class,

            'show'
        ]);

        // home page
        $router->get('/home', [

            HomeController::class,

            'index'
        ]);

        // projects listing for frontend
        $router->get('/projects', [

            App\Controllers\Frontend\ProjectController::class,

            'index'
        ]);

        // project details
        $router->get('/projects/{slug}', [

            App\Controllers\Frontend\ProjectController::class,

            'show'
        ]);

        // about page
        $router->get('/about', [

            App\Controllers\Frontend\AboutController::class,

            'index'
        ]);

        // team listing for frontend
        $router->get('/team', [

            FrontendTeamController::class,

            'index'
        ]);

        // testimonials listing for frontend
        $router->get('/testimonials', [

            FrontendTestimonialController::class,

            'index'
        ]);