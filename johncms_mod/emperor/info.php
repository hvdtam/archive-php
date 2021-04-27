<?php
defined('_IN_JOHNCMS') or die('Error: restricted access');
require_once ("../incfiles/head.php");

echo "<div class='phdr'><img src='img/imperatorius.gif' alt='+'/><b>" . $login .
"</b></div>";

//$clan = mysql_query("SELECT `klanas` FROM `war` WHERE usr = '$_GET[usr]'");
//$c = mysql_fetch_array($clan);
//$c[klanas] = strip_tags($c[klanas]);
//echo "<div class=\"main\">";
//pochta();

if (! empty($c[klanas]))
{
$c[klanas] = iconv("windows-1251", "utf-8", $c[klanas]);
echo "Gia tộc: $c[klanas]<br/>\n";
}

if ($ms['last_attack'])
{
$users = mysql_fetch_array(mysql_query("SELECT `name`
FROM `users`
WHERE id='" . $ms['last_attack'] . "' LIMIT 1;"));

echo "Thời gian qua bạn đã bị tấn công: <b>" . $users . "</b><br/>";
}


//Всадников
$riders = $ms['riders'] * 5;

//Кораблей
$ships = $ms['ships'] * 50;

//Защитных зданий
$tower = $ms['tower'] * 40;

//Стена
$wall = $ms['wall'] * 500;

//количество церквей(защита)
$churches = $ms['churches'] * 40;

//Атака
$attack = $riders + $ships + $tower;
//Защита
$defence = $attack + $wall + $churches;

echo "<div class='menu'>Tấn công: <b>" . $attack . "</b></div>";
echo "<div class='menu'>Bảo vệ: <b>" . $defence . "</b></div>";
echo "<div class='menu'>Chữ ký: <b>";

switch ($ms['libraries'])
{
case 0:
echo '0';
break;
case 1:
echo '25';
break;
case 2:
echo '50';
break;
case 3:
echo '75';
break;
case 4:
echo '99';
break;
default:
echo '100';
}

echo "</b>%</div>";
echo "<div class='menu'>Tôn giáo: <b>";

if ($ms['churches'] == 0)
{
echo "Không có niềm tin";
}
else
if ($ms['churches'] > 0 and $ms['churches'] < 5)
{
echo "Believer";
}
else
if ($ms['churches'] > 4 and $ms['churches'] < 9)
{
echo "Chánh giáo";
}
else
if ($ms['churches'] >= 9)
{
echo "Rất tin tưởng chính thống";
}
echo "</b></div>";

echo "<div class='phdr'><img src='img/money.gif' alt='+'/><b>Kinh tế</b></div>";
echo "<div class='menu'>Tiền bạc: <b>" . $ms['pinigai'] . "</b> Vàng.</div>";

//занято земли рабочими
$houses = $ms['houses'] * 50;
//занято земли воинами
$barracks = $ms['barracks'] * 200;
//занято земли конюшнами
$stables = $ms['stables'] * 100;
//занято земли церквями
$churches = $ms['churches'] * 200;
//занято земли библиотеками
$libraries = $ms['libraries'] * 100;
//занято земли Защитными зданиями
$tower = $ms['tower'] * 70;
//занято земли стеной
$wall = $ms['wall'] * 500;
//занято земли мельницами
$mills = $ms['mills'] * 80;

//занято земли
$earths_busy = $houses + $barracks + $churches + $stables + $libraries + $tower +
$wall + $mills;
$earths_not_busy = $ms['earths'] - $earths_busy;

echo "<div class='menu'>Đất đai: <b>" . $ms['earths'] . "</b> m&#178;</div>";
echo "<div class='menu'>Nghề Nghiệp đất / Không làm việc: <b>" . $earths_busy . "/" . $earths_not_busy .
"</b> m&#178;</div>";
echo "<div class='menu'>Xe ngựa: <b>" . $ms['firewoods'] . "</b></div>";
echo "<div class='menu'>Đá: <b>" . $ms['stone'] . "</b></div>";
echo "<div class='menu'>Sắt: <b>" . $ms['gland'] . "</b></div>";
echo "<div class='menu'>Vàng: <b>" . $ms['golds'] . "</b></div>";
echo "<div class='menu'>Thực phẩm: <b>" . $ms['meal'] . "</b></div>";
echo "<div class='menu'>Lúa mạch: <b>" . $ms['rye'] . "</b></div>";

echo "<div class='phdr'><img src='img/namas.gif' alt='+'/><b>Công trình xây dựng</b></div>";
echo "<div class='menu'>Các ngôi nhà: <b>" . $ms['houses'] . "</b></div>";
echo "<div class='menu'>(Những ngôi nhà có thể sống / số người sống trong nhà: <b>" . ceil($ms['houses'] *
10) . "/" . $ms['workers'] . "</b>)</div>";
echo "<div class='menu'>Doanh trại: <b>" . $ms['barracks'] . "</b></div>";
echo "<div class='menu'>(Trong doanh trại có thể sống / số người sống trong doanh trại: <b>" . ceil($ms['barracks'] *
50) . "/" . $ms['warriors'] . "</b>)</div>";
echo "<div class='menu'>Chuồng Ngựa: <b>" . $ms['stables'] . "</b></div>";
echo "<div class='menu'>(Trong chuồng có thể sống / số ngựa sống trong chuồng: <b>" . ceil($ms['stables'] *
6) . "/" . $ms['horse'] . "</b>)</div>";
echo "<div class='menu'>Thư viện: <b>" . $ms['libraries'] . "</b></div>";
echo "<div class='menu'>Mills: <b>" . $ms['mills'] . "</b></div>";
echo "<div class='menu'>Các nhà thờ: <b>" . $ms['churches'] . "</b></div>";
echo "<div class='menu'>Công trình bảo vệ: <b>" . $ms['tower'] . "</b></div>";
echo "<div class='menu'>Tường Thành: <b>" . ($ms['wall'] > 0 ? 'Được xây dựng' :
'TaMk') . "</b></div>";

echo "<div class='phdr'><img src='img/zmogus.gif' alt='+'/><b>Nhân dân</b></div>";
echo "<div class='menu'>Công nhân <b>" . $ms['workers'] . "</b></div>";
echo "<div class='menu'>Chiến binh: <b>" . $ms['warriors'] . "</b></div>";
echo "<div class='menu'>Ngựa: <b>" . $ms['riders'] . "</b></div>";
echo "<div class='menu'>Nhà xây dựng: <b>" . $ms['builders'] . "</b></div>";
echo "<div class='menu'>Thợ săn: <b>" . $ms['hunters'] . "</b></div>";
echo "<div class='menu'>Thợ đốn củi: <b>" . $ms['lumberjacks'] . "</b></div>";
echo "<div class='menu'>Ngư dân: <b>" . $ms['fishermen'] . "</b></div>";
echo "<div class='menu'>Thợ mỏ: <b>" . $ms['miners'] . "</b></div>";
echo "<div class='menu'>Thợ khai thác đá: <b>" . $ms['stonemasons'] . "</b></div>";


echo "---------<br/>";
echo "<a href='game.php?'>Trong trò chơi</a><br/>";

?>
