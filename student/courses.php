<?php

// Start session to access stored user data
session_start();

// Redirect to login if user is not logged in or is not a student
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'student') {
    header('Location: ../auth/login.php'); exit();
}

// Get student name from session; default to 'Student' if not set
$student_name = $_SESSION['user_name'] ?? 'Student';

// Placeholder course data - will be replaced with database in Day 9
$courses = [
    ['id' => 1, 'title' => 'Full Stack Web Development', 'provider' => 'Tech Academy MY',    'category' => 'Programming', 'duration' => '8 Weeks', 'rating' => 4.8, 'reviews' => 240, 'image' => '../images/webdevelopment.jpg'],
    ['id' => 2, 'title' => 'Data Science & Analytics',   'provider' => 'DataSkill Institute', 'category' => 'Data Science', 'duration' => '6 Weeks', 'rating' => 5.0, 'reviews' => 98,  'image' => '../images/datascience.jpg'],
    ['id' => 3, 'title' => 'UI/UX Design Fundamentals',  'provider' => 'Creative Hub KL',     'category' => 'Design',       'duration' => '4 Weeks', 'rating' => 4.0, 'reviews' => 75,  'image' => '../images/uiuxdesign.jpg'],
    ['id' => 4, 'title' => 'Digital Marketing Essentials','provider' => 'BizPro Academy',     'category' => 'Business',     'duration' => '3 Weeks', 'rating' => 4.6, 'reviews' => 110, 'image' => '../images/webdevelopment.jpg'],
    ['id' => 5, 'title' => 'PHP for Beginners',          'provider' => 'Tech Academy MY',     'category' => 'Programming',  'duration' => '4 Weeks', 'rating' => 4.5, 'reviews' => 60,  'image' => '../images/webdevelopment.jpg'],
    ['id' => 6, 'title' => 'Healthcare Management',      'provider' => 'MediSkill Centre',    'category' => 'Healthcare',   'duration' => '5 Weeks', 'rating' => 4.7, 'reviews' => 45,  'image' => '../images/datascience.jpg'],
];
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
                <h4 class="dash-page-title">Browse Courses</h4>
                <p class="dash-page-sub">Find and enroll in certified courses from approved providers</p>
            </div>
        </div>

        <!-- Search and filter bar (functionality handled in shreeyash.js) -->
        <div class="course-filter-bar mb-4">
            <div class="input-group course-search">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Search courses...">
            </div>
            <!-- Category dropdown to filter courses -->
            <select class="form-control course-filter-select">
                <option value="">All Categories</option>
                <option>Programming</option>
                <option>Data Science</option>
                <option>Design</option>
                <option>Business</option>
                <option>Healthcare</option>
            </select>
        </div>

        <!-- Course cards grid - one card per course -->
        <div class="row">
            <?php foreach ($courses as $c): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="course-card">
                    <div class="course-img">
                        <img src="<?php echo $c['image']; ?>" alt="<?php echo htmlspecialchars($c['title']); ?>">
                    </div>
                    <div class="course-body">
                        <span class="course-cat"><?php echo $c['category']; ?></span>
                        <h5 class="course-title"><?php echo htmlspecialchars($c['title']); ?></h5>
                        <p class="course-provider"><i class="fas fa-building mr-1"></i><?php echo htmlspecialchars($c['provider']); ?></p>
                        <!-- Star rating and review count -->
                        <div class="course-rating">
                            <i class="fas fa-star"></i>
                            <span><?php echo $c['rating']; ?> (<?php echo $c['reviews']; ?> reviews)</span>
                        </div>
                        <div class="course-footer">
                            <span class="course-dur"><i class="fas fa-clock mr-1"></i><?php echo $c['duration']; ?></span>
                            <!-- Enroll button passes course ID to enroll.php via URL -->
                            <a href="enroll.php?id=<?php echo $c['id']; ?>" class="btn-enroll">Enroll Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Custom JS for search and filter interactions -->
<script src="../js/shreeyash.js"></script>
</body>
</html>