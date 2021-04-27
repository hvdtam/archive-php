<?php

/**
 * @author simba
 * @copyright 2011
 */
defined('_IN_JOHNCMS') or die('Низя так смотреть! Гг.');

echo '<div class="phdr">Trên các trang</div>';

$site = isset($_GET['site']) ? functions::check($_GET['site']) : FALSE;

if(!$site){
    echo functions::display_error('Không hợp lệ các thông số!', '<a href="index.php">Thống kê</a>');
    include_once '../incfiles/end.php';
    exit;
}

$count = mysql_result(mysql_query("SELECT COUNT(DISTINCT `ref`) FROM `counter` WHERE `ref` LIKE '%".$site."%';"), 0);
if($count > 0){
    $req = mysql_query("SELECT * FROM `counter` WHERE `ref` LIKE '%".$site."%' GROUP BY `ref` LIMIT ".$start.",".$kmess);
    $i = 0;
    while($arr = mysql_fetch_array($req)){
        echo ($i % 2) ? '<div class="list1">' : '<div class="list2">';
        ++$i;
        $time = date("H:i", $arr['date']);
        $count_hits = mysql_result(mysql_query("SELECT COUNT(*) FROM `counter` WHERE `ref` = '".$arr['ref']."'") , 0);
        echo '<img src="icons/url.png" alt="."/> <a href="'.$arr['ref'].'">'.$arr['ref'].'</a>
        <div class="sub">'.$time.' | Giới thiệu tham gia: '.$count_hits.'</div>
        ';
        echo '</div>';   
        }
    
    echo '<div class="phdr">Tổng cộng: '.$count.'</div>';
    if ($count > $kmess){
    	echo '<div class="topmenu">';
    	echo functions::display_pagination('index.php?act=siteadr&amp;site='.$site.'&amp;', $start, $count, $kmess) . '</div>';
    	echo '<p><form action="index.php" method="get"><input type="hidden" name="act" value="siteadr"/><input type="hidden" name="site" value="'.$site.'"/><input type="text" name="page" size="2"/><input type="submit" value="Đến trang &gt;&gt;"/></form></p>';}
    
}else{
 echo '<div class="rmenu">Không có người sử dụng ngày hôm nay!</div>';   
}


$back_links = '<a href="index.php?act=referer">Sự lựa chọn của trang web</a><br/>';

?>