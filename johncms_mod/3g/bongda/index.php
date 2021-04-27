<?php
// @package Graber bongda.wap.vn
// @link http://gocmaster.com
// @Author: Ari
define('GOCMASTER', 1);
require('func.php');
$content = '<img src="ic.gif"/> <a href="today.php">Hôm nay</a><br />';
$content .= '<img src="ic.gif"/> <a href="live.php">Live</a><br />';
$content .= '<img src="ic.gif"/> <a href="kq.php">Kết quả</a><br />';
$content .= '<img src="ic.gif"/> <a href="ltd.php">Lịch thi đấu</a><br />';
$content .= '<img src="ic.gif"/> <a href="bxh.php">Bảng xếp hạng</a><br />';
$content .= '<img src="ic.gif"/> <a href="news.php">Tin tức</a>';
$title = 'Trang chính';
if(isset($_GET['err'])) {
$content = '<div class="rmenu">Trang không tồn tại hoặc đã bị xóa';
$title = 'Lỗi';
}
$header = 'Thông tin bóng đá';
echo displayContents($content, $header, $title);
?>