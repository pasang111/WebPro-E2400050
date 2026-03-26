
function validateStudentSignup() {
    var name     = document.getElementById('studentName');
    var email    = document.getElementById('studentEmail');
    var password = document.getElementById('studentPassword');
    var confirm  = document.getElementById('studentConfirm');
    var valid    = true;

    clearAllErrors();

    // Validate name
    if (!name || name.value.trim() === '') {
        showFieldError('nameError', 'Full name is required.');
        markFieldError(name);
        valid = false;
    } else if (name.value.trim().length < 3) {
        showFieldError('nameError', 'Name must be at least 3 characters.');
        markFieldError(name);
        valid = false;
    }

    // Validate email
    if (!email || email.value.trim() === '') {
        showFieldError('emailError', 'Email address is required.');
        markFieldError(email);
        valid = false;
    } else if (!validateEmailFormat(email.value.trim())) {
        showFieldError('emailError', 'Please enter a valid email address.');
        markFieldError(email);
        valid = false;
    }

    // Validate password
    if (!password || password.value === '') {
        showFieldError('passwordError', 'Password is required.');
        markFieldError(password);
        valid = false;
    } else if (password.value.length < 6) {
        showFieldError('passwordError', 'Password must be at least 6 characters.');
        markFieldError(password);
        valid = false;
    }

    // Validate confirm password
    if (!confirm || confirm.value === '') {
        showFieldError('confirmError', 'Please confirm your password.');
        markFieldError(confirm);
        valid = false;
    } else if (password && password.value !== confirm.value) {
        showFieldError('confirmError', 'Passwords do not match.');
        markFieldError(confirm);
        valid = false;
    }

    if (valid) {
        showSubmitLoading('signupBtn', 'Creating Account...');
    }

    return valid;
}

// PASSWORD TOGGLE

/**
 * Toggles password field visibility
 */
function togglePassword(fieldId, iconId) {
    fieldId = fieldId || 'studentPassword';
    iconId  = iconId  || 'eyeIcon';

    var field = document.getElementById(fieldId);
    var icon  = document.getElementById(iconId);

    if (!field) return;

    if (field.type === 'password') {
        field.type = 'text';
        if (icon) { icon.classList.remove('fa-eye'); icon.classList.add('fa-eye-slash'); }
    } else {
        field.type = 'password';
        if (icon) { icon.classList.remove('fa-eye-slash'); icon.classList.add('fa-eye'); }
    }
}

// REAL-TIME PASSWORD MATCH CHECK

/**
 * Checks if confirm password matches in real time
 */
function initPasswordMatchCheck() {
    var confirmField = document.getElementById('studentConfirm');
    var passwordField = document.getElementById('studentPassword');

    if (!confirmField || !passwordField) return;

    confirmField.addEventListener('input', function() {
        var errorEl = document.getElementById('confirmError');
        if (this.value && passwordField.value !== this.value) {
            if (errorEl) {
                errorEl.textContent   = 'Passwords do not match.';
                errorEl.style.display = 'block';
                errorEl.style.color   = '#dc2626';
                errorEl.style.fontSize = '12px';
                errorEl.style.fontWeight = '600';
            }
            this.style.borderColor = '#dc2626';
        } else {
            if (errorEl) errorEl.style.display = 'none';
            this.style.borderColor = '#16a34a';
            this.style.boxShadow   = '0 0 0 3px rgba(22,163,74,0.1)';
        }
    });
}

// PASSWORD STRENGTH METER

/**
 * Shows visual password strength meter
 */
function initPasswordStrengthMeter() {
    var passField = document.getElementById('studentPassword');
    var meter     = document.getElementById('strengthMeter');
    var label     = document.getElementById('strengthLabel');

    if (!passField) return;

    passField.addEventListener('input', function() {
        var val      = this.value;
        var strength = calculateStrength(val);

        if (meter) {
            meter.style.width   = (strength.score * 20) + '%';
            meter.style.background = strength.color;
            meter.style.height  = '4px';
            meter.style.borderRadius = '2px';
            meter.style.transition = 'all 0.3s';
        }

        if (label) {
            label.textContent  = val.length > 0 ? strength.label : '';
            label.style.color  = strength.color;
            label.style.fontSize = '12px';
            label.style.fontWeight = '600';
        }
    });
}

/**
 * Calculates password strength score
 */
function calculateStrength(password) {
    var score = 0;
    if (password.length >= 6)                    score++;
    if (password.length >= 10)                   score++;
    if (/[A-Z]/.test(password))                 score++;
    if (/[0-9]/.test(password))                 score++;
    if (/[^A-Za-z0-9]/.test(password))          score++;

    var levels = [
        { color: '#dc2626', label: 'Very Weak'  },
        { color: '#f97316', label: 'Weak'        },
        { color: '#f59e0b', label: 'Fair'        },
        { color: '#16a34a', label: 'Strong'      },
        { color: '#15803d', label: 'Very Strong' }
    ];

    return levels[Math.min(score - 1, 4)] || levels[0];
}

// COURSE SEARCH AND FILTER

/**
 * Initializes live course search and category filter
 */
function initCourseFilter() {
    var searchInput = document.getElementById('courseSearch');
    var catFilter   = document.getElementById('categoryFilter');

    if (!searchInput && !catFilter) return;

    function filterCourses() {
        var search   = searchInput ? searchInput.value.toLowerCase() : '';
        var category = catFilter   ? catFilter.value : '';
        var items    = document.querySelectorAll('.course-item');
        var visible  = 0;

        items.forEach(function(item) {
            var title   = item.getAttribute('data-title') || '';
            var cat     = item.getAttribute('data-category') || '';
            var matchS  = search === '' || title.includes(search);
            var matchC  = category === '' || cat === category;

            if (matchS && matchC) {
                item.style.display = '';
                visible++;
                item.style.animation = 'fadeIn 0.3s ease forwards';
            } else {
                item.style.display = 'none';
            }
        });

        var noResults = document.getElementById('noCourses');
        if (noResults) {
            noResults.classList.toggle('d-none', visible > 0);
        }
    }

    if (searchInput) searchInput.addEventListener('input', filterCourses);
    if (catFilter)   catFilter.addEventListener('change', filterCourses);
}

// ENROLLMENT FORM VALIDATION

/**
 * Validates enrollment request form
 */
function validateEnrollmentForm() {
    var courseId = document.querySelector('input[name="course_id"]');

    if (!courseId || !courseId.value) {
        showToastMessage('Something went wrong. Please go back and try again.', 'error');
        return false;
    }

    showSubmitLoading('enrollBtn', 'Submitting...');
    return true;
}

// RATING FEEDBACK

/**
 * Updates rating feedback text when star is selected
 */
function updateRatingFeedback() {
    var radios  = document.querySelectorAll('.star-rating input[type="radio"]');
    var feedback = document.getElementById('ratingFeedback');
    var labels   = ['', 'Poor', 'Fair', 'Good', 'Very Good', 'Excellent'];

    radios.forEach(function(radio) {
        radio.addEventListener('change', function() {
            var val = parseInt(this.value);
            if (feedback) {
                feedback.textContent = val + ' Star' + (val > 1 ? 's' : '') + ' — ' + (labels[val] || '');
                feedback.classList.add('rating-feedback');
            }
        });
    });
}

/**
 * Validates rating form before submission
 */
function validateRatingForm() {
    var selected = document.querySelector('.star-rating input[type="radio"]:checked');
    if (!selected) {
        showToastMessage('Please select a star rating before submitting.', 'warning');
        return false;
    }
    return true;
}

// SHARED HELPERS

function showFieldError(elementId, message) {
    var el = document.getElementById(elementId);
    if (el) {
        el.textContent      = message;
        el.style.display    = 'block';
        el.style.color      = '#dc2626';
        el.style.fontSize   = '12px';
        el.style.marginTop  = '4px';
        el.style.fontWeight = '600';
    }
}

function markFieldError(field) {
    if (!field) return;
    field.style.borderColor = '#dc2626';
    field.style.boxShadow   = '0 0 0 3px rgba(220,38,38,0.1)';
    field.addEventListener('input', function() {
        this.style.borderColor = '';
        this.style.boxShadow   = '';
    }, { once: true });
}

function clearAllErrors() {
    document.querySelectorAll('.field-error').forEach(function(el) {
        el.style.display = 'none';
        el.textContent   = '';
    });
    document.querySelectorAll('.fi, .form-control').forEach(function(f) {
        f.style.borderColor = '';
        f.style.boxShadow   = '';
    });
}

function validateEmailFormat(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function showSubmitLoading(btnId, text) {
    var btn = document.getElementById(btnId);
    if (btn) {
        btn.innerHTML = '<i class="fas fa-circle-notch fa-spin mr-2"></i>' + text;
        btn.disabled  = true;
        btn.style.opacity = '0.85';
    }
}

function showToastMessage(message, type) {
    type = type || 'info';
    var colors = { success:'#16a34a', error:'#dc2626', warning:'#f97316', info:'#2563eb' };
    var existing = document.getElementById('shreeyashToast');
    if (existing) existing.parentNode.removeChild(existing);

    var toast = document.createElement('div');
    toast.id  = 'shreeyashToast';
    toast.style.cssText = 'position:fixed;top:90px;right:20px;background:' + colors[type] + ';color:white;padding:14px 22px;border-radius:10px;font-size:14px;font-weight:600;font-family:Outfit,sans-serif;box-shadow:0 8px 24px rgba(0,0,0,0.15);z-index:9999;opacity:0;transition:opacity 0.3s;max-width:320px;';
    toast.textContent = message;
    document.body.appendChild(toast);
    setTimeout(function() { toast.style.opacity = '1'; }, 10);
    setTimeout(function() {
        toast.style.opacity = '0';
        setTimeout(function() { if (toast.parentNode) toast.parentNode.removeChild(toast); }, 300);
    }, 3500);
}

// INIT ALL ON DOM READY

document.addEventListener('DOMContentLoaded', function() {

    // Student signup form
    var signupForm = document.getElementById('studentSignupForm');
    if (signupForm) {
        signupForm.addEventListener('submit', function(e) {
            if (!validateStudentSignup()) {
                e.preventDefault();
            }
        });
        initPasswordMatchCheck();
        initPasswordStrengthMeter();
    }

    // Course filter
    initCourseFilter();

    // Enrollment form
    var enrollForm = document.getElementById('enrollForm');
    if (enrollForm) {
        enrollForm.addEventListener('submit', function(e) {
            if (!validateEnrollmentForm()) {
                e.preventDefault();
            }
        });
    }

    // Rating feedback
    updateRatingFeedback();

    // Rating form validation
    var ratingForm = document.getElementById('ratingForm');
    if (ratingForm) {
        ratingForm.addEventListener('submit', function(e) {
            if (!validateRatingForm()) {
                e.preventDefault();
            }
        });
    }
});
