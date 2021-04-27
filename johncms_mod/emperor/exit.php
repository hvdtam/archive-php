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
function ehit()
{
echo"<div class=\"main\">Вы успешно вышли из игры! Через пару минут ваш персонаж пропадет из игры!<br/>";
if (isset($_GET['site']) && isset($_GET['name']))
{
echo"<a href=\"index.php?site=$_GET[site]&amp;name=$_GET[name]\">На главную</a>";
}
else{
echo"<a href=\"index.php\">На главную</a>";
}
unset($_GET[usr]);
unset($_GET[pwd]);
}
$db_connection = mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_table, $db_connection);

$tikr = mysql_num_rows(mysql_query("SELECT usr, pwd FROM war WHERE usr = '$_GET[usr]' AND pwd = '$_GET[pwd]'"));

if($tikr == 1)
{
if($_GET[id] == "")
{
$set['title']='Выход из игры'; 
head();
title ();
ehit();}
}
else
{
echo "<div class=\"main\">";
echo "Вы не зарегистрированны!!!<br/>";
echo "";
}
mysql_close($db_connection);
foot();

?>