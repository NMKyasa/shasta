<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Add Testimonial
                </h1>

            </div>

            <div class="col-sm-6 text-right">

                <a
                    href="<?= url('dashboard/testimonials') ?>"
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
                    action="<?= url('dashboard/testimonials/store') ?>"
                    enctype="multipart/form-data"
                >

                    <!-- NAME -->
                    <div class="form-group">

                        <label>

                            Name
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            placeholder="Client or company name"
                            required
                        >

                    </div>

                    <!-- Company -->
                    <div class="form-group">

                        <label>

                            Company

                        </label>

                        <input
                            type="text"
                            name="company"
                            class="form-control"
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

                    <!-- MESSAGE -->
                    <div class="form-group">

                        <label>
                            Message
                        </label>

                        <textarea
                            name="message"
                            class="form-control"
                            rows="5"
                        ></textarea>

                    </div>

                    <!-- RATING -->
                    <div class="form-group">

                        <label>
                            Rating
                        </label>

                        <select
                            name="rating"
                            class="form-control"
                        >

                            <option value="5">5 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="2">2 Stars</option>
                            <option value="1">1 Star</option>

                        </select>

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

                                Featured Testimonial

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

                        Save Testimonial

                    </button>

                    <a
                        href="<?= url('dashboard/testimonials') ?>"
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