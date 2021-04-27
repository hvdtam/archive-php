<?php
/** **************************
***Gnom**********************
***gnom-09_@mail.ru***********
***6.10.2009******************
***????:http://vip-wap.ru****
***ICQ: 99-01-07*************
/**/
define('_IN_JOHNCMS', 1);
$headmod = 'dosat';
$textl = '' . $lng_dosat['money_move'] . '';
require_once ("../incfiles/core.php");
require_once ("../incfiles/head.php");
$lng_dosat = core::load_lng('dosat');
if (!$user_id) {
require_once ('../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require_once ('../incfiles/end.php');
exit;
}
switch($act)
{
default:
if(empty($_GET['id']))
{
echo '<div class="phdr"><b>Đồ Sát</b></div>';
echo '<form method="POST" action="dosat.php?act=ok">';
echo '<div class="gmenu">';
echo ''.$datauser['money_have'].'<b>'.$datauser['mana'].' Mana</b><br/>';
echo '' . $lng_dosat['money_move_user'] . '<br/>';
echo ' 1: <input type="radio"  value="1" name="pos" checked="checked"/>';
echo '<div class="fmenu">' . $lng_dosat['nick'] . '<br/>';
echo '<select name="users">';
echo '<option value="">' . $lng_dosat['list'] . '</option>';
$sql = mysql_query("select `id`,`name` from `users`");
while($res = mysql_fetch_array($sql))
{
echo '<option value="'.$res['id'].'">'.$res['name'].'</option>';
}
echo '</select></div>';
echo ' 2: <input type="radio"  value="2" name="pos" />';
echo '<div class="fmenu">' . $lng_dosat['enter_nick'] . ' <br/><input name="user"/></div>';
echo '' . $lng_dosat['num_money_move'] . ' <br/><input name="bal"/></div>';
echo '<div class="menu"><input value="' . $lng_dosat['money_move'] . ' " type="submit" name="submit"/></div></form>';
}else{
$sql = mysql_query("select `id`,`name` from `users` WHERE `id` = '".$id."' LIMIT 1;");
if(mysql_num_rows($sql)!=="0")
{
$user = mysql_fetch_array($sql);
echo '<div class="phdr"><b>Đồ Sát</b></div>';
echo '<div class="gmenu">';
echo ''.$lng_dosat['money_have'].'<b>'.$datauser['mana'].' Mana</b><br/>';
echo '<form method="POST" action="dosat.php?act=ok&amp;id='.$user['id'].'">';
echo '' . $lng_dosat['money_move'] . '  ' . $lng_dosat['move_user'] . '  <b>'.$user['name'].'</b><br/>';
echo '' . $lng_dosat['num_money_move'] . '<br/><input name="bal"/><br/>';
echo '<input value="' . $lng_dosat['move'] . ' " type="submit" name="submit"/></form>';
}
}
break;
case "ok";
if(empty($_GET['id']))
{
if(!empty($_POST['submit']))
{
if($_POST['pos'] == "1")
{
$user = isset($_POST['users'])?abs(intval($_POST['users'])):false;
}elseif($_POST['pos'] == "2")
{
$user = isset($_POST['user'])?check($_POST['user']):false;
}
$ball = isset($_POST['bal'])?abs(intval($_POST['bal'])):false;
$count = mysql_result(mysql_query("select COUNT(*) from `users` WHERE `id` = '".$user."' or `name` = '".$user."'"),0);
if($count > 0 )
{
$arr = mysql_fetch_array(mysql_query("select `name`,`mana` from `users` WHERE `id` = '".$user."'  or `name` = '".$user."' LIMIT 1"));
$q = mysql_fetch_array(mysql_query("select `name`,`mana` from `users` WHERE `id` = '".$user_id."' LIMIT 1"));
if($q['mana'] >= 20)
{
if($arr['name'] !== $q['name'])
{
if($ball > 1 && $q['mana'] > $ball)
{
$min_bal = intval($q['mana'] - $ball);
$plus_bal = intval($arr['mana'] - $ball);
$msg = 'Chiến Trường TaMk.tK: <b><a href="/users/profile.php?user=' . $user_id . '">' . $login . '</b></a> đã tấn công bạn bằng '.$ball.' MaNa.Và Bạn Đã Thua Và Bị Trừ '.$ball.' .Hãy Phản Công Lại Nào Ấn Vào <a href="/mod/perevod?id=' . $user_id . '">Đây</a> Để Phản Công<br>
Đây là tin nhắn tự động.Chúc bạn 1 ngày vui vẻ cùng TaMk.tK!';
mysql_query("update `users` set `mana` = '".$min_bal."' where `id` = '".$user_id."' LIMIT 1");
mysql_query("update `users` set `mana` = '".$plus_bal."' where `id` = '".$user."'  or `name` = '".$user."' LIMIT 1");
mysql_query("insert into `privat` values(0,'".$arr['name']."','" . $msg . "','" . time() . "','BOT','in','no','Thách đấu','0','','','','" . mysql_real_escape_string($fname) . "');");
echo '<p>Tấn công thành công '.$ball.' MaNA đối với thành viên '.$arr['name'].'<br/>';
}else{
echo '<p>' . $lng_dosat['error_move_few'] . ' </p>';
}
}else{
echo '<p>' . $lng_dosat['error_move'] . '</p>';
}
}else{
echo '<p>' . $lng_dosat['error_move_few'] . ' </p>';
}
}else{
echo '<p><b>' . $lng_dosat['error_name'] . ' </b><br/>';
echo '<a href="dosat.php?r='.mt_rand(0000,9999).'">' . $lng_dosat['back'] . ' </a></p>';
require_once ("../incfiles/end.php");
exit;
}
}else{
echo '<p><b>' . $lng_dosat['error'] . ' </b><br/>';
echo '<a href="dosat.php?r='.mt_rand(0000,9999).'">' . $lng_dosat['back'] . ' </a></p>';
require_once ("../incfiles/end.php");
exit;
}
}else{
if(!empty($_POST['submit']))
{
$ball = isset($_POST['bal'])?abs(intval($_POST['bal'])):false;
$count = mysql_result(mysql_query("select COUNT(*) from `users` WHERE `id` = '".$id."'"),0);
if($count > 0 )
{
$arr = mysql_fetch_array(mysql_query("select `name`,`mana` from `users` WHERE `id` = '".$id."' LIMIT 1"));
$q = mysql_fetch_array(mysql_query("select `name`,`mana` from `users` WHERE `id` = '".$user_id."' LIMIT 1"));
if($q['mana'] >= 20)
{
if($arr['name'] !== $q['name'])
{
if($ball > 1 && $q['mana'] > $ball)
{
$min_bal = intval($q['mana'] - $ball);
$msg = 'Chiến trường TaMk.tK <b><a href="/users/profile.php?user=' . $user_id . '">' . $login . '</b></a> đã đồ sát bạn với '.$ball.' MaNa.Hãy ấn vào <a href="/mod/perevod?id=' . $user_id . '">đây</a> để phản công
Đây là tin nhắn tự động.Chúc bạn 1 ngày vui vẻ cùng TaMk.tK!';
$plus_bal = intval($arr['mana'] - $ball);
mysql_query("update `users` set `mana` = '".$min_bal."' where `id` = '".$user_id."' LIMIT 1");
mysql_query("update `users` set `mana` = '".$plus_bal."' where `id` = '".$id."' LIMIT 1");
mysql_query("insert into `privat` values(0,'".$arr['name']."','" . $msg . "','" . time() . "','BOT(Máy Chém Tự Động)','in','no','Thông tin về trận chiến','0','','','','" . mysql_real_escape_string($fname) . "');");
echo '<p>Đồ Sát Thành công  '.$ball.' mana đối với '.$arr['name'].'<br/>';
}else{
echo '<p>' . $lng_dosat['error_move_few'] . ' </p>';
}
}else{
echo '<p>' . $lng_dosat['error_move'] . '</p>';
}
}else{
echo '<p>' . $lng_dosat['error_move_few'] . ' </p>';
}
}else{
echo '<p><b>' . $lng_dosat['error_name'] . ' </b><br/>';
echo '<a href="dosat.php?r='.mt_rand(0000,9999).'">' . $lng_dosat['back'] . ' </a></p>';
require_once ("../incfiles/end.php");
exit;
}
}else{
echo '<p><b>' . $lng_dosat['error'] . ' </b><br/>';
echo '<a href="dosat.php?r='.mt_rand(0000,9999).'">' . $lng_dosat['back'] . ' </a></p>';
require_once ("../incfiles/end.php");
exit;
}
}
break;
}
require_once ("../incfiles/end.php");
?>
