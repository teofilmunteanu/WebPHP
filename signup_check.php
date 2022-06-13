<?php
class User{
    public $email;
    public $pass;
    public $lastName;
    public $firstName;
    public $userType;
    function __construct(){
        $this->userType = "normal";
    }
    
    public function setData($e, $p, $ln, $fn){
        $this->email = $e;
        $this->pass = $p;
        $this->lastName = $ln;
        $this->firstName = $fn;
    }
}

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
                
                $user = new User();
                $user->setData($_POST['email'], md5($_POST['password']), $_POST['lastName'], $_POST['firstName']);
                $query="INSERT INTO $table(email, password, lastName, firstName, userType) VALUES ('{$user->email}', '{$user->pass}', '{$user->lastName}', '{$user->firstName}', '{$user->userType}')";
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

