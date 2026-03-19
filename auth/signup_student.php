<?php


session_start();

$success = '';
$error   = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = trim($_POST['name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $phone    = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';

    if (empty($name) || empty($email) || empty($password)) {
        $error = 'Please fill in all required fields.';
    } elseif ($password !== $confirm) {
        $error = 'Passwords do not match.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters.';
    } else {
        // Placeholder - database connection will be added later
        $success = 'Account created successfully! You can now login.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Signup - EduSkill</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/pasang.css">
    <link rel="stylesheet" href="../css/shreeyash.css">
</head>
<body class="auth-page">

<div class="auth-wrapper">

    <!-- LEFT PANEL -->
    <div class="auth-left">
        <a href="../index.php" class="auth-brand">
            <img src="../images/logo.png" alt="EduSkill Logo" style="width:36px; height:36px; border-radius:8px; object-fit:cover;">
            <span class="auth-brand-text">EDU<span class="auth-brand-accent">SKILL</span></span>
        </a>
        <div class="auth-left-content">
            <h2>Start Learning Today</h2>
            <p>Create your free student account and get access to hundreds of courses from certified providers across Malaysia.</p>
            <ul class="auth-features">
                <li><i class="fas fa-check-circle"></i> Free to sign up</li>
                <li><i class="fas fa-check-circle"></i> Browse hundreds of courses</li>
                <li><i class="fas fa-check-circle"></i> Get certified by top providers</li>
            </ul>
        </div>
    </div>

    <!-- RIGHT PANEL - FORM -->
    <div class="auth-right">
        <div class="auth-form-box">

            <h3 class="auth-title">Create Student Account</h3>
            <p class="auth-subtitle">Fill in your details to get started for free</p>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>

            <form method="POST" action="" id="studentSignupForm">

                <div class="form-group">
                    <label class="auth-label">Full Name <span class="text-danger">*</span></label>
                    <div class="auth-input-wrap">
                        <i class="fas fa-user auth-input-icon"></i>
                        <input type="text" name="name" class="form-control auth-input" placeholder="Enter your full name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="auth-label">Email Address <span class="text-danger">*</span></label>
                    <div class="auth-input-wrap">
                        <i class="fas fa-envelope auth-input-icon"></i>
                        <input type="email" name="email" class="form-control auth-input" placeholder="Enter your email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="auth-label">Phone Number</label>
                    <div class="auth-input-wrap">
                        <i class="fas fa-phone-alt auth-input-icon"></i>
                        <input type="text" name="phone" class="form-control auth-input" placeholder="e.g. 011-12345678" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="auth-label">Password <span class="text-danger">*</span></label>
                    <div class="auth-input-wrap">
                        <i class="fas fa-lock auth-input-icon"></i>
                        <input type="password" name="password" id="passwordField" class="form-control auth-input" placeholder="Minimum 6 characters" required>
                        <span class="password-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="auth-label">Confirm Password <span class="text-danger">*</span></label>
                    <div class="auth-input-wrap">
                        <i class="fas fa-lock auth-input-icon"></i>
                        <input type="password" name="confirm_password" class="form-control auth-input" placeholder="Re-enter your password" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block auth-btn">
                    Create Account <i class="fas fa-arrow-right ml-2"></i>
                </button>

            </form>

            <div class="auth-divider"><span>Already have an account?</span></div>
            <a href="login.php" class="btn btn-outline-primary btn-block">Log In</a>

            <div class="text-center mt-3">
                <a href="../index.php" class="auth-back-link">
                    <i class="fas fa-arrow-left mr-1"></i> Back to Home
                </a>
            </div>

        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../js/pasang.js"></script>
<script src="../js/shreeyash.js"></script>
</body>
</html>
