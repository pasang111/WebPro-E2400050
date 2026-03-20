<?php

// Start session to access stored user data
session_start();

// Redirect to login if user is not logged in or is not a provider
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'provider') {
    header('Location: ../auth/login.php'); exit();
}

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