<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Edit Testimonial
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

                <!-- FORM ERROR -->
                <div
                    class="alert alert-danger"
                    id="form-error"
                    style="display:none;"
                ></div>

                <form
                    method="POST"
                    action="<?= url('dashboard/testimonials/update/' . $testimonial['id']) ?>"
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
                            id="name"
                            class="form-control"
                            value="<?= htmlspecialchars($testimonial['name']) ?>"
                            required
                        >

                    </div>

                    <!-- COMPANY -->
                    <div class="form-group">

                        <label>

                            Company

                        </label>

                        <input
                            type="text"
                            name="company"
                            class="form-control"
                            value="<?= htmlspecialchars($testimonial['company']) ?>"
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
                            value="<?= htmlspecialchars($testimonial['position']) ?>"
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
                            rows="6"
                        ><?= htmlspecialchars($testimonial['message']) ?></textarea>

                    </div>

                    <!-- RATING -->
                    <div class="form-group">

                        <label>
                            Rating
                        </label>

                        <input
                            type="number"
                            name="rating"
                            id="rating"
                            class="form-control"
                            value="<?= htmlspecialchars($testimonial['rating']) ?>"
                            min="1"
                            max="5"
                        >

                    </div>

                    <hr>

                    <!-- CURRENT IMAGE -->
                    <div class="form-group">

                        <label>
                            Current Profile Image
                        </label>

                        <div class="mb-3">

                            <?php if (!empty($media)): ?>

                                <img
                                    src="<?= asset($media['file_path']) ?>"
                                    class="img-fluid rounded border"
                                    style="
                                        width: 180px;
                                        height: 180px;
                                        object-fit: cover;
                                    "
                                >

                            <?php else: ?>

                                <div class="text-muted">

                                    No profile image uploaded.

                                </div>

                            <?php endif; ?>

                        </div>

                    </div>

                    <!-- REPLACE IMAGE -->
                    <div class="form-group">

                        <label>
                            Replace Profile Image
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
                            value="<?= htmlspecialchars($testimonial['sort_order']) ?>"
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

                                <?= $testimonial['featured']
                                    ? 'checked'
                                    : '' ?>
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

                            <option
                                value="active"

                                <?= $testimonial['status'] === 'active'
                                    ? 'selected'
                                    : '' ?>
                            >

                                Active

                            </option>

                            <option
                                value="inactive"

                                <?= $testimonial['status'] === 'inactive'
                                    ? 'selected'
                                    : '' ?>
                            >

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

                        Update Testimonial

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
 * FORM VALIDATION
 */
document
    .querySelector('form')
    .addEventListener(

        'submit',

        function (event) {

            const errorBox =
                document.getElementById(
                    'form-error'
                );

            errorBox.style.display =
                'none';

            errorBox.innerHTML = '';

            /**
             * Name validation
             */
            const name =
                document.getElementById(
                    'name'
                ).value.trim();

            if (!name) {

                event.preventDefault();

                errorBox.innerHTML =
                    'Full name is required.';

                errorBox.style.display =
                    'block';

                return;
            }

            /**
             * Email validation
             */
            const email =
                document.getElementById(
                    'email'
                ).value.trim();

            if (
                email
                &&
                !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
            ) {

                event.preventDefault();

                errorBox.innerHTML =
                    'Invalid email address.';

                errorBox.style.display =
                    'block';

                return;
            }

            /**
             * Validate uploaded image
             */
            const image =
                document.getElementById(
                    'image'
                ).files[0];

            if (
                image
                &&
                image.size > 1024 * 1024
            ) {

                event.preventDefault();

                errorBox.innerHTML =
                    'Image exceeds 1MB limit.';

                errorBox.style.display =
                    'block';

                return;
            }
        }
    );

/**
 * IMAGE PREVIEW
 */
document
    .getElementById('image')
    .addEventListener(

        'change',

        function (event) {

            const file =
                event.target.files[0];

            const preview =
                document.getElementById(
                    'preview-container'
                );

            preview.innerHTML = '';

            if (!file) {

                return;
            }

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