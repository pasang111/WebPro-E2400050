// EduSkill - script.js
// Responsible: Pasang Lama (Team Lead)

// ---- HERO SLIDER ----
var currentSlide = 0;
var totalSlides = document.querySelectorAll('.hero-slide').length;
var slideTimer;

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
    clearInterval(slideTimer);
    showSlide(currentSlide + dir);
    startSliderTimer();
}

function goToSlide(n) {
    clearInterval(slideTimer);
    showSlide(n);
    startSliderTimer();
}

function startSliderTimer() {
    slideTimer = setInterval(function() {
        showSlide(currentSlide + 1);
    }, 5000);
}

// ---- TESTIMONIAL SLIDER ----
var tPage = 0;
var tPerPage = 3;

function changeTestimonial(dir) {
    var cards = document.querySelectorAll('.testimonial-track .col-md-4');
    if (cards.length === 0) return;

    var totalPages = Math.ceil(cards.length / tPerPage);
    tPage = (tPage + dir + totalPages) % totalPages;

    cards.forEach(function(c, i) {
        var start = tPage * tPerPage;
        c.style.display = (i >= start && i < start + tPerPage) ? 'block' : 'none';
    });
}

// ---- NAVBAR SCROLL ----
window.addEventListener('scroll', function() {
    var nav = document.querySelector('.eduskill-navbar');
    if (nav) {
        if (window.scrollY > 10) {
            nav.style.boxShadow = '0 2px 20px rgba(0,0,0,0.1)';
        } else {
            nav.style.boxShadow = '0 1px 0 #e5e7eb';
        }
    }
});

// ---- INIT ----
document.addEventListener('DOMContentLoaded', function() {
    // Start hero slider
    if (document.querySelector('.hero-slide')) {
        showSlide(0);
        startSliderTimer();
    }

    // Init testimonial slider - show first page
    var cards = document.querySelectorAll('.testimonial-track .col-md-4');
    if (cards.length > tPerPage) {
        cards.forEach(function(c, i) {
            if (i >= tPerPage) c.style.display = 'none';
        });
    }
});
