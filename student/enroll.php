<?php

// Start session to access stored user data
session_start();

// Redirect to login if user is not logged in or is not a student
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'student') {
    header('Location: ../auth/login.php'); exit();
}

// Get student name from session; default to 'Student' if not set
$student_name = $_SESSION['user_name'] ?? 'Student';

// Get course ID from URL parameter; default to 1 if not provided
$course_id    = $_GET['id'] ?? 1;
$success      = '';
$error        = '';

// Placeholder course data (replace with DB query later)
$courses = [
    1 => ['id' => 1, 'title' => 'Full Stack Web Development', 'provider' => 'Tech Academy MY',    'duration' => '8 Weeks', 'category' => 'Programming', 'description' => 'Learn HTML, CSS, JavaScript, PHP and MySQL from scratch. Build real projects with guidance from industry experts.', 'image' => '../images/webdevelopment.jpg'],
    2 => ['id' => 2, 'title' => 'Data Science & Analytics',   'provider' => 'DataSkill Institute', 'duration' => '6 Weeks', 'category' => 'Data Science', 'description' => 'Master data analysis, visualization and machine learning fundamentals with Python.', 'image' => '../images/datascience.jpg'],
    3 => ['id' => 3, 'title' => 'UI/UX Design Fundamentals',  'provider' => 'Creative Hub KL',     'duration' => '4 Weeks', 'category' => 'Design',       'description' => 'Learn user interface and user experience design principles using industry tools.', 'image' => '../images/uiuxdesign.jpg'],
];

// Select the course matching the URL id; fallback to course 1 if not found
$course = $courses[$course_id] ?? $courses[1];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Placeholder - will connect to database in Day 9
    $success = 'Your enrollment request has been submitted successfully! The Ministry officer will review and approve your request. You can track the status in My Enrollments.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll - EduSkill</title>
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
            <a href="courses.php" class="dsb-link active"><i class="fas fa-book-open"></i> Browse Courses</a>
            <a href="my_courses.php" class="dsb-link"><i class="fas fa-graduation-cap"></i> My Enrollments</a>
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
                <h4 class="dash-page-title">Enroll in Course</h4>
                <p class="dash-page-sub">Submit your enrollment request for admin approval</p>
            </div>
        </div>

        <!-- Show success message after form submission -->
        <?php if ($success): ?>
            <div class="alert alert-success mb-4">
                <i class="fas fa-check-circle mr-2"></i><?php echo $success; ?>
                <div class="mt-2">
                    <a href="my_courses.php" class="btn-dash-primary" style="font-size:13px; padding:7px 14px;">View My Enrollments</a>
                </div>
            </div>
        <?php endif; ?>

        <div class="row">
            <!-- Course details panel -->
            <div class="col-lg-5 mb-4">
                <div class="dash-card">
                    <div class="enroll-course-img">
                        <img src="<?php echo $course['image']; ?>" alt="<?php echo htmlspecialchars($course['title']); ?>">
                    </div>
                    <div class="p-3">
                        <span class="course-cat"><?php echo $course['category']; ?></span>
                        <h5 class="mt-2 mb-2"><?php echo htmlspecialchars($course['title']); ?></h5>
                        <p class="text-muted" style="font-size:14px;"><?php echo $course['description']; ?></p>
                        <div class="enroll-course-meta">
                            <div><i class="fas fa-building mr-1"></i><?php echo htmlspecialchars($course['provider']); ?></div>
                            <div><i class="fas fa-clock mr-1"></i><?php echo $course['duration']; ?></div>
                            <div><i class="fas fa-certificate mr-1"></i>Ministry Certified</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enrollment form panel -->
            <div class="col-lg-7">
                <div class="dash-card p-4">
                    <h5 class="mb-1">Confirm Enrollment</h5>
                    <p class="text-muted mb-4" style="font-size:14px;">Your request will be reviewed by a Ministry officer before it is approved.</p>

                    <?php if (!$success): // Only show form if not yet submitted ?>
                    <form method="POST" action="">
                        <!-- Read-only fields pre-filled from session and course data -->
                        <div class="form-group">
                            <label class="cf-label">Full Name</label>
                            <input type="text" class="form-control cf-input" value="<?php echo htmlspecialchars($student_name); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label class="cf-label">Course</label>
                            <input type="text" class="form-control cf-input" value="<?php echo htmlspecialchars($course['title']); ?>" readonly>
                            <!-- Hidden field to pass course ID on form submit -->
                            <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                        </div>
                        <div class="form-group">
                            <label class="cf-label">Provider</label>
                            <input type="text" class="form-control cf-input" value="<?php echo htmlspecialchars($course['provider']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label class="cf-label">Additional Notes (Optional)</label>
                            <textarea name="notes" class="form-control cf-input" rows="3" placeholder="Any additional information for the Ministry officer..."></textarea>
                        </div>

                        <div class="enroll-notice mb-3">
                            <i class="fas fa-info-circle mr-2"></i>
                            By submitting this form you are requesting enrollment. A Ministry officer will review and approve your request within 1-2 business days.
                        </div>

                        <button type="submit" class="btn-main">
                            <i class="fas fa-paper-plane mr-2"></i> Submit Enrollment Request
                        </button>
                        <a href="courses.php" class="btn btn-outline-secondary ml-2" style="border-radius:8px;">Cancel</a>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>