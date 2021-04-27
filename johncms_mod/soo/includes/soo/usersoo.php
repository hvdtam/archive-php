<?php

/*
WMR: R118530587041
ICQ: 365848916
Автор: VladiSs
Сайт: http://wapnex.ru
*/

defined('_IN_JOHNCMS') or die('Error: restricted access');


$user = functions::get_user($user);
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `soo_users` WHERE `user_id` = '" . $user['id'] . "'"), 0);
echo '<div class="phdr">Người Sử Dụng Bang Hội <b>'. $user['name'] .'</b></div>';
        if ($total) {
            $reqs = mysql_query("SELECT * FROM `soo_users` WHERE `user_id` = '" . $user['id'] . "' ORDER BY `id` DESC LIMIT $start, $kmess");
            $i = 0;
            while ($res = mysql_fetch_assoc($reqs)) {
echo $i % 2 ? '<div class="list2">' : '<div class="list1">';
$sooinf = mysql_fetch_array(mysql_query("SELECT * FROM `soo` WHERE `id` = '". $res['sid'] ."'"));
if($sooinf['mod'] == 0)
echo '<img src="../images/soo/soo_open.gif" alt="' . $res['sid'] . '"/>';
if($sooinf['mod'] == 1)
echo '<img src="../images/soo/soo_closed.gif" alt="' . $res['sid'] . '"/>';   
if($sooinf['mod'] == 2)
echo '<img src="../images/soo/soo_un.gif" alt="' . $res['sid'] . '"/>';                   
echo '<a href="../soo/?act=soo&amp;id='. $res['sid'] .'"> '. $sooinf['name'] .'</a>';
// Метка должности
                    $user_rights = array(
                        7 => ' (Người sáng lập)',
                        8 => ' (Admin)',
                        9 => ' (Thanh Viên)'
                    );
                    echo @$user_rights[$res['rights']];
echo '</div>';
            }
        } else {
            echo '<div class="menu"><p>' . $lng['list_empty'] . '</p></div>';
        }
        echo '<div class="phdr">' . $lng['total'] . ': ' . $total . '</div>';
        if ($total > $kmess) {
            echo '<p>' . functions::display_pagination('../soo/?act=usersoo&amp;user=' . $user['id'] . '&amp;', $start, $total, $kmess) . '</p>' .
                 '<p><form action="../soo/?act=usersoo&amp;user=' . $user['id'] . '" method="post">' .
                 '<input type="text" name="page" size="2"/>' .
                 '<input type="submit" value="' . $lng['to_page'] . ' &gt;&gt;"/></form></p>';
        }
            
            
            
?>