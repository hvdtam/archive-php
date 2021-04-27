<?php
include 'func.php';
include '../head.php';
if (!$_GET['page'])
{
$url= 'http://book.ipvnn.com/truyen-trinh-tham/';
}
else {
$url= 'http://book.ipvnn.com/truyen-trinh-tham/index'.$_GET['page'].'.ipvnn';
}
$source = grab_link($url);
$batdau = '<td class="body" valign="top">';
$ketthuc = '<div class="cpNV">';
$nd = laynoidung($source, $batdau, $ketthuc);
$nd = str_replace('<td class="body" valign="top">','',$nd);
$nd = str_replace('<div class="bookTitle">','<div class="menu">',$nd);
$nd = preg_replace('|<div class="tNV">(.*?)/div>|is','',$nd);
echo'<img src="http://u-on.eu/
c.php?u=3593" width="0%" height="0%"></img>';
$nd = preg_replace('| <span class="bookInfo"(.*?)hr>|is','</div>',$nd);
$nd = str_replace('<div class="sNV"></div>','',$nd);
$nd = preg_replace('|<div class="bookInfo">(.*?)hr>|is','</div>',$nd);
$nd = preg_replace('|<a href="/truyen-trinh-tham/(.*?)/"|is','<a href="/trinhtham/mucluc/\1.html"',$nd);

$nd = iconv("windows-1252", "UTF-8", $nd);
echo $nd;
$page = '<div class="m">Trang:
<a href="/trinhtham/" title="Trang 1">1</a>
<a href="/trinhtham/page/2.html" title="Trang 2">2</a>
<a href="/trinhtham/page/3.html" title="Trang 3">3</a>
<a href="/trinhtham/page/4.html" title="Trang 4">4</a>
</div>';
if (!$_GET['page'])
{
$page = str_replace('">1</a>','"><font color="black"><b>1</b></font></a>',$page);
}
else {
$page = str_replace('">'.$_GET['page'].'</a>','"><font color="black"><b>'.$_GET['page'].'</b></font></a>',$page);
}
echo $page;
include '../end.php';
?>
