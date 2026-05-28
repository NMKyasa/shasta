<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Impact
                </h1>

            </div>

            <div class="col-sm-6 text-right">

                <a href="<?= url('dashboard/impact/create') ?>"
                   class="btn btn-primary">

                    Add Impact

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

                            <th>Impact Label</th>

                            <th>Impact Value</th>

                            <th>Status</th>

                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($impact as $impact): ?>

                            <tr>

                                <td>
                                    <?= $impact['id'] ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars(
                                        $impact['label']
                                    ) ?>
                                </td>
                                
                                <td>
                                    <?= htmlspecialchars(
                                        $impact['value']
                                    ) ?>
                                </td>

                                <td>

                                    <?php if (
                                        $impact['status']
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

                                    <a href="<?= url('dashboard/impact/edit/' . $impact['id']) ?>"
                                       class="btn btn-sm btn-info">

                                        Edit

                                    </a>

                                    <!-- <a href="#"
                                       class="btn btn-sm btn-danger">

                                        Delete

                                    </a> -->

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</section>
