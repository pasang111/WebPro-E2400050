
// HERO SLIDER
var currentSlide = 0;
var totalSlides  = 0;
var sliderTimer  = null;

function initHeroSlider() {
    var slides = document.querySelectorAll('.hero-slide');
    totalSlides = slides.length;
    if (totalSlides === 0) return;
    showSlide(0);
    startSliderTimer();
}

function showSlide(n) {
    var slides = document.querySelectorAll('.hero-slide');
    var dots   = document.querySelectorAll('.sdot');
    if (slides.length === 0) return;

    currentSlide = (n + totalSlides) % totalSlides;

    slides.forEach(function(s) { s.classList.remove('active'); });
    dots.forEach(function(d)   { d.classList.remove('active'); });

    slides[currentSlide].classList.add('active');
    if (dots[currentSlide]) dots[currentSlide].classList.add('active');
}

function changeSlide(dir) {
    clearInterval(sliderTimer);
    showSlide(currentSlide + dir);
    startSliderTimer();
}

function goToSlide(n) {
    clearInterval(sliderTimer);
    showSlide(n);
    startSliderTimer();
}

function startSliderTimer() {
    sliderTimer = setInterval(function() {
        showSlide(currentSlide + 1);
    }, 5000);
}

// TESTIMONIAL SLIDER
var tPage    = 0;
var tPerPage = 3;

function changeTestimonial(dir) {
    var cards = document.querySelectorAll('.testimonial-track .col-md-4');
    if (cards.length === 0) return;
    var totalPages = Math.ceil(cards.length / tPerPage);
    tPage = (tPage + dir + totalPages) % totalPages;
    updateTestimonials();
}

function updateTestimonials() {
    var cards = document.querySelectorAll('.testimonial-track .col-md-4');
    cards.forEach(function(c, i) {
        var start = tPage * tPerPage;
        c.style.display = (i >= start && i < start + tPerPage) ? '' : 'none';
    });
}

// PRICING TOGGLE
function showPricing(type) {
    var individual = document.getElementById('pricingIndividual');
    var teams      = document.getElementById('pricingTeams');
    var btnInd     = document.getElementById('btnIndividual');
    var btnTeams   = document.getElementById('btnTeams');

    if (!individual || !teams) return;

    if (type === 'individual') {
        individual.classList.remove('d-none');
        teams.classList.add('d-none');
        if (btnInd)   btnInd.classList.add('active');
        if (btnTeams) btnTeams.classList.remove('active');
    } else {
        teams.classList.remove('d-none');
        individual.classList.add('d-none');
        if (btnTeams) btnTeams.classList.add('active');
        if (btnInd)   btnInd.classList.remove('active');
    }
}

// NAVBAR SCROLL
function initNavbarScroll() {
    var nav = document.querySelector('.eduskill-navbar');
    if (!nav) return;
    window.addEventListener('scroll', function() {
        if (window.scrollY > 20) {
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }
    });
}

// BACK TO TOP
function initBackToTop() {
    var btn = document.getElementById('backToTop');
    if (!btn) return;

    window.addEventListener('scroll', function() {
        if (window.scrollY > 400) {
            btn.classList.remove('d-none');
        } else {
            btn.classList.add('d-none');
        }
    });

    btn.addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

// MOBILE NAV CLOSE ON LINK CLICK
function initMobileNav() {
    var links = document.querySelectorAll('#navMenu a');
    links.forEach(function(link) {
        link.addEventListener('click', function() {
            var navMenu = document.getElementById('navMenu');
            if (navMenu && navMenu.classList.contains('show')) {
                navMenu.classList.remove('show');
            }
        });
    });
}

// SCROLL PROGRESS BAR
function initScrollProgress() {
    var bar = document.getElementById('scrollProgress');
    if (!bar) return;
    window.addEventListener('scroll', function() {
        var scrollTop  = window.scrollY;
        var docHeight  = document.body.scrollHeight - window.innerHeight;
        var pct        = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
        bar.style.width = pct + '%';
    });
}

// PASSWORD TOGGLE (shared)
function togglePassword(fieldId, iconId) {
    var field = document.getElementById(fieldId || 'passwordField');
    var icon  = document.getElementById(iconId  || 'eyeIcon');
    if (!field) return;
    if (field.type === 'password') {
        field.type = 'text';
        if (icon) { icon.classList.remove('fa-eye'); icon.classList.add('fa-eye-slash'); }
    } else {
        field.type = 'password';
        if (icon) { icon.classList.remove('fa-eye-slash'); icon.classList.add('fa-eye'); }
    }
}

// SCROLL ANIMATIONS (safe version)
function initScrollAnimations() {
    if (!('IntersectionObserver' in window)) return;

    var elements = document.querySelectorAll('.course-card, .cat-card, .why-card, .tcard, .val-card, .dstat-card, .pricing-card');

    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('anim-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    elements.forEach(function(el) {
        el.classList.add('anim-ready');
        observer.observe(el);
    });
}

// INIT ALL ON DOM READY
document.addEventListener('DOMContentLoaded', function() {

    // Hero slider
    initHeroSlider();

    // Testimonial slider — hide extra cards
    var tCards = document.querySelectorAll('.testimonial-track .col-md-4');
    if (tCards.length > tPerPage) {
        tCards.forEach(function(c, i) {
            if (i >= tPerPage) c.style.display = 'none';
        });
    }

    // Navbar
    initNavbarScroll();

    // Mobile nav
    initMobileNav();

    // Back to top
    initBackToTop();

    // Scroll progress
    initScrollProgress();

    // Scroll animations
    initScrollAnimations();
});
