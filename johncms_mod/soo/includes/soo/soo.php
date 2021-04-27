<?php

/*
WMR: R118530587041
ICQ: 365848916
Автор: VladiSs
Сайт: http://wapnex.ru
*/

defined('_IN_JOHNCMS') or die('Error: restricted access');

$headmod = 'soo';
/*
-----------------------------------------------------------------
Закрываем от неавторизованных юзеров
-----------------------------------------------------------------
*/
if (!$user_id && !$set['active']) {
    require('../incfiles/head.php');
    echo functions::display_error($lng['access_guest_forbidden']);
    require('../incfiles/end.php');
    exit;
}

    $link = isset($_GET['s']) ? trim($_GET['s']) : '';
    if (!empty ($link))
  {
    if (mysql_result (mysql_query ("SELECT COUNT(*) FROM `soo`
  WHERE `link` = '" .mysql_real_escape_string($link). "' LIMIT 1;"), 0) != 0)
    $id = mysql_result (mysql_query ("SELECT `id` FROM `soo`
  WHERE `link` = '" .mysql_real_escape_string($link). "' LIMIT 1;"), 0);
}
$mod1 = mysql_fetch_array(mysql_query("SELECT `mod`,`cat` FROM `soo` WHERE `id` = '$id'"));
$us = mysql_fetch_array(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = ' " . $id . " ' AND `user_id`=' " . $user_id . " '  "));
$usin = mysql_num_rows(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = '$id' AND `user_id` = '$user_id'"));

if($mod1['mod'] == 2 && $usin != 1 ){
    echo functions::display_error('Đóng Cửa!');
    echo '<br /><div class="list1"><a href="../soo/?id='. $mod1['cat'] .'">Trong Danh Mục</a></div>';
    require('../incfiles/end.php');
    exit;
}
if($id){
$reqs = mysql_query("SELECT * FROM `soo` WHERE `type` = '2' AND `id`='$id'");
$ress = mysql_fetch_assoc($reqs);
if(!$ress){
    require_once('../incfiles/head.php');
    echo functions::display_error('Không Có Bang Hội!');
    require_once ('../incfiles/end.php');
    exit;
}
}

require_once('../incfiles/head.php');


        $req = mysql_query("SELECT * FROM `soo` WHERE `id` = $id AND `type` = '2' ");
        
        
        while ($res = mysql_fetch_array($req)) {
            $catsoo = mysql_query("SELECT * FROM `soo` WHERE `id` = ".$res['cat']." AND `type`='1' ");
            $catso = mysql_fetch_assoc($catsoo);
            $us = mysql_fetch_array(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = ' " . $res['id'] . " ' AND `user_id`=' " . $user_id . " '  "));
            echo '<div class="phdr">Thể Loại: <a href="../soo/?id='.$catso['id'].'">'.$catso['name'].'</a></div>';
            

            
            if ($us['rights'] == 9){
            echo '<div class="list1"><b><font color="blue">Bang Hội: </font><font color="red">'.$res['name'].'</font></b> [<a href="../soo/?act=edit&amp;id='. $id .'">Thay Đổi.</a>]</div>';
            } else {
            echo '<div class="list1"><b><font color="blue">Bang Hội: </font><font color="red">'.$res['name'].'</font></b></div>';
            }
            echo '<div class="list2"><b>'. $home .'/soo/s_'. $res['link'] .'</b></div>';
            if($res['mod'] == 0)
            echo '<div class="list1"><img src="../images/soo/soo_open.gif" alt="' . $res['id'] . '"/>  (Tham Gia Tự Do)</div><br />';
            if($res['mod'] == 1)
            echo '<div class="list1"><img src="../images/soo/soo_closed.gif" alt="' . $res['id'] . '"/>  (Đóng Cửa )</div><br />';  
            if($res['mod'] == 2)
            echo '<div class="list1"><img src="../images/soo/soo_un.gif" alt="' . $res['id'] . '"/>  (Cần Có Giấy Mời)</div><br />'; 
            
            if (file_exists(('../files/soo/logo/' . $res['id'] . '_logo.png')))
            {
            echo '<a href="../files/soo/logo/' . $res['id'] . '.png"><img src="../files/soo/logo/' . $res['id'] . '_logo.png" alt="' . $res['id'] . '"/></a>';
            } else {
            echo '<img src="../images/soo/nologo.png" alt="nologo"/>';
            }
            
            
            echo '<div class="list1"><a href="../soo/?act=info&amp;id='.$res['id'].'">Giới Thiệu</a></div>';
            
            $totaln = mysql_num_rows(mysql_query("SELECT * FROM `soo_news` WHERE `sid` = '$id'"));
            
            echo '<div class="list2"><a href="../soo/?mod=news&amp;sid='.$res['id'].'">Tin Tức</a> ('. $totaln .')</div>';
            
            $fid = mysql_fetch_array(mysql_query("SELECT `id` FROM `soo_forum` WHERE `type` = 'f' AND `sid` = '".$res['id']."' LIMIT 1"));
            
            $totf = mysql_num_rows(mysql_query("SELECT * FROM `soo_forum` WHERE `type` = 't' AND `sid` = '$id'"));
            echo '<div class="list1"><a href="../soo/?mod=forum&amp;sid='.$res['id'].'&amp;id='.$fid['id'].'">Diễn Đàn</a> ('. $totf .')</div>';
            
            $total = mysql_num_rows(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = '$id' "));
            echo '<div class="list2"><a href="../soo/?act=users&amp;id='.$res['id'].'">Những người tham gia</a> (' . $total . ')</div>';  
            
            $totalban = mysql_num_rows(mysql_query("SELECT * FROM `soo_ban_users` WHERE `sid` = '$id'"));
            echo '<div class="list1"><a href="../soo/?act=bans&amp;id='.$res['id'].'"> Danh sách Cấm</a> (' . $totalban . ')</div>';  
            
            if ($user_id){    
            echo ($us == 0 ? '<br /><div class="list1"> <a href="../soo/?act=in&amp;id=' . $res['id'] . '">Tham Gia Ban Hội</a></div>' : ($us['rights'] != 9 ? '<br /><div class="list1"> <a href="../soo/?act=out&amp;id=' . $res['id'] . '">Bang Hội</a></div>' : ''));
            }
        }

?>