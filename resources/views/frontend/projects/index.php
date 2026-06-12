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
                    <div class="portfolio-inner position-relative">

                        <?php if (!empty($project['file_path'])): ?>
                            <a href="<?= url('projects/' . $project['slug']) ?>">
                                <img
                                    class="img-fluid w-100"
                                    src="<?= url($project['file_path']) ?>"
                                    alt="<?= htmlspecialchars($project['title']) ?>"
                                    loading="lazy"
                                >
                            </a>
                        <?php endif; ?>

                        <a
                            href="<?= url('projects/' . $project['slug']) ?>"
                            class="stretched-link project-card-link"
                            aria-label="<?= htmlspecialchars($project['title']) ?>"
                        ></a>

                        <!-- Always-visible card footer -->
                        <div class="text-center p-4">
                            <p class="text-primary mb-2">
                                <?= htmlspecialchars($project['category_name'] ?? 'Project') ?>
                            </p>
                            <h5 class="lh-base mb-0">
                                <a href="<?= url('projects/' . $project['slug']) ?>">
                                    <?= htmlspecialchars($project['title']) ?>
                                </a>
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
                                    <a
                                        class="btn btn-square btn-primary rounded-circle mx-1"
                                        href="<?= url($project['file_path']) ?>"
                                        data-lightbox="portfolio"
                                        title="Quick view"
                                    >
                                        <i class="fa fa-eye"></i>
                                    </a>
                                <?php endif; ?>

                                <a
                                    class="btn btn-square btn-primary rounded-circle mx-1"
                                    href="<?= url('projects/' . $project['slug']) ?>"
                                    title="View project"
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
