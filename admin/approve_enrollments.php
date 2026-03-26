<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: ../auth/login.php'); exit();
}

$action_msg = '';

// Handle approve or reject
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id     = intval($_GET['id']);

    if ($action === 'approve') {
        $stmt = mysqli_prepare($conn, "UPDATE enrollments SET status='approved' WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $action_msg = '<div class="alert alert-success">Enrollment approved. Student has been notified.</div>';
    } elseif ($action === 'reject') {
        $stmt = mysqli_prepare($conn, "UPDATE enrollments SET status='rejected' WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $action_msg = '<div class="alert alert-danger">Enrollment rejected.</div>';
    }
}

$filter = $_GET['filter'] ?? 'all';
$where  = $filter !== 'all' ? "WHERE e.status='$filter'" : '';

$result = mysqli_query($conn, "
    SELECT e.id, e.status, e.enrolled_at,
           s.name as student, s.email as student_email,
           c.title as course, c.duration,
           p.org_name as provider
    FROM enrollments e
    JOIN students s ON e.student_id = s.id
    JOIN courses c ON e.course_id = c.id
    JOIN providers p ON c.provider_id = p.id
    $where
    ORDER BY e.enrolled_at DESC
");

$pending_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM enrollments WHERE status='pending'"))['c'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve Enrollments - EduSkill Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/pasang.css">
</head>
<body class="dashboard-body">
<div class="dashboard-wrap">
    <aside class="dash-sidebar admin-sidebar">
        <div class="dsb-brand">
            <a href="../index.php">
                <img src="../images/logo.png" alt="Logo" style="width:32px;height:32px;border-radius:8px;object-fit:cover;">
                <span class="dsb-brand-text">EDU<span class="dsb-brand-accent">SKILL</span></span>
            </a>
        </div>
        <div class="dsb-role-badge"><i class="fas fa-user-shield mr-2"></i> Ministry Officer</div>
        <nav class="dsb-nav">
            <a href="dashboard.php" class="dsb-link"><i class="fas fa-th-large"></i> Dashboard</a>
            <a href="approve_providers.php" class="dsb-link"><i class="fas fa-building"></i> Provider Approvals</a>
            <a href="approve_enrollments.php" class="dsb-link active"><i class="fas fa-user-check"></i> Enrollments
                <?php if($pending_count > 0): ?><span class="dsb-badge"><?php echo $pending_count; ?></span><?php endif; ?>
            </a>
            <a href="manage_courses.php" class="dsb-link"><i class="fas fa-book-open"></i> Courses</a>
            <a href="analytics.php" class="dsb-link">
                <i class="fas fa-chart-bar"></i> Analytics
            </a>
        </nav>
        <div class="dsb-bottom">
            <a href="../auth/logout.php" class="dsb-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </aside>

    <main class="dash-main">
        <div class="dash-topbar">
            <div>
                <h4 class="dash-page-title">Student Enrollments</h4>
                <p class="dash-page-sub">Review and approve student course enrollment requests</p>
            </div>
        </div>

        <?php echo $action_msg; ?>

        <div class="filter-tabs mb-4">
            <a href="?filter=all"      class="ftab <?php echo $filter=='all'?'active':''; ?>">All</a>
            <a href="?filter=pending"  class="ftab <?php echo $filter=='pending'?'active':''; ?>">Pending</a>
            <a href="?filter=approved" class="ftab <?php echo $filter=='approved'?'active':''; ?>">Approved</a>
            <a href="?filter=rejected" class="ftab <?php echo $filter=='rejected'?'active':''; ?>">Rejected</a>
        </div>

        <div class="dash-card">
            <div class="dash-table-wrap">
                <table class="table dash-table">
                    <thead>
                        <tr><th>#</th><th>Student</th><th>Course</th><th>Provider</th><th>Duration</th><th>Applied</th><th>Status</th><th>Action</th></tr>
                    </thead>
                    <tbody>
                        <?php while($e = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $e['id']; ?></td>
                            <td>
                                <strong><?php echo htmlspecialchars($e['student']); ?></strong>
                                <br><small class="text-muted"><?php echo htmlspecialchars($e['student_email']); ?></small>
                            </td>
                            <td><?php echo htmlspecialchars($e['course']); ?></td>
                            <td><?php echo htmlspecialchars($e['provider']); ?></td>
                            <td><?php echo $e['duration']; ?></td>
                            <td><?php echo date('d M Y', strtotime($e['enrolled_at'])); ?></td>
                            <td>
                                <?php if($e['status']=='pending'): ?>
                                    <span class="status-pending">Pending</span>
                                <?php elseif($e['status']=='approved'): ?>
                                    <span class="status-approved">Approved</span>
                                <?php else: ?>
                                    <span class="status-rejected">Rejected</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($e['status']=='pending'): ?>
                                    <a href="?action=approve&id=<?php echo $e['id']; ?>&filter=<?php echo $filter; ?>" class="btn-approve" onclick="return confirm('Approve this enrollment?')">
                                        <i class="fas fa-check mr-1"></i>Approve
                                    </a>
                                    <a href="?action=reject&id=<?php echo $e['id']; ?>&filter=<?php echo $filter; ?>" class="btn-reject ml-1" onclick="return confirm('Reject?')">
                                        <i class="fas fa-times mr-1"></i>Reject
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted" style="font-size:12px;">Processed</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        <?php if(mysqli_num_rows($result) == 0): ?>
                        <tr><td colspan="8" class="text-center text-muted py-4">No enrollments found</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
