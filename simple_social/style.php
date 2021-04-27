<?php
$mod = $_GET['mod'];
switch ($mod)
{
case "wap":
$the="wap";
setcookie("the", $the, time() + 3600 * 24 * 365);
header("location: index.php");
break;
case "web":
$the="web";
setcookie("the", $the, time() + 3600 * 24 * 365);
header("location: index.php");
break;
default:
header("location: index.php");
break;
}

?>
