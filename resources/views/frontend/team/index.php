<!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="bg-primary mb-3 mx-auto" style="width: 60px; height: 2px;"></div>
                <h1 class="display-5 mb-5">Team Members</h1>
            </div>
            <div class="row g-4">

                <?php foreach ($teamMembers as $member): ?>

                    <div
                        class="col-lg-3 col-md-6 wow fadeInUp"
                        data-wow-delay="0.1s"
                    >

                        <div class="team-item">

                            <div class="overflow-hidden position-relative">

                                <?php if (!empty($member['file_path'])): ?>

                                    <img
                                        class="img-fluid"
                                        src="<?= url($member['file_path']) ?>"
                                        alt="<?= htmlspecialchars(
                                            $member['name']
                                        ) ?>"
                                    >

                                <?php else: ?>

                                    <img
                                        class="img-fluid"
                                        src="<?= url('assets/frontend/img/team-1.jpg') ?>"
                                        alt="<?= htmlspecialchars(
                                            $member['name']
                                        ) ?>"
                                    >

                                <?php endif; ?>

                                <div class="team-social">

                                    <?php if (!empty($member['facebook_url'])): ?>

                                        <a
                                            class="btn btn-square btn-dark rounded-circle m-1"
                                            href="<?= htmlspecialchars(
                                                $member['facebook_url']
                                            ) ?>"
                                            target="_blank"
                                        >
                                            <i class="fab fa-facebook-f"></i>
                                        </a>

                                    <?php endif; ?>

                                    <?php if (!empty($member['twitter_url'])): ?>

                                        <a
                                            class="btn btn-square btn-dark rounded-circle m-1"
                                            href="<?= htmlspecialchars(
                                                $member['twitter_url']
                                            ) ?>"
                                            target="_blank"
                                        >
                                            <i class="fab fa-twitter"></i>
                                        </a>

                                    <?php endif; ?>

                                    <?php if (!empty($member['linkedin_url'])): ?>

                                        <a
                                            class="btn btn-square btn-dark rounded-circle m-1"
                                            href="<?= htmlspecialchars(
                                                $member['linkedin_url']
                                            ) ?>"
                                            target="_blank"
                                        >
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>

                                    <?php endif; ?>

                                    <?php if (!empty($member['instagram_url'])): ?>

                                        <a
                                            class="btn btn-square btn-dark rounded-circle m-1"
                                            href="<?= htmlspecialchars(
                                                $member['instagram_url']
                                            ) ?>"
                                            target="_blank"
                                        >
                                            <i class="fab fa-instagram"></i>
                                        </a>

                                    <?php endif; ?>

                                </div>

                            </div>

                            <div class="text-center p-4">

                                <h5 class="mb-1">

                                    <?= htmlspecialchars(
                                        $member['name']
                                    ) ?>

                                </h5>

                                <span class="text-primary d-block mb-2">

                                    <?= htmlspecialchars(
                                        $member['position']
                                        ?? ''
                                    ) ?>

                                </span>

                                <?php if (!empty($member['bio'])): ?>

                                    <p class="small text-muted mb-0"
                                        data-full-bio="<?= htmlspecialchars(strip_tags($member['bio'])) ?>">
                                        <?= htmlspecialchars(mb_strimwidth(strip_tags($member['bio']), 0, 120, '...')) ?>
                                    </p>

                                <?php endif; ?>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>
        </div>
    </div>
    <!-- Team End -->