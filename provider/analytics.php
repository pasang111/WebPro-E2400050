<?php

session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'provider') {
    header('Location: ../auth/login.php'); exit();
}

$provider_id   = $_SESSION['user_id'];
$provider_name = $_SESSION['user_name'] ?? 'Provider';

$total_courses     = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM courses WHERE provider_id=$provider_id AND status='approved'"))['c'];
$total_enrollments = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM enrollments e JOIN courses c ON e.course_id=c.id WHERE c.provider_id=$provider_id"))['c'];
$approved_enroll   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM enrollments e JOIN courses c ON e.course_id=c.id WHERE c.provider_id=$provider_id AND e.status='approved'"))['c'];
$pending_enroll    = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM enrollments e JOIN courses c ON e.course_id=c.id WHERE c.provider_id=$provider_id AND e.status='pending'"))['c'];

$courses_result = mysqli_query($conn, "
    SELECT
        c.id, c.title, c.category, c.duration,
        COUNT(e.id) as total_enrollments,
        SUM(CASE WHEN e.status='approved'  THEN 1 ELSE 0 END) as approved,
        SUM(CASE WHEN e.status='pending'   THEN 1 ELSE 0 END) as pending,
        SUM(CASE WHEN e.status='rejected'  THEN 1 ELSE 0 END) as rejected
    FROM courses c
    LEFT JOIN enrollments e ON e.course_id = c.id
    WHERE c.provider_id = $provider_id AND c.status = 'approved'
    GROUP BY c.id
    ORDER BY total_enrollments DESC
");

$chart_labels = [];
$chart_data   = [];
$rows         = [];
while ($c = mysqli_fetch_assoc($courses_result)) {
    $rows[]         = $c;
    $chart_labels[] = $c['title'];
    $chart_data[]   = intval($c['total_enrollments']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Analytics - EduSkill Provider</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/pasang.css">
    <link rel="stylesheet" href="../css/archana.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
</head>
<body class="dashboard-body">
<div class="dashboard-wrap">

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
            <a href="edit_course.php" class="dsb-link"><i class="fas fa-edit"></i> Manage Courses</a>
            <a href="course_students.php" class="dsb-link"><i class="fas fa-users"></i> Enrolled Students</a>
            <a href="analytics.php" class="dsb-link active"><i class="fas fa-chart-bar"></i> Analytics</a>
        </nav>
        <div class="dsb-bottom">
            <div class="dsb-user-info">
                <div class="dsb-avatar provider-avatar"><?php echo strtoupper(substr($provider_name,0,1)); ?></div>
                <div><strong><?php echo htmlspecialchars($provider_name); ?></strong><span>Provider</span></div>
            </div>
            <a href="../auth/logout.php" class="dsb-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </aside>

    <main class="dash-main">
        <div class="dash-topbar">
            <div>
                <h4 class="dash-page-title">My Analytics</h4>
                <p class="dash-page-sub">Your course performance and enrollment overview</p>
            </div>
        </div>

        <div class="dash-content">

            <!-- STAT CARDS -->
            <div class="row mb-4">
                <div class="col-6 col-lg-3 mb-3">
                    <div class="dstat-card">
                        <div class="dstat-icon dstat-icon-orange"><i class="fas fa-book-open"></i></div>
                        <div class="dstat-info"><h3><?php echo $total_courses; ?></h3><p>Active Courses</p></div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3">
                    <div class="dstat-card">
                        <div class="dstat-icon dstat-icon-blue"><i class="fas fa-users"></i></div>
                        <div class="dstat-info"><h3><?php echo $total_enrollments; ?></h3><p>Total Enrollments</p></div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3">
                    <div class="dstat-card">
                        <div class="dstat-icon dstat-icon-green"><i class="fas fa-check-circle"></i></div>
                        <div class="dstat-info"><h3><?php echo $approved_enroll; ?></h3><p>Approved</p></div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3">
                    <div class="dstat-card">
                        <div class="dstat-icon dstat-icon-orange"><i class="fas fa-clock"></i></div>
                        <div class="dstat-info"><h3><?php echo $pending_enroll; ?></h3><p>Pending</p></div>
                    </div>
                </div>
            </div>

            <!-- BAR CHART -->
            <?php if (count($rows) > 0): ?>
            <div class="dash-card mb-4">
                <div class="dash-card-head">
                    <h5><i class="fas fa-chart-bar mr-2"></i>Enrollments Per Course</h5>
                </div>
                <div class="analytics-chart-body">
                    <canvas id="providerChart"></canvas>
                </div>
            </div>
            <?php endif; ?>

            <!-- TABLE -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <h5><i class="fas fa-table mr-2"></i>Course Enrollment Details</h5>
                </div>
                <div class="dash-table-wrap">
                    <table class="table dash-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Course Title</th>
                                <th>Category</th>
                                <th>Duration</th>
                                <th>Total</th>
                                <th>Approved</th>
                                <th>Pending</th>
                                <th>Rejected</th>
                                <th>Approval Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($rows)): ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
                                    No approved courses yet. Add a course and get it approved first.
                                </td>
                            </tr>
                            <?php endif; ?>
                            <?php foreach ($rows as $i => $c):
                                $pct = $c['total_enrollments'] > 0 ? round(($c['approved'] / $c['total_enrollments']) * 100) : 0;
                            ?>
                            <tr>
                                <td><?php echo $i + 1; ?></td>
                                <td><strong><?php echo htmlspecialchars($c['title']); ?></strong></td>
                                <td><?php echo htmlspecialchars($c['category']); ?></td>
                                <td><?php echo htmlspecialchars($c['duration']); ?></td>
                                <td><strong><?php echo $c['total_enrollments']; ?></strong></td>
                                <td><span class="status-approved"><?php echo $c['approved']; ?></span></td>
                                <td><span class="status-pending"><?php echo $c['pending']; ?></span></td>
                                <td><span class="status-rejected"><?php echo $c['rejected']; ?></span></td>
                                <td>
                                    <div class="analytics-progress-wrap">
                                        <div class="analytics-progress-bar">
                                            <div class="analytics-progress-fill" style="width:<?php echo $pct; ?>%"></div>
                                        </div>
                                        <span class="analytics-progress-pct"><?php echo $pct; ?>%</span>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
var chartLabels = <?php echo json_encode($chart_labels); ?>;
var chartData   = <?php echo json_encode($chart_data); ?>;

var ctx = document.getElementById('providerChart');
if (ctx && chartLabels.length > 0) {
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Total Enrollments',
                data: chartData,
                backgroundColor: 'rgba(249,115,22,0.85)',
                borderRadius: 8,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: 'rgba(0,0,0,0.05)' } },
                x: { grid: { display: false } }
            }
        }
    });
}
</script>
</body>
</html>