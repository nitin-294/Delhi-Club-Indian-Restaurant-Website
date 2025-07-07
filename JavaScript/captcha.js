var captchaText = generateCaptcha();

var captchaTextElement = document.getElementById('captchaText');

captchaTextElement.textContent = captchaText;

captchaTextElement.style.display = 'flex';
captchaTextElement.style.alignItems = 'center';
captchaTextElement.style.justifyContent = 'center';
captchaTextElement.style.border = '1px solid #ccc';
captchaTextElement.style.padding = '10px';
captchaTextElement.style.marginBottom = '20px';
captchaTextElement.style.fontSize = '24px';
captchaTextElement.style.backgroundColor = '#f5f5f5';
captchaTextElement.style.color = '#333';
captchaTextElement.style.letterSpacing = '2px';
captchaTextElement.style.fontFamily = 'Arial, sans-serif';

function generateCaptcha() {
    var captchaText = document.getElementById('captchaText');
    var chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var captcha = '';
    for (var i = 0; i < 6; i++) {
        captcha += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    captchaText.textContent = captcha;
    captchaText.classList.add('captchaText');
}

document.addEventListener('DOMContentLoaded', function() {
    generateCaptcha();
});