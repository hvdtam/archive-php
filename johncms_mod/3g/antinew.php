<?php
function server_busy($numer) {
if (THIS_IS == 'WEBSITE' && PHP_OS == 'Linux' and @file_exists ( '/proc/loadavg' ) and $filestuff = @file_get_contents ( '/proc/loadavg' )) {
$loadavg = explode ( ' ', $filestuff );
if (trim ( $loadavg [0] ) > $numer) {
print '<meta http-equiv="content-type" content="text/html; charset=UTF-8" />';
print '<center>He thong chong DDOS<br/>Luong truy cap dang qua tai. Moi ban quay lai sau vai phut.</center>';
exit ( 0 );
}
}
}
$srv = server_busy ( 2 ); // 1000 la so nguoi truy cap tai mot thoi diem
?>
