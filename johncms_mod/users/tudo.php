<?php

define('_IN_JOHNCMS', 1);

$textl = 'Tủ đồ của tôi';

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

display_error('Chỉ cho người dùng đăng ký');

require_once ('../incfiles/end.php');

exit;

}

echo '<div class="menu"><a href="../shop/shop.php">Shop</a> | <a href="../users/profile.php">Cá nhân</a> | <a href="../shop/bank.php">Ngân hàng</a></div>';

echo '<li><span class="gray"><b>Tài khoản của'. $user['name'] . ' đang có:</b></li>';

if (!empty($user['vgold']))

echo '<li><span class="gray">VGold: </span>' . $user['vgold'] . '</li>';

if (!empty($user['balans']))

echo '<li><span class="gray">VND: </span>' . $user['balans'] . '</li>';

echo '<li><span class="gray"><b><color=#ff00ff>Tủ đồ của '. $user['name'] . '</color></b></li>';

echo '<div class="menu">Nhân vật '. $user['name'] . '</div>';

///////////////////////////////////////////////////////////////////

echo '<div align="right">

<table border="0" width="50%">

<tr>

<td>';



echo '<div align="right" style="position: absolute; width: 100px; height: 100px; z-index: 1;" id="layer1">';

if ($user['sex']==zh){echo "<img src='/style/nu.png' border='0' width='120' height='150'></b> \n";} else {echo "<img src='/style/nam.png' border='0' width='120' height='150'> \n";}

echo '</div>';

echo '<div align="right" style="position: absolute; width: 100px; height: 100px; z-index: 1;" id="layer3">';

if ($user['quan']==0) echo '';

else if ($user['quan']==1) echo '<img src="../item/quan/boy/1.png" alt="" class="icon"/>';
else if ($user['quan']==2) echo '<img src="../item/quan/boy/2.png" alt="" class="icon"/>';
else if ($user['quan']==3) echo '<img src="../item/quan/boy/3.png" alt="" class="icon"/>';
else if ($user['quan']==4) echo '<img src="../item/quan/boy/4.png" alt="" class="icon"/>';
else if ($user['quan']==5) echo '<img src="../item/quan/boy/5.png" alt="" class="icon"/>';
else if ($user['quan']==6) echo '<img src="../item/quan/boy/6.png" alt="" class="icon"/>';
else if ($user['quan']==7) echo '<img src="../item/quan/boy/7.png" alt="" class="icon"/>';
else if ($user['quan']==8) echo '<img src="../item/quan/boy/8.png" alt="" class="icon"/>';
else if ($user['quan']==-1) echo '<img src="../item/quan/girl/1.png" alt="" class="icon"/>';
else if ($user['quan']==-2) echo '<img src="../item/quan/girl/2.png" alt="" class="icon"/>';
else if ($user['quan']==-3) echo '<img src="../item/quan/girl/3.png" alt="" class="icon"/>';
else if ($user['quan']==-4) echo '<img src="../item/quan/girl/4.png" alt="" class="icon"/>';
else if ($user['quan']==-5) echo '<img src="../item/quan/girl/5.png" alt="" class="icon"/>';
else if ($user['quan']==-6) echo '<img src="../item/quan/girl/6.png" alt="" class="icon"/>';
else if ($user['quan']==-7) echo '<img src="../item/quan/girl/7.png" alt="" class="icon"/>';

echo '</div>';

echo '<div align="right" style="position: absolute; width: 100px; height: 100px; z-index: 1;" id="layer2">';

if ($user['toc']==0) echo '';

else if ($user['toc']==1) echo '<img src="../item/toc/boy/1.png" alt="" class="icon"/>';
else if ($user['toc']==2) echo '<img src="../item/toc/boy/2.png" alt="" class="icon"/>';
else if ($user['toc']==3) echo '<img src="../item/toc/boy/3.png" alt="" class="icon"/>';
else if ($user['toc']==4) echo '<img src="../item/toc/boy/4.png" alt="" class="icon"/>';
else if ($user['toc']==5) echo '<img src="../item/toc/boy/5.png" alt="" class="icon"/>';
else if ($user['toc']==6) echo '<img src="../item/toc/boy/6.png" alt="" class="icon"/>';
else if ($user['toc']==7) echo '<img src="../item/toc/boy/7.png" alt="" class="icon"/>';
else if ($user['toc']==8) echo '<img src="../item/toc/boy/8.png" alt="" class="icon"/>';
else if ($user['toc']==9) echo '<img src="../item/toc/boy/9.png" alt="" class="icon"/>';
else if ($user['toc']==10) echo '<img src="../item/toc/boy/10.png" alt="" class="icon"/>';
else if ($user['toc']==11) echo '<img src="../item/toc/boy/11.png" alt="" class="icon"/>';
else if ($user['toc']==12) echo '<img src="../item/toc/boy/12.png" alt="" class="icon"/>';
else if ($user['toc']==13) echo '<img src="../item/toc/boy/13.png" alt="" class="icon"/>';
else if ($user['toc']==14) echo '<img src="../item/toc/boy/14.png" alt="" class="icon"/>';
else if ($user['toc']==-1) echo '<img src="../item/toc/girl/1.png" alt="" class="icon"/>';
else if ($user['toc']==-2) echo '<img src="../item/toc/girl/2.png" alt="" class="icon"/>';
else if ($user['toc']==-3) echo '<img src="../item/toc/girl/3.png" alt="" class="icon"/>';
else if ($user['toc']==-4) echo '<img src="../item/toc/girl/4.png" alt="" class="icon"/>';
else if ($user['toc']==-5) echo '<img src="../item/toc/girl/5.png" alt="" class="icon"/>';
else if ($user['toc']==-6) echo '<img src="../item/toc/girl/6.png" alt="" class="icon"/>';
else if ($user['toc']==-7) echo '<img src="../item/toc/girl/7.png" alt="" class="icon"/>';
else if ($user['toc']==-8) echo '<img src="../item/toc/girl/8.png" alt="" class="icon"/>';
else if ($user['toc']==-9) echo '<img src="../item/toc/girl/9.png" alt="" class="icon"/>';
else if ($user['toc']==-10) echo '<img src="../item/toc/girl/10.png" alt="" class="icon"/>';
else if ($user['toc']==11) echo '<img src="../item/toc/girl/item/11.png" alt="" class="icon"/>';
else if ($user['toc']==12) echo '<img src="../item/toc/girl/item/12.png" alt="" class="icon"/>';
else if ($user['toc']==13) echo '<img src="../item/toc/girl/item/13.png" alt="" class="icon"/>';
else if ($user['toc']==14) echo '<img src="../item/toc/girl/item/14.png" alt="" class="icon"/>';
else if ($user['toc']==15) echo '<img src="../item/toc/girl/item/15.png" alt="" class="icon"/>';
else if ($user['toc']==16) echo '<img src="../item/toc/girl/item/16.png" alt="" class="icon"/>';
else if ($user['toc']==17) echo '<img src="../item/toc/girl/item/17.png" alt="" class="icon"/>';
echo '</div>';

echo '<div align="right" style="position: absolute; width: 100px; height: 100px; z-index: 1;" id="layer4">';

if ($user['ao']==0) echo '';

else if ($user['ao']==1) echo '<img src="../item/ao/boy/1.png" alt="" class="icon"/>';
else if ($user['ao']==2) echo '<img src="../item/ao/boy/2.png" alt="" class="icon"/>';
else if ($user['ao']==3) echo '<img src="../item/ao/boy/3.png" alt="" class="icon"/>';
else if ($user['ao']==4) echo '<img src="../item/ao/boy/4.png" alt="" class="icon"/>';
else if ($user['ao']==5) echo '<img src="../item/ao/boy/5.png" alt="" class="icon"/>';
else if ($user['ao']==6) echo '<img src="../item/ao/boy/6.png" alt="" class="icon"/>';
else if ($user['ao']==7) echo '<img src="../item/ao/boy/7.png" alt="" class="icon"/>';
else if ($user['ao']==8) echo '<img src="../item/ao/boy/8.png" alt="" class="icon"/>';
else if ($user['ao']==9) echo '<img src="../item/ao/boy/9.png" alt="" class="icon"/>';
else if ($user['ao']==10) echo '<img src="../item/ao/boy/10.png" alt="" class="icon"/>';
else if ($user['ao']==11) echo '<img src="../item/ao/boy/11.png" alt="" class="icon"/>';
else if ($user['ao']==12) echo '<img src="../item/ao/boy/12.png" alt="" class="icon"/>';
else if ($user['ao']==-1) echo '<img src="../item/ao/girl/1.png" alt="" class="icon"/>';
else if ($user['ao']==-2) echo '<img src="../item/ao/girl/2.png" alt="" class="icon"/>';
else if ($user['ao']==-3) echo '<img src="../item/ao/girl/3.png" alt="" class="icon"/>';
else if ($user['ao']==-4) echo '<img src="../item/ao/girl/4.png" alt="" class="icon"/>';
else if ($user['ao']==-5) echo '<img src="../item/ao/girl/5.png" alt="" class="icon"/>';
else if ($user['ao']==-6) echo '<img src="../item/ao/girl/6.png" alt="" class="icon"/>';
else if ($user['ao']==-7) echo '<img src="../item/ao/girl/7.png" alt="" class="icon"/>';
else if ($user['ao']==-8) echo '<img src="../item/ao/girl/8.png" alt="" class="icon"/>';
else if ($user['ao']==-9) echo '<img src="../item/ao/girl/9.png" alt="" class="icon"/>';
else if ($user['ao']==-10) echo '<img src="../item/ao/girl/10.png" alt="" class="icon"/>';

echo '</div>';

echo '<div align="right" style="position: absolute; width: 100px; height: 100px; z-index: 1;" id="layer5">';

if ($user['giay']==0) echo '';

else if ($user['giay']==1) echo '<img src="../item/giay/boy/1.png" alt="" class="icon"/>';
else if ($user['giay']==2) echo '<img src="../item/giay/boy/2.png" alt="" class="icon"/>';
else if ($user['giay']==3) echo '<img src="../item/giay/boy/3.png" alt="" class="icon"/>';
else if ($user['giay']==4) echo '<img src="../item/giay/boy/4.png" alt="" class="icon"/>';
else if ($user['giay']==5) echo '<img src="../item/giay/boy/5.png" alt="" class="icon"/>';
else if ($user['giay']==6) echo '<img src="../item/giay/boy/6.png" alt="" class="icon"/>';
else if ($user['giay']==7) echo '<img src="../item/giay/boy/7.png" alt="" class="icon"/>';
else if ($user['giay']==8) echo '<img src="../item/giay/boy/8.png" alt="" class="icon"/>';
else if ($user['giay']==-1) echo '<img src="../item/giay/girl/1.png" alt="" class="icon"/>';
else if ($user['giay']==-2) echo '<img src="../item/giay/girl/2.png" alt="" class="icon"/>';
else if ($user['giay']==-3) echo '<img src="../item/giay/girl/3.png" alt="" class="icon"/>';
else if ($user['giay']==-4) echo '<img src="../item/giay/girl/4.png" alt="" class="icon"/>';
else if ($user['giay']==-5) echo '<img src="../item/giay/girl/5.png" alt="" class="icon"/>';
else if ($user['giay']==-6) echo '<img src="../item/giay/girl/6.png" alt="" class="icon"/>';
else if ($user['giay']==14) echo '<img src="/style/giay/boy/14.png" alt="" class="icon"/>';
else if ($user['giay']==15) echo '<img src="/style/giay/boy/15.png" alt="" class="icon"/>';
else if ($user['giay']==16) echo '<img src="/style/giay/boy/16.png" alt="" class="icon"/>';
else if ($user['giay']==17) echo '<img src="/style/giay/boy/17.png" alt="" class="icon"/>';
else if ($user['giay']==18) echo '<img src="/style/giay/boy/18.png" alt="" class="icon"/>';
else if ($user['giay']==19) echo '<img src="/style/giay/boy/19.png" alt="" class="icon"/>';
else if ($user['giay']==20) echo '<img src="/style/giay/boy/20.png" alt="" class="icon"/>';

echo '</div>';

echo '<div align="right" style="position: absolute; width: 100px; height: 100px; z-index: 1;" id="layer5">';if ($user['kiem']==0) echo '';else if ($user['kiem']==1) echo '<img src="../item/kiem/boy/1.png" alt="" class="icon"/>';else if ($user['kiem']==2) echo '<img src="../item/kiem/boy/2.png" alt="" class="icon"/>';else if ($user['kiem']==-1) echo '<img src="../item/kiem/girl/1.png" alt="" class="icon"/>';else if ($user['kiem']==-2) echo '<img src="../item/kiem/girl/2.png" alt="" class="icon"/>';echo '</div>';













echo '</td>

</tr>

</table>

</div>

';

/////////////////////////////////////////////////////////////////////



//////////////////////////////////////////////////////////////////////
echo '<div><span class="menu"><b>Thẻ</b></div></br>';
if (!empty($user['the']))
echo '<li><span class="gray"></span><img src="../images/the/' . $user['the'] . '.gif" alt="' . $user['the'] . '" width="50" height="50" align="middle" /></li>';

echo '<div>____________________</div></br>';////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

echo '<div><span class="menu"><b>Phụ Kiện</b></div></br>';

if (!empty($user['phukien']))

echo '<li><span class="gray"></span><img src="../images/phukien/' . $user['phukien'] . '.gif" alt="' . $user['phukien'] . '" width="50" height="50" align="middle" /></li>';

echo '<div>____________________</div></br>';

//////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////
echo '<div><span class="menu"><b>Vũ Khí</b></div></br>';

if (!empty($user['vukhi']))

echo '<li><span class="gray"></span><img src="../images/vukhi/' . $user['vukhi'] . '.jpg" alt="' . $user['vukhi'] . '" width="50" height="50" align="middle" /></li>';echo '<div>____________________</div></br>';

//////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////
echo '<div><span class="menu"><b>Thú cưng</b></div></br>';

if (!empty($user['pet']))

echo '<li><span class="gray"></span><img src="../pet/' . $user['pet'] . '.gif" alt="' . $user['pet'] . '" width="50" height="50" align="middle" /></li>';

echo '<div>____________________</div></br>';

//////////////////////////////////////////////////////////////////////

echo '<div class="menu"><a href="../shop/index.php">Shop Thời Trang</a></div>';

require_once ("../incfiles/end.php");

?>
