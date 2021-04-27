<?php
defined('_IN_JOHNCMS') or die('Error: restricted access');
require_once ("../incfiles/head.php");

$do = isset($_GET['do']) ? trim($_GET['do']) : ''; // Lựa chọn một hành động

switch ($do)
{
        ////////////////////////////////////////////////////
        // Информация                                     //
        ////////////////////////////////////////////////////
    case "info":
        echo "<b>Công nhân</b><br/>";
        echo "Công nhân rất cần thiết cho bạn! Nhất là họ có thể làm việc trong hầm mỏ, nhà máy, công trường, thu lúa mạch, bắt cá...!<br />Công nhân cũng có thể chiến đấu!.<br/>";
        echo "---------<br/>";
        echo "<b>Chiến binh Warriors</b><br/>";
        echo "Chiến binh bảo vệ lãnh thổ của bạn! Ưu điểm: Tấn công bằng đá!<br/>";
        echo "---------<br/>";
        echo "<b>Ngựa</b><br/>";
        echo "Ngựa giúp tăng phòng thủ cho bạn đồng thời tăng lực tấn công của bạn thêm 10 điểm cho 1 con ngựa.<br/>";
        echo "---------<br/>";
        echo "<a href='game.php?act=centr'>Quay lại</a><br />";
        break;
        ////////////////////////////////////////////////////
        // Нанимаем рабочих                               //
        ////////////////////////////////////////////////////
    case "workers":

        $viso_namuose = $ms['houses'] * 10;
        $vietu = $ms['houses'] * 10 - $ms['workers'];
        $darb_viso = ceil($ms['pinigai'] / 20);

        if ($darb_viso > $viso_namuose)
        {
            $gali_pirkti = $vietu;
        }
        else
            if (($darb_viso <= $viso_namuose) && ($ms['pinigai'] >= ($vietu * 10)))
            {
                $gali_pirkti = $vietu;
            }
            else
                if ($ms['pinigai'] < 20)
                {
                    $gali_pirkti = 0;
                } elseif ($ms['pinigai'] < ($vietu * 10))
                {
                    $gali_pirkti = $darb_viso;
                }
        if (isset($_POST['submit']))
        {
            $sum = intval($_POST['sum']);

            if ($gali_pirkti == 0)
            {
                echo "Bạn không thể thuê công nhân<br />";
            }
            else
                if ($sum > $gali_pirkti)
                {
                    echo "Bạn không thể thuê công nhân nhiều như thế được!<br />";
                }
                else
                {
                    $workers = $ms['workers'] + $sum;
                    $pinigai = $ms['pinigai'] - ($sum * 20);

                    mysql_query("UPDATE emperor_users SET 
		workers = '" . $workers . "',
		pinigai = '" . $pinigai . "'
		 WHERE user_id='" . $idus . "';");

                    echo "Bạn thuê " . $sum . " nô lệ.<br />";
                }
        }
        else
        {
            echo "<img src='img/darbininkai.gif' alt='+'/><br/>";

            echo "Giá 1 công nhân: <b>20</b> vàng<br/>";
            echo "Bạn có: <b>" . $ms['pinigai'] . "</b> vàng<br/>";
            echo "Bạn có: <b>" . $ms['houses'] . "</b> căn nhà<br/>";
            echo "Trong ngôi nhà của bạn có thể sống: <b>" . $viso_namuose . "</b> người dân<br/>";
            echo "Bạn đã có: <b>" . $ms['workers'] . "</b> công nhân<br/>";
            echo "Bạn có thể thuê: <b>" . $gali_pirkti . " </b>công nhân<br/>";
            echo "<br />Có bao nhiêu người lao động bạn muốn thuê?:<br/>";

            echo '<form action="game.php?act=centr&amp;do=workers" method="post">';
            echo "<input type='text' name='sum'/><br/>";
            echo '<input type="submit" name="submit" value="Thuê"/><br /><br /></form>';
        }

        echo "---------<br/>";
        echo "<a href='game.php?act=centr'>Quay lại</a><br />";

        break;
        ////////////////////////////////////////////////////
        // Нанимаем воинов                                //
        ////////////////////////////////////////////////////
    case "warriors":

        $viso_namuose = $ms['barracks'] * 50;
        $vietu = $ms['barracks'] * 50 - $ms['warriors'];
        $darb_viso = ceil($ms['pinigai'] / 30);

        if ($darb_viso > $viso_namuose)
        {
            $gali_pirkti = $vietu;
        }
        else
            if (($darb_viso <= $viso_namuose) && ($ms['pinigai'] >= ($vietu * 20)))
            {
                $gali_pirkti = $vietu;
            }
            else
                if ($ms['pinigai'] < 30)
                {
                    $gali_pirkti = 0;
                } elseif ($ms['pinigai'] < ($vietu * 20))
                {
                    $gali_pirkti = $darb_viso;
                }

        if (isset($_POST['submit']))
        {
            $sum = intval($_POST['sum']);

            if ($gali_pirkti == 0)
            {
                echo "Bạn có thể không quân tuyển dụng<br />";
            }
            else
                if ($sum > $gali_pirkti)
                {
                    echo "Bạn không thể thuê như nhiều người línhв<br />";
                }
                else
                {
                    $warriors = $ms['warriors'] + $sum;
                    $pinigai = $ms['pinigai'] - ($sum * 30);

                    mysql_query("UPDATE emperor_users SET 
		warriors = '" . $warriors . "',
		pinigai = '" . $pinigai . "'
		 WHERE user_id='" . $idus . "';");

                    echo "Bạn thuê " . $sum . " Chiến binh Warriors<br />";
                }
        }
        else
        {
            echo "<img src='img/raiteliai.gif' alt='+'/><br/>";

            echo "Giá chiến binh: <b>30</b> vàng<br/>";
            echo "Bạn có: <b>" . $ms['pinigai'] . "</b> vàng<br/>";
            echo "Bạn có: <b>" . $ms['barracks'] . "</b> Doanh trại<br/>";
            echo "Trong doanh trại của bạn có thể sống: <b>" . $viso_namuose . "</b> người dân<br/>";
            echo "Bạn đã có: <b>" . $ms['warriors'] . "</b> Chiến binh Warriors<br/>";
            echo "Bạn có thể thuê: <b>" . $gali_pirkti . "</b> Chiến binh Warriors<br/>";
            echo "<br />Có bao nhiêu người muốn thuê:<br/>";

            echo '<form action="game.php?act=centr&amp;do=warriors" method="post">';
            echo "<input type='text' name='sum'/><br/>";
            echo '<input type="submit" name="submit" value="Thuê"/><br /><br /></form>';
        }
        echo "---------<br/>";
        echo "<a href='game.php?act=centr'>Quay lại</a><br />";

        break;
        ////////////////////////////////////////////////////
        // Покупаем лошадей                               //
        ////////////////////////////////////////////////////
    case "horse":

        $viso_namuose = $ms['stables'] * 6;
        $vietu = $ms['stables'] * 6 - $ms['horse'];
        $darb_viso = ceil($ms['pinigai'] / 100);

        if ($darb_viso > $viso_namuose)
        {
            $gali_pirkti = $vietu;
        }
        else
            if (($darb_viso <= $viso_namuose) && ($ms['pinigai'] >= ($vietu * 100)))
            {
                $gali_pirkti = $vietu;
            }
            else
                if ($ms['pinigai'] < 100)
                {
                    $gali_pirkti = 0;
                } elseif ($ms['pinigai'] < ($vietu * 100))
                {
                    $gali_pirkti = $darb_viso;
                }

        if (isset($_POST['submit']))
        {
            $sum = intval($_POST['sum']);

            if ($gali_pirkti == 0)
            {
                echo "Bạn không thể mua ngựa<br />";
            }
            else
                if ($sum > $gali_pirkti)
                {
                    echo "Bạn không thể mua nhiều ngựa như thế!<br />";
                }
                else
                {
                    $horse = $ms['horse'] + $sum;
                    $pinigai = $ms['pinigai'] - ($sum * 100);

                    mysql_query("UPDATE emperor_users SET 
		horse = '" . $horse . "',
		pinigai = '" . $pinigai . "'
		 WHERE user_id='" . $idus . "';");

                    echo "Bạn đã mua " . $sum . " Ngựa<br />";
                }
        }
        else
        {
            echo "<img src='img/horse.gif' alt='+'/><br/>";

            echo "Giá của một con ngựa: <b>100</b> vàng<br/>";
            echo "Bạn có: <b>" . $ms['pinigai'] . "</b> vàng<br/>";
            echo "Bạn có: <b>" . $ms['stables'] . "</b> Chuồng ngựa<br/>";
            echo "Trong chuồng của bạn có thể nuôi được: <b>" . $viso_namuose . "</b> con Ngựa<br/>";
            echo "Bạn đã có: <b>" . $ms['horse'] . "</b> con Ngựa<br/>";
            echo "Bạn có thể mua: <b>" . $gali_pirkti . "</b> con Ngựa<br/>";
            echo "<br />Có bao nhiêu con ngựa bạn muốn mua:<br/>";

            echo '<form action="game.php?act=centr&amp;do=warriors" method="post">';
            echo "<input type='text' name='sum'/><br/>";
            echo '<input type="submit" name="submit" value="Mua"/><br /><br /></form>';
        }
        echo "---------<br/>";
        echo "<a href='game.php?act=centr'>Quay lại</a><br />";

        break;
        ////////////////////////////////////////////////////
        // Главная                                        //
        ////////////////////////////////////////////////////
    default:
        echo "<div class='phdr'>Chào mừng các bạn đến với Trung tâm mua bán!!!</div>";

        echo "<img src='img/darbininkai.gif' alt='+'/>
<a href='game.php?act=centr&amp;do=workers'>Thuê công nhân</a><br/>";

        echo "<img src='img/raiteliai.gif' alt='+'/>
<a href='game.php?act=centr&amp;do=warriors'>Thuê chiến binh</a><br/>";

        echo "<img src='img/horse.gif' alt='+'/>
		<a href='game.php?act=centr&amp;do=horse'>Mua ngựa</a><br/>";
        echo ">><a href='game.php?act=rinok'>Về thị trường</a><br/>";
        echo ">><a href='game.php?act=centr&amp;do=info'>Thông tin</a><br/>";
        echo "Bạn: <b>" . $ms['pinigai'] . "</b> vàng<br/>";
        echo "---------<br/>";
}

echo "<a href='game.php?'>Quay về trang chủ Đế Chế!</a><br/>";

?>