<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Add User
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
                    action="<?= url('dashboard/users/store') ?>"
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

                            <option value="">
                                Select Role
                            </option>

                            <?php foreach ($roles as $role): ?>

                                <option
                                    value="<?= $role['id'] ?>"
                                >

                                    <?= htmlspecialchars(
                                        $role['name']
                                    ) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <!-- PASSWORD -->
                    <div class="form-group">

                        <label>

                            Password
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            required
                        >

                    </div>

                    <!-- CONFIRM PASSWORD -->
                    <div class="form-group">

                        <label>

                            Confirm Password
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                            required
                        >

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

                        Save User

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