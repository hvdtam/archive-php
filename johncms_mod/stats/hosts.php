<?php

/**
 * @author simba
 * @copyright 2011
 */
defined('_IN_JOHNCMS') or die('Низя так смотреть! Гг.');

echo '<div class="phdr">Xem máy chủ</div>';
$count = mysql_result(mysql_query("SELECT COUNT(*) FROM `counter` WHERE `robot` = '' AND `host` != 0;"), 0);
if($count > 0){
    $req = mysql_query("SELECT * FROM `counter` WHERE `robot` = '' AND `host` != 0 LIMIT ".$start.",".$kmess);
    $i = 0;
    while($arr = mysql_fetch_array($req)){
        echo ($i % 2) ? '<div class="list1">' : '<div class="list2">';
        ++$i;
        $count_view = mysql_result(mysql_query("SELECT COUNT(*) FROM `counter` WHERE `browser` = '".$arr['browser']."' AND `ip` = '".$arr['ip']."'") , 0);
        
		$time = date("H:i", $arr['date']);
        
        echo '<b>'.$time.'</b> - '.$arr['browser'].'
        <div class="sub">Ip: <a href="'.$home.'/panel/index.php?act=search_ip&amp;ip='.$arr['ip'].'">'.$arr['ip'].'</a> <a href="http://ip-whois.net/ip_geo.php?ip='.$arr['ip'].'" title = "WhoIS ip">[?]</a> ';
        
        if($arr['ip_via_proxy'])
        echo '| <a href="'.$home.'/panel/index.php?act=search_ip&amp;ip='.$arr['ip_via_proxy'].'">'.$arr['ip_via_proxy'].'</a> <a href="http://ip-whois.net/ip_geo.php?ip='.$arr['ip_via_proxy'].'" title = "WhoIS ip">[?]</a> ';
        
        echo '| '.$arr['operator'].' | '.$arr['country'].' | Переходов: '.$count_view.'</div>';
        
        echo '</div>';    
        }
    
    echo '<div class="phdr">Tổng cộng: '.$count.'</div>';
    if ($count > $kmess){
        echo '<div class="topmenu">';
    	echo functions::display_pagination('index.php?act=hosts&amp;', $start, $count, $kmess) . '</div>';
    	echo '<p><form action="index.php" method="get"><input type="hidden" name="act" value="hosts"/><input type="text" name="page" size="2"/><input type="submit" value="Đến trang &gt;&gt;"/></form></p>';}
    
}else{
 echo '<div class="rmenu">Không có máy chủ ngày hôm nay!</div>';   
}
?>