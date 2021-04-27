<?php

/*
WMR: R118530587041
ICQ: 365848916
Автор: VladiSs
Сайт: http://wapnex.ru
*/

define('_IN_JOHNCMS', 1);

require_once('../incfiles/core.php');

/*
-----------------------------------------------------------------
Закрываем от неавторизованных юзеров
-----------------------------------------------------------------
*/
if (!$user_id) {
    require('../incfiles/head.php');
    echo functions::display_error($lng['access_guest_forbidden']);
    require('../incfiles/end.php');
    exit;
}

$bansoo = mysql_num_rows(mysql_query("SELECT * FROM `soo_ban_users` WHERE `sid` = '$id' AND `user_id` = '$user_id'"));    
$ressoo = mysql_fetch_assoc(mysql_query("SELECT * FROM `soo_ban_users` WHERE `sid` = '$id' AND `user_id` = '$user_id'"));  
$remain = $ressoo['ban_time'] - time();

if($bansoo == 1 && $remain > 0){
    require('../incfiles/head.php');
    echo functions::display_error('Lệnh cấm hiện tại!');
    require('../incfiles/end.php');
    exit;
}

switch($mod){
    
    case 'news':
    require('../incfiles/head.php');
    $lng_news = core::load_lng('news'); // Загружаем язык модуля
    $sid = isset($_REQUEST['sid']) ? abs(intval($_REQUEST['sid'])) : false;
    $us = mysql_fetch_array(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = ' " . $sid . " ' AND `user_id`=' " . $user_id . " '  "));
    $mod1 = mysql_fetch_array(mysql_query("SELECT `mod`,`cat` FROM `soo` WHERE `id` = '$sid'"));
    $ussoo = mysql_num_rows(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = '". $sid ."' AND `user_id` = '". $user_id ."' "));
    
if($mod1['mod'] == 1 && $ussoo != 1 || $mod1['mod'] == 2 && $ussoo != 1 ){
    echo functions::display_error('Để đọc những tin tức bạn cần phải là một thành viên của bang hội!');
    echo '<br /><div class="list1"><a href="../soo/?act=soo&amp;id='. $sid .'">Quay Lại</a></div>';
    require('../incfiles/end.php');
    exit;
}

$bansoof = mysql_num_rows(mysql_query("SELECT * FROM `soo_ban_users` WHERE `sid` = '$sid' AND `user_id` = '$user_id'"));    

if($bansoof == 1){
    require('../incfiles/head.php');
    echo functions::display_error('Lệnh cấm hiện tại!');
    require('../incfiles/end.php');
    exit;
}
    
    switch ($do) {
    case 'add':
        /*
        -----------------------------------------------------------------
        Добавление новости
        -----------------------------------------------------------------
        */
        if ($us['rights'] >= 8) {
            echo '<div class="phdr"><a href="../soo/?act=soo&amp;id='. $sid .'"><b>Bang Hội </b></a> |<a href="../soo/?mod=news&amp;sid='. $sid .'"> Tin Tức</a> | Thêm</div>';
            $old = 20;
            if (isset($_POST['submit'])) {
                $error = array();
                $name = isset($_POST['name']) ? functions::check($_POST['name']) : false;
                $text = isset($_POST['text']) ? trim($_POST['text']) : false;
                if (!$name)
                    $error[] = 'Bạn chưa nhập tiêu đề bài viết';
                if (!$text)
                    $error[] = 'Bạn chưa nhập văn bản của bài viết';
                $flood = functions::antiflood();
                if ($flood)
                    $error[] = 'lũ lụt!' . ' ' . $flood . '&#160;' . 'giây';
                if (!$error) {
                    $rid = 0;

                    mysql_query("INSERT INTO `soo_news` SET
                        `time` = '" . time() . "',
                        `avt` = '$login',
                        `name` = '$name',
                        `text` = '" . mysql_real_escape_string($text) . "',
                        `kom` = '$rid',
                        `sid` = '$sid'
                    ");
                    mysql_query("UPDATE `users` SET
                        `lastpost` = '" . time() . "'
                        WHERE `id` = '$user_id'
                    ");
                    echo '<p>Thêm Tin Tức<br /><a href="../soo/?mod=news&amp;sid='. $sid .'">Tin Tức</a></p>';
                } else {
                    echo functions::display_error($error, '<a href="../soo/?mod=news&amp;sid='. $sid .'">Tin Tức</a>');
                }
            } else {
                echo '<form action="../soo/?mod=news&amp;sid='. $sid .'&amp;do=add" method="post"><div class="menu">' .
                     '<p><h3>Tiêu Đề</h3>' .
                     '<input type="text" name="name"/></p>' .
                     '<p><h3>Văn Bản</h3>' .
                     '<textarea rows="' . $set_user['field_h'] . '" name="text"></textarea></p>';
                echo '</p></div><div class="bmenu">' .
                     '<input type="submit" name="submit" value="Lưu"/>' .
                     '</div></form>' .
                     '<p><a href="../soo/?mod=news&amp;sid='. $sid .'">Tin Tức</a></p>';
            }
        } else {
            header("location: ../soo/?mod=news&sid=$sid");
        }
        break;

    case 'edit':
        /*
        -----------------------------------------------------------------
        Редактирование новости
        -----------------------------------------------------------------
        */
        if ($us['rights'] >= 8) {
            echo '<div class="phdr"><a href="../soo/?act=soo&amp;id='. $sid .'"><b>Bang Hội </b></a> |<a href="../soo/?mod=news&amp;sid='. $sid .'"> Tin Tức</a> | Thay Đổi</div>';
            if (!$id) {
                echo functions::display_error('Không Thể loại bỏ!', '<a href="../soo/?mod=news&amp;sid='. $sid .'">Tin Tức</a>');
                require('../incfiles/end.php');
                exit;
            }
            if (isset($_POST['submit'])) {
                $error = array();
                if (empty($_POST['name']))
                    $error[] = $lng_news['error_title'];
                if (empty($_POST['text']))
                    $error[] = $lng_news['error_text'];
                $name = functions::check($_POST['name']);
                $text = mysql_real_escape_string(trim($_POST['text']));
                if (!$error) {
                    mysql_query("UPDATE `soo_news` SET
                        `name` = '$name',
                        `text` = '$text'
                        WHERE `id` = '$id' AND `sid` = '$sid'
                    ");
                } else {
                    echo functions::display_error($error, '<a href="../soo/?mod=news&amp;sid='. $sid .'&amp;do=edit&amp;id=' . $id . '">' . $lng['repeat'] . '</a>');
                }
                echo '<p>Các Tin Đã Thay Đổi<br /><a href="../soo/?mod=news&amp;sid='. $sid .'">Tiến Hành</a></p>';
            } else {
                $req = mysql_query("SELECT * FROM `soo_news` WHERE `sid` = '". $sid ."' AND `id` = '$id'");
                $res = mysql_fetch_assoc($req);
                echo '<div class="menu"><form action="../soo/?mod=news&amp;sid='. $sid .'&amp;do=edit&amp;id=' . $id . '" method="post">' .
                     '<p><h3>' . $lng_news['article_title'] . '</h3>' .
                     '<input type="text" name="name" value="' . $res['name'] . '"/></p>' .
                     '<p><h3>' . $lng['text'] . '</h3>' .
                     '<textarea rows="' . $set_user['field_h'] . '" name="text">' . htmlentities($res['text'], ENT_QUOTES, 'UTF-8') . '</textarea></p>' .
                     '<p><input type="submit" name="submit" value="' . $lng['save'] . '"/></p>' .
                     '</form></div>' .
                     '<div class="phdr"><a href="../soo/?mod=news&amp;sid='. $sid .'">Tin Tức</a></div>';
            }
        } else {
            header('location: ../soo/?mod=news&sid='. $sid .'');
        }
        break;

    case 'clean':
        /*
        -----------------------------------------------------------------
        Чистка новостей
        -----------------------------------------------------------------
        */
        if ($us['rights'] >= 8) {
            echo '<div class="phdr"><a href="../soo/?act=soo&amp;id='. $sid .'"><b>Bang Hội </b></a> |<a href="../soo/?mod=news&amp;sid='. $sid .'"> Tin Tức</a> | Làm Sạch</div>';
            if (isset($_POST['submit'])) {
                $cl = isset($_POST['cl']) ? intval($_POST['cl']) : '';
                switch ($cl) {
                    case '1':
                        // Чистим новости, старше 1 недели
                        mysql_query("DELETE FROM `soo_news` WHERE `sid` = '". $sid ."' AND `time`<='" . (time() - 604800) . "'");
                        mysql_query("OPTIMIZE TABLE `soo_news`");
                        echo '<p>Loại bỏ tất cả những tin tức hơn một tuần</p><p><a href="../soo/?mod=news&amp;sid='. $sid .'">Tin Tức</a></p>';
                        break;

                    case '2':
                        // Проводим полную очистку
                        mysql_query("DELETE FROM `soo_news` WHERE `sid` = '". $sid ."'");
                        mysql_query("OPTIMIZE TABLE `soo_news`;");
                        echo '<p>Loại bỏ tất cả những Tin Tức</p><p><a href="../soo/?mod=news&amp;sid='. $sid .'">Tin Tức</a></p>';
                        break;
                    default :
                        // Чистим сообщения, старше 1 месяца
                        mysql_query("DELETE FROM `soo_news` WHERE `sid` ='". $sid ."' AND `time`<='" . (time() - 2592000) . "'");
                        mysql_query("OPTIMIZE TABLE `soo_news`;");
                        echo '<p>Loại bỏ tất cả những tin tức hơn một tháng</p><p><a href="../soo/?mod=news&amp;sid='. $sid .'">Tin Tức</a></p>';
                }
            } else {
                echo '<div class="menu"><form id="clean" method="post" action="../soo/?mod=news&amp;sid='. $sid .'&amp;do=clean">' .
                     '<p><h3>Tùy Chọn</h3>' .
                     '<input type="radio" name="cl" value="0" checked="checked" />Hơn 1 tháng<br />' .
                     '<input type="radio" name="cl" value="1" />Hơn 1 tuần<br />' .
                     '<input type="radio" name="cl" value="2" />Tất cả</p>' .
                     '<p><input type="submit" name="submit" value="Làm Sạch" /></p>' .
                     '</form></div>' .
                     '<div class="phdr"><a href="../soo/?mod=news&amp;sid='. $sid .'">Hủy</a></div>';
            }
        } else {
            header("location: ../soo/?mod=news&sid='. $sid .'");
        }
        break;

    case 'del':
        /*
        -----------------------------------------------------------------
        Удаление новости
        -----------------------------------------------------------------
        */
        if ($us['rights'] >= 8) {
            echo '<div class="phdr"><a href="../soo/?act=soo&amp;id='. $sid .'"><b>Bang Hội </b></a> |<a href="../soo/?mod=news&amp;sid='. $sid .'"> Tin Tức</a> | Hủy Bỏ</div>';
            if (isset($_GET['yes'])) {
                mysql_query("DELETE FROM `soo_news` WHERE `id` = '$id' AND `sid` = '". $sid ."'");
                echo '<p>các tin tức bị loại bỏ!<br/><a href="../soo/?mod=news&amp;sid='. $sid .'">Tin Tức</a></p>';
            } else {
                echo '<p>Bạn có thực sự muốn xóa?<br/>' .
                     '<a href="../soo/?mod=news&amp;sid='. $sid .'&amp;do=del&amp;id=' . $id . '&amp;yes">Xoá</a> | <a href="../soo/?mod=news&amp;sid='. $sid .'">Hủy</a></p>';
            }
        } else {
            header("location: ../soo/?mod=news&sid='. $sid .'");
        }
        break;

    default:
        /*
        -----------------------------------------------------------------
        Вывод списка новостей
        -----------------------------------------------------------------
        */
        echo '<div class="phdr"><b><a href="../soo/?act=soo&amp;id='. $sid .'">Bang Hội </a> | Tin Tức</b></div>';
        if ($us['rights'] >= 8)
            echo '<div class="topmenu"><a href="../soo/?mod=news&amp;sid='. $sid .'&amp;do=add">Thêm</a> | <a href="../soo/?mod=news&amp;sid='. $sid .'&amp;do=clean">Làm Sạch</a></div>';
        $req = mysql_query("SELECT COUNT(*) FROM `soo_news` WHERE `sid` = '". $sid ."'");
        $total = mysql_result($req, 0);
        if ($total){
        $req = mysql_query("SELECT * FROM `soo_news` WHERE `sid` = '". $sid ."' ORDER BY `time` DESC LIMIT $start, $kmess");
        $i = 0;
        while ($res = mysql_fetch_array($req)) {
            echo $i % 2 ? '<div class="list2">' : '<div class="list1">';
            $text = functions::checkout($res['text'], 1, 1);
            if ($set_user['smileys'])
                $text = functions::smileys($text, 1);
            echo '<h3>' . $res['name'] . '</h3>' .
                 '<span class="gray"><small>' . $lng['author'] . ': ' . $res['avt'] . ' (' . functions::display_date($res['time']) . ')</small></span>' .
                 '<br />' . $text . '<div class="sub">';
            if ($res['kom'] != 0 && $res['kom'] != "") {
                $mes = mysql_query("SELECT COUNT(*) FROM `forum` WHERE `type` = 'm' AND `refid` = '" . $res['kom'] . "'");
                $komm = mysql_result($mes, 0) - 1;
                if ($komm >= 0)
                    echo '<a href="../forum/?id=' . $res['kom'] . '">' . $lng_news['discuss_on_forum'] . ' (' . $komm . ')</a><br/>';
            }
            if ($rights >= 6) {
                echo '<a href="../soo/?mod=news&amp;sid='. $sid .'&amp;do=edit&amp;id=' . $res['id'] . '">Chỉnh Sửa</a> | ' .
                     '<a href="../soo/?mod=news&amp;sid='. $sid .'&amp;do=del&amp;id=' . $res['id'] . '">Hủy Bỏ</a>';
            }
            echo '</div></div>';
            ++$i;
        }
        } else {
        echo '<div class="list1">Danh Sách Trống!</div>';
        }
        echo '<div class="phdr">' . $lng['total'] . ':&#160;' . $total . '</div>';
        if ($total > $kmess) {
            echo '<div class="topmenu">' . functions::display_pagination('../soo/?mod=news&amp;sid='. $sid .'&amp;', $start, $total, $kmess) . '</div>' .
                 '<p><form action="../soo/?mod=news&amp;sid='. $sid .'" method="post">' .
                 '<input type="text" name="page" size="2"/>' .
                 '<input type="submit" value="' . $lng['to_page'] . ' &gt;&gt;"/></form></p>';
        }
}

break;
    
    
    case 'forum':
    
    $sid = isset($_REQUEST['sid']) ? abs(intval($_REQUEST['sid'])) : false;
    $mod1 = mysql_fetch_array(mysql_query("SELECT `mod`,`cat` FROM `soo` WHERE `id` = '$sid'"));
    $ussoo = mysql_num_rows(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = '". $sid ."' AND `user_id` = '". $user_id ."' "));
    
if($mod1['mod'] == 1 && $ussoo != 1 || $mod1['mod'] == 2 && $ussoo != 1 ){
    require('../incfiles/head.php');
    echo functions::display_error('Để đọc các diễn đàn, bạn phải là thành viên của bang hội!');
    echo '<br /><div class="list1"><a href="../soo/?act=soo&amp;id='. $sid .'">Quay Lại</a></div>';
    require('../incfiles/end.php');
    exit;
}

$bansoof = mysql_num_rows(mysql_query("SELECT * FROM `soo_ban_users` WHERE `sid` = '$sid' AND `user_id` = '$user_id'"));    

if($bansoof == 1){
    require('../incfiles/head.php');
    echo functions::display_error('Lệnh cấm hiện tại!');
    require('../incfiles/end.php');
    exit;
}    
    
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
$error = '';
if (!$set['mod_forum'] && $rights < 7)
    $error = $lng_forum['forum_closed'];
elseif ($set['mod_forum'] == 1 && !$user_id)
    $error = $lng['access_guest_forbidden'];
if ($error) {
    require('../incfiles/head.php');
    echo '<div class="rmenu"><p>' . $error . '</p></div>';
    require('../incfiles/end.php');
    exit;
}

$headmod = $id ? 'forum,' . $id : 'forum';

/*
-----------------------------------------------------------------
Заголовки страниц форума
-----------------------------------------------------------------
*/
if (empty($id)) {
    $textl = '' . $lng['forum'] . '';
} else {
    $req = mysql_query("SELECT `text` FROM `soo_forum` WHERE `id`= '" . $id . "'");
    $res = mysql_fetch_assoc($req);
    $hdr = strtr($res['text'], array(
        '&quot;' => '',
        '&amp;' => '',
        '&lt;' => '',
        '&gt;' => '',
        '&#039;' => ''
    ));
    $hdr = mb_substr($hdr, 0, 30);
    $hdr = functions::checkout($hdr);
    $textl = mb_strlen($res['text']) > 30 ? $hdr . '...' : $hdr;
}

/*
-----------------------------------------------------------------
Переключаем режимы работы
-----------------------------------------------------------------
*/
$modsf = array(
    'addfile' => 'includes',
    'addvote' => 'includes',
    'close' => 'includes',
    'deltema' => 'includes',
    'delvote' => 'includes',
    'editpost' => 'includes',
    'editvote' => 'includes',
    'file' => 'includes',
    'files' => 'includes',
    'filter' => 'includes',
    'loadtem' => 'includes',
    'massdel' => 'includes',
    'moders' => 'includes',
    'mforum' => 'includes',
    'nt' => 'includes',
    'per' => 'includes',
    'new' => 'includes',
    'post' => 'includes',
    'ren' => 'includes',
    'restore' => 'includes',
    'say' => 'includes',
    'tema' => 'includes',
    'users' => 'includes',
    'vip' => 'includes',
    'vote' => 'includes',
    'who' => 'includes',
    'curators' => 'includes'
);
$path = !empty($modsf[$act]) ? $modsf[$act] . '/' : '';
if (array_key_exists($act, $modsf) && file_exists($path . $act . '.php')) {
    require($path . $act . '.php');
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
            $sid = isset($_REQUEST['sid']) ? abs(intval($_REQUEST['sid'])) : false;

$res1 = mysql_fetch_assoc(mysql_query("SELECT * FROM `soo` WHERE `id`='$sid'"));
if(!$res1){
echo    functions::display_error('Нет данных!');
    require_once ('../incfiles/end.php');
    exit;
}



    if ($id) {
        $us = mysql_fetch_array(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = ' " . $sid . " ' AND `user_id`=' " . $user_id . " '  "));
        /*
        -----------------------------------------------------------------
        Определяем тип запроса (каталог, или тема)
        -----------------------------------------------------------------
        */
        $type = mysql_query("SELECT * FROM `soo_forum` WHERE `id`= '$id'");
        if (!mysql_num_rows($type)) {
            // Если темы не существует, показываем ошибку
            echo functions::display_error($lng_forum['error_topic_deleted'], '<a href="../soo/?mod=forum">' . $lng['to_forum'] . '</a>');
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
            $req_r = mysql_query("SELECT * FROM `soo_forum_rdm` WHERE `topic_id` = '$id' AND `user_id` = '$user_id' LIMIT 1");
            if (mysql_num_rows($req_r)) {
                $res_r = mysql_fetch_assoc($req_r);
                if ($type1['time'] > $res_r['time'])
                    mysql_query("UPDATE `soo_forum_rdm` SET `time` = '" . time() . "' WHERE `topic_id` = '$id' AND `user_id` = '$user_id' LIMIT 1");
            } else {
                mysql_query("INSERT INTO `soo_forum_rdm` SET `topic_id` = '$id', `user_id` = '$user_id', `time` = '" . time() . "'");
            }
        }

        /*
        -----------------------------------------------------------------
        Получаем структуру форума
        -----------------------------------------------------------------
        */
        $res = true;
        $sid = isset($_REQUEST['sid']) ? abs(intval($_REQUEST['sid'])) : false;
        $parent = $type1['refid'];

        while ($parent != '0' && $res != false) {
            $req = mysql_query("SELECT * FROM `soo_forum` WHERE `id` = '$parent' LIMIT 1");
            $res = mysql_fetch_assoc($req);
            if ($res['type'] == 'f' || $res['type'] == 'r')
                $tree[] = '<a href="../soo/?mod=forum&amp;sid='. $sid .'&amp;id=' . $parent . '">' . $res['text'] . '</a>';
            $parent = $res['refid'];
        }
        $tree[] = '<a href="../soo/?act=soo&amp;id='. $sid .'">Bang Hội </a>';
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
            $count = mysql_result(mysql_query("SELECT COUNT(*) FROM `soo_forum_files` WHERE `cat` = '$id'" . $sql), 0);
            if ($count > 0)
                $filelink = '<a href="../soo/?mod=forum&amp;act=files&amp;c=' . $id . '">' . $lng_forum['files_category'] . '</a>';
        } elseif ($type1['type'] == 'r') {
            $count = mysql_result(mysql_query("SELECT COUNT(*) FROM `soo_forum_files` WHERE `subcat` = '$id'" . $sql), 0);
            if ($count > 0)
                $filelink = '<a href="../soo/?mod=forum&amp;act=files&amp;s=' . $id . '">' . $lng_forum['files_section'] . '</a>';
        } elseif ($type1['type'] == 't') {
            $count = mysql_result(mysql_query("SELECT COUNT(*) FROM `soo_forum_files` WHERE `topic` = '$id'" . $sql), 0);
            if ($count > 0)
                $filelink = '<a href="../soo/?mod=forum&amp;act=files&amp;t=' . $id . '">' . $lng_forum['files_topic'] . '</a>';
        }
        $filelink = isset($filelink) ? $filelink . '&#160;<span class="red">(' . $count . ')</span>' : false;



        /*
        -----------------------------------------------------------------
        Выводим верхнюю панель навигации
        -----------------------------------------------------------------
        */
        echo 
             '<div class="phdr">' . functions::display_menu($tree) . '</div>' .
             '<div class="topmenu">' . ($filelink ? ' | ' . $filelink : '') . ($wholink ? ' | ' . $wholink : '') . '</div>';

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
                
                $res2 = mysql_fetch_assoc(mysql_query("SELECT * FROM `soo_forum` WHERE `sid`='$sid'"));
                if($res2 == 0){
                echo    'Thể loại không có!';
                require_once ('../incfiles/end.php');
                exit;
                }
                else
                {
                $sid = isset($_REQUEST['sid']) ? abs(intval($_REQUEST['sid'])) : false;
                $req = mysql_query("SELECT `id`, `text`, `soft` FROM `soo_forum` WHERE `type`='r' AND `refid`='$id'  AND `sid` = '$sid' ORDER BY `realid`");
                $total = mysql_num_rows($req);
                if ($total) {
                    $i = 0;
                    while (($res = mysql_fetch_assoc($req)) !== false) {
                        echo $i % 2 ? '<div class="list2">' : '<div class="list1">';
                        $coltem = mysql_result(mysql_query("SELECT COUNT(*) FROM `soo_forum` WHERE `sid` ='".$sid."' AND `type` = 't' AND `refid` = '" . $res['id'] . "' "), 0);
                        echo '<a href="../soo/?mod=forum&amp;sid='. $sid .'&amp;id=' . $res['id'] . '">' . $res['text'] . '</a>';
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
                    echo '<div class="menu"><p>Không có thể loại!</p></div>';
                }
                echo '<div class="phdr">' . $lng['total'] . ': ' . $total . '</div>';
                $us = mysql_fetch_array(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = ' " . $sid . " ' AND `user_id`=' " . $user_id . " '  "));
                    if ($us['rights'] >= 8)
                echo '<div class="func"><a href="../soo/?mod=forum&amp;sid='. $sid .'&amp;id='. $id .'&amp;act=mforum&amp;do=cat">Quản Lý Diễn Đàn</a></div>';
                break;
}
            case 'r':
                /*
                -----------------------------------------------------------------
                Список топиков
                -----------------------------------------------------------------
                */
                $sid = abs(intval($_GET['sid']));
                $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `soo_forum` WHERE `type`='t' AND `refid`='$id' AND `sid` ='$sid'" . ($rights >= 7 ? '' : " AND `close`!='1'")), 0);
                if (($user_id && !isset($ban['1']) && !isset($ban['11']) && $set['mod_forum'] != 3) || core::$user_rights) {
                    // Кнопка создания новой темы
                    echo '<div class="gmenu"><form action="../soo/?mod=forum&amp;act=nt&amp;sid='. $sid .'&amp;id=' . $id . '" method="post"><input type="submit" value="' . $lng_forum['new_topic'] . '" /></form></div>';
                }
                if ($total) {
                    $req = mysql_query("SELECT * FROM `soo_forum` WHERE `type`='t'   " . ($rights >= 7 ? '' : " AND `close`!='1'") . " AND `sid` ='$sid'  AND `refid`='$id' ORDER BY `vip` DESC, `time` DESC LIMIT $start, $kmess");
                    $i = 0;
                    while (($res = mysql_fetch_assoc($req)) !== false) {
                        if ($res['close'])
                            echo '<div class="rmenu">';
                        else
                            echo $i % 2 ? '<div class="list2">' : '<div class="list1">';
                        $nikuser = mysql_query("SELECT `from` FROM `soo_forum` WHERE `type` = 'm' AND `close` != '1' AND `refid` = '" . $res['id'] . "' ORDER BY `time` DESC LIMIT 1");
                        $nam = mysql_fetch_assoc($nikuser);
                        $colmes = mysql_query("SELECT COUNT(*) FROM `soo_forum` WHERE `type`='m' AND `refid`='" . $res['id'] . "'" . ($rights >= 7 ? '' : " AND `close` != '1'"));
                        $colmes1 = mysql_result($colmes, 0);
                        $cpg = ceil($colmes1 / $kmess);
                        $np = mysql_result(mysql_query("SELECT COUNT(*) FROM `soo_forum_rdm` WHERE `time` >= '" . $res['time'] . "' AND `topic_id` = '" . $res['id'] . "' AND `user_id`='$user_id'"), 0);
                        // Значки
                        $icons = array(
                            ($np ? (!$res['vip'] ? '<img src="../theme/' . $set_user['skin'] . '/images/op.gif" alt=""/>' : '') : '<img src="../theme/' . $set_user['skin'] . '/images/np.gif" alt=""/>'),
                            ($res['vip'] ? '<img src="../theme/' . $set_user['skin'] . '/images/pt.gif" alt=""/>' : ''),
                            ($res['realid'] ? '<img src="../theme/' . $set_user['skin'] . '/images/rate.gif" alt=""/>' : ''),
                            ($res['edit'] ? '<img src="../theme/' . $set_user['skin'] . '/images/tz.gif" alt=""/>' : '')
                        );
                        echo functions::display_menu($icons, '&#160;', '&#160;');
                        echo '<a href="../soo/?mod=forum&amp;sid='. $sid .'&amp;id=' . $res['id'] . '">' . $res['text'] . '</a> [' . $colmes1 . ']';
                        if ($cpg > 1) {
                            echo '<a href="../soo/?mod=forum&amp;sid='. $sid .'&amp;id=' . $res['id'] . '&amp;page=' . $cpg . '">&#160;&gt;&gt;</a>';
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
                    echo '<div class="topmenu">' . functions::display_pagination('../soo/?mod=forum&amp;sid='. $sid .'&amp;id=' . $id . '&amp;', $start, $total, $kmess) . '</div>' .
                         '<p><form action="../soo/?mod=forum&amp;id=' . $id . '" method="post">' .
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
                        $sql .= "`soo_forum`.`user_id` = '$sortid'";
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
                // Счетчик постов темы
                $colmes = mysql_result(mysql_query("SELECT COUNT(*) FROM `soo_forum` WHERE `type`='m'$sql AND `refid`='$id'" . ($rights >= 7 ? '' : " AND `close` != '1'")), 0);
                if ($start > $colmes) $start = $colmes - $kmess;
                // Выводим название топика
                echo '<div class="phdr"><a name="up" id="up"></a><a href="#down"><img src="../theme/' . $set_user['skin'] . '/images/down.png" alt="Вниз" width="20" height="10" border="0"/></a>&#160;&#160;<b>' . $type1['text'] . '</b></div>';
                if ($colmes > $kmess)
                    echo '<div class="topmenu">' . functions::display_pagination('../soo/?mod=forum&amp;sid='. $sid .'&amp;id=' . $id . '&amp;', $start, $colmes, $kmess) . '</div>';
                // Метки удаления темы
                if ($type1['close'])
                    echo '<div class="rmenu">' . $lng_forum['topic_delete_who'] . ': <b>' . $type1['close_who'] . '</b></div>';
                elseif (!empty($type1['close_who']) && $rights >= 7)
                    echo '<div class="gmenu"><small>' . $lng_forum['topic_delete_whocancel'] . ': <b>' . $type1['close_who'] . '</b></small></div>';
                // Метки закрытия темы
                if ($type1['edit'])
                    echo '<div class="rmenu">' . $lng_forum['topic_closed'] . '</div>';
                /*
                -----------------------------------------------------------------
                Блок голосований
                -----------------------------------------------------------------
                */
                if ($type1['realid']) {
                    $clip_forum = isset($_GET['clip']) ? '&amp;clip' : '';
                    $vote_user = mysql_result(mysql_query("SELECT COUNT(*) FROM `soo_forum_vote_users` WHERE `user`='$user_id' AND `topic`='$id'"), 0);
                    $topic_vote = mysql_fetch_assoc(mysql_query("SELECT `name`, `time`, `count` FROM `soo_forum_vote` WHERE `type`='1' AND `topic`='$id' LIMIT 1"));
                    echo '<div  class="gmenu"><b>' . functions::checkout($topic_vote['name']) . '</b><br />';
                    $vote_result = mysql_query("SELECT `id`, `name`, `count` FROM `soo_forum_vote` WHERE `type`='2' AND `topic`='" . $id . "' ORDER BY `id` ASC");
                    if (!$type1['edit'] && !isset($_GET['vote_result']) && $user_id && $vote_user == 0) {
                        // Выводим форму с опросами
                        echo '<form action="../soo/?mod=forum&amp;act=vote&amp;id=' . $id . '" method="post">';
                        while (($vote = mysql_fetch_assoc($vote_result)) !== false) {
                            echo '<input type="radio" value="' . $vote['id'] . '" name="vote"/> ' . functions::checkout($vote['name'], 0, 1) . '<br />';
                        }
                        echo '<p><input type="submit" name="submit" value="' . $lng['vote'] . '"/><br /><a href="../soo/?mod=forum&amp;id=' . $id . '&amp;start=' . $start . '&amp;vote_result' . $clip_forum .
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
                            echo '<a href="../soo/?mod=forum&amp;act=users&amp;sid='. $sid .'&amp;id=' . $id . '">' . $topic_vote['count'] . '</a>';
                        else
                            echo $topic_vote['count'];
                        echo '</div>';
                        if ($user_id && $vote_user == 0)
                            echo '<div class="bmenu"><a href="../soo/?mod=forum&amp;id=' . $id . '&amp;start=' . $start . $clip_forum . '">' . $lng['vote'] . '</a></div>';
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
                    FROM `soo_forum` LEFT JOIN `users` ON `forum`.`user_id` = `users`.`id`
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
                             '<a href="../soo/?mod=forum&amp;act=say&amp;sid='. $sid .'&amp;id=' . $postres['id'] . '&amp;start=' . $start . '"> ' . $lng_forum['reply_btn'] . '</a> ' .
                             '<a href="../soo/?mod=forum&amp;act=say&amp;sid='. $sid .'&amp;id=' . $postres['id'] . '&amp;start=' . $start . '&amp;cyt"> ' . $lng_forum['cytate_btn'] . '</a> ';
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
                    echo (time() > $postres['lastdate'] + 300 ? '<span class="red"> [Off]</span>' : '<span class="green"> [ON]</span>');
                    echo ' <span class="gray">(' . functions::display_date($postres['time']) . ')</span><br/>';
                    if ($postres['close']) {
                        echo '<span class="red">' . $lng_forum['post_deleted'] . '</span><br/>';
                    }
                    echo functions::checkout(mb_substr($postres['text'], 0, 500), 0, 2);
                    if (mb_strlen($postres['text']) > 500)
                        echo '...<a href="../soo/?mod=forum&amp;act=post&amp;id=' . $postres['id'] . '">' . $lng_forum['read_all'] . '</a>';
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
                $req = mysql_query("SELECT `soo_forum`.*, `users`.`sex`, `users`.`rights`, `users`.`lastdate`, `users`.`status`, `users`.`datereg`
                FROM `soo_forum` LEFT JOIN `users` ON `soo_forum`.`user_id` = `users`.`id`
                WHERE `soo_forum`.`type` = 'm' AND `soo_forum`.`refid` = '$id'"
                                   . ($rights >= 7 ? "" : " AND `soo_forum`.`close` != '1'") . "$sql ORDER BY `soo_forum`.`id` $order LIMIT $start, $kmess");
                 // Верхнее поле "Написать"


                if (($user_id && !$type1['edit'] && $set_forum['upfp'] && $set['mod_forum'] != 3) || ($rights >= 7 && $set_forum['upfp'])) {
                    echo '<div class="gmenu"><form name="form1" action="../soo/?mod=forum&amp;act=say&amp;id=' . $id . '" method="post">';
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
                    echo '<form action="../soo/?mod=forum&amp;act=massdel" method="post">';
                $i = 1;
                
                
                
                
                
                
                
                
                while (($res = mysql_fetch_assoc($req))) {
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
                    if ($res['sex'])
                        echo '<img src="../theme/' . $set_user['skin'] . '/images/' . ($res['sex'] == 'm' ? 'm' : 'w') . ($res['datereg'] > time() - 86400 ? '_new' : '') . '.png" width="16" height="16" align="middle" />&#160;';
                    else
                        echo '<img src="../images/del.png" width="12" height="12" align="middle" alt=""/>&#160;';
                    // Ник юзера и ссылка на его анкету
                    if ($user_id && $user_id != $res['user_id']) {
                        echo '<a href="../users/profile.php?user=' . $res['user_id'] . '"><b>' . $res['from'] . '</b></a> ';
                    } else {
                        echo '<b>' . $res['from'] . '</b> ';
                    }
                    // Метка должности
                    $user_rights = array(
                        3 => '(FMod)',
                        6 => '(Smd)',
                        7 => '(Adm)',
                        9 => '(SV!)'
                    );
                    echo @$user_rights[$res['rights']];
                    // Метка Онлайн / Офлайн
                    echo (time() > $res['lastdate'] + 300 ? '<span class="red"> [Off]</span> ' : '<span class="green"> [ON]</span> ');
                    // Ссылки на ответ и цитирование
                    if ($user_id && $user_id != $res['user_id']) {
                    if ($us['rights'] >= 7){
                    echo '<a href="../soo/?act=ban&amp;mod=do&amp;user=' . $res['user_id'] . '&amp;fid=' . $res['id'] . '&amp;sid=' . $sid . '"><span class="cytate" style="color:red;"> [бан] </span></a>';
                    }
                        echo '<a href="../soo/?mod=forum&amp;act=say&amp;sid='. $sid .'&amp;id=' . $res['id'] . '&amp;start=' . $start . '">' . $lng_forum['reply_btn'] . '</a>&#160;' .
                             '<a href="../soo/?mod=forum&amp;act=say&amp;sid='. $sid .'&amp;id=' . $res['id'] . '&amp;start=' . $start . '&amp;cyt">' . $lng_forum['cytate_btn'] . '</a> ';
                    }
                    // Время поста
                    echo ' <span class="gray">(' . functions::display_date($res['time']) . ')</span><br />';
                    // Статус юзера
                    if (!empty($res['status']))
                        echo '<div class="status"><img src="../theme/' . $set_user['skin'] . '/images/label.png" alt="" align="middle"/>&#160;' . $res['status'] . '</div>';
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
                        echo bbcode::notags($text) . '...<br /><a href="../soo/?mod=forum&amp;act=post&amp;id=' . $res['id'] . '">' . $lng_forum['read_all'] . ' &gt;&gt;</a>';
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
                    $freq = mysql_query("SELECT * FROM `soo_forum_files` WHERE `post` = '" . $res['id'] . "'");
                    if (mysql_num_rows($freq) > 0) {
                        $fres = mysql_fetch_assoc($freq);
                        $fls = round(@filesize('../files/soo/forum/attach/' . $fres['filename']) / 1024, 2);
                        echo '<br /><span class="gray">' . $lng_forum['attached_file'] . ':';
                        // Предпросмотр изображений
                        $att_ext = strtolower(functions::format('./files/soo/forum/attach/' . $fres['filename']));
                        $pic_ext = array(
                            'gif',
                            'jpg',
                            'jpeg',
                            'png'
                        );
                        if (in_array($att_ext, $pic_ext)) {
                            echo '<div><a href="../soo/?mod=forum&amp;act=file&amp;id=' . $fres['id'] . '">';
                            echo '<img src="thumbinal.php?file=' . (urlencode($fres['filename'])) . '" alt="' . $lng_forum['click_to_view'] . '" /></a></div>';
                        } else {
                            echo '<br /><a href="../soo/?mod=forum&amp;act=file&amp;id=' . $fres['id'] . '">' . $fres['filename'] . '</a>';
                        }
                        echo ' (' . $fls . ' кб.)<br/>';
                        echo $lng_forum['downloads'] . ': ' . $fres['dlcount'] . ' ' . $lng_forum['time'] . '</span>';
                        $file_id = $fres['id'];
                    }
                    $us = mysql_fetch_array(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = ' " . $sid . " ' AND `user_id`=' " . $user_id . " '  "));
                    if ((($us['rights'] >= 8 || $curator) && $rights >= $res['rights']) || ($res['user_id'] == $user_id && !$set_forum['upfp'] && ($start + $i) == $colmes && $res['time'] > time() - 300) || ($res['user_id'] == $user_id && $set_forum['upfp'] && $start == 0 && $i == 1 && $res['time'] > time() - 300)) {
                        // Ссылки на редактирование / удаление постов
                        $menu = array(
                            '<a href="../soo/?mod=forum&amp;act=editpost&amp;id=' . $res['id'] . '">' . $lng['edit'] . '</a>',
                            ($us['rights'] >= 8 && $res['close'] == 1 ? '<a href="../soo/?mod=forum&amp;act=editpost&amp;do=restore&amp;sid='. $sid .'&amp;id=' . $res['id'] . '">' . $lng_forum['restore'] . '</a>' : ''),
                            ($res['close'] == 1 ? '' : '<a href="../soo/?mod=forum&amp;act=editpost&amp;do=del&amp;sid='. $sid .'&amp;id=' . $res['id'] . '">' . $lng['delete'] . '</a>')
                        );
                        echo '<div class="sub">';
                        if ($us['rights'] >= 8)
                            echo '<input type="checkbox" name="delch[]" value="' . $res['id'] . '"/>&#160;';
                        echo functions::display_menu($menu);
                        if ($res['close']) {
                            echo '<div class="red">' . $lng_forum['who_delete_post'] . ': <b>' . $res['close_who'] . '</b></div>';
                        } elseif (!empty($res['close_who'])) {
                            echo '<div class="green">' . $lng_forum['who_restore_post'] . ': <b>' . $res['close_who'] . '</b></div>';
                        }
                        if ($us['rights'] >= 8) {
                            if ($res['ip_via_proxy']) {
                                echo '<div class="gray"><b class="red"><a href="' . $set['homeurl'] . '/' . $set['admp'] . '../soo/?mod=forum&amp;act=search_ip&amp;ip=' . long2ip($res['ip']) . '">' . long2ip($res['ip']) . '</a></b> - ' .
                                     '<a href="' . $set['homeurl'] . '/' . $set['admp'] . '../soo/?mod=forum&amp;act=search_ip&amp;ip=' . long2ip($res['ip_via_proxy']) . '">' . long2ip($res['ip_via_proxy']) . '</a>' .
                                     ' - ' . $res['soft'] . '</div>';
                            } else {
                                echo '<div class="gray"><a href="' . $set['homeurl'] . '/' . $set['admp'] . '../soo/?mod=forum&amp;act=search_ip&amp;ip=' . long2ip($res['ip']) . '">' . long2ip($res['ip']) . '</a> - ' . $res['soft'] . '</div>';
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
                if (($user_id && !$type1['edit'] && !$set_forum['upfp'] && $set['mod_forum'] != 3) || ($rights >= 7 && !$set_forum['upfp'])) {
                    echo '<div class="gmenu"><form name="form2" action="../soo/?mod=forum&amp;act=say&amp;sid='. $sid .'&amp;id=' . $id . '" method="post">';
                    if ($set_forum['farea']) {
                        echo '<p>';
                        if (!$is_mobile)
                            echo bbcode::auto_bb('form2', 'msg');
                        echo '<textarea rows="' . $set_user['field_h'] . '" name="msg"></textarea><br/></p>' .
                             '<p><input type="checkbox" name="addfiles" value="1" /> ' . $lng_forum['add_file'];
                        if ($set_user['translit'])
                            echo '<br /><input type="checkbox" name="msgtrans" value="1" /> ' . $lng['translit'];
                        echo '</p><p><input type="submit" name="submit" value="' . $lng['write'] . '" style="width: 107px; cursor: pointer;"/> ' .
                             ($set_forum['preview'] ? '<input type="submit" value="' . $lng['preview'] . '" style="width: 107px; cursor: pointer;"/>' : '') .
                             '</p></form></div>';
                    } else {
                        echo '<p><input type="submit" name="submit" value="' . $lng['write'] . '"/></p></form></div>';
                    }
                }
                echo '<div class="phdr"><a name="down" id="down"></a><a href="#up">' .
                     '<img src="../theme/' . $set_user['skin'] . '/images/up.png" alt="' . $lng['up'] . '" width="20" height="10" border="0"/></a>' .
                     '&#160;&#160;' . $lng['total'] . ': ' . $colmes . '</div>';
                if ($colmes > $kmess) {
                    echo '<div class="topmenu">' . functions::display_pagination('../soo/?mod=forum&amp;sid='. $sid .'&amp;id=' . $id . '&amp;', $start, $colmes, $kmess) . '</div>' .
                         '<p><form action="../soo/?mod=forum&amp;id=' . $id . '" method="post">' .
                         '<input type="text" name="page" size="2"/>' .
                         '<input type="submit" value="' . $lng['to_page'] . ' &gt;&gt;"/>' .
                         '</form></p>';
                } else {
                    echo '<br />';
                }
                /*
                -----------------------------------------------------------------
                Ссылки на модераторские функции
                -----------------------------------------------------------------
                */
                if ($curators) {
                    $array = array();
                    foreach ($curators as $key => $value)
                        $array[] = '<a href="../users/profile.php?user=' . $key . '">' . $value . '</a>';
                    echo '<p><div class="func">' . $lng_forum['curators'] . ': ' . implode(', ', $array) . '</div></p>';
                }
                $us = mysql_fetch_array(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = ' " . $sid . " ' AND `user_id`=' " . $user_id . " '  "));
                if ($us['rights'] >= 8) {
                    echo '<p><div class="func">';
                    if ($us['rights'] >= 8)
                        echo '<a href="../soo/?mod=forum&amp;act=curators&amp;sid='. $sid .'&amp;id=' . $id . '&amp;start=' . $start . '">' . $lng_forum['curators_of_the_topic'] . '</a><br />';
                    echo isset($topic_vote) && $topic_vote > 0
                            ? '<a href="../soo/?mod=forum&amp;act=editvote&amp;sid='. $sid .'&amp;id=' . $id . '">' . $lng_forum['edit_vote'] . '</a><br/><a href="../soo/?mod=forum&amp;act=delvote&amp;sid='. $sid .'&amp;id=' . $id . '">' . $lng_forum['delete_vote'] . '</a><br/>'
                            : '<a href="../soo/?mod=forum&amp;act=addvote&amp;sid='. $sid .'&amp;id=' . $id . '">' . $lng_forum['add_vote'] . '</a><br/>';
                    echo '<a href="../soo/?mod=forum&amp;act=ren&amp;sid='. $sid .'&amp;id=' . $id . '">' . $lng_forum['topic_rename'] . '</a><br/>';
                    // Закрыть - открыть тему
                    if ($type1['edit'] == 1)
                        echo '<a href="../soo/?mod=forum&amp;act=close&amp;sid='. $sid .'&amp;id=' . $id . '">' . $lng_forum['topic_open'] . '</a><br/>';
                    else
                        echo '<a href="../soo/?mod=forum&amp;act=close&amp;sid='. $sid .'&amp;id=' . $id . '&amp;closed">' . $lng_forum['topic_close'] . '</a><br/>';
                    // Удалить - восстановить тему
                    if ($type1['close'] == 1)
                        echo '<a href="../soo/?mod=forum&amp;act=restore&amp;sid='. $sid .'&amp;id=' . $id . '">' . $lng_forum['topic_restore'] . '</a><br/>';
                    echo '<a href="../soo/?mod=forum&amp;act=deltema&amp;sid='. $sid .'&amp;id=' . $id . '">' . $lng_forum['topic_delete'] . '</a><br/>';
                    if ($type1['vip'] == 1)
                        echo '<a href="../soo/?mod=forum&amp;act=vip&amp;sid='. $sid .'&amp;id=' . $id . '">' . $lng_forum['topic_unfix'] . '</a>';
                    else
                        echo '<a href="../soo/?mod=forum&amp;act=vip&amp;sid='. $sid .'&amp;id=' . $id . '&amp;vip">' . $lng_forum['topic_fix'] . '</a>';
                    echo '<br/><a href="../soo/?mod=forum&amp;act=per&amp;sid='. $sid .'&amp;id=' . $id . '">' . $lng_forum['topic_move'] . '</a></div></p>';
                }
                if ($wholink)
                    echo '<div>' . $wholink . '</div>';
                if ($filter)
                    echo '<div><a href="../soo/?mod=forum&amp;act=filter&amp;sid='. $sid .'&amp;id=' . $id . '&amp;do=unset">' . $lng_forum['filter_cancel'] . '</a></div>';
                else
                    echo '<div><a href="../soo/?mod=forum&amp;act=filter&amp;sid='. $sid .'&amp;id=' . $id . '&amp;start=' . $start . '">' . $lng_forum['filter_on_author'] . '</a></div>';
                echo '<a href="../soo/?mod=forum&amp;act=tema&amp;sid='. $sid .'&amp;id=' . $id . '">' . $lng_forum['download_topic'] . '</a>';
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
                         $res2 = mysql_fetch_assoc(mysql_query("SELECT * FROM `soo_forum` WHERE `sid`='$sid'"));
                if($res2 == 0){
                echo    'Thể loại không có!';
                require_once ('../incfiles/end.php');
                exit;
                }
                else
                {
        /*
        -----------------------------------------------------------------
        Список Категорий форума
        -----------------------------------------------------------------
        */
        $headmod = 'soo';
        $sid = isset($_REQUEST['sid']) ? abs(intval($_REQUEST['sid'])) : false;
        $count = mysql_result(mysql_query("SELECT COUNT(*) FROM `soo_forum_files`" . ($rights >= 7 ? '' : " WHERE `del` != '1'  ")), 0);
        echo 
             '<div class="phdr"><b>' . $lng['forum'] . '</b></div>' .
             '<div class="topmenu"><a href="search.php">' . $lng['search'] . '</a> | <a href="../soo/?mod=forum&amp;act=files&amp;sid='. $sid .'">' . $lng_forum['files_forum'] . '</a> <span class="red">(' . $count . ')</span></div>';
        $req = mysql_query("SELECT `id`, `text`, `soft` FROM `soo_forum` WHERE `type`='f' AND `sid` = $sid ORDER BY `realid`");
        $i = 0;
        while (($res = mysql_fetch_array($req)) !== false) {
            echo $i % 2 ? '<div class="list2">' : '<div class="list1">';
            $count = mysql_result(mysql_query("SELECT COUNT(*) FROM `soo_forum` WHERE `sid` = '".$sid."' `type`='r' and `refid`='" . $res['id'] . "'"), 0);
            echo '<a href="../soo/?mod=forum&amp;sid='. $sid .'&amp;id=' . $res['id'] . '">' . $res['text'] . '</a> ';
            if ($count)
                            echo " ['" . $count . "']";
            if (!empty($res['soft']))
                echo '<div class="sub"><span class="gray">' . $res['soft'] . '</span></div>';
            echo '</div>';
            ++$i;
        }
unset($_SESSION['fsort_id']);
        unset($_SESSION['fsort_users']);
    }

    // Навигация внизу страницы
    echo '<p>' . ($id ? '<a href="../soo/?mod=forum&amp;sid='. $sid .'">' . $lng['to_forum'] . '</a><br />' : '');

    echo '</p>';
    if (!$user_id) {
        if ((empty($_SESSION['uppost'])) || ($_SESSION['uppost'] == 0)) {
            echo '<a href="../soo/?mod=forum&amp;id=' . $id . '&amp;page=' . $page . '&amp;newup">' . $lng_forum['new_on_top'] . '</a>';
        } else {
            echo '<a href="../soo/?mod=forum&amp;id=' . $id . '&amp;page=' . $page . '&amp;newdown">' . $lng_forum['new_on_bottom'] . '</a>';
        }
    }
}
    
    
    
    
    break;
    }
    
    
    
    
    
    
    
    
    
    
default:

require('../incfiles/head.php');
/*
-----------------------------------------------------------------
Переключаем режимы работы
-----------------------------------------------------------------
*/
$mods = array(
     'soo' => 'includes/soo',
     'usersoo' => 'includes/soo',
     'ban' => 'includes/soo',
     'bans' => 'includes/soo',
     'del' => 'includes/soo',
     'info' => 'includes/soo',
     'users' => 'includes/soo',
     'in' => 'includes/soo',
     'out' => 'includes/soo',
     'new' => 'includes/soo',
     'msoo' => 'includes/soo',
     'edit' => 'includes/soo',
     'img' => 'includes/soo',
     'deluser' => 'includes/soo',
     'eduser' => 'includes/soo'

);
$path = !empty($mods[$act]) ? $mods[$act] . '/' : '';
if (array_key_exists($act, $mods) && file_exists($path . $act . '.php')) {
    require($path . $act . '.php');
} else {
    


if ($id) {
        
        /*
        -----------------------------------------------------------------
        Определяем тип запроса 
        -----------------------------------------------------------------
        */
        $type = mysql_query("SELECT * FROM `soo` WHERE `type` = '1' AND `id`= '$id'");
        if (!mysql_num_rows($type)) {
            // Если сообщества не существует, показываем ошибку
            echo functions::display_error('không có dữ liệu', '<a href="../soo">Bang Hội</a>');
            require('../incfiles/end.php');
            exit;
        }
        $type1 = mysql_fetch_assoc($type);

        

        /*
        -----------------------------------------------------------------
        Отрбражаем содержимое сообществ
        -----------------------------------------------------------------
        */

            
                            /*
                -----------------------------------------------------------------
                Список сообществ 
                -----------------------------------------------------------------
                */
                $req = mysql_query("SELECT * FROM `soo` WHERE `type`='2' AND `cat`='$id' ORDER BY `id` DESC, `name` DESC LIMIT $start, $kmess");
                $total = mysql_num_rows(mysql_query("SELECT * FROM `soo` WHERE `type`='2' AND `cat`='$id' "));
                $catid = $id;
                $res_soo = mysql_fetch_assoc(mysql_query("SELECT * FROM `soo` WHERE `type` = '1' AND `id` = '$catid' LIMIT 1"));
                $tree[] = $i ? '<a href="../soo/?soid=' . $soid . '">' . functions::checkout($res_soo['name']) . '</a>' : functions::checkout($res_soo['name']);
                $tree[] = '<a href="../soo"><b>Bang Hội</b></a>';
                krsort($tree);
                echo '<div class="phdr">' . functions::display_menu($tree) . '</div>';
                
                if ($user_id)
                echo '<div class="tmn"><a href="../soo/?act=new&amp;id='. $id .'">Tạo Bang Hội</a></div>';
                
                if ($total) {
                    $i = 0;
                    while (($res = mysql_fetch_assoc($req)) !== false) {
                        echo $i % 2 ? '<div class="list2">' : '<div class="list1">';
                        $coltem = mysql_result(mysql_query("SELECT COUNT(*) FROM `soo` WHERE `type` = '2' AND `cat` = '" . $res['id'] . "'"), 0);
                        if($res['mod'] == 0)
                        echo '<img src="../images/soo/soo_open.gif" alt="' . $res['id'] . '"/><a href="?act=soo&amp;id=' . $res['id'] . '"> ' . $res['name'] . '</a>';
                        if($res['mod'] == 1)
                        echo '<img src="../images/soo/soo_closed.gif" alt="' . $res['id'] . '"/><a href="?act=soo&amp;id=' . $res['id'] . '"> ' . $res['name'] . '</a>';   
                        if($res['mod'] == 2)
                        echo '<img src="../images/soo/soo_un.gif" alt="' . $res['id'] . '"/><a href="?act=soo&amp;id=' . $res['id'] . '"> ' . $res['name'] . '</a>';                   
                        if (!empty($res['desc']))
                            echo '<div class="sub"><span class="gray">' . $res['desc'] . '</span></div>';
                        echo '</div>';
                        ++$i;
                    }
                } else {
                    echo '<div class="menu"><p>Không Có Bang Hội!</p></div>';
                }
                
                echo '<div class="phdr">' . $lng['total'] . ': ' . $total . '</div>';
                
                if ($total > $kmess) {
                    echo '<div class="topmenu">' . functions::display_pagination('../soo/../soo/?mod=forum&amp;sid='. $sid .'&amp;id=' . $id . '&amp;', $start, $total, $kmess) . '</div>' .
                         '<p><form action="../soo/?id=' . $id . '" method="post">' .
                         '<input type="text" name="page" size="2"/>' .
                         '<input type="submit" value="' . $lng['to_page'] . ' &gt;&gt;"/>' .
                         '</form></p>';
                }
                

            

        

    }else {
        /*
        -----------------------------------------------------------------
        Список Категорий Сообществ
        -----------------------------------------------------------------
        */
         $res2 = mysql_fetch_assoc(mysql_query("SELECT * FROM `soo_forum` WHERE `type` = '1' AND `sid`='$sid'"));
           
        echo '<div class="phdr"><b>Bang Hội</b></div>';
        $req = mysql_query("SELECT * FROM `soo` WHERE `type`='1' ");
        $total = mysql_num_rows(mysql_query("SELECT * FROM `soo` WHERE `type`='1'  "));
        $i = 0;
        if($total > 0){
        while ($res = mysql_fetch_array($req)) {
            $totals = mysql_num_rows(mysql_query("SELECT * FROM `soo` WHERE `type`='2' AND `cat`='" . $res['id'] . "' "));
            echo $i % 2 ? '<div class="list2">' : '<div class="list1">';
            echo '<a href="../soo/?id=' . $res['id'] . '">' . $res['name'] . '</a> ('. $totals .') ';
            if (!empty($res['desc']))
            echo '<div class="sub"><span class="gray">' . $res['desc'] . '</span></div>';
            echo '</div>';
            ++$i;
            
        }
        echo '<div class="phdr">' . $lng['total'] . ': ' . $total . '</div>';
        echo '<div class="func"><a href="../soo/?act=msoo">Quản Lý</a></div>';
        } else {
            echo functions::display_error('Thể loại Không có!');
            if ($rights >= 8){
                echo '<div class="func"><a href="../soo/?act=msoo">Quản Lý</a></div>';
            }
            require_once('../incfiles/end.php');
        }
        
    
        }
        
        break;
        
        }
        
        }
 
require_once('../incfiles/end.php');
?>