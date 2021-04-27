<?php
include'vipkute.php';
include'head.php';
$duongdan = $_GET['keng'];
$url= "http://thuvien.thegioitrochoi.vn/Story/Detail/".$duongdan."";
$source = grab_link($url);
$batdau = '<div class="content">';
$ketthuc = '</body></html>';
$keng = laynoidung($source, $batdau, $ketthuc);
$keng = str_replace('<a href="/Story/Detail/','<a href="?keng=',$keng);
$keng = str_replace('<a href="/Story/Read/','<a href="re.php?keng=',$keng);
$keng = str_replace('© Phohien Media 2011 | CSKH 04.39057454','© Kho truyện MCT', $keng);
echo $keng;
include'foot.php';
?>