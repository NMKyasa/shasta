<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Edit Impact
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
                <div
                    class="alert alert-danger"
                    id="form-error"
                    style="display:none;"
                ></div>

                <form method="POST"
                      action="<?= url('dashboard/impact/update/' . $impact['id']) ?>"
                      enctype="multipart/form-data">


                        <!-- Impact Label -->
                    <div class="form-group">

                        <label>

                            Impact Label
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="label"
                            id="label"
                            class="form-control"
                            value="<?= htmlspecialchars($impact['label']) ?>"
                            required
                        >

                    </div>

                        <!-- Impact Value -->
                    <div class="form-group">

                        <label>

                            Impact Value
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="value"
                            id="value"
                            class="form-control"
                            value="<?= htmlspecialchars($impact['value']) ?>"
                            required
                        >

                    </div>
                    <!-- Sort Order -->
                    <div class="form-group">

                        <label>
                            Sort Order
                        </label>

                        <input
                            type="number"
                            name="sort_order"
                            id="sort_order"
                            class="form-control"
                            value="<?= htmlspecialchars($impact['sort_order']) ?>"
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
                                <?= $impact['status'] === 'active'
                                    ? 'selected'
                                    : '' ?>

                            >
                                Active
                            </option>

                            <option
                                value="inactive"
                                <?= $impact['status'] === 'inactive'
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

                        Update Impact

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