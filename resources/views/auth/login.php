<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>SHASTA CO. LTD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="<?= asset('assets/auth/css/bootstrap.min.css') ?>">
    <link type="text/css" rel="stylesheet" href="<?= asset('assets/auth/fonts/font-awesome/css/font-awesome.min.css') ?>">
    <link type="text/css" rel="stylesheet" href="<?= asset('assets/auth/fonts/flaticon/font/flaticon.css') ?>">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="<?= asset('assets/auth/img/favicon.ico') ?>" type="image/x-icon" >

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="<?= asset('assets/auth/css/style.css') ?>"> 

</head>
<body id="top">
<div class="page_loader"></div>

<!-- Login 24 start -->
<div class="login-24">
    <div id="bg">
        <canvas></canvas>
        <canvas></canvas>
        <canvas></canvas>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-section">
                    <div class="logo clearfix">
                        <a href="login-24.html">
                            <img src="<?= asset('assets/auth/img/logos/logo.png') ?>" alt="logo">
                        </a>
                    </div>
                    <div class="btn-section clearfix">
                        <a href="#" class="link-btn active">Login</a>
                        <a href="<?= asset('assets/auth/register-24.html') ?>" class="link-btn">Register</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="login-inner-form">
                        <div class="details">
                            <form action="<?= url('login') ?>" method="POST">
                                <div class="form-group form-box">
                                    <label for="first_field" class="form-label">Email address</label>
                                    <input name="email" type="email" class="form-control" id="first_field" placeholder="Email Address" aria-label="Email Address">
                                </div>
                                <div class="form-group form-box">
                                    <label for="second_field" class="form-label">Password</label>
                                    <input name="password" type="password" class="form-control" autocomplete="off" id="second_field" placeholder="Password" aria-label="Password">
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 col-6">
                                        <button type="submit" class="btn-md btn-theme">Login</button>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <a href="forgot-password-24.html" class="forgot">Forgot Password</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login 24 end -->

<!-- External JS libraries -->
<script src="<?= asset('assets/auth/js/jquery-3.6.0.min.js') ?>"></script>
<script src="<?= asset('assets/auth/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= asset('assets/auth/js/jquery.validate.min.js') ?>"></script>
<script src="<?= asset('assets/auth/js/app.js') ?>"></script>
<!-- Custom JS Script -->
</body>
</html>
