<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<style type="text/css"> </style>
<meta http-equiv="Content-Type" content="application/vnd.wap.xhtml+xml; charset=utf-8" />
</head>
<body><?php
include 'func.php';
include '../head.php';
$duongdan = $_GET['wap'];
$url= "http://goctaigame.net/game/3d/".$duongdan."";
$canlay = grab_link($url);
$batdau = '<div class="upban">';
$ketthuc = '</html>';
$wap =  laynoidung($canlay, $batdau, $ketthuc);
$wap = str_replace('<a href="','<a href="?wap=',$wap);
$wap = str_replace('<img src="icon/','<img src="http://goctaigame.net/game/3d/icon/',$wap);
$wap = str_replace('<a href="?wap=http://','<a href="http://',$wap);
$wap = str_replace('Goctaigame.net', 'LaiVung2.Tk', $wap);

echo $wap;

include '../end.php';
?>
