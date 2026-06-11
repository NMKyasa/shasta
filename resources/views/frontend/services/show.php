<!-- Service Details Start -->
<div class="container py-5">

    <!-- Service Title -->
    <div class="mb-5">

        <h1 class="display-5 mb-3">

            <?= htmlspecialchars(
                $service['title']
            ) ?>

        </h1>

        <?php if (
            !empty(
                $service['summary']
            )
        ): ?>

            <p class="lead">

                <?= htmlspecialchars(
                    $service['summary']
                ) ?>

            </p>

        <?php endif; ?>

    </div>

    <!-- Featured Image -->
    <?php if (
        !empty($images)
    ): ?>

        <div class="mb-5">

            <img
                src="<?= url(
                    $images[0]['file_path']
                ) ?>"
                class="img-fluid rounded w-100"
                alt="<?= htmlspecialchars(
                    $service['title']
                ) ?>"
            >

        </div>

    <?php endif; ?>

    <!-- Service Content -->
    <div class="mb-5">

        <?= $service['body'] ?>

    </div>

    <!-- Service Gallery -->
    <?php if (
        count($images) > 1
    ): ?>

        <div class="mt-5">

            <div class="text-center mb-4">

                <h3>

                    Service Gallery

                </h3>

            </div>

            <div class="row g-4">

                <?php foreach ($images as $image): ?>

                    <div class="col-md-4 col-sm-6">

                        <a
                            href="<?= url(
                                $image['file_path']
                            ) ?>"
                            data-lightbox="service-gallery"
                        >

                            <img
                                src="<?= url(
                                    $image['file_path']
                                ) ?>"
                                class="img-fluid rounded shadow-sm"
                                alt="<?= htmlspecialchars(
                                    $service['title']
                                ) ?>"
                            >

                        </a>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    <?php endif; ?>

    <!-- Call To Action -->
    <div class="bg-light p-5 rounded text-center mt-5">

        <h3 class="mb-3">

            Need This Service?

        </h3>

        <p>

            Contact SHASTA Company Limited today for professional security solutions tailored to your needs.

        </p>

        <a
            href="<?= url('quote') ?>"
            class="btn btn-primary px-5"
        >

            Request a Free Quote

        </a>

    </div>

</div>
<!-- Service Details End -->