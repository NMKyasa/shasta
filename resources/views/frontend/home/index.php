<!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5">
        <div class="owl-carousel header-carousel position-relative">

            <?php foreach (
                $sliders
                as
                $slider
            ): ?>

                <div class="owl-carousel-item position-relative">

                    <img
                        class="img-fluid"
                        src="<?= url(
                            $slider['file_path']
                        ) ?>"
                        alt="<?= htmlspecialchars(
                            $slider['title']
                        ) ?>"
                    >

                    <div class="carousel-inner">

                        <div class="container">

                            <div class="row justify-content-center">

                                <div class="col-lg-8 text-center">

                                    <h1
                                        class="display-3 text-white animated slideInDown mb-4"
                                    >

                                        <?= htmlspecialchars(
                                            $slider['title']
                                        ) ?>

                                    </h1>

                                    <p
                                        class="fs-5 text-white mb-4 pb-2"
                                    >

                                        <?= htmlspecialchars(
                                            $slider['subtitle']
                                        ) ?>

                                    </p>

                                    <?php if (
                                        !empty(
                                            $slider['button_url']
                                        )
                                    ): ?>

                                        <a
                                            href="<?= htmlspecialchars(
                                                $slider['button_url']
                                            ) ?>"
                                            class="btn btn-primary rounded-pill py-md-3 px-md-5 me-3"
                                        >

                                            <?= htmlspecialchars(
                                                $slider['button_text']
                                            ) ?>

                                        </a>

                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>
    </div>
    <!-- Carousel End -->


    <!-- Facts Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                    <div class="h-100 bg-dark p-4 p-xl-5">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="btn-square rounded-circle" style="width: 64px; height: 64px; background: #000000;">
                                <img class="img-fluid" src="img/icon/icon-3.png" alt="Icon">
                            </div>
                            <h1 class="display-1 mb-0" style="color: #000000;">01</h1>
                        </div>
                        <h5 class="text-white">Home Security</h5>
                        <hr class="w-25">
                        <span>Vero elitr justo clita lorem ipsum dolor at sed stet sit diam rebum ipsum et diam justo clita et</span>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                    <div class="h-100 bg-dark p-4 p-xl-5">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="btn-square rounded-circle" style="width: 64px; height: 64px; background: #000000;">
                                <img class="img-fluid" src="img/icon/icon-4.png" alt="Icon">
                            </div>
                            <h1 class="display-1 mb-0" style="color: #000000;">02</h1>
                        </div>
                        <h5 class="text-white">Access Control</h5>
                        <hr class="w-25">
                        <span>Vero elitr justo clita lorem ipsum dolor at sed stet sit diam rebum ipsum et diam justo clita et</span>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                    <div class="h-100 bg-dark p-4 p-xl-5">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="btn-square rounded-circle" style="width: 64px; height: 64px; background: #000000;">
                                <img class="img-fluid" src="img/icon/icon-2.png" alt="Icon">
                            </div>
                            <h1 class="display-1 mb-0" style="color: #000000;">03</h1>
                        </div>
                        <h5 class="text-white">24/7 Support</h5>
                        <hr class="w-25">
                        <span>Vero elitr justo clita lorem ipsum dolor at sed stet sit diam rebum ipsum et diam justo clita et</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts Start -->


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
                                        <img class="img-fluid" src="img/icon/icon-1.png" alt="Icon">
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
                                        <img class="img-fluid" src="img/icon/icon-5.png" alt="Icon">
                                    </div>
                                    <div class="ms-4">
                                        <h2 class="mb-1" data-toggle="counter-up">1234</h2>
                                        <p class="fw-medium text-primary mb-0">Projects Done</p>
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


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center">
                <div class="bg-primary mb-3 mx-auto" style="width: 60px; height: 2px;"></div>
                <h1 class="display-5 mb-5">Our Services</h1>
            </div>
            <div class="row g-0 service-row">

                <?php foreach (
                    $services
                    as
                    $service
                ): ?>

                    <div
                        class="col-md-6 col-lg-3 wow fadeIn"
                        data-wow-delay="0.1s"
                    >

                        <div
                            class="service-item border h-100 p-5"
                        >

                            <?php if (
                                !empty(
                                    $service['file_path']
                                )
                            ): ?>

                                <div class="mb-4">

                                    <img
                                        src="<?= url(
                                            $service['file_path']
                                        ) ?>"
                                        alt="<?= htmlspecialchars(
                                            $service['title']
                                        ) ?>"
                                        class="img-fluid"
                                    >

                                </div>

                            <?php endif; ?>

                            <h4 class="mb-3">

                                <?= htmlspecialchars(
                                    $service['title']
                                ) ?>

                            </h4>

                            <p class="mb-4">

                                <?= htmlspecialchars(
                                    $service['summary']
                                    ?? ''
                                ) ?>

                            </p>

                            <a
                                class="btn"
                                href="#"
                            >
                                <i
                                    class="fa fa-arrow-right text-white me-3"
                                ></i>

                                Read More

                            </a>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Feature Start -->
    <div class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
        <div class="container feature px-lg-0">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-6 feature-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-lg-5 ps-lg-0">
                        <div class="bg-primary mb-3" style="width: 60px; height: 2px;"></div>
                        <h1 class="display-5 mb-5">Why Choose Us</h1>
                        <p class="mb-4 pb-2">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo erat amet</p>
                        <div class="row g-4">
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="btn-square bg-white rounded-circle" style="width: 64px; height: 64px;">
                                        <img class="img-fluid" src="img/icon/icon-7.png" alt="Icon">
                                    </div>
                                    <div class="ms-4">
                                        <p class="text-primary mb-2">Trusted</p>
                                        <h5 class="mb-0">Security</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="btn-square bg-white rounded-circle" style="width: 64px; height: 64px;">
                                        <img class="img-fluid" src="img/icon/icon-10.png" alt="Icon">
                                    </div>
                                    <div class="ms-4">
                                        <p class="text-primary mb-2">Quality</p>
                                        <h5 class="mb-0">Services</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="btn-square bg-white rounded-circle" style="width: 64px; height: 64px;">
                                        <img class="img-fluid" src="img/icon/icon-3.png" alt="Icon">
                                    </div>
                                    <div class="ms-4">
                                        <p class="text-primary mb-2">Smart</p>
                                        <h5 class="mb-0">Systems</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="btn-square bg-white rounded-circle" style="width: 64px; height: 64px;">
                                        <img class="img-fluid" src="img/icon/icon-2.png" alt="Icon">
                                    </div>
                                    <div class="ms-4">
                                        <p class="text-primary mb-2">24/7 Hours</p>
                                        <h5 class="mb-0">Support</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pe-lg-0" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute img-fluid w-100 h-100" src="img/feature.jpg" style="object-fit: cover;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->


    <!-- Projects Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="bg-primary mb-3 mx-auto" style="width: 60px; height: 2px;"></div>
                <h1 class="display-5 mb-5">Our Projects</h1>
            </div>
            <div class="row mt-n2 wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-12 text-center">
                    <ul class="list-inline mb-5" id="portfolio-flters">
                        <li class="mx-2 active" data-filter="*">All</li>
                        <li class="mx-2" data-filter=".first">Complete Projects</li>
                        <li class="mx-2" data-filter=".second">Ongoing Projects</li>
                    </ul>
                </div>
            </div>
            <div class="row g-4 portfolio-container">

                <?php foreach (
                    $projects
                    as
                    $project
                ): ?>

                    <div
                        class="col-lg-4 col-md-6 portfolio-item wow fadeInUp"
                        data-wow-delay="0.1s"
                    >

                        <div class="portfolio-inner">

                            <?php if (
                                !empty(
                                    $project['file_path']
                                )
                            ): ?>

                                <img
                                    class="img-fluid w-100"
                                    src="<?= url(
                                        $project['file_path']
                                    ) ?>"
                                    alt="<?= htmlspecialchars(
                                        $project['title']
                                    ) ?>"
                                >

                            <?php endif; ?>

                            <div class="text-center p-4">

                                <h5 class="lh-base mb-0">

                                    <?= htmlspecialchars(
                                        $project['title']
                                    ) ?>

                                </h5>

                            </div>

                            <div
                                class="portfolio-text text-center bg-white p-4"
                            >

                                <h5 class="lh-base mb-3">

                                    <?= htmlspecialchars(
                                        $project['title']
                                    ) ?>

                                </h5>

                                <p>

                                    <?= htmlspecialchars(
                                        $project['summary']
                                        ?? ''
                                    ) ?>

                                </p>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>
        </div>
    </div>
    <!-- Projects End -->


    <!-- Quote Start -->
    <div class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
        <div class="container quote px-lg-0">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-6 ps-lg-0" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute img-fluid w-100 h-100" src="img/quote.jpg" style="object-fit: cover;" alt="">
                    </div>
                </div>
                <div class="col-lg-6 quote-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-lg-5 pe-lg-0">
                        <div class="bg-primary mb-3" style="width: 60px; height: 2px;"></div>
                        <h1 class="display-5 mb-5">Free Quote</h1>
                        <p class="mb-4 pb-2">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo erat amet</p>
                        <form>
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control border-0" placeholder="Your Name" style="height: 55px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="email" class="form-control border-0" placeholder="Your Email" style="height: 55px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control border-0" placeholder="Your Mobile" style="height: 55px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <select class="form-select border-0" style="height: 55px;">
                                        <option selected>Select A Service</option>
                                        <option value="1">Service 1</option>
                                        <option value="2">Service 2</option>
                                        <option value="3">Service 3</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control border-0" placeholder="Special Note"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Get A Free Quote</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quote End -->


    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="bg-primary mb-3 mx-auto" style="width: 60px; height: 2px;"></div>
                <h1 class="display-5 mb-5">Team Members</h1>
            </div>
            <div class="row g-4">

                <?php foreach ($teamMembers as $member): ?>

                    <div
                        class="col-lg-3 col-md-6 wow fadeInUp"
                        data-wow-delay="0.1s"
                    >

                        <div class="team-item">

                            <div class="overflow-hidden position-relative">

                                <?php if (!empty($member['file_path'])): ?>

                                    <img
                                        class="img-fluid"
                                        src="<?= url($member['file_path']) ?>"
                                        alt="<?= htmlspecialchars(
                                            $member['name']
                                        ) ?>"
                                    >

                                <?php else: ?>

                                    <img
                                        class="img-fluid"
                                        src="<?= url('assets/frontend/img/team-1.jpg') ?>"
                                        alt="<?= htmlspecialchars(
                                            $member['name']
                                        ) ?>"
                                    >

                                <?php endif; ?>

                                <div class="team-social">

                                    <?php if (!empty($member['facebook_url'])): ?>

                                        <a
                                            class="btn btn-square btn-dark rounded-circle m-1"
                                            href="<?= htmlspecialchars(
                                                $member['facebook_url']
                                            ) ?>"
                                            target="_blank"
                                        >
                                            <i class="fab fa-facebook-f"></i>
                                        </a>

                                    <?php endif; ?>

                                    <?php if (!empty($member['twitter_url'])): ?>

                                        <a
                                            class="btn btn-square btn-dark rounded-circle m-1"
                                            href="<?= htmlspecialchars(
                                                $member['twitter_url']
                                            ) ?>"
                                            target="_blank"
                                        >
                                            <i class="fab fa-twitter"></i>
                                        </a>

                                    <?php endif; ?>

                                    <?php if (!empty($member['linkedin_url'])): ?>

                                        <a
                                            class="btn btn-square btn-dark rounded-circle m-1"
                                            href="<?= htmlspecialchars(
                                                $member['linkedin_url']
                                            ) ?>"
                                            target="_blank"
                                        >
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>

                                    <?php endif; ?>

                                    <?php if (!empty($member['instagram_url'])): ?>

                                        <a
                                            class="btn btn-square btn-dark rounded-circle m-1"
                                            href="<?= htmlspecialchars(
                                                $member['instagram_url']
                                            ) ?>"
                                            target="_blank"
                                        >
                                            <i class="fab fa-instagram"></i>
                                        </a>

                                    <?php endif; ?>

                                </div>

                            </div>

                            <div class="text-center p-4">

                                <h5 class="mb-0">

                                    <?= htmlspecialchars(
                                        $member['name']
                                    ) ?>

                                </h5>

                                <span class="text-primary">

                                    <?= htmlspecialchars(
                                        $member['position']
                                        ?? ''
                                    ) ?>

                                </span>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="bg-primary mb-3 mx-auto" style="width: 60px; height: 2px;"></div>
                <h1 class="display-5 mb-5">Testimonial</h1>
            </div>
            <div
                class="owl-carousel testimonial-carousel wow fadeInUp"
                data-wow-delay="0.1s"
            >

                <?php foreach ($testimonials as $testimonial): ?>

                    <?php

                    $photo =
                        !empty($testimonial['file_path'])
                        ? url($testimonial['file_path'])
                        : url('assets/frontend/img/testimonial-1.jpg');

                    ?>

                    <div
                        class="testimonial-item text-center"
                        data-dot="<img class='img-fluid' src='<?= $photo ?>' alt='<?= htmlspecialchars($testimonial['name']) ?>'>"
                    >

                    <div class="mb-3">

                        <?php for ($i = 1; $i <= 5; $i++): ?>

                            <?php if ($i <= (int)$testimonial['rating']): ?>

                                <i class="fa fa-star text-warning"></i>

                            <?php else: ?>

                                <i class="far fa-star text-warning"></i>

                            <?php endif; ?>

                        <?php endfor; ?>

                    </div>

                        <p class="fs-5">

                            <?= nl2br(
                                htmlspecialchars(
                                    $testimonial['message']
                                )
                            ) ?>

                        </p>

                        <h4>

                            <?= htmlspecialchars(
                                $testimonial['name']
                            ) ?>

                        </h4>

                        <span class="text-primary">

                            <?= htmlspecialchars(
                                trim(
                                    ($testimonial['position'] ?? '')
                                    .
                                    (
                                        !empty($testimonial['company'])
                                        ? ' - ' . $testimonial['company']
                                        : ''
                                    )
                                )
                            ) ?>

                        </span>

                    </div>

                <?php endforeach; ?>

            </div>
        </div>
    </div>
    <!-- Testimonial End -->