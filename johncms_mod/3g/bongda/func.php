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
echo '<style>
body {
background-color: #ffffff;
color: #000000;
font-family: Arial, Tahoma, sans-serif;
font-size: small;
margin: 0;
padding: 0;
}
.phdr {
font-weight: bold;
background-color: #bfc6cf;
border: 2px solid;
border-color: #e1e4e8 #96a2af #96a2af #e1e4e8;
padding: 3px 4px 3px 4px;
}
.rmenu {
background-color: #e9ccd2;
border: 1px solid white;
margin: 0;
padding: 2px 0 3px 4px;
}
.topmenu {
background-color: #DADDE0;
font-size: x-small;
padding: 2px 4px 3px 4px;
margin-bottom: 1px;
border-bottom: 1px solid #A8B1BB;
border-right: 1px solid #e1e4e8;
border-left: 1px solid #e1e4e8;
}
.footer {
font-weight: bold;
border: 2px solid #993333;
margin: 0;
padding: 3px 0 4px 4px;
}
.gmenu {
background-color: #c7e8d5;
border: 1px solid white;
margin: 0;
padding: 3px 4px 3px 4px;
}
.dong1 {
background-color: #eeecd9;
border: 1px solid white;
margin: 0;
padding: 3px 4px 4px 4px;
}
.dong2 {
background-color: #f5f5f5;
border: 1px solid white;
margin: 0;
padding: 3px 4px 4px 4px;
}
.maintxt {
border: 4px solid #586776;
font-weight: normal;
margin: 0;
padding: 4px 4px 4px 4px;
}
.menu {
background-color: #eeecd9;
border: 1px solid white;
margin: 0;
padding: 3px 4px 3px 4px;
}
</style>';
echo '<div class="phdr">' . $header . '</div>';
echo $content;
// vui long khong chinh sua hoac xoa dong duoi
echo '<center><div class="footer"><a href="http://' . $_SERVER['HTTP_HOST'] . '">' . $_SERVER['HTTP_HOST'] . '</a></div><center><a title="Vietnam Backlinks" href="http://www.backlinks.vn/" target="_blank"><img src="http://www.backlinks.vn/ads/backlinks.png" alt="Vietnam Backlinks" width="80" height="15" border="0" /></a>
<!-- Start Backlink Code --><a target="_blank" title="Free Automatic Link" href="http://camthachmyanmar.com.vn/backlink/"><img border="0" width="80" alt="Free Automatic Link" src="http://camthachmyanmar.com.vn/ec.gif" height="15" /></a><!-- End Backlink Code --></center>
';
echo '</body></html>';
$out = ob_get_contents();
ob_clean();
return $out;
}
// The End Function
?>