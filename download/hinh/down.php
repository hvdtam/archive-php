<?php
error_reporting(0);
$id = $_GET['id'];
if($id){
header('Location:http://alomob.net/pict/down.php?content_id='.$id);
}else{
header('Location:index.php');
exit; }
?>
