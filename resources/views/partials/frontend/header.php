<body>
<!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-dark px-5">
        <div class="row gx-4 d-none d-lg-flex">
            <div class="col-lg-6 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <div class="btn-sm-square rounded-circle bg-primary me-2">
                        <small class="fa fa-map-marker-alt text-white"></small>
                    </div>
                    <small>

                        <?= htmlspecialchars(
                            $settings['office_address']
                            ?? ''
                        ) ?>

                    </small>
                </div>
                <div class="h-100 d-inline-flex align-items-center py-3">
                    <div class="btn-sm-square rounded-circle bg-primary me-2">
                        <small class="fa fa-envelope-open text-white"></small>
                    </div>
                    <small>

                        <?= htmlspecialchars(
                            $settings['company_email']
                            ?? ''
                        ) ?>

                    </small>
                </div>
            </div>
            <div class="col-lg-6 text-end">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <div class="btn-sm-square rounded-circle bg-primary me-2">
                        <small class="fa fa-phone-alt text-white"></small>
                    </div>
                    <small>

                        <?= htmlspecialchars(
                            $settings['phone_number']
                            ?? ''
                        ) ?>

                    </small>
                </div>
                <div class="h-100 d-inline-flex align-items-center py-3">
                    <div class="btn-sm-square rounded-circle bg-primary me-2">
                        <small class="far fa-clock text-white"></small>
                    </div>
                    <small>

                        <?= htmlspecialchars(
                            $settings['working_hours']
                            ?? ''
                        ) ?>

                    </small>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

<!-- Current page active -->
    <?php

    $currentUri =
        trim(
            parse_url(
                $_SERVER['REQUEST_URI'],
                PHP_URL_PATH
            ),
            '/'
        );

    ?>

   <!-- Navbar Start -->
<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 px-4 px-lg-5">

    <a
        href="<?= url('home') ?>"
        class="navbar-brand d-flex align-items-center"
    >

        <?php if (!empty($settings['logo'])): ?>

            <img
                src="<?= asset($settings['logo']) ?>"
                alt="<?= htmlspecialchars(
                    $settings['site_name']
                ) ?>"
                style="max-height:60px;"
                class="me-2"
            >

        <?php endif; ?>

        <span
            class="fw-bold text-primary"
            style="font-size:1.4rem;"
        >

            <?= !empty($settings['site_name'])
                ? htmlspecialchars(
                    $settings['site_name']
                )
                : 'SHASTA'
            ?>

        </span>

    </a>

    <button
        type="button"
        class="navbar-toggler"
        data-bs-toggle="collapse"
        data-bs-target="#navbarCollapse"
    >

        <span class="navbar-toggler-icon"></span>

    </button>

    <div
        class="collapse navbar-collapse"
        id="navbarCollapse"
    >

        <div class="navbar-nav ms-auto py-4 py-lg-0">

            <a
                href="<?= url('home') ?>"
                class="nav-item nav-link <?= $currentUri === 'home' || $currentUri === '' ? 'active' : '' ?>"
            >
                Home
            </a>

            <a
                href="<?= url('about') ?>"
                class="nav-item nav-link <?= str_contains($currentUri, 'about') ? 'active' : '' ?>"
            >
                About Us
            </a>

            <a
                href="<?= url('services') ?>"
                class="nav-item nav-link <?= str_contains($currentUri, 'services') ? 'active' : '' ?>"
            >
                Services
            </a>

            <a
                href="<?= url('projects') ?>"
                class="nav-item nav-link <?= str_contains($currentUri, 'projects') ? 'active' : '' ?>"
            >
                Projects
            </a>

            <a
                href="<?= url('pricing') ?>"
                class="nav-item nav-link <?= str_contains($currentUri, 'pricing') ? 'active' : '' ?>"
            >
                Pricing
            </a>

            <div class="nav-item dropdown">

                <a
                    href="#"
                    class="nav-link dropdown-toggle <?= (
                        str_contains($currentUri, 'team')
                        ||
                        str_contains($currentUri, 'testimonials')
                    ) ? 'active' : '' ?>"
                    data-bs-toggle="dropdown"
                >

                    Company

                </a>

                <div
                    class="dropdown-menu rounded-0 rounded-bottom m-0"
                >

                    <a
                        href="<?= url('team') ?>"
                        class="dropdown-item"
                    >

                        Our Team

                    </a>

                    <a
                        href="<?= url('testimonials') ?>"
                        class="dropdown-item"
                    >

                        Testimonials

                    </a>

                </div>

            </div>

            <a
                href="<?= url('contact') ?>"
                class="nav-item nav-link <?= str_contains($currentUri, 'contact') ? 'active' : '' ?>"
            >
                Contact Us
            </a>

        </div>

        <!-- CTA Button -->
        <a
            href="<?= url('quote') ?>"
            class="btn btn-primary py-2 px-4 ms-lg-3"
        >

            Get Free Quote

        </a>

    </div>

</nav>
<!-- Navbar End -->