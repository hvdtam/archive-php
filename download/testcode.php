<?
include 'head.php';
?>
<div class="phdr">Test Code</div>
<table border="0" width="100%" border="0" cellpadding="5" cellspacing="0">
<tr>
<td>
<textarea>
</textarea>
</td>
<td>
<iframe FrameBorder="0" width="24px" height="32px" Class="viewer" style="width:24px;height:32px;background-color:ffffff;" name="view" src="about:Blank"></iframe>
</td>
</tr>
<tr>
<td colspan="2">
<input name="submit" type="submit" value="Xem thu code" onclick="open_new()">
</td>
</tr>
</table>
<Script type="text/javascript">


function display()
{
var result = window.open('about:Blank','view','');
var tmp = result.document;
tmp.write(document.getElementById('code').value);
tmp.close();
return false;

}
{
display()
}
function open_new()
{
var result = window.open('about:Blank','','toolbar=yes, location=yes, directories=yes, status=yes, menubar=yes, scrollbars=yes, resizable=no, copyhistory=yes');
var tmp = result.document;
tmp.write(document.getElementById('code').value);
tmp.close();
return false;
}
</script>
<?
include 'foot.php';
?>
