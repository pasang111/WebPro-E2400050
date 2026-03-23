<?php
<<<<<<< Updated upstream

// Start session to access stored user data
session_start();

// Redirect to login if user is not logged in or is not a provider
=======
session_start();
require_once '../config/database.php';

>>>>>>> Stashed changes
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'provider') {
    header('Location: ../auth/login.php'); exit();
}

<<<<<<< Updated upstream
// Get course ID from URL parameter
$course_id = $_GET['id'] ?? null;

if ($course_id) {
    // Store success message in session to display after redirect (replace with DB delete query later)
    $_SESSION['delete_msg'] = 'Course #'.$course_id.' has been deleted successfully.';
}

// Redirect back to manage courses page with deleted flag in URL
header('Location: edit_course.php?deleted=1');
exit();
?>
=======
$provider_id = $_SESSION['user_id'];
$course_id   = intval($_GET['id'] ?? 0);

if ($course_id) {
    // Make sure this course belongs to this provider
    $stmt = mysqli_prepare($conn, "DELETE FROM courses WHERE id = ? AND provider_id = ?");
    mysqli_stmt_bind_param($stmt, 'ii', $course_id, $provider_id);
    mysqli_stmt_execute($stmt);
}

header('Location: edit_course.php?deleted=1');
exit();
?>
>>>>>>> Stashed changes
