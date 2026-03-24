<?php
// student/rate_course.php
// Responsible: Shreeyash Pandey
// Star rating system — fixed with pure HTML stars

session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'student') {
    header('Location: ../auth/login.php'); exit();
}

$student_id   = $_SESSION['user_id'];
$student_name = $_SESSION['user_name'] ?? 'Student';
$course_id    = intval($_GET['id'] ?? 0);
$success      = '';
$error        = '';

// Get course — only if student has approved enrollment
$stmt = mysqli_prepare($conn, "
    SELECT c.*, p.org_name as provider_name
    FROM courses c
    JOIN providers p ON c.provider_id = p.id
    JOIN enrollments e ON e.course_id = c.id
    WHERE c.id = ? AND e.student_id = ? AND e.status = 'approved'
");
mysqli_stmt_bind_param($stmt, 'ii', $course_id, $student_id);
mysqli_stmt_execute($stmt);
$course = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$course) {
    header('Location: my_courses.php'); exit();
}

// Check if already rated
$check = mysqli_prepare($conn, "SELECT id, rating, review FROM ratings WHERE student_id=? AND course_id=?");
mysqli_stmt_bind_param($check, 'ii', $student_id, $course_id);
mysqli_stmt_execute($check);
$existing = mysqli_fetch_assoc(mysqli_stmt_get_result($check));

// Handle submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rating = intval($_POST['rating'] ?? 0);
    $review = trim($_POST['review'] ?? '');

    if ($rating < 1 || $rating > 5) {
        $error = 'Please select a rating between 1 and 5 stars.';
    } else {
        if ($existing) {
            $stmt2 = mysqli_prepare($conn, "UPDATE ratings SET rating=?, review=? WHERE student_id=? AND course_id=?");
            mysqli_stmt_bind_param($stmt2, 'isii', $rating, $review, $student_id, $course_id);
        } else {
            $stmt2 = mysqli_prepare($conn, "INSERT INTO ratings (student_id, course_id, rating, review) VALUES (?,?,?,?)");
            mysqli_stmt_bind_param($stmt2, 'iiis', $student_id, $course_id, $rating, $review);
        }
        if (mysqli_stmt_execute($stmt2)) {
            $success  = 'Thank you! Your rating has been submitted.';
            $existing = ['rating' => $rating, 'review' => $review];
        } else {
            $error = 'Something went wrong. Please try again.';
        }
    }
}

// Average rating
$avg_result    = mysqli_query($conn, "SELECT AVG(rating) as avg, COUNT(*) as total FROM ratings WHERE course_id=$course_id");
$avg_data      = mysqli_fetch_assoc($avg_result);
$avg_rating    = round($avg_data['avg'] ?? 0, 1);
$total_ratings = $avg_data['total'] ?? 0;

$current_rating = $existing['rating'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate Course - EduSkill</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/pasang.css">
    <link rel="stylesheet" href="../css/shreeyash.css">
    <style>
        /* ── STAR RATING ── */
        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
            gap: 8px;
            margin-bottom: 14px;
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating label {
            font-size: 40px;
            color: #d1d5db;
            cursor: pointer;
            transition: color 0.15s, transform 0.15s;
            margin: 0;
        }

        /* Hover effect — highlight all stars from hovered to end */
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #f59e0b;
            transform: scale(1.2);
        }

        /* Selected state */
        .star-rating input[type="radio"]:checked ~ label {
            color: #f59e0b;
        }

        .star-rating input[type="radio"]:checked + label {
            transform: scale(1.2);
        }

        .rating-labels {
            display: flex;
            justify-content: center;
            gap: 6px;
            font-size: 12px;
            color: #717171;
            margin-bottom: 20px;
        }

        .rating-label-item {
            width: 56px;
            text-align: center;
            font-weight: 600;
        }
    </style>
</head>
<body class="dashboard-body">
<div class="dashboard-wrap">

    <!-- SIDEBAR -->
    <aside class="dash-sidebar">
        <div class="dsb-brand">
            <a href="../index.php">
                <img src="../images/logo.png" alt="Logo"
                     style="width:30px;height:30px;border-radius:8px;object-fit:cover;"
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
                <h4 class="dash-page-title">Rate This Course</h4>
                <p class="dash-page-sub">Share your experience to help other learners</p>
            </div>
            <div class="dash-topbar-right">
                <a href="my_courses.php" class="btn-ghost">
                    <i class="fas fa-arrow-left mr-1"></i> Back
                </a>
            </div>
        </div>

        <div class="dash-content">
            <div class="row justify-content-center">
                <div class="col-lg-7">

                    <!-- Course info -->
                    <div class="dash-card mb-4 p-4">
                        <span class="course-cat mb-2 d-inline-block">
                            <?php echo htmlspecialchars($course['category']); ?>
                        </span>
                        <h4 style="font-weight:800;color:#1a1a1a;margin-bottom:6px;">
                            <?php echo htmlspecialchars($course['title']); ?>
                        </h4>
                        <p class="text-muted mb-2">
                            <i class="fas fa-building mr-1"></i>
                            <?php echo htmlspecialchars($course['provider_name']); ?>
                        </p>

                        <?php if ($total_ratings > 0): ?>
                        <div style="display:flex;align-items:center;gap:8px;margin-top:8px;">
                            <span style="color:#f59e0b;font-size:15px;">
                                <?php
                                $f = floor($avg_rating);
                                $h = ($avg_rating - $f) >= 0.3 ? 1 : 0;
                                $em = 5 - $f - $h;
                                for($i=0;$i<$f;$i++)  echo '<i class="fas fa-star"></i>';
                                if($h)                echo '<i class="fas fa-star-half-alt"></i>';
                                for($i=0;$i<$em;$i++) echo '<i class="far fa-star"></i>';
                                ?>
                            </span>
                            <strong><?php echo $avg_rating; ?></strong>
                            <span class="text-muted" style="font-size:13px;">
                                (<?php echo $total_ratings; ?> rating<?php echo $total_ratings>1?'s':''; ?>)
                            </span>
                        </div>
                        <?php else: ?>
                        <p class="text-muted mb-0" style="font-size:13px;margin-top:8px;">
                            No ratings yet — be the first to rate!
                        </p>
                        <?php endif; ?>
                    </div>

                    <!-- Rating form -->
                    <div class="dash-card p-4">

                        <?php if ($success): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle mr-2"></i><?php echo $success; ?>
                            <div class="mt-3">
                                <a href="my_courses.php" class="btn-main" style="font-size:14px;padding:10px 20px;">
                                    <i class="fas fa-arrow-left mr-2"></i>Back to My Enrollments
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if ($error): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>

                        <?php if (!$success): ?>
                        <h5 style="font-weight:800;margin-bottom:6px;">
                            <?php echo $existing ? 'Update Your Rating' : 'Your Rating'; ?>
                        </h5>
                        <p class="text-muted mb-4" style="font-size:14px;">
                            Click the stars below to select your rating
                        </p>

                        <form method="POST" action="" id="ratingForm">

                            <!-- Stars -->
                            <div class="text-center mb-4">
                                <div class="star-rating" id="starContainer">
                                    <input type="radio" name="rating" id="s5" value="5" <?php echo $current_rating==5?'checked':''; ?>>
                                    <label for="s5" title="Excellent"><i class="fas fa-star"></i></label>

                                    <input type="radio" name="rating" id="s4" value="4" <?php echo $current_rating==4?'checked':''; ?>>
                                    <label for="s4" title="Very Good"><i class="fas fa-star"></i></label>

                                    <input type="radio" name="rating" id="s3" value="3" <?php echo $current_rating==3?'checked':''; ?>>
                                    <label for="s3" title="Good"><i class="fas fa-star"></i></label>

                                    <input type="radio" name="rating" id="s2" value="2" <?php echo $current_rating==2?'checked':''; ?>>
                                    <label for="s2" title="Fair"><i class="fas fa-star"></i></label>

                                    <input type="radio" name="rating" id="s1" value="1" <?php echo $current_rating==1?'checked':''; ?>>
                                    <label for="s1" title="Poor"><i class="fas fa-star"></i></label>
                                </div>

                                <div class="rating-labels">
                                    <span class="rating-label-item">Poor</span>
                                    <span class="rating-label-item">Fair</span>
                                    <span class="rating-label-item">Good</span>
                                    <span class="rating-label-item">Very Good</span>
                                    <span class="rating-label-item">Excellent</span>
                                </div>

                                <div id="ratingFeedback" style="font-size:15px;font-weight:700;color:#f97316;min-height:24px;">
                                    <?php
                                    $labels = ['','Poor','Fair','Good','Very Good','Excellent'];
                                    if ($current_rating > 0) echo $current_rating . ' Stars — ' . $labels[$current_rating];
                                    ?>
                                </div>
                            </div>

                            <!-- Review -->
                            <div class="form-group">
                                <label class="cf-label">Written Review (Optional)</label>
                                <textarea name="review" class="form-control cf-input" rows="4"
                                    placeholder="Share what you liked about this course, what you learned, and who you would recommend it to..."
                                    style="height:auto;padding-top:12px;"><?php echo htmlspecialchars($existing['review'] ?? ''); ?></textarea>
                            </div>

                            <button type="submit" class="btn-main">
                                <i class="fas fa-paper-plane mr-2"></i>
                                <?php echo $existing ? 'Update Rating' : 'Submit Rating'; ?>
                            </button>
                            <a href="my_courses.php" class="btn btn-outline-secondary ml-2" style="border-radius:10px;">
                                Cancel
                            </a>
                        </form>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </main>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
var labels = ['', 'Poor', 'Fair', 'Good', 'Very Good', 'Excellent'];

// Update feedback text when star is selected
document.querySelectorAll('.star-rating input[type="radio"]').forEach(function(input) {
    input.addEventListener('change', function() {
        var val = parseInt(this.value);
        var fb  = document.getElementById('ratingFeedback');
        if (fb) {
            fb.textContent = val + ' Star' + (val > 1 ? 's' : '') + ' — ' + (labels[val] || '');
        }
    });
});

// Prevent submitting without selecting a star
document.getElementById('ratingForm') && document.getElementById('ratingForm').addEventListener('submit', function(e) {
    var selected = document.querySelector('.star-rating input[type="radio"]:checked');
    if (!selected) {
        e.preventDefault();
        alert('Please select a star rating before submitting.');
    }
});
</script>
</body>
</html>