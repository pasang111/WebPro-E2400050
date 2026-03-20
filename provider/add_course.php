<?php

// Start session to access stored user data
session_start();

// Redirect to login if user is not logged in or is not a provider
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'provider') {
    header('Location: ../auth/login.php'); exit();
}

// Get provider name from session; default to 'Provider' if not set
$provider_name = $_SESSION['user_name'] ?? 'Provider';
$success = '';
$error   = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and retrieve submitted form fields
    $title       = trim($_POST['title'] ?? '');
    $category    = trim($_POST['category'] ?? '');
    $duration    = trim($_POST['duration'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price       = trim($_POST['price'] ?? '');

    // Validate that all required fields are filled
    if (empty($title) || empty($category) || empty($duration) || empty($description)) {
        $error = 'Please fill in all required fields.';
    } else {
        // Placeholder - will connect to database in Day 9
        $success = 'Course "'.$title.'" has been added successfully and is pending admin approval.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course - EduSkill Provider</title>
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
            <a href="add_course.php" class="dsb-link active"><i class="fas fa-plus-circle"></i> Add Course</a>
            <a href="edit_course.php" class="dsb-link"><i class="fas fa-edit"></i> Manage Courses</a>
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
                <h4 class="dash-page-title">Add New Course</h4>
                <p class="dash-page-sub">Fill in the details to list a new course</p>
            </div>
        </div>

        <!-- Show validation error or success message -->
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success"><i class="fas fa-check-circle mr-2"></i><?php echo $success; ?></div>
        <?php endif; ?>

        <div class="row">
            <!-- Course submission form -->
            <div class="col-lg-8">
                <div class="dash-card p-4">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label class="cf-label">Course Title <span class="text-danger">*</span></label>
                            <!-- Retain entered value if form reloads due to validation error -->
                            <input type="text" name="title" class="form-control cf-input" placeholder="e.g. Full Stack Web Development" value="<?php echo htmlspecialchars($_POST['title'] ?? ''); ?>" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="cf-label">Category <span class="text-danger">*</span></label>
                                    <select name="category" class="form-control cf-input" required>
                                        <option value="">Select category</option>
                                        <option>Programming</option>
                                        <option>Data Science</option>
                                        <option>Design</option>
                                        <option>Business</option>
                                        <option>Healthcare</option>
                                        <option>Languages</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="cf-label">Duration <span class="text-danger">*</span></label>
                                    <input type="text" name="duration" class="form-control cf-input" placeholder="e.g. 8 Weeks" value="<?php echo htmlspecialchars($_POST['duration'] ?? ''); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="cf-label">Course Description <span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control cf-input" rows="5" placeholder="Describe what students will learn in this course..." required><?php echo htmlspecialchars($_POST['description'] ?? ''); ?></textarea>
                        </div>
                        <!-- Optional fields - not required for submission -->
                        <div class="form-group">
                            <label class="cf-label">Price (RM)</label>
                            <input type="number" name="price" class="form-control cf-input" placeholder="e.g. 500" value="<?php echo htmlspecialchars($_POST['price'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label class="cf-label">Maximum Students</label>
                            <input type="number" name="max_students" class="form-control cf-input" placeholder="e.g. 30" value="<?php echo htmlspecialchars($_POST['max_students'] ?? ''); ?>">
                        </div>
                        <button type="submit" class="btn-main">
                            <i class="fas fa-plus-circle mr-2"></i> Add Course
                        </button>
                        <a href="dashboard.php" class="btn btn-outline-secondary ml-2" style="border-radius:8px;">Cancel</a>
                    </form>
                </div>
            </div>

            <!-- Side info box with submission guidelines -->
            <div class="col-lg-4">
                <div class="course-add-info">
                    <h6><i class="fas fa-info-circle mr-2"></i>Important Notes</h6>
                    <ul>
                        <li>Your course will be listed as <strong>Pending</strong> until approved by a Ministry officer.</li>
                        <li>Make sure all information is accurate before submitting.</li>
                        <li>Students can only enroll after your course is approved.</li>
                        <li>You can edit course details after submission.</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Custom JS for provider-side interactions -->
<script src="../js/archana.js"></script>
</body>
</html>