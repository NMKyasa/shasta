<div class="container py-5">

    <div class="text-center mb-5">

        <h1>

            <?= htmlspecialchars(
                $project['title']
            ) ?>

        </h1>

    </div>

    <?php if (
        !empty(
            $project['file_path']
        )
    ): ?>

        <img
            src="<?= url(
                $project['file_path']
            ) ?>"
            class="img-fluid w-100 mb-5"
            alt="<?= htmlspecialchars(
                $project['title']
            ) ?>"
        >

    <?php endif; ?>

    <?php if (
        !empty(
            $project['summary']
        )
    ): ?>

        <div class="mb-4">

            <h3>Project Summary</h3>

            <p>

                <?= nl2br(
                    htmlspecialchars(
                        $project['summary']
                    )
                ) ?>

            </p>

        </div>

    <?php endif; ?>

    <?php if (
        !empty(
            $project['client_name']
        )
    ): ?>

        <div class="mb-3">

            <strong>Client:</strong>

            <?= htmlspecialchars(
                $project['client_name']
            ) ?>

        </div>

    <?php endif; ?>

    <?php if (
        !empty(
            $project['completion_date']
        )
    ): ?>

        <div class="mb-4">

            <strong>Completion Date:</strong>

            <?= htmlspecialchars(
                $project['completion_date']
            ) ?>

        </div>

    <?php endif; ?>

    <?php if (
        !empty(
            $project['scope']
        )
    ): ?>

        <div class="mb-5">

            <h3>Project Scope</h3>

            <?= $project['scope'] ?>

        </div>

    <?php endif; ?>

    <?php if (
        !empty(
            $project['impact']
        )
    ): ?>

        <div class="mb-5">

            <h3>Project Impact</h3>

            <?= $project['impact'] ?>

        </div>

    <?php endif; ?>

    <?php if (
        !empty(
            $project['body']
        )
    ): ?>

        <div>

            <h3>Project Details</h3>

            <?= $project['body'] ?>

        </div>

    <?php endif; ?>

</div>