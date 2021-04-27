<?php

define('_IN_JOHNCMS', 1);

$textl = 'Nhiệm vụ truyền thuyết 6 - Vàng Chiến Chấm! ';

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

echo '<div class="bmenu">Nhiệm vụ 6: Mụ phù thuỷ Jane</div>';

if($user['balans']>=2000){

echo '<span style="color:#ff4500"><b>Tìm rìu sắt đôi thật:</b></span>';

echo '<li><span class="gray"><a href="../mission/1a6.php?act=m"><img src="../level/riusatdoi.gif" width="25" height="15" align="middle"/></a>

<a href="../mission/2a6.php?act=m"><img src="../level/riusatdoi.gif" width="25" height="15" align="middle"/></a>

<a href="../mission/3a6.php?act=m"><img src="../level/riusatdoi.gif" width="25" height="15" align="middle"/></a>

<a href="../mission/4a6.php?act=m"><img src="../level/riusatdoi.gif" width="25" height="15" align="middle"/></a>

<a href="../mission/5a6.php?act=m"><img src="../level/riusatdoi.gif" width="25" height="15" align="middle"/></a>

<a href="../mission/6a6.php?act=m"><img src="../level/riusatdoi.gif" width="25" height="15" align="middle"/></a>

<a href="../mission/7a6.php?act=m"><img src="../level/riusatdoi.gif" width="25" height="15" align="middle"/></a></li></br>';

echo '<li><span class="gray"><a href="../mission/8a6.php?act=m"><img src="../level/riusatdoi.gif" width="25" height="15" align="middle"/></a>

<a href="../mission/9a6.php?act=m"><img src="../level/riusatdoi.gif" width="25" height="15" align="middle"/></a>

<a href="../mission/10a6.php?act=m"><img src="../level/riusatdoi.gif" width="25" height="15" align="middle"/></a>

<a href="../mission/11a6.php?act=m"><img src="../level/riusatdoi.gif" width="25" height="15" align="middle"/></a>

<a href="../mission/12a6.php?act=m"><img src="../level/riusatdoi.gif" width="25" height="15" align="middle"/></a>

<a href="../mission/13a6.php?act=m"><img src="../level/riusatdoi.gif" width="25" height="15" align="middle"/></a>

<a href="../mission/14a6.php?act=m"><img src="../level/riusatdoi.gif" width="25" height="15" align="middle"/></a></li></br>';

echo '<li><span class="gray"><a href="../mission/15a6.php?act=m"><img src="../level/riusatdoi.gif" width="25" height="15" align="middle"/></a>

<a href="../mission/16a6.php?act=m"><img src="../level/riusatdoi.gif" width="25" height="15" align="middle"/></a>

<a href="../mission/17a6.php?act=m"><img src="../level/riusatdoi.gif" width="25" height="15" align="middle"/></a>

<a href="../mission/18a6.php?act=m"><img src="../level/riusatdoi.gif" width="25" height="15" align="middle"/></a>

<a href="../mission/19a6.php?act=m"><img src="../level/riusatdoi.gif" width="25" height="15" align="middle"/></a>

<a href="../mission/20a6.php?act=m"><img src="../level/riusatdoi.gif" width="25" height="15" align="middle"/></a>

<a href="../mission/21a6.php?act=m"><img src="../level/riusatdoi.gif" width="25" height="15" align="middle"/></a></li>';

}else{

echo '<div class="menu">Chấp nhận nhiệm vụ thất bại!</div>';

}

require_once ("../incfiles/end.php");

?>