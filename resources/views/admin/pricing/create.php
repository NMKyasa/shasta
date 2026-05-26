<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Add Pricing Item
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

                <form
                    method="POST"
                    action="<?= url('dashboard/pricing/store') ?>"
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

                            <option value="fixed">
                                Fixed
                            </option>

                            <option value="negotiable">
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

                            <option value="UGX">
                                UGX
                            </option>

                            <option value="USD">
                                USD
                            </option>

                            <option value="EUR">
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

                            <option value="per_day">
                                Per Day
                            </option>

                            <option value="monthly">
                                Monthly
                            </option>

                            <option value="per_shift">
                                Per Shift
                            </option>

                            <option value="per_hour">
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
                        ></textarea>

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
                            value="0"
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

                            <option value="active">
                                Active
                            </option>

                            <option value="inactive">
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

                        Save Pricing Item

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