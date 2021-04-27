<?php
###########################
#  Данная версия скрипта принадлежит       # 
#       LiraS aka Артур Лукин Иванович          #
#   Вносить свои изменения крайне               #
#                 запрещенно!                                    #
###########################
include("db.php"); // Подключение базы, тупо но работает!
include "cfg.php"; // Конфигурация игры:) Что нужно то есть)
$set['title']='Почта'; 
head();
title ();
// главное меню сообщений
function main()
{
echo "<div class=\"main\">"; pochta();
//Добавить в конты
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=add_conts\">Thêm vào địa chỉ liên lạc!</a><br/>";
// Написать челу:)
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=write_message\">Để lại tin nhắn</a><br/>";
// Прочитать сообщения
$q = mysql_query("SELECT COUNT(*) FROM `msg_r` WHERE `user_to` = '$_GET[usr]' AND `read` = '1';");
$new_mail = mysql_result($q, 0);
$w = mysql_query("SELECT COUNT(*) FROM `msg_r` WHERE `user_to` = '$_GET[usr]' AND `read` = '0';");
$old_mail = mysql_result($w, 0);
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=read\">Gửi tin nhắn</a>[$new_mail/$old_mail]<br/>";
echo "------------<br/>";
echo "<a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Quay lại</a>";
}
// Поиск контакта
function add_contact()
{
echo "<div class=\"main\">"; pochta();
echo "Ai làm bạn muốn thêm vào địa chỉ liên lạc:";
echo "<form action=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=save_conts\" method=\"post\">Tên của Hoàng Đế:<br/>";
echo "<input type=\"text\" name=\"nick\"><br/>";
echo "<input type=\"submit\" value=\"Искать\" class=\"ibutton\"></form>";
echo "----------<br/>";
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Quay lại</a>";
}
// пишем челу сообщение
function write()
{
echo "<div class=\"main\">"; pochta();
echo "<form method=\"post\" action=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=save_message\">Ai:";
echo "&nbsp;&nbsp;<select name=\"to\">";
$using = mysql_query("SELECT id FROM `war` WHERE `usr` = '$_GET[usr]'");
$u2 = mysql_fetch_array($using);
$result = mysql_result(mysql_query("SELECT COUNT(*) FROM `war`"),0);
$whiel = mysql_query("SELECT contact FROM `msg_users` WHERE `user_id` = '$u2[id]'");
$lists = mysql_fetch_array($whiel);
do{
$lists[contact] = iconv("windows-1251","utf-8",$lists[contact]);
printf("<option value=\"%s\">%s</option><br/>",$lists[contact],$lists[contact]);
} while($lists = mysql_fetch_array($whiel));
echo "</select><br/>";
echo "Thông báo:<br/>";
echo "<textarea name=\"text\" rows=5 cols=15 wrap=\"off\"></textarea><br/><br/>";
echo "<input type=\"submit\" value=\"Gửi\" class=\"ibutton\"></form>";
echo "---------<br/><a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Trang chủ</a>";
}

/*
Проверка данных написанных пользователем!
Сохраняем сообщение в базе
*/
function saving_message ()
{
// Проверка вводимых символов!
if ($_POST[text] != "" && $_POST[to] != "")
{
// Если все норм сохраняем в базе!
// Чтобы злоумышленик херней не страдал!
if (isset($_POST[text]))
{
$text = htmlspecialchars(stripslashes($_POST[text]));
}
if (isset($_POST[to]))
{
$to = $_POST[to];
}
$time = date("H:i d.m.y");
$text = iconv("utf-8","windows-1251",$text);
mysql_query("INSERT INTO `msg_r` SET `user_from` = '$_GET[usr]', `user_to` = '$to', `time` = '$time', `read` = 1, `mail_msg` = '$text'");
echo "<div class=\"main\">"; pochta();
echo "Bạn đã gửi một bức thư cho $to<br/> Ngày gửi: $time";
echo "<br/>---------<br/>";
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=write_message\">Quay lại</a><br/><a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Trang chủ</a>";
}
// Ну а если нет то бежим сюда!
elseif ($_POST[text] == "" ||  $_POST[text] == null )
{
echo "<div class=\"main\">"; pochta();
echo "Bạn chưa nhập thông điệp";
echo "<br/>---------<br/>";
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=write_message\">Quay lại</a><br/><a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Trang chủ</a>";
}
elseif ($_POST[to] == "" || $_POST[to] == null)
{
echo "<div class=\"main\">"; pochta();
echo "Không chọn người gửi!";
echo "<br/>---------<br/>";
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=write_message\"></a><br/><a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Trang chủ<
}
else 
{
echo "<div class=\"main\">"; pochta();
echo "LỔI!!!";
echo "<br/>---------<br/>";
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=write_message\">Quay lại</a><br/><a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Trang chủ</a>";
}
}

// Чтение сообщения
function read_message()
{
$result = mysql_result(mysql_query("SELECT COUNT(*) FROM `msg_r` WHERE user_to = '$_GET[usr]'"),0);
if ($result == 0)
{
echo "<div class=\"main\">";
echo "Không có!<br/>";
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=add_conts\">Thêm vào địa chỉ liên lạc!</a><br/>";
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=write_message\">Написать сообщение</a><br/>";
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">НазQuay lạiад</a>";
}
else {
$times = date("H:i");
echo "<div class=\"main\"><center>-=$times=-</center>";
if ($_GET[page] == "" || $_GET[page] < 0 || $_GET[page] == "0") 
{
$_GET[page] = 0;
}
$next = $_GET[page] + 1;
$back = $_GET[page] - 1;
$num = $_GET[page] * 5;
if($_GET[page] == "0")
{$i = 0;}
else{$i = ($_GET[page]*5)+1;}
$viso = mysql_num_rows(mysql_query("SELECT komentaras FROM komentarai"));
$puslap = floor($viso/5);
$message = mysql_query("SELECT * FROM msg_r WHERE user_to = '$_GET[usr]'  ORDER BY id DESC LIMIT $num,5");
while($msg = mysql_fetch_array($message))
{
if ($msg[read] == 1)
{
mysql_query("UPDATE `msg_r` SET `read` = 0 WHERE `user_to` = '$_GET[usr]'");
}
if ($msg[read] == 1)
{
$read = "не прочитано";
} else
{
$read = "прочитано";
}
$text = iconv("windows-1251","utf-8",$msg[mail_msg]);
$text = strip_tags($text);
$from = strip_tags($msg['user_from']);
echo "<b>От кого:</b>$from [$read]<br/><b>Дата Добавления</b>: <small>$msg[time]</small><br/><b>Сообщение</b>: $text
<br/><a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;user=$from&amp;id=answer\">Ответить</a>|<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;iden=$msg[id]&amp;id=delete_mess\">Удалить</a>
<br/>-------------<br/>";
} 
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=delete_all\">Удалить все сообщения!</a><br/>";
if ($_GET[page] > 0)
{
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=read&amp;page=$back\">back</a>";
}
elseif ($_GET[page] == 0)
{
echo "back";
}
echo"|";
if($_GET[page] < $puslap || $_GET[page] == "" || $_GET[page] == 0)
{echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=read&amp;page=$next\">next</a><br/>";}
else
{echo "next<br/>";}
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
}

//  Delete all messages!
function delete_all_message()
{
mysql_query("DELETE FROM msg_r WHERE (user_to='$_GET[usr]')") or die("Сука не пашет!");
echo"<div class=\"main\">";
echo"Tất cả bài viết đã được gỡ bỏ thành công!<br/>";
echo"<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=read\">Trong thông điệp</a><br/>\n";
}

// Отвечаем на сообщение
function answer_user()
{
if (isset($_GET[user]))
{
echo "<div class=\"main\">"; pochta();
echo "<form method=\"post\" action=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=send_message\">Кому: $_GET[user]<br/>";
echo "Thông báo:<br/>";
echo "<input type=\"hidden\" name=\"to\" value=\"$_GET[user]\">";
echo "<textarea name=\"text\" rows=5 cols=15 wrap=\"off\"></textarea><br/><input type=\"submit\" value=\"Gửi\" class=\"ibutton\"></form><br/>";
echo "<br/>---------<br/>";
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=write_message\">Quay lại</a><br/><a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Trang chủ
}
else
{
echo "<div class=\"main\">"; pochta();
echo "LỔI!!!";
echo "<br/>---------<br/>";
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=write_message\">Quay lại</a><br/><a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Trang chủ</a>";
}
}

// Сохранение сообщения в базе!
function send_message()
{
// Если все норм сохраняем в базе!
// Чтобы злоумышленик херней не страдал!
if ($_POST[text] != "" && $_POST[to] != "")
{
echo "<div class=\"main\">"; pochta();
$time = date("H:i d.m.y");
$_POST[text] = iconv("utf-8","windows-1251",$_POST[text]);
mysql_query("INSERT INTO `msg_r` SET `user_from` = '$_GET[usr]', `user_to` = '$_POST[to]', `time` = '$time', `read` = 1, `mail_msg` = '$_POST[text]'");
echo "Вы успешно отправили письмо для $_POST[to]";
echo "<br/>---------<br/>";
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=write_message\">Quay lại</a><br/><a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Trang chủ</a>";
}
// Ну а если нет то бежим сюда!
elseif ($_POST[text] == ""){
echo "<div class=\"main\">"; pochta();
echo "Вы не ввели текст сообщения";
echo "<br/>---------<br/>";
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=write_message\">Quay lại</a><br/><a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Trang chủ</a>";
}
elseif ($_POST[to] == "" || $_POST[to] == null)
{
echo "<div class=\"main\">"; pochta();
echo "Не выбран отправитель!";
echo "<br/>---------<br/>";
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=write_message\">Quay lại</a><br/><a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Trang chủ</a>";
}
else 
{
echo "<div class=\"main\">"; pochta();
echo "LỔI!!!";
echo "<br/>---------<br/>";
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=write_message\">Quay lại</a><br/><a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Trang chủ</a>";
}
}
// Удаление сообщения!
function delete()
{
if (isset($_GET[iden]))
{
mysql_query("DELETE FROM `msg_r` WHERE `id` = '".intval($_GET['iden'])."' LIMIT 1");
mysql_query("OPTIMIZE TABLE `msg_r`");
echo "<div class=\"main\">"; pochta();
echo "Вы успешно удалили сообщение!";
echo "<br/>---------<br/>";
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=read\">Quay lại</a><br/><a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Trang chủ</a>";
} else
{
echo "<div class=\"main\">"; pochta();
echo "LỔI!";
echo "<br/>---------<br/>";
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=read\">Quay lại</a><br/><a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Trang chủ</a>";
}
}

// Контакты которые нашел!
function save_contacts()
{
$_POST[nick] = htmlspecialchars("$_POST[nick]");
$find = mysql_num_rows(mysql_query("SELECT usr FROM war WHERE usr LIKE '%$_POST[nick]%'"));
echo "<div class=\"main\">"; pochta();
if ($_POST[nick] != "")
{
echo "<div class=\"main\">Найдено: <i>$find</i> император(ов)<br/>";

echo "<form action=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=adding\" method=\"post\">
<select name=\"user\" value=\"one\"><option name=\"one\">--Выбрать--</option>";
$useras = mysql_query("SELECT usr FROM war WHERE usr LIKE '%$_POST[nick]%'");
while ($users = mysql_fetch_array($useras))
{
$users = strip_tags($users['usr']);
echo "<option name=\"$users\">$users</option>";
}
echo "</select><br/><input type=\"submit\" value=\"Thêm vào địa chỉ liên lạc\" class=\"ibutton\"></form>";
echo "-------<br/>";
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Quay lại</a>";
}
elseif ($_POST[nick] == "") {
echo "<div class=\"main\">"; pochta();
echo "<b>Вы не ввели имя в поле!</b><br/>";
echo "-------------<br/>";
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Quay lại</a>";
}
else
{
echo "<div class=\"main\">Нет такого императора!<br/>";
echo "-------<br/>";
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
}

// Добавление контакта к себе!
function adding_contact()
{
/*
TABLE msg_users
id = auto increment
user_id = id того кого контакт
contact = имя  контакта!
time = время добавления контакта:) в дальнейшем понадобится:)
*/
$user = mysql_query("SELECT usr FROM war WHERE usr LIKE '%$_POST[user]%'");
$users = mysql_fetch_array($user);
$_POST[user] = htmlspecialchars(stripslashes($_POST[user]));
$whiel = mysql_query("SELECT id FROM war WHERE usr='$_GET[usr]' LIMIT 1");
$u = mysql_fetch_array($whiel);
$c = mysql_query("SELECT contact FROM msg_users WHERE contact LIKE '$_POST[user]' and user_id = '$u[id]' LIMIT 1");
$contacts = mysql_fetch_array($c);
$time = date("H:i d.m.y");
if ($_POST[user] == $users[usr] && $_POST[user] != $_GET[usr] && $_POST[user] != $contacts[contact]) {
mysql_query("INSERT INTO msg_users SET user_id = '$u[id]', contact = '$_POST[user]', time = '$time'");
echo "<div class=\"main\">"; pochta();
echo "<br/><B>$_POST[user] успешно добавлен в контакты!</B>";
echo "<br/>---------<br/>";
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">НазQuay lạiад</a>";
}
elseif ($_POST[user] == $_GET[usr])
{
echo "<div class=\"main\">"; pochta();
echo "<b>Себя нельзя добавить!<b>";
echo "<br/>---------<br/>";
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Quay lại</a>";
}
elseif ($_POST[user] == $contacts[contact])
{
echo "<div class=\"main\">"; pochta();
echo "<b>Такой контакт уже есть!!!<b>";
echo "<br/>---------<br/>";
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Quay lại</a>";
}
else { 
echo "<div class=\"main\">"; pochta();
echo "<b>Неразрешимое действие!<b>";
echo "<br/>---------<br/>";
echo "<a href=\"msg.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Quay lại</a>";
}
}

$db_connection = mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_table, $db_connection);
$tikr = mysql_num_rows(mysql_query("SELECT usr, pwd FROM war WHERE usr = '$_GET[usr]' AND pwd = '$_GET[pwd]'"));

if($tikr == 1)
{
if($_GET[id] == "")
{main();}
elseif ($_GET[id] == "add_conts")
{add_contact();}
elseif ($_GET[id] == "save_conts")
{save_contacts();}
elseif ($_GET[id] == "adding")
{adding_contact();}
elseif ($_GET[id] == "write_message")
{write();}
elseif ($_GET[id] == "save_message")
{saving_message();}
elseif ($_GET[id] == "read")
{read_message();}
elseif ($_GET[id] == "answer")
{answer_user();}
elseif ($_GET[id] == "send_message")
{send_message();}
elseif ($_GET[id] == "delete_mess")
{delete();}
elseif ($_GET[id] == "delete_all")
{delete_all_message();}
else
{echo "Плохо блин:))))";}
}
else
{
echo "<div class=\"main\">"; 
echo "Вы не зарегистрированны!!!<br/>";
}

mysql_close($db_connection);

foot();
?>
