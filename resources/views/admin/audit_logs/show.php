<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">

                    Audit Log Details

                </h1>

            </div>

            <div class="col-sm-6 text-right">

                <a
                    href="<?= url('dashboard/audit-logs') ?>"
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

        <!-- LOG DETAILS -->
        <div class="card">

            <div class="card-header">

                <h3 class="card-title">

                    Audit Information

                </h3>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6">

                        <table
                            class="table table-bordered"
                        >

                            <tr>

                                <th width="180">

                                    ID

                                </th>

                                <td>

                                    <?= $auditLog['id'] ?>

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    User

                                </th>

                                <td>

                                    <?= htmlspecialchars(

                                        $auditLog['user_name']
                                        ??
                                        'System'

                                    ) ?>

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Action

                                </th>

                                <td>

                                    <?= htmlspecialchars(
                                        $auditLog['action']
                                    ) ?>

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Module

                                </th>

                                <td>

                                    <?= htmlspecialchars(
                                        $auditLog['module']
                                    ) ?>

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Target ID

                                </th>

                                <td>

                                    <?= $auditLog['target_id']
                                        ?? 'N/A' ?>

                                </td>

                            </tr>

                        </table>

                    </div>

                    <div class="col-md-6">

                        <table
                            class="table table-bordered"
                        >

                            <tr>

                                <th width="180">

                                    Log Type

                                </th>

                                <td>

                                    <?php if (
                                        $auditLog['log_type']
                                        ===
                                        'security'
                                    ): ?>

                                        <span
                                            class="badge badge-danger"
                                        >

                                            Security

                                        </span>

                                    <?php else: ?>

                                        <span
                                            class="badge badge-info"
                                        >

                                            Activity

                                        </span>

                                    <?php endif; ?>

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    IP Address

                                </th>

                                <td>

                                    <?= htmlspecialchars(

                                        $auditLog['ip_address']
                                        ?? 'N/A'

                                    ) ?>

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Date

                                </th>

                                <td>

                                    <?= date(

                                        'd M Y H:i:s',

                                        strtotime(
                                            $auditLog['created_at']
                                        )

                                    ) ?>

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    User Agent

                                </th>

                                <td>

                                    <small>

                                        <?= htmlspecialchars(

                                            $auditLog['user_agent']
                                            ?? 'N/A'

                                        ) ?>

                                    </small>

                                </td>

                            </tr>

                        </table>

                    </div>

                </div>

            </div>

        </div>

        <!-- CHANGES COMPARISON -->
        <div class="card">

            <div class="card-header">

                <h3 class="card-title">

                    Changes Comparison

                </h3>

            </div>

            <div class="card-body">

                <?php

                $oldValues =
                    $auditLog['old_values']
                    ?? [];

                $newValues =
                    $auditLog['new_values']
                    ?? [];

                $fields =
                    array_unique(

                        array_merge(

                            array_keys(
                                $oldValues
                            ),

                            array_keys(
                                $newValues
                            )
                        )
                    );

                ?>

                <?php if (
                    !empty($fields)
                ): ?>

                    <table
                        class="table table-bordered table-striped"
                    >

                        <thead>

                            <tr>

                                <th width="25%">

                                    Field

                                </th>

                                <th width="37.5%">

                                    Old Value

                                </th>

                                <th width="37.5%">

                                    New Value

                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach (
                                $fields
                                as
                                $field
                            ): ?>

                                <?php

                                $oldValue =
                                    $oldValues[$field]
                                    ?? null;

                                $newValue =
                                    $newValues[$field]
                                    ?? null;

                                $changed =
                                    json_encode(
                                        $oldValue
                                    )

                                    !==

                                    json_encode(
                                        $newValue
                                    );

                                ?>

                                <tr>

                                    <td>

                                        <strong>

                                            <?= htmlspecialchars(
                                                $field
                                            ) ?>

                                        </strong>

                                    </td>

                                    <td>

                                        <?php if (
                                            is_array(
                                                $oldValue
                                            )
                                        ): ?>

                                            <pre class="mb-0"><?=
                                                htmlspecialchars(

                                                    json_encode(

                                                        $oldValue,

                                                        JSON_PRETTY_PRINT

                                                    )
                                                )
                                            ?></pre>

                                        <?php else: ?>

                                            <?= htmlspecialchars(

                                                $oldValue
                                                ?? '—'

                                            ) ?>

                                        <?php endif; ?>

                                    </td>

                                    <td>

                                        <?php if (
                                            is_array(
                                                $newValue
                                            )
                                        ): ?>

                                            <pre class="mb-0"><?=
                                                htmlspecialchars(

                                                    json_encode(

                                                        $newValue,

                                                        JSON_PRETTY_PRINT

                                                    )
                                                )
                                            ?></pre>

                                        <?php else: ?>

                                            <?= htmlspecialchars(

                                                $newValue
                                                ?? '—'

                                            ) ?>

                                        <?php endif; ?>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                <?php else: ?>

                    <p class="text-muted">

                        No changes recorded.

                    </p>

                <?php endif; ?>

            </div>

        </div>

    </div>

</section>