<?php
define('_IN_JOHNCMS', 1);
$headmod = 'Nông trại vui vẻ';
$rootpath = '../';
require_once ('../incfiles/core.php');
require_once ('../incfiles/ferma_func.php');
if(!$user_id)
{         $textl = 'Lỗi';
require_once ('../incfiles/head.php');echo ('
<div class="phdr">' .$textl.'</div>');echo ('<div class="rmenu">Game chỉ cho thành viên tham gia!</div>');
require_once ('../incfiles/end.php');
exit;
}$textl = 'Nông trại vui vẻ';
require_once ('../incfiles/head.php');echo ('
<div class="phdr">' .$textl.'</div>');      $query = mysql_query("SELECT * FROM `ferma` WHERE `date` > '".(time() - 86400)."' ORDER BY `date` DESC LIMIT " .$start. ", " . $kmess. "");
if(@mysql_num_rows($query) == 0)
{
echo ('<div class="rmenu">Nông trại không có</div>');
} else
while ( $row = mysql_fetch_array ( $query ) )
{
if ($row['mesto'] == 1){ $img = '<img src="img/mesto1.png" alt="+"/>';}
if ($row['mesto'] == 2){ $img = '<img src="img/mesto2.png" alt="+"/>';}
if ($row['mesto'] == 3){ $img = '<img src="img/mesto3.png" alt="+"/>';}
echo ( '<div class="menu">Tên nông trại: <b>'.$row['name'].'</b>' .$img. '<br/>
Xây ngày: ' .tdate($row['date']). '<br/>
Điểm kinh nghiệm: ' .$row['opyt']. ' <br/>
Cấp độ: '.$row['level'].'<br/>
Thu nhập: '.$row['dohot'].'<br/>' );
if ($row['mesto'] > 0){echo ( '<b>Hạng ' .$row['mesto']. ' </b><br/>' );}
echo ( '<a href="udar.php?id='.$row['id'].'">Ăn trộm</a></div>' );
}
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `ferma` WHERE `date` > '".(time() - $conf['new'])."'"), 0);
if ($total > $kmess) {
echo '<p>' . pagenav('new.php?', $start, $total, $kmess) . '</p>';
}
echo ( '<div class="menu">
<a href="/ferma/index.php?">Khu nông trại</a></div>' );
require_once ('../incfiles/end.php'); ?>
