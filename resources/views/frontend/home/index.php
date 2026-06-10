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
                                        <h2 class="mb-1" data-toggle="counter-up">10</h2>
                                        <p class="fw-medium text-primary mb-0">Projects Done</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Call to Action -->
                        <a
                            href="<?= url('about') ?>"
                            class="btn btn-primary rounded-pill py-3 px-5"
                        >
                            Learn More About SHASTA
                        </a>
                            
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
                                href="<?= url('services/' . $service['slug']) ?>"
                            >

                                <i class="fa fa-arrow-right text-white me-3"></i>

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
                                        <img class="img-fluid" src="assets/frontend/img/icon/icon-7.png" alt="Icon">
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
                                        <img class="img-fluid" src="assets/frontend/img/icon/icon-10.png" alt="Icon">
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
                                        <img class="img-fluid" src="assets/frontend/img/icon/icon-3.png" alt="Icon">
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
                                        <img class="img-fluid" src="assets/frontend/img/icon/icon-2.png" alt="Icon">
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
                        <img class="position-absolute img-fluid w-100 h-100" src="assets/frontend/img/feature.jpg" style="object-fit: cover;" alt="">
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

                        <li
                            class="mx-2 active"
                            data-filter="*"
                        >
                            All
                        </li>

                        <?php foreach ($categories as $category): ?>

                            <li
                                class="mx-2"
                                data-filter=".<?= htmlspecialchars(
                                    $category['slug']
                                ) ?>"
                            >

                                <?= htmlspecialchars(
                                    $category['name']
                                ) ?>

                            </li>

                        <?php endforeach; ?>

                    </ul>
                </div>
            </div>
            <div class="row g-4 portfolio-container">

                <?php foreach ($projects as $project): ?>

                    <div
                        class="col-lg-4 col-md-6 portfolio-item <?= htmlspecialchars(
                            $project['category_slug'] ?? ''
                        ) ?> wow fadeInUp"
                        data-wow-delay="0.1s"
                    >

                        <div class="portfolio-inner">

                            <?php if (!empty($project['file_path'])): ?>

                                <a
                                    href="<?= url(
                                        'projects/' .
                                        $project['slug']
                                    ) ?>"
                                >
                                    <img
                                        class="img-fluid w-100"
                                        src="<?= url(
                                            $project['file_path']
                                        ) ?>"
                                        alt="<?= htmlspecialchars(
                                            $project['title']
                                        ) ?>"
                                    >
                                </a>

                            <?php endif; ?>

                            <div class="text-center p-4">

                                <p class="text-primary mb-2">

                                    <?= htmlspecialchars(
                                        $project['category_name']
                                        ?? 'Project'
                                    ) ?>

                                </p>

                                <h5 class="lh-base mb-0">

                                <a
                                    href="<?= url(
                                        'projects/' .
                                        $project['slug']
                                    ) ?>"
                                >

                                    <?= htmlspecialchars(
                                        $project['title']
                                    ) ?>

                                </a>

                            </h5>

                            </div>

                            <div class="portfolio-text text-center bg-white p-4">

                                <p class="text-primary mb-2">

                                    <?= htmlspecialchars(
                                        $project['category_name']
                                        ?? 'Project'
                                    ) ?>

                                </p>

                                <h5 class="lh-base mb-3">

                                    <?= htmlspecialchars($project['title']) ?>

                                </h5>

                                <div class="d-flex justify-content-center">

                                    <?php if (!empty($project['file_path'])): ?>

                                        <a
                                            class="btn btn-square btn-primary rounded-circle mx-1"
                                            href="<?= url($project['file_path']) ?>"
                                            data-lightbox="portfolio"
                                        >
                                            <i class="fa fa-eye"></i>
                                        </a>

                                    <?php endif; ?>

                                    <a
                                        class="btn btn-square btn-primary rounded-circle mx-1"
                                        href="<?= url('projects/' . $project['slug']) ?>"
                                    >
                                        <i class="fa fa-link"></i>
                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>
        </div>
    </div>
    <!-- Projects End -->


<!-- Quote Start -->
    <div class="container-fluid bg-light overflow-hidden px-lg-0">
        <div class="container quote px-lg-0">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-6 ps-lg-0" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute img-fluid w-100 h-100" src="assets/frontend/img/quote.jpg" style="object-fit: cover;" alt="">
                    </div>
                </div>
                <div class="col-lg-6 quote-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-lg-5 pe-lg-0">
                        <div class="bg-primary mb-3" style="width: 60px; height: 2px;"></div>
                        <h1 class="display-5 mb-5">Free Quote</h1>
                        <p class="mb-4 pb-2">
                        Tell us about your security requirements and our team will prepare a tailored solution for your home, business, institution, or project. 
                        Submit your request and we will get back to you with a professional quotation.
                        </p>

                        <?php if (!empty($_SESSION['success'])): ?>

                            <div class="alert alert-success">

                                <?= $_SESSION['success'] ?>

                            </div>

                            <?php unset($_SESSION['success']); ?>

                        <?php endif; ?>

                        <form
                            method="POST"
                            action="<?= url('quote') ?>"
                        >

                            <input
                                type="hidden"
                                name="_token"
                                value="<?= csrf_token() ?>"
                            >

                            <div class="row g-3">

                                <div class="col-12 col-sm-6">

                                    <input
                                        type="text"
                                        name="name"
                                        class="form-control border-0"
                                        placeholder="Your Name"
                                        required
                                        style="height:55px;"
                                    >

                                </div>

                                <div class="col-12 col-sm-6">

                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control border-0"
                                        placeholder="Your Email"
                                        required
                                        style="height:55px;"
                                    >

                                </div>

                                <div class="col-12 col-sm-6">

                                    <input
                                        type="number"
                                        name="phone"
                                        class="form-control border-0"
                                        placeholder="Your Mobile"
                                        style="height:55px;"
                                    >

                                </div>

                                <div class="col-12 col-sm-6">

                                    <select
                                        name="service_id"
                                        class="form-select border-0"
                                        required
                                        style="height:55px;"
                                    >

                                        <option value="">
                                            Select A Service
                                        </option>

                                        <?php foreach ($services as $service): ?>

                                            <option
                                                value="<?= $service['id'] ?>"
                                            >

                                                <?= htmlspecialchars(
                                                    $service['title']
                                                ) ?>

                                            </option>

                                        <?php endforeach; ?>

                                    </select>

                                </div>

                                <div class="col-12">

                                    <textarea
                                        name="message"
                                        class="form-control border-0"
                                        placeholder="Describe your requirements"
                                        rows="5"
                                    ></textarea>

                                </div>

                                <div class="col-12">

                                    <button
                                        class="btn btn-primary w-100 py-3"
                                        type="submit"
                                    >

                                        Request Free Quote

                                    </button>

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

                                <h5 class="mb-1">

                                    <?= htmlspecialchars(
                                        $member['name']
                                    ) ?>

                                </h5>

                                <span class="text-primary d-block mb-2">

                                    <?= htmlspecialchars(
                                        $member['position']
                                        ?? ''
                                    ) ?>

                                </span>

                                <?php if (!empty($member['bio'])): ?>

                                    <p class="small text-muted mb-0">

                                        <?= htmlspecialchars(
                                            mb_strimwidth(
                                                strip_tags($member['bio']),
                                                0,
                                                120,
                                                '...'
                                            )
                                        ) ?>

                                    </p>

                                <?php endif; ?>

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