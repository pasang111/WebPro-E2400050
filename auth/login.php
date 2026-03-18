<?php
// auth/login.php
// EduSkill Login Page
// Responsible: Pasang Lama (Team Lead)
// Day 3 - Login page with 3 role selection

session_start();

if (isset($_SESSION['user_role'])) {
    if ($_SESSION['user_role'] == 'admin') {
        header('Location: ../admin/dashboard.php'); exit();
    } elseif ($_SESSION['user_role'] == 'student') {
        header('Location: ../student/dashboard.php'); exit();
    } elseif ($_SESSION['user_role'] == 'provider') {
        header('Location: ../provider/dashboard.php'); exit();
    }
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role     = $_POST['role'] ?? '';

    if ($role == 'admin' && $email == 'admin@eduskill.com' && $password == 'admin123') {
        $_SESSION['user_role'] = 'admin';
        $_SESSION['user_name'] = 'Admin Officer';
        header('Location: ../admin/dashboard.php'); exit();
    } elseif ($role == 'student' && $email == 'student@eduskill.com' && $password == 'student123') {
        $_SESSION['user_role'] = 'student';
        $_SESSION['user_name'] = 'Test Student';
        header('Location: ../student/dashboard.php'); exit();
    } elseif ($role == 'provider' && $email == 'provider@eduskill.com' && $password == 'provider123') {
        $_SESSION['user_role'] = 'provider';
        $_SESSION['user_name'] = 'Test Provider';
        header('Location: ../provider/dashboard.php'); exit();
    } else {
        $error = 'Invalid email, password, or role. Please try again.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EduSkill</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/pasang.css">
</head>
<body class="auth-body">

<div class="auth-wrap">

    <!-- LEFT PANEL -->
    <div class="auth-left">
        <a href="../index.php" class="auth-logo">
            <img src="../images/logo.png" alt="EduSkill Logo" style="width:32px; height:32px; border-radius:8px; object-fit:cover;">    
            <span class="auth-logo-text">EDU<span class="auth-logo-accent">SKILL</span></span>
        </a>
        <div class="auth-left-body">
            <h2>Welcome Back</h2>
            <p>Login to access your dashboard and continue your learning journey with EduSkill.</p>
            <ul class="auth-perks">
                <li><i class="fas fa-check-circle"></i> Access all your enrolled courses</li>
                <li><i class="fas fa-check-circle"></i> Track your learning progress</li>
                <li><i class="fas fa-check-circle"></i> Connect with training providers</li>
            </ul>
        </div>
        <div class="auth-left-footer">
            <p>Don't have an account? <a href="signup_student.php">Sign Up Free</a></p>
        </div>
    </div>

    <!-- RIGHT PANEL -->
    <div class="auth-right">
        <div class="auth-form-wrap">
            <h3 class="auth-form-title">Log In to EduSkill</h3>
            <p class="auth-form-sub">Select your role and enter your credentials</p>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" action="">

                <!-- Role selector -->
                <div class="role-selector">
                    <label class="role-option">
                        <input type="radio" name="role" value="student" checked>
                        <span class="role-btn">
                            <i class="fas fa-user-graduate"></i> Student
                        </span>
                    </label>
                    <label class="role-option">
                        <input type="radio" name="role" value="provider">
                        <span class="role-btn">
                            <i class="fas fa-building"></i> Provider
                        </span>
                    </label>
                    <label class="role-option">
                        <input type="radio" name="role" value="admin">
                        <span class="role-btn">
                            <i class="fas fa-user-shield"></i> Admin
                        </span>
                    </label>
                </div>

                <div class="form-group">
                    <label class="fl">Email Address</label>
                    <div class="fi-wrap">
                        <i class="fas fa-envelope fi-ico"></i>
                        <input type="email" name="email" class="form-control fi" placeholder="Enter your email" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="fl">Password</label>
                    <div class="fi-wrap">
                        <i class="fas fa-lock fi-ico"></i>
                        <input type="password" name="password" id="passwordField" class="form-control fi" placeholder="Enter your password" required>
                        <span class="fi-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </span>
                    </div>
                </div>

                <button type="submit" class="btn-auth-submit">
                    Log In <i class="fas fa-arrow-right ml-2"></i>
                </button>

            </form>

            <div class="auth-divider"><span>Don't have an account?</span></div>

            <div class="row">
                <div class="col-6">
                    <a href="signup_student.php" class="btn btn-outline-primary btn-block" style="border-radius:8px; font-weight:600; font-size:14px;">Student Signup</a>
                </div>
                <div class="col-6">
                    <a href="signup_provider.php" class="btn btn-outline-secondary btn-block" style="border-radius:8px; font-weight:600; font-size:14px;">Provider Signup</a>
                </div>
            </div>

            <div class="test-creds mt-4">
                <small><strong>Test Credentials:</strong><br>
                Admin: admin@eduskill.com / admin123<br>
                Student: student@eduskill.com / student123<br>
                Provider: provider@eduskill.com / provider123</small>
            </div>

            <div class="text-center mt-3">
                <a href="../index.php" class="auth-back"><i class="fas fa-arrow-left mr-1"></i> Back to Home</a>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
function togglePassword() {
    var field = document.getElementById('passwordField');
    var icon  = document.getElementById('eyeIcon');
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script>
</body>
</html>