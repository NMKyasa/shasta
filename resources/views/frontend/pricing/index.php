<!-- Pricing Start -->
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

                Our Pricing Plans

            </h1>

        </div>

        <div class="row g-4">

            <?php foreach ($pricingItems as $item): ?>

                <div
                    class="col-lg-4 col-md-6 wow fadeInUp"
                >

                    <div
                        class="card h-100 border-0 shadow-sm"
                    >

                        <?php if ($item['featured']): ?>

                            <div
                                class="badge bg-primary text-white p-2"
                            >

                                Most Popular

                            </div>

                        <?php endif; ?>

                        <div class="card-body">

                            <small
                                class="text-primary"
                            >

                                <?= htmlspecialchars(
                                    $item['service_title']
                                ) ?>

                            </small>

                            <h3 class="mt-2">

                                <?= htmlspecialchars(
                                    $item['title']
                                ) ?>

                            </h3>

                            <?php if (
                                !empty(
                                    $item['subtitle']
                                )
                            ): ?>

                                <p class="text-muted">

                                    <?= htmlspecialchars(
                                        $item['subtitle']
                                    ) ?>

                                </p>

                            <?php endif; ?>

                            <hr>

                            <?php if (
                                $item['pricing_type']
                                ===
                                'negotiable'
                            ): ?>

                                <h2 class="text-primary">

                                    Negotiable

                                </h2>

                            <?php else: ?>

                                <h2 class="text-primary">

                                    <?= htmlspecialchars(
                                        $item['currency']
                                    ) ?>

                                    <?= number_format(
                                        $item['price']
                                    ) ?>

                                </h2>

                            <?php endif; ?>

                            <?php if (
                                !empty(
                                    $item['pricing_period']
                                )
                            ): ?>

                                <p>

                                    <?= ucwords(
                                        str_replace(
                                            '_',
                                            ' ',
                                            $item['pricing_period']
                                        )
                                    ) ?>

                                </p>

                            <?php endif; ?>

                            <?php if (
                                !empty(
                                    $item['description']
                                )
                            ): ?>

                                <hr>

                                <p>

                                    <?= nl2br(
                                        htmlspecialchars(
                                            $item['description']
                                        )
                                    ) ?>

                                </p>

                            <?php endif; ?>

                        </div>

                        <div class="card-footer bg-white border-0">

                            <a
                                href="<?= url('quote') ?>"
                                class="btn btn-primary w-100"
                            >

                                Request Quote

                            </a>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</div>
<!-- Pricing End -->