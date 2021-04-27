<?php
require_once ("head.php");
?>
<div class="bmenu">Bói Ngày Sinh</div>
<?php
$ngaysinh_id = file('./ngaysinh_id.php');
$ngaysinh_name = file('./ngaysinh_name.php');
foreach ($ngaysinh_id as $ngaysinh_num => $ngaysinh_ids) {
echo '<li><a href="boingaysinh.php?boi='.$ngaysinh_id[$ngaysinh_num].'" id="'.$ngaysinh_id[$ngaysinh_num].'" class="ItemNoselected" >'.$ngaysinh_name[$ngaysinh_num].'</a></li>';
if (end($ngaysinh_id)) {
}
}
?>
<?php
$hoten_id = file('./hoten_id.php');
$hoten_name = file('./hoten_name.php');
foreach ($hoten_id as $hoten_num => $hoten_ids) {
echo '<li><a href="boihoten.php?boi='.$hoten_id[$hoten_num].'" id="'.$hoten_id[$hoten_num].'" class="ItemNoselected" >'.$hoten_name[$hoten_num].'</a></li>';
if (end($hoten_id)) {
}
}
?>
<div class="bmenu">Bói Hình Dáng</div>
<?php
$hinhdang_id = file('./hinhdang_id.php');
$hinhdang_name = file('./hinhdang_name.php');
foreach ($hinhdang_id as $hinhdang_num => $hinhdang_ids) {
echo '<li><a href="boihinhdang.php?boi='.$hinhdang_id[$hinhdang_num].'" id="'.$hinhdang_id[$hinhdang_num].'" class="ItemNoselected" >'.$hinhdang_name[$hinhdang_num].'</a></li>';
if (end($hinhdang_id)) {
}
}
?>
<div class="bmenu">Bói Tình Yêu</div>
<?php
$tinhyeu_id = file('./tinhyeu_id.php');
$tinhyeu_name = file('./tinhyeu_name.php');
foreach ($tinhyeu_id as $tinhyeu_num => $tinhyeu_ids) {
echo '<li><a href="boitinhyeu.php?boi='.$tinhyeu_id[$tinhyeu_num].'" id="'.$tinhyeu_id[$tinhyeu_num].'" class="ItemNoselected" >'.$tinhyeu_name[$tinhyeu_num].'</a></li>';
if (end($tinhyeu_id)) {
}
}
?>
<div class="bmenu">Bói Linh Tinh</div>
<?php
$linhtinh_id = file('./linhtinh_id.php');
$linhtinh_name = file('./linhtinh_name.php');
foreach ($linhtinh_id as $linhtinh_num => $linhtinh_ids) {
echo '<li><a href="boilinhtinh.php?boi='.$linhtinh_id[$linhtinh_num].'" id="'.$linhtinh_id[$linhtinh_num].'" class="ItemNoselected" >'.$linhtinh_name[$linhtinh_num].'</a></li>';
if (end($linhtinh_id)) {
}
};
require_once ("end.php");
?>
