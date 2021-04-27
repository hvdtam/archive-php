<?php

/**
 * @author simba
 * @copyright 2011
 */
defined('_IN_JOHNCMS') or die('Низя так смотреть! Гг.');

echo '<div class="phdr">Thành viên</div>';
$count = mysql_result(mysql_query("SELECT COUNT(DISTINCT `user`) FROM `counter`;"), 0);
if($count > 0){
    $req = mysql_query("SELECT * FROM `counter` GROUP BY `user` LIMIT ".$start.",".$kmess);
    $i = 0;
    while($arr = mysql_fetch_array($req)){
        echo ($i % 2) ? '<div class="list1">' : '<div class="list2">';
        ++$i;
        $count_hits = mysql_result(mysql_query("SELECT COUNT(*) FROM `counter` WHERE `user` = '".$arr['user']."'") , 0);
        
        $user = mysql_query("SELECT * from `users` where id = '".$arr['user']."';");
        $user = mysql_fetch_array($user);
        $arg = array ('stshide' => 1,
        'sub' => 'Giới thiệu tham gia: '.$count_hits);
        echo functions::display_user($user, $arg) . '</div>';   
        }
    
    echo '<div class="phdr">Tổng cộng: '.$count.'</div>';
    if ($count > $kmess){
    	echo '<div class="topmenu">';
    	echo functions::display_pagination('index.php?act=users&amp;', $start, $count, $kmess) . '</div>';
    	echo '<p><form action="index.php" method="get"><input type="hidden" name="act" value="users"/><input type="text" name="page" size="2"/><input type="submit" value="Đến trang &gt;&gt;"/></form></p>';}
    
}else{
 echo '<div class="rmenu">Không có người sử dụng ngày hôm nay!</div>';   
}
?>