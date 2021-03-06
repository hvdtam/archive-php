<?php

/**
* @package     JohnCMS
* @link        http://johncms.com
* @copyright   Copyright (C) 2008-2011 JohnCMS Community
* @license     LICENSE.txt (see attached file)
* @version     VERSION.txt (see attached file)
* @author      http://johncms.com/about
*/

define('_IN_JOHNCMS', 1);

require('../incfiles/core.php');
$lng_forum = core::load_lng('forum');
if (isset($_SESSION['ref']))
unset($_SESSION['ref']);

/*
-----------------------------------------------------------------
Настройки форума
-----------------------------------------------------------------
*/
$set_forum = $user_id && !empty($datauser['set_forum']) ? unserialize($datauser['set_forum']) : array(
'farea' => 0,
'upfp' => 0,
'preview' => 1,
'postclip' => 1,
'postcut' => 2
);

/*
-----------------------------------------------------------------
Список расширений файлов, разрешенных к выгрузке
-----------------------------------------------------------------
*/
// Файлы архивов
$ext_arch = array(
'zip',
'rar',
'7z',
'tar',
'gz'
);
// Звуковые файлы
$ext_audio = array(
'mp3',
'amr'
);
// Файлы документов и тексты
$ext_doc = array(
'txt',
'pdf',
'doc',
'rtf',
'djvu',
'xls'
);
// Файлы Java
$ext_java = array(
'jar',
'jad'
);
// Файлы картинок
$ext_pic = array(
'jpg',
'jpeg',
'gif',
'png',
'bmp'
);
// Файлы SIS
$ext_sis = array(
'sis',
'sisx'
);
// Файлы видео
$ext_video = array(
'3gp',
'avi',
'flv',
'mpeg',
'mp4'
);
// Файлы Windows
$ext_win = array(
'exe',
'msi'
);
// Другие типы файлов (что не перечислены выше)
$ext_other = array('wmf');

/*
-----------------------------------------------------------------
Ограничиваем доступ к Форуму
-----------------------------------------------------------------
*/
$error = '';if (!$set['mod_forum'] && $rights < 7)    $error = $lng_forum['forum_closed'];	else{if ($forum['hide'] == 1 && !$user_id)    $error = $lng['access_guest_forbidden'];}if ($error) {    require('../incfiles/head.php');    echo '<div class="rmenu"><p>' . $error . '</p></div>';    require('../incfiles/end.php');    exit;}

$headmod = $id ? 'forum,' . $id : 'forum';

/*
-----------------------------------------------------------------
Заголовки страниц форума
-----------------------------------------------------------------
*/
if (empty($id)) {
$textl = '' . $lng['forum'] . '';
} else {
$req = mysql_query("SELECT `text` FROM `forum` WHERE `id`= '" . $id . "'");
$res = mysql_fetch_assoc($req);
$textl = $res['text'];
}
/*
-----------------------------------------------------------------
Переключаем режимы работы
-----------------------------------------------------------------
*/
$mods = array(
'addfile',
'addvote',
'close',
'deltema',
'delvote',
'nhapfile',
'editpost',
'editvote',
'file',
'kiemduyet',
'deltema',
'files',
'filter',
'loadtem',
'massdel',
'moders',
'new',
'nt',
'per',
'post',
'ren',
'restore',
'say',
'tema',
'users',
'vip',
'vote',
'who',
'curators'
);
if ($act && ($key = array_search($act, $mods)) !== false && file_exists('includes/' . $mods[$key] . '.php')) {
require('includes/' . $mods[$key] . '.php');
} else {
require('../incfiles/head.php');

/*
-----------------------------------------------------------------
Если форум закрыт, то для Админов выводим напоминание
-----------------------------------------------------------------
*/
if (!$set['mod_forum']) echo '<div class="alarm">' . $lng_forum['forum_closed'] . '</div>';
elseif ($set['mod_forum'] == 3) echo '<div class="rmenu">' . $lng['read_only'] . '</div>';
if (!$user_id) {
if (isset($_GET['newup']))
$_SESSION['uppost'] = 1;
if (isset($_GET['newdown']))
$_SESSION['uppost'] = 0;
}
if ($id) {
/*
-----------------------------------------------------------------
Определяем тип запроса (каталог, или тема)
-----------------------------------------------------------------
*/
$type = mysql_query("SELECT * FROM `forum` WHERE `id`= '$id'");
if (!mysql_num_rows($type)) {
// Если темы не существует, показываем ошибку
echo functions::display_error($lng_forum['error_topic_deleted'], '<a href="index.php">' . $lng['to_forum'] . '</a>');
require('../incfiles/end.php');
exit;
}
$type1 = mysql_fetch_assoc($type);

/*
-----------------------------------------------------------------
Фиксация факта прочтения Топика
-----------------------------------------------------------------
*/
if ($user_id && $type1['type'] == 't') {
$req_r = mysql_query("SELECT * FROM `cms_forum_rdm` WHERE `topic_id` = '$id' AND `user_id` = '$user_id' LIMIT 1");
if (mysql_num_rows($req_r)) {
$res_r = mysql_fetch_assoc($req_r);
if ($type1['time'] > $res_r['time'])
mysql_query("UPDATE `cms_forum_rdm` SET `time` = '" . time() . "' WHERE `topic_id` = '$id' AND `user_id` = '$user_id' LIMIT 1");
} else {
mysql_query("INSERT INTO `cms_forum_rdm` SET `topic_id` = '$id', `user_id` = '$user_id', `time` = '" . time() . "'");
}
}

/*
-----------------------------------------------------------------
Получаем структуру форума
-----------------------------------------------------------------
*/
$res = true;
$parent = $type1['refid'];
while ($parent != '0' && $res != false) {
$req = mysql_query("SELECT * FROM `forum` WHERE `id` = '$parent' LIMIT 1");
$res = mysql_fetch_assoc($req);
if ($res['type'] == 'f' || $res['type'] == 'r')
$tree[] = '<a href="index.php?id=' . $parent . '">' . $res['text'] . '</a>';
$parent = $res['refid'];
}
$tree[] = '<a href="index.php">' . $lng['forum'] . '</a>';
krsort($tree);
if ($type1['type'] != 't' && $type1['type'] != 'm')
$tree[] = '<b>' . $type1['text'] . '</b>';

/*
-----------------------------------------------------------------
Счетчик файлов и ссылка на них
-----------------------------------------------------------------
*/
$sql = ($rights == 9) ? "" : " AND `del` != '1'";
if ($type1['type'] == 'f') {
$count = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_forum_files` WHERE `cat` = '$id'" . $sql), 0);
if ($count > 0)
$filelink = '<a href="index.php?act=files&amp;c=' . $id . '">' . $lng_forum['files_category'] . '</a>';
} elseif ($type1['type'] == 'r') {
$count = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_forum_files` WHERE `subcat` = '$id'" . $sql), 0);
if ($count > 0)
$filelink = '<a href="index.php?act=files&amp;s=' . $id . '">' . $lng_forum['files_section'] . '</a>';
} elseif ($type1['type'] == 't') {
$count = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_forum_files` WHERE `topic` = '$id'" . $sql), 0);
if ($count > 0)
$filelink = '<a href="index.php?act=files&amp;t=' . $id . '">' . $lng_forum['files_topic'] . '</a>';
}
$filelink = isset($filelink) ? $filelink . '&#160;<span class="red">(' . $count . ')</span>' : false;

/*
-----------------------------------------------------------------
Счетчик "Кто в теме?"
-----------------------------------------------------------------
*/
$wholink = false;
if ($user_id && $type1['type'] == 't') {
$online_u = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `lastdate` > " . (time() - 300) . " AND `place` = 'forum,$id'"), 0);
$online_g = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_sessions` WHERE `lastdate` > " . (time() - 300) . " AND `place` = 'forum,$id'"), 0);
$wholink = '<a href="index.php?act=who&amp;id=' . $id . '">' . $lng_forum['who_here'] . '?</a>&#160;<span class="red">(' . $online_u . '&#160;/&#160;' . $online_g . ')</span><br/>';
}

/*
-----------------------------------------------------------------
Выводим верхнюю панель навигации
-----------------------------------------------------------------
*/
echo '<p>' . counters::forum_new(1) . '</p>' .
'<div class="phdr">' . functions::display_menu($tree) . '</div>' .
'<div class="topmenu"><a href="search.php?id=' . $id . '">' . $lng['search'] . '</a>' . ($filelink ? ' | ' . $filelink : '') . ($wholink ? ' | ' . $wholink : '') . '</div>';

/*
-----------------------------------------------------------------
Отрбражаем содержимое форума
-----------------------------------------------------------------
*/
switch ($type1['type']) {
case 'f':
/*
-----------------------------------------------------------------
Список разделов форума
-----------------------------------------------------------------
*/
$req = mysql_query("SELECT `id`, `text`, `soft` FROM `forum` WHERE `type`='r' AND `refid`='$id' ORDER BY `realid`");
$total = mysql_num_rows($req);
if ($total) {
$i = 0;
while (($res = mysql_fetch_assoc($req)) !== false) {
echo $i % 2 ? '<div class="list2">' : '<div class="list1">';
$coltem = mysql_result(mysql_query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' AND `refid` = '" . $res['id'] . "'"), 0);
echo '<a href="?id=' . $res['id'] . '">' . $res['text'] . '</a>';
if ($coltem)
echo " [$coltem]";
if (!empty($res['soft']))
echo '<div class="sub"><span class="gray">' . $res['soft'] . '</span></div>';
echo '</div>';
++$i;
}
unset($_SESSION['fsort_id']);
unset($_SESSION['fsort_users']);
} else {
echo '<div class="menu"><p>' . $lng_forum['section_list_empty'] . '</p></div>';
}
echo '<div class="phdr">' . $lng['total'] . ': ' . $total . '</div>';
break;

case 'r':
/*
-----------------------------------------------------------------
Список топиков
-----------------------------------------------------------------
*/
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `forum` WHERE `type`='t' AND `refid`='$id'" . ($rights >= 7 ? '' : " AND `close`!='1'")), 0);
if (($user_id && !isset($ban['1']) && !isset($ban['11']) && $set['mod_forum'] != 3) || core::$user_rights) {
// Кнопка создания новой темы
echo '<div class="gmenu"><form action="index.php?act=nt&amp;id=' . $id . '" method="post"><input type="submit" value="' . $lng_forum['new_topic'] . '" /></form></div>';
}
if ($total) {
////$req = mysql_query("SELECT * FROM `forum` WHERE kiemduyet = '1' AND `type`='t'" . ($rights >= 7 ? '' : " AND `close`!='1'") . " AND `refid`='$id' ORDER BY `vip` DESC, `time` DESC LIMIT $start, $kmess");
$req = mysql_query("SELECT * FROM `forum` WHERE `type`='t'" . ($rights >= 7 ? '' : " AND `close`!='1'") . " AND `refid`='$id' ORDER BY `vip` DESC, `time` DESC LIMIT $start, $kmess");

$i = 0;
while (($res = mysql_fetch_assoc($req)) !== false) {
if ($res['close'])
echo '<div class="rmenu">';
else
echo $i % 2 ? '<div class="list1">' : '<div class="list2">';
$nikuser = mysql_query("SELECT `from` FROM `forum` WHERE `type` = 'm' AND `close` != '1' AND `refid` = '" . $res['id'] . "' ORDER BY `time` DESC LIMIT 1");
$nam = mysql_fetch_assoc($nikuser);
$colmes = mysql_query("SELECT COUNT(*) FROM `forum` WHERE `type`='m' AND `refid`='" . $res['id'] . "'" . ($rights >= 7 ? '' : " AND `close` != '1'"));
$colmes1 = mysql_result($colmes, 0);
$cpg = ceil($colmes1 / $kmess);
$np = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_forum_rdm` WHERE `time` >= '" . $res['time'] . "' AND `topic_id` = '" . $res['id'] . "' AND `user_id`='$user_id'"), 0);
// Значки
$icons = array(
($np ? (!$res['vip'] ? '<img src="../theme/' . $set_user['skin'] . '/images/op.gif" alt=""/>' : '') : '<img src="../theme/' . $set_user['skin'] . '/images/np.gif" alt=""/>'),
($res['vip'] ? '<img src="../theme/' . $set_user['skin'] . '/images/pt.gif" alt=""/>' : ''),
($res['realid'] ? '<img src="../theme/' . $set_user['skin'] . '/images/rate.gif" alt=""/>' : ''),
($res['edit'] ? '<img src="../theme/' . $set_user['skin'] . '/images/tz.gif" alt=""/>' : '')
);
echo functions::display_menu($icons, '&#160;', '&#160;');
echo '<a href="index.php?id=' . $res['id'] . '">' . $res['text'] . '</a> [' . $colmes1 . ']';
if ($cpg > 1) {
echo '<a href="index.php?id=' . $res['id'] . '&amp;page=' . $cpg . '">&#160;&gt;&gt;</a>';
}
echo '<div class="sub">';
echo $res['from'];
if (!empty($nam['from'])) {
echo '&#160;/&#160;' . $nam['from'];
}
echo ' <span class="gray">(' . functions::display_date($res['time']) . ')</span></div></div>';
++$i;
}
unset($_SESSION['fsort_id']);
unset($_SESSION['fsort_users']);
} else {
echo '<div class="menu"><p>' . $lng_forum['topic_list_empty'] . '</p></div>';
}
echo '<div class="phdr">' . $lng['total'] . ': ' . $total . '</div>';
if ($total > $kmess) {
echo '<div class="topmenu">' . functions::display_pagination('index.php?id=' . $id . '&amp;', $start, $total, $kmess) . '</div>' .
'<p><form action="index.php?id=' . $id . '" method="post">' .
'<input type="text" name="page" size="2"/>' .
'<input type="submit" value="' . $lng['to_page'] . ' &gt;&gt;"/>' .
'</form></p>';
}
break;

case 't':
/*
-----------------------------------------------------------------
Читаем топик
-----------------------------------------------------------------
*/
$filter = isset($_SESSION['fsort_id']) && $_SESSION['fsort_id'] == $id ? 1 : 0;
$sql = '';
if ($filter && !empty($_SESSION['fsort_users'])) {
// Подготавливаем запрос на фильтрацию юзеров
$sw = 0;
$sql = ' AND (';
$fsort_users = unserialize($_SESSION['fsort_users']);
foreach ($fsort_users as $val) {
if ($sw)
$sql .= ' OR ';
$sortid = intval($val);
$sql .= "`forum`.`user_id` = '$sortid'";
$sw = 1;
}
$sql .= ')';
}
if ($user_id && !$filter) {
// Фиксация факта прочтения топика
}
if ($rights < 7 && $type1['close'] == 1) {
echo '<div class="rmenu"><p>' . $lng_forum['topic_deleted'] . '<br/><a href="?id=' . $type1['refid'] . '">' . $lng_forum['to_section'] . '</a></p></div>';
require('../incfiles/end.php');
exit;
}
##############Thanks john4.x.x by soo http://fiboz.tk
$checkthankdau = mysql_query('SELECT COUNT(*) FROM `forum_thank` WHERE `userthank` = "' . $user_id . '" and `topic` = "' . $_GET['thanks'] . '" and `user` = "' . $_GET['user'] . '"');
if ($user_id && $user_id != $_GET['user'] && (mysql_result($checkthankdau, 0) < 1)) {
if ((isset ($_GET['thank']))&&(isset ($_GET['user']))&&(isset ($_GET['thanks']))) {


echo '<div class="rmenu" id="thanksyou"><b>Cảm Ơn Bạn Đã Cảm Ơn Bài Viết Của Mình!</b></div>';
mysql_query("INSERT INTO `forum_thank` SET
`user` = '".trim($_GET['user'])."',
`topic` = '".trim($_GET['thanks'])."' ,
`time` = 'time()',
`userthank` = '$user_id',
`chude` = '".$_GET["id"]."'
");
$congcamon=mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "' . trim($_GET['user']) . '"'));
mysql_query("UPDATE `users` SET `thank_duoc`='" . ($congcamon['thank_duoc'] + 1) . "' WHERE `id` = '" . trim($_GET['user']) . "'");
mysql_query("UPDATE `users` SET `thank_di`='" . ($datauser['thank_di'] + 1) . "' WHERE `id` = '" . $user_id . "'");

}
}
##########Hết phần thanks!

// Счетчик постов темы
$colmes = mysql_result(mysql_query("SELECT COUNT(*) FROM `forum` WHERE `type`='m'$sql AND `refid`='$id'" . ($rights >= 7 ? '' : " AND `close` != '1'")), 0);
if ($start > $colmes) $start = $colmes - $kmess;
// Выводим название топика
echo '<div class="phdr"><a name="up" id="up"></a><a href="#down"><img src="../theme/' . $set_user['skin'] . '/images/down.png" alt="" width="20" height="10" border="0"/></a>&#160;&#160;<b>' . bbcode::tags($type1['text']) . '</b></div>';
if ($colmes > $kmess)
echo '<div class="topmenu">' . functions::display_pagination('index.php?id=' . $id . '&amp;', $start, $colmes, $kmess) . '</div>';
// Метки удаления темы
if ($type1['close'])
echo '<div class="rmenu">' . $lng_forum['topic_delete_who'] . ': <b>' . $type1['close_who'] . '</b></div>';
elseif (!empty($type1['close_who']) && $rights >= 7)
echo '<div class="gmenu"><small>' . $lng_forum['topic_delete_whocancel'] . ': <b>' . $type1['close_who'] . '</b></small></div>';
if ($type1['edit'])
echo '<div class="rmenu">Chủ đề đã bị đóng cửa!</div>';
///////////////////////////////////////////////

// Метки закрытия темы
/*
if(empty($type1['kiemduyet']))
echo "<a href='index.php?act=kiemduyet&amp;id=" . $id . "&amp;kiemduyet'>Kiểm duyệt</a> | <a href='index.php?act=deltema&amp;id=" . $id . "'>Loại bỏ</a><br/>";
*/
/*
-----------------------------------------------------------------
Блок голосований
-----------------------------------------------------------------
*/
if ($type1['realid']) {
$clip_forum = isset($_GET['clip']) ? '&amp;clip' : '';
$vote_user = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_forum_vote_users` WHERE `user`='$user_id' AND `topic`='$id'"), 0);
$topic_vote = mysql_fetch_assoc(mysql_query("SELECT `name`, `time`, `count` FROM `cms_forum_vote` WHERE `type`='1' AND `topic`='$id' LIMIT 1"));
echo '<div  class="gmenu"><b>' . functions::checkout($topic_vote['name']) . '</b><br />';
$vote_result = mysql_query("SELECT `id`, `name`, `count` FROM `cms_forum_vote` WHERE `type`='2' AND `topic`='" . $id . "' ORDER BY `id` ASC");
if (!$type1['edit'] && !isset($_GET['vote_result']) && $user_id && $vote_user == 0) {
// Выводим форму с опросами
echo '<form action="index.php?act=vote&amp;id=' . $id . '" method="post">';
while (($vote = mysql_fetch_assoc($vote_result)) !== false) {
echo '<input type="radio" value="' . $vote['id'] . '" name="vote"/> ' . functions::checkout($vote['name'], 0, 1) . '<br />';
}
echo '<p><input type="submit" name="submit" value="' . $lng['vote'] . '"/><br /><a href="index.php?id=' . $id . '&amp;start=' . $start . '&amp;vote_result' . $clip_forum .
'">' . $lng_forum['results'] . '</a></p></form></div>';
} else {
// Выводим результаты голосования
echo '<small>';
while (($vote = mysql_fetch_assoc($vote_result)) !== false) {
$count_vote = $topic_vote['count'] ? round(100 / $topic_vote['count'] * $vote['count']) : 0;
echo functions::checkout($vote['name'], 0, 1) . ' [' . $vote['count'] . ']<br />';
echo '<img src="vote_img.php?img=' . $count_vote . '" alt="' . $lng_forum['rating'] . ': ' . $count_vote . '%" /><br />';
}
echo '</small></div><div class="bmenu">' . $lng_forum['total_votes'] . ': ';
if ($datauser['rights'] > 6)
echo '<a href="index.php?act=users&amp;id=' . $id . '">' . $topic_vote['count'] . '</a>';
else
echo $topic_vote['count'];
echo '</div>';
if ($user_id && $vote_user == 0)
echo '<div class="bmenu"><a href="index.php?id=' . $id . '&amp;start=' . $start . $clip_forum . '">' . $lng['vote'] . '</a></div>';
}
}
$curators = !empty($type1['curators']) ? unserialize($type1['curators']) : array();
$curator = false;
if ($rights < 6 && $rights != 3 && $user_id) {
if (array_key_exists($user_id, $curators)) $curator = true;
}
/*
-----------------------------------------------------------------
Фиксация первого поста в теме
-----------------------------------------------------------------
*/
if (($set_forum['postclip'] == 2 && ($set_forum['upfp'] ? $start < (ceil($colmes - $kmess)) : $start > 0)) || isset($_GET['clip'])) {
$postreq = mysql_query("SELECT `forum`.*, `users`.`sex`, `users`.`rights`, `users`.`lastdate`, `users`.`status`, `users`.`datereg`
FROM `forum` LEFT JOIN `users` ON `forum`.`user_id` = `users`.`id`
WHERE `forum`.`type` = 'm' AND `forum`.`refid` = '$id'" . ($rights >= 7 ? "" : " AND `forum`.`close` != '1'") . "
ORDER BY `forum`.`id` LIMIT 1");
$postres = mysql_fetch_assoc($postreq);
echo '<div class="topmenu"><p>';
if ($postres['sex'])
echo '<img src="../theme/' . $set_user['skin'] . '/images/' . ($postres['sex'] == 'm' ? 'm' : 'w') . ($postres['datereg'] > time() - 86400 ? '_new.png" width="14"' : '.png" width="10"') . ' height="10"/>&#160;';
else
echo '<img src="../images/del.png" width="10" height="10" alt=""/>&#160;';
if ($user_id && $user_id != $postres['user_id']) {
echo '<a href="../users/profile.php?user=' . $postres['user_id'] . '&amp;fid=' . $postres['id'] . '"><b>' . $postres['from'] . '</b></a> ' .
'<a href="index.php?act=say&amp;id=' . $postres['id'] . '&amp;start=' . $start . '"> ' . $lng_forum['reply_btn'] . '</a> ' .
'<a href="index.php?act=say&amp;id=' . $postres['id'] . '&amp;start=' . $start . '&amp;cyt"> ' . $lng_forum['cytate_btn'] . '</a> ';
} else {
echo '<b>' . $postres['from'] . '</b> ';
}
$user_rights = array(
1 => 'Kil',
3 => 'Mod',
6 => 'Smd',
7 => 'Adm',
8 => 'SV'
);
echo @$user_rights[$postres['rights']];
echo (time() > $postres['lastdate'] + 300 ? '<a>' : '<a>');
echo ' <span class="gray">(' . functions::display_date($postres['time']) . ')</span><br/>';
if ($postres['close']) {
echo '<span class="red">' . $lng_forum['post_deleted'] . '</span><br/>';
}
echo functions::checkout(mb_substr($postres['text'], 0, 500), 0, 2);
if (mb_strlen($postres['text']) > 500)
echo '...<a href="index.php?act=post&amp;id=' . $postres['id'] . '">' . $lng_forum['read_all'] . '</a>';
echo '</p></div>';
}
if ($filter)
echo '<div class="rmenu">' . $lng_forum['filter_on'] . '</div>';
// Задаем правила сортировки (новые внизу / вверху)
if ($user_id)
$order = $set_forum['upfp'] ? 'DESC' : 'ASC';
else
$order = ((empty($_SESSION['uppost'])) || ($_SESSION['uppost'] == 0)) ? 'ASC' : 'DESC';
// Запрос в базу
$req = mysql_query("SELECT `forum`.*, `users`.`sex`, `users`.`rights`, `users`.`balans`,  `users`.`chuki`,  `users`.`lastdate`, `users`.`status`, `users`.`postforum`, `users`.`mana`, `users`.`datereg`
FROM `forum` LEFT JOIN `users` ON `forum`.`user_id` = `users`.`id`
WHERE `forum`.`type` = 'm' AND `forum`.`refid` = '$id'"
. ($rights >= 7 ? "" : " AND `forum`.`close` != '1'") . "$sql ORDER BY `forum`.`id` $order LIMIT $start, $kmess");
if (($user_id && !$type1['edit'] && $set_forum['upfp'] && $set['mod_forum'] != 3) || ($rights >= 7 && $set_forum['upfp'])) {
echo '<div class="gmenu"><form name="form1" action="index.php?act=say&amp;id=' . $id . '" method="post">';
if ($set_forum['farea']) {
echo '<p>' .
(!$is_mobile ? bbcode::auto_bb('form1', 'msg') : '') .
'<textarea rows="' . $set_user['field_h'] . '" name="msg"></textarea></p>' .
'<p><input type="checkbox" name="addfiles" value="1" /> ' . $lng_forum['add_file'] .
($set_user['translit'] ? '<br /><input type="checkbox" name="msgtrans" value="1" /> ' . $lng['translit'] : '') .
'</p><p><input type="submit" name="submit" value="' . $lng['write'] . '" style="width: 107px; cursor: pointer;"/> ' .
($set_forum['preview'] ? '<input type="submit" value="' . $lng['preview'] . '" style="width: 107px; cursor: pointer;"/>' : '') .
'</p></form></div>';
} else {
echo '<p><input type="submit" name="submit" value="' . $lng['write'] . '"/></p></form></div>';
}
}
if ($rights == 3 || $rights >= 6)
echo '<form action="index.php?act=massdel" method="post">';
$i = 1;
while (($res = mysql_fetch_assoc($req)) !== false) {
if ($res['close'])
echo '<div class="rmenu">';
else
echo $i % 2 ? '<div class="list2">' : '<div class="list1">';
if ($set_user['avatar']) {
echo '<table cellpadding="0" cellspacing="0"><tr><td>';
if (file_exists(('../files/users/avatar/' . $res['user_id'] . '.png')))
echo '<img src="../files/users/avatar/' . $res['user_id'] . '.png" width="32" height="32" alt="' . $res['from'] . '" />&#160;';
else
echo '<img src="../images/empty.png" width="32" height="32" alt="' . $res['from'] . '" />&#160;';
echo '</td><td>';
}
echo '<div class="list2">';
if ($res['sex'])
echo '<a>';
else
echo '<img src="../images/del.png" width="12" height="12" align="middle" alt=""/>&#160;';
// Метка Онлайн / Офлайн
$exp = $res['postforum']*100;

if ($exp >= 0 && $exp <500)
{
$chucdanh = '<img src="../images/forum/level/hocvien.gif" width="13" height="16" align="middle"/>';

}
if ($exp >= 501 && $exp <1000)

{

$chucdanh = '<img src="../images/forum/level/tanbinh.gif" width="13" height="16" align="middle"/>';

}
if ($exp >= 1001 && $exp <2000)

{

$chucdanh = '<img src="../images/forum/level/binhbet.gif" width="13" height="16" align="middle"/>';

}

if ($exp >= 2001 && $exp <3500)
{

$chucdanh = '<img src="../images/forum/level/binhnhi.gif" width="13" height="16" align="middle"/>';

}

if ($exp >= 3501 && $exp <5000)

{
$chucdanh = '<img src="../images/forum/level/binhnhat1.gif" width="13" height="16" align="middle"/>';

}



if ($exp >= 5001 && $exp <10000)

{

}

if ($exp >= 10001 && $exp <20001)

{

$chucdanh = '<img src="../images/forum/level/trungsi.gif" width="13" height="16" align="middle"/>';
}

if ($exp >= 20001 && $exp <30000)

{

$chucdanh = '<img src="../images/forum/level/thuongsi.gif" width="13" height="16" align="middle"/>';

}
if ($exp >= 30001 && $exp <50000)

{

$chucdanh = '<img src="../images/forum/level/thieuuy.gif" width="13" height="16" align="middle"/>';

}

if ($exp >= 50001 && $exp <70000)
{

$chucdanh = '<img src="../images/forum/level/trunguy.gif" width="13" height="16" align="middle"/>';

}

if ($exp >= 70001 && $exp <90000)

{
$chucdanh = '<img src="../images/forum/level/thuonguy.gif" width="13" height="16" align="middle"/>';

}

if ($exp >= 90001 && $exp <120000)

{

$chucdanh = '<img src="../images/forum/level/thieuta.gif" width="13" height="16" align="middle"/>';
}

if ($exp >= 120001 && $exp <140000)

{

$chucdanh = '<img src="../images/forum/level/trungta.gif" width="13" height="16" align="middle"/>';

}
if ($exp >= 140001 && $exp <160000)

{

$chucdanh = '<img src="../images/forum/level/thuongta.gif" width="13" height="16" align="middle"/>';

}

if ($exp >= 200001 && $exp <300000)
{

$chucdanh = '<img src="../images/forum/level/thieutuong.gif" width="13" height="16" align="middle"/>';

}

if ($exp >= 300001 && $exp <350000)

{
$chucdanh = '<img src="../images/forum/level/trungtuong.gif" width="13" height="16" align="middle"/>';

}

if ($exp >= 350001 && $exp <450000)

{

$chucdanh = '<img src="../images/forum/level/thuongtuong.gif" width="13" height="16" align="middle"/>';
}

if ($exp >= 450001 && $exp <500000)

{

$chucdanh = '<img src="../images/forum/level/daituong.gif" width="13" height="16" align="middle"/>';

}
if ($exp >= 500001)

{



$chucdanh = '<img src="../images/forum/level/tongtulenh.gif" width="25" height="15" />';

}
echo ' ' . $chucdanh . ' ';
// Ссылки на ответ и цитирование
// Ник юзера и ссылка на его анкету

if ($res['rights'] == 0 ) {
$colornick['colornick'] = '000000';
$colornickk['colornick'] = '000000';
}
if ($res['rights'] == 1 ) {
$colornick['colornick'] = '008000';
$colornickk['colornick'] = '008000';
}
if ($res['rights'] == 2 ) {
$colornick['colornick'] = '008000';
$colornickk['colornick'] = '008000';
}
if ($res['rights'] == 3 ) {
$colornick['colornick'] = '008000';
$colornickk['colornick'] = '008000';
}
if ($res['rights'] == 4 ) {
$colornick['colornick'] = '008000';
$colornickk['colornick'] = '008000';
}
if ($res['rights'] == 5 ) {
$colornick['colornick'] = '008000';
$colornickk['colornick'] = '008000';
}
if ($res['rights'] == 6 ) {
$colornick['colornick'] = '0000ff';
$colornickk['colornick'] = '0000ff';
}
if ($res['rights'] == 7 ) {
$colornick['colornick'] = 'ff0000';
$colornickk['colornick'] = 'ff0000';
}
if ($res['rights'] == 9 ) {
$colornick['colornick'] = 'ff0000';
$colornickk['colornick'] = 'ff0000';
}
if ($res['rights'] == 10 ) {
$colornick['colornick'] = 'ff0000';
$colornickk['colornick'] = 'ff0000';
}


if ($user_id && $user_id != $res['user_id']) {
echo '<a href="../users/profile.php?user=' . $res['user_id'] . '"><span style="color:#' . $colornick['colornick'] . '">' .$vip['vip']. '<b>' .$res['from'] . '</b>' .$vip1['vip1']. '</span></a> ';
} else {
echo '<b><span style="color:#' . $colornick['colornick'] . '">' .$vip['vip']. '' . $res['from'] . '' .$vip1['vip1']. '</b></span> ';
}
// Метка должности
$user_rights = array(
0 => '<a>',
1 => '<a>',
3 => '<a>',
4 => '<a>',
6 => '<a>',
7 => '<a>',
9 => '<a>',
10 => '<a>'
);
echo @$user_rights[$res['rights']];
//echo'<a>';
echo (time() > $res['lastdate'] + 300 ? '<a> ' : '<a> ');
$user_u = $res['user_id'];
$req_u = mysql_query("SELECT * FROM `users` WHERE `id` = '$user_u' LIMIT 1");
$res_u = mysql_fetch_array($req_u);
echo '<small><span class="gray">(' . functions::display_date($res['time']) . ')</span><br /></small>';

// Время поста
$xp = $res['postforum']*1;
if($xp >= 0 && $xp < 100) {
echo '<a>';
}
if($xp >= 100 && $xp < 400) {
echo '<a>';
}
if($xp >= 400 && $xp < 1000) {
echo '<a>';
}
if($xp >= 1000) {
echo '<a>';
}
$xp = $res['postforum']*1;
$mana = $res['mana']*1;

$user_u = $res['user_id'];
$req_u = mysql_query("SELECT * FROM `users` WHERE `id` = '$user_u' LIMIT 1");
$res_u = mysql_fetch_array($req_u);
//$mana = $res_u['mana'];
//echo'<a>';
//echo '<img src="../rating.php?p=' . $res['postforum'] . '" alt="' . $res['postforum'] . '" />';
if($mana < 0 ){
echo '<a>';
}else{
echo '<a>';
}
echo '<a>';
// Статус юзера
echo '</div>';
if ($set_user['avatar'])
echo '</td></tr></table>';
/*
-----------------------------------------------------------------
Вывод текста поста
-----------------------------------------------------------------
*/
$text = $res['text'];
if ($set_forum['postcut']) {
// Если текст длинный, обрезаем и даем ссылку на полный вариант
switch ($set_forum['postcut']) {
case 2:
$cut = 1000;
break;

case 3:
$cut = 3000;
break;
default :
$cut = 500;
}
}
if ($set_forum['postcut'] && mb_strlen($text) > $cut) {
$text = mb_substr($text, 0, $cut);
$text = functions::checkout($text, 1, 1);
$text = preg_replace('#\[c\](.*?)\[/c\]#si', '<div class="quote">\1</div>', $text);
if ($set_user['smileys'])
$text = functions::smileys($text, $res['rights'] ? 1 : 0);
echo bbcode::notags($text) . '...<br /><a href="index.php?act=post&amp;id=' . $res['id'] . '">' . $lng_forum['read_all'] . ' &gt;&gt;</a>';
} else {
// Или, обрабатываем тэги и выводим весь текст
$text = functions::checkout($text, 1, 1);
if ($set_user['smileys'])
$text = functions::smileys($text, $res['rights'] ? 1 : 0);
echo $text;
}
if ($res['kedit']) {
// Если пост редактировался, показываем кем и когда
echo '<br /><span class="gray"><small>' . $lng_forum['edited'] . ' <b>' . $res['edit'] . '</b> (' . functions::display_date($res['tedit']) . ') <b>[' . $res['kedit'] . ']</b></small></span>';
}
// Если есть прикрепленный файл, выводим его описание
$freq = mysql_query("SELECT * FROM `cms_forum_files` WHERE `post` = '" . $res['id'] . "'");
if (mysql_num_rows($freq) > 0) {
$fres = mysql_fetch_assoc($freq);
$fls = round(@filesize('../files/forum/attach/' . $fres['filename']) / 1024, 2);
echo '<br /><span class="gray">' . $lng_forum['attached_file'] . ':';
// Предпросмотр изображений
$att_ext = strtolower(functions::format('./files/forum/attach/' . $fres['filename']));
$pic_ext = array(
'gif',
'jpg',
'jpeg',
'png'
);
$req99=mysql_query("SELECT `balans`, `id` FROM `users` WHERE (id='$user_id') ");
$arr99=mysql_fetch_array($req99);
$req43=mysql_query("SELECT `postforum`, `id` FROM `users` WHERE (id='$user_id') ");
$arr56=mysql_fetch_array($req43);
$total_spent = 2;
$hammad= 3 - $arr56['postforum'];
echo '<small>';
if (in_array($att_ext, $pic_ext)) {
echo '<div><a href="index.php?act=file&amp;id=' . $fres['id'] . '">';
echo '<img src="thumbinal.php?file=' . (urlencode($fres['filename'])) . '" alt="' . $lng_forum['click_to_view'] . '" /></a></div><br/>';
} else if($fres['cost'] > $arr99['balans']){
echo ' <font color="red">Không đủ tiền</font><br/>';
}
else if (empty($user_id)){
echo '<b>Bạn cần <a href="../login.php">đăng nhập</a> mới tải được file đính kèm</b>';
}else if($total_spent < $arr56['postforum']){
echo '<a href="index.php?act=file&amp;id=' . $fres['id'] . '">' . $fres['filename'] . '</a>';
}
else {
echo '<b>Bạn vui lòng post đủ 3 bài viết để tải tập tin đính kèm</b>';
}
echo ' (' . $fls . ' KB.)<br/>';
echo 'Giá: '.$fres['cost'].' VND<br/>';
echo $lng_forum['downloads'] . ': ' . $fres['dlcount'] . ' ' . $lng_forum['time'] . '</span>';
$file_id = $fres['id'];
echo '</small>';
echo '</div>';
}
#############Th?ng kê s? ngu?i thanks
$thongkethank = mysql_query("SELECT COUNT(*) from `forum_thank` where `topic`='" . $res["id"] . "'");
$thongkethanks = mysql_result($thongkethank, 0);
// $thongkethanks=mysql_result(mysql_query('SELECT COUNT(*) FROM `forum_thank` WHERE `topic` = "' . $res['id'] . '"')), 0);
$thongkea= @mysql_query("select * from `forum_thank` where `topic` = '" . $res['id'] . "'");
$thongke=mysql_fetch_array($thongkea);
$idthongke=trim($_GET['idthongke']);
if($thongkethanks>0&&(empty($_GET['idthongke'])))
{echo'<a>';
$thongkeaa= @mysql_query("select * from `forum_thank` where `topic` = '" . $res['id'] . "'");while ($thongkea = mysql_fetch_array($thongkeaa))
{
{
$dentv=mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$thongkea['userthank'].'"'));
echo '<a>';
}
++$f;
}
echo'</div>';}
if($res['chuki']){
echo '</div><div class="fmenu">'.functions::smileys(bbcode::tags($res['chuki'])).'</div>';
}
if ($user_id && $user_id != $res['user_id']) {
echo'</div><div class="fmenu">321Chat.Tk</div>';
}
//Nút thank
{
echo'<table cellpadding="0" cellspacing="0" width="100%"><tr><td width="auto"><a href="index.php?id=' . $id . '&amp;thanks=' . $res['id'] . '&amp;user=' . $res['user_id'] . '&amp;start=' . $start . '&amp;thank#thanksyou"><img src="/img/l.png"/></a> <b><font color="red">'.$thongkethanks.'</font>';
echo '</td><td align="right" width="32"><a href="index.php?act=say&amp;id=' . $res['id'] . '&amp;start=' . $start . '"><img src="/images/reply.png"></a>&nbsp;' .
'<a href="index.php?act=say&amp;id=' . $res['id'] . '&amp;start=' . $start . '&amp;cyt"><img src="/images/quote.png"></a></a></td></tr></table>';
}
if ($user_id && $user_id != $res['user_id']) {
echo '<a>&#160; ' .
'<a>';
}
if ($user_id==$res['user_id'])
echo '<a>';

if ($user_id==$res['user_id'])
echo '<a> ';
if ((($rights == 3 || $rights >= 6 || $curator) && $rights >= $res['rights']) || ($res['user_id'] == $user_id && !$set_forum['upfp'] && ($start + $i) == $colmes && $res['time'] > time() - 300) || ($res['user_id'] == $user_id && $set_forum['upfp'] && $start == 0 && $i == 1 && $res['time'] > time() - 300)) {
// Ссылки на редактирование / удаление постов
$menu = array(
'<a href="index.php?act=editpost&amp;id=' . $res['id'] . '">' . $lng['edit'] . '</a>',
($rights >= 7 && $res['close'] == 1 ? '<a href="index.php?act=editpost&amp;do=restore&amp;id=' . $res['id'] . '">' . $lng_forum['restore'] . '</a>' : ''),
($res['close'] == 1 ? '' : '<a href="index.php?act=editpost&amp;do=del&amp;id=' . $res['id'] . '">' . $lng['delete'] . '</a>')
);
echo '<div class="sub">';
if ($rights == 3 || $rights >= 6)
echo '<input type="checkbox" name="delch[]" value="' . $res['id'] . '"/>&#160;';
echo functions::display_menu($menu);
if ($res['close']) {
echo '<div class="red">' . $lng_forum['who_delete_post'] . ': <b>' . $res['close_who'] . '</b></div>';
} elseif (!empty($res['close_who'])) {
echo '<div class="green">' . $lng_forum['who_restore_post'] . ': <b>' . $res['close_who'] . '</b></div>';
}
if ($rights == 3 || $rights >= 6) {
if ($res['ip_via_proxy']) {
echo '<div class="gray"><b class="red"><a href="' . $set['homeurl'] . '/' . $set['admp'] . '/index.php?act=search_ip&amp;ip=' . long2ip($res['ip']) . '">' . long2ip($res['ip']) . '</a></b> - ' .
'<a href="' . $set['homeurl'] . '/' . $set['admp'] . '/index.php?act=search_ip&amp;ip=' . long2ip($res['ip_via_proxy']) . '">' . long2ip($res['ip_via_proxy']) . '</a>' .
' - ' . $res['soft'] . '</div>';
} else {
echo '<div class="gray">&#272;i&#803;a chi&#777; IP: <a href="' . $set['homeurl'] . '/' . $set['admp'] . '/index.php?act=search_ip&amp;ip=' . long2ip($res['ip']) . '">' . long2ip($res['ip']) . '</a></div>';
}
}
echo '</div>';
}
echo '</div>';
++$i;
}
if ($rights == 3 || $rights >= 6) {
echo '<div class="rmenu"><input type="submit" value=" ' . $lng['delete'] . ' "/></div>';
echo '</form>';
}
// Нижнее поле "Написать"
if($user_id){
echo '<div class="gmenu"><form name="form2" action="index.php?act=say&amp;id=' . $id . '" method="post">';

echo '<p>';
if (!$is_mobile)
echo bbcode::auto_bb('form2', 'msg');
echo '<textarea rows="' . $set_user['field_h'] . '" name="msg"></textarea><br/></p>' .
'<p><input type="checkbox" name="addfiles" value="1" /> ' . $lng_forum['add_file'];
echo '<br /><input type="checkbox" name="msgtrans" value="1" /> ' . $lng['translit'];
echo '</p><p><input type="submit" name="submit" value="' . $lng['write'] . '" style="width: 107px; cursor: pointer;"/> ' .
($set_forum['preview'] ? '<input type="submit" value="' . $lng['preview'] . '" style="width: 107px; cursor: pointer;"/>' : '') .
'</p></form></div>';
} else {
echo 'Cần phải <a href="/login.php">Đăng Nhập</a></form></div>';
}
echo '<div class="phdr"><a name="down" id="down"></a><a href="#up">' .
'<img src="../theme/' . $set_user['skin'] . '/images/up.png" alt="' . $lng['up'] . '" width="20" height="10" border="0"/></a>' .
'&#160;&#160;' . $lng['total'] . ': ' . $colmes . '</div>';
if ($colmes > $kmess) {
echo '<div class="topmenu">' . functions::display_pagination('index.php?id=' . $id . '&amp;', $start, $colmes, $kmess) . '</div>' .
'<p><form action="index.php?id=' . $id . '" method="post">' .
'<input type="text" name="page" size="2"/>' .
'<input type="submit" value="' . $lng['to_page'] . ' &gt;&gt;"/>' .
'</form></p>';
} else {
echo '<br />';
}
echo '<div class="rmenu">Chia sẻ bài viết. <br/><b>BB Code:</b><br/><input type="text" size="17" value="Chào bạn! Tôi muốn chia sẻ với bạn bài viết: [url='.$home.'/forum/index.php?id='.$id.']'.$type1["text"].'[/url] mong rằng nó sẽ có ích cho bạn. Thank!"/><br/><b>Link:</b><br/><input type="text" size="17" value="'.$home.'/forum/index.php?id='.$id.'"/></div>';


/*
-----------------------------------------------------------------
Ссылки на модераторские функции
-----------------------------------------------------------------
*/
//Tags forum
if($type1['tags']){
echo '<div class="menu">Tags: ';
$w_tag=substr_count($type1['tags'],',')+1;
for($t=0; $t<$w_tag; $t++)
{
$w_exp_label=explode(',',$type1['tags']);
if (!empty($w_exp_label) ? ', ' : '') {
echo '<a href="' . $set['homeurl'] . '/forum/tags='.str_replace(' ','+',$w_exp_label[$t]).'">'.$w_exp_label[$t].'</a>, ';
}
}
echo '<a href="index.php?act=tag&amp;id=' . $id . '">Sửa Tag</a></div>';
}
if ($curators) {
$array = array();
foreach ($curators as $key => $value)
$array[] = '<a href="../users/profile.php?user=' . $key . '">' . $value . '</a>';
echo '<p><div class="func">' . $lng_forum['curators'] . ': ' . implode(', ', $array) . '</div></p>';
}
$req = mysql_query("SELECT * FROM `forum` WHERE `type`='t' AND `refid`='$type1[refid]' AND `id`!='$id' ORDER BY `vip` DESC, `time` DESC LIMIT 5");
$total = mysql_num_rows($req);
if($total!=0)
{
echo '<div><strong>Chủ đề cùng chuyên mục</strong></div>
<div>
<ul>';
while ($res = mysql_fetch_assoc($req)) {
echo '<li><a href="index.php?id=' . $res['id'] . '">' .bbcode::tags($res['text']). '</a></li>';
++$i;
}

echo'</ul>                </div>';
}
if ($rights == 3 || $rights >= 6) {
echo '<p><div class="func">';
if ($rights >= 7)
echo '<a href="index.php?act=curators&amp;id=' . $id . '&amp;start=' . $start . '">' . $lng_forum['curators_of_the_topic'] . '</a><br />';
echo isset($topic_vote) && $topic_vote > 0
? '<a href="index.php?act=editvote&amp;id=' . $id . '">' . $lng_forum['edit_vote'] . '</a><br/><a href="index.php?act=delvote&amp;id=' . $id . '">' . $lng_forum['delete_vote'] . '</a><br/>'
: '<a href="index.php?act=addvote&amp;id=' . $id . '">' . $lng_forum['add_vote'] . '</a><br/>';
echo '<a href="index.php?act=ren&amp;id=' . $id . '">' . $lng_forum['topic_rename'] . '</a><br/>';
// Закрыть - открыть тему
if ($type1['edit'] == 1)
echo '<a href="index.php?act=close&amp;id=' . $id . '">' . $lng_forum['topic_open'] . '</a><br/>';
else
echo '<a href="index.php?act=close&amp;id=' . $id . '&amp;closed">' . $lng_forum['topic_close'] . '</a><br/>';
// Удалить - восстановить тему
if ($type1['close'] == 1)
echo '<a href="index.php?act=restore&amp;id=' . $id . '">' . $lng_forum['topic_restore'] . '</a><br/>';
echo '<a href="index.php?act=deltema&amp;id=' . $id . '">' . $lng_forum['topic_delete'] . '</a><br/>';
if ($type1['vip'] == 1)
echo '<a href="index.php?act=vip&amp;id=' . $id . '">' . $lng_forum['topic_unfix'] . '</a>';
else
echo '<a href="index.php?act=vip&amp;id=' . $id . '&amp;vip">' . $lng_forum['topic_fix'] . '</a>';
echo '<br/><a href="index.php?act=per&amp;id=' . $id . '">' . $lng_forum['topic_move'] . '</a></div></p>';
}
if ($wholink)
echo '<div>' . $wholink . '</div>';
if ($filter)
echo '<div><a href="index.php?act=filter&amp;id=' . $id . '&amp;do=unset">' . $lng_forum['filter_cancel'] . '</a></div>';
else
echo '<div><a href="index.php?act=filter&amp;id=' . $id . '&amp;start=' . $start . '">' . $lng_forum['filter_on_author'] . '</a></div>';
echo '<a href="index.php?act=tema&amp;id=' . $id . '">' . $lng_forum['download_topic'] . '</a>';
break;

default:
/*
-----------------------------------------------------------------
Если неверные данные, показываем ошибку
-----------------------------------------------------------------
*/
echo functions::display_error($lng['error_wrong_data']);
break;
}
} else {
/*
-----------------------------------------------------------------
Список Категорий форума
-----------------------------------------------------------------
*/
$count = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_forum_files`" . ($rights >= 7 ? '' : " WHERE `del` != '1'")), 0);
echo '<p>' . counters::forum_new(1) . '</p>' .
'<div class="phdr"><b>' . $lng['forum'] . '</b></div>' .
'<div class="topmenu"><a href="search.php">' . $lng['search'] . '</a> | <a href="index.php?act=files">' . $lng_forum['files_forum'] . '</a> <span class="red">(' . $count . ')</span></div>';
$req = mysql_query("SELECT `id`, `text`, `soft` FROM `forum` WHERE `type`='f' ORDER BY `realid`");
$i = 0;
while (($res = mysql_fetch_array($req)) !== false) {
echo $i % 2 ? '<div class="list2">' : '<div class="list1">';
$count = mysql_result(mysql_query("SELECT COUNT(*) FROM `forum` WHERE `type`='r' and `refid`='" . $res['id'] . "'"), 0);
echo '<a href="index.php?id=' . $res['id'] . '">' . $res['text'] . '</a> [' . $count . ']';
if (!empty($res['soft']))
echo '<div class="sub"><span class="gray">' . $res['soft'] . '</span></div>';
echo '</div>';
++$i;
}
$online_u = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `lastdate` > " . (time() - 300) . " AND `place` LIKE 'forum%'"), 0);
$online_g = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_sessions` WHERE `lastdate` > " . (time() - 300) . " AND `place` LIKE 'forum%'"), 0);
echo '<div class="phdr">' . ($user_id ? '<a href="index.php?act=who">' . $lng_forum['who_in_forum'] . '</a>' : $lng_forum['who_in_forum']) . '&#160;(' . $online_u . '&#160;/&#160;' . $online_g . ')</div>';
unset($_SESSION['fsort_id']);
unset($_SESSION['fsort_users']);
}

// Навигация внизу страницы
echo '<p>' . ($id ? '<a href="index.php">' . $lng['to_forum'] . '</a><br />' : '');
if (!$id) {
echo '<a href="../pages/faq.php?act=forum">' . $lng_forum['forum_rules'] . '</a><br/>';
echo '<a href="index.php?act=moders">' . $lng['moders'] . '</a>';
}
echo '</p>';
if (!$user_id) {
if ((empty($_SESSION['uppost'])) || ($_SESSION['uppost'] == 0)) {
echo '<a href="index.php?id=' . $id . '&amp;page=' . $page . '&amp;newup">' . $lng_forum['new_on_top'] . '</a>';
} else {
echo '<a href="index.php?id=' . $id . '&amp;page=' . $page . '&amp;newdown">' . $lng_forum['new_on_bottom'] . '</a>';
}
}
}

require_once('../incfiles/end.php');

?>
