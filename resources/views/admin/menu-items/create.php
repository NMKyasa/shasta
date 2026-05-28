<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Add Menu Item
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
                    action="<?= url('dashboard/menu-items/store') ?>"
                >

                    <!-- MENU -->
                    <div class="form-group">

                        <label>

                            Menu
                            <span></span>

                        </label>

                        <select
                            name="menu_id"
                            class="form-control"
                        >

                            <option value="">
                                Select Menu
                            </option>

                            <?php foreach ($menus as $menu): ?>

                                <option
                                    value="<?= $menu['id'] ?>"
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
                            <span ></span>

                        </label>

                        <input
                            type="text"
                            name="label"
                            class="form-control"
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
                            placeholder="/about-us"
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

                            <option value="_self">
                                Same Window
                            </option>

                            <option value="_blank">
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
                            placeholder="fas fa-home"
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
                            value="0"
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

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        Save Menu Item

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