<?php

error_reporting(0); 
$m=str_replace('Xalo','WAP QNA',$m);
$m=preg_replace('|<body>(.*?)src="/micon|is','<body><div class="phdr"><img src="http://m.xalo.vn/micon',$m); $m=preg_replace('|<form(.*?)</html>|is','',$m); $m=preg_replace('|&amp;type(.*?)"|is','&amp;type=JPEG&amp;w=100&amp;h=100"',$m); $m=str_replace('src="/m','src="http://m.xalo.vn/m',$m); $m=preg_replace('|<b>Chú (.*?)</div>|is','</div>',$m); $m=preg_replace('|<b>Có(.*?)<b>|is','<b>',$m); $m=str_replace('.tn','.tnx',$m); $m=preg_replace('|width="(.*?)"|is','width="120"',$m); $m=preg_replace('|height="(.*?)"|is','height="120"',$m);
$m=str_replace('<a href="xthum','<img src="http://m.xalo.vn/xthum',$m); $m=str_replace('tnx?','tnx&',$m); $m=str_replace('tnxc','tnc',$m); $m=str_replace('<a href="mdown','<img src="http://m.xalo.vn/mdown',$m);
$m=str_replace('tnc?','tnc&',$m); $m=str_replace('.st','.stx',$m); $m=str_replace('.stxc','.stc',$m); $m=str_replace('?p=','&p',$m); $m=str_replace('?offset','&offset',$m);
echo(!empty($m))?$m:'<html><head><meta http-equiv="refresh"content="2"><title>Tải lại...</title></head><body><blink><b style="color:red;">Vui lòng tải lại trang này</b></blink>';

?>
