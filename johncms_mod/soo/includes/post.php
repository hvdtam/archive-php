<?php

/*
WMR: R118530587041
ICQ: 365848916
Автор: VladiSs
Сайт: http://wapnex.ru
*/

defined('_IN_JOHNCMS') or die('Error: restricted access');

require('../incfiles/head.php');
if (empty($_GET['id'])) {
    echo functions::display_error($lng['error_wrong_data']);
    require('../incfiles/end.php');
    exit;
}
$s = intval($_GET['s']);
// Запрос сообщения
$req = mysql_query("SELECT `soo_forum`.*, `users`.`sex`, `users`.`rights`, `users`.`lastdate`, `users`.`status`, `users`.`datereg`
FROM `soo_forum` LEFT JOIN `users` ON `soo_forum`.`user_id` = `users`.`id`
WHERE `soo_forum`.`type` = 'm' AND `soo_forum`.`id` = '$id'" . ($rights >= 7 ? "" : " AND `soo_forum`.`close` != '1'") . " LIMIT 1");
$res = mysql_fetch_array($req);

// Запрос темы
$them = mysql_fetch_array(mysql_query("SELECT * FROM `soo_forum` WHERE `type` = 't' AND `id` = '" . $res['refid'] . "'"));
echo '<div class="phdr"><b>' . $lng_forum['topic'] . ':</b> ' . $them['text'] . '</div><div class="menu">';
// Значок пола
if ($res['sex'])
    echo '<img src="../theme/' . $set_user['skin'] . '/images/' . ($res['sex'] == 'm' ? 'm' : 'w') . '.png" alt=""  width="16" height="16"/>&#160;';
else
    echo '<img src="../images/del.png" width="12" height="12" />&#160;';
// Ник юзера и ссылка на его анкету
if ($user_id && $user_id != $res['user_id']) {
    echo '<a href="../users/profile.php?user=' . $res['user_id'] . '&amp;fid=' . $res['id'] . '"><b>' . $res['from'] . '</b></a> ';
    echo '<a href="../soo/?mod=forum&amp;act=say&amp;sid='. $sid .'&amp;id=' . $res['id'] . '&amp;start=' . $start . '"> [о]</a> <a href="../soo/?mod=forum&amp;act=say&amp;sid='. $sid .'&amp;id=' . $res['id'] . '&amp;start=' . $start . '&amp;cyt"> [ц]</a>';
} else {
    echo '<b>' . $res['from'] . '</b>';
}

// Метка Онлайн / Офлайн
echo (time() > $res['lastdate'] + 300 ? '<span class="red"> [Off]</span>' : '<span class="green"> [ON]</span>');
// Время поста
echo ' <span class="gray">(' . functions::display_date($res['time']) . ')</span><br/>';
// Статус юзера
if (!empty($res['status']))
    echo '<div class="status"><img src="../images/star.gif" alt=""/>&#160;' . $res['status'] . '</div>';
$text = htmlentities($res['text'], ENT_QUOTES, 'UTF-8');
$text = nl2br($text);
$text = bbcode::tags($text);
if ($set_user['smileys'])
    $text = functions::smileys($text, ($res['rights'] >= 1) ? 1 : 0);
echo $text . '</div>';
// Вычисляем, на какой странице сообщение?
$page = ceil(mysql_result(mysql_query("SELECT COUNT(*) FROM `soo_forum` WHERE `refid` = '" . $res['refid'] . "' AND `id` " . ($set_forum['upfp'] ? ">=" : "<=") . " '$id'"), 0) / $kmess);
echo '<div class="phdr"><a href="../soo/?mod=forum&amp;sid='. $sid .'&amp;id=' . $res['refid'] . '&amp;page=' . $page . '">' . $lng_forum['back_to_topic'] . '</a></div>';

require_once('../incfiles/end.php');
break;
?>