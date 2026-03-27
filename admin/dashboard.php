<?php

session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: ../auth/login.php'); exit();
}

$admin_name = $_SESSION['user_name'] ?? 'Admin Officer';

// Real data from database
$total_students      = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM students"))['c'];
$total_providers     = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM providers WHERE status='approved'"))['c'];
$pending_providers   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM providers WHERE status='pending'"))['c'];
$pending_enrollments = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM enrollments WHERE status='pending'"))['c'];
$total_courses       = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM courses WHERE status='approved'"))['c'];
$total_enrollments   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM enrollments"))['c'];

// Recent pending providers
$recent_providers = mysqli_query($conn, "
    SELECT id, org_name, email, status, created_at
    FROM providers
    WHERE status = 'pending'
    ORDER BY created_at DESC
    LIMIT 5
");

// Recent pending enrollments
$recent_enrollments = mysqli_query($conn, "
    SELECT e.id, s.name as student, c.title as course, e.status, e.enrolled_at
    FROM enrollments e
    JOIN students s ON e.student_id = s.id
    JOIN courses  c ON e.course_id  = c.id
    WHERE e.status = 'pending'
    ORDER BY e.enrolled_at DESC
    LIMIT 5
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - EduSkill</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/pasang.css">
</head>
<body class="dashboard-body">
<div class="dashboard-wrap">

    <?php include 'sidebar.php'; ?>

    <main class="dash-main">
        <div class="dash-topbar">
            <div>
                <h4 class="dash-page-title">Dashboard</h4>
                <p class="dash-page-sub">Welcome back, <?php echo htmlspecialchars($admin_name); ?></p>
            </div>
            <div class="dash-topbar-right">
                <span class="dash-date">
                    <i class="fas fa-calendar mr-1"></i> <?php echo date('d M Y'); ?>
                </span>
            </div>
        </div>

        <div class="dash-content">

            <!-- STAT CARDS -->
            <div class="row mb-4">
                <div class="col-6 col-lg-3 mb-3">
                    <div class="dstat-card">
                        <div class="dstat-icon dstat-icon-blue">
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
                        <div class="dstat-icon dstat-icon-green">
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
                        <div class="dstat-icon dstat-icon-orange">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div class="dstat-info">
                            <h3><?php echo $total_courses; ?></h3>
                            <p>Active Courses</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3">
                    <div class="dstat-card">
                        <div class="dstat-icon dstat-icon-pink">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="dstat-info">
                            <h3><?php echo $total_enrollments; ?></h3>
                            <p>Total Enrollments</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PENDING ALERTS -->
            <?php if ($pending_providers > 0 || $pending_enrollments > 0): ?>
            <div class="row mb-4">
                <?php if ($pending_providers > 0): ?>
                <div class="col-md-6 mb-3">
                    <div class="alert-notice">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <strong><?php echo $pending_providers; ?> provider(s)</strong> waiting for approval.
                        <a href="approve_providers.php" class="ml-2">Review now</a>
                    </div>
                </div>
                <?php endif; ?>
                <?php if ($pending_enrollments > 0): ?>
                <div class="col-md-6 mb-3">
                    <div class="alert-notice">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <strong><?php echo $pending_enrollments; ?> enrollment(s)</strong> waiting for approval.
                        <a href="approve_enrollments.php" class="ml-2">Review now</a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <!-- TWO TABLES -->
            <div class="row">

                <!-- Pending providers -->
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
                                    <?php while ($p = mysqli_fetch_assoc($recent_providers)): ?>
                                    <tr>
                                        <td><strong><?php echo htmlspecialchars($p['org_name']); ?></strong></td>
                                        <td><?php echo htmlspecialchars($p['email']); ?></td>
                                        <td><span class="status-pending">Pending</span></td>
                                        <td>
                                            <a href="approve_providers.php?action=approve&id=<?php echo $p['id']; ?>"
                                               class="btn-approve"
                                               onclick="return confirm('Approve this provider?')">
                                                <i class="fas fa-check mr-1"></i>Approve
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                    <?php if (mysqli_num_rows($recent_providers) == 0): ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-3">No pending providers</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Pending enrollments -->
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
                                    <?php while ($e = mysqli_fetch_assoc($recent_enrollments)): ?>
                                    <tr>
                                        <td><strong><?php echo htmlspecialchars($e['student']); ?></strong></td>
                                        <td><?php echo htmlspecialchars(substr($e['course'], 0, 25)); ?>...</td>
                                        <td><span class="status-pending">Pending</span></td>
                                        <td>
                                            <a href="approve_enrollments.php?action=approve&id=<?php echo $e['id']; ?>"
                                               class="btn-approve"
                                               onclick="return confirm('Approve this enrollment?')">
                                                <i class="fas fa-check mr-1"></i>Approve
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                    <?php if (mysqli_num_rows($recent_enrollments) == 0): ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-3">No pending enrollments</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
