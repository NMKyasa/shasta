<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Add Impact
                </h1>

            </div>
            <div class="col-sm-6 text-right">
                <a
                    href="<?= url('dashboard/impact') ?>"
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
                      action="<?= url('dashboard/impact/store') ?>"
                      enctype="multipart/form-data">
                      

                    <!-- IMPACT LABEL -->
                    <div class="form-group">

                        <label>
                            Impact Label
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="label"
                            class="form-control"
                            required
                        >

                    </div>

                    <!-- IMPACT VALUE -->
                    <div class="form-group">

                        <label>
                            Impact Value
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="value"
                            class="form-control"
                            required
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
                            value="0"
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

                        Save Impact

                    </button>

                    <a
                        href="<?= url('dashboard/impact') ?>"
                        class="btn btn-secondary"
                    >

                        Cancel

                    </a>

                </form>

            </div>

        </div>

    </div>

</section>
