<?php

/*
WMR: R118530587041
ICQ: 365848916
Автор: VladiSs
Сайт: http://wapnex.ru
*/

defined('_IN_JOHNCMS') or die('Error: restricted access');

if($rights >= 8){
    
    switch($do) {
        
        case 'add':
        
        if (isset($_POST['submit'])) {
            // Принимаем данные
            $name = isset($_POST['name']) ? functions::check($_POST['name']) : '';
            $desc = isset($_POST['desc']) ? functions::check($_POST['desc']) : '';
            // Проверяем на ошибки
            $error = array();
            if (!$name)
                $error[] = $lng['error_empty_title'];
            if ($name && (mb_strlen($name) < 2 || mb_strlen($name) > 30))
                $error[] = $lng['title'] . ': ' . $lng['error_wrong_lenght'];
            if ($desc && mb_strlen($desc) < 2)
                $error[] = $lng['error_description_lenght'];
            if (!$error) {
                // Добавляем в базу категорию

              $sql =  mysql_query("INSERT INTO `soo` SET
                `type` = '1',
                `name` = '$name',
                `desc` = '$desc'");
                if($sql){
                header('Location: ../soo/?act=msoo');
                } else {
                    echo 'lôi!';
                }
            } else {
                // Выводим сообщение об ошибках
                echo functions::display_error($error);
            }
        } else {
            // Форма ввода
            echo '<div class="phdr"><b>Thêm Thể Loại:</b></div>';
            echo '<form action="../soo/?act=msoo&do=add" method="post">' .
                 '<div class="gmenu">' .
                 '<p><h3>' . $lng['title'] . '</h3>' .
                 '<input type="text" name="name" />' .
                 '<br /><small>' . $lng['minmax_2_30'] . '</small></p>' .
                 '<p><h3>' . $lng['description'] . '</h3>' .
                 '<textarea name="desc" rows="' . $set_user['field_h'] . '"></textarea>' .
                 '<br /><small>' . $lng['not_mandatory_field'] . '<br />' . $lng['minmax_2_500'] . '</small></p>' .
                 '<p><input type="submit" value="' . $lng['add'] . '" name="submit" />' .
                 '</p></div></form>' .
                 '<div class="phdr"><a href="../soo/?act=msoo">' . $lng['back'] . '</a></div>';
        }
        break;
        
        case 'edit':
        
        if (!$id) {
            echo functions::display_error($lng['error_wrong_data']);
            require('../incfiles/end.php');
            exit;
        }
        $req = mysql_query("SELECT * FROM `soo` WHERE `id` = '$id'");
        if (mysql_num_rows($req)) {
            $res = mysql_fetch_assoc($req);
                if (isset($_POST['submit'])) {
                    // Принимаем данные
                    $name = isset($_POST['name']) ? functions::check($_POST['name']) : '';
                    $desc = isset($_POST['desc']) ? functions::check($_POST['desc']) : '';
                    // проверяем на ошибки
                    $error = array();

                    if (!$name)
                        $error[] = $lng['error_empty_title'];
                    if ($name && (mb_strlen($name) < 2 || mb_strlen($name) > 30))
                        $error[] = $lng['title'] . ': ' . $lng['error_wrong_lenght'];
                    if ($desc && mb_strlen($desc) < 2)
                        $error[] = $lng['error_description_lenght'];
                    if (!$error) {
                        // Записываем в базу
                        $sql = mysql_query("UPDATE `soo` SET
                            `name` = '$name',
                            `desc` = '$desc'
                            WHERE `id` = '$id'");
                            if($sql){ 
                            header('Location: ../soo/?act=msoo');
                            } else {
                            echo 'lôi';
                            }
                            
                        } else {
                        // Выводим сообщение об ошибках
                        echo functions::display_error($error);
                    }
                } else {
                    // Форма ввода
                    echo '<div class="phdr"><b>Chỉnh Sửa:</b></div>' .
                         '<form action="../soo/?act=msoo&amp;do=edit&amp;id='. $id .'" method="post">' .
                         '<div class="gmenu">' .
                         '<p><h3>' . $lng['title'] . '</h3>' .
                         '<input type="text" name="name" value="' . $res['name'] . '"/>' .
                         '<br /><small>' . $lng['minmax_2_30'] . '</small></p>' .
                         '<p><h3>' . $lng['description'] . '</h3>' .
                         '<textarea name="desc" rows="' . $set_user['field_h'] . '">' . str_replace('<br />', "\r\n", $res['desc']) . '</textarea>' .
                         '<br /><small>' . $lng['not_mandatory_field'] . '<br />' . $lng['minmax_2_500'] . '</small></p>';

                    echo '<p><input type="submit" value="' . $lng['save'] . '" name="submit" />' .
                         '</p></div></form>' .
                         '<div class="phdr"><a href="../soo/?act=msoo">' . $lng['back'] . '</a></div>';
                }
        } else {
            header('Location: ../soo/?act=msoo');
        }
        break;
        
        
        
        case 'del';
        
        
        
        if (!$id) {
            echo functions::display_error($lng['error_wrong_data']);
            require('../incfiles/end.php');
            exit;
        }
        $req = mysql_query("SELECT * FROM `soo` WHERE `id` = '$id' AND `type` = '1'");
        if (mysql_num_rows($req)) {
            $res = mysql_fetch_assoc($req);
            echo '<div class="phdr"><b>Xóa Thể Loại '. $res['name'] .' :</div>';
            // Проверяем, есть ли подчиненная информация
            $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `soo` WHERE `cat` = '$id'"), 0);
            if ($total) {
                    ////////////////////////////////////////////////////////////
                    // Удаление раздела с подчиненными данными                //
                    ////////////////////////////////////////////////////////////
                                    if (isset($_POST['submit'])) {
                        $comms1 = mysql_query("SELECT * FROM `soo` WHERE `cat` = '$id'");
                  while ($comms = mysql_fetch_assoc($comms1)) {
                            mysql_query("DELETE  FROM `soo` WHERE `id` = '". $comms['id'] ."'");
                        }

                   
                  mysql_query("DELETE FROM `soo` WHERE `id` = '$id'");
                                      
                } else {
                    echo '<div class="rmenu"><p>Bạn có chắc bạn muốn xóa tất cả các thông tin?'.$req_fls['id'].'</p>' .
                         '<p><form action="../soo/?act=msoo&amp;do=del&amp;id='. $id .'" method="POST">' .
                         '<input type="submit" name="submit" value="' . $lng['delete'] . '" />' .
                         '</form></p></div>';
                }
            } else {
                ////////////////////////////////////////////////////////////
                // Удаление пустого раздела, или категории                //
                ////////////////////////////////////////////////////////////
                if (isset($_POST['submit'])) {
                    mysql_query("DELETE FROM `soo` WHERE `id` = '$id'");
                    echo '<div class="rmenu"><p>Mục '. $res['name'] .' Loại Bỏ!</p></div>';
                } else {
                    echo '<div class="rmenu"><p>' . $lng['delete_confirmation'] . '</p>' .
                         '<p><form action="../soo/?act=msoo&amp;do=del&amp;id='. $id .'" method="POST">' .
                         '<input type="submit" name="submit" value="' . $lng['delete'] . '" />' .
                         '</form></p></div>';
                }
            }
            echo '<div class="phdr"><a href="../soo/?act=msoo">' . $lng['back'] . '</a></div>';
        } else {
            header('Location: ../soo/?act=msoo');
        }
        break;
        
        
        
        
        default:
        echo '<div class="phdr"><b>Quản Lý:</b></div>';
        $req = mysql_query("SELECT * FROM `soo` WHERE `type`='1' ");
        $total = mysql_num_rows(mysql_query("SELECT * FROM `soo` WHERE `type`='1'  "));
        $i = 0;
        if($total > 0){
        while ($res = mysql_fetch_array($req)) {
            $totals = mysql_num_rows(mysql_query("SELECT * FROM `soo` WHERE `type`='2' AND `cat`='" . $res['id'] . "' "));
            echo $i % 2 ? '<div class="list2">' : '<div class="list1">';
            echo '<a href="../soo/?id=' . $res['id'] . '">' . $res['name'] . '</a> ('. $totals .') ';
            if (!empty($res['desc']))
                        echo '<br /><span class="gray"><small>' . $res['desc'] . '</small></span><br />';
                    echo '<div class="sub">' .
                         '<a href="../soo/?act=msoo&amp;do=edit&amp;id=' . $res['id'] . '">' . $lng['edit'] . '</a> | ' .
                         '<a href="../soo/?act=msoo&amp;do=del&amp;id=' . $res['id'] . '">' . $lng['delete'] . '</a>' .
                         '</div>';
            echo '</div>';
            ++$i;
            
        }
        echo '<div class="phdr">' . $lng['total'] . ': ' . $total . '</div>';
        echo '<div class="func"><a href="../soo/?act=msoo&do=add">Thêm Thể Loại</a></div>';
        } else {
            echo 'Thể Loại Không Có!';
            echo '<div class="phdr">' . $lng['total'] . ': 0</div>';
            echo '<div class="func"><a href="../soo/?act=msoo&do=add">Thêm Thể Loại</a></div>';
            require_once('../incfiles/end.php');
        }
        break;
    
}  
} else {
    echo functions::display_error('Không Đủ Đặc Quyền!');
}


?>