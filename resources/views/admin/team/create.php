<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Add Team Member
                </h1>

            </div>

            <div class="col-sm-6 text-right">

                <a
                    href="<?= url('dashboard/team') ?>"
                    class="btn btn-secondary"
                >

                    Back

                </a>

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
                    action="<?= url('dashboard/team/store') ?>"
                    enctype="multipart/form-data"
                >

                    <!-- NAME -->
                    <div class="form-group">

                        <label>

                            Full Name
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            required
                        >

                    </div>

                    <!-- POSITION -->
                    <div class="form-group">

                        <label>
                            Position
                        </label>

                        <input
                            type="text"
                            name="position"
                            class="form-control"
                        >

                    </div>

                    <!-- BIO -->
                    <div class="form-group">

                        <label>
                            Biography
                        </label>

                        <textarea
                            name="bio"
                            class="form-control"
                            rows="5"
                        ></textarea>

                    </div>

                    <!-- EMAIL -->
                    <div class="form-group">

                        <label>
                            Email Address
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                        >

                    </div>

                    <!-- PHONE -->
                    <div class="form-group">

                        <label>
                            Phone Number
                        </label>

                        <input
                            type="text"
                            name="phone"
                            class="form-control"
                        >

                    </div>

                    <hr>

                    <h5>
                        Social Media Links
                    </h5>

                    <!-- FACEBOOK -->
                    <div class="form-group">

                        <label>
                            Facebook URL
                        </label>

                        <input
                            type="url"
                            name="facebook_url"
                            class="form-control"
                            placeholder="https://facebook.com/username"
                        >

                    </div>

                    <!-- TWITTER -->
                    <div class="form-group">

                        <label>
                            Twitter/X URL
                        </label>

                        <input
                            type="url"
                            name="twitter_url"
                            class="form-control"
                            placeholder="https://x.com/username"
                        >

                    </div>

                    <!-- LINKEDIN -->
                    <div class="form-group">

                        <label>
                            LinkedIn URL
                        </label>

                        <input
                            type="url"
                            name="linkedin_url"
                            class="form-control"
                            placeholder="https://linkedin.com/in/username"
                        >

                    </div>

                    <!-- INSTAGRAM -->
                    <div class="form-group">

                        <label>
                            Instagram URL
                        </label>

                        <input
                            type="url"
                            name="instagram_url"
                            class="form-control"
                            placeholder="https://instagram.com/username"
                        >

                    </div>

                    <hr>

                    <!-- PROFILE IMAGE -->
                    <div class="form-group">

                        <label>

                            Profile Image

                        </label>

                        <input
                            type="file"
                            name="image"
                            id="image"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <small class="text-muted">

                            Maximum image size: 1MB.

                        </small>

                        <div
                            id="image-error"
                            class="text-danger mt-2"
                        ></div>

                    </div>

                    <!-- IMAGE PREVIEW -->
                    <div
                        id="preview-container"
                        class="mb-3"
                    ></div>

                    <!-- SORT ORDER -->
                    <div class="form-group">

                        <label>
                            Sort Order
                        </label>

                        <input
                            type="number"
                            name="sort_order"
                            class="form-control"
                            value="0"
                        >

                    </div>

                    <!-- FEATURED -->
                    <div class="form-group">

                        <div class="form-check">

                            <input
                                type="checkbox"
                                name="featured"
                                value="1"
                                class="form-check-input"
                                id="featured"
                            >

                            <label
                                class="form-check-label"
                                for="featured"
                            >

                                Featured Team Member

                            </label>

                        </div>

                    </div>

                    <!-- STATUS -->
                    <div class="form-group">

                        <label>
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-control"
                        >

                            <option value="active">
                                Active
                            </option>

                            <option value="inactive">
                                Inactive
                            </option>

                        </select>

                    </div>

                    <hr>

                    <!-- SUBMIT -->
                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        Save Team Member

                    </button>

                    <a
                        href="<?= url('dashboard/team') ?>"
                        class="btn btn-secondary"
                    >

                        Cancel

                    </a>

                </form>

            </div>

        </div>

    </div>

</section>

<script>

    /**
     * IMAGE VALIDATION + PREVIEW
     */
    document
        .getElementById('image')
        .addEventListener(

            'change',

            function (event) {

                const file =
                    event.target.files[0];

                const error =
                    document.getElementById(
                        'image-error'
                    );

                const preview =
                    document.getElementById(
                        'preview-container'
                    );

                error.innerHTML = '';

                preview.innerHTML = '';

                /**
                 * No file selected
                 */
                if (!file) {

                    return;
                }

                /**
                 * Validate file size
                 */
                const maxSize =
                    1024 * 1024;

                if (file.size > maxSize) {

                    error.innerHTML =
                        'Image exceeds 1MB limit.';

                    event.target.value = '';

                    return;
                }

                /**
                 * Preview image
                 */
                const reader =
                    new FileReader();

                reader.onload =
                    function (e) {

                        preview.innerHTML = `

                            <img
                                src="${e.target.result}"
                                class="img-fluid rounded border"
                                style="
                                    width: 180px;
                                    height: 180px;
                                    object-fit: cover;
                                "
                            >

                        `;
                    };

                reader.readAsDataURL(file);
            }
        );

</script>