function getPasswordStrength(password) {
    let s = 0;
    if (password.length > 6) {
        s++;
    }
    if (password.length >= 10) {
        s++;
    }
    if (/[A-Z]/.test(password)) {
        s++;
    }
    if (/[0-9]/.test(password)) {
        s++;
    }
    if (/[^A-Za-z0-9]/.test(password)) {
        s++;
    }
    return s;
}
document.querySelector(".pw-meter #newPass").addEventListener("focus", function () {
    document.querySelector(".pw-meter .pw-strength").style.display = "block";
});

document.querySelector(".pw-meter #newPass").addEventListener("focus", function () {
    document.querySelector(".pw-meter .tooltips").style.display = "inline";
});

document.querySelector(".pw-meter #newPass").addEventListener("keyup", function (e) {
    let password = e.target.value;
    let strength = getPasswordStrength(password);
    let passwordStrengthSpans = document.querySelectorAll(".pw-meter .pw-strength span");
    strength = Math.max(strength, 1);
    passwordStrengthSpans[1].style.width = strength * 20 + "%";
    if (strength < 2) {
        passwordStrengthSpans[0].innerText = "Weak";
        passwordStrengthSpans[0].style.color = "#111";
        passwordStrengthSpans[1].style.background = "#d13636";
    } else if (strength >= 2 && strength <= 4) {
        passwordStrengthSpans[0].innerText = "Medium";
        passwordStrengthSpans[0].style.color = "#111";
        passwordStrengthSpans[1].style.background = "#e6da44";
    } else {
        passwordStrengthSpans[0].innerText = "Strong";
        passwordStrengthSpans[0].style.color = "#fff";
        passwordStrengthSpans[1].style.background = "#20a820";
    }
});


const $password = document.getElementById("newPass");
const $password_confirm = document.getElementById("verifyPass");
const $submit = document.getElementById('changePass');
const $confirmation_invalid_message = document.getElementById('password_confirmation_invalid');

$password.addEventListener('input', () => validate_password());
$password_confirm.addEventListener('input', () => validate_password());

function validate_password() {
    const password = $password.value;
    const password_confirm = $password_confirm.value;
    let match = false;

    if (password === password_confirm) {
        match = true;
    }

    if (match) {
        $submit.disabled = false;
    } else {
        $submit.disabled = true;
    }

    if (!match) {
        $confirmation_invalid_message.innerHTML = "New passwords do not match.";
        $confirmation_invalid_message.style.display = "block";
    } else {
        $confirmation_invalid_message.style.display = "none";
    }
}