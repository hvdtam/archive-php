<?php

function userAgent() {
$userAgent = array(








'Opera/9.80 (Windows NT 5.1; U; en) Presto/2.2.15 Version/10.00',


'SEC-SGHB100/1.0 (Openwave/6.2.3 Profile/MIDP-2.0 Configuration/CLDC-1.1)');
return $userAgent[rand(0,2)];
}
function grab_link($url,$cookie='',$user_agent='',$header='') {
if(function_exists('curl_init')){
$ch = curl_init();
$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
$headers[] = 'Accept-Language: en-us,en;q=0.5';
//$headers[] = 'Accept-Encoding: gzip,deflate';
$headers[] = 'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7';
$headers[] = 'Keep-Alive: 300';
$headers[] = 'Connection: Keep-Alive';
$headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8';
curl_setopt($ch, CURLOPT_URL, $url);
if($user_agent)	curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
else curl_setopt($ch, CURLOPT_USERAGENT, userAgent());
if($header)
curl_setopt($ch, CURLOPT_HEADER, 1);
else
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_REFERER, 'http://www.google.com.vn/search?hl=vi&client=firefox-a&rls=org.mozilla:en-US:official&hs=hKS&q=video+clip&start=20&sa=N');
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
if(strncmp($url, 'https', 6)) curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
if($cookie)	curl_setopt($ch, CURLOPT_COOKIE, $cookie);
curl_setopt($ch, CURLOPT_TIMEOUT, 100);
$html = curl_exec($ch);
$mess_error = curl_error($ch);
curl_close($ch);
}
else {
$matches = parse_url($url);
$host = $matches['host'];
$link = (isset($matches['path'])?$matches['path']:'/').(isset($matches['query'])?'?'.$matches['query']:'').(isset($matches['fragment'])?'#'.$matches['fragment']:'');
$port = !empty($matches['port']) ? $matches['port'] : 80;
$fp=@fsockopen($host,$port,$errno,$errval,30);
if (!$fp) {
$html = "$errval ($errno)<br />\n";
} else {
$rand_ip = rand(1,254).".".rand(1,254).".".rand(1,254).".".rand(1,254);
$out  = "GET $link HTTP/1.1\r\n".
"Host: $host\r\n".
"Referer: http://www.google.com.vn/search?hl=vi&client=firefox-a&rls=org.mozilla:en-US:official&hs=hKS&q=video+clip&start=20&sa=N\r\n".
"Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5\r\n";
if($cookie) $out .= "Cookie: $cookie\r\n";
if($user_agent) $out .= "User-Agent: ".$user_agent."\r\n";
else $out .= "User-Agent: ".userAgent()."\r\n";
$out .= "X-Forwarded-For: $rand_ip\r\n".
"Via: CB-Prx\r\n".
"Connection: Close\r\n\r\n";
fwrite($fp,$out);
while (!feof($fp)) {
$html .= fgets($fp,4096);
}
fclose($fp);
}
}
return $html;
}

function laynoidung($noidung, $start, $stop) {
$bd = strpos($noidung, $start);
$kt = strpos(substr($noidung, $bd), $stop) + $bd;
$content = substr($noidung, $bd, $kt - $bd);
return $content;
}

function box($link, $sup, $sub)
{
echo "\n" . '<a href="'.$link.'" style="display:block; padding:4px 0px 4px 4px;"><b>'.$sup.'</b>';
echo "\n" . "<div style='border- ottom:1px dotted lime;'></div>";
echo "\n" . "<div class='menu'><span style='color: # 996633'>";
echo "\n" . "<small>".$sub."</small>";
echo "\n" . '</span></div></a>';
}

function check($string) {
$string = str_replace('&amp;', '&', $string);
$string = preg_replace('~&#x0*([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $string);
$string = preg_replace('~&#0*([0-9]+);~e', 'chr(\\1)', $string);
$trans_tbl = get_html_translation_table(HTML_ENTITIES);
$trans_tbl = array_flip($trans_tbl);
return strtr($string, $trans_tbl);
}


?>
