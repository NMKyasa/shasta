<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Edit User
                </h1>

            </div>

            <div class="col-sm-6 text-right">

                <a
                    href="<?= url('dashboard/users') ?>"
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
                    action="<?= url('dashboard/users/update/' . $user['id']) ?>"
                >

                    <!-- CSRF TOKEN -->
                    <input
                        type="hidden"
                        name="_token"
                        value="<?= csrf_token() ?>"
                    >

                    <!-- FIRST NAME -->
                    <div class="form-group">

                        <label>

                            First Name
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="first_name"
                            class="form-control"
                            value="<?= htmlspecialchars($user['first_name']) ?>"
                            required
                        >

                    </div>

                    <!-- LAST NAME -->
                    <div class="form-group">

                        <label>

                            Last Name
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="last_name"
                            class="form-control"
                            value="<?= htmlspecialchars($user['last_name']) ?>"
                            required
                        >

                    </div>

                    <!-- EMAIL -->
                    <div class="form-group">

                        <label>

                            Email Address
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="<?= htmlspecialchars($user['email']) ?>"
                            required
                        >

                    </div>

                    <!-- ROLE -->
                    <div class="form-group">

                        <label>

                            Role
                            <span class="text-danger">*</span>

                        </label>

                        <select
                            name="role_id"
                            class="form-control"
                            required
                        >

                            <?php foreach ($roles as $role): ?>

                                <option
                                    value="<?= $role['id'] ?>"
                                    <?= $user['role_id'] == $role['id']
                                        ? 'selected'
                                        : '' ?>
                                >

                                    <?= htmlspecialchars(
                                        $role['name']
                                    ) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                        <small class="text-muted">

                            User permissions are inherited from the selected role.

                        </small>

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
                                <?= $user['status'] === 'active'
                                    ? 'selected'
                                    : '' ?>
                            >

                                Active

                            </option>

                            <option
                                value="inactive"
                                <?= $user['status'] === 'inactive'
                                    ? 'selected'
                                    : '' ?>
                            >

                                Inactive

                            </option>

                        </select>

                    </div>

                    <hr>

                    <!-- USER INFORMATION -->
                    <div class="alert alert-info">

                        <strong>
                            Note:
                        </strong>

                        Password changes are managed separately.
                        Editing this user will update profile information,
                        role assignment and account status only.

                    </div>

                    <!-- SUBMIT -->
                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        Update User

                    </button>

                    <a
                        href="<?= url('dashboard/users') ?>"
                        class="btn btn-secondary"
                    >

                        Cancel

                    </a>

                </form>

            </div>

        </div>

    </div>

</section>