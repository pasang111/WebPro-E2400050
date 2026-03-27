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
        $stmt = mysqli_prepare($conn, "UPDATE providers SET status='approved' WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $action_msg = '<div class="alert alert-success"><i class="fas fa-check-circle mr-2"></i>Provider approved successfully. They can now login.</div>';
    } elseif ($action === 'reject') {
        $stmt = mysqli_prepare($conn, "UPDATE providers SET status='rejected' WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $action_msg = '<div class="alert alert-danger"><i class="fas fa-times-circle mr-2"></i>Provider registration rejected.</div>';
    }
}

// Whitelist filter to prevent SQL injection
$allowed_filters = ['all', 'pending', 'approved', 'rejected'];
$filter = isset($_GET['filter']) && in_array($_GET['filter'], $allowed_filters) ? $_GET['filter'] : 'all';
$where  = '';
if ($filter === 'pending')  $where = "WHERE status='pending'";
if ($filter === 'approved') $where = "WHERE status='approved'";
if ($filter === 'rejected') $where = "WHERE status='rejected'";

$result = mysqli_query($conn, "SELECT * FROM providers $where ORDER BY created_at DESC");

// Stats
$total_p    = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM providers"))['c'];
$approved_p = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM providers WHERE status='approved'"))['c'];
$pending_p  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM providers WHERE status='pending'"))['c'];
$rejected_p = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM providers WHERE status='rejected'"))['c'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provider Approvals - EduSkill Admin</title>
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
                <h4 class="dash-page-title">Provider Approvals</h4>
                <p class="dash-page-sub">Review and approve training provider registrations</p>
            </div>
        </div>

        <div class="dash-content">

            <?php echo $action_msg; ?>

            <!-- STAT CARDS -->
            <div class="row mb-4">
                <div class="col-6 col-lg-3 mb-3">
                    <div class="dstat-card">
                        <div class="dstat-icon dstat-icon-blue"><i class="fas fa-building"></i></div>
                        <div class="dstat-info"><h3><?php echo $total_p; ?></h3><p>Total Providers</p></div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3">
                    <div class="dstat-card">
                        <div class="dstat-icon dstat-icon-green"><i class="fas fa-check-circle"></i></div>
                        <div class="dstat-info"><h3><?php echo $approved_p; ?></h3><p>Approved</p></div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3">
                    <div class="dstat-card">
                        <div class="dstat-icon dstat-icon-orange"><i class="fas fa-clock"></i></div>
                        <div class="dstat-info"><h3><?php echo $pending_p; ?></h3><p>Pending</p></div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3">
                    <div class="dstat-card">
                        <div class="dstat-icon dstat-icon-pink"><i class="fas fa-times-circle"></i></div>
                        <div class="dstat-info"><h3><?php echo $rejected_p; ?></h3><p>Rejected</p></div>
                    </div>
                </div>
            </div>

            <!-- FILTER TABS -->
            <div class="filter-tabs mb-4">
                <a href="?filter=all"      class="ftab <?php echo $filter === 'all'      ? 'active' : ''; ?>">All Providers</a>
                <a href="?filter=pending"  class="ftab <?php echo $filter === 'pending'  ? 'active' : ''; ?>">
                    Pending
                    <?php if ($pending_p > 0): ?>
                        <span class="ftab-count"><?php echo $pending_p; ?></span>
                    <?php endif; ?>
                </a>
                <a href="?filter=approved" class="ftab <?php echo $filter === 'approved' ? 'active' : ''; ?>">Approved</a>
                <a href="?filter=rejected" class="ftab <?php echo $filter === 'rejected' ? 'active' : ''; ?>">Rejected</a>
            </div>

            <!-- TABLE -->
            <div class="dash-card">
                <div class="dash-table-wrap">
                    <table class="table dash-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Organisation</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Location</th>
                                <th>Applied</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($p = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $p['id']; ?></td>
                                <td>
                                    <strong><?php echo htmlspecialchars($p['org_name']); ?></strong>
                                    <?php if (!empty($p['description'])): ?>
                                    <br><small class="text-muted"><?php echo htmlspecialchars(substr($p['description'], 0, 60)); ?>...</small>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($p['email']); ?></td>
                                <td><?php echo htmlspecialchars($p['phone']); ?></td>
                                <td><?php echo htmlspecialchars($p['address']); ?></td>
                                <td><?php echo date('d M Y', strtotime($p['created_at'])); ?></td>
                                <td>
                                    <?php if ($p['status'] === 'pending'): ?>
                                        <span class="status-pending">Pending</span>
                                    <?php elseif ($p['status'] === 'approved'): ?>
                                        <span class="status-approved">Approved</span>
                                    <?php else: ?>
                                        <span class="status-rejected">Rejected</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($p['status'] === 'pending'): ?>
                                        <a href="?action=approve&id=<?php echo $p['id']; ?>&filter=<?php echo $filter; ?>"
                                           class="btn-approve"
                                           onclick="return confirm('Approve this provider?')">
                                            <i class="fas fa-check mr-1"></i>Approve
                                        </a>
                                        <a href="?action=reject&id=<?php echo $p['id']; ?>&filter=<?php echo $filter; ?>"
                                           class="btn-reject ml-1"
                                           onclick="return confirm('Reject this provider?')">
                                            <i class="fas fa-times mr-1"></i>Reject
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted" style="font-size:12px;">Processed</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                            <?php if (mysqli_num_rows($result) == 0): ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">No providers found</td>
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
