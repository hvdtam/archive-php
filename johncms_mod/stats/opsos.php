<?php

/**
 * @author simba
 * @copyright 2011
 */
defined('_IN_JOHNCMS') or die('Низя так смотреть! Гг.');

echo '<div class="phdr">Các nhà khai thác</div>';
$count = mysql_result(mysql_query("SELECT COUNT(DISTINCT `operator`, `country`) FROM `counter`;"), 0);
if($count > 0){
    $req = mysql_query("SELECT * FROM `counter` GROUP BY `operator`, `country` LIMIT ".$start.",".$kmess);
    $i = 0;
    while($arr = mysql_fetch_array($req)){
        echo ($i % 2) ? '<div class="list1">' : '<div class="list2">';
        ++$i;
        $count_hits = mysql_result(mysql_query("SELECT COUNT(*) FROM `counter` WHERE `country` = '".$arr['country']."' AND `operator` = '".$arr['operator']."'") , 0);
        
        echo '<img src="icons/opsos.png" alt="."/> '.$arr['operator'].'
        <div class="sub">Quốc gia: '.$arr['country'].' | Lượt truy cập: '.$count_hits.'</div>';
        
        echo '</div>';    
        }
    
    echo '<div class="phdr">Tổng cộng: '.$count.'</div>';
    if ($count > $kmess){
        echo '<div class="topmenu">';
    	echo functions::display_pagination('index.php?act=opsos&amp;', $start, $count, $kmess) . '</div>';
    	echo '<p><form action="index.php" method="get"><input type="hidden" name="act" value="opsos"/><input type="text" name="page" size="2"/><input type="submit" value="Đến trang &gt;&gt;"/></form></p>';}
    
}else{
 echo '<div class="rmenu">Không điều hành ngày hôm nay!</div>';   
}
?>