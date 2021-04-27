<?php
###########################
#  Данная версия скрипта принадлежит       # 
#       LiraS aka Артур Лукин Иванович          #
#   Вносить свои изменения крайне               #
#                 запрещенно!                                    #
###########################
include("db.php");
include("on.php");
include "cfg.php";
$set['title']='Мое меню'; 
head();
title ();
function index()
{
echo "<div class=\"main\">"; pochta();
echo "<a href=\"mmenu.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=change_pwd\">Изменить пароль</a><br/>";
echo "---------<br/>";
echo "<a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">На главную</a>";
}

function keisti_pass()
{
echo "<div class=\"main\">"; pochta();
echo "<form action=\"mmenu.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=apkeisti\" method=\"post\">";
echo "Старый пароль:<br/>";
echo "<input type=\"text\" name=\"old\" maxlength=\"20\"/><br/>";
echo "Новый пароль:<br/>";
echo "<input type=\"text\" name=\"neww\" maxlength=\"20\"/><br/>";
echo "Повторите пароль:<br/>";
echo "<input type=\"text\" name=\"new_re\" maxlength=\"20\"/><br/>";
echo "<input type=\"submit\" value=\"Изменить\" class=\"ibutton\"><br/>";
echo "---------<br/>";
echo "<a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">На главную</a>";
}

function keicia_pass()
{
if (empty($_POST[old]) || empty($_POST[neww]) || empty($_POST[new_re]))
{
echo "<div class=\"main\">"; pochta();
echo "Одно из полей пустое!!!<br/>";
echo "-------<br/>";
echo "<a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">На главную</a>";}
elseif(ereg_replace("[A-za-z0-9]+", "", $_POST[old])  || ereg_replace("[A-za-z0-9]+", "", $_POST[neww]) || ereg_replace("[A-za-z0-9]+", "", $_POST[new_re]))
{
echo "<div class=\"main\">"; pochta();
echo "Используете не разрешенные символы!!!<br/>";
echo "-------<br/>";
echo "<a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">На главную</a>";
}
else
{
$_POST[old] = md5($_POST[old]);
$_POST[neww] = md5($_POST[neww]);
$_POST[new_re] = md5($_POST[new_re]);
$tikrina = mysql_num_rows(mysql_query("SELECT pwd FROM war WHERE usr= '$_GET[usr]' && pwd = '$_POST[old]'"));

if (($tikrina > 0) && ($_POST[old] != "") && ($_POST[neww] != "") && ($_POST[new_re] != "") && ($_POST[neww] == "$_POST[new_re]"))
{
mysql_query("UPDATE war SET pwd = '$_POST[neww]' WHERE usr = '$_GET[usr]'");
echo "<div class=\"main\">"; pochta();
echo "Вы успешно изменили пароль!!!<br/>";
echo "-------<br/>";
echo "<a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_POST[neww]&amp;id=\">На главную</a>";
}
elseif($_POST[neww] != $_POST[new_re])
{
echo "<div class=\"main\">"; pochta();
echo "Пароли не совпадают!<br/>";
echo "-------<br/>";
echo "<a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">На главную</a>";
}
elseif($tikrina == 0)
{
echo "<div class=\"main\">"; pochta();
echo "Старый пароль не правильный!!!<br/>";
echo "-------<br/>";
echo "<a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">На главную</a>";
}
else
{
echo "<div class=\"main\">"; pochta();
echo "Невозможно!!!<br/>";
echo "-------<br/>";
echo "<a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">На главную</a>";
}
}
}

$db_connection = mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_table, $db_connection);
$tikr = mysql_num_rows(mysql_query("SELECT usr, pwd FROM war WHERE usr = '$_GET[usr]' AND pwd = '$_GET[pwd]'"));

if($tikr == 1)
{
if($_GET[id] == "")
{index();}
elseif($_GET[id] == "change_pwd")
{keisti_pass();}
elseif($_GET[id] == "apkeisti")
{keicia_pass();}
else
{echo "Плохо блин:))))";}
}
else
{
echo "<div class=\"main\">"; pochta();
echo "Вы не зарегистрированны!!!<br/>";
echo "";
}

mysql_close($db_connection);

foot();
?>
