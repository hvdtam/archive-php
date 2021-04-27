<?php
define('_IN_JOHNCMS', 1);
$rootpath = '';
$textl = "Quản lí gửi tin nhắn";
require_once ("incfiles/core.php");
require_once ("incfiles/head.php");

//Проверка прав доступа.если меньше 6 то посылаем нафиг :)
if (!$res_id && $rights<7) {
echo '<div class="phdr" style="font-weight:bold;">Thất bại!</div>';
echo 'Truy cập vào trang này được giới hạn trong phần quản trị!';
require_once ("incfiles/end.php");
exit;
}
switch($_GET['act']) {

//Страница ввода текста сообщения.
default:
echo '<div class="phdr" style="font-weight:bold;">Gửi tin nhắn</div>' . "\n";
echo '<form action="email_panel.php?act=start" method="POST">';
echo '<b>Chọn gửi chế độ:</b><br />';
echo '<select name="sel"><option value="all">Tất cả</option><option value="adm">Tất cả Admin</option><option value="smdadm">Tất cả Sadmin trở lên</option><option value="m">Tất cả thành viên nam</option><option value="zh">Tất cả thành viên nử</option></select><br />' . "\n";
echo '<b>Nội dung: </b><br />';
echo '<textarea name="message" rows="5"></textarea><br />';
echo '<input type="submit" value="Gửi!" />' . "\n";
echo '</form></div>';
echo '<div class="menu">&raquo; <a href="/users/profile.php?act=office">Cá nhân</a><br />&raquo; <a href="/email_panel.php?act=stat">Thống kê tin nhắn</a></div>';
break;

//Проверка,обработка и отправка сообщений
case 'start':

if (empty($_POST['message'])) {
echo '<b>Lỗi!</b>Bạn chưa nhập tin nhắn văn bản!<br />&raquo; <a href="email_panel.php">Quay lại</a>';
require_once ("incfiles/end.php");
exit;
}
echo '<div class="phdr" style="font-weight:bold;">Danh sách kết quả</div>' . "\n";
echo '<div class="b">';
$soob = check(trim($_POST['message']));
//Отправка всем пользователям
if ($_POST['sel'] == 'all') {
$colus = mysql_result(mysql_query("SELECT COUNT(*) FROM `users`;"), 0);
$asp = mysql_query("SELECT `name` FROM `users` ORDER BY `id` DESC LIMIT $colus;");
$wx = 0;
while ($res = mysql_fetch_assoc($asp)) {
$usname = $res['name'];
if ($usname == $login) { continue; } 
mysql_query("INSERT INTO `privat` VALUES(0,'" .$usname. "','" .$soob. "','" .$realtime. "','BOT(May Chem Tu Dong)','in','no','Thống báo từ BQT','0','','','','');");
$wx++;
}
echo '<b>Gửi tin nhắn thành công!</b><br />
Gửi <b>' .$wx. '</b> tin nhắn cho tất cả các thành viên!';
$type_r = 1;
}

//Отправка сообщений всем модерам и админам

elseif ($_POST['sel'] == 'adm') {
$colad = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `rights`>= 1;"), 0);
$asp = mysql_query("SELECT `name` FROM `users` WHERE `rights`>=1 ORDER BY `id` DESC LIMIT $colad;");
$wx = 0;
while ($res = mysql_fetch_assoc($asp)) {
$usname = $res['name'];
if ($usname == $login) { continue; } 
mysql_query("INSERT INTO `privat` VALUES(0,'" .$usname. "','" .$soob. "','" .$realtime. "','BOT(May Chem Tu Dong)','in','no','Thống báo từ BQT','0','','','','');");
$wx++;
}
echo '<b>Gửi tin nhắn thành công!</b><br />
Gửi <b>' .$wx. '</b> tin nhắn cho tất cả Admin!';
$type_r = 2;
}

//Отправка сообщений всем Старшим модерам и админам

elseif ($_POST['sel'] == 'smdadm') {
$coladm = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `rights`>=6;"), 0);
$asp = mysql_query("SELECT `name` FROM `users` WHERE `rights`>=6 ORDER BY `id` DESC LIMIT $coladm;");
$wx = 0;
while ($res = mysql_fetch_assoc($asp)) {
$usname = $res['name'];
if ($usname == $login) { continue; } 
mysql_query("INSERT INTO `privat` VALUES(0,'" .$usname. "','" .$soob. "','" .$realtime. "','BOT(May Chem Tu Dong)','in','no','Thống báo từ BQT','0','','','','');");
$wx++;
}
echo '<b>Gửi tin nhắn thành công!</b><br />
Gửi <b>' .$wx. '</b> tin nhắn cho tất cả Sadmin trở lên!';
$type_r = 3;
}

//Отправка сообщений всем парням
if ($_POST['sel'] == 'm') {
$colm = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `sex`='m';"), 0);
$asp = mysql_query("SELECT `name` FROM `users` WHERE `sex`='m' ORDER BY `id` DESC LIMIT $colm;");
$wx = 0;
while ($res = mysql_fetch_assoc($asp)) {
$usname = $res['name'];
if ($usname == $login) { continue; } 
mysql_query("INSERT INTO `privat` VALUES(0,'" .$usname. "','" .$soob. "','" .$realtime. "','BOT(May Chem Tu Dong)','in','no','Thống báo từ BQT','0','','','','');");
$wx++;
}
echo '<b>Gửi tin nhắn thành công!</b><br />
Gửi <b>' .$wx. '</b> tin nhắn cho tất cả các thành viên nam!'; 
$type_r = 4;
}

//Отправка сообщении всем девушкам на сайте :)
elseif ($_POST['sel'] == 'zh') {
$colzh = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `sex`='zh';"), 0);
$asp = mysql_query("SELECT `name` FROM `users` WHERE `sex`='zh' ORDER BY `id` DESC LIMIT $colzh;");
$wx = 0;
while ($res = mysql_fetch_assoc($asp)) {
$usname = $res['name'];
if ($usname == $login) { continue; } 
mysql_query("INSERT INTO `privat` VALUES(0,'" .$usname. "','" .$soob. "','" .$realtime. "','BOT(May Chem Tu Dong)','in','no','Thống báo từ BQT','0','','','','');");
$wx++;
}
echo '<b>Gửi tin nhắn thành công!</b><br />
Gửi <b>' .$wx. '</b> tin nhắn cho tất cả các thành viên nử!';
$type_r = 5;
}
echo '<br /></div><div class="menu">&raquo; <a href="email_panel.php">Quay lại</a><br />&raquo; <a href="email_panel.php?act=stat">Thống kê tin nhắn</a></div>';
//Запись статистики
mysql_query("INSERT INTO `rass_stat` SET
`time`='" .$realtime. "',
`user_id`='" .$user_id. "',
`type`='" .$type_r."',
`mess`='" .$soob. "';");
break;

case 'stat':
$colmes = mysql_result(mysql_query("SELECT COUNT(*) FROM `rass_stat`;"), 0);
echo '<div class="phdr"><b>Thống kê</b></div>';
echo '<div class="menu">Tổng thư đã gửi: (<span class="red" style="font-weight:bold;">' .$colmes. '</span>)</div>';
echo '<div class="rmenu">Tin nhắn mới nhất</div>';
if ($colmes == 0) {
echo '<div class="c"><p>Không có tin nhắn!</p>&raquo; <a href="email_panel.php">Quay lại</a></div>';
require_once ("incfiles/end.php");
exit;
}
$az = mysql_query("SELECT * FROM `rass_stat` ORDER BY `id` DESC LIMIT " .$start. ", " .$kmess. ";");
while ($ss = mysql_fetch_assoc($az)) {
echo ($i % 2) ? '<div class="c">' : '<div class="b">';
$idu = $ss['user_id'];
$ps = mysql_result(mysql_query("SELECT `name` FROM `users` WHERE `id`='" .$idu. "' LIMIT 1;"), 0);
echo 'Người gửi: <b><a href="' .$home. '/str/anketa.php?id=' .$idu. '">' .$ps. '</a></b> ';
$col_p = mysql_result(mysql_query("SELECT COUNT(*) FROM `rass_stat` WHERE `user_id`='" .$idu. "';"), 0);
echo '[' .$col_p. ']<br />';
echo 'Ngày: <span class="green">' .date("d.m.y H:i", $ss['time']). '</span><br />';
echo 'Loại: <b>';
switch($ss['type']) {
case '1':
echo 'Tất cả';
break;
case '2':
echo 'Tất cả Admin';
break;
case '3':
echo 'Tất cả Sadmin trở lên';
break;
case '4':
echo 'Tất cả thành viên nam';
break;
case '5':
echo 'Tất cả thành viên nử';
break;
}
echo '</b><br />';
echo "Nội dung: " .$ss['mess']. "<br /></div>";
$i++;
}
if ($colmes > $kmess) {
    echo '<div class="menu">'.pagenav('?act=stat&amp;', $start, $colmes, $kmess) . '</div>';
}
echo '<a href="/email_panel.php?">Quay lại</a></div>';
break;
}
echo '<div class="phdr">&raquo; <a href="/panel/index.php?">Admin panel</a></div>';
require_once ("incfiles/end.php");
?>