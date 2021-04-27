<?define('_IN_JOHNCMS', 1); 
$textl = 'Nhiệm vụ truyền thuyết - Vàng Chiến Chấm! '; 
$headmod = 'nick'; 
require_once ("../incfiles/core.php");
if (!$user_id) {    require('../incfiles/head.php');    echo functions::display_error($lng['access_guest_forbidden']);    require('../incfiles/end.php');    exit;}
require_once ('../incfiles/head.php'); 
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
echo '<div class="bmenu">Danh sách nhiệm vụ truyền thuyết - <a href="../users/profile.php?id=' . $user['id'] . '">Thông tin cá nhân</a></div>';   
echo '<span style="color:#ff4500"><b>Danh sách nhiệm vụ:</b></span>'; 
echo '<li><span><a href="../mission/m1.php">Nhiệm vụ cấp 1. Bước khởi đầu</a></br> Người giao: Kyndy </li>'; 
echo '<li><span><a href="../mission/m2.php">Nhiệm vụ cấp 2. Những người bạn</a></br> Người giao: Kyndy </li>'; 
echo '<li><span><a href="../mission/m3.php">Nhiệm vụ cấp 3. Lời thách thức của Lee</a></br> Người giao: Lee </li>'; 
echo '<li><span><a href="../mission/m4.php">Nhiệm vụ cấp 4. Ông ấy nói ' . $user['name'] . ' hãy biết cảm ơn!</a></br> Tiếp nhận nhiệm vụ: Kyndy </li>'; 
echo '<li><span><a href="../mission/m5.php">Nhiệm vụ cấp 5. Cô nàng đỏng đảnh</a></br> Tiếp nhận nhiệm vụ: Lee </li>'; 
echo '<li><span><a href="../mission/m6.php">Nhiệm vụ cấp 6. Mụ phù thuỷ Jane</a></br> Tiếp nhận nhiệm vụ: Jane </li>'; 
echo '<li><span><a href="../mission/m7.php">Nhiệm vụ cấp 7. Nông trại vui vẻ</a></br> Tiếp nhận nhiệm vụ: Thuny </li>'; 
echo '<li><span><a href="../mission/m8.php">Nhiệm vụ cấp 8. Tập luyện</a></br> Tiếp nhận nhiệm vụ: Thuny </li>'; 
echo '<li><span><a href="http://vn.mhatinh.com">Nhiệm vụ cấp 9. Câu trả lời của tôi(Chưa mở)</a></br> Tiếp nhận nhiệm vụ: Zone </li>'; 
echo '<li><span><a href="http://vn.mhatinh.com">Nhiệm vụ cấp 10. Chiếc mũ thần kỳ(Chưa mở)</a></br> Tiếp nhận nhiệm vụ: Darkking </li>'; 
///////////////////////////////////////////////////////////////////////////////////////////////////////////// 
echo '<div class="bmenu">Thông tin Nhân Vật</div>'; 
///////////////////////////////////////////////////////////////////   
                                                                                     
                        echo '<li>Cấp bậc: ' . $chucdanh . ' </li>'; 
if (!empty($user['status'])) 
    echo '<li><span class="gray">Tâm trạng: </span><img src="../tamtrang/' . $user['status'] . '.gif" alt="' . $user['status'] . '" border="0" height="15" align="middle" /></li>';     
////////////////////////////////////////////////////////// 
if (!empty($user['fam'])) 
    echo '<li><span class="gray">Fam: </span>' . $user['fam'] . '</li>';   
if (!empty($user['vgold'])) 
    echo '<li><span class="gray">VGold: </span>' . $user['vgold'] . '</li>';   
if (!empty($user['balans'])) 
    echo '<li><span class="gray">VND: </span>' . $user['balans'] . '</li>'; 
if (!empty($user['postforum'])) 
    echo '<li><span class="gray">Post: </span>' . $user['postforum'] . '</li>'; 
if (!empty($user['postguest'])) 
    echo '<li><span class="gray">Chat: </span>' . $user['postguest'] . '</li>'; 
if (!empty($user['mission'])) 
    echo '<li><span class="gray">Nhiệm vụ truyền thuyết: </span><b style="color:red;">' . $user['mission'] . '</b>/60</li>';   
////////////////////////////////////////// 
$user_u = $user['id']; 
$req_u = mysql_query("SELECT * FROM `users` WHERE `id` = '$user_u' LIMIT 1"); 
$res_u = mysql_fetch_array($req_u); 
$exp = $res_u['postforum']*155+$res_u['postguest']*10; 
echo '<li><span class="red">Điểm kinh nghiệm: <b>' . $exp . '</b> exp</span></li>'; 
////////////////////////     
   
require_once ("../incfiles/end.php"); 
?>