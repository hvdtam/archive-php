<?php
defined('_IN_JOHNCMS') or die('Error: restricted access');
require_once ("../incfiles/head.php");

$do = isset($_GET['do']) ? trim($_GET['do']) : ''; // Chọn hành động

switch ($do)
{
        ////////////////////////////////////////////////////
        // Продажа                                        //
        ////////////////////////////////////////////////////
    case "sell":
        echo "<div class='phdr'>Bán</div>";

        if (isset($_POST['submit']))
        {
            $sum = intval($_POST['sum']);
            $who = intval($_POST['who']);

            switch ($who)
            {
                case 1:
                    if ($sum > $ms['meal'] or $sum < 1)
                    {
                        echo "Bạn không thể bán như nhiều như thế<br />";
                    }
                    else
                    {
                        $meal = $ms['meal'] - $sum;
                        $pinigai = $ms['pinigai'] + ($sum * 2);

                        mysql_query("UPDATE emperor_users SET 
		meal = '" . $meal . "',
		pinigai = '" . $pinigai . "'			
		 WHERE user_id='" . $idus . "';");

                        echo "Bán thành công<br />";
                    }
                    break;
                case 2:
                    if ($sum > $ms['firewoods'] or $sum < 1)
                    {
                        echo "Bạn không thể mua nhiều như thế<br />";
                    }
                    else
                    {
                        $firewoods = $ms['firewoods'] - $sum;
                        $pinigai = $ms['pinigai'] + ($sum * 4);

                        mysql_query("UPDATE emperor_users SET 
		firewoods = '" . $firewoods . "',
		pinigai = '" . $pinigai . "'			
		 WHERE user_id='" . $idus . "';");

                        echo "Bán thành công<br />";
                    }
                    break;
                case 3:
                    if ($sum > $ms['stone'] or $sum < 1)
                    {
                        echo "Bạn không thể mua nhiều như thế<br />";
                    }
                    else
                    {
                        $stone = $ms['stone'] - $sum;
                        $pinigai = $ms['pinigai'] + ($sum * 4);

                        mysql_query("UPDATE emperor_users SET 
		stone = '" . $stone . "',
		pinigai = '" . $pinigai . "'			
		 WHERE user_id='" . $idus . "';");

                        echo "Bán thành công<br />";
                    }
                    break;
                case 4:
                    if ($sum > $ms['gland'] or $sum < 1)
                    {
                        echo "Bạn không thể mua nhiều như thế<br />";
                    }
                    else
                    {
                        $gland = $ms['gland'] - $sum;
                        $pinigai = $ms['pinigai'] + ($sum * 5);

                        mysql_query("UPDATE emperor_users SET 
		gland = '" . $gland . "',
		pinigai = '" . $pinigai . "'			
		 WHERE user_id='" . $idus . "';");

                        echo "Bán thành công<br />";
                    }
                    break;
                case 6:
                    if ($sum > $ms['golds'] or $sum < 1)
                    {
                        echo "Bạn không thể mua nhiều như thế<br />";
                    }
                    else
                    {
                        $golds = $ms['golds'] + $sum;
                        $pinigai = $ms['pinigai'] - ($sum * 7);

                        mysql_query("UPDATE emperor_users SET 
		golds = '" . $golds . "',
		pinigai = '" . $pinigai . "'			
		 WHERE user_id='" . $idus . "';");
                        echo "Bán thành công<br />";
                    }
                    break;
                default:
                    header("Location: game.php");
                    exit;
            }
        }
        else
        {
            echo "Số vàng của bạn: <b>" . $ms['pinigai'] . "</b><br/>";
            echo "Giá thực phẩm: <b>2</b> vàng<br/>";
            echo "(<i>Max: <b>" . $ms['meal'] . "</b></i>)<br/>";
            echo "Giá Củi: <b>4</b> vàng<br/>";
            echo "(<i>Max: <b>" . $ms['firewoods'] . "</b></i>)<br/>";
            echo "Giá Đá: <b>4</b> vàng<br/>";
            echo "(<i>Max: <b>" . $ms['stone'] . "</b></i>)<br/>";
            echo "Giá sắt: <b>5</b> vàng<br/>";
            echo "(<i>Max: <b>" . $ms['gland'] . "</b></i>)<br/>";
            echo "Giá vàng: <b>7</b> vàng<br/>";
            echo "(<i>Max: <b>" . $ms['golds'] . "</b></i>)<br/>";
            echo "---------<br/>";

            echo '<form action="game.php?act=rinok&amp;do=sell" method="post">';
            echo "Chọn vật phẩm và số lượng bạn muốn bán:<br/>";

            echo "Số lượng:<br/><input type='text' name='sum'/><br/>";

            echo "Vật phẩm:<br/><select name='who'>
      <option value='1'>Thực phẩm</option>
      <option value='2'>Củi</option>
      <option value='3'>Đá</option>
      <option value='4'>Sắt</option>
      <option value='5'>Vàng</option>
      </select><br/>";

            echo '<input type="submit" name="submit" value="Bán"/><br /><br /></form>';
        }

        echo "---------<br/>";
        echo "<a href='game.php?act=rinok'>Quay lại</a><br />";
        break;
        ////////////////////////////////////////////////////
        // Покупка                                        //
        ////////////////////////////////////////////////////
    case "purchase":
        echo "<div class='phdr'>Mua</div>";
        $max_8 = floor($ms['pinigai'] / 8);
        $max_4 = floor($ms['pinigai'] / 4);
        $max_16 = floor($ms['pinigai'] / 16);
        $max_20 = floor($ms['pinigai'] / 20);
        $max_28 = floor($ms['pinigai'] / 28);

        if (isset($_POST['submit']))
        {
            $sum = intval($_POST['sum']);
            $who = intval($_POST['who']);

            switch ($who)
            {
                case 1:
                    if ($sum > $max_8 or $sum < 1)
                    {
                        echo "Bạn không thể mua nhiều như thế<br />";
                    }
                    else
                    {
                        $meal = $ms['meal'] + $sum;
                        $pinigai = $ms['pinigai'] - ($sum * 8);

                        mysql_query("UPDATE emperor_users SET 
		meal = '" . $meal . "',
		pinigai = '" . $pinigai . "'			
		 WHERE user_id='" . $idus . "';");

                        echo "Mua thành công!<br />";
                    }
                    break;
                case 2:
                    if ($sum > $max_4 or $sum < 1)
                    {
                        echo "Bạn không thể mua nhiều như thế<br />";
                    }
                    else
                    {
                        $rye = $ms['rye'] + $sum;
                        $pinigai = $ms['pinigai'] - ($sum * 4);

                        mysql_query("UPDATE emperor_users SET 
		rye = '" . $rye . "',
		pinigai = '" . $pinigai . "'			
		 WHERE user_id='" . $idus . "';");

                        echo "Mua thành công!<br />";
                    }
                    break;
                case 3:
                    if ($sum > $max_16 or $sum < 1)
                    {
                        echo "Bạn không thể mua nhiều như thế<br />";
                    }
                    else
                    {
                        $firewoods = $ms['firewoods'] + $sum;
                        $pinigai = $ms['pinigai'] - ($sum * 16);

                        mysql_query("UPDATE emperor_users SET 
		firewoods = '" . $firewoods . "',
		pinigai = '" . $pinigai . "'			
		 WHERE user_id='" . $idus . "';");

                        echo "Mua thành công!<br />";
                    }
                    break;
                case 4:
                    if ($sum > $max_16 or $sum < 1)
                    {
                        echo "Bạn không thể mua nhiều như thế<br />";
                    }
                    else
                    {
                        $stone = $ms['stone'] + $sum;
                        $pinigai = $ms['pinigai'] - ($sum * 16);

                        mysql_query("UPDATE emperor_users SET 
		stone = '" . $stone . "',
		pinigai = '" . $pinigai . "'			
		 WHERE user_id='" . $idus . "';");

                        echo "Mua thành công!<br />";
                    }
                    break;
                case 5:
                    if ($sum > $max_20 or $sum < 1)
                    {
                        echo "Bạn không thể mua nhiều như thế<br />";
                    }
                    else
                    {
                        $gland = $ms['gland'] + $sum;
                        $pinigai = $ms['pinigai'] - ($sum * 20);

                        mysql_query("UPDATE emperor_users SET 
		gland = '" . $gland . "',
		pinigai = '" . $pinigai . "'			
		 WHERE user_id='" . $idus . "';");

                        echo "Mua thành công!<br />";
                    }
                    break;
                case 6:
                    if ($sum > $max_28 or $sum < 1)
                    {
                        echo "Bạn không thể mua nhiều như thế<br />";
                    }
                    else
                    {
                        $golds = $ms['golds'] + $sum;
                        $pinigai = $ms['pinigai'] - ($sum * 28);

                        mysql_query("UPDATE emperor_users SET 
		golds = '" . $golds . "',
		pinigai = '" . $pinigai . "'			
		 WHERE user_id='" . $idus . "';");
                        echo "Mua thành công!<br />";
                    }
                    break;
                default:
                    header("Location: game.php");
                    exit;
            }
        }
        else
        {
            echo "Số vàng của bạn: <b>" . $ms['pinigai'] . "</b><br/>";
            echo "Giá thực phẩm: <b>8</b> vàng<br/>";
            echo "(<i>Max: <b>" . $max_8 . "</b></i>)<br/>";
            echo "Giá lúa mạch: <b>4</b> vàng<br/>";
            echo "(<i>Max: <b>" . $max_4 . "</b></i>)<br/>";
            echo "Giá của củi: <b>16</b> vàng<br/>";
            echo "(<i>Max: <b>" . $max_16 . "</b></i>)<br/>";
            echo "Giá của Đá: <b>16</b> vàng<br/>";
            echo "(<i>Max: <b>" . $max_16 . "</b></i>)<br/>";
            echo "Giá sắt: <b>20</b> vàng<br/>";
            echo "(<i>Max: <b>" . $max_20 . "</b></i>)<br/>";
            echo "Gái vàng: <b>28</b> vàng<br/>";
            echo "(<i>Max: <b>" . $max_28 . "</b></i>)<br/>";
            echo "---------<br/>";

            echo '<form action="game.php?act=rinok&amp;do=purchase" method="post">';
            echo "Chọn vật phẩm và số lượng bạn muốn mua:<br/>";

            echo "Số lượng:<br/><input type='text' name='sum'/><br/>";

            echo "Vật phẩm:<br/><select name='who'>
      <option value='1'>Thực phẩm</option>
      <option value='2'>Lúa mạch</option>
      <option value='3'>Củi</option>
      <option value='4'>Đá</option>
      <option value='5'>Sắt</option>
      <option value='6'>Vàng</option>
      </select><br/>";

            echo '<input type="submit" name="submit" value="Mua"/><br /><br /></form>';
        }

        echo "---------<br/>";
        echo "<a href='game.php?act=rinok'>Quay lại</a><br />";
        break;
        ////////////////////////////////////////////////////
        // Главная                                        //
        ////////////////////////////////////////////////////
    default:
        echo "<div class='phdr'>Chào mừng đến với thị trường mua bán!!!</div>";
        echo "<a href='game.php?act=rinok&amp;do=purchase'>Mua</a><br/>";
        echo "<a href='game.php?act=rinok&amp;do=sell'>Bán</a><br/>";
        echo "---------<br/>"; 
}
echo "<a href='game.php?'>Trong trò chơi</a><br/>";

?>