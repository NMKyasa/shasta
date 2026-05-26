<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Add Project
                </h1>

            </div>
            <div class="col-sm-6 text-right">
                <a
                    href="<?= url('dashboard/projects') ?>"
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
                      action="<?= url('dashboard/projects/store') ?>"
                      enctype="multipart/form-data">

                    <!-- TITLE -->
                    <div class="form-group">

                        <label>
                            Project Title
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="title"
                            class="form-control"
                            required
                        >

                    </div>

                    <!-- Client name -->
                    <div class="form-group">

                        <label>
                            Client Name
                        </label>

                        <input
                            type="text"
                            name="client_name"
                            class="form-control"
                        >

                    </div>

                    <!-- Project Scope -->
                    <div class="form-group">

                        <label>
                            Scope
                        </label>

                        <textarea
                            name="scope"
                            class="form-control"
                            rows="3"
                        ></textarea>

                    </div>

                    <!-- Project Impact -->
                    <div class="form-group">

                        <label>
                            Impact
                        </label>

                        <textarea
                            name="impact"
                            class="form-control"
                            rows="3"
                        ></textarea>

                    </div>


                    <!-- CATEGORY -->
                    <div class="form-group">

                        <label>
                            Category
                            <span class="text-danger">*</span>
                        </label>

                        <div class="d-flex">

                            <select
                                name="category_id"
                                id="category-select"
                                class="form-control"
                                required
                            >

                                <option value="">
                                    Select Category
                                </option>

                                <?php foreach ($categories as $category): ?>

                                    <option
                                        value="<?= $category['id'] ?>">

                                        <?= htmlspecialchars(
                                            $category['name']
                                        ) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                            <button
                                type="button"
                                class="btn btn-primary ml-2"
                                data-toggle="modal"
                                data-target="#categoryModal"
                            >

                                +
                            </button>

                        </div>

                    </div>

                    <!-- IMAGES -->
                    <div class="form-group">

                        <label>
                            Project Images
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

                                Featured Project

                            </label>

                        </div>

                    </div>

                    <!-- Completion Date -->
                    <div class="form-group">

                        <label>
                            Completion Date
                        </label>

                        <input
                            type="date"
                            name="completion_date"
                            class="form-control"
                        >

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

                    <h4>
                        SEO Information
                    </h4>

                    <!-- META TITLE -->
                    <div class="form-group">

                        <label>
                            Meta Title
                        </label>

                        <input
                            type="text"
                            name="meta_title"
                            class="form-control"
                        >

                    </div>

                    <!-- META DESCRIPTION -->
                    <div class="form-group">

                        <label>
                            Meta Description
                        </label>

                        <textarea
                            name="meta_description"
                            class="form-control"
                            rows="3"
                        ></textarea>

                    </div>

                    <!-- META KEYWORDS -->
                    <div class="form-group">

                        <label>
                            Meta Keywords
                        </label>

                        <textarea
                            name="meta_keywords"
                            class="form-control"
                            rows="2"
                        ></textarea>

                    </div>

                    <!-- SUBMIT -->
                    <button
                        type="submit"
                        class="btn btn-primary">

                        Save Project

                    </button>

                    <a
                        href="<?= url('dashboard/projects') ?>"
                        class="btn btn-secondary"
                    >

                        Cancel

                    </a>

                </form>

            </div>

        </div>

    </div>

</section>

<!-- CATEGORY MODAL -->
<div
    class="modal fade"
    id="categoryModal"
    tabindex="-1"
>

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Add Category
                </h5>

                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                >

                    <span>&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <div class="form-group">

                    <label>
                        Category Title
                    </label>

                    <input
                        type="text"
                        id="category-title"
                        class="form-control"
                    >

                </div>

                <div
                    id="category-error"
                    class="text-danger"
                ></div>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal"
                >

                    Close

                </button>

                <button
                    type="button"
                    id="save-category"
                    class="btn btn-primary"
                >

                    Save Category

                </button>

            </div>

        </div>

    </div>

</div>

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

    /**
     * CREATE CATEGORY
     */
    document
        .getElementById('save-category')
        .addEventListener(

            'click',

            function () {

                const title =
                    document.getElementById(
                        'category-title'
                    ).value;

                const error =
                    document.getElementById(
                        'category-error'
                    );

                error.innerHTML = '';

                /**
                 * Validation
                 */
                if (!title) {

                    error.innerHTML =
                        'Category title is required.';

                    return;
                }

                /**
                 * FormData
                 */
                const formData =
                    new FormData();

                formData.append(
                    'title',
                    title
                );

                /**
                 * AJAX request
                 */
                fetch(

                    '<?= url('dashboard/categories/store-ajax') ?>',

                    {

                        method: 'POST',

                        body: formData
                    }
                )

                .then(response => response.json())

                .then(data => {

                    /**
                     * Error
                     */
                    if (data.error) {

                        error.innerHTML =
                            data.error;

                        return;
                    }

                    /**
                     * Add option dynamically
                     */
                    const select =
                        document.getElementById(
                            'category-select'
                        );

                    const option =
                        document.createElement(
                            'option'
                        );

                    option.value =
                        data.id;

                    option.text =
                        data.name;

                    option.selected = true;

                    select.appendChild(option);

                    /**
                     * Reset modal
                     */
                    document.getElementById(
                        'category-title'
                    ).value = '';

                    /**
                     * Close modal
                     */
                    $('#categoryModal').modal('hide');
                })

                .catch(error => {

                    document.getElementById(
                        'category-error'
                    ).innerHTML =
                        'Failed to create category.';
                });
            }
        );

</script>