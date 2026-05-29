<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="<?= url('dashboard') ?>"
       class="brand-link">

        <img
            src="<?= asset('assets/admin/dist/img/AdminLTELogo.png') ?>"
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
                    src="<?= asset('assets/admin/dist/img/user2-160x160.jpg') ?>"
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
                       class="nav-link">

                        <i class="nav-icon fas fa-tachometer-alt"></i>

                        <p>
                            Dashboard
                        </p>

                    </a>

                </li>

                <!-- Services -->
                <li class="nav-item">

                    <a href="<?= url('dashboard/services') ?>"
                       class="nav-link">

                        <i class="nav-icon fas fa-cogs"></i>

                        <p>
                            Services
                        </p>

                    </a>

                </li>

                <!-- Projects -->
                <li class="nav-item">

                    <a href="<?= url('dashboard/projects') ?>"
                       class="nav-link">

                        <i class="nav-icon fas fa-project-diagram"></i>

                        <p>
                            Projects
                        </p>

                    </a>

                </li>

                <!-- Categories -->
                <li class="nav-item">

                    <a href="<?= url('dashboard/categories') ?>"
                       class="nav-link">

                        <i class="nav-icon fas fa-file-alt"></i>

                        <p>
                            Categories
                        </p>

                    </a>

                </li>

                <!-- Pricing -->
                <li class="nav-item">

                    <a href="<?= url('dashboard/pricing') ?>"
                       class="nav-link">

                        <i class="nav-icon fas fa-tag"></i>

                        <p>
                            Pricing
                        </p>

                    </a>

                </li>

                <!-- Team -->
                <li class="nav-item">

                    <a href="<?= url('dashboard/team') ?>"
                       class="nav-link">

                        <i class="nav-icon fas fa-users"></i>

                        <p>
                            Team
                        </p>

                    </a>

                </li>

                <!-- Testimonials -->
                <li class="nav-item">

                    <a href="<?= url('dashboard/testimonials') ?>"
                       class="nav-link">

                        <i class="nav-icon fas fa-comment-dots"></i>

                        <p>
                            Testimonials
                        </p>

                    </a>

                </li>

                <!-- Inquiries -->
                <li class="nav-item">

                    <a href="<?= url('dashboard/inquiries') ?>"
                       class="nav-link">

                        <i class="nav-icon fas fa-question-circle"></i>

                        <p>
                            Inquiries
                        </p>

                    </a>

                </li>

                <!-- USERS & ACCESS -->
                <li class="nav-header">
                    USERS & ACCESS
                </li>

                <li class="nav-item">

                    <a href="#"
                       class="nav-link">

                        <i class="nav-icon fas fa-user"></i>

                        <p>
                            Users
                        </p>

                    </a>

                </li>

                <li class="nav-item">

                    <a href="#"
                       class="nav-link">

                        <i class="nav-icon fas fa-user-shield"></i>

                        <p>
                            Roles
                        </p>

                    </a>

                </li>

                <li class="nav-item">

                    <a href="#"
                       class="nav-link">

                        <i class="nav-icon fas fa-lock"></i>

                        <p>
                            Permissions
                        </p>

                    </a>

                </li>

                <!-- WEBSITE SETTINGS -->
                <li class="nav-header">
                    WEBSITE SETTINGS
                </li>

                <!-- Sliders -->
                <li class="nav-item">

                    <a href="<?= url('dashboard/sliders') ?>"
                       class="nav-link">

                        <i class="nav-icon fas fa-sliders-h"></i>

                        <p>
                            Sliders
                        </p>

                    </a>

                </li>

                <!-- Settings -->
                <li class="nav-item">

                    <a href="<?= url('dashboard/settings') ?>"
                       class="nav-link">

                        <i class="nav-icon fas fa-cog"></i>

                        <p>
                            Settings
                        </p>

                    </a>

                </li>

                <!-- About settings -->
                <li class="nav-item">

                    <a href="<?= url('dashboard/settings/about') ?>"
                       class="nav-link">

                        <i class="nav-icon fas fa-info-circle"></i>

                        <p>
                            About
                        </p>

                    </a>

                </li>

                    <!-- Impacts -->
                    <li class="nav-item">
    
                        <a href="<?= url('dashboard/impact') ?>"
                        class="nav-link">
    
                            <i class="nav-icon fas fa-chart-bar"></i>
    
                            <p>
                                Impacts
                            </p>
    
                        </a>
    
                    </li>

                    <!-- Menus -->
                    <li class="nav-item">

                        <a href="<?= url('dashboard/menus') ?>"
                           class="nav-link">

                            <i class="nav-icon fas fa-bars"></i>

                            <p>
                                Menus
                            </p>

                        </a>

                    </li>

                    <!-- Menu Items -->
                    <li class="nav-item">

                        <a href="<?= url('dashboard/menu-items') ?>"
                           class="nav-link">

                            <i class="nav-icon fas fa-list"></i>

                            <p>
                                Menu Items
                            </p>

                        </a>

                    </li>

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