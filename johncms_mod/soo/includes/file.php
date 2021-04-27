<?php

/*
WMR: R118530587041
ICQ: 365848916
Автор: VladiSs
Сайт: http://wapnex.ru
*/

defined('_IN_JOHNCMS') or die('Error: restricted access');
$error = false;
if ($id) {
    /*
    -----------------------------------------------------------------
    Скачивание прикрепленного файла Форума
    -----------------------------------------------------------------
    */
    $req = mysql_query("SELECT * FROM `soo_forum_files` WHERE `id` = '$id'");
    if (mysql_num_rows($req)) {
        $res = mysql_fetch_array($req);
        if (file_exists('../files/soo/forum/attach/' . $res['filename'])) {
            $dlcount = $res['dlcount'] + 1;
            mysql_query("UPDATE `soo_forum_files` SET  `dlcount` = '$dlcount' WHERE `id` = '$id'");
            header('location: ../files/soo/forum/attach/' . $res['filename']);
        } else {
            $error = true;
        }
    } else {
        $error = true;
    }
    if ($error) {
        require('../incfiles/head.php');
        echo functions::display_error($lng['error_file_not_exist'], '<a href="../soo/?mod=forum">' . $lng['to_forum'] . '</a>');
        require('../incfiles/end.php');
        exit;
    }
} else {
    header('location: ../soo/?mod=forum');
}
?>