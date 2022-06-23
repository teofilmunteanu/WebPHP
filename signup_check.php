<?php
class User{
    private $email;
    private $pass;
    private $lastName;
    private $firstName;
    private $userType;
    
    function __construct(){
        $this->userType = "normal";
    }
    
    public function setData($e, $p, $ln, $fn){
        $this->email = $e;
        $this->pass = $p;
        $this->lastName = $ln;
        $this->firstName = $fn;
    }
    
    public function getData(){
        return array($this->email, $this->pass, $this->lastName, $this->firstName, $this->userType);
    }
}

require_once 'connection.php';
session_start();
$table="users";
$message="Failed";

if(strtoupper($_POST['captchaAnswer1']) == $_POST['captchaValue']){
    if(($_POST['email'] != "") && ($_POST['password'] != "")
            && ($_POST['cpassword'] != "") && ($_POST['lastName'] != "")
            && ($_POST['firstName'] != "")){
        $email = $_POST['email'];
        $queryEmail = "SELECT * FROM $table WHERE email='$email'";
        $resultEmail=mysqli_query($con, $queryEmail);
        
        if(mysqli_num_rows($resultEmail) == 0){
            if(strlen($_POST['password'])>=6){
                if($_POST['password'] == $_POST['cpassword']){

                    $user = new User();
                    $user->setData($_POST['email'], md5($_POST['password']), $_POST['lastName'], $_POST['firstName']);
                    
                    $values  = implode("', '", $user->getData());
                    $query= "INSERT INTO $table (email, password, lastName, firstName, userType) VALUES ('$values')";
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
        else
        {
            $message = "Email already used.";
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

