<!-- projects/show.php -->
<!-- Requires: projects.css loaded in your layout -->

<div class="container project-detail-wrap">

    <!-- Back button -->
    <a href="<?= url('projects') ?>" class="btn-back-projects">
        <i class="fa fa-arrow-left"></i>
        Back to Projects
    </a>

    <div class="row g-5">

        <!-- ── Main Content ── -->
        <div class="col-lg-8">

            <h1><?= htmlspecialchars($project['title']) ?></h1>

            <?php if (!empty($project['featured_image'])): ?>
                <img
                    src="<?= url($project['featured_image']) ?>"
                    class="project-hero-img"
                    alt="<?= htmlspecialchars($project['title']) ?>"
                >
            <?php endif; ?>

            <?php if (!empty($project['summary'])): ?>
                <div class="mb-5">
                    <h3>Project Summary</h3>
                    <p><?= nl2br(htmlspecialchars($project['summary'])) ?></p>
                </div>
            <?php endif; ?>

            <?php if (!empty($project['scope'])): ?>
                <div class="mb-5">
                    <h3>Scope of Work</h3>
                    <?= $project['scope'] ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($project['impact'])): ?>
                <div class="mb-5">
                    <h3>Project Impact</h3>
                    <?= $project['impact'] ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($project['body'])): ?>
                <div class="mb-5">
                    <h3>Project Details</h3>
                    <?= $project['body'] ?>
                </div>
            <?php endif; ?>

        </div>

        <!-- ── Sidebar ── -->
        <div class="col-lg-4">
            <div class="project-info-card">

                <h4>Project Information</h4>

                <div class="project-info-row">

                    <?php if (!empty($project['category_name'])): ?>
                        <div class="project-info-item">
                            <span class="info-label">Category</span>
                            <span class="info-value"><?= htmlspecialchars($project['category_name']) ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($project['client_name'])): ?>
                        <div class="project-info-item">
                            <span class="info-label">Client</span>
                            <span class="info-value"><?= htmlspecialchars($project['client_name']) ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($project['completion_date'])): ?>
                        <div class="project-info-item">
                            <span class="info-label">Completion</span>
                            <span class="info-value"><?= htmlspecialchars($project['completion_date']) ?></span>
                        </div>
                    <?php endif; ?>

                </div>

            </div>
        </div>

    </div><!-- /row -->

    <!-- ── Gallery ── -->
    <?php if (!empty($gallery)): ?>
        <div class="project-gallery-section mt-5">

            <h3>Project Gallery</h3>

            <div class="row g-3 mt-1">
                <?php foreach ($gallery as $image): ?>
                    <div class="col-md-4 col-sm-6">
                        <a
                            href="<?= url($image['file_path']) ?>"
                            data-lightbox="project-gallery"
                            class="gallery-img-wrap d-block"
                        >
                            <img
                                src="<?= url($image['file_path']) ?>"
                                class="img-fluid"
                                alt=""
                                loading="lazy"
                            >
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    <?php endif; ?>

    <!-- ── Prev / Next Navigator ── -->
    <?php if (!empty($prev_project) || !empty($next_project)): ?>
        <nav class="project-nav-dock" aria-label="Browse projects">

            <!-- Previous -->
            <?php if (!empty($prev_project)): ?>
                <a href="<?= url('projects/' . $prev_project['slug']) ?>" class="project-nav-link nav-prev">

                    <?php if (!empty($prev_project['file_path'])): ?>
                        <img
                            class="project-nav-thumb"
                            src="<?= url($prev_project['file_path']) ?>"
                            alt=""
                        >
                    <?php else: ?>
                        <div class="project-nav-thumb-placeholder">
                            <i class="fa fa-image"></i>
                        </div>
                    <?php endif; ?>

                    <div class="project-nav-meta">
                        <div class="project-nav-direction">
                            <i class="fa fa-arrow-left"></i>
                            Previous
                        </div>
                        <div class="project-nav-title">
                            <?= htmlspecialchars($prev_project['title']) ?>
                        </div>
                        <?php if (!empty($prev_project['category_name'])): ?>
                            <div class="project-nav-cat">
                                <?= htmlspecialchars($prev_project['category_name']) ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </a>
            <?php else: ?>
                <div></div>
            <?php endif; ?>

            <!-- Next -->
            <?php if (!empty($next_project)): ?>
                <a href="<?= url('projects/' . $next_project['slug']) ?>" class="project-nav-link nav-next">

                    <?php if (!empty($next_project['file_path'])): ?>
                        <img
                            class="project-nav-thumb"
                            src="<?= url($next_project['file_path']) ?>"
                            alt=""
                        >
                    <?php else: ?>
                        <div class="project-nav-thumb-placeholder">
                            <i class="fa fa-image"></i>
                        </div>
                    <?php endif; ?>

                    <div class="project-nav-meta">
                        <div class="project-nav-direction">
                            Next
                            <i class="fa fa-arrow-right"></i>
                        </div>
                        <div class="project-nav-title">
                            <?= htmlspecialchars($next_project['title']) ?>
                        </div>
                        <?php if (!empty($next_project['category_name'])): ?>
                            <div class="project-nav-cat">
                                <?= htmlspecialchars($next_project['category_name']) ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </a>
            <?php endif; ?>

        </nav>
    <?php endif; ?>

</div>