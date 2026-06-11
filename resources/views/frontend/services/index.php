<!-- Services Start -->
<div class="container-xxl py-5">

    <div class="container">

        <!-- Section Header -->
        <div class="text-center wow fadeInUp">

            <div
                class="bg-primary mb-3 mx-auto"
                style="width:60px;height:2px;"
            ></div>

            <h1 class="display-5 mb-5">

                Our Services

            </h1>

        </div>

        <!-- Services Grid -->
        <div class="row g-4">

            <?php foreach ($services as $service): ?>

                <div
                    class="col-lg-4 col-md-6 wow fadeInUp"
                >

                    <div
                        class="service-item border rounded overflow-hidden h-100 shadow-sm"
                    >

                        <!-- Service Image -->
                        <?php if (
                            !empty(
                                $service['file_path']
                            )
                        ): ?>

                            <a
                                href="<?= url(
                                    'services/'
                                    .
                                    $service['slug']
                                ) ?>"
                            >

                                <img
                                    src="<?= url(
                                        $service['file_path']
                                    ) ?>"
                                    class="img-fluid w-100"
                                    alt="<?= htmlspecialchars(
                                        $service['title']
                                    ) ?>"
                                    style="
                                        height:250px;
                                        object-fit:cover;
                                    "
                                >

                            </a>

                        <?php endif; ?>

                        <!-- Service Content -->
                        <div class="p-4">

                            <h4 class="mb-3">

                                <a
                                    href="<?= url(
                                        'services/'
                                        .
                                        $service['slug']
                                    ) ?>"
                                    class="text-dark text-decoration-none"
                                >

                                    <?= htmlspecialchars(
                                        $service['title']
                                    ) ?>

                                </a>

                            </h4>

                            <?php if (
                                !empty(
                                    $service['summary']
                                )
                            ): ?>

                                <p class="mb-4">

                                    <?= htmlspecialchars(
                                        mb_strimwidth(
                                            $service['summary'],
                                            0,
                                            180,
                                            '...'
                                        )
                                    ) ?>

                                </p>

                            <?php endif; ?>

                            <a
                                href="<?= url(
                                    'services/'
                                    .
                                    $service['slug']
                                ) ?>"
                                class="btn btn-primary"
                            >

                                Learn More

                            </a>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

        <!-- CTA -->
        <div
            class="text-center mt-5"
        >

            <a
                href="<?= url('quote') ?>"
                class="btn btn-primary btn-lg px-5"
            >

                Request a Free Quote

            </a>

        </div>

    </div>

</div>
<!-- Services End -->