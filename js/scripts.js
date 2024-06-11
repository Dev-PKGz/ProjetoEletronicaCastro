document.getElementById('registerForm').addEventListener('submit', function(event) {
    const passwordInput = document.getElementById('password');
    if (passwordInput.value.length < 6) {
        event.preventDefault();
        alert('A senha deve ter pelo menos 6 caracteres.');
    }
});

function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        togglePassword.classList.remove('bi-eye');
        togglePassword.classList.add('bi-eye-slash');
    } else {
        passwordInput.type = 'password';
        togglePassword.classList.remove('bi-eye-slash');
        togglePassword.classList.add('bi-eye');
    }
}