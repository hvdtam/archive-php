<?php

define('_IN_JOHNCMS', 1);
$headmod = 'ferma';
$rootpath = '../';
require_once ('../incfiles/core.php');
require_once ('../incfiles/ferma_func.php'); 
if(!$user_id)
{         $textl = 'Nông trại vui vẻ';
        require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ('<div class="rmenu">Chỉ cho thành viên tham gia</div>');
       
        require_once ('../incfiles/end.php');
exit;
}
if(!preg_match("|^[\d]+$|",$_GET['id']))
{         $textl = 'Nông trại vui vẻ';
        require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ('<div class="bmenu">Yêu cầu định dạng không hợp lệ! Kiểm tra URL!</div>');
       echo ( '<div class="menu">
<a href="/ferma/index.php?">Khu nông trại</a></div>' );
     
        require_once ('../incfiles/end.php');
exit;
}


$id = intval ( $_GET['id'] ) ? ( int ) $_GET['id'] : NULL;

      $info = mysql_fetch_assoc(mysql_query("SELECT * FROM `gratka` WHERE `id` = '$id' LIMIT 1"));
           $ferma = mysql_fetch_assoc(mysql_query("SELECT * FROM `ferma` WHERE `id` = '" .$info['ferma']. "' LIMIT 1"));

if(mysql_num_rows(mysql_query ( "SELECT * FROM `gratka` WHERE `id`='" . $id . "' AND `ferma` = '" .$ferma['id']. "' LIMIT 1" )) == 0){
              $textl = 'Lỗi';
        require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
       echo ( '<div class="rmenu">Trống</div>' );
              
echo ( '<a href="/ferma/index.php?">Khu nông trại</a>' );
     
        require_once ('../incfiles/end.php');
exit;
}
      
       $textl = 'Bón phân';
        require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');


if ($info['vred'] > 0 && $ferma['user'] == $user_id){
       $lec = mysql_query("SELECT * FROM `gratka` WHERE `id` = '$id' LIMIT 1"); 

////Лекарства!


 while ($lec1 = mysql_fetch_array($lec))
{

$cena=$lec1['dohot']/$lec1['semid'];  echo ( 'Cây : ' .$lec1['name']. ' <br/> Số lượng : ' .$lec1['vred']. ' <br/> Giá: ' .abs($cena). ' Xu<br/> <a href="lec.php?id=' .$id. '&amp;lec_id= '.$lec1['id'].'">Bón phân</a> <br/> <br/>'); 

}







if ($_GET['lec_id'])
{

if(!preg_match("|^[\d]+$|",$_GET['id']))
{         $textl = 'Ошибкa';
        require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ('<div class="bmenu">Yêu cầu định dạng không hợp lệ! Kiểm tra URL!</div>');
       echo ( '<div class="menu">
<a href="/ferma/index.php?">Khu nông trại</a></div>' );
     
        require_once ('../incfiles/end.php');
exit;
}

$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '" .$user_id. "' LIMIT 1"));
$gratka = mysql_fetch_array(mysql_query("SELECT * FROM `gratka` WHERE `id` = '" .$id. "' LIMIT 1"));

if($user['balans'] >= $gratka['dohod']/$gratka['semid'] ) 
{
 mysql_query("UPDATE `gratka` SET `vred`=`vred`-'" .$gratka['vred']. "' WHERE `id`='".$id."'");
 mysql_query("UPDATE `gratka` SET `vred`=`vred`-'" .$gratka['dohod']/$gratka['semid']. "' WHERE `id`='".$id."'");
if ($gratka['vred'] < 0)
{

 mysql_query("UPDATE `gratka` SET `vred`='0' WHERE `id`='".$id."'");


}






}


echo "Đã bón phân rồi đó, mệt hông?";



}


//////Лекарства!
}

echo ( '<div class="menu">
<a href="/ferma/ferma.php?id=' .$ferma['id']. '">Quay lại</a><br/>
<a href="/ferma/index.php?">Khu nông trại</a></div>' );
       require_once ('../incfiles/end.php');

?>