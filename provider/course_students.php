<?php

session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'provider') {
    header('Location: ../auth/login.php'); exit();
}

$provider_id   = $_SESSION['user_id'];
$provider_name = $_SESSION['user_name'] ?? 'Provider';

// Get all enrollments for this provider's courses
$result = mysqli_query($conn, "
    SELECT e.id, e.status, e.enrolled_at,
           s.name as student, s.email as student_email,
           c.title as course
    FROM enrollments e
    JOIN students s ON e.student_id = s.id
    JOIN courses c ON e.course_id = c.id
    WHERE c.provider_id = $provider_id
    ORDER BY e.enrolled_at DESC
");

$total    = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM enrollments e JOIN courses c ON e.course_id=c.id WHERE c.provider_id=$provider_id"))['c'];
$approved = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM enrollments e JOIN courses c ON e.course_id=c.id WHERE c.provider_id=$provider_id AND e.status='approved'"))['c'];
$pending  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM enrollments e JOIN courses c ON e.course_id=c.id WHERE c.provider_id=$provider_id AND e.status='pending'"))['c'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrolled Students - EduSkill Provider</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/pasang.css">
    <link rel="stylesheet" href="../css/archana.css">
</head>
<body class="dashboard-body">
<div class="dashboard-wrap">
    <aside class="dash-sidebar provider-sidebar">
        <div class="dsb-brand">
            <a href="../index.php">
                <img src="../images/logo.png" alt="Logo" style="width:32px;height:32px;border-radius:8px;object-fit:cover;">
                <span class="dsb-brand-text">EDU<span class="dsb-brand-accent">SKILL</span></span>
            </a>
        </div>
        <div class="dsb-role-badge provider-role-badge"><i class="fas fa-building mr-2"></i> Training Provider</div>
        <nav class="dsb-nav">
            <a href="dashboard.php" class="dsb-link"><i class="fas fa-th-large"></i> Dashboard</a>
            <a href="add_course.php" class="dsb-link"><i class="fas fa-plus-circle"></i> Add Course</a>
            <a href="edit_course.php" class="dsb-link"><i class="fas fa-edit"></i> Manage Courses</a>
            <a href="course_students.php" class="dsb-link active"><i class="fas fa-users"></i> Enrolled Students</a>
                <a href="analytics.php" class="dsb-link">
                <i class="fas fa-chart-bar"></i> Analytics
            </a>
        </nav>
        <div class="dsb-bottom">
            <div class="dsb-user-info">
                <div class="dsb-avatar provider-avatar"><?php echo strtoupper(substr($provider_name,0,1)); ?></div>
                <div><strong><?php echo htmlspecialchars($provider_name); ?></strong><span>Provider</span></div>
            </div>
            <a href="../auth/logout.php" class="dsb-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </aside>

    <main class="dash-main">
        <div class="dash-topbar">
            <div>
                <h4 class="dash-page-title">Enrolled Students</h4>
                <p class="dash-page-sub">View students enrolled in your courses</p>
            </div>
        </div>

        <div class="dash-content">
        <div class="row mb-4">
            <div class="col-6 col-lg-4 mb-3">
                <div class="dstat-card">
                    <div class="dstat-icon" style="background:#dbeafe;color:#1d4ed8;"><i class="fas fa-users"></i></div>
                    <div class="dstat-info"><h3><?php echo $total; ?></h3><p>Total Students</p></div>
                </div>
            </div>
            <div class="col-6 col-lg-4 mb-3">
                <div class="dstat-card">
                    <div class="dstat-icon" style="background:#dcfce7;color:#15803d;"><i class="fas fa-check-circle"></i></div>
                    <div class="dstat-info"><h3><?php echo $approved; ?></h3><p>Approved</p></div>
                </div>
            </div>
            <div class="col-6 col-lg-4 mb-3">
                <div class="dstat-card">
                    <div class="dstat-icon" style="background:#ffedd5;color:#c2410c;"><i class="fas fa-clock"></i></div>
                    <div class="dstat-info"><h3><?php echo $pending; ?></h3><p>Pending</p></div>
                </div>
            </div>
        </div>

        <div class="dash-card">
            <div class="dash-table-wrap">
                <table class="table dash-table">
                    <thead>
                        <tr><th>#</th><th>Student</th><th>Email</th><th>Course</th><th>Enrolled On</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        <?php while($e = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $e['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($e['student']); ?></strong></td>
                            <td><?php echo htmlspecialchars($e['student_email']); ?></td>
                            <td><?php echo htmlspecialchars($e['course']); ?></td>
                            <td><?php echo date('d M Y', strtotime($e['enrolled_at'])); ?></td>
                            <td>
                                <?php if($e['status']=='approved'): ?>
                                    <span class="status-approved"><i class="fas fa-check-circle mr-1"></i>Approved</span>
                                <?php elseif($e['status']=='pending'): ?>
                                    <span class="status-pending"><i class="fas fa-clock mr-1"></i>Pending</span>
                                <?php else: ?>
                                    <span class="status-rejected"><i class="fas fa-times-circle mr-1"></i>Rejected</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        <?php if(mysqli_num_rows($result) == 0): ?>
                        <tr><td colspan="6" class="text-center text-muted py-4">No students enrolled yet.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div><!-- end dash-content -->
    </main>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>