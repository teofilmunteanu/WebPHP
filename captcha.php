<?php
    session_start();
    //ENABLE GD
    function generateCharacters($captchaLength)
    {
        $characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $captchaString = "";

        for($i = 0; $i < $captchaLength; $i++){
            $captchaString .= $characters[rand(0, strlen($characters)-1)];
        }
        
        return $captchaString;
    }
    
    function drawText($image, $captchaString){
        $right = 10; $top = 35; $fontSize = 20; $spacing = 15;
        for($i = 0; $i < strlen($captchaString); $i++){
            imagettftext(
                    $image, $fontSize, rand(-15, 15), $right + $i * $spacing, $top,
                    imagecolorallocate($image, rand(70, 255), rand(70, 255), rand(70, 255)), 
                    'assets/RobotoCondensed-Bold.ttf', $captchaString[$i]
                    );
        }
    }

    function drawLines($image){
        for($i = 0; $i < 3; $i++){
            $left = array(0, rand(0,50));
            $right = array(100, rand(0,50));
            
            $lineColor = imagecolorallocate($image, rand(70, 255), rand(70, 255), rand(70, 255));
            imageline($image, $left[0], $left[1], $right[0], $right[1], $lineColor);
        }
        
        for($i = 0; $i < 3; $i++){
            $bot = array(rand(0,100), 50);
            $top = array(rand(0,100), 0);
            
            $lineColor = imagecolorallocate($image, rand(70, 255), rand(70, 255), rand(70, 255));
            imageline($image, $bot[0], $bot[1], $top[0], $top[1], $lineColor);
        }
    }
    

    $img = imagecreatetruecolor(100, 50);
    $captchaLength = 5;
    $captchaString = generateCharacters($captchaLength); 
    
    $_SESSION['captchaString'] = $captchaString;
    
    header('Content-type: image/png');
    
    drawText($img, $captchaString);  
    drawLines($img);
    imagepng($img);
?>
