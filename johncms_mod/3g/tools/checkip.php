<?php include("../head.php");?><?
echo '<div class="menu">';
echo '<p align=center><b>Kiểm tra IP</b></p>
<form action="checkip.php" method=post>
'.$l[3].'<br><input type="text" name="s"><input type="submit" name="sub" value="OK">
</form>
<hr>';
if ($_POST['sub'])
{
echo $l[4].' <b>'.$_POST['s'].'</b> '.$l[5].' <b>'.gethostbyname($_POST['s']).'</b>';
}
echo '</div>';
?>
<?php include("../foot.php");?>