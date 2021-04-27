<?php
$is_mobile=mobile();
function mobile($iphone=true,$ipod=true,$ipad=true,$android=true,$opera=true,$blackberry=true,$palm=true,$windows=true,$mobileredirect=false,$desktopredirect=false)
{
$mobile_browser	= false;
$user_agent		= (!empty($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : getenv('HTTP_USER_AGENT');
$accept			= (!empty($_SERVER['HTTP_ACCEPT'])) ? $_SERVER['HTTP_ACCEPT'] : getenv('HTTP_ACCEPT');
switch(true)
{
case (preg_match('/ipad/i',$user_agent));
$mobile_browser = $ipad;
$status = 'iPad';
if(substr($ipad,0,4)=='http')
{
$mobileredirect = $ipad;
}
break;
case (preg_match('/ipod/i',$user_agent));
$mobile_browser = $ipod;
$status = 'iPod';
if(substr($ipod,0,4)=='http')
{
$mobileredirect = $ipod;
}
break;
case (preg_match('/iphone/i',$user_agent));
$mobile_browser = $iphone;
$status = 'iPhone';
if(substr($iphone,0,4)=='http')
{
$mobileredirect = $iphone;
}
break;
case (preg_match('/android/i',$user_agent));
if (preg_match('/SPH-D700/i',$user_agent))
{
$status = 'Samsung Epic';
}
elseif (preg_match('/A6277/i',$user_agent))
{
$status = 'HTC A6277';
}
else
{
$status = 'Android';
}
$mobile_browser = $android;
if(substr($android,0,4)=='http')
{
$mobileredirect = $android;
}
break;
case (preg_match('/opera mini/i',$user_agent));
$mobile_browser = $opera;
$status = 'Mobile Device';
if(substr($opera,0,4)=='http')
{
$mobileredirect = $opera;
}
break;
case (preg_match('/blackberry/i',$user_agent));
if (preg_match('/BlackBerry8530/i',$user_agent))
{
$status = 'BlackBerry Curve';
}
else if (preg_match('/BlackBerry8330/i',$user_agent))
{
$status = 'BlackBerry Curve';
}
else if (preg_match('/BlackBerry8300/i',$user_agent))
{
$status = 'BlackBerry Curve';
}
else if (preg_match('/BlackBerry8320/i',$user_agent))
{
$status = 'BlackBerry Curve';
}
else if (preg_match('/BlackBerry8310/i',$user_agent))
{
$status = 'BlackBerry Curve';
}
else if (preg_match('/BlackBerry9800/i',$user_agent))
{
$status = 'BlackBerry Torch';
}
else
{
$status = 'BlackBerry';
}
$mobile_browser = $blackberry;
if(substr($blackberry,0,4)=='http')
{
$mobileredirect = $blackberry;
}
break;
case (preg_match('/(pre\/|palm os|palm|hiptop|avantgo|plucker|xiino|blazer|elaine)/i',$user_agent));
$mobile_browser = $palm;
$status = 'Palm';
if(substr($palm,0,4)=='http')
{
$mobileredirect = $palm;
}
break;
case (preg_match('/(iris|3g_t|windows ce|windows Phone|opera mobi|windows ce; smartphone;|windows ce; iemobile)/i',$user_agent));
$mobile_browser = $windows;
$status = 'Windows Smartphone';
if(substr($windows,0,4)=='http')
{
$mobileredirect = $windows;
}
break;
case (preg_match('/lge vx10000/i',$user_agent));
$mobile_browser = $windows;
$status = 'Voyager';
if(substr($windows,0,4)=='http')
{
$mobileredirect = $lge;
}
break;
case (preg_match('/(mini 9.5|vx1000|lge |m800|e860|u940|ux840|compal|wireless| mobi|ahong|lg380|lgku|lgu900|lg210|lg47|lg920|lg840|lg370|sam-r|mg50|s55|g83|t66|vx400|mk99|d615|d763|el370|sl900|mp500|samu3|samu4|vx10|xda_|samu5|samu6|samu7|samu9|a615|b832|m881|s920|n210|s700|c-810|_h797|mob-x|sk16d|848b|mowser|s580|r800|471x|v120|rim8|c500foma:|160x|x160|480x|x640|t503|w839|i250|sprint|w398samr810|m5252|c7100|mt126|x225|s5330|s820|htil-g1|fly v71|s302|-x113|novarra|k610i|-three|8325rc|8352rc|sanyo|vx54|c888|nx250|n120|mtk |c5588|s710|t880|c5005|i;458x|p404i|s210|c5100|teleca|s940|c500|s590|foma|samsu|vx8|vx9|a1000|_mms|myx|a700|gu1100|bc831|e300|ems100|me701|me702m-three|sd588|s800|8325rc|ac831|mw200|brew |d88|htc\/|htc_touch|355x|m50|km100|d736|p-9521|telco|sl74|ktouch|m4u\/|me702|8325rc|kddi|phone|lg |sonyericsson|samsung|240x|x320|vx10|nokia|sony cmd|motorola|up.browser|up.link|mmp|symbian|smartphone|midp|wap|vodafone|o2|pocket|kindle|mobile|psp|treo)/i',$user_agent));
$mobile_browser = true;
$status = 'Mobile Device';
break;
case ((strpos($accept,'text/vnd.wap.wml')>0)||(strpos($accept,'application/vnd.wap.xhtml+xml')>0));
$mobile_browser = true;
$status = 'Mobile Device';
break;
case (isset($_SERVER['HTTP_X_WAP_PROFILE'])||isset($_SERVER['HTTP_PROFILE']));
$mobile_browser = true;
$status = 'Mobile Device';
break;
case (in_array(strtolower(substr($user_agent,0,4)),array('1207'=>'1207','3gso'=>'3gso','4thp'=>'4thp','501i'=>'501i','502i'=>'502i','503i'=>'503i','504i'=>'504i','505i'=>'505i','506i'=>'506i','6310'=>'6310','6590'=>'6590','770s'=>'770s','802s'=>'802s','a wa'=>'a wa','acer'=>'acer','acs-'=>'acs-','airn'=>'airn','alav'=>'alav','asus'=>'asus','attw'=>'attw','au-m'=>'au-m','aur '=>'aur ','aus '=>'aus ','abac'=>'abac','acoo'=>'acoo','aiko'=>'aiko','alco'=>'alco','alca'=>'alca','amoi'=>'amoi','anex'=>'anex','anny'=>'anny','anyw'=>'anyw','aptu'=>'aptu','arch'=>'arch','argo'=>'argo','bell'=>'bell','bird'=>'bird','bw-n'=>'bw-n','bw-u'=>'bw-u','beck'=>'beck','benq'=>'benq','bilb'=>'bilb','blac'=>'blac','c55/'=>'c55/','cdm-'=>'cdm-','chtm'=>'chtm','capi'=>'capi','cond'=>'cond','craw'=>'craw','dall'=>'dall','dbte'=>'dbte','dc-s'=>'dc-s','dica'=>'dica','ds-d'=>'ds-d','ds12'=>'ds12','dait'=>'dait','devi'=>'devi','dmob'=>'dmob','doco'=>'doco','dopo'=>'dopo','el49'=>'el49','erk0'=>'erk0','esl8'=>'esl8','ez40'=>'ez40','ez60'=>'ez60','ez70'=>'ez70','ezos'=>'ezos','ezze'=>'ezze','elai'=>'elai','emul'=>'emul','eric'=>'eric','ezwa'=>'ezwa','fake'=>'fake','fly-'=>'fly-','fly_'=>'fly_','g-mo'=>'g-mo','g1 u'=>'g1 u','g560'=>'g560','gf-5'=>'gf-5','grun'=>'grun','gene'=>'gene','go.w'=>'go.w','good'=>'good','grad'=>'grad','hcit'=>'hcit','hd-m'=>'hd-m','hd-p'=>'hd-p','hd-t'=>'hd-t','hei-'=>'hei-','hp i'=>'hp i','hpip'=>'hpip','hs-c'=>'hs-c','htc '=>'htc ','htc-'=>'htc-','htca'=>'htca','htcg'=>'htcg','htcp'=>'htcp','htcs'=>'htcs','htct'=>'htct','htc_'=>'htc_','haie'=>'haie','hita'=>'hita','huaw'=>'huaw','hutc'=>'hutc','i-20'=>'i-20','i-go'=>'i-go','i-ma'=>'i-ma','i230'=>'i230','iac'=>'iac','iac-'=>'iac-','iac/'=>'iac/','ig01'=>'ig01','im1k'=>'im1k','inno'=>'inno','iris'=>'iris','jata'=>'jata','java'=>'java','kddi'=>'kddi','kgt'=>'kgt','kgt/'=>'kgt/','kpt '=>'kpt ','kwc-'=>'kwc-','klon'=>'klon','lexi'=>'lexi','lg g'=>'lg g','lg-a'=>'lg-a','lg-b'=>'lg-b','lg-c'=>'lg-c','lg-d'=>'lg-d','lg-f'=>'lg-f','lg-g'=>'lg-g','lg-k'=>'lg-k','lg-l'=>'lg-l','lg-m'=>'lg-m','lg-o'=>'lg-o','lg-p'=>'lg-p','lg-s'=>'lg-s','lg-t'=>'lg-t','lg-u'=>'lg-u','lg-w'=>'lg-w','lg/k'=>'lg/k','lg/l'=>'lg/l','lg/u'=>'lg/u','lg50'=>'lg50','lg54'=>'lg54','lge-'=>'lge-','lge/'=>'lge/','lynx'=>'lynx','leno'=>'leno','m1-w'=>'m1-w','m3ga'=>'m3ga','m50/'=>'m50/','maui'=>'maui','mc01'=>'mc01','mc21'=>'mc21','mcca'=>'mcca','medi'=>'medi','meri'=>'meri','mio8'=>'mio8','mioa'=>'mioa','mo01'=>'mo01','mo02'=>'mo02','mode'=>'mode','modo'=>'modo','mot '=>'mot ','mot-'=>'mot-','mt50'=>'mt50','mtp1'=>'mtp1','mtv '=>'mtv ','mate'=>'mate','maxo'=>'maxo','merc'=>'merc','mits'=>'mits','mobi'=>'mobi','motv'=>'motv','mozz'=>'mozz','n100'=>'n100','n101'=>'n101','n102'=>'n102','n202'=>'n202','n203'=>'n203','n300'=>'n300','n302'=>'n302','n500'=>'n500','n502'=>'n502','n505'=>'n505','n700'=>'n700','n701'=>'n701','n710'=>'n710','nec-'=>'nec-','nem-'=>'nem-','newg'=>'newg','neon'=>'neon','netf'=>'netf','noki'=>'noki','nzph'=>'nzph','o2 x'=>'o2 x','o2-x'=>'o2-x','opwv'=>'opwv','owg1'=>'owg1','opti'=>'opti','oran'=>'oran','p800'=>'p800','pand'=>'pand','pg-1'=>'pg-1','pg-2'=>'pg-2','pg-3'=>'pg-3','pg-6'=>'pg-6','pg-8'=>'pg-8','pg-c'=>'pg-c','pg13'=>'pg13','phil'=>'phil','pn-2'=>'pn-2','pt-g'=>'pt-g','palm'=>'palm','pana'=>'pana','pire'=>'pire','pock'=>'pock','pose'=>'pose','psio'=>'psio','qa-a'=>'qa-a','qc-2'=>'qc-2','qc-3'=>'qc-3','qc-5'=>'qc-5','qc-7'=>'qc-7','qc07'=>'qc07','qc12'=>'qc12','qc21'=>'qc21','qc32'=>'qc32','qc60'=>'qc60','qci-'=>'qci-','qwap'=>'qwap','qtek'=>'qtek','r380'=>'r380','r600'=>'r600','raks'=>'raks','rim9'=>'rim9','rove'=>'rove','s55/'=>'s55/','sage'=>'sage','sams'=>'sams','sc01'=>'sc01','sch-'=>'sch-','scp-'=>'scp-','sdk/'=>'sdk/','se47'=>'se47','sec-'=>'sec-','sec0'=>'sec0','sec1'=>'sec1','semc'=>'semc','sgh-'=>'sgh-','shar'=>'shar','sie-'=>'sie-','sk-0'=>'sk-0','sl45'=>'sl45','slid'=>'slid','smb3'=>'smb3','smt5'=>'smt5','sp01'=>'sp01','sph-'=>'sph-','spv '=>'spv ','spv-'=>'spv-','sy01'=>'sy01','samm'=>'samm','sany'=>'sany','sava'=>'sava','scoo'=>'scoo','send'=>'send','siem'=>'siem','smar'=>'smar','smit'=>'smit','soft'=>'soft','sony'=>'sony','t-mo'=>'t-mo','t218'=>'t218','t250'=>'t250','t600'=>'t600','t610'=>'t610','t618'=>'t618','tcl-'=>'tcl-','tdg-'=>'tdg-','telm'=>'telm','tim-'=>'tim-','ts70'=>'ts70','tsm-'=>'tsm-','tsm3'=>'tsm3','tsm5'=>'tsm5','tx-9'=>'tx-9','tagt'=>'tagt','talk'=>'talk','teli'=>'teli','topl'=>'topl','hiba'=>'hiba','up.b'=>'up.b','upg1'=>'upg1','utst'=>'utst','v400'=>'v400','v750'=>'v750','veri'=>'veri','vk-v'=>'vk-v','vk40'=>'vk40','vk50'=>'vk50','vk52'=>'vk52','vk53'=>'vk53','vm40'=>'vm40','vx98'=>'vx98','virg'=>'virg','vite'=>'vite','voda'=>'voda','vulc'=>'vulc','w3c '=>'w3c ','w3c-'=>'w3c-','wapj'=>'wapj','wapp'=>'wapp','wapu'=>'wapu','wapm'=>'wapm','wig '=>'wig ','wapi'=>'wapi','wapr'=>'wapr','wapv'=>'wapv','wapy'=>'wapy','wapa'=>'wapa','waps'=>'waps','wapt'=>'wapt','winc'=>'winc','winw'=>'winw','wonu'=>'wonu','x700'=>'x700','xda2'=>'xda2','xdag'=>'xdag','yas-'=>'yas-','your'=>'your','zte-'=>'zte-','zeto'=>'zeto','acs-'=>'acs-','alav'=>'alav','alca'=>'alca','amoi'=>'amoi','aste'=>'aste','audi'=>'audi','avan'=>'avan','benq'=>'benq','bird'=>'bird','blac'=>'blac','blaz'=>'blaz','brew'=>'brew','brvw'=>'brvw','bumb'=>'bumb','ccwa'=>'ccwa','cell'=>'cell','cldc'=>'cldc','cmd-'=>'cmd-','dang'=>'dang','doco'=>'doco','eml2'=>'eml2','eric'=>'eric','fetc'=>'fetc','hipt'=>'hipt','http'=>'http','ibro'=>'ibro','idea'=>'idea','ikom'=>'ikom','inno'=>'inno','ipaq'=>'ipaq','jbro'=>'jbro','jemu'=>'jemu','java'=>'java','jigs'=>'jigs','kddi'=>'kddi','keji'=>'keji','kyoc'=>'kyoc','kyok'=>'kyok','leno'=>'leno','lg-c'=>'lg-c','lg-d'=>'lg-d','lg-g'=>'lg-g','lge-'=>'lge-','libw'=>'libw','m-cr'=>'m-cr','maui'=>'maui','maxo'=>'maxo','midp'=>'midp','mits'=>'mits','mmef'=>'mmef','mobi'=>'mobi','mot-'=>'mot-','moto'=>'moto','mwbp'=>'mwbp','mywa'=>'mywa','nec-'=>'nec-','newt'=>'newt','nok6'=>'nok6','noki'=>'noki','o2im'=>'o2im','opwv'=>'opwv','palm'=>'palm','pana'=>'pana','pant'=>'pant','pdxg'=>'pdxg','phil'=>'phil','play'=>'play','pluc'=>'pluc','port'=>'port','prox'=>'prox','qtek'=>'qtek','qwap'=>'qwap','rozo'=>'rozo','sage'=>'sage','sama'=>'sama','sams'=>'sams','sany'=>'sany','sch-'=>'sch-','sec-'=>'sec-','send'=>'send','seri'=>'seri','sgh-'=>'sgh-','shar'=>'shar','sie-'=>'sie-','siem'=>'siem','smal'=>'smal','smar'=>'smar','sony'=>'sony','sph-'=>'sph-','symb'=>'symb','t-mo'=>'t-mo','teli'=>'teli','tim-'=>'tim-','tosh'=>'tosh','treo'=>'treo','tsm-'=>'tsm-','upg1'=>'upg1','upsi'=>'upsi','vk-v'=>'vk-v','voda'=>'voda','vx52'=>'vx52','vx53'=>'vx53','vx60'=>'vx60','vx61'=>'vx61','vx70'=>'vx70','vx80'=>'vx80','vx81'=>'vx81','vx83'=>'vx83','vx85'=>'vx85','wap-'=>'wap-','wapa'=>'wapa','wapi'=>'wapi','wapp'=>'wapp','wapr'=>'wapr','webc'=>'webc','whit'=>'whit','winw'=>'winw','wmlb'=>'wmlb','xda-'=>'xda-',)));
$mobile_browser = true;
$status = 'Mobile Device';
break;
default;
$mobile_browser = false;
$status = 'Desktop / full capability browser';
break;
}
header('Cache-Control: no-transform');
header('Vary: User-Agent, Accept');
if($redirect = ($mobile_browser==true) ? $mobileredirect : $desktopredirect)
{
header('Location: '.$redirect);
exit;
}
else
{
if($mobile_browser=='')
{
return $mobile_browser;
}
else
{
return array($mobile_browser,$status);
}
}
}
function block($total,$page,$num,$url) { //view.php?id='.$id.'
if ($page != 1) $pervpage = ' <a href= "'.$url.'page='. ($page - 1) .'">&lt;&lt;</a> ';
// Проверяем нужны ли стрелки вперед
if ($page != $total) $nextpage = ' <a href="'.$url.'page='. ($page + 1) .'">&gt;&gt;</a>';
if ($page - 4 > 0) $first = '<a href="'.$url.'page=1">1</a>...';
if ($page + 4 <= $total) $last = '...<a href="'.$url.'page='.$total.'">'.$total.'</a>';
// Находим две ближайшие станицы с обоих краев, если они есть
if($page - 2 > 0) $page2left = ' <a href= "'.$url.'page='. ($page - 2) .'">'. ($page - 2) .'</a> ';
if($page - 1 > 0) $page1left = '<a href= "'.$url.'page='. ($page - 1) .'">'. ($page - 1) .'</a> ';
if($page + 2 <= $total) $page2right = ' <a href= "'.$url.'page='. ($page + 2) .'">'. ($page + 2) .'</a>';
if($page + 1 <= $total) $page1right = ' <a href="'.$url.'page='. ($page + 1) .'">'. ($page + 1) .'</a>';
echo '<div class="block">'.$pervpage.$first.$page2left.$page1left.'['.$page.']'.$page1right.$page2right.$last.$nextpage.'</div>';
}
// Функция  обработка тегов в тексте
function tags($text = '') {
$text = preg_replace(array('#\[code\](.*?)\[\/code\]#se'), array("''.highlight_code('$1').''"), str_replace("]\n", "]", $text));
$text = preg_replace('#\[b\](.*?)\[/b\]#si', '<span style="font-weight: bold;">\1</span>', $text);
$text = preg_replace('#\[i\](.*?)\[/i\]#si', '<span style="font-style:italic;">\1</span>', $text);
$text = preg_replace('#\[u\](.*?)\[/u\]#si', '<span style="text-decoration:underline;">\1</span>', $text);
$text = preg_replace('#\[s\](.*?)\[/s\]#si', '<span style="text-decoration: line-through;">\1</span>', $text);
$text = preg_replace('#\[red\](.*?)\[/red\]#si', '<span style="color:red">\1</span>', $text);
$text = preg_replace('#\[green\](.*?)\[/green\]#si', '<span style="color:green">\1</span>', $text);
$text = preg_replace('#\[blue\](.*?)\[/blue\]#si', '<span style="color:blue">\1</span>', $text);
$text = preg_replace('#\[img=(.+?)\]#is', '<br/><center><a href="\1"><img src="\1" alt="" border="0" /></a></center><br/>', $text);
$text = preg_replace('#\[img=(.+?)\[/img\]#is', '<br/><center><a href="\1"><img src="\1" alt="" border="0" /></a></center><br/>', $text);
$text = preg_replace('#\[img\](.+?)\[/img\]#is', '<br/><center><a href="\1"><img src="\1" alt="" border="0" /></a></center><br/>', $text);
$text = preg_replace("#\[url=(.+?)\](.+?)\[/url\]#is", "".("<a href=\"http://\\1\">\\2</a>")."", $text );
return $text;
}
// Функция парсинга ссылки
function url_replace($s) {
if (!isset ($s[3])) {
return '<a href="' . $s[1] . '">' . $s[2] . '</a>';
}
else {
return '<a href="' . $s[3] . '">' . $s[3] . '</a>';
}
$text = str_replace('[img=http://', '[img=', $text);
$text = str_replace('[url=http://', '[url=', $text);
$text = str_replace('[img]http://', '[img]', $text);
return preg_replace_callback('~\\[url=(https?://.+?)\\](.+?)\\[/url\\]|(https?://(www.)?[0-9a-z\.-]+\.[0-9a-z]{2,6}[0-9a-zA-Z/\?\.\~&amp;_=/%-:#]*)~', 'process_url', $text);
}
// Функция смайлов
function smileys($text){
$text = strtr($text, array(
':)'=>'<img src="smileys/1.gif" alt=":)"/>',
':('=>'<img src="smileys/2.gif" alt=":("/>',
':P'=>'<img src="smileys/3.gif" alt=":P"/>',
':D'=>'<img src="smileys/4.gif" alt=":D"/>',
));
return $text;
}
// Преобразование числа в ip
function int2ip($i) {
$d[0]=(int)($i/256/256/256);
$d[1]=(int)(($i-$d[0]*256*256*256)/256/256);
$d[2]=(int)(($i-$d[0]*256*256*256-$d[1]*256*256)/256);
$d[3]=$i-$d[0]*256*256*256-$d[1]*256*256-$d[2]*256;
return "$d[0].$d[1].$d[2].$d[3]";
}
// Преобразование ip в число
function ip2int($ip) {
$a=explode(".",$ip);
return $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
}
function unsign($str) {
$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
$str = preg_replace("/(đ)/", 'd', $str);
$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'o', $str);
$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
$str = preg_replace("/(Đ)/", 'D', $str);
$str = strtolower($str);
$str = str_replace(Array("?", "&amp;", '_', ':', '+', '?', '&quote', '!', '&lt;', '&gt;', '(', ')', '[', ']', '&ldquo;', '&rdquo;', '&sbquo;', '.', ',', '/', '&bdquo;'), '-', $str);
$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
$str = str_replace("----", '-', $str);
$str = str_replace("---", '-', $str);
$str = str_replace("--", '-', $str);
$str = ltrim($str, "-");
$str = rtrim($str, "-");
return $str;
}
// Получаем реальный ip-адрес пользователя
function getip()
{
if (!empty($_SERVER['HTTP_CLIENT_IP']))
{
$ip=$_SERVER['HTTP_CLIENT_IP'];
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
{
$ip=htmlspecialchars($_SERVER['HTTP_X_FORWARDED_FOR']);
}
else
{
$ip=$_SERVER['REMOTE_ADDR'];
}
return $ip;
}
// Подсветка php-кода
function highlight_code($code)
{
$code = strtr($code, array('<br />' => '', '\\' => 'slash'));
$code = html_entity_decode(trim($code), ENT_QUOTES, 'UTF-8');
$code = substr($code, 0, 2) != "<?" ? $code = "" . $code . "" : $code;
$code = stripslashes($code);
$code=highlight_string($code,true);
$code = strtr($code, array('slash' => '&#92;', ':' => '&#58;', '[' => '&#91;'));
return '<div class="code">'.$code.'</div>';
}
// формат файла
function format($name) {
$f1 = strrpos($name, ".");
$f2 = substr($name, $f1 + 1, 999);
$fname = strtolower($f2);
return $fname;
}
// Анонс статьи
function preview_desc ( $str, $length = 100 ) {
if (strstr($str,'[code]')) return '';
$result = substr ( stripslashes( $str ), 0, $length );
while( true ) {
if( $tmp = substr ( stripslashes( $str ), $length, 1 ) ) {
if ( $tmp == ' ' ) break;
$result .= $tmp;
} else break;
$length++;
}
return $result;
}
// Вырезание bb-кодов
function notags($text = '') {
$text = strtr($text, array('[green]' => '', '[/green]' => '', '[red]' => '', '[/red]' => '', '[blue]' => '', '[/blue]' => '', '[b]' => '', '[/b]' => '', '[i]' => '', '[/i]' => '', '[u]' => '', '[/u]' => '', '[s]' => '', '[/s]' => '',
'[code]' => '', '[/code]' => ''));
return $text;
}
function online() {
$on = mysql_result(mysql_query("SELECT COUNT(*) FROM `online`"), 0);
return $on;
}
// Bỏ dấu tiếng việt sử dụng seo url
function bodau($str)
{
$marTViet = array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
"ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề"
,"ế","ệ","ể","ễ",
"ì","í","ị","ỉ","ĩ",
"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ",
"ơ","ờ","ớ","ợ","ở","ỡ",
"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
"ỳ","ý","ỵ","ỷ","ỹ",
"đ",
"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
"Ì","Í","Ị","Ỉ","Ĩ",
"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
,"Ờ","Ớ","Ợ","Ở","Ỡ",
"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
"Đ");
$marKoDau = array("a","a","a","a","a","a","a","a","a","a","a"
,"a","a","a","a","a","a",
"e","e","e","e","e","e","e","e","e","e","e",
"i","i","i","i","i",
"o","o","o","o","o","o","o","o","o","o","o","o"
,"o","o","o","o","o",
"u","u","u","u","u","u","u","u","u","u","u",
"y","y","y","y","y",
"d",
"a","a","a","a","a","a","a","a","a","a","a"
,"a","a","a","a","a","a",
"e","e","e","e","e","e","e","e","e","e","e",
"i","i","i","i","i",
"o","o","o","o","o","o","o","o","o","o","o","o"
,"o","o","o","o","o",
"u","u","u","u","u","u","u","u","u","u","u",
"y","y","y","y","y",
"d");
$str = str_replace('̃','',$str);
$str = str_replace('̣','',$str);
$str = str_replace('̀','',$str);
$str = str_replace('́','',$str);
$str = str_replace('̉','',$str);
$str = str_replace($marTViet,$marKoDau,$str);
$str = str_replace(' ','-',$str);
$str = str_replace('/','-',$str);
$str = str_replace('/','-',$str);
$str = str_replace('-','-',$str);
$str = str_replace('(','-',$str);
$str = str_replace(')','-',$str);
$str = str_replace('*','',$str);
$str = str_replace('%','',$str);
$str = str_replace('^','',$str);
$str = str_replace('$','',$str);
$str = str_replace('#','',$str);
$str = str_replace('@','',$str);
$str = str_replace('!','',$str);
$str = str_replace('~','',$str);
$str = str_replace('`','',$str);
$str = str_replace('__','-',$str);
$str = mb_strtolower($str);
$str = str_replace(':','',$str);
$str = str_replace('"','',$str);
$str = str_replace('?','',$str);
$str = str_replace('!','',$str);
$str = str_replace('.','',$str);
$str = str_replace('&quot;','',$str);
$str = str_replace("'",'',$str);
$str = str_replace(',','',$str);
return $str;
}
function tgs($nametag)
{
$sql=mysql_fetch_row(mysql_query("select name from article where id=$nametag")) or die(mysql_error());
$tags='';
$total_tag=substr_count($sql[0],' ')+1;
if ($total_tag > 0){
for($t=0; $t<$total_tag;
$t++){ $keyword=explode(' ',$sql[0]
);
$tags.='<a href="/search.php?search='.$keyword[$t].'">'.str_replace('-',' ',$keyword[$t]).'</a>';
if($t<$total_tag-1)
$tags.=', ';}
}
return $tags;
}
?>
