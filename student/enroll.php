<?php

session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'student') {
    header('Location: ../auth/login.php'); exit();
}

$student_id   = $_SESSION['user_id'];
$student_name = $_SESSION['user_name'] ?? 'Student';
$course_id    = intval($_GET['id'] ?? 0);
$success      = '';
$error        = '';

// Get course from database
$stmt = mysqli_prepare($conn, "SELECT c.*, p.org_name as provider_name FROM courses c JOIN providers p ON c.provider_id = p.id WHERE c.id = ? AND c.status = 'approved'");
mysqli_stmt_bind_param($stmt, 'i', $course_id);
mysqli_stmt_execute($stmt);
$course = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$course) {
    header('Location: courses.php'); exit();
}

// Check if already enrolled
$check = mysqli_prepare($conn, "SELECT id FROM enrollments WHERE student_id = ? AND course_id = ?");
mysqli_stmt_bind_param($check, 'ii', $student_id, $course_id);
mysqli_stmt_execute($check);
mysqli_stmt_store_result($check);
$already_enrolled = mysqli_stmt_num_rows($check) > 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !$already_enrolled) {
    $notes = trim($_POST['notes'] ?? '');
    $stmt2 = mysqli_prepare($conn, "INSERT INTO enrollments (student_id, course_id, notes, status) VALUES (?, ?, ?, 'pending')");
    mysqli_stmt_bind_param($stmt2, 'iis', $student_id, $course_id, $notes);
    if (mysqli_stmt_execute($stmt2)) {
        $success = 'Enrollment request submitted successfully! The Ministry officer will review your request. Check My Enrollments for status updates.';
    } else {
        $error = 'Something went wrong. Please try again.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll - EduSkill</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/pasang.css">
    <link rel="stylesheet" href="../css/shreeyash.css">
</head>
<body class="dashboard-body">
<div class="dashboard-wrap">

    <aside class="dash-sidebar student-sidebar">
        <div class="dsb-brand">
            <a href="../index.php">
                <img src="../images/logo.png" alt="Logo" style="width:32px;height:32px;border-radius:8px;object-fit:cover;">
                <span class="dsb-brand-text">EDU<span class="dsb-brand-accent">SKILL</span></span>
            </a>
        </div>
        <div class="dsb-role-badge student-role-badge"><i class="fas fa-user-graduate mr-2"></i> Student</div>
        <nav class="dsb-nav">
            <a href="dashboard.php" class="dsb-link"><i class="fas fa-th-large"></i> Dashboard</a>
            <a href="courses.php" class="dsb-link active"><i class="fas fa-book-open"></i> Browse Courses</a>
            <a href="my_courses.php" class="dsb-link"><i class="fas fa-graduation-cap"></i> My Enrollments</a>
        </nav>
        <div class="dsb-bottom">
            <div class="dsb-user-info">
                <div class="dsb-avatar"><?php echo strtoupper(substr($student_name,0,1)); ?></div>
                <div><strong><?php echo htmlspecialchars($student_name); ?></strong><span>Student</span></div>
            </div>
            <a href="../auth/logout.php" class="dsb-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </aside>

    <main class="dash-main">
        <div class="dash-topbar">
            <div>
                <h4 class="dash-page-title">Enroll in Course</h4>
                <p class="dash-page-sub">Submit your enrollment request for admin approval</p>
            </div>
        </div>

        <?php if($already_enrolled && !$success): ?>
        <div class="alert alert-warning">You have already enrolled in this course. <a href="my_courses.php">Check your enrollment status</a>.</div>
        <?php endif; ?>

        <?php if($success): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle mr-2"></i><?php echo $success; ?>
            <div class="mt-2"><a href="my_courses.php" class="btn-dash-primary" style="font-size:13px;padding:7px 14px;">View My Enrollments</a></div>
        </div>
        <?php endif; ?>

        <?php if($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="row">
            <div class="col-lg-5 mb-4">
                <div class="dash-card p-3">
                    <span class="course-cat"><?php echo htmlspecialchars($course['category']); ?></span>
                    <h5 class="mt-2 mb-2"><?php echo htmlspecialchars($course['title']); ?></h5>
                    <p class="text-muted" style="font-size:14px;"><?php echo htmlspecialchars($course['description']); ?></p>
                    <div style="font-size:13px; color:#6b7280; margin-top:12px;">
                        <div class="mb-1"><i class="fas fa-building mr-2" style="color:#0056d2;"></i><?php echo htmlspecialchars($course['provider_name']); ?></div>
                        <div class="mb-1"><i class="fas fa-clock mr-2" style="color:#0056d2;"></i><?php echo htmlspecialchars($course['duration']); ?></div>
                        <div><i class="fas fa-certificate mr-2" style="color:#0056d2;"></i>Ministry Certified</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="dash-card p-4">
                    <h5 class="mb-1">Confirm Enrollment</h5>
                    <p class="text-muted mb-4" style="font-size:14px;">Your request will be reviewed by a Ministry officer.</p>

                    <?php if(!$already_enrolled && !$success): ?>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label class="cf-label">Your Name</label>
                            <input type="text" class="form-control cf-input" value="<?php echo htmlspecialchars($student_name); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label class="cf-label">Course</label>
                            <input type="text" class="form-control cf-input" value="<?php echo htmlspecialchars($course['title']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label class="cf-label">Additional Notes (Optional)</label>
                            <textarea name="notes" class="form-control cf-input" rows="3" placeholder="Any additional information..."></textarea>
                        </div>
                        <div class="enroll-notice mb-3">
                            <i class="fas fa-info-circle mr-2"></i>
                            By submitting you are requesting enrollment. A Ministry officer will review within 1-2 business days.
                        </div>
                        <button type="submit" class="btn-main">
                            <i class="fas fa-paper-plane mr-2"></i> Submit Enrollment Request
                        </button>
                        <a href="courses.php" class="btn btn-outline-secondary ml-2" style="border-radius:8px;">Cancel</a>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
