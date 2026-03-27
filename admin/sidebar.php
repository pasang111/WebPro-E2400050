<?php
$current_file = basename($_SERVER['PHP_SELF']);

$pending_providers   = 0;
$pending_enrollments = 0;
$pending_courses     = 0;

if (isset($conn) && $conn) {
    $r = mysqli_query($conn, "SELECT COUNT(*) as c FROM providers WHERE status='pending'");
    if ($r) $pending_providers = (int)(mysqli_fetch_assoc($r)['c'] ?? 0);

    $r = mysqli_query($conn, "SELECT COUNT(*) as c FROM enrollments WHERE status='pending'");
    if ($r) $pending_enrollments = (int)(mysqli_fetch_assoc($r)['c'] ?? 0);

    $r = mysqli_query($conn, "SELECT COUNT(*) as c FROM courses WHERE status='pending'");
    if ($r) $pending_courses = (int)(mysqli_fetch_assoc($r)['c'] ?? 0);
}
?>
<aside class="dash-sidebar admin-sidebar">

    <div class="dsb-brand">
        <a href="../index.php">
            <img src="../images/logo.png" alt="Logo" class="dsb-brand-img" onerror="this.style.display='none'">
            <span class="dsb-brand-text ml-2">EDU<span class="dsb-brand-accent">SKILL</span></span>
        </a>
    </div>

    <div class="dsb-role-badge">
        <i class="fas fa-user-shield mr-2"></i> Ministry Officer
    </div>

    <nav class="dsb-nav">

        <a href="dashboard.php" class="dsb-link <?php echo ($current_file === 'dashboard.php') ? 'active' : ''; ?>">
            <i class="fas fa-th-large"></i> Dashboard
        </a>

        <a href="approve_providers.php" class="dsb-link <?php echo ($current_file === 'approve_providers.php') ? 'active' : ''; ?>">
            <i class="fas fa-building"></i> Provider Approvals
            <?php if ($pending_providers > 0): ?>
                <span class="dsb-badge"><?php echo $pending_providers; ?></span>
            <?php endif; ?>
        </a>

        <a href="approve_enrollments.php" class="dsb-link <?php echo ($current_file === 'approve_enrollments.php') ? 'active' : ''; ?>">
            <i class="fas fa-user-check"></i> Enrollments
            <?php if ($pending_enrollments > 0): ?>
                <span class="dsb-badge"><?php echo $pending_enrollments; ?></span>
            <?php endif; ?>
        </a>

        <a href="manage_courses.php" class="dsb-link <?php echo ($current_file === 'manage_courses.php') ? 'active' : ''; ?>">
            <i class="fas fa-book-open"></i> Courses
            <?php if ($pending_courses > 0): ?>
                <span class="dsb-badge"><?php echo $pending_courses; ?></span>
            <?php endif; ?>
        </a>

        <a href="analytics.php" class="dsb-link <?php echo ($current_file === 'analytics.php') ? 'active' : ''; ?>">
            <i class="fas fa-chart-bar"></i> Analytics
        </a>

    </nav>

    <div class="dsb-bottom">
        <a href="../auth/logout.php" class="dsb-logout">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>

</aside>
