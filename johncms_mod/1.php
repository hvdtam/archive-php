<?php
$day = date('d');
$month = date('m');
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `dayb`='$day' AND `monthb`='$month'"), 0);
if($total) {
echo 'Chúc mừng sinh nhật: ';
$req = mysql_query("SELECT * FROM `users` WHERE `dayb`='$day' AND `monthb`='$month' ORDER BY `name` DESC LIMIT 100");
while($res = mysql_fetch_assoc($req)) {
echo '<a href="users/profile.php?user='.$res['id'].'">'.$res['name'].'</a>, ';
}
}
?>
