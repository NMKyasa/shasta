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