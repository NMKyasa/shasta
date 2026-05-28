<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Edit Menu Item
                </h1>

            </div>

            <div class="col-sm-6 text-right">

                <a
                    href="<?= url('dashboard/menu-items') ?>"
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
                    action="<?= url('dashboard/menu-items/update/' . $menuItem['id']) ?>"
                >

                    <!-- MENU -->
                    <div class="form-group">

                        <label>

                            Menu
                            <span class="text-danger">*</span>

                        </label>

                        <select
                            name="menu_id"
                            class="form-control"
                            required
                        >

                            <?php foreach ($menus as $menu): ?>

                                <option
                                    value="<?= $menu['id'] ?>"

                                    <?= $menuItem['menu_id'] == $menu['id']
                                        ? 'selected'
                                        : '' ?>

                                >

                                    <?= htmlspecialchars(
                                        $menu['name']
                                    ) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <!-- PARENT -->
                    <div class="form-group">

                        <label>
                            Parent Menu Item
                        </label>

                        <select
                            name="parent_id"
                            class="form-control"
                        >

                            <option value="">
                                None
                            </option>

                            <?php foreach ($parentItems as $item): ?>

                                <option
                                    value="<?= $item['id'] ?>"

                                    <?= $menuItem['parent_id'] == $item['id']
                                        ? 'selected'
                                        : '' ?>

                                >

                                    <?= htmlspecialchars(
                                        $item['label']
                                    ) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <!-- TITLE -->
                    <div class="form-group">

                        <label>

                            Title
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="label"
                            class="form-control"
                            value="<?= htmlspecialchars($menuItem['label']) ?>"
                            required
                        >

                    </div>

                    <!-- URL -->
                    <div class="form-group">

                        <label>
                            URL
                        </label>

                        <input
                            type="text"
                            name="url"
                            class="form-control"
                            value="<?= htmlspecialchars($menuItem['url']) ?>"
                        >

                    </div>

                    <!-- TARGET -->
                    <div class="form-group">

                        <label>
                            Link Target
                        </label>

                        <select
                            name="target"
                            class="form-control"
                        >

                            <option
                                value="_self"
                                <?= $menuItem['target'] === '_self'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Same Window
                            </option>

                            <option
                                value="_blank"
                                <?= $menuItem['target'] === '_blank'
                                    ? 'selected'
                                    : '' ?>
                            >
                                New Tab
                            </option>

                        </select>

                    </div>

                    <!-- ICON -->
                    <div class="form-group">

                        <label>
                            Icon Class
                        </label>

                        <input
                            type="text"
                            name="icon"
                            class="form-control"
                            value="<?= htmlspecialchars($menuItem['icon']) ?>"
                        >

                    </div>

                    <!-- SORT ORDER -->
                    <div class="form-group">

                        <label>
                            Sort Order
                        </label>

                        <input
                            type="number"
                            name="sort_order"
                            class="form-control"
                            value="<?= $menuItem['sort_order'] ?>"
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

                            <option
                                value="active"
                                <?= $menuItem['status'] === 'active'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Active
                            </option>

                            <option
                                value="inactive"
                                <?= $menuItem['status'] === 'inactive'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Inactive
                            </option>

                        </select>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        Update Menu Item

                    </button>

                    <a
                        href="<?= url('dashboard/menu-items') ?>"
                        class="btn btn-secondary"
                    >

                        Cancel

                    </a>

                </form>

            </div>

        </div>

    </div>

</section>