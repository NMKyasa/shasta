<?php if (!empty($pageHeaderTitle)): ?>

<!-- Page Header Start -->
<div class="container-fluid page-header py-5">
    <div class="container py-5">

        <h1 class="display-3 text-white mb-3 animated slideInDown">

            <?= htmlspecialchars($pageHeaderTitle) ?>

        </h1>

        <nav aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item">

                    <a
                        class="text-white"
                        href="<?= url('home') ?>"
                    >
                        Home
                    </a>

                </li>

                <li
                    class="breadcrumb-item text-white active"
                    aria-current="page"
                >

                    <?= htmlspecialchars($pageHeaderTitle) ?>

                </li>

            </ol>

        </nav>

    </div>
</div>
<!-- Page Header End -->

<?php endif; ?>