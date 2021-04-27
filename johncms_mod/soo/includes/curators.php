<?php

/*
WMR: R118530587041
ICQ: 365848916
Автор: VladiSs
Сайт: http://wapnex.ru
*/

defined('_IN_JOHNCMS') or die('Error: restricted access');

require('../incfiles/head.php');

$us = mysql_fetch_array(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = ' " . $sid . " ' AND `user_id`=' " . $user_id . " '  "));
                if ($us['rights'] >= 8) {
    $req = mysql_query("SELECT * FROM `soo_forum` WHERE `id` = '$id' AND `type` = 't'");
    if (!mysql_num_rows($req) || $us['rights'] < 8) {
        echo functions::display_error($lng_forum['error_topic_deleted']);
        require('../incfiles/end.php');
        exit;
    }
    $topic = mysql_fetch_assoc($req);
    $req = mysql_query("SELECT `soo_forum`.*, `users`.`id`
        FROM `soo_forum` LEFT JOIN `users` ON `soo_forum`.`user_id` = `users`.`id`
        WHERE `soo_forum`.`refid`='$id' AND `users`.`rights` < 6 AND `users`.`rights` != 3 GROUP BY `soo_forum`.`from` ORDER BY `soo_forum`.`from`");
    $total = mysql_num_rows($req);
    echo '<div class="phdr"><a href="../soo/?mod=forum&amp;sid='. $sid .'&amp;id=' . $id . '&amp;start=' . $start . '"><b>' . $lng['forum'] . '</b></a> | ' . $lng_forum['curators'] . '</div>' .
         '<div class="bmenu">' . $res['text'] . '</div>';
    $curators = array();
    $users = !empty($topic['curators']) ? unserialize($topic['curators']) : array();
    if (isset($_POST['submit'])) {
        $users = isset($_POST['users']) ? $_POST['users'] : array();
        if (!is_array($users)) $users = array();
    }
    if ($total > 0) {
        echo '<form action="../soo/?mod=forum&amp;act=curators&amp;sid='. $sid .'&amp;id=' . $id . '&amp;start=' . $start . '" method="post">';
        $i = 0;
        while ($res = mysql_fetch_array($req)) {
            $checked = array_key_exists($res['user_id'], $users) ? true : false;
            if ($checked) $curators[$res['user_id']] = $res['from'];
            echo ($i++ % 2 ? '<div class="list2">' : '<div class="list1">') .
                 '<input type="checkbox" name="users[' . $res['user_id'] . ']" value="' . $res['from'] . '"' . ($checked ? ' checked="checked"' : '') . '/>&#160;' .
                 '<a href="../users/profile.php?user=' . $res['user_id'] . '">' . $res['from'] . '</a></div>';
        }
        echo '<div class="gmenu"><input type="submit" value="' . $lng_forum['assign'] . '" name="submit" /></div></form>';
        if (isset($_POST['submit'])) mysql_query("UPDATE `soo_forum` SET `curators`='" . mysql_real_escape_string(serialize($curators)) . "' WHERE `id` = '$id'");

    } else
        echo functions::display_error($lng['list_empty']);
    echo '<div class="phdr">' . $lng['total'] . ': ' . $total . '</div>' .
         '<p><a href="../soo/?mod=forum&amp;sid='. $sid .'&amp;id=' . $id . '&amp;start=' . $start . '">' . $lng['back'] . '</a></p>';
}
require('../incfiles/end.php');
break;