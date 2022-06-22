var uploadCover = document.getElementById("uploadCover");

uploadCover.addEventListener("click", hideUploadMenuLocal);
uploadCover.addEventListener("click", hideUploadMenuPublic);

function refreshCaptcha()
{
    document.getElementById("captcha").src='captcha.php';
}

function showUploadMenuLocal()
{
    document.getElementById("uploadCover").style.display='block';
    document.getElementById("boxLocal").style.display = 'block';
}

function hideUploadMenuLocal()
{
    document.getElementById("uploadCover").style.display = 'none';
    document.getElementById("boxLocal").style.display = 'none';
}

function showUploadMenuPublic()
{
    document.getElementById("uploadCover").style.display='block';
    document.getElementById("boxPublic").style.display = 'block';
}

function hideUploadMenuPublic()
{
    document.getElementById("uploadCover").style.display = 'none';
    document.getElementById("boxPublic").style.display = 'none';
}


var idToDelete="";

function selectDelete(id){
    idToDelete = id;
}

function confirmDelete(lastContentType){
    window.location.href = "delete.php?id="+idToDelete+"&last_content_type="+lastContentType;
}
