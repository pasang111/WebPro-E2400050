<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<style>
/* ── Navbar base ── */
.eduskill-navbar {
    background: #ffffff !important;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    padding: 10px 0;
    z-index: 9999;
}

.brand-icon {
    width: 34px; height: 34px;
    background: #ffffff;
    border-radius: 8px;
    display: inline-flex; align-items: center; justify-content: center;
}

.brand-text {
    font-weight: 800;
    font-size: 1.15rem;
    color: #1a1a2e;
    letter-spacing: 1px;
}

.brand-accent { color: #ff6b00; }

/* ── Nav links ── */
.eduskill-navbar .nav-link {
    color: #3d3d3d !important;
    font-weight: 500;
    font-size: 0.95rem;
    padding: 6px 14px !important;
    border-radius: 6px;
    transition: background 0.2s, color 0.2s;
}

.eduskill-navbar .nav-link:hover,
.eduskill-navbar .nav-link.active {
    color: #ff6b00 !important;
    background: #fff4ec;
}

/* ── CTA buttons ── */
.btn-nav-login {
    display: inline-block;
    padding: 7px 18px;
    border: 1.5px solid #ff6b00;
    border-radius: 8px;
    color: #ff6b00 !important;
    font-weight: 600;
    font-size: 0.88rem;
    text-decoration: none;
    transition: background 0.2s, color 0.2s;
    white-space: nowrap;
}
.btn-nav-login:hover {
    background: #ff6b00;
    color: #fff !important;
    text-decoration: none;
}

.btn-nav-join {
    display: inline-block;
    padding: 7px 18px;
    background: #ff6b00;
    border: 1.5px solid #ff6b00;
    border-radius: 8px;
    color: #fff !important;
    font-weight: 600;
    font-size: 0.88rem;
    text-decoration: none;
    transition: background 0.2s, box-shadow 0.2s;
    white-space: nowrap;
}
.btn-nav-join:hover {
    background: #e05e00;
    box-shadow: 0 4px 12px rgba(255,107,0,0.3);
    text-decoration: none;
}

/* ── Toggler icon color ── */
.navbar-toggler { border: none !important; outline: none !important; box-shadow: none !important; }
.navbar-toggler .fas { color: #3d3d3d; font-size: 20px; }

@media (max-width: 991.98px) {
    #navMenu {
        background: #ffffff;
        border-top: 1px solid #f0f0f0;
        border-radius: 0 0 12px 12px;
        padding: 12px 8px 16px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.10);
    }

    /* Stack nav links nicely */
    .eduskill-navbar .nav-link {
        padding: 10px 16px !important;
        border-radius: 8px;
        font-size: 1rem;
    }

    /* Give the CTA buttons full width & spacing on mobile */
    .btn-nav-login,
    .btn-nav-join {
        display: block;
        width: 100%;
        text-align: center;
        margin: 5px 0 !important;
        padding: 10px 18px;
        font-size: 0.95rem;
    }

    /* Remove the right-margin that looks odd on mobile */
    .navbar-nav.ml-auto { margin-left: 0 !important; margin-top: 8px; }
    .navbar-nav.ml-auto .nav-item { width: 100%; }
    .navbar-nav.mx-auto { margin: 0 !important; }
}
</style>

<nav class="navbar navbar-expand-lg eduskill-navbar fixed-top">
    <div class="container-fluid px-4">
        <a class="navbar-brand d-flex align-items-center" href="/eduskill/index.php">
            <div class="brand-icon">
                <img src="/eduskill/images/logo.png" alt="Logo"
                     style="width:22px;height:22px;object-fit:cover;border-radius:4px;"
                     onerror="this.style.display='none'; this.nextSibling.style.display='flex';">
                <i class="fas fa-graduation-cap" style="display:none; color:white;"></i>
            </div>
            <span class="brand-text ml-2">EDU<span class="brand-accent">SKILL</span></span>
        </a>

        <!-- Hamburger button -->
        <button class="navbar-toggler" type="button"
                data-toggle="collapse" data-target="#navMenu"
                aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <!-- Centre links -->
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page=='index.php' ? 'active' : ''; ?>"
                       href="/eduskill/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page=='about.php' ? 'active' : ''; ?>"
                       href="/eduskill/about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $current_page=='contact.php' ? 'active' : ''; ?>"
                       href="/eduskill/contact.php">Contact</a>
                </li>
            </ul>

            <!-- Right CTA buttons -->
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
