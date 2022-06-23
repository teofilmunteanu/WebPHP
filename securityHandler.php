<?php
    require __DIR__.'/connection.php';
    
    class SecurityHandler{
        static function generateToken(){
            $token = openssl_random_pseudo_bytes(16);
            $token = bin2hex($token);

            return $token;
        }

        static function addToken($email){
            $table = "usertokens";
            $token = self::generateToken();

            /* set cookie to last 1 year */
            $expirationAdder = 60*60*24*365;
            setcookie('email', $email, time()+$expirationAdder);
            setcookie('token', $token, time()+$expirationAdder);

            $query="INSERT INTO $table(email, token, expirationDate) VALUES ('{$email}',"
                . "'{$token}', NOW()+00010000000000)";

            $result= mysqli_query($GLOBALS['con'], $query)or die(mysqli_error($con));
        }

        static function checkUserToken($email, $token){ 
            $table = "usertokens";
            $query = "SELECT * FROM $table WHERE email='$email' AND token='$token' AND expirationDate > NOW() LIMIT 1";
            $result=mysqli_query($GLOBALS['con'], $query);

            if(mysqli_num_rows($result) == 1){
                return true;
            }
            return false;
        }
    }
    
    
   
    
    
    
    