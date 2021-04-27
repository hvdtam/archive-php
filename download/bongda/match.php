<?php
// @package Graber bongda.wap.vn
// @link http://gocmaster.com
// @Author: Ari
define('GOCMASTER', 1);
require('func.php');
if($id && $code) {
$link = 'http://bongda.wap.vn/ketqua/match.jsp?id=' . $id . '&code=' . $code;
}
if($page && $id && $code) {
$link = 'http://bongda.wap.vn/ketqua/match.jsp?page=' . $page . '&id=' . $id . '&code=' . $code;
}
$html = getContents($link);
$html =  str_replace('match.jsp', 'match.php', $html);
$html = preg_replace('|<div class="gmenu">(.*?)</html>|is', '', $html);
$html = str_replace('../ketqua/ketqua.jsp', 'kq.php', $html);
$html = str_replace('../today.jsp', 'today.php', $html);
$html = preg_replace('|<!DOCTYPE(.*?)<div class="rmenu">|is', '<div class="rmenu">', $html);
$html = str_replace('../lichthidau/ltd.jsp', 'ltd.php', $html);
$html = str_replace('../bxh/xephang.jsp', 'bxh.php', $html);
if($code) {
$html = str_replace('../images', 'http://bongda.wap.vn/images', $html);
preg_match('#<div class="rmenu">(.*)</div>#', $html, $phdr);
$html = preg_replace('|<div class="rmenu">(.*?)</div>|', '', $html);
$phdr[0] = str_replace('../ketqua', 'kq.php', $phdr[0]);
$phdr[0] = preg_replace('|<div class="rmenu">(.*?)</div>|', '\1', $phdr[0]);
$phdr[0] = preg_replace('|<b>(.*?)</b>|', '\1', $phdr[0]);
}
$header = '<a href="index.html">Bóng đá</a> &raquo; Kết quả';
if($code) {
$header = '<a href="index.html">Bóng đá</a> &raquo; '.$phdr[0];
}
echo displayContents($html, $header, 'Kết quả');
?>