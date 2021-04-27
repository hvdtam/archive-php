<?php

include 'replacetonghop.php'; 
include 'head.php';
if(empty($_GET['link'])){$url = 'http://m.xalo.vn/boivui.mobi';}else{
     if(empty($_GET['p'])){$url = 'http://m.xalo.vn'.$_GET['link'];}else{
	     $url = 'http://m.xalo.vn'.$_GET['link'].'&p='.$_GET['p'].'';}}
     	 $source = grab_link($url);
	     $batdau = '<img src="/micon/itamlinh.gif" border="0"/>';
     	$ketthuc = '<form action="/kq';
     	$tin = laynoidung($source, $batdau, $ketthuc);
  	   $tin = preg_replace("/<a href='/","<a href='?link=",$tin);
  	   $tin = preg_replace('/<a href="/','<a href="?link=',$tin);
echo $tin;

echo '</div>';
include 'foot.php'; 

?>