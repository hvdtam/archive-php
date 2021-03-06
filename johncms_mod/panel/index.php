<?php



/**

 * @package     JohnCMS

 * @link        http://johncms.com

 * @copyright   Copyright (C) 2008-2011 JohnCMS Community

 * @license     LICENSE.txt (see attached file)

 * @version     VERSION.txt (see attached file)

 * @author      http://johncms.com/about

 */



@ini_set("max_execution_time", "600");

define('_IN_JOHNCMS', 1);

define('_IN_JOHNADM', 1);



require('../incfiles/core.php');

// Подключаем язык Админ-панели

$lng = array_merge($lng, core::load_lng('admin'));



// Проверяем права доступа

if (core::$user_rights < 1) {

    header('Location: http://johncms.com/?err');

    exit;

}



$headmod = 'admin';

$textl = $lng['admin_panel'];

require('../incfiles/head.php');

$array = array(

    'forum',

    'news',

    'ads',

    'counters',

    'languages',

    'settings',

    'sitemap',

    'smileys',

    'access',

    'antispy',

    'httpaf',

    'ipban',

    'antiflood',

    'ban_panel',

    'karma',

    'reg',

    'search_ip',

    'usr',

    'usr_adm',

    'usr_clean',

    'usr_del',
    
    'mod_quiz'

);

if ($act && ($key = array_search($act, $array)) !== false && file_exists('includes/' . $array[$key] . '.php')) {

    require('includes/' . $array[$key] . '.php');

} else {

    $regtotal = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `preg`='0'"), 0);

    $bantotal = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_ban_users` WHERE `ban_time` > '" . time() . "'"), 0);

    echo '<div class="phdr"><b>' . $lng['admin_panel'] . '</b></div>';



    /*

    -----------------------------------------------------------------

    Блок пользователей

    -----------------------------------------------------------------

    */

    echo '<div class="user"><p><h3><img src="../images/users.png" width="16" height="16" class="left" />&#160;' . $lng['users'] . '</h3><ul>';

    if ($regtotal && core::$user_rights >= 6) echo '<li><span class="red"><b><a href="index.php?act=reg">' . $lng['users_reg'] . '</a>&#160;(' . $regtotal . ')</b></span></li>';

    echo '<li><a href="index.php?act=usr">' . $lng['users'] . '</a>&#160;(' . counters::users() . ')</li>' .

         '<li><a href="index.php?act=usr_adm">' . $lng['users_administration'] . '</a>&#160;(' . mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `rights` >= '1'"), 0) . ')</li>' .

         ($rights >= 7 ? '<li><a href="index.php?act=usr_clean">' . $lng['users_clean'] . '</a></li>' : '') .

         '<li><a href="index.php?act=ban_panel">' . $lng['ban_panel'] . '</a>&#160;(' . $bantotal . ')</li>' .

         (core::$user_rights >= 7 ? '<li><a href="index.php?act=antiflood">' . $lng['antiflood'] . '</a></li>' : '') .

         (core::$user_rights >= 7 ? '<li><a href="index.php?act=karma">' . $lng['karma'] . '</a></li>' : '') .

         '<br />' .

         '<li><a href="../users/search.php">' . $lng['search_nick'] . '</a></li>' .

         '<li><a href="index.php?act=search_ip">' . $lng['ip_search'] . '</a></li>' .

         '</ul></p></div>';

    if ($rights >= 3) {


        /*

        -----------------------------------------------------------------

        Блок модулей

        -----------------------------------------------------------------

        */

        echo '<div class="gmenu"><p>';

        echo '<h3><img src="../images/modules.png" width="16" height="16" class="left" />&#160;' . $lng['modules'] . '</h3><ul>';

    if ($rights >= 7) {

      echo '<li><a href="index.php?act=ads">' . $lng['advertisement'] . '</a></li>' .
               '<li><a href="index.php?act=news">' . $lng['news'] . '</a></li>' .
               '<li><a href="index.php?act=forum">' . $lng['forum'] . '</a></li>';

     }

            echo '<li><a href="index.php?act=mod_quiz">Trắc nghiệm</a></li>' .
             '</ul></p></div>';

    }

    if ($rights >= 7) {





        /*

        -----------------------------------------------------------------

        Блок системных настроек

        -----------------------------------------------------------------

        */

        echo '<div class="menu"><p>' .

             '<h3><img src="../images/settings.png" width="16" height="16" class="left" />&#160;' . $lng['system'] . '</h3>' .

             '<ul>' .

             (core::$user_rights == 9 ? '<li><a href="index.php?act=settings"><b>' . $lng['site_settings'] . '</b></a></li>' : '') .

             '<li><a href="index.php?act=smileys">' . $lng['refresh_smileys'] . '</a></li>' .

             (core::$user_rights == 9 ? '<li><a href="index.php?act=languages">' . $lng['language_settings'] . '</a></li>' : '') .

             '<li><a href="index.php?act=access">' . $lng['access_rights'] . '</a></li><br />' .

             (core::$user_rights == 9 ? '<li><a href="index.php?act=sitemap">' . $lng['site_map'] . '</a></li>' : '') .

             (core::$user_rights == 9 ? '<li><a href="index.php?act=counters">' . $lng['counters'] . '</a></li>' : '') .

             '</ul>' .

             '</p></div>';



        /*

        -----------------------------------------------------------------

        Блок безопасности

        -----------------------------------------------------------------

        */

        echo '<div class="rmenu"><p>' .

             '<h3><img src="../images/admin.png" width="16" height="16" class="left" />&#160;' . $lng['security'] . '</h3>' .

             '<ul>' .

             '<li><a href="index.php?act=antispy">' . $lng['antispy'] . '</a></li>' .

             (core::$user_rights == 9 ? '<li><a href="index.php?act=ipban">' . $lng['ip_ban'] . '</a></li>' : '') .

             '</ul>' .

             '</p></div>';

    }

    echo '<div class="phdr">&#160;</div>';

}



require('../incfiles/end.php');

?>