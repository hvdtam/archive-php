<?php
//////////////////////////////////////////
//   Модуль статистики для JohnCMS      //
//////////////////////////////////////////
//  Автор: Максим (Simba)               //
//  Wap site - http://symbos.su         //
//////////////////////////////////////////

@ini_set('max_execution_time', 5);
@set_time_limit(5);

define('_IN_JOHNCMS', 1);
$headmod = 'statistik';
$textl = 'Thống kê cho Site';
require_once '../incfiles/core.php';
require_once '../incfiles/head.php';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$model = isset($_GET['model']) ? functions::check($_GET['model']) : '';

// Дополнительные страницы //
$do = array('robots', 'robot_types', 'hosts', 'point_in', 'opsos', 'allstat',
 'country', 'users', 'referer', 'siteadr', 'pop', 'phones', 'phone', 'os');
if (in_array($act, $do)){
$back_links = '';
include_once ($act . '.php');
echo '<div class="gmenu">'.$back_links.'<a href="index.php">Để xem thống kê</a></div>';
include '../incfiles/end.php';
exit;
}


// Главная статистики //

$begin_day = strtotime(date("d F y", statistic::$system_time));
$my_url = parse_url($home);
$sql = "
(SELECT COUNT(*) FROM `counter` WHERE `robot` != '') UNION ALL
(SELECT COUNT(DISTINCT `pop`) FROM `counter` WHERE `robot` = '') UNION ALL
(SELECT COUNT(*) FROM `stat_robots` WHERE `date` > '".$begin_day."') UNION ALL
(SELECT COUNT(DISTINCT `country`) FROM `counter`) UNION ALL
(SELECT COUNT(DISTINCT `operator`, `country`) FROM `counter`) UNION ALL
(SELECT COUNT(DISTINCT `robot`) FROM `counter` WHERE `robot` != '') UNION ALL
(SELECT COUNT(DISTINCT `user`) FROM `counter`) UNION ALL
(SELECT COUNT(DISTINCT `site`) FROM `counter` WHERE `site` NOT LIKE '%".$my_url['host']."')
";

$query = mysql_query($sql);
$count_stat = array();
while($result_array = mysql_fetch_array($query)) {
        $count_stat[] = $result_array[0];
        }


$hitnorob = statistic::$hity - $count_stat[0];

echo '<div class="phdr">Thống kê</div>
<div class="gmenu"><h3><img src="icons/statistic.png" alt="."/> Thông tin chung</h3>
<li>Truy cập hôm nay: '.statistic::$hity.'</li>
<li>Máy chủ hôm nay: '.statistic::$hosty.'</li>
<li>Truy cập vào robot: '.$count_stat[0].'</li>
<li>Truy cập không có robot: '.$hitnorob.'</li>';


//////// Максимум хостов //////
$maxhost = mysql_query("SELECT `date`, `host` FROM `countersall` ORDER BY `countersall`.`host` DESC LIMIT 0 , 1");
if(mysql_num_rows($maxhost) > 0){
$maxhost = mysql_fetch_array($maxhost);
/////// Максимум хитов ////////
$maxhits = mysql_fetch_array(mysql_query("SELECT `date`, `hits` FROM `countersall` ORDER BY `countersall`.`hits` DESC LIMIT 0 , 1"));
$max_host_time = date("d M Y", $maxhost['date']);
$max_hits_time = date("d M Y", $maxhits['date']);
echo '<li>Ghi chú (<b>'.$maxhost['host'].'</b>) là <b>'.statistic::month($max_host_time).'г.</b></li>
<li>Ghi lại số truy cập (<b>'.$maxhits['hits'].'</b>) là <b>'.statistic::month($max_hits_time).'г.</b></li>';
}

echo '<li>Số lượng trung bình của lượt truy cập mỗi khách truy cập: '.round($hitnorob/statistic::$hosty).'</li></div>';

$percent = statistic::$hosty/100; // 1%
$searchpercent = $count_stat[2]/$percent; // % поисковиков
echo '<div class="menu"><h3><img src="icons/stats.png" alt="."/> Chi tiết số liệu thống kê</h3>';

echo'<li><a href="index.php?act=hosts">Máy chủ</a> ('.statistic::$hosty.')</li>
<li><a href="index.php?act=opsos">Nhà khai thác</a> ('.$count_stat[4].')</li>
<li><a href="index.php?act=country">Các nước</a> ('.$count_stat[3].')</li>
<li><a href="index.php?act=robots">Robot</a> ('.$count_stat[5].')</li>
<li><a href="index.php?act=users">Thành viên</a> ('.$count_stat[6].')</li>
<li><a href="stat_search.php">Các quá trình chuyển đổi từ các công cụ tìm kiếm</a> ('.$count_stat[2].' | '.round($searchpercent, 2).'%)</li>
<li><a href="index.php?act=phones">Điện thoại / trình duyệt</a></li>
<li><a href="index.php?act=os">Hệ điều hành</a></li>
<li><a href="index.php?act=referer">Từ đâu đến</a> ('.$count_stat[7].')</li>';

echo'<li><a href="index.php?act=point_in">Điểm vào</a></li>';
echo'<li><a href="index.php?act=pop">Phổ biến Tìm kiếm</a> ('.$count_stat[1].')</li>';
echo'<li><a href="http://www.cy-pr.com/analysis/'.$my_url['host'].'">SEO trang web</a></li>';
echo'<li><a href="index.php?act=allstat">Daily Thống kê</a></li></div>';

if ($rights >= 9)
echo'<div class="bmenu"><a href="ip_base.php?act=base">Cơ sở dữ liệu quản lý</a></div>';


echo'<div class="phdr">Mô-đun Phiên bản: 6.3</div>';


require_once '../incfiles/end.php';
?>