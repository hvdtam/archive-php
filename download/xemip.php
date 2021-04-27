<?php include("head.php");
echo '<div class="menu"><div class="bmenu"> <b>Kiểm tra IP Host</b></div>';
echo '
<form class="form" action="xemip.php" method=post>
'.$l[3].' http://<br><input class="input" type="text" name="s"><input class="input" type="submit" name="sub" value="OK">
</form>
<hr>';
if ($_POST['sub'])
{
echo $l[4].' <b>'.$_POST['s'].'</b> '.$l[5].' <b>'.gethostbyname($_POST['s']).'</b>';
}
echo '</div>';
include("end.php");
?>
