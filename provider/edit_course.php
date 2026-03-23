<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'provider') {
    header('Location: ../auth/login.php'); exit();
}

$provider_id   = $_SESSION['user_id'];
$provider_name = $_SESSION['user_name'] ?? 'Provider';
$action_msg    = '';

// Get all courses for this provider
$result = mysqli_query($conn, "
    SELECT c.*, (SELECT COUNT(*) FROM enrollments WHERE course_id=c.id) as enroll_count
    FROM courses c
    WHERE c.provider_id = $provider_id
    ORDER BY c.created_at DESC
");

if (isset($_GET['deleted'])) {
    $action_msg = '<div class="alert alert-success">Course deleted successfully.</div>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses - EduSkill Provider</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
            <a href="edit_course.php" class="dsb-link active"><i class="fas fa-edit"></i> Manage Courses</a>
            <a href="course_students.php" class="dsb-link"><i class="fas fa-users"></i> Enrolled Students</a>
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
                <h4 class="dash-page-title">Manage Courses</h4>
                <p class="dash-page-sub">View, edit or delete your listed courses</p>
            </div>
            <div class="dash-topbar-right">
                <a href="add_course.php" class="btn-dash-primary btn-dash-green"><i class="fas fa-plus mr-1"></i> Add New Course</a>
            </div>
        </div>

        <?php echo $action_msg; ?>

        <div class="dash-card">
            <div class="dash-table-wrap">
                <table class="table dash-table">
                    <thead>
                        <tr><th>#</th><th>Course Title</th><th>Category</th><th>Duration</th><th>Price</th><th>Enrollments</th><th>Status</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        <?php while($c = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $c['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($c['title']); ?></strong></td>
                            <td><?php echo htmlspecialchars($c['category']); ?></td>
                            <td><?php echo htmlspecialchars($c['duration']); ?></td>
                            <td>RM <?php echo number_format($c['price'], 2); ?></td>
                            <td><?php echo $c['enroll_count']; ?></td>
                            <td>
                                <?php if($c['status']=='approved'): ?>
                                    <span class="status-approved">Active</span>
                                <?php elseif($c['status']=='pending'): ?>
                                    <span class="status-pending">Pending</span>
                                <?php else: ?>
                                    <span class="status-rejected">Rejected</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="add_course.php?edit=<?php echo $c['id']; ?>" class="btn-course-edit"><i class="fas fa-edit mr-1"></i>Edit</a>
                                <a href="delete_course.php?id=<?php echo $c['id']; ?>" class="btn-course-delete ml-1" onclick="return confirmDelete(<?php echo $c['id']; ?>)"><i class="fas fa-trash mr-1"></i>Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        <?php if(mysqli_num_rows($result) == 0): ?>
                        <tr><td colspan="8" class="text-center text-muted py-4">No courses yet. <a href="add_course.php">Add your first course</a>.</td></tr>
                        <?php endif; ?>
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
