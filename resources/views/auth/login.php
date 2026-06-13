<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login - SHASTA CO. LTD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="<?= asset('assets/auth/img/favicon-32x32.png') ?>" type="image/x-icon">
    
    <!-- Style new CSS -->
    <link href="/shasta/public/assets/auth/css/style_new.css" rel="stylesheet">
    
</head>
<body>

<div class="lg">
    <div class="lg-card">

        <!-- Left side panel -->
        <div class="lg-side">
            <div class="lg-logo">
                <div class="lg-logo-box">
                    <?php if (!empty($settings['logo'])): ?>
                        <img src="<?= asset($settings['logo']) ?>" alt="Logo" style="width:100%;height:100%;object-fit:contain;border-radius:10px;">
                    <?php else: ?>
                        S
                    <?php endif; ?>
                </div>
                <div class="lg-logo-text">
                    <?= strtoupper(htmlspecialchars($settings['site_name'] ?? 'SHASTA')) ?> <span>ADMIN</span>
                </div>
            </div>

            <div class="lg-side-content">
                <h2>Secure Access to Your Dashboard</h2>
                <p>Manage services, projects, quotes and content for <?= htmlspecialchars($settings['site_name'] ?? 'Shasta Company Limited') ?> from one place.</p>
            </div>

            <div class="lg-side-foot">&copy; <?= date('Y') ?> <?= htmlspecialchars($settings['site_name'] ?? 'Shasta Company Limited') ?></div>
        </div>

        <!-- Right side form -->
        <div class="lg-form">
            <div class="lg-tag">Admin Panel</div>
            <h1>Welcome Back</h1>
            <p>Sign in to continue to your dashboard.</p>

            <?php if (!empty($_SESSION['error'])): ?>
                <div class="lg-alert">
                    <i class="fa fa-circle-exclamation"></i>
                    <?= htmlspecialchars($_SESSION['error']) ?>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <form action="<?= url('login') ?>" method="POST">

                <input type="hidden" name="_token" value="<?= csrf_token() ?>">

                <div class="lg-field">
                    <label for="email">Email Address</label>
                    <div class="lg-input-wrap">
                        <i class="fa fa-envelope"></i>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            placeholder="you@shasta.com"
                            required
                            autofocus
                        >
                    </div>
                </div>

                <div class="lg-field">
                    <label for="password">Password</label>
                    <div class="lg-input-wrap">
                        <i class="fa fa-lock"></i>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="••••••••"
                            required
                            autocomplete="off"
                        >
                        <button type="button" class="lg-toggle-pw" onclick="togglePassword()">
                            <i class="fa fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="lg-row">
                    <label class="lg-remember">
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                    <a class="lg-forgot" href="<?= url('forgot-password') ?>">Forgot Password?</a>
                </div>

                <button type="submit" class="lg-submit">
                    Sign In <i class="fa fa-arrow-right"></i>
                </button>

            </form>

            <a class="lg-back" href="<?= url('home') ?>">
                <i class="fa fa-arrow-left"></i> Back to Website
            </a>
        </div>

    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    const icon = document.getElementById('toggleIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>

</body>
</html>