<?php

/*
WMR: R118530587041
ICQ: 365848916
Автор: VladiSs
Сайт: http://wapnex.ru
*/
defined('_IN_JOHNCMS') or die('Error: restricted access');

require_once('../incfiles/core.php');
require_once('../incfiles/head.php');
// Проверяем права доступа
$us = mysql_fetch_array(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = ' " . $sid . " ' AND `user_id`=' " . $user_id . " '  "));

if ($us['rights'] < 8){
    header('Location: http://johncms.com/?err');
    exit;
}

// Подключаем языковый файл форума
$lng_forum = core::load_lng('forum');

// Задаем пользовательские настройки форума
$set_forum = unserialize($datauser['set_forum']);
if (!isset($set_forum) || empty($set_forum))
    $set_forum = array(
        'farea' => 0,
        'upfp' => 0,
        'farea_w' => 20,
        'farea_h' => 4,
        'postclip' => 1,
        'postcut' => 2
    );
    
$us = mysql_fetch_array(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = ' " . $sid . " ' AND `user_id`=' " . $user_id . " '  "));

if ($us['rights'] >= 8){
    
    
switch ($do) {
    case 'del':
        /*
        -----------------------------------------------------------------
        Удаление категории, или раздела
        -----------------------------------------------------------------
        */
        if (!$id) {
            echo functions::display_error($lng['error_wrong_data']);
            require('../incfiles/end.php');
            exit;
        }
        $req = mysql_query("SELECT * FROM `soo_forum` WHERE `id` = '$id' AND `type` = 'r'");
        if (mysql_num_rows($req)) {
            $res = mysql_fetch_assoc($req);
            echo '<div class="phdr"><b>' . ($res['type'] == 'r' ? $lng_forum['delete_section'] : $lng_forum['delete_catrgory']) . ':</b> ' . $res['text'] . '</div>';
            // Проверяем, есть ли подчиненная информация
            $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `soo_forum` WHERE `refid` = '$id' AND (`type` = 'f' OR `type` = 'r' OR `type` = 't')"), 0);
            if ($total) {
                if ($res['type'] == 'r') {
                    ////////////////////////////////////////////////////////////
                    // Удаление раздела с подчиненными данными                //
                    ////////////////////////////////////////////////////////////
                                    if (isset($_POST['submit'])) {
                                           // Удаляем файлы
                        $req_f = mysql_query("SELECT * FROM `soo_forum_files` WHERE `subcat` = '$id'");
                        while ($res_f = mysql_fetch_assoc($req_f)) {
                            unlink('../files/soo/forum/attach/' . $res_f['filename']);
                        }
                        mysql_query("DELETE FROM `soo_forum_files` WHERE `subcat` = '$id'");
                        // Удаляем посты, голосования и метки прочтений
                        $req_t = mysql_query("SELECT `id` FROM `soo_forum` WHERE `refid` = '$id' AND `type` = 't'");
                        while ($res_t = mysql_fetch_assoc($req_t)) {
                            mysql_query("DELETE FROM `soo_forum` WHERE `refid` = '" . $res_t['id'] . "'");
                            mysql_query("DELETE FROM `soo_forum_vote` WHERE `topic` = '" . $res_t['id'] . "'");
                            mysql_query("DELETE FROM `soo_forum_vote_users` WHERE `topic` = '" . $res_t['id'] . "'");
                            mysql_query("DELETE FROM `soo_forum_rdm` WHERE `topic_id` = '" . $res_t['id'] . "'");
                        }
                        // Удаляем темы
                        mysql_query("DELETE FROM `soo_forum` WHERE `refid` = '$id'");
                        // Удаляем раздел
                        mysql_query("DELETE FROM `soo_forum` WHERE `id` = '$id'");
                        // Оптимизируем таблицы
                        mysql_query("OPTIMIZE TABLE `soo_forum_files` , `soo_forum_rdm` , `soo_forum` , `soo_forum_vote` , `soo_forum_vote_users`");
                        echo '<div class="rmenu"><p>' . $lng_forum['section_themes_deleted'] . '<br />' .
                             '<a href="../soo/?mod=forum&amp;act=mforum&amp;do=cat&amp;sid='. $sid .'&amp;rid='. $rid .'&amp;id=' . $res['refid'] . '">' . $lng_forum['to_category'] . '</a></p></div>';
                    
                } else {
                    $rid = isset($_REQUEST['rid']) ? abs(intval($_REQUEST['rid'])) : false;
                    echo '<div class="rmenu"><p>Bạn có chắc bạn muốn xóa tất cả các thông tin?</p>' .
                         '<p><form action="../soo/?mod=forum&amp;act=mforum&amp;do=del&amp;sid='. $sid .'&amp;rid='. $rid .'&amp;id=' . $id . '" method="POST">' .
                         '<input type="submit" name="submit" value="' . $lng['delete'] . '" />' .
                         '</form></p></div>';
                }
                }
            } else {
                ////////////////////////////////////////////////////////////
                // Удаление пустого раздела, или категории                //
                ////////////////////////////////////////////////////////////
                if (isset($_POST['submit'])) {
                    mysql_query("DELETE FROM `soo_forum` WHERE `id` = '$id'");
                    echo '<div class="rmenu"><p>' . ($res['type'] == 'r' ? $lng_forum['section_deleted'] : $lng_forum['category_deleted']) . '</p></div>';
                } else {
                    $rid = isset($_REQUEST['rid']) ? abs(intval($_REQUEST['rid'])) : false;
                    echo '<div class="rmenu"><p>' . $lng['delete_confirmation'] . '</p>' .
                         '<p><form action="../soo/?mod=forum&amp;act=mforum&amp;do=del&amp;sid='. $sid .'&amp;rid='. $rid .'&amp;id=' . $id . '" method="POST">' .
                         '<input type="submit" name="submit" value="' . $lng['delete'] . '" />' .
                         '</form></p></div>';
                }
            }
            $rid = isset($_REQUEST['rid']) ? abs(intval($_REQUEST['rid'])) : false;
            echo '<div class="phdr"><a href="../soo/?mod=forum&amp;act=mforum&amp;do=cat&amp;sid='. $sid .'&amp;id='. $rid .'">' . $lng['back'] . '</a></div>';
        } else {
            header('Location: ../soo/?mod=forum&act=mforum&do=cat');
        }
        break;

    case 'add':
        /*
        -----------------------------------------------------------------
        Добавление категории
        -----------------------------------------------------------------
        */
        if ($id) {
            // Проверяем наличие категории
            $req = mysql_query("SELECT `text` FROM `soo_forum` WHERE `id` = '$id' AND `type` = 'f'");
            if (mysql_num_rows($req)) {
                $res = mysql_fetch_array($req);
                $cat_name = $res['text'];
            } else {
                echo functions::display_error($lng['error_wrong_data']);
                require('../incfiles/end.php');
                exit;
            }
        }
        if (isset($_POST['submit'])) {
            // Принимаем данные
            $name = isset($_POST['name']) ? functions::check($_POST['name']) : '';
            $desc = isset($_POST['desc']) ? functions::check($_POST['desc']) : '';
            // Проверяем на ошибки
            $error = array();
            if (!$name)
                $error[] = $lng['error_empty_title'];
            if ($name && (mb_strlen($name) < 2 || mb_strlen($name) > 30))
                $error[] = $lng['title'] . ': ' . $lng['error_wrong_lenght'];
            if ($desc && mb_strlen($desc) < 2)
                $error[] = $lng['error_description_lenght'];
            if (!$error) {
                // Добавляем в базу категорию
                $req = mysql_query("SELECT `realid` FROM `soo_forum` WHERE " . ($id ? "`refid` = '$id' AND `type` = 'r'" : "`type` = 'f'") . " ORDER BY `realid` DESC LIMIT 1");
                if (mysql_num_rows($req)) {
                    $res = mysql_fetch_assoc($req);
                    $sort = $res['realid'] + 1;
                } else {
                    $sort = 1;
                }
                $sid = isset($_REQUEST['sid']) ? abs(intval($_REQUEST['sid'])) : false;
                mysql_query("INSERT INTO `soo_forum` SET
                `refid` = '" . ($id ? $id : '') . "',
                `type` = 'r',
                `text` = '$name',
                `soft` = '$desc',
                `realid` = '$sort',
                `sid` = '$sid'");
                header('Location: ../soo/?mod=forum&act=mforum&sid='. $sid .'&do=cat' . ($id ? '&id=' . $id : ''));
            } else {
                // Выводим сообщение об ошибках
                echo functions::display_error($error);
            }
        } else {
            // Форма ввода
            echo '<div class="phdr"><b>' . ($id ? $lng_forum['add_section'] : $lng_forum['add_category']) . '</b></div>';
            if ($id)
                echo '<div class="bmenu"><b>Bang Hội:</b> ' . $cat_name . '</div>';
            echo '<form action="../soo/?mod=forum&amp;act=mforum&amp;sid='. $sid .'&amp;do=add' . ($id ? '&amp;id=' . $id : '') . '" method="post">' .
                 '<div class="gmenu">' .
                 '<p><h3>' . $lng['title'] . '</h3>' .
                 '<input type="text" name="name" />' .
                 '<br /><small>' . $lng['minmax_2_30'] . '</small></p>' .
                 '<p><h3>' . $lng['description'] . '</h3>' .
                 '<textarea name="desc" rows="' . $set_user['field_h'] . '"></textarea>' .
                 '<br /><small>' . $lng['not_mandatory_field'] . '<br />' . $lng['minmax_2_500'] . '</small></p>' .
                 '<p><input type="submit" value="' . $lng['add'] . '" name="submit" />' .
                 '</p></div></form>' .
                 '<div class="phdr"><a href="../soo/?mod=forum&amp;act=mforum&amp;sid='. $sid .'&amp;do=cat' . ($id ? '&amp;id=' . $id : '') . '">' . $lng['back'] . '</a></div>';
        }
        break;

    case 'edit':
        /*
        -----------------------------------------------------------------
        Редактирование выбранной категории, или раздела
        -----------------------------------------------------------------
        */
        if (!$id) {
            echo functions::display_error($lng['error_wrong_data']);
            require('../incfiles/end.php');
            exit;
        }
        $req = mysql_query("SELECT * FROM `soo_forum` WHERE `id` = '$id'");
        if (mysql_num_rows($req)) {
            $res = mysql_fetch_assoc($req);
            if ($res['type'] == 'r') {
                if (isset($_POST['submit'])) {
                    // Принимаем данные
                    $name = isset($_POST['name']) ? functions::check($_POST['name']) : '';
                    $desc = isset($_POST['desc']) ? functions::check($_POST['desc']) : '';
                    // проверяем на ошибки
                    $error = array();

                    if (!$name)
                        $error[] = $lng['error_empty_title'];
                    if ($name && (mb_strlen($name) < 2 || mb_strlen($name) > 30))
                        $error[] = $lng['title'] . ': ' . $lng['error_wrong_lenght'];
                    if ($desc && mb_strlen($desc) < 2)
                        $error[] = $lng['error_description_lenght'];
                    if (!$error) {
                        // Записываем в базу
                        mysql_query("UPDATE `soo_forum` SET
                            `text` = '$name',
                            `soft` = '$desc'
                            WHERE `id` = '$id'");
                        if ($res['type'] == 'r' && $category != $res['refid']) {
                            // Вычисляем сортировку
                            $req_s = mysql_query("SELECT `realid` FROM `soo_forum` WHERE `refid` = '$eid' AND `type` = 'r' ORDER BY `realid` DESC LIMIT 1");
                            $res_s = mysql_fetch_assoc($req_s);
                            $sort = $res_s['realid'] + 1;
                            // Меняем категорию
                            $rid = isset($_REQUEST['rid']) ? abs(intval($_REQUEST['rid'])) : false;
                            mysql_query("UPDATE `soo_forum` SET `refid` = '$rid', `realid` = '$sort' WHERE `id` = '$id'");
                            // Меняем категорию для прикрепленных файлов
                            mysql_query("UPDATE `soo_forum_files` SET `cat` = '$rid' WHERE `cat` = '" . $res['refid'] . "'");
                        }
                        header('Location: ../soo/?mod=forum&act=mforum&sid='. $sid .'&do=cat' . ($res['type'] == 'r' ? '&id=' . $res['refid'] : ''));
                    } else {
                        // Выводим сообщение об ошибках
                        echo functions::display_error($error);
                    }
                } else {
                    // Форма ввода
                    $rid = isset($_REQUEST['rid']) ? abs(intval($_REQUEST['rid'])) : false;
                    echo '<div class="phdr"><b>' . ($res['type'] == 'r' ? $lng_forum['section_edit'] : $lng_forum['category_edit']) . '</b></div>' .
                         '<form action="../soo/?mod=forum&amp;act=mforum&amp;do=edit&amp;rid='. $rid .'&amp;sid='. $sid .'&amp;id=' . $id . '" method="post">' .
                         '<div class="gmenu">' .
                         '<p><h3>' . $lng['title'] . '</h3>' .
                         '<input type="text" name="name" value="' . $res['text'] . '"/>' .
                         '<br /><small>' . $lng['minmax_2_30'] . '</small></p>' .
                         '<p><h3>' . $lng['description'] . '</h3>' .
                         '<textarea name="desc" rows="' . $set_user['field_h'] . '">' . str_replace('<br />', "\r\n", $res['soft']) . '</textarea>' .
                         '<br /><small>' . $lng['not_mandatory_field'] . '<br />' . $lng['minmax_2_500'] . '</small></p>';

                    echo '<p><input type="submit" value="' . $lng['save'] . '" name="submit" />' .
                         '</p></div></form>' .
                         '<div class="phdr"><a href="../soo/?mod=forum&amp;act=mforum&amp;sid='. $sid .'&amp;do=cat' . ($res['type'] == 'r' ? '&amp;id=' . $res['refid'] : '') . '">' . $lng['back'] . '</a></div>';
                }
            } else {
                header('Location: ../soo/?mod=forum&act=mforum&do=cat');
            }
        } else {
            header('Location: ../soo/?mod=forum&act=mforum&do=cat');
        }
        break;

    case 'cat':
        /*
        -----------------------------------------------------------------
        Управление категориями и разделами
        -----------------------------------------------------------------
        */
        echo '<div class="phdr"><a href="../soo/?act=soo&amp;id='. $sid .'">Bang Hội </a> | <a href="../soo/?mod=forum&amp;sid='. $sid .'&amp;id='. $id .'">Форум </a> | ' . $lng_forum['forum_structure'] . '</div>';

if ($id) {
            // Управление разделами
            $req = mysql_query("SELECT `text` FROM `soo_forum` WHERE `id` = '$id' AND `type` = 'f'");
            $res = mysql_fetch_assoc($req);
            echo '<div class="bmenu">' . $lng_forum['section_list'] . '</div>';
            $req = mysql_query("SELECT * FROM `soo_forum` WHERE `refid` = '$id' AND `type` = 'r' ORDER BY `realid` ASC");
            if (mysql_num_rows($req)) {
                while ($res = mysql_fetch_assoc($req)) {
                    echo $i % 2 ? '<div class="list2">' : '<div class="list1">';
                    echo '<b>' . $res['text'] . '</b>' .
                         '&#160;<a href="../soo/?mod=forum&amp;sid='. $sid .'&amp;id=' . $res['id'] . '">&gt;&gt;</a>';
                    if (!empty($res['soft']))
                        echo '<br /><span class="gray"><small>' . $res['soft'] . '</small></span><br />';
                    echo '<div class="sub">' .
                         '<a href="../soo/?mod=forum&amp;act=mforum&amp;do=edit&amp;sid='. $sid .'&amp;rid='. $id .'&amp;id=' . $res['id'] . '">' . $lng['edit'] . '</a> | ' .
                         '<a href="../soo/?mod=forum&amp;act=mforum&amp;do=del&amp;sid='. $sid .'&amp;rid='. $id .'&amp;id=' . $res['id'] . '">' . $lng['delete'] . '</a>' .
                         '</div></div>';
                    ++$i;
                }
            } else {
                echo '<div class="menu"><p>' . $lng['list_empty'] . '</p></div>';
            }
        }
        else 
        {
        echo functions::display_error('Ошибка!');
        require('../incfiles/end.php');
        exit;
        }
        
        echo '<div class="gmenu">' .
             '<form action="../soo/?mod=forum&amp;act=mforum&amp;sid='. $sid .'&amp;do=add' . ($id ? '&amp;id=' . $id : '') . '" method="post">' .
             '<input type="submit" value="' . $lng['add'] . '" />' .
             '</form></div>';
        break;


    default:
        /*
        -----------------------------------------------------------------
        Панель управления форумом
        -----------------------------------------------------------------
        */
        echo functions::display_error('Ошибка!');
        require('../incfiles/end.php');
        exit;
}
}
require('../incfiles/end.php');
break;
?>