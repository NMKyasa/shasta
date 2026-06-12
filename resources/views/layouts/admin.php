<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>
        SHASTA Admin
    </title>

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">

    <!-- Font Awesome -->
     <!-- DataTables -->
    <link
        rel="stylesheet"
        href="<?= asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>"
    >

    <link
        rel="stylesheet"
        href="<?= asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>"
    >

    <link
        rel="stylesheet"
        href="<?= asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>"
    >
    <link rel="stylesheet"
          href="<?= asset('assets/admin/plugins/fontawesome-free/css/all.min.css') ?>">

    <!-- AdminLTE -->
    <link rel="stylesheet"
          href="<?= asset('assets/admin/dist/css/adminlte.min.css') ?>">

    <!-- Custom CSS -->
    <link rel="stylesheet"
          href="<?= asset('assets/admin/dist/css/style.css') ?>">

</head>

<body class="hold-transition sidebar-mini">

<div class="wrapper">

    <!-- Navbar -->
    <?php require resource_path(
        'views/partials/admin/navbar.php'
    ); ?>

    <!-- Sidebar -->
    <?php require resource_path(
        'views/partials/admin/sidebar.php'
    ); ?>

    <!-- Content Wrapper -->
    <div class="content-wrapper">

        <?php
        require_once
            resource_path(
                'views/components/flash.php'
            );
        ?>
        <?= $content ?>

    </div>

    <!-- Footer -->
    <?php require resource_path(
        'views/partials/admin/footer.php'
    ); ?>

</div>

<!-- jQuery -->
<script src="<?= asset('assets/admin/plugins/jquery/jquery.min.js') ?>"></script>

<!-- Bootstrap -->
<script src="<?= asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- DataTables -->
<script src="<?= asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') ?>"></script>

<script src="<?= asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>

<script src="<?= asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>

<script src="<?= asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>

<script src="<?= asset('assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>

<script src="<?= asset('assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>

<script>

$(document).ready(function () {

    $('.datatable').DataTable({

        responsive: true,

        autoWidth: false,

        pageLength: 10,

        ordering: true,

        searching: true,

        lengthChange: true
    });

});

</script>

<!-- AdminLTE -->
<script src="<?= asset('assets/admin/dist/js/adminlte.min.js') ?>"></script>

<!-- Custom JS -->
<script src="<?= asset('assets/admin/dist/js/script.js') ?>"></script>

</body>

</html>