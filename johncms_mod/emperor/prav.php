<?php
defined('_IN_JOHNCMS') or die('Error: restricted access');
require_once ("../incfiles/head.php");

$do = isset($_GET['do']) ? trim($_GET['do']) : ''; // Chọn hành động

switch ($do)
{
        ////////////////////////////////////////////////////
        // Купить землю                                   //
        ////////////////////////////////////////////////////
    case "purchase":
        echo "<div class='phdr'>Mua đất</div>";
        //chiếm đất công nhân
        $houses = $ms['houses'] * 50;
        //đất chiếm đóng của lính
        $barracks = $ms['barracks'] * 200;
        //đất chuồng ngựa
        $stables = $ms['stables'] * 100;
        //chiếm đất nhà thờ
        $churches = $ms['churches'] * 200;
        //chiếm đất thư viện
        $libraries = $ms['libraries'] * 100;
        //bảo vệ các tòa nhà chiếm đất
        $tower = $ms['tower'] * 70;
        //chiếm đất tường thành
        $wall = $ms['wall'] * 500;
        //chiếm đất nhà máy
        $mills = $ms['mills'] * 80;

        //chiếm đất
        $earths_busy = $houses + $barracks + $churches + $stables + $libraries + $tower +
            $wall + $mills;
        $earths_not_busy = $ms['earths'] - $earths_busy;

        $gali_buy_lands = floor($ms['pinigai'] / 10);

        if (isset($_POST['submit']))
        {
            $sum = intval($_POST['sum']);
            if ($sum > $gali_buy_lands or $sum < 1)
            {
                echo "Bạn không thể mua nhiều đất đai như thế<br />";
            }
            else
            {
                $earths = $ms['earths'] + $sum;
                $pinigai = $ms['pinigai'] - ($sum * 10);

                mysql_query("UPDATE emperor_users SET 
		earths = '" . $earths . "',
		pinigai = '" . $pinigai . "'
		 WHERE user_id='" . $idus . "';");

                echo "Bạn đã mua " . $sum . "m² đất<br />";
            }
        }
        else
        {
            echo "Số đất của bạn là: " . $ms['earths'] . "m²<br />";
            echo "Đất nông nghiệp: " . $earths_busy . "m²<br />";
            echo "Đất có sẳn: " . $earths_not_busy . "m²<br />";
            echo "-------<br />";
            echo "Giá 1M ² đất: 10 vàng<br />";
            echo "Bạn có: " . $ms['pinigai'] . " vàng<br />";
            echo "Bạn có thể mua: " . $gali_buy_lands . "m²<br />";
            echo "Nhập số đất bạn muốn mua:<br />";
            echo '<form action="game.php?act=prav&amp;do=purchase" method="post">';
            echo "<input type='text' name='sum'/><br/>";
            echo '<input type="submit" name="submit" value="Mua"/><br /><br /></form>';
        }
        echo "---------<br/>";
        echo "<a href='game.php?act=prav'>Quay lại</a><br />";
        break;
        ////////////////////////////////////////////////////
        // Платить Создателю                              //
        ////////////////////////////////////////////////////
    case "pay":

        if ($ms['churches'])
        {
            $auka = ceil($habitants / $ms['churches']);
        }
        else
        {
            $auka = $habitants;
        }
        if (isset($_POST['submit']))
        {
            if ($auka > $ms['pinigai'])
            {
                echo "Bạn không có nhiều tiền<br />";
            }
            else
            {
                $pinigai = $ms['pinigai'] - $auka;
                $time_tax = $realtime + (12 * 60 * 60);

                mysql_query("UPDATE emperor_users SET 
		time_tax = '" . $time_tax . "',
		pinigai = '" . $pinigai . "'
		 WHERE user_id='" . $idus . "';");

                echo "Thuế đã nộp<br />";
            }
        }
        else
        {
            echo "<img src='img/kunigas.gif' alt='+'/><br />";
            echo "Thuế phụ thuộc vào bạn có bao nhiêu nhà thờ, nhà thờ nhiều hơn số thuế sẽ ít hơn!!!<br />";
            echo "Bạn phải nộp: " . $auka . " Vàng.<br />";
            echo "Tăng cấp: " . date("H:i/d.m.Y", $ms['time_tax']) . "<br />";

            echo "(Nếu không nộp thuế, chúng tôi sẽ bắt nhân dân của bạn để làm nô lệ)<br />";
            echo '<form action="game.php?act=prav&amp;do=pay" method="post">';
            echo '<input type="submit" name="submit" value="Nộp"/><br /><br /></form>';
        }
        echo "---------<br/>";
        echo "<a href='game.php?act=prav'>Quay lại</a><br />";
        break;
        ////////////////////////////////////////////////////
        // Обучать воинов на всадников                    //
        ////////////////////////////////////////////////////
    case "teach":
        echo "<div class='phdr'>Tại đây bạn có thể làm ra một Rider chiến binh</div>";
        if (isset($_POST['submit']))
        {
            $sum = intval($_POST['sum']);
            if (($sum > $ms['warriors'] and $sum > $ms['horse']) or $sum < 1)
            {
                echo "Bạn không thể dạy nhiều<br />";
            }
            else
            {
                $warriors = $ms['warriors'] - $sum;
                $horse = $ms['horse'] - $sum;
                $riders = $ms['riders'] + $sum;

                mysql_query("UPDATE emperor_users SET 
		warriors = '" . $warriors . "',
		horse = '" . $horse . "',
		riders = '" . $riders . "'
		 WHERE user_id='" . $idus . "';");

                echo "Bạn dạy " . $sum . " Warriors thành Riders<br />";
            }
        }
        else
        {
            echo "Chiến binh Warriors: " . $ms['warriors'] . "<br />";
            echo "Bạn có số ngựa là: " . $ms['horse'] . "<br />";
            echo "Hầu hết có thể đào tạo: " . ($ms['warriors'] > $ms['horse'] ? $ms['horse'] :
                $ms['warriors']) . "<br />";
            echo "Nhập số binh sĩ bạn muốn giảng dạy:";
            echo '<form action="game.php?act=prav&amp;do=teach" method="post">';
            echo "<input type='text' name='sum'/><br/>";
            echo '<input type="submit" name="submit" value="Dạy"/><br /><br /></form>';

        }
        echo "---------<br/>";
        echo "<a href='game.php?act=prav'>Quay lại</a><br />";
        break;
        ////////////////////////////////////////////////////
        // Главная                                        //
        ////////////////////////////////////////////////////
    default:
        echo "<div class='phdr'>Chính phủ</div>";
        echo "<a href='game.php?act=prav&amp;do=purchase'>Mua đất</a><br/>";
        echo "<a href='game.php?act=prav&amp;do=pay'>Nộp thuế</a><br/>";
        echo "<a href='game.php?act=prav&amp;do=teach'>Đào tạo nâng cấp lính</a><br/>";
}

echo "---------<br/>";
echo "<a href='game.php?'>Trong trò chơi</a><br/>";

?>