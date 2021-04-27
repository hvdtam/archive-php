<?php
defined('_IN_JOHNCMS') or die('Error: restricted access');
require_once ("../incfiles/head.php");

$do = isset($_GET['do']) ? trim($_GET['do']) : ''; // Chọn hành động

switch ($do)
{
        ////////////////////////////////////////////////////
        // Шахты                                          //
        ////////////////////////////////////////////////////
    case "mine":
        echo "<div class='phdr'>Thợ mỏ</div>";

        $min_med = ceil($ms['lumberjacks'] / 0.25);
        $max_med = $ms['lumberjacks'];
        $prikirsta = mt_rand($min_med, $max_med);

        if (isset($_POST['submit']))
        {
            if (! $ms['miners'])
            {
                echo "Bạn không có thợ mỏ!<br />";
            }
            else
                if ($ms['time_miners'] > $realtime)
                {
                    echo "Số thợ mỏ còn lại của bạn<br />";
                }
                else
                {
                    $medziokle = $ms['miners'] * 1.5;
                    $min_maist = $medziokle / 2;
                    $primedziota = mt_rand($min_maist, $medziokle);
                    $elniu_kiekis = floor($primedziota / 3);
                    $kitu_gyvunu = $primedziota - $elniu_kiekis;

                    $elniu_mesa = $elniu_kiekis * 2;

                    $golds = $ms['golds'] + $kitu_gyvunu;
                    $gland = $ms['gland'] + $elniu_mesa;
                    $time_miners = $realtime + 600;

                    mysql_query("UPDATE emperor_users SET 
		golds = '" . $golds . "',
		gland = '" . $gland . "',
		time_miners = '" . $time_miners . "'
		 WHERE user_id='" . $idus . "';");

                    echo "Thợ mỏ của bạn đào được: <b>+" . $kitu_gyvunu . "</b> vàng <b>+" . $elniu_mesa .
                        " Sắt</b><br/>";
                }
        }
        else
        {
            echo "Thợ Mỏ: " . $ms['miners'] . "<br />";

            if (! $ms['miners'])
            {
                echo "Bạn không có thợ mỏ!<br />";
            }
            else
                if ($ms['time_miners'] < $realtime)
                {
                    echo "Thợ mỏ của bạn đả sẵn sàng làm việc<br />";
                    echo '<form action="game.php?act=shachta&amp;do=mine" method="post">';
                    echo '<input type="submit" name="submit" value="Đăng vào mỏ"/><br /><br /></form>';
                }
                else
                {
                    echo "Số thợ mỏ còn lại của bạn<br />";
                }

                echo "---------<br />";
            echo "<a href='game.php?act=shachta&amp;do=teach'>Dạy nghề cho các thợ mỏ</a><br />";
        }
        echo "---------<br />";
        echo "<a href='game.php?act=shachta'>Quay lại</a><br />";
        break;
        ////////////////////////////////////////////////////
        // Обучение на шахтеров                           //
        ////////////////////////////////////////////////////
    case "teach":
        if (isset($_POST['submit']))
        {
            $sum = intval($_POST['sum']);
            if ($sum > $ms['workers'] or $sum < 1)
            {
                echo "Bạn không thể đào tạo nhiều thợ mỏ như thế<br />";
            }
            else
            {
                $miners = $ms['miners'] + $sum;
                $workers = $ms['workers'] - $sum;

                mysql_query("UPDATE emperor_users SET 
		miners = '" . $miners . "',
		workers = '" . $workers . "'
		 WHERE user_id='" . $idus . "';");

                echo "Bạn dạy được " . $sum . " công nhân thợ mỏ<br />";
            }
        }
        else
        {
            echo "<div class='phdr'><b>Học nghề thợ mỏ</b></div>";
            echo "Bạn có:<br/>";
            echo "Công nhân: <b>" . $ms['workers'] . "</b><br/>";
            echo "Thợ mỏ: <b>" . $ms['miners'] . "</b><br/>";
            echo "-------<br/>";
            echo "Bạn làm việc <b>" . $ms['workers'] . "</b><br/>";
            echo "<i>(Bạn có thể đào tạo <b>" . $ms['workers'] . "</b> thợ mỏ</i>)<br/>";
            echo "Điền số lượng công nhân bạn muốn đào tạo thành thợ mỏ:<br/>";

            echo '<form action="game.php?act=shachta&amp;do=teach" method="post">';
            echo "<input type='text' name='sum'/><br/>";
            echo '<input type="submit" name="submit" value="Đào tạo"/><br /><br /></form>';
        }
        echo "---------<br/>";
        echo "<a href='game.php?act=shachta'>Quay lại</a><br />";
        break;
        ////////////////////////////////////////////////////
        // Главная                                        //
        ////////////////////////////////////////////////////
    default:
        echo "<div class='phdr'>Thợ mỏ</div>";
        echo "<a href='game.php?act=shachta&amp;do=mine'>Thợ mỏ</a><br/>";
        echo "<a href='game.php?act=shachta&amp;do=teach'>Đào tạo công nhân thành các thợ mỏ</a><br/>";
        echo "---------<br/>";
}


echo "<a href='game.php?'>Trong trò chơi</a><br/>";

?>