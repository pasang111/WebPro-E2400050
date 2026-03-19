<?php

session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: ../auth/login.php'); exit();
}

$admin_name = $_SESSION['user_name'] ?? 'Admin Officer';

$providers = [
    ['id' => 1, 'org_name' => 'Tech Academy Malaysia', 'email' => 'info@techacademy.my', 'phone' => '03-1234 5678', 'address' => 'Kuala Lumpur', 'description' => 'Leading tech training provider in Malaysia.', 'status' => 'pending', 'date' => '2026-03-10'],
    ['id' => 2, 'org_name' => 'DataSkill Institute',   'email' => 'hello@dataskill.my',  'phone' => '03-2345 6789', 'address' => 'Petaling Jaya', 'description' => 'Specialising in data science and analytics courses.', 'status' => 'pending', 'date' => '2026-03-11'],
    ['id' => 3, 'org_name' => 'Creative Hub KL',       'email' => 'hi@creativehub.my',   'phone' => '03-3456 7890', 'address' => 'Bangsar', 'description' => 'Design and creative skills training centre.', 'status' => 'approved', 'date' => '2026-03-08'],
    ['id' => 4, 'org_name' => 'BizPro Academy',        'email' => 'info@bizpro.my',       'phone' => '03-4567 8901', 'address' => 'Shah Alam', 'description' => 'Business management and entrepreneurship courses.', 'status' => 'rejected', 'date' => '2026-03-07'],
];

$action_msg = '';
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id     = $_GET['id'];
    if ($action === 'approve') {
        $action_msg = '<div class="alert alert-success">Provider #'.$id.' has been approved successfully.</div>';
    } elseif ($action === 'reject') {
        $action_msg = '<div class="alert alert-danger">Provider #'.$id.' has been rejected.</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve Providers - EduSkill Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
                <img src="../images/logo.png" alt="Logo" style="width:32px;height:32px;border-radius:8px;object-fit:cover;">
                <span class="dsb-brand-text">EDU<span class="dsb-brand-accent">SKILL</span></span>
            </a>
        </div>
        <div class="dsb-role-badge">
            <i class="fas fa-user-shield mr-2"></i> Ministry Officer
        </div>
        <nav class="dsb-nav">
            <a href="dashboard.php" class="dsb-link"><i class="fas fa-th-large"></i> Dashboard</a>
            <a href="approve_providers.php" class="dsb-link active"><i class="fas fa-building"></i> Provider Approvals <span class="dsb-badge">2</span></a>
            <a href="approve_enrollments.php" class="dsb-link"><i class="fas fa-user-check"></i> Enrollments</a>
            <a href="manage_courses.php" class="dsb-link"><i class="fas fa-book-open"></i> Courses</a>
        </nav>
        <div class="dsb-bottom">
            <a href="../auth/logout.php" class="dsb-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="dash-main">
        <div class="dash-topbar">
            <div>
                <h4 class="dash-page-title">Provider Approvals</h4>
                <p class="dash-page-sub">Review and approve training provider registrations</p>
            </div>
        </div>

        <?php echo $action_msg; ?>

        <!-- Filter tabs -->
        <div class="filter-tabs mb-4">
            <a href="?filter=all"      class="ftab <?php echo (!isset($_GET['filter']) || $_GET['filter']=='all')     ? 'active' : ''; ?>">All Providers</a>
            <a href="?filter=pending"  class="ftab <?php echo (isset($_GET['filter']) && $_GET['filter']=='pending')  ? 'active' : ''; ?>">Pending</a>
            <a href="?filter=approved" class="ftab <?php echo (isset($_GET['filter']) && $_GET['filter']=='approved') ? 'active' : ''; ?>">Approved</a>
            <a href="?filter=rejected" class="ftab <?php echo (isset($_GET['filter']) && $_GET['filter']=='rejected') ? 'active' : ''; ?>">Rejected</a>
        </div>

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
                        <?php foreach ($providers as $p): ?>
                        <tr>
                            <td><?php echo $p['id']; ?></td>
                            <td>
                                <strong><?php echo htmlspecialchars($p['org_name']); ?></strong>
                                <br><small class="text-muted"><?php echo htmlspecialchars($p['description']); ?></small>
                            </td>
                            <td><?php echo htmlspecialchars($p['email']); ?></td>
                            <td><?php echo htmlspecialchars($p['phone']); ?></td>
                            <td><?php echo htmlspecialchars($p['address']); ?></td>
                            <td><?php echo $p['date']; ?></td>
                            <td>
                                <?php if ($p['status'] == 'pending'): ?>
                                    <span class="status-pending">Pending</span>
                                <?php elseif ($p['status'] == 'approved'): ?>
                                    <span class="status-approved">Approved</span>
                                <?php else: ?>
                                    <span class="status-rejected">Rejected</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($p['status'] == 'pending'): ?>
                                    <a href="?action=approve&id=<?php echo $p['id']; ?>" class="btn-approve" onclick="return confirm('Approve this provider?')">
                                        <i class="fas fa-check mr-1"></i> Approve
                                    </a>
                                    <a href="?action=reject&id=<?php echo $p['id']; ?>" class="btn-reject ml-1" onclick="return confirm('Reject this provider?')">
                                        <i class="fas fa-times mr-1"></i> Reject
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted" style="font-size:12px;">Processed</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
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
