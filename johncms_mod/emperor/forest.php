<?php
defined('_IN_JOHNCMS') or die('Error: restricted access');
require_once ("../incfiles/head.php");

$do = isset($_GET['do']) ? trim($_GET['do']) : ''; // Chọn hành động

switch ($do)
{
        ////////////////////////////////////////////////////
        // Обучение на лесорубов                          //
        ////////////////////////////////////////////////////
    case "teach_lumberjacks":
        if (isset($_POST['submit']))
        {
            $sum = intval($_POST['sum']);
            if ($sum > $ms['workers'] or $sum < 1)
            {
                echo "Bạn không thể đào tạo nhiều công nhân như thế<br />";
            }
            else
            {
                $lumberjacks = $ms['lumberjacks'] + $sum;
                $workers = $ms['workers'] - $sum;

                mysql_query("UPDATE emperor_users SET 
		lumberjacks = '" . $lumberjacks . "',
		workers = '" . $workers . "'
		 WHERE user_id='" . $idus . "';");

                echo "Bạn dạy được" . $sum . " công nhân đốn củi<br />";
            }
        }
        else
        {
            echo "<div class='phdr'><b>Ở đây người lao động được dạy để khai thác gỗ</b></div>";
            echo "Bạn có:<br/>";
            echo "Công nhân: <b>" . $ms['workers'] . "</b><br/>";
            echo "Thợ đốn củi: <b>" . $ms['lumberjacks'] . "</b><br/>";
            echo "-------<br/>";
            echo "Bạn làm việc <b>" . $ms['workers'] . "</b><br/>";
            echo "<i>(có thể đào tạo về <b>" . $ms['workers'] . "</b> đốn củi</i>)<br/>";
            echo "Điền số lượng công nhân bạn muốn dạy tại nghề đốn củi:<br/>";

            echo '<form action="game.php?act=forest&amp;do=teach_lumberjacks" method="post">';
            echo "<input type='text' name='sum'/><br/>";
            echo '<input type="submit" name="submit" value="Dạy"/><br /><br /></form>';
        }
        echo "---------<br/>";
        echo "<a href='game.php?act=forest'>Quay lại</a><br />";
        break;
        ////////////////////////////////////////////////////
        // Лесорубы                                       //
        ////////////////////////////////////////////////////
    case "lumberjacks":
        echo "<div class='phdr'>Đốn củi</div>";

        $min_med = ceil($ms['lumberjacks'] / 0.25);
        $max_med = $ms['lumberjacks'];
        $prikirsta = mt_rand($min_med, $max_med);

        if (isset($_POST['submit']))
        {
            if (! $ms['lumberjacks'])
            {
                echo "Bạn không có thợ đốn củi!<br />";
            }
            else
                if ($ms['time_lumberjacks'] > $realtime)
                {
                    echo "Thợ đốn củi của bạn phần còn lại<br />";
                }
                else
                {
                    $firewoods = $ms['firewoods'] + $prikirsta;
                    $time_lumberjacks = $realtime + 600;

                    mysql_query("UPDATE emperor_users SET 
		firewoods = '" . $firewoods . "',
		time_lumberjacks = '" . $time_hunters . "'
		 WHERE user_id='" . $idus . "';");

                    echo "Công nhân của bạn tìm được: <b>" . $prikirsta . "</b><br/>";
                    echo "Số gổ đốn được: <b>+" . $prikirsta . "</b><br/>";
                }
        }
        else
        {
            echo "Số thợ đốn củi của bạn là: " . $ms['lumberjacks'] . "<br />";

            if (! $ms['lumberjacks'])
            {
                echo "Bạn không có thợ đốn củi!<br />";
            }
            else
                if ($ms['time_lumberjacks'] < $realtime)
                {
                    echo "Thợ đốn củi của bạn đã sẵn sàng để làm việc<br />";
                    echo '<form action="game.php?act=forest&amp;do=lumberjacks" method="post">';
                    echo '<input type="submit" name="submit" value="Bắt đầu đốn cây"/><br /><br /></form>';
                }
                else
                {
                    echo "thợ săn của bạn đang nghỉ ngơi<br />";
                }

                echo "---------<br />";
            echo "<a href='game.php?act=forest&amp;do=teach_lumberjacks'>Dạy nghề đốn củi cho công nhân</a><br />";
        }
        echo "---------<br />";
        echo "<a href='game.php?act=forest'>Quay lại</a><br />";
        break;


        ////////////////////////////////////////////////////
        // Обучение на охотников                          //
        ////////////////////////////////////////////////////
    case "teach":
        if (isset($_POST['submit']))
        {
            $sum = intval($_POST['sum']);
            if ($sum > $ms['workers'] or $sum < 1)
            {
                echo "Bạn không thể đào tạo nhiều công nhân như thế<br />";
            }
            else
            {
                $hunters = $ms['hunters'] + $sum;
                $workers = $ms['workers'] - $sum;

                mysql_query("UPDATE emperor_users SET 
		hunters = '" . $hunters . "',
		workers = '" . $workers . "'
		 WHERE user_id='" . $idus . "';");

                echo "Bạn dạy " . $sum . " Công nhân nghề Săn bắn<br />";
            }
        }
        else
        {
            echo "<div class='phdr'><b>Ở đây người lao động được dạy nghề Thợ Săn</b></div>";
            echo "Bạn có:<br/>";
            echo "Công nhân: <b>" . $ms['workers'] . "</b><br/>";
            echo "Thợ săn: <b>" . $ms['hunters'] . "</b><br/>";
            echo "-------<br/>";
            echo "Bạn làm việc <b>" . $ms['workers'] . "</b><br/>";
            echo "<i>(có thể đào tạo về <b>" . $ms['workers'] . "</b> thợ săn</i>)<br/>";
            echo "Điền số lượng công nhân bạn người muốn dạy nghề Thợ săn:<br/>";

            echo '<form action="game.php?act=forest&amp;do=teach" method="post">';
            echo "<input type='text' name='sum'/><br/>";
            echo '<input type="submit" name="submit" value="Dạy"/><br /><br /></form>';
        }
        echo "---------<br/>";
        echo "<a href='game.php?act=forest'>Quay lại</a><br />";
        break;
        ////////////////////////////////////////////////////
        // Охотничество                                   //
        ////////////////////////////////////////////////////
    case "okhotnichestvo":
        echo "<div class='phdr'>Thợ săn</div>";

        $medziokle = $ms['hunters'] * 1.5;

        if (isset($_POST['submit']))
        {
            if (! $ms['hunters'])
            {
                echo "Bạn không có thợ săn!<br />";
            }
            else
                if ($ms['time_hunters'] > $realtime)
                {
                    echo "thợ săn của bạn nghỉ ngơi<br />";
                }
                else
                {
                    $min_maist = $medziokle / 2;
                    $primedziota = mt_rand($min_maist, $medziokle);
                    $elniu_kiekis = floor($primedziota / 3);
                    $kitu_gyvunu = $primedziota - $elniu_kiekis;

                    $elniu_mesa = $elniu_kiekis * 2;
                    $mesa = $elniu_mesa + $kitu_gyvunu;


                    $meal = $ms['meal'] + $mesa;
                    $time_hunters = $realtime + 600;

                    mysql_query("UPDATE emperor_users SET 
		meal = '" . $meal . "',
		time_hunters = '" . $time_hunters . "'
		 WHERE user_id='" . $idus . "';");

                    echo "Thợ săn của bạn giết được: <b>" . $elniu_kiekis .
                        "</b> Nai<img src='img/elnias.gif' alt='+'/><br/>";
                    echo "Động vật khác: <b>" . $kitu_gyvunu . "</b><br/>";
                    echo "Bổ sung thịt: <b>+" . $mesa .
                        "</b><img src='img/kumpis.gif' alt='+'/><br/>";
                }
        }
        else
        {
            echo " <img src='img/briedis.gif' alt='+'/><br />";
            echo "Thợ săn bạn có: " . $ms['hunters'] . "<br />";
            echo "Thợ săn sẽ không thể nắm bắt được nhiều hơn nửa: <b>" . $medziokle . "</b><br />";


            if (! $ms['hunters'])
            {
                echo "Bạn không có thợ săn!<br />";
            }
            else
                if ($ms['time_hunters'] < $realtime)
                {
                    echo "Thợ săn của bạn đã sẵn sàng để làm việc<br />";
                    echo '<form action="game.php?act=forest&amp;do=okhotnichestvo" method="post">';
                    echo '<input type="submit" name="submit" value="Săn bắn"/><br /><br /></form>';
                }
                else
                {
                    echo "thợ săn của bạn nghỉ ngơi<br />";
                }

                echo "---------<br />";
            echo "<a href='game.php?act=forest&amp;do=teach'>Đào tạo cho thợ săn</a><br />";
        }
        echo "---------<br />";
        echo "<a href='game.php?act=forest'>Quay lại</a><br />";
        break;
        ////////////////////////////////////////////////////
        // Информация                                     //
        ////////////////////////////////////////////////////
    case "info":
        echo "<div class='phdr'>Thông tin</div>";
        echo "<b>Thợ đốn củi</b><br/>";
        echo "Trong rừng, bạn có thể đốn gổ để nhận được Gổ<br/>";
        echo "---------<br/>";
        echo "<b>Thợ săn</b><br/>";
        echo "Bạn có thể gửi những người thợ săn vào rừng để có được nguồn cung cấp thực phẩm dồi dào<br />";
        echo "---------<br/>";
        echo "<a href='game.php?act=forest'>Quay lại</a><br />";
        break;
        ////////////////////////////////////////////////////
        // Главная                                        //
        ////////////////////////////////////////////////////
    default:
        echo "<div class='phdr'>Rừng</div>";
        echo "<a href='game.php?act=forest&amp;do=lumberjacks'>Thợ đốn củi</a><br/>";
        echo "<a href='game.php?act=forest&amp;do=okhotnichestvo'>Thợ săn</a><br/>";
        echo "<a href='game.php?act=forest&amp;do=info'>Thông tin</a><br/>";
        echo "---------<br/>";
}


echo "<a href='game.php?'>Trong trò chơi</a><br/>";

?>