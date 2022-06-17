function refreshCaptcha()
{
    document.getElementById("captcha").src='captcha.php';
}

function showUploadMenu()
{
    document.getElementById("uploadCover").style.display='inline';
}

function hideUploadMenu()
{
    document.getElementById("uploadCover").style.display = 'none';
}
