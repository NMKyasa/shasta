<?php use App\Core\Auth\Authorization; ?>

<!--  ACTIVE Highlight for pages -->
<?php

$currentUrl =
    $_SERVER['REQUEST_URI'];

function isActive($path)
{
    return strpos(
        $_SERVER['REQUEST_URI'],
        $path
    ) !== false
        ? 'active'
        : '';
}
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="<?= url('dashboard') ?>"
       class="brand-link">

        <img
            src="<?= asset('assets/admin/dist/img/shasta-logo2.jpeg') ?>"
            alt="SHASTA Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: .8"
        >

        <span class="brand-text font-weight-light">
            SHASTA CMS
        </span>

    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="image">

                <img
                    src="<?= asset('assets/admin/dist/img/shasta-logo.jpeg') ?>"
                    class="img-circle elevation-2"
                    alt="User Image"
                >

            </div>

            <div class="info">

                <a href="#"
                   class="d-block">

                    <?= $_SESSION['user']['first_name'] ?? 'Administrator' ?>

                </a>

            </div>

        </div>

        <!-- Sidebar Search -->
        <div class="form-inline">

            <div class="input-group"
                 data-widget="sidebar-search">

                <input
                    class="form-control form-control-sidebar"
                    type="search"
                    placeholder="Search"
                >

                <div class="input-group-append">

                    <button class="btn btn-sidebar">

                        <i class="fas fa-search fa-fw"></i>

                    </button>

                </div>

            </div>

        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">

                    <a href="<?= url('dashboard') ?>"
                        class="nav-link <?= $currentUrl == '/dashboard' ? 'active' : '' ?>">

                        <i class="nav-icon fas fa-tachometer-alt"></i>

                        <p>
                            Dashboard
                        </p>

                    </a>

                </li>

                <!-- Content Management -->
                    <?php

                    $canContentManagement =

                        Authorization::can('services.view')
                        ||

                        Authorization::can('projects.view')
                        ||

                        Authorization::can('categories.view')
                        ||

                        Authorization::can('pricing_items.view');

                    ?>

                    <?php if ($canContentManagement): ?>
                <li class="nav-item has-treeview <?= (
                    isActive('/dashboard/services')
                    ||
                    isActive('/dashboard/projects')
                    ||
                    isActive('/dashboard/categories')
                    ||
                    isActive('/dashboard/pricing')
                ) ? 'menu-open' : '' ?>">

                    <a href="#"
                        class="nav-link <?= (
                            isActive('/dashboard/services')
                            ||
                            isActive('/dashboard/projects')
                            ||
                            isActive('/dashboard/categories')
                            ||
                            isActive('/dashboard/pricing')
                        ) ? 'active' : '' ?>">

                        <i class="nav-icon fas fa-folder"></i>

                        <p>

                            Content Management

                            <i class="right fas fa-angle-left"></i>

                        </p>

                    </a>

                    <ul class="nav nav-treeview">
                        <?php if (Authorization::can('services.view')): ?>

                        <li class="nav-item">

                            <a href="<?= url('dashboard/services') ?>"
                                class="nav-link <?= isActive('/dashboard/services') ?>">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Services</p>

                            </a>

                        </li>
                        <?php endif; ?>

                        <?php if (Authorization::can('projects.view')): ?>

                        <li class="nav-item">

                            <a href="<?= url('dashboard/projects') ?>"
                                class="nav-link <?= isActive('/dashboard/projects') ?>">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Projects</p>

                            </a>

                        </li>
                        <?php endif; ?>

                        <?php if (Authorization::can('categories.view')): ?>
                        <li class="nav-item">

                            <a href="<?= url('dashboard/categories') ?>"
                                class="nav-link <?= isActive('/dashboard/categories') ?>">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Categories</p>

                            </a>

                        </li>
                        <?php endif; ?>

                        <?php if (Authorization::can('pricing_items.view')): ?>
                        <li class="nav-item">

                            <a href="<?= url('dashboard/pricing') ?>"
                                class="nav-link <?= isActive('/dashboard/pricing') ?>">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Pricing</p>

                            </a>

                        </li>
                        <?php endif; ?>

                    </ul>

                </li>
                <?php endif; ?>

                <!-- WEBSITE CONTENT -->
                 <?php
                $canWebsiteContent =

                    Authorization::can('team.view')
                    ||
                    Authorization::can('testimonials.view')
                    ||
                    Authorization::can('inquiries.view');

                ?>
                <?php if ($canWebsiteContent): ?>
                <li class="nav-item has-treeview <?= (
                    isActive('/dashboard/team')
                    ||
                    isActive('/dashboard/testimonials')
                    ||
                    isActive('/dashboard/inquiries')
                ) ? 'menu-open' : '' ?>">

                    <a href="#"
                                        class="nav-link <?= (
                        isActive('/dashboard/team')
                        ||
                        isActive('/dashboard/testimonials')
                        ||
                        isActive('/dashboard/inquiries')
                    ) ? 'active' : '' ?>">

                        <i class="nav-icon fas fa-globe"></i>

                        <p>

                            Website Content

                            <i class="right fas fa-angle-left"></i>

                        </p>

                    </a>

                    <ul class="nav nav-treeview">

                    <?php if (Authorization::can('team.view')): ?>
                        <li class="nav-item">

                            <a href="<?= url('dashboard/team') ?>"
                                class="nav-link <?= isActive('/dashboard/team') ?>">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Team</p>

                            </a>

                        </li>
                    <?php endif; ?>

                    <?php if (Authorization::can('testimonials.view')): ?>
                        <li class="nav-item">

                            <a href="<?= url('dashboard/testimonials') ?>"
                                class="nav-link <?= isActive('/dashboard/testimonials') ?>">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Testimonials</p>

                            </a>

                        </li>
                    <?php endif; ?>

                    <?php if (Authorization::can('inquiries.view')): ?>
                        <li class="nav-item">

                            <a href="<?= url('dashboard/inquiries') ?>"
                                class="nav-link <?= isActive('/dashboard/inquiries') ?>">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Inquiries</p>

                            </a>

                        </li>
                    <?php endif; ?>

                    </ul>

                </li>
                <?php endif; ?>

                <!-- WEBSITE CONFIGURATION -->
                 <?php
                $canWebsiteConfig =
                    Authorization::can('sliders.view')
                    ||
                    Authorization::can('about.view')
                    ||
                    Authorization::can('impact.view')
                    ||
                    Authorization::can('menus.view')
                    ||
                    Authorization::can('menu-items.view')
                    ||
                    Authorization::can('settings.view');

                ?>
                <?php if ($canWebsiteConfig): ?>
                <li class="nav-item has-treeview <?= (
                    isActive('/dashboard/sliders')
                    ||
                    isActive('/dashboard/settings/about')
                    ||
                    isActive('/dashboard/impact')
                    ||
                    isActive('/dashboard/menus')
                    ||
                    isActive('/dashboard/menu-items')
                    ||
                    isActive('/dashboard/settings')
                ) ? 'menu-open' : '' ?>">

                        <a href="#"
                        class="nav-link <?= (
                            isActive('/dashboard/sliders')
                            ||
                            isActive('/dashboard/settings/about')
                            ||
                            isActive('/dashboard/impact')
                            ||
                            isActive('/dashboard/menus')
                            ||
                            isActive('/dashboard/menu-items')
                            ||
                            isActive('/dashboard/settings')
                        ) ? 'active' : '' ?>">

                            <i class="nav-icon fas fa-cogs"></i>

                            <p>

                                Website Configuration

                                <i class="right fas fa-angle-left"></i>

                            </p>

                        </a>

                        <ul class="nav nav-treeview">

                            <?php if (Authorization::can('sliders.view')): ?>
                                <li class="nav-item">

                                <a href="<?= url('dashboard/sliders') ?>"
                                    class="nav-link <?= isActive('/dashboard/sliders') ?>">

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>Sliders</p>

                                </a>

                            </li>
                            <?php endif; ?>

                            <?php if (Authorization::can('about.view')): ?>
                                <li class="nav-item">

                                <a href="<?= url('dashboard/settings/about') ?>"
                                    class="nav-link <?= isActive('/dashboard/settings/about') ?>">

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>About</p>

                                </a>

                            </li>
                            <?php endif; ?>

                            <?php if (Authorization::can('impact.view')): ?>
                                <li class="nav-item">

                                <a href="<?= url('dashboard/impact') ?>"
                                class="nav-link <?= isActive('/dashboard/impact') ?>">

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>Impact</p>

                                </a>

                            </li>
                            <?php endif; ?>

                            <?php if (Authorization::can('menus.view')): ?>
                                <li class="nav-item">

                                <a href="<?= url('dashboard/menus') ?>"
                                    class="nav-link <?= isActive('/dashboard/menus') ?>">

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>Menus</p>

                                </a>

                            </li>
                            <?php endif; ?>

                            <?php if (Authorization::can('menu-items.view')): ?>
                            <li class="nav-item">

                                <a href="<?= url('dashboard/menu-items') ?>"
                                    class="nav-link <?= isActive('/dashboard/menu-items') ?>">

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>Menu Items</p>

                                </a>

                            </li>
                            <?php endif; ?>

                            <?php if (Authorization::can('settings.view')): ?>
                            <li class="nav-item">

                                <a href="<?= url('dashboard/settings') ?>"
                                    class="nav-link <?= isActive('/dashboard/settings') ?>">

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>Settings</p>

                                </a>

                            </li>
                            <?php endif; ?>

                        </ul>

                    </li>
                <?php endif; ?>

                <!-- ACCESS CONTROL -->
                <?php if (Authorization::can('users.view') || Authorization::can('roles.view') || Authorization::can('permissions.view') || Authorization::can('role_permissions.view') || Authorization::can('user_permissions.view')
                    || Authorization::can('audit_logs.view')
                    ): ?>
                    <li class="nav-item has-treeview <?= (
                        isActive('/dashboard/users')
                        ||
                        isActive('/dashboard/roles')
                        ||
                        isActive('/dashboard/permissions')
                        ||
                        isActive('/dashboard/role_permissions')
                        ||
                        isActive('/dashboard/user_permissions')
                        ||
                        isActive('/dashboard/audit_logs')
                    ) ? 'menu-open' : '' ?>">

                        <a href="#"
                        class="nav-link <?= (
                            isActive('/dashboard/users')
                            ||
                            isActive('/dashboard/roles')
                            ||
                            isActive('/dashboard/permissions')
                            ||
                            isActive('/dashboard/role_permissions')
                            ||
                            isActive('/dashboard/user_permissions')
                            ||
                            isActive('/dashboard/audit_logs')
                        ) ? 'active' : '' ?>">

                            <i class="nav-icon fas fa-user-shield"></i>

                            <p>

                                Access Control

                                <i class="right fas fa-angle-left"></i>

                            </p>

                        </a>

                        <ul class="nav nav-treeview">

                        <?php if (Authorization::can('users.view')): ?>
                            <li class="nav-item">

                                <a href="<?= url('dashboard/users') ?>"
                                    class="nav-link <?= isActive('/dashboard/users') ?>">

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>Users</p>

                                </a>

                            </li>
                            <?php endif; ?>

                            <?php if (Authorization::can('roles.view')): ?>
                            <li class="nav-item">

                                <a href="<?= url('dashboard/roles') ?>"
                                    class="nav-link <?= isActive('/dashboard/roles') ?>">

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>Roles</p>

                                </a>

                            </li>
                            <?php endif; ?>

                            <?php if (Authorization::can('permissions.view')): ?>
                            <li class="nav-item">

                                <a href="<?= url('dashboard/permissions') ?>"
                                    class="nav-link <?= isActive('/dashboard/permissions') ?>">

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>Permissions</p>

                                </a>

                            </li>
                            <?php endif; ?>

                            <?php if (Authorization::can('role_permissions.view')): ?>
                            <li class="nav-item">

                                <a href="<?= url('dashboard/role_permissions') ?>"
                                    class="nav-link <?= isActive('/dashboard/role_permissions') ?>">

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>Role Permissions</p>

                                </a>

                            </li>
                            <?php endif; ?>

                            <?php if (Authorization::can('user_permissions.view')): ?>
                            <li class="nav-item">

                                <a href="<?= url('dashboard/user_permissions') ?>"
                                    class="nav-link <?= isActive('/dashboard/user_permissions') ?>">

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>User Permissions</p>

                                </a>
                            </li>
                            <?php endif; ?>

                            <?php if (Authorization::can('audit_logs.view')): ?>
                            <li class="nav-item">

                                <a href="<?= url('dashboard/audit_logs') ?>"
                                    class="nav-link <?= isActive('/dashboard/audit_logs') ?>">

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>Audit Logs</p>

                                </a>

                            </li>
                            <?php endif; ?>

                        </ul>

                    </li>
                <?php endif; ?>



                <!-- ACCOUNT -->
                <li class="nav-header">
                    ACCOUNT
                </li>

                <li class="nav-item">

                    <a href="<?= url('logout') ?>"
                       class="nav-link">

                        <i class="nav-icon fas fa-sign-out-alt"></i>

                        <p>
                            Logout
                        </p>

                    </a>

                </li>

            </ul>

        </nav>

    </div>

</aside>