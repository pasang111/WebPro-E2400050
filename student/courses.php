<?php

session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'student') {
    header('Location: ../auth/login.php'); exit();
}

$student_id   = $_SESSION['user_id'];
$student_name = $_SESSION['user_name'] ?? 'Student';

// Get approved courses from database
$result = mysqli_query($conn, "
    SELECT c.*, p.org_name as provider_name
    FROM courses c
    JOIN providers p ON c.provider_id = p.id
    WHERE c.status = 'approved'
    ORDER BY c.created_at DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Courses - EduSkill</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/pasang.css">
    <link rel="stylesheet" href="../css/shreeyash.css">
</head>
<body class="dashboard-body">
<div class="dashboard-wrap">

    <aside class="dash-sidebar student-sidebar">
        <div class="dsb-brand">
            <a href="../index.php">
                <img src="../images/logo.png" alt="Logo" style="width:32px;height:32px;border-radius:8px;object-fit:cover;">
                <span class="dsb-brand-text">EDU<span class="dsb-brand-accent">SKILL</span></span>
            </a>
        </div>
        <div class="dsb-role-badge student-role-badge"><i class="fas fa-user-graduate mr-2"></i> Student</div>
        <nav class="dsb-nav">
            <a href="dashboard.php" class="dsb-link"><i class="fas fa-th-large"></i> Dashboard</a>
            <a href="courses.php" class="dsb-link active"><i class="fas fa-book-open"></i> Browse Courses</a>
            <a href="my_courses.php" class="dsb-link"><i class="fas fa-graduation-cap"></i> My Enrollments</a>
        </nav>
        <div class="dsb-bottom">
            <div class="dsb-user-info">
                <div class="dsb-avatar"><?php echo strtoupper(substr($student_name,0,1)); ?></div>
                <div><strong><?php echo htmlspecialchars($student_name); ?></strong><span>Student</span></div>
            </div>
            <a href="../auth/logout.php" class="dsb-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </aside>

    <main class="dash-main">
        <div class="dash-topbar">
            <div>
                <h4 class="dash-page-title">Browse Courses</h4>
                <p class="dash-page-sub">Find and enroll in certified courses from approved providers</p>
            </div>
        </div>

        <div class="row">
            <?php while($c = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="course-card">
                    <div class="course-img" style="background:linear-gradient(135deg,#0056d2,#003d99); height:160px; display:flex; align-items:center; justify-content:center; font-size:42px; color:rgba(255,255,255,0.5);">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div class="course-body">
                        <span class="course-cat"><?php echo htmlspecialchars($c['category']); ?></span>
                        <h5 class="course-title"><?php echo htmlspecialchars($c['title']); ?></h5>
                        <p class="course-provider"><i class="fas fa-building mr-1"></i><?php echo htmlspecialchars($c['provider_name']); ?></p>
                        <p class="text-muted" style="font-size:13px; margin-bottom:12px;"><?php echo htmlspecialchars(substr($c['description'],0,80)); ?>...</p>
                        <div class="course-footer">
                            <span class="course-dur"><i class="fas fa-clock mr-1"></i><?php echo htmlspecialchars($c['duration']); ?></span>
                            <a href="enroll.php?id=<?php echo $c['id']; ?>" class="btn-enroll">Enroll Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
            <?php if(mysqli_num_rows($result) == 0): ?>
            <div class="col-12 text-center py-5 text-muted">No courses available yet.</div>
            <?php endif; ?>
        </div>
    </main>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
