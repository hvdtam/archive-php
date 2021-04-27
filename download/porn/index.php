<?php
include '../head.php';

echo"<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
echo"<html xmlns=\"http://www.w3.org/1999/xhtml\" dir=\"ltr\">";
echo"<head>";
echo"<meta http-equiv=\"Content-Type\" content=\"application/xhtml+xml; charset=UTF-8\" />";
echo"<meta name=\"keywords\" content=\"Free mobile porn clips, mp4 porn videos, porn, porn animations, porn images\"/>";
echo"<meta name=\"description\" content=\"Free mobile porn clips, mp4 porn videos, porn, porn animations, porn images, andrew, wap-forum.info\"/>";
echo"<title>Free mp4 porn clips</title>";
echo"<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\"/>";
echo"</head><body>";
//         */
if(isset($_GET['page'])){ $page=$_GET['page']; }else{ $page=1; }
if(!empty($page) && $page!=1){ $pp=$page-1; }
if(empty($page)){ $page="1"; }
if(isset($_GET['cat'])){ $cat=$_GET['cat']; }else{ $cat=""; }
$pageplus1=$page+1;
$pageminus1=$page-1;
$useragent="NokiaN72/5.0706.4.0.1 Series60/2.8 Profile/MIDP-2.0 Configuration/CLDC-1.1";
if(!empty($cat) && $cat!="none"){ $url="http://mobile.xshare.com/mr/cat/$cat/page=".$page; }else{
$url="http://mobile.xshare.com/?page=".$page;
}
$serverip=$_SERVER['SERVER_ADDR'];
$ch=curl_init(); 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_USERAGENT, $useragent); 
curl_setopt($ch, CURLOPT_INTERFACE, $serverip);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_REFERER, $url);  
$xx=curl_exec($ch); 
curl_close($ch); 
$downloadlink[]="http://wapbux.com/go/5130503062"; //fake ones, obviusly ^^
$downloadlink[]="http://www.wapbux.com/go/5130503062";
$downloadlink[]="http://wapbux.com/go/5130503062";
$texts[]="Free porn clips, +18!";
$texts[]="Real rape video!!!";
$texts[]="Porn Pictures, Animations, and Videos";
$texts[]="Mobile porn games! +18 Erotic";
$xx=preg_replace('|<!DOCTYPE html(.*?)<h3 class="blackhdr">|is','<div class="titl"><h3 align="center">Mp4 ',$xx);
$xx=str_replace('</h3>','</h3></div>',$xx);
$xx=preg_replace('|<iframe(.*?)</html>|is','',$xx);
$xx=preg_replace('|<div class="(.*?)>|is','',$xx);
$xx=preg_replace('|<span class="rating">(.*?)</span>|is','',$xx);
$xx=preg_replace('|<span class="sep">(.*?)</span>|is','',$xx);
$xx=preg_replace('|<span class="numPhotos">(.*?)</span>|is','',$xx);
$xx=preg_replace('|<span class="views">(.*?)</span>|is','',$xx);
$xx=str_replace('</div>','',$xx);
$xx=preg_replace('|<li>(.*?)</a>|is','<div class="cont"><div class="titl"><img alt="" src="images/rd.png"/><b>\1</a></b> </div>',$xx);
$xx=str_replace('<a href="http://mobile','<br/><a href="http://mobile',$xx);
$xx=str_replace('height="83" width="125"','width="80"',$xx);
$xx=preg_replace('|<a href="http://mobile.xshare.com/vid/(.*?)"><img src="(.*?)"(.*?)</a>|is','<table><tbody><tr><td><img src="\2"\3</td><td><a href="'.$downloadlink[0].'">Full, High Quality</a><br /><a href="http://mobile.xshare.com/vid/\1"> Full, Medium Quality</a><br /><a href="\2">Download image (#1)</a><br /><a href="'.$downloadlink[1].'">Download image (#2)</a></td></tr></tbody></table>',$xx);
$xx=str_replace('<br/>','',$xx);
$xx=str_replace('</a> </div>','</a> </div><div class="cont">',$xx);
$xx=str_replace('</li>','</div>',$xx);
$xx=preg_replace('|<span class="heading">(.*?)</div>|is','</div></div>',$xx);
$xx=str_replace('<ul class="listView">','',$xx);
$xx=str_replace('</div></div>','</div></div>&nbsp;&nbsp;Click: <a href="'.$downloadlink[rand(1,count($downloadlink)-1)].'">'.$texts[rand(1,count($texts)-1)].'</a>',$xx);
$xx=preg_replace('|<a class="favAddButton" href="http://mobile.xshare.com/vid/(.*?)">(.*?)</a>|is','<big>\2</big>',$xx);
echo $xx;
$lastpage=262;
echo"<div align=\"center\">";
if($page!=1){
$previous=$page-1;
if($page!=2){
echo"<a href=\"".$_SERVER['PHP_SELF']."?page=1&amp;cat=".$cat."\">1</a> ";
}
if($page!=3 && $page!=2){ echo".. "; }
echo"<a href=\"".$_SERVER['PHP_SELF']."?page=".$previous."&amp;cat=".$cat."\">".$previous."</a> ";
}
echo "<b>".$page."</b> ";
if($page!=$lastpage){
$next=$page+1;
echo"<a href=\"".$_SERVER['PHP_SELF']."?page=".$next."&amp;cat=".$cat."\">".$next."</a> ";
if($page!=($lastpage-1)){
if($page!=($lastpage-2)){ echo".. "; }
echo"<a href=\"".$_SERVER['PHP_SELF']."?page=".$lastpage."&amp;cat=".$cat."\">".$lastpage."</a> ";
}
}
echo"<br/><b>Change category:</b><br/><form action='' method='get'>";
echo'<select name="cat">
<option value="none">Categories</option>
<option value="mr">Most Recent</option>
<option value="mv">Most Viewed</option>
<option value="tr">Top Rated</option>
<option value="amateur" selected>Amateur</option>
<option value="anal">Anal</option>
<option value="anime">Anime</option>
<option value="asian">Asian</option>
<option value="bbw">BBW</option>
<option value="bigbutt">Big Butt</option>
<option value="bigcock">Big Cock</option>
<option value="bigtits">Big Tits</option>
<option value="blowjob">Blowjob</option>
<option value="bondage">Bondage</option>
<option value="bukkake">Bukkake</option>
<option value="creampie">Creampie</option>
<option value="facial">Cumshot - Facial</option>
<option value="cumswapping">Cum Swapping</option>
<option value="doublepenetration">Double Penetration</option>
<option value="ebony">Ebony</option>
<option value="fetish">Fetish</option>
<option value="fingering">Fingering</option>
<option value="fisting">Fisting</option>
<option value="footfetish">Foot Fetish</option>
<option value="fuckingmachine">Fucking Machine</option>
<option value="gagging">Gagging</option>
<option value="gangbang">Gangbang</option>
<option value="groupsex">Group Sex</option>
<option value="handjob">Handjob</option>
<option value="hardcore">Hardcore</option>
<option value="hentai">Hentai</option>
<option value="indian">Indian</option>
<option value="insertion">Insertion</option>
<option value="interracial">Interracial</option>
<option value="latex">Latex</option>
<option value="latina">Latina</option>
<option value="lesbian">Lesbian</option>
<option value="masturbation">Masturbation</option>
<option value="milf">MILF</option>
<option value="party">Party</option>
<option value="pornstar">Pornstar</option>
<option value="pov">POV</option>
<option value="public">Public</option>
<option value="reality">Reality</option>
<option value="smoking">Smoking</option>
<option value="solo">Solo</option>
<option value="squirting">Squirting</option>
<option value="striptease">Striptease</option>
<option value="swallowing">Swallowing</option>
<option value="teen">Teen</option>
<option value="threesome">Threesome</option>
<option value="toys">Toys</option>
<option value="voyeur">Voyeur</option>
</select>';
echo"<input type='submit' value='Change Category'></form>\n\n";
echo"</body></html>";
include '../foot.php';
?>