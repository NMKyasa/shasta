<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Add Menu
                </h1>

            </div>

            <div class="col-sm-6 text-right">

                <a
                    href="<?= url('dashboard/menus') ?>"
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
                    action="<?= url('dashboard/menus/store') ?>"
                >

                    <!-- MENU NAME -->
                    <div class="form-group">

                        <label>

                            Menu Name
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            required
                        >

                        <small class="text-muted">
                            Example: Header Menu
                        </small>

                    </div>

                    <!-- MENU KEY -->
                    <div class="form-group">

                        <label>

                            Menu Key
                            <span class="text-danger">*</span>

                        </label>

                        <select
                            name="menu_key"
                            class="form-control"
                            required
                        >

                            <option value="header">
                                Header Menu
                            </option>

                            <option value="footer">
                                Footer Menu
                            </option>

                            <option value="mobile">
                                Mobile Menu
                            </option>

                        </select>

                        <small class="text-muted">
                            Used internally for frontend menu rendering.
                        </small>

                    </div>

                    <!-- DESCRIPTION -->
                    <div class="form-group">

                        <label>
                            Description
                        </label>

                        <textarea
                            name="description"
                            class="form-control"
                            rows="4"
                        ></textarea>

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

                        Save Menu

                    </button>

                    <a
                        href="<?= url('dashboard/menus') ?>"
                        class="btn btn-secondary"
                    >

                        Cancel

                    </a>

                </form>

            </div>

        </div>

    </div>

</section>
