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