<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Edit Menu
                </h1>

            </div>

            <div class="col-sm-6 text-right">

                <a
                    href="<?= url('dashboard/menus') ?>"
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
                    action="<?= url('dashboard/menus/update/' . $menu['id']) ?>"
                >

                    <!-- MENU NAME -->
                    <div class="form-group">

                        <label>

                            Menu Name
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="<?= htmlspecialchars($menu['name']) ?>"
                            required
                        >

                    </div>

                    <!-- MENU KEY -->
                    <div class="form-group">

                        <label>

                            Menu Key
                            <span class="text-danger">*</span>

                        </label>

                        <select
                            name="menu_key"
                            class="form-control"
                            required
                        >

                            <option
                                value="header"
                                <?= $menu['menu_key'] === 'header'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Header Menu
                            </option>

                            <option
                                value="footer"
                                <?= $menu['menu_key'] === 'footer'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Footer Menu
                            </option>

                            <option
                                value="mobile"
                                <?= $menu['menu_key'] === 'mobile'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Mobile Menu
                            </option>

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
                        ><?= htmlspecialchars($menu['description']) ?></textarea>

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
                                <?= $menu['status'] === 'active'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Active
                            </option>

                            <option
                                value="inactive"
                                <?= $menu['status'] === 'inactive'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Inactive
                            </option>

                        </select>

                    </div>

                    <!-- SUBMIT -->
                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        Update Menu

                    </button>

                    <a
                        href="<?= url('dashboard/menus') ?>"
                        class="btn btn-secondary"
                    >

                        Cancel

                    </a>

                </form>

            </div>

        </div>

    </div>

</section>
