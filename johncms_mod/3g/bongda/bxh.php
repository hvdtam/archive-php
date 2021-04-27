<?php
// @package Graber bongda.wap.vn
// @link http://gocmaster.com
// @Author: Ari
define('GOCMASTER', 1);
require('func.php');
$link = 'http://bongda.wap.vn/bxh/';
if($code) {
$link = $link . 'xephang.jsp?code=' . $code;
}
$html = getContents($link);
$html = preg_replace('|<!DOCTYPE(.*?)<!--start-->|is', '', $html);
$html = preg_replace('|<div class="gmenu" align="center">(.*?)</html>|is', '', $html);
$html =  str_replace('xephang.jsp', 'bxh.php', $html);
if($code) {
preg_match('#<div class="rmenu">(.*)</div>#', $html, $phdr);
$html = preg_replace('|<div class="rmenu">(.*?)</div>|', '', $html);
$html = str_replace('../ketqua/ketqua.jsp', 'kq.php', $html);
$phdr[0] = str_replace('../bxh', 'bxh.php', $phdr[0]);
$phdr[0] = preg_replace('|<div class="rmenu">(.*?)</div>|', '\1', $phdr[0]);
$phdr[0] = preg_replace('|<b>(.*?)</b>|', '\1', $phdr[0]);
}
$header = '<a href="index.html">Bóng đá</a> &raquo; BXH';
if($code) {
$header = '<a href="index.html">Bóng đá</a> &raquo; '.$phdr[0];
}
echo displayContents($html, $header, 'Bảng xếp hạng');
?>