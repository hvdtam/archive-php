<?php
$m=preg_replace('|width="(.*?)"|is','width="128"',$m); $m=preg_replace('|height="(.*?)"|is','height="128"',$m);

$aa=explode('<a href="/mdown?url=',$m); $bb=explode('&amp;type',$aa[1]); $full=$bb[0];
$m=preg_replace('|<?(.*?)<img src="/micon|is','<div class="j"><img src="/micon',$m);  $m=preg_replace('|<form(.*?)</html>|is','<center class="h">Download ảnh nền miễn phí</center>',$m);
$m=preg_replace('|<b>Chú(.*?)</div>|is','</div>',$m); $m=preg_replace('|<b>Có(.*?)<b>|is','<b>',$m); $m=preg_replace('|&amp;type=(.*?)">|is','">',$m);
$m=str_replace('=ni','=JPEG',$m); $m=str_replace('src="/','src="http://m.xalo.vn/',$m); $m=str_replace('<a href="/mdown?url=','<a href="http://m.xalo.vn/mdown?url='.$full.'&amp;type=JPEG&amp;w=128&amp;h=128">128x128</a><a href="http://m.xalo.vn/mdown?url='.$full.'&amp;type=JPEG&amp;w=128&amp;h=160">128x160</a><a href="',$m); $m=str_replace('<a href="x','<img src="http://m.xalo.vn/x',$m);
$m=str_replace('<a href="/photo.mobi','<a href="/photo',$m); $m=str_replace('/photo.mpts?s=','/photo/down/',$m); $m=str_replace('/photo.mptc?c=','/photo/cat/',$m);
echo(!empty($m))?$m:'<html><head><meta http-equiv="refresh" content="4"><title>Reloading....</title></head><body><b>This page will auto reload ! if it does not work please <a href=$_SERVER["PHP_SELF"]>click here!</a></b></body></html>';

?>
