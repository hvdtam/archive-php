<?php
include 'config.php';
$name= $_POST['name'];
$partner= $_POST['partner'];

if($name=="")
{
include '../head.php';
echo "<center><br/><b>Lỗi Plz Kiểm tra Thông tin chi tiết cung cấp</b><br/></center>";
}
elseif($partner=="")
{
include '../head.php';
echo "<center><br/><b>Lỗi Plz Kiểm tra Thông tin chi tiết cung cấp</b><br/></center>";
}
elseif($name==$partner)
{
include '../head.php';
echo "<center><br/><b>Bạn không thể yêu chính mình</b><br/></center>";
}
else
{
list($msec,$sec)=explode(chr(32),microtime());
$HeadTime=$sec+$msec;

$love=rand (53,100);

print "<html><head><title>";
echo $title;
echo '</title>';
include '../head.php';
echo '<div class="bmenu">Kết quả của bạn</div><div class="menu">';

echo "<div class='menu'></div>\n";

print $name." và ".$partner." yêu nhau <br/> những <b>$love % </b>cơ đấy.!!!<br/>";

echo "<div class='menu'></div>\n";


print '</div><div class="menu">';
list($msec,$sec)=explode(chr(32),microtime());
echo "[".round(($sec+$msec)-$HeadTime,4)."]";

print '</div><div class="menu"><a href="'.$url.'">Love</a>';
print '
</small></center></div>';
include '../end.php';
}
?>
