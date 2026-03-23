<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'provider') {
    header('Location: ../auth/login.php'); exit();
}

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
