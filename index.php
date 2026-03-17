<?php
// index.php - EduSkill Home Page
// Responsible: Pasang Lama (Team Lead)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSkill - Malaysia's Learning Marketplace</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Lora:ital,wght@0,400;0,600;1,400;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<!-- HERO SLIDER -->
<section class="hero-slider-section">
    <div class="hero-slider" id="heroSlider">

        <!-- Slide 1 -->
        <div class="hero-slide active">
            <div class="hero-slide-bg" style="background: linear-gradient(135deg, #f0f7ff 0%, #e8f0fe 100%);"></div>
            <div class="container hero-slide-content">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <span class="hero-tag">Online Learning Platform</span>
                        <h1 class="hero-h">
                            Learn New Skills From <em>Certified Providers</em> Across Malaysia
                        </h1>
                        <p class="hero-p">Browse hundreds of short courses, workshops and certification programmes from Ministry-approved training providers.</p>
                        <div class="hero-btns">
                            <a href="#" class="btn-hero-main">Explore Courses <i class="fas fa-arrow-right ml-2"></i></a>
                            <a href="about.php" class="btn-hero-ghost ml-3">Learn More</a>
                        </div>
                        <div class="hero-stats-row">
                            <div class="hsr-item"><strong>10,000+</strong><span>Students</span></div>
                            <div class="hsr-div"></div>
                            <div class="hsr-item"><strong>500+</strong><span>Courses</span></div>
                            <div class="hsr-div"></div>
                            <div class="hsr-item"><strong>200+</strong><span>Providers</span></div>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center mt-4 mt-lg-0">
                        <div class="hero-img-block">
                            <img src="images/studentlearner.jpg" alt="Students learning online" class="hero-main-img">
                            <div class="hero-pill pill-top">
                                <i class="fas fa-certificate"></i>
                                <div><strong>Ministry Certified</strong><span>All courses verified</span></div>
                            </div>
                            <div class="hero-pill pill-bottom">
                                <i class="fas fa-users"></i>
                                <div><strong>10,000+ Learners</strong><span>Across Malaysia</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="hero-slide">
            <div class="hero-slide-bg" style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);"></div>
            <div class="container hero-slide-content">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <span class="hero-tag hero-tag-green">For Training Providers</span>
                        <h1 class="hero-h">
                            List Your Courses and <em>Reach Thousands</em> of Learners
                        </h1>
                        <p class="hero-p">Register your organisation, get approved by the Ministry of Human Resources, and start growing your student base today.</p>
                        <div class="hero-btns">
                            <a href="auth/signup_provider.php" class="btn-hero-green">Register as Provider <i class="fas fa-arrow-right ml-2"></i></a>
                            <a href="about.php" class="btn-hero-ghost ml-3">Learn More</a>
                        </div>
                        <div class="hero-stats-row">
                            <div class="hsr-item"><strong>200+</strong><span>Providers</span></div>
                            <div class="hsr-div"></div>
                            <div class="hsr-item"><strong>13</strong><span>States</span></div>
                            <div class="hsr-div"></div>
                            <div class="hsr-item"><strong>95%</strong><span>Satisfaction</span></div>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center mt-4 mt-lg-0">
                        <div class="hero-img-block">
                            <img src="images/Trainingprovider.jpg" alt="Training providers" class="hero-main-img">
                            <div class="hero-pill pill-top pill-green">
                                <i class="fas fa-building"></i>
                                <div><strong>200+ Providers</strong><span>Ministry Approved</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="hero-slide">
            <div class="hero-slide-bg" style="background: linear-gradient(135deg, #fefce8 0%, #fef9c3 100%);"></div>
            <div class="container hero-slide-content">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <span class="hero-tag hero-tag-orange">Career Development</span>
                        <h1 class="hero-h">
                            Upskill, Reskill and <em>Advance Your Career</em> With EduSkill
                        </h1>
                        <p class="hero-p">From programming to design to business management — find the right course to take your career to the next level.</p>
                        <div class="hero-btns">
                            <a href="auth/signup_student.php" class="btn-hero-orange">Join for Free <i class="fas fa-arrow-right ml-2"></i></a>
                            <a href="about.php" class="btn-hero-ghost ml-3">Learn More</a>
                        </div>
                        <div class="hero-stats-row">
                            <div class="hsr-item"><strong>500+</strong><span>Courses</span></div>
                            <div class="hsr-div"></div>
                            <div class="hsr-item"><strong>Free</strong><span>To Sign Up</span></div>
                            <div class="hsr-div"></div>
                            <div class="hsr-item"><strong>Certified</strong><span>Programmes</span></div>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center mt-4 mt-lg-0">
                        <div class="hero-img-block">
                            <img src="images/careerdevelopment.jpg" alt="Career development" class="hero-main-img">
                            <div class="hero-pill pill-top pill-orange">
                                <i class="fas fa-rocket"></i>
                                <div><strong>Career Growth</strong><span>Industry aligned</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Slider controls -->
    <div class="slider-controls">
        <button class="slider-prev" onclick="changeSlide(-1)"><i class="fas fa-chevron-left"></i></button>
        <div class="slider-dots">
            <span class="sdot active" onclick="goToSlide(0)"></span>
            <span class="sdot" onclick="goToSlide(1)"></span>
            <span class="sdot" onclick="goToSlide(2)"></span>
        </div>
        <button class="slider-next" onclick="changeSlide(1)"><i class="fas fa-chevron-right"></i></button>
    </div>
</section>

<!-- STATS BAR -->
<section class="stats-bar">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-6 col-md-3 mb-3 mb-md-0">
                <div class="sbar-item">
                    <i class="fas fa-book-open sbar-ico"></i>
                    <h3>500+</h3>
                    <p>Courses Available</p>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-3 mb-md-0">
                <div class="sbar-item">
                    <i class="fas fa-user-graduate sbar-ico"></i>
                    <h3>10,000+</h3>
                    <p>Students Enrolled</p>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-3 mb-md-0">
                <div class="sbar-item">
                    <i class="fas fa-building sbar-ico"></i>
                    <h3>200+</h3>
                    <p>Training Providers</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="sbar-item">
                    <i class="fas fa-certificate sbar-ico"></i>
                    <h3>95%</h3>
                    <p>Satisfaction Rate</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CATEGORIES -->
<section class="sec-pad bg-light">
    <div class="container">
        <div class="sec-head text-center mb-5">
            <span class="sec-tag">Browse by Category</span>
            <h2 class="sec-title">Explore Course Categories</h2>
            <p class="sec-sub">Find the right course for your career goals</p>
        </div>
        <div class="row">
            <div class="col-6 col-md-4 col-lg-2 mb-3">
                <a href="#" class="cat-card">
                    <div class="cat-ico-wrap" style="background:#dbeafe;"><i class="fas fa-laptop-code" style="color:#1d4ed8;"></i></div>
                    <span class="cat-name">Programming</span>
                    <span class="cat-count">48 courses</span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2 mb-3">
                <a href="#" class="cat-card">
                    <div class="cat-ico-wrap" style="background:#dcfce7;"><i class="fas fa-chart-bar" style="color:#15803d;"></i></div>
                    <span class="cat-name">Data Science</span>
                    <span class="cat-count">32 courses</span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2 mb-3">
                <a href="#" class="cat-card">
                    <div class="cat-ico-wrap" style="background:#fce7f3;"><i class="fas fa-palette" style="color:#be185d;"></i></div>
                    <span class="cat-name">Design</span>
                    <span class="cat-count">28 courses</span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2 mb-3">
                <a href="#" class="cat-card">
                    <div class="cat-ico-wrap" style="background:#ffedd5;"><i class="fas fa-briefcase" style="color:#c2410c;"></i></div>
                    <span class="cat-name">Business</span>
                    <span class="cat-count">36 courses</span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2 mb-3">
                <a href="#" class="cat-card">
                    <div class="cat-ico-wrap" style="background:#ede9fe;"><i class="fas fa-heartbeat" style="color:#7c3aed;"></i></div>
                    <span class="cat-name">Healthcare</span>
                    <span class="cat-count">22 courses</span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2 mb-3">
                <a href="#" class="cat-card">
                    <div class="cat-ico-wrap" style="background:#ccfbf1;"><i class="fas fa-language" style="color:#0f766e;"></i></div>
                    <span class="cat-name">Languages</span>
                    <span class="cat-count">18 courses</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- POPULAR COURSES -->
<section class="sec-pad bg-white">
    <div class="container">
        <div class="sec-head text-center mb-5">
            <span class="sec-tag">Top Picks</span>
            <h2 class="sec-title">Popular Courses</h2>
            <p class="sec-sub">Courses our learners love the most</p>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="course-card">
                    <div class="course-img">
                        <img src="images/webdevelopment.jpg" alt="Web Development">
                        <span class="course-badge">Most Popular</span>
                    </div>
                    <div class="course-body">
                        <span class="course-cat">Programming</span>
                        <h5 class="course-title">Full Stack Web Development</h5>
                        <p class="course-provider"><i class="fas fa-building mr-1"></i> Tech Academy Malaysia</p>
                        <div class="course-rating">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                            <span>4.8 (240 reviews)</span>
                        </div>
                        <div class="course-footer">
                            <span class="course-dur"><i class="fas fa-clock mr-1"></i> 8 Weeks</span>
                            <a href="#" class="btn-enroll">Enroll Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="course-card">
                    <div class="course-img">
                        <img src="images/datascience.jpg" alt="Data Science">
                    </div>
                    <div class="course-body">
                        <span class="course-cat course-cat-green">Data Science</span>
                        <h5 class="course-title">Data Science & Analytics</h5>
                        <p class="course-provider"><i class="fas fa-building mr-1"></i> DataSkill Institute</p>
                        <div class="course-rating">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            <span>5.0 (98 reviews)</span>
                        </div>
                        <div class="course-footer">
                            <span class="course-dur"><i class="fas fa-clock mr-1"></i> 6 Weeks</span>
                            <a href="#" class="btn-enroll">Enroll Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="course-card">
                    <div class="course-img">
                        <img src="images/uiuxdesign.jpg" alt="UI/UX Design">
                    </div>
                    <div class="course-body">
                        <span class="course-cat course-cat-pink">Design</span>
                        <h5 class="course-title">UI/UX Design Fundamentals</h5>
                        <p class="course-provider"><i class="fas fa-building mr-1"></i> Creative Hub KL</p>
                        <div class="course-rating">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                            <span>4.0 (75 reviews)</span>
                        </div>
                        <div class="course-footer">
                            <span class="course-dur"><i class="fas fa-clock mr-1"></i> 4 Weeks</span>
                            <a href="#" class="btn-enroll">Enroll Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-2">
            <a href="#" class="btn-outline-main">View All Courses <i class="fas fa-arrow-right ml-1"></i></a>
        </div>
    </div>
</section>

<!-- WHY EDUSKILL -->
<section class="sec-pad why-sec">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <span class="sec-tag">Why EduSkill</span>
                <h2 class="sec-title">The Smarter Way to Upskill in Malaysia</h2>
                <p class="text-muted">Every feature on EduSkill is built around one goal — helping Malaysians gain real, job-ready skills from verified training providers.</p>
                <a href="auth/signup_student.php" class="btn-main mt-3">Get Started Free <i class="fas fa-arrow-right ml-2"></i></a>
            </div>
            <div class="col-lg-7">
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <div class="why-card">
                            <div class="why-ico" style="background:#dbeafe; color:#1d4ed8;"><i class="fas fa-chalkboard-teacher"></i></div>
                            <h6>Expert Instructors</h6>
                            <p>Learn from industry professionals and certified trainers with real-world experience.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="why-card">
                            <div class="why-ico" style="background:#dcfce7; color:#15803d;"><i class="fas fa-clock"></i></div>
                            <h6>Flexible Learning</h6>
                            <p>Study at your own pace online. Access course materials anytime, anywhere you are.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="why-card">
                            <div class="why-ico" style="background:#fce7f3; color:#be185d;"><i class="fas fa-certificate"></i></div>
                            <h6>Ministry Certified</h6>
                            <p>All courses and providers go through a strict approval process by the Ministry.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="why-card">
                            <div class="why-ico" style="background:#ffedd5; color:#c2410c;"><i class="fas fa-briefcase"></i></div>
                            <h6>Career Focused</h6>
                            <p>Courses are designed around Malaysia's current industry demands and skills needs.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONIALS SLIDER -->
<section class="sec-pad bg-light">
    <div class="container">
        <div class="sec-head text-center mb-5">
            <span class="sec-tag">Student Reviews</span>
            <h2 class="sec-title">What Our Learners Say</h2>
            <p class="sec-sub">Real feedback from real students across Malaysia</p>
        </div>
        <div class="testimonial-slider" id="testimonialsSlider">
            <div class="row testimonial-track">
                <div class="col-md-4 mb-4">
                    <div class="tcard">
                        <div class="tcard-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        <p class="tcard-text">"EduSkill helped me transition into a tech career. The Web Development course was practical and the instructor was incredibly supportive."</p>
                        <div class="tcard-author">
                            <div class="tcard-av" style="background:#1d4ed8;">A</div>
                            <div><strong>Ahmad Faris</strong><span>Web Development Graduate</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="tcard">
                        <div class="tcard-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        <p class="tcard-text">"The Data Science course completely changed my career path. The platform is easy to use and the content is directly relevant to what employers need."</p>
                        <div class="tcard-author">
                            <div class="tcard-av" style="background:#15803d;">N</div>
                            <div><strong>Nurul Aina</strong><span>Data Science Graduate</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="tcard">
                        <div class="tcard-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></div>
                        <p class="tcard-text">"The UI/UX Design course gave me the confidence to build a proper portfolio. Highly recommend EduSkill to anyone looking to upskill professionally."</p>
                        <div class="tcard-author">
                            <div class="tcard-av" style="background:#be185d;">R</div>
                            <div><strong>Ravi Kumar</strong><span>UI/UX Design Graduate</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="tcard">
                        <div class="tcard-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        <p class="tcard-text">"I enrolled in a Business Management course and it helped me get a promotion within 3 months. The quality of content is outstanding."</p>
                        <div class="tcard-author">
                            <div class="tcard-av" style="background:#7c3aed;">S</div>
                            <div><strong>Siti Nabilah</strong><span>Business Management Graduate</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="tcard">
                        <div class="tcard-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        <p class="tcard-text">"As someone from Sabah, I could not afford to travel to KL for training. EduSkill made it possible for me to learn from home and get certified."</p>
                        <div class="tcard-author">
                            <div class="tcard-av" style="background:#0f766e;">J</div>
                            <div><strong>James Lim</strong><span>Digital Marketing Graduate</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="tcard">
                        <div class="tcard-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
                        <p class="tcard-text">"The enrollment process was smooth and the admin was very responsive. Got my course approved within 2 days. Very satisfied with EduSkill."</p>
                        <div class="tcard-author">
                            <div class="tcard-av" style="background:#c2410c;">F</div>
                            <div><strong>Farah Liyana</strong><span>Healthcare Graduate</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="t-slider-nav text-center mt-3">
                <button class="t-prev" onclick="changeTestimonial(-1)"><i class="fas fa-chevron-left"></i></button>
                <button class="t-next" onclick="changeTestimonial(1)"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>
</section>

<!-- PROVIDER CTA -->
<section class="provider-cta">
    <div class="container">
        <div class="pcta-box">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <p class="pcta-eyebrow">For Training Providers</p>
                    <h2 class="pcta-title">List Your Courses. Reach Thousands of Learners.</h2>
                    <p class="pcta-sub">Register your organisation, get approved by the Ministry, and start listing your courses on Malaysia's trusted upskilling platform.</p>
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
