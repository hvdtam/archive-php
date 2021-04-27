<?php

/*
WMR: R118530587041
ICQ: 365848916
Автор: VladiSs
Сайт: http://wapnex.ru
*/

defined('_IN_JOHNCMS') or die('Error: restricted access');
$us = mysql_fetch_array(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = ' " . $sid . " ' AND `user_id`=' " . $user_id . " '  "));
        
if ($us['rights'] >= 8) {
    if (!$id) {
        require('../incfiles/head.php');
        echo functions::display_error($lng['error_wrong_data']);
        require('../incfiles/end.php');
        exit;
    }
    $typ = mysql_query("SELECT * FROM `soo_forum` WHERE `id` = '$id' AND `type` = 't'");
    if (!mysql_num_rows($typ)) {
        require('../incfiles/head.php');
        echo functions::display_error($lng['error_wrong_data']);
        require('../incfiles/end.php');
        exit;
    }
    if (isset($_POST['submit'])) {
        $razd = isset($_POST['razd']) ? abs(intval($_POST['razd'])) : false;
        if (!$razd) {
            require('../incfiles/head.php');
            echo functions::display_error($lng['error_wrong_data']);
            require('../incfiles/end.php');
            exit;
        }
        $typ1 = mysql_query("SELECT * FROM `soo_forum` WHERE `id` = '$razd' AND `type` = 'r'");
        if (!mysql_num_rows($typ1)) {
            require('../incfiles/head.php');
            echo functions::display_error($lng['error_wrong_data']);
            require('../incfiles/end.php');
            exit;
        }
        mysql_query("UPDATE `soo_forum` SET
            `refid` = '$razd'
            WHERE `id` = '$id'
        ");
        header("Location: ../soo/?mod=forum&sid=$sid&id=$id");
    } else {
        /*
        -----------------------------------------------------------------
        Перенос темы
        -----------------------------------------------------------------
        */
        $ms = mysql_fetch_assoc($typ);
        require('../incfiles/head.php');
        if (empty($_GET['other'])) {
            $rz = mysql_query("select * from `soo_forum` where id='" . $ms['refid'] . "';");
            $rz1 = mysql_fetch_assoc($rz);
            $other = $rz1['refid'];
        } else {
            $other = intval(functions::check($_GET['other']));
        }
        $fr = mysql_query("select * from `soo_forum` where id='" . $other . "';");
        $fr1 = mysql_fetch_assoc($fr);
        echo '<div class="phdr"><a href="../soo/?mod=forum&amp;sid='. $sid .'&amp;id=' . $id . '"><b>' . $lng['forum'] . '</b></a> | ' . $lng_forum['topic_move'] . '</div>' .
            '<form action="../soo/?mod=forum&amp;act=per&amp;sid='. $sid .'&amp;id=' . $id . '" method="post">' .
            '<div class="gmenu"><p>' .
            '<h3>' . $lng['category'] . '</h3>' . $fr1['text'] . '</p>' .
            '<p><h3>' . $lng['section'] . '</h3>' .
            '<select name="razd">';
        $raz = mysql_query("SELECT * FROM `soo_forum` WHERE `refid` = '$other' AND `type` = 'r' AND `id` != '" . $ms['refid'] . "' ORDER BY `realid` ASC");
        while ($raz1 = mysql_fetch_assoc($raz)) {
            echo '<option value="' . $raz1['id'] . '">' . $raz1['text'] . '</option>';
        }
        echo '</select></p>' .
            '<p><input type="submit" name="submit" value="' . $lng['move'] . '"/></p>' .
            '</div></form>';
        $frm = mysql_query("SELECT * FROM `soo_forum` WHERE `type` = 'f' AND `id` != '$other' ORDER BY `realid` ASC");

        echo '<div class="phdr"><a href="../soo/?mod=forum&amp;sid='. $sid .'&amp;id='. $id .'">' . $lng['back'] . '</a></div>';
    }
} else {
    require('../incfiles/head.php');
    echo functions::display_error($lng['access_forbidden']);
}
require('../incfiles/end.php');
break;
?>