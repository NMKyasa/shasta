<div class="container py-5">

    <h1 class="mb-4">

        <?= htmlspecialchars(
            $service['title']
        ) ?>

    </h1>

    <?php if (
        !empty(
            $service['file_path']
        )
    ): ?>

        <img
            src="<?= url(
                $service['file_path']
            ) ?>"
            class="img-fluid mb-4"
            alt="<?= htmlspecialchars(
                $service['title']
            ) ?>"
        >

    <?php endif; ?>

    <div>

        <?= $service['body'] ?>

    </div>

</div>