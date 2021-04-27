<?php
#############################################################
###	S.2.U Application - http://app.s2u.vn				  ###
###	S.2.U Firewall System by Mr.Won		     	  		  ###
###	Phiên bản 2.0 - 01/11/2011		          			  ###
###	Không xóa bản quyền nhé mấy đại ca!!				  ###
#############################################################

#############################################################
###     Chú ý: Nội dung file này không được chỉnh sửa.    ###
#############################################################

////////////////////////////////Int///////////////////////////////
session_start();$time=time();date_default_timezone_set('Asia/Saigon');include_once("s2u.firewall_system.php");
if(empty($_POST['go'])){showHTML("Chào mừng bạn đến với trình cài đặt Hệ thống tường lửa!<br><br>Nhấn nút 'Bắt Đầu' để tiến hành cài đặt.<br><br/><form action='s2u.firewall_install.php' method='post'><input type='hidden' name='go' value=1/><input type='submit' value='Bắt đầu'/></form>",0);}
if($_POST['go']==1){
@chmod('s2u.firewall_logs',0701);
@chmod('s2u.firewall_logs/.htaccess',0404);
@chmod('s2u.firewall_image',0501);
@chmod('s2u.firewall_image/favicon.ico',0404);
@chmod('s2u.firewall_image/page_bg.jpg',0404);
@chmod('s2u.firewall_image/quangcao.png',0404);
@chmod('s2u.firewall_until',0501);
@chmod('s2u.firewall_until/css',0501);
@chmod('s2u.firewall_until/css/styleindex.css',0404);
@chmod('s2u.firewall_until/js',0501);
@chmod('s2u.firewall_until/js/jquery.min.js',0404);
@chmod('s2u.firewall_until/js/script.js',0404);
@chmod('s2u.firewall_until/400.shtml',0404);
@chmod('s2u.firewall_until/401.shtml',0404);
@chmod('s2u.firewall_until/403.shtml',0404);
@chmod('s2u.firewall_until/404.shtml',0404);
@chmod('s2u.firewall_until/500.shtml',0404);
@chmod('s2u.firewall_until/index.html',0404);
@chmod('.htaccess',0604);
@chmod('s2u.firewall_system.php',0404);
@chmod('s2u.firewall_config.php',0604);
@chmod('s2u.firewall_recaptchalib.php',0404);

showHTML("Cài đặt hoàn tất! Bạn hãy bắt đầu cấu hình hệ thống tường lửa cho website :]",0);
}
function chmodFirewall($f,$t){@chmod($f,$t);}
?>
