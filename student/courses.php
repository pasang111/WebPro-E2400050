<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'student') {
    header('Location: ../auth/login.php'); exit();
}

$student_id   = $_SESSION['user_id'];
$student_name = $_SESSION['user_name'] ?? 'Student';

// Get approved courses from database
$db_result = mysqli_query($conn, "
    SELECT c.*, p.org_name as provider_name
    FROM courses c
    JOIN providers p ON c.provider_id = p.id
    WHERE c.status = 'approved'
    ORDER BY c.created_at DESC
");

$db_courses = [];
while ($c = mysqli_fetch_assoc($db_result)) {
    $db_courses[] = $c;
}

// Placeholder courses — always show 6 minimum
$placeholder_courses = [
    ['id'=>1, 'title'=>'Full Stack Web Development',      'category'=>'Programming', 'duration'=>'8 Weeks', 'provider_name'=>'Tech Academy Malaysia',  'rating'=>'4.8', 'reviews'=>240, 'lessons'=>12],
    ['id'=>2, 'title'=>'Data Science & Analytics',        'category'=>'Data Science','duration'=>'6 Weeks', 'provider_name'=>'DataSkill Institute',      'rating'=>'5.0', 'reviews'=>98,  'lessons'=>10],
    ['id'=>3, 'title'=>'UI/UX Design Fundamentals',       'category'=>'Design',      'duration'=>'4 Weeks', 'provider_name'=>'Creative Hub KL',          'rating'=>'4.0', 'reviews'=>75,  'lessons'=>8],
    ['id'=>4, 'title'=>'Digital Marketing Essentials',    'category'=>'Business',    'duration'=>'3 Weeks', 'provider_name'=>'BizPro Academy',           'rating'=>'4.6', 'reviews'=>130, 'lessons'=>9],
    ['id'=>5, 'title'=>'Career Development & Leadership', 'category'=>'Business',    'duration'=>'5 Weeks', 'provider_name'=>'Leadership Institute MY',  'rating'=>'4.9', 'reviews'=>88,  'lessons'=>11],
    ['id'=>6, 'title'=>'Healthcare Management & Admin',   'category'=>'Healthcare',  'duration'=>'7 Weeks', 'provider_name'=>'MediSkill Centre',         'rating'=>'4.7', 'reviews'=>56,  'lessons'=>14],
];

// Merge DB courses with placeholders to always show at least 6
if (count($db_courses) >= 6) {
    $courses = $db_courses;
} elseif (count($db_courses) > 0) {
    $db_titles = array_map(function($c){ return strtolower($c['title']); }, $db_courses);
    $extra = [];
    foreach ($placeholder_courses as $p) {
        if (!in_array(strtolower($p['title']), $db_titles) && count($db_courses) + count($extra) < 6) {
            $extra[] = $p;
        }
    }
    $courses = array_merge($db_courses, $extra);
} else {
    $courses = $placeholder_courses;
}

// Smart image matching by course title
function getImage($title) {
    $t = strtolower($title);
    if (strpos($t,'web')!==false || strpos($t,'full stack')!==false)       return '../images/webdevelopment.jpg';
    if (strpos($t,'data')!==false)                                          return '../images/datascience.jpg';
    if (strpos($t,'ui')!==false || strpos($t,'ux')!==false || strpos($t,'design')!==false) return '../images/uiuxdesign.jpg';
    if (strpos($t,'digital')!==false || strpos($t,'marketing')!==false)    return '../images/digittalmarketing.jpg';
    if (strpos($t,'career')!==false || strpos($t,'leadership')!==false)    return '../images/carrerdevelopment.jpg';
    if (strpos($t,'health')!==false)                                        return '../images/healthcaremanagement.jpg';
    if (strpos($t,'php')!==false || strpos($t,'beginner')!==false)         return '../images/webdevelopment.jpg';
    if (strpos($t,'javascript')!==false)                                    return '../images/webdevelopment.jpg';
    return '../images/webdevelopment.jpg';
}

// Level badge based on category
function getLevelBadge($cat) {
    $map = [
        'Programming'  => ['class'=>'level-intermediate', 'text'=>'Intermediate'],
        'Data Science' => ['class'=>'level-advanced',     'text'=>'Advanced'],
        'Design'       => ['class'=>'level-beginner',     'text'=>'Beginner'],
        'Business'     => ['class'=>'level-intermediate', 'text'=>'Intermediate'],
        'Healthcare'   => ['class'=>'level-advanced',     'text'=>'Advanced'],
        'Languages'    => ['class'=>'level-beginner',     'text'=>'Beginner'],
    ];
    return $map[$cat] ?? ['class'=>'level-beginner','text'=>'Beginner'];
}

// Category badge style
function getCatStyle($cat) {
    $map = [
        'Programming'  => 'background:#dbeafe;color:#2563eb;',
        'Data Science' => 'background:#dcfce7;color:#16a34a;',
        'Design'       => 'background:#fce7f3;color:#db2777;',
        'Business'     => 'background:#fff7ed;color:#c2410c;',
        'Healthcare'   => 'background:#ccfbf1;color:#0f766e;',
        'Languages'    => 'background:#ede9fe;color:#7c3aed;',
    ];
    return $map[$cat] ?? 'background:#fff7ed;color:#f97316;';
}

// Star rating display
function getStars($rating) {
    $r = floatval($rating);
    $full = floor($r);
    $half = ($r - $full) >= 0.3 ? 1 : 0;
    $empty = 5 - $full - $half;
    $html = '';
    for ($i=0;$i<$full;$i++)  $html .= '<i class="fas fa-star"></i>';
    if ($half)                 $html .= '<i class="fas fa-star-half-alt"></i>';
    for ($i=0;$i<$empty;$i++) $html .= '<i class="far fa-star"></i>';
    return $html;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Courses - EduSkill</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Fraunces:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/pasang.css">
    <link rel="stylesheet" href="../css/shreeyash.css">
    <link rel="stylesheet" href="../css/darkmode.css">
    <script src="../js/darkmode.js"></script>
</head>
<body class="dashboard-body">
<div class="dashboard-wrap">

    <!-- SIDEBAR -->
    <aside class="dash-sidebar">
        <div class="dsb-brand">
            <a href="../index.php">
                <img src="../images/logo.png" alt="Logo" style="width:30px;height:30px;border-radius:8px;object-fit:cover;" onerror="this.style.display='none'">
                <span class="dsb-brand-text ml-2">EDU<span class="dsb-brand-accent">SKILL</span></span>
            </a>
        </div>
        <div class="dsb-role-badge student-role-badge">
            <i class="fas fa-user-graduate mr-2"></i> Student
        </div>
        <nav class="dsb-nav">
            <a href="dashboard.php"  class="dsb-link"><i class="fas fa-th-large"></i> Dashboard</a>
            <a href="courses.php"    class="dsb-link active"><i class="fas fa-book-open"></i> Browse Courses</a>
            <a href="my_courses.php" class="dsb-link"><i class="fas fa-graduation-cap"></i> My Enrollments</a>
        </nav>
        <div class="dark-toggle-wrap mt-3" style="padding:0 16px;">
            <i class="fas fa-sun toggle-icon" style="color:#6b7280;font-size:13px;"></i>
            <label class="dark-switch" style="margin:0 8px;">
                <input type="checkbox" id="darkModeToggle">
                <span class="dark-slider"></span>
            </label>
            <i class="fas fa-moon toggle-icon" style="color:#6b7280;font-size:13px;"></i>
            <span style="font-size:12px;color:#6b7280;margin-left:4px;">Dark Mode</span>
        </div>
        <div class="dsb-bottom">
            <div class="dsb-user-info">
                <div class="dsb-avatar"><?php echo strtoupper(substr($student_name,0,1)); ?></div>
                <div>
                    <strong><?php echo htmlspecialchars($student_name); ?></strong>
                    <span>Student</span>
                </div>
            </div>
            <a href="../auth/logout.php" class="dsb-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="dash-main">
        <div class="dash-topbar">
            <div>
                <h4 class="dash-page-title">Browse Courses</h4>
                <p class="dash-page-sub">Find and enroll in certified courses from approved providers</p>
            </div>
        </div>

        <div class="dash-content">

            <!-- Search and filter -->
            <div class="mb-4 d-flex" style="gap:12px; flex-wrap:wrap;">
                <div class="input-group flex-grow-1" style="min-width:200px;">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="background:white;border:1.5px solid #e8e8e8;border-right:none;border-radius:10px 0 0 10px;color:#9ca3af;">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                    <input type="text" id="courseSearch" class="form-control" placeholder="Search courses..."
                           style="border:1.5px solid #e8e8e8;border-left:none;border-radius:0 10px 10px 0;font-size:14px;font-family:'Outfit',sans-serif;height:46px;">
                </div>
                <select id="categoryFilter" class="form-control"
                        style="width:180px;flex:0 0 180px;border:1.5px solid #e8e8e8;border-radius:10px;font-size:14px;font-family:'Outfit',sans-serif;height:46px;">
                    <option value="">All Categories</option>
                    <option>Programming</option>
                    <option>Data Science</option>
                    <option>Design</option>
                    <option>Business</option>
                    <option>Healthcare</option>
                    <option>Languages</option>
                </select>
            </div>

            <!-- Course grid -->
            <div class="row" id="courseGrid">

                <?php foreach ($courses as $idx => $c):
                    $badge    = getLevelBadge($c['category']);
                    $catStyle = getCatStyle($c['category']);
                    $img      = getImage($c['title']);
                    $rating   = isset($c['rating'])  ? $c['rating']  : '4.5';
                    $reviews  = isset($c['reviews']) ? $c['reviews'] : '50';
                    $lessons  = isset($c['lessons']) ? $c['lessons'] : '8';
                ?>
                <div class="col-md-6 col-lg-4 mb-4 course-item"
                     data-category="<?php echo htmlspecialchars($c['category']); ?>"
                     data-title="<?php echo strtolower(htmlspecialchars($c['title'])); ?>">
                    <div class="course-card">

                        <!-- Image -->
                        <div class="course-img" style="position:relative;height:200px;overflow:hidden;">
                            <img src="<?php echo $img; ?>"
                                 alt="<?php echo htmlspecialchars($c['title']); ?>"
                                 style="width:100%;height:100%;object-fit:cover;transition:transform 0.4s;"
                                 onerror="this.parentNode.style.background='linear-gradient(135deg,#f97316,#ea580c)';this.style.display='none'">
                            <span class="course-level-badge <?php echo $badge['class']; ?>">
                                <?php echo $badge['text']; ?>
                            </span>
                        </div>

                        <!-- Body -->
                        <div class="course-body">
                            <span class="course-cat" style="<?php echo $catStyle; ?>">
                                <?php echo htmlspecialchars($c['category']); ?>
                            </span>
                            <h5 class="course-title"><?php echo htmlspecialchars($c['title']); ?></h5>
                            <p class="course-instructor">
                                <i class="fas fa-user mr-1"></i><?php echo htmlspecialchars($c['provider_name']); ?>
                            </p>
                            <div class="course-rating">
                                <span class="stars"><?php echo getStars($rating); ?></span>
                                <span class="rating-num"><?php echo $rating; ?></span>
                                <span class="rating-count">(<?php echo $reviews; ?> reviews)</span>
                            </div>
                            <div class="course-meta">
                                <span><i class="fas fa-clock"></i> <?php echo htmlspecialchars($c['duration']); ?></span>
                                <span><i class="fas fa-book"></i> <?php echo $lessons; ?> Lessons</span>
                            </div>
                            <a href="enroll.php?id=<?php echo $c['id']; ?>" class="btn-enroll">Enroll Now</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

                <div class="col-12 text-center py-5 text-muted d-none" id="noCourses">
                    <i class="fas fa-search" style="font-size:36px;color:#d1d5db;display:block;margin-bottom:12px;"></i>
                    <p>No courses found. Try a different search.</p>
                </div>

            </div>
        </div>
    </main>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../js/shreeyash.js"></script>
<script>
var searchInput    = document.getElementById('courseSearch');
var categoryFilter = document.getElementById('categoryFilter');

function filterCourses() {
    var search   = searchInput ? searchInput.value.toLowerCase() : '';
    var category = categoryFilter ? categoryFilter.value : '';
    var items    = document.querySelectorAll('.course-item');
    var visible  = 0;

    items.forEach(function(item) {
        var title = item.getAttribute('data-title');
        var cat   = item.getAttribute('data-category');
        var matchS = search === '' || title.includes(search);
        var matchC = category === '' || cat === category;
        if (matchS && matchC) { item.style.display = 'block'; visible++; }
        else                  { item.style.display = 'none'; }
    });

    var noCoursesEl = document.getElementById('noCourses');
    if (noCoursesEl) noCoursesEl.classList.toggle('d-none', visible > 0);
}

if (searchInput)    searchInput.addEventListener('input', filterCourses);
if (categoryFilter) categoryFilter.addEventListener('change', filterCourses);
</script>
</body>
</html>