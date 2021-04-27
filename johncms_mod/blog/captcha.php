<?php
session_start();
$pkod = rand(0001,9999);
$_SESSION['ktc'] = $pkod;
$kod1=substr($pkod, 0, 1);
$kod2=substr($pkod, 1, 1);
$kod3=substr($pkod, 2, 1);
$kod4=substr($pkod, 3, 1);

$img=imagecreate(46,20);
$fon=imagecolorallocate($img,255,255,255);
imagefill($img,0,0,$fon);

$color1 = imagecolorallocate($img,rand(0,204),rand(0,204),rand(0,204));
$color2 = imagecolorallocate($img,rand(0,204),rand(0,204),rand(0,204));
$color3 = imagecolorallocate($img,rand(0,204),rand(0,204),rand(0,204));
$color4 = imagecolorallocate($img,rand(0,204),rand(0,204),rand(0,204));

ImageString($img, 5, rand(2,3), rand(0,3), $kod1, $color1);
ImageString($img, 5, rand(11,12), rand(0,3), $kod2, $color2);
ImageString($img, 5, rand(20,21), rand(0,3), $kod3, $color2);
ImageString($img, 5, rand(29,30), rand(0,3), $kod4, $color3);

for ($i=0; $i<5; $i++){
$temp_color=imagecolorallocate($img,204,204,204);
$pos=array(rand(0,42),rand(0,18),rand(0,42),rand(0,18));
imageline($img,$pos[0],$pos[1],$pos[2],$pos[3],$temp_color);
}

Header("Content-type: image/gif");
ImageGIF($img);
ImageDestroy($img);

?>
