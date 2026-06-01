<div class="content-header">

    <div class="container-fluid">

        <div class="col-sm-6 text-right">

            <form
                method="POST"
                action="<?= url('dashboard/permissions/generate') ?>"
                style="display:inline;"
            >

                <input
                    type="hidden"
                    name="_token"
                    value="<?= csrf_token() ?>"
                >

                <button
                    type="submit"
                    class="btn btn-success"
                >

                    Generate Permissions

                </button>

            </form>

            <a
                href="<?= url('dashboard/permissions/create') ?>"
                class="btn btn-primary"
            >

                Add Permission

            </a>

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

                            <th>Module</th>

                            <th>Action</th>

                            <th>Permission Name</th>

                            <th>Description</th>

                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($permissions as $permission): ?>

                            <tr>

                                <td>

                                    <?= $permission['id'] ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $permission['module']
                                    ) ?>

                                </td>

                                <td>

                                    <span
                                        class="badge badge-info"
                                    >

                                        <?= htmlspecialchars(
                                            ucfirst(
                                                $permission['action']
                                            )
                                        ) ?>

                                    </span>

                                </td>

                                <td>

                                    <code>

                                        <?= htmlspecialchars(
                                            $permission['name']
                                        ) ?>

                                    </code>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $permission['description']
                                    ) ?>

                                </td>

                                <td>

                                    <a
                                        href="<?= url('dashboard/permissions/edit/' . $permission['id']) ?>"
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