<?php

/**
 * @author simba
 * @copyright 2011
 */
defined('_IN_JOHNCMS') or die('Низя так смотреть! Гг.');

echo '<div class="phdr">Thống kê về các robot</div>';
$count = mysql_result(mysql_query("SELECT COUNT(DISTINCT `robot`) FROM `counter` WHERE `robot` != '';"), 0);
if($count > 0){
    $req = mysql_query("SELECT * FROM `counter` WHERE `robot` != '' GROUP BY `robot` LIMIT ".$start.",".$kmess);
    $i = 0;
    while($arr = mysql_fetch_array($req)){
        echo ($i % 2) ? '<div class="list1">' : '<div class="list2">';
        ++$i;
        $count_view = mysql_result(mysql_query("SELECT COUNT(*) FROM `counter` WHERE `robot` = '".$arr['robot']."'") , 0);
        
        echo '<img src="icons/robot.png" alt="."/> <a href="index.php?act=robot_types&amp;robot='.$arr['robot'].'">'.$arr['robot'].'</a>
        <div class="sub">Tổng số chuyển đổi: '.$count_view.'</div>';
        
        echo '</div>';    
        }
    
    echo '<div class="phdr">Tổng số Robots: '.$count.'</div>';
    
}else{
 echo '<div class="rmenu">Robot ngày nay nebylo!</div>';   
}
?>