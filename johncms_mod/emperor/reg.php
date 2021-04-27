<?php
###########################
#  Данная версия скрипта принадлежит       # 
#       LiraS aka Артур Лукин Иванович          #
#   Вносить свои изменения крайне               #
#                 запрещенно!                                    #
###########################
include("db.php");
include "cfg.php";
$set['title']='Регистрация'; 
head();
title ();
function first()
{
if (isset($_GET['site']) && isset($_GET['name'])){
echo "<form action=\"reg.php?site=$_GET[site]&amp;name=$_GET[name]&amp;id=rega\" method=\"post\">";
}
else
{
echo "<form action=\"reg.php?id=rega\" method=\"post\">";
}
echo "<div class=\"main\">Имя Императора:<br/>";
echo "<input type=\"text\" name=\"nick\" maxlength=\"30\"/><br/>";
echo "Пароль:<br/>";
echo "<input type=\"password\" name=\"pass\" maxlength=\"30\"/><br/>";
echo "Пароль(повторите):<br/>";
echo "<input type=\"password\" name=\"repass\" maxlength=\"30\"/><br/>";
echo "E-mail(вводится один раз!):<br/>";
echo "<input type=\"text\" name=\"email\"><br/>";
echo "<input type=\"submit\" value=\"Регистрация\" class=\"ibutton\"><br/>";
echo "--------";
if (isset($_GET['site']) && isset($_GET['name']))
{
echo "<br/><a href=\"index.php?site=$_GET[site]&amp;name=$_GET[name]\">На главную</a>";
} else {
echo "<br/><a href=\"index.php\">На главную</a>";
}

}

function registruoja()
{
    $pass = $_POST[pass];
	$_POST[nick] = addslashes("$_POST[nick]");
    $_POST[nick] = htmlspecialchars($_POST[nick]);
    
    $_POST[pass] = addslashes("$_POST[pass]");       
    $_POST[pass] = htmlspecialchars($_POST[pass]);

	$_POST[repass] = addslashes("$_POST[repass]");
    $_POST[repass] = htmlspecialchars($_POST[repass]);
    
    $_POST[email] = addslashes("$_POST[email]");       
    $_POST[email] = htmlspecialchars($_POST[email]);
	
$tkr = mysql_num_rows(mysql_query("SELECT usr FROM war WHERE usr = '$_POST[nick]'"));

if (ereg_replace("[A-za-z0-9]+", "", $_POST[nick]) || ereg_replace("[A-za-z0-9]+", "", $_POST[pass]) || ereg_replace("[A-za-z0-9]+", "", $_POST[repass]))
{
echo "<div class=\"main\">";
echo "Используете неразрешимые символы!!<br/>";
echo "-------<br/>";
if (isset($_GET['site']) && isset($_GET['name']))
{
echo "<a href=\"reg.php?site=$_GET[site]&amp;name=$_GET[name]\">Quay lại</a>";
}

else{
echo "<a href=\"reg.php\">Quay lại</a>";
}
}
elseif (ereg("/[0-9a-z_]+@[0-9a-z_^\.]", "", $_POST[email]))
{
echo "<div class=\"main\">";
echo "Не правильно введен e-mail!<br/>";
echo "-------<br/>";
if (isset($_GET['site']) && isset($_GET['name']))
{
echo "<a href=\"reg.php?site=$_GET[site]&amp;name=$_GET[name]\">Quay lại</a>";
}
else{
echo "<a href=\"reg.php\">Quay lại</a>";
}
}
elseif (($tkr < 1) && ($_POST[nick] != "") && ($_POST[pass] != "") && ($_POST[repass] != "") && ($_POST[pass] == $_POST[repass]))
{
$text = "Поздравляем!\n Вы успешно зарегистрировалисьв онлайн игре GaMe!\n Ваши данные:\n Император: $_POST[nick] \n Пароль: $_POST[pass] \n
--------\n С уважением Администрация игры GaMe";
$subject="Регистрация в онлайн игре!";
$text= iconv('utf-8', 'windows-1251', $text);;
$subject= iconv('utf-8', 'windows-1251', $subject);
$headers = "MIME-Version: 1.0\r\n"."Content-type: text/plain; charset=Windows-1251\r\nFrom: no-reply@GaMe.ru\r\nReply-To: no_reply@GaMe.ru\r\nX-Mailer: PHP/".phpversion();
@mail(email, $subject, $text, $headers);
$_POST[pass] = md5($_POST[pass]);
mysql_query("INSERT INTO war SET usr = '$_POST[nick]', pwd = '$_POST[pass]', email = '$_POST[email]', pinigai = '100', darbininkai = '20', namai = '2', plotas = '100'");
echo "<div class=\"main\">";
echo "Поздравляем, вы успешно зарегистрировались в игре!<br/>";
echo "-------<br/>";
echo "<a href=\"index.php\">Пройти к авторизации</a>";
}
elseif($_POST[nick] == "")
{
echo "<div class=\"main\">";
echo "Вы оставили пустое поле!<br/>";
echo "-------<br/>";
if (isset($_GET['site']) && isset($_GET['name']))
{
echo "<a href=\"reg.php?site=$_GET[site]&amp;name=$_GET[name]\">Quay lại</a>";
}
else{
echo "<a href=\"reg.php\">Quay lại</a>";
}
}
elseif($_POST[pass] == "")
{
echo "<div class=\"main\">";
echo "Вы оставили пустое поле!<br/>";
echo "-------<br/>";
if (isset($_GET['site']) && isset($_GET['name']))
{
echo "<a href=\"reg.php?site=$_GET[site]&amp;name=$_GET[name]\">Quay lại</a>";
}
else{
echo "<a href=\"reg.php\">Quay lại</a>";
}
}
elseif($_POST[repass] == "")
{
echo "<div class=\"main\">";
echo "Вы оставили пустое поле<br/>";
echo "-------<br/>";
if (isset($_GET['site']) && isset($_GET['name']))
{
echo "<a href=\"reg.php?site=$_GET[site]&amp;name=$_GET[name]\">Quay lại</a>";
}
else{
echo "<a href=\"reg.php\">Quay lại</a>";
}
}
elseif($_POST[pass] != $_POST[repass])
{
echo "<div class=\"main\">";
echo "Пароли не совпадают!<br/>";
echo "-------<br/>";
if (isset($_GET['site']) && isset($_GET['name']))
{
echo "<a href=\"reg.php?site=$_GET[site]&amp;name=$_GET[name]\">Quay lại</a>";
}
else{
echo "<a href=\"reg.php\">Quay lại</a>";
}
}
elseif($tkr > 0)
{
echo "<div class=\"main\">";
echo "Такой ник уже есть!<br/>";
echo "-------<br/>";
if (isset($_GET['site']) && isset($_GET['name']))
{
echo "<a href=\"reg.php?site=$_GET[site]&amp;name=$_GET[name]\">Quay lại</a>";
}
else{
echo "<a href=\"reg.php\">Quay lại</a>";
}
}
}
$db_connection = mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_table, $db_connection);
mysql_query('set charset utf-8'); 
mysql_query('SET NAMES utf-8'); 
mysql_query('set character_set_client="utf-8"'); 
mysql_query('set character_set_connection="utf-8"'); 
mysql_query('set character_set_result="utf-8"');
if($_GET[id] == "")
{first();}
elseif($_GET[id] == "rega")
{registruoja();}

mysql_close($db_connection);

foot();
?>
