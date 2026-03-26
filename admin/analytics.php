<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: ../auth/login.php'); exit();
}

// Filter by provider if selected
$filter_provider = isset($_GET['provider_id']) ? intval($_GET['provider_id']) : 0;

// ── SYSTEM-WIDE STATS ──────────────────────
$total_students   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM students"))['c'];
$total_providers  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM providers WHERE status='approved'"))['c'];
$total_courses    = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM courses WHERE status='approved'"))['c'];
$total_enrollments= mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM enrollments"))['c'];
$approved_enroll  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM enrollments WHERE status='approved'"))['c'];
$pending_enroll   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM enrollments WHERE status='pending'"))['c'];

// ── ENROLLMENTS PER COURSE ─────────────────
$course_query = "
    SELECT
        c.id,
        c.title,
        c.category,
        c.duration,
        p.org_name as provider,
        COUNT(e.id) as total_enrollments,
        SUM(CASE WHEN e.status='approved'  THEN 1 ELSE 0 END) as approved,
        SUM(CASE WHEN e.status='pending'   THEN 1 ELSE 0 END) as pending,
        SUM(CASE WHEN e.status='rejected'  THEN 1 ELSE 0 END) as rejected
    FROM courses c
    JOIN providers p ON c.provider_id = p.id
    LEFT JOIN enrollments e ON e.course_id = c.id
    WHERE c.status = 'approved'
";

if ($filter_provider > 0) {
    $course_query .= " AND c.provider_id = $filter_provider";
}

$course_query .= " GROUP BY c.id ORDER BY total_enrollments DESC";
$courses_result = mysqli_query($conn, $course_query);

// ── ENROLLMENTS PER PROVIDER ───────────────
$provider_query = "
    SELECT
        p.id,
        p.org_name,
        COUNT(DISTINCT c.id) as total_courses,
        COUNT(e.id) as total_enrollments,
        SUM(CASE WHEN e.status='approved' THEN 1 ELSE 0 END) as approved_enrollments
    FROM providers p
    LEFT JOIN courses c ON c.provider_id = p.id AND c.status = 'approved'
    LEFT JOIN enrollments e ON e.course_id = c.id
    WHERE p.status = 'approved'
    GROUP BY p.id
    ORDER BY total_enrollments DESC
";
$providers_result = mysqli_query($conn, $provider_query);

// ── MONTHLY ENROLLMENT TREND ───────────────
$monthly_result = mysqli_query($conn, "
    SELECT
        DATE_FORMAT(enrolled_at, '%b %Y') as month,
        COUNT(*) as total
    FROM enrollments
    GROUP BY DATE_FORMAT(enrolled_at, '%Y-%m')
    ORDER BY enrolled_at ASC
    LIMIT 6
");

$months = []; $monthly_counts = [];
while ($row = mysqli_fetch_assoc($monthly_result)) {
    $months[]         = $row['month'];
    $monthly_counts[] = $row['total'];
}

// ── PROVIDER FILTER LIST ───────────────────
$all_providers = mysqli_query($conn, "SELECT id, org_name FROM providers WHERE status='approved' ORDER BY org_name ASC");

$pending_providers   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM providers WHERE status='pending'"))['c'];
$pending_enrollments = $pending_enroll;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics Reports - EduSkill Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/pasang.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
</head>
<body class="dashboard-body">
<div class="dashboard-wrap">

    <!-- SIDEBAR -->
    <aside class="dash-sidebar admin-sidebar">
        <div class="dsb-brand">
            <a href="../index.php">
                <img src="../images/logo.png" alt="Logo" class="dsb-brand-img" onerror="this.style.display='none'">
                <span class="dsb-brand-text ml-2">EDU<span class="dsb-brand-accent">SKILL</span></span>
            </a>
        </div>
        <div class="dsb-role-badge">
            <i class="fas fa-user-shield mr-2"></i> Ministry Officer
        </div>
        <nav class="dsb-nav">
            <a href="dashboard.php"          class="dsb-link"><i class="fas fa-th-large"></i> Dashboard</a>
            <a href="approve_providers.php"  class="dsb-link">
                <i class="fas fa-building"></i> Provider Approvals
                <?php if($pending_providers > 0): ?><span class="dsb-badge"><?php echo $pending_providers; ?></span><?php endif; ?>
            </a>
            <a href="approve_enrollments.php" class="dsb-link">
                <i class="fas fa-user-check"></i> Enrollments
                <?php if($pending_enrollments > 0): ?><span class="dsb-badge"><?php echo $pending_enrollments; ?></span><?php endif; ?>
            </a>
            <a href="manage_courses.php"     class="dsb-link"><i class="fas fa-book-open"></i> Courses</a>
            <a href="analytics.php"          class="dsb-link active"><i class="fas fa-chart-bar"></i> Analytics</a>
        </nav>
        <div class="dsb-bottom">
            <a href="../auth/logout.php" class="dsb-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="dash-main">
        <div class="dash-topbar">
            <div>
                <h4 class="dash-page-title">Analytics Reports</h4>
                <p class="dash-page-sub">System-wide enrollment and provider performance data</p>
            </div>
            <div class="dash-topbar-right">
                <!-- Filter by provider -->
                <form method="GET" action="" class="analytics-filter-form">
                    <select name="provider_id" class="analytics-select" onchange="this.form.submit()">
                        <option value="0">All Providers</option>
                        <?php
                        mysqli_data_seek($all_providers, 0);
                        while ($p = mysqli_fetch_assoc($all_providers)):
                        ?>
                        <option value="<?php echo $p['id']; ?>" <?php echo $filter_provider == $p['id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($p['org_name']); ?>
                        </option>
                        <?php endwhile; ?>
                    </select>
                </form>
            </div>
        </div>

        <div class="dash-content">

            <!-- SYSTEM STATS ROW -->
            <div class="row mb-4">
                <div class="col-6 col-lg-2 mb-3">
                    <div class="dstat-card">
                        <div class="dstat-icon dstat-icon-blue"><i class="fas fa-user-graduate"></i></div>
                        <div class="dstat-info"><h3><?php echo $total_students; ?></h3><p>Students</p></div>
                    </div>
                </div>
                <div class="col-6 col-lg-2 mb-3">
                    <div class="dstat-card">
                        <div class="dstat-icon dstat-icon-green"><i class="fas fa-building"></i></div>
                        <div class="dstat-info"><h3><?php echo $total_providers; ?></h3><p>Providers</p></div>
                    </div>
                </div>
                <div class="col-6 col-lg-2 mb-3">
                    <div class="dstat-card">
                        <div class="dstat-icon dstat-icon-orange"><i class="fas fa-book-open"></i></div>
                        <div class="dstat-info"><h3><?php echo $total_courses; ?></h3><p>Courses</p></div>
                    </div>
                </div>
                <div class="col-6 col-lg-2 mb-3">
                    <div class="dstat-card">
                        <div class="dstat-icon dstat-icon-purple"><i class="fas fa-users"></i></div>
                        <div class="dstat-info"><h3><?php echo $total_enrollments; ?></h3><p>Total Enrollments</p></div>
                    </div>
                </div>
                <div class="col-6 col-lg-2 mb-3">
                    <div class="dstat-card">
                        <div class="dstat-icon dstat-icon-green"><i class="fas fa-check-circle"></i></div>
                        <div class="dstat-info"><h3><?php echo $approved_enroll; ?></h3><p>Approved</p></div>
                    </div>
                </div>
                <div class="col-6 col-lg-2 mb-3">
                    <div class="dstat-card">
                        <div class="dstat-icon dstat-icon-orange"><i class="fas fa-clock"></i></div>
                        <div class="dstat-info"><h3><?php echo $pending_enroll; ?></h3><p>Pending</p></div>
                    </div>
                </div>
            </div>

            <!-- CHARTS ROW -->
            <div class="row mb-4">
                <!-- Monthly Enrollment Trend -->
                <div class="col-lg-8 mb-4">
                    <div class="dash-card analytics-chart-card">
                        <div class="dash-card-head">
                            <h5><i class="fas fa-chart-line mr-2"></i>Monthly Enrollment Trend</h5>
                        </div>
                        <div class="analytics-chart-body">
                            <canvas id="enrollmentChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Enrollment Status Donut -->
                <div class="col-lg-4 mb-4">
                    <div class="dash-card analytics-chart-card">
                        <div class="dash-card-head">
                            <h5><i class="fas fa-chart-pie mr-2"></i>Enrollment Status</h5>
                        </div>
                        <div class="analytics-chart-body">
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ENROLLMENTS PER COURSE TABLE -->
            <div class="dash-card mb-4">
                <div class="dash-card-head">
                    <h5><i class="fas fa-book mr-2"></i>Enrollments Per Course</h5>
                    <?php if ($filter_provider > 0): ?>
                    <a href="analytics.php" class="dash-card-link">Clear Filter</a>
                    <?php endif; ?>
                </div>
                <div class="dash-table-wrap">
                    <table class="table dash-table" id="courseAnalyticsTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Course Title</th>
                                <th>Provider</th>
                                <th>Category</th>
                                <th>Duration</th>
                                <th>Total Enrolled</th>
                                <th>Approved</th>
                                <th>Pending</th>
                                <th>Rejected</th>
                                <th>Progress</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $rank = 1;
                            while ($c = mysqli_fetch_assoc($courses_result)):
                                $pct = $c['total_enrollments'] > 0 ? round(($c['approved'] / $c['total_enrollments']) * 100) : 0;
                            ?>
                            <tr>
                                <td><?php echo $rank++; ?></td>
                                <td><strong><?php echo htmlspecialchars($c['title']); ?></strong></td>
                                <td><?php echo htmlspecialchars($c['provider']); ?></td>
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
                            <?php endwhile; ?>
                            <?php if (mysqli_num_rows($courses_result) == 0): ?>
                            <tr><td colspan="10" class="text-center text-muted py-4">No course data found</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ENROLLMENTS PER PROVIDER TABLE -->
            <div class="dash-card">
                <div class="dash-card-head">
                    <h5><i class="fas fa-building mr-2"></i>Enrollments Per Provider</h5>
                </div>
                <div class="dash-table-wrap">
                    <table class="table dash-table" id="providerAnalyticsTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Provider Name</th>
                                <th>Total Courses</th>
                                <th>Total Enrollments</th>
                                <th>Approved Enrollments</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $rank2 = 1;
                            while ($p = mysqli_fetch_assoc($providers_result)):
                            ?>
                            <tr>
                                <td><?php echo $rank2++; ?></td>
                                <td><strong><?php echo htmlspecialchars($p['org_name']); ?></strong></td>
                                <td><?php echo $p['total_courses']; ?></td>
                                <td><strong><?php echo $p['total_enrollments']; ?></strong></td>
                                <td><span class="status-approved"><?php echo $p['approved_enrollments']; ?></span></td>
                                <td>
                                    <a href="analytics.php?provider_id=<?php echo $p['id']; ?>" class="btn-dash-action">
                                        <i class="fas fa-filter mr-1"></i>Filter
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../js/pasang.js"></script>
<script>
// ── ENROLLMENT TREND LINE CHART ─────────────────
var months  = <?php echo json_encode($months); ?>;
var counts  = <?php echo json_encode($monthly_counts); ?>;

var ctx1 = document.getElementById('enrollmentChart');
if (ctx1) {
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: months.length > 0 ? months : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Enrollments',
                data: counts.length > 0 ? counts : [0],
                borderColor: '#f97316',
                backgroundColor: 'rgba(249,115,22,0.08)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#f97316',
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 },
                    grid: { color: 'rgba(0,0,0,0.05)' }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
}

// ── ENROLLMENT STATUS DONUT ─────────────────────
var ctx2 = document.getElementById('statusChart');
if (ctx2) {
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Approved', 'Pending', 'Rejected'],
            datasets: [{
                data: [
                    <?php echo $approved_enroll; ?>,
                    <?php echo $pending_enroll; ?>,
                    <?php echo $total_enrollments - $approved_enroll - $pending_enroll; ?>
                ],
                backgroundColor: ['#16a34a', '#f97316', '#dc2626'],
                borderWidth: 0,
                hoverOffset: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { font: { family: 'Outfit', size: 13 }, padding: 16 }
                }
            }
        }
    });
}
</script>
</body>
</html>
