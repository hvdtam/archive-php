<?php
// @package Graber bongda.wap.vn
// @link http://gocmaster.com
// @ Author: Ari
define('GOCMASTER', 1);
require('func.php');
$link = 'http://bongda.wap.vn/lichthidau/tyle.jsp';
if($code) {
$link = 'http://bongda.wap.vn/lichthidau/tyle.jsp?code=' . $code;
}
if($code && $team) {
$link = 'http://bongda.wap.vn/lichthidau/tyle.jsp?code=' . $code . '&team=' . $team;
}
if($id && $code) {
$link = 'http://bongda.wap.vn/lichthidau/tyle.jsp?id=' . $id . '&code=' . $code;
}
$html = getContents($link);
$html =  str_replace('../ltd.jsp', 'ltd.php', $html);
$html = preg_replace('|<!DOCTYPE(.*?)<div class="rmenu">|is', '<div class="rmenu">', $html);
$html = preg_replace('|<div class="gmenu">(.*?)</html>|is', '', $html);
$html = str_replace('../lichthidau', 'ltd.php', $html);
if($code) {
$html = str_replace('../ketqua/match.jsp', 'match.php', $html);
$html = str_replace('../ketqua/ketqua.jsp', 'ketqua.php', $html);
$html = str_replace('../bxh/xephang.jsp', 'bxh.php', $html);
$html = str_replace('../images', 'http://bongda.wap.vn/images', $html);
preg_match('#<div class="rmenu">(.*)</div>#', $html, $phdr);
$html = preg_replace('|<div class="rmenu">(.*?)</div>|', '', $html);
$phdr[0] = preg_replace('|<div class="rmenu">(.*?)</div>|', '\1', $phdr[0]);
$phdr[0] = preg_replace('|<b>(.*?)</b>|', '\1', $phdr[0]);
}
$header = '<a href="index.html">Bóng đá</a> &raquo; Tỷ lệ';
if($code) {
$header = '<a href="index.html">Bóng đá</a> &raquo; '.$phdr[0];
}
echo displayContents($html, $header, 'Tỷ lệ');
?>