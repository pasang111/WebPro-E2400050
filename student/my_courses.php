<?php

// Start session to access stored user data
session_start();

// Redirect to login if user is not logged in or is not a student
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'student') {
    header('Location: ../auth/login.php'); exit();
}

// Get student's name from session, default to 'Student' if not set
$student_name = $_SESSION['user_name'] ?? 'Student';

// Placeholder enrollment data (replace with actual DB query later)
$my_enrollments = [
    ['id' => 1, 'course' => 'Full Stack Web Development', 'provider' => 'Tech Academy MY',    'duration' => '8 Weeks', 'enrolled_date' => '2026-03-12', 'status' => 'approved'],
    ['id' => 2, 'course' => 'Data Science & Analytics',   'provider' => 'DataSkill Institute', 'duration' => '6 Weeks', 'enrolled_date' => '2026-03-13', 'status' => 'pending'],
    ['id' => 3, 'course' => 'UI/UX Design Fundamentals',  'provider' => 'Creative Hub KL',     'duration' => '4 Weeks', 'enrolled_date' => '2026-03-08', 'status' => 'completed'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Enrollments - EduSkill</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/pasang.css">
    <link rel="stylesheet" href="../css/shreeyash.css">
</head>
<body class="dashboard-body">
<div class="dashboard-wrap">

    <!-- Sidebar Navigation -->
    <aside class="dash-sidebar student-sidebar">
        <div class="dsb-brand">
            <a href="../index.php">
                <img src="../images/logo.png" alt="Logo" style="width:32px;height:32px;border-radius:8px;object-fit:cover;">
                <span class="dsb-brand-text">EDU<span class="dsb-brand-accent">SKILL</span></span>
            </a>
        </div>
        <div class="dsb-role-badge student-role-badge">
            <i class="fas fa-user-graduate mr-2"></i> Student
        </div>
        <nav class="dsb-nav">
            <a href="dashboard.php" class="dsb-link"><i class="fas fa-th-large"></i> Dashboard</a>
            <a href="courses.php" class="dsb-link"><i class="fas fa-book-open"></i> Browse Courses</a>
            <a href="my_courses.php" class="dsb-link active"><i class="fas fa-graduation-cap"></i> My Enrollments</a>
        </nav>
        <div class="dsb-bottom">
            <!-- Display first letter of student's name as avatar -->
            <div class="dsb-user-info">
                <div class="dsb-avatar"><?php echo strtoupper(substr($student_name,0,1)); ?></div>
                <div><strong><?php echo htmlspecialchars($student_name); ?></strong><span>Student</span></div>
            </div>
            <a href="../auth/logout.php" class="dsb-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="dash-main">
        <div class="dash-topbar">
            <div>
                <h4 class="dash-page-title">My Enrollments</h4>
                <p class="dash-page-sub">Track your course enrollment status</p>
            </div>
            <div class="dash-topbar-right">
                <a href="courses.php" class="btn-dash-primary"><i class="fas fa-search mr-1"></i> Browse More Courses</a>
            </div>
        </div>

        <!-- Info box explaining the enrollment approval process -->
        <div class="enrollment-info-box mb-4">
            <div class="eib-item">
                <i class="fas fa-info-circle"></i>
                <div>
                    <strong>How enrollment works</strong>
                    <p>After you enroll in a course, the Ministry officer will review and approve your request. You will see the status update here.</p>
                </div>
            </div>
        </div>

        <!-- Enrollments Table -->
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
                            <th>Enrolled On</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($my_enrollments as $e): ?>
                        <tr>
                            <td><?php echo $e['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($e['course']); ?></strong></td>
                            <td><?php echo htmlspecialchars($e['provider']); ?></td>
                            <td><?php echo $e['duration']; ?></td>
                            <td><?php echo $e['enrolled_date']; ?></td>
                            <td>
                                <?php // Display colored status badge based on enrollment status ?>
                                <?php if ($e['status'] == 'pending'): ?>
                                    <span class="status-pending"><i class="fas fa-clock mr-1"></i>Pending Approval</span>
                                <?php elseif ($e['status'] == 'approved'): ?>
                                    <span class="status-approved"><i class="fas fa-check-circle mr-1"></i>Approved</span>
                                <?php elseif ($e['status'] == 'completed'): ?>
                                    <span class="status-completed"><i class="fas fa-certificate mr-1"></i>Completed</span>
                                <?php else: ?>
                                    <span class="status-rejected"><i class="fas fa-times-circle mr-1"></i>Rejected</span>
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