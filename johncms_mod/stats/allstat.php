<?php

/**
 * @author simba
 * @copyright 2011
 */
defined('_IN_JOHNCMS') or die('Низя так смотреть! Гг.');


// Если нужны графики за неделю и по поисковикам? присваиваем переменной TRUE вместо FALSE.

$grafics = TRUE;

$days = isset($_GET['days']) ? intval($_GET['days']) : 1;
echo '<div class="phdr">Daily Thống kê</div>';
$start_time_stat = strtotime(date("d F y", statistic::$system_time - $days * 86400));
$stop_stat_time = $start_time_stat+86400;
$count_stat = mysql_result(mysql_query("SELECT COUNT(*) FROM `countersall` WHERE `date` > '".$start_time_stat."' AND `date` < '".$stop_stat_time."';"), 0);
if($count_stat > 0){
$day_array = mysql_fetch_assoc(mysql_query("SELECT * FROM `countersall` WHERE `date` > '".$start_time_stat."' AND `date` < '".$stop_stat_time."' LIMIT 1;"));

echo '<div class="gmenu"><h3><img src="icons/all1.png" alt="." /> Thống kê cho '.date("d.m.y", $start_time_stat).'</h3>
<li>Máy chủ: '.$day_array['host'].'</li>
<li>Lượt truy cập: '.$day_array['hits'].'</li>
<h3><img src="icons/search.png" alt="." /> Giới thiệu từ các công cụ tìm kiếm: '.array_sum(array_slice($day_array, 3)).'</h3>';
if($day_array['yandex'] > 0){
    echo'<img src="icons/yandex.png" alt="." /> Yandex.ru ('.$day_array['yandex'].')<br/>'; }
if($day_array['rambler'] > 0){
    echo'<img src="icons/rambler.png" alt="." /> Rambler.ru ('.$day_array['rambler'].')<br/>'; }
if($day_array['google'] > 0){
    echo'<img src="icons/google.png" alt="." /> Google.ru ('.$day_array['google'].')<br/>'; }
if($day_array['mail'] > 0){
    echo'<img src="icons/mail.png" alt="." /> Mail.ru ('.$day_array['mail'].')<br/>'; }
if($day_array['gogo'] > 0){
    echo'<img src="icons/gogo.png" alt="." /> Gogo.ru ('.$day_array['gogo'].')<br/>'; }
if($day_array['yahoo'] > 0){
    echo'<img src="icons/yahoo.png" alt="." /> Yahoo.com ('.$day_array['yahoo'].')<br/>'; }
if($day_array['bing'] > 0){
    echo'<img src="icons/bing.png" alt="." /> Bing.com ('.$day_array['bing'].')<br/>'; }
if($day_array['nigma'] > 0){
    echo'<img src="icons/nigma.png" alt="." /> Nigma.ru ('.$day_array['nigma'].')<br/>'; }
if($day_array['qip'] > 0){
    echo'<img src="icons/qip.png" alt="." /> Search.QIP.ru ('.$day_array['qip'].')<br/>'; }
if($day_array['aport'] > 0){
    echo'<img src="icons/aport.png" alt="." /> АПОРТ.ru ('.$day_array['aport'].')<br/>'; }
echo '</div>';

$searchc = mysql_fetch_row(mysql_query("SELECT SUM(hits), sum(host), sum(yandex), sum(rambler), sum(google), sum(mail), sum(gogo), sum(yahoo), sum(bing), sum(nigma), sum(qip), sum(aport) FROM countersall"));

echo '<div class="menu"><h3><img src="icons/fullstats.png" alt="." /> Nhìn chung, thống kê số liệu</h3>
<li>Tổng số máy chủ:<b> '.$searchc[1].'</b></li>';
echo'<li>Lượt truy cập: <b>'.$searchc[0].'</b></li>';
echo'<h3><img src="icons/search_network.png" alt="." /> Từ công cụ tìm kiếm: '.array_sum(array_slice($searchc, 2)).'</h3>';
echo'<img src="icons/yandex.png" alt="." />&nbsp;Từ Yandex: <b>'.$searchc[2].'</b><br />';
echo'<img src="icons/rambler.png" alt="." />&nbsp;Từ các Rambler: <b>'.$searchc[3].'</b><br />';
echo'<img src="icons/google.png" alt="." />&nbsp;Từ Google: <b>'.$searchc[4].'</b><br />';
echo'<img src="icons/mail.png" alt="." />&nbsp;Từ Mile: <b>'.$searchc[5].'</b><br />';
echo'<img src="icons/gogo.png" alt="." />&nbsp;Từ GoGo: <b>'.$searchc[6].'</b><br />';
echo'<img src="icons/yahoo.png" alt="." />&nbsp;Từ Yahoo: <b>'.$searchc[7].'</b><br />';
echo'<img src="icons/bing.png" alt="." />&nbsp;Từ Bing: <b>'.$searchc[8].'</b><br />';
echo'<img src="icons/nigma.png" alt="." />&nbsp;Từ Nigma: <b>'.$searchc[9].'</b><br />';
echo'<img src="icons/qip.png" alt="." />&nbsp;Từ Search.QIP.Ru: <b>'.$searchc[10].'</b><br />';
echo'<img src="icons/aport.png" alt="." />&nbsp;Từ АПОРТ.Ru: <b>'.$searchc[11].'</b></div>';

if($grafics){

echo '<div class="bmenu"><h3><img src="icons/graf.png" alt="." /> Đồ thị</h3>';

echo'<img src="tmp/we.png" alt="Tiến độ tuần"/><br/><h4>Tìm kiếm giao thông</h4>';
echo'<img src="tmp/se.png" alt="Lịch trình xuyên. từ các công cụ tìm kiếm"/>';

echo '</div>';

///////////////////////////////
/// График хостов за неделю ///
///////////////////////////////
$filetime = date("d.m.y", @filemtime('tmp/we.png'));
$daytime = date("d.m.y", statistic::$system_time);

if(!is_file('tmp/we.png') || $filetime != $daytime){

$q = statistic::$system_time - 604800;
$req = mysql_query("SELECT * FROM `countersall` WHERE `date` > '".$q."' ORDER BY `date` ASC LIMIT 7;");
$a = array(); // Массив с хитами
$b = array(); // Массив с хостами
$c = array(); // Массив с датами
while($arr = mysql_fetch_array($req)){
$a[] = $arr['hits']; // Добавляем хит
$b[] = $arr['host']; // Добавляем хост
$c[] = $arr['date']; // Добавляем дату
}
include_once 'pChart/pData.class';
include_once 'pChart/pChart.class';
$DataSet = new pData;
$DataSet->AddPoint($a,"Serie1"); // Передаём массив с хитами
$DataSet->AddPoint($b,"Serie2"); // Передаём массив с хостами
$DataSet->AddPoint($c,"Serie3"); // Передаём массив с датами
$DataSet->AddSerie("Serie1");
$DataSet->AddSerie("Serie2");
$DataSet->SetAbsciseLabelSerie("Serie3");
$DataSet->SetSerieName("Хиты","Serie1"); // Пояснительные надписи
$DataSet->SetSerieName("Хосты","Serie2");
//$DataSet->SetSerieName("Дата","Serie3");
$DataSet->SetXAxisFormat("date"); // Как обрабатывать массив с датами (в виде даты)

$Test = new pChart(170,140); // Размер графика
$Test->setFontProperties("Fonts/tahoma.ttf",5); // Шрифт боковых надписей
$Test->setGraphArea(30,10,164,110); // Положение самого графика
$Test->drawFilledRoundedRectangle(3,3,167,136,5,240,240,240); // Обводка
$Test->drawRoundedRectangle(1,1,169,138,5,138,230,230);  // Обводка
$Test->drawGraphArea(252,252,252,TRUE); // Цвет фона на котором расположен график
$Test->setDateFormat("d"); // Формат вывода даты по оси Х
$Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2);
$Test->drawGrid(4,TRUE,230,230,230,50);
$Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());
$Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);

$Test->setFontProperties("Fonts/tahoma.ttf",8); // Шрифт заголовка
$Test->drawLegend(31,10,$DataSet->GetDataDescription(),230,255,255, -1,-1,-1, TRUE); // Подложка с пояснениями к линиям
$Test->drawTitle(1,9,"За неделю",50,50,50,195); // Заголовок графика
$Test->Render("tmp/we.png"); //Место хранения картинки

}

//////////////////////////
/// График поисковиков ///
//////////////////////////
$filetime = date("d.m.y", @filemtime('tmp/se.png'));
$daytime = date("d.m.y", statistic::$system_time);
if(!is_file('tmp/we.png') || $filetime != $daytime){
include_once 'pChart/pData.class';
include_once 'pChart/pChart.class';
// Dataset definition
$DataSet = new pData;
$DataSet->AddPoint(array($searchc[2],$searchc[3],$searchc[4],$searchc[5],$searchc[6],$searchc[7],$searchc[8],$searchc[9],$searchc[10],$searchc[11]),"Serie1");
$DataSet->AddPoint(array("Яндекс","Рамблер","Google","Mail","Gogo", "Yahoo", "Bing", "Nigma", "QIP", "Апорт"),"Serie2");
$DataSet->AddAllSeries();
$DataSet->SetAbsciseLabelSerie("Serie2");
// Initialise the graph
$Test = new pChart(235,161);
$Test->setFontProperties("Fonts/tahoma.ttf",7);
$Test->drawFilledRoundedRectangle(7,7,235,193,5,240,240,240);
$Test->drawRoundedRectangle(5,5,234,160,5,20,230,230);
// Draw the pie chart
$Test->AntialiasQuality = 0;
$Test->setShadowProperties(2,2,200,200,200);
$Test->drawFlatPieGraphWithShadow($DataSet->GetData(),$DataSet->GetDataDescription(),70,80,50,PIE_PERCENTAGE,8);
$Test->clearShadow();
$Test->drawPieLegend(158,8,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);
$Test->Render("tmp/se.png");
}
}
}else{
    echo '<div class="rmenu">Các thông tin cho ngày này là mất tích.</div>';
}

++$days;
echo'<div class="phdr"><a href="index.php?act=allstat&amp;days='.$days.'">Xem của '.date("d.m.y", statistic::$system_time - $days * 24 * 3600).'</a></div>';


?>