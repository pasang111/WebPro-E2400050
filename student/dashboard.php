<?php
session_start();

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'student') {
    header('Location: ../auth/login.php');
    exit();
}

$student_name = $_SESSION['user_name'] ?? 'Student';

// Placeholder data
$enrolled_courses  = 2;
$pending_approvals = 1;
$completed_courses = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - EduSkill</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/pasang.css">
    <link rel="stylesheet" href="../css/shreeyash.css">
</head>
<body class="dashboard-body">

<div class="dashboard-wrap">

    <!-- SIDEBAR -->
    <aside class="dash-sidebar student-sidebar">
        <div class="dsb-brand">
            <a href="../index.php">
                <img src="../images/logo.png" alt="EduSkill Logo" style="width:32px; height:32px; border-radius:8px; object-fit:cover;">
                <span class="dsb-brand-text">EDU<span class="dsb-brand-accent">SKILL</span></span>
            </a>
        </div>

        <div class="dsb-role-badge student-role-badge">
            <i class="fas fa-user-graduate mr-2"></i> Student
        </div>

        <nav class="dsb-nav">
            <a href="dashboard.php" class="dsb-link active">
                <i class="fas fa-th-large"></i> Dashboard
            </a>
            <a href="courses.php" class="dsb-link">
                <i class="fas fa-book-open"></i> Browse Courses
            </a>
            <a href="my_courses.php" class="dsb-link">
                <i class="fas fa-graduation-cap"></i> My Enrollments
                <?php if($pending_approvals > 0): ?>
                    <span class="dsb-badge"><?php echo $pending_approvals; ?></span>
                <?php endif; ?>
            </a>
        </nav>

        <div class="dsb-bottom">
            <div class="dsb-user-info">
                <div class="dsb-avatar">
                    <?php echo strtoupper(substr($student_name, 0, 1)); ?>
                </div>
                <div>
                    <strong><?php echo htmlspecialchars($student_name); ?></strong>
                    <span>Student</span>
                </div>
            </div>
            <a href="../auth/logout.php" class="dsb-logout">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="dash-main">

        <!-- Top bar -->
        <div class="dash-topbar">
            <div>
                <h4 class="dash-page-title">My Dashboard</h4>
                <p class="dash-page-sub">Welcome back, <?php echo htmlspecialchars($student_name); ?>!</p>
            </div>
            <div class="dash-topbar-right">
                <a href="courses.php" class="btn-dash-primary">
                    <i class="fas fa-search mr-1"></i> Browse Courses
                </a>
            </div>
        </div>

        <!-- Stats -->
        <div class="row mb-4">
            <div class="col-6 col-lg-4 mb-3">
                <div class="dstat-card">
                    <div class="dstat-icon" style="background:#dbeafe; color:#1d4ed8;">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div class="dstat-info">
                        <h3><?php echo $enrolled_courses; ?></h3>
                        <p>Enrolled Courses</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-4 mb-3">
                <div class="dstat-card">
                    <div class="dstat-icon" style="background:#ffedd5; color:#c2410c;">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="dstat-info">
                        <h3><?php echo $pending_approvals; ?></h3>
                        <p>Pending Approval</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-4 mb-3">
                <div class="dstat-card">
                    <div class="dstat-icon" style="background:#dcfce7; color:#15803d;">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <div class="dstat-info">
                        <h3><?php echo $completed_courses; ?></h3>
                        <p>Completed</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- My enrollments table -->
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
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Full Stack Web Development</td>
                            <td>Tech Academy MY</td>
                            <td>8 Weeks</td>
                            <td><span class="status-approved">Approved</span></td>
                        </tr>
                        <tr>
                            <td>Data Science & Analytics</td>
                            <td>DataSkill Institute</td>
                            <td>6 Weeks</td>
                            <td><span class="status-pending">Pending</span></td>
                        </tr>
                        <tr>
                            <td>UI/UX Design Fundamentals</td>
                            <td>Creative Hub KL</td>
                            <td>4 Weeks</td>
                            <td><span class="status-completed">Completed</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Browse courses prompt -->
        <div class="dash-empty-prompt">
            <i class="fas fa-search"></i>
            <h5>Discover New Courses</h5>
            <p>Browse hundreds of certified courses from approved training providers across Malaysia.</p>
            <a href="courses.php" class="btn-dash-primary">Browse Courses</a>
        </div>

    </main>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../js/shreeyash.js"></script>
</body>
</html>
