function refreshCaptcha()
{
    document.getElementById("captcha").src='captcha.php?' + Date.now();
}