<?php

session_start();

$success = '';
$error   = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $org_name    = trim($_POST['org_name'] ?? '');
    $email       = trim($_POST['email'] ?? '');
    $phone       = trim($_POST['phone'] ?? '');
    $address     = trim($_POST['address'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $password    = $_POST['password'] ?? '';
    $confirm     = $_POST['confirm_password'] ?? '';

    if (empty($org_name) || empty($email) || empty($password)) {
        $error = 'Please fill in all required fields.';
    } elseif ($password !== $confirm) {
        $error = 'Passwords do not match.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters.';
    } else {
        // Placeholder - database connection will be added later
        $success = 'Registration submitted! Please wait for admin approval before you can login.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provider Registration - EduSkill</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/pasang.css">
    <link rel="stylesheet" href="../css/archana.css">
</head>
<body class="auth-page">

<div class="auth-wrapper">

    <!-- LEFT PANEL -->
    <div class="auth-left" style="background-color: #2e7d32;">
        <a href="../index.php" class="auth-brand">
            <img src="../images/logo.png" alt="EduSkill Logo" style="width:36px; height:36px; border-radius:8px; object-fit:cover;">
            <span class="auth-brand-text">EDU<span class="auth-brand-accent">SKILL</span></span>
        </a>
        <div class="auth-left-content">
            <h2>Become a Provider</h2>
            <p>Register your training organisation and start listing your courses to thousands of learners across Malaysia.</p>
            <ul class="auth-features">
                <li><i class="fas fa-check-circle"></i> Reach thousands of learners</li>
                <li><i class="fas fa-check-circle"></i> Manage your courses easily</li>
                <li><i class="fas fa-check-circle"></i> Ministry verified platform</li>
            </ul>
            <div class="provider-notice mt-4">
                <i class="fas fa-info-circle mr-2"></i>
                Your registration will be reviewed by a Ministry officer before activation.
            </div>
        </div>
    </div>

    <!-- RIGHT PANEL - FORM -->
    <div class="auth-right">
        <div class="auth-form-box">

            <h3 class="auth-title">Provider Registration</h3>
            <p class="auth-subtitle">Register your training organisation on EduSkill</p>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>

            <form method="POST" action="">

                <div class="form-group">
                    <label class="auth-label">Organisation Name <span class="text-danger">*</span></label>
                    <div class="auth-input-wrap">
                        <i class="fas fa-building auth-input-icon"></i>
                        <input type="text" name="org_name" class="form-control auth-input" placeholder="e.g. Tech Academy Sdn Bhd" value="<?php echo htmlspecialchars($_POST['org_name'] ?? ''); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="auth-label">Email Address <span class="text-danger">*</span></label>
                    <div class="auth-input-wrap">
                        <i class="fas fa-envelope auth-input-icon"></i>
                        <input type="email" name="email" class="form-control auth-input" placeholder="Organisation email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="auth-label">Phone Number</label>
                            <div class="auth-input-wrap">
                                <i class="fas fa-phone-alt auth-input-icon"></i>
                                <input type="text" name="phone" class="form-control auth-input" placeholder="03-12345678" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="auth-label">City / State</label>
                            <div class="auth-input-wrap">
                                <i class="fas fa-map-marker-alt auth-input-icon"></i>
                                <input type="text" name="address" class="form-control auth-input" placeholder="e.g. Kuala Lumpur" value="<?php echo htmlspecialchars($_POST['address'] ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="auth-label">Organisation Description</label>
                    <textarea name="description" class="form-control auth-input" rows="3" style="height:auto; padding-top:12px;" placeholder="Brief description of your organisation and courses you offer"><?php echo htmlspecialchars($_POST['description'] ?? ''); ?></textarea>
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

                <button type="submit" class="btn btn-success btn-block auth-btn" style="background-color:#2e7d32; border-color:#2e7d32;">
                    Submit Registration <i class="fas fa-arrow-right ml-2"></i>
                </button>

            </form>

            <div class="auth-divider"><span>Already registered?</span></div>
            <a href="login.php" class="btn btn-outline-secondary btn-block">Log In</a>

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
<script src="../js/archana.js"></script>
</body>
</html>
