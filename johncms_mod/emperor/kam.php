<?php
defined('_IN_JOHNCMS') or die('Error: restricted access');
require_once ("../incfiles/head.php");

$do = isset($_GET['do']) ? trim($_GET['do']) : ''; // Chọn hành động

switch ($do)
{
        ////////////////////////////////////////////////////
        // Обучение на каменотесов                        //
        ////////////////////////////////////////////////////
    case "teach":
        if (isset($_POST['submit']))
        {
            $sum = intval($_POST['sum']);
            if ($sum > $ms['workers'] or $sum < 1)
            {
                echo "Bạn không thể đào tạo như nhiều công nhân<br />";
            }
            else
            {
                $stonemasons = $ms['stonemasons'] + $sum;
                $workers = $ms['workers'] - $sum;

                mysql_query("UPDATE emperor_users SET 
		stonemasons = '" . $stonemasons . "',
		workers = '" . $workers . "'
		 WHERE user_id='" . $idus . "';");

                echo "Bạn dạy " . $sum . " công nhân Khai thác đá<br />";
            }
        }
        else
        {
            echo "<div class='phdr'><b>Ở đây, công nhân được dạy nghề Khai thác đá</b></div>";
            echo "Bạn có:<br/>";
            echo "Công nhân: <b>" . $ms['workers'] . "</b><br/>";
            echo "CN Khai thác đá: <b>" . $ms['stonemasons'] . "</b><br/>";
            echo "-------<br/>";
            echo "Bạn làm việc <b>" . $ms['workers'] . "</b><br/>";
            echo "<i>(có thể đào tạo về <b>" . $ms['workers'] . "</b> công nhân khai thác đá</i>)<br/>";
            echo "Điền số lượng công nhân bạn muốn dạy nghề Khai thác đá:<br/>";

            echo '<form action="game.php?act=kam&amp;do=teach" method="post">';
            echo "<input type='text' name='sum'/><br/>";
            echo '<input type="submit" name="submit" value="Dạy nghề"/><br /><br /></form>';
        }
        echo "---------<br/>";
        echo "<a href='game.php?act=kam'>Quay lại</a><br />";
        break;
        ////////////////////////////////////////////////////
        // Скалы                                          //
        ////////////////////////////////////////////////////
    case "rocks":
        echo "<div class='phdr'>Khai thác đá</div>";

        $min_akm = $ms['stonemasons'] * 0.25;
        $priskaldyta = mt_rand($min_akm, $ms['stonemasons']);

        if (isset($_POST['submit']))
        {
            if (! $ms['stonemasons'])
            {
                echo "Bạn không có công nhân Khai thác đá!<br />";
            }
            else
                if ($ms['time_stonemasons'] > $realtime)
                {
                    echo "Công nhân khai thác đá còn lại của bạn<br />";
                }
                else
                {
                    $stone = $ms['stone'] + $priskaldyta;
                    $time_stonemasons = $realtime + 600;

                    mysql_query("UPDATE emperor_users SET 
		stone = '" . $stone . "',
		time_stonemasons = '" . $time_stonemasons . "'
		 WHERE user_id='" . $idus . "';");

                    echo "Công nhân của bạn đả khai thác được số đá: <b>" . $priskaldyta . "</b><br/>";
                    echo "Tài nguyên của bạn được bổ sung đá: <b>+" . $priskaldyta . "</b><br/>";
                }
        }
        else
        {
            echo "CN Khai thác đá của bạn: " . $ms['stonemasons'] . "<br />";
            echo "Có thể nhận được số đá nhiều hơn: <b>" . $medziokle . "</b><br />";

            if (! $ms['stonemasons'])
            {
                echo "Bạn không có công nhân Khai thác đá!<br />";
            }
            else
                if ($ms['time_stonemasons'] < $realtime)
                {
                    echo "CN Khai thác đá của bạn đã sẵn sàng để làm việc<br />";
                    echo '<form action="game.php?act=kam&amp;do=rocks" method="post">';
                    echo '<input type="submit" name="submit" value="Bắt đầu khai thác đá"/><br /><br /></form>';
                }
                else
                {
                    echo "CN Khai thác đá còn lại của bạn<br />";
                }

                echo "---------<br />";
            echo "<a href='game.php?act=kam&amp;do=teach'>Dạy nghề khai thác đá</a><br />";
        }
        echo "---------<br />";
        echo "<a href='game.php?act=kam'>Quay lại</a><br />";
        break;
        ////////////////////////////////////////////////////
        // Информация                                     //
        ////////////////////////////////////////////////////
    case "info":
        echo "<div class='phdr'>Thông tin</div>";
        echo "<b>Khai thác đá</b><br />";
        echo "Tại đây bạn có thể trích xuất các loại đá và bổ sung nguồn lực của mình với họ. Một CN có thể nhận được 2 đá<br />";
        echo "---------<br/>";
        echo "<a href='game.php?act=kam'>Quay lại</a><br />";
        break;
        ////////////////////////////////////////////////////
        // Главная                                        //
        ////////////////////////////////////////////////////
    default:
        echo "<div class='phdr'>Mỏ đá</div>";
        echo "<a href='game.php?act=kam&amp;do=rocks'>Khai thác đá</a><br/>";
        echo "<a href='game.php?act=kam&amp;do=teach'>Đào tạo công nhân Khai thác dá</a><br/>";
        echo "<a href='game.php?act=kam&amp;do=info'>Thông tin</a><br/>";
        echo "---------<br/>";
}


echo "<a href='game.php?'>Trong trò chơi</a><br/>";

?>