<?php

define('_IN_JOHNCMS', 1);
$headmod = 'ferma';
$rootpath = '../';
require_once ('../incfiles/core.php');
require_once ('../incfiles/ferma_func.php');

        $textl = 'Trộm';
        require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
if(!$user_id)
{         $textl = 'Ошибкa';
        require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ('<div class="rmenu">Игра доступа только авторизованым пользавателям</div>');
       
        require_once ('../incfiles/end.php');
exit;
}
if(!preg_match("|^[\d]+$|",$_GET['id']))
{         $textl = 'Ошибкa';
        require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ('<div class="bmenu">Неверный формат запроса! Проверьте URL!</div>');
       require_once ('../incfiles/end.php');
exit;
}
////Конец шапки////
$id = intval ( $_GET['id'] ) ? ( int ) $_GET['id'] : NULL;
////Проверяем существует грядка с таким ид////
if(mysql_num_rows(mysql_query ( "SELECT * FROM `ferma` WHERE `id`='" . $id . "' LIMIT 1" )) == 0){
              $textl = 'Ошибка';
        require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl. '</div>       <div class="rmenu">Такой фермы нет</div>' );
       require_once ('../incfiles/end.php');
exit;
}
////Получаем различный инфу////
$f = mysql_fetch_assoc(mysql_query("SELECT * FROM `ferma` WHERE `id` = '$id' LIMIT 1")); 
$user = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$user_id' LIMIT 1"));
$user2 = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '" .$f['user']. "' LIMIT 1"));


if ($user_id != $user2['id'] && $ferma['dohot'] >= 100) {
$rand = rand(1, 2);

if ($rand == 1) {

if ($_SESSION['time'] > ($time - 86400) && $_SESSION['ferma'] == $id) {      $textl = 'Ошибка';
        require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo '<b>Вы уже грабил эту ферму. Одну и туже ферму можно грабить только раз в сутки</b><br/>';
echo ( '<div class="menu">
<a href="/ferma/index.php?">Về nông trại</a></div>' );
        require_once ('../incfiles/end.php');
exit;
} else {
        $_SESSION['time'] = time();
        $_SESSION['ferma'] = $id;
}
 mysql_query("UPDATE `users` SET `balans`=`balans`+'" .rand(). "' WHERE `id`='".$user['id']."'");
mysql_query("UPDATE `ferma` SET `dohot`=`dohot`-'" .rand(). "' WHERE `id`='".$id."'");

echo ( '<div class="rmenu">Вы успешно ограбили юзера ' .$user['name']. ' И получили за это ' .rand(). '.
Мы крайне не рекоментуем сдесь бывать часто за каждый проигрыш вы можете потерять от 20 до 100000 монет</div>' );

                    mysql_query("insert into `privat` values(0,'" . $user2['name2'] . "','Вас ограбил " .$user['name']. " и украл у вас " .rand()."','" . $realtime . " игровых балов сайта','" . $user2['name']. "','out','no','Вас ограбили','0','','','','');");
}
if ($rand == 2)
{
if ($_SESSION['time'] > ($time - 86400) && $_SESSION['ferma'] == $id) {      $textl = 'Ошибка';
        require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo '<b>Вы уже грабил эту ферму. Одну и туже ферму можно грабить только раз в сутки</b><br/>';
echo ( '<div class="menu">
<a href="/ferma/index.php?">về nông trại</a></div>' );
        require_once ('../incfiles/end.php');
exit;
} else {
        $_SESSION['time'] = time();
        $_SESSION['ferma'] = $id;
}
 mysql_query("UPDATE `users` SET `balans`=`balans`+'".rand()."' WHERE `id`='".$user2['id']."'");
mysql_query("UPDATE `users` SET `balans`=`balans`-'".rand()."' WHERE `id`='".$user['id']."'");

 echo ( '<div class="rmenu">Уважаемый(ая) ' .$login. ' ваша попытка ограбить ' .$user2['name']. ' оказалась не удачной. ' .$user2['name']. ' забрал у вас в качестве компинсаций ' .rand(). ' монет</div>' );

                    mysql_query("insert into `privat` values(0,'" . $user2['name'] . "','На вас напал " .$user['name']. " Но он получил отпор в качестве компинсаций вам начислено " .rand()." игровых баллов','" . $realtime . "','" . $login. "','out','no','На вас напали','0','','','','');");
}

}else{
echo ( '<div class="rmenu">Để ăn trộm được tài sản của bạn hoặc người bị trộm ít nhất phải có 100 Xu</div>' ); 
}
echo ( '<div class="menu">
<a href="/ferma/index.php?">Về nông trại</a></div>' );
        require_once ('../incfiles/end.php');
?>