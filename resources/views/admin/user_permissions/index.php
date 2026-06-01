<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    User Permissions
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

                            <th>Name</th>

                            <th>Email</th>

                            <th>Role</th>

                            <th>Overrides</th>

                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($users as $user): ?>

                            <tr>

                                <td>

                                    <?= $user['id'] ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(

                                        $user['first_name']
                                        .
                                        ' '
                                        .
                                        $user['last_name']

                                    ) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $user['email']
                                    ) ?>

                                </td>

                                <td>

                                    <span
                                        class="badge badge-info"
                                    >

                                        <?= htmlspecialchars(
                                            $user['role_name']
                                        ) ?>

                                    </span>

                                </td>

                                <td>

                                    <span
                                        class="badge badge-secondary"
                                    >

                                        <?= $user['overrides_count'] ?>

                                    </span>

                                </td>

                                <td>

                                    <a
                                        href="<?= url('dashboard/user_permissions/edit/' . $user['id']) ?>"
                                        class="btn btn-sm btn-primary"
                                    >

                                        Manage Permissions

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