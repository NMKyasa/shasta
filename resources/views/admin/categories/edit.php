<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Edit Category
                </h1>

            </div>

            <div class="col-sm-6 text-right">

                <a
                    href="<?= url('dashboard/categories') ?>"
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
                      action="<?= url('dashboard/categories/update/' . $category['id']) ?>"
                      enctype="multipart/form-data">

                    <!-- Category Name -->
                    <div class="form-group">

                        <label>

                            Category Name
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control"
                            value="<?= htmlspecialchars($category['name']) ?>"
                            required
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

                            <option
                                value="active"
                                <?= $category['status'] === 'active'
                                    ? 'selected'
                                    : '' ?>

                            >
                                Active
                            </option>

                            <option
                                value="inactive"
                                <?= $category['status'] === 'inactive'
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

                        Update Category

                    </button>

                    <a
                        href="<?= url('dashboard/categories') ?>"
                        class="btn btn-secondary"
                    >

                        Cancel

                    </a>

                </form>

            </div>

        </div>

    </div>

</section>