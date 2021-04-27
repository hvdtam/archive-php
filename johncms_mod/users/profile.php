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
require('../incfiles/core.php');
$lng_profile = core::load_lng('profile');
/*
-----------------------------------------------------------------
Закрываем от неавторизованных юзеров
-----------------------------------------------------------------
*/
if (!$user_id) {
require('../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require('../incfiles/end.php');
exit;
}
/*
-----------------------------------------------------------------
Получаем данные пользователя
-----------------------------------------------------------------
*/
$user = functions::get_user($user);
if (!$user) {
require('../incfiles/head.php');
echo functions::display_error($lng['user_does_not_exist']);
require('../incfiles/end.php');
exit;
}
/*
-----------------------------------------------------------------
Переключаем режимы работы
-----------------------------------------------------------------
*/
$array = array (
'activity' => 'includes/profile',
'ban' => 'includes/profile',
'edit' => 'includes/profile',
'images' => 'includes/profile',
'info' => 'includes/profile',
'ip' => 'includes/profile',
'guestbook' => 'includes/profile',
'karma' => 'includes/profile',
'office' => 'includes/profile',
'password' => 'includes/profile',
'reset' => 'includes/profile',
'settings' => 'includes/profile',
'stat' => 'includes/profile'
);
$path = !empty($array[$act]) ? $array[$act] . '/' : '';
if (array_key_exists($act, $array) && file_exists($path . $act . '.php')) {
require_once($path . $act . '.php');
} else {
/*
-----------------------------------------------------------------
Анкета пользователя
-----------------------------------------------------------------
*/
$headmod = 'profile,' . $user['id'];
$textl = $lng['profile'] . ': ' . htmlspecialchars($user['name']);
require('../incfiles/head.php');
echo '<div class="phdr"><b>' . ($user['id'] != $user_id ? $lng_profile['user_profile'] : $lng_profile['my_profile']) . '</b></div>';
// Меню анкеты
$menu = array ();
if ($user['id'] == $user_id || $rights == 9 || ($rights == 7 && $rights > $user['rights']))
$menu[] = '<a href="profile.php?act=edit&amp;user=' . $user['id'] . '">' . $lng['edit'] . '</a>';
if ($user['id'] != $user_id && $rights >= 7 && $rights > $user['rights'])
$menu[] = '<a href="' . $set['homeurl'] . '/' . $set['admp'] . '/index.php?act=usr_del&amp;id=' . $user['id'] . '">' . $lng['delete'] . '</a>';
if ($user['id'] != $user_id && $rights > $user['rights'])
$menu[] = '<a href="profile.php?act=ban&amp;mod=do&amp;user=' . $user['id'] . '">' . $lng['ban_do'] . '</a>';
if (!empty($menu))
echo '<div class="topmenu">' . functions::display_menu($menu) . '</div>';
//Уведомление о дне рожденья
if ($user['dayb'] == date('j', time()) && $user['monthb'] == date('n', time())) {
echo '<div class="gmenu">' . $lng['birthday'] . '!!!</div>';
}
//Уведомление о дне рожденья
if ($user['dayb'] == date('j', $realtime) && $user['monthb'] == date('n', $realtime)) {
echo '<div class="gmenu">' . $lng['birthday'] . '!!!</div>';
}
// Информация о юзере
echo '<div class="phdr"><b>' . ($id ? 'Hồ sơ Người dùng' : 'Hồ sơ của tôi') . '</b></div>';
if ($user['dayb'] == $day && $user['monthb'] == $mon) {
echo '<div class="gmenu">Happy Birthday!!!</div>';
}
echo '<div class="gmenu"><p><h3><img src="../theme/' . $set_user['skin'] . '/images/' . ($user['sex'] == 'm' ? 'm' : 'w') . ($user['datereg'] > $realtime - 86400 ? '_new' : '') . '.png" width="16" height="16" class="left" />&nbsp;';
echo '<b>' . $user['name'] . '</b> (<b style="color:red;">ID</b>: ' . $user['id'] . ')';
if (time() > $user['lastdate'] + 300) {
echo '<span class="red"> [Off]</span>';
$lastvisit = date("d.m.Y (H:i)", $user['lastdate']);
} else {
echo '<span class="green"> [ON]</span>';
}
echo '</h3><ul>';
// Показываем аватар (если есть)
if (file_exists('../files/users/avatar/' . $user['id'] . '.png'))
echo 'Avatar:<br/ ><a href="../files/users/avatar/' . $user['id'] . '.png"><img src="../files/users/avatar/' . $user['id'] . '.png" width="32" height="32" alt="' . $user['name'] . '" border="0" /></a><br />';
// Показываем фотографию (если есть)
if (file_exists('../files/users/photo/' . $user['id'] . '_small.jpg'))
echo 'Photo:<br /><a href="../files/users/photo/' . $user['id'] . '.jpg"><img src="../files/users/photo/' . $user['id'] . '_small.jpg" alt="' . $user['name'] . '" border="0" /></a>';
//////////////////////////////////
///////thành viên chức danh
$user_u = $user['id'];
$req_u = mysql_query("SELECT * FROM `users` WHERE `id` = '$user_u' LIMIT 1");
$res_u = mysql_fetch_array($req_u);
$exp = $res_u['postforum']*100;
//$exp = $datauser['postforum']*100;
if ($exp >= 0 && $exp <500)
{
$chucdanh = '<img src="../images/forum/level/hocvien.gif" width="13" height="16" align="middle"/> Học Viên';
}
if ($exp >= 501 && $exp <1000)
{
$chucdanh = '<img src="../images/forum/level/tanbinh.gif" width="13" height="16" align="middle"/> Tân Binh';
}
if ($exp >= 1001 && $exp <2000)
{
$chucdanh = '<img src="../images/forum/level/binhbet.gif" width="13" height="16" align="middle"/> Binh Bét';
}
if ($exp >= 2001 && $exp <3500)
{
$chucdanh = '<img src="../images/forum/level/binhnhi.gif" width="13" height="16" align="middle"/> Binh Nhì';
}
if ($exp >= 3501 && $exp <5000)
{
$chucdanh = '<img src="../images/forum/level/binhnhat1.gif" width="13" height="16" align="middle"/> Binh Nhất';
}
if ($exp >= 5001 && $exp <10000)
{
$chucdanh = '<img src="../images/forum/level/hasi.gif" width="13" height="16" align="middle"/> Hạ Sĩ';
}
if ($exp >= 10001 && $exp <20001)
{
$chucdanh = '<img src="../images/forum/level/trungsi.gif" width="13" height="16" align="middle"/> Trung Sĩ';
}
if ($exp >= 20001 && $exp <30000)
{
$chucdanh = '<img src="../images/forum/level/thuongsi.gif" width="13" height="16" align="middle"/> Thượng Sĩ';
}
if ($exp >= 30001 && $exp <50000)
{
$chucdanh = '<img src="../images/forum/level/thieuuy.gif" width="13" height="16" align="middle"/> Thiếu Úy';
}
if ($exp >= 50001 && $exp <70000)
{
$chucdanh = '<img src="../images/forum/level/trunguy.gif" width="13" height="16" align="middle"/> Trung Úy';
}
if ($exp >= 70001 && $exp <90000)
{
$chucdanh = '<img src="../images/forum/level/thuonguy.gif" width="13" height="16" align="middle"/> Thượng Úy';
}
if ($exp >= 90001 && $exp <120000)
{
$chucdanh = '<img src="../images/forum/level/thieuta.gif" width="13" height="16" align="middle"/> Thiếu Tá';
}
if ($exp >= 120001 && $exp <140000)
{
$chucdanh = '<img src="../images/forum/level/trungta.gif" width="13" height="16" align="middle"/> Trung Tá';
}
if ($exp >= 140001 && $exp <160000)
{
$chucdanh = '<img src="../images/forum/level/thuongta.gif" width="13" height="16" align="middle"/> Thượng Tá';
}
if ($exp >= 200001 && $exp <300000)
{
$chucdanh = '<img src="../images/forum/level/thieutuong.gif" width="13" height="16" align="middle"/> Thiếu Tướng';
}
if ($exp >= 300001 && $exp <350000)
{
$chucdanh = '<img src="../images/forum/level/trungtuong.gif" width="13" height="16" align="middle"/> Trung Tướng';
}
if ($exp >= 350001 && $exp <450000)
{
$chucdanh = '<img src="../images/forum/level/thuongtuong.gif" width="13" height="16" align="middle"/> Thượng Tướng';
}
if ($exp >= 450001 && $exp <500000)
{
$chucdanh = '<img src="../images/forum/level/daituong.gif" width="13" height="16" align="middle"/> Đại Tướng';
}
if ($exp >= 500001)
{
$chucdanh = '<img src="../images/forum/level/tongtulenh.gif" width="25" height="15" /> Tổng Tư Lệnh';
}
echo '<li>Cấp bậc: ' . $chucdanh . ' </li>';
if (!empty($user['status']))
echo '<li><span class="gray">Tâm trạng: </span><img src="../tamtrang/' . $user['status'] . '.gif" alt="' . $user['status'] . '" border="0" height="15" align="middle" /></li>';
//////////////////////////////////////////////////////////
echo '<li><span class="gray">Đăng nhập:</span> <b>' . $user['name_lat'] . '</b></li>';
if ($user['rights'] >=2) {
$user['colornick'] == 'ff0000';
}
echo '<li>Màu nick: <span style="color:#' . $user['colornick'] . '">' . $user['name'] . '</span></li>';
if ($user['rights']) {
echo '<li><span class="gray">Chức vụ:</span> ';
$rank = array (
1 => 'Killer',
2 => '&nbsp;Mod Chat Room',
3 => '&nbsp;Mod Forum',
4 => '&nbsp;Mod Download',
5 => '&nbsp;Mod Thư viện',
6 => '&nbsp;Super Moderator',
7 => '&nbsp;Adminstrator',
8 => '&nbsp;Adminstrator',
9 => '&nbsp;Người sáng lập'
);
echo '<span class="red"><b>' . $rank[$user['rights']] . '</b></span>';
echo '</li>';
}
$user_u = $user['id'];
$req_u = mysql_query("SELECT * FROM `users` WHERE `id` = '$user_u' LIMIT 1");
$res_u = mysql_fetch_array($req_u);
$exp = $res_u['postforum']*155;
if ($exp >= 0 && $exp <3000)
{
echo '<li><span class="gray">Điểm kinh nghiệm:</span> <b style="color:red;">' . $exp . '</b>/3000 exp</li>';
}
if ($exp >= 3000 && $exp <5250)
{
echo '<li><span class="gray">Điểm kinh nghiệm:</span> <b style="color:red;">' . $exp . '</b>/5250 exp</li>';
}
if ($exp >= 5250 && $exp <8250)
{
echo '<li><span class="gray">Điểm kinh nghiệm: </span><b style="color:red;">' . $exp . '</b>/8250 exp</li>';
}
if ($exp >= 8250 && $exp <12750)
{
echo '<li><span class="gray">Điểm kinh nghiệm:</span> <b style="color:red;">' . $exp . '</b>/12750 exp</li>';
}
if ($exp >= 12750 && $exp <19500)
{
echo '<li><span class="gray">Điểm kinh nghiệm: </span><b style="color:red;">' . $exp . '</b>/19500 exp</li>';
}
if ($exp >= 19500 && $exp <31500)
{
echo '<li><span class="gray">Điểm kinh nghiệm: </span><b style="color:red;">' . $exp . '</b>/31500 exp</li>';
}
if ($exp >= 31500 && $exp <46500)
{
echo '<li><span class="gray">Điểm kinh nghiệm: </span><b style="color:red;">' . $exp . '</b>/46500 exp</li>';
}
if ($exp >= 46500 && $exp <70500)
{
echo '<li><span class="gray">Điểm kinh nghiệm: </span><b style="color:red;">' . $exp . '</b>/70500 exp</li>';
}
if ($exp >= 70500 && $exp <102000)
{
echo '<li><span class="gray">Điểm kinh nghiệm: </span><b style="color:red;">' . $exp . '</b>/102000 exp</li>';
}
if ($exp >= 102000 && $exp <165000)
{
echo '<li><span class="gray">Điểm kinh nghiệm:</span><b style="color:red;">' . $exp . '</b>/165000 exp</li>';
}
if ($exp >= 165000 && $exp <240000)
{
echo '<li><span class="gray">Điểm kinh nghiệm:</span><b style="color:red;">' . $exp . '</b>/240000 exp</li>';
}
if ($exp >= 240000 && $exp <330000)
{
echo '<li><span class="gray">Điểm kinh nghiệm: </span><b style="color:red;">' . $exp . '</b>/330000 exp</li>';
}
if ($exp >= 330000 && $exp <435000)
{
echo '<li><span class="gray">Điểm kinh nghiệm: </span><b style="color:red;">' . $exp . '</b>/435000 exp</li>';
}
if ($exp >= 435000 && $exp <585000)
{
echo '<li><span class="gray">Điểm kinh nghiệm: </span><b style="color:red;">' . $exp . '</b>/585000 exp</li>';
}
if ($exp >= 585000 && $exp <765000)
{
echo '<li><span class="gray">Điểm kinh nghiệm: </span><b style="color:red;">' . $exp . '</b>/765000 exp</li>';
}
if ($exp >= 765000 && $exp <1140000)
{
echo '<li><span class="gray">Điểm kinh nghiệm: </span><b style="color:red;">' . $exp . '</b>/1140000 exp</li>';
}
if ($exp >= 1140000 && $exp <1650000)
{
echo '<li><span class="gray">Điểm kinh nghiệm: </span><b style="color:red;">' . $exp . '</b>/1650000 exp</li>';
}
////////////////////////
////////////////////////
$user_u = $user['id'];
$req_u = mysql_query("SELECT * FROM `users` WHERE `id` = '$user_u' LIMIT 1");
$res_u = mysql_fetch_array($req_u);
$diem = $res_u['postforum'];
if ($diem == 0 )
{
$quanham = 'New Member!';
}
if ($diem >= 1 && $diem <20)
{
$quanham = 'Binh Nhì';
}
if ($diem >= 21 && $diem <40)
{
$quanham = 'Binh Nhất';
}
if ($diem >= 41 && $diem <80)
{
$quanham = 'Hạ Sĩ';
}
if ($diem >= 81 && $diem <150)
{
$quanham = 'Trung Sĩ';
}
if ($diem >= 151 && $diem <300)
{
$quanham = 'Thượng Sĩ';
}
if ($diem >= 301 && $diem <450)
{
$quanham = 'Chuẩn Úy';
}
if ($diem >= 451 && $diem <700)
{
$quanham = 'Thiếu Úy';
}
if ($diem >= 701 && $diem <900)
{
$quanham ='Trung Úy';
}
if ($diem >= 901 && $diem <1200)
{
$quanham = 'Đại Úy';
}
if ($diem >= 1201 && $diem <1500)
{
$quanham = 'Thiếu Tá';
}
if ($diem >= 1501 && $diem <1900)
{
$quanham = 'Trung Tá';
}
if ($diem >= 1901 && $diem <2500)
{
$quanham = 'Đại Tá';
}
if ($diem >= 2501 && $diem <2800)
{
$quanham = 'Thiếu Tướng';
}
if ($diem >= 2801 && $diem <4000)
{
$quanham = 'Trung Tướng';
}
if ($diem >= 4000)
{
$quanham = 'Đại Tướng';
}
if (isset($lastvisit))
echo '<li><span class="gray">' . $lng['last_visit'] . ':</span> ' . $lastvisit . '</li>';
////
if (!empty($user['love']))
echo '<li><span class="gray">Love: </span><b style="color:#7B68EE">' . $user['love'] . '</b></li>';
////
if (!empty($user['fam']))
echo '<li><span class="gray">Bang: </span><b style="color:#7B68EE">' . $user['fam'] . '</b></li>';
switch($act){
case 'muabuy' :
if($user['balans']>=10000)
if($user['postforum']>=10){
$mua = ($_POST['mua']);
mysql_query("UPDATE `users` SET `fam` = '$mua' , `balans`=`balans`-10000  WHERE `id` = '$user_id' LIMIT 1");
echo '<div class="menu">Gia nhập Fam  ' .$user['fam']. '  thành công!!</div>';
require_once('../incfiles/end.php');
header('Location:../users/profile.php?act=muabuyo&amp;user=' . $user_id . '');
exit();
}else{
echo '<div class="menu">Bạn không đủ số VNĐ, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';
}
require_once('../incfiles/end.php');
break;
case 'muabuyo' :
echo '<div class="menu">Gia nhập Fam  '.$user['fam'].'  thành công!</div>';
require_once('../incfiles/end.php');
break;
default :
if ($user['id'] != $user_id)
if (!empty($user['fam']))
if($user['balans']>=100000)
if($user['postforum']>=50){
echo '<div> <form action="../users/profile.php?act=muabuy&amp;user=' . $user_id . '" name="mua" method="post">
<input type="radio" name="mua" value="' . $user['fam'] . '"/> Vào fam - 100000 VNĐ<br/>
<input type="submit" name="submit" value="Vào Bang"/> </form> </div> ';
}else{
echo '<div class="menu">Bạn không đủ cấp độ!</div>';
}
}
//
$totussoo = mysql_num_rows(mysql_query("SELECT * FROM `soo_users` WHERE `user_id` = '". $user['id'] ."'"));
echo '<li><img src="../images/soo/soo.gif" width="16" height="16"/>&#160;<a href="../soo/?act=usersoo&amp;user='. $user['id'] .'">Hội nhóm </a> ('. $totussoo .')</li>';
/////////////////////////////////
if ($rights >= 1 && $rights >= $user['rights']) {
echo '<li><span class="gray">Sử dụng trình duyệt:</span> ' . $user['browser'] . '</li>';
echo '<li><span class="gray">Địa chỉ IP:</span> <a href="/panel/index.php?act=search_ip&amp;ip=' . $user['ip'] . '">' . long2ip($user['ip']) . '</a></li>';
if ($user['immunity'])
echo '<li><span class="green"><b>không ảnh hưởng</b></span></li>';
}
$user_u = $res['user_id'];
$req_u = mysql_query("SELECT * FROM `users` WHERE `id` = '$user_u' LIMIT 1");
$res_u = mysql_fetch_array($req_u);
$mana = $res_u['mana'];
if ($mana <= 0)
{
$congluc = '<font color="blue">Die</font>';
}
if ($mana > 0)
{
$congluc = 'hihi';
}
echo '<li><div class="status"><font color="Yellow">Quân hàm: ' . $quanham . '</font></div>';
///echo '<li><div class="status"><b><font color="violet">Phi Phong: ' . $congluc . '</font></b></div>';
if (!empty($user['farm']))
echo '<li><div class="status"><b><font color="violet">Bang: ' . $user['farm'] . '</font></b></div>';
if($user['mana'] < 0 ){
echo '<li><div class="status">Công lực: <font color="red">DIE</font></div>';
}else{
echo '<li><div class="status">Công lực: ' . $user['mana'] . ' mana</div>';
}
echo '<li><div class="status">Tài sản: ' . $user['balans'] . ' VND</div></font>';
echo '<li><img src="../rating.php?p=' . $user['postforum'] . '" alt="' . $user['postforum'] . '" />';
echo '<li><div class="status"><a href="'.$home.'/users/tudo.php?id=' . $user['id'] . '"><b><font color="#736AFF">Tủ đồ</font></b></a> | <a href="' . $home . '/mod/dosat.php?id=' . $user['id'] . '"><b><font color="#736AFF">Đồ sát</font></b></a> | <a href="' . $home . '/users/perevod.php?id=' . $user['id'] . '"><b><font color="#736AFF">Chuyển tiền</font></b></a></div>';
echo '</ul></p></div>';
include 'blog.php';
// Информация о юзере
$arg = array (
'lastvisit' => 1,
'iphist' => 1,
'header' => '<b>ID:' . $user['id'] . '</b>'
);
if($user['id'] != core::$user_id) $arg['footer'] = '<span class="gray">' . core::$lng['where'] . ':</span> ' . functions::display_place($user['id'], $user['place']);
//// echo '<div class="user"><p>' . functions::display_user($user, $arg) . '</p></div>';
// Если юзер ожидает подтверждения регистрации, выводим напоминание
if ($rights >= 7 && !$user['preg'] && empty($user['regadm'])) {
echo '<div class="rmenu">' . $lng_profile['awaiting_registration'] . '</div>';
}
// Карма
if ($set_karma['on']) {
$karma = $user['karma_plus'] - $user['karma_minus'];
if ($karma > 0) {
$images = ($user['karma_minus'] ? ceil($user['karma_plus'] / $user['karma_minus']) : $user['karma_plus']) > 10 ? '2' : '1';
echo '<div class="gmenu">';
} else if ($karma < 0) {
$images = ($user['karma_plus'] ? ceil($user['karma_minus'] / $user['karma_plus']) : $user['karma_minus']) > 10 ? '-2' : '-1';
echo '<div class="rmenu">';
} else {
$images = 0;
echo '<div class="menu">';
}
echo '<table  width="100%"><tr><td width="22" valign="top"><img src="' . $set['homeurl'] . '/images/k_' . $images . '.gif"/></td><td>' .
'<b>' . $lng['karma'] . ' (' . $karma . ')</b>' .
'<div class="sub">' .
'<span class="green"><a href="profile.php?act=karma&amp;user=' . $user['id'] . '&amp;type=1">' . $lng['vote_for'] . ' (' . $user['karma_plus'] . ')</a></span> | ' .
'<span class="red"><a href="profile.php?act=karma&amp;user=' . $user['id'] . '">' . $lng['vote_against'] . ' (' . $user['karma_minus'] . ')</a></span>';
if ($user['id'] != $user_id) {
if (!$datauser['karma_off'] && (!$user['rights'] || ($user['rights'] && !$set_karma['adm'])) && $user['ip'] != $datauser['ip']) {
$sum = mysql_result(mysql_query("SELECT SUM(`points`) FROM `karma_users` WHERE `user_id` = '$user_id' AND `time` >= '" . $datauser['karma_time'] . "'"), 0);
$count = mysql_result(mysql_query("SELECT COUNT(*) FROM `karma_users` WHERE `user_id` = '$user_id' AND `karma_user` = '" . $user['id'] . "' AND `time` > '" . (time() - 86400) . "'"), 0);
if (!$ban && $datauser['postforum'] >= $set_karma['forum'] && $datauser['total_on_site'] >= $set_karma['karma_time'] && ($set_karma['karma_points'] - $sum) > 0 && !$count) {
echo '<br /><a href="profile.php?act=karma&amp;mod=vote&amp;user=' . $user['id'] . '">' . $lng['vote'] . '</a>';
}
}
} else {
$total_karma = mysql_result(mysql_query("SELECT COUNT(*) FROM `karma_users` WHERE `karma_user` = '$user_id' AND `time` > " . (time() - 86400)), 0);
if ($total_karma > 0)
echo '<br /><a href="profile.php?act=karma&amp;mod=new">' . $lng['responses_new'] . '</a> (' . $total_karma . ')';
}
echo '</div></td></tr></table></div>';
}
// Меню выбора
$total_photo = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_album_files` WHERE `user_id` = '" . $user['id'] . "'"), 0);
echo '<div class="list2"><p>' .
'<div><img src="../images/contacts.png" width="16" height="16"/>&#160;<a href="profile.php?act=info&amp;user=' . $user['id'] . '">' . $lng['information'] . '</a></div>' .
'<div><img src="../images/activity.gif" width="16" height="16"/>&#160;<a href="profile.php?act=activity&amp;user=' . $user['id'] . '">' . $lng_profile['activity'] . '</a></div>' .
'<div><img src="../images/rate.gif" width="16" height="16"/>&#160;<a href="profile.php?act=stat&amp;user=' . $user['id'] . '">' . $lng['statistics'] . '</a></div>';
$bancount = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_ban_users` WHERE `user_id` = '" . $user['id'] . "'"), 0);
if ($bancount)
echo '<div><img src="../images/block.gif" width="16" height="16"/>&#160;<a href="profile.php?act=ban&amp;user=' . $user['id'] . '">' . $lng['infringements'] . '</a> (' . $bancount . ')</div>';
echo '<br />' .
'<div><img src="../images/photo.gif" width="16" height="16"/>&#160;<a href="album.php?act=list&amp;user=' . $user['id'] . '">' . $lng['photo_album'] . '</a>&#160;(' . $total_photo . ')</div>' .
'<div><img src="../images/guestbook.gif" width="16" height="16"/>&#160;<a href="profile.php?act=guestbook&amp;user=' . $user['id'] . '">' . $lng['guestbook'] . '</a>&#160;(' . $user['comm_count'] . ')</div>';
//echo '<div><img src="../images/pt.gif" width="16" height="16"/>&#160;<a href="">' . $lng['blog'] . '</a>&#160;(0)</div>';
if ($user['id'] != $user_id) {
echo '<br /><div><img src="../images/users.png" width="16" height="16"/>&#160;<a href="">' . $lng['contacts_in'] . '</a></div>';
if (!isset($ban['1']) && !isset($ban['3']))
echo '<div><img src="../images/write.gif" width="16" height="16"/>&#160;<a href="pradd.php?act=write&amp;adr=' . $user['id'] . '"><b>' . $lng['write'] . '</b></a></div>';
}
echo '</p></div>';
echo '<div class="phdr"><a href="index.php">' . $lng['users'] . '</a></div>';
}
require_once('../incfiles/end.php');
?>
