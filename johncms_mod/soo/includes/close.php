<?php

/*
WMR: R118530587041
ICQ: 365848916
Автор: VladiSs
Сайт: http://wapnex.ru
*/

defined('_IN_JOHNCMS') or die('Error: restricted access');
$us = mysql_fetch_array(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = ' " . $sid . " ' AND `user_id`=' " . $user_id . " '  "));
        
if (($us['rights'] < 8) || !$id) {
    header('Location: ../soo/?mod=forum&sid='.$sid.'');
    exit;
}
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `soo_forum` WHERE `id` = '$id' AND `type` = 't'"), 0)) {
    if (isset($_GET['closed']))
        mysql_query("UPDATE `soo_forum` SET `edit` = '1' WHERE `id` = '$id'");
    else
        mysql_query("UPDATE `soo_forum` SET `edit` = '0' WHERE `id` = '$id'");
}

header("Location: ../soo/?mod=forum&sid=$sid&id=$id");
require('../incfiles/end.php');
break;
?>