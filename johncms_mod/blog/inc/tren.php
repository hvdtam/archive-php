<?php
echo '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>
<title>'.(isset($tit) ? $tit.' &bull; ':NULL).b_set('title').'</title>
<meta name="keywords" content="'.(empty($key) ? b_set('key'):$key).'" />
<meta name="description" content="'.(empty($key) ? b_set('key'):$key).'" /><link rel="shortcut icon" href="'.$home.'/img/fav.ico"/>
<link rel="stylesheet" href="'.$home.'/img/style.css" media="all" />
<meta http-equiv="Content-Type" content="application/vnd.wap.xhtml+xml; charset=utf-8" /></head><body>
<div class="head"><a href="'.$home.'"><img src="'.$home.'/img/logo.png" width="150" height="45"></a></div>
<div class="table"><div id="tab"><table width="100%" cellpadding="0" cellspacing="0"><tbody><tr><td width="33%" class="active">Truyện</td><td width="34%"><a href="http://bentrewap.com">Game</a></td><td width="33%"><a href="http://theme.bentrewap.com">Theme</a></td></tr></tbody></table></div></div>
<div class="main"><a href="'.$home.'">Home</a> | <a href="'.$home.'/theloai.html">Thể Loại</a> | <a href="'.$home.'/tim.php">Tìm Kiếm</a></div>
<div class="tmn"><form action="'.$home.'/tim.php"><input type="text" class="eb" name="key"><input type="submit" value=" " class="fb"/></form></div>
<a name="TOP"></a>';

?>
