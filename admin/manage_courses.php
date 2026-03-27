<?php

session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: ../auth/login.php'); exit();
}

$action_msg = '';

if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id     = intval($_GET['id']);

    if ($action === 'approve') {
        $stmt = mysqli_prepare($conn, "UPDATE courses SET status='approved' WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $action_msg = '<div class="alert alert-success"><i class="fas fa-check-circle mr-2"></i>Course approved successfully. Students can now enroll.</div>';
    } elseif ($action === 'disable') {
        $stmt = mysqli_prepare($conn, "UPDATE courses SET status='rejected' WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $action_msg = '<div class="alert alert-warning"><i class="fas fa-ban mr-2"></i>Course has been disabled.</div>';
    }
}

// Whitelist filter to prevent SQL injection
$allowed_filters = ['all', 'pending', 'approved', 'rejected'];
$filter = isset($_GET['filter']) && in_array($_GET['filter'], $allowed_filters) ? $_GET['filter'] : 'all';
$where  = '';
if ($filter === 'pending')  $where = "WHERE c.status='pending'";
if ($filter === 'approved') $where = "WHERE c.status='approved'";
if ($filter === 'rejected') $where = "WHERE c.status='rejected'";

$result = mysqli_query($conn, "
    SELECT c.*, p.org_name as provider,
    (SELECT COUNT(*) FROM enrollments WHERE course_id = c.id) as enroll_count
    FROM courses c
    JOIN providers p ON c.provider_id = p.id
    $where
    ORDER BY c.id ASC
");

$total_c    = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM courses"))['c'];
$approved_c = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM courses WHERE status='approved'"))['c'];
$pending_c  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM courses WHERE status='pending'"))['c'];
$enrolls    = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM enrollments"))['c'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses - EduSkill Admin</title>
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
                <h4 class="dash-page-title">Manage Courses</h4>
                <p class="dash-page-sub">Review and approve courses submitted by training providers</p>
            </div>
        </div>

        <div class="dash-content">

            <?php echo $action_msg; ?>

            <!-- STAT CARDS -->
            <div class="row mb-4">
                <div class="col-6 col-lg-3 mb-3">
                    <div class="dstat-card">
                        <div class="dstat-icon dstat-icon-blue"><i class="fas fa-book-open"></i></div>
                        <div class="dstat-info"><h3><?php echo $total_c; ?></h3><p>Total Courses</p></div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3">
                    <div class="dstat-card">
                        <div class="dstat-icon dstat-icon-green"><i class="fas fa-check-circle"></i></div>
                        <div class="dstat-info"><h3><?php echo $approved_c; ?></h3><p>Active Courses</p></div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3">
                    <div class="dstat-card">
                        <div class="dstat-icon dstat-icon-orange"><i class="fas fa-clock"></i></div>
                        <div class="dstat-info"><h3><?php echo $pending_c; ?></h3><p>Pending Review</p></div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3">
                    <div class="dstat-card">
                        <div class="dstat-icon dstat-icon-pink"><i class="fas fa-users"></i></div>
                        <div class="dstat-info"><h3><?php echo $enrolls; ?></h3><p>Total Enrollments</p></div>
                    </div>
                </div>
            </div>

            <!-- FILTER TABS -->
            <div class="filter-tabs mb-4">
                <a href="?filter=all"      class="ftab <?php echo $filter === 'all'      ? 'active' : ''; ?>">All Courses</a>
                <a href="?filter=pending"  class="ftab <?php echo $filter === 'pending'  ? 'active' : ''; ?>">
                    Pending
                    <?php if ($pending_c > 0): ?>
                        <span class="ftab-count"><?php echo $pending_c; ?></span>
                    <?php endif; ?>
                </a>
                <a href="?filter=approved" class="ftab <?php echo $filter === 'approved' ? 'active' : ''; ?>">Approved</a>
                <a href="?filter=rejected" class="ftab <?php echo $filter === 'rejected' ? 'active' : ''; ?>">Disabled</a>
            </div>

            <!-- TABLE -->
            <div class="dash-card">
                <div class="dash-table-wrap">
                    <table class="table dash-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Course Title</th>
                                <th>Provider</th>
                                <th>Category</th>
                                <th>Duration</th>
                                <th>Enrollments</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($c = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $c['id']; ?></td>
                                <td>
                                    <strong><?php echo htmlspecialchars($c['title']); ?></strong>
                                    <?php if (!empty($c['description'])): ?>
                                    <br><small class="text-muted"><?php echo htmlspecialchars(substr($c['description'], 0, 50)); ?>...</small>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($c['provider']); ?></td>
                                <td><?php echo htmlspecialchars($c['category']); ?></td>
                                <td><?php echo htmlspecialchars($c['duration']); ?></td>
                                <td><?php echo $c['enroll_count']; ?></td>
                                <td>
                                    <?php if ($c['status'] === 'approved'): ?>
                                        <span class="status-approved">Active</span>
                                    <?php elseif ($c['status'] === 'pending'): ?>
                                        <span class="status-pending">Pending</span>
                                    <?php else: ?>
                                        <span class="status-rejected">Disabled</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($c['status'] === 'pending'): ?>
                                        <a href="?action=approve&id=<?php echo $c['id']; ?>&filter=<?php echo $filter; ?>"
                                           class="btn-approve"
                                           onclick="return confirm('Approve this course?')">
                                            <i class="fas fa-check mr-1"></i>Approve
                                        </a>
                                        <a href="?action=disable&id=<?php echo $c['id']; ?>&filter=<?php echo $filter; ?>"
                                           class="btn-reject ml-1"
                                           onclick="return confirm('Reject this course?')">
                                            <i class="fas fa-times mr-1"></i>Reject
                                        </a>
                                    <?php elseif ($c['status'] === 'approved'): ?>
                                        <a href="?action=disable&id=<?php echo $c['id']; ?>&filter=<?php echo $filter; ?>"
                                           class="btn-reject"
                                           onclick="return confirm('Disable this course?')">
                                            <i class="fas fa-ban mr-1"></i>Disable
                                        </a>
                                    <?php else: ?>
                                        <a href="?action=approve&id=<?php echo $c['id']; ?>&filter=<?php echo $filter; ?>"
                                           class="btn-approve"
                                           onclick="return confirm('Re-enable this course?')">
                                            <i class="fas fa-check mr-1"></i>Enable
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                            <?php if (mysqli_num_rows($result) == 0): ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">No courses found</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
