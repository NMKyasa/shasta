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

                        <a href="#">
                            Home
                        </a>

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

        <!-- SMALL BOXES -->
        <div class="row">

            <!-- SERVICES -->
            <div class="col-lg-3 col-6">

                <div class="small-box bg-info">

                    <div class="inner">

                        <h3>
                            <?= $statistics['services'] ?>
                        </h3>

                        <p>
                            Services
                        </p>

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

            <!-- PROJECTS -->
            <div class="col-lg-3 col-6">

                <div class="small-box bg-success">

                    <div class="inner">

                        <h3>
                            <?= $statistics['projects'] ?>
                        </h3>

                        <p>
                            Projects
                        </p>

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

            <!-- TEAM MEMBERS -->
            <div class="col-lg-3 col-6">

                <div class="small-box bg-warning">

                    <div class="inner">

                        <h3>
                            <?= $statistics['team_members'] ?>
                        </h3>

                        <p>
                            Team Members
                        </p>

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

            <!-- TESTIMONIALS -->
            <div class="col-lg-3 col-6">

                <div class="small-box bg-danger">

                    <div class="inner">

                        <h3>
                            <?= $statistics['testimonials'] ?>
                        </h3>

                        <p>
                            Testimonials
                        </p>

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

        </div>

        <!-- SECOND ROW -->
        <div class="row">

            <!-- PRICING -->
            <div class="col-lg-3 col-6">

                <div class="small-box bg-primary">

                    <div class="inner">

                        <h3>
                            <?= $statistics['pricing_items'] ?>
                        </h3>

                        <p>
                            Pricing Plans
                        </p>

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

            <!-- CATEGORIES -->
            <div class="col-lg-3 col-6">

                <div class="small-box bg-secondary">

                    <div class="inner">

                        <h3>
                            <?= $statistics['categories'] ?>
                        </h3>

                        <p>
                            Categories
                        </p>

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

            <!-- ACTIVE CONTENT -->
            <div class="col-lg-3 col-6">

                <div class="small-box bg-teal">

                    <div class="inner">

                        <h3>
                            <?= $statistics['active_content'] ?>
                        </h3>

                        <p>
                            Active Content
                        </p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-check-circle"></i>

                    </div>

                    <a
                        href="#"
                        class="small-box-footer"
                    >

                        System Overview

                        <i class="fas fa-arrow-circle-right"></i>

                    </a>

                </div>

            </div>

            <!-- FEATURED CONTENT -->
            <div class="col-lg-3 col-6">

                <div class="small-box bg-dark">

                    <div class="inner">

                        <h3>
                            <?= $statistics['featured_content'] ?>
                        </h3>

                        <p>
                            Featured Content
                        </p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-star"></i>

                    </div>

                    <a
                        href="#"
                        class="small-box-footer"
                    >

                        System Overview

                        <i class="fas fa-arrow-circle-right"></i>

                    </a>

                </div>

            </div>

        </div>


    </div>

</section>

<!-- CONTROL SIDEBAR -->
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