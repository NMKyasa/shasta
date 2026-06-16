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