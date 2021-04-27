<?
if ( $user_id && $datauser['dayb'] =='0' ||$user_id && $datauser['monthb'] =='0' ||$user_id && $datauser['yearofbirth']=='0' ){
echo '<li><div class="gmenu"   style="color:red">Bạn chưa giới thiệu về mình <a href="'.$home.'/users/profile.php?act=edit">».»</a></br></div></li>';
}
echo '<div class="fmenu">Menu Chính</div><div class="list1"><li> <a href="/forum/index.php?id=5">Diễn đàn wapsite</a></li></div><div class="list2"><li> <a href="soo">Băng nhóm</a></li></div><div class="list1"><li> <a href="chat">Phòng Chat</a></li></div><div class="list2"><li> <a href="shop">Shop Online</a></li></div><div class="list1"><li> <a href="/forum/index.php?id=16">Lưu bút</a></li></div><div class="list2"><li> <a href="users">Thành viên</a></li></div><div class="list1"><li> <a href="users/album.php">Khu Ảnh</a></li></div>';
echo'<div class="fmenu">Giải trí</div><div class="list1"><li> <a href="pages/giaitri.php">Game có thưởng</a></li></div><div class="list2"><li> <a href="http://up.wapdep.tk">Chia sẻ tập tin</a></li></div><div class="list1"><li> <a href="http://3g.wapdep.tk">Wap 3G</a></li></div>
<div class="list2"><li> <a href="users/quiz.php">Trắc nghiệm</a></li></div>
<div class="list1"><li> <a href="http://10bc1.tk">Kho truyện</a></li></div>
<div class="list2"><li> <a href="bank">Ngân hàng</a></li></div>';
?>
