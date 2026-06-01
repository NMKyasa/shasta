<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">

                    User Permissions

                </h1>

            </div>

            <div class="col-sm-6 text-right">

                <a
                    href="<?= url('dashboard/user_permissions') ?>"
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

            <div class="card-header">

                <h3 class="card-title">

                    <?= htmlspecialchars(

                        $user['first_name']
                        .
                        ' '
                        .
                        $user['last_name']

                    ) ?>

                    (
                    <?= htmlspecialchars(
                        $user['role_name']
                    ) ?>
                    )

                </h3>

            </div>

            <form
                method="POST"
                action="<?= url('dashboard/user_permissions/update/' . $user['id']) ?>"
            >

                <input
                    type="hidden"
                    name="_token"
                    value="<?= csrf_token() ?>"
                >

                <div class="card-body">

                    <div class="alert alert-info">

                        <strong>
                            Permission States:
                        </strong>

                        <br>

                        Allow =
                        Explicitly grant permission.

                        <br>

                        Inherit =
                        Follow role permissions.

                        <br>

                        Deny =
                        Explicitly deny permission.

                    </div>

                    <?php foreach (
                        $permissions
                        as
                        $module => $modulePermissions
                    ): ?>

                        <div class="card mb-4">

                            <div class="card-header">

                                <h3
                                    class="card-title text-capitalize"
                                >

                                    <?= htmlspecialchars(
                                        str_replace(
                                            '_',
                                            ' ',
                                            $module
                                        )
                                    ) ?>

                                </h3>

                            </div>

                            <div class="card-body p-0">

                                <table
                                    class="table table-bordered mb-0"
                                >

                                    <thead>

                                        <tr>

                                            <th>
                                                Permission
                                            </th>

                                            <th>
                                                Role Access
                                            </th>

                                            <th>
                                                Override
                                            </th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php foreach (
                                            $modulePermissions
                                            as
                                            $permission
                                        ): ?>

                                            <tr>

                                                <td>

                                                    <?= htmlspecialchars(
                                                        $permission['name']
                                                    ) ?>

                                                </td>

                                                <td>

                                                    <?php if (
                                                        $permission['role_allowed']
                                                    ): ?>

                                                        <span
                                                            class="badge badge-success"
                                                        >

                                                            Allowed

                                                        </span>

                                                    <?php else: ?>

                                                        <span
                                                            class="badge badge-danger"
                                                        >

                                                            Denied

                                                        </span>

                                                    <?php endif; ?>

                                                </td>

                                                <td>

                                                    <select
                                                        name="permissions[<?= $permission['id'] ?>]"
                                                        class="form-control"
                                                    >

                                                        <option
                                                            value="inherit"
                                                            <?= $permission['state'] === 'inherit'
                                                                ? 'selected'
                                                                : '' ?>
                                                        >

                                                            Inherit

                                                        </option>

                                                        <option
                                                            value="allow"
                                                            <?= $permission['state'] === 'allow'
                                                                ? 'selected'
                                                                : '' ?>
                                                        >

                                                            Allow

                                                        </option>

                                                        <option
                                                            value="deny"
                                                            <?= $permission['state'] === 'deny'
                                                                ? 'selected'
                                                                : '' ?>
                                                        >

                                                            Deny

                                                        </option>

                                                    </select>

                                                </td>

                                            </tr>

                                        <?php endforeach; ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

                <div class="card-footer">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        Save User Permissions

                    </button>

                    <a
                        href="<?= url('dashboard/user_permissions') ?>"
                        class="btn btn-secondary"
                    >

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</section>