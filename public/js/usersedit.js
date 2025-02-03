const togglePassword = document.getElementById('togglePassword');
const password = document.getElementById('password');
const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
const confirmPassword = document.getElementById('password_confirmation');

document.getElementById('togglePassword').addEventListener('click', function() {
    var passwordField = document.getElementById('password');
    var icon = document.getElementById('togglePassword');

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    } else {
        passwordField.type = 'password';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    }
});

document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
    var confirmPasswordField = document.getElementById('password_confirmation');
    var icon = document.getElementById('toggleConfirmPassword');

    if (confirmPasswordField.type === 'password') {
        confirmPasswordField.type = 'text';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    } else {
        confirmPasswordField.type = 'password';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    }
});