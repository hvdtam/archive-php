<?php

/*
WMR: R118530587041
ICQ: 365848916
Автор: VladiSs
Сайт: http://wapnex.ru
*/

defined('_IN_JOHNCMS') or die('Error: restricted access');
require('../incfiles/head.php');
$topic_vote = mysql_result(mysql_query("SELECT COUNT(*) FROM `soo_forum_vote` WHERE `type` = '1' AND `topic` = '$id'"), 0);
if ($topic_vote == 0) {
    echo functions::display_error($lng['error_wrong_data']);
    require('../incfiles/end.php');
    exit;
} else {
    $topic_vote = mysql_fetch_array(mysql_query("SELECT `name`, `time`, `count` FROM `soo_forum_vote` WHERE `type` = '1' AND `topic` = '$id' LIMIT 1"));
    echo '<div  class="phdr">' . $lng_forum['voting_users'] . ' &laquo;<b>' . htmlentities($topic_vote['name'], ENT_QUOTES, 'UTF-8') . '</b>&raquo;</div>';
    $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `soo_forum_vote_users` WHERE `topic`='$id'"), 0);
    $req = mysql_query("SELECT `soo_forum_vote_users`.*, `users`.`rights`, `users`.`lastdate`, `users`.`name`, `users`.`sex`, `users`.`status`, `users`.`datereg`, `users`.`id`
    FROM `soo_forum_vote_users` LEFT JOIN `users` ON `soo_forum_vote_users`.`user` = `users`.`id`
    WHERE `soo_forum_vote_users`.`topic`='$id' ORDER BY `time` DESC LIMIT $start,$kmess");
    $i = 0;
    while ($res = mysql_fetch_array($req)) {
        echo $i % 2 ? '<div class="list2">' : '<div class="list1">';
        echo functions::display_user($res, array ('iphide' => 1));
        echo '</div>';
        ++$i;
    }
    if ($total == 0)
        echo '<div class="menu">' . $lng_forum['voting_users_empty'] . '</div>';
    echo '<div class="phdr">' . $lng['total'] . ': ' . $total . '</div>';
    if ($total > $kmess) {
        echo '<p>' . functions::display_pagination('../soo/?mod=forum&amp;act=users&amp;id=' . $id . '&amp;', $start, $total, $kmess) . '</p>' .
            '<p><form action="../soo/?mod=forum&amp;act=users&amp;id=' . $id . '" method="post">' .
            '<input type="text" name="page" size="2"/>' .
            '<input type="submit" value="' . $lng['to_page'] . ' &gt;&gt;"/></form></p>';
    }
    echo '<p><a href="../soo/?mod=forum&amp;sid='. $sid .'&amp;id=' . $id . '">' . $lng_forum['to_topic'] . '</a></p>';
}

require('../incfiles/end.php');
break;
?>