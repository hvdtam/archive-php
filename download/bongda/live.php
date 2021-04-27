<?php
// @package Graber bongda.wap.vn
// @link http://gocmaster.com
// @Author: Ari
define('GOCMASTER', 1);
require('func.php');
$link = 'http://bongda.wap.vn/live.jsp';
if($code) {
$link = 'http://bongda.wap.vn/live.jsp?code=' . $code;}
if($id && $code) {
$link = 'http://bongda.wap.vn/live.jsp?id=' . $id . '&code=' . $code;}
if($team) {
$link = 'http://bongda.wap.vn/live.jsp?team=' . $team;}
$html = getContents($link);
$html = preg_replace('|<!DOCTYPE(.*?)<!--start-->|is', '', $html);
$html = preg_replace('|<div class="gmenu" align="center">(.*?)</html>|is', '', $html);
$html = str_replace('images', 'http://bongda.wap.vn/images', $html);
$html = str_replace('live.jsp', 'live.php', $html);
$html = str_replace('./today.jsp', 'today.php', $html);
$html = str_replace('./ketqua/match.jsp', 'match.php', $html);
$html = str_replace('./lichthidau/tyle.jsp', 'tyle.php', $html);
$html = str_replace('./bxh/xephang.jsp', 'bxh.php', $html);
$header = '<a href="index.html">Bóng đá</a> &raquo; Live';
echo displayContents($html, $header, 'Live');
?>