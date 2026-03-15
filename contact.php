<?php
// contact.php - EduSkill Contact Page
// Responsible: Pasang Lama (Team Lead)
session_start();
$success = '';
$error   = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    if (empty($name) || empty($email) || empty($message)) {
        $error = 'Please fill in all required fields.';
    } else {
        $success = 'Thank you! Your message has been received. We will reply within 1-2 business days.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - EduSkill</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@400;600;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<div class="contact-layout">

    <!-- LEFT: dark sticky sidebar -->
    <div class="contact-sidebar">
        <div class="csb-inner">
            <p class="csb-eyebrow">Get In Touch</p>
            <h2 class="csb-title">We're Here to Help</h2>
            <p class="csb-sub">Have a question about EduSkill? Our team is ready to assist you.</p>

            <div class="csb-items">
                <div class="csb-item">
                    <div class="csb-ico csb-ico-blue">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <h6>Address</h6>
                        <p>Ministry of Human Resources, Selangor, Malaysia</p>
                    </div>
                </div>
                <div class="csb-item">
                    <div class="csb-ico csb-ico-green">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div>
                        <h6>Phone</h6>
                        <p>03-8000 8000</p>
                    </div>
                </div>
                <div class="csb-item">
                    <div class="csb-ico csb-ico-orange">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <h6>Email</h6>
                        <p>support@eduskill.gov.my</p>
                    </div>
                </div>
                <div class="csb-item">
                    <div class="csb-ico csb-ico-pink">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <h6>Office Hours</h6>
                        <p>Monday – Friday<br>8:00 AM – 5:00 PM</p>
                    </div>
                </div>
            </div>

            <div class="csb-note">
                <i class="fas fa-shield-alt mr-2"></i>
                Official Ministry of Human Resources Platform
            </div>
        </div>
    </div>

    <!-- RIGHT: form panel -->
    <div class="contact-form-panel">
        <div class="cfp-inner">
            <h2 class="cfp-title">Send Us a Message</h2>
            <p class="cfp-sub">Fill in the form below and we will get back to you within 1–2 business days.</p>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="cf-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control cf-input" placeholder="Your full name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="cf-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control cf-input" placeholder="Your email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="cf-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control cf-input" placeholder="e.g. 011-12345678" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="cf-label">Subject</label>
                            <select name="subject" class="form-control cf-input">
                                <option value="">Select a subject</option>
                                <option>Enrollment Issue</option>
                                <option>Provider Registration</option>
                                <option>Course Enquiry</option>
                                <option>Technical Support</option>
                                <option>Other</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="cf-label">Message <span class="text-danger">*</span></label>
                    <textarea name="message" class="form-control cf-input" rows="5" placeholder="Write your message here..." required><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                </div>
                <button type="submit" class="btn-contact-send">
                    <i class="fas fa-paper-plane mr-2"></i> Send Message
                </button>
            </form>

            <div class="cfp-faq">
                <i class="fas fa-lightbulb cfp-faq-ico"></i>
                <div>
                    <h6>Looking for quick answers?</h6>
                    <p>For enrollment or account questions, login to your dashboard for direct support.</p>
                    <a href="auth/login.php">Go to Login <i class="fas fa-arrow-right ml-1"></i></a>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include 'includes/footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
