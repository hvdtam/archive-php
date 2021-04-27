<?php

/**
 * @author simba
 * @copyright 2011
 */
 
defined('_IN_JOHNCMS') or die('Низя так смотреть! Гг.');

echo '<div class="phdr">Точки входа</div>';
$count = mysql_result(mysql_query("SELECT COUNT(DISTINCT `pop`) FROM `counter` WHERE `robot` = '' AND `host` != 0;"), 0);
if($count > 0){
    $req = mysql_query("SELECT * FROM `counter` WHERE `robot` = '' AND `host` != 0 GROUP BY `pop` ORDER BY `date` LIMIT ".$start.",".$kmess);
    $i = 0;
    while($arr = mysql_fetch_array($req)){
        echo ($i % 2) ? '<div class="list1">' : '<div class="list2">';
        ++$i;
        $count_view = mysql_result(mysql_query("SELECT COUNT(*) FROM `counter` WHERE `robot` = '' AND `host` != '0' AND `pop` = '" . $arr['pop'] . "'") , 0);
        
		$time = date("H:i", $arr['date']);
        
        if($arr['pop'] !== '/'){
        echo '<b>'.$time.'</b> | Tiêu đề: '.$arr['head'];
        echo '<div class="sub">Trang: <a href="'.$arr['pop'].'">'.$arr['pop'].'</a><br/>';
        }else{ 
        echo'<b>'.$time.'</b> | <a href="'.$arr['pop'].'">Trang chủ</a><div class="sub">'; 
        }
        
        echo 'Đầu vào: '.$count_view.'</div>';
        
        echo '</div>';    
        }
    
    echo '<div class="phdr">Tổng cộng: '.$count.'</div>';
    if ($count > $kmess){
    	echo '<div class="topmenu">';
    	echo functions::display_pagination('index.php?act=point_in&amp;', $start, $count, $kmess) . '</div>';
    	echo '<p><form action="index.php" method="get"><input type="hidden" name="act" value="point_in"/><input type="text" name="page" size="2"/><input type="submit" value="Đến trang &gt;&gt;"/></form></p>';}
    
}else{
 echo '<div class="rmenu">Không có dữ liệu để hiển thị!</div>';   
}
?>