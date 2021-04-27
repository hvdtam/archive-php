<?php

define('_IN_JOHNCMS', 1);
$headmod = 'ferma';
$rootpath = '../';
require_once ('../incfiles/core.php');
require_once ('../incfiles/ferma_func.php'); 
if(!$user_id)
{         $textl = 'Nông trại vui vẻ';
        require_once ('../incfiles/head.php');echo ('
<div class="phdr">' .$textl.'</div>');echo ('<div class="rmenu">Chỉ cho thành viên đăng ký tham gia!</div>');
       
        require_once ('../incfiles/end.php');
exit;
}if(!preg_match("|^[\d]+$|",$_GET['id']))
{         $textl = 'Nông trại vui vẻ';
        require_once ('../incfiles/head.php');echo ('
<div class="phdr">' .$textl.'</div>');echo ('<div class="bmenu">Неверный формат запроса! Проверьте URL!</div>');
       echo ( '<div class="menu">
<a href="/ferma/index.php?">Khu nông trại</a></div>' );
     
        require_once ('../incfiles/end.php');
exit;
}


$id = intval ( $_GET['id'] ) ? ( int ) $_GET['id'] : NULL;
      $info = mysql_fetch_assoc(mysql_query("SELECT * FROM `gratka` WHERE `id` = '$id' LIMIT 1"));
           $ferma = mysql_fetch_assoc(mysql_query("SELECT * FROM `ferma` WHERE `id` = '" .$info['ferma']. "' LIMIT 1"));

if(mysql_num_rows(mysql_query ( "SELECT * FROM `gratka` WHERE `id`='" . $id . "' AND `ferma` = '" .$ferma['id']. "' LIMIT 1" )) == 0){
              $textl = 'Ошибка';
        require_once ('../incfiles/head.php');echo ('
<div class="phdr">' .$textl.'</div>');
       echo ( '<div class="rmenu">Không có</div>' );
              
echo ( '<a href="/ferma/index.php?">Khu nông trại</a>' );
     
        require_once ('../incfiles/end.php');exit;
}
      
       $textl = 'Thu hoạch';
        require_once ('../incfiles/head.php');echo ('
<div class="phdr">' .$textl.'</div>');


if (time() >= $info['data'] && $ferma['user'] == $user_id){
      $row = mysql_fetch_assoc(mysql_query("SELECT * FROM `semena` WHERE `id` = '" .$info['semid']. "' LIMIT 1"));


//////Вредители!!
if ($info[vred] > 0)
{
if ($info[vred] < 5) 
{
$vred  = rand(3,15) ;
}
}
if ($info[vred] > 5)
{
if ($info[vred] < 9) 
{
$vred  = rand(7,20) ;
}
}
if ($info[vred] > 10)
{
if ($info[vred] < 16) 
{
$vred  = rand(15,30) ;
}
}
if ($info[vred] == 0)
{$vred = 0;}
$row['cena'] = $row['cena'] - $vred ;
if ($row['cena'] < 0)
{
$row['cena'] = 0 ;
printf ("Dịch sâu hại cây, bạn không thể bán được! ");
} 
else
{
if ($vred != 0)
{
printf ("Dịch sâu hại cây, bạn sẽ bị trừ tiền! ",$vred);
 }
}
/////////Вредители!!! 



mysql_unbuffered_query ( "UPDATE `ferma` SET `dohot`=`dohot`+'" .$row['cena']. "' WHERE `id`='" .$info['ferma']. "'" );

mysql_unbuffered_query ( "UPDATE `users` SET `balans`=`balans`+'" .$row['cena']. "' WHERE `id`='" .$user_id. "'" );

mysql_unbuffered_query ( "UPDATE `ferma` SET `opyt`=`opyt`+1 WHERE `id`=" .$info['ferma'] );

mysql_unbuffered_query ( "DELETE FROM `gratka` WHERE `id`='" .$id. "'" );

echo ( '<div class="rmenu">Thu hoạch xong nông trại</div>' );
}

else{
echo ( '<div class="rmenu">Chưa thu hoạch được, cây trồng chưa lớn</div>' );
}

echo ( '<div class="menu">
<a href="/ferma/ferma.php?id=' .$ferma['id']. '">Quay lại</a><br/>
<a href="/ferma/index.php?">Khu nông trại</a></div>' );
       require_once ('../incfiles/end.php');

?>