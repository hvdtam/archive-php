<?php

define('_IN_JOHNCMS', 1);
$headmod = 'Nông trại vui vẻ';
$rootpath = '../';
require_once ('../incfiles/core.php');
require_once ('../incfiles/ferma_func.php'); 

if(!$user_id)
{         $textl = 'Nông trại vui vẻ';
        require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ('<div class="rmenu">Chỉ cho thành viên tham gia!</div>');
       
        require_once ('../incfiles/end.php');
break;
}
$id = intval ( $_GET['id'] ) ? ( int ) $_GET['id'] : NULL;

       $user = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$user_id' LIMIT 1"));

       $ferma = mysql_fetch_assoc(mysql_query("SELECT * FROM `ferma` WHERE `id` = '$id' LIMIT 1"));
if(!preg_match("|^[\d]+$|",$_GET['id']))
{         $textl = 'Ошибкa';
        require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ('<div class="bmenu">Yêu cầu định dạng không hợp lệ! Kiểm tra URL!</div>');
       
echo ( '<div class="menu">

<a href="/ferma/index.php?">Danh sách các trang trại</a></div>' );
             require_once ('../incfiles/end.php');

break;
}
if(mysql_num_rows(mysql_query ( "SELECT * FROM `ferma` WHERE `id`='" . $id . "' AND `user` = '" .$user_id. "' LIMIT 1" )) == 0){
              $textl = 'Ошибка';
        require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
       echo ( '<div class="rmenu">đây không phải trang trại</div>' );
              
echo ( '<div class="menu">

<a href="/ferma/index.php?">Khu nông trại</a></div>' );
             require_once ('../incfiles/end.php');

break;
}
               $textl = 'Làm nông';
        require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
                $ferma = mysql_fetch_assoc(mysql_query("SELECT * FROM `ferma` WHERE `id` = '" .$id. "' LIMIT 1"));

if ($ferma['user'] == $user_id) { 
echo ( '<div class="menu">
Chào ' .$login. ', đây là nông trại của bạn, hãy mua cây giống, trồng cây, chăm sóc, tưới nước, bón phân và thu hoạch nhé!</div>' );



if($ferma['dohot']>$conf['level_2'] && $ferma['level'] == 1){
echo ( '<b>Chúc mừng bạn đã lên cấp độ 2 !!!<br/></b>' );
mysql_query("UPDATE `ferma` SET `level`='2' WHERE `id`='".$id."'");
}

if($ferma['dohot']> $conf['level_3'] && $ferma['level']==2){
echo ( '<b>Chúc mừng bạn đã lên cấp độ 3 !!!<br/></b>' );
mysql_query("UPDATE `ferma` SET `level`='3' WHERE `id`='".$id."'");
}

if($ferma['dohot']>$conf['level_4'] && $ferma['level']==3){
echo ( '<b>Chúc mừng bạn đã lên cấp độ 4 !!!<br/></b>' );
mysql_query("UPDATE `ferma` SET `level`='4' WHERE `id`='".$id."'");
}
if($ferma['dohot']>$conf['level_5'] && $ferma['level']==4){
echo ( '<b>Chúc mừng bạn đã lên cấp độ 5 !!!<br/></b>' );
mysql_query("UPDATE `ferma` SET `level`='5' WHERE `id`='".$id."'");
}
if($ferma['dohot']>$conf['level_6'] && $ferma['level']==5){
echo ( '<b>Chúc mừng bạn đã lên cấp độ 6 !!!<br/></b>' );
mysql_query("UPDATE `ferma` SET `level`='6' WHERE `id`='".$id."'");
}

if($ferma['dohot']>$conf['level_7'] && $ferma['level']==6){
echo ( '<b>Chúc mừng bạn đã lên cấp độ 7 !!!<br/></b>' );
mysql_query("UPDATE `ferma` SET `level`='7' WHERE `id`='".$id."'");
}
if($ferma['dohot']>$conf['level_8'] && $ferma['level']==7){
echo ( '<b>Chúc mừng bạn đã lên cấp độ 8 !!!<br/></b>' );
mysql_query("UPDATE `ferma` SET `level`='8' WHERE `id`='".$id."'");
}

if($ferma['dohot']>$conf['level_9'] && $ferma['level']==8){
echo ( '<b>Chúc mừng bạn đã lên cấp độ 9 !!!<br/></b>' );
mysql_query("UPDATE `ferma` SET `level`='9' WHERE `id`='".$id."'");
} 
if($ferma['dohot']>$conf['level_10'] && $ferma['level']==9){
echo ( '<b>Xin chúc mừng bạn đã đạt đến cấp độ tối đa, Bây giờ bạn có thể mua không giới hạn nông trại!<br/></b>' );
mysql_query("UPDATE `ferma` SET `level`='10' WHERE `id`='".$id."'");
}
$query = mysql_query("SELECT * FROM `gratka` WHERE `ferma` = '".$id."' ORDER BY `date` DESC LIMIT " .$start. ", " . $kmess. "");

if(@mysql_num_rows($query) == 0)
  {
      echo ('<div class="rmenu">Bạn chưa trồng cây!</div>');
    } else 
    while ( $row = mysql_fetch_array ( $query ) )
  {
if($row['semid']){$ico = '<img src="img/'.$row['semid'].'.png" alt="+"/>';} else {$ico = '<img src="img/no.png" alt="+"/>';}
echo ( '<div class="menu">Cây: ' .$row['name']. ' ' .$ico. '<br/>Ngày trồng: ' .tdate($row['date']). '<br/>Có thể thu hoạch trong: ' .tdate($row['date2']). ' giây<br/>
Thu hoạch từ cây: ' .$row['dohot']. ' <br/>
Cây chậm lớn: ' .$row['vred']. ' <br/>' );
if ($row['vred'] != 0)
{
echo ( '<a href="lec.php?id=' .$row['id']. '">Bón phân</a><br/>' );
}

if (time() >= $row['date2']) {
echo ( '<a href="spor.php?id=' .$row['id']. '">Thu hoạch</a>' );
 }
echo ( ' </div>' ); 
}

    $total = mysql_result ( mysql_query ( "SELECT COUNT(*) FROM `gratka` WHERE `ferma` = '" .$id. "'" ), 0 );
    if ($total > $kmess) {
        echo '<p>' . pagenav('ferma.php?id=' .$id. '&amp;', $start, $total, $kmess) . '</p>';
}
echo ( '<div class="rmenu"><img src="img/ico.png" alt="+"/> <a href="posatka.php?id=' .$id. '">Mua hạt giống</a><br/>
<img src="img/info.png" alt="+"/> <a href="faq.php?act=level"> Các phần thưởng khi lên cấp</a><br/>
<img src="img/info.png" alt="+"/> <a href="faq.php?act=level2">Danh sách hạt giống bạn có thể trồng khi lên cấp!</a></div>' );

 
}
else {
   $textl = 'Ошибка';
    require_once ("../incfiles/head.php");
    echo ( '<div class="rmenu"><p>' . $textl . '</p></div>' );
echo ( '<div class="rmenu">Đây không phải là trang trại của bạn<br/></div>' );

 }

echo ( '<div class="menu">
<a href="/ferma/ferma.php?id=' .$ferma['id']. '">Quay lại</a><br/>
<a href="/ferma/index.php?">Danh sách nông trại</a></div>' );
     require_once ('../incfiles/end.php');

?>