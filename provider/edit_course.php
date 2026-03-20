<?php

// Start session to access stored user data
session_start();

// Redirect to login if user is not logged in or is not a provider
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'provider') {
    header('Location: ../auth/login.php'); exit();
}

// Get provider name from session; default to 'Provider' if not set
$provider_name = $_SESSION['user_name'] ?? 'Provider';

// Placeholder courses (replace with DB query later)
$courses = [
    ['id' => 1, 'title' => 'Full Stack Web Development', 'category' => 'Programming', 'duration' => '8 Weeks', 'price' => 'RM 800', 'students' => 18, 'status' => 'approved'],
    ['id' => 2, 'title' => 'PHP for Beginners',          'category' => 'Programming', 'duration' => '4 Weeks', 'price' => 'RM 400', 'students' => 12, 'status' => 'approved'],
    ['id' => 3, 'title' => 'JavaScript Essentials',      'category' => 'Programming', 'duration' => '3 Weeks', 'price' => 'RM 350', 'students' => 4,  'status' => 'pending'],
];

// Show success message if a course was just deleted via URL parameter
$action_msg = '';
if (isset($_GET['delete'])) {
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

    <!-- Sidebar Navigation -->
    <aside class="dash-sidebar provider-sidebar">
        <div class="dsb-brand">
            <a href="../index.php">
                <img src="../images/logo.png" alt="Logo" style="width:32px;height:32px;border-radius:8px;object-fit:cover;">
                <span class="dsb-brand-text">EDU<span class="dsb-brand-accent">SKILL</span></span>
            </a>
        </div>
        <div class="dsb-role-badge provider-role-badge">
            <i class="fas fa-building mr-2"></i> Training Provider
        </div>
        <nav class="dsb-nav">
            <a href="dashboard.php" class="dsb-link"><i class="fas fa-th-large"></i> Dashboard</a>
            <a href="add_course.php" class="dsb-link"><i class="fas fa-plus-circle"></i> Add Course</a>
            <a href="edit_course.php" class="dsb-link active"><i class="fas fa-edit"></i> Manage Courses</a>
            <a href="course_students.php" class="dsb-link"><i class="fas fa-users"></i> Enrolled Students</a>
        </nav>
        <div class="dsb-bottom">
            <!-- Display first letter of provider's name as avatar -->
            <div class="dsb-user-info">
                <div class="dsb-avatar provider-avatar"><?php echo strtoupper(substr($provider_name,0,1)); ?></div>
                <div><strong><?php echo htmlspecialchars($provider_name); ?></strong><span>Provider</span></div>
            </div>
            <a href="../auth/logout.php" class="dsb-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </aside>

    <!-- Main Content Area -->
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

        <!-- Display delete confirmation message if present -->
        <?php echo $action_msg; ?>

        <!-- Courses management table -->
        <div class="dash-card">
            <div class="dash-table-wrap">
                <table class="table dash-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Course Title</th>
                            <th>Category</th>
                            <th>Duration</th>
                            <th>Price</th>
                            <th>Students</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($courses as $c): ?>
                        <tr>
                            <td><?php echo $c['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($c['title']); ?></strong></td>
                            <td><?php echo $c['category']; ?></td>
                            <td><?php echo $c['duration']; ?></td>
                            <td><?php echo $c['price']; ?></td>
                            <td><?php echo $c['students']; ?></td>
                            <td>
                                <!-- Show approval status badge -->
                                <?php if ($c['status'] == 'approved'): ?>
                                    <span class="status-approved">Active</span>
                                <?php else: ?>
                                    <span class="status-pending">Pending</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <!-- Edit passes course ID; delete triggers JS confirm before proceeding -->
                                <a href="add_course.php?edit=<?php echo $c['id']; ?>" class="btn-course-edit"><i class="fas fa-edit mr-1"></i>Edit</a>
                                <a href="delete_course.php?id=<?php echo $c['id']; ?>" class="btn-course-delete ml-1" onclick="return confirmDelete(<?php echo $c['id']; ?>)"><i class="fas fa-trash mr-1"></i>Delete</a>
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
<!-- Custom JS including confirmDelete() function -->
<script src="../js/archana.js"></script>
</body>
</html>