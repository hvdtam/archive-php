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
    $typ = mysql_query("SELECT * FROM `soo_forum` WHERE `id` = '$id'");
    $ms = mysql_fetch_assoc($typ);
    if ($ms[type] != "t") {
        require('../incfiles/head.php');
        echo functions::display_error($lng['error_wrong_data']);
        require('../incfiles/end.php');
        exit;
    }
    if (isset($_POST['submit'])) {
        $nn = isset($_POST['nn']) ? functions::check($_POST['nn']) : false;
        if (!$nn) {
            require('../incfiles/head.php');
            echo functions::display_error($lng_forum['error_topic_name'], '<a href="../soo/?mod=forum&amp;act=ren&amp;id=' . $id . '">' . $lng['repeat'] . '</a>');
            require('../incfiles/end.php');
            exit;
        }
        // Проверяем, есть ли тема с таким же названием?
        $pt = mysql_query("SELECT * FROM `soo_forum` WHERE `type` = 't' AND `refid` = '" . $ms['refid'] . "' and text='$nn' LIMIT 1");
        if (mysql_num_rows($pt) != 0) {
            require('../incfiles/head.php');
            echo functions::display_error($lng_forum['error_topic_exists'], '<a href="../soo/?mod=forum&amp;act=ren&amp;&sid='. $sid .'&amp;id=' . $id . '">' . $lng['repeat'] . '</a>');
            require('../incfiles/end.php');
            exit;
        }
        mysql_query("update `soo_forum` set  text='" . $nn . "' where id='" . $id . "';");
        header("Location: ../soo/?mod=forum&sid=$sid&id=$id");
    } else {
        /*
        -----------------------------------------------------------------
        Переименовываем тему
        -----------------------------------------------------------------
        */
        require('../incfiles/head.php');
        echo '<div class="phdr"><a href="../soo/?mod=forum&amp;&sid='. $sid .'&amp;id=' . $id . '"><b>' . $lng['forum'] . '</b></a> | ' . $lng_forum['topic_rename'] . '</div>' .
            '<div class="menu"><form action="../soo/?mod=forum&amp;act=ren&amp;&sid='. $sid .'&amp;id=' . $id . '" method="post">' .
            '<p><h3>' . $lng_forum['topic_name'] . '</h3>' .
            '<input type="text" name="nn" value="' . $ms['text'] . '"/></p>' .
            '<p><input type="submit" name="submit" value="' . $lng['save'] . '"/></p>' .
            '</form></div>' .
            '<div class="phdr"><a href="../soo/?mod=forum&amp;&sid='. $sid .'&amp;id=' . $id . '">' . $lng['back'] . '</a></div>';
    }
} else {
    require('../incfiles/head.php');
    echo functions::display_error($lng['access_forbidden']);
}
require('../incfiles/end.php');
break;
?>
