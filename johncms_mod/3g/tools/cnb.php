<?php
include'func.php';
include'../head.php';
$id = $_GET['id'];
if($id) {
$source=grab_link('http://tucuong.tk/viewcamnghibay.php?id='.$id.'.html');
} else {
$source=grab_link('http://tucuong.tk/camnghibay.php');
}
if($id) {
$batdau = '<div class="hot"><div class="td2">';
} else {
$batdau='<div class="ax"><div class="a">';
}
$ketthuc='<div class="footer" align="center">';
$view=laynoidung($source, $batdau, $ketthuc);
$view= str_replace('camnghibay.php','cnb.php',$view);
$view= str_replace('camnghibay?id=','viewcnb.php?id=',$view);
$view= str_replace('.html','',$view);
$view= str_replace('#comment_up','',$view);
$view= str_replace('#comment_down','',$view);
$view= str_replace('#copy','',$view);
$view= str_replace('<div class="a"','<div class="menu"',$view);
$view= str_replace('<div class="td2"','<div class="footer"',$view);
echo $view;
include'../foot.php';
?>