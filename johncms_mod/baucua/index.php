<?php
define('_IN_JOHNCMS', 1);

session_name("SESID");
session_start();
$headmod = 'Casino';
$textl = 'Casino';
$rootpath = '../';
require_once ("../incfiles/core.php");
require_once ("../incfiles/head.php");

echo'<div class="rmenu"><b>Tôm Cua 3 con</b></div>

<div class="menu"><a href="3socap.php">+ Phòng sơ cấp (Cược 100 ăn 300)</a><br/></div>

<div class="menu"><a href="3trungcap.php">+ Phòng trung cấp (Cược 500 ăn 1500)</a><br/></div>

<div class="menu"><a href="3vip.php">+ Phòng vip (Cược 5000 ăn 15000)</a><br/></div>

<div class="bmenu"  style="color:Green"><b>Tôm cua 6 con</b><br/></div>


<div class="menu"><a href="6socap.php">+ Phòng sơ cấp (Cược 100 ăn 600)</a><br/></div>

<div class="menu"><a href="6trungcap.php">+ Phòng trung cấp (Cược 500 ăn 3000)</a><br/></div>
<div class="menu"><a href="6vip.php">+ Phòng vip (Cược 5000 ăn 30000)</a><br/></div>';

require_once ("../incfiles/end.php");
?>

