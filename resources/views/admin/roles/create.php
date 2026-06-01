<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Add Role
                </h1>

            </div>

            <div class="col-sm-6 text-right">

                <a
                    href="<?= url('dashboard/roles') ?>"
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
                    action="<?= url('dashboard/roles/store') ?>"
                >

                    <!-- CSRF TOKEN -->
                    <input
                        type="hidden"
                        name="_token"
                        value="<?= csrf_token() ?>"
                    >

                    <!-- ROLE NAME -->
                    <div class="form-group">

                        <label>

                            Role Name
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            required
                        >

                    </div>

                    <!-- PARENT ROLE -->
                    <div class="form-group">

                        <label>
                            Parent Role
                        </label>

                        <select
                            name="parent_role_id"
                            class="form-control"
                        >

                            <option value="">
                                No Parent
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

                    <!-- SYSTEM ROLE -->
                    <div class="form-group">

                        <label>
                            System Role
                        </label>

                        <select
                            name="is_system"
                            class="form-control"
                        >

                            <option value="0">
                                No
                            </option>

                            <option value="1">
                                Yes
                            </option>

                        </select>

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

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        Save Role

                    </button>

                    <a
                        href="<?= url('dashboard/roles') ?>"
                        class="btn btn-secondary"
                    >

                        Cancel

                    </a>

                </form>

            </div>

        </div>

    </div>

</section>