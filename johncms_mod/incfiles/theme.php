<?php
if ($user_id || $set['active']) {
echo '<div class="logo" align="left"><form action="' . $rootpath . 'users/profile.php?act=settings" method="post" style="font-size:x-small" >' .
'<select name="skin" style="font-size:x-small"></div>';
foreach (glob($rootpath . 'theme/*/*.css') as $val) {
$dir = explode('/', dirname($val));
$theme = array_pop($dir);
echo '<option' . (core::$user_set['skin'] == $theme ? ' selected="selected">' : '>') . $theme . '</option>';
}
echo '</select>' .
'<input type="submit" name="submit" value="OK!" style="font-size:x-small"/></form></div>';
}
echo '<center>
';
echo '</center>';
?>
