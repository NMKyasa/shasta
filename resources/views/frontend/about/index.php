    <!-- Impact Start -->
    <div class="container-xxl py-5 impact-section">

        <div class="container">

            <div
                class="text-center wow fadeInUp"
                data-wow-delay="0.1s"
            >

                <div
                    class="bg-primary mb-3 mx-auto"
                    style="width:60px;height:2px;"
                ></div>

                <h1 class="display-5 mb-5">

                    Our Impact

                </h1>

            </div>

            <div class="row g-4">

                <?php foreach ($impacts as $index => $impact): ?>

                    <div
                        class="col-md-6 col-lg-3 wow fadeInUp"
                        data-wow-delay="<?= ($index + 1) * 0.2 ?>s"
                    >

                        <div
                            class="h-100 bg-dark text-center p-4 p-xl-5"
                        >

                            <h1
                                class="display-3 text-primary mb-3"
                            >

                                <?= htmlspecialchars(
                                    $impact['value']
                                ) ?>

                            </h1>

                            <h5 class="text-white">

                                <?= htmlspecialchars(
                                    $impact['label']
                                ) ?>

                            </h5>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    </div>
    <!-- Impact End -->


    <!-- About Start -->
    <div class="container-fluid about-section my-5 px-lg-0">
        <div class="container about px-lg-0">
            <div class="row g-0 mx-lg-0 ab-grid-row">
                <div class="col-lg-6 ps-lg-0 ab-img-col">
                    <div class="position-relative h-100 ab-img-wrap">
                        <img
                            class="position-absolute img-fluid w-100 h-100 ab-main-img"
                            src="/shasta/public/<?= htmlspecialchars($aboutImage['file_path'] ?? 'assets/frontend/img/about.jpg') ?>"
                            style="object-fit: cover;"
                            alt="<?= htmlspecialchars($settings['about_title'] ?? 'About Us') ?>"
                        >
                        <div class="ab-img-frame"></div>
                        <div class="ab-img-badge">
                            <div class="ab-img-badge-icon"><i class="fa fa-shield-alt"></i></div>
                            <div class="ab-img-badge-text">
                                <strong><?= (int)($settings['about_experience_years'] ?? 0) ?>+ Years</strong>
                                Trusted Security Partner
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 about-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-lg-5 pe-lg-0">
                        <div class="ab-tag">
                            <span></span>
                            <em>About Us</em>
                        </div>
                        <h1 class="display-5 mb-4 ab-title">
                            <?= htmlspecialchars($settings['about_title'] ?? 'About Us') ?>
                        </h1>
                        <p class="mb-4 pb-2 ab-text">
                            <?= nl2br(htmlspecialchars($settings['about_content'] ?? '')) ?>
                        </p>

                        <div class="row g-4 mb-4 pb-3 ab-mv-row">
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                                <div class="ab-mv-card">
                                    <h5 class="mb-3">Our Mission</h5>
                                    <span><?= nl2br(htmlspecialchars($settings['about_mission'] ?? '')) ?></span>
                                </div>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                                <div class="ab-mv-card">
                                    <h5 class="mb-3">Our Vision</h5>
                                    <span><?= nl2br(htmlspecialchars($settings['about_vision'] ?? '')) ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4 mb-4 pb-3 ab-stats-row">
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                                <div class="d-flex align-items-center ab-stat">
                                    <div class="ab-stat-icon">
                                        <i class="fa fa-medal"></i>
                                    </div>
                                    <div class="ms-4">
                                        <h2 class="mb-1"><?= (int)($settings['about_experience_years'] ?? 0) ?>+</h2>
                                        <p class="fw-medium text-primary mb-0">Years Experience</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                                <div class="d-flex align-items-center ab-stat">
                                    <div class="ab-stat-icon">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <div class="ms-4">
                                        <h2 class="mb-1">100+</h2>
                                        <p class="fw-medium text-primary mb-0">Clients Reached</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a
                            href="<?= htmlspecialchars($settings['about_button_url'] ?? '#') ?>"
                            class="btn btn-primary rounded-pill py-3 px-5 ab-cta"
                        >
                            <?= htmlspecialchars($settings['about_button_text'] ?? 'Learn More') ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->