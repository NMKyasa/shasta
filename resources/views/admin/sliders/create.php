<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Add Slider
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

                <form method="POST"
                      action="<?= url('dashboard/sliders/store') ?>"
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
                            class="form-control"
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
                        ></textarea>

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
                        >

                    </div>

                    <!-- IMAGES -->
                    <div class="form-group">

                        <label>
                            Slider Images
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="file"
                            name="images[]"
                            id="images"
                            class="form-control"
                            multiple
                            accept=".jpg,.jpeg,.png,.webp"
                            required
                        >

                        <small class="text-muted">

                            Each image must not exceed 1MB.

                        </small>

                        <div
                            id="image-error"
                            class="text-danger mt-2"
                        ></div>

                    </div>

                    <!-- IMAGE PREVIEW -->
                    <div
                        id="preview-container"
                        class="row"
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
                        class="btn btn-primary">

                        Save Slider

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
     * IMAGE VALIDATION
     */
    document
        .getElementById('images')
        .addEventListener(

            'change',

            function (event) {

                const files =
                    event.target.files;

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
                 * Minimum 1 image required
                 */
                if (files.length < 1) {

                    error.innerHTML =
                        'At least one image is required.';

                    return;
                }

                /**
                 * Validate each image
                 */
                for (let i = 0; i < files.length; i++) {

                    const file =
                        files[i];

                    const maxSize =
                        1024 * 1024;

                    if (file.size > maxSize) {

                        error.innerHTML =
                            'One or more images exceed 1MB limit.';

                        event.target.value = '';

                        preview.innerHTML = '';

                        return;
                    }

                    /**
                     * Preview image
                     */
                    const reader =
                        new FileReader();

                    reader.onload =
                        function (e) {

                            preview.innerHTML += `

                                <div class="col-md-2 mb-3">

                                    <img
                                        src="${e.target.result}"
                                        class="img-fluid rounded border"
                                    >

                                </div>

                            `;
                        };

                    reader.readAsDataURL(file);
                }
            }
        );

</script>