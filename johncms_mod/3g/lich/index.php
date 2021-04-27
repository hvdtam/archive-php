<?php
include '../head.php';
?>
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<script language="JavaScript" src="amlich.js" type="text/javascript"></script>
<script language="JavaScript">
<!--
showVietCal();
-->
</script>
</head>

<!--
-->
<table align="center" cellspacing="1" border="0">

<tr>
<td align="center">

<script language="JavaScript">
<!--
document.writeln(printSelectedMonth());
//-->
</script>

</td>
</tr>

<tr>
<td align="center">
<form class="login" name="SelectMonth" action="">
Th&aacute;ng
<select class="logput" name="month">
<option value="1">1
<option value="2">2
<option value="3">3
<option value="4">4
<option value="5">5
<option value="6">6
<option value="7">7
<option value="8">8
<option value="9">9
<option value="10">10
<option value="11">11
<option value="12">12
</select> &#160;&#160;&#160;&#160;
N&#x103;m
<INPUT class="logput" NAME="year" size=4 value="2005"> &#160;
<p>
<input class="logput" type="button" value="Xem l&#x1ECB;ch th&aacute;ng" onClick="javascript:viewMonth(parseInt(month.value), parseInt(year.value));">

&#160;&#160;
<input class="logput"type="button" value="Xem l&#x1ECB;ch n&#x0103;m" onClick="javascript:viewYear(parseInt(year.value));">
<!--
-->
</form>

<script type="text/javascript">
<!--
getSelectedMonth();
document.SelectMonth.month.value = currentMonth;
document.SelectMonth.year.value = currentYear;
function viewMonth(mm, yy) {
window.location = window.location.pathname + '?yy='+yy+'&mm='+mm;
}
function viewYear(yy) {
var loc = 'currentyear.php?yy='+yy;
var win2702 = window.open(loc, "win2702", "menubar=yes,scrollbars=yes,resizable=yes");
}

//-->
</script>
</td>
</tr>
</table>
<?php
include '../end.php';
?>
