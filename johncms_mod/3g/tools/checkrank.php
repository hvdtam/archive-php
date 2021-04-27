<?php
ob_start('ob_gzhandler',9);
if(isset($_GET['mod']))
{
$mod = $_GET['mod'];
}
else
{
$mod = "";
}
switch($mod)
{
case 'get':
$who=strtolower($_POST['who']);
if(preg_match('#^([a-z0-9_\-\.])+(\.([a-z0-9])+)+$#',$who))
{function StrToNum($Str, $Check, $Magic) {
$Int32Unit = 4294967296;
$length = strlen($Str);
for ($i = 0; $i < $length; $i++) {
$Check *= $Magic;
if ($Check >= $Int32Unit) {
$Check = ($Check - $Int32Unit * (int) ($Check / $Int32Unit));
$Check = ($Check < -2147483648) ? ($Check + $Int32Unit) : $Check;
}
$Check += ord($Str{$i});
}
return $Check;
}

function HashURL($String) {
$Check1 = StrToNum($String, 0x1505, 0x21);
$Check2 = StrToNum($String, 0, 0x1003F);

$Check1 >>= 2;
$Check1 = (($Check1 >> 4) & 0x3FFFFC0 ) | ($Check1 & 0x3F);
$Check1 = (($Check1 >> 4) & 0x3FFC00 ) | ($Check1 & 0x3FF);
$Check1 = (($Check1 >> 4) & 0x3C000 ) | ($Check1 & 0x3FFF);

$T1 = (((($Check1 & 0x3C0) << 4) | ($Check1 & 0x3C)) <<2 ) | ($Check2 & 0xF0F );
$T2 = (((($Check1 & 0xFFFFC000) << 4) | ($Check1 & 0x3C00)) << 0xA) | ($Check2 & 0xF0F0000 );

return ($T1 | $T2);
}

function CheckHash($Hashnum) {
$CheckByte = 0;
$Flag = 0;

$HashStr = sprintf('%u', $Hashnum);
$length = strlen($HashStr);

for ($i = $length - 1; $i >= 0; $i --) {
$Re = $HashStr{$i};
if (1 === ($Flag % 2)) {
$Re += $Re;
$Re = (int)($Re / 10) + ($Re % 10);
}
$CheckByte += $Re;
$Flag ++;
}

$CheckByte %= 10;
if (0 !== $CheckByte) {
$CheckByte = 10 - $CheckByte;
if (1 === ($Flag % 2) ) {
if (1 === ($CheckByte % 2)) {
$CheckByte += 9;
}
$CheckByte >>= 1;
}
}

return '7'.$CheckByte.$HashStr;
}

function getch($url) { return CheckHash(HashURL($url)); }

function pr($url)
{
$googlehost='toolbarqueries.google.com';
$ch = getch($url);
if ($ch)
{
$googleurl='http://'.$googlehost.'/search?client=navclient-auto&ch='.$ch.'&features=Rank&q=info:'.$url;
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, $googleurl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
$data = curl_exec($ch);
curl_close($ch);
if(!substr_count($data, "Rank_"))
return ('n/a');
else
{
$pos = strpos($data, "Rank_");
$pr=substr($data, $pos + 9);
$pr=trim($pr);
$pr=str_replace("\n",'',$pr);
return $pr;
}
}
}
function ginfo($url){
preg_match('#<span class="c">(.*)/</span>#Ui', file_get_contents('http://www.google.com/m?q=info:'.$url), $out);
if (!isset($out[1])){ $out[1] = $url;}  if($out[1] !== $url){$r='(клей с '.$out[1].')';}else{$r=' ';} return $r;}
$yandex = new SimpleXMLElement('http://bar-navig.yandex.ru/u?ver=2&show=32&url=http://'.$who, NULL, TRUE);
$alexa = new SimpleXMLElement('http://data.alexa.com/data?cli=10&dat=snbamz&url='.$who, NULL, TRUE);
include '../head.php';
echo 'Google PageRank:<b> '.pr($who).'</b> '.ginfo($who);
echo '</b><br>Alexa Rank:<b> '.$alexa->SD[1]->POPULARITY['TEXT'];
echo'</b><br>&raquo; <a href="http://MChanTroi.Net/tools/checkrank.php">Trở lại</a><br>';
include '../foot.php';
}
else{
include '../head.php';
echo'Địa chỉ là không đúng!!<br>';
echo'&raquo; <a href="http://MChanTroi.Net/tools/checkrank.php">Trở lại</a>
<br>';
include '../foot.php';
}
break;
default:
include '../head.php';
echo'<form action="?mod=get" method="post">';
echo'Nhập tên wapsite/website của bạn (không có http:// hoặc www.):<br><input type="text" name="who" class="form"> ';
echo'<br><input type="submit" class="button" value="Check">';
echo'</form>';
include '../foot.php';
break;
}
?>
