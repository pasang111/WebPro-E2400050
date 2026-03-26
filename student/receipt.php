<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'student') {
    header('Location: ../auth/login.php'); exit();
}

$student_id      = $_SESSION['user_id'];
$student_name    = $_SESSION['user_name'] ?? 'Student';
$enrollment_id   = intval($_GET['id'] ?? 0);

if ($enrollment_id === 0) {
    header('Location: my_courses.php'); exit();
}

// Get enrollment details — only if it belongs to this student
$stmt = mysqli_prepare($conn, "
    SELECT
        e.id                as enrollment_id,
        e.status,
        e.enrolled_at,
        e.notes,
        s.name              as student_name,
        s.email             as student_email,
        s.phone             as student_phone,
        c.id                as course_id,
        c.title             as course_title,
        c.category,
        c.duration,
        c.description       as course_description,
        c.price,
        p.org_name          as provider_name,
        p.email             as provider_email,
        p.address           as provider_address,
        p.phone             as provider_phone
    FROM enrollments e
    JOIN students s   ON e.student_id  = s.id
    JOIN courses c    ON e.course_id   = c.id
    JOIN providers p  ON c.provider_id = p.id
    WHERE e.id = ? AND e.student_id = ?
");

mysqli_stmt_bind_param($stmt, 'ii', $enrollment_id, $student_id);
mysqli_stmt_execute($stmt);
$enrollment = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$enrollment) {
    header('Location: my_courses.php'); exit();
}

// Generate receipt number
$receipt_no = 'EDU-' . str_pad($enrollment['enrollment_id'], 6, '0', STR_PAD_LEFT) . '-' . date('Y');
$issued_date = date('d F Y', strtotime($enrollment['enrolled_at']));
$issued_time = date('h:i A', strtotime($enrollment['enrolled_at']));
?>