<?php
$title = 'Nhạc Chuông Cực Hot';
include 'inc/func.php';
include 'head.php';
if($_GET['kvs']) {
$url='http://waphay.com/'.$_GET['kvs'];
} else {
$url='http://waphay.com/';
}
$kvs=grabkvs($url);
$kvs=preg_replace('|(.*)</form>|is','',$kvs);
$kvs=preg_replace('|<div id="footer">(.*)|is','',$kvs);
$kvs=str_replace('<a href="http://waphay.com/nghe-bai-hat/','<a href="?kvs=/nghe-bai-hat/',$kvs);
$kvs=str_replace('<a href="http://waphay.com/the-loai','<a href="?kvs=/the-loai',$kvs);
$kvs=str_replace('<a href="http://waphay.com/page','<a href="?kvs=/page',$kvs);
$kvs=str_replace('<div class="list-song">','',$kvs);
$kvs=str_replace('<div class="download" align="center">','<div class="page" align="center">',$kvs);
$kvs=str_replace('<div class="TOP_2" align="center">','<div class="bmenu">',$kvs);
$kvs=str_replace('CHỌN THỂ LOẠI','Chọn Thể Loại',$kvs);
$kvs=str_replace('<div class="category">','<div class="list1">',$kvs);
$kvs=str_replace('<img src="http://waphay.com/images/o.png" />','<img src="http://3g.wapdep.tk/tintuc/ring/images/list.png"/> ',$kvs);
$kvs=str_replace('<li>','<div class="list1">',$kvs);
$kvs=str_replace('</li>','</div>',$kvs);
$kvs=str_replace('<ul>','',$kvs);
$kvs=str_replace('</ul>','',$kvs);
$kvs=str_replace('Dự đoán Euro - Vồ ngay iPad','',$kvs);
echo $kvs;
include 'end.php';
?>
