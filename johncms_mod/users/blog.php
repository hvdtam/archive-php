<?php
$context_top = '<a>' .

'<div class="user"><p>' . functions::display_user($user, array ('iphide' => 1,)) . '</p></div>';



$arg = array (

'comments_table' => 'cms_users_guestbook', // Таблица Гостевой

'object_table' => 'users',                 // Таблица комментируемых объектов

'script' => 'profile.php?act=guestbook',   // Имя скрипта (с параметрами вызова)

'sub_id_name' => 'user',                   // Имя идентификатора комментируемого объекта

'sub_id' => $user['id'],                   // Идентификатор комментируемого объекта

'owner' => $user['id'],                    // Владелец объекта

'owner_delete' => true,                    // Возможность владельцу удалять комментарий

'owner_reply' => true,                     // Возможность владельцу отвечать на комментарий

'title' => $lng['comments'],               // Название раздела

'context_top' => $context_top              // Выводится вверху списка

);


$comm = new comments($arg);



if(!$mod && $user['id'] == $user_id && $user['comm_count'] != $user['comm_old']){

mysql_query("UPDATE `users` SET `comm_old` = '" . $user['comm_count'] . "' WHERE `id` = '$user_id'");

}

?>
