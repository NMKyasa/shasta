<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    TESTIMONIALS
                </h1>

            </div>

            <div class="col-sm-6 text-right">

                <a
                    href="<?= url('dashboard/testimonials/create') ?>"
                    class="btn btn-primary"
                >

                    Add Testimonial

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

                            <th>Photo</th>

                            <th>Name</th>

                            <th>Message</th>

                            <th>Rating</th>

                            <th>Featured</th>

                            <th>Status</th>

                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($testimonials as $testimonial): ?>

                            <tr>

                                <!-- ID -->
                                <td>

                                    <?= $testimonial['id'] ?>

                                </td>

                                <!-- PHOTO -->
                                <td>

                                    <?php if (
                                        !empty(
                                            $testimonial['featured_image']
                                        )
                                    ): ?>

                                        <img
                                            src="<?= asset($testimonial['featured_image']) ?>"
                                            style="
                                                width: 70px;
                                                height: 70px;
                                                object-fit: cover;
                                                border-radius: 50%;
                                            "
                                        >

                                    <?php else: ?>

                                        <div
                                            class="bg-light d-flex align-items-center justify-content-center"
                                            style="
                                                width: 70px;
                                                height: 70px;
                                                border-radius: 50%;
                                                font-size: 12px;
                                                color: #999;
                                            "
                                        >

                                            No Image

                                        </div>

                                    <?php endif; ?>

                                </td>

                                <!-- NAME -->
                                <td>

                                    <?= htmlspecialchars(
                                        $testimonial['name']
                                    ) ?>

                                </td>

                                <!-- MESSAGE -->
                                <td>

                                    <?= htmlspecialchars(
                                        $testimonial['message']
                                    ) ?>

                                </td>

                                <!-- RATING -->
                                <td>

                                    <?= $testimonial['rating'] ?>

                                </td>

                                <!-- FEATURED -->
                                <td>

                                    <?php if (
                                        $testimonial['featured']
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

                                <!-- STATUS -->
                                <td>

                                    <?php if (
                                        $testimonial['status']
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
                                        href="<?= url('dashboard/testimonials/edit/' . $testimonial['id']) ?>"
                                        class="btn btn-sm btn-info"
                                    >

                                        Edit

                                    </a>

                                    <!--
                                    <a
                                        href="#"
                                        class="btn btn-sm btn-danger"
                                    >

                                        Delete

                                    </a>
                                    -->

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</section>