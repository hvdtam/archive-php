<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> _-_ SatThuIT.InFo _-_ Code Dowload Từ Xtgem</title>
</head>
<table width="70%" cellpadding="0" cellspacing="0" border="1" align="center">
	<tr><th align="center" colspan="2">Code DownLoad Từ Xtgem.Com by _-_ SatThuIT.InFo _-_</th></tr>
	<form name="filepost" method="post">
	<tr><td align="left" width="20%">Link File:</td><td align="left"><textarea name="linkfile" cols="100" rows="10" ></textarea></td></tr>
    <tr><td align="left" width="20%">Link ref:</td><td align="left"><input name="reffile" type="text" size="134" value="http://hkozon.wap.sh/" /></td></tr>
    <tr><td align="center" colspan="2"><input name="submit" type="submit" value="Lấy Link" /></td></tr>
	</form>
</table>
<center>&copy; 2012 by _-_ SatThuIT.InFo _-_</center>
<?php
	if(isset($_REQUEST['submit']) && $_REQUEST['linkfile'] != NULL){
		$referer = $_REQUEST['reffile'];
		$linkarray = explode("\n",$_REQUEST['linkfile']);
		for($i = 0; $i < count($linkarray); $i++){
			$linkfile = trim($linkarray[$i]);
			$linkname = basename($linkfile);
			$fp = fopen($linkname,'w');
			set_time_limit(0);
			$curl = curl_init();
			curl_setopt ($curl, CURLOPT_URL, $linkfile);
			curl_setopt ($curl, CURLOPT_REFERER, $referer);
			curl_setopt ($curl, CURLOPT_FILE, $fp);
			curl_exec ($curl);
			curl_close ($curl);
			fclose($fp);
			echo 'Finished File: '.$linkname.'<br>';
		}
	}
?>
<body>
</body>
</html>
