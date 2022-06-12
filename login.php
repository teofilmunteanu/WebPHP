<?php
session_start();
?>
<html>
    <head>
        <title>User Login</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <h2>User Login</h2>
        <form name="login" method="post" action="login_check.php">
            <table>
                <?php if(isset($_SESSION['message'])){
                    echo "<tr>
                            <td style='color:red;'>".$_SESSION['message']."</td>
                        </tr>";
                    unset($_SESSION['message']);
                }?>
                <tr>
                    <td colspan="2"><strong>Enter your account:</strong></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="text" name="email"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="text" name="password"></td>
                </tr>
                <tr>
                    <td>Remember me:</td>
                    <td><input type="checkbox" name="rememberMe" value="1"></td>
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
                    <td><input type="text" name="captchaAnswer"></td>
                </tr>    
                <tr>
                    <td><input type="submit" name="submit" value="Log In"></td>
                </tr>
            </table> 
        </form>
        
        <p>Don't have an account? <a href ='signup.php'>Sign up</a></p>

        <script src="assets/js/scripts.js"></script>
    </body>
</html>
