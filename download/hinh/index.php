<?php
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'http://alomob.net/pict/index.php?lg=en');
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: text/html','charset:UTF-8'));
curl_setopt($curl, CURLOPT_USERAGENT, 'Nokia5130c-2/2.0 (07.96) Profile/MIDP-2.1 Configuration/CLDC-1.1');
curl_setopt($curl, CURLOPT_REFERER, 'http://bentrewap.com');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_TIMEOUT, 30);
$nd = curl_exec($curl);
curl_close($curl);
$nd = preg_replace(array('/<!(.+?)center">Pictures<\/div>/is', '/<a href="http:\/\/alomob.net(.+?)<\/html>/is'), '', $nd);
$nd = preg_replace('/<div(.+?)cat.php(.+?)&amp;lg=en">(.+?)<\/a>(.+?)<\/div>/is', "<div class=\"main\"><img src=\"http://truyen.bentrewap.com/img/next.png\"> <a href=\"cat.php$2&amp;m=$3\">$3</a></div>", $nd);

echo '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>
<title>Hình Nền Tổng Hợp</title>
<meta name="keywords" content="hinh nen tong hop, hinh nen dien thoai, wap tai hinh nen, hinh nen dep nhap, hinh nen mobile, wap hinh nen, wap tai hinh" />
<meta name="description" content="hinh nen tong hop, hinh nen dien thoai, wap tai hinh nen, hinh nen dep nhap, hinh nen mobile, wap hinh nen, wap tai hinh" /><link rel="shortcut icon" href="http://10bc1.tk/img/fav.ico"/>
<link rel="stylesheet" href="http://10bc1.tk/img/style.css" media="all" />
<meta http-equiv="Content-Type" content="application/vnd.wap.xhtml+xml; charset=utf-8" /></head><body>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="trang wap upload tep tin danh cho mobile">
<meta name="keywords" content="Wap teen, wap upload, wap up so 1 vn, Wap ViP, wap viet nam, wap chat free, tai xuong, tamk.tk, tai game, wap hot cho DT, tamk.tk, Wap Of Teen, Ck S2 Zk, Ck S2 Vk, Wap hot, wap pro, wap tong hop, wap tai nhac" />
<link rel="stylesheet"
type="text/css" href="http://m.wapdep.tk/style.css"/><link
rel="icon" href="http://tamk.wen.ru/favicon.ico"/>
<title>Wap 3G VN</title><a name="bottom"></a>
<title>Wap 3G VN</title><a name="bottom"></a>
<style>
.forum #menu, .forum #search .text  {border-color:#FFB600;}
.forum #header {height:37px;background repeat-x;padding:3px 0 0 10px}
.forum #menu .active, .forum #search .button, .forum h1.title {background:#FFB600;}
.forum #footer {text-align:center;padding:5px 0;background:#e28b08;color:#fff}
.forum .list li {list-style:square;margin:3px 0 3px 13px;color:#e28b08}
.forum .tab .active {color:#b01e1e}
.forum .guide li {color:#000}
.forum .msg {border-bottom: 1px solid #E7E7E7; padding: 5px;background:#FAFAFA}
.forum .error {color:#b0397c}
.forum .info {color:#494949}
.forum p,td {line-height:10px}
#menu {padding-left:5px;border-bottom:5px solid #FFB600;font-size:12px}
#menu a {color:#494949;font-weight:bold}
#menu tr, #menu td{height:25px;padding-top:4px}
#menu td {padding-left:5px;padding-right:5px;text-align:center}
#menu .active {background:#FFB600;}
#menu .active a {color:#fff}
.sitemap {
font-size: xx-small;
position: relative;
width: 100%;
height: 38px;
z-index: 1;
overflow: auto;
}</style></head><body>
<div class="main index">
<div id="menu">
<table cellpadding="0" cellspacing="0">
<tbody><tr>
<td class="active"><a href="http://' . $_SERVER['HTTP_HOST'] . '">Home</a></td>
<td  width="10" ><a href="http://up.wapdep.tk/">Up</a></td>
<td  width="10"><a href="http://' . $_SERVER['HTTP_HOST'] . '/mp3.php">Mp3</a></td>
<td  width="10"><a href="http://wapdep.tk/chat">Chat</a></td>
</tr>
</tbody></table>
</div></div>
<a name="TOP"><div class="menu">&rsaquo;<b> Hình nền</b></div>'.$nd.'<div class="foot"><a href="http://LaiVung2.Tk">LaiVung2.Tk</a></div></body></html>';
?>
