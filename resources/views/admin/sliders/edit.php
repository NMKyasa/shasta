<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Edit Slider
                </h1>

            </div>

            <div class="col-sm-6 text-right">

                <a
                    href="<?= url('dashboard/sliders') ?>"
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

                <div
                    class="alert alert-danger"
                    id="form-error"
                    style="display:none;"
                ></div>

                <form method="POST"
                      action="<?= url('dashboard/sliders/update/' . $slider['id']) ?>"
                      enctype="multipart/form-data">

                    <!-- TITLE -->
                    <div class="form-group">

                        <label>

                            Title
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="title"
                            id="title"
                            class="form-control"
                            value="<?= htmlspecialchars($slider['title']) ?>"
                            required
                        >

                    </div>

                    <!-- SUBTITLE -->
                    <div class="form-group">

                        <label>
                            Subtitle
                        </label>

                        <textarea
                            name="subtitle"
                            class="form-control"
                            rows="3"
                        ><?= htmlspecialchars($slider['subtitle']) ?></textarea>

                    </div>

                    <!-- BUTTON TEXT -->
                    <div class="form-group">

                        <label>
                            Button Text
                        </label>

                        <input
                            type="text"
                            name="button_text"
                            class="form-control"
                            value="<?= htmlspecialchars($slider['button_text']) ?>"
                        >

                    </div>

                    <!-- BUTTON URL -->
                    <div class="form-group">

                        <label>
                            Button URL
                        </label>

                        <input
                            type="text"
                            name="button_url"
                            class="form-control"
                            value="<?= htmlspecialchars($slider['button_url']) ?>"
                        >

                    </div>

                    <!-- EXISTING IMAGES -->
                    <div class="form-group">

                        <label>
                            Existing Images
                        </label>

                        <div class="row">

                            <?php foreach ($media as $image): ?>

                                <div class="col-md-2 mb-3 existing-image">

                                    <div class="border rounded p-2">

                                        <img
                                            src="<?= asset($image['file_path']) ?>"
                                            class="img-fluid rounded mb-2"
                                            style="
                                                height: 140px;
                                                width: 100%;
                                                object-fit: cover;
                                            "
                                        >

                                        <!-- FEATURED -->
                                        <div class="form-check mb-2">

                                            <input
                                                type="radio"
                                                name="featured_image"
                                                value="<?= $image['id'] ?>"
                                                class="form-check-input"

                                                <?= $image['is_featured']
                                                    ? 'checked'
                                                    : '' ?>

                                            >

                                            <label class="form-check-label">

                                                Featured

                                            </label>

                                        </div>

                                        <!-- DELETE -->
                                        <div class="form-check">

                                            <input
                                                type="checkbox"
                                                name="delete_images[]"
                                                value="<?= $image['id'] ?>"
                                                class="form-check-input"
                                            >

                                            <label class="form-check-label">

                                                Delete

                                            </label>

                                        </div>

                                        <!-- FEATURED BADGE -->
                                        <?php if ($image['is_featured']): ?>

                                            <span class="badge badge-success mt-2">

                                                Current Featured

                                            </span>

                                        <?php endif; ?>

                                    </div>

                                </div>

                            <?php endforeach; ?>

                        </div>

                    </div>

                    <!-- ADD NEW IMAGES -->
                    <div class="form-group">

                        <label>
                            Add More Images
                        </label>

                        <input
                            type="file"
                            name="images[]"
                            id="images"
                            class="form-control"
                            multiple
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                    </div>

                    <!-- SORT ORDER -->
                    <div class="form-group">

                        <label>
                            Sort Order
                        </label>

                        <input
                            type="number"
                            name="sort_order"
                            class="form-control"
                            value="<?= $slider['sort_order'] ?>"
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

                                <?= $slider['featured']
                                    ? 'checked'
                                    : '' ?>

                            >

                            <label class="form-check-label">

                                Featured Slider

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
                                <?= $slider['status'] === 'active'
                                    ? 'selected'
                                    : '' ?>

                            >
                                Active
                            </option>

                            <option
                                value="inactive"
                                <?= $slider['status'] === 'inactive'
                                    ? 'selected'
                                    : '' ?>

                            >
                                Inactive
                            </option>

                        </select>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        Update Slider

                    </button>

                    <a
                        href="<?= url('dashboard/sliders') ?>"
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
 * Form validation
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
             * Title validation
             */
            const title =
                document.getElementById(
                    'title'
                ).value.trim();

            if (!title) {

                event.preventDefault();

                errorBox.innerHTML =
                    'Title is required.';

                errorBox.style.display =
                    'block';

                return;
            }

            /**
             * Remaining images
             */
            const deleteChecks =
                document.querySelectorAll(
                    'input[name="delete_images[]"]:checked'
                );

            const totalImages =
                document.querySelectorAll(
                    '.existing-image'
                ).length;

            const newImages =
                document.getElementById(
                    'images'
                ).files.length;

            /**
             * Prevent deleting all images
             */
            if (

                deleteChecks.length
                >=
                totalImages

                &&

                newImages < 1

            ) {

                event.preventDefault();

                errorBox.innerHTML =
                    'A slider must have at least one image.';

                errorBox.style.display =
                    'block';

                return;
            }

            /**
             * Validate uploaded images
             */
            const files =
                document.getElementById(
                    'images'
                ).files;

            for (let i = 0; i < files.length; i++) {

                /**
                 * Max 1MB
                 */
                if (
                    files[i].size
                    >
                    1024 * 1024
                ) {

                    event.preventDefault();

                    errorBox.innerHTML =
                        'One or more images exceed 1MB limit.';

                    errorBox.style.display =
                        'block';

                    return;
                }
            }
        }
    );

</script>