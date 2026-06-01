<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Edit Permission
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
                    action="<?= url('dashboard/permissions/update/' . $permission['id']) ?>"
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
                            value="<?= htmlspecialchars($permission['module']) ?>"
                            required
                        >

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

                            <option
                                value="view"
                                <?= $permission['action'] === 'view'
                                    ? 'selected'
                                    : '' ?>
                            >
                                View
                            </option>

                            <option
                                value="create"
                                <?= $permission['action'] === 'create'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Create
                            </option>

                            <option
                                value="edit"
                                <?= $permission['action'] === 'edit'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Edit
                            </option>

                            <option
                                value="deactivate"
                                <?= $permission['action'] === 'deactivate'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Deactivate
                            </option>

                        </select>

                    </div>

                    <!-- PERMISSION NAME -->
                    <div class="form-group">

                        <label>
                            Permission Name
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="<?= htmlspecialchars($permission['name']) ?>"
                            readonly
                        >

                        <small class="text-muted">

                            Auto-generated from Module and Action.

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
                        ><?= htmlspecialchars(
                            $permission['description']
                        ) ?></textarea>

                    </div>

                    <!-- SUBMIT -->
                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        Update Permission

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