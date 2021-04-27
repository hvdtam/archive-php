<?php
defined('_IN_JOHNCMS') or die('Error: restricted access');
require_once ("../incfiles/head.php");

$do = isset($_GET['do']) ? trim($_GET['do']) : ''; // Chọn hành động

//Horsemen
$riders = $ms['riders'] * 5;

//Tàu
$ships = $ms['ships'] * 50;

//Công trình bảo vệ
$tower = $ms['tower'] * 40;

//Стена
$wall = $ms['wall'] * 500;

//số nhà thờ (bảo vệ)
$churches = $ms['churches'] * 40;

//Tấn công
$attack = $riders + $ships + $tower;
//Bảo vệ
$defence = $attack + $wall + $churches;

switch ($do)
{
        ////////////////////////////////////////////////////
        // Список императоров                             //
        ////////////////////////////////////////////////////
    case "emperors":
        echo "<div class='phdr'><img src='img/imperatorius.gif' alt='+'/> Hoàng đế</div>";

        $count = mysql_result(mysql_query("SELECT COUNT(`id`) FROM `emperor_users` WHERE warriors>'999';"),
            0);

        $rating = mysql_query("SELECT `id` 
	FROM `emperor_users` 
	WHERE warriors>'999' ORDER BY warriors DESC LIMIT " . $start . "," . $kmess .
            ";");

        while ($add = mysql_fetch_array($rating))
        {
            echo ceil(ceil($i / 2) - ($i / 2)) == 0 ? '<div class="list1">' :
                '<div class="list2">';

            $users = mysql_fetch_array(mysql_query("SELECT `name`
	FROM `users` 
	WHERE id='" . $add['id'] . "' LIMIT 1;"));

            echo "<a href='game.php?act=opponent&amp;do=emperors&amp;id=" . $add['id'] .
                "'><b>" . $users['name'] . "</b></a>";

            ++$i;
            echo "</div>";
        }

        echo ($count > 0 ? '<hr />Chỉ đạo: ' . $count . '<br/>' :
            'Hoàng đế đã sẵn sàng để tấn công!<hr />');

        if ($count > $kmess)
        {
            // Bằng cách chuyển hướng trang
            echo '<p>' . pagenav('game.php?act=opponent&amp;do=emperors&amp;', $start, $count,
                $kmess) . '</p>';
            echo '<p><form action="index.php" method="get">
			<input type="text" name="page" size="2"/>
			<input type="hidden" name="act" value="opponent"/>
			<input type="hidden" name="do" value="emperors"/>
			<input type="submit" value="К странице &gt;&gt;"/></form></p>';
        }

        echo "---------<br/>";
        echo "<a href='game.php?act=shachta'>Quay lại</a><br />";
        break;
        ////////////////////////////////////////////////////
        // Главная                                        //
        ////////////////////////////////////////////////////
    default:
        echo "<div class='phdr'>Tấn công</div>";

        echo "<img src='img/gynyba.gif' alt='+'/><br/>Cuộc tấn công của bạn: <b>" . $attack .
            "</b><br/>";
        echo "Bảo vệ của bạn: <b>" . $defence . "</b><br/>";
        echo "---------<br/>";
        echo "<a href='game.php?act=opponent&amp;do=emperors'>Hoàng đế</a><br />";
        echo "---------<br/>";
}

echo "<a href='game.php?'>Trong trò chơi</a><br/>";

?>