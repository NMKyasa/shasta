<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Add Category
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

                <form method="POST"
                      action="<?= url('dashboard/categories/store') ?>"
                      enctype="multipart/form-data">

                    <!-- TITLE -->
                    <div class="form-group">

                        <label>
                            Category Name
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
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

                        Save Category

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
