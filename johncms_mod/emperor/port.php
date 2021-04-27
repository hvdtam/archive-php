<?php
defined('_IN_JOHNCMS') or die('Error: restricted access');
require_once ("../incfiles/head.php");

$do = isset($_GET['do']) ? trim($_GET['do']) : ''; // Lựa chọn

switch ($do)
{
        ////////////////////////////////////////////////////
        // Кораблестроение                                //
        ////////////////////////////////////////////////////
    case "shipbuilding":

        $max_ships = floor($ms['pinigai'] / 500);

        if (isset($_POST['submit']))
        {
            $sum = intval($_POST['sum']);
            if ($sum > $max_ships or $sum < 1)
            {
                echo "Bạn không thể mua nhiều như thế<br />";
            }
            else
            {
                $ships = $ms['ships'] + $sum;
                $pinigai = $ms['pinigai'] - ($sum * 500);

                mysql_query("UPDATE emperor_users SET 
		ships = '" . $ships . "',
		pinigai = '" . $pinigai . "'
		 WHERE user_id='" . $idus . "';");

                echo "Bạn đã mua " . $sum . " tàu<br />";
            }
        }
        else
        {
            echo "<div class='phdr'><b>Tàu thủy</b></div>";
            echo "<img src='img/laivas.gif' alt='+'/><br />Bạn đã có một:<br/>";
            echo "Tàu: <b>" . $ms['ships'] . "</b><br/>";
            echo "Số vàng của bạn: <b>" . $ms['pinigai'] . "</b><br/>";
            echo "-------<br/>";
            echo "<b>Mua tàu thương gia</b><br />";
            echo "Giá của một chiếc tàu là 500 vàng.<br />";
            echo "Bạn có thể mua: " . $max_ships . "<br />";
            echo "Nhập vào số tàu bạn muốn mua:<br />";

            echo '<form action="game.php?act=port&amp;do=shipbuilding" method="post">';
            echo "<input type='text' name='sum'/><br/>";
            echo '<input type="submit" name="submit" value="Mua"/><br /><br /></form>';
            echo "---------<br/>";
        }

        echo "<a href='game.php?act=port'>Quay lại</a><br />";
        break;
        ////////////////////////////////////////////////////
        // Обучение на рыболовов                          //
        ////////////////////////////////////////////////////
    case "teach":
        if (isset($_POST['submit']))
        {
            $sum = intval($_POST['sum']);
            if ($sum > $ms['workers'] or $sum < 1)
            {
                echo "Bạn không thể đào tạo như nhiều công nhân như thế<br />";
            }
            else
            {
                $fishermen = $ms['fishermen'] + $sum;
                $workers = $ms['workers'] - $sum;

                mysql_query("UPDATE emperor_users SET 
		fishermen = '" . $fishermen . "',
		workers = '" . $workers . "'
		 WHERE user_id='" . $idus . "';");

                echo "Bạn dạy được " . $sum . " Công nhân Thủy sản<br />";
            }
        }
        else
        {
            echo "<div class='phdr'><b>Ở đây người lao động được dạy nghề cá</b></div>";
            echo "Bạn đã có:<br/>";
            echo "Công nhân: <b>" . $ms['workers'] . "</b><br/>";
            echo "Ngư dân: <b>" . $ms['fishermen'] . "</b><br/>";
            echo "-------<br/>";
            echo "Bạn làm việc <b>" . $ms['workers'] . "</b><br/>";
            echo "<i>(có thể đào tạo về<b>" . $ms['workers'] . "</b> Ngư dân</i>)<br/>";
            echo "Điền số lượng những công nhân bạn muốn dạy nghề cá:<br/>";

            echo '<form action="game.php?act=port&amp;do=teach" method="post">';
            echo "<input type='text' name='sum'/><br/>";
            echo '<input type="submit" name="submit" value="Dạy"/><br /><br /></form>';
            echo "---------<br/>";
        }
        echo "<a href='game.php?act=port'>Quay lại</a><br />";
        break;
        ////////////////////////////////////////////////////
        // Рыболовство                                    //
        ////////////////////////////////////////////////////
    case "fishing":
        echo "<div class='phdr'>Câu cá</div>";

        $pagavimas = $ms['fishermen'] * 1.5;

        if (isset($_POST['submit']))
        {
            if (! $ms['fishermen'])
            {
                echo "Bạn không có cá!<br />";
            }
            else
                if ($ms['time_fishermen'] > $realtime)
                {
                    echo "anglers của bạn trôi trở lại <img src='img/laivas.gif' alt='+'/><br />";
                }
                else
                {
                    $catch = rand(1, $pagavimas);
                    $meal = $ms['meal'] + $catch;
                    $time_fishermen = $realtime + 600;

                    mysql_query("UPDATE emperor_users SET 
		meal = '" . $meal . "',
		time_fishermen = '" . $time_fishermen . "'
		 WHERE user_id='" . $idus . "';");

                    echo "anglers của bạn bị bắt: " . $catch . "<br />";
                    echo "Thực phẩm bổ sung: +" . $catch . "<br />";
                }
        }
        else
        {
            echo "Số cá của bạn: " . $ms['fishermen'] . "<br />";
            echo "Các ngư dân sẽ không thể nắm bắt nhiều hơn: <b>" . $pagavimas . "</b>";
            echo " <img src='img/fish.gif' alt='+'/><br />";

            if (! $ms['fishermen'])
            {
                echo "Bạn không có cá!<br />";
            }
            else
                if ($ms['time_fishermen'] < $realtime)
                {
                    echo "anglers của bạn sẵn sàng làm việc";
                    echo " <img src='img/pipe.gif' alt='+'/><br />";
                    echo '<form action="game.php?act=port&amp;do=fishing" method="post">';
                    echo '<input type="submit" name="submit" value="Cá"/><br /><br /></form>';
                }
                else
                {
                    echo "anglers của bạn trôi trở lại <img src='img/laivas.gif' alt='+'/><br />";
                }

                echo "---------<br />";
            echo "<a href='game.php?act=port&amp;do=teach'>Dạy cho anglers</a><br />";
        }
        echo "---------<br />";
        echo "<a href='game.php?act=port'>Quay lại</a><br />";
        break;
        ////////////////////////////////////////////////////
        // Информация                                     //
        ////////////////////////////////////////////////////
    case "info":
        echo "<div class='phdr'>Thông tin</div>";
        echo "<b>Tàu thuỷ</b><br />";
        echo "Tại đây bạn có thể mua thêm tàu thuyền.<br />";
        echo "---------<br />";
        echo "<b>Câu cá</b><br />";
        echo "Với câu cá, bạn sẽ được thêm vào cung cấp thực phẩm<br />";
        echo "---------<br/>";
        echo "<a href='game.php?act=port'>Quay lại</a><br />";
        break;
        ////////////////////////////////////////////////////
        // Главная                                        //
        ////////////////////////////////////////////////////
    default:
        echo "<div class='phdr'>Bến cảng</div>";
        echo "<a href='game.php?act=port&amp;do=shipbuilding'>Tàu thuỷ</a><br/>";
        echo "<a href='game.php?act=port&amp;do=fishing'>Câu cá</a><br/>";
        echo "<a href='game.php?act=port&amp;do=info'>Thông tin</a><br/>";
        echo "---------<br/>";
}


echo "<a href='game.php?'>Trong trò chơi</a><br/>";

?>