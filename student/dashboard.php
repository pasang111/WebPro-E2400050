<?php

// Start session to access stored user data
session_start();

// Redirect to login if user is not logged in or is not a student
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'student') {
    header('Location: ../auth/login.php'); exit();
}

// Get student name from session; default to 'Student' if not set
$student_name = $_SESSION['user_name'] ?? 'Student';

// Placeholder summary stats (replace with DB queries later)
$enrolled_courses  = 2;
$pending_approvals = 1;
$completed_courses = 1;
$available_courses = 6;

// Placeholder recent enrollment data (replace with DB query later)
$recent_enrollments = [
    ['course'=>'Full Stack Web Development','provider'=>'Tech Academy MY',   'duration'=>'8 Weeks','status'=>'approved', 'date'=>'2026-03-12'],
    ['course'=>'Data Science & Analytics',  'provider'=>'DataSkill Institute','duration'=>'6 Weeks','status'=>'pending',  'date'=>'2026-03-13'],
    ['course'=>'UI/UX Design Fundamentals', 'provider'=>'Creative Hub KL',   'duration'=>'4 Weeks','status'=>'completed','date'=>'2026-03-01'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - EduSkill</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/pasang.css">
    <link rel="stylesheet" href="../css/shreeyash.css">
</head>
<body class="dashboard-body">
<div class="dashboard-wrap">

    <!-- Sidebar Navigation -->
    <aside class="dash-sidebar student-sidebar">
        <div class="dsb-brand">
            <a href="../index.php">
                <img src="../images/logo.png" alt="Logo" style="width:32px;height:32px;border-radius:8px;object-fit:cover;">
                <span class="dsb-brand-text">EDU<span class="dsb-brand-accent">SKILL</span></span>
            </a>
        </div>
        <div class="dsb-role-badge student-role-badge"><i class="fas fa-user-graduate mr-2"></i> Student</div>
        <nav class="dsb-nav">
            <a href="dashboard.php" class="dsb-link active"><i class="fas fa-th-large"></i> Dashboard</a>
            <a href="courses.php" class="dsb-link"><i class="fas fa-book-open"></i> Browse Courses</a>
            <a href="my_courses.php" class="dsb-link"><i class="fas fa-graduation-cap"></i> My Enrollments
                <?php // Show pending count badge on sidebar link if there are pending approvals ?>
                <?php if($pending_approvals > 0): ?>
                    <span class="dsb-badge"><?php echo $pending_approvals; ?></span>
                <?php endif; ?>
            </a>
        </nav>
        <div class="dsb-bottom">
            <!-- Display first letter of student's name as avatar -->
            <div class="dsb-user-info">
                <div class="dsb-avatar"><?php echo strtoupper(substr($student_name,0,1)); ?></div>
                <div><strong><?php echo htmlspecialchars($student_name); ?></strong><span>Student</span></div>
            </div>
            <a href="../auth/logout.php" class="dsb-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="dash-main">
        <div class="dash-topbar">
            <div>
                <h4 class="dash-page-title">My Dashboard</h4>
                <p class="dash-page-sub">Welcome back, <?php echo htmlspecialchars($student_name); ?>!</p>
            </div>
            <div class="dash-topbar-right">
                <a href="courses.php" class="btn-dash-primary"><i class="fas fa-search mr-1"></i> Browse Courses</a>
            </div>
        </div>

        <!-- Summary stat cards -->
        <div class="row mb-4">
            <div class="col-6 col-lg-3 mb-3">
                <div class="dstat-card">
                    <div class="dstat-icon" style="background:#dbeafe;color:#1d4ed8;"><i class="fas fa-book-open"></i></div>
                    <div class="dstat-info"><h3><?php echo $enrolled_courses; ?></h3><p>Enrolled Courses</p></div>
                </div>
            </div>
            <div class="col-6 col-lg-3 mb-3">
                <div class="dstat-card">
                    <div class="dstat-icon" style="background:#ffedd5;color:#c2410c;"><i class="fas fa-clock"></i></div>
                    <div class="dstat-info"><h3><?php echo $pending_approvals; ?></h3><p>Pending Approval</p></div>
                </div>
            </div>
            <div class="col-6 col-lg-3 mb-3">
                <div class="dstat-card">
                    <div class="dstat-icon" style="background:#dcfce7;color:#15803d;"><i class="fas fa-certificate"></i></div>
                    <div class="dstat-info"><h3><?php echo $completed_courses; ?></h3><p>Completed</p></div>
                </div>
            </div>
            <div class="col-6 col-lg-3 mb-3">
                <div class="dstat-card">
                    <div class="dstat-icon" style="background:#fce7f3;color:#be185d;"><i class="fas fa-search"></i></div>
                    <div class="dstat-info"><h3><?php echo $available_courses; ?></h3><p>Available Courses</p></div>
                </div>
            </div>
        </div>

        <!-- Alert banner if student has pending enrollments awaiting approval -->
        <?php if ($pending_approvals > 0): ?>
        <div class="alert-notice mb-4">
            <i class="fas fa-info-circle mr-2"></i>
            You have <strong><?php echo $pending_approvals; ?> enrollment(s)</strong> waiting for Ministry approval.
            <a href="my_courses.php" class="ml-2" style="font-weight:600; color:#0056d2;">Check Status</a>
        </div>
        <?php endif; ?>

        <!-- Recent enrollments table -->
        <div class="dash-card mb-4">
            <div class="dash-card-head">
                <h5>My Enrollments</h5>
                <a href="my_courses.php" class="dash-card-link">View All</a>
            </div>
            <div class="dash-table-wrap">
                <table class="table dash-table">
                    <thead>
                        <tr>
                            <th>Course</th>
                            <th>Provider</th>
                            <th>Duration</th>
                            <th>Enrolled On</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_enrollments as $e): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($e['course']); ?></strong></td>
                            <td><?php echo htmlspecialchars($e['provider']); ?></td>
                            <td><?php echo $e['duration']; ?></td>
                            <td><?php echo $e['date']; ?></td>
                            <td>
                                <?php // Display colored status badge per enrollment status ?>
                                <?php if ($e['status']=='pending'): ?>
                                    <span class="status-pending"><i class="fas fa-clock mr-1"></i>Pending</span>
                                <?php elseif ($e['status']=='approved'): ?>
                                    <span class="status-approved"><i class="fas fa-check-circle mr-1"></i>Approved</span>
                                <?php else: ?>
                                    <span class="status-completed"><i class="fas fa-certificate mr-1"></i>Completed</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Prompt card encouraging students to browse more courses -->
        <div class="dash-card p-4 text-center">
            <i class="fas fa-search" style="font-size:36px; color:#d1d5db; display:block; margin-bottom:14px;"></i>
            <h5>Discover New Courses</h5>
            <p class="text-muted">Browse hundreds of certified courses from approved training providers.</p>
            <a href="courses.php" class="btn-dash-primary mt-2">Browse Courses</a>
        </div>
    </main>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>