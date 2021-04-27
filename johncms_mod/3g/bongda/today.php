<?php
// @package Graber bongda.wap.vn
// @link http://gocmaster.com
// @Author: Ari
define('GOCMASTER', 1);
require('func.php');
$link = 'http://bongda.wap.vn/today.jsp';
if($code) {
$link = 'http://bongda.wap.vn/today.jsp?code=' . $code;}
if($team) {
$link = 'http://bongda.wap.vn/today.jsp?team=' . $team;}
if($team && $team2) {
$link = 'http://bongda.wap.vn/today.jsp?team=' . $team . '&team2=' . $team2;}
$html = getContents($link);
$html = preg_replace('|<!DOCTYPE(.*?)<!--start-->|is', '', $html);
$html = preg_replace('|<div class="gmenu" align="center">(.*?)</html>|is', '', $html);
$html = preg_replace('|<td align="right" colspan="3"><small>(.*?)</small></td>|is', '', $html);
$html = str_replace('./images', 'http://bongda.wap.vn/images', $html);
$html = str_replace('today.jsp', 'today.php', $html);
$html = str_replace('./ketqua/match.jsp', 'match.php', $html);
$html = str_replace('./lichthidau/tyle.jsp', 'tyle.php', $html);
$html = str_replace('./bxh/xephang.jsp', 'bxh.php', $html);
$header = '<a href="index.html">Bóng đá</a> &raquo; Hôm nay';
echo displayContents($html, $header, 'Hôm nay');
?>