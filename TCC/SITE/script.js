const logregBox = document.querySelector('.logreg-box');
const loginLink = document.querySelector('.login-link');
const RegisterLink = document.querySelector('.register-link');

RegisterLink.addEventListener('click', () => {
    logregBox.classList.add('active');
});

loginLink.addEventListener('click', () => {
    logregBox.classList.remove('active');
});