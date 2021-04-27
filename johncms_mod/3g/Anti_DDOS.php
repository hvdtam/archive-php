<?php
$cookie = $_COOKIE['yourcookie'];
$othercookie = $_COOKIE['yourothercookie'];
$othercookie = $_COOKIE['1211598493'];
$othercookie = $_COOKIE['2c07863737b385b4c3567f0ecfa6d480'];
$othercookie = $_COOKIE['3bc52aba5f6ed8a19cfafdc777ad1b1f'];
if($cookie && $othercookie > 0) $iptime = 20; //so giay toi thieu giua cac lan truy cap.
else $iptime = 10; // so giay toi thieu cho moi lan truy cap cho tat ca moi nguoi

$ippenalty = 60; // So giay truoc khi nguoi truy cap dc phep truy cap lai

if($cookie && $othercookie > 0)$ipmaxvisit = 30; //toi da truy cap tho $iptime
else $ipmaxvisit = 20; // toi da cho moi lan truy cap $iptime

$iplogdir = "./iplog/";
$iplogfile = "iplog.dat";
$oldtime = 0;
if (file_exists($iplogdir.$ipfile)) $oldtime = filemtime($iplogdir.$ipfile);
$time = time();
if ($oldtime < $time) $oldtime = $time;
$newtime = $oldtime + $iptime;
if ($newtime >= $time + $iptime*$ipmaxvisit)
{
touch($iplogdir.$ipfile, $time + $iptime*($ipmaxvisit-1) + $ippenalty);
$oldref = $_SERVER['HTTP_REFERER'];
header("HTTP/1.0 503 Service Temporarily Unavailable");
header("Content-Type: text/html");
echo "<html><body bgcolor=#999999 text=#ffffff link=#ffff00>
<font face='Verdana, Arial'>

[b]
<h1>Temporary  Access Denial</h1>Too many quick page views by your IP address  (more than ".$ipmaxvisit." visits within ".$iptime." seconds).[/b]
";
echo  "
Please wait ".$ippenalty." seconds and reload. Warning by  KentMaster</p></font></body></html>";
touch($iplogdir.$iplogfile); //create if not existing
$fp = fopen($iplogdir.$iplogfile, "a");
$yourdomain = $_SERVER['HTTP_HOST'];
if ($fp)
{
$useragent = "<unknown user agent>";
if (isset($_SERVER["HTTP_USER_AGENT"])) $useragent = $_SERVER["HTTP_USER_AGENT"];
fputs($fp, $_SERVER["REMOTE_ADDR"]." ".date("d/m/Y H:i:s")." ".$useragent."\n");
fclose($fp);
$yourdomain = $_SERVER['HTTP_HOST'];

if($_SESSION['reportedflood'] < 1 && ($newtime < $time + $iptime + $iptime*$ipmaxvisit))
@mail('hvdtam@gmail.com', 'Website is being flooded-DDOS from address '.$cookie.' '
.$_SERVER['REMOTE_ADDR'],''.$yourdomain.'  are attacked refuse services from IP addresses  '.$_SERVER['REMOTE_ADDR'].' attack to  '.$yourdomain.$_SERVER['REQUEST_URI'].' Attaker is '.$oldref.' agent  '.$_SERVER['HTTP_USER_AGENT'].' '
.$cookie.' '.$othercookie, "From: ".$yourdomain."\n");
$_SESSION['reportedflood'] = 1;
}
exit();
}
else $_SESSION['reportedflood'] = 0;
//echo("loaded ".$cookie.$iplogdir.$iplogfile.$ipfile.$newtim e);
touch($iplogdir.$ipfile, $newtime);
?>
