<?
define('_IN_JOHNCMS',1);
$rootpath='../';
require('../incfiles/core.php');
require('../incfiles/head.php');
/////////////
if($user_id && $datauser[balans] >= 1500)
{
if(isset($_POST[xacnhan]))
{
if(isset($_POST[colornick]))
{
$true=mysql_query("update `users` set `colornick` = '" . $_POST[colornick] . "' where id = '" . $user_id . "';");
if($true==TRUE)
{
mysql_query("update `users` set `balans` = '" . ($datauser[balans]-1500) . "' where id = '" . $user_id . "';");
echo "<div class='list1' style='padding: 10px'>Đổi màu nick thành công!<br/>Bạn bị trừ 1500 VNĐ!<br/><a href='../users/profile.php?act=edit'>Tiếp tục</a></div>";
}
else
{
echo "<div>Chọn màu nick thất bại<br/><a href='/mod/colornick.php'>Quay lại</a></div>";
}
}
else
{
echo "<div>Bạn chưa chọn một màu nick!<br/><a href='/mod/colornick.php'>Quay lại</a></div>";
}
}
else
{
$mau=array('red','blue','green','orange','black','tomato','violet','blueviolet','coral','cyan','darkkhaki','darkgreen','darkmagenta','gold','lightgreen','lightgrey','magenta','olive');
$i=0;
echo "<form action='/mod/colornick.php' method='post'>";
foreach($mau as $value)
{
echo $i % 2 ? '<div class="list1">' : '<div class="list2">';
if($datauser[colornick]== $value) echo "<input type='radio' value='$value' name='colornick' checked='checked'/><font color='$value'>$value</font>"; else echo "<input type='radio' value='$value' name='colornick'/><font color='$value'>$value</font>";
echo '</div>';
$i++;
}
echo '<input type="submit" value="Xác nhận" name="xacnhan"/></form>';
}
}
else
{
echo "<div style='padding:10px' class='list1'>Truy cập thất bại!<br/> Bạn không đủ 1500 VNĐ!</div>";
}
require('../incfiles/end.php');
?>
