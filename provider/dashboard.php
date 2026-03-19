<?php
session_start();

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'provider') {
    header('Location: ../auth/login.php');
    exit();
}

$provider_name = $_SESSION['user_name'] ?? 'Training Provider';

// Placeholder data
$total_courses     = 5;
$total_enrollments = 34;
$pending_enrollments = 6;
$approved_enrollments = 28;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provider Dashboard - EduSkill</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/pasang.css">
    <link rel="stylesheet" href="../css/archana.css">
</head>
<body class="dashboard-body">

<div class="dashboard-wrap">

    <!-- SIDEBAR -->
    <aside class="dash-sidebar provider-sidebar">
        <div class="dsb-brand">
            <a href="../index.php">
                <img src="../images/logo.png" alt="EduSkill Logo" style="width:32px; height:32px; border-radius:8px; object-fit:cover;">    
                <span class="dsb-brand-text">EDU<span class="dsb-brand-accent">SKILL</span></span>
            </a>
        </div>

        <div class="dsb-role-badge provider-role-badge">
            <i class="fas fa-building mr-2"></i> Training Provider
        </div>

        <nav class="dsb-nav">
            <a href="dashboard.php" class="dsb-link active">
                <i class="fas fa-th-large"></i> Dashboard
            </a>
            <a href="add_course.php" class="dsb-link">
                <i class="fas fa-plus-circle"></i> Add Course
            </a>
            <a href="edit_course.php" class="dsb-link">
                <i class="fas fa-edit"></i> Manage Courses
            </a>
            <a href="course_students.php" class="dsb-link">
                <i class="fas fa-users"></i> Enrolled Students
                <?php if($pending_enrollments > 0): ?>
                    <span class="dsb-badge"><?php echo $pending_enrollments; ?></span>
                <?php endif; ?>
            </a>
        </nav>

        <div class="dsb-bottom">
            <div class="dsb-user-info">
                <div class="dsb-avatar provider-avatar">
                    <?php echo strtoupper(substr($provider_name, 0, 1)); ?>
                </div>
                <div>
                    <strong><?php echo htmlspecialchars($provider_name); ?></strong>
                    <span>Provider</span>
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
                <h4 class="dash-page-title">Provider Dashboard</h4>
                <p class="dash-page-sub">Welcome back, <?php echo htmlspecialchars($provider_name); ?>!</p>
            </div>
            <div class="dash-topbar-right">
                <a href="add_course.php" class="btn-dash-primary btn-dash-green">
                    <i class="fas fa-plus mr-1"></i> Add New Course
                </a>
            </div>
        </div>

        <!-- Stats -->
        <div class="row mb-4">
            <div class="col-6 col-lg-3 mb-3">
                <div class="dstat-card">
                    <div class="dstat-icon" style="background:#dcfce7; color:#15803d;">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div class="dstat-info">
                        <h3><?php echo $total_courses; ?></h3>
                        <p>My Courses</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 mb-3">
                <div class="dstat-card">
                    <div class="dstat-icon" style="background:#dbeafe; color:#1d4ed8;">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="dstat-info">
                        <h3><?php echo $total_enrollments; ?></h3>
                        <p>Total Enrollments</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 mb-3">
                <div class="dstat-card">
                    <div class="dstat-icon" style="background:#ffedd5; color:#c2410c;">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="dstat-info">
                        <h3><?php echo $pending_enrollments; ?></h3>
                        <p>Pending</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 mb-3">
                <div class="dstat-card">
                    <div class="dstat-icon" style="background:#dcfce7; color:#15803d;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="dstat-info">
                        <h3><?php echo $approved_enrollments; ?></h3>
                        <p>Approved</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- My courses table -->
        <div class="dash-card mb-4">
            <div class="dash-card-head">
                <h5>My Courses</h5>
                <a href="add_course.php" class="dash-card-link">+ Add Course</a>
            </div>
            <div class="dash-table-wrap">
                <table class="table dash-table">
                    <thead>
                        <tr>
                            <th>Course Name</th>
                            <th>Duration</th>
                            <th>Enrollments</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Full Stack Web Development</td>
                            <td>8 Weeks</td>
                            <td>18</td>
                            <td><span class="status-approved">Active</span></td>
                            <td>
                                <a href="edit_course.php" class="btn-tbl-edit">Edit</a>
                                <a href="#" class="btn-tbl-delete">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td>PHP for Beginners</td>
                            <td>4 Weeks</td>
                            <td>12</td>
                            <td><span class="status-approved">Active</span></td>
                            <td>
                                <a href="edit_course.php" class="btn-tbl-edit">Edit</a>
                                <a href="#" class="btn-tbl-delete">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td>JavaScript Essentials</td>
                            <td>3 Weeks</td>
                            <td>4</td>
                            <td><span class="status-pending">Pending</span></td>
                            <td>
                                <a href="edit_course.php" class="btn-tbl-edit">Edit</a>
                                <a href="#" class="btn-tbl-delete">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../js/archana.js"></script>
</body>
</html>
