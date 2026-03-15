<?php
// index.php - EduSkill Home Page
// Responsible: Pasang Lama (Team Lead)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSkill - Learn Without Limits</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@400;600;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<!-- HERO -->
<section class="hero">
    <div class="hero-left">
        <div class="hero-text">
            <div class="hero-eyebrow">Ministry of Human Resources Initiative</div>
            <h1 class="hero-heading">
                Unlock Your Next <em>Career Chapter</em> With Certified Training
            </h1>
            <p class="hero-para">
                EduSkill connects learners across Malaysia with verified training providers
                offering short courses, workshops, and certification programmes.
            </p>
            <div class="hero-actions">
                <a href="#" class="btn-primary-solid">
                    Explore Courses <i class="fas fa-arrow-right ml-2"></i>
                </a>
                <a href="about.php" class="btn-ghost-white ml-3">How It Works</a>
            </div>
            <div class="hero-numbers">
                <div class="hn-item">
                    <span class="hn-val">10K+</span>
                    <span class="hn-key">Students</span>
                </div>
                <div class="hn-sep"></div>
                <div class="hn-item">
                    <span class="hn-val">500+</span>
                    <span class="hn-key">Courses</span>
                </div>
                <div class="hn-sep"></div>
                <div class="hn-item">
                    <span class="hn-val">200+</span>
                    <span class="hn-key">Providers</span>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-right">
        <div class="hero-img-wrap">
            <img src="images/hero-bg.jpg" alt="Student learning online" class="hero-photo">
            <div class="hero-course-pill">
                <i class="fas fa-play-circle"></i>
                <div>
                    <strong>Web Development</strong>
                    <span>Enrolling Now</span>
                </div>
            </div>
            <div class="hero-cert-pill">
                <i class="fas fa-certificate"></i>
                <div>
                    <strong>Ministry Certified</strong>
                    <span>All courses verified</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CATEGORIES - tile grid -->
<section class="categories-section">
    <div class="container">
        <div class="cats-header">
            <h2 class="cats-title">Browse by Category</h2>
            <a href="#" class="cats-link">View all <i class="fas fa-arrow-right ml-1"></i></a>
        </div>
        <div class="cats-grid">
            <a href="#" class="cat-tile cat-blue">
                <i class="fas fa-laptop-code cat-ico"></i>
                <span class="cat-name">Programming</span>
                <span class="cat-num">48 courses</span>
            </a>
            <a href="#" class="cat-tile cat-green">
                <i class="fas fa-chart-bar cat-ico"></i>
                <span class="cat-name">Data Science</span>
                <span class="cat-num">32 courses</span>
            </a>
            <a href="#" class="cat-tile cat-pink">
                <i class="fas fa-palette cat-ico"></i>
                <span class="cat-name">Design</span>
                <span class="cat-num">28 courses</span>
            </a>
            <a href="#" class="cat-tile cat-orange">
                <i class="fas fa-briefcase cat-ico"></i>
                <span class="cat-name">Business</span>
                <span class="cat-num">36 courses</span>
            </a>
            <a href="#" class="cat-tile cat-purple">
                <i class="fas fa-heartbeat cat-ico"></i>
                <span class="cat-name">Healthcare</span>
                <span class="cat-num">22 courses</span>
            </a>
            <a href="#" class="cat-tile cat-teal">
                <i class="fas fa-language cat-ico"></i>
                <span class="cat-name">Languages</span>
                <span class="cat-num">18 courses</span>
            </a>
        </div>
    </div>
</section>

<!-- COURSES - featured + sidebar list layout -->
<section class="courses-section">
    <div class="container">
        <div class="courses-header mb-4">
            <h2 class="sec-title">Popular Courses</h2>
            <p class="sec-sub">Handpicked by our team based on enrollment and ratings</p>
        </div>
        <div class="row">
            <!-- Featured course - large left -->
            <div class="col-lg-6 mb-4">
                <div class="course-featured">
                    <div class="cf-img">
                        <img src="images/course1.jpg" alt="Web Development Course">
                        <span class="cf-badge">Most Popular</span>
                    </div>
                    <div class="cf-body">
                        <span class="cf-cat">Programming</span>
                        <h3 class="cf-title">Full Stack Web Development Bootcamp</h3>
                        <p class="cf-desc">Learn HTML, CSS, JavaScript, PHP and MySQL from scratch. Build real projects with guidance from industry experts.</p>
                        <div class="cf-meta">
                            <span><i class="fas fa-clock"></i> 8 Weeks</span>
                            <span><i class="fas fa-star"></i> 4.8 (240 reviews)</span>
                            <span><i class="fas fa-building"></i> Tech Academy MY</span>
                        </div>
                        <a href="#" class="btn-enroll-main">Enroll Now <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                </div>
            </div>
            <!-- Sidebar list - right -->
            <div class="col-lg-6">
                <div class="course-list-item">
                    <div class="cli-img">
                        <img src="images/course2.jpg" alt="Data Science">
                    </div>
                    <div class="cli-body">
                        <span class="cli-cat cli-cat-green">Data Science</span>
                        <h5 class="cli-title">Data Science & Analytics</h5>
                        <div class="cli-meta">
                            <span><i class="fas fa-clock"></i> 6 Weeks</span>
                            <span><i class="fas fa-star"></i> 4.9</span>
                        </div>
                        <a href="#" class="cli-enroll">Enroll <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                </div>
                <div class="course-list-item">
                    <div class="cli-img">
                        <img src="images/course3.jpg" alt="UI/UX Design">
                    </div>
                    <div class="cli-body">
                        <span class="cli-cat cli-cat-pink">Design</span>
                        <h5 class="cli-title">UI/UX Design Fundamentals</h5>
                        <div class="cli-meta">
                            <span><i class="fas fa-clock"></i> 4 Weeks</span>
                            <span><i class="fas fa-star"></i> 4.7</span>
                        </div>
                        <a href="#" class="cli-enroll">Enroll <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                </div>
                <div class="course-list-item">
                    <div class="cli-img cli-img-fallback">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="cli-body">
                        <span class="cli-cat cli-cat-orange">Business</span>
                        <h5 class="cli-title">Digital Marketing Essentials</h5>
                        <div class="cli-meta">
                            <span><i class="fas fa-clock"></i> 3 Weeks</span>
                            <span><i class="fas fa-star"></i> 4.6</span>
                        </div>
                        <a href="#" class="cli-enroll">Enroll <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="#" class="btn-outline-main">Browse All Courses <i class="fas fa-arrow-right ml-1"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- WHY EDUSKILL - editorial numbered layout -->
<section class="why-section">
    <div class="container">
        <div class="row align-items-end mb-5">
            <div class="col-lg-6">
                <p class="why-eyebrow">Why EduSkill</p>
                <h2 class="why-heading">Learning That <em>Actually Works</em></h2>
            </div>
            <div class="col-lg-6">
                <p class="why-intro">Every feature on EduSkill is built around one goal — helping Malaysians gain real, job-ready skills from verified training providers.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="why-item">
                    <span class="why-num">01</span>
                    <h5>Expert Instructors</h5>
                    <p>Industry professionals and certified trainers with real-world experience leading every course.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="why-item">
                    <span class="why-num">02</span>
                    <h5>Flexible Schedule</h5>
                    <p>Study at your own pace. Access all course materials online anytime, anywhere you are.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="why-item">
                    <span class="why-num">03</span>
                    <h5>Ministry Certified</h5>
                    <p>All courses and providers go through a strict approval process by the Ministry of Human Resources.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="why-item">
                    <span class="why-num">04</span>
                    <h5>Career Focused</h5>
                    <p>Courses are designed around Malaysia's current industry demands and emerging skills needs.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONIALS -->
<section class="testimonials-section">
    <div class="container">
        <h2 class="sec-title mb-2">What Our Learners Say</h2>
        <p class="sec-sub mb-5">Real feedback from real students across Malaysia</p>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="tcard">
                    <div class="tcard-stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="tcard-text">"EduSkill helped me transition into a tech career. The Web Development course was practical and the instructor was incredibly supportive throughout."</p>
                    <div class="tcard-author">
                        <div class="tcard-av" style="background:#0056d2;">A</div>
                        <div>
                            <strong>Ahmad Faris</strong>
                            <span>Web Development Graduate</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="tcard tcard-dark">
                    <div class="tcard-stars tcard-stars-light">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="tcard-text tcard-text-light">"The Data Science course completely changed my career path. The platform is easy to use and the content is directly relevant to what employers need."</p>
                    <div class="tcard-author">
                        <div class="tcard-av" style="background:#2e7d32;">N</div>
                        <div>
                            <strong class="text-white">Nurul Aina</strong>
                            <span class="tcard-span-light">Data Science Graduate</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="tcard">
                    <div class="tcard-stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="tcard-text">"The UI/UX Design course gave me the confidence to build a proper portfolio. Highly recommend EduSkill to anyone looking to upskill professionally."</p>
                    <div class="tcard-author">
                        <div class="tcard-av" style="background:#c2185b;">R</div>
                        <div>
                            <strong>Ravi Kumar</strong>
                            <span>UI/UX Design Graduate</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PROVIDER CTA -->
<section class="provider-cta">
    <div class="container">
        <div class="provider-cta-inner">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <p class="pcta-eyebrow">For Training Providers</p>
                    <h2 class="pcta-title">List Your Courses. Reach Thousands of Learners.</h2>
                    <p class="pcta-sub">Register your organisation, get approved by the Ministry, and start listing your courses on Malaysia's trusted upskilling platform.</p>
                </div>
                <div class="col-lg-4 text-lg-right mt-4 mt-lg-0">
                    <a href="#" class="btn-pcta">Register as Provider <i class="fas fa-arrow-right ml-2"></i></a>
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
