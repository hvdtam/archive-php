<?php
###########################
#  Данная версия скрипта принадлежит       # 
#       LiraS aka Артур Лукин Иванович          #
#   Вносить свои изменения крайне               #
#                 запрещенно!                                    #
###########################
include("db.php");
include "cfg.php";
$set['title']='GaMe - Вход'; 
head();
title ();
function prisijungia()
{
$_POST[pwd] = md5($_POST['pwd']);
$tkr = mysql_num_rows(mysql_query("SELECT usr, pwd FROM war WHERE usr = '$_POST[usr]' AND pwd = '$_POST[pwd]'"));

if ($tkr == 1 && $_POST[usr] != "" && $_POST[pwd] != "")
{
echo "<div class=\"main\">";
echo "Добро пожаловать в игру $_POST[usr]<br/>";
if (isset($_GET['site']) && isset($_GET['name']))
{
echo "<a href=\"game.php?usr=$_POST[usr]&amp;pwd=$_POST[pwd]&amp;site=$_GET[site]&amp;name=$_GET[name]\">Продолжить>></a><br/>";
}
else{
echo "<a href=\"game.php?usr=$_POST[usr]&amp;pwd=$_POST[pwd]\">Продолжить>></a><br/>";
}
echo "<br/>";
}
elseif($_POST[usr] == "" || $_POST[pwd] == "")
{
echo "<div class=\"main\">";
echo "Одно или все поля пусты.<br/>";
echo "<a href=\"index.php\">Quay lại</a><br/>";
echo "<br/>";
}
elseif($tkr != 1)
{
echo "<div class=\"main\">";
echo "Неправильные данные!<br/>";
echo "<a href=\"index.php\">Quay lại</a><br/>";
echo "<br/>";
}
else
{
echo "<div class=\"main\">";
echo "Ошибка!!<br/>";
echo "<a href=\"index.php\">Quay lại</a><br/>";
echo "<br/>";
}
}

$db_connection = mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_table, $db_connection);
mysql_query('set charset utf-8'); 
mysql_query('SET NAMES utf-8'); 
mysql_query('set character_set_client="utf-8"'); 
mysql_query('set character_set_connection="utf-8"'); 
mysql_query('set character_set_result="utf-8"');
if($_GET[id] == "go_in")
{prisijungia();}

mysql_close($db_connection);

foot();
?>
