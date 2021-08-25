<?php



session_start();

define('CAPTCHA_NUMCHARS', 6);
define("CAPTCHA_WIDTH", 100);
define("CAPTCHA_HEIGHT", 25);

// generate the random pass-phrase

$pass_phrase = "";

for ($i=0; $i < CAPTCHA_NUMCHARS; $i++) { 
    $pass_phrase .= chr(rand(97, 122));
}

$_SESSION['pass_phrase'] = sha1($pass_phrase);
// echo $_SESSION['pass_phrase'];

   // gd_info();

    // phpinfo();

    
    // $image = imagecreatetruecolor(200, 200);
    // $white = imagecolorallocate($image, 0xff, 0xff, 0xff);
    // $black = imagecolorallocate($image, 0x00, 0x00, 0x00);

    // imagefilledrectangle($image, 50, 50, 150, 150,$black);

    // header("Content-Type: image/png");
    // imagepng($image);
    // create the image
    $img = imagecreatetruecolor(CAPTCHA_WIDTH, CAPTCHA_HEIGHT);
    // $version = GD_VERSION;
    // set background with black text and gray graphics



    $bg_color = imagecolorallocate($img, 255, 255, 255);
    $text_color = imagecolorallocate($img, 0, 0, 0);
    $graphic_color = imagecolorallocate($img, 64, 64, 64);

    // fill the background
    imagefilledrectangle($img, 0, 0, CAPTCHA_WIDTH, CAPTCHA_HEIGHT, $bg_color);

    // draw some random lines

    for ($i=0; $i < 50; $i++) { 
        imageline($img, 0, rand() % CAPTCHA_HEIGHT, CAPTCHA_WIDTH, rand() % CAPTCHA_HEIGHT, $graphic_color);
    }


    // sprinkle in some random dots
    for ($i=0; $i < 50; $i++) { 
        imagesetpixel($img, rand() % CAPTCHA_WIDTH, rand() % CAPTCHA_HEIGHT, $graphic_color);
    }

    // draw the pass-phrase string
    imagettftext($img, 18, 0, 5, CAPTCHA_HEIGHT - 5, $text_color, "asset/fonts/OpenSans-Regular.ttf", $pass_phrase);

    header("Content-Type: image/png");

    imagepng($img);

    //clean up 
    imagedestroy($img);


    ?>


