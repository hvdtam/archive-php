<?php

/**
 * @author simba
 * @copyright 2011
 */
defined('_IN_JOHNCMS') or die('Низя так смотреть! Гг.');
$robot = isset($_GET['robot']) ? functions::check($_GET['robot']) : FALSE;

if(!$robot){
    echo functions::display_error('Không hợp lệ các thông số!', '<a href="index.php">Thống kê</a>');
    include_once '../incfiles/end.php';
    exit;
}

echo '<div class="phdr">Thống kê roboty '.$robot.'</div>';
$count = mysql_num_rows(mysql_query("select * from `counter` WHERE `robot` = '".$robot."' GROUP BY `robot_type`;"));
if($count > 0){
    $req = mysql_query("SELECT * FROM `counter` WHERE `robot` = '".$robot."' GROUP BY `robot_type` LIMIT ".$start.",".$kmess);
    $i = 0;
    while($arr = mysql_fetch_array($req)){
        echo ($i % 2) ? '<div class="list1">' : '<div class="list2">';
        ++$i;
        $count_view = mysql_result(mysql_query("SELECT COUNT(*) FROM `counter` WHERE `robot` = '".$robot."' AND `robot_type` = '".$arr['robot_type']."'") , 0);
        
        echo '<img src="icons/robot.png" alt="."/> <b>'.$arr['robot_type'].'</b>
        <div class="sub">Tổng số chuyển đổi: '.$count_view.'</div>';
        
        echo '</div>';    
        }
    
    echo '<div class="phdr">Tổng số Robots: '.$count.'</div>';
    
}else{
 echo '<div class="rmenu">Robot ngày nay nebylo!</div>';   
}

$back_links = '<a href="index.php?act=robots">Đến các robot</a><br/>';

?>