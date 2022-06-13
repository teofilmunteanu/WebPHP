<?php
require_once 'connection.php';
session_start();
$table="users";
$message="Failed";

if(strtoupper($_POST['captchaAnswer1']) == $_SESSION['captchaString']){
    if(($_POST['email'] != "") && ($_POST['password'] != "")
            && ($_POST['cpassword'] != "") && ($_POST['lastName'] != "")
            && ($_POST['firstName'] != "")){
        
        if(strlen($_POST['password'])>=6){
            if($_POST['password'] == $_POST['cpassword']){
                $email = $_POST['email'];
                $pass = md5($_POST['password']);
                $lastName = $_POST['lastName'];
                $firstName = $_POST['firstName'];
                $userType = "normal";
                $query="INSERT INTO $table(email, password, lastName, firstName, userType) "
                    . "VALUES ('{$email}', '{$pass}', '{$lastName}', '{$firstName}', '{$userType}')";
                $result=mysqli_query($con, $query);
                $message = "Success";
                header('location: index.php');  
            }
            else{
                $message = "Passwords must match";
            }        
        }
        else{
            $message = "Password is too short.";
        }
    }
    else{
        $message = "All of the fields are mandatory";
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
    $_SESSION['messageSignUp'] = $message;
    header('location: signup.php');
}


?>

