<!-- Contact Start -->
<div class="container-fluid contact-section overflow-hidden px-lg-0">
    <div class="container contact px-lg-0">
        <div class="row g-0 mx-lg-0 ct-row">

            <div class="col-lg-5 contact-text py-5 wow fadeIn" data-wow-delay="0.5s">
                <div class="p-lg-5 ps-lg-0">
                    <div class="ct-tag">
                        <span></span><em>Contact Us</em>
                    </div>
                    <h1 class="display-5 mb-4 ct-title">Let's Talk Security</h1>
                    <p class="mb-4 ct-text">
                        At Shasta Company Limited, we are committed to providing reliable and professional
                        security solutions. Contact us today to discuss your requirements, request additional
                        information, or speak with a member of our team.
                    </p>

                    <div class="ct-info-list">
                        <div class="ct-info-item">
                            <div class="ct-info-icon"><i class="fa fa-map-marker-alt"></i></div>
                            <div>
                                <div class="ct-info-label">Location</div>
                                <div class="ct-info-value"><?= htmlspecialchars($settings['office_address'] ?? '') ?></div>
                            </div>
                        </div>
                        <div class="ct-info-item">
                            <div class="ct-info-icon"><i class="fa fa-phone-alt"></i></div>
                            <div>
                                <div class="ct-info-label">Phone</div>
                                <div class="ct-info-value"><?= htmlspecialchars($settings['phone_number'] ?? '') ?></div>
                            </div>
                        </div>
                        <div class="ct-info-item">
                            <div class="ct-info-icon"><i class="fa fa-envelope"></i></div>
                            <div>
                                <div class="ct-info-label">Email</div>
                                <div class="ct-info-value"><?= htmlspecialchars($settings['company_email'] ?? '') ?></div>
                            </div>
                        </div>
                        <div class="ct-info-item">
                            <div class="ct-info-icon"><i class="far fa-clock"></i></div>
                            <div>
                                <div class="ct-info-label">Working Hours</div>
                                <div class="ct-info-value"><?= htmlspecialchars($settings['working_hours'] ?? '') ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 pe-lg-0 ct-form-col py-5 wow fadeIn" data-wow-delay="0.7s">
                <div class="ct-form-wrap">

                    <?php if (!empty($_SESSION['success'])): ?>
                        <div class="ct-success">
                            <i class="fa fa-check-circle"></i>
                            <?= $_SESSION['success'] ?>
                        </div>
                        <?php unset($_SESSION['success']); ?>
                    <?php endif; ?>

                    <form method="POST" action="<?= url('contact') ?>" class="ct-form">

                        <input type="hidden" name="_token" value="<?= csrf_token() ?>">

                        <div class="row g-3">

                            <div class="col-md-6 ct-field">
                                <label>Your Name</label>
                                <input type="text" name="name" placeholder="John Doe" required>
                            </div>

                            <div class="col-md-6 ct-field">
                                <label>Your Email</label>
                                <input type="email" name="email" placeholder="john@example.com" required>
                            </div>

                            <div class="col-md-6 ct-field">
                                <label>Phone Number</label>
                                <input type="number" name="phone" placeholder="07XX XXX XXX">
                            </div>

                            <div class="col-md-6 ct-field">
                                <label>Subject</label>
                                <input type="text" name="subject" placeholder="How can we help?">
                            </div>

                            <div class="col-12 ct-field">
                                <label>Message</label>
                                <textarea name="message" placeholder="Leave a message here..." rows="5"></textarea>
                            </div>

                            <div class="col-12">
                                <button class="ct-submit" type="submit">
                                    Send Message <i class="fa fa-arrow-right"></i>
                                </button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Contact End -->