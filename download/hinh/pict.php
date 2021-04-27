<?php
$page = isset($_GET['page']) ? '&page='.$_GET['page']:'';
$resl = $_GET['resl'];
$cat_id = $_GET['cat_id'];
$m = $_GET['m'];
$mn = $_GET['mn'];

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'http://alomob.net/pict/pict.php?cat_id='.$cat_id.'&resl='.$resl.$page.'&lg=en');
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: text/html','charset:UTF-8'));
curl_setopt($curl, CURLOPT_USERAGENT, 'Nokia5130c-2/2.0 (07.96) Profile/MIDP-2.1 Configuration/CLDC-1.1');
curl_setopt($curl, CURLOPT_REFERER, 'http://bentrewap.com');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_TIMEOUT, 30);
$nd = curl_exec($curl);
curl_close($curl);
$nd = preg_replace(array('/<!(.+?)<br\/>---<br\/>/is', '/<a href="http:\/\/alomob.net(.+?)<\/html>/is'), '', $nd);
$nd = preg_replace(array('/<a(.+?)src="(.+?)"(.+?)Downloads: (.+?)<br>(.+?)content_id=(.+?)">(.+?)<br>/is', '/<input class="enter" name="lg" type="hidden" value="en">/i'), array("<div class=\"main\"> <img style=\"margin: 1px;\" src=\"http://alomob.net/pict/$2\" alt=\"BenTreWap\"><br>
&rsaquo; <a href=\"down.php?id=$6\">Tải về máy</a></div>", "<input class=\"enter\" name=\"mn\" type=\"hidden\" value=\"$mn\">\n<input class=\"enter\" name=\"m\" type=\"hidden\" value=\"$m\">"), $nd);
$nd = str_replace(array('<div class="d">', 'Page', '&amp;lg=en'), array('<div class="trang">', 'Trang', '&amp;m='.$m.'&amp;mn='.$mn), $nd);

echo '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>
<title>'.$mn.' - '.$m.'</title>
<meta name="keywords" content="hinh nen tong hop, hinh nen dien thoai, wap tai hinh nen, hinh nen dep nhap, hinh nen mobile, wap hinh nen, wap tai hinh" />
<meta name="description" content="hinh nen tong hop, hinh nen dien thoai, wap tai hinh nen, hinh nen dep nhap, hinh nen mobile, wap hinh nen, wap tai hinh" /><link rel="shortcut icon" href="http://truyen.bentrewap.com/img/fav.ico"/>
<link rel="stylesheet" href="http://truyen.bentrewap.com/img/style.css" media="all" />
<meta http-equiv="Content-Type" content="application/vnd.wap.xhtml+xml; charset=utf-8" /></head><body>
<div class="head"><a href="http://pic.bentrewap.com"><img src="http://truyen.bentrewap.com/img/logo.png" width="150" height="45"></a></div>
<div class="table"><div id="tab"><table width="100%" cellpadding="0" cellspacing="0"><tbody><tr><td width="25%"><a href="http://truyen.bentrewap.com">Truyện</a></td><td width="25%"><a href="http://bentrewap.com">Game</a></td>
<td width="25%"><a href="http://theme.bentrewap.com">Theme</a></td>
<td width="25%"><a href="http://wap.bentrewap.com">Wap</a></td></tr></tbody></table></div></div>
<a name="TOP"><div class="main">&rsaquo;<a href="index.php">Trang chủ</a> &rsaquo;<a href="cat.php?resl='.$resl.'&m='.$m.'">'.$m.'</a> &rsaquo;<b>'.$mn.'</b></div>'.$nd.'</div>
<div class="tmn"><a href="http://pic.bentrewap.com"><img src="http://truyen.bentrewap.com/img/back.gif"></a> <a href="#TOP"><img src="http://truyen.bentrewap.com/img/top.gif"></a></div><div class="foot">
© 2012 <a href="http://bentrewap.com">BenTreWap</a><br>
All rights reserved</div><a href="http://daylogs.com/show/544155ky"><img src="http://daylogs.com/counter/544155ky.gif?v=small" alt="Online" width="80" height="15" border="0"></a></body></html>';
?>
