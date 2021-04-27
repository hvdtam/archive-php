<?php
include 'head.php';
echo '<div class="iblock">[<font color="red"><b>MCT</b></font>] Nhạc chuông cực đỉnh</div>';
if(empty($_GET['link'])){$url = 'http://m.xalo.vn/ringtone.mobi';}else{
if(empty($_GET['p'])){$url = 'http://m.xalo.vn/'.$_GET['link'];}else{
	     $url = 'http://m.xalo.vn/'.$_GET['link'].'&p='.$_GET['p'].'';}}
     	$source = grab_link($url);
	     $batdau = '<div>';
     	$ketthuc = '<form action="/kq';
     	$tin = laynoidung($source, $batdau, $ketthuc);
  	   $tin = preg_replace("#<a href='#","<a href='../?link=",$tin);
  	   $tin = preg_replace('#<a href="#','<a href="../?link=',$tin);
  	   $tin = str_replace('?link=/mrtd','http://m.xalo.vn/mrtd',$tin);
echo $tin;
      echo '</div>';
      echo '';
     include 'foot.php';
?>