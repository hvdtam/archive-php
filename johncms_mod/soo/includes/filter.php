<?php

/*
WMR: R118530587041
ICQ: 365848916
Автор: VladiSs
Сайт: http://wapnex.ru
*/

defined('_IN_JOHNCMS') or die('Error: restricted access');
require('../incfiles/head.php');
if (!$id) {
    echo functions::display_error($lng['error_wrong_data'], '<a href="../soo/?mod=forum&amp;sid='. $sid .'&amp;id='. $id .'">' . $lng['to_forum'] . '</a>');
    require('../incfiles/end.php');
    exit;
}
switch ($do) {
    case 'unset':
        /*
        -----------------------------------------------------------------
        Удаляем фильтр
        -----------------------------------------------------------------
        */
        unset($_SESSION['fsort_id']);
        unset($_SESSION['fsort_users']);
        header("Location: ../soo/?mod=forum&sid=$sid&id=$id");
        break;

    case 'set':
        /*
        -----------------------------------------------------------------
        Устанавливаем фильтр по авторам
        -----------------------------------------------------------------
        */
        $users = isset($_POST['users']) ? $_POST['users'] : '';
        if (empty($_POST['users'])) {
            echo '<div class="rmenu"><p>' . $lng_forum['error_author_select'] . '<br /><a href="../soo/?mod=forum&amp;act=filter&amp;sid='. $sid .'&amp;id=' . $id . '&amp;start=' . $start . '">' . $lng['back'] . '</a></p></div>';
            require('../incfiles/end.php');
            exit;
        }
        $array = array ();
        foreach ($users as $val) {
            $array[] = intval($val);
        }
        $_SESSION['fsort_id'] = $id;
        $_SESSION['fsort_users'] = serialize($array);
        header("Location: ../soo/?mod=forum&sid=$sid&id=$id");
        break;

    default :
        /*
        -----------------------------------------------------------------
        Показываем список авторов темы, с возможностью выбора
        -----------------------------------------------------------------
        */
        $req = mysql_query("SELECT *, COUNT(`from`) AS `count` FROM `soo_forum` WHERE `refid` = '$id' GROUP BY `from` ORDER BY `from`");
        $req = mysql_query("SELECT *, COUNT(`from`) AS `count` FROM `soo_forum` WHERE `refid` = '$id' GROUP BY `from` ORDER BY `from`");
        $total = mysql_num_rows($req);
        if ($total > 0) {
            echo '<div class="phdr"><a href="../soo/?mod=forum&amp;sid='. $sid .'&amp;id=' . $id . '&amp;start=' . $start . '"><b>' . $lng['forum'] . '</b></a> | ' . $lng_forum['filter_on_author'] . '</div>' .
                '<form action="../soo/?mod=forum&amp;act=filter&amp;sid='. $sid .'&amp;id=' . $id . '&amp;start=' . $start . '&amp;do=set" method="post">';
            while ($res = mysql_fetch_array($req)) {
                echo $i % 2 ? '<div class="list2">' : '<div class="list1">';
                echo '<input type="checkbox" name="users[]" value="' . $res['user_id'] . '"/>&#160;' .
                    '<a href="../users/profile.php?user=' . $res['user_id'] . '">' . $res['from'] . '</a> [' . $res['count'] . ']</div>';
                ++$i;
            }
            echo '<div class="gmenu"><input type="submit" value="' . $lng_forum['filter_to'] . '" name="submit" /></div>' .
                '<div class="phdr"><small>' . $lng_forum['filter_on_author_help'] . '</small></div>' .
                '</form>';
        } else {
            echo functions::display_error($lng['error_wrong_data']);
        }
}
echo '<p><a href="../soo/?mod=forum&amp;sid='. $sid .'&amp;id=' . $id . '&amp;start=' . $start . '">' . $lng_forum['return_to_topic'] . '</a></p>';
require('../incfiles/end.php');
break;
?>