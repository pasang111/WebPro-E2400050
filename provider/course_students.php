<?php

// Start session to access stored user data
session_start();

// Redirect to login if user is not logged in or is not a provider
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'provider') {
    header('Location: ../auth/login.php'); exit();
}

// Get provider name from session; default to 'Provider' if not set
$provider_name = $_SESSION['user_name'] ?? 'Provider';

// Placeholder enrollment data (replace with DB query later)
$enrollments = [
    ['id'=>1,'student'=>'Ahmad Faris', 'email'=>'ahmad@gmail.com','course'=>'Full Stack Web Development','enrolled_date'=>'2026-03-12','status'=>'approved'],
    ['id'=>2,'student'=>'Nurul Aina',  'email'=>'nurul@gmail.com','course'=>'Full Stack Web Development','enrolled_date'=>'2026-03-13','status'=>'pending'],
    ['id'=>3,'student'=>'Ravi Kumar',  'email'=>'ravi@gmail.com', 'course'=>'PHP for Beginners',         'enrolled_date'=>'2026-03-10','status'=>'approved'],
    ['id'=>4,'student'=>'Siti Nabilah','email'=>'siti@gmail.com', 'course'=>'PHP for Beginners',         'enrolled_date'=>'2026-03-11','status'=>'approved'],
    ['id'=>5,'student'=>'James Lim',   'email'=>'james@gmail.com','course'=>'Full Stack Web Development','enrolled_date'=>'2026-03-14','status'=>'pending'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrolled Students - EduSkill Provider</title>
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
        <div class="dsb-role-badge provider-role-badge"><i class="fas fa-building mr-2"></i> Training Provider</div>
        <nav class="dsb-nav">
            <a href="dashboard.php" class="dsb-link"><i class="fas fa-th-large"></i> Dashboard</a>
            <a href="add_course.php" class="dsb-link"><i class="fas fa-plus-circle"></i> Add Course</a>