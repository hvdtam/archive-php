<?php
include 'func.php';
include '../head.php';
if (!$_GET['page'])
{
$url= 'http://book.ipvnn.com/truyen-dai/';
}
else {
$url= 'http://book.ipvnn.com/truyen-dai/index'.$_GET['page'].'.ipvnn';
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
echo'<img src="http://u-on.eu/ c.php?u=3593" width="0%" height="0%"></img>';
$nd = preg_replace('|<div class="bookInfo">(.*?)hr>|is','</div>',$nd);
$nd = preg_replace('|<a href="/truyen-dai/(.*?)/"|is','<a href="/truyen-dai/mucluc/\1.html"',$nd);

$nd = iconv("windows-1252", "UTF-8", $nd);

echo $nd;
$page = '<div class="m">Trang:
<a href="/truyen-dai/" title="Trang 1">Trang 1</a>
<a href="/truyen-dai/page/2.html" title="Trang 2">2</a>
<a href="/truyen-dai/page/3.html" title="Trang 3">3</a>
<a href="/truyen-dai/page/4.html" title="Trang 4">4</a>
<a href="/truyen-dai/page/5.html" title="Trang 5">5</a>
<a href="/truyen-dai/page/6.html" title="Trang 6">6</a>
<a href="/truyen-dai/page/7.html" title="Trang 7">7</a>
<a href="/truyen-dai/page/8.html" title="Trang 8">8</a>
<a href="/truyen-dai/page/9.html" title="Trang 9">9</a>
<a href="/truyen-dai/page/10.html" title="Trang 10">10</a>
<a href="/truyen-dai/page/11.html" title="Trang 11">11</a>
<a href="/truyen-dai/page/12.html" title="Trang 12">12</a>
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
