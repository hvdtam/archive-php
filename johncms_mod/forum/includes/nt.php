<?php

defined('_IN_JOHNCMS') or die('Error: restricted access');

/*
-----------------------------------------------------------------
Закрываем доступ для определенных ситуаций
-----------------------------------------------------------------
*/
if (!$id || !$user_id || isset($ban['1']) || isset($ban['11']) || (!core::$user_rights && $set['mod_forum'] == 3)) {
    require('../incfiles/head.php');
    echo functions::display_error($lng['access_forbidden']);
    require('../incfiles/end.php');
    exit;
}

/*
-----------------------------------------------------------------
Вспомогательная Функция обработки ссылок форума
-----------------------------------------------------------------
*/
function forum_link($m)
{
    global $set;
    if (!isset($m[3])) {
        return '[url=' . $m[1] . ']' . $m[2] . '[/url]';
    } else {
        $p = parse_url($m[3]);
        if ('http://' . $p['host'] . $p['path'] . '?id=' == $set['homeurl'] . '/forum/index.php?id=') {
            $thid = abs(intval(preg_replace('/(.*?)id=/si', '', $m[3])));
            $req = mysql_query("SELECT `text` FROM `forum` WHERE `id`= '$thid' AND `type` = 't' AND `close` != '1'");
            if (mysql_num_rows($req) > 0) {
                $res = mysql_fetch_array($req);
                $name = strtr($res['text'], array(
                                                 '&quot;' => '',
                                                 '&amp;' => '',
                                                 '&lt;' => '',
                                                 '&gt;' => '',
                                                 '&#039;' => '',
                                                 '[' => '',
                                                 ']' => ''
                                            ));
                if (mb_strlen($name) > 40)
                    $name = mb_substr($name, 0, 40) . '...';
                return '[url=' . $m[3] . ']' . $name . '[/url]';
            } else {
                return $m[3];
            }
        } else
            return $m[3];
    }
}

// Проверка на флуд
$flood = functions::antiflood();
if ($flood) {
    require('../incfiles/head.php');
    echo functions::display_error($lng['error_flood'] . ' ' . $flood . $lng['sec'] . ', <a href="index.php?id=' . $id . '&amp;start=' . $start . '">' . $lng['back'] . '</a>');
    require('../incfiles/end.php');
    exit;
}
$req_r = mysql_query("SELECT * FROM `forum` WHERE `id` = '$id' AND `type` = 'r' LIMIT 1");
if (!mysql_num_rows($req_r)) {
    require('../incfiles/head.php');
    echo functions::display_error($lng['error_wrong_data']);
    require('../incfiles/end.php');
    exit;
}
$th = isset($_POST['th']) ? functions::check(mb_substr(trim($_POST['th']), 0, 100)) : '';
$msg = isset($_POST['msg']) ? trim($_POST['msg']) : '';
        $tiento = trim($_POST['tiento']);
        if($tiento==0){
        $th = $th;
        }elseif($tiento==1){
        $th = '[orange][b][Share][/b][/orange] '.$th.'';
        }elseif($tiento==2){
        $th = '[black][b][Hỏi][/b][/black] '.$th.'';
        }elseif($tiento==3){
        $th = '[red][b][HOT][/b][/red] '.$th.'';
        }elseif($tiento==4){
        $th = '[green][b][Tin tức][/b][/green] '.$th.'';
        }elseif($tiento==5){
        $th = '[black][b][Xin][/b][/black] '.$th.'';
        }elseif($tiento==6){
        $th = '[red][b][Thông báo][/b][/red] '.$th.'';
        }elseif($tiento==7){
        $th = '[blue][b][Thảo luận][/b][/blue] '.$th.'';
        }
$msg = preg_replace_callback('~\\[url=(http://.+?)\\](.+?)\\[/url\\]|(http://(www.)?[0-9a-zA-Z\.-]+\.[0-9a-zA-Z]{2,6}[0-9a-zA-Z/\?\.\~&amp;_=/%-:#]*)~', 'forum_link', $msg);
if (isset($_POST['submit'])) {
    $error = array();
    if (empty($th))
        $error[] = $lng_forum['error_topic_name'];
    if (mb_strlen($th) < 2)
        $error[] = $lng_forum['error_topic_name_lenght'];
    if (empty($msg))
        $error[] = $lng['error_empty_message'];
    if (mb_strlen($msg) < 4)
        $error[] = $lng['error_message_short'];
    if (!$error) {
        $msg = preg_replace_callback('~\\[url=(http://.+?)\\](.+?)\\[/url\\]|(http://(www.)?[0-9a-zA-Z\.-]+\.[0-9a-zA-Z]{2,6}[0-9a-zA-Z/\?\.\~&amp;_=/%-:#]*)~', 'forum_link', $msg);
        // Прверяем, есть ли уже такая тема в текущем разделе?
        if (mysql_result(mysql_query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' AND `refid` = '$id' AND `text` = '$th'"), 0) > 0)
            $error[] = $lng_forum['error_topic_exists'];
        // Проверяем, не повторяется ли сообщение?
        $req = mysql_query("SELECT * FROM `forum` WHERE `user_id` = '$user_id' AND `type` = 'm' ORDER BY `time` DESC");
        if (mysql_num_rows($req) > 0) {
            $res = mysql_fetch_array($req);
            if ($msg == $res['text'])
                $error[] = $lng['error_message_exists'];
        }
    }
    if (!$error) {
        // Добавляем тему
        mysql_query("INSERT INTO `forum` SET
            `refid` = '$id',
            `type` = 't',
            `time` = '" . time() . "',
            `user_id` = '$user_id',
            `from` = '$login',
            `text` = '$th'
        ");
        $rid = mysql_insert_id();
        // Добавляем текст поста
        mysql_query("INSERT INTO `forum` SET
            `refid` = '$rid',
            `type` = 'm',
            `time` = '" . time() . "',
            `user_id` = '$user_id',
            `from` = '$login',
            `ip` = '" . core::$ip . "',
            `ip_via_proxy` = '" . core::$ip_via_proxy . "',
            `soft` = '" . mysql_real_escape_string($agn) . "',
            `text` = '" . mysql_real_escape_string($msg) . "'
        ");
        $postid = mysql_insert_id();
        // Записываем счетчик постов юзера
        $fpst = $datauser['postforum'] + 1;
        mysql_query("UPDATE `users` SET
            `postforum` = '$fpst',
            `lastpost` = '" . time() . "'
            WHERE `id` = '$user_id'
        ");
        // Ставим метку о прочтении
        mysql_query("INSERT INTO `cms_forum_rdm` SET
            `topic_id`='$rid',
            `user_id`='$user_id',
            `time`='" . time() . "'
        ");
        if($rights >= 3) {
mysql_query("UPDATE forum SET `kiemduyet`='1' WHERE `id`='$rid'");
mysql_query("UPDATE forum SET `kiemduyet_who`='$login' WHERE `id`='$rid'");
}
if ($_POST['addfiles'] == 1)
header("Location: index.php?id=$postid&act=addfile");
        else
            header("Location: index.php?id=$rid");
    } else {
        // Выводим сообщение об ошибке
        require('../incfiles/head.php');
        echo functions::display_error($error, '<a href="index.php?act=nt&amp;id=' . $id . '">' . $lng['repeat'] . '</a>');
        require('../incfiles/end.php');
        exit;
    }
} else {
    $res_r = mysql_fetch_assoc($req_r);
    $req_c = mysql_query("SELECT * FROM `forum` WHERE `id` = '" . $res_r['refid'] . "'");
    $res_c = mysql_fetch_assoc($req_c);
    require('../incfiles/head.php');
    if ($datauser['postforum'] == 0) {
        if (!isset($_GET['yes'])) {
            $lng_faq = core::load_lng('faq');
            echo '<p>' . $lng_faq['forum_rules_text'] . '</p>';
            echo '<p><a href="index.php?act=nt&amp;id=' . $id . '&amp;yes">' . $lng_forum['agree'] . '</a> | <a href="index.php?id=' . $id . '">' . $lng_forum['not_agree'] . '</a></p>';
            require('../incfiles/end.php');
            exit;
        }
    }
    $msg_pre = functions::checkout($msg, 1, 1);
    if ($set_user['smileys'])
        $msg_pre = functions::smileys($msg_pre, $datauser['rights'] ? 1 : 0);
    $msg_pre = preg_replace('#\[c\](.*?)\[/c\]#si', '<div class="quote">\1</div>', $msg_pre);
    echo '<div class="phdr"><a href="index.php?id=' . $id . '"><b>' . $lng['forum'] . '</b></a> | ' . $lng_forum['new_topic'] . '</div>';
    if ($msg && $th && !isset($_POST['submit']))
        echo '<div class="list1"><img src="../theme/default/images/op.gif" border="0" alt="op" /> <span style="font-weight: bold">' . $th . '</span></div>' .
             '<div class="list2">' . functions::display_user($datauser, array('iphide' => 1, 'header' => '<span class="gray">(' . functions::display_date(time()) . ')</span>', 'body' => $msg_pre)) . '</div>';
    echo '<form name="form" action="index.php?act=nt&amp;id=' . $id . '" method="post">' .
         '<div class="gmenu">' .
         '<p><h3>' . $lng['section'] . '</h3>' .
         '<a href="index.php?id=' . $res_c['id'] . '">' . $res_c['text'] . '</a> | <a href="index.php?id=' . $res_r['id'] . '">' . $res_r['text'] . '</a></p>' .
         '<p><h3>' . $lng_forum['new_topic_name'] . '</h3>' .
         '<input type="text" size="20" maxlength="100" name="th" value="' . $th . '"/></p>' .
         '<p><h3>' . $lng_forum['post'] . '</h3>';
    if (!$is_mobile)
        echo '</p><p>' . bbcode::auto_bb('form', 'msg');
    echo '<textarea rows="' . $set_user['field_h'] . '" name="msg">' . (isset($_POST['msg']) ? functions::checkout($_POST['msg']) : '') . '</textarea></p>' .
         '<p><input type="checkbox" name="addfiles" value="1" ' . (isset($_POST['addfiles']) ? 'checked="checked" ' : '') . '/> ' . $lng_forum['add_file'];
//Tiền tố bài viết
echo '<div class="phdr">Tiền tố:</div>';
echo'
<input type="radio" value="0" name="tiento" checked="checked" />&nbsp;<b>Mặc định</b>
<br/><input type="radio" value="1" name="tiento" />&nbsp;<b><font color="orange">[Share]</font></b>
<br/><input type="radio" value="2" name="tiento" />&nbsp;<b><font color="black">[Hỏi]</font></b>
<br/><input type="radio" value="3" name="tiento" />&nbsp;<b><font color="red">[HOT]</font></b>
<br/><input type="radio" value="4" name="tiento" />&nbsp;<b><font color="green">[Tin tức]</font></b>
<br/><input type="radio" value="5" name="tiento" />&nbsp;<b><font color="black">[Xin]</font></b>
<br/><input type="radio" value="6" name="tiento" />&nbsp;<b><font color="red">[Thông báo]</font></b>
<br/><input type="radio" value="7" name="tiento" />&nbsp;<b><font color="blue">[Thảo luận]</font></b>';
//Hết
    if ($set_user['translit'])
        echo '<br /><input type="checkbox" name="msgtrans" value="1" ' . (isset($_POST['msgtrans']) ? 'checked="checked" ' : '') . '/> ' . $lng['translit'];
    echo '</p><p><input type="submit" name="submit" value="' . $lng['save'] . '" style="width: 107px; cursor: pointer;"/> ' .
         ($set_forum['preview'] ? '<input type="submit" value="' . $lng['preview'] . '" style="width: 107px; cursor: pointer;"/>' : '') .
         '</p></div></form>' .
         '<div class="phdr"><a href="../pages/faq.php?act=trans">' . $lng['translit'] . '</a> | ' .
         '<a href="../pages/faq.php?act=smileys">' . $lng['smileys'] . '</a></div>' .
         '<p><a href="index.php?id=' . $id . '">' . $lng['back'] . '</a></p>';
}
?>