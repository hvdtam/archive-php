<?php



$p_font=$_GET['font'];            
$p_text=$_GET['text'];             
$p_angle=$_GET['angle'];         
$p_bg1=$_GET['bg1'];             
$p_bg2=$_GET['bg2'];               
$p_bg3=$_GET['bg3'];               
$p_txtcolor1=$_GET['txtcolor1'];     
$p_txtcolor2=$_GET['txtcolor2'];    
$p_txtcolor3=$_GET['txtcolor3'];     
$p_size=$_GET['size'];          
$p_format=$_GET['format'];        
$b_alpha=$_GET['b_alpha'];       

if (ereg("[A-Za-zа-яА-Я,$,>,<,',`,;,/,\,&,#,,,.,:,*,@,!,%,^,(,)]","$p_angle$p_size"))
{
include "../head.php";
echo "<center class=\"b\">Lỗi!!!<br/><a href=\"create.php\">trở về</a></center>";
include "../foot.php";
exit;
}

if (ereg("[A-Zg-zа-яА-Я,$,>,<,',`,;,/,\,&,#,,,.,:,*,@,!,%,^,(,)]","$b_alpha"))
{
include "../head.php";
echo "<center class=\"b\">độ trong sáng chỉ từ 0-127!!!<br/><a href=\"create.php\">trở về</a></center>";
include "../foot.php";
exit;
}

if (ereg("[J-Zj-zа-яА-Я,$,>,<,',`,;,/,\,&,#,,,.,:,*,@,!,%,^,(,)]","$p_bg1$p_bg2$p_bg3$p_txtcolor1$p_txtcolor2$p_txtcolor3"))
{
include "../head.php";
echo "<center class=\"b\">kí tự k hợp lệ!!!<br/><a href=\"create.php\">trở về</a></center>";
include "../foot.php";
exit;
}

if (ereg("[а-яА-Я,$,>,<,',`,;,/,\,&,#,,,:,*,@,!,%,^,(,)]","$p_text"))
{
include "../head.php";
echo "<center class=\"b\">chỉ sử dụng kí tự latin!!!<br/><a href=\"create.php\">trở lạ</a></center>";
include "../foot.php";
exit;
}


if ($b_alpha>127){$b_alpha="127";}elseif($b_alpha==0){$b_alpha="0";}elseif($b_alpha==""){$b_alpha="0";}
if ($p_font==""){ include "../head.php"; echo "<center class=\"b\">kí tự k hợp lệ!!!<br/><a href=\"create.php\">Trở về</a></center>"; include "../foot.php"; exit; }
if ($p_size>40){$p_size="40";}
if ($p_angle==""){$p_angle="0";}
if ($p_angle>180){$p_angle="180";} 
if ($p_angle<-180){$p_angle="-180";}
if ($p_text==""){$p_text="5 SECOND LOGO";} 
if ($p_text=="5 SECOND LOGO"){$b_alpha="127";} 
$font = getcwd()."/fonts/$p_font.ttf";

$angle = $p_angle;     
$font_size = $p_size; 
$text = "$p_text";   

$pos= ImageTTFBbox($font_size, $angle, $font, $text);



$min_x = min($pos[0], $pos[2], $pos[4], $pos[6]);
$max_x = max($pos[0], $pos[2], $pos[4], $pos[6]);
$width = $max_x-$min_x+1;


$min_y = min($pos[1], $pos[3], $pos[5], $pos[7]);
$max_y = max($pos[1], $pos[3], $pos[5], $pos[7]);
$height = $max_y-$min_y+1;

$im = ImageCreate($width+1, $height+1); 
$bg = ImageColorAllocateAlpha($im, $p_bg1, $p_bg2, $p_bg3, $b_alpha);
$textcolor = ImageColorAllocate($im, $p_txtcolor1, $p_txtcolor2, $p_txtcolor3);


ImageTTFtext($im, $font_size, $angle, $pos[0]-$min_x, $pos[1]-$min_y,
	$textcolor, $font, $text);


if ($p_format=="png"){@HEADER("Content-type: image/png");  ImagePNG($im);}
if ($p_format=="gif"){@HEADER("Content-tupe: image/gif");  ImageGIF($im);}
if ($p_format=="jpeg"){@HEADER("Content-type: image/jpeg");  ImageJPEG($im, "", 100);}

ImageDestroy($im);
?>