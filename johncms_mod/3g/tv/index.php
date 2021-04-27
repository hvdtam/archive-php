<?php
header ("content-type:text/html; charset=UTF-8");
$title = 'Bỏ Dấu Văn Bản';
?>
<?php
include 'head.php';
include 'telex.php';
include 'vni.php';
echo ''.$tren.'';
echo '<div class="phdr"><b style="color:red">Bỏ Dấu Văn Bản</b></div>
<div class="gmenu"><font color="green">Nhập Nội Dung Cần Chuyển và Chọn Kiểu Gõ.</font><br>';
echo '<form action="index.php" method="post">
Nhập Nội Dung: <input type="text" name="noidung" size="20" ><br>
<input type="checkbox" name="tv">Kiểu Gõ Telex<br>
<input type="checkbox" name="vni">Kiểu Gõ VNI<br>
<br><input type="submit" value="Xong"></div>';
$noidung = $_POST['noidung'];
if ($_POST['tv']) $noidung = tiengviet($noidung);
if ($_POST['vni']) $noidung = kieu2($noidung);
echo '<div class="rmenu"><textarea cols="20" rows="5">'.$noidung.'</textarea></div>';
echo ''.$duoi.'';
include 'end.php';
?>
