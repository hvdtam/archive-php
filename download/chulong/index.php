<?php
include '../head.php';
switch($_GET['anh'])
{
default:
echo '<div class="bmenu">Tạo Chữ Lồng</div><div class="menu"><center><img src="../chulong/A_P.jpg" alt="logo" border="0" width="110"/>';
echo '<form action="?anh=phu" method="post">
<div class="bmenu">Chọn Chữ Cái Tên Bạn Và Tên Người Ấy:</div>
<div class="menu"><select name="A" style="font-size:x-small">
<option value="a">A</option>
<option value="b">B</option>
<option value="c">C</option>
<option value="d">D</option>
<option value="e">E</option>
<option value="g">G</option>
<option value="h">H</option>
<option value="i">I</option>
<option value="k">K</option>
<option value="l">L</option>
<option value="m">M</option>
<option value="n">N</option>
<option value="o">O</option>
<option value="p">P</option>
<option value="q">Q</option>
<option value="r">R</option>
<option value="s">S</option>
<option value="t">T</option>
<option value="u">U</option>
<option value="v">V</option>
<option value="x">X</option>
<option value="y">Y</option>
</select><b>&</b><select name="P" style="font-size:x-small">
<option value="p">P</option>
<option value="a">A</option>
<option value="b">B</option>
<option value="c">C</option>
<option value="d">D</option>
<option value="e">E</option>
<option value="g">G</option>
<option value="h">H</option>
<option value="k">K</option>
<option value="l">L</option>
<option value="m">M</option>
<option value="n">N</option>
<option value="o">O</option>
<option value="p">P</option>
<option value="q">Q</option>
<option value="r">R</option>
<option value="s">S</option>
<option value="t">T</option>
<option value="u">U</option>
<option value="v">V</option>
<option value="x">X</option>
<option value="y">Y</option>
</select>
</div>
<input class="input" type="submit" value="Xem trước" name="submit"></form></center>';
break;
case 'phu':
$title = 'Tạo Xong';
$A = $_POST['A'];
$P = $_POST['P'];
echo '<div class="bmenu">Hình Minh Hoạ:</div><div class="menu">
<center><img src="http://download.zat.su/hinh/'.$A.''.$P.'.jpg" width="160" height="200" alt="'.$A.'&'.$P.'"><br>
<a href="http://download.zat.su/hinh/'.$A.''.$P.'.jpg">[Tải Ảnh Về]</a></center></div><br><div class="menu"><a href="index.php">[Quay Lại]</a></div>';
break;
}
include '../end.php';
?>
