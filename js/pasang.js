function validateLoginForm() {
    var email    = document.getElementById('loginEmail');
    var password = document.getElementById('loginPassword');
    var role     = document.querySelector('input[name="role"]:checked');
    var valid    = true;

    clearErrors();

    // Validate role selection
    if (!role) {
        showError('roleError', 'Please select your role to continue.');
        valid = false;
    }

    // Validate email
    if (!email || email.value.trim() === '') {
        showError('emailError', 'Email address is required.');
        highlightField(email);
        valid = false;
    } else if (!isValidEmail(email.value.trim())) {
        showError('emailError', 'Please enter a valid email address.');
        highlightField(email);
        valid = false;
    }

    // Validate password
    if (!password || password.value === '') {
        showError('passwordError', 'Password is required.');
        highlightField(password);
        valid = false;
    } else if (password.value.length < 6) {
        showError('passwordError', 'Password must be at least 6 characters.');
        highlightField(password);
        valid = false;
    }

    // Show loading state if valid
    if (valid) {
        showLoginLoading();
    }

    return valid;
}

/**
 * Shows loading spinner on login button
 */
function showLoginLoading() {
    var btn = document.getElementById('loginBtn');
    if (btn) {
        btn.innerHTML = '<i class="fas fa-circle-notch fa-spin mr-2"></i> Logging in...';
        btn.disabled  = true;
        btn.style.opacity = '0.85';
    }
}

/**
 * Handles role button selection with animation
 */
function initRoleSelector() {
    var roles = document.querySelectorAll('.role-option input[type="radio"]');

    roles.forEach(function(radio) {
        radio.addEventListener('change', function() {
            var allBtns = document.querySelectorAll('.role-btn');
            allBtns.forEach(function(btn) {
                btn.style.transform = 'scale(1)';
            });

            var selectedBtn = this.nextElementSibling;
            if (selectedBtn) {
                selectedBtn.style.transform = 'scale(1.05)';
                setTimeout(function() {
                    selectedBtn.style.transform = 'scale(1)';
                }, 150);
            }

            // Update placeholder text based on role
            var emailInput = document.getElementById('loginEmail');
            if (emailInput) {
                var placeholders = {
                    'admin':    'admin@eduskill.com',
                    'student':  'your.email@example.com',
                    'provider': 'organisation@example.com'
                };
                emailInput.placeholder = placeholders[this.value] || 'Enter your email';
            }
        });
    });
}

/**
 * Toggles password visibility in input field
 * @param {string} fieldId - ID of the password input
 * @param {string} iconId  - ID of the eye icon
 */
function togglePassword(fieldId, iconId) {
    fieldId = fieldId || 'loginPassword';
    iconId  = iconId  || 'eyeIcon';

    var field = document.getElementById(fieldId);
    var icon  = document.getElementById(iconId);

    if (!field) return;

    if (field.type === 'password') {
        field.type = 'text';
        if (icon) {
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    } else {
        field.type = 'password';
        if (icon) {
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
}


/**
 * Shows an error message under a form field
 */
function showError(elementId, message) {
    var el = document.getElementById(elementId);
    if (el) {
        el.textContent   = message;
        el.style.display = 'block';
        el.style.color   = '#dc2626';
        el.style.fontSize = '12px';
        el.style.marginTop = '4px';
        el.style.fontWeight = '600';
    }
}

/**
 * Highlights a field in red to show error
 */
function highlightField(field) {
    if (!field) return;
    field.style.borderColor = '#dc2626';
    field.style.boxShadow   = '0 0 0 3px rgba(220,38,38,0.1)';

    field.addEventListener('input', function() {
        field.style.borderColor = '';
        field.style.boxShadow   = '';
        var errorId = field.id + 'Error';
        var errorEl = document.getElementById(errorId);
        if (errorEl) errorEl.style.display = 'none';
    }, { once: true });
}

/**
 * Clears all error messages
 */
function clearErrors() {
    var errors = document.querySelectorAll('.field-error');
    errors.forEach(function(el) { el.style.display = 'none'; el.textContent = ''; });

    var fields = document.querySelectorAll('.fi, .form-control');
    fields.forEach(function(field) {
        field.style.borderColor = '';
        field.style.boxShadow   = '';
    });
}

/**
 * Validates email format using regex
 * @param {string} email
 * @returns {boolean}
 */
function isValidEmail(email) {
    var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

/**
 * Adds real-time validation feedback as user types
 */
function initRealTimeValidation() {
    var emailField = document.getElementById('loginEmail');
    var passField  = document.getElementById('loginPassword');

    if (emailField) {
        emailField.addEventListener('blur', function() {
            if (this.value && !isValidEmail(this.value)) {
                highlightField(this);
                showError('emailError', 'Please enter a valid email address.');
            }
        });

        emailField.addEventListener('input', function() {
            var errorEl = document.getElementById('emailError');
            if (errorEl) errorEl.style.display = 'none';
            this.style.borderColor = '';
            this.style.boxShadow   = '';
        });
    }

    if (passField) {
        passField.addEventListener('input', function() {
            var errorEl = document.getElementById('passwordError');
            if (errorEl) errorEl.style.display = 'none';
            this.style.borderColor = '';
            this.style.boxShadow   = '';

            // Password strength indicator
            updatePasswordStrength(this.value);
        });
    }
}

/**
 * Shows password strength as user types
 * @param {string} password
 */
function updatePasswordStrength(password) {
    var indicator = document.getElementById('passwordStrength');
    if (!indicator) return;

    var strength = 0;
    var hints    = [];

    if (password.length >= 6)  { strength++; }
    if (password.length >= 10) { strength++; hints.push('Good length'); }
    if (/[A-Z]/.test(password)) { strength++; hints.push('Uppercase letter'); }
    if (/[0-9]/.test(password)) { strength++; hints.push('Number'); }
    if (/[^A-Za-z0-9]/.test(password)) { strength++; hints.push('Special character'); }

    var colors = ['', '#dc2626', '#f97316', '#f59e0b', '#16a34a', '#15803d'];
    var labels = ['', 'Very Weak', 'Weak', 'Fair', 'Strong', 'Very Strong'];

    if (password.length === 0) {
        indicator.style.display = 'none';
        return;
    }

    indicator.style.display  = 'block';
    indicator.style.color    = colors[strength] || '#dc2626';
    indicator.style.fontSize = '12px';
    indicator.style.fontWeight = '600';
    indicator.style.marginTop = '4px';
    indicator.textContent    = 'Password strength: ' + (labels[strength] || 'Very Weak');
}
/**
 * Sets active class on current sidebar link
 */
function initSidebarActiveLink() {
    var currentPath = window.location.pathname;
    var links       = document.querySelectorAll('.dsb-link');

    links.forEach(function(link) {
        if (link.href && link.href.indexOf(currentPath.split('/').pop()) !== -1) {
            link.classList.add('active');
        }
    });
}

/**
 * Shows confirmation dialog before deleting
 * @param {string} itemName - Name of item to delete
 * @returns {boolean}
 */
function confirmDelete(itemName) {
    itemName = itemName || 'this item';
    return confirm('Are you sure you want to delete ' + itemName + '? This action cannot be undone.');
}
/**
 * Shows a toast notification message
 * @param {string} message
 * @param {string} type - success, error, warning, info
 */
function showToast(message, type) {
    type = type || 'success';

    var colors = {
        success: '#16a34a',
        error:   '#dc2626',
        warning: '#f97316',
        info:    '#2563eb'
    };

    var icons = {
        success: 'fa-check-circle',
        error:   'fa-times-circle',
        warning: 'fa-exclamation-circle',
        info:    'fa-info-circle'
    };

    var existing = document.getElementById('eduToast');
    if (existing) existing.parentNode.removeChild(existing);

    var toast = document.createElement('div');
    toast.id  = 'eduToast';
    toast.className = 'edu-toast';

    toast.innerHTML = '<i class="fas ' + (icons[type] || icons.success) + ' mr-2"></i>' + message;

    toast.style.cssText = [
        'position:fixed',
        'top:90px',
        'right:20px',
        'background:' + (colors[type] || colors.success),
        'color:white',
        'padding:14px 22px',
        'border-radius:10px',
        'font-size:14px',
        'font-weight:600',
        'font-family:Outfit,sans-serif',
        'box-shadow:0 8px 24px rgba(0,0,0,0.15)',
        'z-index:9999',
        'opacity:0',
        'transition:opacity 0.3s',
        'max-width:320px',
        'display:flex',
        'align-items:center'
    ].join(';');

    document.body.appendChild(toast);

    setTimeout(function() { toast.style.opacity = '1'; }, 10);
    setTimeout(function() {
        toast.style.opacity = '0';
        setTimeout(function() {
            if (toast.parentNode) toast.parentNode.removeChild(toast);
        }, 300);
    }, 3500);
}

/**
 * Filters table rows based on search input
 * @param {string} inputId   - ID of search input
 * @param {string} tableId   - ID of table to filter
 * @param {number} colIndex  - Column index to search in
 */
function initTableSearch(inputId, tableId, colIndex) {
    var input = document.getElementById(inputId);
    var table = document.getElementById(tableId);

    if (!input || !table) return;

    input.addEventListener('input', function() {
        var query = this.value.toLowerCase();
        var rows  = table.querySelectorAll('tbody tr');

        rows.forEach(function(row) {
            var cells = row.querySelectorAll('td');
            var found = false;

            if (colIndex !== undefined) {
                if (cells[colIndex]) {
                    found = cells[colIndex].textContent.toLowerCase().indexOf(query) !== -1;
                }
            } else {
                cells.forEach(function(cell) {
                    if (cell.textContent.toLowerCase().indexOf(query) !== -1) {
                        found = true;
                    }
                });
            }

            row.style.display = found ? '' : 'none';
        });
    });
}

document.addEventListener('DOMContentLoaded', function() {

    // Login form
    var loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            if (!validateLoginForm()) {
                e.preventDefault();
            }
        });
    }

    // Role selector
    initRoleSelector();

    // Real-time validation
    initRealTimeValidation();

    // Sidebar active link
    initSidebarActiveLink();

    // Table search on admin pages
    initTableSearch('providerSearch', 'providersTable', 1);
    initTableSearch('enrollmentSearch', 'enrollmentsTable', 1);
    initTableSearch('courseSearch', 'coursesTable', 1);
});
