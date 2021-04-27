function $show(url,id,eval_str){
    if(document.getElementById){var x=(window.ActiveXObject)?new ActiveXObject("Microsoft.XMLHTTP"):new XMLHttpRequest();}
    if(x){x.onreadystatechange=function() {
        el=document.getElementById(id);
        el.innerHTML='<center><img src="load_big.gif"></img></center>';
        if(x.readyState==4&&x.status==200){
            el.innerHTML='';
            el=document.getElementById(id);
            el.innerHTML=x.responseText;
			if (eval_str) eval(eval_str);
            }
            }
        }
    x.open("GET",url,true);x.send(null);
    }

function ketqua(){
	TuKhoa=document.getElementById('TuKhoa').value;
	TinhTP=document.getElementById('TinhTP').value;
	url = "ketqua.php?TuKhoa="+TuKhoa+"&TinhTP="+TinhTP;
	$show(url,'div_kq_diem_ptth');
}
function ketqua2(div,url){
	url = 'ketqua2.php?url='+url;
	$show(url,div);
}