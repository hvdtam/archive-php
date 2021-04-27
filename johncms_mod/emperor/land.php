<?php
defined('_IN_JOHNCMS') or die('Error: restricted access');
require_once ("../incfiles/head.php");

$do = isset($_GET['do']) ? trim($_GET['do']) : ''; //Chọn hành động

switch ($do)
{
        ////////////////////////////////////////////////////
        // Мельницы                                       //
        ////////////////////////////////////////////////////
    case "mills":
        echo "<div class='phdr'>Xay lúa</div>";

        $galima = $ms['mills'] * 100;

        if (isset($_POST['submit']))
        {
            $sum = intval($_POST['sum']);
            if ($sum > $galima or $sum < 1)
            {
                echo "Bạn không thể xay lúa mạch nhiều như thế<br />";
            }
            else
            {
                $meal = $ms['meal'] + ($sum * 3);
                $rye = $ms['rye'] - $sum;
                $time_grades = $realtime + 600;

                mysql_query("UPDATE emperor_users SET 
		meal = '" . $meal . "',
		rye = '" . $rye . "',
		time_grades = '" . $time_grades . "'
		 WHERE user_id='" . $idus . "';");

                echo "Bạn có lúa mạch đen<br/>";
                echo "Đối với nguồn cung cấp thực phẩm cho: +<b>" . ceil($sum * 3) . "</b><br/>";
            }
        }
        else
        {
            echo "Số lúa mạch đencủa bạn là: " . $ms['rye'] . "<br />";
            echo "Xay lúa: " . $ms['mills'] . "<br />";
            echo "Bạn có thể xay được: <b>" . $galima . "</b>kg Lúa mạch đen<br/>";
            echo "---------<br />";

            if ($ms['time_sowing'])
            {
                echo "Bạn không thể xay cho đến khi bạn đả thu hoạch lúa mạch đen<br />";
            }
            else
            {
                if ($ms['time_grades'] > $realtime)
                {
                    echo "Không có gió, bạn không thể xay lúa mạch đen<br />";
                }
                else
                {
                    echo "Gió đả mạnh. Bạn có thể xay lúa mạch đen<br />";
                    echo "Bạn muốn xay bao nhiu lúa:<br/>";
                    echo '<form action="game.php?act=land&amp;do=mills" method="post">';
                    echo "<input type='text' name='sum'/><br/>";
                    echo '<input type="submit" name="submit" value="Xay"/><br /><br /></form>';
                }
            }
        }
        echo "---------<br />";
        echo "<a href='game.php?act=land'>Quay lại</a><br />";
        break;
        ////////////////////////////////////////////////////
        // Приготовить землю                              //
        ////////////////////////////////////////////////////
    case "earth":
        $worker = $ms['workers'] * 2;

        if (isset($_POST['submit']))
        {
            $sum = intval($_POST['sum']);
            if ($sum > $worker or $sum < 1)
            {
                echo "Bạn không thể xử lý như vậy<br />";
            }
            else
                if ($ms['time_sowing'])
                {
                    echo "Bạn không thể xử lý mặt đất như thế cho đến khi bạn đả thu hoạch<br />";
                }
                else
                {
                    $dirva = $ms['dirva'] + $sum;

                    mysql_query("UPDATE emperor_users SET 
		dirva = '" . $dirva . "'
		 WHERE user_id='" . $idus . "';");

                    echo "Công việc của bạn được sản xuất <b>" . $sum . "</b>m&#178; đất để gieo trồng<br />";
                }
        }
        else
        {
            //занято земли рабочими
            $houses = $ms['houses'] * 50;
            //занято земли воинами
            $barracks = $ms['barracks'] * 200;
            //занято земли конюшнами
            $stables = $ms['stables'] * 100;
            //занято земли церквями
            $churches = $ms['churches'] * 200;
            //занято земли библиотеками
            $libraries = $ms['libraries'] * 100;
            //занято земли Защитными зданиями
            $tower = $ms['tower'] * 70;
            //занято земли стеной
            $wall = $ms['wall'] * 500;
            //занято земли мельницами
            $mills = $ms['mills'] * 80;

            //занято земли
            $earths_busy = $houses + $barracks + $churches + $stables + $libraries + $tower +
                $wall + $mills;
            $earths_not_busy = $ms['earths'] - $earths_busy;

            echo "<div class='phdr'><b>Xới đất</b></div>";
            echo "Đất của bạn: " . $ms['earths'] . "m²<br />";
            echo "Đất chiếm đóng: " . $earths_busy . "m²<br />";
            echo "Đất có sẳn: " . $earths_not_busy . "m²<br />";
            echo "---------<br />";
            echo "Đất nông nghiệp: " . $ms['dirva'] . "m²<br />";
            echo "Bạn làm việc: " . $ms['workers'] . "<br />";
            echo "Công nhân đả xử lý được" . $worker . "m² Đất đai<br />";
            if (! $ms['time_sowing'])
            {
                echo "Chọn số đất cần xới để gieo trồng:<br />";

                echo '<form action="game.php?act=land&amp;do=earth" method="post">';
                echo "<input type='text' name='sum'/><br/>";
                echo '<input type="submit" name="submit" value="Xới đất"/><br /><br /></form>';
            }
            else
            {
                echo "Bạn không thể xử lý mặt đất cho đến khi bạn đả thu hoạch<br />";
            }
        }

        echo "---------<br/>";
        echo "<a href='game.php?act=land'>Quay lại</a><br />";
        break;
        ////////////////////////////////////////////////////
        // Земледелие                                     //
        ////////////////////////////////////////////////////
    case "agriculture":
        echo "<div class='phdr'>Nông nghiệp</div>";

        $telpa_rugiu = $ms['dirva'] * 10;
        if ($telpa_rugiu > $ms['rye'])
        {
            $telpa_rugiu = $ms['rye'];
        }
        $reik_darb = floor($telpa_rugiu / 2);
        $reik_darb_pjov = $telpa_rugiu;

        if (isset($_POST['submit']))
        {
            //Посев
            if (! $ms['time_sowing'])
            {
                if ($telpa_rugiu < 1)
                {
                    echo "Bạn không có nhiều giống để gieo<br />";
                }
                else
                    if ($reik_darb > $ms['workers'])
                    {
                        echo "Đủ công nhân<br />";
                    }
                    else
                    {
                        $time_sowing = $realtime + 600;

                        mysql_query("UPDATE emperor_users SET 
		time_sowing = '" . $time_sowing . "'
		 WHERE user_id='" . $idus . "';");

                        echo "Gieo lúa mạch đen<br />";
                    }
            }
            else //Косим

                if ($ms['time_sowing'] < $realtime)
                {
                    if ($reik_darb_pjov > $ms['workers'])
                    {
                        echo "Đủ công nhân<br />";
                    }
                    else
                    {
                        $max = $telpa_rugiu * 3;
                        $pripjauna = mt_rand(1, $max);
                        $rye = $ms['rye'] + $pripjauna;

                        mysql_query("UPDATE emperor_users SET 
						time_sowing = '',
						rye='" . $rye . "'
						WHERE user_id='" . $idus . "';");

                        echo "Bạn mowed các mạch đen! cổ phiếu bổ sung của họ tại: +<b>" . $pripjauna .
                            "</b>кг.<br/>";
                    }
                }
                else
                {
                    echo " <b>Chờ cho đến khi phát triển lúa mạch đen</b><br />";
                }
        }
        else
        {
            echo "Lúa mạch đen của bạn: " . $ms['rye'] . "<br />";
            echo "Diện tích: " . $ms['dirva'] . "m²<br />";
            echo "Công nhân: " . $ms['workers'] . "<br />";
            echo "Số lúa mạch đen bạn có thể gieo: " . $telpa_rugiu . "<br />";
            echo "Số công nhân có thể gieo giống: " . $reik_darb . " công nhân<br />";
            echo "Đối với nghề trồng lúa bạn có: " . $reik_darb_pjov . " công nhân<br />";
            echo "Lúa mạch đen của bạn:";

            if (! $ms['time_sowing'])
            {
                echo " <b>Không gieo</b><br />";
                echo "---------<br />";
                echo '<form action="game.php?act=land&amp;do=agriculture" method="post">';
                echo '<input type="submit" name="submit" value="Gieo giống"/><br /><br /></form>';

            } elseif ($ms['time_sowing'] > $realtime)
            {
                echo " <b>Gieo và phát triển</b><br />";
            }
            else
            {
                echo " <b>Gieo hột</b><br />";
                echo '<form action="game.php?act=land&amp;do=agriculture" method="post">';
                echo '<input type="submit" name="submit" value="Biu môi"/><br /><br /></form>';
            }
        }
        echo "---------<br />";
        echo "<a href='game.php?act=land'>Quay lại</a><br />";
        break;
        ////////////////////////////////////////////////////
        // Информация                                     //
        ////////////////////////////////////////////////////
    case "info":
        echo "<div class='phdr'>Thông tin</div>";
        echo "<b>Nông nghiệp</b><br />";
        echo "Với nông nghiệp, bạn có thể bổ sung nguồn cung cấp từ đất để chế biến thực phẩm!<br />";
        echo "<b>Xay lúa mạch</b><br />";
        echo "Trong các nhà máy có thể xay lúa mạch đen<br />";
        echo "---------<br/>";
        echo "<a href='game.php?act=land'>Quay lại</a><br />";
        break;
        ////////////////////////////////////////////////////
        // Главная                                        //
        ////////////////////////////////////////////////////
    default:
        echo "<div class='phdr'>Làm nông nghiệp</div>";
        echo "<a href='game.php?act=land&amp;do=earth'>Xới đất</a><br/>";
        echo "<a href='game.php?act=land&amp;do=agriculture'>Gieo giống</a><br/>";
        echo "<a href='game.php?act=land&amp;do=mills'>Xay lúa</a><br/>";
        echo "<a href='game.php?act=land&amp;do=info'>Thông tin</a><br/>";
        echo "---------<br/>";
}


echo "<a href='game.php?'>Trong trò chơi</a><br/>";

?>