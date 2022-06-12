<?php
@include 'connection.php';
session_start();
$table="users";
$message="";

if(strtoupper($_POST['captchaAnswer']) == $_SESSION['captchaString']){
    if(($_POST['email'] != "")&& ($_POST['password'] != "")){
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $query = "SELECT * FROM $table WHERE email='$email' and password='$pass'";
        $result=mysqli_query($con, $query);
        
        if(mysqli_num_rows($result) == 1){
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
            $message = "Username/Password Invalid.";
            header('location: login.php');
        }
    }
    else{
        $message = "You must supply a username and password.";
        header('location: login.php');
    }
}
else{
    $message = "Incorrect captcha";
    header('location: login.php');
}
$_SESSION['message'] = $message;

?>

