<?
#############################################################
###	S.2.U Application - http://app.s2u.vn				  ###
###	S.2.U Firewall System by Mr.Won		     	  		  ###
###	Phiên bản 2.0 - 01/11/2011		          			  ###
###	Không xóa bản quyền nhé mấy đại ca!!				  ###
#############################################################

####################### Config chuẩn ########################
### config['s2u_fw_on_off']=1; 	                    	  ###
### config['s2u_fw_two_layer']=1;						  ###
### config['s2u_fw_lock_ref']=1;					      ###
### config['s2u_fw_super']=0;						      ###
### config['s2u_fw_time_super']=5;						  ###
### config['s2u_fw_live']=100;   	 				 	  ###
### config['s2u_fw_isbot']=1;							  ###
### config['s2u_fw_wait_time']=10;						  ###
### config['s2u_fw_penalty_allow']=5;					  ###
### config['s2u_fw_max_lockcount']=3;					  ###
### config['s2u_fw_error_report']=1;					  ###
### config['s2u_fw_time_captcha']=30;					  ###
### config['s2u_fw_time_unlock']=60;					  ###
### config['s2u_fw_time_clear']=1440;					  ###
### config['s2u_fw_alert_update']=1; 	 			      ###
### config['s2u_fw_send_mail']=3; 	 			  	      ###
### config['s2u_fw_htaccess']=".htaccess";				  ###
#############################################################

#############################################################
### Chú ý: Luôn lưu config dưới dạng UTF-8 without BOM    ###
#############################################################

//Bật/tắt S.2.U Firewall System.
$config['s2u_fw_on_off']=1; //-> 0 tắt, 1 bật.

//Anti 2 lớp, 1 để bật, 0 để bỏ.
$config['s2u_fw_two_layer']=1; //-> Nếu bật thì vẫn chống ddos và block ip, tắt thì chỉ chờ click xác nhận.

//Bật/tắt chức năng chặn gói ref từ web khác.
$config['s2u_fw_lock_ref']=1; //-> 0 tắt, 1 bật.

//Tự động chuyển chế độ chặn ngay từ đầu khi phát hiện ddos, 1 để bật, 0 để bỏ.
$config['s2u_fw_super']=0; //-> Khi bị ddos thì nó sẽ tự kích hoạt tính năng này.

//Thời gian hoạt động của chế độ Anti Super.
$config['s2u_fw_time_super']=5; //-> Tính theo phút.

//Số điểm website tồn tại trong 60s. Giúp phát hiện tình trạng website bị ddos nặng và bật chế độ bảo trì hoặc super.
$config['s2u_fw_live']=100; //-> 1 IP bị chặn -5, bị khóa vĩnh viển -15 ~ 20ip chặn hoặc 6ip bị khóa trong 60s.

//Cho phép firewall bỏ wa BOT, 0 tắt, 1 bật.
$config['s2u_fw_isbot']=1; //-> Trung bình tốc độ của bot ~2lần/1s.

//Thời gian chờ khi thông báo phát hiện ddos.
$config['s2u_fw_wait_time']=10; //-> Càng ít càng gắt với ddos và nhẹ với người bình thường.

//Số lần kết nối cho phép trong khoản thời gian nhất định ([s2u_fw_penalty_allow]/s)
$config['s2u_fw_penalty_allow']=5; //-> Càng ít càng gắt.

//Giới hạn số lần bị khóa IP tạm thời sang khóa IP vĩnh viễn.
$config['s2u_fw_max_lockcount']=3; //-> Càng ít càng gắt.

//Hiện thông báo lỗi của firewall. 0 tắt, 1 bật.
$config['s2u_fw_error_report']=1; //-> Nên bật để báo lỗi firewall.

//Thời gian chờ nhập captcha và thông báo IP bị khóa vĩnh viển.
$config['s2u_fw_time_captcha']=30; //-> Tính theo giây.

//Thời gian ip bị block bằng .htaccess được mở khóa.
$config['s2u_fw_time_unlock']=60; //-> Tính theo phút.

//Khoãng thời gian làm sạch folder s2u.firewall_logs. 0 tắt.
$config['s2u_fw_time_clear']=1440; //-> Tính theo phút.

//Tự động thông báo phiên bản mới của firewall.
$config['s2u_fw_alert_update']=1; //-> 0 tắt, 1 thông báo qua email.

//Bật tắt tính năng gửi mail thông báo.
$config['s2u_fw_send_mail']=3; //-> 0 tắt, 1 thông báo Web bị ddos, 2 +thông báo ip bị khóa vĩnh viễn, 3 +thông báo ip bị khóa tạm thời.

//File .htaccess trên web để khóa ip vĩnh viển và bảo trì ảo.
$config['s2u_fw_htaccess']='.htaccess'; //-> Nếu để trống thì chức năng này bị tắt.

//Mã PublicKey khi đăng kí ở http://www.google.com/recaptcha. Để trống tương đương với không dùng tính năng tự unlock bằng captcha. 
$config['s2u_fw_captcha_public_key']='';

//Mã PrivateKey khi đăng kí ở http://www.google.com/recaptcha. Để trống tương đương với không dùng tính năng tự unlock bằng captcha. 
$config['s2u_fw_captcha_private_key']='';

//Email để thông báo cho người bị khóa liên hệ.
$config['s2u_fw_email_admin']='';

//Địa chỉ tên miền để xác nhận Ref
$config['s2u_fw_domain_ref']='';

//Những tên miền được phép truy cấp, ko có /
$config['s2u_fw_domain_allow']=array(
	'http://',
	'http://www.'
);
?>