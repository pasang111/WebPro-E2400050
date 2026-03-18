<?php

session_start();

// Check if logged in as admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit();
}

$admin_name = $_SESSION['user_name'] ?? 'Admin Officer';

// Placeholder data - will be replaced with database in final step
$total_students   = 120;
$total_providers  = 15;
$pending_providers = 4;
$pending_enrollments = 8;
$total_courses    = 45;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - EduSkill</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/pasang.css">
</head>
<body class="dashboard-body">

<div class="dashboard-wrap">

    <!-- SIDEBAR -->
    <aside class="dash-sidebar admin-sidebar">
        <div class="dsb-brand">
            <a href="../index.php">
                <img src="../images/logo.png" alt="EduSkill Logo" style="width:32px; height:32px; border-radius:8px; object-fit:cover;">    
                <span class="dsb-brand-text">EDU<span class="dsb-brand-accent">SKILL</span></span>
            </a>
        </div>

        <div class="dsb-role-badge">
            <i class="fas fa-user-shield mr-2"></i> Ministry Officer
        </div>

        <nav class="dsb-nav">
            <a href="dashboard.php" class="dsb-link active">
                <i class="fas fa-th-large"></i> Dashboard
            </a>
            <a href="approve_providers.php" class="dsb-link">
                <i class="fas fa-building"></i> Provider Approvals
                <?php if($pending_providers > 0): ?>
                    <span class="dsb-badge"><?php echo $pending_providers; ?></span>
                <?php endif; ?>
            </a>
            <a href="approve_enrollments.php" class="dsb-link">
                <i class="fas fa-user-check"></i> Enrollments
                <?php if($pending_enrollments > 0): ?>
                    <span class="dsb-badge"><?php echo $pending_enrollments; ?></span>
                <?php endif; ?>
            </a>
            <a href="manage_courses.php" class="dsb-link">
                <i class="fas fa-book-open"></i> Courses
            </a>
        </nav>

        <div class="dsb-bottom">
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
                <h4 class="dash-page-title">Dashboard</h4>
                <p class="dash-page-sub">Welcome back, <?php echo htmlspecialchars($admin_name); ?></p>
            </div>
            <div class="dash-topbar-right">
                <span class="dash-date"><i class="fas fa-calendar mr-1"></i> <?php echo date('d M Y'); ?></span>
            </div>
        </div>

        <!-- Stats cards -->
        <div class="row mb-4">
            <div class="col-6 col-lg-3 mb-3">
                <div class="dstat-card">
                    <div class="dstat-icon" style="background:#dbeafe; color:#1d4ed8;">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="dstat-info">
                        <h3><?php echo $total_students; ?></h3>
                        <p>Total Students</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 mb-3">
                <div class="dstat-card">
                    <div class="dstat-icon" style="background:#dcfce7; color:#15803d;">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="dstat-info">
                        <h3><?php echo $total_providers; ?></h3>
                        <p>Total Providers</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 mb-3">
                <div class="dstat-card">
                    <div class="dstat-icon" style="background:#ffedd5; color:#c2410c;">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="dstat-info">
                        <h3><?php echo $pending_providers; ?></h3>
                        <p>Pending Providers</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 mb-3">
                <div class="dstat-card">
                    <div class="dstat-icon" style="background:#fce7f3; color:#be185d;">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div class="dstat-info">
                        <h3><?php echo $total_courses; ?></h3>
                        <p>Total Courses</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Two column: pending providers + pending enrollments -->
        <div class="row">

            <!-- Pending provider approvals -->
            <div class="col-lg-6 mb-4">
                <div class="dash-card">
                    <div class="dash-card-head">
                        <h5>Pending Provider Approvals</h5>
                        <a href="approve_providers.php" class="dash-card-link">View All</a>
                    </div>
                    <div class="dash-table-wrap">
                        <table class="table dash-table">
                            <thead>
                                <tr>
                                    <th>Organisation</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tech Academy MY</td>
                                    <td>tech@academy.my</td>
                                    <td><span class="status-pending">Pending</span></td>
                                    <td><a href="approve_providers.php" class="btn-dash-action">Review</a></td>
                                </tr>
                                <tr>
                                    <td>DataSkill Institute</td>
                                    <td>info@dataskill.my</td>
                                    <td><span class="status-pending">Pending</span></td>
                                    <td><a href="approve_providers.php" class="btn-dash-action">Review</a></td>
                                </tr>
                                <tr>
                                    <td>Creative Hub KL</td>
                                    <td>hello@creativehub.my</td>
                                    <td><span class="status-pending">Pending</span></td>
                                    <td><a href="approve_providers.php" class="btn-dash-action">Review</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pending enrollment approvals -->
            <div class="col-lg-6 mb-4">
                <div class="dash-card">
                    <div class="dash-card-head">
                        <h5>Pending Enrollments</h5>
                        <a href="approve_enrollments.php" class="dash-card-link">View All</a>
                    </div>
                    <div class="dash-table-wrap">
                        <table class="table dash-table">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Course</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Ahmad Faris</td>
                                    <td>Web Development</td>
                                    <td><span class="status-pending">Pending</span></td>
                                    <td><a href="approve_enrollments.php" class="btn-dash-action">Review</a></td>
                                </tr>
                                <tr>
                                    <td>Nurul Aina</td>
                                    <td>Data Science</td>
                                    <td><span class="status-pending">Pending</span></td>
                                    <td><a href="approve_enrollments.php" class="btn-dash-action">Review</a></td>
                                </tr>
                                <tr>
                                    <td>Ravi Kumar</td>
                                    <td>UI/UX Design</td>
                                    <td><span class="status-pending">Pending</span></td>
                                    <td><a href="approve_enrollments.php" class="btn-dash-action">Review</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </main>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../js/pasang.js"></script>
</body>
</html>
