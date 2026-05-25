<?php

use App\Core\Services\Flash;

$flash =
    Flash::get();

?>

<?php if ($flash): ?>

    <div
        class="alert alert-<?= $flash['type'] ?> alert-dismissible fade show"
        role="alert"
    >

        <?= htmlspecialchars(
            $flash['message']
        ) ?>

        <button
            type="button"
            class="close"
            data-dismiss="alert"
        >

            <span>&times;</span>

        </button>

    </div>

<?php endif; ?>