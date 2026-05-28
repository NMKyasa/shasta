<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Inquiries
                </h1>

            </div>

        </div>

    </div>

</div>

<section class="content">

    <div class="container-fluid">

        <!-- FILTERS -->
        <div class="mb-3">

            <a
                href="<?= url('dashboard/inquiries') ?>"
                class="btn btn-sm <?= !$selectedType ? 'btn-primary' : 'btn-default' ?>"
            >

                All

            </a>

            <a
                href="<?= url('dashboard/inquiries?type=contact') ?>"
                class="btn btn-sm <?= $selectedType === 'contact'
                    ? 'btn-primary'
                    : 'btn-default' ?>"
            >

                Contact

            </a>

            <a
                href="<?= url('dashboard/inquiries?type=quote') ?>"
                class="btn btn-sm <?= $selectedType === 'quote'
                    ? 'btn-primary'
                    : 'btn-default' ?>"
            >

                Quote Requests

            </a>

        </div>

        <div class="card">

            <div class="card-body table-responsive p-0">

                <table
                    class="table table-bordered table-striped datatable"
                >

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Type</th>

                            <th>Name</th>

                            <th>Email</th>

                            <th>Phone</th>

                            <th>Status</th>

                            <th>Date</th>

                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($inquiries as $inquiry): ?>

                            <tr>

                                <td>
                                    <?= $inquiry['id'] ?>
                                </td>

                                <td>

                                    <?php if (
                                        $inquiry['inquiry_type']
                                        ===
                                        'quote'
                                    ): ?>

                                        <span class="badge badge-info">

                                            Quote

                                        </span>

                                    <?php else: ?>

                                        <span class="badge badge-secondary">

                                            Contact

                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $inquiry['name']
                                    ) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $inquiry['email']
                                    ) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $inquiry['phone']
                                    ) ?>

                                </td>

                                <td>

                                    <?php if (
                                        $inquiry['status']
                                        ===
                                        'new'
                                    ): ?>

                                        <span class="badge badge-primary">

                                            New

                                        </span>

                                    <?php elseif (
                                        $inquiry['status']
                                        ===
                                        'in_progress'
                                    ): ?>

                                        <span class="badge badge-warning">

                                            In Progress

                                        </span>

                                    <?php elseif (
                                        $inquiry['status']
                                        ===
                                        'resolved'
                                    ): ?>

                                        <span class="badge badge-success">

                                            Resolved

                                        </span>

                                    <?php else: ?>

                                        <span class="badge badge-dark">

                                            Closed

                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <?= date(

                                        'd M Y',

                                        strtotime(
                                            $inquiry['created_at']
                                        )
                                    ) ?>

                                </td>

                                <td>

                                    <a
                                        href="<?= url(
                                            'dashboard/inquiries/show/'
                                            .
                                            $inquiry['id']
                                        ) ?>"
                                        class="btn btn-sm btn-info"
                                    >

                                        View

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