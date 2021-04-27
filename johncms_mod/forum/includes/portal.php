<?php

defined('_IN_JOHNCMS') or die('Error: restricted access');

if ($rights >= 8) {

    if (empty ($_GET['id'])) {
        require_once ("../incfiles/head.php");
        echo "Bạn không có quyền truy cập vào đây!
		<br/><a href='?'>Quay lại</a><br/>";
        require_once ("../incfiles/end.php");
        exit;
    }
}

if(isset($_GET['portal'])){
    $req = mysql_query("SELECT COUNT(*) FROM `forum` WHERE `id` = '" . $id . "' AND `type` = 't'");
    if (mysql_result($req, 0) > 0) {
		$mrhoang = mysql_fetch_assoc(mysql_query("SELECT MAX(portal) FROM `forum`;"));
        mysql_query("UPDATE `forum` SET  `portal` = '".($mrhoang["MAX(portal)"]+1)."' WHERE `id` = '" . $id . "'");
		 
		        header('Location: index.php?id=' . $id);
	          }
			   
			
    else {
        require_once ("../incfiles/head.php");
        echo '<p>ERROR!<br/><a href="index.php">Trở về</a></p>';
        require_once ("../incfiles/end.php");
        exit;
    }
}
elseif(isset($_GET['khoiphuc'])){
	$req = mysql_query("SELECT COUNT(*) FROM `forum` WHERE `id` = '" . $id . "' AND `type` = 't'");
    if (mysql_result($req, 0) > 0) {
		
        mysql_query("UPDATE `forum` SET  `portal` = '0' WHERE `id` = '" . $id . "'");
		 
		        header('Location: index.php?id=' . $id);
	          }
			   
			
    else {
        require_once ("../incfiles/head.php");
        echo '<p>ERROR!<br/><a href="index.php">Trở về</a></p>';
        require_once ("../incfiles/end.php");
        exit;
    }
}
?>