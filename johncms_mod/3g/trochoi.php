<?
include'head.php';
echo'<div  class="t1"><div  class="t2"><div  class="t3"><div  class="note">';ini_set('user_agent','Opera/8.01 (J2ME/MIDP; Opera Mini/1.2.3214/1724; en; U; ssr)');
$reival = $_GET['reival']; 
$ur3l=$_SERVER['HTTP_HOST'];
if("$reival")
{
$f=file("http://nokia-games.com/$reival");
}else{
$f=file('http://nokia-games.com/');
}

$f = @implode("", $f);
$url = "$ur3l/f=";
$f=str_replace('/games/', '?reival=games/', $f);
$t1=explode('<body>',$f);
$t2=explode('</body',$t1[1]);
$t=$t2[0];
$t=str_replace('<img src="','<img src="http://nokia-games.com', $t);
$t=preg_replace('#<div id="footer">(.+?)<\/html>#siu','',$t);
$t=preg_replace('#<div class="head">(.+?)Cool Games<br/></div>(.+?)</a></div>#siu','',$t);
$t=preg_replace('#<p align="center"><a href="http://googleads(.+?)">(.+?)</p>#siu','',$t);
//$t=preg_replace('#<a href="http://besttop.mobi/(.+?)">(.+?)</a>(.+?)<div class="foot">#siu','',$t);
$t=preg_replace('#<a href="http://c.admob.com/(.+?)">(.+?)</a>#siu','',$t);
$t=preg_replace('#<div class="gamein"><a href="http://malluwap.com/(.+?)">(.+?)</div>#siu','',$t);
$t=preg_replace('#<a href="http://besttop.mobi/(.+?)">(.+?)</a>#siu','',$t);
$t=str_replace('Nokia-Games.Com 2010','',$t);
$t=str_replace('Nokia-Games 2010','',$t);
$t=str_replace('<img src="http://nokia-games.comhttp://besttop.mobi/s3.php?id=52765">','',$t);
$t=preg_replace('#<div class="head"><img src="(.+?)">(.+?)</div>#siu','',$t);
$t=preg_replace('#<a href="http://waptrack.net/(.+?)">(.+?)</a>#siu','',$t);
$t=preg_replace('#<div align="center">(.+?)</div>#siu','',$t);
$t=str_replace('<a href="?reival=games/get/','<a href="http://nokia-games.com/games/get/',$t);
echo $t;
echo'</div ></div ></div ></div ></div >';
include_once'foot.php';?>