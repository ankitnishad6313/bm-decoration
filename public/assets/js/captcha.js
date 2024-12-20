function generateRandomString(length) {
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let result = '';
    for (let i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    return result;
}

// Function to draw Login CAPTCHA
function drawLoginCaptcha() {
    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');
    canvas.width = 200;
    canvas.height = 70;

    // Random background pattern
    ctx.fillStyle = 'rgba(255, 255, 255, 0.5)';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    for (let i = 0; i < 40; i++) {
        ctx.fillStyle = `rgba(${Math.random() * 255}, ${Math.random() * 255}, ${Math.random() * 255}, 0.3)`;
        ctx.fillRect(Math.random() * canvas.width, Math.random() * canvas.height, 20, 20);
    }

    // Randomly generate text
    const captchaText = generateRandomString(5);
    document.getElementById('login_captcha').value = captchaText;
    // Randomly rotate and position text
    for (let i = 0; i < captchaText.length; i++) {
        ctx.save();
        ctx.translate(20 + i * 22 + Math.random() * 5, 35 + Math.random() * 10);
        ctx.rotate((Math.random() - 0.6) * 1);
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.font = 'bold 30px Arial';
        ctx.fillStyle = 'black';
        ctx.fillText(captchaText[i], 0, 0);
        ctx.restore();
    }

    // Add additional lines
    for (let i = 0; i < 20; i++) {
        ctx.beginPath();
        ctx.moveTo(Math.random() * canvas.width, Math.random() * canvas.height);
        ctx.lineTo(Math.random() * canvas.width, Math.random() * canvas.height);
        ctx.strokeStyle = 'black';
        ctx.stroke();
    }

    document.getElementById('log_captcha').innerHTML = '';
    document.getElementById('log_captcha').appendChild(canvas);
}

// Generate CAPTCHA on page load
drawLoginCaptcha();
function checkLoginCaptcha(){
    var captcha = $('#login_captcha').val();
    var input_catpcha = $('#login_captcha_input').val();
    if (input_catpcha !== captcha) {
        triggerAlert("Invalid Captcha", 'error')
        drawLoginCaptcha();
        $('#login_captcha_input').val('');
        return false;
    }
}

// Function to draw Register CAPTCHA
function drawRegisterCaptcha() {
    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');
    canvas.width = 200;
    canvas.height = 70;

    // Random background pattern
    ctx.fillStyle = 'rgba(255, 255, 255, 0.5)';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    for (let i = 0; i < 40; i++) {
        ctx.fillStyle = `rgba(${Math.random() * 255}, ${Math.random() * 255}, ${Math.random() * 255}, 0.3)`;
        ctx.fillRect(Math.random() * canvas.width, Math.random() * canvas.height, 20, 20);
    }

    // Randomly generate text
    const captchaText = generateRandomString(5);
    document.getElementById('register_captcha').value = captchaText;
    // Randomly rotate and position text
    for (let i = 0; i < captchaText.length; i++) {
        ctx.save();
        ctx.translate(20 + i * 22 + Math.random() * 5, 35 + Math.random() * 10);
        ctx.rotate((Math.random() - 0.6) * 1);
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.font = 'bold 30px Arial';
        ctx.fillStyle = 'black';
        ctx.fillText(captchaText[i], 0, 0);
        ctx.restore();
    }

    // Add additional lines
    for (let i = 0; i < 20; i++) {
        ctx.beginPath();
        ctx.moveTo(Math.random() * canvas.width, Math.random() * canvas.height);
        ctx.lineTo(Math.random() * canvas.width, Math.random() * canvas.height);
        ctx.strokeStyle = 'black';
        ctx.stroke();
    }

    document.getElementById('reg_captcha').innerHTML = '';
    document.getElementById('reg_captcha').appendChild(canvas);
}

// Generate CAPTCHA on page load
drawRegisterCaptcha();

function checkRegisterCaptcha(){
    var captcha = $('#register_captcha').val();
    var input_catpcha = $('#register_captcha_input').val();
    if (input_catpcha !== captcha) {
        triggerAlert("Invalid Captcha", 'error')
        drawRegisterCaptcha();
        $('#register_captcha_input').val('');
        return false;
    }
}
