<?php
error_reporting(0);
if(isset($_GET['xem']))
{ $noidung = file_get_contents('http://t9x.vn/'.$_GET['xem']);
preg_match("/<\/script><div class=\"block\">(.*?)Tags/is",$noidung,$arr);
$buidoi = str_replace('<a href="http://t9x.vn/','<a href="',$arr[1]);
$buidoi = str_replace('<a href="','<a href="?xem=',$buidoi);
echo $buidoi; }
else
{ $noidung = file_get_contents('http://t9x.vn/'.(!$_GET['page']?NULL:'?page='.$_GET['page']));
preg_match("/Bài viết mới<\/div>(.*?)Menu<\/div>/is",$noidung,$arr);
$buidoi = str_replace('<a href="http://t9x.vn/','<a href="',$arr[1]);
$buidoi = str_replace('<a href="','<a href="?xem=',$buidoi);
$buidoi = str_replace('?xem=?page=','?page=',$buidoi);
echo $buidoi; }
?>
