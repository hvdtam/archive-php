<?php
include'vipkute.php';
include'head.php';
$duongdan = $_GET['keng'];
$url= "http://thuvien.thegioitrochoi.vn/Story/Categories".$duongdan."";
$source = grab_link($url);
$batdau = '<div class="caption">';
$ketthuc = '</body></html>';
$keng = laynoidung($source, $batdau, $ketthuc);
$keng = str_replace('<a href="/Story/Category/','<a href="ca.php?keng=', $keng);
$keng = str_replace('<a href="/Story/Categories?olderthan','<a href="?keng=?olderthan', $keng);
$keng = str_replace('© Phohien Media 2011 | CSKH 04.39057454','© Kho truyện MCT', $keng);
echo $keng;
include'foot.php';
?>