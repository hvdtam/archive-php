<?php

/*
////////////////////////////////////////////////////////////////////////////////
// JohnCMS                Mobile Content Management System                    //
// Project site:          http://johncms.com                                  //
// Support site:          http://gazenwagen.com                               //
////////////////////////////////////////////////////////////////////////////////
// Lead Developer:        Oleg Kasyanov   (AlkatraZ)  alkatraz@gazenwagen.com //
// Development Team:      Eugene Ryabinin (john77)    john77@gazenwagen.com   //
//                        Dmitry Liseenko (FlySelf)   flyself@johncms.com     //
////////////////////////////////////////////////////////////////////////////////
*/

defined('_IN_JOHNCMS') or die('Error: restricted access');
$error = false;$req98=mysql_query("SELECT * FROM `users` WHERE `id` = '$user_id'");$arr98=mysql_fetch_array($req98);$req = mysql_query("SELECT * FROM `cms_forum_files` WHERE `id` = '$id'");    if (mysql_num_rows($req)) {        $res = mysql_fetch_array($req);if ($arr98['id'] == $res['id_up']) {    require('../incfiles/head.php');	    echo '<div class="rmenu">Bạn là người upload files. Bạn không thể download file </div>';    require('../incfiles/end.php');    exit;	}	}
if ($id) {
    /*
    -----------------------------------------------------------------
    Скачивание прикрепленного файла Форума
    -----------------------------------------------------------------
    */	/*$user_u = $res['user_id'];$req_u = mysql_query("SELECT * FROM `users` WHERE `id` = '$user_u' LIMIT 1");$res_u = mysql_fetch_array($req_u);*/
$req = mysql_query("SELECT * FROM `cms_forum_files` WHERE `id` = '$id'");
    if (mysql_num_rows($req)) {
        $res = mysql_fetch_array($req);		$user_id_up = $res['id_up'];$req99=mysql_query("SELECT * FROM `users` WHERE `id` = '$user_id_up'");$arr99=mysql_fetch_array($req99);$req98=mysql_query("SELECT * FROM `users` WHERE `id` = '$user_id'");$arr98=mysql_fetch_array($req98);
        if (file_exists('../files/forum/attach/' . $res['filename'])) {          			$tientru = $arr98['balans'] - $res['cost'];
            $dlcount = $res['dlcount'] + 1;            ///$user_id_up = $res['id_up'] ;			mysql_query("UPDATE `users` SET `balans`='$tientru' WHERE `id` = '$user_id'");              $tiencong = $arr99['balans'] + $res['cost'];
            mysql_query("UPDATE `cms_forum_files` SET  `dlcount` = '$dlcount' WHERE `id` = '$id'");	            mysql_query("UPDATE `users` SET  `balans` = '$tiencong' WHERE `id` = '$user_id_up'");
            header('location: ../files/forum/attach/' . $res['filename']);
        } else {
            $error = true;
        }
    } else {
        $error = true;
    }
    if ($error) {
        require('../incfiles/head.php');
        echo functions::display_error($lng['error_file_not_exist'], '<a href="index.php">' . $lng['to_forum'] . '</a>');
        require('../incfiles/end.php');
        exit;
    }
} else {
    header('location: index.php');
}
?>