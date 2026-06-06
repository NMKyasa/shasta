    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center">
                <div class="bg-primary mb-3 mx-auto" style="width: 60px; height: 2px;"></div>
                <h1 class="display-5 mb-5">Our Services</h1>
            </div>
            <div class="row g-0 service-row">

                <?php foreach ($services as $service): ?>

                    <div class="col-md-6 col-lg-3 wow fadeIn">

                        <div class="service-item border h-100 p-5">

                            <?php if (!empty($service['file_path'])): ?>

                                <div class="mb-4">

                                    <img
                                        class="img-fluid"
                                        src="<?= url($service['file_path']) ?>"
                                        alt="<?= htmlspecialchars($service['title']) ?>"
                                    >

                                </div>

                            <?php endif; ?>

                            <h4 class="mb-3">

                                <?= htmlspecialchars($service['title']) ?>

                            </h4>

                            <p class="mb-4">

                                <?= htmlspecialchars($service['summary'] ?? '') ?>

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
     