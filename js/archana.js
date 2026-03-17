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

function confirmDelete(courseId) {
    if (confirm('Are you sure you want to delete this course? This cannot be undone.')) {
        window.location.href = 'delete_course.php?id=' + courseId;
    }
}
