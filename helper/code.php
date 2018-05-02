<?php
session_start();

$str=dechex(rand(1,15));
$str.=dechex(rand(1,15));
$str.=rand(1,9);
//$str.=rand(1,9);

$arr=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
$str.=$arr[rand(0,25)];
$_SESSION['code']=$str;

$width=120;
$height=40;
$im=imagecreatetruecolor($width,$height);
$bg=imagecolorallocate($im,0,0,0);
$te=imagecolorallocate($im,255,255,255);

//干扰线
for($i = 0;$i < 15;$i++) {   
        $font_color = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));   
        imagearc($im, mt_rand(- $width, $width), mt_rand(- $height, $height), mt_rand(50, $width*2 ), mt_rand(50, $height*2 ), mt_rand(0, 360), mt_rand(0, 360), $font_color);   
    }    
//干扰点  
for($i = 0;$i < 50;$i++) {   
        $font_color = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));   
        imagesetpixel($im, mt_rand(0, $width), mt_rand(0, $height), $font_color);   
    }    	
    
imagestring($im,5,mt_rand(5,$width-30),mt_rand(5,$height-15),$str,$te);//先大小，后左右，再上下
header("Content-type: image/png");
imagepng($im);   //显示图片
imagedestroy($im);//销毁图片
?>