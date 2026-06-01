<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">

                    Manage Permissions

                    <small class="text-muted">

                        (<?= htmlspecialchars(
                            $role['name']
                        ) ?>)

                    </small>

                </h1>

            </div>

            <div class="col-sm-6 text-right">

                <a
                    href="<?= url('dashboard/role_permissions') ?>"
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

        <form
            method="POST"
            action="<?= url('dashboard/role_permissions/update/' . $role['id']) ?>"
        >

            <!-- CSRF TOKEN -->
            <input
                type="hidden"
                name="_token"
                value="<?= csrf_token() ?>"
            >

            <div class="card">

                <div class="card-body">

                    <?php foreach (
                        $permissions
                        as
                        $module => $modulePermissions
                    ): ?>

                        <div class="card card-outline card-primary mb-4">

                            <div class="card-header">

                                <h3 class="card-title">

                                    <?= ucfirst(
                                        $module
                                    ) ?>

                                </h3>

                            </div>

                            <div class="card-body">

                                <div class="row">

                                    <?php foreach (
                                        $modulePermissions
                                        as
                                        $permission
                                    ): ?>

                                        <div
                                            class="col-md-3 mb-3"
                                        >

                                            <div
                                                class="custom-control custom-checkbox"
                                            >

                                                <input
                                                    type="checkbox"
                                                    class="custom-control-input"
                                                    id="permission_<?= $permission['id'] ?>"
                                                    name="permissions[]"
                                                    value="<?= $permission['id'] ?>"

                                                    <?= in_array(
                                                        $permission['id'],
                                                        $assignedPermissions
                                                    )
                                                        ? 'checked'
                                                        : '' ?>
                                                >

                                                <label
                                                    class="custom-control-label"
                                                    for="permission_<?= $permission['id'] ?>"
                                                >

                                                    <?= htmlspecialchars(
                                                        $permission['name']
                                                    ) ?>

                                                </label>

                                            </div>

                                        </div>

                                    <?php endforeach; ?>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

                <div class="card-footer">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        Save Permissions

                    </button>

                    <a
                        href="<?= url('dashboard/role_permissions') ?>"
                        class="btn btn-secondary"
                    >

                        Cancel

                    </a>

                </div>

            </div>

        </form>

    </div>

</section>