<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Pricing Items
                </h1>

            </div>

            <div class="col-sm-6 text-right">

                <a
                    href="<?= url('dashboard/pricing/create') ?>"
                    class="btn btn-primary"
                >

                    Add Pricing Item

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

                            <th>Service</th>

                            <th>Title</th>

                            <th>Subtitle</th>

                            <th>Price</th>

                            <th>Type</th>

                            <th>Period</th>

                            <th>Featured</th>

                            <th>Status</th>

                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($pricingItems as $pricingItem): ?>

                            <tr>

                                <!-- ID -->
                                <td>

                                    <?= $pricingItem['id'] ?>

                                </td>

                                <!-- SERVICE -->
                                <td>

                                    <?= htmlspecialchars(
                                        $pricingItem['service_title']
                                    ) ?>

                                </td>

                                <!-- TITLE -->
                                <td>

                                    <?= htmlspecialchars(
                                        $pricingItem['title']
                                    ) ?>

                                </td>

                                <!-- SUBTITLE -->
                                <td>

                                    <?= htmlspecialchars(
                                        $pricingItem['subtitle']
                                    ) ?>

                                </td>

                                <!-- PRICE -->
                                <td>

                                    <?php if (
                                        $pricingItem['pricing_type']
                                        ===
                                        'negotiable'
                                    ): ?>

                                        <span class="badge badge-warning">

                                            Negotiable

                                        </span>

                                    <?php else: ?>

                                        <?= htmlspecialchars(
                                            $pricingItem['currency']
                                        ) ?>

                                        <?= number_format(
                                            $pricingItem['price']
                                        ) ?>

                                    <?php endif; ?>

                                </td>

                                <!-- PRICING TYPE -->
                                <td>

                                    <?php if (
                                        $pricingItem['pricing_type']
                                        ===
                                        'fixed'
                                    ): ?>

                                        <span class="badge badge-success">

                                            Fixed

                                        </span>

                                    <?php else: ?>

                                        <span class="badge badge-info">

                                            Negotiable

                                        </span>

                                    <?php endif; ?>

                                </td>

                                <!-- PRICING PERIOD -->
                                <td>

                                    <?= htmlspecialchars(
                                        $pricingItem['pricing_period']
                                    ) ?>

                                </td>

                                <!-- FEATURED -->
                                <td>

                                    <?php if (
                                        $pricingItem['featured']
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
                                        $pricingItem['status']
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
                                        href="<?= url('dashboard/pricing/edit/' . $pricingItem['id']) ?>"
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