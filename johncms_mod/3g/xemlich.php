<?php
define('_IN_ANHPHU', 1);
require_once ('func.php');
$title = " Xem lich";
require_once ("head.php");
echo '<div class="menu">';
if(empty($_GET['link'])){$url = 'http://m.xalo.vn/xemngay.mobi';}else{
if(empty($_GET['p'])){$url = 'http://m.xalo.vn'.$_GET['link'];}else{

$url = 'http://m.xalo.vn'.$_GET['link'].'&p='.$_GET['p'].'';}}

$source = grab_link($url);

$batdau = '<img src="/micon/ical.gif" border="0"/>';
$ketthuc = '<form action="/kq';
$tin = laynoidung($source, $batdau, $ketthuc);

$tin = preg_replace("/<a href='/","<a href='?link=",$tin);
$tin = preg_replace('/<a href="/','<a href="?link=',$tin);
echo $tin;
echo '</div>';
require_once ("end.php");
?>
