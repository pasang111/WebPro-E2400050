<?php
// includes/navbar.php
// Responsible: Pasang Lama (Team Lead)
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-expand-lg eduskill-navbar fixed-top">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="/eduskill/index.php">
            <span class="brand-icon"><i class="fas fa-graduation-cap"></i></span>
            <span class="brand-text">EDU<span class="brand-accent">SKILL</span></span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page=='index.php'?'active':''; ?>" href="/eduskill/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page=='about.php'?'active':''; ?>" href="/eduskill/about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page=='contact.php'?'active':''; ?>" href="/eduskill/contact.php">Contact</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto align-items-center">
                <li class="nav-item mr-2">
                    <a class="btn-nav-login" href="/eduskill/auth/login.php">Log In</a>
                </li>
                <li class="nav-item">
                    <a class="btn-nav-join" href="/eduskill/auth/signup_student.php">Join for Free</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
