<?php
session_start();
require_once '../config/database.php';

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
        // Check if email already exists
        $check = mysqli_prepare($conn, "SELECT id FROM providers WHERE email = ?");
        mysqli_stmt_bind_param($check, 's', $email);
        mysqli_stmt_execute($check);
        mysqli_stmt_store_result($check);

        if (mysqli_stmt_num_rows($check) > 0) {
            $error = 'This email is already registered.';
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert into database with pending status
            $stmt = mysqli_prepare($conn, "INSERT INTO providers (org_name, email, phone, address, description, password, status) VALUES (?, ?, ?, ?, ?, ?, 'pending')");
            mysqli_stmt_bind_param($stmt, 'ssssss', $org_name, $email, $phone, $address, $description, $hashed_password);

            if (mysqli_stmt_execute($stmt)) {
                $success = 'Registration submitted successfully! Please wait for Ministry approval before you can login.';
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
    <title>Provider Registration - EduSkill</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/archana.css">
</head>
<body class="auth-body">
<div class="auth-wrap">

    <!-- LEFT -->
    <div class="auth-left auth-left-green">
        <a href="../index.php" class="auth-logo">
            <img src="../images/logo.png" alt="Logo" style="width:32px;height:32px;border-radius:8px;object-fit:cover;">
            <span class="auth-logo-text">EDU<span class="auth-logo-accent">SKILL</span></span>
        </a>
        <div class="auth-left-body">
            <h2>Become a Provider</h2>
            <p>Register your training organisation and reach thousands of learners across Malaysia.</p>
            <ul class="auth-perks">
                <li><i class="fas fa-check-circle"></i> Reach thousands of learners</li>
                <li><i class="fas fa-check-circle"></i> Manage your courses easily</li>
                <li><i class="fas fa-check-circle"></i> Ministry verified platform</li>
                <li><i class="fas fa-check-circle"></i> Grow your student base</li>
            </ul>
            <div class="provider-notice">
                <i class="fas fa-info-circle mr-2"></i>
                Your registration will be reviewed by a Ministry officer before activation.
            </div>
        </div>
        <div class="auth-left-footer">
            <p>Already registered? <a href="login.php">Log In</a></p>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="auth-right">
        <div class="auth-form-wrap">
            <h3 class="auth-form-title">Provider Registration</h3>
            <p class="auth-form-sub">Register your training organisation on EduSkill</p>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>

            <?php if (!$success): ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label class="fl">Organisation Name <span class="text-danger">*</span></label>
                    <div class="fi-wrap">
                        <i class="fas fa-building fi-ico"></i>
                        <input type="text" name="org_name" class="form-control fi" placeholder="e.g. Tech Academy Sdn Bhd" value="<?php echo htmlspecialchars($_POST['org_name'] ?? ''); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="fl">Email Address <span class="text-danger">*</span></label>
                    <div class="fi-wrap">
                        <i class="fas fa-envelope fi-ico"></i>
                        <input type="email" name="email" class="form-control fi" placeholder="Organisation email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="fl">Phone Number</label>
                            <div class="fi-wrap">
                                <i class="fas fa-phone-alt fi-ico"></i>
                                <input type="text" name="phone" class="form-control fi" placeholder="03-12345678" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="fl">City / State</label>
                            <div class="fi-wrap">
                                <i class="fas fa-map-marker-alt fi-ico"></i>
                                <input type="text" name="address" class="form-control fi" placeholder="e.g. Kuala Lumpur" value="<?php echo htmlspecialchars($_POST['address'] ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="fl">Organisation Description</label>
                    <textarea name="description" class="form-control fi" rows="3" style="height:auto;padding-top:12px;" placeholder="Brief description of your organisation"><?php echo htmlspecialchars($_POST['description'] ?? ''); ?></textarea>
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
                <button type="submit" class="btn-auth-submit btn-auth-green">
                    Submit Registration <i class="fas fa-arrow-right ml-2"></i>
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
<script src="../js/archana.js"></script>
</body>
</html>
