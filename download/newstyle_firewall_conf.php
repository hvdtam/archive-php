<?
//Code by Vo Phuoc Tien
//Shared by: Vo Phuoc Tien
//Shared at: NewStyleClan.Com
//KO thanh doi 4 dong chu thich nay neu ban dc share de ton trong tac gia cung nhu ton trong cong suc cua nguoi share ! Thanks !
//---------------------------------------------------------------------------------------------------------------------------------------------------------------




//--Cau hinh firewall--//
$newstyle_fw_conf['max_lockcount']=10;//So lan toi da phat hien dau hieu DDOS va khoa IP do vinh vien 
$newstyle_fw_conf['max_connect']=15;//So ket noi toi da dc gioi han boi $newstyle_fw_conf['time_limit']
$newstyle_fw_conf['time_limit']=3;//Thoi gian dc thuc hien toi da $newstyle_fw_conf['max_connect'] ket noi
$newstyle_fw_conf['time_wait']=20;//Thoi gian cho de dc mo khoa khi IP bi khoa tam thoi
$newstyle_fw_conf['email_admin']='NewStyleClan@Gmail.Com';//Email lien lac voi Admin
$newstyle_fw_conf['htaccess']="../.htaccess";//Duong dan toi file htaccess tren server
//--Ket thuc cau hinh Firewall--//
?>