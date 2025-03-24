<?php
session_start();

$captcha_code = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 6);
$_SESSION["captcha"] = $captcha_code;

header("Content-Type: image/png");
$image = imagecreate(150, 50);
$background_color = imagecolorallocate($image, 255, 255, 255); 
$text_color = imagecolorallocate($image, 0, 0, 0); 

imagestring($image, 5, 35, 15, $captcha_code, $text_color);

imagepng($image);
imagedestroy($image);
?>
