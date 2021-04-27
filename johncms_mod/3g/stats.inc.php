<?php
/*
* stats.inc.php
* (C) 2012 anhphu.tk
* http://vn.wen9.com
*/
// --[Config]--------------
$file = 'stats.dat';
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
?>
