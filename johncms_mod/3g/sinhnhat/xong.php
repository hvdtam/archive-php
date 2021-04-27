<?php
header ("content-type:text/html; charset=UTF-8");
?><?php
include '../head.php';
$id = count(file("dat.dat"));
$ngay = $_POST['ngay'];
$thang = $_POST['thang'];
$nam = $_POST['nam'];
$ten = $_POST['name'];
$ten1 = $_POST['name1'];
$name = $_POST['ten'];
$name1 = $_POST['ten1'];
$mo = fopen("dat.dat",'a');
$viet = $ngay.'|'.$thang.'|'.$nam.'|'.$name.'|'.$ten.'|'.$name1.'|'.$ten1;
fwrite($mo, $viet."\r\n");
fclose($mo);
echo 'Trang WAP của bạn đã được khởi tạo thành công.<br>
Đường dẫn của bạn là <input value="http://TaMk.tK/sinhnhat/sinhnhat.php?id='.$id.'"><br>Bạn hãy copy đường dẫn này, và gửi nó đến người bạn của bạn.<br>
<a href="http://TaMk.tK/sinhnhat/sinhnhat.php?id='.$id.'"><div class="menu">XEM Kết quả ^^! </a></div>';
include '../foot.php';
?>
