<?php

/**
 * @author simba
 * @copyright 2011
 */
 
defined('_IN_JOHNCMS') or die('Низя так смотреть! Гг.');

echo'<div class="phdr">Thống kê điện thoại / trình duyệt</div>';
    $sql = "(SELECT COUNT(DISTINCT `ip`, `browser`) FROM `counter` WHERE `browser` LIKE '%Windows NT 5.1%') UNION ALL
    (SELECT COUNT(DISTINCT `ip`, `browser`) FROM `counter` WHERE `browser` LIKE '%Windows NT 6.0%') UNION ALL
    (SELECT COUNT(DISTINCT `ip`, `browser`) FROM `counter` WHERE `browser` LIKE '%Windows NT 6.1%') UNION ALL
    (SELECT COUNT(DISTINCT `ip`, `browser`) FROM `counter` WHERE `browser` LIKE '%linux%' OR `browser` LIKE '%bsd%') UNION ALL
    (SELECT COUNT(DISTINCT `ip`, `browser`) FROM `counter` WHERE `browser` LIKE '%SymbianOS/9.1;%' OR `browser` LIKE '%Series60/3.0%') UNION ALL
    (SELECT COUNT(DISTINCT `ip`, `browser`) FROM `counter` WHERE `browser` LIKE '%SymbianOS/9.2;%' OR `browser` LIKE '%Series60/3.1%') UNION ALL
    (SELECT COUNT(DISTINCT `ip`, `browser`) FROM `counter` WHERE `browser` LIKE '%SymbianOS/9.3;%' OR `browser` LIKE '%Series60/3.2%') UNION ALL
    (SELECT COUNT(DISTINCT `ip`, `browser`) FROM `counter` WHERE `browser` LIKE '%SymbianOS/9.4;%' OR `browser` LIKE '%Series60/5.0%') UNION ALL
    (SELECT COUNT(DISTINCT `ip`, `browser`) FROM `counter` WHERE `browser` LIKE '%Symbian/3;%' OR `browser` LIKE '%Series60/5.2%') UNION ALL
    (SELECT COUNT(DISTINCT `ip`, `browser`) FROM `counter` WHERE `browser` LIKE '%Series60/2.%') UNION ALL
    (SELECT COUNT(DISTINCT `ip`, `browser`) FROM `counter` WHERE `browser` LIKE '%macos%' OR `browser` LIKE '%macintosh%') UNION ALL
    (SELECT COUNT(DISTINCT `ip`, `browser`) FROM `counter` WHERE `browser` LIKE '%android%')";
    $query = mysql_query($sql);
    $os = array();

    while($result_array = mysql_fetch_array($query)) {
        $os[] = $result_array[0];
        }
    if(array_sum($os)){
    	////// График //////
 	include("pChart/pData.class");
 	include("pChart/pChart.class");
 	// Dataset definition
 	$DataSet = new pData;
 	$DataSet->AddPoint($os,"Serie1");
 	$DataSet->AddPoint(array('Windows XP','Win Vista','Win 7','Linux', 'Symbian 9.1', 'Symbian 9.2', 'Symbian 9.3', 'Symbian 9.4', 'Symbian ^3', 'Other Symbian', 'MAC OS', 'Android'),"Serie2");
 	$DataSet->AddAllSeries();
 	$DataSet->SetAbsciseLabelSerie("Serie2");

 	// Initialise the graph
 	$Test = new pChart(237,172);
 	$Test->setFontProperties("Fonts/tahoma.ttf",6);
 	$Test->drawFilledRoundedRectangle(7,7,237,193,5,240,240,240);
 	$Test->drawRoundedRectangle(5,5,236,171,5,20,230,230);

 	// Draw the pie chart
 	$Test->AntialiasQuality = 0;
 	$Test->setShadowProperties(2,2,200,200,200);
 	$Test->drawFlatPieGraphWithShadow($DataSet->GetData(),$DataSet->GetDataDescription(),80,80,40,PIE_PERCENTAGE,8);
 	$Test->clearShadow();
	$Test->drawPieLegend(150,8,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);
	$Test->Render('tmp/os.png');

  	echo'<div class="menu"><img src="tmp/os.png" alt="Lịch trình OS"/></div>';
    
    echo '<div class="gmenu"><h3>Thông tin chi tiết</h3>';
    
    if($os[0] > 0){
        echo'<li> Windows XP ('.$os[0].')</li>'; }
    if($os[1] > 0){
        echo'<li> Windows Vista ('.$os[1].')</li>'; }
    if($os[2] > 0){
        echo'<li> Windows 7 ('.$os[2].')</li>'; }
    if($os[3] > 0){
        echo'<li> Linux ('.$os[3].')</li>'; }
    if($os[10] > 0){
        echo'<li> MAC OS ('.$os[10].')</li>'; }
    if($os[4] > 0){
        echo'<li> Symbian OS 9.1 ('.$os[4].')</li>'; }
    if($os[5] > 0){
        echo'<li> Symbian OS 9.2 ('.$os[5].')</li>'; }
    if($os[6] > 0){
        echo'<li> Symbian OS 9.3 ('.$os[6].')</li>'; }
    if($os[7] > 0){
        echo'<li> Symbian OS 9.4 ('.$os[7].')</li>'; }
    if($os[8] > 0){
        echo'<li> Symbian OS ^3 ('.$os[8].')</li>'; }
    if($os[9] > 0){
        echo'<li> Khác Symbian ('.$os[9].')</li>'; }
    if($os[11] > 0){
        echo'<li> Android OS ('.$os[11].')</li>'; }
        
    echo '</div>';
    
    }else{
        echo '<div class="rmenu">Không có dữ liệu về khách truy cập hệ thống điều hành!</div>';
    }
    
?>