<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Role Permissions
                </h1>

            </div>

        </div>

    </div>

</div>

<section class="content">

    <div class="container-fluid">

        <div class="card">

            <div class="card-body table-responsive p-0">

                <table
                    class="table table-bordered table-striped datatable"
                >

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Role Name</th>

                            <th>Permissions</th>

                            <th>Status</th>

                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($roles as $role): ?>

                            <tr>

                                <!-- ROLE ID -->
                                <td>

                                    <?= $role['id'] ?>

                                </td>

                                <!-- ROLE NAME -->
                                <td>

                                    <?= htmlspecialchars(
                                        $role['name']
                                    ) ?>

                                </td>

                                <!-- PERMISSION COUNT -->
                                <td>

                                    <span
                                        class="badge badge-info"
                                    >

                                        <?= $role['permissions_count'] ?>

                                    </span>

                                </td>

                                <!-- STATUS -->
                                <td>

                                    <?php if (
                                        $role['status']
                                        ===
                                        'active'
                                    ): ?>

                                        <span
                                            class="badge badge-success"
                                        >

                                            Active

                                        </span>

                                    <?php else: ?>

                                        <span
                                            class="badge badge-danger"
                                        >

                                            Inactive

                                        </span>

                                    <?php endif; ?>

                                </td>

                                <!-- ACTIONS -->
                                <td>

                                    <?php if (
                                        strtolower(
                                            $role['name']
                                        )
                                        ===
                                        'super admin'
                                    ): ?>

                                        <span
                                            class="badge badge-primary"
                                        >

                                            Full Access

                                        </span>

                                    <?php else: ?>

                                        <a
                                            href="<?= url('dashboard/role_permissions/edit/' . $role['id']) ?>"
                                            class="btn btn-sm btn-info"
                                        >

                                            Manage Permissions

                                        </a>

                                    <?php endif; ?>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</section>