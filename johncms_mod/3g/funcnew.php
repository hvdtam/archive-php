<?php
function extstr3($content, $start, $end) {
    if ($content && $start && $end) {
        $r = explode($start, $content);
        if (isset($r[1])) {
            $r = explode($end, $r[1]);
            return $r[0];
        }
        return '';
    }
}

function laynoidung($noidung, $start, $stop) {
    $bd = strpos($noidung, $start);
    $kt = strpos(substr($noidung, $bd), $stop) + $bd;
    $content = substr($noidung, $bd, $kt - $bd);
    return $content;
}

function get_contents($url, $cookie='', $user_agent='', $header='') {



    if (function_exists('curl_init')) {



        $ch = curl_init();



        $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';



        $headers[] = 'Accept-Language: en-us,en;q=0.5';



        //$headers[] = 'Accept-Encoding: gzip,deflate';



        $headers[] = 'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7';



        $headers[] = 'Keep-Alive: 300';



        $headers[] = 'Connection: Keep-Alive';



        $headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8';



        curl_setopt($ch, CURLOPT_URL, $url);



        if ($user_agent)
            curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);



        else
            curl_setopt($ch, CURLOPT_USERAGENT, userAgent());



        if ($header)
            curl_setopt($ch, CURLOPT_HEADER, 1);



        else
            curl_setopt($ch, CURLOPT_HEADER, 0);



        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);



        curl_setopt($ch, CURLOPT_REFERER, 'http://www.google.com.vn/search?hl=vi&client=firefox-a&rls=org.mozilla:en-US:official&hs=hKS&q=video+clip&start=20&sa=N');



        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);



        if (strncmp($url, 'https', 6))
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);



        if ($cookie)
            curl_setopt($ch, CURLOPT_COOKIE, $cookie);



        curl_setopt($ch, CURLOPT_TIMEOUT, 100);



        $html = curl_exec($ch);



        $mess_error = curl_error($ch);



        curl_close($ch);
    }



    else {



        $matches = parse_url($url);



        $host = $matches['host'];



        $link = (isset($matches['path']) ? $matches['path'] : '/') . (isset($matches['query']) ? '?' . $matches['query'] : '') . (isset($matches['fragment']) ? '#' . $matches['fragment'] : '');



        $port = !empty($matches['port']) ? $matches['port'] : 80;



        $fp = @fsockopen($host, $port, $errno, $errval, 30);



        if (!$fp) {



            $html = "$errval ($errno)<br />\n";
        } else {



            $rand_ip = rand(1, 254) . "." . rand(1, 254) . "." . rand(1, 254) . "." . rand(1, 254);



            $out = "GET $link HTTP/1.1\r\n" .
                    "Host: $host\r\n" .
                    "Referer: http://www.google.com.vn/search?hl=vi&client=firefox-a&rls=org.mozilla:en-US:official&hs=hKS&q=video+clip&start=20&sa=N\r\n" .
                    "Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5\r\n";



            if ($cookie)
                $out .= "Cookie: $cookie\r\n";



            if ($user_agent)
                $out .= "User-Agent: " . $user_agent . "\r\n";



            else
                $out .= "User-Agent: " . userAgent() . "\r\n";



            $out .= "X-Forwarded-For: $rand_ip\r\n" .
                    "Via: CB-Prx\r\n" .
                    "Connection: Close\r\n\r\n";



            fwrite($fp, $out);



            while (!feof($fp)) {



                $html .= fgets($fp, 4096);
            }



            fclose($fp);
        }
    }



    return $html;
}

function userAgent() {



    $userAgent = array(
        'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)',
        'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)',
        'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; GTB6; .NET CLR 2.0.50727)',
        'Mozilla/5.0 (Windows; U; Windows NT 6.0; vi; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2',
        'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; GTB6)',
        'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2',
        'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.13) Gecko/2009073022 Firefox/3.0.13',
        'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/530.5 (KHTML, like Gecko) Chrome/2.0.172.43 Safari/530.5',
        'Opera/9.80 (Windows NT 5.1; U; en) Presto/2.2.15 Version/10.00',
        'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; InfoPath.2)',
        'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/531.0 (KHTML, like Gecko) Chrome/3.0.182.3 Safari/531.0',
    );



    return $userAgent[rand(0, 10)];
}

function pick($start, $stop, $from) {
    @$from = explode($start, $from);
    @$from = explode($stop, $from[1]);
    @$from = $from[0];
    return $from;
}

function ctheloai($theloai,$page) {
    switch ($theloai) {

        case nhactre:
            $catname = 'Nhạc Trẻ';
            $url = 'http://m.nhaccuatui.com/the-loai-5015/nhac-tre.'.$page.'.html';
            return $url;
            break;
        case trutinh:
            $catname = 'Nhạc Trữ Tình';
            $url = 'http://m.nhaccuatui.com/the-loai-5000/nhac-tru-tinh.'.$page.'.html';
            return $url;
            break;
        case cachmang:
            $catname = 'Nhạc Cách Mạng';
            $url = 'http://m.nhaccuatui.com/the-loai-5001/nhac-cach-mang.'.$page.'.html';
            return $url;
            break;
        case khongloi:
            $catname = 'Nhạc Không Lời';
            $url = 'http://m.nhaccuatui.com/the-loai-5002/nhac-khong-loi.'.$page.'.html';
            return $url;
            break;
        case nhactrinh:
            $catname = 'Nhạc Trịnh';
            $url = 'http://m.nhaccuatui.com/the-loai-5003/nhac-trinh.'.$page.'.html';
            return $url;
            break;
        case tienchien:
            $catname = 'Nhạc Tiền chiến';
            $url = 'http://m.nhaccuatui.com/the-loai-5004/nhac-tien-chien.'.$page.'.html';
            return $url;
            break;
        case thieunhi:
            $catname = 'Nhạc Thiếu Nhi';
            $url = 'http://m.nhaccuatui.com/the-loai-5005/nhac-thieu-nhi.'.$page.'.html';
            return $url;
            break;
        case raphiphop:
            $catname = 'Rock,Rap-Hiphop';
            $url = 'http://m.nhaccuatui.com/the-loai-5006/rock-hip-hop-viet.'.$page.'.html';
            return $url;
            break;
        case tuihat:
            $catname = 'Nhạc Tui hát';
            $url = 'http://m.nhaccuatui.com/the-loai-5007/nhac-tui-hat.'.$page.'.html';
            return $url;
            break;
        case usuk:
            $catname = 'Nhạc US - UK';
            $url = 'http://m.nhaccuatui.com/the-loai-5008/nhac-us-uk.'.$page.'.html';
            return $url;
            break;
        case nhachoa:
            $catname = 'Nhạc Hoa';
            $url = 'http://m.nhaccuatui.com/the-loai-5009/nhac-hoa.'.$page.'.html';
            return $url;
            break;
        case nhachan:
            $catname = 'Nhạc Hàn';
            $url = 'http://m.nhaccuatui.com/the-loai-5010/nhac-han-quoc.'.$page.'.html';
            return $url;
            break;
        case nhacnhat:
            $catname = 'Nhạc Nhật';
            $url = 'http://m.nhaccuatui.com/the-loai-5011/nhac-nhat.'.$page.'.html';
            return $url;
            break;
        case khac:
            $catname = 'Thể loại khác';
            $url = 'http://m.nhaccuatui.com/the-loai-5012/the-loai-khac.'.$page.'.html';
            return $url;
            break;
        case topnew:
            $url='http://m.nhaccuatui.com/top-new.html';
            return $url;
            break;
        case tophot:
            $url='http://m.nhaccuatui.com/top-hot.html';
            return $url;
            break;
        default:
            $catname = 'Tất cả';
            $url = 'http://m.nhaccuatui.com/the-loai/tat-ca.'.$page.'.html';
            return $url;
            break;
    }
}
function khongdau($str) {



	if(!$str) return false;



	$utf8 = array(



            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',



            'd'=>'đ|Đ',



            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',



            'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',



            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',



            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',



            'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',



			);



	foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);



	return $str;



}
?>
