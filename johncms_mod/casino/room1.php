<?php
define('_IN_JOHNCMS', 1);
session_name("SESID");
session_start();
$headmod = 'naperstki';
$textl = 'Tôm cua cá';
$rootpath = '../';
require_once ("../incfiles/core.php");
require_once ("../incfiles/head.php");

$act = isset($_GET['act']) ? $_GET['act'] : '';
echo '<b> Tôm cua cá</b><br/><br/>';
echo '<b> Room 1</b><br/><br/>';


$rand = mt_rand(100, 999);
$money_plus = "300";
$money_minus = "100";

if (!empty($_SESSION['uid'])) {

    switch ($act) {

        case "choice":
            if (isset($_SESSION['naperstki'])) {
                $_SESSION['naperstki'] = "";
                unset($_SESSION['naperstki']);
            }


            echo '<a href="room1.php?act=go&amp;thimble=1&amp;rand=' . $rand .
                '"><img src="1.gif" alt=""/></a>
				<a href="room1.php?act=go&amp;thimble=2&amp;rand=' . $rand .
                '"><img src="2.gif" alt=""/></a>
				<a href="room1.php?act=go&amp;thimble=3&amp;rand=' . $rand .
                '"><img src="3.gif" alt=""/></a><br/><br/>
				Chọn một một trong ba con<br/>
			Bạn có: ' . $datauser['balans'] . ' VND<br/>
			<br/><a href="room1.php">Quay lại</a>';


            break;
        case "go":


            if ($datauser['balans'] >= $money_minus) {

                if (intval($_SESSION['naperstki']) < "1") {

                    $_SESSION['naperstki']++;

                    $thimble = intval($_GET['thimble']);

                    $rand_thimble = mt_rand(1, 3);


                    if ($rand_thimble == "1") {
                        echo '<img src="4.gif" alt=""/> ';
                    } else {
                        echo '<img src="1.gif" alt=""/> ';
                    }

                    if ($rand_thimble == "2") {
                        echo '<img src="4.gif" alt=""/> ';
                    } else {
                        echo '<img src="2.gif" alt=""/> ';
                    }

                    if ($rand_thimble == "3") {
                        echo '<img src="4.gif" alt=""/>';
                    } else {
                        echo '<img src="3.gif" alt=""/>';
                    }


                    //------------------------------ Win ----------------------------//
                    if ($thimble == $rand_thimble) {

                        //------------------------------ Ghi lại trong hồ sơ của ----------------------------//
                        $money_plus_c = ($datauser['balans'] + $money_plus);
                        mysql_query("update `users` set `balans` ='" . $money_plus_c . "' WHERE `id` = '$user_id'");

                        echo '<br/><b>Bạn đã thắng! Và nhận được ' . $money_plus . ' VND</b><br/>';


                        //------------------------------ Mất ----------------------------//
                    } else {

                        //------------------------------ Ghi lại trong hồ sơ của ----------------------------//
                        $money_minus_с = ($datauser['balans'] - $money_minus);
                        mysql_query("update `users` set `balans`='" . $money_minus_с . "' WHERE `id` = '$user_id'");


                        echo '<br/><b>Bạn đã thua! Và bị trừ ' . $money_minus . ' VND </b><br/>';
                    }


                } else {
                    echo '<b>Bạn phải chọn một trong ba con</b><br/>';
                }


                echo '<br/><b><a href="room1.php?act=choice&amp;rand=' . $rand .
                    '">Tiếp tục chơi</a></b><br/><br/>
					Bạn có: ' . $datauser['balans'] . ' VND<br/>';
                /////////////////////////


            } else {
                echo '<b>Bạn không đủ tiền để chơi.</b><br/>';
            }


            break;
        case "faq":
            echo 'Luật "Chơi"<br/><br/>
Bạn Phải chọn 1 trong 3 con để bắt đầu cuộc chơi<br/>
Nếu bạn chọn đúng bạn sẽ nhận được ' . $money_plus . ' VND<br/><br/>
Nếu bạn chọn sai bạn sẽ bị trừ ' . $money_minus . ' VND<br/>
Chúc may mắn!<br/>
<br/><a href="room1.php">Quay lại</a>';

            break;

        default:

            echo '<img src="itmobi.gif" alt=""/><br/><br/>
<b><a href="room1.php?act=choice">Bắt đầu Chơi</a></b><br/>
<a href="room1.php?act=faq">Trợ giúp</a><br/>
Bạn có: ' . $datauser['balans'] . ' VND<br/>';

            break;
    }


} else {
    echo 'Bạn cần <a href="' . $home . '/login.php">Đăng Nhập</a> mới có thể bắt đầu cuộc chơi.<br/>';
    echo 'Đăng Ký Tại: <a href="' . $home . '/registration.php">Đây</a><br/>';
}

require_once ("../incfiles/end.php");
?>
