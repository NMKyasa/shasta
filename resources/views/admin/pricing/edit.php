<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Edit Pricing Item
                </h1>

            </div>

            <div class="col-sm-6 text-right">

                <a
                    href="<?= url('dashboard/pricing') ?>"
                    class="btn btn-secondary"
                >

                    Back

                </a>

            </div>

        </div>

    </div>

</div>

<section class="content">

    <div class="container-fluid">

        <div class="card">

            <div class="card-body">

                <div
                    class="alert alert-danger"
                    id="form-error"
                    style="display:none;"
                ></div>

                <form
                    method="POST"
                    action="<?= url('dashboard/pricing/update/' . $pricingItem['id']) ?>"
                >

                    <!-- SERVICE -->
                    <div class="form-group">

                        <label>

                            Service
                            <span class="text-danger">*</span>

                        </label>

                        <select
                            name="service_id"
                            class="form-control"
                            required
                        >

                            <option value="">
                                Select Service
                            </option>

                            <?php foreach ($services as $service): ?>

                                <option
                                    value="<?= $service['id'] ?>"
                                    <?= $pricingItem['service_id'] == $service['id']
                                        ? 'selected'
                                        : '' ?>
                                >

                                    <?= htmlspecialchars(
                                        $service['title']
                                    ) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <!-- TITLE -->
                    <div class="form-group">

                        <label>

                            Pricing Title
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="title"
                            class="form-control"
                            value="<?= htmlspecialchars($pricingItem['title']) ?>"
                            required
                        >

                    </div>

                    <!-- SUBTITLE -->
                    <div class="form-group">

                        <label>
                            Subtitle
                        </label>

                        <input
                            type="text"
                            name="subtitle"
                            class="form-control"
                            value="<?= htmlspecialchars($pricingItem['subtitle']) ?>"
                        >

                    </div>

                    <!-- PRICING TYPE -->
                    <div class="form-group">

                        <label>
                            Pricing Type
                        </label>

                        <select
                            name="pricing_type"
                            id="pricing_type"
                            class="form-control"
                        >

                            <option
                                value="fixed"
                                <?= $pricingItem['pricing_type'] === 'fixed'
                                    ? 'selected'
                                    : '' ?>
                            >

                                Fixed

                            </option>

                            <option
                                value="negotiable"
                                <?= $pricingItem['pricing_type'] === 'negotiable'
                                    ? 'selected'
                                    : '' ?>
                            >

                                Negotiable

                            </option>

                        </select>

                    </div>

                    <!-- PRICE -->
                    <div
                        class="form-group"
                        id="price-wrapper"
                    >

                        <label>
                            Price
                        </label>

                        <input
                            type="number"
                            name="price"
                            class="form-control"
                            step="0.01"
                            value="<?= htmlspecialchars($pricingItem['price']) ?>"
                        >

                    </div>

                    <!-- CURRENCY -->
                    <div class="form-group">

                        <label>
                            Currency
                        </label>

                        <select
                            name="currency"
                            class="form-control"
                        >

                            <option
                                value="UGX"
                                <?= $pricingItem['currency'] === 'UGX'
                                    ? 'selected'
                                    : '' ?>
                            >

                                UGX

                            </option>

                            <option
                                value="USD"
                                <?= $pricingItem['currency'] === 'USD'
                                    ? 'selected'
                                    : '' ?>
                            >

                                USD

                            </option>

                            <option
                                value="EUR"
                                <?= $pricingItem['currency'] === 'EUR'
                                    ? 'selected'
                                    : '' ?>
                            >

                                EUR

                            </option>

                        </select>

                    </div>

                    <!-- PRICING PERIOD -->
                    <div class="form-group">

                        <label>
                            Pricing Period
                        </label>

                        <select
                            name="pricing_period"
                            class="form-control"
                        >

                            <option
                                value="per_day"
                                <?= $pricingItem['pricing_period'] === 'per_day'
                                    ? 'selected'
                                    : '' ?>
                            >

                                Per Day

                            </option>

                            <option
                                value="monthly"
                                <?= $pricingItem['pricing_period'] === 'monthly'
                                    ? 'selected'
                                    : '' ?>
                            >

                                Monthly

                            </option>

                            <option
                                value="per_shift"
                                <?= $pricingItem['pricing_period'] === 'per_shift'
                                    ? 'selected'
                                    : '' ?>
                            >

                                Per Shift

                            </option>

                            <option
                                value="per_hour"
                                <?= $pricingItem['pricing_period'] === 'per_hour'
                                    ? 'selected'
                                    : '' ?>
                            >

                                Per Hour

                            </option>

                        </select>

                    </div>

                    <!-- DESCRIPTION -->
                    <div class="form-group">

                        <label>
                            Description
                        </label>

                        <textarea
                            name="description"
                            class="form-control"
                            rows="4"
                        ><?= htmlspecialchars($pricingItem['description']) ?></textarea>

                    </div>

                    <!-- SORT ORDER -->
                    <div class="form-group">

                        <label>
                            Sort Order
                        </label>

                        <input
                            type="number"
                            name="sort_order"
                            class="form-control"
                            value="<?= htmlspecialchars($pricingItem['sort_order']) ?>"
                        >

                    </div>

                    <!-- FEATURED -->
                    <div class="form-group">

                        <div class="custom-control custom-checkbox">

                            <input
                                type="checkbox"
                                name="featured"
                                value="1"
                                class="custom-control-input"
                                id="featured"
                                <?= $pricingItem['featured']
                                    ? 'checked'
                                    : '' ?>
                            >

                            <label
                                class="custom-control-label"
                                for="featured"
                            >

                                Featured Pricing

                            </label>

                        </div>

                    </div>

                    <!-- STATUS -->
                    <div class="form-group">

                        <label>
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-control"
                        >

                            <option
                                value="active"
                                <?= $pricingItem['status'] === 'active'
                                    ? 'selected'
                                    : '' ?>
                            >

                                Active

                            </option>

                            <option
                                value="inactive"
                                <?= $pricingItem['status'] === 'inactive'
                                    ? 'selected'
                                    : '' ?>
                            >

                                Inactive

                            </option>

                        </select>

                    </div>

                    <hr>

                    <!-- SUBMIT -->
                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        Update Pricing Item

                    </button>

                    <a
                        href="<?= url('dashboard/pricing') ?>"
                        class="btn btn-secondary"
                    >

                        Cancel

                    </a>

                </form>

            </div>

        </div>

    </div>

</section>

<script>

document.addEventListener(

    'DOMContentLoaded',

    function () {

        const pricingType =
            document.getElementById(
                'pricing_type'
            );

        const priceWrapper =
            document.getElementById(
                'price-wrapper'
            );

        function togglePriceField()
        {
            if (
                pricingType.value
                ===
                'negotiable'
            ) {

                priceWrapper.style.display =
                    'none';

            } else {

                priceWrapper.style.display =
                    'block';
            }
        }

        togglePriceField();

        pricingType.addEventListener(
            'change',
            togglePriceField
        );
    }
);

</script>