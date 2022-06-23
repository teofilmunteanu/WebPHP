window.onload = generateCaptcha();

function drawLines(){
    var c = document.getElementById("captcha");
    var ctx = c.getContext("2d");
    
    var rgb = [Math.floor(Math.random() * 127) + 70, Math.floor(Math.random() * 127) + 70, Math.floor(Math.random() * 127) + 70];
    for ( var i = 0; i < 3; i++ ){
        var col = 'rgb(' + rgb[0] + ',' + rgb[1] + ',' + rgb[2] + ')';
        ctx.strokeStyle = col;
        
        var randLeft = Math.floor(Math.random() * 50);
        var randRight = Math.floor(Math.random() * 50);
        
        ctx.moveTo(0, randLeft);
        ctx.lineTo(100, randRight);
        ctx.stroke();
    }
    
    for ( var i = 0; i < 3; i++ ){
        var col = 'rgb(' + rgb[0] + ',' + rgb[1] + ',' + rgb[2] + ')';
        ctx.strokeStyle = col;
        
        var randTop = Math.floor(Math.random() * 100);
        var randBot = Math.floor(Math.random() * 100);
        ctx.moveTo(randTop, 0);
        ctx.lineTo(randBot, 50);
        ctx.stroke();
    }
}

function drawText(length){
    var text = "";
    
    var c = document.getElementById("captcha");
    var ctx = c.getContext("2d");
    
    ctx.font = "20px Arial";
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    
    for ( var i = 0; i < length; i++ ) {
        var char = characters[Math.floor(Math.random() * characters.length)];
        var rgb = [Math.floor(Math.random() * 255) + 70, Math.floor(Math.random() * 255) + 70, Math.floor(Math.random() * 255) + 70];
        var col = 'rgb(' + rgb[0] + ',' + rgb[1] + ',' + rgb[2] + ')';
        ctx.fillStyle = col;
        
        var randLeftRight = (Math.floor(Math.random() * 3) - 1);
        var randRot = (Math.floor(Math.random() * 21) +15);
        ctx.save();
        ctx.translate(0, randLeftRight*i*3);
        ctx.rotate(-randLeftRight*(Math.PI / randRot));
        ctx.fillText(char, (i+1)*15, 35);
        ctx.restore();
        
        text += char;
    }
    
    return text;
}

function generateCaptcha(){
    var captchaLength = 5;
    
    var c = document.getElementById("captcha");
    var ctx = c.getContext("2d");
    
    c.width = 100;
    c.height = 50;
    
    ctx.fillStyle = "black";
    ctx.fillRect(0, 0, 100, 50);
    
    drawLines();

    var captchaText = drawText(captchaLength);
    
    document.getElementById("captchaVal").value = captchaText; 
}
