<?php
error_reporting(0);
class apdich{
private $ab = '">';
private $ac = '</d';
private $host = 'http://translate.google.com';
function cc(){
$cc = array(
'auto'=>'Tự Nhận diện',
'en'=>'Tiếng Anh',
'vi'=>'Tiếng Việt',
'af'=>'Afrikaans',
'sq'=>'Albanian',
'ar'=>'Arabic',
'hy'=>'Armenian',
'az'=>'Azerbaijani',
'eu'=>'Basque',
'az'=>'Azerbaijani',
'eu'=>'Basque',
'be'=>'Belarusian',
'bn'=>'Bengali',
'bg'=>'Bulgarian',
'ca'=>'Catalan',
'zh-CN'=>'Chinese (Simplified)',
'zh-TW'=>'Chinese (Traditional)',
'hr'=>'Croatian',
'cs'=>'Czech',
'da'=>'Danish',
'nl'=>'Dutch',
'et'=>'Estonian',
'tl'=>'Filipino',
'fi'=>'Finnish',
'fr'=>'French',
'gl'=>'Galician',
'ka'=>'Georgian',
'de'=>'German',
'el'=>'Greek',
'gu'=>'Gujarati',
'ht'=>'Haitian Creole',
'iw'=>'Hebrew',
'hi'=>'Hindi',
'hu'=>'Hungarian',
'is'=>'Icelandic',
'id'=>'Indonesian',
'ga'=>'Irish',
'it'=>'Italian',
'ja'=>'Japanese',
'kn'=>'Kannada',
'ko'=>'Korean',
'la'=>'Latin',
'lv'=>'Latvian',
'lt'=>'Lithuanian',
'mk'=>'Macedonian',
'ms'=>'Malay',
'mt'=>'Maltese',
'no'=>'Norwegian',
'fa'=>'Persian',
'pl'=>'Polish',
'pt'=>'Portuguese',
'ro'=>'Romanian',
'ru'=>'Russian',
'sr'=>'Serbian',
'sk'=>'Slovak',
'sl'=>'Slovenian',
'es'=>'Spanish',
'sw'=>'Swahili',
'sv'=>'Swedish',
'ta'=>'Tamil',
'te'=>'Telugu',
'th'=>'Thai',
'tr'=>'Turkish',
'uk'=>'Ukrainian',
'ur'=>'Urdu',
'cy'=>'Welsh',
'yi'=>'Yiddish');
$q = $_GET['q'];
$from = $_GET['from'];
$to = $_GET['to'];
$q = str_replace(' ', '+', $q);
$qi = str_replace('+', ' ', $q);

echo "<div align='center'><form class='form' method='get' action=''>Nhập văn bản:<br><input class='input' name='q' type='text' value='$qi'>
<br>Dịch từ:<br><select class='input' name='form'>";
if ($from){
echo "<option class='input' value='$from'>$cc[$from]</option>";
}
foreach($cc as $key => $val){
echo "<option class='input' value='$key'>$val</option>";
}
echo "</select>
<br>Dịch sang:<br><select class='input' name='to'>";
if ($to){
echo "<option class='input' value='$to'>$cc[$to]</option>";
}

foreach($cc as $key => $val){
$key = str_replace('auto', 'Tự động', $key);
$val = str_replace('Auto detect', 'Tự nhận diện', $val);
echo"<option class='input' value='$key'>$val</option>";
}
echo"</select>
<input class='input' type='submit' value='dịch ngay'>
</form></div>";
}
function anhphu(){
$q = $_GET['q'];
$q = str_replace(' ', '+', $q);
if ($_GET['from'])
$from = $_GET['from']; else $from = 'auto';
$to = $_GET['to'];
$url = file_get_contents("$this->host/m?hl=en&sl=$from&tl=$to&ie=UTF-8&prev=_m&q=$q");
return $url;
}
function ex1(){
$exp = explode('<div dir="ltr"', $this->anhphu());
return $exp[1];
}
function ex2(){
$exp = explode('<div dir="ltr"', $this->anhphu());
return $exp[2];
}
function dich(){
$dich1 = cut($this->ex1(),$this->ab,$this->ac);
$dich2 = cut($this->ex2(),$this->ab,$this->ac);
if ($dich1 !="") {
echo "<div align='center'><textarea>$dich1</textarea></div>";
}
if ($dich2 !="") {
echo "<div align='center'><textarea>$dich2</textarea></div>";
}
}
}

function cut($content,$start,$end){
if($content && $start && $end) {
$r = explode($start, $content);
if (isset($r[1])){
$r = explode($end, $r[1]);
return $r[0];
}
return '';
}
}
ini_set("default_charset", "UTF-8");
Ini_set("user_agent", "Mozilla/5.0 (Symbian/3; Series60/5.2 NokiaE7-00/012.002; Profile/MIDP-2.1 Configuration/CLDC-1.1) AppleWebKit/525 (KHTML, like Gecko) Version/3.0BrowserNG/7.2.7.3 3gpp-gba");
if ($_GET['q'])
$title = str_replace('+', ' ', $_GET['q']);          else $title = 'Dịch văn bản trực tuyến';
include'head.php';
echo "<div class='menu'>";
$apdich = new apdich;
$apdich->anhphu();
$apdich->ex1();
$apdich->ex2();
$apdich->cc();
$apdich->dich();
echo '</div>'; include'end.php';
?>
