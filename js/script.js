
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
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }
    }
});

// ---- INIT ----
document.addEventListener('DOMContentLoaded', function() {
    // Init testimonial slider
    var cards = document.querySelectorAll('.testimonial-track .col-md-4');
    if (cards.length > tPerPage) {
        cards.forEach(function(c, i) {
            if (i >= tPerPage) c.style.display = 'none';
        });
    }
});
