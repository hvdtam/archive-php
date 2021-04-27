<?php
include 'head.php';
echo '<div class="phdr">[<font color="blue"><b>TK</b></font>] Sức khỏe</div>';
function get_url_contents($url){$crl = curl_init();$timeout = 5;curl_setopt ($crl, CURLOPT_COOKIESESSION, true);curl_setopt ($crl, CURLOPT_URL,$url);curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);		curl_setopt($crl, CURLOPT_USERAGENT, "User-Agent:Profile/MIDP-1.0 Configuration/CLDC-1.0"); $ret = curl_exec($crl);curl_close($crl);return $ret;}function sstring($source,$a,$b){list($junk, $dest) = split($a, $source);list($dest, $junk) = split($b, $dest);return $dest;}function cutstring($source,$a,$b){$ret = substr($source, $a, $b);$pos1 = stripos($source, $a);$ret = substr($source, 0, $pos1);$pos1 = $pos1 + strlen($a);$s = substr($source, $pos1);$pos2 = stripos($s, $b) + strlen($b);$ret = $ret.substr($s, $pos2);return $ret;}
if ($_REQUEST["get"]=="d1"){
$id = $_REQUEST["id"];
$url = "http://vho.vn/wap/?module=1&id=$id";
$response = str_replace('"', "'", get_url_contents($url));
$gw = sstring($response,"<html>","<a href='#top' style='text-decoration:none;'>");
$gw = str_replace("href='?module=1&id=", "href='/vho.php?get=d1&id=", $gw);
$gw = str_replace("href='?module=4", "href='/vho.php?get=d4", $gw);
$gw = str_replace("href='?module=5", "href='/vho.php?get=d5", $gw);
$gw = str_replace("href='?module=8", "href='/vho.php?get=d8", $gw);
$gw = str_replace("href='?module=3&ch=", "href='/vho.php?get=d9&c=", $gw);
$gw = str_replace("href='?q=", "href='/vho.php?search=q&k=", $gw);
$gw = str_replace("href='?m=", "href='/vho.php?get=u&m=", $gw);
$gw = str_replace("href='?module=6", "href='/vho.php?get=d6&id=", $gw);
$gw = str_replace("action=''", "action='/vho.php?search=q'", $gw);
$gw = str_replace("<input type='hidden' name='btnV' value='Search'><input type='radio' value='0' checked name='r1'><font face='Arial' size='2'>Tin</font>", "", $gw);
$gw = str_replace("<input type='radio' value='1' name='r1'><font face='Arial' size='2'>Địa chỉ</font>", "", $gw);
$gw = str_replace(" value='Search' onclick='javascript: this.value='';'", "", $gw);
$gw = str_replace("name='q'", "name='k'", $gw);
$gw = str_replace("method='get'", "method='post'", $gw);
$gw = str_replace("src='", "src='", $gw);
$gw = str_replace("src='http://vho.vn/photos/search.gif'", "src='http://vho.vn/wap/search.gif'", $gw);
$gw = str_replace("<img border='0' src='http://vho.vn/photos/vho_logo.gif' width='225' height='47'></font></td>", "", $gw);
$gw = str_replace("", "", $gw);
$gw = str_replace("", "", $gw);
//$gw = str_replace("<td colspan='3'><font face='Arial' size='2'><a href='/wap'", "<td colspan='3'><font face='Arial' size='2'><a href='/'", $gw);
$gw = str_replace("src='http://vho.vn/photos/phone.png'", "src='http://vho.vn/wap/phone.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/video.png'", "src='http://vho.vn/wap/video.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/quest.png'", "src='http://vho.vn/wap/quest.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/benhvien.png'", "src='http://vho.vn/wap/benhvien.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/phongkham.png'", "src='http://vho.vn/wap/phongkham.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/nhathuoc.png'", "src='http://vho.vn/wap/nhathuoc.png'", $gw);
$gw = str_replace("<img border='0' src='vho_logo.gif' width='225' height='47'>", "", $gw);
echo $gw;}
if ($_REQUEST["get"]=="d4"){
$url = "http://vho.vn/wap/?module=4";
$response = str_replace('"', "'", get_url_contents($url));
$gw = sstring($response,"<html>","<a href='#top' style='text-decoration:none;'>");
$gw = str_replace("href='?module=1&id=", "href='/vho.php?get=d1&id=", $gw);
$gw = str_replace("href='?module=4", "href='/vho.php?get=d4", $gw);
$gw = str_replace("href='?module=5", "href='/vho.php?get=d5", $gw);
$gw = str_replace("href='?module=8", "href='/vho.php?get=d8", $gw);
$gw = str_replace("href='?module=3&ch=", "href='/vho.php?get=d9&c=", $gw);
$gw = str_replace("href='?q=", "href='/vho.php?search=q&k=", $gw);
$gw = str_replace("href='?module=6", "href='/vho.php?get=d6&id=", $gw);
$gw = str_replace("href='?m=", "href='/vho.php?get=u&m=", $gw);
$gw = str_replace("action=''", "action='/vho.php?search=q'", $gw);
$gw = str_replace("<input type='hidden' name='btnV' value='Search'><input type='radio' value='0' checked name='r1'><font face='Arial' size='2'>Tin</font>", "", $gw);
$gw = str_replace("<input type='radio' value='1' name='r1'><font face='Arial' size='2'>Địa chỉ</font>", "", $gw);
$gw = str_replace(" value='Search' onclick='javascript: this.value='';'", "", $gw);
$gw = str_replace("name='q'", "name='k'", $gw);
$gw = str_replace("method='get'", "method='post'", $gw);
$gw = str_replace("src='", "src='", $gw);
$gw = str_replace("src='http://vho.vn/photos/search.gif'", "src='http://vho.vn/wap/search.gif'", $gw);
$gw = str_replace("<img border='0' src='http://vho.vn/photos/vho_logo.gif' width='225' height='47'></font></td>", "", $gw);
$gw = str_replace("VHO.vn - ", "", $gw);
$gw = str_replace("|", "<br>", $gw);
//$gw = str_replace("<td colspan='3'><font face='Arial' size='2'><a href='/wap style='text-decoration:none;'>Trang", "<td colspan='3'><font face='Arial' size='2'><a href='/'", $gw)
$gw = str_replace("src='http://vho.vn/photos/phone.png'", "src='http://vho.vn/wap/phone.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/video.png'", "src='http://vho.vn/wap/video.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/quest.png'", "src='http://vho.vn/wap/quest.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/benhvien.png'", "src='http://vho.vn/wap/benhvien.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/phongkham.png'", "src='http://vho.vn/wap/phongkham.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/nhathuoc.png'", "src='http://vho.vn/wap/nhathuoc.png'", $gw);
$gw = str_replace("<img border='0' src='vho_logo.gif' width='225' height='47'>", "", $gw);
echo $gw;}
if ($_REQUEST["get"]=="d5"){
$p = $_REQUEST["page"];
$url = "http://vho.vn/wap/?module=5&page=$p";
$response = str_replace('"', "'", get_url_contents($url));
$gw = sstring($response,"<html>","<a href='#top' style='text-decoration:none;'>");
$gw = str_replace("href='?module=5&page=", "href='/vho.php?get=d5&page=", $gw);
$gw = str_replace("href='?module=1&id=", "href='/vho.php?get=d1&id=", $gw);
$gw = str_replace("href='?module=4", "href='/vho.php?get=d4", $gw);
$gw = str_replace("href='?module=5", "href='/vho.php?get=d5", $gw);
$gw = str_replace("href='?module=8", "href='/vho.php?get=d8", $gw);
$gw = str_replace("href='?module=3&ch=", "href='/vho.php?get=d9&c=", $gw);
$gw = str_replace("href='?q=", "href='/vho.php?search=q&k=", $gw);
$gw = str_replace("href='?module=6", "href='/vho.php?get=d6&id=", $gw);
$gw = str_replace("href='?m=", "href='/vho.php?get=u&m=", $gw);
$gw = str_replace("action=''", "action='/vho.php?search=q'", $gw);
$gw = str_replace("<input type='hidden' name='btnV' value='Search'><input type='radio' value='0' checked name='r1'><font face='Arial' size='2'>Tin</font>", "", $gw);
$gw = str_replace("<input type='radio' value='1' name='r1'><font face='Arial' size='2'>Địa chỉ</font>", "", $gw);
$gw = str_replace(" value='Search' onclick='javascript: this.value='';'", "", $gw);
$gw = str_replace("name='q'", "name='k'", $gw);
$gw = str_replace("method='get'", "method='post'", $gw);
$gw = str_replace("src='", "src='", $gw);
$gw = str_replace("src='http://vho.vn/photos/search.gif'", "src='http://vho.vn/wap/search.gif'", $gw);
$gw = str_replace("<img border='0' src='http://vho.vn/photos/vho_logo.gif' width='225' height='47'></font></td>", "", $gw);
$gw = str_replace("VHO.vn - ", "", $gw);
$gw = str_replace("|", "<br>", $gw);
$gw = str_replace("src='http://vho.vn/photos/phone.png'", "src='http://vho.vn/wap/phone.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/video.png'", "src='http://vho.vn/wap/video.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/quest.png'", "src='http://vho.vn/wap/quest.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/benhvien.png'", "src='http://vho.vn/wap/benhvien.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/phongkham.png'", "src='http://vho.vn/wap/phongkham.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/nhathuoc.png'", "src='http://vho.vn/wap/nhathuoc.png'", $gw);
$gw = str_replace("<img border='0' src='vho_logo.gif' width='225' height='47'>", "", $gw);
echo $gw;}
if ($_REQUEST["get"]=="d6"){
$i = $_REQUEST["id"];
$url = "http://vho.vn/wap/?module=6&id=$i";
$response = str_replace('"', "'", get_url_contents($url));
$gw = sstring($response,"<html>","<a href='#top' style='text-decoration:none;'>");
$gw = str_replace("href='?module=1&id=", "href='/vho.php?get=d1&id=", $gw);
$gw = str_replace("href='?module=4", "href='/vho.php?get=d4", $gw);
$gw = str_replace("href='?module=5", "href='/vho.php?get=d5", $gw);
$gw = str_replace("href='?module=8", "href='/vho.php?get=d8", $gw);
$gw = str_replace("href='?module=3&ch=", "href='/vho.php?get=d9&c=", $gw);
$gw = str_replace("href='?q=", "href='/vho.php?search=q&k=", $gw);
$gw = str_replace("href='?module=6", "href='/vho.php?get=d6&id=", $gw);
$gw = str_replace("href='?m=", "href='/vho.php?get=u&m=", $gw);
$gw = str_replace("href='?module=7&id=", "href='/vho.php?get=d7&id=", $gw);
$gw = str_replace("href='?module=7&tid=1&id=", "href='/vho.php?get=d7&t=1&id=", $gw);
$gw = str_replace("href='?module=7&tid=2&id=", "href='/vho.php?get=d7&t=2&id=", $gw);
$gw = str_replace("href='?module=7&tid=3&id=", "href='/vho.php?get=d7&t=3&id=", $gw);
$gw = str_replace("action=''", "action='/vho.php?search=q'", $gw);
$gw = str_replace("<input type='hidden' name='btnV' value='Search'><input type='radio' value='0' checked name='r1'><font face='Arial' size='2'>Tin</font>", "", $gw);
$gw = str_replace("<input type='radio' value='1' name='r1'><font face='Arial' size='2'>Địa chỉ</font>", "", $gw);
$gw = str_replace(" value='Search' onclick='javascript: this.value='';'", "", $gw);
$gw = str_replace("name='q'", "name='k'", $gw);
$gw = str_replace("method='get'", "method='post'", $gw);
$gw = str_replace("src='", "src='", $gw);
$gw = str_replace("src='http://vho.vn/photos/search.gif'", "src='http://vho.vn/wap/search.gif'", $gw);
$gw = str_replace("<img border='0' src='http://vho.vn/photos/vho_logo.gif' width='225' height='47'></font></td>", "", $gw);
$gw = str_replace("VHO.vn - ", "", $gw);
$gw = str_replace("|", "<br>", $gw);
//$gw = str_replace("<td colspan='3'><font face='Arial' size='2'><a href='/wap'", "<td colspan='3'><font face='Arial' size='2'><a href='/'", $gw)
$gw = str_replace("src='http://vho.vn/photos/phone.png'", "src='http://vho.vn/wap/phone.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/video.png'", "src='http://vho.vn/wap/video.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/quest.png'", "src='http://vho.vn/wap/quest.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/benhvien.png'", "src='http://vho.vn/wap/benhvien.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/phongkham.png'", "src='http://vho.vn/wap/phongkham.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/nhathuoc.png'", "src='http://vho.vn/wap/nhathuoc.png'", $gw);
$gw = str_replace("<img border='0' src='vho_logo.gif' width='225' height='47'>", "", $gw);
echo $gw;}
if ($_REQUEST["get"]=="d7"){
$id = $_REQUEST["id"];
$t = $_REQUEST["t"];
$url = "http://vho.vn/wap/?module=7&tid=$t&id=$id";
$response = str_replace('"', "'", get_url_contents($url));
$gw = sstring($response,"<html>","<a href='#top' style='text-decoration:none;'>");
$gw = str_replace("href='?module=1&id=", "href='/vho.php?get=d1&id=", $gw);
$gw = str_replace("href='?module=4", "href='/vho.php?get=d4", $gw);
$gw = str_replace("href='?module=5", "href='/vho.php?get=d5", $gw);
$gw = str_replace("href='?module=8", "href='/vho.php?get=d8", $gw);
$gw = str_replace("href='?module=6", "href='/vho.php?get=d6&id=", $gw);
$gw = str_replace("href='?module=3&ch=", "href='/vho.php?get=d9&c=", $gw);
$gw = str_replace("href='?m=", "href='/vho.php?get=u&m=", $gw);
$gw = str_replace("href='?module=7&tid=1&id=", "href='/vho.php?get=d7&t=1&id=", $gw);
$gw = str_replace("href='?module=7&tid=2&id=", "href='/vho.php?get=d7&t=2&id=", $gw);
$gw = str_replace("href='?module=7&tid=3&id=", "href='/vho.php?get=d7&t=3&id=", $gw);
$gw = str_replace("action=''", "action='/vho.php?search=q'", $gw);
$gw = str_replace("<input type='hidden' name='btnV' value='Search'><input type='radio' value='0' checked name='r1'><font face='Arial' size='2'>Tin</font>", "", $gw);
$gw = str_replace("<input type='radio' value='1' name='r1'><font face='Arial' size='2'>Địa chỉ</font>", "", $gw);
$gw = str_replace(" value='Search' onclick='javascript: this.value='';'", "", $gw);
$gw = str_replace("name='q'", "name='k'", $gw);
$gw = str_replace("method='get'", "method='post'", $gw);
$gw = str_replace("src='", "src='", $gw);
$gw = str_replace("src='http://vho.vn/photos/search.gif'", "src='http://vho.vn/wap/search.gif'", $gw);
$gw = str_replace("<img border='0' src='http://vho.vn/photos/vho_logo.gif' width='225' height='47'></font></td>", "", $gw);
$gw = str_replace("VHO.vn - ", "", $gw);
$gw = str_replace("|", "<br>", $gw);
//$gw = str_replace("<td colspan='3'><font face='Arial' size='2'><a href='/wap'", "<td colspan='3'><font face='Arial' size='2'><a href='/'", $gw)
$gw = str_replace("src='http://vho.vn/photos/phone.png'", "src='http://vho.vn/wap/phone.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/video.png'", "src='http://vho.vn/wap/video.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/quest.png'", "src='http://vho.vn/wap/quest.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/benhvien.png'", "src='http://vho.vn/wap/benhvien.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/phongkham.png'", "src='http://vho.vn/wap/phongkham.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/nhathuoc.png'", "src='http://vho.vn/wap/nhathuoc.png'", $gw);
$gw = str_replace("<img border='0' src='vho_logo.gif' width='225' height='47'>", "", $gw);
echo $gw;}
if ($_REQUEST["get"]=="d8"){
$url = "http://vho.vn/wap/?module=8";
$response = str_replace('"', "'", get_url_contents($url));
$gw = sstring($response,"<html>","<a href='#top' style='text-decoration:none;'>");
$gw = str_replace("href='?module=1&id=", "href='/vho.php?get=d1&id=", $gw);
$gw = str_replace("href='?module=4", "href='/vho.php?get=d4", $gw);
$gw = str_replace("href='?module=5", "href='/vho.php?get=d5", $gw);
$gw = str_replace("href='?module=8", "href='/vho.php?get=d8", $gw);
$gw = str_replace("href='?module=3&ch=", "href='/vho.php?get=d9&c=", $gw);
$gw = str_replace("href='?q=", "href='/vho.php?search=q&k=", $gw);
$gw = str_replace("href='?module=6", "href='/vho.php?get=d6&id=", $gw);
$gw = str_replace("href='?m=", "href='/vho.php?get=u&m=", $gw);
$gw = str_replace("action=''", "action='/vho.php?search=q'", $gw);
$gw = str_replace("<input type='hidden' name='btnV' value='Search'><input type='radio' value='0' checked name='r1'><font face='Arial' size='2'>Tin</font>", "", $gw);
$gw = str_replace("<input type='radio' value='1' name='r1'><font face='Arial' size='2'>Địa chỉ</font>", "", $gw);
$gw = str_replace(" value='Search' onclick='javascript: this.value='';'", "", $gw);
$gw = str_replace("name='q'", "name='k'", $gw);
$gw = str_replace("method='get'", "method='post'", $gw);
$gw = str_replace("src='", "src='", $gw);
$gw = str_replace("src='http://vho.vn/photos/search.gif'", "src='http://vho.vn/wap/search.gif'", $gw);
$gw = str_replace("<img border='0' src='http://vho.vn/photos/vho_logo.gif' width='225' height='47'></font></td>", "", $gw);
$gw = str_replace("VHO.vn - ", "", $gw);
$gw = str_replace("|", "<br>", $gw);
//$gw = str_replace("<td colspan='3'><font face='Arial' size='2'><a href='/wap'", "<td colspan='3'><font face='Arial' size='2'><a href='/'", $gw)

$gw = str_replace("src='http://vho.vn/photos/phone.png'", "src='http://vho.vn/wap/phone.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/video.png'", "src='http://vho.vn/wap/video.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/quest.png'", "src='http://vho.vn/wap/quest.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/benhvien.png'", "src='http://vho.vn/wap/benhvien.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/phongkham.png'", "src='http://vho.vn/wap/phongkham.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/nhathuoc.png'", "src='http://vho.vn/wap/nhathuoc.png'", $gw);
$gw = str_replace("<img border='0' src='vho_logo.gif' width='225' height='47'>", "", $gw);
$gw = str_replace("<a href='../media", "<a href='http://vho.vn/media", $gw);

echo $gw;}
if ($_REQUEST["get"]=="d9"){
$c = $_REQUEST["c"];
$url = "http://vho.vn/wap/?module=3&ch=$c";
$response = str_replace('"', "'", get_url_contents($url));
$gw = sstring($response,"<html>","<a href='#top' style='text-decoration:none;'>");
$gw = str_replace("href='?module=1&id=", "href='/vho.php?get=d1&id=", $gw);
$gw = str_replace("href='?module=4", "href='/vho.php?get=d4", $gw);
$gw = str_replace("href='?module=5", "href='/vho.php?get=d5", $gw);
$gw = str_replace("href='?module=8", "href='/vho.php?get=d8", $gw);
$gw = str_replace("href='?module=3&ch=", "href='/vho.php?get=d9&c=", $gw);
$gw = str_replace("href='?q=", "href='/vho.php?search=q&k=", $gw);
$gw = str_replace("href='?module=6", "href='/vho.php?get=d6&id=", $gw);
$gw = str_replace("href='?m=", "href='/vho.php?get=u&m=", $gw);
$gw = str_replace("action=''", "action='/vho.php?search=q'", $gw);
$gw = str_replace("<input type='hidden' name='btnV' value='Search'><input type='radio' value='0' checked name='r1'><font face='Arial' size='2'>Tin</font>", "", $gw);
$gw = str_replace("<input type='radio' value='1' name='r1'><font face='Arial' size='2'>Địa chỉ</font>", "", $gw);
$gw = str_replace(" value='Search' onclick='javascript: this.value='';'", "", $gw);
$gw = str_replace("name='q'", "name='k'", $gw);
$gw = str_replace("method='get'", "method='post'", $gw);
$gw = str_replace("src='", "src='", $gw);
$gw = str_replace("src='http://vho.vn/photos/search.gif'", "src='http://vho.vn/wap/search.gif'", $gw);
$gw = str_replace("<img border='0' src='http://vho.vn/photos/vho_logo.gif' width='225' height='47'></font></td>", "", $gw);
$gw = str_replace("VHO.vn - ", "", $gw);
$gw = str_replace("|", "<br>", $gw);
//$gw = str_replace("<td colspan='3'><font face='Arial' size='2'><a href='/wap'", "<td colspan='3'><font face='Arial' size='2'><a href='/'", $gw)
$gw = str_replace("href='../", "href='http://vho.vn/", $gw);
$gw = str_replace("src='http://vho.vn/photos/phone.png'", "src='http://vho.vn/wap/phone.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/video.png'", "src='http://vho.vn/wap/video.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/quest.png'", "src='http://vho.vn/wap/quest.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/benhvien.png'", "src='http://vho.vn/wap/benhvien.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/phongkham.png'", "src='http://vho.vn/wap/phongkham.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/nhathuoc.png'", "src='http://vho.vn/wap/nhathuoc.png'", $gw);
$gw = str_replace("<img border='0' src='vho_logo.gif' width='225' height='47'>", "", $gw);
echo $gw;}
if ($_REQUEST["search"]=="q"){
$k = $_REQUEST["k"];
$url = "http://vho.vn/wap/?q=".str_replace(" ","%20",$k)."";
$response = str_replace('"', "'", get_url_contents($url));
$gw = sstring($response,"<html>","<a href='#top' style='text-decoration:none;'>");
$gw = str_replace("href='?module=1&id=", "href='/vho.php?get=d1&id=", $gw);
$gw = str_replace("href='?module=4", "href='/vho.php?get=d4", $gw);
$gw = str_replace("href='?module=5", "href='/vho.php?get=d5", $gw);
$gw = str_replace("href='?module=8", "href='/vho.php?get=d8", $gw);
$gw = str_replace("href='?module=3&ch=", "href='/vho.php?get=d9&c=", $gw);
$gw = str_replace("href='?q=", "href='/vho.php?search=q&k=", $gw);
$gw = str_replace("href='?module=6", "href='/vho.php?get=d6&id=", $gw);
$gw = str_replace("href='?m=", "href='/vho.php?get=u&m=", $gw);
$gw = str_replace("action=''", "action='/vho.php?search=q'", $gw);
$gw = str_replace("<input type='hidden' name='btnV' value='Search'><input type='radio' value='0' checked name='r1'><font face='Arial' size='2'>Tin</font>", "", $gw);
$gw = str_replace("<input type='radio' value='1' name='r1'><font face='Arial' size='2'>Địa chỉ</font>", "", $gw);
$gw = str_replace(" value='Search' onclick='javascript: this.value='';'", "", $gw);
$gw = str_replace("name='q'", "name='k'", $gw);
$gw = str_replace("method='get'", "method='post'", $gw);
$gw = str_replace("src='", "src='", $gw);
$gw = str_replace("src='http://vho.vn/photos/search.gif'", "src='http://vho.vn/wap/search.gif'", $gw);
$gw = str_replace("<img border='0' src='http://vho.vn/photos/vho_logo.gif' width='225' height='47'></font></td>", "", $gw);
$gw = str_replace("VHO.vn - ", "", $gw);
$gw = str_replace("|", "<br>", $gw);
//$gw = str_replace("<td colspan='3'><font face='Arial' size='2'><a href='/wap'", "<td colspan='3'><font face='Arial' size='2'><a href='/'", $gw)
$gw = str_replace("href='../", "href='http://vho.vn/", $gw);
$gw = str_replace("src='http://vho.vn/photos/phone.png'", "src='http://vho.vn/wap/phone.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/video.png'", "src='http://vho.vn/wap/video.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/quest.png'", "src='http://vho.vn/wap/quest.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/benhvien.png'", "src='http://vho.vn/wap/benhvien.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/phongkham.png'", "src='http://vho.vn/wap/phongkham.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/nhathuoc.png'", "src='http://vho.vn/wap/nhathuoc.png'", $gw);
$gw = str_replace("<img border='0' src='vho_logo.gif' width='225' height='47'>", "", $gw);
$gw = str_replace("<font face='Arial' size='2'><a href='/wap'", "<font face='Arial' size='2'><a href='/'", $gw);
echo $gw;}
if ($_REQUEST["get"]=="u"){
$q = $_REQUEST["q"];
$m = $_REQUEST["m"];
$p = $_REQUEST["page"];
$url = "http://vho.vn/wap/?m=$m&page=$p&q=$q";
$response = str_replace('"', "'", get_url_contents($url));
$gw = sstring($response,"<html>","<a href='#top' style='text-decoration:none;'>");
$gw = str_replace("href='?module=1&id=", "href='/vho.php?get=d1&id=", $gw);
$gw = str_replace("href='?module=4", "href='/vho.php?get=d4", $gw);
$gw = str_replace("href='?module=5", "href='/vho.php?get=d5", $gw);
$gw = str_replace("href='?module=8", "href='/vho.php?get=d8", $gw);
$gw = str_replace("href='?module=3&ch=", "href='/vho.php?get=d9&c=", $gw);
$gw = str_replace("href='?q=", "href='/vho.php?search=q&k=", $gw);
$gw = str_replace("href='?module=6", "href='/vho.php?get=d6&id=", $gw);
$gw = str_replace("href='?m=", "href='/vho.php?get=u&m=", $gw);
$gw = str_replace("action=''", "action='/vho.php?search=q'", $gw);
$gw = str_replace("<input type='hidden' name='btnV' value='Search'><input type='radio' value='0' checked name='r1'><font face='Arial' size='2'>Tin</font>", "", $gw);
$gw = str_replace("<input type='radio' value='1' name='r1'><font face='Arial' size='2'>Địa chỉ</font>", "", $gw);
$gw = str_replace(" value='Search' onclick='javascript: this.value='';'", "", $gw);
$gw = str_replace("name='q'", "name='k'", $gw);
$gw = str_replace("method='get'", "method='post'", $gw);
$gw = str_replace("src='", "src='", $gw);
$gw = str_replace("src='http://vho.vn/photos/search.gif'", "src='http://vho.vn/wap/search.gif'", $gw);
$gw = str_replace("<img border='0' src='http://vho.vn/photos/vho_logo.gif' width='225' height='47'></font></td>", "", $gw);
$gw = str_replace("VHO.vn - ", "", $gw);
$gw = str_replace("|", "<br>", $gw);
//$gw = str_replace("<td colspan='3'><font face='Arial' size='2'><a href='/wap'", "<td colspan='3'><font face='Arial' size='2'><a href='/'", $gw)
$gw = str_replace("href='../", "href='http://vho.vn/", $gw);
$gw = str_replace("src='http://vho.vn/photos/phone.png'", "src='http://vho.vn/wap/phone.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/video.png'", "src='http://vho.vn/wap/video.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/quest.png'", "src='http://vho.vn/wap/quest.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/benhvien.png'", "src='http://vho.vn/wap/benhvien.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/phongkham.png'", "src='http://vho.vn/wap/phongkham.png'", $gw);
$gw = str_replace("src='http://vho.vn/photos/nhathuoc.png'", "src='http://vho.vn/wap/nhathuoc.png'", $gw);
$gw = str_replace("<img border='0' src='vho_logo.gif' width='225' height='47'>", "", $gw);
$gw = str_replace("<font face='Arial' size='2'><a href='/wap'", "<font face='Arial' size='2'><a href='/'", $gw);
echo $gw;}

include 'foot.php';
?>
