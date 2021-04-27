<?php
/*
////////////////////////////////////////////////////////////////////////////////
// JohnCMS                             Content Management System              //
// Официальный сайт сайт проекта:      http://johncms.com                     //
// Дополнительный сайт поддержки:      http://gazenwagen.com                  //
////////////////////////////////////////////////////////////////////////////////
// JohnCMS core team:                                                         //
// Евгений Рябинин aka john77          john77@gazenwagen.com                  //
// Олег Касьянов aka AlkatraZ          alkatraz@gazenwagen.com                //
//                                                                            //

Скрипт банка. Переделан с мотора под джон ПеревозЧЕГом. 
Сайт http://owab.ru

// Информацию о версиях смотрите в прилагаемом файле version.txt              //
////////////////////////////////////////////////////////////////////////////////
*/ 
define('_IN_JOHNCMS', 1);
$textl = 'Banks - Ngân Hàng';
$rootpath = '../';
require_once ("../incfiles/core.php");
require_once ("../incfiles/head.php");
//header("Content-type:text/html; charset=utf-8");

$oldtime=$realtime+43200;

echo '<b>Banks - Ngân Hàng</b><br/><br/>';

if (!empty($user_id)){
//--------------- Функция правильного вывода времени -------------------//
function formattime($file_time){

if($file_time >= 86400){
$file_time = 'Ngày: '.round((($file_time / 60) / 60) / 24, 1);
}elseif(
$file_time >= 3600){
$file_time = 'Giờ:  '.round(($file_time / 60) / 60, 1);
}elseif(
$file_time >= 60){
$file_time =  'phút: '.round($file_time / 60);
}else{
$file_time = 'giây:  '.round($file_time);}
return $file_time;
}
/////////////

$q=mysql_query("select * from bank where user='".$user_id."';");
$q1=mysql_fetch_array($q);
$usersum=$q1['vklad'];
$userdata=$q1['datatime'];
$usid=$q1['id'];
if(!isset($_GET['action'])){

echo'Bạn có: '.$datauser['balans'].' VND<br/>';


if($q1<1){
echo 'Bạn là khách hàng mới của Ngân Hàng. Chúng tôi rất vui chào mừng bạn đến với hệ thống tiết kiệm có lãi của chúng tôi<br/>';
echo 'Tài khoản ngân hàng của bạn chưa có tiền, hãy gửi ít nhất 10 VND để tạo tài khoản nhé!<br/>'; 
} else {

echo 'Bạn đã có một tài khoản trong ngân hàng với số VND là: '.$usersum;}

if($usersum>5000000){echo'<br/><b><font color="#FF0000">Xin lưu ý: Không gửi quá 5 triệu VND, Admin đang nghi ngờ bạn Hack hoặc Bug VND!</font></b>';}


if($userdata>=$realtime){
echo '<br/>Thời gian rút lãi gần nhất còn <b>'.formattime($userdata-$realtime).'</b>';
}else{if($usersum>0){
echo'<br/><b>Số lãi của bạn đã tăng!</b>';}}

//-------------------- Выплата процентов ---------------------//
if($userdata!="" && $realtime>=$userdata && $usersum>0){

$stavka=12;
if($usersum>=100000){$stavka=6;}
if($usersum>=250000){$stavka=3;}
if($usersum>=500000){$stavka=2;}
if($usersum>=1000000){$stavka=1;}
if($usersum<=5000000){
$newgold3=round((($usersum*$stavka)/100)+$usersum);
}else{$newgold3=$usersum;}


 
$pro_gold=$newgold3-$usersum;
echo '<br/>Một phần trăm : '.$pro_gold;
 
                        mysql_query("update `bank` set vklad='" . $newgold3 . "', datatime='".$oldtime."' where user='" . $user_id .
                            "';");
}




echo '<br/><br/><b>Hoạt động:</b>';
echo '<br/><form action="index.php?action=operacia" method="post"><input name="gold" /><br/>';
echo '<select name="oper">';
echo '<option value="2">Gửi tiền vào tài khoản</option><option value="1">Rút tiền từ tài khoản</option>';
echo '</select><br/><br/>';
echo '<input type="submit" value="Tiếp tục" /></form><hr/>';


echo'Số VND gửi tối thiểu là 10 VND<br/>';
echo'Số VND gửi tối đa là 5.000.000.<br/><br/>';
echo'Lãi suất phụ thuộc vào số VND bạn gửi<br/>';
echo'Gửi 100.000 - Tỷ lệ 12%<br/>';
echo'Gửi 100.000 và nhiều hơn. - Tỷ lệ 6%<br/>';
echo'Gửi 250.000 và nhiều hơn. - Tỷ lệ 3%<br/>';
echo'Gửi 500.000 và nhiều hơn. - Tỷ lệ 2%<br/>';
echo'Các thành viên gửi hơn 1.000.000. - Tỷ lệ 1%<br/><br/>';

/*echo'Tổng số người gửi tiền: <b>'.(int)$all_bank.'</b><br/>';
echo'Kho tiền của ngân hàng MHT Bank có: '.moneys($banksumm).'<br/>';*/
}


//------------------------------ Операция ------------------------------------//
if($_GET['action']=="operacia"){
if(ctype_digit($_POST['gold']) && $_POST['gold']>=10 && $_POST['oper']!=""){


//----------------------- Снятие с счета ----------------------------//
if($_POST['oper']=="1"){

echo'<b>Rút tiền từ tài khoản</b><br/>';



if($usersum>0){
if($_POST['gold']<=($usersum-10)){

//------------------------------ Запись в профиль ----------------------------//


$datauser1=round($datauser['balans']+$_POST['gold']);

                        mysql_query("update `users` set `balans`='" . $datauser1 . "' where id='" . $user_id .
                            "';");


$newgold=round($usersum-$_POST['gold']);

                        mysql_query("update `bank` set vklad='" . $newgold . "', datatime='".$oldtime."' where user='" . $user_id .
                            "';");

echo'Số tiền <b>'.$_POST['gold'].' VND</b> rút thành công!<br/>';
echo'Số VND còn lại trong tài khoản: <b>'.$newgold.'</b><br/>';
echo'VND: <b>'.$datauser['balans'].'</b>';

}else{echo'<b>Không thể rút hết tiền, trong tài khoản phải luôn có 10 VND để duy trì!</b>';}
}else{echo'<b>Bạn không thể rút tiền, trong tài khoản của bạn không có tiền!</b>';}

}



//-------------------------- Пополение счета --------------------------------//
if($_POST['oper']=="2"){
echo'<b>Gửi tiền thành công!</b><br/>';

if($_POST['gold']<=$datauser['balans']){

//------------------------------ Запись в профиль ----------------------------//

$dataus1=round($datauser['balans']-$_POST['gold']);


                        mysql_query("update `users` set `balans`='" . $dataus1 . "' where id='" . $user_id .
                            "';");


$newgold=round($usersum+$_POST['gold']);

if($usid){

                        mysql_query("update `bank` set vklad='" . $newgold . "', datatime='".$oldtime."' where user='" . $user_id .
                            "';");

}else{

                        mysql_query("insert into `bank` SET user='".$user_id."', vklad='".$_POST['gold']."', datatime='".$oldtime."';");
}

echo'Số tiền <b>'.$_POST['gold'].'</b> VND được gửi vào tài khoản của bạn thành công!<br/>';
echo'Hiện tại tài khoản ngân hàng của bạn có: <b>'.$newgold.' VND</b><br/>';
echo'Số VND ngoài hiện có: <b>'.$datauser['balans'].' VND</b><br/>';
echo'Không thể nhận số tiền lãi trước 12 giờ sau khi gửi';


}else{echo'<b>Không đủ tiền, bạn không có số tiền này trong tài khoản</b>';}
} 
//----------------------------------------------------------------//


}else{echo'Giao dịch ít hơn 10 VND không được thực hiện<br/>';}
echo'<br/><br/><a href="index.php?">Tiếp tục</a>';
}
	

}else{
echo '<br/>Bạn không được phép để thực hiện các hoạt động phải<br/>';
echo '<b><a href="../login.php">Đăng nhập</a></b> hoặc <b><a href="../registration.php">Đăng ký</a></b><br/><br/>';
}



require_once ("../incfiles/end.php");
?>