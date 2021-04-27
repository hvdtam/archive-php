<?php
define('_IN_JOHNCMS', 1);
$headmod = 'ferma';
$rootpath = '../';
require_once ('../incfiles/core.php');require_once ('../incfiles/ferma_func.php');
if(!$user_id)
{         $textl = 'Nông trại vui vẻ';
require_once ('../incfiles/head.php');echo ('
<div class="phdr">' .$textl.'</div>');echo ('<div class="rmenu">Game chỉ cho thành viên tham gia</div>');
require_once ('../incfiles/end.php');
exit;
}  $textl = "Top nhà nông";
require_once ('../incfiles/head.php');echo ('
<div class="phdr">' .$textl.'</div>');
$query = mysql_query("SELECT * FROM `ferma` WHERE `opyt` > '1' ORDER BY `opyt` DESC LIMIT " .$start. ", " .$kmess. "");
if(@mysql_num_rows($query) == 0)
{
echo ('<div class="rmenu">Các nông trại trong Top</div>');
} else
$mesto = $start;
while ( $row = mysql_fetch_array ( $query ) )
{
$mesto = $mesto+1;
if ($mesto == 1){ $img = '<img src="img/mesto1.png" alt="+"/>';}
if ($mesto == 2){ $img = '<img src="img/mesto2.png" alt="+"/>';}
if ($mesto == 3){ $img = '<img src="img/mesto3.png" alt="+"/>';}
echo ( '<div class="menu">
Tên nông trại: <b>'.$row['name'].'</b>' .$img. '<br/>
Xây ngày: ' .tdate($row['date']). '<br/>
Điểm kinh nghiệm: ' .$row['opyt']. ' <br/>
Cấp độ: '.$row['level'].'<br/>
Thu nhập: '.$row['dohot'].'<br/>' );
if ($mesto > 0){echo ( '<b>Đứng Top ' .$mesto. ' </b><br/>' );}
if (!$row['user'] == $user_id){
echo ( '<a href="udar.php?id='.$row['id'].'">Nông</a></div>' );
}
mysql_query("UPDATE `ferma` SET `mesto`='".$mesto."' WHERE `id`='".$row['id']."'");
}
$total = mysql_result ( mysql_query ( "SELECT COUNT(*) FROM `ferma` WHERE `opyt` > '1'" ), 0 );
if ($total > $kmess) {
echo '<p>' . pagenav('top.php?', $start, $total, $kmess) . '</p>';
}
echo ( '<div class="menu">
<br/>
<a href="/ferma/index.php?">Khu nông trại</a></div>' );
require_once ('../incfiles/end.php');
?>
