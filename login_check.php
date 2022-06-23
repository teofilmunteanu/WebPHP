<?php
require_once 'connection.php';
require_once 'securityHandler.php';
session_start();
$table="users";
$message="Failed";

if(strtoupper($_POST['captchaAnswer']) == $_POST['captchaValue']){
    if(($_POST['email'] != "") && ($_POST['password'] != "")){
        $email = $_POST['email'];
        $pass = md5($_POST['password']);
        $query = "SELECT * FROM $table WHERE email='$email' AND password='$pass'";
        $result=mysqli_query($con, $query);
        
        if(mysqli_num_rows($result) == 1){
            if(isset($_POST['rememberMe'])){
                addToken($email);
            }

            $message = "Success";
            $_SESSION['email'] = $email;
           
            header('location: index.php');    
        }
        else{
            $message = "Email/Password Invalid.";
        }
    }
    else{
        $message = "You must supply an email and password.";
    }
}
else{
    $message = "Incorrect captcha";
}

if($message == "Failed"){
    $message = "Something went wrong";
}

if($message != "Success")
{
    $_SESSION['messageLogIn'] = $message;
    header('location: login.php');
}

?>

