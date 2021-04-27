<?php
include 'func.php';
include '../head.php';
$url= 'http://book.ipvnn.com/truyen-kiem-hiep/'.$_GET['truyen'].'';
$source = grab_link($url);
$batdau = '<div class="innerTitle">';
$ketthuc = '</div><div class="pNV">';
$nd = laynoidung($source, $batdau, $ketthuc);
$nd = str_replace('<div class="innerTitle">','<div class="m" align="center">',$nd);
$nd = preg_replace('|<div class="sName">(.*?)</div>|is','<div class="menu" align="center"><b>\1</b></div>',$nd);
$nd = str_replace('<div class="content">','<div class="menu">',$nd);
$nd = str_replace('<div class="ending">','<div class="menu">',$nd);
$nd = preg_replace('|<a href="/truyen-kiem-hiep/(.*?)/"|is','<a href="/kiemhiep/truyen/\1.html"',$nd);
$nd = str_replace('<a href="/truyen-kiem-hiep/">','<a href="/kiemhiep/index.html">',$nd);
$nd = str_replace('<a href="/">','<a href="http://anhphu.org">',$nd);
$nd = str_replace('--------------------------------------------------------------------------------<br>','',$nd);
$nd = iconv("windows-1252", "UTF-8", $nd);
echo $nd;
echo '</div>';
include '../end.php';
?>
