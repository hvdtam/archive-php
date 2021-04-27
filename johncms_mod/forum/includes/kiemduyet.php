<?php

defined('_IN_JOHNCMS') or die('Error: restricted access');

if ($rights == 5 || $rights >= 6) {
    if (empty ($_GET['id'])) {
        require_once ("../incfiles/head.php");
        echo "Lỗi!<br/><a href='?'>Quay lại</a><br/>";
        require_once ("../incfiles/end.php");
        exit;
    }
$time = time()+10;
    $req = mysql_query("SELECT COUNT(*) FROM `forum` WHERE `id` = '" . $id . "' AND `type` = 't'");
    if (mysql_result($req, 0) > 0) {
        mysql_query("UPDATE `forum` SET  `kiemduyet` = '" . (isset ($_GET['kiemduyet']) ? '1' : '0') . "', `time` = '" .$time. "', `kiemduyet_who` = '$login' WHERE `id` = '" . $id . "'");
//kiem duyet
		$men = mysql_query("SELECT * FROM `forum` WHERE `id` ='".$id."'");
			if(mysql_num_rows($men)) {
				$okmen = mysql_fetch_array($men);
//				'Xem chủ đề tại link: <a href="/forum/index.php?id='.$rid.'">'.$th.'</a>'
				$msg = 'Chủ đề <a href="/forum/index.php?id='.$id.'">'.$okmen['text'].'</a> đã được <font color="red">' .$login. '</font> kiểm duyệt';
		mysql_query("insert into `privat` values(0,'" . $okmen['from'] . "','".$msg."','" .$time. "','BOT','in','no','Kiểm duyệt bài viết','0','','','','" . mysql_real_escape_string($fname) . "');");
			}
		        header('Location: index.php?id=' . $id);

			   }
			}
    else {
        require_once ("../incfiles/head.php");
        echo '<p>Lỗi diểm duyệt !!<br/><a href="index.php">Quay lại chủ đề</a></p>';
        require_once ("../incfiles/end.php");
        exit;
    }

?>