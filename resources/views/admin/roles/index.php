<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Roles
                </h1>

            </div>

            <div class="col-sm-6 text-right">

                <a
                    href="<?= url('dashboard/roles/create') ?>"
                    class="btn btn-primary"
                >

                    Add Role

                </a>

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

                            <th>Name</th>

                            <th>System</th>

                            <th>Status</th>

                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($roles as $role): ?>

                            <tr>

                                <td>
                                    <?= $role['id'] ?>
                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $role['name']
                                    ) ?>

                                </td>

                                <td>

                                    <?php if (
                                        $role['is_system']
                                    ): ?>

                                        <span class="badge badge-info">

                                            Yes

                                        </span>

                                    <?php else: ?>

                                        <span class="badge badge-secondary">

                                            No

                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <?php if (
                                        $role['status']
                                        ===
                                        'active'
                                    ): ?>

                                        <span class="badge badge-success">

                                            Active

                                        </span>

                                    <?php else: ?>

                                        <span class="badge badge-danger">

                                            Inactive

                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <a
                                        href="<?= url('dashboard/roles/edit/' . $role['id']) ?>"
                                        class="btn btn-sm btn-info"
                                    >

                                        Edit

                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</section>