<?php
require_once('inc/db.php');
require_once('inc/fun.php');
require_once('inc/tren.php');
echo "<div class='menu'>☆ Đang Online:</div>";
$data = file('online.dat');
foreach($data as $val)
{
$ex = explode('::', $val);
$ex2 = explode(' ', $ex[0]);
$i++;
echo "<div class='list'><b>$i. </b>$ex2[0]<br/><b>IP:</b> $ex[1]<br/></div></body>";
}

require_once('inc/duoi.php');
?>
