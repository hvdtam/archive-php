<?php
###########################
#  Данная версия скрипта принадлежит       # 
#       LiraS aka Артур Лукин Иванович          #
#   Вносить свои изменения крайне               #
#                 запрещенно!                                    #
###########################
include("db.php");
include("on.php");
include "cfg.php";
//Вывод разделов в форум!
function razdel()
{
$razd = mysql_query("SELECT COUNT(*) FROM `forum_r`");
$r = mysql_result($razd, 0);
if ($r == 0)
{
echo "<div class=\"main\">";
echo "---Разделов нет---";
$a = mysql_query("SELECT `adm` FROM `war` WHERE `usr` = '$_GET[usr]'");
$result = mysql_fetch_array($a);
if ($result[adm] >= 2)
{
echo "<br/>\n <a href=\"cpan/forum.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Создать раздел!</a>";
}
echo "<br/>\n<a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">На главную</a>";
}
else
{
echo "<div class=\"main\">";
$razd = mysql_query("SELECT * FROM `forum_r`");
$result = mysql_fetch_array($razd);
do{
$tcount = mysql_query("SELECT COUNT(*) FROM `forum_t` WHERE `id_r`='$result[id]'");
$t_count = mysql_result($tcount,0);
$result[title] = iconv("windows-1251","utf-8",$result[title]);
echo "<b><a href=\"forum.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=look_r&amp;razd=$result[id]\">$result[title]</a></b>[$t_count]<br/>";
} while ($result = mysql_fetch_array($razd));
$a = mysql_query("SELECT `adm` FROM `war` WHERE `usr` = '$_GET[usr]'");
$result = mysql_fetch_array($a);
echo "--------";
if ($result[adm] >= 2)
{
echo "<br/>\n <a href=\"cpan/forum.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Создать раздел!</a>";
}
echo "<br/>\n<a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">На главную</a>";
}
}
// Вывод тем
function look_r()
{
$tem = mysql_query("SELECT * FROM forum_r WHERE id = '$_GET[razd]' LIMIT 1");
$set['title']='Форум - Создание темы'; 
title();
$a = mysql_query("SELECT COUNT(*) FROM `forum_t` WHERE `id_r` = '$_GET[razd]'");
$r = mysql_result($a,0);
if ($r == 0)
{
echo"<div class=\"main\">";
echo"<a href=\"forum.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&razd=$_GET[razd]&amp;id=create_t\">Создать тему</a><br/>\n";
echo"---Тем нет---<br/>\n";
echo"<a href=\"forum.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Разделы</a>";
} else
{
if ($_GET[page] == "" || $_GET[page] < 0 || $_GET[page] == "0") 
{
$_GET[page] = 0;
}
$next = $_GET[page] + 1;
$back = $_GET[page] - 1;
$num = $_GET[page] * 10;
if($_GET[page] == "0")
{$i = 1;}
else{$i = ($_GET[page]*10)+1;}
$viso = mysql_num_rows(mysql_query("SELECT title FROM forum_t WHERE id_r = '$_GET[razd]'"));
$puslap = floor($viso/10);
echo"<div class=\"main\">";
echo"<a href=\"forum.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&razd=$_GET[razd]&amp;id=create_t\">Создать тему</a><br/>\n";
$times = date("H:i");
echo "<center>-=$times=-</center>";
$tem = mysql_query("SELECT * FROM forum_t WHERE id_r = '$_GET[razd]' ORDER BY last DESC LIMIT $num,10");
while ($t = mysql_fetch_array($tem)) 
{
$pcount = mysql_query("SELECT COUNT(*) FROM `forum_p` WHERE `id_t`='$t[id]'");
$p_count = mysql_result($pcount,0);
$p_count = $p_count + 1;
$t[title] = iconv("windows-1251","utf-8",$t[title]);
$t[user] = iconv("windows-1251","utf-8",$t[user]);
echo"$t[user][$t[f_time]]<br/>\n<b><a href=\"forum.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;razd=$_GET[razd]&amp;tema=$t[id]&amp;id=look_t\">$t[title]</a></b>[$p_count]<br/>\n";
}
if ($_GET[page] > 0)
{
echo "<a href=\"forum.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=look_r&amp;razd=$_GET[razd]&amp;page=$back\">back</a>";
}
elseif ($_GET[page] == 0)
{
echo "back";
}
echo"|";
if($_GET[page] < $puslap || $_GET[page] == "" || $_GET[page] == 0)
{echo "<a href=\"forum.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=look_r&amp;razd=$_GET[razd]&amp;page=$next\">next</a><br/>";}
else
{echo "next<br/>";}
echo"<a href=\"forum.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Разделы</a>";
}
}
//Создать тему
function create_t()
{
echo"<div class=\"main\">";
echo"<form action=\"forum.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;razd=$_GET[razd]&amp;id=save_t\" method=\"post\">Название темы:<br/>\n";
echo"<input type=\"text\" name=\"tema\"><br/>\n";
echo"Текст:<br/><input type=\"text\" name=\"text\"><br/>\n";
echo"<input type=\"submit\" value=\"Создать\" class=\"ibutton\"></form>";
echo"<a href=\"forum.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=look_r&amp;razd=$_GET[razd]\">Темы</a><br/>\n";
}
//Сохранить тему
function save_t()
{
echo"<div class=\"main\">";
if (empty($_POST[tema]))
{
echo "Не написано название темы!";
}
elseif(empty($_POST[text]))
{
echo "Не написан текст сообщения!";
} else
{
$_POST[razd] = htmlspecialchars(stripslashes($_POST[razd]));
$tema = htmlspecialchars(stripslashes($_POST[tema]));
$text = htmlspecialchars(stripslashes($_POST[text]));
$tema = iconv("utf-8","windows-1251",$tema);
$text = iconv("utf-8","windows-1251",$text);
$times = date("m.d H:i");
$time=time();
mysql_query("INSERT INTO `forum_t`(id_r,title,text,time,f_time,last,user) VALUES ('$_GET[razd]','$tema','$text','$times','$times','$time','$_GET[usr]')");
mysql_query("OPTIMIZE TABLE `forum_t`");
echo "Вы успешно создали тему!<br/>\n";
echo "<a href=\"forum.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;razd=$_GET[razd]&amp;id=look_r\">Темы</a>";
}
}
//Показ постов в теме
function tema()
{
echo"<div class=\"main\">";
$_GET[razd] = htmlspecialchars(stripslashes($_GET[razd]));
$_GET[tema] = htmlspecialchars(stripslashes($_GET[tema]));
$times = date("H:i");
echo "<div class=\"main\"><center>-=$times=-</center>";
$post = mysql_query("SELECT * FROM `forum_t` WHERE `id`='$_GET[tema]' or `id_r`='$_GET[razd]'");
$p = mysql_result($post,0);
if ($p == 0)
{
echo "Че то ты тут паришь:)";
} else
{
if ($_GET[page] == "" || $_GET[page] < 0 || $_GET[page] == "0") 
{
$_GET[page] = 0;
}
$next = $_GET[page] + 1;
$back = $_GET[page] - 1;
$num = $_GET[page] * 9;
if($_GET[page] == "0")
{$i = 1;}
else{$i = ($_GET[page]*9)+1;}
$viso = mysql_num_rows(mysql_query("SELECT user FROM forum_p WHERE id_t = '$_GET[tema]'"));
$puslap = floor($viso/9);
echo "<a href=\"forum.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;tema=$_GET[tema]&amp;id=create_p\">Ответить</a><br/>--------<br/>";
$post = mysql_query("SELECT * FROM `forum_t` WHERE `id`='$_GET[tema]'");
$i = mysql_fetch_array($post);
$i[user] = iconv("windows-1251","utf-8",$i[user]);
$i[text] = iconv("windows-1251","utf-8",$i[text]);
echo "<b><a href=\"forum.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;user=$i[user]&amp;id=create_p\">$i[user]</a></b><a href=\"info_m.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;man=$i[user]\">[i]</a>[$i[time]]<br/>\n$i[text]<br/>\n";
$tekst = mysql_query("SELECT * FROM `forum_p` WHERE id_t='$_GET[tema]' ORDER by time ASC LIMIT $num,9");
while ($tk = mysql_fetch_array($tekst))
{
$tk[user] = strip_tags($tk[user]);
$tk[text] = strip_tags($tk[text]);
$tk[time] = strip_tags($tk[time]);
$tk[user] = iconv("windows-1251","utf-8",$tk[user]);
$tk[text] = iconv("windows-1251","utf-8",$tk[text]);
echo "<b><a href=\"forum.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;user=$tk[user]&amp;id=create_p\">$tk[user]</a></b><a href=\"info_m.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;man=$tk[user]\">[i]</a>[$tk[time]]<br/>\n$tk[text]<br/>\n";
}
echo"-------<br/>\n";
}
if ($_GET[page] > 0)
{
echo "<a href=\"forum.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;razd=$_GET[razd]&amp;tema=$_GET[tema]&amp;id=look_t&amp;page=$back\">back</a>";
}
elseif ($_GET[page] == 0)
{
echo "back";
}
echo"|";
if($_GET[page] < $puslap || $_GET[page] == "" || $_GET[page] == 0)
{echo "<a href=\"forum.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;razd=$_GET[razd]&amp;tema=$_GET[tema]&amp;id=look_t&amp;page=$next\">next</a><br/>";}
else
{echo "next<br/>";}
echo "<br/>\n<a href=\"forum.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;razd=$i[id_r]&amp;id=look_r\">Темы</a><br/>\n";
echo"<a href=\"forum.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Разделы</a>";
}
//Создание поста
function create_p()
{
$_GET[tema] = htmlspecialchars(stripslashes($_GET[tema]));
echo "<div class=\"main\">";
echo "<form action=\"forum.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;tema=$_GET[tema]&amp;id=save_p\" method=\"post\">Текст сообщения:<br/>\n";
if (isset($_GET[user]))
{
$_GET[user] = htmlspecialchars($_GET[user]);
echo "<input type=\"text\" name=\"postas\" value=\"$_GET[user], \">";
} else
{
echo "<input type=\"text\" name=\"postas\">";
}
echo "<br/>\n<input type=\"submit\" value=\"Написать\" class=\"ibutton\"></form>";
echo "---------<br/>\n<a href=\"forum.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;tema=$_GET[tema]&amp;id=look_t\">В тему</a>";
}
//Сохранение поста!
function save_p()
{
echo "<div class=\"main\">";
if (empty($_POST[postas]))
{
echo "Пустое поле ввода!";
echo "<br/>\n<a href=\"forum.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;tema=$_GET[tema]&amp;id=look_t\">В тему</a>";
}
else 
{
$_POST[postas] = htmlspecialchars(stripslashes($_POST[postas]));
$_GET[tema] = htmlspecialchars(stripslashes($_GET[tema]));
$_GET[usr] = htmlspecialchars(stripslashes($_GET[usr]));
$times = date("m.d H:i");
$_POST[postas] = iconv("utf-8","windows-1251",$_POST[postas]);
$_GET[usr] = iconv("utf-8","windows-1251",$_GET[usr]);
mysql_query("INSERT INTO `forum_p`(id_t,user,text,time) VALUES ('$_GET[tema]','$_GET[usr]','$_POST[postas]','$times')");
$time=time();
mysql_query("UPDATE `forum_t` SET `f_time` = '$times',`last` = '$time' WHERE `id` = '$_GET[tema]'");
mysql_query("OPTIMIZE TABLE `forum_p`");
mysql_query("OPTIMIZE TABLE `forum_t`");
$_GET[usr] = iconv("windows-1251","utf-8",$_GET[usr]);
echo "Текст успешно написан!<br/>\n<a href=\"forum.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;tema=$_GET[tema]&amp;id=look_t\">В тему</a>";
}
}

$db_connection = mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_table, $db_connection);

$tikr = mysql_num_rows(mysql_query("SELECT usr, pwd FROM war WHERE usr = '$_GET[usr]' AND pwd = '$_GET[pwd]'"));

if($tikr == 1)
{
if($_GET[id] == "")
{
$set['title']='Форум - Разделы'; 
head();
title ();
razdel();}
elseif($_GET[id] == "look_r")
{
$set['title']='Форум - Темы'; 
head();
title ();
look_r();}
elseif($_GET[id] == "create_t")
{
$set['title']='Форум - Создание темы'; 
head();
title ();
create_t();}
elseif($_GET[id] == "save_t")
{
head();
save_t();}
elseif ($_GET[id] == "look_t")
{
$set['title']='Форум - Тема'; 
head();
title ();
tema();
}
elseif($_GET[id] == "create_p")
{
$set['title']='Форум - Пишем ответ'; 
head();
title ();
create_p();
}
elseif($_GET[id] == "save_p")
{$set['title']='Форум - Пишем ответ'; 
head();
title ();
save_p();
}
}else
{
echo "<div class=\"main\">"; 
echo "Вы не зарегистрированны!!!<br/>";
echo "<br/>";
}
mysql_close($db_connection);
foot();
?>
