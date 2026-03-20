<?php
// admin/manage_courses.php

session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: ../auth/login.php'); exit();
}

// Placeholder data
$courses = [
    ['id'=>1,'title'=>'Full Stack Web Development','provider'=>'Tech Academy MY',   'category'=>'Programming','duration'=>'8 Weeks','students'=>18,'status'=>'approved'],
    ['id'=>2,'title'=>'Data Science & Analytics',  'provider'=>'DataSkill Institute','category'=>'Data Science','duration'=>'6 Weeks','students'=>12,'status'=>'approved'],
    ['id'=>3,'title'=>'UI/UX Design Fundamentals', 'provider'=>'Creative Hub KL',   'category'=>'Design',      'duration'=>'4 Weeks','students'=>8, 'status'=>'approved'],
    ['id'=>4,'title'=>'Digital Marketing',         'provider'=>'BizPro Academy',     'category'=>'Business',    'duration'=>'3 Weeks','students'=>5, 'status'=>'pending'],
    ['id'=>5,'title'=>'PHP for Beginners',         'provider'=>'Tech Academy MY',    'category'=>'Programming', 'duration'=>'4 Weeks','students'=>4, 'status'=>'approved'],
];

$action_msg = '';
if (isset($_GET['action'])) {
    $action_msg = '<div class="alert alert-success">Course status updated successfully.</div>';
}
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
            <a href="approve_providers.php" class="dsb-link"><i class="fas fa-building"></i> Provider Approvals</a>
            <a href="approve_enrollments.php" class="dsb-link"><i class="fas fa-user-check"></i> Enrollments</a>
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
                <p class="dash-page-sub">View all courses listed by training providers</p>
            </div>
        </div>

        <?php echo $action_msg; ?>

        <!-- Stats row -->
        <div class="row mb-4">
            <div class="col-6 col-lg-3 mb-3">
                <div class="dstat-card">
                    <div class="dstat-icon" style="background:#dbeafe;color:#1d4ed8;"><i class="fas fa-book-open"></i></div>
                    <div class="dstat-info"><h3><?php echo count($courses); ?></h3><p>Total Courses</p></div>
                </div>
            </div>
            <div class="col-6 col-lg-3 mb-3">
                <div class="dstat-card">
                    <div class="dstat-icon" style="background:#dcfce7;color:#15803d;"><i class="fas fa-check-circle"></i></div>
                    <div class="dstat-info"><h3><?php echo count(array_filter($courses, fn($c) => $c['status']=='approved')); ?></h3><p>Active Courses</p></div>
                </div>
            </div>
            <div class="col-6 col-lg-3 mb-3">
                <div class="dstat-card">
                    <div class="dstat-icon" style="background:#ffedd5;color:#c2410c;"><i class="fas fa-clock"></i></div>
                    <div class="dstat-info"><h3><?php echo count(array_filter($courses, fn($c) => $c['status']=='pending')); ?></h3><p>Pending Review</p></div>
                </div>
            </div>
            <div class="col-6 col-lg-3 mb-3">
                <div class="dstat-card">
                    <div class="dstat-icon" style="background:#fce7f3;color:#be185d;"><i class="fas fa-users"></i></div>
                    <div class="dstat-info"><h3><?php echo array_sum(array_column($courses,'students')); ?></h3><p>Total Enrollments</p></div>
                </div>
            </div>
        </div>

        <div class="dash-card">
            <div class="dash-card-head">
                <h5>All Courses</h5>
            </div>
            <div class="dash-table-wrap">
                <table class="table dash-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Course Title</th>
                            <th>Provider</th>
                            <th>Category</th>
                            <th>Duration</th>
                            <th>Students</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($courses as $c): ?>
                        <tr>
                            <td><?php echo $c['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($c['title']); ?></strong></td>
                            <td><?php echo htmlspecialchars($c['provider']); ?></td>
                            <td><?php echo $c['category']; ?></td>
                            <td><?php echo $c['duration']; ?></td>
                            <td><?php echo $c['students']; ?></td>
                            <td>
                                <?php if ($c['status']=='approved'): ?>
                                    <span class="status-approved">Active</span>
                                <?php else: ?>
                                    <span class="status-pending">Pending</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($c['status']=='pending'): ?>
                                    <a href="?action=approve&id=<?php echo $c['id']; ?>" class="btn-approve" onclick="return confirm('Approve this course?')">
                                        <i class="fas fa-check mr-1"></i>Approve
                                    </a>
                                <?php else: ?>
                                    <a href="?action=disable&id=<?php echo $c['id']; ?>" class="btn-reject" onclick="return confirm('Disable this course?')">
                                        <i class="fas fa-ban mr-1"></i>Disable
                                    </a>
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
