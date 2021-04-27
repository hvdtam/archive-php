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

$iplogdir = "iplog";
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
<?php
echo '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="trang wap upload tep tin danh cho mobile">
<meta name="keywords" content="Wap teen, wap upload, wap up so 1 vn, Wap ViP, wap viet nam, wap chat free, tai xuong, tamk.tk, tai game, wap hot cho DT, tamk.tk, Wap Of Teen, Ck S2 Zk, Ck S2 Vk, Wap hot, wap pro, wap tong hop, wap tai nhac" />
<link rel="stylesheet"
type="text/css" href="http://3g.wapdep.tk/style.css"/><link
rel="icon" href="http://tamk.wen.ru/favicon.ico"/>
<title>Wap 3G VN</title><a name="bottom"></a>
<style>
.forum #menu, .forum #search .text  {border-color:#FFB600;}
.forum #header {height:37px;background repeat-x;padding:3px 0 0 10px}
.forum #menu .active, .forum #search .button, .forum h1.title {background:#FFB600;}
.forum #footer {text-align:center;padding:5px 0;background:#e28b08;color:#fff}
.forum .list li {list-style:square;margin:3px 0 3px 13px;color:#e28b08}
.forum .tab .active {color:#b01e1e}
.forum .guide li {color:#000}
.forum .msg {border-bottom: 1px solid #E7E7E7; padding: 5px;background:#FAFAFA}
.forum .error {color:#b0397c}
.forum .info {color:#494949}
.forum p,td {line-height:10px}
#menu {padding-left:5px;border-bottom:5px solid #FFB600;font-size:12px}
#menu a {color:#494949;font-weight:bold}
#menu tr, #menu td{height:25px;padding-top:4px}
#menu td {padding-left:5px;padding-right:5px;text-align:center}
#menu .active {background:#FFB600;}
#menu .active a {color:#fff}
.sitemap {
font-size: xx-small;
position: relative;
width: 100%;
height: 38px;
z-index: 1;
overflow: auto;
}</style></head><body>
<div class="main index">
<div id="menu">
<table cellpadding="0" cellspacing="0">
<tbody><tr>
<td class="active"><a href="http://3g.wapdep.tk/">Home</a></td>
<td  width="10" ><a href="http://up.wapdep.tk/">Up</a></td>
<td  width="10"><a href="http://wapdep.tk/mp3.php">Mp3</a></td>
<td  width="10"><a href="http://wapdep.tk/chat">Chat</a></td>
</tr>
</tbody></table>
</div></div>
<script type="text/javascript">var timing = new Date (); _startTime = timing.getTime ();</script>';

$a = array();
$a[] = '<a href="http://tamk.mbox.sh">Game hot trên dế</a>';
$a[] = '<a href="http://vda.vn/java/139556.jar">Video HOT</a>';
$a[] = '<a href="http://vietbank.mobi/java/tamk_portal.jar">Ứng dụng tổng hợp</a>';
$a[] = '<a href="http://vietbank.mobi/java/tamk_mp3.jar">Nhạc siêu HOT</a>';
$a[] = '<a href="http://service.xtgem.me/mcd-download/get?partner=tamk&key=d37676c649cf3b288220236145acbecd&cid=500130a90cf28d2aa175c7ba"><b>Tải game Avatar 193</b></a></div>';
$a[] = '<a href="http://service.xtgem.me/mcd-download/get?partner=tamk&key=d37676c649cf3b288220236145acbecd&cid=4ff4f0830cf2434d8f4732e1">Game Thiên Đường Giải Trí</a>';
$a[] = '<div><a  href="http://1st.xtgem.me/tamk"><font color="red"><b>Kho game HOT</b></font></a></div>';
$a[] = '<a href="http://service.xtgem.me/mcd-download/get?partner=tamk&key=d37676c649cf3b288220236145acbecd&cid=4ffb9b3f80ab88961d000005">Cùng chơi game, trồng cây, kết bạn, tán gái</a>';
$a[] = '<a href="http://service.topjar.mobi/mcd-download/get?cid=4fe047c10cf2044208fb41f2&partner=tamk&key=d37676c649cf3b288220236145acbecd"/><img src="http://static.topjar.mobi/images/socbay/icon.png">Tải Socbay iMedia</a><br/>';
$a[] = '<a  href="http//d1.hotclip.mobi/tamk/HotClip.jar">Video Clip HOT</a><br/>';
$a[] = '<a href="http://partner.xtgem.me/package/download.php?app=DiemThi.jar&u=tamk&a=0cd0a6288230ce75fc3fca9d4fe565ea">Phần mềm tra cứu điểm thi tốt nghiệp, đại học 2012</a><br/>';

echo'<div class="menu" align="center">';
echo $a[rand(0, count($a)-1)];
echo'</div>';

?>
