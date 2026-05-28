<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Sliders
                </h1>

            </div>

            <div class="col-sm-6 text-right">

                <a
                    href="<?= url('dashboard/sliders/create') ?>"
                    class="btn btn-primary"
                >

                    Add Slider

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

                            <th>Featured Image</th>

                            <th>Title</th>

                            <th>Subtitle</th>

                            <th>Button</th>

                            <th>Status</th>

                            <th>Featured</th>

                            <th>Sort Order</th>

                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($sliders as $slider): ?>

                            <tr>

                                <!-- ID -->
                                <td>

                                    <?= $slider['id'] ?>

                                </td>

                                <!-- IMAGE -->
                                <td>

                                    <?php if (
                                        !empty(
                                            $slider['featured_image']
                                        )
                                    ): ?>

                                        <img
                                            src="<?= asset($slider['featured_image']) ?>"
                                            style="
                                                width: 120px;
                                                height: 70px;
                                                object-fit: cover;
                                                border-radius: 6px;
                                            "
                                        >

                                    <?php else: ?>

                                        <span class="text-muted">

                                            No Image

                                        </span>

                                    <?php endif; ?>

                                </td>

                                <!-- TITLE -->
                                <td>

                                    <?= htmlspecialchars(
                                        $slider['title']
                                    ) ?>

                                </td>

                                <!-- SUBTITLE -->
                                <td>

                                    <?php if (
                                        !empty(
                                            $slider['subtitle']
                                        )
                                    ): ?>

                                        <?= htmlspecialchars(
                                            mb_strimwidth(
                                                $slider['subtitle'],
                                                0,
                                                50,
                                                '...'
                                            )
                                        ) ?>

                                    <?php else: ?>

                                        <span class="text-muted">

                                            N/A

                                        </span>

                                    <?php endif; ?>

                                </td>

                                <!-- BUTTON -->
                                <td>

                                    <?php if (
                                        !empty(
                                            $slider['button_text']
                                        )
                                    ): ?>

                                        <span class="badge badge-info">

                                            <?= htmlspecialchars(
                                                $slider['button_text']
                                            ) ?>

                                        </span>

                                    <?php else: ?>

                                        <span class="text-muted">

                                            N/A

                                        </span>

                                    <?php endif; ?>

                                </td>

                                <!-- STATUS -->
                                <td>

                                    <?php if (
                                        $slider['status']
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

                                <!-- FEATURED -->
                                <td>

                                    <?php if (
                                        $slider['featured']
                                    ): ?>

                                        <span class="badge badge-primary">

                                            Featured

                                        </span>

                                    <?php else: ?>

                                        <span class="text-muted">

                                            No

                                        </span>

                                    <?php endif; ?>

                                </td>

                                <!-- SORT ORDER -->
                                <td>

                                    <?= $slider['sort_order'] ?>

                                </td>

                                <!-- ACTIONS -->
                                <td>

                                    <a
                                        href="<?= url('dashboard/sliders/edit/' . $slider['id']) ?>"
                                        class="btn btn-sm btn-info"
                                    >

                                        Edit

                                    </a>

                                    <!-- DELETE DISABLED -->

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</section>