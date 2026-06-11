<div class="container py-5">

<div class="row">

    <div class="col-lg-8">

        <h1 class="mb-4">

            <?= htmlspecialchars(
                $project['title']
            ) ?>

        </h1>

        <?php if (!empty($project['featured_image'])): ?>

            <img
                src="<?= url(
                    $project['featured_image']
                ) ?>"
                class="img-fluid rounded mb-4"
                alt="<?= htmlspecialchars(
                    $project['title']
                ) ?>"
            >

        <?php endif; ?>

        <?php if (!empty($project['summary'])): ?>

            <div class="mb-5">

                <h3>
                    Project Summary
                </h3>

                <p>

                    <?= nl2br(
                        htmlspecialchars(
                            $project['summary']
                        )
                    ) ?>

                </p>

            </div>

        <?php endif; ?>

        <?php if (!empty($project['scope'])): ?>

            <div class="mb-5">

                <h3>
                    Scope of Work
                </h3>

                <?= $project['scope'] ?>

            </div>

        <?php endif; ?>

        <?php if (!empty($project['impact'])): ?>

            <div class="mb-5">

                <h3>
                    Project Impact
                </h3>

                <?= $project['impact'] ?>

            </div>

        <?php endif; ?>

        <?php if (!empty($project['body'])): ?>

            <div class="mb-5">

                <h3>
                    Project Details
                </h3>

                <?= $project['body'] ?>

            </div>

        <?php endif; ?>

    </div>

    <div class="col-lg-4">

        <div class="bg-light p-4 rounded">

            <h4 class="mb-4">
                Project Information
            </h4>

            <?php if (!empty($project['category_name'])): ?>

                <p>

                    <strong>
                        Category:
                    </strong>

                    <?= htmlspecialchars(
                        $project['category_name']
                    ) ?>

                </p>

            <?php endif; ?>

            <?php if (!empty($project['client_name'])): ?>

                <p>

                    <strong>
                        Client:
                    </strong>

                    <?= htmlspecialchars(
                        $project['client_name']
                    ) ?>

                </p>

            <?php endif; ?>

            <?php if (!empty($project['completion_date'])): ?>

                <p>

                    <strong>
                        Completion:
                    </strong>

                    <?= htmlspecialchars(
                        $project['completion_date']
                    ) ?>

                </p>

            <?php endif; ?>

        </div>

    </div>

</div>

<?php if (!empty($gallery)): ?>

    <div class="mt-5">

        <h3 class="mb-4">
            Project Gallery
        </h3>

        <div class="row">

            <?php foreach ($gallery as $image): ?>

                <div class="col-md-4 mb-4">

                    <a
                        href="<?= url(
                            $image['file_path']
                        ) ?>"
                        data-lightbox="project-gallery"
                    >

                        <img
                            src="<?= url(
                                $image['file_path']
                            ) ?>"
                            class="img-fluid rounded"
                            alt=""
                        >

                    </a>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

<?php endif; ?>

</div>
