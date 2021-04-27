<?php include 'head.php'; ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>MChanTroi.Net-Cong Cu Ma Hoa MD5</title>
<meta name="keywords" content="tools.MChanTroi.Net, dịch văn bản, mã hóa md5, whois tools, check domain, check page ranks, MChanTroi.Net, svit, charset converter, convert charset, chuyển đổi charset">
<meta name="description" content="MChanTroi.Net - Công cụ tiện ích cho cộng đồng mạng. Mã hóa MD5">
</head>
<body>

<form method="POST" action="?act=mahoa">
<input type="text" name="text_md5" value="<?echo $_POST['text_md5'];?>" size="22">
<select size="1" name="solan">
	<option selected value="1">Mã hóa 1 lần</option>
	<option value="2">Mã hóa 2 lần</option>
	<option value="3">Mã hóa 3 lần</option>
	<option value="4">Mã hóa 4 lần</option>
	<option value="5">Mã hóa 5 lần</option>
	<option value="6">Mã hóa 6 lần</option>
	<? if (isset($_GET['act'])) 
		{
			$ketqua=$_POST['text_md5'];
			$solan=$_POST['solan'];
			echo "<option selected value=\"$solan\">Mã hóa $solan lần</option>";
		}
	?>
</select>
<input type="submit" value="Mã hóa" name="B1">
<input type="reset" value="Nhập lại">
</form>
<?php
if (isset($_GET['act']))
	{
		for ($i=1;$i<=$solan;$i++)
			$ketqua=md5($ketqua);
		echo "<br><br>Kết quả mã hóa MD5 $solan lần:<br><textarea rows='5' name='ketqua_md5' cols='22'>$ketqua</textarea>";
	}
//	echo "<br><br><a href='./'>Click here to Go Back</a>";
?>

</body>
</html>
<?php include 'foot.php'; ?>
