<?php

                                                                                        
 /*                                                                           
 ************************************************************               
 *  Profile pets by Amarelle (c) 2011 Free version          *               
 ************************************************************           
 */
			  
define('_IN_JOHNCMS', 1);
$headmod = 'profile_pets';
require('../incfiles/core.php');

// Задаем заголовки страницы
$textl = 'Kiếm';
require('../incfiles/head.php');
$cp = '<span style="float : right;"><a href="http://mchantroi.net"></a></span>';


/*
-----------------------------------------------------------------
Получаем данные пользователя
-----------------------------------------------------------------
*/
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
if($user['sex']==m) echo '<p>Không mua đồ khác giới tính</p>';
else {
switch ($act) {

		
	 case 'buy':
        /*
        -----------------------------------------------------------------
        Магазин
        -----------------------------------------------------------------
        */
		 echo '<div class="phdr">Tài khoản '.$user['vgold'].' mvn</div><div class="menu">';
		 echo 'Bạn hãy chọn cho mình thanh kiếm mình thích. Và hãy chú ý đến điểm kinh nghiệm để sử dụng được nó<br />';
	





	  //Панда
		  echo '<img src="/item/kiem/boy/item/1.png" alt="" /><br />';
		   echo '<p>Đũa thần [10000 VGold]<br><font color="red">Điểm kinh nghiệm: 105000exp</font></p>';
            if ($user['vgold'] >= 10000 && $exp >=105000)	{	   
		  echo '- <a href="?act=ok&amp;select=1">Mua Kiếm</a><br />';
		    }else{
			echo 'Chưa đủ tiền hoặc điểm kinh nghiệm<br />';
			}
			
		  echo '</div>';
		  
        break;
	
	 case 'ok':
	 
        /*
        -----------------------------------------------------------------
        Покупка
        -----------------------------------------------------------------
        */
		       $select = abs(intval($_GET['select']));
			 
			    if ($select == 1) $price = $user['vgold'] - 10000;
				if ($select == 2) $price = $user['vgold'] - 100000;
			
		 echo '<div class="phdr">Kiếm</div><div class="menu">';
		  if ($select >= 1 AND $select <= 2) {
		  if ($price >= 0) {
		   mysql_query("UPDATE `users` SET `kiem` = '$select' WHERE `id` = '$user_id' LIMIT 1");
			  mysql_query("UPDATE `users` SET `vgold` = '$price' WHERE `id` = '$user_id' LIMIT 1");
		   echo '<p>Kiếm đã mua thành công. Hãy xem hồ sơ của bạn</p> 
		     - <a href="/users/tudo.php">Tủ đồ</a>';
		   
		   }else{
		   echo 'Bạn không đủ tiền!';
		   }
		   }else{
		      echo 'Kiếm không tồn tại!';
		   }
		  echo '</div>';
        break;


		
		
    default:
	
        /*
        -----------------------------------------------------------------
        Отображаем главную страницу
        -----------------------------------------------------------------
        */
		if (isset($cp)) {
		 echo '<div class="phdr">Thú cưng của bạn '.$cp.'</div><div class="menu">';
		  echo '<span style="float : left; padding : 2px;"><img src="/images/pet/logo.png" alt="" /></span>';
		   echo '<p>Bạn muốn trang bị cho mình một thanh kiếm cho nhân vật trong hồ sơ? Hãy đi đến cửa hàng kiếm của chúng tôi!</p> 
		   - <a href="?act=buy">Cửa hàng Kiếm</a>';
		    echo '</div>';
		   if (!isset($amarelle['user_id'])) mysql_query("INSERT INTO `kiem` SET `user_id` = '".$user['id']."'");
           }
	break;
		
		
		
}
}
require('../incfiles/end.php');
?>