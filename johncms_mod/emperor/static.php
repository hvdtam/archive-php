<?php
defined('_IN_JOHNCMS') or die('Error: restricted access');
require_once ("../incfiles/head.php");

$do = isset($_GET['do']) ? trim($_GET['do']) : ''; // Chọn hành động

switch ($do)
{
        ////////////////////////////////////////////////////
        // Рейтинг                                        //
        ////////////////////////////////////////////////////
    case "rating":
        switch ($id)
        {
            case 2:
                echo "<div class='phdr'>Chủ đất lớn</div>";

                $rating = mysql_query("SELECT `id`,`earths` 
	FROM `emperor_users` 
	WHERE user_id='" . $idus . "' ORDER BY earths DESC LIMIT 10;");

                while ($add = mysql_fetch_array($rating))
                {
                    echo ceil(ceil($i / 2) - ($i / 2)) == 0 ? '<div class="list1">' :
                        '<div class="list2">';

                    $users = mysql_fetch_array(mysql_query("SELECT `name`
	FROM `users` 
	WHERE id='" . $add['id'] . "' LIMIT 1;"));

                    echo ceil($i + 1) . ")<b>" . $users['name'] . "</b>(" . $add['earths'] .
                        ")<br />";

                    ++$i;
                    echo "</div>";
                }

                break;
            case 3:
                echo "<div class='phdr'>Củi</div>";

                $rating = mysql_query("SELECT `id`,`firewoods` 
	FROM `emperor_users` 
	WHERE user_id='" . $idus . "' ORDER BY firewoods DESC LIMIT 10;");

                while ($add = mysql_fetch_array($rating))
                {
                    echo ceil(ceil($i / 2) - ($i / 2)) == 0 ? '<div class="list1">' :
                        '<div class="list2">';

                    $users = mysql_fetch_array(mysql_query("SELECT `name`
	FROM `users` 
	WHERE id='" . $add['id'] . "' LIMIT 1;"));

                    echo ceil($i + 1) . ")<b>" . $users['name'] . "</b>(" . $add['firewoods'] .
                        ")<br />";

                    ++$i;
                    echo "</div>";
                }

                break;
            case 4:
                echo "<div class='phdr'>Đá</div>";

                $rating = mysql_query("SELECT `id`,`stone` 
	FROM `emperor_users` 
	WHERE user_id='" . $idus . "' ORDER BY stone DESC LIMIT 10;");

                while ($add = mysql_fetch_array($rating))
                {
                    echo ceil(ceil($i / 2) - ($i / 2)) == 0 ? '<div class="list1">' :
                        '<div class="list2">';

                    $users = mysql_fetch_array(mysql_query("SELECT `name`
	FROM `users` 
	WHERE id='" . $add['id'] . "' LIMIT 1;"));

                    echo ceil($i + 1) . ")<b>" . $users['name'] . "</b>(" . $add['stone'] .
                        ")<br />";

                    ++$i;
                    echo "</div>";
                }

                break;
            case 5:
                echo "<div class='phdr'>Thức ăn</div>";

                $rating = mysql_query("SELECT `id`,`meal` 
	FROM `emperor_users` 
	WHERE user_id='" . $idus . "' ORDER BY meal DESC LIMIT 10;");

                while ($add = mysql_fetch_array($rating))
                {
                    echo ceil(ceil($i / 2) - ($i / 2)) == 0 ? '<div class="list1">' :
                        '<div class="list2">';

                    $users = mysql_fetch_array(mysql_query("SELECT `name`
	FROM `users` 
	WHERE id='" . $add['id'] . "' LIMIT 1;"));

                    echo ceil($i + 1) . ")<b>" . $users['name'] . "</b>(" . $add['meal'] . ")<br />";

                    ++$i;
                    echo "</div>";
                }

                break;
            case 6:
                echo "<div class='phdr'>Vàng</div>";

                $rating = mysql_query("SELECT `id`,`golds` 
	FROM `emperor_users` 
	WHERE user_id='" . $idus . "' ORDER BY golds DESC LIMIT 10;");

                while ($add = mysql_fetch_array($rating))
                {
                    echo ceil(ceil($i / 2) - ($i / 2)) == 0 ? '<div class="list1">' :
                        '<div class="list2">';

                    $users = mysql_fetch_array(mysql_query("SELECT `name`
	FROM `users` 
	WHERE id='" . $add['id'] . "' LIMIT 1;"));

                    echo ceil($i + 1) . ")<b>" . $users['name'] . "</b>(" . $add['golds'] .
                        ")<br />";

                    ++$i;
                    echo "</div>";
                }

                break;
            case 7:
                echo "<div class='phdr'>Sắt</div>";

                $rating = mysql_query("SELECT `id`,`gland` 
	FROM `emperor_users` 
	WHERE user_id='" . $idus . "' ORDER BY gland DESC LIMIT 10;");

                while ($add = mysql_fetch_array($rating))
                {
                    echo ceil(ceil($i / 2) - ($i / 2)) == 0 ? '<div class="list1">' :
                        '<div class="list2">';

                    $users = mysql_fetch_array(mysql_query("SELECT `name`
	FROM `users` 
	WHERE id='" . $add['id'] . "' LIMIT 1;"));

                    echo ceil($i + 1) . ")<b>" . $users['name'] . "</b>(" . $add['gland'] .
                        ")<br />";

                    ++$i;
                    echo "</div>";
                }

                break;
            default:
                echo "<div class='phdr'>Người Giàu Nhất</div>";

                $rating = mysql_query("SELECT `id`,`pinigai` 
	FROM `emperor_users` 
	WHERE user_id='" . $idus . "' ORDER BY pinigai DESC LIMIT 10;");

                while ($add = mysql_fetch_array($rating))
                {
                    echo ceil(ceil($i / 2) - ($i / 2)) == 0 ? '<div class="list1">' :
                        '<div class="list2">';

                    $users = mysql_fetch_array(mysql_query("SELECT `name`
	FROM `users` 
	WHERE id='" . $add['id'] . "' LIMIT 1;"));

                    echo ceil($i + 1) . ")<b>" . $users['name'] . "</b>(" . $add['pinigai'] .
                        ")<br />";

                    ++$i;
                    echo "</div>";
                }
        }
        echo "---------<br/>";
        echo "<a href='game.php?act=static'>Quay lại!</a><br />";
        break;
        ////////////////////////////////////////////////////
        // Главная                                        //
        ////////////////////////////////////////////////////
    default:
        echo "<div class='phdr'><img src='img/first.gif' alt='+'/>";
        echo "Top sỡ hửu vật phẩm</div>";
        echo "<a href='game.php?act=static&amp;do=rating&amp;id=1'>Giàu nhất</a><br/>";
        echo "<a href='game.php?act=static&amp;do=rating&amp;id=2'>Người nhiều đất nhất</a><br/>";
        echo "<a href='game.php?act=static&amp;do=rating&amp;id=3'>Gổ</a><br/>";
        echo "<a href='game.php?act=static&amp;do=rating&amp;id=4'>Đá</a><br/>";
        echo "<a href='game.php?act=static&amp;do=rating&amp;id=5'>Thực Phẩm</a><br/>";
        echo "<a href='game.php?act=static&amp;do=rating&amp;id=6'>Vàng</a><br/>";
        echo "<a href='game.php?act=static&amp;do=rating&amp;id=7'>Sắt</a><br/>";
        echo "---------<br/>";
}

echo "<a href='game.php?'>Trong trò chơi</a><br/>";

?>