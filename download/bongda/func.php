<?php
// @package Graber bongda.wap.vn
// @link http://gocmaster.com
// @ Author: Ari

defined('GOCMASTER') or die('Coding by Ari');
$id = isset($_GET['id']) ? intval($_GET['id']) : false;
$page = isset($_GET['page']) ? intval($_GET['page']) : false;
$code = isset($_GET['code']) ? $_GET['code'] : false;
$team = isset($_GET['team']) ? $_GET['team'] : false;
$team2 = isset($_GET['team2']) ? $_GET['team2'] : false;
// gzip handler
@ini_set('zlib.output_compression', 'On');
// get Contents
function getContents($url) {
if(function_exists('curl_init')) {
$curl = curl_init();
curl_setopt($curl, CURLOPT_REFERER, 'http://google.com');
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_USERAGENT, 'Nokia 2700 Classic/BOT Spider(http://gocmaster.com) v1.0');
curl_setopt ($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded"));
$html = curl_exec($curl);
curl_close($curl);
} else {
$html = 'Lỗi từ máy chủ: hàm curl_init không được hỗ trợ';
}
return $html;
}
// Start get HTML page
function displayContents($content, $header, $textl = 'Trang chính') {
ob_start();
header("Cache-Control: public");
header('Content-type: application/xhtml+xml; charset=UTF-8');
echo '<?xml version="1.0" encoding="utf-8"?>' . "\n";
echo "\n" . '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">';
echo "\n" . '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="vi">';
echo "\n" . '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
echo "\n" . '<meta name="title" content="Bóng đá" />';
echo "\n" . '<meta name="content-language" content="vi" />';
echo "\n" . '<meta name="keywords" content="bong, da, lich, thi, dau, euro, world, cup, ket, qua, bang, xep hang" />';
echo "\n" . '<meta name="description" content="Thông tin bóng đá tổng hợp, bảng xếp hạng, lịch thi đấu, euro cup, world cup, AFF cup, Laliga cup,..." />';
echo "\n" . '<title>' . $textl . ' - Bóng đá</title>';
echo "\n" . '</head><body>';
// style design by JohnCMS
echo '
<link rel="stylesheet" type="text/css" href="http://m.wapdep.tk/style.css">';
echo '<div class="phdr">' . $header . '</div>';
echo $content;
// vui long khong chinh sua hoac xoa dong duoi
echo '<center><div class="footer"><a href="http://' . $_SERVER['HTTP_HOST'] . '">' . $_SERVER['HTTP_HOST'] . '</a></div></center>
';
echo '</body></html>';
$out = ob_get_contents();
ob_clean();
return $out;
}
// The End Function
?>
