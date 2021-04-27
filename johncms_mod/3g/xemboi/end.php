<?php
// --[Config]--------------
date_default_timezone_set ("Asia/Jakarta");
$jam=date("H:i:s",time());
echo'
<div class="menu"><script type="text/javascript" src="http://mvn3g.wen9.com/js/az.js"></script>
</div>
<div class="menu"><a href="/index.php" >Xem bói</a> | <a href="javascript:history.back(1)" >Quay Lại</a> | <a id="down" href="#up">Lên trên</a> </div>';
$file = './stats.dat';
// File to store all data.
$onlineTime = 360;
// Max user online time (in seconds)
$perPage = 10;
// Entry per page
// --[End Config]------
if(!file_exists($file)) {
$fs = fopen($file, 'w') or die('<b>Error:</b> Unable to create stats file.<br/>');
fclose($fs);
}
$ip = (getenv('HTTP_X_FORWARDED_FOR') != '') ? getenv('HTTP_X_FORWARDED_FOR') : $_SERVER['REMOTE_ADDR'];
$ua = $_SERVER['HTTP_USER_AGENT'];
$user = $_SERVER['REMOTE_ADDR'];
$hp = $_SERVER['HTTP_X_OPERAMINI_PHONE_UA'];
$ua = str_replace('|~~|', '', htmlspecialchars($ua));
$hp = str_replace('|~~|', '', htmlspecialchars($hp));
$hp = explode(' ', $hp);
$hp = $hp[0];
$ua = explode(' ', $ua);
$ua = $ua[0];

$ip = str_replace('|~~|', '', htmlspecialchars($ip));
$waktu=7*3600+time();
$data = file($file);
foreach($data as $i => $line) {
$line = explode('|~~|', $line);
if(($line[1] == $ip && $line[2] == $hp && $line[3] == $ua && $line[4] == $user) || $line[0] < ($waktu - $onlineTime)) unset($data[$i]);
}
$data[] = implode('|~~|', array_pad(array($waktu, $ip, $hp, $ua, $user, $pageName), 5, ''));
$online = count($data);
$fs = fopen($file, 'w');
foreach($data as $line) fputs($fs, rtrim($line) . "\n");
fclose($fs);
unset($data, $line, $ip, $hp, $ua, $user, $fs);

$counter = "counter.txt";
$today = getdate();
$month = $today[month];
$mday = $today[mday];
$year = $today[year];
$current_date = $mday . $month . $year;
// Log visit;
$fp = fopen($counter, "a");
$line = $REMOTE_ADDR . "|" . $mday . $month . $year . "\n";
$size = strlen($line);
fputs($fp, $line, $size);
fclose($fp);
$contents = file($counter);
$total_hits = sizeof($contents);
$total_hosts = array();
for ($i=0;$i<sizeof($contents);$i++) {
$entry = explode("|", $contents[$i]);
array_push($total_hosts, $entry[0]);
}
$total_hosts_size = sizeof(array_unique($total_hosts));
$daily_hits = array();
for ($i=0;$i<sizeof($contents);$i++) {
$entry = explode("|", $contents[$i]);
if ($current_date == chop($entry[1])) {
array_push($daily_hits, $entry[0]);
}
}
$daily_hits_size = sizeof($daily_hits);
$daily_hosts = array();
for ($i=0;$i<sizeof($contents);$i++) {
$entry = explode("|", $contents[$i]);
if ($current_date == chop($entry[1])) {
array_push($daily_hosts, $entry[0]);
}
}
$daily_hosts_size = sizeof(array_unique($daily_hosts));
echo("<div class=\"gmenu\" align=\"center\"><small>Online: ".$online." | Today: ".$daily_hits_size." | Total: ".$total_hits."</small></div>");
echo "</div>


<div class=\"footer\"><center>";
echo "<a class=\"ads\" align=\"center\" style=\"color:orange\" href=\"http://quocphu.tk\">&#169;".date("Y")." QUOCPHU.TK&trade;</a>";
echo '</body></html>';
?>
