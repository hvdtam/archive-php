<?
require_once("global.php");
$sql2="DELETE FROM `". TABLE_PREFIX ."cron` WHERE `filename`='./newstyle_firewall_unlock.php';";
$r2 = $db->query_write($sql2);
if ($r2)
	echo "Uninstall thanh cong";
else
	echo "Uninstall That bai";
?>
<hr>
<center>&copy; NewStyleClan.Com 2011</center>