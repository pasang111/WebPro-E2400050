<?php
// about.php
// EduSkill About Page
// Responsible: Pasang Lama (Team Lead)
// Day 2 - About page added
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - EduSkill</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<!-- PAGE HEADER — replace 'images/about-bg.jpg' with your actual image path -->
<section class="page-header">
    <div class="container">
        <h1 class="page-header-title">About EduSkill</h1>
        <p class="page-header-subtitle">Learn about our mission and what we do</p>
    </div>
</section>

<!-- ABOUT CONTENT -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <span class="section-tag">Our Mission</span>
                <h2 class="section-title">Bridging the Skills Gap in Malaysia</h2>
                <p class="text-muted mb-3">
                    The Ministry of Human Resources developed EduSkill, an online network that connects registered
                     training providers with learners across Malaysia.
                </p>
                <p class="text-muted mb-3">
                    With the increased demand for upskilling and reskilling, many professionals choose short courses, workshops, and 
                    certification programs offered by local training providers.
                </p>
                <p class="text-muted">
                    EduSkill makes the process simple, transparent, and accessible to everybody.
                </p>
            </div>
            <div class="col-lg-6">
                <div class="about-image-placeholder">
                </div>
            </div>
        </div>

        <!-- Stats row -->
        <div class="row text-center mt-5">
            <div class="col-md-3 col-6 mb-4">
                <div class="about-stat-card">
                    <h3 class="about-stat-number">200+</h3>
                    <p class="about-stat-label">Courses Available</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="about-stat-card">
                    <h3 class="about-stat-number">50+</h3>
                    <p class="about-stat-label">Training Providers</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="about-stat-card">
                    <h3 class="about-stat-number">5,000+</h3>
                    <p class="about-stat-label">Learners Enrolled</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="about-stat-card">
                    <h3 class="about-stat-number">13</h3>
                    <p class="about-stat-label">States Covered</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- HOW WE WORK -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="section-tag">Our Process</span>
            <h2 class="section-title">How The System Works</h2>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="step-card text-center">
                    <div class="step-icon-wrap">
                        <span class="step-number">1</span>
                    </div>
                    <h4 class="step-title">Providers Register</h4>
                    <p class="step-desc">Training providers register and wait for Ministry permission before listing to the courses.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="step-card text-center">
                    <div class="step-icon-wrap">
                        <span class="step-number">2</span>
                    </div>
                    <h4 class="step-title">Ministry Approves</h4>
                    <p class="step-desc">Ministry officials review and approve provider registrations and student enrollment requests.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="step-card text-center">
                    <div class="step-icon-wrap">
                        <span class="step-number">3</span>
                    </div>
                    <h4 class="step-title">Students Learn</h4>
                    <p class="step-desc">Approved students can access their courses and begin their learning journey right away.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>