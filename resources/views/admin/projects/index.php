<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Projects
                </h1>

            </div>

            <div class="col-sm-6 text-right">

                <a href="<?= url('dashboard/projects/create') ?>"
                   class="btn btn-primary">

                    Add Project

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

                            <th>Image</th>

                            <th>Title</th>

                            <th>Client</th>

                            <th>Status</th>

                            <th>Scope</th>

                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($projects as $project): ?>

                            <tr>

                                <td>
                                    <?= $project['id'] ?>
                                </td>

                                <td>

                                    <?php if ($project['featured_image']): ?>

                                        <img
                                            src="<?= asset($project['featured_image']) ?>"
                                            style="
                                                width: 80px;
                                                height: 60px;
                                                object-fit: cover;
                                                border-radius: 6px;
                                            "
                                        >

                                    <?php endif; ?>

                                </td>

                                <td>
                                    <?= htmlspecialchars(
                                        $project['title']
                                    ) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars(
                                        $project['client_name']
                                    ) ?>
                                </td>

                                <td>

                                    <?php if (
                                        $project['status']
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
                                    <?= htmlspecialchars(
                                        $project['scope']
                                    ) ?>
                                </td>

                                <td>

                                    <a href="<?= url('dashboard/projects/edit/' . $project['id']) ?>"
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
