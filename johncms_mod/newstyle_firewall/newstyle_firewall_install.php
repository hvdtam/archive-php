<?
$time=time()+100;
require_once("global.php");
$sql2="DELETE FROM `". TABLE_PREFIX ."cron` WHERE `filename`='./newstyle_firewall_unlock.php';";
$sql3="INSERT INTO `". TABLE_PREFIX ."cron` (`nextrun`, `weekday`, `day`, `hour`, `minute`, `filename`, `loglevel`, `active`, `varname`, `volatile`, `product`) VALUES
('$time', '-1', '-1', '0', 'a:1:{i:0;i:1;}', './newstyle_firewall_unlock.php', '1', '1', 'newstyle_firewall', '1', 'vbulletin');";
$r2 = $db->query_write($sql2);
$r3 = $db->query_write($sql3);
if ($r3)
	echo "OK";
else
	echo "That bai";
?>
<hr>
<center>&copy; NewStyleClan.Com 2011</center>