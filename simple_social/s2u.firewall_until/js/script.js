var time = getCookie('wait');
if(!time||time<0){time = 10;}
var timer;var t;var url = document.referrer;
$(document).ready(function(){
	t = $('#container');
	if(t.text()!=''){time = t.text();}
	t.html('Chuyển trang trong: '+time+'s');
	initSC();
});
function initSC(){
	if(t.text()!=''){
		timer = setInterval(countDown, 900);
	} else {
		setTimeout(initSC, 900);
	}
}
function getCookie(c_name){
	var i,x,y,ARRcookies=document.cookie.split(";");
	for (i=0;i<ARRcookies.length;i++){
		x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
		y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
		x=x.replace(/^\s+|\s+$/g,"");
		if (x==c_name){return unescape(y);}
	}
}
function popup(url){
	mywindow=window.open (url, "webbanner");
	mywindow.moveTo(0, 0);
}
function countDown(){
	t.html('Chuyển trang trong: '+time+'s');
	if(time <= 0){
		clearInterval(timer);
		if(location.href==url||url==''){
			url = window.location.protocol+"//"+location.hostname+location.pathname;
		}
		var u = $('#url');
		if(u.val()!=''&&u.val()!=undefined){
			url = u.val();
		}
		window.location = url;
		t.html("Đang tải...");
	}
	time--;
}