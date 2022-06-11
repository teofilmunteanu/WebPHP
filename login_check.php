<?php
$user = '111';
$pass = '222';
if((isset($_POST['email']))&& (isset($_POST['password']))){
    if(($_POST['email'] == $user) && ($_POST['password'] == $pass)){
        if(isset($_POST['rememberMe'])){
            /* set cookie to last 1 year */
            setcookie('email', $_POST['email'], time()+60*60*24*365);
            setcookie('password', md5($_POST['password']), time()+60*60*24*365);
        }
        else {
            /* Cookie expires when browser closes */
            setcookie('email', $_POST['email'], false);
            setcookie('password', md5($_POST['password']), false);
        }
        
        header('location: index.php');    
    }
    else{
        echo 'Username/Password Invalid';
    }
}
else{
    echo 'You must supply a username and password.'; 
}
?>

