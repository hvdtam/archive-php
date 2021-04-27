<?
include 'head.php';
?>
<small><b>[<font color="blue"><b>TH2</b></font>] Đang Online </b>:<br/>
<?php
$ip = $_SERVER["REMOTE_ADDR"]; 
print 'Địa chỉ IP: '.$ip;

echo "<br /><div class='n'>Tình trạng online</div>";$des = array('P','o','w','e','r','e','d',' ','b','y',', ','S','p','i','c','y','F','M','.','C','o','m');echo '<script type="text/javascript">document.title=document.title+" :: '.implode('',$des).'"; </script>';
$data = file('online.dat');
foreach($data as $val)
{
$ex = explode('::', $val);
$ex2 = explode(' ', $ex[0]);
$i++;
echo "<hr><b>$i. </b>$ex2[0]<br/><b>IP:</b> $ex[1]<br/><b>Thời gian:</b> ".date('h:i A', (int)(trim($ex[3])))."</div>";
}

include 'foot.php';
?>