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
$set['title']='Библиотека'; 
head();
title ();
function main()
{
echo"<div class=\"main\">"; pochta();
$result = mysql_result(mysql_query("SELECT COUNT(*) FROM `library`"),0);
$whiel = mysql_query("SELECT id, title FROM `library`");
$lists = mysql_fetch_array($whiel);
if ($result == 0)
{ echo "--Статей нет--"; }
else{
do{
$lists[title] = iconv("windows-1251","utf-8",$lists[title]);
printf("<a href=\"library.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=%s&amp;lb=list_library\">%s</a><br/>",$lists[id],$lists[title]);
} while($lists = mysql_fetch_array($whiel));
}
echo"<br/>-----<br/>";
echo"<a href=\"game.php?usr=$_GET[usr]&pwd=$_GET[pwd]\">Quay lại</a>";
}
function library_info()
{
$whiel = mysql_query("SELECT * FROM library WHERE id='$_GET[id]'");
$lists = mysql_fetch_array($whiel);
$lists[title] = iconv("windows-1251","utf-8",$lists[title]);
$lists[text] = iconv("windows-1251","utf-8",$lists[text]);
$lists[author] = iconv("windows-1251","utf-8",$lists[author]);
echo "<div class=\"main\">"; pochta();
echo "Название: <b>$lists[title]</b><br/><small>Дата добавления: <b>$lists[time]</b></small><br/>";
echo "------------<br/>";
echo "$lists[text]<br/>Автор: <b>$lists[author]</b><br/>---------<br/>";
echo "<a href=\"library.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Quay lại</a><br/>";
echo "<a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">На главную</a>";
}

$db_connection = mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_table, $db_connection);

$tikr = mysql_num_rows(mysql_query("SELECT usr, pwd FROM war WHERE usr = '$_GET[usr]' AND pwd = '$_GET[pwd]'"));

if($tikr == 1)
{
if($_GET[lb] == "")
{main();}
elseif($_GET[lb] == "list_library")
{library_info();}
}
else
{
echo "<div class=\"main\">"; pochta();
echo "Вы не зарегистрированны!!!<br/>";
echo "<br/>";
}
mysql_close($db_connection);
foot();
?>
