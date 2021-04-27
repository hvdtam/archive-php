<?php

function seo($link){
$a_str = array("ă", "ắ", "ằ", "ẳ", "ẵ", "ặ", "á", "à", "ả", "ã", "ạ", "â", "ấ", "ầ", "ẩ", "ẫ", "ậ", "Á", "À", "Ả", "Ã", "Ạ", "Ă", "Ắ", "Ằ", "Ẳ", "Ẵ", "Ặ", "Â", "Ấ", "Ầ", "Ẩ", "Ẫ", "Ậ" );
$e_str = array("é","è","ẻ","ẽ","ẹ","ê","ế","ề","ể","ễ","ệ","É","È","Ẻ","Ẽ","Ẹ","Ê","Ế","Ề","Ể","Ễ","Ệ");
$d_str = array("đ","Đ");
$o_str = array("ó","ò","ỏ","õ","ọ","ô","ố","ồ","ổ","ỗ","ộ","ơ","ớ","ờ","ở","ỡ","ợ","Ó","Ò","Ỏ","Õ","Ọ","Ô","Ố","Ồ","Ổ","Ỗ","Ộ","Ơ","Ớ","Ờ","Ở","Ỡ","Ợ");
$u_str = array("ú","ù","ủ","ũ","ụ","ư","ứ","ừ","ữ","ử","ự","Ú","Ù","Ủ","Ũ","Ụ","Ư","Ứ","Ừ","Ử","Ữ","Ự");
$i_str = array("í","ì","ỉ","ị","ĩ","Í","Ì","Ỉ","Ị","Ĩ");
$y_str = array("ý","ỳ","ỷ","ỵ","ỹ","Ý","Ỳ","Ỷ","Ỵ","Ỹ");
$da_str = array("́","̀","̉","̃","̣");
$link = str_replace($i_str,"i",$link);
$link = str_replace($da_str,"",$link);
$link = str_replace($y_str,"y",$link);
$link = str_replace($a_str,"a",$link);
$link = str_replace($e_str,"e",$link);
$link = str_replace($d_str,"d",$link);
$link = str_replace($o_str,"o",$link);
$link = str_replace($u_str,"u",$link);

$link=strtolower($link);
$link=preg_replace('/[^a-z0-9]/',' ',$link);
$link=preg_replace('/\s\s+/',' ',$link);
$link=trim($link);
$link=str_replace(' ','-',$link);
return $link;
}

?>