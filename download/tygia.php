<?php
define('_IN_ANHPHU', 1);
require_once ('func.php');
require_once ("head.php");
echo '<div class="bmenu">Tỷ giá</div>';
echo '<div class="menu"><img src="micon/igame.gif" alt="»"/>';
if(empty($_GET['link'])){$url = 'http://m.xalo.vn/USD.mtg';}
$source = grab_link($url);

$batdau = 'Tỷ giá</a>:<b>';

$ketthuc = '<form action="/kq';

$tin = laynoidung($source, $batdau, $ketthuc);
echo $tin;
echo '</div>';
echo '<div class="menu"><img src="micon/igame.gif" alt="»"/>';
if(empty($_GET['link'])){$url = 'http://m.xalo.vn/VANG.mtg';}
$source = grab_link($url);

$batdau = 'Tỷ giá</a>:<b>';

$ketthuc = '<form action="/kq';

$tin = laynoidung($source, $batdau, $ketthuc);

echo $tin;

echo '</div>';
echo '<div class="menu"><img src="micon/igame.gif" alt="»"/>';
if(empty($_GET['link'])){$url = 'http://m.xalo.vn/EUR.mtg';}
$source = grab_link($url);

$batdau = 'Tỷ giá</a>:<b>';

$ketthuc = '<form action="/kq';

$tin = laynoidung($source, $batdau, $ketthuc);

echo $tin;

echo '</div>';
require_once ("end.php");
?>
