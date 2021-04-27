<?php
header ("content-type:text/html; charset=UTF-8");
?><?php
include'head.php';
include'func.php';
$tl = $_GET['tl'];
$url= "http://truyenviet.com/".$tl."";
$source = grab_link($url);
$batdau = '<span>Add Your Site</span>';
$ketthuc = '<span style="font-family: arial,helvetica,sans-serif;">©2002-2009 TruyenViet.com</span>';
$toan = laynoidung($source, $batdau, $ketthuc);
$toan = str_replace('<a href="/','<a href="?tl=', $toan);
echo $toan;
include'end.php';
?>