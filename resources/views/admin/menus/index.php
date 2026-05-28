<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Menus
                </h1>

            </div>

            <div class="col-sm-6 text-right">

                <a
                    href="<?= url('dashboard/menus/create') ?>"
                    class="btn btn-primary"
                >

                    Add Menu

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

                            <th>Menu Key</th>

                            <th>Description</th>

                            <th>Status</th>

                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($menus as $menu): ?>

                            <tr>

                                <!-- ID -->
                                <td>
                                    <?= $menu['id'] ?>
                                </td>

                                <!-- NAME -->
                                <td>

                                    <?= htmlspecialchars(
                                        $menu['name']
                                    ) ?>

                                </td>

                                <!-- MENU KEY -->
                                <td>

                                    <span class="badge badge-info">

                                        <?= htmlspecialchars(
                                            $menu['menu_key']
                                        ) ?>

                                    </span>

                                </td>

                                <!-- DESCRIPTION -->
                                <td>

                                    <?= htmlspecialchars(
                                        $menu['description']
                                        ?? ''
                                    ) ?>

                                </td>

                                <!-- STATUS -->
                                <td>

                                    <?php if (
                                        $menu['status']
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

                                <!-- ACTIONS -->
                                <td>

                                    <a
                                        href="<?= url('dashboard/menus/edit/' . $menu['id']) ?>"
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