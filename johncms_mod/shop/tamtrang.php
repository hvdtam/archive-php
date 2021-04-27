<?phpdefine('_IN_JOHNCMS', 1);
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
    echo functions::display_error($lng['access_guest_forbidden']);
    require_once ('../incfiles/end.php');
    exit;
}
echo '<div class="menu">Thay đổi tâm trạng</div>';
echo '<div class="gray">Thay đổi tâm trạng của bạn</div>';
switch($act){
case 'tamtrang' :
if($user['balans']>=0){
echo '<div> <form action="tamtrang.php?act=tamtrangbuy" name="tamtrang" method="post">
<input type="radio" name="tamtrang" value="ZuiQuaXa"/> <img src="../tamtrang/ZuiQuaXa.gif"></img><br/>
<input type="radio" name="tamtrang" value="XinhTuoi"/> <img src="../tamtrang/XinhTuoi.gif"></img><br/>
<input type="radio" name="tamtrang" value="TucQuaDi"/> <img src="../tamtrang/TucQuaDi.gif"></img><br/>
<input type="radio" name="tamtrang" value="ThatTinhRui"/> <img src="../tamtrang/ThatTinhRui.gif"></img><br/>
<input type="radio" name="tamtrang" value="TanTa"/> <img src="../tamtrang/TanTa.gif"></img><br/>
<input type="radio" name="tamtrang" value="SungSuong"/> <img src="../tamtrang/SungSuong.gif"></img><br/>
<input type="radio" name="tamtrang" value="RatTuTin"/> <img src="../tamtrang/RatTuTin.gif"></img><br/>
<input type="radio" name="tamtrang" value="RatLaNgau"/> <img src="../tamtrang/RatLaNgau.gif"></img><br/>
<input type="radio" name="tamtrang" value="QuyetTam"/> <img src="../tamtrang/QuyetTam.gif"></img><br/>
<input type="radio" name="tamtrang" value="NghiQua"/> <img src="../tamtrang/NghiQua.gif"></img><br/>
<input type="radio" name="tamtrang" value="MuonKhoc"/> <img src="../tamtrang/MuonKhoc.gif"></img><br/>
<input type="radio" name="tamtrang" value="LeuLeu"/> <img src="../tamtrang/LeuLeu.gif"></img><br/>
<input type="radio" name="tamtrang" value="KhongGionNha"/> <img src="../tamtrang/KhongGionNha.gif"></img><br/>
<input type="radio" name="tamtrang" value="HoNang"/> <img src="../tamtrang/HoNang.gif"></img><br/>
<input type="radio" name="tamtrang" value="HoiHopQua"/> <img src="../tamtrang/HoiHopQua.gif"></img><br/>
<input type="radio" name="tamtrang" value="DoMat"/> <img src="../tamtrang/DoMat.gif"></img><br/>
<input type="radio" name="tamtrang" value="DangZui"/> <img src="../tamtrang/DangZui.gif"></img><br/>
<input type="radio" name="tamtrang" value="DangNgu"/> <img src="../tamtrang/DangNgu.gif"></img><br/>
<input type="radio" name="tamtrang" value="DangBuon"/> <img src="../tamtrang/DangBuon.gif"></img><br/>
<input type="radio" name="tamtrang" value="BucRoiNha"/> <img src="../tamtrang/BucRoiNha.gif"></img><br/>
<input type="radio" name="tamtrang" value="BoTayRui"/> <img src="../tamtrang/BoTayRui.gif"></img><br/>
<input type="radio" name="tamtrang" value="DaiKhoLam"/> <img src="../tamtrang/DaiKhoLam.gif"></img><br/>
<input type="radio" name="tamtrang" value="DangKhoc"/> <img src="../tamtrang/DangKhoc.gif"></img><br/>
<input type="radio" name="tamtrang" value="DangYeu"/> <img src="../tamtrang/DangYeu.gif"></img><br/>
<input type="radio" name="tamtrang" value="DoiVoDoi"/> <img src="../tamtrang/DoiVoDoi.gif"></img><br/>
<input type="radio" name="tamtrang" value="HamMoWa"/> <img src="../tamtrang/HamMoWa.gif"></img><br/>
<input type="radio" name="tamtrang" value="HokTinNoi"/> <img src="../tamtrang/HokTinNoi.gif"></img><br/>
<input type="radio" name="tamtrang" value="HunCaiNha"/> <img src="../tamtrang/HunCaiNha.gif"></img><br/>
<input type="radio" name="tamtrang" value="KhoXuQua"/> <img src="../tamtrang/KhoXuQua.gif"></img><br/>
<input type="radio" name="tamtrang" value="MoiAnDon"/> <img src="../tamtrang/MoiAnDon.gif"></img><br/>
<input type="radio" name="tamtrang" value="NgacNhien"/> <img src="../tamtrang/NgacNhien.gif"></img><br/>
<input type="radio" name="tamtrang" value="Suyt"/> <img src="../tamtrang/Suyt.gif"></img><br/>
<input type="radio" name="tamtrang" value="SoHai"/> <img src="../tamtrang/SoHai.gif"></img><br/>
<input type="radio" name="tamtrang" value="ThoNgay"/> <img src="../tamtrang/ThoNgay.gif"></img><br/>
<input type="radio" name="tamtrang" value="XinLoiNha"/> <img src="../tamtrang/XinLoiNha.gif"></img><br/>
<input type="radio" name="tamtrang" value="BenhRui"/> <img src="../tamtrang/BenhRui.gif"></img><br/>
<input type="radio" name="tamtrang" value="RatChanh"/> <img src="../tamtrang/RatChanh.gif"></img><br/>
<input type="submit" name="submit" value="Đồng ý"/> </form> </div> '; 
}else{
echo '<div class="menu">Bạn không đủ số VGold, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';
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
echo '<div class="menu">Bạn không đủ số VGold hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';
}
break;
case 'tamtrangbuyo' :
echo '<div class="menu">Tâm trạng của bạn đã thay đổi, hãy kiểm tra!</div>';

break;
default :
echo '<div class="bmenu">Bạn không đủ số VGold, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';
echo '<div class="menu">Thay đổi tâm trạng miển phí: <li><a href="../shop/tamtrang.php?act=tamtrang">Tâm trạng thường</a></li>';


}
echo '<div class="menu"><a href="../users/profile.php">Hồ sơ cá nhân</a></div>';
require_once ("../incfiles/end.php");
?>