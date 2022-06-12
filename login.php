<?php
    function generateCaptcha($path)
    {
        $characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $captchaString = "";
        $captchaLength = 5;

        for($i = 0; $i < $captchaLength; $i++){
            $captchaString .= $characters[rand(0, strlen($characters)-1)];
        }

        $im = imagecreatetruecolor(100, 50);

        $right = 10; $top = 35; $fontSize = 20; $spacing = 15;
        for($i = 0; $i < $captchaLength; $i++){
            imagettftext($im, $fontSize, rand(-15, 15), $right + $i * $spacing, $top, 
                imagecolorallocate($im, rand(10, 255), rand(10, 255), rand(10, 255)), 
                'assets/RobotoCondensed-Bold.ttf', $captchaString[$i]);

            imagepng($im, $path);
        }
        
        return $path;
    }
?>

<html>
    <head>
        <title>User Login</title>
    </head>
    <body>
        <h2>User Login</h2>
        <form name="login" method="post" action="login_check.php">
            Email: <input type="text" name="email"><br/>
            Password: <input type="text" name="password"><br/>
            Remember me: <input type="checkbox" name="rememberMe" value="1"><br/>
            <input type="submit" name="submit" value="Log In">
        </form>

        <img src = <?php echo generateCaptcha("assets/img/captcha.png"); ?> >
    </body>
</html>

<!-- ----------------------- -->
<!--

@include 'config.php';
session_start();


if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

      
   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_array($result);
      
     if((isset($_POST['email']))&& (isset($_POST['password'])))
{
        if(isset($_POST['remember']))
        {
            /* set cookie to last 1 year */
            setcookie('email', $_POST['email'], time()+60*60*24*365);
            setcookie('password', md5($_POST['password']), time()+60*60*24*365);
            echo "Remember me cookie set!";
        }
        else 
        {
            /* Cookie expires when browser closes */
            setcookie('email', $_POST['email'], false);
            setcookie('password', md5($_POST['password']), false);
            echo "Remember me cookie not set!";
        }
}
else
{
    echo 'You must supply a username and password.';
}   
      
      if($row['user_type'] == 'admin'){
         $_SESSION['admin_name'] = $row['name'];
         header('location:admin_page.php');
      }elseif($row['user_type'] == 'user'){
         $_SESSION['user_name'] = $row['name'];
         header('location:user_page.php');
      }
   }else{
      $error[] = 'incorrect email or password!';
   }
};

-->