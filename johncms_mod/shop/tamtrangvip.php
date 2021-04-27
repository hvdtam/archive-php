<?php
define('_IN_JOHNCMS', 1);
$textl = 'Thay đổi tâm trạng';
$headmod = 'nick';
require_once ("../incfiles/core.php");
require_once ("../incfiles/head.php");
if ($id && $id != $user_id) {
    $req = mysql_query("SELECT * FROM `users` WHERE `id` = '$id' LIMIT 1");
    if (mysql_num_rows($req)) {
        $user = mysql_fetch_assoc($req);
}
else {

}
}
else {
$id = false;
$user = $datauser;
}

if (!$user_id) {
    require_once ('../incfiles/head.php');
    display_error('Chỉ cho người dùng đăng ký');
    require_once ('../incfiles/end.php');
    exit;
}
echo '<div class="menu">Thay đổi tâm trạng</div>';
echo '<div class="gray">Thay đổi tâm trạng của bạn</div>';
switch($act){
case 'tamtrang' :
if($user['balans']>=0){
echo '<div> <form action="tamtrang.php?act=tamtrangbuy" name="tamtrang" method="post">
<input type="radio" name="tamtrang" value="adminvip"/> <img src="../tamtrang/adminvip.gif"></img><br/>
<input type="radio" name="tamtrang" value="modvip"/> <img src="../tamtrang/modvip.gif"></img><br/>
<input type="radio" name="tamtrang" value="smodvip"/> <img src="../tamtrang/smodvip.gif"></img><br/>
<input type="radio" name="tamtrang" value="admin"/> <img src="../tamtrang/admin.gif"></img><br/>
<input type="radio" name="tamtrang" value="banner"/> <img src="../tamtrang/banner.gif"></img><br/>
<input type="radio" name="tamtrang" value="DaiCa"/> <img src="../tamtrang/DaiCa.gif"></img><br/>
<input type="radio" name="tamtrang" value="Compu"/> <img src="../tamtrang/Compu.gif"></img><br/>
<input type="radio" name="tamtrang" value="Cuoi"/> <img src="../tamtrang/Cuoi.gif"></img><br/>
<input type="radio" name="tamtrang" value="Danh"/> <img src="../tamtrang/Danh.gif"></img><br/>
<input type="radio" name="tamtrang" value="HoHo"/> <img src="../tamtrang/HoHo.gif"></img><br/>
<input type="radio" name="tamtrang" value="BeBe"/> <img src="../tamtrang/BeBe.gif"></img><br/>
<input type="radio" name="tamtrang" value="ITM1"/> <img src="../tamtrang/ITM1.gif"></img><br/>
<input type="radio" name="tamtrang" value="ITM2"/> <img src="../tamtrang/ITM2"></img><br/>
<input type="radio" name="tamtrang" value="ITM3"/> <img src="../tamtrang/ITM3.gif"></img><br/>
<input type="radio" name="tamtrang" value="ITM4"/> <img src="../tamtrang/ITM4.gif"></img><br/>
<input type="radio" name="tamtrang" value="ITM5"/> <img src="../tamtrang/ITM5.gif"></img><br/>
<input type="radio" name="tamtrang" value="ITM6"/> <img src="../tamtrang/ITM6.gif"></img><br/>
<input type="radio" name="tamtrang" value="ITM7"/> <img src="../tamtrang/ITM7.gif"></img><br/>
<input type="radio" name="tamtrang" value="ITM8"/> <img src="../tamtrang/ITM8.gif"></img><br/>
<input type="radio" name="tamtrang" value="ITM9"/> <img src="../tamtrang/ITM9.gif"></img><br/>
<input type="radio" name="tamtrang" value="thanhvienvang"/> <img src="../tamtrang/thanhvienvang.gif"></img><br/>
<input type="radio" name="tamtrang" value="thanhvienbac"/> <img src="../tamtrang/thanhvienbac.gif"></img><br/>
<input type="radio" name="tamtrang" value="thanhviendong"/> <img src="../tamtrang/thanhviendong.gif"></img><br/>
<input type="radio" name="tamtrang" value="thanhvienvip"/> <img src="../tamtrang/thanhvienvip.gif"></img><br/>
<input type="radio" name="tamtrang" value="hocmaumui"/> <img src="../tamtrang/hocmaumui.gif"></img><br/>
<input type="submit" name="submit" value="Đồng ý"/> </form> </div> '; 
}else{
echo '<div class="menu">Bạn không đủ số VGold hoặc DGold, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';
}
break;
case 'tamtrangbuy' :
if($user['balans']>=0){
$status = ($_POST['tamtrang']); 
mysql_query("UPDATE `users` SET `status` = '$status' ,`balans`=`balans`-0  WHERE `id` = '$user_id' LIMIT 1");
echo '<div class="menu">Tâm trạng của bạn đã thay đổi, hãy kiểm tra!</div>';



header('Location:../shop/tamtrang.php?act=tamtrangbuyo');
exit();

}else{
echo '<div class="menu">Bạn không đủ số VGold hoặc DGold, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';
}
break;
case 'tamtrangbuyo' :
echo '<div class="menu">Tâm trạng của bạn đã thay đổi, hãy kiểm tra!</div>';

break;
default :
echo '<div class="bmenu">Bạn không đủ số VGold hoặc DGold, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';
echo '<div class="menu">Thay doi: <li><a href="tinhtrang.php?act=tamtrang">Tinh trang</a></li>';


}
echo '<div class="menu"><a href="../str/anketa.php">Hồ sơ cá nhân</a></div>';
require_once ("../incfiles/end.php");
?>