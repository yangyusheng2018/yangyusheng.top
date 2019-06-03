<?php
/**
 * @name SampleModel
 * @desc sample数据获取类, 可以访问数据库，文件，其它系统等
 * @author pc-201707241653\administrator
 */
class ApischeckModel {

    public $errno=0;
    public $errmsg="123";
    public function __construct() {
    }
    public function sidn($domain){
//        $res=0;
//        $curl = curl_init();
////设置抓取的url
//        $header=[
//        ];
//        curl_setopt($curl, CURLOPT_URL, "https://www.sidn.nl/rest/is?domain=".$domain);
////设置头文件的信息作为数据流输出
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($curl, CURLOPT_POST, false);
//        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
//        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
//        $datajson = curl_exec($curl);
//        curl_close($curl);
        $datajson=file_get_contents("https://www.sidn.nl/rest/is?domain=".$domain);
    $data=json_decode($datajson,true);
    var_dump($data);
    if($data["details"]["state"]["type"]=="FREE"){
        $res=1;
    }elseif($data["details"]["state"]["type"]=="QUARANTINE"){
        $res=0;
    }elseif($data["details"]["state"]["type"]=="ACTIVE"){
        $res=-1;
    }else{
        $res=-2;
    }
    echo "<br>".$res."<br>";
    return $res;
    }
    public function creazy($domain){
        $res=0;
        $domainarr=explode(".",$domain);
        if($domainarr[1]=="nl"){
            $search_tld="30";
        }elseif ($domainarr[1]=="be"){
            $search_tld="13";
        }
        $curl = curl_init();
        $url="https://cri2.secureapi.com.au/ajax/domain_get_availability.php?domain=".$domainarr[0]."&search_tld=".$search_tld."&tlds_to_search=".$domainarr[1];
        curl_setopt($curl, CURLOPT_URL, $url);
//设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $datajson = curl_exec($curl);
        curl_close($curl);
//    $datajon=file_get_contents("https://www.sidn.nl/rest/is?domain=".$domain);
        echo $datajson;
        $data=explode(":",$datajson);
        var_dump($data);
        if($data[1]=="0})"){
            $res=0;
        }elseif ($data[1]=="1})"){
            $res=1;
        }
        return $res;
    }
    public function bigrock($domain){
        $res=0;
        $domainarr=explode(".",$domain);
        if($domainarr[1]=="nl"){
            $url="https://www.bigrock.in/domain-search.php?domain_names%5B%5D=".$domainarr[0]."&tlds%5B%5D=".$domainarr[1]."&action=multiple-check-availability";
            $curl = curl_init();
//设置抓取的url
            $header=[
                "content-Type: text/html; charset=Utf-8",
                ":authority: www.bigrock.in",
                ":method: GET",
                ":path: /domain-search.php?domain_names%5B%5D=123&tlds%5B%5D=nl&action=multiple-check-availability",
                ":scheme: https",
                "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8",
                "accept-language: zh-CN,zh;q=0.9,fil;q=0.8,en;q=0.7,es;q=0.6,fa;q=0.5",
                "cache-control: no-cache",
                "cookie: __cfduid=d784644b351a4c8dd9b87dec9909d483b1553856006; selected_lang=en; SERVERID=a1; _ga=GA1.2.1198943654.1553856028; notice_behavior=none; IR_gbd=bigrock.in; PAPVisitorId=2e2dd93854a57fc883dfd956fwgsKjYi; _fbp=fb.1.1553856036024.822885118; _cb_ls=1; _cb=3w1VJ5QjySCztJrH; _gid=GA1.2.1674573781.1554277041; IR_5632=1554277322196%7C0%7C1554277048821%7C%7C; _chartbeat2=.1553856051571.1554277338460.100001.8dinpCNbXJ9BvXTepwyI3ACQxzvg.3; PHPSESSID=b98fsfgvrjip5bv4cda6r8o8n7; online_marketing_vars=%7B%22location%22%3A%5B%7B%22country%22%3A%22cn%22%2C%22state%22%3A%22NA%22%2C%22city%22%3A%22NA%22%7D%5D%2C%22platform%22%3A%22desktop%22%2C%22os%22%3A%22Windows+NT+6.1%22%2C%22referrer%22%3Anull%2C%22query_params%22%3A%22domain_names%255B%255D%3D123%26tlds%255B%255D%3Dnl%26action%3Dmultiple-check-availability%22%2C%22landing_url%22%3A%22%5C%2Fdomain-search.php%3Fdomain_names%255B%255D%3D123%26tlds%255B%255D%3Dnl%26action%3Dmultiple-check-availability%22%7D; goRhUe86a0=3764ba934ebdc12c87535156af8b5585",
                "pragma: no-cache",
                "upgrade-insecure-requests: 1",
                "user-agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36"
            ];
            curl_setopt($curl, CURLOPT_URL, $url);
//设置头文件的信息作为数据流输出
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POST, false);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            $datajson = curl_exec($curl);
            curl_close($curl);
            $data=json_decode($datajson,true);
            var_dump($data);
            if($data["data"][$domain]["status"]=="available"){
                $res=1;
            }else{
                $res=0;
            }
        }
        return $res;
        }

     public function combaba($domain){
         $res=0;
         $domainarr=explode(".",$domain);
         if($domainarr[1]=="nl"){
             $url="https://www.combaba.com/domain-search.php?domain_names%5B%5D=".$domainarr[0]."&tlds%5B%5D=".$domainarr[1]."&action=multiple-check-availability";
             $datajson=file_get_contents($url);
             $data=json_decode($datajson,true);
             var_dump($data);
             if($data["data"][$domain]["status"]=="available"){
                 $res=1;
             }else{
                 $res=0;
             }
         }
         return $res;
     }
    public function  myorderbox1($domain){
        $res=0;
        $domainarr=explode(".",$domain);
        if($domainarr[1]=="nl"){
            $url="https://domainin.supersite2.myorderbox.com/domain-search.php?domain_names%5B%5D=".$domainarr[0]."&tlds%5B%5D=".$domainarr[1]."&action=multiple-check-availability";
            $datajson=file_get_contents($url);
            $data=json_decode($datajson,true);
            var_dump($data);
            if($data["data"][$domain]["status"]=="available"){
                $res=1;
            }else{
                $res=0;
            }
        }
        return $res;
    }
    public function  myorderbox2($domain){
        $res=0;
        $domainarr=explode(".",$domain);
        if($domainarr[1]=="nl"){
            $url="https://comin.supersite2.china.myorderbox.com/domain-search.php?domain_names%5B%5D=".$domainarr[0]."&tlds%5B%5D=".$domainarr[1]."&action=multiple-check-availability";
            $datajson=file_get_contents($url);
            $data=json_decode($datajson,true);
            var_dump($data);
            if($data["data"][$domain]["status"]=="available"){
                $res=1;
            }else{
                $res=0;
            }
        }
        return $res;
    }
    public function  hostgator($domain){
        $res=0;
        $domainarr=explode(".",$domain);
        if($domainarr[1]=="nl"){
            $url="https://comin.supersite2.china.myorderbox.com/domain-search.php?domain_names%5B%5D=".$domainarr[0]."&tlds%5B%5D=".$domainarr[1]."&action=multiple-check-availability";
            $datajson=file_get_contents($url);
            $data=json_decode($datajson,true);
            var_dump($data);
            if($data["data"][$domain]["status"]=="available"){
                $res=1;
            }else{
                $res=0;
            }
        }
        return $res;
    }
    public function  ovhie($domain){
        $res=0;
            $url="https://www.ovh.ie/engine/apiv6/order/cart/2aca88a7-8c64-479d-b8b5-d250e501676f/domain?domain=".$domain;
            $datajson=file_get_contents($url);
            $data=json_decode($datajson,true);
            var_dump($data);
            if($data[0]["action"]=="create"){
                $res=1;
            }else{
                $res=0;
            }
        return $res;
    }
    public function dnsbe($domain){
        //加载bewhois 服务器
        $fp = @fsockopen("whois.dns.be", 43, $errno, $errstr, 20) or die("Socket Error " . $errno . " - " . $errstr);
        //添加域名
        fputs($fp, $domain. "\r\n");
        $out = "";
        while(!feof($fp)){
            $out .= fgets($fp);
        }
        echo $out;
        fclose($fp);
        //将输出文档转化成数组
        $data=explode("\r\n",$out);
        //获取年份
        $years=explode(" ",trim($data[38]));
        echo $years[3];
        echo "<br>";
        //判断域名是否 可注册  判断域名是否被抢注
        if(trim($data[37])=="Status:	NOT AVAILABLE"&& $years[3]!=date("Y")){
            $res=0;
        }elseif (trim($data[37])=="Status:	NOT AVAILABLE"&& $years[3]==date("Y")){
            $res=-1;
        }elseif (trim($data[37])=="Status:	AVAILABLE"){
            $res=1;
        }
        echo $res."<br>";
        //返回状态码
        return $res;
    }
    public function lgium($domain){
        $domainarr=explode(".",$domain);
        $curl = curl_init();
//设置抓取的url
        curl_setopt($curl, CURLOPT_URL, "https://api.dnsbelgium.be/pubws/das?domain=".$domainarr[0]);
//设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $datajson = curl_exec($curl);
        curl_close($curl);
//    $datajon=file_get_contents("https://www.sidn.nl/rest/is?domain=".$domain);
        $data=json_decode($datajson,true);
        echo $status=$data["data"]["dasResults"]["be"]["status"];
        if($status=="DELEGATED"){
            $res=0;
        }elseif ($status=="AVAILABLE"){
            $res=1;
        }
        return $res;
    }

    public function sidndns($domain){
        $whoisdns=[
            "whois.domain-registry.nl",
            "whois.sidn.nl"
        ];
        $fp = @fsockopen( "whois.sidn.nl", 43, $errno, $errstr, 20) or die("Socket Error " . $errno . " - " . $errstr);
        fputs($fp, $domain . "\r\n");
        $out = "";
        while(!feof($fp)){
            $out .= fgets($fp);
        }
        echo $out;
        fclose($fp);
        $data=explode("\r\n",$out);
        if(isset($data[1])){
            $status=str_replace(" ","",$data[1]);
        }
        echo $status;
        if(count($data)<5){
            $res=1;
        }elseif ($status=="Status:active"){
            $res=-1;
        }elseif ($status=="Status:inquarantine"){
            $res=0;
        }
        echo $domain."||".$res.'<br>';
        return $res;
    }


}