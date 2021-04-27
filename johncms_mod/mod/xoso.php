<?php
/**
* @package JohnCMS
* @link http://johncms.com
* @copyright Copyright (C) 2008-2011 JohnCMS Community
* @license LICENSE.txt (see attached file)
* @version VERSION.txt (see attached file)
* @author http://johncms.com/about
*/
define('_IN_JOHNCMS', 1);
$headmod = 'XSTD';
$textl = 'Trò Chơi Xổ Số - TaMk.tK';
require_once ("../incfiles/core.php");
require_once ("../incfiles/head.php");
$id = $_GET['id'];


if ($id && $id != $user_id) {


$req = mysql_query("SELECT * FROM `users` WHERE `id` = '$id' LIMIT 1");


if (mysql_num_rows($req)) {


$user = mysql_fetch_assoc($req);}}


if (!$user_id) {


echo 'Chỉ cho người dùng đăng ký';


require_once ('../incfiles/end.php');


exit;


}


switch($_GET['act']) {
default:
echo'<div class="phdr">Xổ số kiến thiết TK</div>';
echo'<div class="rmenu">Bạn có: '.$datauser['balans'].' Vcoin</div>';
echo'<div class="list2"><span class="gmenu">Loto 2 số: 1 ăn 10</span>';
echo'<center><form action="xoso.php?act=hai" method="post">';
echo 'Số tiền cược<br/><input name="tien" type="text" size="10" /><br/>';
echo 'Số muốn đánh<br/><input name="danh" type="text" maxlength="2" size="3" />';
echo'<input type="submit" value="Ok">';
echo'</form></center></div>';
echo'<div class="list2"><span class="gmenu">Loto 3 số: 1 ăn 100</span>';
echo'<center><form action="xoso.php?act=ba" method="post">';
echo 'Số tiền cược<br/><input name="tien" type="text" size="10" /><br/>';
echo 'Số muốn đánh<br/><input name="danh" type="text" maxlength="3" size="4" />';
echo'<input type="submit" value="Ok">';
echo'</form></center></div>';
break;
case 'hai':
$danh = isset($_POST['danh'])?abs(intval($_POST['danh'])):false;
$tien = isset($_POST['tien'])?abs(intval($_POST['tien'])):false;
$tienan = $tien*10;
$ketqua1 = rand(10,99);
$ketqua2 = rand(10,99);
$ketqua3 = rand(10,99);
$ketqua4 = rand(10,99);
$ketqua5 = rand(10,99);
$ketqua6 = rand(10,99);
$ketqua7 = rand(10,99);
$ketqua8 = rand(10,99);
$ketqua9 = rand(10,99);
$balans = mysql_fetch_assoc(mysql_query("select `balans` from `users` where `id`='".$user_id."';"));
if ($danh >= 10 && $tien > 0) {
if ($datauser['balans'] >= $tien) {
mysql_query("UPDATE `users` SET `balans`=`balans`-'$tien' WHERE `id` = '$user_id' LIMIT 1");
echo'<div class="phdr">Kết quả lần quay:</div>';
echo'<table width="100%" border="1"><tr><td class="list1" width="33%" style="text-align:center;">'.$ketqua1.'</td>
<td class="list1" width="33%" style="text-align:center;">'.$ketqua2.'</td>
<td class="list1" width="33%" style="text-align:center;">'.$ketqua3.'</td></tr>
<tr><td class="list1" width="33%" style="text-align:center;">'.$ketqua4.'</td>
<td class="list1" width="33%" style="text-align:center;">'.$ketqua5.'</td>
<td class="list1" width="33%" style="text-align:center;">'.$ketqua6.'</td></tr>
<tr><td class="list1" width="33%" style="text-align:center;">'.$ketqua7.'</td>
<td class="list1" width="33%" style="text-align:center;">'.$ketqua8.'</td>
<td class="list1" width="33%" style="text-align:center;">'.$ketqua9.'</td></tr></table>';

if ($danh == $ketqua1 || $danh == $ketqua2 || $danh == $ketqua3 || $danh == $ketqua4 || $danh == $ketqua5 || $danh == $ketqua6 || $danh == $ketqua7 || $danh == $ketqua8 || $danh == $ketqua9)
{

$msg = 'Xin chúc mừng [b]'.$login.'[/b] đã trứng giải [green]Loto 2 số[/green] trong chương trình xổ số TaMk. Con số trúng giải là [b]'.$danh.'[/b] và trị giá giải thưởng [b]'.$tienan.'[/b] Vcoin :D';


mysql_query("INSERT INTO `forum` SET



`refid` = '106',



`type` = 'm' ,



`time` = '" . time() . "',



`user_id` = '2',



`from` = 'BOT',



`ip` = '00000',



`ip_via_proxy` = '" . core::$ip_via_proxy . "',



`soft` = '" . mysql_real_escape_string($agn1) . "',



`text` = '" . mysql_real_escape_string($msg) . "'



");



$fadd = mysql_insert_id();



// Обновляем время топика


mysql_query("UPDATE `forum` SET `time` = '" . time() . "' WHERE `id` = '106' LIMIT 1") or die('Không thể cập nhật');


mysql_query("UPDATE `users` SET `balans`=`balans`+'$tienan' WHERE `id` = '$user_id' LIMIT 1");


echo '<div class="gmenu">Wow! Xin chúc mừng bạn đã trúng <b>'.$tienan.'<b> Vcoin số <b>'.$danh.'</b></div>';
echo '<div class="phdr"><a href="/mod/xoso.php">Chơi tiếp</a></div>';
} else {
echo '<div class="rmenu">Xin chia buồn! Bạn tạch rùi, số tiền bạn bị trừ '.$tien.'</div>';
echo '<div class="phdr"><a href="/mod/xoso.php">Chơi tiếp</a>';
}
} else {
echo '<div class="rmenu">Bạn không đủ tiền</div>';
echo '<div class="phdr"><a href="/">Thoát</a>';
}
} else {
echo '<div class="rmenu">Không hợp lệ! Kết quả là số có 2 chữ số trong khoảng từ 10 đến 99 vui lòng nhập lại!!!</div>';
echo '<div class="phdr"><a href="/mod/xoso.php">Quay lại</a>';
}
break;

case 'ba':
$danh = isset($_POST['danh'])?abs(intval($_POST['danh'])):false;
$tien = isset($_POST['tien'])?abs(intval($_POST['tien'])):false;
$tienan = $tien*100;
$ketqua1 = rand(100,999);
$ketqua2 = rand(100,999);
$ketqua3 = rand(100,999);
$ketqua4 = rand(100,999);
$ketqua5 = rand(100,999);
$ketqua6 = rand(100,999);
$ketqua7 = rand(100,999);
$ketqua8 = rand(100,999);
$ketqua9 = rand(100,999);
$balans = mysql_fetch_assoc(mysql_query("select `balans` from `users` where `id`='".$user_id."';"));
if ($danh >= 10 && $tien > 0) {
if ($datauser['balans'] >= $tien) {
mysql_query("UPDATE `users` SET `balans`=`balans`-'$tien' WHERE `id` = '$user_id' LIMIT 1");
echo'<div class="phdr">Kết quả lần quay:</div>';
echo'<table width="100%" border="1"><tr><td class="list1" width="33%" style="text-align:center;">'.$ketqua1.'</td>
<td class="list1" width="33%" style="text-align:center;">'.$ketqua2.'</td>
<td class="list1" width="33%" style="text-align:center;">'.$ketqua3.'</td></tr>
<tr><td class="list1" width="33%" style="text-align:center;">'.$ketqua4.'</td>
<td class="list1" width="33%" style="text-align:center;">'.$ketqua5.'</td>
<td class="list1" width="33%" style="text-align:center;">'.$ketqua6.'</td></tr>
<tr><td class="list1" width="33%" style="text-align:center;">'.$ketqua7.'</td>
<td class="list1" width="33%" style="text-align:center;">'.$ketqua8.'</td>
<td class="list1" width="33%" style="text-align:center;">'.$ketqua9.'</td></tr></table>';

if ($danh == $ketqua1 || $danh == $ketqua2 || $danh == $ketqua3 || $danh == $ketqua4 || $danh == $ketqua5 || $danh == $ketqua6 || $danh == $ketqua7 || $danh == $ketqua8 || $danh == $ketqua9)
{

$msg = 'Xin chúc mừng [b]'.$login.'[/b] đã trứng giải [green]Loto 3 số[/green] trong chương trình xổ số TaMk. Con số trúng giải là [b]'.$danh.'[/b] và trị giá giải thưởng [b]'.$tienan.'[/b] Vcoin :D';


mysql_query("INSERT INTO `forum` SET



`refid` = '106',



`type` = 'm' ,



`time` = '" . time() . "',



`user_id` = '2',



`from` = 'BOT',



`ip` = '00000',



`ip_via_proxy` = '" . core::$ip_via_proxy . "',



`soft` = '" . mysql_real_escape_string($agn1) . "',



`text` = '" . mysql_real_escape_string($msg) . "'



");



$fadd = mysql_insert_id();



// Обновляем время топика


mysql_query("UPDATE `forum` SET `time` = '" . time() . "' WHERE `id` = '106' LIMIT 1") or die('Không thể cập nhật');


mysql_query("UPDATE `users` SET `balans`=`balans`+'$tienan' WHERE `id` = '$user_id' LIMIT 1");


echo '<div class="gmenu">Wow! Xin chúc mừng bạn đã trúng <b>'.$tienan.'<b> Vcoin số <b>'.$danh.'</b></div>';
echo '<div class="phdr"><a href="/mod/xoso.php">Chơi tiếp</a></div>';
} else {
echo '<div class="rmenu">Xin chia buồn! Bạn tạch rùi, số tiền bạn bị trừ '.$tien.'</div>';
echo '<div class="phdr"><a href="/mod/xoso.php">Chơi tiếp</a>';
}
} else {
echo '<div class="rmenu">Bạn không đủ tiền</div>';
echo '<div class="phdr"><a href="/">Thoát</a>';
}
} else {
echo '<div class="rmenu">Không hợp lệ! Kết quả là số có 3 chữ số trong khoảng từ 100 đến 999 vui lòng nhập lại!!!</div>';
echo '<div class="phdr"><a href="/mod/xoso.php">Quay lại</a>';
}
break;
}

require_once ("../incfiles/end.php");
?>
