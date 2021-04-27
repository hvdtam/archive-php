<?php
error_reporting(0);
$user = $_SERVER['HTTP_X_OPERAMINI_PHONE'];
$user = str_replace('#', '', $user);
if($user)
header("Content-Type: text/html; charset=utf-8");
echo '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN"
"http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="vi" id="vbulletin_html">
<head><title>XEMBOI.TK</title><meta http-equiv="Content-Type" content="application/vnd.wap.xhtml+xml; charset=utf-8" /><link rel="icon" href="http://vn.wen9.com/ic.gif"/><link rel="stylesheet" type="text/css" href="http://mvn3g.wen9.com/css/sky.css"/><meta name="Robots" content="INDEX,FOLLOW" /> <meta name="Revisit-after" content="1 Day" /> </head><body><div class="body"> <a id="up" href="#down"> </a> <div class="gmenu"><center><span style="font-size:12px; font-weight: bold; color: orange; text-shadow: #000000 3px 3px 4px;">XEMBOI.TK</center></span></div>
<div class="menu"><center><span style="font-size:12px; font-weight: bold; color: #949494; text-shadow: #000000 3px 3px 4px;"> <a href="/"style="color:#99cc33">Home</a> </span>
| <b>๏  '.$user.' </b>
</div><div class="menu"><script type="text/javascript" src="http://mvn3g.wen9.com/js/az.js"></script>
</div>';

?>
