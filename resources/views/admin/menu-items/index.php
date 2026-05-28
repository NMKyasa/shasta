<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Menu Items
                </h1>

            </div>

            <div class="col-sm-6 text-right">

                <a
                    href="<?= url('dashboard/menu-items/create') ?>"
                    class="btn btn-primary"
                >

                    Add Menu Item

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

                            <th>Menu</th>

                            <th>Parent</th>

                            <th>Title</th>

                            <th>URL</th>

                            <th>Target</th>

                            <th>Status</th>

                            <th>Sort</th>

                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($menuItems as $item): ?>

                            <tr>

                                <td>
                                    <?= $item['id'] ?>
                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $item['menu_name']
                                    ) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $item['parent_label'] ?? 'None'
                                    ) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $item['label']
                                    ) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $item['url']
                                    ) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $item['target']
                                    ) ?>

                                </td>

                                <td>

                                    <?php if (
                                        $item['status']
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

                                    <?= $item['sort_order'] ?>

                                </td>

                                <td>

                                    <a
                                        href="<?= url('dashboard/menu-items/edit/' . $item['id']) ?>"
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