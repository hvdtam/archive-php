<?php
/*
* ////////////////////////////////////////////////////////////////////////////////
* // JohnCMS                             Content Management System              //
* // Официальный сайт сайт проекта:      http://johncms.com                     //
* // Дополнительный сайт поддержки:      http://gazenwagen.com                  //
* ////////////////////////////////////////////////////////////////////////////////
* // JohnCMS core team:                                                         //
* // Евгений Рябинин aka john77          john77@gazenwagen.com                  //
* // Олег Касьянов aka AlkatraZ          alkatraz@gazenwagen.com                //
* //                                                                            //
* // Информацию о версиях смотрите в прилагаемом файле version.txt              //
* ////////////////////////////////////////////////////////////////////////////////
* // Alternative gallery v. 2.2.0                                               //
* // Модификация от 13.06.2009                                                  //
* // Автор мода Regan                                                           //
* // Rec.h2m.ru                                                                 //
* ////////////////////////////////////////////////////////////////////////////////
*/

define('_IN_JOHNCMS', 1);

$textl = 'Đế chế Online';
$headmod = 'emperor';

require_once ("../incfiles/core.php");
require_once ("../incfiles/head.php");

if ($ban['1'])
{
echo '<p>Đối với các bạn truy cập bị từ chối.</p>';
require_once ("../incfiles/end.php");
exit;
}

if ($user_id)
{
$ms = mysql_fetch_array(mysql_query("SELECT *
FROM `emperor_users`
WHERE user_id='" . $idus . "' LIMIT 1;"));

if (! $ms['id'])
{
header("Location: index.php");
exit;
}

//Tất cả các cư dân
$habitants = $ms['workers'] + $ms['stonemasons'] + $ms['warriors'] + $ms['horse'] +
$ms['riders'] + $ms['fishermen'] + $ms['builders'] + $ms['lumberjacks'] + $ms['hunters'] +
$ms['miners'];

if ($habitants > 0)
{
//nếu ngày không được thiết lập
if (! $ms['time_meal'])
{
$time_meal = $realtime + (60 * 60 * 60);

mysql_query("UPDATE emperor_users
SET time_meal = '" . $time_meal . "' WHERE user_id='" . $idus . "';");

}
else //hiện tại nhiều thời gian hơn một ghi nhận

if ($realtime >= $ms['time_meal'])
{
//жителей больше чем еды
if ($habitants > $ms['meal'])
{

$difference = $habitants - $ms['meal'];

//Подсчет потерь жителей от голода
if ($ms['workers'] > 0)
{
$losses = rand(1, $difference);
$workers = $ms['workers'] - $losses;
if ($workers <= 0)
{
$workers = "0";
$difference = $difference - $ms['workers'];
}
else
{
$difference = $difference - $losses;
}
}
else
{
$workers = $ms['workers'];
}
///////////////////////
if ($ms['warriors'] > 0)
{
$losses = rand(1, $difference);
$warriors = $ms['warriors'] - $losses;
if ($warriors <= 0)
{
$warriors = "0";
$difference = $difference - $ms['warriors'];
}
else
{
$difference = $difference - $losses;
}
}
else
{
$warriors = $ms['warriors'];
}
///////////////////////
if ($ms['stonemasons'] > 0)
{
$losses = rand(1, $difference);
$stonemasons = $ms['stonemasons'] - $losses;
if ($stonemasons <= 0)
{
$stonemasons = "0";
$difference = $difference - $ms['stonemasons'];
}
else
{
$difference = $difference - $losses;
}
}
else
{
$stonemasons = $ms['stonemasons'];
}
///////////////////////
if ($ms['horse'] > 0)
{
$losses = rand(1, $difference);
$horse = $ms['horse'] - $losses;
if ($horse <= 0)
{
$horse = "0";
$difference = $difference - $ms['horse'];
}
else
{
$difference = $difference - $losses;
}
}
else
{
$horse = $ms['horse'];
}
///////////////////////
if ($ms['riders'] > 0)
{
$losses = rand(1, $difference);
$riders = $ms['riders'] - $losses;
if ($riders <= 0)
{
$riders = "0";
$difference = $difference - $ms['riders'];
}
else
{
$difference = $difference - $losses;
}
}
else
{
$riders = $ms['riders'];
}
///////////////////////
if ($ms['fishermen'] > 0)
{
$losses = rand(1, $difference);
$fishermen = $ms['fishermen'] - $losses;
if ($fishermen <= 0)
{
$fishermen = "0";
$difference = $difference - $ms['fishermen'];
}
else
{
$difference = $difference - $losses;
}
}
else
{
$fishermen = $ms['fishermen'];
}
///////////////////////
if ($ms['builders'] > 0)
{
$losses = rand(1, $difference);
$builders = $ms['builders'] - $losses;
if ($builders <= 0)
{
$builders = "0";
$difference = $difference - $ms['builders'];
}
else
{
$difference = $difference - $losses;
}
}
else
{
$builders = $ms['builders'];
}
///////////////////////
if ($ms['lumberjacks'] > 0)
{
$losses = rand(1, $difference);
$lumberjacks = $ms['lumberjacks'] - $losses;
if ($lumberjacks <= 0)
{
$lumberjacks = "0";
$difference = $difference - $ms['lumberjacks'];
}
else
{
$difference = $difference - $losses;
}
}
else
{
$lumberjacks = $ms['lumberjacks'];
}
///////////////////////
if ($ms['hunters'] > 0)
{
$losses = rand(1, $difference);
$hunters = $ms['hunters'] - $losses;
if ($hunters <= 0)
{
$hunters = "0";
$difference = $difference - $ms['hunters'];
}
else
{
$difference = $difference - $losses;
}
}
else
{
$hunters = $ms['hunters'];
}
///////////////////////
if ($ms['miners'] > 0)
{
$losses = rand(1, $difference);
$miners = $ms['miners'] - $losses;
if ($miners <= 0)
{
$miners = "0";
$difference = $difference - $ms['miners'];
}
else
{
$difference = $difference - $losses;
}
}
else
{
$miners = $ms['miners'];
}

$time_meal = $realtime + (15 * 60);

mysql_query("UPDATE emperor_users SET
workers = '" . $workers . "',
stonemasons = '" . $stonemasons . "',
horse = '" . $horse . "',
riders = '" . $riders . "',
fishermen = '" . $fishermen . "',
builders = '" . $builders . "',
lumberjacks = '" . $lumberjacks . "',
hunters = '" . $hunters . "',
miners = '" . $miners . "',
meal='0',
time_meal = '" . $time_meal . "'
WHERE user_id='" . $idus . "';");

echo "<img src='img/budelis.gif' alt='+'/><br/>Bạn không có đủ lương thực để nuôi dân cư!<br /> Vì vậy, bạn bị mất một số công nhân và chiến binh của mình!!!<br/>";
} elseif ($habitants <= $ms['meal'])
{ //еды больше чем жителей

$meal = $ms['meal'] - $habitants; //Thực phẩm - Cu dân

$time_meal = $realtime + (15 * 60);

mysql_query("UPDATE emperor_users SET
meal='" . $meal . "',
time_meal = '" . $time_meal . "' WHERE user_id='" . $idus . "';");

echo "<img src='img/valgo.gif' alt='+'/>Cư dân của bạn đả ăn <b>" . $habitants .
"</b> еды.<br/>";
}
}
}
$do = array('news', 'prav', 'online', 'info', 'msg', 'centr', 'zdanija',
'rinok', 'opponent', 'port', 'land', 'forest', 'shachta', 'kam', 'clan',
'static');

if (in_array($act, $do))
{
require_once ($act . '.php');
}
else
{
////////////////////////////////////////////////////
//Главная страница                                //
////////////////////////////////////////////////////
echo '<a href="game.php?act=news">Tin tức</a><br/>';
echo '<a href="game.php?act=prav">Chính phủ</a><br/>';
echo '<a href="game.php?act=online"Người chơi Online(vis)</a><br/>';
echo '<a href="game.php?act=info">Thông tin Nhân Vật</a><br/>';
echo '<a href="game.php?act=centr">Trung tâm mua bán</a><br/>';
echo '<a href="game.php?act=zdanija">Công trình xây dựng</a><br/>';
echo '<a href="game.php?act=rinok">Thị trường mua bán</a><br/>';
echo '<a href="game.php?act=opponent">Công Thành Chiến</a><br/>';
echo '<a href="game.php?act=port">Bến Cảng</a><br/>';
echo '<a href="game.php?act=land">Làm nông nhiệp</a><br/>';
echo '<a href="game.php?act=forest">Rừng cây</a><br/>';
echo '<a href="game.php?act=shachta">Hầm mỏ</a><br/>';
echo '<a href="game.php?act=kam">Khai thác đá</a><br/>';
echo '<a href="game.php?act=clan">Gia Tộc</a><br/>';
echo '<a href="game.php?act=static">Thống kê</a><br/>';
}
}
else
{
echo "Bạn chưa đăng nhập!<br/><a href='../in.php'>Đăng nhập</a><br/>";
require_once ("../incfiles/end.php");
exit;
}
require_once ("../incfiles/end.php");

?>
