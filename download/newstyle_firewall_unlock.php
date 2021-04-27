<?
//Code by Vo Phuoc Tien
//Shared by: Vo Phuoc Tien
//Shared at: NewStyleClan.Com
//KO thanh doi 4 dong chu thich nay neu ban dc share de ton trong tac gia cung nhu ton trong cong suc cua nguoi share ! Thanks !
//---------------------------------------------------------------------------------------------------------------------------------------------------------------

include "newstyle_firewall_conf.php";

//--------Function
function xoa($dir) {
    if ( $dirHandle = opendir($dir) ) {
        while ( $file = readdir($dirHandle) ) {
            if ( $file !== "." && $file !== ".." ) {
				if (basename($file)!=".htaccess")
                    @unlink($dir."/".$file);
            }
        }
        closedir($dirHandle);
        return true;
    } else {
        return false;
    }
}


//-----------Unlock
//Bo Cam bang htaccess
$ft=fopen($newstyle_fw_conf['htaccess'],"w");
fclose($ft);
//Bo cam tren Firewall
xoa("newstyle_firewall");