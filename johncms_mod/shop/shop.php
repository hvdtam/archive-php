<?php
define('_IN_JOHNCMS', 1);
$textl = 'Shop';
$headmod = 'shop';
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
echo display_error ('
<br/>Bạn không được phép để thực hiện các hoạt động, bạn phải<br/><b><a href="../login.php">Đăng nhập</a></b> hoặc <b><a href="../registration.php">Đăng ký</a></b><br/>');
require_once ('../incfiles/end.php');
exit;
}
switch($act){
case 'color' :
if($user['balans']>=200){
echo '<div><form action="shop.php?act=colorbuy" name="color" method="post">
<input type="radio" name="color" value="006400"/><font color="#006400"> MouseIT</font><br />
<input type="radio" name="color" value="0000FF"/><font color="#0000FF"> MouseIT</font><br />
<input type="radio" name="color" value="000080"/><font color="#000080"> MouseIT</font><br />
<input type="submit" name="submit" value="Mua"/></form></div>';
}else{
echo '<div class="menu">Bạn không đủ tiền, bạn có '.$user['balans'].'VND, cần 200DDV để mua, vui lòng nạp thêm</div>';
}
break;
case 'colorbuy' :
if($user['balans']>=200){
$color = ($_POST['color']);
mysql_query("UPDATE `users` SET `colornick` = '$color' ,`balans`=`balans`-200  WHERE `id` = '$user_id' LIMIT 1");
echo '<div class="menu">Mua màu nick thành công, màu nick của bạn là: <font color="#'.$color.'">'.$login.'</font> .Bạn bị trừ 500 VND</div>';
echo '<div class="menu"><a href="../str/shop.php">Quay lại cửa hàng</a></div>';
header('Location:..');
exit();
}else{
echo '<div class="menu">Bạn không đủ tiền, bạn có '.$user['balans'].'VND, cần 200 VND đề mua, vui lòng nạp thêm</div>';
}
break;
case 'colorbuyo' :
echo '<div class="menu">Mua màu nick thành công, màu nick của bạn là: <font color="#'.$color.'">'.$login.'</font> .Bạn bị trừ 200 VND!</div>';
echo '<div class="menu"><a href="../str/shop.php">Quay lại cửa hàng</a></div>';
break;
case 'status' :
if($user['balans']>=300){
echo '<div class="menu"><img src="http://vn.mhatinh.com/theme/default/images/label.png"/>Tâm trạng là tính năng sẽ làm bạn nổi bật trên trang wap của MouseIT<br/>';
echo '<div class="menu"><img src="../theme/default/images/label.png"/>Vui lòng nhập tên tâm trạng bạn muốn mua<br/>';
echo '<form action="shop.php?act=statusbuy" name="status" method="post">
<input type="text" name="status" value="Nhập vào"/>
<input type="submit" name="submit" value="Mua"/></form></div>';
echo '<div class="menu"><img src="../theme/default/images/label.png"/>Tên các Tâm Trạng<br/>';
echo '<div class="menu"><img src="../tamtrang/Alo.gif"/> Alo<br/>';
echo '<div class="menu"><img src="../tamtrang/DoMat.gif"/> DoMat<br/>';
echo '<div class="menu"><img src="../tamtrang/Get.gif"/> Get<br/>';
echo '<div class="menu"><img src="../tamtrang/HuHu.gif"/> HuHu<br/>';
echo '<div class="menu"><img src="../tamtrang/LeuLeu.gif"/> LeuLeu<br/>';
echo '<div class="menu"><img src="../tamtrang/MacCuoi.gif"/> MacCuoi<br/>';
echo '<div class="menu"><img src="../tamtrang/NghiQua.gif"/> NghiQua<br/>';
echo '<div class="menu"><img src="../tamtrang/TrumNe.gif"/> TrumNe<br/>';
echo '<div class="menu"><img src="../tamtrang/DaiCa.gif"/> DaiCa<br/>';
echo '<div class="menu"><img src="../tamtrang/HoHo.gif"/> HoHo<br/>';
echo '<div class="menu"><img src="../tamtrang/Kiss.gif"/> Kiss<br/>';
echo '<div class="menu"><img src="../tamtrang/Love.gif"/> Love<br/>';
echo '<div class="menu"><img src="../tamtrang/NgauChua.gif"/> NgauChua<br/>';
echo '<div class="menu"><img src="../tamtrang/OmCai.gif"/> OmCai<br/>';
echo '<div class="menu"><img src="../tamtrang/ZuiQuaXa.gif"/> ZuiQuaXa<br/>';
echo '<div class="menu"><img src="../tamtrang/XinhTuoi.gif"/> XinhTuoi<br/>';
echo '<div class="menu"><img src="../tamtrang/BenhRui.gif"/> BenhRui<br/>';
echo '<div class="menu"><img src="../tamtrang/BoTayRui.gif"/> BoTayRui<br/>';
echo '<div class="menu"><img src="../tamtrang/BucRoiNha.gif"/> BucRoiNha<br/>';
echo '<div class="menu"><img src="../tamtrang/ChongMat.gif"/> ChongMat<br/>';
echo '<div class="menu"><img src="../tamtrang/DaiKhoLam.gif"/> DaiKhoLam<br/>';
echo '<div class="menu"><img src="../tamtrang/DangBuon.gif"/> DangBuon<br/>';
echo '<div class="menu"><img src="../tamtrang/DangKhoc.gif"/> DangKhoc<br/>';
echo '<div class="menu"><img src="../tamtrang/DangNgu.gif"/> DangNgu<br/>';
echo '<div class="menu"><img src="../tamtrang/DangYeu.gif"/> DangYeu<br/>';
echo '<div class="menu"><img src="../tamtrang/DangZui.gif"/> DangZui<br/>';
echo '<div class="menu"><img src="../tamtrang/DoMat.gif"/> DoMat<br/>';
echo '<div class="menu"><img src="../tamtrang/DoiVoDoi.gif"/> DoiVoDoi<br/>';
echo '<div class="menu"><img src="../tamtrang/HamMoWa.gif"/> HamMoWa<br/>';
echo '<div class="menu"><img src="../tamtrang/HoNang.gif"/> HoNang<br/>';
echo '<div class="menu"><img src="../tamtrang/HoiHopQua.gif"/> HoiHopQua<br/>';
echo '<div class="menu"><img src="../tamtrang/HunCaiNha.gif"/> HunCaiNha<br/>';
echo '<div class="menu"><img src="../tamtrang/KhongGionNha.gif"/> KhongGionNha<br/>';
echo '<div class="menu"><img src="http://www.vn.mhatinh.com/tamtrang/LeuLeu.gif"/> LeuLeu<br/>';
echo '<div class="menu"><img src="../tamtrang/MoiAnDon.gif"/> MoiAnDon<br/>';
echo '<div class="menu"><img src="../tamtrang/MuonKhoc.gif"/> MuonKhoc<br/>';
echo '<div class="menu"><img src="../tamtrang/NgacNhien.gif"/> NgacNhien<br/>';
echo '<div class="menu"><img src="../tamtrang/NghiQua.gif"/> NghiQua<br/>';
echo '<div class="menu"><img src="../tamtrang/QuaLuaDao.gif"/> QuaLuaDao<br/>';
echo '<div class="menu"><img src="../tamtrang/QuyetTam.gif"/> QuyetTam<br/>';
echo '<div class="menu"><img src="../tamtrang/RatLaNgau.gif"/> RatLaNgau<br/>';
echo '<div class="menu"><img src="../tamtrang/RatLuaTinh.gif"/> RatLuaTinh<br/>';
echo '<div class="menu"><img src="../tamtrang/RatChanh.gif"/> RatChanh<br/>';
echo '<div class="menu"><img src="../tamtrang/RatTuTin.gif"/> RatTuTin<br/>';
echo '<div class="menu"><img src="../tamtrang/SoHai.gif"/> SoHai<br/>';
echo '<div class="menu"><img src="../tamtrang/SungSuong.gif"/> <SungSuongbr/>';
echo '<div class="menu"><img src="../tamtrang/Suyt.gif"/> Suyt<br/>';
echo '<div class="menu"><img src="../tamtrang/TanTa.gif"/> TanTa<br/>';
echo '<div class="menu"><img src="../tamtrang/ThoNgay.gif"/> ThoNgay<br/>';
echo '<div class="menu"><img src="../tamtrang/TucQuaDi.gif"/> TucQuaDi<br/>';
echo '<div class="menu"><img src="../tamtrang/VoToi.gif"/> VoToi<br/>';
echo '<div class="menu"><img src="../tamtrang/XinLoiNha.gif"/> XinLoiNha<br/>';
echo '<div class="menu"><img src="../tamtrang/ZuiQuaXa.gif"/> ZuiQuaXa<br/>';
echo '<div class="menu"><img src="../tamtrang/none.gif"/> none<br/>';
}else{
echo '<div class="menu">Bạn không đủ tiền, bạn có '.$user['balans'].'VND, Bạn cần 300DDV. Vui lòng nạp thêm!</div>';
}
break;
case 'statusbuy' :
if($user['balans']>=300){
$status = ($_POST['status']);
mysql_query("UPDATE `users` SET `status` = '$status' ,`balans`=`balans`-300  WHERE `id` = '$user_id' LIMIT 1");
echo '<div class="menu">Mua Tâm trạng thành công, Tâm trạng hiện tại cụa bạn là: '.$user['status'].' .Bạn bị trừ 300 VND!</div>';
echo '<div class="menu"><a href="../str/shop.php">Quay lại cửa hàng</a></div>';
header('Location:../shop/tamtrang.php?act=tamtrangbuyo');
exit();
}else{
echo '<div class="menu">Xin lổi, bạn không đủ tiền, bạn có '.$user['balans'].'VND, Cần 300 VND. Vui lòng nạp thêm!</div>';
}
case 'statusbuyo' :
echo '<div class="menu">Giao dịch thành công, Tâm trạng của bạn là: '.$user['status'].' .Bạn bị trừ 300 VND!</div>';
echo '<div class="menu"><a href="../str/shop.php">Quay lại cửa hàng</a></div>';
break;
///////////////////////////////////////////
case 'immun' :
if($user['balans']>=50000){
echo '<div class="menu"><img src="../theme/default/images/label.png"/>Bạn sẽ có các quyền đặc biệt như chống bắn, chống xóa bài viết của mình...ngẩu nhiên 1 tuần, 1 ngày, 1 tháng tại diển đàn nếu mua hệ thống Miển Dịch!<br/>';
echo '<div class="menu"><img src="../theme/default/images/label.png"/>Chú ý các quyền đặc biệt củng như hạn sử dụng của bạn sẽ không được thông báo, đó là bí mật của  TaMk!<br/>';
echo '<form action="shop.php?act=immunbuy" name="status" method="post">
<input type="submit" name="submit" value="Mua chức năng này"/></form></div>';
}else{
echo '<div class="menu">Bạn không đủ tiền, bạn có '.$user['balans'].'VND, cần 50000 VND để mua, vui lòng nạp thêm!</div>';
}
break;
case 'immunbuy' :
if($user['balans']>=50000){
mysql_query("UPDATE `users` SET `immunity` = '1' ,`balans`=`balans`-50000  WHERE `id` = '$user_id' LIMIT 1");
echo '<div class="menu">Giao dịch thành công, bạn đả loại bỏ được 1 số chức năng không cho phép thành viên! Bạn bị trừ 50000DDV</div>';
echo '<div class="menu"><a href="../str/shop.php">Quay lại cửa hàng</a></div>';
header('Location:..');
exit();
}else{
echo '<div class="menu">Xin lổi, bạn có '.$user['balans'].'VND, cần 50000DDV, vui lòng nạp thêm</div>';
}
case 'immunbuyo' :
echo '<div class="menu">Giao dịch thành công, bạn đả loại bỏ được 1 số chức năng không cho phép thành viên! Bạn bị trừ 50000DDV</div>';
echo '<div class="menu"><a href="../str/shop.php">Quay lại cửa hàng</a></div>';
break;
/////////////////////////////////////////////////////////////
case 'name' :
if($user['balans']>=10000){
echo '<div class="menu"><img src="../theme/default/images/label.png"/>Đổi tên Thành Viên<br/>';
echo '<form action="shop.php?act=name" name="status" method="post">
<input type="submit" name="submit" value="Mua chức năng này"/></form></div>';
}else{
echo '<div class="menu">Bạn không đủ tiền, bạn có '.$user['balans'].'VND, cần 50000 VND để mua, vui lòng nạp thêm!</div>';
}
break;
case 'immunbuy' :
if($user['balans']>=50000){
mysql_query("UPDATE `users` SET `immunity` = '1' ,`balans`=`balans`-50000  WHERE `id` = '$user_id' LIMIT 1");
echo '<div class="menu">Giao dịch thành công, bạn đả loại bỏ được 1 số chức năng không cho phép thành viên! Bạn bị trừ 50000 VND</div>';
echo '<div class="menu"><a href="../str/shop.php">Quay lại cửa hàng</a></div>';
header('Location:..');
exit();
}else{
echo '<div class="menu">Xin lổi, bạn có '.$user['balans'].'VND, cần 50000VND, vui lòng nạp thêm</div>';
}
case 'immunbuyo' :
echo '<div class="menu">Giao dịch thành công, bạn đả loại bỏ được 1 số chức năng không cho phép thành viên! Bạn bị trừ 50000VND</div>';
echo '<div class="menu"><a href="../str/shop.php">Quay lại cửa hàng</a></div>';
break;
default :
echo '<li><span class="gray"><b>Bạn đang có:</b></li>';
if (!empty($user['vgold']))
echo '<li><span class="gray" style="color:violet">VGold: </span>' . $user['vgold'] . '</li>';
if (!empty($user['balans']))
echo '<li><span class="gray" style="color:violet">VND: </span>' . $user['balans'] . '</li>';
echo '<li><b><a href="../shop/bank.php">-:-Ngân hàng-:-</a></b></li>';
echo '<div class="menu" style="color:MediumSpringGreen"><p><b>Shop</b> ';
echo '<li><b><a href="../shop/index.php">Quần áo™</a></b></li>';
echo '<li><b><a href="../shop/card.php">Thẻ VIP™</a></b></li>';
echo '<li><b><a href="../shop/pet.php?act=pet">Thú cưng™</a></b></li>';
echo '<li><b><a href="../shop/phukien.php?act=phukien">Phụ kiện™</a></b></li>';
echo '<li><b><a href="../shop/icon.php?act=icon">Icons™</a></b></li></div>';
echo '<div class="menu" style="color:red"><p><b>Bản cập nhật 3.2</b> ';
echo '<li><span class="gray">Item mới cực kool!</li>';
echo '<li><span class="gray">Thú cưng cực ngầu</li>';
echo '<li><span class="gray">Icon mới thật thích</li>';
echo '<li><span class="gray">Cập nhật liên tục!</li></div>';
echo '<br><b><a href="../users/tudo.php?id=' .$user['id'] . '" style="color:lime">+Tủ đồ của  ' . $user['name'] . ' </a></b>';
}
require_once ("../incfiles/end.php");
?>
