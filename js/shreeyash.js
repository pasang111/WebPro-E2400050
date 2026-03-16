
function togglePassword() {
    var field = document.getElementById('passwordField');
    var icon  = document.getElementById('eyeIcon');
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}

// Client side password match check
document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('studentSignupForm');
    if (form) {
        form.addEventListener('submit', function (e) {
            var password = document.querySelector('input[name="password"]').value;
            var confirm  = document.querySelector('input[name="confirm_password"]').value;
            if (password !== confirm) {
                e.preventDefault();
                alert('Passwords do not match. Please try again.');
            }
        });
    }
});
