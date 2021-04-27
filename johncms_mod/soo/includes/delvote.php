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
    $topic_vote = mysql_result(mysql_query("SELECT COUNT(*) FROM `soo_forum_vote` WHERE `type`='1' AND `topic` = '$id'"), 0);
    require('../incfiles/head.php');
    if ($topic_vote == 0) {
        echo functions::display_error($lng['error_wrong_data']);
        require('../incfiles/end.php');
        exit;
    }
    if (isset($_GET['yes'])) {
        mysql_query("DELETE FROM `soo_forum_vote` WHERE `topic` = '$id'");
        mysql_query("DELETE FROM `soo_forum_vote_users` WHERE `topic` = '$id'");
        mysql_query("UPDATE `soo_forum` SET  `realid` = '0'  WHERE `id` = '$id'");
        echo $lng_forum['voting_deleted'] . '<br /><a href="' . $_SESSION['prd'] . '">' . $lng['continue'] . '</a>';
    } else {
        echo '<p>' . $lng_forum['voting_delete_warning'] . '</p>';
        echo '<p><a href="../soo/?mod=forum&amp;act=delvote&amp;sid='. $sid .'&amp;id=' . $id . '&amp;yes">' . $lng['delete'] . '</a><br />';
        echo '<a href="' . htmlspecialchars(getenv("HTTP_REFERER")) . '">' . $lng['cancel'] . '</a></p>';
        $_SESSION['prd'] = htmlspecialchars(getenv("HTTP_REFERER"));
    }
} else {
    header('location: ../index.php?err');
}
require('../incfiles/end.php');
break;
?>