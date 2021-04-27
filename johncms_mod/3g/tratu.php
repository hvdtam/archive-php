<?php 
include 'head.php';

echo '<div class="phdr">[<font color="blue"><b>MCT</b></font>] Tra từ điển</div>';
echo '<div class="content">      <SCRIPT src="tratu/jsapi" type=text/javascript></SCRIPT>

      <SCRIPT src="tratu/translate.js" type=text/javascript></SCRIPT>
      <FORM action="index.php" method=get>

Dịch từ tiếng <SELECT id=sourcelanguageall 
      name=sourcelanguageall> <OPTION value="" selected>Tự động nhận 
        dạng</OPTION> <OPTION value=en>English</OPTION> <OPTION 
        value=vi>Vietnamese</OPTION> <OPTION value=ar>Arabic</OPTION> <OPTION 
        value=bg>Bulgarian</OPTION> <OPTION value=ca>Catalan</OPTION> <OPTION 
        value=zh-TW>Chinese (traditional)</OPTION> <OPTION value=zh-CN>Chinese 
        (simplified)</OPTION> <OPTION value=hr>Croatian</OPTION> <OPTION 
        value=cs>Czech</OPTION> <OPTION value=da>Danish</OPTION> <OPTION 
        value=nl>Dutch</OPTION> <OPTION value=tl>Filipino</OPTION> <OPTION 
        value=fi>Finnish</OPTION> <OPTION value=fr>French</OPTION> <OPTION 
        value=hi>Hindi</OPTION> <OPTION value=id>Indonesian</OPTION> <OPTION 
        value=it>Italian</OPTION> <OPTION value=ja>Japanese</OPTION> <OPTION 
        value=ko>Korean</OPTION> <OPTION value=lv>Latvian</OPTION> <OPTION 
        value=lt>Lithuanian</OPTION> <OPTION value=no>Norwegian</OPTION> <OPTION 
        value=pl>Polish</OPTION> <OPTION value=pt-PT>Portuguese</OPTION> <OPTION 
        value=ro>Romanian</OPTION> <OPTION value=ru>Russian</OPTION> <OPTION 
        value=sr>Serbian</OPTION> <OPTION value=sk>Slovak</OPTION> <OPTION 
        value=sl>Slovenian</OPTION> <OPTION value=es>Spanish</OPTION> <OPTION 
        value=sv>Swedish</OPTION> <OPTION value=uk>Ukrainian</OPTION></SELECT><br/> Sang tiếng <SELECT 
      id=targetlanguageall name=targetlanguageall> <OPTION value="" 
        selected>Tự động nhận dạng</OPTION> <OPTION value=en>English</OPTION> 
        <OPTION value=vi>Vietnamese</OPTION> <OPTION value=ar>Arabic</OPTION> 
        <OPTION value=bg>Bulgarian</OPTION> <OPTION value=ca>Catalan</OPTION> 
        <OPTION value=zh-TW>Chinese (traditional)</OPTION> <OPTION 
        value=zh-CN>Chinese (simplified)</OPTION> <OPTION 
        value=hr>Croatian</OPTION> <OPTION value=cs>Czech</OPTION> <OPTION 
        value=da>Danish</OPTION> <OPTION value=nl>Dutch</OPTION> <OPTION 
        value=tl>Filipino</OPTION> <OPTION value=fi>Finnish</OPTION> <OPTION 
        value=fr>French</OPTION> <OPTION value=hi>Hindi</OPTION> <OPTION 
        value=id>Indonesian</OPTION> <OPTION value=it>Italian</OPTION> <OPTION 
        value=ja>Japanese</OPTION> <OPTION value=ko>Korean</OPTION> <OPTION 
        value=lv>Latvian</OPTION> <OPTION value=lt>Lithuanian</OPTION> <OPTION 
        value=no>Norwegian</OPTION> <OPTION value=pl>Polish</OPTION> <OPTION 
        value=pt-PT>Portuguese</OPTION> <OPTION value=ro>Romanian</OPTION> 
        <OPTION value=ru>Russian</OPTION> <OPTION value=sr>Serbian</OPTION> 
        <OPTION value=sk>Slovak</OPTION> <OPTION value=sl>Slovenian</OPTION> 
        <OPTION value=es>Spanish</OPTION> <OPTION value=sv>Swedish</OPTION> 
        <OPTION value=uk>Ukrainian</OPTION></SELECT> 
<br/><TEXTAREA id=originaltextall onkeydown=limitText(this.form.originaltextall,this.form.countdownall,5000); onkeyup=limitText(this.form.originaltextall,this.form.countdownall,5000); style="WIDTH: 99%; HEIGHT: 20px" name=originaltextall rows=5></TEXTAREA>
<br/><INPUT id=translatesubmitall onclick=doTranslationAll(); type=button value="Bắt đầu dịch" name=translatesubmitall><br/>
      <DIV id=resultDiv1 style="DISPLAY: none">
      <DIV class=TabView id=TabView>
      <DIV class="main3">Kết quả</A> </DIV>
      <DIV class=Pages class=Page style="BACKGROUND-COLOR: #eeeefe">
      <DIV class=Pad>
      <DIV class=resultdiv id=result></DIV></DIV></DIV></DIV></DIV></DIV>
      
      <DIV id=resultDiv2 style="DISPLAY: none">
      <DIV class=TabView id=TabView2>
      <DIV class="main3">Kết quả 2</DIV>
      <DIV class=Pages>
      <DIV class=Page style="BACKGROUND-COLOR: #eeeefe">
      <DIV class=Pad>
      <DIV class=resultdiv 
      id=resultevtran></DIV></DIV></DIV></DIV></DIV></DIV></FORM></div>';
include 'foot.php';
?>	  