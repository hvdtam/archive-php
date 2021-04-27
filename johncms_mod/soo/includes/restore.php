<?php

/*
WMR: R118530587041
ICQ: 365848916
Автор: VladiSs
Сайт: http://wapnex.ru
*/

defined('_IN_JOHNCMS') or die('Error: restricted access');

if (($rights != 3 && $rights < 6) || !$id) {
    header('Location: http://johncms.com?act=404');
    exit;
}
$req = mysql_query("SELECT * FROM `soo_forum` WHERE `id` = '$id' AND (`type` = 't' OR `type` = 'm')");
if (mysql_num_rows($req)) {
    $res = mysql_fetch_assoc($req);
    mysql_query("UPDATE `soo_forum` SET `close` = '0', `close_who` = '$login' WHERE `id` = '$id'");
    if ($res['type'] == 't') {
        header('Location: ../soo/?mod=forum&id=' . $id);
    } else {
        $page = ceil(mysql_result(mysql_query("SELECT COUNT(*) FROM `soo_forum` WHERE `refid` = '" . $res['refid'] . "' AND `id` " . ($set_forum['upfp'] ? ">=" : "<=") . " '" . $id . "'"), 0) / $kmess);
        header('Location: ../soo/?mod=forum&id=' . $res['refid'] . '&page=' . $page);
    }
} else {
    header('Location: ../soo/?mod=forum');
}

?>