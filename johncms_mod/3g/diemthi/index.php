<?php
include "function.php";

class TinhTP
{
public $MaTinh,$TenTinh;
public function __construct($M,$T) {
$this->MaTinh = $M;
$this->TenTinh = $T;
}
}


$DanhSachTinh=array();
$daco=curl("http://diemthi.24h.com.vn/diem-thi-tot-nghiep-thpt/");
$arr=explode('<div class="TenTruongContainer" id="box_tra_diem_ptth" style="border:#202020;" >',$daco);
$arr=explode('</div>',$arr[1]);
$arr=explode('<option class="sel_option_select" value=\'',$arr[0]);
#print_r($arr);

$SoTinhDaCo=count($arr);
for($i=0;$i<$SoTinhDaCo;$i++)
{
$arrt=explode("' href='/diem-thi-tot-nghiep-thpt/",$arr[$i]);
$MaTinh=$arrt[0];
$arrt=explode("<h2>",$arrt[1]);
$arrt=explode("</h2>",$arrt[1]);
$TenTinh=$arrt[0];
$DanhSachTinh[$i]=new TinhTP($MaTinh,$TenTinh);
}
$SoTinhDaCo--;
for($i=1;$i<=$SoTinhDaCo;$i++)
{
if($i==1)
$List.="<option selected value='{$DanhSachTinh[$i]->MaTinh}{$DanhSachTinh[$i]->TenTinh}</option>";
else
$List.="<option value='{$DanhSachTinh[$i]->MaTinh}{$DanhSachTinh[$i]->TenTinh}</option>";
}

?>

<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" type="text/css" href="http://soidong.org/mobile_vbb4.css"/>
<script type="text/javascript" src="code.js"></script>
<script type="text/javascript" src="http://diemthi.24h.com.vn/js/diemthi.js"></script>
<title>Tra cứu điểm thi tốt nghiệp trung học phổ thông năm 2012</title>
</head>
<body>
<center>
<center><b><font color="red">Xem Điểm Thi Tốt Nghiệp 2012 </font></b></center>





<br /><br /><br />
<font color="#C3643B"><b>Hiện Tại Đã Có <font color="red"><?=$SoTinhDaCo?></font> Hội Đồng Thi Công Bố Điểm Thi</b></font>
<br /><br /><br /><br />
<form method="POST">
<input type="text" name="TuKhoa" id="TuKhoa" size="45" style="border-color:green; border-style:solid ;border-width:2px;-webkit-border-radius: 20px;-moz-border-radius: 20px;padding-left:20px;">
<select size="1" name="TinhTP" id="TinhTP" >
<?=$List?>
</select>

<input type="button" class="button" value="Tra điểm" onClick="ketqua();" >
</form>
<br /><br />
<div id="div_kq_diem_ptth" name="div_kq_diem_ptth" width="660"></div>
<p><br>
<br />
<br />
<?php
echo'<center><a title="Vietnam Backlinks" href="http://www.backlinks.vn/" target="_blank"><img src="http://www.backlinks.vn/ads/backlinks.png" alt="Vietnam Backlinks" width="80" height="15" border="0" /></a>
<!-- Start Backlink Code --><a target="_blank" title="Free Automatic Link" href="http://camthachmyanmar.com.vn/backlink/"><img border="0" width="80" alt="Free Automatic Link" src="http://camthachmyanmar.com.vn/ec.gif" height="15" /></a><!-- End Backlink Code --></center>';

?><br/>
</body>

</html>
