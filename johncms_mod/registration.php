<?php

define('_IN_JOHNCMS', 1);

$rootpath = '';
require('incfiles/core.php');
$textl = $lng['registration'];
require('incfiles/head.php');
$lng_reg = core::load_lng('registration');
// Если регистрация закрыта, выводим предупреждение
if (core::$deny_registration || !$set['mod_reg']) {
echo '<p>' . $lng_reg['registration_closed'] . '</p>';
require('incfiles/end.php');
exit;
}
/*
-----------------------------------------------------------------
Форма регистрации
-----------------------------------------------------------------
*/
$ktip = mysql_result(mysql_query("SELECT COUNT(`ip`) FROM `users` WHERE `ip`='" . core::$ip . "'"), 0);

if ($ktip == 4) {
echo '<div class="rmenu">Bạn đã đăng ký quá 3 nick rồi không thể <b>Đăng ký</b> được nữa...</div>';
require('incfiles/end.php');
exit;}
/*
-----------------------------------------------------------------
Форма регистрации
-----------------------------------------------------------------
*/

$reg_nick = isset($_POST['nick']) ? trim($_POST['nick']) : '';
$lat_nick = functions::rus_lat(mb_strtolower($reg_nick));
$reg_pass = isset($_POST['password']) ? trim($_POST['password']) : '';
$reg_name = isset($_POST['imname']) ? trim($_POST['imname']) : '';
$reg_about = isset($_POST['about']) ? trim($_POST['about']) : '';
$reg_sex = isset($_POST['sex']) ? functions::check(mb_substr(trim($_POST['sex']), 0, 2)) : '';

echo '<div class="phdr"><b>' . $lng['registration'] . '</b></div>';
if (isset($_POST['submit'])) {
// Принимаем переменные
$error = array();
// Проверка Логина
if (empty($reg_nick))
$error['login'][] = $lng_reg['error_nick_empty'];
elseif (mb_strlen($reg_nick) < 2 || mb_strlen($reg_nick) > 25)
$error['login'][] = $lng_reg['error_nick_lenght'];
// Проверка пароля
if (empty($reg_pass)) $error['password'][] = $lng['error_empty_password'];
elseif (mb_strlen($reg_pass) < 3 || mb_strlen($reg_pass) > 20) $error['password'][] = $lng['error_wrong_lenght'];
// Проверка пола
if ($reg_sex != 'm' && $reg_sex != 'zh') $error['sex'] = $lng_reg['error_sex'];
// Проверка кода CAPTCHA
// Проверка переменных
if (empty($error)) {
$pass = md5(md5($reg_pass));
$reg_name = functions::check(mb_substr($reg_name, 0, 20));
$reg_about = functions::check(mb_substr($reg_about, 0, 500));
// Проверка, занят ли ник
$req = mysql_query("SELECT * FROM `users` WHERE `name_lat`='" . mysql_real_escape_string($lat_nick) . "'");
if (mysql_num_rows($req) != 0) {
$error['login'][] = $lng_reg['error_nick_occupied'];
}
}
if (empty($error)) {
$msg = 'Chào mừng bạn đã đến với wap chat dành cho teen :D
Nếu bạn buồn hãy vào <b><a href="/chat">Phòng Chat</b></a> hoặc vào <b><a href="/pages/giaitri.php">Game có thưởng</b></a> để giải trí nhá! Nếu có rảnh thì vào làm nhiệm vụ ở <b><a href="/mission">đây</b></a> nhá
Chúc bạn 1 ngày vui vẻ!';
mysql_query("insert into `privat` values(0,'" . mysql_real_escape_string($lat_nick) . "','".$msg."','" . time() . "','MouseIT','in','no','Chào','0','','','','" . mysql_real_escape_string($fname) . "');");
$botnew = 'Chào mừng [red]' . $reg_nick . '[/red] đã vào wap chat ';
if ($botnew) {
mysql_query("INSERT INTO `guest` SET
`adm` = '$admset',
`time` = '" . time() . "',
`user_id` = '3',
`name` = 'BOT',
`text` = '" . mysql_real_escape_string($botnew) . "',
`ip` = '00000',
`browser` = 'IPhone 4Gs'
");
$preg = $set['mod_reg'] > 1 ? 1 : 0;
mysql_query("INSERT INTO `users` SET
`name` = '" . mysql_real_escape_string($reg_nick) . "',
`name_lat` = '" . mysql_real_escape_string($lat_nick) . "',
`password` = '" . mysql_real_escape_string($pass) . "',
`imname` = '$reg_name',
`about` = '$reg_about',
`sex` = '$reg_sex',
`rights` = '0',
`balans` = '10000',

`ip` = '" . core::$ip . "',
`ip_via_proxy` = '" . core::$ip_via_proxy . "',
`browser` = '" . mysql_real_escape_string($agn) . "',
`datereg` = '" . time() . "',
`lastdate` = '" . time() . "',
`sestime` = '" . time() . "',
`preg` = '$preg'
");
$usid = mysql_insert_id();
echo '<div class="menu"><p><h3>' . $lng_reg['you_registered'] . '</h3>' . $lng_reg['your_id'] . ': <b>' . $usid . '</b><br/>' . $lng_reg['your_login'] . ': <b>' . $reg_nick . '</b><br/>' . $lng_reg['your_password'] . ': <b>' . $reg_pass . '</b></p>' .
'<p><h3>' . $lng_reg['your_link'] . '</h3><input type="text" value="' . $set['homeurl'] . '/login.php?id=' . $usid . '&amp;p=' . $reg_pass . '" /><br/>';
if ($set['mod_reg'] == 1) {
echo '<p><span class="red"><b>' . $lng_reg['moderation_note'] . '</b></span></p>';
} else {
echo '<br/>Bạn vui lòng vào <a href="login.php">đây</a> để đăng nhập<br/><br/>';
}
echo '</p></div>';
require('incfiles/end.php');
exit;
}
}

}
/*
-----------------------------------------------------------------
Форма регистрации
-----------------------------------------------------------------
*/
if ($set['mod_reg'] == 1) echo '<div class="rmenu"><p>' . $lng_reg['moderation_warning'] . '</p></div>';
echo '<form action="registration.php" method="post"><div class="gmenu">' .
'<p><h3>Tên nick: (2 - 20 ký tự) </h3><hr/>Không hỗ trợ Tiếng Việt có dấu' .
(isset($error['login']) ? '<span class="red"><small>' . implode('<br />', $error['login']) . '</small></span><br />' : '') .
'<input type="text" name="nick" maxlength="20" value="' . htmlspecialchars($reg_nick) . '"' . (isset($error['login']) ? ' style="background-color: #FFCCCC"' : '') . '/><br />' .
'</p>' .
'<p><h3>Mật khẩu: (2 - 20 ký tự)</h3><hr/>Không hỗ trợ Tiếng Việt có dấu' .
(isset($error['password']) ? '<span class="red"><small>' . implode('<br />', $error['password']) . '</small></span><br />' : '') .
'<input type="text" name="password" maxlength="20" value="' . htmlspecialchars($reg_pass) . '"' . (isset($error['password']) ? ' style="background-color: #FFCCCC"' : '') . '/><br/>' .
'</p>' .
'<p><h3>' . $lng_reg['sex'] . '</h3>' .
(isset($error['sex']) ? '<span class="red"><small>' . $error['sex'] . '</small></span><br />' : '') .
'<select name="sex"' . (isset($error['sex']) ? ' style="background-color: #FFCCCC"' : '') . '>' .
'<option value="m"' . ($reg_sex == 'm' ? ' selected="selected"' : '') . '>' . $lng_reg['sex_m'] . '</option>' .
'<option value="zh"' . ($reg_sex == 'zh' ? ' selected="selected"' : '') . '>' . $lng_reg['sex_w'] . '</option>' .
'</select></p></div>' .
'<div class="menu">' .
'<p><h3>' . $lng_reg['name'] . '</h3>' .
'<input type="text" name="imname" maxlength="30" value="' . htmlspecialchars($reg_name) . '" /><br />' .
'</p>' .
'<p><h3>' . $lng_reg['about'] . '</h3>' .
'<textarea rows="3" name="about">' . htmlspecialchars($reg_about) . '</textarea><br />' .
'</div>' .
'<div class="gmenu"><p>' .
'<p><input type="submit" name="submit" value="' . $lng_reg['registration'] . '"/></p></div></form>' .
'<div></div>';

require('incfiles/end.php');
?>
