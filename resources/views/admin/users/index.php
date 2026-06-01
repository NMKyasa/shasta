<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Users
                </h1>

            </div>

            <div class="col-sm-6 text-right">

                <a
                    href="<?= url('dashboard/users/create') ?>"
                    class="btn btn-primary"
                >

                    Add User

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

                            <th>Email</th>

                            <th>Role</th>

                            <th>Status</th>

                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($users as $user): ?>

                            <tr>

                                <!-- USER ID -->
                                <td>

                                    <?= $user['id'] ?>

                                </td>

                                <!-- FULL NAME -->
                                <td>

                                    <?= htmlspecialchars(

                                        $user['first_name']
                                        .
                                        ' '
                                        .
                                        $user['last_name']

                                    ) ?>

                                </td>

                                <!-- EMAIL -->
                                <td>

                                    <?= htmlspecialchars(
                                        $user['email']
                                    ) ?>

                                </td>

                                <!-- ROLE -->
                                <td>

                                    <span
                                        class="badge badge-info"
                                    >

                                        <?= htmlspecialchars(
                                            $user['role_name']
                                        ) ?>

                                    </span>

                                </td>

                                <!-- STATUS -->
                                <td>

                                    <?php if (
                                        $user['status']
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

                                    <a
                                        href="<?= url('dashboard/users/edit/' . $user['id']) ?>"
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