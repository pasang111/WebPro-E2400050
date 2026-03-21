<?php

session_start();
require_once '../config/database.php';

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
        // Check if email already exists
        $check = mysqli_prepare($conn, "SELECT id FROM students WHERE email = ?");
        mysqli_stmt_bind_param($check, 's', $email);
        mysqli_stmt_execute($check);
        mysqli_stmt_store_result($check);

        if (mysqli_stmt_num_rows($check) > 0) {
            $error = 'This email is already registered. Please login instead.';
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert into database
            $stmt = mysqli_prepare($conn, "INSERT INTO students (name, email, phone, password) VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, 'ssss', $name, $email, $phone, $hashed_password);

            if (mysqli_stmt_execute($stmt)) {
                $success = 'Account created successfully! You can now login.';
            } else {
                $error = 'Something went wrong. Please try again.';
            }
        }
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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/shreeyash.css">
</head>
<body class="auth-body">
<div class="auth-wrap">

    <!-- LEFT -->
    <div class="auth-left">
        <a href="../index.php" class="auth-logo">
            <img src="../images/logo.png" alt="Logo" style="width:32px;height:32px;border-radius:8px;object-fit:cover;">
            <span class="auth-logo-text">EDU<span class="auth-logo-accent">SKILL</span></span>
        </a>
        <div class="auth-left-body">
            <h2>Start Learning Today</h2>
            <p>Create your free student account and get access to hundreds of certified courses from approved training providers.</p>
            <ul class="auth-perks">
                <li><i class="fas fa-check-circle"></i> Free to sign up</li>
                <li><i class="fas fa-check-circle"></i> Browse hundreds of courses</li>
                <li><i class="fas fa-check-circle"></i> Ministry certified programmes</li>
                <li><i class="fas fa-check-circle"></i> Track your learning progress</li>
            </ul>
        </div>
        <div class="auth-left-footer">
            <p>Already have an account? <a href="login.php">Log In</a></p>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="auth-right">
        <div class="auth-form-wrap">
            <h3 class="auth-form-title">Create Student Account</h3>
            <p class="auth-form-sub">Fill in your details to get started for free</p>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?>
                    <div class="mt-2"><a href="login.php" class="btn-auth-submit" style="display:inline-flex; width:auto; padding:8px 20px;">Go to Login</a></div>
                </div>
            <?php endif; ?>

            <?php if (!$success): ?>
            <form method="POST" action="" id="studentSignupForm">
                <div class="form-group">
                    <label class="fl">Full Name <span class="text-danger">*</span></label>
                    <div class="fi-wrap">
                        <i class="fas fa-user fi-ico"></i>
                        <input type="text" name="name" class="form-control fi" placeholder="Enter your full name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="fl">Email Address <span class="text-danger">*</span></label>
                    <div class="fi-wrap">
                        <i class="fas fa-envelope fi-ico"></i>
                        <input type="email" name="email" class="form-control fi" placeholder="Enter your email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="fl">Phone Number</label>
                    <div class="fi-wrap">
                        <i class="fas fa-phone-alt fi-ico"></i>
                        <input type="text" name="phone" class="form-control fi" placeholder="e.g. 011-12345678" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="fl">Password <span class="text-danger">*</span></label>
                    <div class="fi-wrap">
                        <i class="fas fa-lock fi-ico"></i>
                        <input type="password" name="password" id="passwordField" class="form-control fi" placeholder="Minimum 6 characters" required>
                        <span class="fi-toggle" onclick="togglePassword()"><i class="fas fa-eye" id="eyeIcon"></i></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="fl">Confirm Password <span class="text-danger">*</span></label>
                    <div class="fi-wrap">
                        <i class="fas fa-lock fi-ico"></i>
                        <input type="password" name="confirm_password" class="form-control fi" placeholder="Re-enter your password" required>
                    </div>
                </div>
                <button type="submit" class="btn-auth-submit">
                    Create Account <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </form>
            <?php endif; ?>

            <div class="text-center mt-3">
                <a href="../index.php" class="auth-back"><i class="fas fa-arrow-left mr-1"></i> Back to Home</a>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../js/shreeyash.js"></script>
</body>
</html>
