<?php

/**
 * @author simba
 * @copyright 2011
 */
defined('_IN_JOHNCMS') or die('Низя так смотреть! Гг.');

echo '<div class="phdr">Giới thiệu nguồn</div>';

$my_url = parse_url($home);

$count = mysql_result(mysql_query("SELECT COUNT(DISTINCT `site`) FROM `counter` WHERE `site` NOT LIKE '%".$my_url['host']."';"), 0);
if($count > 0){
    $req = mysql_query("SELECT * FROM `counter` WHERE `site` NOT LIKE '%".$my_url['host']."' GROUP BY `site` LIMIT ".$start.",".$kmess);
    $i = 0;
    while($arr = mysql_fetch_array($req)){
        echo ($i % 2) ? '<div class="list1">' : '<div class="list2">';
        ++$i;
        $time = date("H:i", $arr['date']);
        $count_hits = mysql_result(mysql_query("SELECT COUNT(*) FROM `counter` WHERE `site` = '".$arr['site']."'") , 0);
        echo '<img src="icons/url.png" alt="."/> <a href="index.php?act=siteadr&amp;site='.$arr['site'].'">'.$arr['site'].'</a>
        <div class="sub">'.$time.' | Giới thiệu tham gia: '.$count_hits.'</div>
        ';
        echo '</div>';
        }
    
    echo '<div class="phdr">Tổng cộng: '.$count.'</div>';
    if ($count > $kmess){
    	echo '<div class="topmenu">';
    	echo functions::display_pagination('index.php?act=referer&amp;', $start, $count, $kmess) . '</div>';
    	echo '<p><form action="index.php" method="get"><input type="hidden" name="act" value="referer"/><input type="text" name="page" size="2"/><input type="submit" value="Đến trang &gt;&gt;"/></form></p>';}
    
}else{
 echo '<div class="rmenu">Không có người sử dụng ngày hôm nay!</div>';   
}
?>