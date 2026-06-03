<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Dashboard
                </h1>

            </div>

            <div class="col-sm-6">

                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>

                    <li class="breadcrumb-item active">
                        Dashboard
                    </li>

                </ol>

            </div>

        </div>

    </div>

</div>

<section class="content">

    <div class="container-fluid">

        <div class="row">
            
            <!-- Services -->
            <?php if (isset($statistics['services'])): ?>
            <div class="col-lg-3 col-6">

                <div class="small-box bg-info">

                    <div class="inner">

                        <h3><?= $statistics['services'] ?></h3>

                        <p>Services</p>

                    </div>

                    <div class="icon">
                        <i class="fas fa-concierge-bell"></i>
                    </div>

                    <a
                        href="<?= url('dashboard/services') ?>"
                        class="small-box-footer"
                    >
                        More info
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>

                </div>

            </div>
            <?php endif; ?>

            <!-- Projects -->
            <?php if (isset($statistics['projects'])): ?>
            <div class="col-lg-3 col-6">

                <div class="small-box bg-success">

                    <div class="inner">

                        <h3><?= $statistics['projects'] ?></h3>

                        <p>Projects</p>

                    </div>

                    <div class="icon">
                        <i class="fas fa-project-diagram"></i>
                    </div>

                    <a
                        href="<?= url('dashboard/projects') ?>"
                        class="small-box-footer"
                    >
                        More info
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>

                </div>

            </div>
            <?php endif; ?>

            <!-- Team Members -->
            <?php if (isset($statistics['team_members'])): ?>
            <div class="col-lg-3 col-6">

                <div class="small-box bg-warning">

                    <div class="inner">

                        <h3><?= $statistics['team_members'] ?></h3>

                        <p>Team Members</p>

                    </div>

                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>

                    <a
                        href="<?= url('dashboard/team') ?>"
                        class="small-box-footer"
                    >
                        More info
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>

                </div>

            </div>
            <?php endif; ?>

            <!-- Testimonials -->
            <?php if (isset($statistics['testimonials'])): ?>
            <div class="col-lg-3 col-6">

                <div class="small-box bg-danger">

                    <div class="inner">

                        <h3><?= $statistics['testimonials'] ?></h3>

                        <p>Testimonials</p>

                    </div>

                    <div class="icon">
                        <i class="fas fa-comments"></i>
                    </div>

                    <a
                        href="<?= url('dashboard/testimonials') ?>"
                        class="small-box-footer"
                    >
                        More info
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>

                </div>

            </div>
            <?php endif; ?>

            <!-- Pricing Plans -->
            <?php if (isset($statistics['pricing_items'])): ?>
            <div class="col-lg-3 col-6">

                <div class="small-box bg-primary">

                    <div class="inner">

                        <h3><?= $statistics['pricing_items'] ?></h3>

                        <p>Pricing Plans</p>

                    </div>

                    <div class="icon">
                        <i class="fas fa-tags"></i>
                    </div>

                    <a
                        href="<?= url('dashboard/pricing') ?>"
                        class="small-box-footer"
                    >
                        More info
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>

                </div>

            </div>
            <?php endif; ?>

            <!-- Categories -->
            <?php if (isset($statistics['categories'])): ?>
            <div class="col-lg-3 col-6">

                <div class="small-box bg-secondary">

                    <div class="inner">

                        <h3><?= $statistics['categories'] ?></h3>

                        <p>Categories</p>

                    </div>

                    <div class="icon">
                        <i class="fas fa-layer-group"></i>
                    </div>

                    <a
                        href="<?= url('dashboard/categories') ?>"
                        class="small-box-footer"
                    >
                        More info
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>

                </div>

            </div>
            <?php endif; ?>

            <!-- Inquiries -->
            <?php if (isset($statistics['inquiries'])): ?>
            <div class="col-lg-3 col-6">

                <div class="small-box bg-dark">

                    <div class="inner">

                        <h3><?= $statistics['inquiries'] ?></h3>

                        <p>Inquiries</p>

                    </div>

                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>

                    <a
                        href="<?= url('dashboard/inquiries') ?>"
                        class="small-box-footer"
                    >
                        More info
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>

                </div>

            </div>
            <?php endif; ?>

            <!-- Users -->
            <?php if (isset($statistics['users'])): ?>
            <div class="col-lg-3 col-6">

                <div class="small-box bg-indigo">

                    <div class="inner">

                        <h3><?= $statistics['users'] ?></h3>

                        <p>Users</p>

                    </div>

                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>

                    <a
                        href="<?= url('dashboard/users') ?>"
                        class="small-box-footer"
                    >
                        More info
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>

                </div>

            </div>
            <?php endif; ?>

        </div>

    </div>

</section>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-light">

    <div class="p-3">

        <h5>
            SHASTA CMS
        </h5>

        <p>
            Enterprise Admin Dashboard
        </p>

    </div>

</aside>