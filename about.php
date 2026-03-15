<?php
// about.php - EduSkill About Page
// Responsible: Pasang Lama (Team Lead)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - EduSkill</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@400;600;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<!-- ABOUT HERO -->
<section class="about-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <p class="page-eyebrow">About EduSkill</p>
                <h1 class="page-hero-h">
                    Empowering Malaysia's Workforce <em>One Course at a Time</em>
                </h1>
                <p class="page-hero-p">
                    An initiative by the Ministry of Human Resources to connect learners
                    with certified training providers across Malaysia — making upskilling
                    simple, transparent, and accessible for everyone.
                </p>
                <a href="auth/signup_student.php" class="btn-primary-solid">
                    Join EduSkill <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            <div class="col-lg-7 mt-4 mt-lg-0">
                <div class="about-hero-img">
                    <img src="images/mission.jpg" alt="Students learning together">
                    <div class="about-stat-overlay">
                        <div class="aso-item">
                            <strong>10,000+</strong>
                            <span>Students</span>
                        </div>
                        <div class="aso-divider"></div>
                        <div class="aso-item">
                            <strong>200+</strong>
                            <span>Providers</span>
                        </div>
                        <div class="aso-divider"></div>
                        <div class="aso-item">
                            <strong>13</strong>
                            <span>States</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MISSION -->
<section class="about-mission">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <p class="section-eyebrow">Our Mission</p>
                <h2 class="section-h">Bridging Malaysia's Skills Gap</h2>
                <p class="section-p">
                    With the increasing demand for upskilling and reskilling, many professionals
                    are seeking short courses, workshops, and certification programmes offered
                    by local training providers.
                </p>
                <p class="section-p">
                    EduSkill makes this simple — learners can browse courses, enroll online,
                    and get certified by verified training providers, all through one platform.
                </p>
                <div class="mission-list">
                    <div class="mlist-item">
                        <i class="fas fa-check-circle"></i>
                        <span>All providers verified by the Ministry of Human Resources</span>
                    </div>
                    <div class="mlist-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Transparent enrollment and approval process</span>
                    </div>
                    <div class="mlist-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Accessible to all Malaysians regardless of background</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mission-img-block">
                    <img src="images/mission.jpg" alt="Training session">
                    <div class="mission-badge">
                        <i class="fas fa-award mr-2"></i> Ministry Approved Platform
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- VISION - editorial two col -->
<section class="about-vision">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <p class="section-eyebrow">Our Vision</p>
                <h2 class="section-h">Building a Future-Ready Malaysia</h2>
                <p class="section-p">
                    We envision a Malaysia where every professional has access to quality
                    training and certification, enabling them to thrive in the modern economy.
                </p>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-sm-6 mb-4">
                        <div class="vision-item">
                            <i class="fas fa-rocket vision-ico"></i>
                            <h5>Career Advancement</h5>
                            <p>Helping every Malaysian professional move forward with recognised certifications.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <div class="vision-item">
                            <i class="fas fa-globe-asia vision-ico"></i>
                            <h5>National Growth</h5>
                            <p>Contributing to Malaysia's human capital development and economic transformation.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <div class="vision-item">
                            <i class="fas fa-handshake vision-ico"></i>
                            <h5>Industry Alignment</h5>
                            <p>Ensuring courses are aligned with current industry demands and emerging skills.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <div class="vision-item">
                            <i class="fas fa-users vision-ico"></i>
                            <h5>Community Learning</h5>
                            <p>Fostering a culture of lifelong learning and professional development across Malaysia.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- VALUES -->
<section class="about-values">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-5 mb-lg-0">
                <p class="section-eyebrow section-eyebrow-light">Our Values</p>
                <h2 class="section-h section-h-white">What We Stand For</h2>
                <p class="section-p section-p-light">
                    Every decision we make at EduSkill is guided by these four core values
                    that put learners and quality first.
                </p>
            </div>
            <div class="col-lg-7">
                <div class="row">
                    <div class="col-sm-6 mb-4">
                        <div class="val-card val-blue">
                            <i class="fas fa-star"></i>
                            <h6>Quality Education</h6>
                            <p>Only verified, high-quality courses from approved providers.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <div class="val-card val-green">
                            <i class="fas fa-universal-access"></i>
                            <h6>Accessible Learning</h6>
                            <p>Making professional training affordable and available to everyone.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <div class="val-card val-orange">
                            <i class="fas fa-industry"></i>
                            <h6>Industry Partnerships</h6>
                            <p>Courses developed with real industry experts and employers.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <div class="val-card val-pink">
                            <i class="fas fa-chart-line"></i>
                            <h6>Career Growth</h6>
                            <p>Focused on real skills that lead to real career opportunities.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- IMPACT - horizontal band -->
<section class="about-impact">
    <div class="container">
        <div class="impact-band">
            <div class="impact-item">
                <strong>10,000+</strong>
                <span>Students Trained</span>
            </div>
            <div class="impact-divider"></div>
            <div class="impact-item">
                <strong>500+</strong>
                <span>Courses Available</span>
            </div>
            <div class="impact-divider"></div>
            <div class="impact-item">
                <strong>200+</strong>
                <span>Training Providers</span>
            </div>
            <div class="impact-divider"></div>
            <div class="impact-item">
                <strong>13</strong>
                <span>States Covered</span>
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
