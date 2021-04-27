<?php
###########################
#  Данная версия скрипта принадлежит       # 
#       LiraS aka Артур Лукин Иванович          #
#   Вносить свои изменения крайне               #
#                 запрещенно!                                    #
###########################
include("db.php");
include("on.php");
include "cfg.php";
$set['title']='Người sử dụng'; 
head();
title ();
function about()
{
$c = mysql_fetch_array(mysql_query("SELECT uzpuole, pinigai, namai, kareivines, arklides, baznycia, biblioteka, darbininkai, kariai, mokslininkai, arkliai, raiteliai, plotas, dirva, mediena, akmuo, valgis, auksas, gelezis, zvejai, statybininkai, medkirciai, medziotojai, malunai, bokstai, siena, puolimas, gynyba, bomba, sachtininkai, akmenskaldziai, laivai, rugiai FROM war WHERE usr = '$_GET[man]'"));
$pinigai = strip_tags($c['pinigai']);
$namai = strip_tags($c['namai']);
$kareivines = strip_tags($c['kareivines']);
$arklides = strip_tags($c['arklides']);
$baznycios = strip_tags($c['baznycia']);
$biblioteka = strip_tags($c['biblioteka']);
$darbininkai = strip_tags($c['darbininkai']);
$kariai = strip_tags($c['kariai']);
$mokslininkai = strip_tags($c['mokslininkai']);
$arkliai = strip_tags($c['arkliai']);
$raiteliai = strip_tags($c['raiteliai']);
$plotas = strip_tags($c['plotas']);
$dirbama_zeme = strip_tags($c['dirva']);
$mediena = strip_tags($c['mediena']);
$akmuo = strip_tags($c['akmuo']);
$valgis = strip_tags($c['valgis']);
$auksas = strip_tags($c['auksas']);
$gelezis = strip_tags($c['gelezis']);
$zvejai = strip_tags($c['zvejai']);
$statybininkai = strip_tags($c['statybininkai']);
$medkirciai = strip_tags($c['medkirciai']);
$medziotojai = strip_tags($c['medziotojai']);
$malunai = strip_tags($c['malunai']);
$bokstai = strip_tags($c['bokstai']);
$siena = strip_tags($c['siena']);
$sachtininkai = strip_tags($c['sachtininkai']);
$akmenskaldziu = strip_tags($c['akmenskaldziai']);
$laivai = strip_tags($c['laivai']);
$rugiai = strip_tags($c['rugiai']);
$puolimas_mano = strip_tags($c['puolimas']);
$gynyba_mano = strip_tags($c['gynyba']);
$last_uzpuole = strip_tags($c['uzpuole']);

$raiteliai_p = $raiteliai * 5;
$raiteliai_g = $raiteliai * 5;
$laivai_p = $laivai * 50;
$laivai_g = $laivai *50;
$bokstai_g = $bokstai * 40;
$siena_g = $siena * 500;
$bomba_p = $bomba * 1000;
$bomba_g = $bomba * 300;
$baznycia_g = $baznycios * 50;
$mano_p = $kariai + $raiteliai_p + $laivai_p + $bomba_p + $puolimas_mano;
$mano_g = $kariai + $raiteliai_g + $laivai_g + $bomba_g + $siena_g + $bokstai_g + $gynyba_mano + $baznycia_g;

if($baznycios == 0)
{$religija = "Không có niềm tin";}
elseif($baznycios == 1 || $baznycios == 2 || $baznycios == 3 || $baznycios == 4)
{$religija = "Believer";}
elseif($baznycios == 5 || $baznycios == 6 || $baznycios == 7 || $baznycios == 8)
{$religija = "Chánh giáo";}
elseif($baznycios >= 9)
{$religija = "Rất tin tưởng chính thống";}

if($biblioteka == 0)
{$rastingumas = "0";}
elseif($biblioteka == 1)
{$rastingumas = "25";}
elseif($biblioteka == 2)
{$rastingumas = "50";}
elseif($biblioteka == 3)
{$rastingumas = "75";}
elseif($biblioteka == 4)
{$rastingumas = "99";}
elseif($biblioteka >= 5)
{$rastingumas = "100";}

$namuose_gali_gyventi = $namai*10;

$arklidese_gali_gyventi = $arklides*6;

$kareivinese_gali_gyventi = $kareivines*50;

$namai_uzima = $namai*50;
$kareivines_uzima = $kareivines*200;
$arklides_uzima = $arklides*100;
$baznycios_uzima = $baznycios*200;
$bibliotekos_uzima = $biblioteka*100;
$bokstai_uzima = $bokstai*70;
$siena_uzima = 500;
$malunai_uzima = $malunai*80;
$uzimamas_plotas = $namai_uzima + $kareivines_uzima + $arklides_uzima + $baznycios_uzima + $bibliotekos_uzima + $dirbama_zeme;
$laisvas = $plotas - $uzimamas_plotas;

if($siena >= 1)
{$sienos_bukle = "Được xây dựng";}
else
{$sienos_bukle = "Không được xây dựng";}

if($last_uzpuole == "" || $last_uzpuole == "0")
{$last_uzpuole = "Ни кто";}
else{$last_uzpuole = $last_uzpuole;}
$clan = mysql_query("SELECT `klanas` FROM `war` WHERE usr = '$_GET[man]'");
$c = mysql_fetch_array($clan);
echo "<div class=\"main\">"; pochta();
echo "<img src=\"img/imperatorius.gif\" alt=\"+\"/><big><big><u><b>$_GET[man]</b></u></big></big><br/>";
echo "<img src=\"img/infoo.gif\" alt=\"+\"/><b>Thông tin tổng hợp:</b><br/>";
if (!empty($c[klanas]))
{
$c[klanas] = iconv("windows-1251","utf-8",$c[klanas]);
echo "Gia tộc: $c[klanas]<br/>\n";
}
echo "Ngày tấn công: <b>$last_uzpuole</b><br/>";
echo "Tấn công: <b>$mano_p</b><br/>";
echo "Bảo vệ: <b>$mano_g</b><br/>";
echo "Chữ viết tay: <b>$rastingumas</b>%<br/>";
echo "Tôn giáo: <b>$religija</b><br/>";
echo "<b>---------</b><br/>";
echo "<img src=\"img/namas.gif\" alt=\"+\"/><b>Công trình xây dựng</b><br/>";
echo "Các ngôi nhà: <b>$namai</b><br/>";
echo "(Những ngôi nhà có thể sống / sống trong nhà: <b>$namuose_gali_gyventi/$darbininkai</b>)<br/>";
echo "Doanh trại: <b>$kareivines</b><br/>";
echo "(Trong doanh trại có thể được / sống trong doanh trại: <b>$kareivinese_gali_gyventi/$kariai</b>)<br/>";
echo "Chuồng: <b>$arklides</b><br/>";
echo "(Trong chuồng có thể sống / sống trong chuồng: <b>$arklidese_gali_gyventi/$arkliai</b>)<br/>";
echo "Thư viện: <b>$biblioteka</b><br/>";
echo "Mills: <b>$malunai</b><br/>";
echo "Các nhà thờ: <b>$baznycios</b><br/>";
echo "Công trình bảo vệ: <b>$bokstai</b><br/>";
echo "Tường thành: <b>$sienos_bukle</b><br/>";
echo "<b>--------- </b><br/>";
echo "<img src=\"img/zmogus.gif\" alt=\"+\"/><b>Nhân dân</b><br/>";
echo "Công nhân <b>$darbininkai</b><br/>";
echo "Nhà xây dựng: <b>$statybininkai</b><br/>";
echo "Thợ săn: <b>$medziotojai</b><br/>";
echo "Thợ đốn củi: <b>$medkirciai</b><br/>";
echo "Ngư dân: <b>$zvejai</b><br/>";
echo "Các nhà khoa học: <b>$mokslininkai</b><br/>";
echo "Thợ mỏ: <b>$sachtininkai</b><br/>";
echo "Thợ khai thác đá: <b>$akmenskaldziu</b><br/>";
echo "---------<br/>";
echo "<a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Trang chủ</a>";
}

$db_connection = mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_table, $db_connection);

$tikr = mysql_num_rows(mysql_query("SELECT usr, pwd FROM war WHERE usr = '$_GET[usr]' AND pwd = '$_GET[pwd]'"));

if($tikr == 1)
{
if($_GET[id] == "")
{about();}
}
else
{
echo "<div class=\"main\">"; pochta();
echo "Bạn chưa đăng ký!<br/>";
}
mysql_close($db_connection);

foot();

?>