    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">

        <div class="container py-5">

            <div class="row g-5">

                <!-- Contact Information -->
                <div class="col-lg-3 col-md-6">

                    <h5 class="text-light mb-4">

                        Contact Information

                    </h5>

                    <p class="mb-2">

                        <i class="fa fa-map-marker-alt me-3"></i>

                        <?= htmlspecialchars(
                            $settings['office_address']
                            ?? ''
                        ) ?>

                    </p>

                    <p class="mb-2">

                        <i class="fa fa-phone-alt me-3"></i>

                        <?= htmlspecialchars(
                            $settings['phone_number']
                            ?? ''
                        ) ?>

                    </p>

                    <p class="mb-2">

                        <i class="fa fa-envelope me-3"></i>

                        <?= htmlspecialchars(
                            $settings['company_email']
                            ?? ''
                        ) ?>

                    </p>

                    <div class="d-flex pt-2">

                        <?php if (!empty($settings['twitter_url'])): ?>

                            <a
                                class="btn btn-square btn-outline-secondary rounded-circle me-2"
                                href="<?= htmlspecialchars($settings['twitter_url']) ?>"
                                target="_blank"
                            >
                                <i class="fab fa-twitter"></i>
                            </a>

                        <?php endif; ?>

                        <?php if (!empty($settings['facebook_url'])): ?>

                            <a
                                class="btn btn-square btn-outline-secondary rounded-circle me-2"
                                href="<?= htmlspecialchars($settings['facebook_url']) ?>"
                                target="_blank"
                            >
                                <i class="fab fa-facebook-f"></i>
                            </a>

                        <?php endif; ?>

                        <?php if (!empty($settings['youtube_url'])): ?>

                            <a
                                class="btn btn-square btn-outline-secondary rounded-circle me-2"
                                href="<?= htmlspecialchars($settings['youtube_url']) ?>"
                                target="_blank"
                            >
                                <i class="fab fa-youtube"></i>
                            </a>

                        <?php endif; ?>

                        <?php if (!empty($settings['linkedin_url'])): ?>

                            <a
                                class="btn btn-square btn-outline-secondary rounded-circle me-2"
                                href="<?= htmlspecialchars($settings['linkedin_url']) ?>"
                                target="_blank"
                            >
                                <i class="fab fa-linkedin-in"></i>
                            </a>

                        <?php endif; ?>

                        <?php if (!empty($settings['instagram_url'])): ?>

                            <a
                                class="btn btn-square btn-outline-secondary rounded-circle me-2"
                                href="<?= htmlspecialchars($settings['instagram_url']) ?>"
                                target="_blank"
                            >
                                <i class="fab fa-instagram"></i>
                            </a>

                        <?php endif; ?>

                    </div>

                </div>

                <!-- Services -->
                <div class="col-lg-3 col-md-6">

                    <h5 class="text-light mb-4">

                        Services

                    </h5>

                    <?php

                    $db =
                        \App\Core\Database\Connection::getInstance();

                    $footerServices =
                        $db->query(
                            "
                            SELECT
                                title,
                                slug
                            FROM services
                            WHERE status = 'active'
                            AND deleted_at IS NULL
                            ORDER BY title ASC
                            LIMIT 5
                            "
                        )->fetchAll();

                    ?>

                    <?php foreach ($footerServices as $service): ?>

                        <a
                            class="btn btn-link"
                            href="<?= url(
                                'services/' .
                                $service['slug']
                            ) ?>"
                        >

                            <?= htmlspecialchars(
                                $service['title']
                            ) ?>

                        </a>

                    <?php endforeach; ?>

                </div>

                <!-- Quick Links -->
                <div class="col-lg-3 col-md-6">

                    <h5 class="text-light mb-4">

                        Quick Links

                    </h5>

                    <a
                        class="btn btn-link"
                        href="<?= url('about') ?>"
                    >
                        About Us
                    </a>

                    <a
                        class="btn btn-link"
                        href="<?= url('services') ?>"
                    >
                        Services
                    </a>

                    <a
                        class="btn btn-link"
                        href="<?= url('projects') ?>"
                    >
                        Projects
                    </a>

                    <a
                        class="btn btn-link"
                        href="<?= url('quote') ?>"
                    >
                        Request Quote
                    </a>

                    <a
                        class="btn btn-link"
                        href="<?= url('contact') ?>"
                    >
                        Contact Us
                    </a>

                </div>

                <!-- Company -->
                <div class="col-lg-3 col-md-6">

                    <h5 class="text-light mb-4">

                        <?= htmlspecialchars(
                            $settings['site_name']
                            ?? 'Company'
                        ) ?>

                    </h5>

                    <p>

                        <?= htmlspecialchars(
                            $settings['site_tagline']
                            ?? ''
                        ) ?>

                    </p>

                    <p class="mb-0">

                        Working Hours:

                        <br>

                        <?= htmlspecialchars(
                            $settings['working_hours']
                            ?? ''
                        ) ?>

                    </p>

                </div>

            </div>

        </div>

    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div
        class="container-fluid py-4"
        style="background:#000000;"
    >

        <div class="container">

            <div class="row">

                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">

                    &copy;

                    <?= date('Y') ?>

                    <a
                        class="border-bottom"
                        href="<?= url('home') ?>"
                    >

                        <?= htmlspecialchars(
                            $settings['site_name']
                            ?? 'Company'
                        ) ?>

                    </a>

                    . All Rights Reserved.

                </div>

                <div class="col-md-6 text-center text-md-end">

                    <?= htmlspecialchars(
                        $settings['footer_text']
                        ?? ''
                    ) ?>

                </div>

            </div>

        </div>

    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a
        href="#"
        class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"
    >
        <i class="bi bi-arrow-up"></i>
    </a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= asset('lib/wow/wow.min.js') ?>"></script>
    <script src="<?= asset('lib/easing/easing.min.js') ?>"></script>
    <script src="<?= asset('lib/waypoints/waypoints.min.js') ?>"></script>
    <script src="<?= asset('lib/counterup/counterup.min.js') ?>"></script>
    <script src="<?= asset('lib/owlcarousel/owl.carousel.min.js') ?>"></script>
    <script src="<?= asset('lib/isotope/isotope.pkgd.min.js') ?>"></script>
    <script src="<?= asset('lib/lightbox/js/lightbox.min.js') ?>"></script>

    <!-- Template Javascript -->
    <script src="<?= asset('js/main.js') ?>"></script>

    <!-- Project Javascript -->
    <script src="<?= asset('js/script.js') ?>"></script>

</body>

</html>