<?php
include 'func.php';
include 'head.php';
///////////////////////
$qr = str_replace('m=','',$_SERVER['QUERY_STRING']);
$url = 'http://m.dantri.com.vn/'.$qr;

while (!$source){$source = grab_link($url);}
$source = laynoidung($source,'</table>','<b>Copyright 2010</b>');
$source = str_replace('href="','href="index.php?m=',$source);
$source = str_replace("href='","href='?m=",$source);
$source = str_replace('src="/ImagesGUI/','src="http://m.dantri.com.vn/ImagesGUI/',$source);
$source = str_replace('href="index.php?m=javascript:history.go(-1);"','href="javascript:history.go(-1);"',$source);
echo $source;
//////////////////
include 'end.php';
?>
