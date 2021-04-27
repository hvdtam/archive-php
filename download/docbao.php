<?php

define('_IN_ANHPHU', 1);
require_once ('func.php');

$type = $_GET['type'];
$bao = $_GET['bao'];
$duongdan = $_GET['view'];

if($bao=='24h'){$linkxembao="http://docbao.viettelmobile.com.vn/site/24h.html";}
if($bao=='DanTri'){$linkxembao="http://docbao.viettelmobile.com.vn/site/dantri.html";}
if($bao=='LaoDong'){$linkxembao="http://docbao.viettelmobile.com.vn/site/laodong.html";}
if($bao=='SoHoa'){$linkxembao="http://docbao.viettelmobile.com.vn/site/sohoa.html";}
if($bao=='DailyInfo'){$linkxembao="http://docbao.viettelmobile.com.vn/site/dailyinfo.html";}
if($bao=='TuoiTre'){$linkxembao="http://docbao.viettelmobile.com.vn/site/tuoitre.html";}
if($bao=='ThanhNien'){$linkxembao="http://docbao.viettelmobile.com.vn/site/thanhnien.html";}
if($bao=='TienPhong'){$linkxembao="http://docbao.viettelmobile.com.vn/site/tienphong.html";}
if($bao=='VietNamNet'){$linkxembao="http://docbao.viettelmobile.com.vn/site/vietnamnet.html";}
if($bao=='VNE'){$linkxembao="http://docbao.viettelmobile.com.vn/site/vnexpress.html";}
if($bao=='VnMedia'){$linkxembao="http://docbao.viettelmobile.com.vn/site/vnmedia.html";}
if($bao=='TopHot'){$linkxembao="http://docbao.viettelmobile.com.vn/index.html";}
if($bao=='DocNhieu'){$linkxembao="http://docbao.viettelmobile.com.vn/top.html";}

switch ($type)
{
case 'docnhieu':
$title = "Báo Điện Tử";
require_once ("head.php");
echo'<div class="bmenu"> <a href="/docbao.php">Tin Mới đăng</a> | <b>Tin Đọc Nhiều</b></div><div class="menu">';
$source = grab_link("http://docbao.viettelmobile.com.vn/top.html");
$batdau = '</b>';
$ketthuc = '-------------';
$tinphp = laynoidung($source, $batdau, $ketthuc);
$tinphp = preg_replace('/<a href="/','<a href="?type=detail&view=',$tinphp);
echo $tinphp;
echo '</div';
echo'<div class="bmenu"><b>Danh Mục Báo</b></div>  <img src="img/24h.gif" width="12" height="12" alt="»"/><a href="?type=news&bao=24h">24h</a><br/>
<img src="img/cio.gif" width="12" height="12" alt="»"/><a href="?type=news&bao=DailyInfo">DailyInfo</a><br/><img src="img/sohoa.gif" width="12" height="12" alt="»"/> <a href="?type=news&bao=SoHoa">Số hóa</a><br/>
<img src="img/vnmedia.gif" width="12" height="12" alt="»"/><a href="?type=news&bao=VnMedia">VnMedia</a><br/><img src="img/dantri.gif" width="12" height="12" alt="»"/><a href="?type=news&bao=DanTri">Dân Trí</a><br/>
<img src="img/laodong.gif" width="12" height="12" alt="»"/><a href="?type=news&bao=LaoDong">Lao Động</a><br/><img src="img/TNO.gif" width="12" height="12" alt="»"/> <a href="?type=news&bao=ThanhNien">Thanh Niên Online</a><br/>
<img src="img/tienphong.gif" width="12" height="12" alt="»"/><a href="?type=news&bao=TienPhong">Tiền Phong Online</a><br/><img src="img/tuoitre.gif" width="12" height="12" alt="»"/><a href="?type=news&bao=TuoiTre">Tuổi Trẻ Online</a><br/>
<img src="img/other.gif" width="12" height="12" alt="»"/><a href="?type=news&bao=VietNamNet">VietNamNet</a><br/>
<img src="img/vne.gif" width="12" height="12" alt="»"/><a href="?type=news&bao=VNE">Vnexpress</a><br/>';
require_once ("end.php");
break;
case 'news':
$title = "Báo Điện Tử";
require_once ("head.php");

echo '<div class="menu">';
$source = grab_link($linkxembao);
$batdau = '<b>';
$ketthuc = '-------------';
$tinphp = laynoidung($source, $batdau, $ketthuc);
$tinphp = preg_replace('/<a href="/','<a href="?type=detail&view=',$tinphp);
echo $tinphp;

echo '</div>';
require_once ("end.php");
break;
case 'detail':
$url= "http://docbao.viettelmobile.com.vn".$duongdan."";
$source = grab_link($url);
$batdau = '<b>';
$ketthuc = '-------------';
$tinphp = laynoidung($source, $batdau, $ketthuc);
$tinphp = preg_replace('/<a href="/','<a href="?type=detail&view=',$tinphp);
$tinphp = preg_replace("/<a href='/",'<a href="?type=detail&view=',$tinphp);
$tinphp = preg_replace('#<img src="#is','<img alt="image" src="http://docbao.viettelmobile.com.vn/',$tinphp);
$tinphp = preg_replace("#<img src='#is",'<img alt="image" src="http://docbao.viettelmobile.com.vn/',$tinphp);
$title = explode('<b>',$tinphp);
$title = explode('</b><br/>',$title[1]);
$title = $title[0];
require_once ("head.php");
echo '<div class="menu">';
echo $tinphp;
echo '</div>';
require_once ("end.php");
break;

default:
$title = "Báo Điện Tử";
require_once ("head.php");
echo '<div class="bmenu"> <b>Tin Mới Đăng</b> | <a href="/docbao.php?type=docnhieu">Tin Đọc Nhiều</a></div><div class="menu">';
$source = grab_link("http://docbao.viettelmobile.com.vn/index.html");
$batdau = '</b>';
$ketthuc = '-------------';
$tinphp = laynoidung($source, $batdau, $ketthuc);
$tinphp = preg_replace('/<a href="/','<a href="?type=detail&view=',$tinphp);
echo $tinphp;
echo '</div>';
echo'<div class="bmenu"><b>Danh Mục Báo</b></div> <img src="img/24h.gif" width="12" height="12" alt="»"/><a href="?type=news&bao=24h">24h</a><br/>
<img src="img/cio.gif" width="12" height="12" alt="»"/><a href="?type=news&bao=DailyInfo">DailyInfo</a><br/>
<img src="img/sohoa.gif" width="12" height="12" alt="»"/> <a href="?type=news&bao=SoHoa">Số hóa</a><br/>
<img src="img/vnmedia.gif" width="12" height="12" alt="»"/> <a href="?type=news&bao=VnMedia">VnMedia</a><br/>
<img src="img/dantri.gif" width="12" height="12" alt="»"/> <a href="?type=news&bao=DanTri">Dân Trí</a><br/>
<img src="img/laodong.gif" width="12" height="12" alt="»"/> <a href="?type=news&bao=LaoDong">Lao Động</a><br/>
<img src="img/TNO.gif" width="12" height="12" alt="»"/> <a href="?type=news&bao=ThanhNien">Thanh Niên Online</a><br/>
<img src="img/tienphong.gif" width="12" height="12" alt="»"/> <a href="?type=news&bao=TienPhong">Tiền Phong Online</a><br/>
<img src="img/tuoitre.gif" width="12" height="12" alt="»"/> <a href="?type=news&bao=TuoiTre">Tuổi Trẻ Online</a><br/>
<img src="img/other.gif" width="12" height="12" alt="»"/> <a href="?type=news&bao=VietNamNet">VietNamNet</a><br/>
<img src="img/vne.gif" width="12" height="12" alt="»"/> <a href="?type=news&bao=VNE">Vnexpress</a><br/>';
require_once ("end.php");
}
exit;
?>
