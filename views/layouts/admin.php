<?php
// Expected variables:
// $title       → page title (browser tab)
// $pageTitle   → page header title
// $content     → path to view file (e.g. 'admin/dashboard/index.php')
?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title ?? 'Admin Panel' ?></title>

  <!-- Google Font -->

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Font Awesome -->

  <link rel="stylesheet" href="/assets/admin/plugins/fontawesome-free/css/all.min.css">

  <!-- AdminLTE -->

  <link rel="stylesheet" href="/assets/admin/dist/css/adminlte.min.css">

  <!-- Optional Custom CSS -->

  <link rel="stylesheet" href="/assets/shared/css/app.css">
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->

  <?php include __DIR__ . '/../components/admin_header.php'; ?>

  <!-- Sidebar -->

  <?php include __DIR__ . '/../components/admin_sidebar.php'; ?>

  <!-- Content Wrapper -->

  <div class="content-wrapper">

```
<!-- Page Header -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><?= $pageTitle ?? '' ?></h1>
      </div>
      <div class="col-sm-6">
        <!-- Optional breadcrumb -->
      </div>
    </div>
  </div>
</div>

<!-- Main Content -->
<section class="content">
  <div class="container-fluid">

    <!-- Flash Messages -->
    <?php if (!empty($flash)): ?>
      <div class="alert alert-<?= $flash['type'] ?>">
        <?= $flash['message'] ?>
      </div>
    <?php endif; ?>

    <!-- Dynamic Page Content -->
    <?php include __DIR__ . '/../' . $content; ?>

  </div>
</section>
```

  </div>

  <!-- Footer -->

  <?php include __DIR__ . '/../components/admin_footer.php'; ?>

</div>

<!-- Scripts -->

<script src="/assets/admin/plugins/jquery/jquery.min.js"></script>

<script src="/assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="/assets/admin/dist/js/adminlte.min.js"></script>

<!-- Optional Custom JS -->

<script src="/assets/shared/js/app.js"></script>

</body>
</html>
