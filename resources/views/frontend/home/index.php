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
                            src="/shasta/public/<?= htmlspecialchars($aboutImage['file_path'] ?? 'assets/frontend/img/shasta-home-protection-services.png') ?>"
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


    <!-- Services Start -->
    <div class="container-xxl py-5 services-section">
        <div class="container">

            <div class="text-center wow fadeInUp sv-head">
                <div class="sv-tag">
                    <span></span><em>Our Services</em><span></span>
                </div>
                <h1 class="display-5 mb-0 sv-title">Comprehensive Security Solutions</h1>
            </div>

            <div class="owl-carousel services-carousel">
                <?php foreach ($services as $service): ?>
                    <div class="sv-card">
                        <?php if (!empty($service['file_path'])): ?>
                            <a href="<?= url('services/' . $service['slug']) ?>" class="sv-card-img">
                                <img
                                    src="<?= url($service['file_path']) ?>"
                                    alt="<?= htmlspecialchars($service['title']) ?>"
                                >
                            </a>
                        <?php endif; ?>

                        <div class="sv-card-body">
                            <h4>
                                <a href="<?= url('services/' . $service['slug']) ?>">
                                    <?= htmlspecialchars($service['title']) ?>
                                </a>
                            </h4>

                            <?php if (!empty($service['summary'])): ?>
                                <p><?= htmlspecialchars(mb_strimwidth($service['summary'], 0, 180, '...')) ?></p>
                            <?php endif; ?>

                            <a href="<?= url('services/' . $service['slug']) ?>" class="sv-card-link">
                                Learn More <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="text-center mt-5 sv-cta-wrap">
                <a href="<?= url('quote') ?>" class="btn sv-cta-btn">
                    Request a Free Quote
                </a>
            </div>

        </div>
    </div>
    <!-- Services End -->

    <!-- Feature Start -->
    <div class="container-fluid feature-section my-5 px-lg-0">
        <div class="container feature px-lg-0">
            <div class="row g-0 mx-lg-0 ft-row">

                <div class="col-lg-6 feature-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-lg-5 ps-lg-0">
                        <div class="ft-tag">
                            <span></span><em>Why Choose Us</em>
                        </div>
                        <h1 class="display-5 mb-4 ft-title">Security Built on Trust &amp; Excellence</h1>
                        <p class="mb-4 pb-2 ft-text">
                            Shasta Security is a licensed Ugandan security company trusted by hospitals, retail chains, and corporate offices.
                            We deliver reliable protection through certified guards, advanced surveillance systems, and 24/7 customer support.
                            Our commitment to quality, innovation, and professionalism ensures clients enjoy peace of mind and measurable safety improvements.
                        </p>

                        <div class="row g-3 ft-grid2">
                            <div class="col-6">
                                <div class="ft-item">
                                    <div class="ft-icon"><i class="fa fa-shield-alt"></i></div>
                                    <div>
                                        <div class="ft-item-label">Trusted</div>
                                        <div class="ft-item-title">Security</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="ft-item">
                                    <div class="ft-icon"><i class="fa fa-award"></i></div>
                                    <div>
                                        <div class="ft-item-label">Quality</div>
                                        <div class="ft-item-title">Services</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="ft-item">
                                    <div class="ft-icon"><i class="fa fa-video"></i></div>
                                    <div>
                                        <div class="ft-item-label">Smart</div>
                                        <div class="ft-item-title">Systems</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="ft-item">
                                    <div class="ft-icon"><i class="fa fa-headset"></i></div>
                                    <div>
                                        <div class="ft-item-label">24/7 Hours</div>
                                        <div class="ft-item-title">Support</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 pe-lg-0 ft-img-col">
                    <div class="position-relative h-100 ft-img-wrap">
                        <img
                            class="position-absolute img-fluid w-100 h-100"
                            src="<?= asset('assets/frontend/img/shasta-home-protection-services.png') ?>"
                            style="object-fit: cover;"
                            alt="Shasta Home Protection Services"
                        >
                        <div class="ft-img-frame"></div>
                        <div class="ft-img-badge">
                            <i class="fa fa-check-circle"></i>
                            <div class="ft-img-badge-text"><strong>Licensed</strong>&amp; Certified</div>
                        </div>
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
                <span class="projects-section-label">Portfolio</span>
                <h1 class="display-5 mb-5">Our Projects</h1>
            </div>

            <div class="row mt-n2 wow fadeInUp" data-wow-delay="0.2s">
                <div class="col-12 text-center">
                    <ul class="list-inline mb-0" id="portfolio-flters">

                        <li class="mx-1 active" data-filter="*">
                            All
                        </li>

                        <?php foreach ($categories as $category): ?>
                            <li
                                class="mx-1"
                                data-filter="<?= htmlspecialchars($category['slug']) ?>"
                            >
                                <?= htmlspecialchars($category['name']) ?>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                </div>
            </div>

            <div class="row g-4 portfolio-container mt-2">

                <?php foreach ($projects as $project): ?>

                    <div
                        class="col-lg-4 col-md-6 portfolio-item <?= htmlspecialchars($project['category_slug'] ?? '') ?> wow fadeInUp"
                        data-wow-delay="0.1s"
                    >
                        <!-- Entire card is one link for full clickability -->
                        <a
                            href="<?= url('projects/' . $project['slug']) ?>"
                            class="portfolio-inner"
                            aria-label="View <?= htmlspecialchars($project['title']) ?>"
                        >

                            <?php if (!empty($project['file_path'])): ?>
                                <div class="portfolio-img-wrap">
                                    <img
                                        class="img-fluid w-100"
                                        src="<?= url($project['file_path']) ?>"
                                        alt="<?= htmlspecialchars($project['title']) ?>"
                                        loading="lazy"
                                    >
                                </div>
                            <?php endif; ?>

                            <!-- Always-visible card footer -->
                            <div class="portfolio-card-body">
                                <p class="portfolio-cat">
                                    <?= htmlspecialchars($project['category_name'] ?? 'Project') ?>
                                </p>
                                <h5 class="portfolio-title">
                                    <?= htmlspecialchars($project['title']) ?>
                                </h5>
                            </div>

                            <!-- Hover overlay -->
                            <div class="portfolio-text">

                                <p class="text-primary mb-2">
                                    <?= htmlspecialchars($project['category_name'] ?? 'Project') ?>
                                </p>

                                <h5 class="lh-base mb-3">
                                    <?= htmlspecialchars($project['title']) ?>
                                </h5>

                                <div class="d-flex">

                                    <?php if (!empty($project['file_path'])): ?>
                                        <!-- Stop propagation so lightbox doesn't also navigate to project -->
                                        <span
                                            class="btn btn-square btn-primary rounded-circle mx-1 portfolio-lightbox-btn"
                                            data-lightbox-src="<?= url($project['file_path']) ?>"
                                            data-lightbox="portfolio"
                                            title="Quick view"
                                            role="button"
                                        >
                                            <i class="fa fa-eye"></i>
                                        </span>
                                    <?php endif; ?>

                                    <span
                                        class="btn btn-square btn-primary rounded-circle mx-1"
                                        title="View project"
                                        role="button"
                                    >
                                        <i class="fa fa-link"></i>
                                    </span>

                                </div>

                            </div>

                        </a>
                    </div>

                <?php endforeach; ?>

            </div>
        </div>
    </div>
    <!-- Projects End -->



    <!-- Quote Start -->
    <div class="container-fluid quote-section overflow-hidden px-lg-0">
        <div class="container quote px-lg-0">
            <div class="row g-0 mx-lg-0 qt-row">

                <div class="col-lg-6 ps-lg-0 qt-img-col">
                    <div class="position-relative h-100 qt-img-wrap">
                        <img
                            class="position-absolute img-fluid w-100 h-100"
                            src="<?= asset('assets/frontend/img/shasta-warehouse-protection-services.png') ?>"
                            style="object-fit: cover;"
                            alt="Request a Quote"
                        >
                        <div class="qt-img-overlay"></div>
                        <div class="qt-img-frame"></div>

                        <div class="qt-badges">
                            <div class="qt-badge"><i class="fa fa-bolt"></i> Fast Response</div>
                            <div class="qt-badge"><i class="fa fa-tag"></i> No Obligation</div>
                        </div>

                        <div class="qt-img-text">
                            <h3>Tailored to Your Needs</h3>
                            <p>Whether for a home, business, institution, or special event — get a quote built around your specific requirements.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 quote-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-lg-5 pe-lg-0">
                        <div class="qt-tag">
                            <span></span><em>Get Started</em>
                        </div>
                        <h1 class="display-5 mb-4 qt-title">Request Your Free Quote</h1>
                        <p class="mb-4 pb-2 qt-text">
                            Tell us about your security requirements and our team will prepare a tailored solution for your home, business, institution, or project.
                            Submit your request and we will get back to you with a professional quotation.
                        </p>

                        <?php if (!empty($_SESSION['success'])): ?>
                            <div class="qt-success">
                                <i class="fa fa-check-circle"></i>
                                <?= $_SESSION['success'] ?>
                            </div>
                            <?php unset($_SESSION['success']); ?>
                        <?php endif; ?>

                        <form method="POST" action="<?= url('quote') ?>" class="qt-form">

                            <input type="hidden" name="_token" value="<?= csrf_token() ?>">

                            <div class="row g-3">

                                <div class="col-12 col-sm-6 qt-field">
                                    <label>
                                        Your Name
                                        <span class="qt-required">*</span>
                                    </label>
                                    <input type="text" name="name" placeholder="Braham Grant" required>
                                </div>

                                <div class="col-12 col-sm-6 qt-field">
                                    <label>
                                        Your Email
                                        <span class="qt-required">*</span>
                                    </label>
                                    <input type="email" name="email" placeholder="brahamgrant@example.com" required>
                                </div>

                                <div class="col-12 col-sm-6 qt-field">
                                    <label>Your Mobile <small>(Optional)</small></label>
                                    <input type="number" name="phone" placeholder="07XX XXX XXX">
                                </div>

                                <!-- Services Dropdown -->
                                <div class="col-12 col-sm-6 qt-field">
                                    <label>Service Needed <small>(Optional)</small></label>

                                    <select name="service_id" class="qt-select">
                                        <option value="">
                                            I am not sure yet
                                        </option>

                                        <?php foreach ($services as $service): ?>

                                            <option value="<?= $service['id'] ?>">

                                                <?= htmlspecialchars($service['title']) ?>

                                            </option>

                                        <?php endforeach; ?>

                                    </select>
                                </div>

                                <div class="col-12 qt-field">
                                    <label>Your Requirements</label>
                                    <textarea name="message" placeholder="Describe your requirements..." rows="5"></textarea>
                                </div>

                                <div class="col-12">
                                    <button class="qt-submit" type="submit">
                                        Request Free Quote <i class="fa fa-arrow-right"></i>
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

                                    <p class="small text-muted mb-0"
                                        data-full-bio="<?= htmlspecialchars(strip_tags($member['bio'])) ?>">
                                        <?= htmlspecialchars(mb_strimwidth(strip_tags($member['bio']), 0, 120, '...')) ?>
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