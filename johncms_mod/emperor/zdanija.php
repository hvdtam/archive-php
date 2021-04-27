<?php
defined('_IN_JOHNCMS') or die('Error: restricted access');
require_once ("../incfiles/head.php");

$do = isset($_GET['do']) ? trim($_GET['do']) : ''; // Lựa chọn

switch ($do)
{
////////////////////////////////////////////////////
// Снос зданий                                    //
////////////////////////////////////////////////////
case "del":
if (isset($_POST['submit']))
{
$who = intval($_POST['who']);

switch ($who)
{
case 1:
if ($ms['houses'] <= 0)
{
echo 'Bạn không có tòa nhà này';
}
else
{
$firewoods = $ms['firewoods'] + 50;
$stone = $ms['stone'] + 20;
$gland = $ms['gland'] + 10;
$golds = $ms['golds'] + 10;
$houses = $ms['houses'] - 1;

mysql_query("UPDATE emperor_users SET
firewoods = '" . $firewoods . "',
stone = '" . $stone . "',
gland = '" . $gland . "',
golds = '" . $golds . "',
houses = '" . $houses . "'
WHERE user_id='" . $idus . "';");

echo "Tòa nhà bị phá hủy<br />";
}
break;
case 2:
if ($ms['barracks'] <= 0)
{
echo 'Bạn không có tòa nhà này';
}
else
{
$firewoods = $ms['firewoods'] + 50;
$stone = $ms['stone'] + 60;
$gland = $ms['gland'] + 40;
$golds = $ms['golds'] + 45;
$barracks = $ms['barracks'] - 1;

mysql_query("UPDATE emperor_users SET
firewoods = '" . $firewoods . "',
stone = '" . $stone . "',
gland = '" . $gland . "',
golds = '" . $golds . "',
barracks = '" . $barracks . "'
WHERE user_id='" . $idus . "';");

echo "Tòa nhà bị phá hủy<br />";
}
break;
case 3:
if ($ms['stables'] <= 0)
{
echo 'Bạn không có tòa nhà này';
}
else
{
$firewoods = $ms['firewoods'] + 40;
$stone = $ms['stone'] + 40;
$gland = $ms['gland'] + 35;
$golds = $ms['golds'] + 40;
$stables = $ms['stables'] - 1;

mysql_query("UPDATE emperor_users SET
firewoods = '" . $firewoods . "',
stone = '" . $stone . "',
gland = '" . $gland . "',
golds = '" . $golds . "',
stables = '" . $stables . "'
WHERE user_id='" . $idus . "';");

echo "Tòa nhà bị phá hủy<br />";
}
break;
case 4:
if ($ms['churches'] <= 0)
{
echo 'Bạn không có tòa nhà này';
}
else
{
$firewoods = $ms['firewoods'] + 50;
$stone = $ms['stone'] + 60;
$gland = $ms['gland'] + 30;
$golds = $ms['golds'] + 40;
$churches = $ms['churches'] - 1;

mysql_query("UPDATE emperor_users SET
firewoods = '" . $firewoods . "',
stone = '" . $stone . "',
gland = '" . $gland . "',
golds = '" . $golds . "',
churches = '" . $churches . "'
WHERE user_id='" . $idus . "';");

echo "Tòa nhà bị phá hủy<br />";
}
break;
case 5:
if ($ms['libraries'] <= 0)
{
echo 'Bạn không có tòa nhà này';
}
else
{
$firewoods = $ms['firewoods'] + 35;
$stone = $ms['stone'] + 30;
$gland = $ms['gland'] + 10;
$golds = $ms['golds'] + 10;
$libraries = $ms['libraries'] - 1;

mysql_query("UPDATE emperor_users SET
firewoods = '" . $firewoods . "',
stone = '" . $stone . "',
gland = '" . $gland . "',
golds = '" . $golds . "',
libraries = '" . $libraries . "'
WHERE user_id='" . $idus . "';");

echo "Tòa nhà bị phá hủy<br />";
}
break;
case 6:
if ($ms['mills'] <= 0)
{
echo 'Bạn không có tòa nhà này';
}
else
{
$firewoods = $ms['firewoods'] + 25;
$stone = $ms['stone'] + 20;
$gland = $ms['gland'] + 10;
$golds = $ms['golds'] + 10;
$mills = $ms['mills'] - 1;

mysql_query("UPDATE emperor_users SET
firewoods = '" . $firewoods . "',
stone = '" . $stone . "',
gland = '" . $gland . "',
golds = '" . $golds . "',
mills = '" . $mills . "'
WHERE user_id='" . $idus . "';");

echo "Tòa nhà bị phá hủy<br />";
}
break;
case 7:
if ($ms['tower'] <= 0)
{
echo 'Bạn không có tòa nhà này';
}
else
{
$firewoods = $ms['firewoods'] + 50;
$stone = $ms['stone'] + 60;
$gland = $ms['gland'] + 40;
$golds = $ms['golds'] + 45;
$tower = $ms['tower'] - 1;

mysql_query("UPDATE emperor_users SET
firewoods = '" . $firewoods . "',
stone = '" . $stone . "',
gland = '" . $gland . "',
golds = '" . $golds . "',
tower = '" . $tower . "'
WHERE user_id='" . $idus . "';");

echo "Tòa nhà bị phá hủy<br />";
}
break;
case 8:
if ($ms['wall'] <= 0)
{
echo 'Bạn không có tòa nhà này';
}
else
{
$firewoods = $ms['firewoods'] + 500;
$stone = $ms['stone'] + 600;
$gland = $ms['gland'] + 1000;
$golds = $ms['golds'] + 400;
$wall = $ms['wall'] - 1;

mysql_query("UPDATE emperor_users SET
firewoods = '" . $firewoods . "',
stone = '" . $stone . "',
gland = '" . $gland . "',
golds = '" . $golds . "',
wall = '" . $wall . "'
WHERE user_id='" . $idus . "';");

echo "Tòa nhà bị phá hủy<br />";
}
break;
default:
header("Location: game.php");
exit;
}
}
else
{
echo "<div class='phdr'><b>Thông tin</b></div>";
echo "Trong thời gian phá dỡ xây dựng các bạn nhận được một nửa chi cho vật liệu xây dựng<br/>";
echo "Xin chọn:<br/>";
echo '<form action="game.php?act=zdanija&amp;do=del" method="post">';

echo "<select name='who'>
<option value='1'>Trang chủ</option>
<option value='2'>Doanh trại</option>
<option value='3'>Ổn định</option>
<option value='4'>Giáo Hội</option>
<option value='5'>Thư viện</option>
<option value='6'>Mill</option>
<option value='7'>Bảo vệ tháp</option>
<option value='8\'>Tường thành</option>
</select><br/>";
echo '<input type="submit" name="submit" value="Phá bỏ"/><br /><br /></form>';
}

echo "---------<br/>";
echo "<a href='game.php?act=zdanija'>Quay lại</a><br />";
break;
////////////////////////////////////////////////////
// Обучение на строителей                         //
////////////////////////////////////////////////////
case "teach":
if (isset($_POST['submit']))
{
$sum = intval($_POST['sum']);
if ($sum > $ms['workers'] or $sum < 1)
{
echo "Bạn không thể đào tạo nhiều công nhân như thế!<br />";
}
else
{
$builders = $ms['builders'] + $sum;
$workers = $ms['workers'] - $sum;

mysql_query("UPDATE emperor_users SET
builders = '" . $builders . "',
workers = '" . $workers . "'
WHERE user_id='" . $idus . "';");

echo "Bạn đả dạy " . $sum . " công nhân xây dựng<br />";
}
}
else
{
echo "<div class='phdr'><b>Ở đây, công nhân được dạy để xây dựng</b></div>";
echo "Bạn đã có:<br/>";
echo "Công nhân: <b>" . $ms['workers'] . "</b><br/>";
echo "Nhà xây dựng: <b>" . $ms['builders'] . "</b><br/>";
echo "-------<br/>";
echo "Bạn làm việc <b>" . $ms['workers'] . "</b><br/>";
echo "<i>(có thể đào tạo về <b>" . $ms['workers'] . "</b> Nhà xây dựng</i>)<br/>";
echo "Điền số lượng công nhân để đào tạo những người muốn xây dựng:<br/>";

echo '<form action="game.php?act=zdanija&amp;do=teach" method="post">';
echo "<input type='text' name='sum'/><br/>";
echo '<input type="submit" name="submit" value="Train"/><br /><br /></form>';
}

echo "---------<br/>";
echo "<a href='game.php?act=zdanija'>Quay lại</a><br />";
break;
////////////////////////////////////////////////////
// Строим                                         //
////////////////////////////////////////////////////
case "create_info":
echo "<div class='phdr'><img src='img/statybininkas.gif' alt='+'/> <b>Xây dựng</b></div>";
//chiếm đất công nhân
$houses = $ms['houses'] * 50;
//ất chiếm đóng của lính
$barracks = $ms['barracks'] * 200;
//chiếm đất chuồng ngựa
$stables = $ms['stables'] * 100;
//chiếm đất nhà thờ
$churches = $ms['churches'] * 200;
//chiếm đất thư viện
$libraries = $ms['libraries'] * 100;
//chiếm đóng đất đai bảo vệ các tòa nhà
$tower = $ms['tower'] * 70;
//chiếm đất thành
$wall = $ms['wall'] * 500;
//chiếm đất nhà máy
$mills = $ms['mills'] * 80;

//chiếm đất
$earths_busy = $houses + $barracks + $churches + $stables + $libraries + $tower +
$wall + $mills;

$laisva = $ms['earths'] - $earths_busy;

switch ($id)
{
case 1:
$what = "nhà";
$viet = 50;
$stat = 15;
$med = 100;
$ak = 40;
$gel = 20;
$auk = 20;
break;
case 2:
$what = "doanh trại";
$viet = 200;
$stat = 100;
$med = 100;
$ak = 120;
$gel = 80;
$auk = 90;
break;
case 3:
$what = "ổn định";
$viet = 100;
$stat = 40;
$med = 80;
$ak = 80;
$gel = 70;
$auk = 90;
break;
case 4:
$what = "nhà thờ";
$viet = 200;
$stat = 50;
$med = 100;
$ak = 120;
$gel = 60;
$auk = 80;
break;
case 5:
$what = "thư viện";
$viet = 100;
$stat = 15;
$med = 70;
$ak = 60;
$gel = 20;
$auk = 20;
break;
case 6:
$what = "nhà máy";
$viet = 80;
$stat = 15;
$med = 50;
$ak = 40;
$gel = 20;
$auk = 20;
break;
case 7:
$what = "tháp";
$viet = 70;
$stat = 40;
$med = 100;
$ak = 120;
$gel = 80;
$auk = 90;
break;
case 8:
$what = "tường";
$viet = 500;
$stat = 200;
$med = 1000;
$ak = 1200;
$gel = 2000;
$auk = 800;
break;
default:
header("Location: game.php");
exit;
}

if (isset($_POST['submit']))
{
if ($ms['time_builders'] > $realtime)
{
echo "Công nhân của bạn đang mệt mỏi<br />";
echo "---------<br/>";
echo "<a href='game.php?act=zdanija'>Quay lại</a>";
echo "<br/><a href='game.php?'>Trong trò chơi</a><br/>";
require_once ("../incfiles/end.php");
exit;
}
if ($laisva < $viet)
{
$error = "Không đủ đất<br />";
}
if ($ms['builders'] < $stat)
{
$error = $error . "Đủ công nhân<br />";
}
if ($ms['firewoods'] < $med)
{
$error = $error . "Đủ củi<br />";
}
if ($ms['stone'] < $ak)
{
$error = $error . "Không đủ đá<br />";
}
if ($ms['gland'] < $gel)
{
$error = $error . "Thiếu sắt<br />";
}
if ($ms['golds'] < $auk)
{
$error = $error . "Đủ vàng<br />";
}
if (empty($error))
{
$firewoods = $ms['firewoods'] - $med;
$stone = $ms['stone'] - $ak;
$gland = $ms['gland'] - $gel;
$golds = $ms['golds'] - $auk;
$time_builders = $realtime + 600;

switch ($id)
{
case 1:
$what_t = "houses";
break;
case 2:
$what_t = "barracks";
break;
case 3:
$what_t = "stables";
break;
case 4:
$what_t = "churches";
break;
case 5:
$what_t = "libraries";
break;
case 6:
$what_t = "mills";
break;
case 7:
$what_t = "tower";
break;
case 8:
$what_t = "wall";
if ($ms['wall'] >= '1')
{
echo "Bức tường đả được xây dựng!<br />";
echo "---------<br/>";
echo "<a href='game.php?act=zdanija'>Quay lại</a>";
echo "<br/><a href='game.php?'>Trong trò chơi</a><br/>";
require_once ("../incfiles/end.php");
exit;
}
break;
}

$structure = $ms[$what_t] + 1;

mysql_query("UPDATE emperor_users SET
firewoods = '" . $firewoods . "',
stone = '" . $stone . "',
gland = '" . $gland . "',
golds = '" . $golds . "',
time_builders='" . $time_builders . "',
" . $what_t . "='" . $structure . "'
WHERE user_id='" . $idus . "';");

echo "Bạn đã xây dựng thành công " . $what . "<br />";
}
else
{
echo "<b>Lổi!</b><br />" . $error;
}
}
else
{
echo "Xây dựng " . $what . " bạn cần:<br/>";
echo "Đất: <b>" . $viet . "</b>m&#178;<br/>";
echo "Công nhân: <b>" . $stat . "</b><br/>";
echo "Xe ngựa: <b>" . $med . "</b><br/>";
echo "Đá: <b>" . $ak . "</b><br/>";
echo "Gland: <b>" . $gel . "</b><br/>";
echo "Vàng: <b>" . $auk . "</b><br/>";
echo "--------<br/>";
echo '<form action="game.php?act=zdanija&amp;do=create_info&amp;id=' . $id .
'" method="post">';
echo '<input type="submit" name="submit" value="Xây dựng"/><br /><br /></form>';
}

echo "---------<br/>";
echo "<a href='game.php?act=zdanija'>Quay lại</a><br />";
break;
////////////////////////////////////////////////////
// Построить здания                               //
////////////////////////////////////////////////////
case "create":
echo "<div class='phdr'><img src='img/statybininkas.gif' alt='+'/> <b>Xây dựng</b></div>";

echo "<div class='menu'><a href='game.php?act=zdanija&amp;do=create_info&amp;id=1'>Xây dựng một ngôi nhà</a></div>";
echo "<div class='menu'><a href='game.php?act=zdanija&amp;do=create_info&amp;id=2'>Xây dựng doanh trại</a></div>";
echo "<div class='menu'><a href='game.php?act=zdanija&amp;do=create_info&amp;id=3'>Xây dựng kanyushni</a></div>";
echo "<div class='menu'><a href='game.php?act=zdanija&amp;do=create_info&amp;id=4'>Xây dựng Giáo Hội</a></div>";
echo "<div class='menu'><a href='game.php?act=zdanija&amp;do=create_info&amp;id=5'>Xây dựng một thư viện</a></div>";
echo "<div class='menu'><a href='game.php?act=zdanija&amp;do=create_info&amp;id=6'>Xây dựng nhà máy</a></div>";
echo "<div class='menu'><a href='game.php?act=zdanija&amp;do=create_info&amp;id=7'>Xây dựng một tháp bảo vệ</a></div>";
echo "<div class='menu'><a href='game.php?act=zdanija&amp;do=create_info&amp;id=8'>Xây dựng một bức tường thành</a></div>";
echo "-------<br/>";
echo "<div class='menu'><a href='game.php?act=zdanija&amp;do=teach'>Đào tạo công nhân xây dựng</a></div>";

echo "---------<br/>";
echo "<a href='game.php?act=zdanija'>Quay lại</a><br />";
break;
////////////////////////////////////////////////////
// Мои строения                                   //
////////////////////////////////////////////////////
case "my_structures":
echo "<div class='phdr'><img src='img/namas.gif' alt='+'/><b>Công trình xây dựng</b></div>";
echo "<div class='menu'>Các ngôi nhà: <b>" . $ms['houses'] . "</b></div>";
echo "<div class='menu'>Doanh trại: <b>" . $ms['barracks'] . "</b></div>";
echo "<div class='menu'>Chuồng ngựa: <b>" . $ms['stables'] . "</b></div>";
echo "<div class='menu'>Thư viện: <b>" . $ms['libraries'] . "</b></div>";
echo "<div class='menu'>Mills: <b>" . $ms['mills'] . "</b></div>";
echo "<div class='menu'>Các nhà thờ: <b>" . $ms['churches'] . "</b></div>";
echo "<div class='menu'>Công trình bảo vệ: <b>" . $ms['tower'] . "</b></div>";
echo "<div class='menu'>Tường thành: <b>" . ($ms['wall'] > 0 ? 'Được xây dựng' :
'TaMk') . "</b></div>";

echo "---------<br/>";
echo "<a href='game.php?act=zdanija'>Quay lại</a><br />";
break;
////////////////////////////////////////////////////
// Главная                                        //
////////////////////////////////////////////////////
default:
echo ">><a href='game.php?act=zdanija&amp;do=my_structures'>Các công trình đả xây dựng</a><br/>";
echo ">><a href='game.php?act=zdanija&amp;do=create'>Bắt đầu Xây dựng công trình</a><br/>";
echo ">><a href='game.php?act=zdanija&amp;do=del'>Xoá bỏ các công trình</a><br/>";
echo "---------<br/>";
}

echo "<a href='game.php?'>Trong trò chơi</a><br/>";

?>
