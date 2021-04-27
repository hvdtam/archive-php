<?php

session_start();

$limit = 1; // thoi gian (s) han che giua hai lan truy cap
$delay = 2; // thoi gian (s) phai cho de load trang

$last = ($_SESSION['time'] == NULL) ? 0 : $_SESSION['time'];
$_SESSION['time'] = time();

if ( $limit >= (time() - $last) ) {
echo '   <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Refresh" Content="'.$delay.'; url='.$_SERVER["REQUEST_URI"].'">
</head>
<title>TaMk.tK - Anti DDoS</title><center><h3>Tường lửa nhưng không có lửa :D</h3><h1><a href="'.$_SERVER["REQUEST_URI"].'">Click vào đây</a></h1></center></html>';
exit(0);
}
?>
