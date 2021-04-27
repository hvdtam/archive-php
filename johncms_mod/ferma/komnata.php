<?php
define('_IN_JOHNCMS', 1);

$headmod = 'Nông trại vui vẻ';
$textl = 'Nông dân chém gió';
require_once("../incfiles/core.php");
require_once('../incfiles/head.php');
if(!$user_id)
{         $textl = 'Nông trại vui vẻ';
require_once ('../incfiles/head.php');echo ('
<div class="phdr">' .$textl.'</div>');echo ('<div class="rmenu">Game chỉ cho thành viên tham gia!</div>');

require_once ('../incfiles/end.php');
exit;
}


switch ($act) {
case 'delpost':
////////////////////////////////////////////////////////////
// Удаление отдельного поста                              //
////////////////////////////////////////////////////////////
if ($rights >= 6 && $id) {
if (isset($_GET['yes'])) {
mysql_query("DELETE FROM `ferma_guest` WHERE `id`='" . $id . "' LIMIT 1");
header("Location: komnata.php");
} else {
echo '<p>Bạn có chắc chắn xoá bài viết này?<br/>';
echo '<a href="komnata.php?act=delpost&amp;id=' . $id . '&amp;yes">Có</a> | <a href="komnata.php">Không</a></p>';
}
}
break;

case "trans":
////////////////////////////////////////////////////////////
// Справка по транслиту                                   //
////////////////////////////////////////////////////////////
include("../pages/trans.$ras_pages");
echo '<br/><br/><a href="' . htmlspecialchars(getenv("HTTP_REFERER")) . '">Quay lại</a><br/>';
break;

case 'say':
////////////////////////////////////////////////////////////
// Добавление нового поста                                //
////////////////////////////////////////////////////////////
$admset = isset($_SESSION['ga']) ? 1 : 0; // Задаем куда вставляем, в Админ клуб (1), или в Гастивуху (0)
// Принимаем и обрабатываем данные
$name = isset($_POST['name']) ? mb_substr(trim($_POST['name']), 0, 20) : '';
$msg = isset($_POST['msg']) ? mb_substr(trim($_POST['msg']), 0, 5000) : '';
$trans = isset($_POST['msgtrans']) ? 1 : 0;
$code = isset($_POST['code']) ? trim($_POST['code']) : '';
$from = $user_id ? $login : mysql_real_escape_string($name);
// Транслит сообщения
if ($trans)
$msg = trans($msg);
// Проверяем на ошибки
$error = array ();
$flood = false;
if (!$user_id && empty($_POST['name']))
$error[] = 'Вы не ввели имя';
if (empty($_POST['msg']))
$error[] = 'Вы не ввели сообщение';
if ($ban['1'] || $ban['13'])
$error[] = 'Вы не можете писать в Гостевой';
// CAPTCHA для гостей
if (!$user_id && (empty($code) || mb_strlen($code) < 4 || $code != $_SESSION['code']))
$error[] = 'Проверочный код введен неверно';
unset($_SESSION['code']);
if ($user_id) {
// Антифлуд для зарегистрированных пользователей
$flood = antiflood();
} else {
// Антифлуд для гостей
$req = mysql_query("SELECT `time` FROM `ferma_guest` WHERE `ip` = '$ipl' AND `browser` = '" . mysql_real_escape_string($agn) . "' AND `time` > '" . ($realtime - 60) . "'");
if (mysql_num_rows($req)) {
$res = mysql_fetch_assoc($req);
$flood = $realtime - $res['time'];
}
}
if ($flood)
$error = 'Bạn không thể thêm các bài viết liên tục<br />Xin vui lòng chờ ' . $flood . ' сек.';
if (!$error) {
// Проверка на одинаковые сообщения
$req = mysql_query("SELECT * FROM `ferma_guest` WHERE `user_id` = '$user_id' ORDER BY `time` DESC");
$res = mysql_fetch_array($req);
if ($res['text'] == $msg) {
header("location: komnata.php");
exit;
}
}
if (!$error) {
// Вставляем сообщение в базу
mysql_query("INSERT INTO `ferma_guest` SET
`adm` = '$admset',
`time` = '$realtime',
`user_id` = '$user_id',
`name` = '$from',
`text` = '" . mysql_real_escape_string($msg) . "',
`ip` = '$ipl',
`browser` = '" . mysql_real_escape_string($agn) . "'");
// Фиксируем время последнего поста (антиспам)
if ($user_id) {
$postguest = $datauser['postguest'] + 1;
mysql_query("UPDATE `users` SET `postguest` = '$postguest', `lastpost` = '$realtime' WHERE `id` = '$user_id'");
}
header("location: komnata.php");
} else {
echo display_error($error, '<a href="komnata.php">Tiếp tục</a>');
}
break;

case 'otvet':
////////////////////////////////////////////////////////////
// Добавление "ответа Админа"                             //
////////////////////////////////////////////////////////////
if ($rights >= 6 && $id) {
if (isset($_POST['submit'])) {
$otv = mb_substr($_POST['otv'], 0, 5000);
mysql_query("UPDATE `ferma_guest` SET
`admin` = '" . $login . "',
`otvet` = '" . mysql_real_escape_string($otv) . "',
`otime` = '" . $realtime . "'
WHERE `id` = '" . $id . "'");
header("location: komnata.php");
} else {
$ps = mysql_query("select * from `ferma_guest` where id='" . $id . "'");
$ps1 = mysql_fetch_array($ps);
if (!empty($ps1['otvet'])) {
echo "<br /><b>Cảnh báo!<br />Bài đăng này đã được trả lời.</b><br/><br/>";
}
$text = htmlentities($ps1['text'], ENT_QUOTES, 'UTF-8');
$otv = htmlentities($ps1['otvet'], ENT_QUOTES, 'UTF-8');
echo "Post chat:<br /><b>$ps1[name]:</b> $text&quot;<br/><br/><form action='komnata.php?act=otvet&amp;id=" . $id .
"' method='post'>Ответ:<br/><textarea rows='3' name='otv'>$otv</textarea><br/><input type='submit' name='submit' value='Ok!'/><br/></form><a href='komnata.php?'>Chat</a><br/>";
}
}
break;

case 'edit':
////////////////////////////////////////////////////////////
// Редактирование поста                                   //
////////////////////////////////////////////////////////////
if ($rights >= 6 && $id) {
if (isset($_POST['submit'])) {
$req = mysql_query("SELECT `edit_count` FROM `ferma_guest` WHERE `id`='" . $id . "' LIMIT 1");
$res = mysql_fetch_array($req);
$edit_count = $res['edit_count'] + 1;
$msg = mb_substr($_POST['msg'], 0, 500);
mysql_query("UPDATE `ferma_guest` SET
`text`='" . mysql_real_escape_string($msg) . "',
`edit_who`='" . $login . "',
`edit_time`='" . $realtime . "',
`edit_count`='" . $edit_count . "'
WHERE `id`='" . $id . "'");
header("location: komnata.php");
} else {
$req = mysql_query("SELECT * FROM `ferma_guest` WHERE `id` = '" . $id . "' LIMIT 1");
$res = mysql_fetch_array($req);
$text = htmlentities($res['text'], ENT_QUOTES, 'UTF-8');
echo '<div class="phdr"><b>Nông dân chém gió: sửa bài viết</div>';
echo '<div class="rmenu"><form action="komnata.php?act=edit&amp;id=' . $id . '" method="post">
<textarea rows="3" name="msg">' . $text .
'</textarea><br/>
<input type="submit" name="submit" value="Gửi"/></form></div>';
echo '<div class="phdr"><a href="index.php?act=trans">TV có dấu</a> | <a href="../str/smile.php">Smile</a></div>';
echo '<p><a href="komnata.php">Tiếp tục</a></p>';
}
}
break;

case 'clean':
////////////////////////////////////////////////////////////
// Очистка Гостевой                                       //
////////////////////////////////////////////////////////////
if ($rights >= 7) {
if (isset($_POST['submit'])) {
$adm = isset($_SESSION['ga']) ? 1 : 0;
$cl = isset($_POST['cl']) ? intval($_POST['cl']) : '';
switch ($cl) {
case '1':
// Net tin nhắn cũ hơn 1 ngày
mysql_query("DELETE FROM `ferma_guest` WHERE `adm`='$adm' AND `time` < '" . ($realtime - 86400) . "'");
echo '<p>Gỡ bỏ tất cả các tin nhắn cũ hơn 1 ngày.</p><p><a href="komnata.php">Tiếp tục</a></p>';
break;

case '2':
// Chúng tôi cung cấp đầy đủ sạch
mysql_query("DELETE FROM `ferma_guest` WHERE `adm`='$adm'");
echo '<p>Xóa tất cả các tin nhắn.</p><p><a href="komnata.php">Tiếp tục</a></p>';
break;
default :
// Net tin nhắn cũ hơn 1 tuần
mysql_query("DELETE FROM `ferma_guest` WHERE `adm`='$adm' AND `time`<='" . ($realtime - 604800) . "';");
echo '<p>Tất cả các tin nhắn cũ hơn 1 tuần ra khỏi khách.</p><p><a href="komnata.php">Tiếp tục</a></p>';
}
mysql_query("OPTIMIZE TABLE `ferma_guest`");
} else {
echo '<p><b>Xoá tin nhắn</b></p>';
echo '<u>Thế nào là sạch?</u>';
echo '<form id="clean" method="post" action="komnata.php?act=clean">';
echo '<input type="radio" name="cl" value="0" checked="checked" />Hơn 1 tuần<br />';
echo '<input type="radio" name="cl" value="1" />Cách đây 1 ngày<br />';
echo '<input type="radio" name="cl" value="2" />Rõ ràng tất cả<br />';
echo '<input type="submit" name="submit" value="Sạch" />';
echo '</form>';
echo '<p><a href="komnata.php">Huỷ</a></p>';
}
}
break;

case 'ga':
////////////////////////////////////////////////////////////
// Переключение режима работы Гостевая фермеров / Админ-клуб       //
////////////////////////////////////////////////////////////
//TODO: Убрать переключение по сессии, сделать по ссылке
if ($rights >= 1) {
if ($_GET['do'] == 'set') {
$_SESSION['ga'] = 1;
$textl = 'Админ-Клуб';
} else {
unset($_SESSION['ga']);
$textl = 'Гостевая фермеров';
}
}

default:
////////////////////////////////////////////////////////////
// Отображаем Гостевую, или Админ клуб                    //
////////////////////////////////////////////////////////////
if (!$set['mod_guest'])
echo '<p><span class="red"><b>nông dân chém gió đóng cửa!</b></span></p>';
echo '<div class="phdr"><b>Nông dân chém gió</b></div>';
// Форма ввода нового сообщения
if (($user_id || $set['mod_guest'] == 2) && !$ban['1'] && !$ban['13']) {
echo '<div class="gmenu"><form action="komnata.php?act=say" method="post">';
if (!$user_id)
echo "Tên (max. 25):<br/><input type='text' name='name' maxlength='25'/><br/>";
echo 'Chat(max. 500):<br/><textarea cols="20" rows="2" name="msg"></textarea><br/>';
if ($set_user['translit'])
echo '<input type="checkbox" name="msgtrans" value="1" /> TV có dấu<br/>';
if (!$user_id) {
// CAPTCHA для гостей
echo '<img src="../captcha.php?r=' . rand(1000, 9999) . '" alt="Mã xác minh"/><br />';
echo '<input type="text" size="5" maxlength="5"  name="code"/>&nbsp;Nhập mã số<br />';
}
echo "<input type='submit' title='Nhấn vào đây để gửi' name='submit' value='Gửi'/></form></div>";
} else {
echo '<div class="rmenu">Chỉ có thể viết khi <a href="../login.php">đăng nhập</a> làm thành viên</div>';
}
if (isset($_SESSION['ga']) && ($login == $nickadmina || $login == $nickadmina2 || $rights >= "1")) {
$req = mysql_query("SELECT COUNT(*) FROM `ferma_guest` WHERE `adm`='1'");
} else {
$req = mysql_query("SELECT COUNT(*) FROM `ferma_guest` WHERE `adm`='0'");
}
$colmes = mysql_result($req, 0); // Число сообщений в гастивухе
if ($colmes > 0) {
if (isset($_SESSION['ga']) && ($login == $nickadmina || $login == $nickadmina2 || $rights >= "1")) {
// Запрос для Админ клуба
echo '<div class="rmenu"><b>АДМИН-КЛУБ</b></div>';
$req = mysql_query("SELECT `ferma_guest`.*, `ferma_guest`.`id` AS `gid`, `users`.`rights`, `users`.`lastdate`, `users`.`sex`, `users`.`status`, `users`.`datereg`, `users`.`id`
FROM `ferma_guest` LEFT JOIN `users` ON `ferma_guest`.`user_id` = `users`.`id` WHERE `ferma_guest`.`adm`='1' ORDER BY `time` DESC LIMIT "
. $start . "," . $kmess);
} else {
// Запрос для обычной Гастивухи
$req = mysql_query("SELECT `ferma_guest`.*, `ferma_guest`.`id` AS `gid`, `users`.`rights`, `users`.`lastdate`, `users`.`sex`, `users`.`status`, `users`.`datereg`, `users`.`id`
FROM `ferma_guest` LEFT JOIN `users` ON `ferma_guest`.`user_id` = `users`.`id` WHERE `ferma_guest`.`adm`='0' ORDER BY `time` DESC LIMIT "
. $start . "," . $kmess);
}
while ($res = mysql_fetch_assoc($req)) {
$text = '';
echo $i % 2 ? '<div class="list2">' : '<div class="list1">';
if (empty($res['id'])) {
// Запрос по гостям
$req_g = mysql_query("SELECT `lastdate` FROM `cms_guests` WHERE `session_id` = '" . md5($res['ip'] . $res['browser']) . "' LIMIT 1");
$res_g = mysql_fetch_assoc($req_g);
$res['lastdate'] = $res_g['lastdate'];
}
// Время создания поста
$text = ' <span class="gray">(' . date("d.m.y / H:i", $res['time'] + $set_user['sdvig'] * 3600) . ')</span>';
if ($res['user_id']) {
// Для зарегистрированных показываем ссылки и смайлы
$post = checkout($res['text'], 1, 1);
if ($set_user['smileys'])
$post = smileys($post, $res['rights'] >= 1 ? 1 : 0);
} else {
// Для гостей обрабатываем имя и фильтруем ссылки
$res['name'] = checkout($res['name']);
$post = antilink(checkout($res['text'], 0, 2));
}
if ($res['edit_count']) {
// Если пост редактировался, показываем кем и когда
$dizm = date("d.m /H:i", $res['edit_time'] + $set_user['sdvig'] * 3600);
$post .= '<br /><span class="gray"><small>Chỉnh sửa. <b>' . $res['edit_who'] . '</b> (' . $dizm . ') <b>[' . $res['edit_count'] . ']</b></small></span>';
}
if (!empty($res['otvet'])) {
// Ответ Администрации
$otvet = checkout($res['otvet'], 1, 1);
$vrp1 = $res['otime'] + $set_user['sdvig'] * 3600;
$vr1 = date("d.m.Y / H:i", $vrp1);
if ($set_user['smileys'])
$otvet = smileys($otvet, 1);
$post .= '<div class="reply"><b>' . $res['admin'] . '</b>: (' . $vr1 . ')<br/>' . $otvet . '</div>';
}
$subtext = '<a href="komnata.php?act=otvet&amp;id=' . $res['gid'] . '">Trả lời</a>' . ($rights >= 6 && $rights >= $res['rights'] ? ' | <a href="komnata.php?act=edit&amp;id=' . $res['gid'] .
'">Chỉnh sửa</a> | <a href="komnata.php?act=delpost&amp;id=' . $res['gid'] . '">Xóa</a>' : '');
echo show_user($res, 1, ($rights >= 6 && $rights >= $res['rights'] ? 1 : 0), $text, $post, ($rights >= 6 ? $subtext : ''));
echo '</div>';
++$i;
}
echo '<div class="phdr">Tổng số: ' . $colmes . '</div>';
if ($colmes > $kmess) {
echo '<p>' . pagenav('komnata.php?', $start, $colmes, $kmess) . '</p>';
echo '<p><form action="komnata.php" method="get"><input type="text" name="page" size="2"/><input type="submit" value="Đến trang &gt;&gt;"/></form></p>';
}
echo '<p><div class="func">';
// Для Админов даем ссылку на чистку Гостевой
if ($rights >= 7)
echo '<a href="komnata.php?act=clean">Xoá chat</a><br />';
echo '</div></p>';
} else {
echo '<p>Trong bài viết khách ở đó.</p>';
}
// Ссылка на Админ-клуб
if ($rights >= 1)
echo (isset($_SESSION['ga']) ? '<p><a href="komnata.php?act=ga"><b>Nông dân chém gió &gt;&gt;</b></a></p>' : '<p></p>');
break;
}
echo ( '<div class="menu">

<a href="/ferma/index.php?">Khu nông trại</a></div>' );
require_once ('../incfiles/end.php');

?>
