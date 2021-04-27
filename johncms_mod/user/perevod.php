<?php

define('_IN_JOHNCMS', 1);

$headmod = 'perevod';
$textl = 'Chuyển Xu';
require_once ("../incfiles/core.php");
require_once ("../incfiles/head.php");

switch($act)
{
	default:
	if(empty($_GET['id']))
	{
		echo '<b>Chuyển Xu cho thành viên</b><br/>';
                            echo '<form method="POST" action="perevod.php?act=ok">';
		echo '<div class="gmenu">';
		echo 'Bạn đang có: <b>'.$datauser['balans'].' Xu</b><br/>';
		echo 'Chuyển Xu qua danh sách thành viên:<br/>';
		echo ' 1: <input type="radio"  value="1" name="pos" checked="checked"/>';
		echo '<div class="fmenu">Nếu bạn không nhớ, hãy chọn một nick :<br/>';
		echo '<select name="users">';
		echo '<option value="">Danh sách</option>';
		$sql = mysql_query("select `id`,`name` from `users`");
		while($res = mysql_fetch_array($sql))
		{
			echo '<option value="'.$res['id'].'">'.$res['name'].'</option>';
		}
		echo '</select></div>';
		echo ' 2: <input type="radio"  value="2" name="pos" />';
		echo '<div class="fmenu">Viết số ID hoặc tên Nick<br/><input name="user"/></div>';
		echo 'Số Xu cần chuyển:<br/><input name="bal"/></div>';
		echo '<div class="menu"><input value="Chuyển Xu" type="submit" name="submit"/></div></form>';
	}else{
		$sql = mysql_query("select `id`,`name` from `users` WHERE `id` = '".$id."' LIMIT 1;");
		if(mysql_num_rows($sql)!=="0")
		{
			$user = mysql_fetch_array($sql);
			echo '<form method="POST" action="perevod.php?act=ok&amp;id='.$user['id'].'">';
			echo 'Chuyển Xu cho thành viên <b>'.$user['name'].'</b><br/>';
			echo 'Số Xu chuyển :<br/><input name="bal"/><br/>';
			echo '<input value="Chuyển" type="submit" name="submit"/></form>';
		}
	}
	break;
	case "ok";
	if(empty($_GET['id']))
	{
		if(!empty($_POST['submit']))
		{
			if($_POST['pos'] == "1")
			{
                $user = isset($_POST['users'])?abs(intval($_POST['users'])):false;
			}elseif($_POST['pos'] == "2")
			{
                $user = isset($_POST['user'])?check($_POST['user']):false;
			}
			$ball = isset($_POST['bal'])?abs(intval($_POST['bal'])):false;
			$count = mysql_result(mysql_query("select COUNT(*) from `users` WHERE `id` = '".$user."' or `name` = '".$user."'"),0);
			if($count > 0 )
			{
				$arr = mysql_fetch_array(mysql_query("select `name`,`balans` from `users` WHERE `id` = '".$user."'  or `name` = '".$user."' LIMIT 1"));
				$q = mysql_fetch_array(mysql_query("select `name`,`balans` from `users` WHERE `id` = '".$user_id."' LIMIT 1"));
				if($q['balans'] >= 20)
				{
				 if($arr['name'] !== $q['name'])
				 {
                  if($ball > 1 && $q['balans'] > $ball)
				  {
				$min_bal = intval($q['balans'] - $ball);
				$plus_bal = intval($arr['balans'] + $ball);
				mysql_query("update `users` set `balans` = '".$min_bal."' where `id` = '".$user_id."' LIMIT 1");
				mysql_query("update `users` set `balans` = '".$plus_bal."' where `id` = '".$user."'  or `name` = '".$user."' LIMIT 1");
$botsend = '' . $login . ' đã chuyển '.$ball.' Xu cho '.$arr['name'].' ! :cuoito: ';
            mysql_query("INSERT INTO `forum` SET
                `refid` = '103',
                `type` = 'm' ,
                `time` = '" . time() . "',
                `user_id` = '3',
                `from` = 'BOT',
                `ip` = '00000',
                `ip_via_proxy` = '" . core::$ip_via_proxy . "',
                `soft` = '" . mysql_real_escape_string($agn1) . "',
                `text` = '" . mysql_real_escape_string($botsend) . "'
            ");
            $fadd = mysql_insert_id();
            // Обновляем время топика
            mysql_query("UPDATE `forum` SET
                `time` = '" . time() . "'
                WHERE `id` = '103'
            ");
				$msg = 'Chuyển khoản: <b><a href="/users/profile.php?user=' . $user_id . '">' . $login . '</b></a> đã chuyễn cho bạn '.$ball.' Xu.<br/>Đây là tin nhắn tự động.Chúc bạn 1 ngày vui vẻ cùng vn.mhatinh.com!';
				mysql_query("update `users` set `balans` = '".$min_bal."' where `id` = '".$user_id."' LIMIT 1");
				mysql_query("update `users` set `balans` = '".$plus_bal."' where `id` = '".$user."'  or `name` = '".$user."' LIMIT 1");
				mysql_query("insert into `privat` values(0,'".$arr['name']."','" . $msg . "','" .time(). "','BOT(Máy Chém Tự Động)','in','no','Thông tin về chuyển khoản VND','0','','','','" . mysql_real_escape_string($fname) . "');");

				echo '<p>Chuyển thành công '.$ball.' WNGold cho thành viên '.$arr['name'].'<br/>';
				
                  }else{
                    echo '<p>Không thể chuyển tiền, số Xu của bạn ít hơn số Xu muốn chuyển!</p>';
                  }
				}else{
                    echo '<p>Có lỗi, không thể chuyển tiền!</p>';
				}
				}else{
					echo '<p>Không thể chuyển tiền, số Xu của bạn ít hơn số Xu muốn chuyển!</p>';
				}
			}else{
				echo '<p><b>Sai tên thành viên!</b><br/>';
				echo '<a href="perevod.php?r='.mt_rand(0000,9999).'">Quay lại</a></p>';
				require_once ("../incfiles/end.php");
				exit;
			}
		}else{
            echo '<p><b>Có lỗi!!!</b><br/>';
		    echo '<a href="perevod.php?r='.mt_rand(0000,9999).'">Quay lại</a></p>';
			require_once ("../incfiles/end.php");
			exit;
		}
	}else{
        if(!empty($_POST['submit']))
		{
			$ball = isset($_POST['bal'])?abs(intval($_POST['bal'])):false;
			$count = mysql_result(mysql_query("select COUNT(*) from `users` WHERE `id` = '".$id."'"),0);
			if($count > 0 )
			{
				$arr = mysql_fetch_array(mysql_query("select `name`,`balans` from `users` WHERE `id` = '".$id."' LIMIT 1"));
				$q = mysql_fetch_array(mysql_query("select `name`,`balans` from `users` WHERE `id` = '".$user_id."' LIMIT 1"));
				if($q['balans'] >= 20)
				{
                 if($arr['name'] !== $q['name'])
				 {
				  if($ball > 1 && $q['balans'] > $ball)
				  {
				$min_bal = intval($q['balans'] - $ball);
				$plus_bal = intval($arr['balans'] + $ball);
				mysql_query("update `users` set `balans` = '".$min_bal."' where `id` = '".$user_id."' LIMIT 1");
				mysql_query("update `users` set `balans` = '".$plus_bal."' where `id` = '".$id."' LIMIT 1");
$botsend = '' . $login . ' đã chuyển '.$ball.' Xu cho '.$arr['name'].' ! :cuoito: ';
            mysql_query("INSERT INTO `forum` SET
                `refid` = '103',
                `type` = 'm' ,
                `time` = '" . time() . "',
                `user_id` = '3',
                `from` = 'BOT',
                `ip` = '00000',
                `ip_via_proxy` = '" . core::$ip_via_proxy . "',
                `soft` = '" . mysql_real_escape_string($agn1) . "',
                `text` = '" . mysql_real_escape_string($botsend) . "'
            ");
            $fadd = mysql_insert_id();
            // Обновляем время топика
            mysql_query("UPDATE `forum` SET
                `time` = '" . time() . "'
                WHERE `id` = '103'
            ");
				$msg = 'Chuyển khoản: <b><a href="/users/profile.php?user=' . $user_id . '">' . $login . '</b></a> đã chuyễn cho bạn '.$ball.' Xu.<br/>Đây là tin nhắn tự động.Chúc bạn 1 ngày vui vẻ cùng vn.mhatinh.com!';
				mysql_query("update `users` set `balans` = '".$min_bal."' where `id` = '".$user_id."' LIMIT 1");
				mysql_query("update `users` set `balans` = '".$plus_bal."' where `id` = '".$user."'  or `name` = '".$user."' LIMIT 1");
				mysql_query("insert into `privat` values(0,'".$arr['name']."','" . $msg . "','" .time(). "','BOT(Máy Chém Tự Động)','in','no','Thông tin về chuyển khoản VND','0','','','','" . mysql_real_escape_string($fname) . "');");
				echo '<p>Chuyển thành công  '.$ball.' Xu cho thành viên '.$arr['name'].'<br/>';
				
				  }else{
                    echo '<p>Không thể chuyển tiền, số Xu của bạn ít hơn số Xu muốn chuyển!</p>';
				  }
				 }else{
                    echo '<p>Có lỗi, không thể chuyển tiền!</p>';
				}
				}else{
					echo '<p>Không thể chuyển tiền, số Xu của bạn ít hơn số Xu muốn chuyển!</p>';
				}
			}else{
				echo '<p><b>Sai tên thành viên!</b><br/>';
				echo '<a href="perevod.php?r='.mt_rand(0000,9999).'">Quay lại</a></p>';
				require_once ("../incfiles/end.php");
				exit;
			}
		}else{
            echo '<p><b>Lỗi!!!</b><br/>';
		    echo '<a href="perevod.php?r='.mt_rand(0000,9999).'">Quay lại</a></p>';
			require_once ("../incfiles/end.php");
			exit;
		}
	}
	break;
}

require_once ("../incfiles/end.php");
?>