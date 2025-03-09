document.addEventListener("DOMContentLoaded", function() {
    // Real-time validation for Signup and Login

    // Username Validation
    const usernameInput = document.getElementById("username");
    const usernameError = document.getElementById("usernameError");

    usernameInput.addEventListener("input", function() {
        if (usernameInput.value.trim() === "") {
            usernameError.textContent = "Username is required!";
        } else {
            usernameError.textContent = "";
        }
    });

    // Password Validation
    const passwordInput = document.getElementById("password");
    const passwordError = document.getElementById("passwordError");

    passwordInput.addEventListener("input", function() {
        if (passwordInput.value.trim() === "") {
            passwordError.textContent = "Password is required!";
        } else {
            passwordError.textContent = "";
        }
    });

    // Confirm Password Validation (for signup only)
    const confirmPasswordInput = document.getElementById("confirm_password");
    const confirmPasswordError = document.getElementById("confirmPasswordError");

    confirmPasswordInput.addEventListener("input", function() {
        if (confirmPasswordInput.value !== passwordInput.value) {
            confirmPasswordError.textContent = "Passwords do not match!";
        } else {
            confirmPasswordError.textContent = "";
        }
    });
});
