<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Add Permission
                </h1>

            </div>

            <div class="col-sm-6 text-right">

                <a
                    href="<?= url('dashboard/permissions') ?>"
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
                    action="<?= url('dashboard/permissions/store') ?>"
                >

                    <!-- CSRF TOKEN -->
                    <input
                        type="hidden"
                        name="_token"
                        value="<?= csrf_token() ?>"
                    >

                    <!-- MODULE -->
                    <div class="form-group">

                        <label>

                            Module
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="module"
                            class="form-control"
                            placeholder="services"
                            required
                        >

                        <small class="text-muted">

                            Example:
                            services, projects, team

                        </small>

                    </div>

                    <!-- ACTION -->
                    <div class="form-group">

                        <label>

                            Action
                            <span class="text-danger">*</span>

                        </label>

                        <select
                            name="action"
                            class="form-control"
                            required
                        >

                            <option value="view">
                                View
                            </option>

                            <option value="create">
                                Create
                            </option>

                            <option value="edit">
                                Edit
                            </option>

                            <option value="deactivate">
                                Deactivate
                            </option>

                        </select>

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

                    <!-- SUBMIT -->
                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        Save Permission

                    </button>

                    <a
                        href="<?= url('dashboard/permissions') ?>"
                        class="btn btn-secondary"
                    >

                        Cancel

                    </a>

                </form>

            </div>

        </div>

    </div>

</section>