<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Login' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

```
<!-- CSS -->
<link rel="stylesheet" href="/assets/auth/css/bootstrap.min.css">
<link rel="stylesheet" href="/assets/auth/fonts/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="/assets/auth/fonts/flaticon/font/flaticon.css">

<!-- Favicon -->
<link rel="shortcut icon" href="/assets/auth/img/favicon.ico">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<!-- Main CSS -->
<link rel="stylesheet" href="/assets/auth/css/style.css">
```

</head>

<body>

<?php include __DIR__ . '/../' . $content; ?>

<!-- JS -->

<script src="/assets/auth/js/jquery-3.6.0.min.js"></script>

<script src="/assets/auth/js/bootstrap.bundle.min.js"></script>

<script src="/assets/auth/js/jquery.validate.min.js"></script>

<script src="/assets/auth/js/app.js"></script>

</body>
</html>
