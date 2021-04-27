<?php
include 'func.php';
include '../head.php';
if (!$_GET['page'])
{
$url= 'http://book.ipvnn.com/truyen-co-tich/';
}
else {
$url= 'http://book.ipvnn.com/truyen-co-tich/index'.$_GET['page'].'.ipvnn';
}
$source = grab_link($url);
$batdau = '<td class="body" valign="top">';
$ketthuc = '<div class="cpNV">';
$nd = laynoidung($source, $batdau, $ketthuc);
$nd = str_replace('<td class="body" valign="top">','',$nd);
$nd = str_replace('<div class="bookTitle">','<div class="menu">',$nd);
$nd = preg_replace('|<div class="tNV">(.*?)/div>|is','',$nd);
$nd = preg_replace('| <span class="bookInfo"(.*?)hr>|is','</div>',$nd);
$nd = str_replace('<div class="sNV"></div>','',$nd);
$nd = preg_replace('|<div class="bookInfo">(.*?)hr>|is','</div>',$nd);
$nd = preg_replace('|<a href="/truyen-co-tich/(.*?)/"|is','<a href="/truyen-co-tich/mucluc/\1.html"',$nd);
$nd = iconv("windows-1252", "UTF-8", $nd);

echo $nd;
include '../end.php';
?>
