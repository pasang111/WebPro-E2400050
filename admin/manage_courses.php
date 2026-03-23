<?php

session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: ../auth/login.php'); exit();
}

$action_msg = '';

// Handle approve or disable
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id     = intval($_GET['id']);
    if ($action === 'approve') {
        $stmt = mysqli_prepare($conn, "UPDATE courses SET status='approved' WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $action_msg = '<div class="alert alert-success">Course approved successfully.</div>';
    } elseif ($action === 'disable') {
        $stmt = mysqli_prepare($conn, "UPDATE courses SET status='rejected' WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $action_msg = '<div class="alert alert-warning">Course has been disabled.</div>';
    }
}

// Get all courses with provider info
$result = mysqli_query($conn, "
    SELECT c.*, p.org_name as provider,
    (SELECT COUNT(*) FROM enrollments WHERE course_id = c.id) as enroll_count
    FROM courses c
    JOIN providers p ON c.provider_id = p.id
    ORDER BY c.created_at DESC
");

// Stats
$total    = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM courses"))['c'];
$active   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM courses WHERE status='approved'"))['c'];
$pending  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM courses WHERE status='pending'"))['c'];
$enrolls  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM enrollments"))['c'];

$pending_providers   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM providers WHERE status='pending'"))['c'];
$pending_enrollments = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM enrollments WHERE status='pending'"))['c'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses - EduSkill Admin</title>
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
            <a href="approve_providers.php" class="dsb-link"><i class="fas fa-building"></i> Provider Approvals
                <?php if($pending_providers > 0): ?><span class="dsb-badge"><?php echo $pending_providers; ?></span><?php endif; ?>
            </a>
            <a href="approve_enrollments.php" class="dsb-link"><i class="fas fa-user-check"></i> Enrollments
                <?php if($pending_enrollments > 0): ?><span class="dsb-badge"><?php echo $pending_enrollments; ?></span><?php endif; ?>
            </a>
            <a href="manage_courses.php" class="dsb-link active"><i class="fas fa-book-open"></i> Courses</a>
        </nav>
        <div class="dsb-bottom">
            <a href="../auth/logout.php" class="dsb-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </aside>

    <main class="dash-main">
        <div class="dash-topbar">
            <div>
                <h4 class="dash-page-title">Manage Courses</h4>
                <p class="dash-page-sub">View and manage all courses listed by training providers</p>
            </div>
        </div>

        <?php echo $action_msg; ?>

        <div class="row mb-4">
            <div class="col-6 col-lg-3 mb-3">
                <div class="dstat-card">
                    <div class="dstat-icon" style="background:#dbeafe;color:#1d4ed8;"><i class="fas fa-book-open"></i></div>
                    <div class="dstat-info"><h3><?php echo $total; ?></h3><p>Total Courses</p></div>
                </div>
            </div>
            <div class="col-6 col-lg-3 mb-3">
                <div class="dstat-card">
                    <div class="dstat-icon" style="background:#dcfce7;color:#15803d;"><i class="fas fa-check-circle"></i></div>
                    <div class="dstat-info"><h3><?php echo $active; ?></h3><p>Active Courses</p></div>
                </div>
            </div>
            <div class="col-6 col-lg-3 mb-3">
                <div class="dstat-card">
                    <div class="dstat-icon" style="background:#ffedd5;color:#c2410c;"><i class="fas fa-clock"></i></div>
                    <div class="dstat-info"><h3><?php echo $pending; ?></h3><p>Pending Review</p></div>
                </div>
            </div>
            <div class="col-6 col-lg-3 mb-3">
                <div class="dstat-card">
                    <div class="dstat-icon" style="background:#fce7f3;color:#be185d;"><i class="fas fa-users"></i></div>
                    <div class="dstat-info"><h3><?php echo $enrolls; ?></h3><p>Total Enrollments</p></div>
                </div>
            </div>
        </div>

        <div class="dash-card">
            <div class="dash-table-wrap">
                <table class="table dash-table">
                    <thead>
                        <tr><th>#</th><th>Course Title</th><th>Provider</th><th>Category</th><th>Duration</th><th>Enrollments</th><th>Status</th><th>Action</th></tr>
                    </thead>
                    <tbody>
                        <?php while($c = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $c['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($c['title']); ?></strong></td>
                            <td><?php echo htmlspecialchars($c['provider']); ?></td>
                            <td><?php echo htmlspecialchars($c['category']); ?></td>
                            <td><?php echo htmlspecialchars($c['duration']); ?></td>
                            <td><?php echo $c['enroll_count']; ?></td>
                            <td>
                                <?php if($c['status']=='approved'): ?>
                                    <span class="status-approved">Active</span>
                                <?php elseif($c['status']=='pending'): ?>
                                    <span class="status-pending">Pending</span>
                                <?php else: ?>
                                    <span class="status-rejected">Disabled</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($c['status']=='pending'): ?>
                                    <a href="?action=approve&id=<?php echo $c['id']; ?>" class="btn-approve" onclick="return confirm('Approve this course?')"><i class="fas fa-check mr-1"></i>Approve</a>
                                <?php elseif($c['status']=='approved'): ?>
                                    <a href="?action=disable&id=<?php echo $c['id']; ?>" class="btn-reject" onclick="return confirm('Disable this course?')"><i class="fas fa-ban mr-1"></i>Disable</a>
                                <?php else: ?>
                                    <a href="?action=approve&id=<?php echo $c['id']; ?>" class="btn-approve" onclick="return confirm('Re-enable this course?')"><i class="fas fa-check mr-1"></i>Enable</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        <?php if(mysqli_num_rows($result) == 0): ?>
                        <tr><td colspan="8" class="text-center text-muted py-4">No courses found</td></tr>
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
