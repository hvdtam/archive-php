<?php
#############################################################
###	S.2.U Application - http://app.s2u.vn				  ###
###	S.2.U Firewall System by Mr.Won		     	  	 	  ###
###	Phiên bản 2.0 - 01/11/2011		          			  ###
###	Không xóa bản quyền nhé mấy đại ca!!		    	  ###
#############################################################

#############################################################
###     Chú ý: Nội dung file này không được chỉnh sửa.    ###
#############################################################

////////////////////////////////Int///////////////////////////////
session_start();$ip=getIP();$time=time();date_default_timezone_set('Asia/Saigon');
if(file_exists("s2u.firewall_config.php")){include_once("s2u.firewall_config.php");include_once('s2u.firewall_recaptchalib.php');if($config['s2u_fw_domain_ref']==''){sendMail("Hệ thống chưa được cấu hình tên miền REF!");}}else{return;}
if($_GET['deny']=='go'&&!file_exists("s2u.firewall_logs/$ip.deny")){unlockIP($ip);return;}
if($_SESSION['captcha']){if(timeEnd($config['s2u_fw_time_captcha'],$_SESSION['timeout'])<=0||$_POST['recaptcha_challenge_field']){unset($_SESSION['captcha']);unset($_SESSION['timeout']);$_SESSION['time']=$time;if(!file_exists("s2u.firewall_logs/$ip.deny")){unlockIP($ip);showHTML("IP của bạn đã được mở khóa!!!",timeEnd(10,$_SESSION['time']),$config['s2u_fw_domain_allow'][0]);return;}else{$resp=recaptcha_check_answer($config['s2u_fw_captcha_private_key'],$_SERVER['REMOTE_ADDR'],$_POST['recaptcha_challenge_field'],$_POST['recaptcha_response_field']);if(!$resp -> is_valid){blockIP($ip);showHTML("Nhập sai! IP của bạn đã bị chặn trong {$config['s2u_fw_time_unlock']} phút.",timeEnd(10,$_SESSION['time']),$config['s2u_fw_domain_allow'][0]);}else{unlockIP($ip);showHTML("IP của bạn đã được mở khóa!!!",timeEnd(10,$_SESSION['time']),$config['s2u_fw_domain_allow'][0]);}return;}}}
if($config['s2u_fw_on_off']==0){return;}unset($_SESSION['time']);
if($config['s2u_fw_time_clear']>0){checkAutoClear();$c=configIP('get','autoClear','');if(!empty($c)){if(($time-$c)/60>=$config['s2u_fw_time_clear']){configIP('add','autoClear',$time);if(deleteAll()){if($config['s2u_fw_send_mail']>=3){sendMail("Đã làm sạch các ip theo dõi! Lúc: ".date("H:i:s-d/m/Y"));}}}}}
if($config['s2u_fw_alert_update']==1){checkAutoConfig();$ver=configIP('get','autoConfig','');$ver=explode("|",$ver);$ver=$ver[2];checkUpdate($ver);}
if($config['s2u_fw_error_report']==0){error_reporting(0);}
if($config['s2u_fw_live']<=0&&$config['s2u_fw_super']==0){autoConfig('s2u_fw_super',1);if($config['s2u_fw_send_mail']>=1){sendMail("Phát hiện dấu hiệu DDoS!!! Hệ thống tường lửa đã chuyển sang chế độ Super anti trong 5 phút! Lúc: ".date("H:i:s-d/m/Y")." Tại: ".fullAddress());}}
if($config['s2u_fw_super']==0&&(($config['s2u_fw_isbot']==1&&isBot()==1)||$ip==$config['s2u_fw_domain'])){return;}
if($config['s2u_fw_htaccess']==''||strpos($config['s2u_fw_htaccess'],'.htaccess')===false){$config['s2u_fw_htaccess']=false;}
if($config['s2u_fw_super']==1&&!$_SESSION['super']){$_SESSION['temp']=1;fireWallTwo();}else{fireWallOne();}
////////////////////////////////FireWall//////////////////////////
function fireWallOne(){global $config,$ip;$now=time();
     if(!is_dir("s2u.firewall_logs")){mkdir("s2u.firewall_logs",0755);}
     if(!file_exists("s2u.firewall_logs/$ip")){configIP('new',$ip,$now);}else
     if(file_exists("s2u.firewall_logs/$ip.deny")){
        if($config['s2u_fw_captcha_public_key']!=''&&$config['s2u_fw_captcha_private_key']!=''){$captcha="<br><center>Nhập mã dưới để bạn tự Unlock IP (Chỉ nhập một lần)<br><br><form method='post' action='s2u.firewall_system.php'>".recaptcha_get_html($config['s2u_fw_captcha_public_key'])."</form>Nhấn Enter để hoàn tất trước khi hết thời gian.</center>";$_SESSION['captcha']=$ip;}
        $gTime=getTime("$ip.deny",$now);setcookie("wait",$config['s2u_fw_time_unlock'] * timeEnd(60,$gTime[1]));
        if(($now-$gTime[1])/60>=$config['s2u_fw_time_unlock']){unlockIP($ip);header("location: ".fullAddress());return;}
		$_SESSION['timeout']=$gTime[1];showHTML("IP của bạn <font color='red'>$ip</font> đã bị khóa truy cập để đảm bảo an toàn<br/>(Do hệ thông phát hiện dấu hiệu Flood nhiều lần từ IP của bạn).<br />Bạn sẽ phải nhập đoạn mã bên dưới để tự mở khóa<br />Nếu không,IP sẽ được mở khóa sau <font color='red'>{$config['s2u_fw_time_unlock']} phút</font>{$captcha}",timeEnd($config['s2u_fw_time_captcha'],$gTime[1]),$config['s2u_fw_domain_allow'][0]);
    }else if(file_exists("s2u.firewall_logs/$ip.lock")){$time=configIP('get',$ip,$now,'.lock');
        if(file_exists("s2u.firewall_logs/$ip.lockcount")){$lockCount=configIP('get',$ip,$now,'.lockcount');}else{$lockCount=1;}
        $wait=(($config['s2u_fw_wait_time']+$lockCount)+$time)-$now;$ref=$_SERVER['HTTP_REFERER'];
        if(!$ref){$ref=$config['s2u_fw_domain_ref'];}
        if(strpos($ref,$config['s2u_fw_domain_ref'])===false){$_SESSION['ref']=0;}else{$_SESSION['ref']=1;}
        if($wait>0){if($_SESSION['ref']==0&&$config['s2u_fw_lock_ref']==1){
                unset($_SESSION['ref']);if($config['s2u_fw_send_mail']>=2){sendMail("Địa chỉ IP: $ip đã bị khóa vĩnh viển bởi Ref từ: $ref Tại: ".fullAddress());}configIP('block',$ip,$now,'.deny');autoConfig('s2u_fw_live',-10);
            }showHTML("IP của bạn đã bị chặn tạm thời do phát hiện sự truy cập bất thường!<br> xin lỗi bạn vì sự bất tiện này.",$wait);
        }else{$_SESSION['temp']=1;fireWallTwo();return;}
    }else{anti();}}
function anti(){global $config,$ip;$now=time();
    if(!file_exists("s2u.firewall_logs/$ip")){configIP('new',$ip,$now);}$gTime=getTime($ip,$now);
    if($gTime[0]>=$config['s2u_fw_penalty_allow']&&($now-$gTime[1])<=1){configIP('set',$ip,$now,'.lock');
        if(file_exists("s2u.firewall_logs/$ip.lockcount")){$lockCount=configIP('get',$ip,$now,'.lockcount');}else{$lockCount=0;}
        if($lockCount>=$config['s2u_fw_max_lockcount']){configIP('block',$ip,$now,'.deny');autoConfig('s2u_fw_live',-10);}
        else{$_SESSION['temp']=1;$_SESSION['super']=1;configIP('skip',$ip,$now);
            if(file_exists("s2u.firewall_logs/$ip.lockcount")){$c=configIP('get',$ip,$now,'.lockcount');}else{$c=1;}
            configIP('add',$ip,'','.lockcount',$c);showHTML("IP của bạn đã bị chặn tạm thời!",1);}
    }else if($gTime[0]<$config['s2u_fw_penalty_allow']&&($now-$gTime[1])>=1){configIP('skip',$ip,$now);if($_GET['s2u_accepted_redirect']){header("location: ".$_GET['s2u_accepted_redirect']);}}else{configIP('add',$ip,$now,'',$gTime[0]);}}
function fireWallTwo(){
    global $config,$ip;$destination_ready=$_GET['s2u_accepted_redirect'];
    if(!empty($destination_ready)&&!empty($_SESSION['temp'])){$domainAllowed=0;
        foreach($config['s2u_fw_domain_allow'] as $Domain){if(strpos($_SERVER['HTTP_REFERER'],$Domain)!==false){$domainAllowed++;}}
        if($domainAllowed>0){unset($_SESSION['temp']);$_SESSION['super']=1;configIP('reset',$ip,'','.lock');configIP('reset',$ip,'','.lockcount');unset($_SESSION['autoConfig']);header("location: ".$destination_ready);}}
    if($config['s2u_fw_two_layer']==1){anti();}
    if($config['s2u_fw_super']==1){$gTime=getTime('autoConfig','');
        if((time()-$gTime[1])/60>=$config['s2u_fw_time_super']){
            if($config['s2u_fw_send_mail']>=1){sendMail("Website đã trở lại bình thường! Lúc: ".date("H:i:s-d/m/Y"));}
			unset($_SESSION['super']);configIP('add','autoConfig',time(),'',$gTime[0]);autoConfig('s2u_fw_super',0);autoConfig('s2u_fw_live',$gTime[0]);}}
     if(!empty($_SESSION['super'])&&empty($_SESSION['autoConfig'])){$_SESSION['autoConfig']=1;autoConfig('s2u_fw_live',-5);
        if($config['s2u_fw_send_mail']>=3){sendMail("Địa chỉ IP: $ip đã bị khóa tạm thời lúc: ".date("H:i:s-d/m/Y")."  Tại: ".fullAddress());}
    }$img=getBanner();$clickBG="Nhấp vào hình để tiếp tục<br><center><form name='s2u_accepted' method='get' action='s2u.firewall_system.php'><input type='hidden' value='{$_SERVER['REQUEST_URI']}' name='s2u_accepted_redirect'><input type='submit' onclick='popup(\"{$img[3]}\");' value=' ' style='background-image:url({$img[0]});width:{$img[1]};height:{$img[2]};cursor:pointer;border-width:0px;'></form></center>";showHTML($clickBG,0);}
////////////////////////////////Until///////////////////////////////
function getBanner(){$url=base64_decode('aHR0cDovL2FwcC5zMnUudm4vYmFubmVyLnBocA==');$con=explode("|",getUrl($url));return array($con[0],$con[1],$con[2],$con[3]);}
function configIP($type,$ip,$now,$ext='',$c=1){
    $chm=false;$t='w';$set=false;
    switch($type){case'new':$chm=true;break;case'get':$t='gt';break;case'skip':break;case'reset':@unlink("s2u.firewall_logs/".$ip.$ext);$ext='';break;case'add':$chm=true;$c++;break;case'set':$chm=true;$set=true;break;case'block':$chm=true;break;}
    if($t=='gt'){$ft=file_get_contents("s2u.firewall_logs/".$ip.$ext);return $ft;
    }else{$ft=@fopen("s2u.firewall_logs/".$ip.$ext,$t);
        if(!$ft){if($config['s2u_fw_send_mail']>=1){sendMail("Có lỗi khi ghi quá trình hoạt động của IP,firewall bị vô hiệu! Tại: ".fullAddress());}return;}}
    if($chm){chmod("s2u.firewall_logs/".$ip.$ext,0666);}
    if($ip=='autoConfig'){fwrite($ft,"$c|$now");
    }elseif($ip=='autoClear'){fwrite($ft,$now);
    }else{if($set){fwrite($ft,$now);}else{if($now==''){fwrite($ft,$c);}else{fwrite($ft,"$c|$now");}}}
    fclose($ft);}
function autoConfig($n,$v){global $config;$content=file_get_contents("s2u.firewall_config.php");$get=explode("\$config['$n']=",$content);$get=explode(";",$get[1]);$vo=trim($get[0]);	
    if($v<0){$v=$vo+($v);if($v<0){$v=0;}}
    if($vo<0){checkAutoConfig();$gTime=getTime('autoConfig','');configIP('add','autoConfig',time().'|2.0','',$gTime[0]);}
    $new=str_replace("\$config['$n']=$vo;","\$config['$n']=$v;",$content);
    if($new!=$content){$ft=fopen("s2u.firewall_config.php","w");fwrite($ft,$new);fclose($ft);}}
function isBot(){$botlist=array("Teoma","alexa","froogle","Gigabot","inktomi","looksmart","URL_Spider_SQL","Firefly","NationalDirectory","Ask Jeeves","TECNOSEEK","InfoSeek","WebFindBot","girafabot","crawler","www.galaxy.com","Googlebot","Scooter","Slurp","msnbot","appie","FAST","WebBug","Spade","ZyBorg","rabaz","Baiduspider","Feedfetcher-Google","TechnoratiSnoop","Rankivabot","Mediapartners-Google","Sogou web spider","WebAlta Crawler","TweetmemeBot","Butterfly","Twitturls","Me.dium","Twiceler");foreach($botlist as $bot){if(strpos($_SERVER['HTTP_USER_AGENT'],$bot)!==false){return 1;}}}
function getIP(){if(!empty($_SERVER['HTTP_CLIENT_IP'])){$ip=$_SERVER['HTTP_CLIENT_IP'];}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];}else{$ip=$_SERVER['REMOTE_ADDR'];}if(!preg_match("/^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/",$ip)){showHTML("Sự truy cập của bạn bị cấm vì IP của bạn ko hợp lệ.");}return $ip;}
function showHTML($msg,$time=10,$url=''){echo "<html><head><meta http-equiv='Content-Type' content='text/html;charset=utf-8'><title>[ S.2.U Firewall System-Hệ thống tường lửa ]</title><link rel='shortcut icon' href='/../s2u.firewall_until/favicon.ico'><link href='/../s2u.firewall_until/css/styleindex.css' rel='stylesheet' type='text/css'><script src='/../s2u.firewall_until/js/jquery.min.js'></script><script src='/../s2u.firewall_until/js/script.js'></script></head><body style='width:900;'><p class='bro'><span class='b'>S</span>.<span class='r'>2</span>.<span class='o'>U</span> <span class='b'>Firewall</span> System</p><div class='contentSection'><div class='status'>[ Hệ thống tường lửa ]</div><div class='line'></div><div class='alert'><p>{$msg}</p></div><br>";if($time!=0){if($url==''){$url=fullAddress();}echo "<div class='ref'><input type='hidden' id='url' value='$url'><span id='container'>{$time}</span></div>";}echo "</div></body></html>";exit;}
function getTime($con,$now){$c=configIP('get',$con,$now);$s2u=explode("|",$c);return $s2u;}
function blockIP($ip){global $config;$ht=$config['s2u_fw_htaccess'];
    if($ht==false||!file_exists($ht)){return;}
    $htd=file_get_contents($ht);$ft=fopen($ht,"a");
    if(strpos($htd,$ip)===false){
        if(preg_match("/^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/",$ip)){
            fwrite($ft,"\ndeny from $ip");if($config['s2u_fw_send_mail']>=2){sendMail("Địa chỉ IP: $ip đã bị khóa vĩnh viển lúc ".date("H:i:s-d/m/Y").". Tại: ".fullAddress());}
        }}fclose($ft);}
function unlockIP($ip){global $config;$ht=$config['s2u_fw_htaccess'];
    if($ht==false||!file_exists($ht)){return;}
    $htd=file_get_contents($ht);
    if(strpos($htd,$ip)!==false){$new=str_replace("\ndeny from $ip","",$htd);$ft=fopen($ht,"w");fwrite($ft,$new);fclose($ft);
        if($config['s2u_fw_send_mail']>=2){sendMail("Địa chỉ IP: $ip đã được mở khóa lúc ".date("H:i:s-d/m/Y"));}
    }configIP('reset',$ip,'','.lock');configIP('reset',$ip,'','.lockcount');configIP('reset',$ip,'','.deny');}
function sendMail($msg){global $config;$mail=$config['s2u_fw_email_admin'];@mail($mail,'Thông báo của Hệ thống tường lửa S.2.U !!!',$msg);}
function checkUpdate($v){$url="http://app.s2u.vn/checkupdate.php?ver=$v&ref=".$_SERVER['HTTP_ORIGIN'];if(@file_get_contents($url)){$con=file_get_contents($url);}else{$con=getUrl($url);};if($con!=0&&$con!=''){$con=explode("|",$con);$ver=$con[0];$url=$con[1];sendMail("S.2.U Firewall System đã có phiên bản mới! Phiên bản: $ver,Tải và xem hướng dẫn ở: $url");$time=configIP('get','autoConfig','');$s2u=explode("|",$time);$limit=$s2u[0];configIP('add','autoConfig',time()."|$ver",'',$limit);}}
function fullAddress(){$adr=(isset($_SERVER['HTTPS'])&&$_SERVER['HTTPS']!='off')?'https://':'http://';$adr.=isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:getenv('HTTP_HOST');$adr.=isset($_SERVER['REQUEST_URI'])?$_SERVER['REQUEST_URI']:getenv('REQUEST_URI');return $adr;}
function getUrl($url){$ch=curl_init();curl_setopt($ch,CURLOPT_URL,$url);curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,2);$data=curl_exec($ch);curl_close($ch);return $data;}
function timeEnd($t1,$t2){return $t1-(time()-$t2);}
function checkAutoConfig(){global $config;if(!file_exists("s2u.firewall_logs/autoConfig")){configIP('new','autoConfig',time().'|2.0','',$config['s2u_fw_live']);}}
function checkAutoClear(){if(!file_exists("s2u.firewall_logs/autoClear")){configIP('new','autoClear',time());}}
function deleteAll($directory='s2u.firewall_logs'){if(substr($directory,-1)=="/"){$directory=substr($directory,0,-1);}
    if(!file_exists($directory)||!is_dir($directory)){return false;}elseif(!is_readable($directory)){return false;
    }else{$directoryHandle=opendir($directory);
        while($contents=readdir($directoryHandle)){
            if($contents!='.'&&$contents!='..'&&$contents!='autoConfig'&&$contents!='.htaccess'&&$contents!='autoClear'&&strpos($contents,'.deny')===false&&strpos($contents,'.lock')===false&&strpos($contents,'.lockcount')===false){$path=$directory."/".$contents;if(is_dir($path)){deleteAll($path);}else{unlink($path);}}}
        closedir($directoryHandle);return true;}}
?>