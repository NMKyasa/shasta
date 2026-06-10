<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    About Settings
                </h1>

            </div>

        </div>

    </div>

</div>

<section class="content">

    <div class="container-fluid">

        <div class="card">

            <div class="card-body">

                <form
                    method="POST"
                    action="<?= url('dashboard/settings/about') ?>"
                    enctype="multipart/form-data"
                >

                    <!-- TITLE -->
                    <div class="form-group">

                        <label>
                            About Title
                        </label>

                        <input
                            type="text"
                            name="about_title"
                            class="form-control"
                            value="<?= htmlspecialchars($settings['about_title'] ?? '') ?>"
                        >

                    </div>

                    <!-- SUBTITLE -->
                    <div class="form-group">

                        <label>
                            About Subtitle
                        </label>

                        <textarea
                            name="about_subtitle"
                            class="form-control"
                            rows="2"
                        ><?= htmlspecialchars($settings['about_subtitle'] ?? '') ?></textarea>

                    </div>

                    <!-- CONTENT -->
                    <div class="form-group">

                        <label>
                            About Content
                        </label>

                        <textarea
                            name="about_content"
                            class="form-control"
                            rows="6"
                        ><?= htmlspecialchars($settings['about_content'] ?? '') ?></textarea>

                    </div>

                    <!-- MISSION -->
                    <div class="form-group">

                        <label>
                            Mission
                        </label>

                        <textarea
                            name="about_mission"
                            class="form-control"
                            rows="3"
                        ><?= htmlspecialchars($settings['about_mission'] ?? '') ?></textarea>

                    </div>

                    <!-- VISION -->
                    <div class="form-group">

                        <label>
                            Vision
                        </label>

                        <textarea
                            name="about_vision"
                            class="form-control"
                            rows="3"
                        ><?= htmlspecialchars($settings['about_vision'] ?? '') ?></textarea>

                    </div>

                    <!-- IMPACT -->
                    <div class="form-group">

                        <label>
                            Impact
                        </label>

                        <textarea
                            name="about_impact"
                            class="form-control"
                            rows="4"
                        ><?= htmlspecialchars($settings['about_impact'] ?? '') ?></textarea>

                    </div>

                    <!-- EXPERIENCE -->
                    <div class="form-group">

                        <label>
                            Years of Experience
                        </label>

                        <input
                            type="number"
                            name="about_experience_years"
                            class="form-control"
                            value="<?= htmlspecialchars($settings['about_experience_years'] ?? '') ?>"
                        >

                    </div>

                    <!-- BUTTON TEXT -->
                    <div class="form-group">

                        <label>
                            Button Text
                        </label>

                        <input
                            type="text"
                            name="about_button_text"
                            class="form-control"
                            value="<?= htmlspecialchars($settings['about_button_text'] ?? '') ?>"
                        >

                    </div>

                    <!-- BUTTON URL -->
                    <div class="form-group">

                        <label>
                            Button URL
                        </label>

                        <input
                            type="text"
                            name="about_button_url"
                            class="form-control"
                            value="<?= htmlspecialchars($settings['about_button_url'] ?? '') ?>"
                        >

                    </div>

                    <!-- VIDEO URL -->
                    <div class="form-group">

                        <label>
                            Video URL
                        </label>

                        <input
                            type="text"
                            name="about_video_url"
                            class="form-control"
                            value="<?= htmlspecialchars($settings['about_video_url'] ?? '') ?>"
                        >

                    </div>

                    <!-- CURRENT IMAGE -->
                    <?php if (
                        !empty(
                            $settings['about_image']
                        )
                    ): ?>

                        <div class="form-group">

                            <label>
                                Current About Image
                            </label>

                            <div>

                                <img
                                    src="<?= asset($settings['about_image']['file_path']) ?>"
                                    style="
                                        width: 250px;
                                        border-radius: 8px;
                                    "
                                >

                            </div>

                        </div>

                    <?php endif; ?>

                    <!-- IMAGE -->
                    <div class="form-group">

                        <label>
                            About Image
                        </label>

                        <input
                            type="file"
                            name="about_image"
                            class="form-control"
                        >

                    </div>

                    <hr>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        Save About Settings

                    </button>

                </form>

            </div>

        </div>

    </div>

</section>