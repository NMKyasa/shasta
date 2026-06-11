    <!-- Impact Start -->
    <div class="container-xxl py-5">

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
    <div class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
        <div class="container about px-lg-0">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-6 ps-lg-0" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        
                        <!-- About Image -->
                        <img
                            class="position-absolute img-fluid w-100 h-100"
                            src="/shasta/public/<?= htmlspecialchars(
                                $aboutImage['file_path']
                                ?? 'assets/frontend/img/about.jpg'
                            ) ?>"
                            style="object-fit: cover;"
                            alt="<?= htmlspecialchars(
                                $settings['about_title']
                                ?? 'About Us'
                            ) ?>"
                        >
                    </div>
                </div>

                <!-- About Text -->
                <div class="col-lg-6 about-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-lg-5 pe-lg-0">
                        <div class="bg-primary mb-3" style="width: 60px; height: 2px;"></div>
                        <h1 class="display-5 mb-4">
                            <?= htmlspecialchars(
                                $settings['about_title']
                                ?? 'About Us'
                            ) ?>
                        </h1>
                        <p class="mb-4 pb-2">
                            <?= nl2br(
                                htmlspecialchars(
                                    $settings['about_content']
                                    ?? ''
                                )
                            ) ?>
                        </p>

                        <!-- Mission and Vision -->
                        <div class="row g-4 mb-4 pb-3">
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                                <h5 class="mb-3">Our Mission</h5>
                                <span>
                                    <?= nl2br(
                                        htmlspecialchars(
                                            $settings['about_mission']
                                            ?? ''
                                        )
                                    ) ?>
                                </span>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                                <h5 class="mb-3">Our Vision</h5>
                                <span>
                                    <?= nl2br(
                                        htmlspecialchars(
                                            $settings['about_vision']
                                            ?? ''
                                        )
                                    ) ?>
                                </span>
                            </div>

                        <!-- Experience Stats -->
                        <div class="row g-4 mb-4 pb-3">
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                                <div class="d-flex align-items-center">
                                    <div class="btn-square bg-white rounded-circle" style="width: 64px; height: 64px;">
                                        <img class="img-fluid" src="assets/frontend/img/icon/icon-1.png" alt="Icon">
                                    </div>
                                    <div class="ms-4">
                                        <h2
                                            class="mb-1"
                                            data-toggle="counter-up"
                                        >
                                            <?= (int)(
                                                $settings['about_experience_years']
                                                ?? 0
                                            ) ?>
                                        </h2>
                                        <p class="fw-medium text-primary mb-0">Years Experience</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Projects Done -->
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                                <div class="d-flex align-items-center">
                                    <div class="btn-square bg-white rounded-circle" style="width: 64px; height: 64px;">
                                        <img class="img-fluid" src="assets/frontend/img/icon/icon-5.png" alt="Icon">
                                    </div>
                                    <div class="ms-4">
                                        <h2 class="mb-1" data-toggle="counter-up">100</h2>
                                        <p class="fw-medium text-primary mb-0">Clients Reached</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Call to Action -->
                        <a
                            href="<?= htmlspecialchars(
                                $settings['about_button_url']
                                ?? '#'
                            ) ?>"
                            class="btn btn-primary rounded-pill py-3 px-5"
                        >
                            <?= htmlspecialchars(
                                $settings['about_button_text']
                                ?? 'Learn More'
                            ) ?>
                        </a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
