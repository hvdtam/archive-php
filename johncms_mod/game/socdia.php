<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
////////////////////////////////////////////////////////////////////////////////////////////
$thoigian_cuocchoi = 1*60*60; // day*hour*60*60
$phut = 00; // Số phút hiện kết quả. Ví dụ phút thứ 30 mỗi h;
////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////
$qlast = mysql_query("SELECT * FROM `pmk_mod_socdia` ORDER BY `id` DESC LIMIT 11");
while($row = mysql_fetch_array($qlast,MYSQL_ASSOC)) {
$last[] = $row;
}
if(($last[0]['time']+$thoigian_cuocchoi) < time() || !mysql_num_rows($qlast)) {
if(!mysql_num_rows($qlast))
$cuoc_next = strtotime(date('Y-m-d H').':'.$phut.':00');
else
$cuoc_next = $last[0]['time']+$thoigian_cuocchoi;
$new_kq = rand(0,1)."|".rand(0,1)."|".rand(0,1)."|".rand(0,1);
mysql_query("INSERT INTO pmk_mod_socdia(kq,time) VALUES('".$new_kq."','".$cuoc_next."')");
$list_user = mysql_query("SELECT * FROM `pmk_mod_socdia_user`");
///////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
while($row = mysql_fetch_array($list_user,MYSQL_ASSOC)) {
if(int2chanle(explode("|",$new_kq)))
$kq_check = 2;
else
$kq_check = 1;
//mysql_query("TRUNCATE TABLE `pmk_mod_socdia_user_old`");
if($row['time']==$last[0]['time']){
if($row['play_value'] == $kq_check) {
/////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

mysql_query("UPDATE `users` SET `balans`=`balans`+{$row['money']}+{$row['money']}  WHERE `id` = '{$row['iduser']}'");
$tien_win = $row['money']*2;
$msg = 'Bạn đã thắng cuộc! với tổng số tiền thắng là '.$tien_win.' $';
mysql_query("INSERT INTO `privat` values(0,'".$row['username']."','".$msg."','" . time() . "','TaMk.tK','in','no','Thông báo kết quả cuộc chơi sóc đĩa','0','','','','" . mysql_real_escape_string($fname) . "');");
mysql_query("INSERT INTO `pmk_mod_socdia_user_old` SELECT * FROM `pmk_mod_socdia_user` where `id`='{$row['id']}' AND `time`='".$last[0]['time']."'");
} else {
$msg = 'Bạn đã thua cuộc! bạn bị mất số tiền là '.$row['money'].' $';
mysql_query("INSERT INTO `privat` values(0,'".$row['username']."','".$msg."','" . time() . "','TaMk.tK','in','no','Thông báo kết quả cuộc chơi sóc đĩa','0','','','','" . mysql_real_escape_string($fname) . "');");
}
}
//mysql_query("TRUNCATE TABLE `pmk_mod_socdia_user`");
}
$qlast = mysql_query("SELECT * FROM `pmk_mod_socdia` ORDER BY `id` DESC LIMIT 11");
unset($last);
while($row = mysql_fetch_array($qlast,MYSQL_ASSOC)) {
$last[] = $row;
}
}
//////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////
$textl = 'Sóc đĩa Online | Mobivnn.com | Diễn đàn công nghệ mobile | Wap công nghệ mobile';
$headmod = 'socdia';
date_default_timezone_set('Asia/Ho_Chi_Minh');
if (isset($_SESSION['ref']))
unset($_SESSION['ref']);

require('../incfiles/head.php');

////////////////////////////////////////////
$user = functions::get_user();
if(!empty($_POST['kieudat'])) {
if (eregi("[^0-9]", $_POST['tien'])) {
echo'Đặt sai quy định vui lòng thử lại';}
elseif(empty($_POST['tien']))

echo '<div class="headtab"><table width="100%"><tr>
<td class="menu">
Thông tin đặt cược
</td></tr></table></div>
<div class="box_nobottom"></div><div class="box_notop"><div class="item">Hãy nhập số tiền muốn chơi, ít nhất là 1 </div></div>';
elseif($_POST['tien'] > $user['balans'])
echo '<div class="headtab"><table width="100%"><tr>
<td class="titletab">
Thông tin đặt cược
</td></tr></table></div>
<div class="box_nobottom"></div><div class="box_notop"><div class="item">Số tiền trong tài khoản không đủ, kiểm tra lại.</div></div>';
elseif($_POST['tien'] < 0)
echo '<div class="headtab"><table width="100%"><tr>
<td class="titletab">
Thông tin đặt cược
</td></tr></table></div>
<div class="box_nobottom"></div><div class="box_notop"><div class="item">Bạn đang cố tình bug game. Hãy thận trọng với hành động của mình.</div></div>';
else {

$check = mysql_query("SELECT * FROM `pmk_mod_socdia_user` WHERE `iduser` = '{$user['id']}' LIMIT 1");
mysql_query("UPDATE `users` SET `balans`=`balans`-{$_POST['tien']}  WHERE `id` = '{$user['id']}'");
mysql_query("INSERT INTO pmk_mod_socdia_user(money,iduser,username,play_value,time) VALUES ('{$_POST['tien']}','{$user['id']}','{$user['name']}','{$_POST['kieudat']}','".$last[0]['time']."+".$thoigian_cuocchoi."')");
echo '<div class="headtab"><table width="100%"><tr>
<td class="titletab">
Thông tin đặt cược
</td></tr></table></div>
<div class="box_nobottom"></div><div class="box_notop"><div class="item">Bạn đã đặt cược <b>'.$_POST['tien'].' </b> cho cửa: <b>'.(($_POST['kieudat'] == 1) ? 'Lẻ' : 'Chẵn') .'</b> thành công.</b></div></div>';
$user = functions::get_user();

}
}
/////////////////////////////////////////////

if(!mysql_num_rows($qlast))
echo '<div class="headtab"><table width="100%"><tr>
<td class="titletab">
Thông tin đặt cược
</td></tr></table></div>
<div class="box_nobottom"></div><div class="box_notop"><div class="item">Không thể hiển thị kết quả cuộc chơi gần nhất.</div></div>';
else {
$last_kq = explode("|",$last[0]['kq']);
echo '<div class="headtab"><table width="100%"><tr>
<td class="titletab">
Thông tin - Sự kiện
</td></tr></table></div>
<div class="menu">
Kết quả cuộc chơi gần nhất lúc: <b>'.date('H:i d/m/Y',$last[0]['time']).'</b><br/>
Con vị 1: '.($last_kq[0] ? 'Sấp' : 'Ngửa').'<br/>
Con vị 2: '.($last_kq[1] ? 'Sấp' : 'Ngửa').'<br/>
Con vị 3: '.($last_kq[2] ? 'Sấp' : 'Ngửa').'<br/>
Con vị 4: '.($last_kq[3] ? 'Sấp' : 'Ngửa').'<br/>
Tổng kết quả: '.(int2chanle($last_kq) ? 'Chẵn' : 'Lẻ').'<hr/>
Lịch sử:<br/>';
for($i = 1; $i <= 10; ++$i) {
$ls = explode("|",$last[$i]['kq']);
echo date('H:i',$last[$i]['time']).': <b>'.(int2chanle($ls) ? 'Chẵn' : 'Lẻ').'</b><br/>';
}
echo '</div>';
}
echo '<div class="headtab"><table width="100%"><tr>
<td class="titletab">
Cuộc chơi mới
</td></tr></table></div><div class="box_nobottom"></div><div class="box_notop"><div class="item">Cuộc chơi mới sẽ có kết quả vào: <b>'.date('H:i:s d/m/Y',$last[0]['time']+$thoigian_cuocchoi).'</b><br/>';
if (!$user) {
echo functions::display_error('Bạn cần là thành viên mới có thể chơi được. Vui lòng đăng nhập.');
}
else {
echo 'Tài khoản bạn còn: <b>'.$user['balans'].' </b>.<br/>
Nếu bạn muốn chơi, thì hãy đặt cược.<br/>
<form method="post">
Cửa:<select name="kieudat">
<option value="2">Chẵn</option>
<option value="1">Lẻ</option>
</select><br/>
Số tiền đặt:<Br/> <input value="" name="tien" style="width:50%;" type="text" /> <b></b>
<br/>
<input type="submit" value="Đặt cược" name="submit"/>
</form>';
}
echo '</div></div>';

$result = mysql_query("SELECT * FROM `pmk_mod_socdia_user` WHERE `time`='".$last[0]['time']."'");
while($row = mysql_fetch_array($result)) {
$list_user_thamgia[] = $row;
}
$timexem=$last[0]['time']-$thoigian_cuocchoi;
$result = mysql_query("SELECT * FROM `pmk_mod_socdia_user_old` WHERE `time`= '".$timexem."'");
while($row = mysql_fetch_array($result)) {
$list_user_trung[] = $row;
}

echo '<div class="headtab" id="nhadautu"><table width="100%"><tr>
<td class="titletab">
Người đặt cược
</td></tr></table></div>
<div class="box_nobottom"></div><div class="box_notop"><div class="item">
Những người đã đặt cuộc chơi mở lúc <b>'.date('H:i d/m/Y',$last[0]['time']+$thoigian_cuocchoi).'</b>: '.count($list_user_thamgia).' lượt<br/><div class="chuyen-muc"><ul>';
for($i=0; $i<count($list_user_thamgia);++$i) {
echo '<li><a href="../users/profile.php?user='.$list_user_thamgia[$i]['iduser'].'">'.$list_user_thamgia[$i]['username'].'</a> ('.(($list_user_thamgia[$i]['play_value'] == '2') ? 'Chẵn' : 'Lẻ').' - '.$list_user_thamgia[$i]['money'].' )';
/*
if($list_user_thamgia[$i]['iduser']==$user['id']){
switch($act){
case'del':
mysql_query("DELETE FROM `pmk_mod_socdia_user` WHERE `id` = '".$list_user_thamgia[$i]['id']."'");
$tienlaylai=$list_user_thamgia[$i]['money']-($list_user_thamgia[$i]['money']/100)*10;
mysql_query("UPDATE `users` SET `balans`=`balans`+".$tienlaylai."  WHERE `id` = '".$list_user_thamgia[$i]['iduser']."'");

echo'Del xong';
break;
default:
echo'<small><a href="../games/socdia.php?act=del"><span style="color:red">[x]</span></a></small>';

}
}
*/
echo'</li>';
}
echo '</ul></div></div></div>';
echo '<div class="headtab"><table width="100%"><tr>
<td class="titletab">
Trúng thưởng
</td></tr></table></div>
<div class="box_nobottom"></div><div class="box_notop"><div class="item">';
echo 'Những người trúng thưởng cuộc chơi mở lúc <b>'.date('H:i d/m/Y',$last[0]['time']).'</b>: '.count($list_user_trung).' lượt<br/><div class="chuyen-muc"><ul>';
for($i=0; $i<count($list_user_trung);++$i) {
$tien_win_2 = $list_user_trung[$i]['money']*2;
echo '<li><a href="../users/profile.php?user='.$list_user_trung[$i]['iduser'].'">'.$list_user_trung[$i]['username'].'</a> ('.$tien_win_2.' )</li>';
}
echo '</ul></div></div></div>';
function int2chanle($kq) {
if(gettype(array_sum($kq)/2) == 'integer')
return 1;
else
return 0;
}
////Cái này để Auto clean đỡ đầy data
$canxoa=time()-86400*3; //3 là số ngày trước
//Sóc đĩa
mysql_query("DELETE FROM `pmk_mod_socdia` WHERE `time` < '$canxoa'");
mysql_query("DELETE FROM `pmk_mod_socdia_user` WHERE `time` < '$canxoa'");
mysql_query("DELETE FROM `pmk_mod_socdia_user_old` WHERE `time` < '$canxoa'");
/*
//Tôm cua
mysql_query("DELETE FROM `pmk_mod_tomcua` WHERE `time` < '$canxoa'");
mysql_query("DELETE FROM `pmk_mod_tomcua_user` WHERE `time` < '$canxoa'");
mysql_query("DELETE FROM `pmk_mod_tomcua_user_old` WHERE `time` < '$canxoa'");
//Xổ số
mysql_query("DELETE FROM `xoso_kq` WHERE `time` < '$canxoa'");
mysql_query("DELETE FROM `xoso` WHERE `time` < '$canxoa'");
mysql_query("DELETE FROM `xoso_trungthuong` WHERE `time` < '$canxoa'");
//Xổ số MB
/*
mysql_query("DELETE FROM `xsmb` WHERE `time` < '$canxoa'*3");
mysql_query("DELETE FROM `xsmb_trungthuong` WHERE `time` < '$canxoa'*3");
mysql_query("DELETE FROM `xsmb_user` WHERE `time` < '$canxoa'*3");
*/
////////////////////
require('../incfiles/end.php');
?>
