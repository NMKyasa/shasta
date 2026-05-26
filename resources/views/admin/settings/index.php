<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Website Settings
                </h1>

            </div>

        </div>

    </div>

</div>

<section class="content">

    <div class="container-fluid">

        <form
            method="POST"
            action="<?= url('dashboard/settings/update') ?>"
            enctype="multipart/form-data"
        >

            <div class="card card-primary card-outline card-outline-tabs">

                <div class="card-header p-0 border-bottom-0">

                    <ul
                        class="nav nav-tabs"
                        id="settings-tabs"
                        role="tablist"
                    >

                        <!-- GENERAL -->
                        <li class="nav-item">

                            <a
                                class="nav-link active"
                                id="general-tab"
                                data-toggle="pill"
                                href="#general"
                                role="tab"
                            >

                                General

                            </a>

                        </li>

                        <!-- BRANDING -->
                        <li class="nav-item">

                            <a
                                class="nav-link"
                                id="branding-tab"
                                data-toggle="pill"
                                href="#branding"
                                role="tab"
                            >

                                Branding

                            </a>

                        </li>

                        <!-- SOCIAL -->
                        <li class="nav-item">

                            <a
                                class="nav-link"
                                id="social-tab"
                                data-toggle="pill"
                                href="#social"
                                role="tab"
                            >

                                Social Media

                            </a>

                        </li>

                        <!-- SEO -->
                        <li class="nav-item">

                            <a
                                class="nav-link"
                                id="seo-tab"
                                data-toggle="pill"
                                href="#seo"
                                role="tab"
                            >

                                SEO

                            </a>

                        </li>

                        <!-- CONTACT -->
                        <li class="nav-item">

                            <a
                                class="nav-link"
                                id="contact-tab"
                                data-toggle="pill"
                                href="#contact"
                                role="tab"
                            >

                                Contact

                            </a>

                        </li>

                    </ul>

                </div>

                <div class="card-body">

                    <div class="tab-content">

                        <!-- GENERAL -->
                        <div
                            class="tab-pane fade show active"
                            id="general"
                            role="tabpanel"
                        >

                            <div class="form-group">

                                <label>
                                    Site Name
                                </label>

                                <input
                                    type="text"
                                    name="site_name"
                                    class="form-control"
                                    value="<?= htmlspecialchars($settings['site_name'] ?? '') ?>"
                                >

                            </div>

                            <div class="form-group">

                                <label>
                                    Site Tagline
                                </label>

                                <input
                                    type="text"
                                    name="site_tagline"
                                    class="form-control"
                                    value="<?= htmlspecialchars($settings['site_tagline'] ?? '') ?>"
                                >

                            </div>

                            <div class="form-group">

                                <label>
                                    Company Email
                                </label>

                                <input
                                    type="email"
                                    name="company_email"
                                    class="form-control"
                                    value="<?= htmlspecialchars($settings['company_email'] ?? '') ?>"
                                >

                            </div>

                            <div class="form-group">

                                <label>
                                    Phone Number
                                </label>

                                <input
                                    type="text"
                                    name="phone_number"
                                    class="form-control"
                                    value="<?= htmlspecialchars($settings['phone_number'] ?? '') ?>"
                                >

                            </div>

                            <div class="form-group">

                                <label>
                                    Footer Text
                                </label>

                                <textarea
                                    name="footer_text"
                                    class="form-control"
                                    rows="4"
                                ><?= htmlspecialchars($settings['footer_text'] ?? '') ?></textarea>

                            </div>

                        </div>

                        <!-- BRANDING -->
                        <div
                            class="tab-pane fade"
                            id="branding"
                            role="tabpanel"
                        >

                            <!-- LOGO -->
                            <div class="form-group">

                                <label>
                                    Logo
                                </label>

                                <input
                                    type="file"
                                    name="logo"
                                    class="form-control"
                                    accept=".jpg,.jpeg,.png,.webp"
                                >

                                <?php if (!empty($settings['logo'])): ?>

                                    <div class="mt-3">

                                        <img
                                            src="<?= asset($settings['logo']) ?>"
                                            style="max-height:80px;"
                                        >

                                    </div>

                                <?php endif; ?>

                            </div>

                            <!-- DARK LOGO -->
                            <div class="form-group">

                                <label>
                                    Dark Logo
                                </label>

                                <input
                                    type="file"
                                    name="dark_logo"
                                    class="form-control"
                                    accept=".jpg,.jpeg,.png,.webp"
                                >

                                <?php if (!empty($settings['dark_logo'])): ?>

                                    <div class="mt-3">

                                        <img
                                            src="<?= asset($settings['dark_logo']) ?>"
                                            style="max-height:80px;"
                                        >

                                    </div>

                                <?php endif; ?>

                            </div>

                            <!-- FAVICON -->
                            <div class="form-group">

                                <label>
                                    Favicon
                                </label>

                                <input
                                    type="file"
                                    name="favicon"
                                    class="form-control"
                                    accept=".png,.ico,.webp"
                                >

                                <?php if (!empty($settings['favicon'])): ?>

                                    <div class="mt-3">

                                        <img
                                            src="<?= asset($settings['favicon']) ?>"
                                            style="max-height:50px;"
                                        >

                                    </div>

                                <?php endif; ?>

                            </div>

                        </div>

                        <!-- SOCIAL -->
                        <div
                            class="tab-pane fade"
                            id="social"
                            role="tabpanel"
                        >

                            <div class="form-group">

                                <label>
                                    Facebook URL
                                </label>

                                <input
                                    type="url"
                                    name="facebook_url"
                                    class="form-control"
                                    value="<?= htmlspecialchars($settings['facebook_url'] ?? '') ?>"
                                >

                            </div>

                            <div class="form-group">

                                <label>
                                    Twitter/X URL
                                </label>

                                <input
                                    type="url"
                                    name="twitter_url"
                                    class="form-control"
                                    value="<?= htmlspecialchars($settings['twitter_url'] ?? '') ?>"
                                >

                            </div>

                            <div class="form-group">

                                <label>
                                    Instagram URL
                                </label>

                                <input
                                    type="url"
                                    name="instagram_url"
                                    class="form-control"
                                    value="<?= htmlspecialchars($settings['instagram_url'] ?? '') ?>"
                                >

                            </div>

                            <div class="form-group">

                                <label>
                                    LinkedIn URL
                                </label>

                                <input
                                    type="url"
                                    name="linkedin_url"
                                    class="form-control"
                                    value="<?= htmlspecialchars($settings['linkedin_url'] ?? '') ?>"
                                >

                            </div>

                            <div class="form-group">

                                <label>
                                    YouTube URL
                                </label>

                                <input
                                    type="url"
                                    name="youtube_url"
                                    class="form-control"
                                    value="<?= htmlspecialchars($settings['youtube_url'] ?? '') ?>"
                                >

                            </div>

                        </div>

                        <!-- SEO -->
                        <div
                            class="tab-pane fade"
                            id="seo"
                            role="tabpanel"
                        >

                            <div class="form-group">

                                <label>
                                    Meta Title
                                </label>

                                <input
                                    type="text"
                                    name="meta_title"
                                    class="form-control"
                                    value="<?= htmlspecialchars($settings['meta_title'] ?? '') ?>"
                                >

                            </div>

                            <div class="form-group">

                                <label>
                                    Meta Description
                                </label>

                                <textarea
                                    name="meta_description"
                                    class="form-control"
                                    rows="4"
                                ><?= htmlspecialchars($settings['meta_description'] ?? '') ?></textarea>

                            </div>

                            <div class="form-group">

                                <label>
                                    Meta Keywords
                                </label>

                                <textarea
                                    name="meta_keywords"
                                    class="form-control"
                                    rows="3"
                                ><?= htmlspecialchars($settings['meta_keywords'] ?? '') ?></textarea>

                            </div>

                            <div class="form-group">

                                <label>
                                    Google Analytics
                                </label>

                                <textarea
                                    name="google_analytics"
                                    class="form-control"
                                    rows="5"
                                ><?= htmlspecialchars($settings['google_analytics'] ?? '') ?></textarea>

                            </div>

                        </div>

                        <!-- CONTACT -->
                        <div
                            class="tab-pane fade"
                            id="contact"
                            role="tabpanel"
                        >

                            <div class="form-group">

                                <label>
                                    Office Address
                                </label>

                                <textarea
                                    name="office_address"
                                    class="form-control"
                                    rows="4"
                                ><?= htmlspecialchars($settings['office_address'] ?? '') ?></textarea>

                            </div>

                            <div class="form-group">

                                <label>
                                    Working Hours
                                </label>

                                <textarea
                                    name="working_hours"
                                    class="form-control"
                                    rows="3"
                                ><?= htmlspecialchars($settings['working_hours'] ?? '') ?></textarea>

                            </div>

                            <div class="form-group">

                                <label>
                                    Google Maps Embed
                                </label>

                                <textarea
                                    name="google_maps_embed"
                                    class="form-control"
                                    rows="5"
                                ><?= htmlspecialchars($settings['google_maps_embed'] ?? '') ?></textarea>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card-footer">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        Save Settings

                    </button>

                </div>

            </div>

        </form>

    </div>

</section>