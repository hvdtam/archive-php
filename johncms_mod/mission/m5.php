<?php
define('_IN_JOHNCMS', 1);
$textl = 'Nhiệm vụ truyền thuyết 5 - Vàng Chiến Chấm! ';
$headmod = 'nick';
require_once ("../incfiles/core.php");
require_once ("../incfiles/head.php");
if ($id && $id != $user_id) {
    $req = mysql_query("SELECT * FROM `users` WHERE `id` = '$id' LIMIT 1");
    if (mysql_num_rows($req)) {
        $user = mysql_fetch_assoc($req);
}
else {

}
}
else {
$id = false;
$user = $datauser;
}

if (!$user_id) {
    require_once ('../incfiles/head.php');
     echo display_error ('<br/>Bạn không được phép để thực hiện các hoạt động, bạn phải<br/><b><a href="../login.php">Đăng nhập</a></b> hoặc <b><a href="../registration.php">Đăng ký</a></b><br/>');
    require_once ('../incfiles/end.php');
    exit;
}
echo '<div class="menu"><a href="../mission/index.php">Danh sách nhiệm vụ truyền thuyết</a> - <a href="../users/profile.php?id=' . $user['id'] . '">Thông tin cá nhân</a></div>';
echo '<span style="color:#ff4500"><b>Nhiệm vụ 5: Cô nàng đỏng đảnh</b></span>';
if($user['mission']==4){
echo '<div><b>Lee</b>:<a href="../users/profile.php?id=' . $user['id'] . '">' . $user['name'] . '</a>, chúng ta đã lên đường 2
ngày rồi, phía trước là thị trấn Small, rất nổi tiếng với những con thú xinh xắn đấy .<div>';

echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: Ưhm, tôi cũng không quan tâm
lắm, vậy cô muốn chúng ta dùng chân ở đó sao Lee?</span><div>';

echo '<div><b>Lee</b>:đúng là ' . $user['name'] . ' ngố! ^^ Tôi muốn chúng ta mang theo một con thú cưng đáng yêu, chặng đường
rất dài, hơn nữa đi với bạn chán chết à, tôi là một cô bé dễ thương tôi cần có một con vật nuôi xinh xinh chứ! .<div>';
echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: Vậy cô muốn gì nào Lee</span><div>';

echo '<div><b>kyndy</b>:<a href="../users/profile.php?id=' . $user['id'] . '">' . $user['name'] . '</a> à, đi mua cho tôi một con thú nuôi nhé, tôi nghĩ giá của nó
cũng không mắc lắm đâu, hơn nữa chủ cửa tiệm thú nuôi là người quen của tôi mà, hãy đi nhanh lên rồi chúng ta sẽ tiếp tục đi
tôi sẽ không bắt bạn dừng lại đây chơi đùa đâu, tôi chỉ muốn một pet xinh thôi!<div>';
echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: Chặng đường phía trước còn dài, 
tôi ước không phải đi cùng cô bé đỏng đảnh này...</span><div>';
echo '</br>';
echo '<div><b>Nhiệm vụ: Mua một thú nuôi từ khu vực Shop</b></div>';
echo '<div>Phần thưởng: 1.000 VND</div>';
echo '<div><a href="../mission/a5.php?act=m">Nhận nhiệm vụ Cô nàng đỏng đảnh</a></div>';
}else{
echo '<div class="menu">Chấp nhận nhiệm vụ thất bại!</div>';
}
echo '<div><a href="../mission/index.php">Danh sách nhiệm vụ truyền thuyết</a></div>';
require_once ("../incfiles/end.php");
?>