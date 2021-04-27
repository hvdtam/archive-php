<?php

include "function.php";
$url=$_GET['url'];


$Link = 'http://diemthi.24h.com.vn' . $url;
$KetQua=curl($Link);
?>
<table border="1" width="660" style="border-collapse: collapse" bordercolor="#C0C0C0">
<?
$kq = get_string_between($KetQua,'<table width="100%" cellpadding="1" cellspacing="1" border="0" bgcolor="#d7d7d7">','<div class="xemDiemKhac">');
$kq = str_replace('javascript:AjaxAction','javascript:ketqua2',$kq);
$kq = str_replace('a href="' , 'a href="#"',$kq);
$kq = str_replace('<div class="marBot10">','',$kq);
$kq = str_replace('<div class="padTop5 marBot10"><b>Ghi chú: </b>Tach du lieu nam 2011</div>','',$kq);
$kq = str_replace('<div class="marBot10">','',$kq);
$kq = str_replace('<a href="#"/diem-thi-tot-nghiep-thpt/" class="LinkBack" title="Tra điểm thi tốt nghiệp THPT">Quay lại <span class="textBold">Tra Điểm THPT</span></a><a href="#"/" class="LinkBackHome" title="Trang chủ điểm thi">Về <span class="textBold">Trang Chủ</span></a>','',$kq);

echo $kq;
//echo $KetQua;

