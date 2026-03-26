<?php

$provider_name    = $_SESSION['user_name'] ?? 'Provider';
$provider_id_s    = $_SESSION['user_id'] ?? 0;
$current_file     = basename($_SERVER['PHP_SELF']);

// Get pending enrollments count for badge
$pending_badge = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT COUNT(*) as c FROM enrollments e
     JOIN courses c ON e.course_id=c.id
     WHERE c.provider_id=$provider_id_s AND e.status='pending'"))['c'] ?? 0;
?>
<aside class="dash-sidebar provider-sidebar">
    <div class="dsb-brand">
        <a href="../index.php">
            <img src="../images/logo.png" alt="Logo" class="dsb-brand-img" onerror="this.style.display='none'">
            <span class="dsb-brand-text ml-2">EDU<span class="dsb-brand-accent">SKILL</span></span>
        </a>
    </div>

    <div class="dsb-role-badge provider-role-badge">
        <i class="fas fa-building mr-2"></i> Training Provider
    </div>

    <nav class="dsb-nav">
        <a href="dashboard.php"
           class="dsb-link <?php echo $current_file === 'dashboard.php' ? 'active' : ''; ?>">
            <i class="fas fa-th-large"></i> Dashboard
        </a>
        <a href="add_course.php"
           class="dsb-link <?php echo $current_file === 'add_course.php' ? 'active' : ''; ?>">
            <i class="fas fa-plus-circle"></i> Add Course
        </a>
        <a href="edit_course.php"
           class="dsb-link <?php echo $current_file === 'edit_course.php' ? 'active' : ''; ?>">
            <i class="fas fa-edit"></i> Manage Courses
        </a>
        <a href="course_students.php"
           class="dsb-link <?php echo $current_file === 'course_students.php' ? 'active' : ''; ?>">
            <i class="fas fa-users"></i> Enrolled Students
            <?php if ($pending_badge > 0): ?>
                <span class="dsb-badge"><?php echo $pending_badge; ?></span>
            <?php endif; ?>
        </a>
        <a href="analytics.php"
           class="dsb-link <?php echo $current_file === 'analytics.php' ? 'active' : ''; ?>">
            <i class="fas fa-chart-bar"></i> Analytics
        </a>
    </nav>

    <div class="dsb-bottom">
        <div class="dsb-user-info">
            <div class="dsb-avatar provider-avatar">
                <?php echo strtoupper(substr($provider_name, 0, 1)); ?>
            </div>
            <div>
                <strong><?php echo htmlspecialchars($provider_name); ?></strong>
                <span>Provider</span>
            </div>
        </div>
        <a href="../auth/logout.php" class="dsb-logout">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</aside>
