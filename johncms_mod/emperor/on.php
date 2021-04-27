<?php
###########################
#  Данная версия скрипта принадлежит       # 
#       LiraS aka Артур Лукин Иванович          #
#   Вносить свои изменения крайне               #
#                 запрещенно!                                    #
###########################
include "db.php";
$db_connection = mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_table, $db_connection);
$laikas = 600;
$dabar = time();
$timeout = $dabar - $laikas;

$kas = $_GET[usr];

mysql_query("DELETE FROM online WHERE laikas<$timeout");
$yra = mysql_num_rows(mysql_query("SELECT usr, pwd FROM war WHERE usr = '$_GET[usr]' AND pwd = '$_GET[pwd]'"));
if($yra == 1)
{
$ar_yra = mysql_num_rows(mysql_query("SELECT usr FROM online WHERE usr = '$kas'"));
if ($ar_yra == 0)
{
mysql_query("INSERT INTO online SET usr = '$kas', laikas = '$dabar'");
}
elseif($ar_yra > 0)
{
mysql_query("UPDATE online SET laikas = '$dabar' WHERE usr = '$kas'");
}
}
else
{}
mysql_close($db_connection);
?>
