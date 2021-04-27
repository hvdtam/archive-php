<?php
/**
* Grab XXX
*
* Grab Video 3x http://livepornos.net
*
* @author VnCMS TEAM <viaiviai_anh_phai_online_the_nay@yahoo.com>
* @copyright Copyright (c) 2011, VnCMS Team
* @link http://vncms.net
*/

/**
* Cài đặt
*/
$count_to_view = 5;
// Hiển thị số video trên 1 trang.

ini_set('zlib.output_compression_level', 3);
ob_start('ob_gzhandler');
$page = isset($_GET['page']) ? abs($_GET['page']) : 0;

function curl_get($url)
{
$curl = curl_init();
/*
* Khởi tạo phiên làm việc Curl.
*/
curl_setopt($curl, CURLOPT_URL, $url);
/*
* Thiết lập đường dẫn Url.
*/
curl_setopt($curl, CURLOPT_USERAGENT,  $_SERVER['HTTP_USER_AGENT']);
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_TIMEOUT, 60);
/*
* Thời gian tối đa thực hiện một phiên Curl.
*/
$html = curl_exec($curl);
curl_close($curl);
return $html;
}

header("Cache-Control: public");
header('Content-type: application/xhtml+xml; charset=UTF-8');
header("Expires: " . date("r",  time() + 60));
echo '<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="vi">
<head>
<title>Free Video XXX</title>
<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8"/>
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="Generator" content="vn.chantroi.net, http://vn.mchantroi.net,sex,download sex,download video sex,sex full,mp4 sex,3gp sex download" />
<style type="text/css">
.title {
color: #fff;
position: relative;
margin-top: 3px;
margin-bottom: -16px;
margin-left: 3px;
padding-right: 3px;
padding-left: 3px;
border-color: #8fdcff;
border-style: groove ridge ridge groove;
border-width: 2px;
display: table;
background: #1895d4 repeat-x 50% top;
}
.menu {
color: blue;
margin: 2px;
padding: 6px;
border: 1px solid #e6e6e6;
background: #fff repeat-x 50% top;
}
</style>';
require('head.php');

$p = $page * $count_to_view;
for($i = $p; $p + $count_to_view > $i; ++$i)
{
$url = "livepornos.net/Default.asp?" . "v=y" . ($i > 0 ? "&amp;p=$i" : "");
$html = curl_get($url);
preg_match('#src\=\"(/file.+?)\"#i', $html, $src);
preg_match_all('#href\=\"(get.+?)\"#i', $html, $href, PREG_SET_ORDER);

echo '<div class="menu"><img src="http://livepornos.net';
echo $src[1];
echo '" /></div><div class="title"><b>Download</b></div><b>&raquo;</b> <a href="http://livepornos.net/';
echo $href[0][1];
echo '"><b>3GP</b></a><br />';
echo '<b>&raquo;</b> <a href="http://livepornos.net/';
echo $href[1][1];
echo '"><b>3GP bản đẹp</b></a><br />';
echo '<b>&raquo;</b> <a href="http://livepornos.net/';
echo $href[2][1];
echo '"><b>MP4</b></a></td></tr>';
}
echo '</table><div class="menu">';
if ($page > 0)
{
echo '<a href="xxx.php?page=' . ($page - 1) . '"> << Trang trước</a> | ';
echo '<a href="xxx.php?page=' . ($page + 1) . '">Trang sau >> </a>';
} else {
echo '<a href="xxx.php?page=' . ($page + 1) . '">Trang sau >></a>';
}
echo'</div></div>';
require('foot.php');

ob_flush();
?>
