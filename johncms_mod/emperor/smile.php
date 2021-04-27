<?php
include "cfg.php";
include "db.php";
if (isset($_GET[site]))
{
$_GET[site] = htmlspecialchars($_GET[site]);
}
if (isset($_GET[site]))
{
$_GET[name] = htmlspecialchars($_GET[name]);
}
$set['title']='Справка по смайлам'; 
head();
title ();
function smiles() {
echo "<div class=\"main\">"; pochta();
$dir = opendir ("smiles");
while ($file = readdir ($dir)) 
{ if (ereg (".gif$", "$file"))
{$a[]=$file;}}  
closedir ($dir); 
sort($a);

$total = count($a); 
if (empty($_GET['start'])) $start = 0;
else $start = $_GET['start'];
if ($total < $start + 10){ $end = $total; }
else {$end = $start + 10; }
for ($i = $start; $i < $end; $i++){ 

$smkod=str_replace(".gif","",$a[$i]);

echo '<img src="smiles/'.$a[$i].'" alt="">'; 
echo '- :'.$smkod.'<br>';
}


$a=count($a);
$ba=ceil($a/10);
$ba2=floor(($a-1)/10)*10;

echo'<br/>Страницы:';
$asd=$start-(10*4);
$asd2=$start+(10*5);

if($asd<$a && $asd>0){echo ' <a href="smile.php?usr='.$_GET[usr].'&amp;pwd='.$_GET[pwd].'&amp;start=0&amp;id=">1</a> ... ';}

for($i=$asd; $i<$asd2;)
{
if($i<$a && $i>=0){
$ii=floor(1+$i/10);

if ($start==$i) {
echo ' <b>'.$ii.'</b>';
               }
                else {
echo ' <a href="smile.php?usr='.$_GET[usr].'&amp;pwd='.$_GET[pwd].'&amp;start='.$i.'&amp;id=">'.$ii.'</a>';
                     }}


$i=$i+10;}
if($asd2<$a){echo ' ... <a href="smile.php?usr='.$_GET[usr].'&amp;pwd='.$_GET[pwd].'&amp;start='.$ba2.'&amp;id=">'.$ba.'</a>';}

echo "<br/><a href=\"chat.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]\">Quay lại</a>";
}

$db_connection = mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_table, $db_connection);

$tikr = mysql_num_rows(mysql_query("SELECT * FROM war WHERE usr = '$_GET[usr]' AND pwd = '$_GET[pwd]'"));
if($tikr == 1)
{
if($_GET[id] == "")
{smiles();}
}
else
{
echo "<div class=\"main\">"; pochta();
echo "Вы не зарегистрированы!!!<br/>";
}
mysql_close($db_connection);
foot();
?>