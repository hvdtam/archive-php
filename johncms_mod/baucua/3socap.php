<?php
/**
* @package     JohnCMS
* @link        http://johncms.com
* @copyright   Copyright (C) 2008-2011 JohnCMS Community
* @license     LICENSE.txt (see attached file)
* @version     VERSION.txt (see attached file)
* @author      http://johncms.com/about
*/

define('_IN_JOHNCMS', 1);
session_name("SESID");
session_start();
$headmod = 'naperstki';
$textl = 'Tôm cua cá';
$rootpath = '../';
require_once ("../incfiles/core.php");
require_once ("../incfiles/head.php");

$act = isset($_GET['act']) ? $_GET['act'] : '';
echo '<div class="phdr"><b> Tôm cua cá 3 con</b></div>';
echo '<b> Phòng sơ cấp</b><br/>';


$rand = mt_rand(100, 999);
$balans_plus = "300";
$balans_minus = "100";

if (!empty($_SESSION['uid'])) {

switch ($act) {

case "choice":
if (isset($_SESSION['naperstki'])) {
$_SESSION['naperstki'] = "";
unset($_SESSION['naperstki']);
}


echo '<a href="3socap.php?act=go&amp;thimble=1&amp;rand=' . $rand .
'"><img src="1.gif" alt=""/></a>
<a href="3socap.php?act=go&amp;thimble=2&amp;rand=' . $rand .
'"><img src="2.gif" alt=""/></a>
<a href="3socap.php?act=go&amp;thimble=3&amp;rand=' . $rand .
'"><img src="3.gif" alt=""/></a><br/><br/>
Chọn một trong ba con<br/>
Bạn có: ' . $datauser['balans'] . ' VND<br/>
<br/><a href="3socap.php">Quay lại</a>';


break;
case "go":


if ($datauser['balans'] >= $balans_minus) {

if (intval($_SESSION['naperstki']) < "1") {

$_SESSION['naperstki']++;
$thimble = intval($_GET['thimble']);

$rand_thimble = mt_rand(1, 3);


if ($rand_thimble == "1") {
echo '<img src="4.gif" alt=""/> ';
} else {
echo '<img src="1.gif" alt=""/> ';
}

if ($rand_thimble == "2") {
echo '<img src="4.gif" alt=""/> ';
} else {
echo '<img src="2.gif" alt=""/> ';
}

if ($rand_thimble == "3") {
echo '<img src="4.gif" alt=""/>';
} else {
echo '<img src="3.gif" alt=""/>';
}


//------------------------------ Win ----------------------------//
if ($thimble == $rand_thimble) {

//------------------------------ Ghi lбп��п��i trong hбп��п�� sЖп�� cбп��п��a ----------------------------//
$balans_plus_c = ($datauser['balans'] + $balans_plus);
mysql_query("update `users` set balans='" . $balans_plus_c . "' where id='" . $user_id .
"';");

echo '<br/><b>Bạn đã thắng! Và nhận được ' . $balans_plus . ' VND</b><br/>';


//------------------------------ Mбп��п��t ----------------------------//
} else {

//------------------------------ Ghi lбп��п��i trong hбп��п�� sЖп�� cбп��п��a ----------------------------//
$balans_minus_с = ($datauser['balans'] - $balans_minus);
mysql_query("update `users` set balans='" . $balans_minus_с . "' where id='" . $user_id .
"';");


echo '<br/><b>Bạn đã thua! Và bị trừ ' . $balans_minus . ' VND </b><br/>';
}


} else {
echo '<b>Bạn phải chọn một trong ba con</b><br/>';
}


echo '<br/><b><a href="3socap.php?act=choice&amp;rand=' . $rand .
'">Tiếp tục chơi</a></b><br/><br/>
Bạn có: ' . $datauser['balans'] . ' VND<br/>';
/////////////////////////


} else {
echo '<b>Bạn không đủ tiền để chơi.</b><br/>';
}


break;
case "faq":
echo 'Luбп��п��t "ChЖп��i"<br/><br/>
Bбп��п��n Phбп��п��i chбп��п��n 1 trong 3 con Дп��бп��п�� bбп��п��t Дп��бп��п��u cuбп��п��c chЖп��i<br/>
Nбп��п��u bбп��п��n chбп��п��n Дп��Гп��ng bбп��п��n sбп��п�� nhбп��п��n Дп��Жп��бп��п��c ' . $balans_plus . ' DGold<br/><br/>
Nбп��п��u bбп��п��n chбп��п��n sai bбп��п��n sбп��п�� bбп��п�� trбп��п�� ' . $balans_minus . ' DGold<br/>
ChГп��c may mбп��п��n!<br/>
<br/><a href="3socap.php">Quay lбп��п��i</a>';

break;

default:

echo '<img src="itmobi.gif" alt=""/><br/><br/>
<b><a href="3socap.php?act=choice">Bắt đầu Chơi</a></b><br/>
<a href="3socap.php?act=faq">Trợ giúp</a><br/>
Bạn có: ' . $datauser['balans'] . ' VND<br/>';
break;
}


} else {
echo 'Bạn cần <a href="' . $home . '/login.php">Đăng Nhập</a> mới có thể bắt đầu cuộc chơi.<br/>';
echo 'đăng Kí Tại: <a href="' . $home . '/registration.php">đây</a><br/>';
}

require_once ("../incfiles/end.php");
?>