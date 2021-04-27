<?php
define('_IN_ANHPHU', 1);
require_once ("func.php");
require_once ("head.php");

echo '<div class="bmenu">Thời tiết</div><div class="menu">';
$source = grab_link("http://www.nchmf.gov.vn/web/vi-VN/43/Default.aspx");

$noidung = explode('<table id="_ctl1__ctl5__ctl0_dl_thoitiethieitai" cellspacing="0" cellpadding="0" border="0" width="100%">', $source);

$noidung = explode('<TD class="thoitiet_rightbox_ver"></TD>', $noidung[1]);

$noidung = $noidung[0];
$noidung = preg_replace('#<a href=(.+?)/>#is','',$noidung);
echo '<table>'.$noidung.'</tr></table>';

echo'<a href="/thoitiet.php">Nếu không xem được trang! Vui lòng làm mới trang hiện tại này, đến khi xem được...</a></div>';

require_once ("end.php");
?>
