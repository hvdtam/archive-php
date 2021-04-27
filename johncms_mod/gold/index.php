<?php
define('_IN_JOHNCMS', 1);
$textl = 'Lật đồng tiền';
require_once ("../incfiles/core.php");
require_once ("../incfiles/head.php");
$rand = mt_rand(100, 999);
$balans_plus = "2000";
$balans_minus = "1500";
echo "<div class='phdr'>Lật đồng tiền</div>";
if ($user_id) {

    switch ($act) {

        case "go":

            if ($datauser['balans'] >= 2000) {

$num1=trim($_POST['rezka']);
$num3 = mt_rand(1, 2);
echo '<div class="gmenu">';
echo 'Bạn đã lật đồng tiền: <br/>';
echo '<img src="' . $num1 . '.gif" alt=""/><br/><br/>';
echo 'Kết quả: <br/>';
echo '<img src="' . $num3 . '.gif" alt=""/><br/><br/></div>';
$num_bank = $num1;
$num_user = $num3;
if ($num_bank > $num_user) {
mysql_query("UPDATE `users` SET `balans`=`balans` - " . $balans_minus . " WHERE `id`='" .
$user_id . "' LIMIT 1;");
echo '<b>Đoán sai bét, bạn đã bị trừ ' .$balans_minus. ' VND. Chúc bạn may mắn lần sau!!</b>';
}
if ($num_bank < $num_user) {
mysql_query("UPDATE `users` SET `balans`=`balans` - " . $balans_minus . " WHERE `id`='" .
$user_id . "' LIMIT 1;");
echo '<h3><span class="green">Đoán sai bét, bạn đã bị trừ ' .$balans_minus. ' VND. Chúc bạn may mắn lần sau!!</span></h3>';
}
if ($num_bank == $num_user) {
mysql_query("UPDATE `users` SET `balans` = `balans` + " . $balans_plus . " WHERE `id`='" .
$user_id . "' LIMIT 1;");
echo '<b>Hay wá!Đúng rồi! Bạn đã đoán chính xác và nhận được ' .$balans_plus. ' VND</b>';
}
echo '<br />Вạn có: ' .$datauser['balans']. ' VND';
echo '</div><div class="menu">
<b><a href="index.php">Chơi tiếp</a></b><br/>';
echo '<a href="?">Trở lại</a><br />';
                /////////////////////////
                //задержка 1 сек
                //sleep(1);
                ///////////////////////
            } else {
                echo "Bạn ko đủ tiền để chơi!";
                echo "<div class='menu'><a href='../?'>Trong phần</a></div>";
                require_once ("../incfiles/end.php");
                exit;
            }

            break;
case "faq":
            echo '<div class="gmenu">Để tham gia vào trò chơi. Nhấn chọn và nhấn phía bên của đồng tiền "lật"<br/>';
            echo 'Khi đoán sai bạn sẽ bị trừ ' . $balans_minus . 'VND<br/>';
            echo 'Khi đoán đúng bạn sẽ đc cộng ' . $balans_plus . 'VND<br/>';
            echo 'Bạn có thể chơi với tinh thần công bằng và tích cực<br/>';
            echo 'Chúc may mắn!</div>';

            echo '<div class="menu"><a href="?">Trở lại</a></div><br />';
            break;

        default:
            echo '<center><img src="0.gif" alt="?"/></center><div class="rmenu">Theo bạn thì một trong 2 đồng tiền ở phía dưới đồng tiền nào là đồng tiền ở trên?</div><div class="gmenu"><img src="1.gif" alt="hình"/> hay <img src="2.gif" alt="số"/><br/><b>Hình</b> hay <b>Số?</b></div><br/><br/>';


            echo 'Вạn có: ' . $datauser['balans'] . 'VND<br/>';
{
    echo 'Lật đồng tiền có:<form action="index.php?act=go" method="post">';
    echo '<select name="rezka">
    <option value="1">Hình</option>
    <option value="2">Số</option>
    
    </select><input type="submit" name="orel" value="Lật ngay!" style="font-size:x-small"/>';
    echo '</form>';
}
            echo '</div><div class="menu">
<a href="?act=faq&amp;">FAQ</a><br />';
            break;
}
} else {
    echo "Bạn cần đăng nhập để chơi game này!";
}

require_once ("../incfiles/end.php");

?>