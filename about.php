<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - EduSkill</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Lora:ital,wght@0,400;0,600;1,400;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<!-- HERO -->
<section class="page-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <span class="sec-tag">About EduSkill</span>
                <h1 class="page-hero-h">Empowering Malaysia's Workforce <em>One Course at a Time</em></h1>
                <p class="page-hero-p">An initiative by the Ministry of Human Resources to connect learners with certified training providers across Malaysia — making upskilling simple, transparent, and accessible.</p>
                <a href="auth/signup_student.php" class="btn-main">Join EduSkill <i class="fas fa-arrow-right ml-2"></i></a>
            </div>
            <div class="col-lg-6 mt-4 mt-lg-0">
                <div class="about-hero-img">
                    <img src="images/studentlearning.jpg" alt="Students learning">
                    <div class="about-stat-strip">
                        <div class="ass-item"><strong>10,000+</strong><span>Students</span></div>
                        <div class="ass-div"></div>
                        <div class="ass-item"><strong>200+</strong><span>Providers</span></div>
                        <div class="ass-div"></div>
                        <div class="ass-item"><strong>13</strong><span>States</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MISSION -->
<section class="sec-pad bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <span class="sec-tag">Our Mission</span>
                <h2 class="sec-title">Bridging Malaysia's Skills Gap</h2>
                <p class="text-muted mb-3">With the increasing demand for upskilling and reskilling, many professionals are seeking short courses, workshops, and certification programmes offered by local training providers.</p>
                <p class="text-muted mb-4">EduSkill makes this simple — learners can browse courses, enroll online, and get certified by verified training providers, all through one platform.</p>
                <div class="mission-pts">
                    <div class="mpt"><i class="fas fa-check-circle"></i><span>All providers verified by the Ministry of Human Resources</span></div>
                    <div class="mpt"><i class="fas fa-check-circle"></i><span>Transparent enrollment and approval process</span></div>
                    <div class="mpt"><i class="fas fa-check-circle"></i><span>Accessible to all Malaysians regardless of background</span></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mission-img">
                    <img src="images/Trainingsession.jpg" alt="Training session">
                    <div class="mission-badge"><i class="fas fa-award mr-2"></i>Ministry Approved</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- VISION -->
<section class="sec-pad bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <span class="sec-tag">Our Vision</span>
                <h2 class="sec-title">Building a Future-Ready Malaysia</h2>
                <p class="text-muted">We envision a Malaysia where every professional has access to quality training and certification, enabling them to thrive in the modern economy.</p>
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
                            <p>Fostering a culture of lifelong learning and professional development.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- VALUES -->
<section class="sec-pad bg-white">
    <div class="container">
        <div class="sec-head text-center mb-5">
            <span class="sec-tag">Our Values</span>
            <h2 class="sec-title">What We Stand For</h2>
        </div>
        <div class="row">
            <div class="col-6 col-md-3 mb-4">
                <div class="val-card">
                    <div class="val-ico" style="background:#dbeafe; color:#1d4ed8;"><i class="fas fa-star"></i></div>
                    <h6>Quality Education</h6>
                    <p>Only verified, high-quality courses from approved providers.</p>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-4">
                <div class="val-card">
                    <div class="val-ico" style="background:#dcfce7; color:#15803d;"><i class="fas fa-universal-access"></i></div>
                    <h6>Accessible Learning</h6>
                    <p>Making professional training affordable and available to everyone.</p>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-4">
                <div class="val-card">
                    <div class="val-ico" style="background:#ffedd5; color:#c2410c;"><i class="fas fa-industry"></i></div>
                    <h6>Industry Partnerships</h6>
                    <p>Courses developed with real industry experts and employers.</p>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-4">
                <div class="val-card">
                    <div class="val-ico" style="background:#fce7f3; color:#be185d;"><i class="fas fa-chart-line"></i></div>
                    <h6>Career Growth</h6>
                    <p>Focused on real skills that lead to real career opportunities.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- IMPACT -->
<section class="impact-sec">
    <div class="container">
        <div class="sec-head text-center mb-5">
            <span class="sec-tag sec-tag-light">Our Impact</span>
            <h2 class="sec-title sec-title-white">EduSkill by the Numbers</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-6 col-md-3 mb-4">
                <div class="impact-card">
                    <i class="fas fa-user-graduate"></i>
                    <h3>10,000+</h3>
                    <p>Students Trained</p>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-4">
                <div class="impact-card">
                    <i class="fas fa-book-open"></i>
                    <h3>500+</h3>
                    <p>Courses Available</p>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-4">
                <div class="impact-card">
                    <i class="fas fa-building"></i>
                    <h3>200+</h3>
                    <p>Training Providers</p>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-4">
                <div class="impact-card">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>13</h3>
                    <p>States Covered</p>
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
