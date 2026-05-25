<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Services
                </h1>

            </div>

            <div class="col-sm-6 text-right">

                <a href="<?= url('dashboard/services/create') ?>"
                   class="btn btn-primary">

                    Add Service

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
                    id="services-table"
                    class="table table-bordered table-striped"
                >

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Image</th>

                            <th>Title</th>

                            <th>Slug</th>

                            <th>Status</th>

                            <th>Featured</th>

                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($services as $service): ?>

                            <tr>

                                <td>
                                    <?= $service['id'] ?>
                                </td>

                                <td>

                                    <?php if ($service['featured_image']): ?>

                                        <img
                                            src="<?= asset($service['featured_image']) ?>"
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
                                        $service['title']
                                    ) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars(
                                        $service['slug']
                                    ) ?>
                                </td>

                                <td>

                                    <?php if (
                                        $service['status']
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

                                    <?php if (
                                        $service['featured']
                                    ): ?>

                                        <span class="badge badge-primary">
                                            Featured
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <a href="<?= url('dashboard/services/edit/' . $service['id']) ?>"
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
