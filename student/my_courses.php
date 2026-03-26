<?php
// student/my_courses.php
// Responsible: Shreeyash Pandey
// Updated — View Receipt button for approved enrollments

session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'student') {
    header('Location: ../auth/login.php'); exit();
}

$student_id   = $_SESSION['user_id'];
$student_name = $_SESSION['user_name'] ?? 'Student';

$result = mysqli_query($conn, "
    SELECT
        e.id,
        e.status,
        e.enrolled_at,
        e.notes,
        c.id   as course_id,
        c.title as course,
        c.duration,
        c.category,
        c.price,
        p.org_name as provider,
        (SELECT rating FROM ratings WHERE student_id=$student_id AND course_id=c.id LIMIT 1) as my_rating,
        (SELECT ROUND(AVG(rating),1) FROM ratings WHERE course_id=c.id) as avg_rating,
        (SELECT COUNT(*) FROM ratings WHERE course_id=c.id) as total_ratings
    FROM enrollments e
    JOIN courses c  ON e.course_id  = c.id
    JOIN providers p ON c.provider_id = p.id
    WHERE e.student_id = $student_id
    ORDER BY e.enrolled_at DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Enrollments - EduSkill</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/pasang.css">
    <link rel="stylesheet" href="../css/shreeyash.css">
</head>
<body class="dashboard-body">
<div class="dashboard-wrap">

    <!-- SIDEBAR -->
    <aside class="dash-sidebar">
        <div class="dsb-brand">
            <a href="../index.php">
                <img src="../images/logo.png" alt="Logo"
                     class="dsb-brand-img"
                     onerror="this.style.display='none'">
                <span class="dsb-brand-text ml-2">EDU<span class="dsb-brand-accent">SKILL</span></span>
            </a>
        </div>
        <div class="dsb-role-badge student-role-badge">
            <i class="fas fa-user-graduate mr-2"></i> Student
        </div>
        <nav class="dsb-nav">
            <a href="dashboard.php"  class="dsb-link"><i class="fas fa-th-large"></i> Dashboard</a>
            <a href="courses.php"    class="dsb-link"><i class="fas fa-book-open"></i> Browse Courses</a>
            <a href="my_courses.php" class="dsb-link active"><i class="fas fa-graduation-cap"></i> My Enrollments</a>
        </nav>
        <div class="dsb-bottom">
            <div class="dsb-user-info">
                <div class="dsb-avatar"><?php echo strtoupper(substr($student_name,0,1)); ?></div>
                <div>
                    <strong><?php echo htmlspecialchars($student_name); ?></strong>
                    <span>Student</span>
                </div>
            </div>
            <a href="../auth/logout.php" class="dsb-logout">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="dash-main">
        <div class="dash-topbar">
            <div>
                <h4 class="dash-page-title">My Enrollments</h4>
                <p class="dash-page-sub">Track your courses and download receipts</p>
            </div>
            <div class="dash-topbar-right">
                <a href="courses.php" class="btn-dash-primary">
                    <i class="fas fa-search mr-1"></i> Browse More Courses
                </a>
            </div>
        </div>

        <div class="dash-content">

            <!-- Info box -->
            <div class="enrollment-info-box mb-4">
                <div class="eib-item">
                    <i class="fas fa-info-circle"></i>
                    <div>
                        <strong>How it works</strong>
                        <p>After enrolling, a Ministry officer reviews and approves your request. Once approved you can view your receipt and rate the course.</p>
                    </div>
                </div>
            </div>

            <div class="dash-card">
                <div class="dash-card-head">
                    <h5>My Course Enrollments</h5>
                    <a href="courses.php" class="dash-card-link">Browse Courses</a>
                </div>
                <div class="dash-table-wrap">
                    <table class="table dash-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Course</th>
                                <th>Provider</th>
                                <th>Duration</th>
                                <th>Fee</th>
                                <th>Enrolled On</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) == 0): ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    <i class="fas fa-graduation-cap" style="font-size:32px;color:#d1d5db;display:block;margin-bottom:10px;"></i>
                                    No enrollments yet.
                                    <a href="courses.php">Browse courses to enroll.</a>
                                </td>
                            </tr>
                            <?php endif; ?>

                            <?php while ($e = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $e['id']; ?></td>
                                <td>
                                    <strong><?php echo htmlspecialchars($e['course']); ?></strong><br>
                                    <small class="text-muted"><?php echo htmlspecialchars($e['category']); ?></small>
                                </td>
                                <td><?php echo htmlspecialchars($e['provider']); ?></td>
                                <td><?php echo htmlspecialchars($e['duration']); ?></td>
                                <td>
                                    <?php if ($e['price'] > 0): ?>
                                        <strong>RM <?php echo number_format($e['price'], 2); ?></strong>
                                    <?php else: ?>
                                        <span class="status-approved">Free</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo date('d M Y', strtotime($e['enrolled_at'])); ?></td>
                                <td>
                                    <?php if ($e['status'] === 'pending'): ?>
                                        <span class="status-pending">
                                            <i class="fas fa-clock mr-1"></i>Pending
                                        </span>
                                    <?php elseif ($e['status'] === 'approved'): ?>
                                        <span class="status-approved">
                                            <i class="fas fa-check-circle mr-1"></i>Approved
                                        </span>
                                    <?php elseif ($e['status'] === 'completed'): ?>
                                        <span class="status-completed">
                                            <i class="fas fa-certificate mr-1"></i>Completed
                                        </span>
                                    <?php else: ?>
                                        <span class="status-rejected">
                                            <i class="fas fa-times-circle mr-1"></i>Rejected
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="my-courses-actions">
                                        <?php if ($e['status'] === 'approved' || $e['status'] === 'completed'): ?>

                                            <!-- VIEW RECEIPT BUTTON -->
                                            <a href="receipt.php?id=<?php echo $e['id']; ?>"
                                               class="btn-view-receipt">
                                                <i class="fas fa-file-invoice mr-1"></i>Receipt
                                            </a>

                                            <!-- RATE COURSE BUTTON -->
                                            <a href="rate_course.php?id=<?php echo $e['course_id']; ?>"
                                               class="<?php echo $e['my_rating'] ? 'btn-edit-rating' : 'btn-rate-course'; ?>">
                                                <i class="fas fa-star mr-1"></i>
                                                <?php echo $e['my_rating'] ? 'Edit Rating' : 'Rate'; ?>
                                            </a>

                                        <?php elseif ($e['status'] === 'pending'): ?>
                                            <span class="my-courses-waiting">
                                                <i class="fas fa-hourglass-half mr-1"></i>Awaiting approval
                                            </span>
                                        <?php else: ?>
                                            <span class="text-muted" style="font-size:12px;">—</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../js/shreeyash.js"></script>
</body>
</html>
