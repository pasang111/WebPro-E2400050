/*---pasang Lama---*/
<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSkill — Malaysia's Learning Marketplace</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Fraunces:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/darkmode.css">
    <link rel="stylesheet" href="css/darkmode.css">
    <script src="js/darkmode.js"></script>
    <style>
        /* ── HERO SLIDER ── */
        .hero-slider-wrap { position:relative; overflow:hidden; }
        .hero-slide { display:none; }
        .hero-slide.active { display:block; }

        .slider-controls {
            display:flex; align-items:center; justify-content:center;
            gap:14px; padding:18px 0;
            background:white;
            border-top:1.5px solid #e8e8e8;
        }

        .slider-arrow {
            width:36px; height:36px;
            border:1.5px solid #e8e8e8; border-radius:50%;
            background:white; cursor:pointer;
            display:flex; align-items:center; justify-content:center;
            font-size:13px; color:#717171;
            transition:all 0.2s;
        }
        .slider-arrow:hover { border-color:#f97316; color:#f97316; }

        .slider-dots { display:flex; gap:8px; align-items:center; }
        .sdot {
            width:8px; height:8px; border-radius:50%;
            background:#e8e8e8; cursor:pointer; transition:all 0.2s;
        }
        .sdot.active { background:#f97316; width:24px; border-radius:4px; }

        /* ── MARQUEE PARTNERS ── */
        .partners-strip {
            padding:36px 0;
            border-top:1.5px solid #e8e8e8;
            border-bottom:1.5px solid #e8e8e8;
            background:#fafafa;
            overflow:hidden;
        }
        .partners-label {
            font-size:12px; font-weight:700;
            text-transform:uppercase; letter-spacing:1.5px;
            color:#717171; text-align:center; margin-bottom:20px;
        }
        .partners-marquee-wrap { overflow:hidden; width:100%; }
        .partners-marquee {
            display:flex; align-items:center; gap:60px;
            width:max-content;
            animation:marquee 18s linear infinite;
        }
        .partners-marquee:hover { animation-play-state:paused; }
        @keyframes marquee {
            0%   { transform:translateX(0); }
            100% { transform:translateX(-50%); }
        }
        .partner-item {
            display:flex; align-items:center; gap:8px;
            font-size:17px; font-weight:800;
            color:#c0c0c0; letter-spacing:-0.5px;
            white-space:nowrap; transition:color 0.2s;
            font-family:'Outfit',sans-serif;
        }
        .partner-item:hover { color:#f97316; }
        .partner-item i { font-size:20px; }
    </style>
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<div class="hero-slider-wrap">

    <!-- Slide 1 -->
    <div class="hero-slide active">
        <section class="hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="hero-eyebrow">
                            <i class="fas fa-bolt"></i>
                            <span>NEW</span> Ministry Approved Platform
                        </div>
                        <h1 class="hero-h">
                            Unlock Your<br>Potential With<br><em>New Skills</em>
                        </h1>
                        <p class="hero-p">Discover hundreds of certified courses from Ministry-approved training providers across Malaysia. Learn at your own pace and advance your career.</p>
                        <div class="hero-btns">
                            <a href="auth/signup_student.php" class="btn-main">Get Started Free <i class="fas fa-arrow-right"></i></a>
                            <a href="about.php" class="btn-ghost"><i class="fas fa-play-circle"></i> Learn More</a>
                        </div>
                        <div class="hero-stats-row">
                            <div class="hsr-item"><strong>4.9</strong><span><i class="fas fa-star" style="color:#f59e0b;font-size:10px;"></i> Rating</span></div>
                            <div class="hsr-div"></div>
                            <div class="hsr-item"><strong>10K+</strong><span>Students</span></div>
                            <div class="hsr-div"></div>
                            <div class="hsr-item"><strong>500+</strong><span>Courses</span></div>
                            <div class="hsr-div"></div>
                            <div class="hsr-item"><strong>200+</strong><span>Providers</span></div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-5 mt-lg-0">
                        <div class="hero-img-wrap">
                            <img src="images/studentlearner.jpg" alt="Student learning" class="hero-main-img">
                            <div class="hero-float-card card-tl">
                                <div class="hfc-ico" style="background:#fff7ed;"><i class="fas fa-certificate" style="color:#f97316;"></i></div>
                                <div><strong>Ministry Certified</strong><span>All courses verified</span></div>
                            </div>
                            <div class="hero-float-card card-br">
                                <div class="hfc-ico" style="background:#dcfce7;"><i class="fas fa-user-graduate" style="color:#16a34a;"></i></div>
                                <div><strong>10,000+ Learners</strong><span>Across Malaysia</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

<div class="partners-strip">
    <div class="container">
        <p class="partners-label">Our Valued Partners</p>
    </div>
    <div class="partners-marquee-wrap">
        <div class="partners-marquee">
            <div class="partner-item"><i class="fas fa-building"></i> TechCorp MY</div>
            <div class="partner-item"><i class="fas fa-university"></i> DataHub</div>
            <div class="partner-item"><i class="fas fa-laptop-code"></i> CodeAcademy</div>
            <div class="partner-item"><i class="fas fa-chart-bar"></i> Analytics Pro</div>
            <div class="partner-item"><i class="fas fa-globe"></i> SkillBridge</div>
            <div class="partner-item"><i class="fas fa-star"></i> CreativeHub</div>
            <div class="partner-item"><i class="fas fa-microchip"></i> TechVision</div>
            <div class="partner-item"><i class="fas fa-flask"></i> SkillLab</div>
            <!-- Duplicate for seamless loop -->
            <div class="partner-item"><i class="fas fa-building"></i> TechCorp MY</div>
            <div class="partner-item"><i class="fas fa-university"></i> DataHub</div>
            <div class="partner-item"><i class="fas fa-laptop-code"></i> CodeAcademy</div>
            <div class="partner-item"><i class="fas fa-chart-bar"></i> Analytics Pro</div>
            <div class="partner-item"><i class="fas fa-globe"></i> SkillBridge</div>
            <div class="partner-item"><i class="fas fa-star"></i> CreativeHub</div>
            <div class="partner-item"><i class="fas fa-microchip"></i> TechVision</div>
            <div class="partner-item"><i class="fas fa-flask"></i> SkillLab</div>
        </div>
    </div>
</div>

<section class="sec-pad" style="background:#fafafa;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="sec-tag"><i class="fas fa-th-large"></i> Browse by Category</span>
            <h2 class="sec-title">Explore Course Categories</h2>
            <p class="sec-sub mx-auto">Find the right course for your career goals from our growing catalogue</p>
        </div>
        <div class="row">
            <div class="col-6 col-md-4 col-lg-2 mb-3">
                <a href="#" class="cat-card">
                    <div class="cat-ico-wrap" style="background:#dbeafe;"><i class="fas fa-laptop-code" style="color:#2563eb;"></i></div>
                    <span class="cat-name">Programming</span>
                    <span class="cat-count">48 courses</span>
                    <span class="cat-arrow"><i class="fas fa-arrow-right"></i></span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2 mb-3">
                <a href="#" class="cat-card">
                    <div class="cat-ico-wrap" style="background:#dcfce7;"><i class="fas fa-chart-bar" style="color:#16a34a;"></i></div>
                    <span class="cat-name">Data Science</span>
                    <span class="cat-count">32 courses</span>
                    <span class="cat-arrow"><i class="fas fa-arrow-right"></i></span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2 mb-3">
                <a href="#" class="cat-card">
                    <div class="cat-ico-wrap" style="background:#fce7f3;"><i class="fas fa-palette" style="color:#db2777;"></i></div>
                    <span class="cat-name">Design</span>
                    <span class="cat-count">28 courses</span>
                    <span class="cat-arrow"><i class="fas fa-arrow-right"></i></span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2 mb-3">
                <a href="#" class="cat-card">
                    <div class="cat-ico-wrap" style="background:#fff7ed;"><i class="fas fa-briefcase" style="color:#f97316;"></i></div>
                    <span class="cat-name">Business</span>
                    <span class="cat-count">36 courses</span>
                    <span class="cat-arrow"><i class="fas fa-arrow-right"></i></span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2 mb-3">
                <a href="#" class="cat-card">
                    <div class="cat-ico-wrap" style="background:#ede9fe;"><i class="fas fa-heartbeat" style="color:#7c3aed;"></i></div>
                    <span class="cat-name">Healthcare</span>
                    <span class="cat-count">22 courses</span>
                    <span class="cat-arrow"><i class="fas fa-arrow-right"></i></span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2 mb-3">
                <a href="#" class="cat-card">
                    <div class="cat-ico-wrap" style="background:#ccfbf1;"><i class="fas fa-language" style="color:#0f766e;"></i></div>
                    <span class="cat-name">Languages</span>
                    <span class="cat-count">18 courses</span>
                    <span class="cat-arrow"><i class="fas fa-arrow-right"></i></span>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="sec-pad bg-white">
    <div class="container">
        <div class="row align-items-end mb-5">
            <div class="col-lg-7">
                <span class="sec-tag"><i class="fas fa-fire"></i> Top Picks</span>
                <h2 class="sec-title">Our Featured Courses</h2>
                <p class="sec-sub">Courses our learners love the most — verified by Ministry officers</p>
            </div>
            <div class="col-lg-5 text-lg-right mt-3 mt-lg-0">
                <a href="auth/login.php" class="btn-outline-main">View All Courses <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="course-card">
                    <div class="course-img"><img src="images/webdevelopment.jpg" alt="Web Dev"><span class="course-level-badge level-intermediate">Intermediate</span></div>
                    <div class="course-body">
                        <span class="course-cat">Programming</span>
                        <h5 class="course-title">Full Stack Web Development</h5>
                        <p class="course-instructor"><i class="fas fa-user mr-1"></i> Tech Academy Malaysia</p>
                        <div class="course-rating"><span class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></span><span class="rating-num">4.8</span><span class="rating-count">(240)</span></div>
                        <div class="course-meta"><span><i class="fas fa-clock"></i> 8 Weeks</span><span><i class="fas fa-book"></i> 12 Lessons</span></div>
                        <a href="auth/signup_student.php" class="btn-enroll">Enroll Now</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="course-card">
                    <div class="course-img"><img src="images/datascience.jpg" alt="Data Science"><span class="course-level-badge level-advanced">Advanced</span></div>
                    <div class="course-body">
                        <span class="course-cat" style="background:#dcfce7;color:#16a34a;">Data Science</span>
                        <h5 class="course-title">Data Science & Analytics</h5>
                        <p class="course-instructor"><i class="fas fa-user mr-1"></i> DataSkill Institute</p>
                        <div class="course-rating"><span class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></span><span class="rating-num">5.0</span><span class="rating-count">(98)</span></div>
                        <div class="course-meta"><span><i class="fas fa-clock"></i> 6 Weeks</span><span><i class="fas fa-book"></i> 10 Lessons</span></div>
                        <a href="auth/signup_student.php" class="btn-enroll">Enroll Now</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="course-card">
                    <div class="course-img"><img src="images/uiuxdesign.jpg" alt="UI/UX"><span class="course-level-badge level-beginner">Beginner</span></div>
                    <div class="course-body">
                        <span class="course-cat" style="background:#fce7f3;color:#db2777;">Design</span>
                        <h5 class="course-title">UI/UX Design Fundamentals</h5>
                        <p class="course-instructor"><i class="fas fa-user mr-1"></i> Creative Hub KL</p>
                        <div class="course-rating"><span class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></span><span class="rating-num">4.0</span><span class="rating-count">(75)</span></div>
                        <div class="course-meta"><span><i class="fas fa-clock"></i> 4 Weeks</span><span><i class="fas fa-book"></i> 8 Lessons</span></div>
                        <a href="auth/signup_student.php" class="btn-enroll">Enroll Now</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="course-card">
                    <div class="course-img"><img src="images/digittalmarketing.jpg" alt="Digital Marketing"><span class="course-level-badge level-intermediate">Intermediate</span></div>
                    <div class="course-body">
                        <span class="course-cat" style="background:#fff7ed;color:#c2410c;">Business</span>
                        <h5 class="course-title">Digital Marketing Essentials</h5>
                        <p class="course-instructor"><i class="fas fa-user mr-1"></i> BizPro Academy</p>
                        <div class="course-rating"><span class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></span><span class="rating-num">4.6</span><span class="rating-count">(130)</span></div>
                        <div class="course-meta"><span><i class="fas fa-clock"></i> 3 Weeks</span><span><i class="fas fa-book"></i> 9 Lessons</span></div>
                        <a href="auth/signup_student.php" class="btn-enroll">Enroll Now</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="course-card">
                    <div class="course-img"><img src="images/carrerdevelopment.jpg" alt="Career"><span class="course-level-badge level-beginner">Beginner</span></div>
                    <div class="course-body">
                        <span class="course-cat" style="background:#ede9fe;color:#7c3aed;">Business</span>
                        <h5 class="course-title">Career Development & Leadership</h5>
                        <p class="course-instructor"><i class="fas fa-user mr-1"></i> Leadership Institute MY</p>
                        <div class="course-rating"><span class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></span><span class="rating-num">4.9</span><span class="rating-count">(88)</span></div>
                        <div class="course-meta"><span><i class="fas fa-clock"></i> 5 Weeks</span><span><i class="fas fa-book"></i> 11 Lessons</span></div>
                        <a href="auth/signup_student.php" class="btn-enroll">Enroll Now</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="course-card">
                    <div class="course-img"><img src="images/healthcaremanagement.jpg" alt="Healthcare"><span class="course-level-badge level-advanced">Advanced</span></div>
                    <div class="course-body">
                        <span class="course-cat" style="background:#ccfbf1;color:#0f766e;">Healthcare</span>
                        <h5 class="course-title">Healthcare Management & Admin</h5>
                        <p class="course-instructor"><i class="fas fa-user mr-1"></i> MediSkill Centre</p>
                        <div class="course-rating"><span class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></span><span class="rating-num">4.7</span><span class="rating-count">(56)</span></div>
                        <div class="course-meta"><span><i class="fas fa-clock"></i> 7 Weeks</span><span><i class="fas fa-book"></i> 14 Lessons</span></div>
                        <a href="auth/signup_student.php" class="btn-enroll">Enroll Now</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="sec-pad why-sec">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <span class="sec-tag sec-tag-dark"><i class="fas fa-trophy"></i> Why EduSkill</span>
                <h2 class="sec-title sec-title-white">The Smarter Way to Upskill in Malaysia</h2>
                <p class="sec-sub" style="color:rgba(255,255,255,0.5);">Every feature is built around one goal — helping Malaysians gain real, job-ready skills from verified providers.</p>
                <a href="auth/signup_student.php" class="btn-main mt-4">Start Learning Today <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="col-lg-6 mt-4 mt-lg-0">
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <div class="why-card">
                            <div class="why-num">01</div>
                            <div class="why-ico" style="background:rgba(249,115,22,0.15);"><i class="fas fa-chalkboard-teacher" style="color:#f97316;"></i></div>
                            <h5>Expert Instructors</h5>
                            <p>Learn from certified trainers with real-world industry experience.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="why-card">
                            <div class="why-num">02</div>
                            <div class="why-ico" style="background:rgba(74,222,128,0.15);"><i class="fas fa-clock" style="color:#4ade80;"></i></div>
                            <h5>Flexible Learning</h5>
                            <p>Study at your own pace anytime, anywhere you are.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="why-card">
                            <div class="why-num">03</div>
                            <div class="why-ico" style="background:rgba(96,165,250,0.15);"><i class="fas fa-certificate" style="color:#60a5fa;"></i></div>
                            <h5>Ministry Certified</h5>
                            <p>All courses go through strict Ministry approval process.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="why-card">
                            <div class="why-num">04</div>
                            <div class="why-ico" style="background:rgba(167,139,250,0.15);"><i class="fas fa-briefcase" style="color:#a78bfa;"></i></div>
                            <h5>Career Focused</h5>
                            <p>Courses designed around Malaysia's industry demands.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="sec-pad" style="background:#fafafa;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="sec-tag"><i class="fas fa-heart"></i> Student Reviews</span>
            <h2 class="sec-title">What Our Learners Say</h2>
            <p class="sec-sub mx-auto">Real feedback from real students across Malaysia</p>
        </div>
        <div class="row testimonial-track">
            <div class="col-md-4 mb-4">
                <div class="tcard">
                    <div class="tcard-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p class="tcard-text">"EduSkill helped me transition into a tech career. The Web Development course was practical and the instructor was incredibly supportive."</p>
                    <div class="tcard-author"><div class="tcard-av" style="background:#f97316;">A</div><div><strong>Ahmad Faris</strong><span>Web Development Graduate</span></div></div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="tcard">
                    <div class="tcard-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p class="tcard-text">"Data Science course completely changed my career path. Easy to use platform and content directly relevant to what employers need."</p>
                    <div class="tcard-author"><div class="tcard-av" style="background:#16a34a;">N</div><div><strong>Nurul Aina</strong><span>Data Science Graduate</span></div></div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="tcard">
                    <div class="tcard-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></div>
                    <p class="tcard-text">"UI/UX Design course gave me confidence to build a proper portfolio. Highly recommend EduSkill to anyone looking to upskill."</p>
                    <div class="tcard-author"><div class="tcard-av" style="background:#db2777;">R</div><div><strong>Ravi Kumar</strong><span>UI/UX Design Graduate</span></div></div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="tcard">
                    <div class="tcard-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p class="tcard-text">"Enrolled in Business Management and got a promotion within 3 months. Quality of content outstanding and approval process was smooth."</p>
                    <div class="tcard-author"><div class="tcard-av" style="background:#7c3aed;">S</div><div><strong>Siti Nabilah</strong><span>Business Graduate</span></div></div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="tcard">
                    <div class="tcard-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p class="tcard-text">"As someone from Sabah, EduSkill made it possible for me to get certified without travelling to KL. Truly life-changing platform."</p>
                    <div class="tcard-author"><div class="tcard-av" style="background:#0f766e;">J</div><div><strong>James Lim</strong><span>Digital Marketing Graduate</span></div></div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="tcard">
                    <div class="tcard-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
                    <p class="tcard-text">"Healthcare Management course was well structured. Got my enrollment approved within 2 days. Very satisfied with EduSkill."</p>
                    <div class="tcard-author"><div class="tcard-av" style="background:#c2410c;">F</div><div><strong>Farah Liyana</strong><span>Healthcare Graduate</span></div></div>
                </div>
            </div>
        </div>
        <div class="t-slider-nav text-center mt-2">
            <button class="t-prev" onclick="changeTestimonial(-1)"><i class="fas fa-chevron-left"></i></button>
            <button class="t-next" onclick="changeTestimonial(1)"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>
</section>

<section class="provider-cta">
    <div class="container">
        <div class="pcta-box">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <p class="pcta-eyebrow">For Training Providers</p>
                    <h2 class="pcta-title">List Your Courses. Reach Thousands of Learners.</h2>
                    <p class="pcta-sub">Register your organisation, get Ministry approval, and start growing your student base today on Malaysia's most trusted upskilling platform.</p>
                </div>
                <div class="col-lg-4 text-lg-right mt-4 mt-lg-0">
                    <a href="auth/signup_provider.php" class="btn-pcta">Register as Provider <i class="fas fa-arrow-right ml-2"></i></a>
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
<script>
// ── HERO SLIDER ──────────────────────────
var currentSlide = 0;
var totalSlides  = document.querySelectorAll('.hero-slide').length;
var sliderTimer;

function showSlide(n) {
    var slides = document.querySelectorAll('.hero-slide');
    var dots   = document.querySelectorAll('.sdot');
    currentSlide = (n + totalSlides) % totalSlides;
    slides.forEach(function(s) { s.classList.remove('active'); });
    dots.forEach(function(d)   { d.classList.remove('active'); });
    slides[currentSlide].classList.add('active');
    if (dots[currentSlide]) dots[currentSlide].classList.add('active');
}

function changeSlide(dir) {
    clearInterval(sliderTimer);
    showSlide(currentSlide + dir);
    startTimer();
}

function goToSlide(n) {
    clearInterval(sliderTimer);
    showSlide(n);
    startTimer();
}

function startTimer() {
    sliderTimer = setInterval(function() { showSlide(currentSlide + 1); }, 5000);
}

showSlide(0);
startTimer();
</script>
</body>
</html>
