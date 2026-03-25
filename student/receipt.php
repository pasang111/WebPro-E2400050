<?php
// student/receipt.php
// Responsible: Shreeyash Pandey
// Enrollment Receipt — shows after enrollment is approved
// Student can view and print the receipt

session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'student') {
    header('Location: ../auth/login.php'); exit();
}

$student_id      = $_SESSION['user_id'];
$student_name    = $_SESSION['user_name'] ?? 'Student';
$enrollment_id   = intval($_GET['id'] ?? 0);

if ($enrollment_id === 0) {
    header('Location: my_courses.php'); exit();
}

// Get enrollment details — only if it belongs to this student and is approved
$stmt = mysqli_prepare($conn, "
    SELECT
        e.id                as enrollment_id,
        e.status,
        e.enrolled_at,
        e.notes,
        s.name              as student_name,
        s.email             as student_email,
        s.phone             as student_phone,
        c.id                as course_id,
        c.title             as course_title,
        c.category,
        c.duration,
        c.description       as course_description,
        c.price,
        p.org_name          as provider_name,
        p.email             as provider_email,
        p.address           as provider_address,
        p.phone             as provider_phone
    FROM enrollments e
    JOIN students s   ON e.student_id  = s.id
    JOIN courses c    ON e.course_id   = c.id
    JOIN providers p  ON c.provider_id = p.id
    WHERE e.id = ? AND e.student_id = ?
");

mysqli_stmt_bind_param($stmt, 'ii', $enrollment_id, $student_id);
mysqli_stmt_execute($stmt);
$enrollment = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$enrollment) {
    header('Location: my_courses.php'); exit();
}

// Generate receipt number
$receipt_no = 'EDU-' . str_pad($enrollment['enrollment_id'], 6, '0', STR_PAD_LEFT) . '-' . date('Y');
$issued_date = date('d F Y', strtotime($enrollment['enrolled_at']));
$issued_time = date('h:i A', strtotime($enrollment['enrolled_at']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Receipt #<?php echo $receipt_no; ?> - EduSkill</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Fraunces:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/pasang.css">
    <link rel="stylesheet" href="../css/shreeyash.css">
    <style>
        /* ── RECEIPT STYLES ── */
        .receipt-page {
            background: #f5f5f5;
            min-height: 100vh;
            padding: 40px 20px;
            font-family: 'Outfit', sans-serif;
        }

        .receipt-wrapper {
            max-width: 720px;
            margin: 0 auto;
        }

        .receipt-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .receipt-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0,0,0,0.10);
        }

        /* Header */
        .receipt-header {
            background: linear-gradient(135deg, #0f0f0f 0%, #1a1a1a 100%);
            padding: 36px 40px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .receipt-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .receipt-brand-logo {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            object-fit: cover;
        }

        .receipt-brand-text {
            font-size: 22px;
            font-weight: 900;
            color: white;
            letter-spacing: -0.5px;
        }

        .receipt-brand-accent { color: #f97316; }

        .receipt-title-block { text-align: right; }

        .receipt-title {
            font-size: 22px;
            font-weight: 900;
            color: white;
            margin-bottom: 4px;
        }

        .receipt-number {
            font-size: 14px;
            color: rgba(255,255,255,0.55);
            font-weight: 500;
        }

        /* Status banner */
        .receipt-status-banner {
            padding: 16px 40px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            font-weight: 700;
        }

        .receipt-status-approved {
            background: #dcfce7;
            color: #15803d;
        }

        .receipt-status-pending {
            background: #fff7ed;
            color: #c2410c;
        }

        .receipt-status-banner i { font-size: 18px; }

        /* Body */
        .receipt-body { padding: 36px 40px; }

        .receipt-section { margin-bottom: 28px; }

        .receipt-section-title {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #9ca3af;
            margin-bottom: 14px;
            padding-bottom: 8px;
            border-bottom: 1.5px solid #f0f0f0;
        }

        .receipt-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 8px 0;
            font-size: 14px;
        }

        .receipt-row-label {
            color: #717171;
            font-weight: 500;
            flex: 0 0 180px;
        }

        .receipt-row-value {
            color: #0f0f0f;
            font-weight: 600;
            text-align: right;
            flex: 1;
        }

        /* Course highlight box */
        .receipt-course-box {
            background: #fafafa;
            border: 1.5px solid #e8e8e8;
            border-radius: 14px;
            padding: 20px 24px;
            margin-bottom: 28px;
        }

        .receipt-course-cat {
            display: inline-block;
            background: #fff7ed;
            color: #f97316;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 100px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }

        .receipt-course-title {
            font-size: 20px;
            font-weight: 900;
            color: #0f0f0f;
            margin-bottom: 8px;
            letter-spacing: -0.3px;
        }

        .receipt-course-meta {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            font-size: 13px;
            color: #717171;
            margin-top: 10px;
        }

        .receipt-course-meta span {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .receipt-course-meta i { color: #f97316; }

        /* Price table */
        .receipt-price-table {
            border: 1.5px solid #e8e8e8;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 28px;
        }

        .receipt-price-row {
            display: flex;
            justify-content: space-between;
            padding: 14px 20px;
            font-size: 14px;
            border-bottom: 1px solid #f0f0f0;
        }

        .receipt-price-row:last-child { border-bottom: none; }

        .receipt-price-row.total {
            background: #fafafa;
            font-weight: 800;
            font-size: 16px;
        }

        .receipt-price-row.total .price-amount { color: #f97316; font-size: 20px; }

        .price-label { color: #3d3d3d; font-weight: 500; }
        .price-amount { color: #0f0f0f; font-weight: 700; }
        .price-free   { color: #16a34a; font-weight: 700; }

        /* Footer */
        .receipt-footer {
            background: #fafafa;
            border-top: 1.5px solid #f0f0f0;
            padding: 24px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .receipt-footer-note {
            font-size: 12px;
            color: #9ca3af;
            line-height: 1.6;
            max-width: 400px;
        }

        .receipt-stamp {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
        }

        .receipt-stamp-circle {
            width: 80px;
            height: 80px;
            border: 3px solid #16a34a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .receipt-stamp-circle i { font-size: 24px; color: #16a34a; }
        .receipt-stamp-text { font-size: 9px; font-weight: 800; color: #16a34a; text-transform: uppercase; letter-spacing: 1px; margin-top: 2px; }
        .receipt-stamp-label { font-size: 11px; color: #9ca3af; margin-top: 6px; }

        /* Watermark for pending */
        .receipt-watermark {
            position: relative;
        }

        .receipt-watermark::after {
            content: 'PENDING';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 80px;
            font-weight: 900;
            color: rgba(249,115,22,0.06);
            pointer-events: none;
            letter-spacing: 4px;
        }

        /* Print styles */
        @media print {
            .receipt-page { background: white; padding: 0; }
            .receipt-actions { display: none !important; }
            .dash-sidebar { display: none !important; }
            .dash-main { margin-left: 0 !important; }
            .receipt-card { box-shadow: none; }
            .receipt-wrapper { max-width: 100%; }
            body { padding-top: 0 !important; }
        }
    </style>
</head>
<body class="receipt-page">

    <div class="receipt-wrapper">

        <!-- Action buttons -->
        <div class="receipt-actions">
            <a href="my_courses.php" class="btn-ghost">
                <i class="fas fa-arrow-left mr-2"></i> Back to My Enrollments
            </a>
            <div style="display:flex;gap:10px;">
                <button onclick="window.print()" class="btn-dash-primary">
                    <i class="fas fa-print mr-2"></i> Print Receipt
                </button>
                <button onclick="downloadReceipt()" class="btn-dash-primary" style="background:#0f0f0f;">
                    <i class="fas fa-download mr-2"></i> Download PDF
                </button>
            </div>
        </div>

        <!-- RECEIPT CARD -->
        <div class="receipt-card <?php echo $enrollment['status'] !== 'approved' ? 'receipt-watermark' : ''; ?>">

            <!-- Header -->
            <div class="receipt-header">
                <div class="receipt-brand">
                    <img src="../images/logo.png"
                         alt="EduSkill"
                         class="receipt-brand-logo"
                         onerror="this.style.display='none'">
                    <span class="receipt-brand-text">EDU<span class="receipt-brand-accent">SKILL</span></span>
                </div>
                <div class="receipt-title-block">
                    <div class="receipt-title">Enrollment Receipt</div>
                    <div class="receipt-number"><?php echo $receipt_no; ?></div>
                </div>
            </div>

            <!-- Status Banner -->
            <?php if ($enrollment['status'] === 'approved'): ?>
            <div class="receipt-status-banner receipt-status-approved">
                <i class="fas fa-check-circle"></i>
                Enrollment Approved — This is your official enrollment confirmation.
            </div>
            <?php elseif ($enrollment['status'] === 'pending'): ?>
            <div class="receipt-status-banner receipt-status-pending">
                <i class="fas fa-clock"></i>
                Enrollment Pending — Your request is under review by the Ministry officer.
            </div>
            <?php endif; ?>

            <!-- Body -->
            <div class="receipt-body">

                <!-- Course Details -->
                <div class="receipt-course-box">
                    <span class="receipt-course-cat"><?php echo htmlspecialchars($enrollment['category']); ?></span>
                    <div class="receipt-course-title"><?php echo htmlspecialchars($enrollment['course_title']); ?></div>
                    <div style="font-size:14px;color:#717171;"><?php echo htmlspecialchars($enrollment['course_description']); ?></div>
                    <div class="receipt-course-meta">
                        <span><i class="fas fa-building"></i> <?php echo htmlspecialchars($enrollment['provider_name']); ?></span>
                        <span><i class="fas fa-clock"></i> <?php echo htmlspecialchars($enrollment['duration']); ?></span>
                        <span><i class="fas fa-certificate"></i> Ministry Certified</span>
                    </div>
                </div>

                <div class="row">
                    <!-- Student Details -->
                    <div class="col-md-6">
                        <div class="receipt-section">
                            <div class="receipt-section-title">Student Information</div>
                            <div class="receipt-row">
                                <span class="receipt-row-label">Full Name</span>
                                <span class="receipt-row-value"><?php echo htmlspecialchars($enrollment['student_name']); ?></span>
                            </div>
                            <div class="receipt-row">
                                <span class="receipt-row-label">Email</span>
                                <span class="receipt-row-value"><?php echo htmlspecialchars($enrollment['student_email']); ?></span>
                            </div>
                            <?php if ($enrollment['student_phone']): ?>
                            <div class="receipt-row">
                                <span class="receipt-row-label">Phone</span>
                                <span class="receipt-row-value"><?php echo htmlspecialchars($enrollment['student_phone']); ?></span>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Provider Details -->
                    <div class="col-md-6">
                        <div class="receipt-section">
                            <div class="receipt-section-title">Provider Information</div>
                            <div class="receipt-row">
                                <span class="receipt-row-label">Organisation</span>
                                <span class="receipt-row-value"><?php echo htmlspecialchars($enrollment['provider_name']); ?></span>
                            </div>
                            <div class="receipt-row">
                                <span class="receipt-row-label">Email</span>
                                <span class="receipt-row-value"><?php echo htmlspecialchars($enrollment['provider_email']); ?></span>
                            </div>
                            <?php if ($enrollment['provider_address']): ?>
                            <div class="receipt-row">
                                <span class="receipt-row-label">Location</span>
                                <span class="receipt-row-value"><?php echo htmlspecialchars($enrollment['provider_address']); ?></span>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Enrollment Details -->
                <div class="receipt-section">
                    <div class="receipt-section-title">Enrollment Details</div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="receipt-row">
                                <span class="receipt-row-label">Receipt No.</span>
                                <span class="receipt-row-value"><?php echo $receipt_no; ?></span>
                            </div>
                            <div class="receipt-row">
                                <span class="receipt-row-label">Enrollment ID</span>
                                <span class="receipt-row-value">#<?php echo $enrollment['enrollment_id']; ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="receipt-row">
                                <span class="receipt-row-label">Date Enrolled</span>
                                <span class="receipt-row-value"><?php echo $issued_date; ?></span>
                            </div>
                            <div class="receipt-row">
                                <span class="receipt-row-label">Time</span>
                                <span class="receipt-row-value"><?php echo $issued_time; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="receipt-row">
                        <span class="receipt-row-label">Status</span>
                        <span class="receipt-row-value">
                            <?php if ($enrollment['status'] === 'approved'): ?>
                                <span class="status-approved"><i class="fas fa-check-circle mr-1"></i>Approved</span>
                            <?php elseif ($enrollment['status'] === 'pending'): ?>
                                <span class="status-pending"><i class="fas fa-clock mr-1"></i>Pending Approval</span>
                            <?php else: ?>
                                <span class="status-rejected"><i class="fas fa-times-circle mr-1"></i>Rejected</span>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="receipt-row">
                        <span class="receipt-row-label">Platform</span>
                        <span class="receipt-row-value">EduSkill Marketplace — Ministry of Human Resources Malaysia</span>
                    </div>
                </div>

                <!-- Payment/Fee Summary -->
                <div class="receipt-price-table">
                    <div class="receipt-price-row">
                        <span class="price-label">Course Fee</span>
                        <span class="price-amount">
                            <?php if ($enrollment['price'] > 0): ?>
                                RM <?php echo number_format($enrollment['price'], 2); ?>
                            <?php else: ?>
                                <span class="price-free">Free</span>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="receipt-price-row">
                        <span class="price-label">Platform Fee</span>
                        <span class="price-free">Free</span>
                    </div>
                    <div class="receipt-price-row">
                        <span class="price-label">Processing Fee</span>
                        <span class="price-free">Free</span>
                    </div>
                    <div class="receipt-price-row total">
                        <span class="price-label">Total Amount</span>
                        <span class="price-amount">
                            <?php if ($enrollment['price'] > 0): ?>
                                RM <?php echo number_format($enrollment['price'], 2); ?>
                            <?php else: ?>
                                <span class="price-free">Free Enrollment</span>
                            <?php endif; ?>
                        </span>
                    </div>
                </div>

                <!-- Notes -->
                <?php if ($enrollment['notes']): ?>
                <div class="receipt-section">
                    <div class="receipt-section-title">Additional Notes</div>
                    <p style="font-size:14px;color:#3d3d3d;line-height:1.6;"><?php echo htmlspecialchars($enrollment['notes']); ?></p>
                </div>
                <?php endif; ?>

            </div>

            <!-- Footer -->
            <div class="receipt-footer">
                <div class="receipt-footer-note">
                    This receipt is an official record of your enrollment with EduSkill Marketplace System.<br>
                    Issued by the Ministry of Human Resources, Malaysia.<br>
                    For support: support@eduskill.gov.my | 03-8000 8000
                </div>

                <?php if ($enrollment['status'] === 'approved'): ?>
                <div class="receipt-stamp">
                    <div class="receipt-stamp-circle">
                        <i class="fas fa-check"></i>
                        <span class="receipt-stamp-text">Approved</span>
                    </div>
                    <span class="receipt-stamp-label">Ministry Verified</span>
                </div>
                <?php endif; ?>
            </div>

        </div>

    </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
function downloadReceipt() {
    window.print();
}
</script>
</body>
</html>
