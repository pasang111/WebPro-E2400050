    <?php
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>EduSkill — Malaysia's Learning Marketplace</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>

    <?php include 'includes/navbar.php'; ?>

    <div class="hero-slider-wrap">

        <div class="hero-slide active">
            <section class="hero-section">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            
                            <h1 class="hero-h">
                                Unlock Your<br>Potential With<br><em>New Skills</em>
                            </h1>
                            <p class="hero-p">Discover hundreds of certified courses from Ministry-approved training providers across Malaysia. Learn at your own pace and advance your career.</p>
                            <div class="hero-btns">
                                <a href="auth/signup_student.php" class="btn-main">
                                    Get Started Free <i class="fas fa-arrow-right"></i>
                                </a>
                                <a href="about.php" class="btn-ghost">
                                    <i class="fas fa-play-circle"></i> Learn More
                                </a>
                            </div>
                            <div class="hero-stats-row">
                                <div class="hsr-item">
                                    <strong>4.9</strong>
                                    <span><i class="fas fa-star hsr-star"></i> Rating</span>
                                </div>
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
                                    <div>
                                    </div>
                                </div>
                                
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

    <section class="sec-pad bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="sec-title">Explore Course Categories</h2>
                <p class="sec-sub mx-auto">Find the right course for your career goals</p>
            </div>
            <div class="row">
                <div class="col-6 col-md-4 col-lg-2 mb-3">
                    <a href="#" class="cat-card">
                        <div class="cat-ico-wrap cat-ico-blue"><i class="fas fa-laptop-code"></i></div>
                        <span class="cat-name">Programming</span>
                        <span class="cat-count">48 courses</span>
                        <span class="cat-arrow"><i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2 mb-3">
                    <a href="#" class="cat-card">
                        <div class="cat-ico-wrap cat-ico-green"><i class="fas fa-chart-bar"></i></div>
                        <span class="cat-name">Data Science</span>
                        <span class="cat-count">32 courses</span>
                        <span class="cat-arrow"><i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2 mb-3">
                    <a href="#" class="cat-card">
                        <div class="cat-ico-wrap cat-ico-pink"><i class="fas fa-palette"></i></div>
                        <span class="cat-name">Design</span>
                        <span class="cat-count">28 courses</span>
                        <span class="cat-arrow"><i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2 mb-3">
                    <a href="#" class="cat-card">
                        <div class="cat-ico-wrap cat-ico-orange"><i class="fas fa-briefcase"></i></div>
                        <span class="cat-name">Business</span>
                        <span class="cat-count">36 courses</span>
                        <span class="cat-arrow"><i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2 mb-3">
                    <a href="#" class="cat-card">
                        <div class="cat-ico-wrap cat-ico-purple"><i class="fas fa-heartbeat"></i></div>
                        <span class="cat-name">Healthcare</span>
                        <span class="cat-count">22 courses</span>
                        <span class="cat-arrow"><i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2 mb-3">
                    <a href="#" class="cat-card">
                        <div class="cat-ico-wrap cat-ico-teal"><i class="fas fa-language"></i></div>
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
                        <div class="course-img">
                            <img src="images/webdevelopment.jpg" alt="Web Development">
                            <span class="course-level-badge level-intermediate">Intermediate</span>
                        </div>
                        <div class="course-body">
                            <span class="course-cat course-cat-blue">Programming</span>
                            <h5 class="course-title">Full Stack Web Development</h5>
                            <p class="course-instructor"><i class="fas fa-user mr-1"></i> Tech Academy Malaysia</p>
                            <div class="course-rating">
                                <span class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></span>
                                <span class="rating-num">4.8</span>
                                <span class="rating-count">(240)</span>
                            </div>
                            <div class="course-meta">
                                <span><i class="fas fa-clock"></i> 8 Weeks</span>
                                <span><i class="fas fa-book"></i> 12 Lessons</span>
                            </div>
                            <a href="auth/signup_student.php" class="btn-enroll">Enroll Now</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="course-card">
                        <div class="course-img">
                            <img src="images/datascience.jpg" alt="Data Science">
                            <span class="course-level-badge level-advanced">Advanced</span>
                        </div>
                        <div class="course-body">
                            <span class="course-cat course-cat-green">Data Science</span>
                            <h5 class="course-title">Data Science & Analytics</h5>
                            <p class="course-instructor"><i class="fas fa-user mr-1"></i> DataSkill Institute</p>
                            <div class="course-rating">
                                <span class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></span>
                                <span class="rating-num">5.0</span>
                                <span class="rating-count">(98)</span>
                            </div>
                            <div class="course-meta">
                                <span><i class="fas fa-clock"></i> 6 Weeks</span>
                                <span><i class="fas fa-book"></i> 10 Lessons</span>
                            </div>
                            <a href="auth/signup_student.php" class="btn-enroll">Enroll Now</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="course-card">
                        <div class="course-img">
                            <img src="images/uiuxdesign.jpg" alt="UI/UX Design">
                            <span class="course-level-badge level-beginner">Beginner</span>
                        </div>
                        <div class="course-body">
                            <span class="course-cat course-cat-pink">Design</span>
                            <h5 class="course-title">UI/UX Design Fundamentals</h5>
                            <p class="course-instructor"><i class="fas fa-user mr-1"></i> Creative Hub KL</p>
                            <div class="course-rating">
                                <span class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></span>
                                <span class="rating-num">4.0</span>
                                <span class="rating-count">(75)</span>
                            </div>
                            <div class="course-meta">
                                <span><i class="fas fa-clock"></i> 4 Weeks</span>
                                <span><i class="fas fa-book"></i> 8 Lessons</span>
                            </div>
                            <a href="auth/signup_student.php" class="btn-enroll">Enroll Now</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="course-card">
                        <div class="course-img">
                            <img src="images/digittalmarketing.jpg" alt="Digital Marketing">
                            <span class="course-level-badge level-intermediate">Intermediate</span>
                        </div>
                        <div class="course-body">
                            <span class="course-cat course-cat-orange">Business</span>
                            <h5 class="course-title">Digital Marketing Essentials</h5>
                            <p class="course-instructor"><i class="fas fa-user mr-1"></i> BizPro Academy</p>
                            <div class="course-rating">
                                <span class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></span>
                                <span class="rating-num">4.6</span>
                                <span class="rating-count">(130)</span>
                            </div>
                            <div class="course-meta">
                                <span><i class="fas fa-clock"></i> 3 Weeks</span>
                                <span><i class="fas fa-book"></i> 9 Lessons</span>
                            </div>
                            <a href="auth/signup_student.php" class="btn-enroll">Enroll Now</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="course-card">
                        <div class="course-img">
                            <img src="images/careerdevelopment.jpg" alt="Career Development">
                            <span class="course-level-badge level-beginner">Beginner</span>
                        </div>
                        <div class="course-body">
                            <span class="course-cat course-cat-purple">Business</span>
                            <h5 class="course-title">Career Development & Leadership</h5>
                            <p class="course-instructor"><i class="fas fa-user mr-1"></i> Leadership Institute MY</p>
                            <div class="course-rating">
                                <span class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></span>
                                <span class="rating-num">4.9</span>
                                <span class="rating-count">(88)</span>
                            </div>
                            <div class="course-meta">
                                <span><i class="fas fa-clock"></i> 5 Weeks</span>
                                <span><i class="fas fa-book"></i> 11 Lessons</span>
                            </div>
                            <a href="auth/signup_student.php" class="btn-enroll">Enroll Now</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="course-card">
                        <div class="course-img">
                            <img src="images/healthcaremanagement.jpg" alt="Healthcare">
                            <span class="course-level-badge level-advanced">Advanced</span>
                        </div>
                        <div class="course-body">
                            <span class="course-cat course-cat-teal">Healthcare</span>
                            <h5 class="course-title">Healthcare Management & Admin</h5>
                            <p class="course-instructor"><i class="fas fa-user mr-1"></i> MediSkill Centre</p>
                            <div class="course-rating">
                                <span class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></span>
                                <span class="rating-num">4.7</span>
                                <span class="rating-count">(56)</span>
                            </div>
                            <div class="course-meta">
                                <span><i class="fas fa-clock"></i> 7 Weeks</span>
                                <span><i class="fas fa-book"></i> 14 Lessons</span>
                            </div>
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
                    <h2 class="sec-title sec-title-white">The Smarter Way to Upskill in Malaysia</h2>
                    <a href="auth/signup_student.php" class="btn-main mt-4">Start Learning Today <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="col-lg-6 mt-4 mt-lg-0">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <div class="why-card">
                                <div class="why-ico why-ico-orange"><i class="fas fa-chalkboard-teacher"></i></div>
                                <h5>Expert Instructors</h5>
                                <p>Learn from certified trainers with real-world industry experience.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="why-card">
                                <div class="why-ico why-ico-green"><i class="fas fa-clock"></i></div>
                                <h5>Flexible Learning</h5>
                                <p>Study at your own pace anytime, anywhere you are.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="why-card">
                                <div class="why-ico why-ico-blue"><i class="fas fa-certificate"></i></div>
                                <h5>Ministry Certified</h5>
                                <p>All courses go through strict Ministry approval process.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="why-card">
                                <div class="why-ico why-ico-purple"><i class="fas fa-briefcase"></i></div>
                                <h5>Career Focused</h5>
                                <p>Courses designed around Malaysia's industry demands.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sec-pad bg-light">
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
                        <div class="tcard-author">
                            <div class="tcard-av tcard-av-orange">A</div>
                            <div><strong>Ahmad Faris</strong><span>Web Development Graduate</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="tcard">
                        <div class="tcard-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        <p class="tcard-text">"Data Science course completely changed my career path. Easy to use platform and content directly relevant to what employers need."</p>
                        <div class="tcard-author">
                            <div class="tcard-av tcard-av-green">N</div>
                            <div><strong>Nurul Aina</strong><span>Data Science Graduate</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="tcard">
                        <div class="tcard-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></div>
                        <p class="tcard-text">"UI/UX Design course gave me confidence to build a proper portfolio. Highly recommend EduSkill to anyone looking to upskill."</p>
                        <div class="tcard-author">
                            <div class="tcard-av tcard-av-pink">R</div>
                            <div><strong>Ravi Kumar</strong><span>UI/UX Design Graduate</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="tcard">
                        <div class="tcard-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        <p class="tcard-text">"Enrolled in Business Management and got a promotion within 3 months. Quality of content outstanding and approval process was smooth."</p>
                        <div class="tcard-author">
                            <div class="tcard-av tcard-av-purple">S</div>
                            <div><strong>Siti Nabilah</strong><span>Business Graduate</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="tcard">
                        <div class="tcard-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        <p class="tcard-text">"As someone from Sabah, EduSkill made it possible for me to get certified without travelling to KL. Truly life-changing platform."</p>
                        <div class="tcard-author">
                            <div class="tcard-av tcard-av-teal">J</div>
                            <div><strong>James Lim</strong><span>Digital Marketing Graduate</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="tcard">
                        <div class="tcard-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
                        <p class="tcard-text">"Healthcare Management course was well structured. Got my enrollment approved within 2 days. Very satisfied with EduSkill."</p>
                        <div class="tcard-author">
                            <div class="tcard-av tcard-av-red">F</div>
                            <div><strong>Farah Liyana</strong><span>Healthcare Graduate</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="t-slider-nav text-center mt-2">
                <button class="t-prev" onclick="changeTestimonial(-1)"><i class="fas fa-chevron-left"></i></button>
                <button class="t-next" onclick="changeTestimonial(1)"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </section>

    <section class="sec-pad bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <span class="sec-tag"><i class="fas fa-tag"></i> Pricing</span>
                <h2 class="sec-title">Plans for You or Your Team</h2>
                <p class="sec-sub mx-auto">Choose the plan that works best for your learning goals</p>
                <div class="pricing-toggle mt-4">
                    <button class="ptoggle active" id="btnIndividual" onclick="showPricing('individual')">For Individuals</button>
                    <button class="ptoggle" id="btnTeams" onclick="showPricing('teams')">For Teams</button>
                </div>
            </div>

            <!-- Individual Plans -->
            <div id="pricingIndividual">
                <div class="row justify-content-center">
                    <div class="col-md-4 mb-4">
                        <div class="pricing-card">
                            <div class="pricing-header">
                                <h5 class="pricing-name">Basic Plan</h5>
                                <p class="pricing-desc">Learn a single topic and earn a Ministry-verified credential.</p>
                                <div class="pricing-price">
                                    <span class="pricing-currency">RM</span>
                                    <span class="pricing-amount">49</span>
                                    <span class="pricing-period">/month</span>
                                </div>
                            </div>
                            <div class="pricing-body">
                                <a href="auth/login.php" class="pricing-btn-outline">Get Started</a>
                                <ul class="pricing-features">
                                    <li><i class="fas fa-check"></i> Access courses in 1 category</li>
                                    <li><i class="fas fa-check"></i> Ministry-verified certificate</li>
                                    <li><i class="fas fa-check"></i> Self-paced learning</li>
                                    <li><i class="fas fa-check"></i> Mobile access</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-4">
                        <div class="pricing-card pricing-card-featured">
                            <div class="pricing-popular-badge">Most Popular</div>
                            <div class="pricing-header">
                                <h5 class="pricing-name pricing-name-white">EduSkill Plus</h5>
                                <p class="pricing-desc pricing-desc-light">Complete multiple courses and earn credentials in the short term.</p>
                                <div class="pricing-price">
                                    <span class="pricing-currency pricing-currency-white">RM</span>
                                    <span class="pricing-amount pricing-amount-white">89</span>
                                    <span class="pricing-period pricing-period-light">/month</span>
                                </div>
                            </div>
                            <div class="pricing-body">
                                <a href="auth/login.php" class="pricing-btn-main">Start 7-Day Free Trial</a>
                                <p class="pricing-cancel">Cancel anytime</p>
                                <ul class="pricing-features pricing-features-light">
                                    <li><i class="fas fa-check"></i> Access 500+ courses from all categories</li>
                                    <li><i class="fas fa-check"></i> Unlimited Ministry certificates</li>
                                    <li><i class="fas fa-check"></i> Priority enrollment approval</li>
                                    <li><i class="fas fa-check"></i> Learn from 200+ approved providers</li>
                                    <li><i class="fas fa-check"></i> Career development resources</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="pricing-card">
                            <div class="pricing-header">
                                <h5 class="pricing-name">EduSkill Annual</h5>
                                <p class="pricing-desc">Combine flexibility and savings with long-term learning goals.</p>
                                <div class="pricing-price">
                                    <span class="pricing-currency">RM</span>
                                    <span class="pricing-amount">699</span>
                                    <span class="pricing-period">/year</span>
                                </div>
                                <p class="pricing-save">Save RM 369 vs monthly</p>
                            </div>
                            <div class="pricing-body">
                                <a href="auth/login.php" class="pricing-btn-outline">Try Annual Plan</a>
                                <p class="pricing-guarantee">14-day money-back guarantee</p>
                                <ul class="pricing-features">
                                    <li><i class="fas fa-check"></i> Everything in Plus plan</li>
                                    <li><i class="fas fa-check"></i> Save up to 35% vs monthly</li>
                                    <li><i class="fas fa-check"></i> Exclusive annual-only courses</li>
                                    <li><i class="fas fa-check"></i> Certificate portfolio export</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team Plans -->
            <div id="pricingTeams" class="d-none">
                <div class="row justify-content-center">
                    <div class="col-md-4 mb-4">
                        <div class="pricing-card">
                            <div class="pricing-header">
                                <h5 class="pricing-name">Team Starter</h5>
                                <p class="pricing-desc">Perfect for small teams of up to 10 members.</p>
                                <div class="pricing-price">
                                    <span class="pricing-currency">RM</span>
                                    <span class="pricing-amount">299</span>
                                    <span class="pricing-period">/month</span>
                                </div>
                            </div>
                            <div class="pricing-body">
                                <a href="auth/signup_provider.php" class="pricing-btn-outline">Get Started</a>
                                <ul class="pricing-features">
                                    <li><i class="fas fa-check"></i> Up to 10 team members</li>
                                    <li><i class="fas fa-check"></i> Team progress dashboard</li>
                                    <li><i class="fas fa-check"></i> 500+ courses access</li>
                                    <li><i class="fas fa-check"></i> Ministry certificates for all</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="pricing-card pricing-card-featured">
                            <div class="pricing-popular-badge">Best Value</div>
                            <div class="pricing-header">
                                <h5 class="pricing-name pricing-name-white">Team Pro</h5>
                                <p class="pricing-desc pricing-desc-light">For growing organisations that need more seats.</p>
                                <div class="pricing-price">
                                    <span class="pricing-currency pricing-currency-white">RM</span>
                                    <span class="pricing-amount pricing-amount-white">799</span>
                                    <span class="pricing-period pricing-period-light">/month</span>
                                </div>
                            </div>
                            <div class="pricing-body">
                                <a href="auth/signup_provider.php" class="pricing-btn-main">Start Free Trial</a>
                                <ul class="pricing-features pricing-features-light">
                                    <li><i class="fas fa-check"></i> Up to 50 team members</li>
                                    <li><i class="fas fa-check"></i> Advanced analytics</li>
                                    <li><i class="fas fa-check"></i> Custom learning paths</li>
                                    <li><i class="fas fa-check"></i> Dedicated account manager</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="pricing-card">
                            <div class="pricing-header">
                                <h5 class="pricing-name">Enterprise</h5>
                                <p class="pricing-desc">Custom solution for large organisations and ministries.</p>
                                <div class="pricing-price">
                                    <span class="pricing-amount pricing-amount-custom">Custom</span>
                                </div>
                            </div>
                            <div class="pricing-body">
                                <a href="contact.php" class="pricing-btn-outline">Contact Us</a>
                                <ul class="pricing-features">
                                    <li><i class="fas fa-check"></i> Unlimited team members</li>
                                    <li><i class="fas fa-check"></i> Custom branding</li>
                                    <li><i class="fas fa-check"></i> SLA guarantee</li>
                                    <li><i class="fas fa-check"></i> On-site training support</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
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
                        <p class="pcta-sub">Register your organisation, get Ministry approval, and start growing your student base on Malaysia's most trusted upskilling platform.</p>
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
    </body>
    </html>
