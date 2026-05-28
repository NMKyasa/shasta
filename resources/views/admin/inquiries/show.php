<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">

                    Inquiry Details

                </h1>

            </div>

            <div class="col-sm-6 text-right">

                <a
                    href="<?= url('dashboard/inquiries') ?>"
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

        <div class="row">

            <!-- LEFT -->
            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">

                        <h3 class="card-title">

                            Inquiry Information

                        </h3>

                    </div>

                    <div class="card-body">

                        <table class="table table-bordered">

                            <tr>

                                <th width="200">
                                    Inquiry Type
                                </th>

                                <td>

                                    <?php if (
                                        $inquiry['inquiry_type']
                                        ===
                                        'quote'
                                    ): ?>

                                        <span class="badge badge-info">

                                            Quote Request

                                        </span>

                                    <?php else: ?>

                                        <span class="badge badge-secondary">

                                            Contact Inquiry

                                        </span>

                                    <?php endif; ?>

                                </td>

                            </tr>

                            <tr>

                                <th>
                                    Name
                                </th>

                                <td>

                                    <?= htmlspecialchars(
                                        $inquiry['name']
                                    ) ?>

                                </td>

                            </tr>

                            <tr>

                                <th>
                                    Email
                                </th>

                                <td>

                                    <?= htmlspecialchars(
                                        $inquiry['email']
                                    ) ?>

                                </td>

                            </tr>

                            <tr>

                                <th>
                                    Phone
                                </th>

                                <td>

                                    <?= htmlspecialchars(
                                        $inquiry['phone']
                                    ) ?>

                                </td>

                            </tr>

                            <?php if (
                                !empty(
                                    $inquiry['subject']
                                )
                            ): ?>

                                <tr>

                                    <th>
                                        Subject
                                    </th>

                                    <td>

                                        <?= htmlspecialchars(
                                            $inquiry['subject']
                                        ) ?>

                                    </td>

                                </tr>

                            <?php endif; ?>

                            <?php if (
                                !empty(
                                    $inquiry['service_title']
                                )
                            ): ?>

                                <tr>

                                    <th>
                                        Service
                                    </th>

                                    <td>

                                        <?= htmlspecialchars(
                                            $inquiry['service_title']
                                        ) ?>

                                    </td>

                                </tr>

                            <?php endif; ?>

                            <?php if (
                                !empty(
                                    $inquiry['project_title']
                                )
                            ): ?>

                                <tr>

                                    <th>
                                        Project
                                    </th>

                                    <td>

                                        <?= htmlspecialchars(
                                            $inquiry['project_title']
                                        ) ?>

                                    </td>

                                </tr>

                            <?php endif; ?>

                            <tr>

                                <th>
                                    Submitted On
                                </th>

                                <td>

                                    <?= date(

                                        'd M Y H:i A',

                                        strtotime(
                                            $inquiry['created_at']
                                        )
                                    ) ?>

                                </td>

                            </tr>

                            <tr>

                                <th>
                                    Message
                                </th>

                                <td>

                                    <?= nl2br(
                                        htmlspecialchars(
                                            $inquiry['message']
                                        )
                                    ) ?>

                                </td>

                            </tr>

                        </table>

                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="col-md-4">

                <div class="card">

                    <div class="card-header">

                        <h3 class="card-title">

                            Manage Inquiry

                        </h3>

                    </div>

                    <form
                        method="POST"
                        action="<?= url(
                            'dashboard/inquiries/update-status/'
                            .
                            $inquiry['id']
                        ) ?>"
                    >

                        <div class="card-body">

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
                                        value="new"
                                        <?= $inquiry['status'] === 'new'
                                            ? 'selected'
                                            : '' ?>
                                    >

                                        New

                                    </option>

                                    <option
                                        value="in_progress"
                                        <?= $inquiry['status'] === 'in_progress'
                                            ? 'selected'
                                            : '' ?>
                                    >

                                        In Progress

                                    </option>

                                    <option
                                        value="resolved"
                                        <?= $inquiry['status'] === 'resolved'
                                            ? 'selected'
                                            : '' ?>
                                    >

                                        Resolved

                                    </option>

                                    <option
                                        value="closed"
                                        <?= $inquiry['status'] === 'closed'
                                            ? 'selected'
                                            : '' ?>
                                    >

                                        Closed

                                    </option>

                                </select>

                            </div>

                            <!-- NOTES -->
                            <div class="form-group">

                                <label>
                                    Admin Notes
                                </label>

                                <textarea
                                    name="admin_notes"
                                    class="form-control"
                                    rows="6"
                                ><?= htmlspecialchars(
                                    $inquiry['admin_notes']
                                    ?? ''
                                ) ?></textarea>

                            </div>

                        </div>

                        <div class="card-footer">

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >

                                Update Inquiry

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>