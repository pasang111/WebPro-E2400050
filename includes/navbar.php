<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-expand-lg eduskill-navbar fixed-top">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="/eduskill/index.php">
            <div class="brand-icon">
                <img src="/eduskill/images/logo.png" alt="Logo" style="width:22px;height:22px;object-fit:cover;border-radius:4px;" onerror="this.style.display='none'; this.nextSibling.style.display='flex';">
                <i class="fas fa-graduation-cap" style="display:none; color:white;"></i>
            </div>
            <span class="brand-text ml-2">EDU<span class="brand-accent">SKILL</span></span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navMenu" style="outline:none;">
            <i class="fas fa-bars" style="font-size:18px; color:#3d3d3d;"></i>
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
                <li class="nav-item mr-1">
                    <a class="btn-nav-login" href="/eduskill/auth/login.php">Log In</a>
                </li>
                <li class="nav-item mr-3">
                    <a class="btn-nav-join" href="/eduskill/auth/signup_student.php">Get Started Free</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
