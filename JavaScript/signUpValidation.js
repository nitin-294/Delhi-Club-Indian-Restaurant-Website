function validateForm() {

    var firstName = document.getElementById('firstName').value.trim();
    var lastName = document.getElementById('lastName').value.trim();
    var email = document.getElementById('email').value.trim();
    var username = document.getElementById('username').value.trim();
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirmPassword').value;
    var captcha = document.getElementById('captcha').value.trim();
    var captchaText = document.getElementById('captchaText').textContent;

    var firstNameError = document.getElementById('firstNameError');
    var lastNameError = document.getElementById('lastNameError');
    var emailError = document.getElementById('emailError');
    var usernameError = document.getElementById('usernameError');
    var passwordError = document.getElementById('passwordError');
    var confirmPasswordError = document.getElementById('confirmPasswordError');
    var captchaError = document.getElementById('captchaError');


    firstNameError.textContent = '';
    lastNameError.textContent = '';
    emailError.textContent = '';
    usernameError.textContent = '';
    passwordError.textContent = '';
    confirmPasswordError.textContent = '';
    captchaError.textContent = '';

    var isValid = true;

    if (firstName === '') {
        firstNameError.textContent = 'First name is required.';
        isValid = false;
    }

    if (lastName === '') {
        lastNameError.textContent = 'Last name is required.';
        isValid = false;
    }

    if (email === '') {
        emailError.textContent = 'Email is required.';
        isValid = false;
    } else if (!isValidEmail(email)) {
        emailError.textContent = 'Invalid email format.';
        isValid = false;
    }

    if (username === '') {
        usernameError.textContent = 'Username is required.';
        isValid = false;
    }

    if (password === '') {
        passwordError.textContent = 'Password is required.';
        isValid = false;
    } else if (password.length < 8) {
        passwordError.textContent = 'Password must be at least 8 characters long.';
        isValid = false;
    } else if (!isValidPassword(password)) {
        passwordError.textContent = 'Password must contain at least 1 uppercase letter, 1 special character, and 1 number.';
        isValid = false;
    }

    if (confirmPassword === '') {
        confirmPasswordError.textContent = 'Please confirm your password.';
        isValid = false;
    } else if (confirmPassword !== password) {
        confirmPasswordError.textContent = 'Passwords do not match.';
        isValid = false;
    }
     
    if (captcha === '') {
        captchaError.textContent = 'CAPTCHA is required.';
        isValid = false;
    } else if (captcha !== captchaText) {
        captchaError.textContent = 'CAPTCHA is incorrect.';
        isValid = false;
    }

    return isValid;
}

function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function isValidPassword(password) {
    var passwordRegex = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,}$/;
    return passwordRegex.test(password);
}

document.getElementById('signUpForm').addEventListener('submit', function(event) {
    if (!validateForm()) {
        event.preventDefault();
    }
});