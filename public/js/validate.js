const form = document.querySelector("form");
const nameInput = form.querySelector('input[name="name"]');
const surnameInput = form.querySelector('input[name="surname"]')
const emailInput = form.querySelector('input[name="email"]');
const passwordInput = form.querySelector('input[name="password"]');
const confirmedPasswordInput = form.querySelector('input[name="confirm-password"]');
const button = form.querySelector('button[type="submit"]');

function isEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
}

function arePasswordsSame(password, confirmedPassword) {
    return password === confirmedPassword;
}

function isPasswordSafe(password) {
    return /^(?=.*\d)(?=.*[A-Z])(?=.{6,100})/.test(password);
}

function markValidation(element, condition) {
    if(!condition) {
        element.classList.add('no-valid');
    }
    else {
        element.classList.remove('no-valid');
    }
}

function validateEmail() {
    setTimeout(function () {
        markValidation(emailInput, isEmail(emailInput.value));
    }, 1000);
}

function validatePassword() {
    setTimeout(function () {
        markValidation(passwordInput, isPasswordSafe(passwordInput.value));
    }, 1000);
}

function validateConfirmedPassword() {
    setTimeout(function() {
        const condition = arePasswordsSame(
            confirmedPasswordInput.previousElementSibling.value,
            confirmedPasswordInput.value
        )
        markValidation(confirmedPasswordInput, condition);
    }, 1000);
}

function validateInputNotEmpty(input) {
    setTimeout(function () {
        markValidation(input, input.value !== "");
    }, 1000);
}

emailInput.addEventListener('keyup', validateEmail);

passwordInput.addEventListener('keyup', validatePassword);

confirmedPasswordInput.addEventListener('keyup', validateConfirmedPassword);

nameInput.addEventListener('keyup', () => {
    validateInputNotEmpty(nameInput);
});

surnameInput.addEventListener('keyup', () => {
    validateInputNotEmpty(surnameInput);
});