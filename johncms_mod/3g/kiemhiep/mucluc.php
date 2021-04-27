<?php
include 'func.php';
include '../head.php';
$url= 'http://book.ipvnn.com/truyen-kiem-hiep/'.$_GET['truyen'].'';
$source = grab_link($url);
$batdau = '<div align="center" class="largetext">';
$ketthuc = '</table>';
$nd = laynoidung($source, $batdau, $ketthuc);
$nd = str_replace('<div align="center" class="largetext">','<div align="center" class="m">',$nd);
$nd = str_replace('<h1>','<div class="menu" align="center"><b>',$nd);
$nd = str_replace('</h1>','</b></div>',$nd);
$nd = str_replace('<td class="tdbullet">�</td>','',$nd);
$nd = str_replace('<tr><td>','<div class="menu">',$nd);
$nd = str_replace('</td></tr>','</div>',$nd);
$nd = str_replace('<div >','',$nd);
$nd = preg_replace('|<a href="/truyen-kiem-hiep/(.*?)/"|is','<a href="/kiemhiep/truyen/\1.html"',$nd);
$nd = iconv("windows-1252", "UTF-8", $nd);
echo $nd;
echo '</table></div>';
include '../end.php';
?>
