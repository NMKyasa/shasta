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

                <!-- Content Management -->
                <li class="nav-item has-treeview">

                    <a href="#"
                    class="nav-link">

                        <i class="nav-icon fas fa-folder"></i>

                        <p>

                            Content Management

                            <i class="right fas fa-angle-left"></i>

                        </p>

                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">

                            <a href="<?= url('dashboard/services') ?>"
                            class="nav-link">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Services</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="<?= url('dashboard/projects') ?>"
                            class="nav-link">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Projects</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="<?= url('dashboard/categories') ?>"
                            class="nav-link">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Categories</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="<?= url('dashboard/pricing') ?>"
                            class="nav-link">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Pricing</p>

                            </a>

                        </li>

                    </ul>

                </li>

                <!-- WEBSITE CONTENT -->
                <li class="nav-item has-treeview">

                    <a href="#"
                    class="nav-link">

                        <i class="nav-icon fas fa-globe"></i>

                        <p>

                            Website Content

                            <i class="right fas fa-angle-left"></i>

                        </p>

                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">

                            <a href="<?= url('dashboard/team') ?>"
                            class="nav-link">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Team</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="<?= url('dashboard/testimonials') ?>"
                            class="nav-link">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Testimonials</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="<?= url('dashboard/inquiries') ?>"
                            class="nav-link">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Inquiries</p>

                            </a>

                        </li>

                    </ul>

                </li>

                <!-- WEBSITE CONFIGURATION -->
                    <li class="nav-item has-treeview">

                        <a href="#"
                        class="nav-link">

                            <i class="nav-icon fas fa-cogs"></i>

                            <p>

                                Website Configuration

                                <i class="right fas fa-angle-left"></i>

                            </p>

                        </a>

                        <ul class="nav nav-treeview">

                            <li class="nav-item">

                                <a href="<?= url('dashboard/sliders') ?>"
                                class="nav-link">

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>Sliders</p>

                                </a>

                            </li>

                            <li class="nav-item">

                                <a href="<?= url('dashboard/settings/about') ?>"
                                class="nav-link">

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>About</p>

                                </a>

                            </li>

                            <li class="nav-item">

                                <a href="<?= url('dashboard/impact') ?>"
                                class="nav-link">

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>Impact</p>

                                </a>

                            </li>

                            <li class="nav-item">

                                <a href="<?= url('dashboard/menus') ?>"
                                class="nav-link">

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>Menus</p>

                                </a>

                            </li>

                            <li class="nav-item">

                                <a href="<?= url('dashboard/menu-items') ?>"
                                class="nav-link">

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>Menu Items</p>

                                </a>

                            </li>

                            <li class="nav-item">

                                <a href="<?= url('dashboard/settings') ?>"
                                class="nav-link">

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>Settings</p>

                                </a>

                            </li>

                        </ul>

                    </li>

                <!-- ACCESS CONTROL -->
                    <li class="nav-item has-treeview">

                        <a href="#"
                        class="nav-link">

                            <i class="nav-icon fas fa-user-shield"></i>

                            <p>

                                Access Control

                                <i class="right fas fa-angle-left"></i>

                            </p>

                        </a>

                        <ul class="nav nav-treeview">

                            <li class="nav-item">

                                <a href="<?= url('dashboard/users') ?>"
                                class="nav-link">

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>Users</p>

                                </a>

                            </li>

                            <li class="nav-item">

                                <a href="<?= url('dashboard/roles') ?>"
                                class="nav-link">

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>Roles</p>

                                </a>

                            </li>

                            <li class="nav-item">

                                <a href="<?= url('dashboard/permissions') ?>"
                                class="nav-link">

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>Permissions</p>

                                </a>

                            </li>

                            <li class="nav-item">

                                <a href="<?= url('dashboard/role_permissions') ?>"
                                class="nav-link">

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>Role Permissions</p>

                                </a>

                            </li>

                            <li class="nav-item">

                                <a href="<?= url('dashboard/user_permissions') ?>"
                                class="nav-link">

                                    <i class="far fa-circle nav-icon"></i>

                                    <p>User Permissions</p>

                                </a>
                            </li>

                        </ul>

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