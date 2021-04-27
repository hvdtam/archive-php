<?php
/**
 * @author simba
 * @copyright 2011
 */
 
define('_IN_JOHNCMS', 1);
$headmod = 'statistik';
$textl = 'Thống kê cho Site';
require_once ("../incfiles/core.php");
require_once ("../incfiles/head.php");
$act = isset($_GET['act']) ? $_GET['act'] : '';
if(isset($_GET['sday'])){
    $_SESSION['sday'] = $_GET['sday'];
}
if(isset($_GET['sengine'])){
    $_SESSION['sengine'] = $_GET['sengine'];
}
$day = isset($_SESSION['sday']) ? $_SESSION['sday'] : '';
$engine = isset($_SESSION['sengine']) ? $_SESSION['sengine'] : '';


switch ($act)
{
case 'se':
$sql = '';
$n = 'всем';
/////// Выбираем поисковую машину ///////
switch ($engine){
    case 'google':
    $sql = " AND `engine` LIKE '%google%'";
    $n = 'www.google.ru';
    break;
    case 'mail':
    $sql = " AND `engine` LIKE '%mail%'";
    $n = 'mail.ru';
    break;
    case 'rambler':
    $sql = " AND `engine` LIKE '%rambler%'";
    $n='rambler.ru';
    break;
    case 'yandex':
    $sql = " AND `engine` LIKE '%yandex%'";
    $n='yandex.ru';
    break;
    case 'bing':
    $sql = " AND `engine` LIKE '%bing%'";
    $n='bing.com';
    break;
    case 'nigma':
    $sql = " AND `engine` LIKE '%nigma%'";
    $n='nigma.ru';
    break;
    case 'qip':
    $sql = " AND `engine` LIKE '%qip%'";
    $n='search.qip.ru';
    break;
    case 'aport':
    $sql = " AND `engine` LIKE '%aport%'";
    $n='aport.ru';
    break;
    case 'gogo':
    $sql = " AND `engine` LIKE '%gogo%'";
    $n='gogo.ru';
    break;
    case 'yahoo':
    $sql = " AND `engine` LIKE '%yahoo%'";
    $n='yahoo.ru';
    break;
    }
echo'<div class="phdr">Thống kê '.$n.'</div>';
/////// Вычисляем время /////////
$time = strtotime(date("d F y", statistic::$system_time));
$time1 = $time-86400;
$time7 = $time-604800;
///// Выбираем нужный период ////
switch ($day){
        ///// Весь период /////
         case "all":
         $sql = str_replace('AND', 'WHERE', $sql);
         $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `stat_robots` ".$sql.""), 0);
         if($total > 0)
         $req = mysql_query("SELECT * FROM `stat_robots` ".$sql." ORDER BY `date` DESC LIMIT " . $start . "," . $kmess);
         break;
        ///// Семь дней /////
         case "seven":
         $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$time7."' and `date` < '".$time."' ".$sql.""), 0);
         if($total > 0)
         $req = mysql_query("SELECT * FROM `stat_robots` WHERE `date` > '".$time7."' and `date` < '".$time."'".$sql." ORDER BY `date` DESC LIMIT " . $start . "," . $kmess);
         break;
         ///// За прошедший день (вчера) /////
         case "two":
         $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$time1."' and `date` < '".$time."'".$sql.""), 0);
         if($total > 0)
         $req = mysql_query("SELECT * FROM `stat_robots` WHERE `date` > '".$time1."' and `date` < '".$time."'".$sql." ORDER BY `date` DESC LIMIT " . $start . "," . $kmess);
         break;
         /////// Стандарт за сутки /////
         default:
         $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$time."'".$sql.""), 0);
         if($total > 0)
         $req = mysql_query("SELECT * FROM `stat_robots` WHERE `date` > '".$time."'".$sql." ORDER BY `date` DESC LIMIT " . $start . "," . $kmess);

         break;
         }
////// Выводим ссылки для выбора периода ////////
         echo'<div class="menu">Thời gian: ';
if($day !== 'seven' && $day !== 'two' && $day !== 'all'){
echo'<b>Hôm nay</b> | <a href="?act=se&amp;sday=two">Hôm qua</a> | <a href="?act=se&amp;sday=seven">7 ngày</a> | <a href="?act=se&amp;sday=all">Tất cả thời gian</a>';         
}elseif($day == 'two'){
echo'<a href="?act=se&amp;sday=one">Hôm nay</a> | <b>Hôm qua</b> | <a href="?act=se&amp;sday=seven">7 ngày</a> | <a href="?act=se&amp;sday=all">Tất cả thời gian</a>';    
}elseif($day == 'seven'){
echo'<a href="?act=se&amp;sday=one">Hôm nay</a> | <a href="?act=se&amp;sday=two">Hôm qua</a> | <b>7 ngày</b> | <a href="?act=se&amp;sday=all">Tất cả thời gian</a>';    
}elseif($day == 'all'){
echo'<a href="?act=se&amp;sday=one">Hôm nay</a> | <a href="?act=se&amp;sday=two">Hôm qua</a> | <a href="?act=se&amp;sday=seven">7 ngày</a> | <b>tất cả thời gian</b>';    
}
echo'</div>';

//////// Выводим полученный результат или сообщение об отсутствии ///////

if($total > 0){
while ($arr = mysql_fetch_array($req)){
    echo ($i % 2) ? '<div class="list1">' : '<div class="list2">';
    ++$i;
    $vr = date("H:i", $arr['date']);
    echo '<a href="'.$arr['url'].'">'.$arr['query'].'</a> ['.$vr.']<br/>
    <small>IP: <a href="../panel/index.php?act=search_ip&amp;ip='.long2ip($arr['ip']).'">'.long2ip($arr['ip']).'</a>';
    if($day !== 'seven' && $day !== 'two'){ echo' Перех. Сегодня: '.$arr['today']; }
    echo' Tổng cộng: '.$arr['count'];
    echo'<br/>UA: '.$arr['ua'].'</small>
    </div>';
}

        echo '<div class="phdr">Tổng cộng: ' . $total . '</div>';
		if ($total > $kmess){
    	echo '<div class="topmenu">';
    	echo functions::display_pagination('stat_search.php?act=se&amp;', $start, $total, $kmess) . '</div>';
    	echo '<p><form action="stat_search.php" method="get"><input type="hidden" name="act" value="se"/><input type="text" name="page" size="2"/><input type="submit" value="Đến trang &gt;&gt;"/></form></p>';}
 }else{
    echo'<div class="rmenu">Giới thiệu tham gia từ các công cụ tìm kiếm trong một thời gian lựa chọn là không!</div>';
 }      
   echo'<div class="menu"><a href="stat_search.php?">Bằng cách lựa chọn một công cụ tìm kiếm</a></div>';     
   echo'<div class="menu"><a href="index.php">Các số liệu thống kê</a></div><br/>';
 
break;


default:
$where_time = strtotime(date("d F y", statistic::$system_time));
$sql = "
(SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$where_time."' AND `engine` LIKE '%yandex%') UNION ALL
(SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$where_time."' AND `engine` LIKE '%mail%') UNION ALL
(SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$where_time."' AND `engine` LIKE '%rambler%') UNION ALL
(SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$where_time."' AND `engine` LIKE '%google%') UNION ALL
(SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$where_time."' AND `engine` LIKE '%gogo%') UNION ALL
(SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$where_time."' AND `engine` LIKE '%yahoo%') UNION ALL
(SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$where_time."' AND `engine` LIKE '%bing%') UNION ALL
(SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$where_time."' AND `engine` LIKE '%nigma%') UNION ALL
(SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$where_time."' AND `engine` LIKE '%qip%') UNION ALL
(SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$where_time."' AND `engine` LIKE '%aport%') UNION ALL
(SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$where_time."')";

$query = mysql_query($sql);
$count_query = array();
while($result_array = mysql_fetch_array($query)) {
        $count_query[] = $result_array[0];
        }
////// Выводим ссылки и количество переходов ///
echo'<div class="phdr"><img src="icons/search.png" alt="." /> Thống kê trên các truy vấn tìm kiếm</div>';
echo'<div class="menu"><img src="icons/yandex.png" alt="." /> <a href="stat_search.php?act=se&amp;sengine=yandex">Yandex.ru</a> ('.$count_query[0].')<br/>';
echo'<img src="icons/mail.png" alt="." /> <a href="stat_search.php?act=se&amp;sengine=mail">Mail.ru</a> ('.$count_query[1].')<br/>';
echo'<img src="icons/rambler.png" alt="." /> <a href="stat_search.php?act=se&amp;sengine=rambler">Rambler.ru</a> ('.$count_query[2].')<br/>';
echo'<img src="icons/google.png" alt="." /> <a href="stat_search.php?act=se&amp;sengine=google">Google.ru</a> ('.$count_query[3].')<br/>';
echo'<img src="icons/gogo.png" alt="." /> <a href="stat_search.php?act=se&amp;sengine=gogo">Gogo.ru</a> ('.$count_query[4].')<br/>';
echo'<img src="icons/yahoo.png" alt="." /> <a href="stat_search.php?act=se&amp;sengine=yahoo">Yahoo.ru</a> ('.$count_query[5].')<br/>';
echo'<img src="icons/bing.png" alt="." /> <a href="stat_search.php?act=se&amp;sengine=bing">Bing.ru</a> ('.$count_query[6].')<br/>';
echo'<img src="icons/nigma.png" alt="." /> <a href="stat_search.php?act=se&amp;sengine=nigma">Nigma.ru</a> ('.$count_query[7].')<br/>';
echo'<img src="icons/qip.png" alt="." /> <a href="stat_search.php?act=se&amp;sengine=qip">Search.QIP.ru</a> ('.$count_query[8].')<br/>';
echo'<img src="icons/aport.png" alt="." /> <a href="stat_search.php?act=se&amp;sengine=aport">Aport.ru</a> ('.$count_query[9].')</div>';
echo'<div class="bmenu"><img src="icons/all1.png" alt="." /> <a href="stat_search.php?act=se&amp;sengine=all">Все запросы</a> ('.$count_query[10].')</div>';
echo'<div class="gmenu"><a href="index.php">Các số liệu thống kê</a></div><br/>';

break;
}
require_once ('../incfiles/end.php');
?>