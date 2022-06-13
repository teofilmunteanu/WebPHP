<?php
session_start();
?>
<html>
    <head>
        <title>Sign Up</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <h2>User Registration</h2>
        <form name="signup" method="post" action="signup_check.php">
            <table>
                <?php if(isset($_SESSION['messageSignUp'])){
                    echo "<tr>
                            <td colspan='2' style='color:red;'>".$_SESSION['messageSignUp']."</td>
                        </tr>";
                    unset($_SESSION['messageSignUp']);
                }
                ?>
                <tr>
                    <td colspan="2"><strong>Create your account:</strong></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email"></td>
                </tr>
                <tr>
                    <td>Last Name:</td>
                    <td><input type="text" name="lastName"></td>
                </tr>
                <tr>
                    <td>First Name:</td>
                    <td><input type="text" name="firstName"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="cpassword"></td>
                </tr>
                <tr>
                    <td><img src = "captcha.php" id="captcha"></td>
                    <td><button type="button" style="font-size:24px" onclick="refreshCaptcha()">
                            <i class="fa fa-refresh"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>Text in the picture:</td>
                    <td><input type="text" name="captchaAnswer1"></td>
                </tr>    
                <tr>
                    <td><input type="submit" name="submit" value="Sign Up"></td>
                </tr>
                <tr>
                    <td>Already have an account? </td>
                    <td><a href ='login.php'>Log In</a></td>
                </tr>
            </table> 
        </form>
        
        <script src="assets/js/scripts.js"></script>
    </body>
</html>



