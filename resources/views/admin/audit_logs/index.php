<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Audit Logs
                </h1>

            </div>

        </div>

    </div>

</div>

<section class="content">

    <div class="container-fluid">

        <!-- FILTERS -->
        <div class="card">

            <div class="card-body">

                <form
                    method="GET"
                    action=""
                >

                    <div class="row">

                        <!-- SEARCH -->
                        <div class="col-md-3">

                            <div class="form-group">

                                <label>
                                    Search
                                </label>

                                <input
                                    type="text"
                                    name="search"
                                    class="form-control"
                                    placeholder="Action or Module"
                                    value="<?= htmlspecialchars(
                                        $filters['search']
                                        ?? ''
                                    ) ?>"
                                >

                            </div>

                        </div>

                        <!-- MODULE -->
                        <div class="col-md-3">

                            <div class="form-group">

                                <label>
                                    Module
                                </label>

                                <select
                                    name="module"
                                    class="form-control"
                                >

                                    <option value="">
                                        All Modules
                                    </option>

                                    <?php foreach (
                                        $modules
                                        as
                                        $module
                                    ): ?>

                                        <option
                                            value="<?= $module['module'] ?>"
                                            <?= (
                                                $filters['module']
                                                ??
                                                ''
                                            ) === $module['module']
                                            ? 'selected'
                                            : '' ?>
                                        >

                                            <?= ucfirst(
                                                $module['module']
                                            ) ?>

                                        </option>

                                    <?php endforeach; ?>

                                </select>

                            </div>

                        </div>

                        <!-- LOG TYPE -->
                        <div class="col-md-2">

                            <div class="form-group">

                                <label>
                                    Log Type
                                </label>

                                <select
                                    name="log_type"
                                    class="form-control"
                                >

                                    <option value="">
                                        All
                                    </option>

                                    <option
                                        value="activity"
                                        <?= (
                                            $filters['log_type']
                                            ??
                                            ''
                                        ) === 'activity'
                                        ? 'selected'
                                        : '' ?>
                                    >
                                        Activity
                                    </option>

                                    <option
                                        value="security"
                                        <?= (
                                            $filters['log_type']
                                            ??
                                            ''
                                        ) === 'security'
                                        ? 'selected'
                                        : '' ?>
                                    >
                                        Security
                                    </option>

                                </select>

                            </div>

                        </div>

                        <!-- USER -->
                        <div class="col-md-2">

                            <div class="form-group">

                                <label>
                                    User
                                </label>

                                <select
                                    name="user_id"
                                    class="form-control"
                                >

                                    <option value="">
                                        All Users
                                    </option>

                                    <?php foreach (
                                        $users
                                        as
                                        $user
                                    ): ?>

                                        <option
                                            value="<?= $user['id'] ?>"
                                            <?= (
                                                $filters['user_id']
                                                ??
                                                ''
                                            ) == $user['id']
                                            ? 'selected'
                                            : '' ?>
                                        >

                                            <?= htmlspecialchars(

                                                $user['first_name']
                                                .
                                                ' '
                                                .
                                                $user['last_name']

                                            ) ?>

                                        </option>

                                    <?php endforeach; ?>

                                </select>

                            </div>

                        </div>

                        <!-- BUTTONS -->
                        <div class="col-md-2">

                            <div class="form-group">

                                <label>
                                    &nbsp;
                                </label>

                                <div>

                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >

                                        Filter

                                    </button>

                                    <a
                                        href="<?= url('dashboard/audit_logs') ?>"
                                        class="btn btn-secondary"
                                    >

                                        Reset

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </div>

        <!-- LOGS TABLE -->
        <div class="card">

            <div class="card-body table-responsive p-0">

                <table
                    class="table table-bordered table-striped datatable"
                >

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>User</th>

                            <th>Action</th>

                            <th>Module</th>

                            <th>Type</th>

                            <th>IP Address</th>

                            <th>Date</th>

                            <th width="120">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach (
                            $auditLogs
                            as
                            $log
                        ): ?>

                            <tr>

                                <td>
                                    <?= $log['id'] ?>
                                </td>

                                <td>

                                    <?= htmlspecialchars(

                                        $log['user_name']
                                        ??
                                        'System'

                                    ) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $log['action']
                                    ) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $log['module']
                                    ) ?>

                                </td>

                                <td>

                                    <?php if (
                                        $log['log_type']
                                        ===
                                        'security'
                                    ): ?>

                                        <span class="badge badge-danger">

                                            Security

                                        </span>

                                    <?php else: ?>

                                        <span class="badge badge-info">

                                            Activity

                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $log['ip_address']
                                        ?? 'N/A'
                                    ) ?>

                                </td>

                                <td>

                                    <?= date(

                                        'd M Y H:i',

                                        strtotime(
                                            $log['created_at']
                                        )

                                    ) ?>

                                </td>

                                <td>

                                    <a
                                        href="<?= url(
                                            'dashboard/audit_logs/show/'
                                            .
                                            $log['id']
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