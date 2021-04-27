<?php
// @package Graber bongda.wap.vn
// @link http://gocmaster.com
// @Author: Ari
define('GOCMASTER', 1);
require('func.php');
$link = 'http://3g.wap.vn/news/category.jsp?catid=13';
if($page) {
$link = 'http://3g.wap.vn/news/category.jsp?catid=13&page=' . $page;
}
if($id) {
$link = 'http://3g.wap.vn/news/detail.jsp?id=' . $id;
}
$html = getContents($link);
$html = preg_replace('|<!DOCTYPE(.*?)<div style="padding:5px;|is', 'HEADER', $html);
$html = preg_replace('|HEADER(.*?)</div>|is', '', $html);
$html = preg_replace('|<div class="menu-theloaikhac">(.*?)</html>|is', '', $html);
$html = str_replace('<div class="tieudeDVkhac">', '<div class="phdr">', $html);
$html = str_replace('<div class="noidungtin1">', '<div class="menu">', $html);
$html = str_replace('<div class="noidungtin2">', '<div class="gmenu">', $html);
$html = str_replace('<div class="tindacbiet">', '<div class="dong2">', $html);
$html = str_replace('<div class="menu3"', '<div class="topmenu"', $html);
$html =  str_replace('detail.jsp', 'news.php', $html);
$html = str_replace('category.jsp', 'news.php', $html);
$html = str_replace('&catid=13', '', $html);
$html = str_replace('<img src="/images', '<img src="http://3g.wap.vn/images', $html);
$html = str_replace('<img src="../images', '<img src="http://3g.wap.vn/images', $html);
$html .= '<img src="ic.gif"/> <a href="today.php">Hôm nay</a><br />';
$html .= '<img src="ic.gif"/> <a href="live.php">Live</a><br />';
$html .= '<img src="ic.gif"/> <a href="kq.php">Kết quả</a><br />';
$html .= '<img src="ic.gif"/> <a href="ltd.php">Lịch thi đấu</a><br />';
$html .= '<img src="ic.gif"/> <a href="bxh.php">Bảng xếp hạng</a>';
$header = '<a href="index.html">Bóng đá</a> &raquo; Tin tức';
echo displayContents($html, $header, 'Tin tức');
?>